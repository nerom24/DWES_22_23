<?php

    class Perfil Extends Controller {


        public function edit() {

            // Iniciamos o continuamos sesion
            sec_session_start();

            // Capa de autentificacion
            if (!isset($_SESSION['id'])) {
                $_SESSION['mensaje'] = "Usuario debe autentificarse";
                
                header("location:". URL. "login");
                
            }

            // Comprobamos si existe mensaje
            if (isset($_SESSION['mensaje'])) {
                $this->view->mensaje = $_SESSION['mensaje'];
                unset($_SESSION['mensaje']);
            }

            //Obtenemos objeto User con los detalles del usuario
            $this->view->user = $this->model->getUserId($_SESSION['id']);

            // Compruebo si existe algún error en la validación
            if (isset($_SESSION['error'])) {

                // Mensaje de error
                $this->view->error = $_SESSION['error'];
                unset($_SESSION['error']);

                // Autorrelleno del formulario
                $this->view->user = unserialize($_SESSION['user']);
                unset($_SESSION['user']);

                // Cargo los errores especificos
                $this->view->errores = $_SESSION['errores'];
                unset($_SESSION['errores']);
            }

            $this->view->render('perfil/edit/index');
        }

        public function valperfil(){
            // Iniciamos o continuamos sesion
            sec_session_start();

            // Capa de autentificacion
            if (!isset($_SESSION['id'])) {
                $_SESSION['mensaje'] = "Usuario debe autentificarse";
                
                header("location:". URL. "login");
                
            }

            //Saneamos el formulario

            $name = filter_var($_POST['name'] ??= null, FILTER_SANITIZE_SPECIAL_CHARS);
            $email = filter_var($_POST['email'] ??= null, FILTER_SANITIZE_EMAIL);
            
            //Obtenemos objeto con los detalles del usuario

            $user = $this->model->getUserId($_SESSION['id']);

            // Validaciones

            $errores = [];


            //name
            if (strcmp($user->name, $name) !== 0) {
                if (empty($name)){
                    $errores['name'] = 'Campo obligatorio';
                } else if (strlen($name) < 5 || strlen($name) > 50) {
                    $errores['name'] = 'Nombre de usuario debe de tener entre 5 y 50 caracteres';
                } else if (!$this->model->validarName($name)) {
                    $errores['name'] = 'Nombre de usuario ya ha sido registrado';
                }
            }

            //email
            if (strcmp($user->email, $email) !== 0) {
                if (empty($email)){
                    $errores['email'] = 'Campo obligatorio';
                } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
                    $errores['email'] = 'Email incorrecto';
                } else if (!$this->model->validarEmail($email)){
                    $errores['email'] = 'Email en uso';
                }
            }

            //Crear objeto user

            $user = new User(
                $user->id,
                $name,
                $email,
                null
            );

            // Comprobamos si hay errores

            if(!empty($errores)) {

                //  print_r($errores);
                // exit();

                $_SESSION['errores'] = $errores;
                $_SESSION['user'] = Serialize($user);
                $_SESSION['error'] = "Fallo en la validación del formulario";

                # Redireccionamos a  cliete
                header("location:" .URL. "perfil/edit");

            } else {

                // Actualizamos perfil
                $this->model->update($user);

                // Creamos mensaje
                $_SESSION['name_user'] = $name;
                $_SESSION['mensaje'] = "Usuario modificado correctamente";

                # Redireccionamos a  cliete
                header("location:" .URL. "clientes");

            }
            

        }

        //Modificación del password
        public function pass(){

            //iniciamos o continuamos sesion
            sec_session_start();

            // Capa de autentificacion
            if (!isset($_SESSION['id'])) {
                $_SESSION['mensaje'] = "Usuario debe autentificarse";
                
                header("location:". URL. "login");
                
            }

             // Comprobamos si existe mensaje
             if (isset($_SESSION['mensaje'])) {
                $this->view->mensaje = $_SESSION['mensaje'];
                unset($_SESSION['mensaje']);
            }

            // Capa no validación formulario

            if(isset($_SESSION['error'])){

                //mensaje de error
                $this->view->error = $_SESSION['error'];
                unset($_SESSION['error']);

                //tipo de error
                $this->view->errores = $_SESSION['errores'];
                unset($_SESSION['errores']);

            }

            //título página
            $this->view->title = "Modificar password";
            $this->view->render('perfil/pass/index');
        }

        //Validacíon cambio password
        public function valpass(){

            //iniciamos o continuamos sesion
            sec_session_start();

             // Capa de autentificacion
             if (!isset($_SESSION['id'])) {
                $_SESSION['mensaje'] = "Usuario debe autentificarse";
                
                header("location:". URL. "login");
                
            }

            //Saneamos formulario

            $password_actual = filter_var($_POST['password_actual'] ??= null, FILTER_SANITIZE_SPECIAL_CHARS);
            $password = filter_var($_POST['password'] ??= null, FILTER_SANITIZE_SPECIAL_CHARS);
            $password_confirm = filter_var($_POST['password_confirm'] ??= null, FILTER_SANITIZE_SPECIAL_CHARS);

            //Obtenemos objeto de los detalles del usuario
            $user = $this->model->getUserId($_SESSION['id']);

            //Validaciones
            $errores = [];

            //Validar password actual
            if(!password_verify($password_actual, $user->password)) {
                $errores['password_actual'] = "Password actual no es correcto";
            }

            //Validar nuevo password
            if (empty($password)) {
                $errores['password'] = "Password no introducido";
                
            } else if(strcmp($password, $password_confirm) !==0) {
                $errores['password'] = "Password no conincide";
            } else if ((strlen($password) < 5) || (strlen($password) > 60)) {
                $errores['password'] = "Password ha de tener entre 5 y 60 caracteres";
            }


            if(!empty($errores)) {

                

                $_SESSION['errores'] = $errores;
                $_SESSION['error'] = "Fallo en la validación del formulario";

                # Redireccionamos a perfil/pass
                header("location:" .URL. "perfil/pass");

            } else {

                //Crear objeto user
                $user = new User (
                    $user->id,
                    null,
                    null,
                    $password
                );

                // Actualizamos password
                $this->model->updatePass($user);

                // Creamos mensaje
                $_SESSION['mensaje'] = "Password modificado correctamente";

                # Redireccionamos a cliete
                header("location:" .URL. "clientes");

            }

        }

        //Muestra los detalles del perfil antes de eliminar
        public function show() {

            //iniciamos o continuamos sesion
            sec_session_start();

             // Capa de autentificacion
             if (!isset($_SESSION['id'])) {
                $_SESSION['mensaje'] = "Usuario debe autentificarse";
                
                header("location:". URL. "login");
                
            }

            //Obtenemos objeto con los detalles del usuario
            $this->view->user = $this->model->getUserId($_SESSION['id']);
            $this->view->title = "Eliminar Perfil Usuario";
            $this->view->render('perfil/delete/index');

        }

        //Elimina definitivamente el perfil
        public function delete(){

            //iniciamos o continuamos sesion
            sec_session_start();

             // Capa de autentificacion
             if (!isset($_SESSION['id'])) {
                $_SESSION['mensaje'] = "Usuario debe autentificarse";
                
                header("location:". URL. "login");
                
            } else {

                //Elimino perfil de usuario
                $this->model->delete($_SESSION['id']);

                // Destruyo la sesión
                sec_session_destroy();

                //Salgo de la aplicación
                header("location:". URL. "index");
            }

        }
    }

?>