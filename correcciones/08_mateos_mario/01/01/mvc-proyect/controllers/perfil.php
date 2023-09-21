<?php

class Perfil extends Controller
{

    public function edit()
    {

        # inicio o continuo sesión
        sec_session_start();

        # Compruebo usuario autentificado.
        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";
            header("location:" . URL . "login");
        } else {

            # Comprueba si existe mensaje
            if (isset($_SESSION['mensaje'])) {
                $this->view->mensaje = $_SESSION['mensaje'];
                unset($_SESSION['mensaje']);
            }

            //Obtenemos un objeto de la clase user
            $this->view->user = $this->model->getUserId($_SESSION["id"]);

            # Comprueba si el formulario no ha sido validado
            if (isset($_SESSION['error'])) {

                # Mensaje de error
                $this->view->error = $_SESSION['error'];
                unset($_SESSION['error']);

                # Autorrelleno del formulario
                $this->view->user = unserialize($_SESSION['user']);
                unset($_SESSION['user']);

                # Cargo los errores específicos
                $this->view->errores = $_SESSION['errores'];
                unset($_SESSION['errores']);
            }


            $this->view->render('perfil/edit/index');

            # En la carpeta views tengo que crear la carpeta alumnos
            # Dentro de la carpeta alumnos creo main
            # En main creo index.php que corresponde a la vista que muestra los alumnos
        }
    }

    public function valperfil()
    {

        sec_session_start();

        if (!isset($_SESSION["id"])) {

            header("location:" . URL . "login");
        }


        #Saneamos el formulario
        $name = filter_var($_POST['name'] ??= null, FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_var($_POST['email'] ??= null, FILTER_SANITIZE_EMAIL);

        #Obtengo objeto con los datos del usuario
        $user = $this->model->getUserId($_SESSION['id']);

        #Validacion

        $errores = [];
        if (strcmp($user->name, $name) !== 0) {

            # Validar name
            if (empty($name)) {
                $errores['name'] = "Nombre es campo obligatorio";
            } else if ((strlen($name) < 5 || (strlen($name) > 50))) {
                $errores['name'] = "Nombre de usuario debe estar entre 5 y 50 chars";
            } else if (!$this->model->validarName($name)) {
                $errores['name'] = "Nombre de usuario no permitido";
            }
        }

        # Validar Email
        if (strcmp($user->email, $email) !== 0) {
            if (empty($email)) {
                $errores['email'] = 'Campo obligatorio';
            } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errores['email'] = 'Email incorrecto';
            } else if (!$this->model->validarEmail($email)) {
                $errores['email'] = 'Email registrado';
            }
        }

        // crear objeto user 
        $user = new User(
            $user->id,
            $name,
            $email,
            null
        );


        if (!empty($errores)) {

            // Si $errores el formulario no ha sido validado
            $_SESSION['user'] = serialize($user);
            $_SESSION['error'] = 'Formulario no ha sido validado';
            $_SESSION['errores'] = $errores;

            # Redireccionamos a nuevo alumno

            header('location:' . URL . 'perfil/edit/');
        } else {

            # actualizo la base de datos
            $this->model->update($user);

            # Crear mensaje
            $_SESSION['mensaje'] = 'Usuario actualizado correctamente';

            $_SESSION["name_user"] = $name;

            # redirecciono al main de cuentas
            header('location:' . URL . 'albumes');
        }
    }

    
    public function pass()
    {
        sec_session_start();


        if (!isset($_SESSION["id"])) {

            header("location:" . URL . "login");
        } else {


            # Comprueba si existe mensaje
            if (isset($_SESSION['mensaje'])) {
                $this->view->mensaje = $_SESSION['mensaje'];
                unset($_SESSION['mensaje']);
            }


            # Comprueba si el formulario no ha sido validado
            if (isset($_SESSION['error'])) {
                # Mensaje de error
                $this->view->error = $_SESSION['error'];
                unset($_SESSION['error']);

                # Cargo los errores específicos
                $this->view->errores = $_SESSION['errores'];
                unset($_SESSION['errores']);
            }

            $this->view->title = "Modificar password";
            $this->view->render("perfil/pass/index");
        }
    }

    public function valpass()
    {

        sec_session_start();

        if (!isset($_SESSION["id"])) {

            header("location:" . URL . "login");
        }


        #Saneamos el formulario
        $password_actual = filter_var($_POST['password_actual'] ??= null, FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_var($_POST['password'] ??= null, FILTER_SANITIZE_SPECIAL_CHARS);
        $password_confirm = filter_var($_POST['password_confirm'] ??= null, FILTER_SANITIZE_SPECIAL_CHARS);

        #Obtengo objeto con los datos del usuario
        $user = $this->model->getUserId($_SESSION['id']);

        #Validacion
        $errores = [];
        if (!password_verify($password_actual, $user->password)) {
            $errores["password_actual"] = "Password actual no es correcto";
        }

        # Validar pass
        if (empty($password)) {
            $errores['password'] = "Pasword no introducido";
        } else if ((strcmp($password, $password_confirm) !== 0)) {
            $errores['password'] = "Password no coincidentes";
        } else if (strlen($password) < 5 || strlen($password) > 60) {

            $errores['password'] = "Password debe tener entre 5 y 60 caracteres";
        }


        if (!empty($errores)) {

            // Si $errores el formulario no ha sido validado
            $_SESSION['error'] = 'Formulario no ha sido validado';
            $_SESSION['errores'] = $errores;

            # Redireccionamos a nuevo alumno

            header('location:' . URL . 'perfil/pass/');
        } else {

            // crear objeto user 
            $user = new User(
                $user->id,
                null,
                null,
                $password
            );
            # actualizo la base de datos
            $this->model->updatePass($user);

            # Crear mensaje
            $_SESSION['mensaje'] = 'Password actualizado correctamente';

            # redirecciono al main de alumnos
            header('location:' . URL . 'albumes');
        }
    }

    public function show()
    {

        sec_session_start();


        if (!isset($_SESSION["id"])) {

            header("location:" . URL . "login");
        }

        $this->view->user = $this->model->getUserId($_SESSION["id"]);
        $this->view->title = "Eliminar Perfil Usuario";
        $this->view->render("perfil/delete/index");
    }

    public function delete()
    {

        sec_session_start();


        if (!isset($_SESSION["id"])) {

            header("location:" . URL . "login");
        } else {
            $this->model->delete($_SESSION["id"]);
            
            sec_session_destroy();

            header("location:".URL . "index");
        }
    }
}
