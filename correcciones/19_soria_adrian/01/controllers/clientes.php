<?php

    class Clientes extends Controller {

        function render(){

            // Inicio o continuo sesion
            sec_session_start();

            # compruebo usuario autentificado
            if (!isset($_SESSION['id'])) {
                $_SESSION['mensaje'] = "Usuario debe autentificarse";
                
                header("location:". URL. "login");
                
            } else {
                // Compruebo si existe mensaje
                if (isset($_SESSION['mensaje'])) {
                    $this->view->mensaje = $_SESSION['mensaje'];
                    unset($_SESSION['mensaje']);
                }

                //mostrara todos los clientes
                $this->view->title = "Tabla Clientes";
                $this->view->clientes = $this->model->get();
                $this->view->render('clientes/main/index');

                //en la carpeta views tengo que crear la carpeta clientes
                //dentro de la carpeta clientes creo main
                //en la main creo index.php que corresponde a la vista que muestra clientes
            }
            
            
        }

        public function nuevo(){

            // Inicio o continuo sesion
            sec_session_start();

            # compruebo usuario autentificado
            if (!isset($_SESSION['id'])) {
                $_SESSION['mensaje'] = "Usuario debe autentificarse";
                
                header("location:". URL. "login");
                
            } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['crear']))) {

                $_SESSION['mensaje'] = "Usuario sin privilegios";
                
                header("location:". URL. "clientes");

            } else {
                // Crear objeto vacio de la clase cliente
                $this->view->cliente = new Cliente();

                // Compruebo si existe algún error en la validación
                if (isset($_SESSION['error'])) {

                    // Mensaje de error
                    $this->view->error = $_SESSION['error'];
                    unset($_SESSION['error']);

                    // Autorrelleno del formulario
                    $this->view->cliente = unserialize($_SESSION['cliente']);
                    unset($_SESSION['cliente']);

                    // Cargo los errores especificos
                    $this->view->errores = $_SESSION['errores'];
                    unset($_SESSION['errores']);
                }


                //mostrara el formulario nuevo
                $this->view->title = "Formulario Nuevo Cliente";
                $this->view->render('clientes/nuevo/index');
            }
            
        }

        public function create(){
            //añadira un Cliente a la bd

            # Inicia sesion
            sec_session_start();

            # compruebo usuario autentificado
            if (!isset($_SESSION['id'])) {
                $_SESSION['mensaje'] = "Usuario debe autentificarse";
                
                header("location:". URL. "login");
                
            } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['crear']))) {

                $_SESSION['mensaje'] = "Usuario sin privilegios";
                
                header("location:". URL. "clientes");

            } else {
                    # VALIDACION FORMULARIOS
            //1.Saneamos datos del formulario
                $nombre = filter_var($_POST['nombre'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
                $apellidos = filter_var($_POST['apellidos'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
                $email = filter_var($_POST['email'] ??= '', FILTER_SANITIZE_EMAIL);
                $telefono = filter_var($_POST['telefono'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
                $ciudad = filter_var($_POST['ciudad'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
                $dni = filter_var($_POST['dni'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);

            // 2.Creamos el objeto cliente con los datos saneados
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

            // 3.Validación de los datos
                $errores = [];

                // Validamos el nombre
                // Valor obligatorio
                if (empty($nombre)){
                    $errores['nombre'] = 'Campo obligatorio';
                } else if (strlen($nombre) > 20) {
                    $errores['nombre'] = 'Nombre demasiado largo, máximo 20 caracteres';
                }


                // Validamos los apellidos
                // Valor obligatorio
                if (empty($apellidos)){
                    $errores['apellidos'] = 'Campo obligatorio';
                } else if (strlen($apellidos) > 45) {
                    $errores['apellidos'] = 'Apellidos demasiado largo, máximo 45 caracteres';
                }


                // Validamos el teléfono
                // Campo opcional
                if (strlen($telefono) > 9) {
                    $errores['telefono'] = 'Teléfono demasiado largo, máximo 9 caracteres';
                }
                

                // Validamos email
                // Verificar obligatorio, email, unico
                if (empty($email)){
                    $errores['email'] = 'Campo obligatorio';
                } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
                    $errores['email'] = 'Email incorrecto';
                } else if (!$this->model->validarEmail($email)){
                    $errores['email'] = 'Email en uso';
                }

                // Validamos ciudad
                // Valor obligatorio
                if (empty($ciudad)){
                    $errores['ciudad'] = 'Campo obligatorio';
                } else if (strlen($ciudad) > 20) {
                    $errores['ciudad'] = 'Ciudad demasiada larga, máximo 20 caracteres';
                }

                // Validamos dni
                // Verificar obligatorio, formato dni, unico
                $options = [
                    'options' => [
                        'regexp' => "/^(\d{8})([A-Z])$/"
                        ]
                ];

                if (empty($dni)){
                    $errores['dni'] = 'Campo obligatorio';
                } else if (!filter_var($dni, FILTER_VALIDATE_REGEXP, $options)){
                    $errores['dni'] = 'Dni con formato incorrecto';
                } else if (!$this->model->validarDni($dni)){
                    $errores['dni'] = 'Dni en uso';
                }

            // 4. Comprobar validación 

                // Si $errores no está vacio el formulario no ha sido validado
                if (!empty($errores)){

                    //print_r($errores);
                    //exit();

                    $_SESSION['cliente'] = Serialize($new_cliente);
                    $_SESSION['error'] = "Fallo en la validación del formulario";
                    $_SESSION['errores'] = $errores;

                    # Redireccionamos a nuevo alumno
                    header("location:" .URL. "clientes/nuevo");

                } else {

                    // Creamos alumno
                    $this->model->create($new_cliente);

                    // Creamos mensaje
                    $_SESSION['mensaje'] = "Cliente creado correctamente";

                    // Redireccionamos
                    header('location:'.URL.'clientes');
                }
            }

        
            
        }

        public function editar($param){
            //mostrara un formulario para editar

            // Iniciamos o continuamos sesión
            sec_session_start();

            # compruebo usuario autentificado
            if (!isset($_SESSION['id'])) {
                $_SESSION['mensaje'] = "Usuario debe autentificarse";
                
                header("location:". URL. "login");
                
            } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['editar']))) {

                $_SESSION['mensaje'] = "Usuario sin privilegios";
                
                header("location:". URL. "clientes");

            } else {
                // Obtengo el id del cliente
                $this->view->id = $param[0];
                

                // Obtengo el objeto de la clase cliente
                $this->view->cliente = $this->model->readCliente($this->view->id);

                // Compruebo si existe algún error en la validación
                if (isset($_SESSION['error'])) {

                    // Mensaje de error
                    $this->view->error = $_SESSION['error'];
                    unset($_SESSION['error']);

                    // Autorrelleno del formulario
                    $this->view->cliente = unserialize($_SESSION['cliente']);
                    unset($_SESSION['cliente']);

                    // Cargo los errores especificos
                    $this->view->errores = $_SESSION['errores'];
                    unset($_SESSION['errores']);
                }

                // Titulo de la página
                $this->view->title = "Formulario Editar Cliente";

                // Renderización al formulario editar
                $this->view->render('clientes/editar/index');
            } 
        }

        public function update($param){
            //actualizara el Cliente


            //Iniciamos o continuamos sesion
            sec_session_start();

            # compruebo usuario autentificado
            if (!isset($_SESSION['id'])) {
                $_SESSION['mensaje'] = "Usuario debe autentificarse";
                
                header("location:". URL. "login");
                
            } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['editar']))) {

                $_SESSION['mensaje'] = "Usuario sin privilegios";
                
                header("location:". URL. "clientes");

            } else {
                # VALIDACIÓN FORMULARIOS
                //1.Saneamos datos del formulario
                $nombre = filter_var($_POST['nombre'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
                $apellidos = filter_var($_POST['apellidos'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
                $email = filter_var($_POST['email'] ??= '', FILTER_SANITIZE_EMAIL);
                $telefono = filter_var($_POST['telefono'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
                $ciudad = filter_var($_POST['ciudad'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
                $dni = filter_var($_POST['dni'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);


                // 2.Creamos el objeto cliente con los datos saneados
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

                // Detalles del cliente que voy a actualizar
                $id = $param[0];

                // Obtengo el objeto de dicho cliente

                $cliente = $this->model->readCliente($id);

                // Validación editar cliente (Solo validará en caso de modificación de un detalle)
                $errores = [];
                
                // Validamos el nombre
                // Valor obligatorio
                if (strcmp($cliente->nombre, $nombre) !== 0) {
                    if (empty($nombre)){
                        $errores['nombre'] = 'Campo obligatorio';
                    } else if (strlen($nombre) > 20) {
                        $errores['nombre'] = 'Nombre demasiado largo, máximo 20 caracteres';
                    }
                }

                // Validamos los apellidos
                // Valor obligatorio
                if (strcmp($cliente->apellidos, $apellidos) !== 0) {
                    if (empty($apellidos)){
                        $errores['apellidos'] = 'Campo obligatorio';
                    } else if (strlen($apellidos) > 45) {
                        $errores['apellidos'] = 'Apellidos demasiado largo, máximo 45 caracteres';
                    }
                }

                // Validamos el teléfono
                // Campo opcional
                if ($cliente->telefono != $telefono)  {
                    if (strlen($telefono) > 9) {
                        $errores['telefono'] = 'Teléfono demasiado largo, máximo 9 caracteres';
                    }
                }

                // Validamos email
                // Verificar obligatorio, email, unico
                if (strcmp($cliente->email, $email) !== 0) {
                    if (empty($email)){
                        $errores['email'] = 'Campo obligatorio';
                    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
                        $errores['email'] = 'Email incorrecto';
                    } else if (!$this->model->validarEmail($email)){
                        $errores['email'] = 'Email en uso';
                    }
                }

                // Validamos ciudad
                // Valor obligatorio
                if (strcmp($cliente->ciudad, $ciudad) !== 0) {
                    if (empty($ciudad)){
                        $errores['ciudad'] = 'Campo obligatorio';
                    } else if (strlen($ciudad) > 20) {
                        $errores['ciudad'] = 'Ciudad demasiada larga, máximo 20 caracteres';
                    }
                }

                // Validamos dni
                // Verificar obligatorio, formato dni, unico
                if (strcmp($cliente->dni, $dni) !== 0) {
                    $options = [
                        'options' => [
                            'regexp' => "/^(\d{8})([A-Z])$/"
                            ]
                    ];
        
                    if (empty($dni)){
                        $errores['dni'] = 'Campo obligatorio';
                    } else if (!filter_var($dni, FILTER_VALIDATE_REGEXP, $options)){
                        $errores['dni'] = 'Dni con formato incorrecto';
                    } else if (!$this->model->validarDni($dni)){
                        $errores['dni'] = 'Dni en uso';
                    }
                }

                // 4. Comprobar validación 

                // Si $errores no está vacio el formulario no ha sido validado
                if (!empty($errores)){

                    //print_r($errores);
                    //exit();

                    $_SESSION['cliente'] = Serialize($edit_cliente);
                    $_SESSION['error'] = "Fallo en la validación del formulario";
                    $_SESSION['errores'] = $errores;

                    # Redireccionamos a editar cliente
                    header("location:" .URL. "clientes/editar/".$id);

                } else {

                    // Actualizamos cliente
                    $this->model->update($edit_cliente, $id);

                    // Creamos mensaje
                    $_SESSION['mensaje'] = "Cliente editado correctamente";

                    // Redireccionamos
                    header('location:'.URL.'clientes');
                }

            }

        

        }

        public function delete($param){

            # Inicia sesion
            sec_session_start();

            # compruebo usuario autentificado
            if (!isset($_SESSION['id'])) {
                $_SESSION['mensaje'] = "Usuario debe autentificarse";
                
                header("location:". URL. "login");
                
            } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['eliminar']))) {

                $_SESSION['mensaje'] = "Usuario sin privilegios";
                
                header("location:". URL. "clientes");

            } else {
                //eliminara el Cliente
                $this->model->delete($param[0]);

                header('location:'.URL.'clientes');
            }
            
            
        }

        public function mostrar($param){

            # Inicia sesion
            sec_session_start();

            # compruebo usuario autentificado
            if (!isset($_SESSION['id'])) {
                $_SESSION['mensaje'] = "Usuario debe autentificarse";
                
                header("location:". URL. "login");
                
            } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['mostrar']))) {

                $_SESSION['mensaje'] = "Usuario sin privilegios";
                
                header("location:". URL. "clientes");

            } else {
                //mostrara el Cliente
                $this->view->id = $param[0];
                $this->view->title = "Formulario Mostrar Cliente";
                $this->view->cliente = $this->model->readCliente($this->view->id);
                $this->view->render('clientes/mostrar/index');
            }
            
        }

        public function ordenar($param){

            # Inicia sesion
            sec_session_start();
            //ordenara los clientes

            # compruebo usuario autentificado
            if (!isset($_SESSION['id'])) {
                $_SESSION['mensaje'] = "Usuario debe autentificarse";
                
                header("location:". URL. "login");
                
            } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['ordenar']))) {

                $_SESSION['mensaje'] = "Usuario sin privilegios";
                
                header("location:". URL. "clientes");

            } else {
                $criterio = htmlspecialchars($param[0]);
                $this->view->title = "Ordenar Cliente por " . $criterio;
                $this->view->clientes = $this->model->order($criterio);
                $this->view->render('clientes/main/index');
            }
        
            
        }

        public function filtrar(){

            # Inicia sesion
            sec_session_start();

            # compruebo usuario autentificado
            if (!isset($_SESSION['id'])) {
                $_SESSION['mensaje'] = "Usuario debe autentificarse";
                
                header("location:". URL. "login");
                
            } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['buscar']))) {

                $_SESSION['mensaje'] = "Usuario sin privilegios";
                
                header("location:". URL. "clientes");

            } else {
                //filtrara los clientes
                $expresion = $_GET["expresion"];
                $this->view->title = "Filtrar Cliente por " .$expresion;
                $this->view->clientes = $this->model->filter($expresion);
                $this->view->render('clientes/main/index');
            }
            
        }

        public function pdf(){

            sec_session_start();

                
            if (!isset($_SESSION['id'])) {
                $_SESSION['mensaje'] = "Usuario debe autentificarse";
                
                header("location:". URL. "login");
                
            } else {
                // Compruebo si existe mensaje
                if (isset($_SESSION['mensaje'])) {
                    $this->view->mensaje = $_SESSION['mensaje'];
                    unset($_SESSION['mensaje']);
                }
                
                $clientes = $this->model->get();
        

                require('fpdf185/fpdf.php');
                require('class/pdfClientes.php');

                $pdf= new pdfClientes('P', 'mm', 'A4');

                $pdf->AliasNbPages();
                $pdf->AddPage();

                # Muestro el titulo del documento
                $pdf->Titulo();

                # Muestro el enncabezado de los clientes
                $pdf->Linea_clie();

                $fondo = false;
                $pdf->SetFillColor(200);

                foreach($clientes as $cliente){

                    $pdf->Cell(10, 7, iconv ("UTF-8","ISO-8859-1", $cliente->id), 'B', 0, 'R', $fondo);
                    $pdf->Cell(30, 7, iconv ("UTF-8","ISO-8859-1", $cliente->nombre), 'B', 0, 'L', $fondo);
                    $pdf->Cell(40, 7, iconv ("UTF-8","ISO-8859-1", $cliente->apellidos), 'B', 0, 'L', $fondo);
                    $pdf->Cell(50, 7, iconv ("UTF-8","ISO-8859-15", $cliente->email), 'B', 0, 'L', $fondo);
                    $pdf->Cell(30, 7, iconv ("UTF-8","ISO-8859-1", $cliente->telefono), 'B', 0, 'L', $fondo);
                    $pdf->Cell(30, 7, iconv ("UTF-8","ISO-8859-15", $cliente->dni), 'B', 1, 'L', $fondo);

                    $fondo = (!$fondo);
                };

                $pdf->Output("I", "clientes.pdf", true);
            } 
        }
    }

?>