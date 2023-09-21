<?php

    class Perfil Extends Controller {

        public function edit() {

            # Iniciamos o continuamos sesión
            sec_session_start();

            # Capa de autentificación
            if (isset($_SESSION['id'])) {

                header('Location' .URL. 'login');

            }

            # Comprobamos que existe algún mensaje
            if (isset($_SESSION['mensaje'])) {

                $this->view->mensaje = $_SESSION['mensaje'];
                unset($_SESSION['mensaje']);

            }

            # Obtenemos objeto User con los detalles del usuario
            $this->view->user = $this->model->getUserId($_SESSION['id']);

            # Capa no validación formulario
            if (isset($_SESSION['error'])) {

                # Mensaje de error
                $this->view->error = $_SESSION['error'];
                unset($_SESSION['error']);

                # Variables de autorrelleno
                $this->view->alumno = unserialize($_SESSION['user']);
                unset($_SESSION['user']);

                # Tipo de error
                $this->view->errores = $_SESSION['errores'];
                unset($_SESSION['errores']);
            }

            # carge la vista
            $this->view->render('perfil/edit/index');

        }

        public function valperfil() {

            # Iniciamos o continuamos sesión
            sec_session_start();

            # Capa de autentificación
            if (isset($_SESSION['id'])) {

                header('Location' .URL. 'login');

            }

            # Saneamos el formulario
            $name = filter_var($_POST['name'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $email = filter_var($_POST['email'] ??= '', FILTER_SANITIZE_EMAIL);

            # Obtenemos objeto con los detalles del usuario
            $user = $this->model->getUserId($_SESSION['id']);

            # Validaciones
            $errores = [];

            // name
            if(strcmp($user->name, $name) !== 0){
                if(empty($name)) {
                    $errores['name'] = "Nombre de usuario es obligatorio";
                } else if ((strlen($name) < 5) || (strlen($name) > 50)) {
                    $errores['name'] = "Nombre de usuario ha de tener entre 5 y 50 caracteres";
                } else if (!$this->model->validarName($name)) {
                    $errores['name'] = "Nombre de usuario ya ha sido registrado";
                }
            }

            //email
            if(strcmp($user->email, $email) !== 0){
                if(empty($email)) {
                    $errores['email'] = "Email es un campo obligatorio";
                } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $errores['email'] = "Email no válido";
                } else if (!$this->model->validarName($email)) {
                    $errores['email'] = "Email ya ha sido registrado";
                }
            }

            # Crear objeto user
            $user = new User (
                $user->id,
                $name,
                $email,
                null
            );

            # Comprobamos si hay errores
            if (!empty($errores)) {
                $_SESSION['errores'] = $errores;
                $_SESSION['user'] = serialize($user);
                $_SESSION['error'] = "Formulario con errores de validación";

                header('Location:' .URL. 'perfil/edit');

            } else {

                # Actualizamos perfil
                $this->model->update($user);

                $_SESSION['name_user'] = $name;
                $_SESSION['mensaje'] = 'Usuario modificado correctamente';

                header('Location:' .URL. 'clientes');

            }
        }

        public function pass() {

            # Iniciamos o continuamos sesión
            sec_session_start();

            # Capa de autentificación
            if (isset($_SESSION['id'])) {

                header('Location' .URL. 'login');

            }

            # Comprobamos que existe algún mensaje
            if (isset($_SESSION['mensaje'])) {

                $this->view->mensaje = $_SESSION['mensaje'];
                unset($_SESSION['mensaje']);
            
            }

            # Obtenemos objeto User con los detalles del usuario
            $this->view->user = $this->model->getUserId($_SESSION['id']);

            # Capa no validación formulario
            if (isset($_SESSION['error'])) {

                # Mensaje de error
                $this->view->error = $_SESSION['error'];
                unset($_SESSION['error']);

                # Tipo de error
                $this->view->errores = $_SESSION['errores'];
                unset($_SESSION['errores']);
            }

            # Titulo de la pagina
            $this->view->title = "Modificar password";
            $this->view->render('perfil/pass/index');

            
        }

        public function valpass() {

            # Iniciamos o continuamos sesión
            sec_session_start();

            # Capa de autentificación
            if (isset($_SESSION['id'])) {

                header('Location' .URL. 'login');

            }

            # Saneamos el formulario
            $password_actual = filter_var($_POST['password_actual'] ??= null, FILTER_SANITIZE_SPECIAL_CHARS);
            $password = filter_var($_POST['password'] ??= null, FILTER_SANITIZE_SPECIAL_CHARS);
            $password_confirm = filter_var($_POST['password_confirm'] ??= null, FILTER_SANITIZE_SPECIAL_CHARS);

            # Obtenemos objeto con los detalles del usuario
            $user = $this->model->getUserId($_SESSION['id']);

            # Validaciones
            $errores = array();

            # Validar password actual
            if (!password_verify($password_actual, $user->password)) {
                    $errores['password_actual'] = "Password actual no es correcto";
            }

            # Validar nuevo password
            if(empty($password)) {
                $errores['password'] = "Password no introducido";
            } else if (strcmp($password, $password_confirm) !==0) {
                $errores['password'] = "Password no coincidentes";
            } else if ((strlen($password) < 5) || (strlen($password) > 60)) {
                $errores['password'] = "Password ha de tener entre 5 y 60 caracteres";
            } 

            if (!empty($errores)) {

                $_SESSION['errores'] = $errores;
                $_SESSION['error'] = "Formulario con errores de validación";

                header("Location:" .URL. "perfil/pass");


            } else {

                # Crear objeto user
                $user = new User(
                    $user->id,
                    null,
                    null,
                    $password
                );

                # Actualiza password
                $this->model->updatePass($user);

                $_SESSION['mensaje'] = "Password modificado correctamente";

                #Vuelve alumnos
                header("Location:" .URL. "clientes");

            }
        }

        public function show() {

            # Iniciamos o continuamos sesión
            sec_session_start();

            # Capa de autentificación
            if (isset($_SESSION['id'])) {

                header('Location' .URL. 'login');

            }

            # Comprobamos que existe algún mensaje
            if (isset($_SESSION['mensaje'])) {

                $this->view->mensaje = $_SESSION['mensaje'];
                unset($_SESSION['mensaje']);
            
            }

            # Obtenemos objeto User con los detalles del usuario
            $this->view->user = $this->model->getUserId($_SESSION['id']);

            # Capa no validación formulario
            if (isset($_SESSION['error'])) {

                # Mensaje de error
                $this->view->error = $_SESSION['error'];
                unset($_SESSION['error']);

                # Tipo de error
                $this->view->errores = $_SESSION['errores'];
                unset($_SESSION['errores']);
            }

            # Titulo de la pagina
            $this->view->title = "Eliminar Perfil";
            $this->view->render('perfil/delete/index');
        }

        public function delete() {

            # Iniciamos o continuamos sesión
            sec_session_start();

            # Capa de autentificación
            if (isset($_SESSION['id'])) {

                header('Location:' .URL. 'login');

            }

            # Elimino perfil de usuario
            $this->model->delete($_SESSION['id']);

            # Destruyo la sesión
            sec_session_destroy();

            # Salgo de la apliación
            header('Location:' .URL. 'index');    
        
        }
    }

?>