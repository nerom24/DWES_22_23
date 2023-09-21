<?php

class Clientes extends Controller
{

    function render($param = [])
    {
        # inicio o continuo sesión
        sec_session_start();

        # Compruebo usuario autentificado
        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";
            header("location:". URL. "login"); 
        } else {

        if (isset($_SESSION["mensaje"])) {
            $this->view->mensaje = $_SESSION["mensaje"];
            unset($_SESSION["mensaje"]);
        }
        // Mostrara todos los alumnos
        $this->view->title = "Tabla Clientes";
        $this->view->clientes = $this->model->get();
        $this->view->render("clientes/main/index");
    }
    }

    function nuevo($param = []) {
        
        # Iniciamos o continuamos sesión
        sec_session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";
            header("location:". URL. "login"); 
        } else if((!in_array($_SESSION['id_rol'],$GLOBALS['crear']))) {
            $_SESSION['error'] = "Operacion sin privilegio";
            header("location:" .URL. "clientes");
        } else {

        $this->view->cliente = new Cliente();

        if (isset($_SESSION["error"])) {

            $this->view->error = $_SESSION["error"];

            unset($_SESSION["error"]);

            $this->view->cliente = unserialize($_SESSION["cliente"]);
            unset($_SESSION["cliente"]);

            $this->view->errores = $_SESSION["errores"];
            unset($_SESSION["errores"]);
        }

        // Metodo formulario nuevo cliente  
        $this->view->title = "Formulario cliente nuevo";
        $this->view->render("clientes/nuevo/index");
    }
    }

    function create($param = [])
    {

        # inicio sesión
        sec_session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";
            header("location:". URL. "login"); 
        } else if((!in_array($_SESSION['id_rol'],$GLOBALS['crear']))) {
            $_SESSION['error'] = "Operacion sin privilegio";
            header("location:" .URL. "clientes");
        } else {

        //Saneamos los datos del formulario Filter_sanitize

        $nombre = filter_var($_POST['nombre'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $apellidos = filter_var($_POST['apellidos'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $telefono = filter_var($_POST['telefono'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $ciudad = filter_var($_POST['ciudad'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_var($_POST['email'] ??= '', FILTER_SANITIZE_EMAIL);
        $dni = filter_var($_POST['dni'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);


        $new_cliente = new Cliente(
            null,
            $apellidos,
            $nombre,
            $telefono,
            $ciudad,
            $dni,
            $email,
            null,
            null
        );


        // Nombre. Obligatorio, tamaño máximo 20
        if (empty($nombre)) {
            $errores["nombre"] = "Campo obligatorio.";
        } else if (strlen($nombre) > 20) {
            $errores["nombre"] = "Nombre superior a 20 caracteres.";
        }


        // Apellidos. Obligatorio. tamaño máximo de 45
        if (empty($apellidos)) {
            $errores["apellidos"] = "Campo obligatorio.";
        } else if (strlen($apellidos) > 45) {
            $errores["apellidos"] = "apellidos superior a 45 caracteres.";
        }


        // Teléfono. No obligatorio, 9 dígitos numéricos
        $options = [
            'options' => [
                'regexp' => '/[0-9]{9}$/'
            ]
        ];
        if (!empty($telefono)) {
            if (!filter_var($telefono, FILTER_VALIDATE_REGEXP, $options)) {
                $errores["telefono"] = "Formato incorrecto.";
            }
        }

        // Ciudad. Obligatorio, tamaño máximo de 20
        if (empty($ciudad)) {
            $errores["ciudad"] = "Campo obligatorio.";
        } else if (strlen($ciudad) > 20) {
            $errores["ciudad"] = "ciudad superior a 20 caracteres.";
        }

        //Validamos dni
        //Valor obligatorio

        $options = [
            'options' => [
                'regexp' => '/[0-9]{7,8}[A-Z]$/'
            ]
        ];
        if (empty($dni)) {
            $errores["dni"] = "Campo obligatorio.";
        } else if (!filter_var($dni, FILTER_VALIDATE_REGEXP, $options)) {
            $errores["dni"] = "Formato incorrecto.";
        } else if (!$this->model->validarDni($dni)) {
            $errores["dni"] = "Numero de dni duplicado.";
        }


        // Email. Obligatorio, formato EMAIL válido, ha de ser único en la tabla de clientes.
        if (empty($email)) {
            $errores["email"] = "Campo obligatorio.";
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errores["email"] = "Formato incorrecto.";
        } else if (!$this->model->validarEmail($email)) {
            $errores["email"] = "Email duplicado.";
        }

        //Comprobar validacion

        if (!empty($errores)) {
            //si errores no esta vacio el formulario no ha sido validado
            $_SESSION["cliente"] = serialize($new_cliente);
            $_SESSION["error"] = "Formulario no ha sido validado";
            $_SESSION["errores"] = $errores;

            //redireccionamos a nuevo alumno
            header('Location:' . URL . 'clientes/nuevo');
        } else {

            $this->view->title = "Tabla Cuentas";
            $this->model->create($new_cliente);
            $_SESSION["mensaje"] = "Cliente creado correctamente";
            header("Location:" . URL . "clientes");
        }
    }
    }


    function delete($param = [])
    {

        # inicio o continuo sesión
        sec_session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";
            header("location:". URL. "login"); 
        } else if((!in_array($_SESSION['id_rol'],$GLOBALS['eliminar']))) {
            $_SESSION['error'] = "Operacion sin privilegio";
            header("location:" .URL. "clientes");
        } else  {

        $id = $param[0];
        
        $this->model->delete($id);

        header("Location:" . URL . "clientes");
    }
    }

    function editar($param = []) {
        # Iniciamos o continuamos sesión
        sec_session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";
            header("location:". URL. "login"); 
        } else if((!in_array($_SESSION['id_rol'],$GLOBALS['editar']))) {
            $_SESSION['error'] = "Operacion sin privilegio";
            header("location:" .URL. "clientes");
        } else {

        #Obtengo el id del cliente
        $this->view->id = $param[0];

        # Comprueba si el formulario no ha sido validado
        if (isset($_SESSION['error'])) {

            # Mensaje de error
            $this->view->error = $_SESSION['error'];
            unset($_SESSION['error']);

            # Autorrelleno del formulario
            $this->view->cliente = unserialize($_SESSION['cliente']);
            unset($_SESSION['cliente']);

            # Cargo los errores específicos
            $this->view->errores = $_SESSION['errores'];
            unset($_SESSION['errores']);

        }


        $this->view->title = "Formulario  editar cliente";
        $this->view->cliente = $this->model->getCliente($this->view->id);
        $this->view->render("clientes/editar/index");
    }
    }

    function update($param = []) {
        # inicio sesión
        sec_session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";
            header("location:". URL. "login"); 
        } else if((!in_array($_SESSION['id_rol'],$GLOBALS['crear']))) {
            $_SESSION['error'] = "Operacion sin privilegio";
            header("location:" .URL. "clientes");
        } else {

        #Saneamos formulario
        $nombre = filter_var($_POST['nombre'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $apellidos = filter_var($_POST['apellidos'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $telefono = filter_var($_POST['telefono'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $ciudad = filter_var($_POST['ciudad'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_var($_POST['email'] ??= '', FILTER_SANITIZE_EMAIL);
        $dni = filter_var($_POST['dni'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);

        $edit_cliente = new Cliente(
            null,
            $apellidos,
            $nombre,
            $telefono,
            $ciudad,
            $dni,
            $email,
            null,
            null
        );

        # cargar el id de cliente que voy a actualizar
        $id = $param[0];

        # obtengo el objeto cliente original
        $cliente = $this->model->getCliente($id);

        # 3. Validación de los datos
        
        $errores = [];

        // Validamos nombre
        // Valor obligatorio
        if (strcmp($cliente->nombre, $nombre) !== 0) {
            if(empty($nombre)) {
                $errores['nombre'] = 'Campo obligatorio';
            } 
        }  

        // Validamos apellidos
        // Valor obligatorio
        if (strcmp($cliente->apellidos, $apellidos) !== 0) {
            if(empty($apellidos)) {
                $errores['apellidos'] = 'Campo obligatorio';
            }
        }

        if (strcmp($cliente->telefono, $telefono) !== 0) {
            // Teléfono. No obligatorio, 9 dígitos numéricos
            $options = [
                'options' => [
                    'regexp' => '/[0-9]{9}$/'
                ]
            ];
            if (!empty($telefono)) {
                if (!filter_var($telefono, FILTER_VALIDATE_REGEXP, $options)) {
                    $errores["telefono"] = "Formato incorrecto.";
                }
            }
        }

        if (strcmp($cliente->ciudad, $ciudad) !== 0) {
            // Ciudad. Obligatorio, tamaño máximo de 20
            if (empty($ciudad)) {
                $errores["ciudad"] = "Campo obligatorio.";
            } else if (strlen($ciudad) > 20) {
                $errores["ciudad"] = "ciudad superior a 20 caracteres.";
            }
        }

        // Validamos email
        // Verificar obligatorio, email, único
        if (strcmp($cliente->email, $email) !== 0) {
            if(empty($email)) {
                $errores['email'] = 'Campo obligatorio';
            } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errores['email'] = 'Email incorrecto';
            } else if (!$this->model->validarEmail($email)) {
                $errores['email'] = 'Email registrado';
            }
        }

        // Validamos dni
        // Verificar obligatorio, formato dni, único
        if (strcmp($cliente->dni, $dni) !== 0) {
            $options = [
                'options' => [
                    'regexp' => '/^(\d{8})([A-Z])$/'
                ]
            ];
            if(empty($dni)) {
                $errores['dni'] = 'Campo obligatorio';
            } else if (!filter_var($dni, FILTER_VALIDATE_REGEXP, $options)) {
                $errores['dni'] = 'DNI con formato incorrecto';
            } else if (!$this->model->validarDNI($dni)) {
                $errores['dni'] = 'DNI ya ha sido registrado';
            }
        }

        #Comprobamos validacion
        if (!empty($errores)) {

            // Si $errores el formulario no ha sido validado
            $_SESSION['cliente'] = serialize($edit_cliente);
            $_SESSION['error'] = 'Formulario no ha sido validado';
            $_SESSION['errores'] = $errores;

            # Redireccionamos a nuevo alumno

            header('location:'. URL. 'clientes/editar/'.$id);
        } else {

            # actualizo la base de datos
            $this->model->update($param[0], $edit_cliente);

            # Crear mensaje
            $_SESSION['mensaje'] = 'Cliente actualizado correctamente';

            # redirecciono al main de alumnos
            header("Location:" . URL . "clientes");

        }
        
    }
    }

    function mostrar($param = []) {

        # inicio o continuo sesión
        sec_session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";
            header("location:". URL. "login"); 
        } else if((!in_array($_SESSION['id_rol'],$GLOBALS['mostrar']))) {
            $_SESSION['error'] = "Operacion sin privilegio";
            header("location:" .URL. "clientes");
        } else  {

        $id = $param[0];
        $this->view->title = "Formulario Cliente Mostar";
        $this->view->cliente = $this->model->getCliente($id);
        $this->view->render("clientes/mostrar/index");
    }
    }

    function ordenar($param = []) {

        # inicio o continuo sesión
        sec_session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";
            header("location:". URL. "login"); 
        } else if((!in_array($_SESSION['id_rol'],$GLOBALS['ordenar']))) {
            $_SESSION['error'] = "Operacion sin privilegio";
            header("location:" .URL. "clientes");
        } else  {

        $criterio = $param[0];
        $this->view->title = "Tabla Clientes";
        $this->view->clientes = $this->model->order($criterio);
        $this->view->render("clientes/main/index");
    }
    }

    function buscar($param = []) {

        # inicio o continuo sesión
        sec_session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";
            header("location:". URL. "login"); 
        } else if((!in_array($_SESSION['id_rol'],$GLOBALS['buscar']))) {
            $_SESSION['error'] = "Operacion sin privilegio";
            header("location:" .URL. "clientes");
        } else {

        $expresion = $_GET["expresion"];
        $this->view->title = "Tabla Clientes";
        $this->view->clientes = $this->model->filter($expresion);
        $this->view->render("clientes/main/index");
    }
    }

    function Pdf($param = []) {

        # inicio o continuo sesión
        sec_session_start();

         if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";
            
            header("location:". URL. "login");
            
        } else {

            $clientes=$this->model->get();
            
            $pdf=new pdfCliente('P', 'mm', 'A4');

            $pdf->AliasNbPages();
            $pdf->AddPage();
            $pdf->Titulo();
            $pdf->CabListadoArticulos();
        
            foreach ($clientes as $cliente){
                $pdf->Cell(10, 7, iconv('UTF-8', 'ISO-8859-1', $cliente->id), 'B', 0, 'R', true);
                $pdf->Cell(20, 7, iconv('UTF-8', 'ISO-8859-1', $cliente->nombre), 'B', 0, 'L', true);
                $pdf->Cell(30, 7, iconv('UTF-8', 'ISO-8859-1', $cliente->apellidos), 'B', 0, 'L', true);
                $pdf->Cell(20, 7, iconv('UTF-8', 'ISO-8859-1', $cliente->telefono), 'B', 0, 'L', true);
                $pdf->Cell(20, 7, iconv('UTF-8', 'ISO-8859-1', $cliente->ciudad), 'B', 0, 'L', true);
                $pdf->Cell(28, 7, iconv('UTF-8', 'ISO-8859-1', $cliente->dni), 'B', 0, 'L', true);
                $pdf->Cell(50, 7, iconv('UTF-8', 'ISO-8859-1', $cliente->email), 'B', 1, 'L', true);
            };
        
            ob_end_clean();
            $pdf->Output("I", "doc.pdf", true);
        }
    }
}