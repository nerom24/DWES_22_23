<?php

    class Clientes Extends Controller {

        public function render(){
            // Inicio o continuo sesion
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

                // Mostrará todos los clientes
                $this->view->title="Tabla Clientes";
                $this->view->clientes=$this->model->get();
                $this->view->render('clientes/main/index');

                # En la carpeta views tengo que crear la carpeta clientes
                # Dentro de la carpeta clientes creo main
                # En main creo index.php que corresponde a la vista que muestra los clientes
            }
        }

        public function nuevo(){
            # Iniciamos o continuamos la sesion
            sec_session_start();

            if (!isset($_SESSION['id'])) {
                $_SESSION['mensaje'] = "Usuario debe autentificarse";
                
                header("location:". URL. "login");
                
            }else if((!in_array($_SESSION['id_rol'], $GLOBALS['crear']))){

                $_SESSION['mensaje'] = "Operación sin privilegios";
                
                header("location:". URL. "clientes");
            
            } else {

                # Crear objeto vacío de la clase alumno
                $this->view->cliente = new Cliente();

                # Compruebo si existe algún error en la validación
                if(isset($_SESSION['error'])){

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

                # título de la vista
                $this->view->title= "Formulario Nuevo Cliente";
            
                # carga la vista nuevo formulario
                $this->view->render('clientes/nuevo/index');
            }
        }

        public function create(){

            # Inicia sesion
            sec_session_start();

            if (!isset($_SESSION['id'])) {
                $_SESSION['mensaje'] = "Usuario debe autentificarse";
                
                header("location:". URL. "login");
                
            }else if((!in_array($_SESSION['id_rol'], $GLOBALS['crear']))){

                $_SESSION['mensaje'] = "Operación sin privilegios";
                
                header("location:". URL. "clientes");
            
            }  else {

                # VALIDACION FORMULARIOS
                //1.Saneamos datos del formulario
                $apellidos = filter_var($_POST['apellidos'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
                $nombre = filter_var($_POST['nombre'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
                $telefono = filter_var($_POST['telefono'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
                $ciudad = filter_var($_POST['ciudad'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
                $dni = filter_var($_POST['dni'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
                $email = filter_var($_POST['email'] ??= '', FILTER_SANITIZE_EMAIL);
                


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
                if(empty($nombre)){
                    $errores ['nombre'] = 'Campo obligatorio';
                } else if(strlen($nombre) > 20){
                    $errores['nombre'] = 'Nombre demasiado largo, máximo 20 carácteres';
                }

                
                // Validamos los apellidos
                // Valor obligatorio
                if(empty($apellidos)){
                    $errores ['apellidos'] = 'Campo obligatorio';
                } else if(strlen($apellidos) > 45){
                    $errores['apellidos'] = 'Apellidos demasiado largo, máximo 45 carácteres';
                }

                // Validamos la ciudad
                // Valor obligatorio
                if(empty($ciudad)){
                    $errores ['ciudad'] = 'Campo obligatorio';
                } else if(strlen($ciudad) > 20){
                    $errores['ciudad'] = 'Ciudad demasiado largo, máximo 20 carácteres';
                }

                
                // Validamos el telefono
                // Valor opcional

                // Validamos email
                // Verificar obligatorio, email, unico
                if (empty($email)){
                    $errores['email'] = 'Campo obligatorio';
                } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
                    $errores['email'] = 'Email incorrecto';
                } else if (!$this->model->validarEmail($email)){
                    $errores['email'] = 'Email en uso';
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


                    $_SESSION['cliente'] = Serialize($new_cliente);
                    $_SESSION['error'] = "Fallo en la validación del formulario";
                    $_SESSION['errores'] = $errores;

                    # Redireccionamos a nuevo alumno
                    header("location:" .URL. "clientes/nuevo");

                } else {

                    // Creamos cliente
                    $this->model->create($new_cliente);

                    // Creamos mensaje
                    $_SESSION['mensaje'] = "Cliente creado correctamente";

                    // Redireccionamos
                    header('location:'.URL.'clientes');
                }
            }
        }

        public function editar($param){
            # Iniciamos o continuamos sesion
            sec_session_start();

            if (!isset($_SESSION['id'])) {
                $_SESSION['mensaje'] = "Usuario debe autentificarse";
                
                header("location:". URL. "login");
                
            }else if((!in_array($_SESSION['id_rol'], $GLOBALS['editar']))){

                $_SESSION['mensaje'] = "Operación sin privilegios";
                
                header("location:". URL. "clientes");
            
            }  else {
                # obtengo el id del cliente
                $this->view->id = $param[0];

                # obtengo el objeto de la clase cliente
                $this->view->cliente = $this->model->readCliente($this->view->id);

                # Comprobar si el formulario viene de una no validación
                if(isset($_SESSION['error'])){

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

                # título de la vista
                $this->view->title= "Formulario Edición cliente";

                # obtener los cursos generar dinamicamente combox de cursos
                $this->view->cliente = $this->model->readcliente($this->view->id);

                $this->view->render('clientes/editar/index');
            }
        }

        public function update($param){

            # Iniciamos o continuo sesióno 
            sec_session_start();

            if (!isset($_SESSION['id'])) {
                $_SESSION['mensaje'] = "Usuario debe autentificarse";
                
                header("location:". URL. "login");
                
            }else if((!in_array($_SESSION['id_rol'], $GLOBALS['editar']))){

                $_SESSION['mensaje'] = "Operación sin privilegios";
                
                header("location:". URL. "clientes");
            
            }  else {

                # Saneamos el formulario
                $apellidos = filter_var($_POST['apellidos'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
                $nombre = filter_var($_POST['nombre'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
                $telefono = filter_var($_POST['telefono'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
                $ciudad = filter_var($_POST['ciudad'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
                $dni = filter_var($_POST['dni'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
                $email = filter_var($_POST['email'] ??= '', FILTER_SANITIZE_EMAIL);

                # Creamos el objeto Cuenta con los detalles del formulario saneados
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

                # Detalles de la cliente que voy a actualizar
                $id = $param[0];

                # Obtengo el objeto de dicha cliente
                $cliente = $this->model->readCliente($id);

                # Validacion editar cliente
                # Solo validará en caso de modificación de un detalle
                $errores=[];

                // Validar nombre: obligatorio
                if(strcmp($cliente->nombre, $nombre) !== 0){
                    if(empty($nombre)){
                        $errores ['nombre'] = 'Campo obligatorio';
                    } else if(strlen($nombre) > 20){
                        $errores['nombre'] = 'Nombre demasiado largo, máximo 20 carácteres';
                    }
                }

                // Validar apellidos: obligatorio
                if(strcmp($cliente->apellidos, $apellidos) !== 0){
                    if(empty($apellidos)){
                        $errores ['apellidos'] = 'Campo obligatorio';
                    } else if(strlen($apellidos) > 45){
                        $errores['apellidos'] = 'Apellidos demasiado largo, máximo 45 carácteres';
                    }
                }

                // Validar ciudad: obligatorio
                if(strcmp($cliente->ciudad, $ciudad) !== 0){
                    if(empty($ciudad)){
                        $errores ['ciudad'] = 'Campo obligatorio';
                    } else if(strlen($ciudad) > 20){
                        $errores['ciudad'] = 'Ciudad demasiado largo, máximo 20 carácteres';
                    }
                }

                // Validar email: obligatorio
                if(strcmp($cliente->email, $email) !== 0){
                    if (empty($email)){
                        $errores['email'] = 'Campo obligatorio';
                    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
                        $errores['email'] = 'Email incorrecto';
                    } else if (!$this->model->validarEmail($email)){
                        $errores['email'] = 'Email en uso';
                    }
                }

                // Validar dni: obligatorio
                if($cliente->dni != $dni){
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

                # Comprobamos validación
                if(!empty($errores)){
                    $_SESSION['cliente'] = Serialize($edit_cliente);
                    $_SESSION['error'] = "Fallo en la validación del formulario";
                    $_SESSION['errores'] = $errores;

                    # Redireccionamos a nuevo alumno
                    header("location:" .URL. "clientes/editar/".$id);
                } else{
                    // Actualizamos cuetna
                    $this->model->update($edit_cliente, $id);

                    // Creamos mensaje
                    $_SESSION['mensaje'] = "Cliente actualizado correctamente";

                    // Redireccionamos
                    header('location:'.URL.'clientes');
                }
            }
        }
        
        public function mostrar($param){
            # Iniciamos o continuamos sesión
            sec_session_start();

            if (!isset($_SESSION['id'])) {
                $_SESSION['mensaje'] = "Usuario debe autentificarse";
                
                header("location:". URL. "login");
                
            } else {
                # obtengo el id del cliente
                $this->view->id = $param[0];

                # título de la vista
                $this->view->title= "Formulario Mostrar cliente";

                # obtener los cursos generar dinamicamente combox de cursos
                $this->view->cliente = $this->model->readcliente($this->view->id);

                $this->view->render('clientes/mostrar/index');
            }
        }

        public function delete($param){
            # Iniciamos o continuamos sesión
            sec_session_start();

            if (!isset($_SESSION['id'])) {
                $_SESSION['mensaje'] = "Usuario debe autentificarse";
                
                header("location:". URL. "login");
                
            }else if((!in_array($_SESSION['id_rol'], $GLOBALS['eliminar']))){

                $_SESSION['mensaje'] = "Operación sin privilegios";
                
                header("location:". URL. "clientes");
            
            }  else {
                # obtengo el id del cliente
                $this->model->delete($param[0]);
                header('location:'.URL.'clientes');
            }
        }

        public function order($param){
            # Iniciamos o continuamos sesión
            sec_session_start();

            if (!isset($_SESSION['id'])) {
                $_SESSION['mensaje'] = "Usuario debe autentificarse";
                
                header("location:". URL. "login");
                
            } else {
            
                $criterio = htmlspecialchars($param[0]);
                
                $this->view->clientes = $this->model->order($criterio);
                $this->view->title="Ordenar clientes por " . $criterio;

                $this->view->render('clientes/main/index');
            }
        }

        public function filter(){
            # Iniciamos o continuamos sesión
            sec_session_start();

            if (!isset($_SESSION['id'])) {
                $_SESSION['mensaje'] = "Usuario debe autentificarse";
                    
                header("location:". URL. "login");
                
            } else {
                $expresion = $_GET['expresion'];
                
                $this->view->clientes = $this->model->filter($expresion);
                $this->view->title="Buscar clientes por " . $expresion;

                $this->view->render('clientes/main/index');
            }
        }

        public function pdf() {

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
                $pdf->Titulo();

                # Muestro el enncabezado de los articulos
                $pdf->encabezado();

                foreach($clientes as $cliente){
                    $pdf->Cell(10, 7, iconv ("UTF-8","ISO-8859-1", $cliente->id), 'B', 0, 'R');
                    $pdf->Cell(40, 7, iconv ("UTF-8","ISO-8859-1", $cliente->apellidos), 'B', 0, 'L');
                    $pdf->Cell(35, 7, iconv ("UTF-8","ISO-8859-1", $cliente->nombre), 'B', 0, 'L');
                    $pdf->Cell(55, 7, iconv ("UTF-8","ISO-8859-1", $cliente->email), 'B', 0, 'L');
                    $pdf->Cell(20, 7, iconv ("UTF-8","ISO-8859-1", $cliente->telefono), 'B', 0, 'R');
                    $pdf->Cell(30, 7, iconv ("UTF-8","ISO-8859-1", $cliente->dni), 'B', 1, 'R');
                    
                };
                ob_end_clean();
                $pdf->Output("I", "clientes.pdf", true);
            }

        }
    }
 
?>