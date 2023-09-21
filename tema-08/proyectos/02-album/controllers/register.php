<?php 

    class Register extends Controller {

        public function render(){

            //Iniciamos o continiuamos sessión
            sec_session_start();

            //Titulo Página
            $this->view->title = "Registrar Nuevo Usuario - Albumes";

            //Si exite algun mensaje
            if (isset($_SESSION['mensaje'])){
                $this->view->mensaje = $_SESSION['mensaje'];
                unset($_SESSION['mensaje']);
            }

            //Inicializamos los campos del formulario
            $this->view->user = new User();

            if (isset($_SESSION['error'])){

                //Mensaje de error
                $this->view->error = $_SESSION['error'];
                unset($_SESSION['error']);

                //Variables de autorelleno
                $this->view->user = unserialize($_SESSION['user']);
                unset($_SESSION['user']);

                //Tipo de error 
                $this->view->erroresVal = $_SESSION['erroresVal'];
                unset($_SESSION['erroresVal']);

            }

            $this->view->render('auth/register/index');

        }

        public function validate(){

            //Iniciamos o continiuamos sessión
            sec_session_start();

            $user = new User();

            $user->name = filter_var($_POST['name'] ??= null, FILTER_SANITIZE_STRING);
            $user->email = filter_var($_POST['email']  ??= null, FILTER_SANITIZE_EMAIL);
            $user->password = filter_var($_POST['password'] ??= null, FILTER_SANITIZE_STRING);
            $user->password_confirm = filter_var($_POST['password_confirm'] ??= null, FILTER_SANITIZE_STRING);

            
            //Validación
            $erroresVal = [];

            //Aplicaremos las reglas de validación

            //Validar nombre
            if(empty($user->name)){
                $erroresVal['name'] = "Nombre no puede estar vacio";
            }else if (strlen($user->name) < 5 || (strlen($user->name) > 50)){
                $erroresVal['name'] = "Nombre no puede superar mas de 20 caracteres";
            }else if(!$this->model->validarName($user->name)){
                $erroresVal['name'] = "Nombre de usuario ya ha sido registrado";
            }

            //Validar Email
            if(empty($user->email)){
                $erroresVal['email'] = "Email no puede estar vacio";
            }else if(!filter_var($user->email, FILTER_VALIDATE_EMAIL)){
                $erroresVal['email'] = "Email no válido";
            }else if(!$this->model->validarEmail($user->email)){
                $erroresVal['email'] = "Email ya ha sido registrado";
            }
            
            //Validar password
            if(empty($user->password)){
                $erroresVal['password'] = "Password no introducido";
            }else if (strlen($user->password) < 5 || (strlen($user->password) > 60)){
                $erroresVal['password'] = "Password ha de tener entre 5 y 60 Caracteres";
            }else if(strcmp($user->password, $user->password_confirm) !== 0 ){
                $erroresVal['password'] = "La contraseña no coinciden";
            }

            if(!empty($erroresVal)){

                //Formulario no validado
                $_SESSION['user'] = Serialize($user);
                $_SESSION['error'] = "Fallo en la validación del formulario";
                $_SESSION['erroresVal'] = $erroresVal;
                //print_r($erroresVal);
                //exit;

                //Redireccionamos a nuevo usuario
                header('Location: ' . URL . 'register');
                exit();

            }else{

                //Añade el usuario
                $this->model->registrar($user);

                //Autorrelleno del login
                $_SESSION['mensaje'] = "Usuario registrado correctamente";
                $_SESSION['email'] = $user->email;
                $_SESSION['password'] = $user->password;

                //Vuelve al login
                header('Location: ' . URL . "login" );
                exit();

            }
        }

    }




?>