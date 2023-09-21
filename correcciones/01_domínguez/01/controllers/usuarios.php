<?php

    class Usuarios extends Controller {

        function render(){

            // Inicio o continuo sesion
            sec_session_start();

            // compruebo usuario autentificado
            if (!isset($_SESSION['id'])) {
                $_SESSION['mensaje'] = "Usuario debe autentificarse";
                header("location:". URL. "login");
                
            }  else if ((!in_array($_SESSION['id_rol'], $GLOBALS['admin']))) {

                $_SESSION['mensaje'] = "Usuario sin privilegios";
                header("location:". URL. "clientes");

            } else {
                // Compruebo si existe mensaje
                if (isset($_SESSION['mensaje'])) {
                    $this->view->mensaje = $_SESSION['mensaje'];
                    unset($_SESSION['mensaje']);
                }

                //mostrara todos los usuarios
                $this->view->title = "Tabla Usuarios";
                $this->view->usuarios = $this->model->get();
                $this->view->render('usuarios/main/index');
            }
        }

        public function nuevo(){

            // Inicio o continuo sesion
            sec_session_start();

            // compruebo usuario autentificado
            if (!isset($_SESSION['id'])) {
                $_SESSION['mensaje'] = "Usuario debe autentificarse";
                header("location:". URL. "login");
                
            } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['admin']))) {

                $_SESSION['mensaje'] = "Usuario sin privilegios";
                header("location:". URL. "clientes");

            } else {
                // Crear objeto vacio de la clase usuario
                //$this->view->usuario = new User();

                # Inicializamos los campos del formulario
                $this->view->name = null;
                $this->view->email = null;
                $this->view->pass = null;
                $this->view->rol = null;

                // Compruebo si existe algún error en la validación
                if (isset($_SESSION['error'])) {

                    // Mensaje de error
                    $this->view->error = $_SESSION['error'];
                    unset($_SESSION['error']);

                    //Autorrelleno formulario
                    $this->view->name = $_SESSION['name'];
                    $this->view->email = $_SESSION['email'];
                    $this->view->pass = $_SESSION['pass'];
                    $this->view->rol = $_SESSION['rol'];
                    unset($_SESSION['name']);
                    unset($_SESSION['email']);
                    unset($_SESSION['pass']);
                    unset($_SESSION['rol']);

                    // Cargo los errores especificos
                    $this->view->errores = $_SESSION['errores'];
                    unset($_SESSION['errores']);
                }
                //mostrara el formulario nuevo
                $this->view->title = "Formulario Nuevo Usuario";
                $this->view->roles = $this->model->getRol();
                $this->view->render('usuarios/nuevo/index');
            }
        }

        public function create() {

            // Iniciamos o continuamos con la sesión
            sec_session_start();

             // compruebo usuario autentificado
             if (!isset($_SESSION['id'])) {
                $_SESSION['mensaje'] = "Usuario debe autentificarse";
                header("location:". URL. "login");
                
            } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['admin']))) {

                $_SESSION['mensaje'] = "Usuario sin privilegios";
                header("location:". URL. "clientes");

            } else {

                // Saneamos el formulario
                $name = filter_var($_POST['nombre'],FILTER_SANITIZE_SPECIAL_CHARS);
                $email = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
                $rol = filter_var($_POST['id'],FILTER_SANITIZE_NUMBER_INT);
                $password = filter_var($_POST['password'],FILTER_SANITIZE_SPECIAL_CHARS);
                $password_confirm = filter_var($_POST['password_confirm'],FILTER_SANITIZE_SPECIAL_CHARS);
        
                // Validaciones
        
                $errores = array();
        
                // Validar name
                if (empty($name)) {
                    $errores['name'] = "Nombre es campo obligatorio";
                } elseif (!$this->model->validarName($name)) {
                    $errores['name'] = "Nombre de usuario no permitido";
                }

                // Validar rol
                if (empty($rol)) {
                    $errores['rol'] = "Rol es campo obligatorio";
                } elseif (!$this->model->validarRol($rol)) {
                    $errores['rol'] = "Rol de usuario no permitido";
                }
        
                // Validar Email
                if (empty($email)) {
                    $errores['email'] = "Email es campo obligatorio";
                } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $errores['email'] = "Email no válido";
                } elseif (!$this->model->validaEmailUnique($email)) {
                    $errores['email'] = "Email ya ha sido registrado";
                }
        
                // Validar password
                if (empty($password) || empty($password_confirm)) {
                    $errores['password'] = "Password y confirmación son campos obligarios";
                } elseif (strcmp($password, $password_confirm) !== 0) {
                        $errores['password'] = "Password no coincidentes";
                } elseif (!$this->model->validarPass($password)) {
                        $errores['password'] = "Password: No permitido";
                }
        
                if (!empty($errores)) {
        
                    $_SESSION['errores'] = $errores;
                    $_SESSION['name'] = $name;
                    $_SESSION['email'] = $email;
                    $_SESSION['pass'] = $password;
                    $_SESSION['rol'] = $rol;
                    $_SESSION['error'] = "Fallo en la validación del formulario";
                    
                    header("location:". URL. "usuarios/nuevo");
        
                } else {
                    
                    // Añade nuevo usuario
                    $this->model->create($name, $email, $password , $rol);
                    $_SESSION['mensaje'] = "Usuario registrado correctamente";
                    
                    //Vuelve a usuarios
                    header("location:". URL. "usuarios");
                }
            }
        }

        public function editar($param){
            //mostrara un formulario para editar

            // Iniciamos o continuamos sesión
            sec_session_start();

            // compruebo usuario autentificado
            if (!isset($_SESSION['id'])) {
                $_SESSION['mensaje'] = "Usuario debe autentificarse";
                header("location:". URL. "login");
                
            } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['admin']))) {

                $_SESSION['mensaje'] = "Usuario sin privilegios";
                header("location:". URL. "clientes");

            } else {
                // Obtengo el id del usuario
                $this->view->id = $param[0];
                

                // Obtengo el objeto de la clase usuario
                $this->view->usuario = $this->model->readuser($this->view->id);

                // Compruebo si existe algún error en la validación
                if (isset($_SESSION['error'])) {

                    // Mensaje de error
                    $this->view->error = $_SESSION['error'];
                    unset($_SESSION['error']);

                    // Autorrelleno del formulario
                    $this->view->name = $_SESSION['name'];
                    $this->view->email = $_SESSION['email'];
                    $this->view->password = $_SESSION['password'];
                    $this->view->rol = $_SESSION['rol'];
                    unset($_SESSION['name']);
                    unset($_SESSION['email']);
                    unset($_SESSION['password']);
                    unset($_SESSION['rol']);

                    // Cargo los errores especificos
                    $this->view->errores = $_SESSION['errores'];
                    unset($_SESSION['errores']);
                }

                // Titulo de la página
                $this->view->title = "Formulario Editar Usuario";
                $this->view->roles = $this->model->getRol();
                // Renderización al formulario editar
                $this->view->render('usuarios/editar/index');
                
            } 
        }

        public function update($param){
            //actualizara el usuario


            //Iniciamos o continuamos sesion
            sec_session_start();

            // compruebo usuario autentificado
            if (!isset($_SESSION['id'])) {
                $_SESSION['mensaje'] = "Usuario debe autentificarse";
                header("location:". URL. "login");
                
            } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['admin']))) {

                $_SESSION['mensaje'] = "Usuario sin privilegios";
                header("location:". URL. "clientes");

            } else {
                // Detalles del usuario que voy a actualizar
                $id = $param[0];
                // Obtengo el objeto de la clase usuario
                $usuario = $this->model->readuser($id);

                // VALIDACIÓN FORMULARIOS
                // Saneamos el formulario
                $name = filter_var($_POST['nombre'],FILTER_SANITIZE_SPECIAL_CHARS);
                $email = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
                $rol = filter_var($_POST['id'],FILTER_SANITIZE_NUMBER_INT);
                $password = filter_var($_POST['password'],FILTER_SANITIZE_SPECIAL_CHARS);
                $password_confirm = filter_var($_POST['password_confirm'],FILTER_SANITIZE_SPECIAL_CHARS);

  
                // Validaciones
                $errores = array();
        
                // Validar name
                if (strcmp($usuario->name, $name) !== 0) {
                    if (empty($name)) {
                        $errores['name'] = "Nombre es campo obligatorio";
                    } else if (!$this->model->validarName($name)) {
                        $errores['name'] = "Nombre de usuario no permitido";
                    }
                }

                // Validar rol
                if ($usuario->idrol != $rol) {
                    if (empty($rol)) {
                        $errores['rol'] = "Rol es campo obligatorio";
                    } else if (!$this->model->validarRol($rol)) {
                        $errores['rol'] = "Rol de usuario no permitido";
                    }
                }
        
                // Validar Email
                if (strcmp($usuario->email, $email) !== 0) {
                    if (empty($email)) {
                        $errores['email'] = "Email es campo obligatorio";
                    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $errores['email'] = "Email no válido";
                    } else if (!$this->model->validaEmailUnique($email)) {
                        $errores['email'] = "Email ya ha sido registrado";
                    }
                }
        
                // Validar password
                if (strcmp($password, $password_confirm) !== 0) {
                        $errores['password'] = "Password no coincidentes";
                } else if (strlen($password) != 0) {
                    if (!$this->model->validarPass($password)) {
                        $errores['password'] = "Password: No permitido";
                    }
                }
                    
        

                // 4. Comprobar validación 

                // Si $errores no está vacio el formulario no ha sido validado
                if (!empty($errores)){

                    $_SESSION['name'] = $name;
                    $_SESSION['email'] = $email;
                    $_SESSION['password'] = $password;
                    $_SESSION['rol'] = $rol;
                    $_SESSION['error'] = "Fallo en la validación del formulario";
                    $_SESSION['errores'] = $errores;

                    // Redireccionamos a editar usuario
                    header("location:" .URL. "usuarios/editar/".$id);

                } else {

                    // Actualizamos usuario
                    $this->model->update($name, $email, $password, $rol, $id);

                    // Creamos mensaje
                    $_SESSION['mensaje'] = "Usuario editado correctamente";

                    // Redireccionamos
                    header('location:'.URL.'usuarios');
                }
            }
        }

        public function delete($param){

            // Inicia sesion
            sec_session_start();

            // compruebo usuario autentificado
            if (!isset($_SESSION['id'])) {
                $_SESSION['mensaje'] = "Usuario debe autentificarse";
                header("location:". URL. "login");
                
            } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['admin']))) {

                $_SESSION['mensaje'] = "Usuario sin privilegios";
                header("location:". URL. "clientes");

            } else {
                //eliminara el usuario
                $this->model->delete($param[0]);
                header('location:'.URL.'usuarios');
            }
        }

        public function mostrar($param){

            // Inicia sesion
            sec_session_start();

            // compruebo usuario autentificado
            if (!isset($_SESSION['id'])) {
                $_SESSION['mensaje'] = "Usuario debe autentificarse";
                header("location:". URL. "login");
                
            } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['admin']))) {

                $_SESSION['mensaje'] = "Usuario sin privilegios";
                header("location:". URL. "clientes");

            } else {

                // id del usuario
                $this->view->id = $param[0];
                // titulo del formulario
                $this->view->title = "Formulario Mostrar Usuario";
                // Obtengo el objeto de la clase usuario
                $this->view->usuario = $this->model->readuser($this->view->id);
                //obtengo los roles
                $this->view->roles = $this->model->getRol();
                $this->view->render('usuarios/mostrar/index');
            }
        }

        public function ordenar($param){

            // Inicia sesion
            sec_session_start();

            // compruebo usuario autentificado
            if (!isset($_SESSION['id'])) {
                $_SESSION['mensaje'] = "Usuario debe autentificarse";
                header("location:". URL. "login");
            } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['admin']))) {
                $_SESSION['mensaje'] = "Usuario sin privilegios";
                header("location:". URL. "clientes");
            } else {
                $criterio = htmlspecialchars($param[0]);
                $this->view->title = "Ordenar Usuario por " . $criterio;
                $this->view->usuarios = $this->model->order($criterio);
                $this->view->render('usuarios/main/index');
            }
        }

        public function filtrar(){

            // Inicia sesion
            sec_session_start();

            // compruebo usuario autentificado
            if (!isset($_SESSION['id'])) {
                $_SESSION['mensaje'] = "Usuario debe autentificarse";
                header("location:". URL. "login");
            } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['admin']))) {
                $_SESSION['mensaje'] = "Usuario sin privilegios";
                header("location:". URL. "clientes");
            } else {
                //filtrara los usuarios
                $expresion = $_GET["expresion"];
                $this->view->title = "Filtrar usuario por " .$expresion;
                $this->view->usuarios = $this->model->filter($expresion);
                $this->view->render('usuarios/main/index');
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
                $usuarios = $this->model->get();

                require('fpdf185/fpdf.php');
                require('class/pdfUsuarios.php');

                $pdf= new pdfUsuarios('P', 'mm', 'A4');

                $pdf->AliasNbPages();
                $pdf->AddPage();

                $pdf->Titulo();
                # Muestro el enncabezado de los articulos
                $pdf->encabezado();

                foreach($usuarios as $usuario){
                    $pdf->Cell(10, 7, iconv ("UTF-8","ISO-8859-1", $usuario->id), 'B', 0, 'R');
                    $pdf->Cell(60, 7, iconv ("UTF-8","ISO-8859-1", $usuario->name), 'B', 0, 'L');
                    $pdf->Cell(60, 7, iconv ("UTF-8","ISO-8859-1", $usuario->email), 'B', 0, 'L');
                    $pdf->Cell(60, 7, iconv ("UTF-8","ISO-8859-1", $usuario->rol), 'B', 1, 'L');
                };
                ob_end_clean();
                $pdf->Output("I", "usuarios.pdf", true);
            }

        }
    }
?>