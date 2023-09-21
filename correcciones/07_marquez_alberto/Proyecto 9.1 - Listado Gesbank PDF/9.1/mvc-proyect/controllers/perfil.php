<?php

class Perfil extends Controller
{

    public function edit()
    {

       
        sec_session_start();

        
        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";
            header("location:" . URL . "login");
        } else {

           
            if (isset($_SESSION['mensaje'])) {
                $this->view->mensaje = $_SESSION['mensaje'];
                unset($_SESSION['mensaje']);
            }

            
            $this->view->user = $this->model->getUserId($_SESSION["id"]);

           
            if (isset($_SESSION['error'])) {

                
                $this->view->error = $_SESSION['error'];
                unset($_SESSION['error']);

               
                $this->view->user = unserialize($_SESSION['user']);
                unset($_SESSION['user']);

                
                $this->view->errores = $_SESSION['errores'];
                unset($_SESSION['errores']);
            }


            $this->view->render('perfil/edit/index');
        }
    }

    public function valperfil()
    {

        sec_session_start();

        if (!isset($_SESSION["id"])) {

            header("location:" . URL . "login");
        }


        
        $name = filter_var($_POST['name'] ??= null, FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_var($_POST['email'] ??= null, FILTER_SANITIZE_EMAIL);

        
        $user = $this->model->getUserId($_SESSION['id']);

        

        $errores = [];
        if (strcmp($user->name, $name) !== 0) {

           
            if (empty($name)) {
                $errores['name'] = "Nombre es campo obligatorio";
            } else if ((strlen($name) < 5 || (strlen($name) > 50))) {
                $errores['name'] = "Nombre de usuario debe estar entre 5 y 50 chars";
            } else if (!$this->model->validarName($name)) {
                $errores['name'] = "Nombre de usuario no permitido";
            }
        }

        
        if (strcmp($user->email, $email) !== 0) {
            if (empty($email)) {
                $errores['email'] = 'Campo obligatorio';
            } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errores['email'] = 'Email incorrecto';
            } else if (!$this->model->validarEmail($email)) {
                $errores['email'] = 'Email registrado';
            }
        }

        
        $user = new User(
            $user->id,
            $name,
            $email,
            null
        );


        if (!empty($errores)) {

            
            $_SESSION['user'] = serialize($user);
            $_SESSION['error'] = 'Formulario no ha sido validado';
            $_SESSION['errores'] = $errores;

            

            header('location:' . URL . 'perfil/edit/');
        } else {

           
            $this->model->update($user);

           
            $_SESSION['mensaje'] = 'Usuario actualizado correctamente';

            $_SESSION["name_user"] = $name;

            
            header('location:' . URL . 'cuentas');
        }
    }

    
    public function pass()
    {
        sec_session_start();


        if (!isset($_SESSION["id"])) {

            header("location:" . URL . "login");
        } else {


           
            if (isset($_SESSION['mensaje'])) {
                $this->view->mensaje = $_SESSION['mensaje'];
                unset($_SESSION['mensaje']);
            }


           
            if (isset($_SESSION['error'])) {
                
                $this->view->error = $_SESSION['error'];
                unset($_SESSION['error']);

                
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


        
        $password_actual = filter_var($_POST['password_actual'] ??= null, FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_var($_POST['password'] ??= null, FILTER_SANITIZE_SPECIAL_CHARS);
        $password_confirm = filter_var($_POST['password_confirm'] ??= null, FILTER_SANITIZE_SPECIAL_CHARS);

        
        $user = $this->model->getUserId($_SESSION['id']);

        
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

            
            $_SESSION['error'] = 'Formulario no ha sido validado';
            $_SESSION['errores'] = $errores;

            

            header('location:' . URL . 'perfil/pass/');
        } else {

            
            $user = new User(
                $user->id,
                null,
                null,
                $password
            );
           
            $this->model->updatePass($user);

           
            $_SESSION['mensaje'] = 'Password actualizado correctamente';

            # redirecciono al main de alumnos
            header('location:' . URL . 'cuentas');
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
