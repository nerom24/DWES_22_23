<?php 

    class Auth extends Controller{

        public function render(){

            
        }

        public function logout(){

            //Continuamos la sesion y la destruimos
            sec_session_start();
            sec_session_destroy();

            header('Location: ' . URL . 'login');

        }

        public function edit(){

            //Continuamos la sesion y la destruimos
            sec_session_start();

            
            // Capa autentificación
            if(!isset($_SESSION['id'])){

                header("location:" . URL . "login");
                exit;
            }

            //Titulo de la página
            $this->view->title = "Modificar perfil usuario - Albumes";


            //Comprobamos si existe algún mensaje
            if (isset($_SESSION['mensaje'])){

                $this->view->mensaje = $_SESSION['mensaje'];

                unset($_SESSION['mensaje']);


            }

            //Obtenemos objeto con los detalles del usuario
            $this->view->user = $this->model->getUserId($_SESSION['id']);

            //Si existe algún error
            if (isset($_SESSION['error'])){

                //Mensaje de error
                $this->view->error = $_SESSION['error'];
                unset($_SESSION['error']);

                //Varialbes de autorelloeno formulario
                $this->view->user = unserialize($_SESSION['user']);
                unset($_SESSION['user']);

                //Tipo de error
                $this->view->erroresVal = $_SESSION['erroresVal'];
                unset($_SESSION['erroresVal']);


            }

            $this->view->render('auth/edit/index');

        }

        public function validate(){

            //Iniciamos o continiuamos sessión
            sec_session_start();

            // Capa autentificación
            if(!isset($_SESSION['id'])){

                header("location:" . URL . "login");

                exit;

            }

            $name = filter_var($_POST['name'] ??= null, FILTER_SANITIZE_STRING);
            $email = filter_var($_POST['email']  ??= null, FILTER_SANITIZE_EMAIL);

            //Obtenemos objeto con los detalles del usuario
            $user = $this->model->getUserId($_SESSION['id']);
            
            //Validación
            $erroresVal = [];

            //Aplicaremos las reglas de validación

            //Validar name solo si se ha modificado
            if (strcmp($user->name, $name) !== 0){
                if(empty($user->name)){
                    $erroresVal['name'] = "Nombre no puede estar vacio";
                }else if (strlen($user->name) < 5 || (strlen($user->name) > 50)){
                    $erroresVal['name'] = "Nombre no puede superar mas de 20 caracteres";
                }else if(!$this->model->validarName($name)){
                    $erroresVal['name'] = "Nombre de usuario ya ha sido registrado";
                }
            }
            //Validar name solo si se ha modificado
            if (strcmp($user->email, $email) !== 0){
                if(empty($user->email)){
                    $erroresVal['email'] = "Email no puede estar vacio";
                }else if(!filter_var($user->email, FILTER_VALIDATE_EMAIL)){
                    $erroresVal['email'] = "Email no válido";
                }else if(!$this->model->validarEmail($email)){
                    $erroresVal['email'] = "Email ya ha sido registrado";
                }
            }

            $user = new User(
                $user->id,
                $name,
                $email,
                null
            );
            

            if(!empty($erroresVal)){

                //Formulario no validado
                $_SESSION['user'] = Serialize($user);
                $_SESSION['error'] = "Fallo en la validación del formulario";
                $_SESSION['erroresVal'] = $erroresVal;
                //print_r($erroresVal);
                //exit;

                //Redireccionamos a nuevo usuario
                header('Location: ' . URL . 'auth/edit');

                exit;


            }else{

                //Añade el usuario
                $this->model->update($user);

                //Autorrelleno del login
                $_SESSION['name_user'] = $user->name;

                $_SESSION['mensaje'] = "Usuario modificado correctamente";
                
                //Vuelve al login
                header('Location: ' . URL . "login" );

                exit;

            }
        }

        //Validar password
    public function chpassword(){

        sec_session_start();

        //Capa autentificacion
        if(!isset($_SESSION['id']) ){
            header("location:" .URL. "login");
            exit;
        }

        $this->view->tittle = "Cambiar password - Albumes";

        //Comprobamos si existe algun mensaje
        if(isset($_SESSION['mensaje'])){
            $this->view->mensaje = $_SESSION['mensaje'];
            unset($_SESSION['mensaje']);
            
        }


        //Comprobamos si existe algun mensaje
        if(isset($_SESSION['error'])){
            $this->view->error = $_SESSION['error'];
            unset($_SESSION['error']);

            $this->view->erroresVal = $_SESSION['erroresVal'];
            unset($_SESSION['erroresVal']);
            
        }

        $this->view->render('auth/password/index');

    }

        //validacion cambio password
    public function password() {

        sec_session_start();

        $this->view->title = "Cambiar password - Albumes";

        if (!isset($_SESSION['id'])) {

            header("location:". URL. "login");

            exit;

        }

        $password_actual = filter_var($_POST['password_actual'] ??= null, FILTER_SANITIZE_STRING);
        $password = filter_var($_POST['password'] ??= null, FILTER_SANITIZE_STRING);
        $password_confirm = filter_var($_POST['password_confirm'] ??= null, FILTER_SANITIZE_STRING);

        $user = $this->model->getUserId($_SESSION['id']);

        $erroresVal = array();

        if (!password_verify($password_actual, $user->password)) {
            $erroresVal['password_actual'] = "Password actual no es correcto";
        }

        if (empty($password)) {
            $erroresVal['password'] = "Password no introducido";
        } else if (strcmp($password, $password_confirm) !== 0) {
            $erroresVal['password'] = "Password no coincidentes";
        } else if ((strlen($password) < 5) || (strlen($password) > 60)) {
            $erroresVal['password'] = "Password ha de tener entre 5 y 60 caracteres";
        }

        if (!empty($erroresVal)) {

            $_SESSION['erroresVal'] = $erroresVal;
            $_SESSION['error'] = "Formulario con errores de validación";

            header("location:". URL. "auth/password");

            exit;
        } else {
            
            $user = new User(
                $user->id,
                null,
                null,
                $password
            );

            $this->model->updatePassword($user);

            $_SESSION['mensaje'] = "Password modificado correctamente";

            header("location:". URL. "login");

            exit;
        }

    }
        
        public function delete(){

            //Iniciamos o continiuamos sessión
            sec_session_start();

            if (isset($_SESSION['error'])){

                $this->view->error = $_SESSION['error'];

                unset($_SESSION['error']);
            

            }

            if (isset($_SESSION['mensaje'])){

                $this->view->mensaje = $_SESSION['mensaje'];

                unset($_SESSION['mensaje']);

            }


            // Capa autentificación
            if(!isset($_SESSION['id'])){

                header("location:" . URL . "login");
                exit;

            }

            // Estraigo el id del usuario que voy a eliminar
            $this->view->id = $_SESSION['id'];

            $this->model->delete($this->view->id);
            
            sec_session_destroy();

            header('Location: ' . URL . 'login');


        }

    }

?>