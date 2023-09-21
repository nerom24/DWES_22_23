<?php 

    class Login extends Controller{
        
        public function render(){

            //Iniciamos o continuamos sesion
            sec_session_start();

            //Titulo Página
            $this->view->title = "Login - Albumes";

            //Inicializamos valores del formulario
            $this->view->email = null;

            $this->view->password = null;

            //Control de mensajes
            if(isset($_SESSION['mensaje'])){

                $this->view->mensaje = $_SESSION['mensaje'];
                unset($_SESSION['mensaje']);


                //Autorrelleno despues de un registro con exito
                if(isset($_SESSION['email'])){

                    $this->view->email = $_SESSION['email'];
                    unset($_SESSION['email']);
                    
                }

                if(isset($_SESSION['password'])){

                    $this->view->password = $_SESSION['password'];
                    unset($_SESSION['password']);
                    
                }

            }

            //Control de errores
            if (isset($_SESSION['error'])){

                //Mensaje de error
                $this->view->error = $_SESSION['error'];
                unset($_SESSION['error']);

                //Autocompleto los valores del formulario
                $this->view->email = $_SESSION['email'];
                $this->view->password = $_SESSION['password'];
                unset($_SESSION['password']);
                unset($_SESSION['email']);

                //Tipo de error 
                $this->view->erroresVal = $_SESSION['erroresVal'];
                unset($_SESSION['erroresVal']);

            }

            $this->view->render('auth/login/index');

        }

        public function validate(){

            //Iniciamos o continuamos sesion
            sec_session_start();

            //Saneamos el formulario
            $email = filter_var($_POST['email']  ??= null, FILTER_SANITIZE_EMAIL);
            $password = filter_var($_POST['password'] ??= null, FILTER_SANITIZE_STRING);

            //Validación
            $erroresVal = [];

            //Obtengo el usuario a partir del email

            $user = $this->model->getUserEmail($email);

            if ($user === false){

                $erroresVal['email']  = 'Email no ha sido registrado';
                $_SESSION['erroresVal'] = $erroresVal;

                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;

                $_SESSION['error'] = "Fallo en la Autentificación";

                header("location:" . URL . "login");

                exit;

            }else if(!password_verify($password, $user->password)){

                $erroresVal['password']  = 'Password no es correcto';
                $_SESSION['erroresVal'] = $erroresVal;

                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;

                $_SESSION['error'] = "Fallo en la Autentificación";

                header("location:" . URL . "login");

                exit;

            }else{

                //Autentificación completa
                $_SESSION['id'] = $user->id;
                $_SESSION['name_user'] = $user->name;
                $_SESSION['id_rol'] = $this->model->getUserIdPerfil($user->id);
                $_SESSION['name_rol'] = $this->model->getUserPerfil($_SESSION['id_rol']);
                //var_dump($user);
                //var_dump($_SESSION['id_rol']);
                //exit();
                $_SESSION['mensaje'] = "Usuario " . $user->name ." ha iniciado sesión";

                header("location:" . URL . "albumes");

                exit;
            }

        }

    }


?>