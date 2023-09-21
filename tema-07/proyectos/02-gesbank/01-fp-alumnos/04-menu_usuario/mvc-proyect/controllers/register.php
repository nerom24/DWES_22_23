<?php

    class Register Extends Controller {

        public function render() {

            # iniciamos o continuar sessión
            sec_session_start();

            # Si existe algún mensaje 
            if (isset($_SESSION['mensaje'])) {

                $this->view->mensaje = $_SESSION['mensaje'];
                unset($_SESSION['mensaje']);

            }

            # Inicializamos los campos del formulario
            $this->view->name = null;
            $this->view->email = null;
            $this->view->password = null;

            if (isset($_SESSION['error'])) {

                # Mensaje de error
                $this->view->error = $_SESSION['error'];
                unset($_SESSION['error']);

                # Variables de autorrelleno
                $this->view->name = $_SESSION['name'];
                $this->view->email = $_SESSION['email'];
                $this->view->password = $_SESSION['password'];
                unset($_SESSION['name']);
                unset($_SESSION['email']);
                unset($_SESSION['password']);

                # Tipo de error
                $this->view->errores = $_SESSION['errores'];
                unset($_SESSION['errores']);

            }
        
            $this->view->render('aut/register/index');
        }
    

    public function validate() {

        # Iniciamos o continuamos con la sesión
        sec_session_start();

        # Saneamos el formulario
        $name = filter_var($_POST['name'],FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
        $password = filter_var($_POST['password'],FILTER_SANITIZE_SPECIAL_CHARS);
        $password_confirm = filter_var($_POST['password-confirm'],FILTER_SANITIZE_SPECIAL_CHARS);

        # Validaciones

        $errores = array();

        # Validar name
        if (empty($name)) {
            $errores['name'] = "Nombre es campo obligatorio";
        } elseif (!$this->model->validarName($name)) {
            $errores['name'] = "Nombre de usuario no permitido";
        }

        # Validar Email
        if (empty($email)) {
            $errores['email'] = "Email es campo obligatorio";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errores['email'] = "Email no válido";
        } elseif (!$this->model->validaEmailUnique($email)) {
            $errores['email'] = "Email ya ha sido registrado";
        }

        # Validar password
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
            $_SESSION['password'] = $password;
            $_SESSION['error'] = "Fallo en la validación del formulario";
            
            header("location:". URL. "register");
   
        } else {
            
            # Añade nuevo usuario

            $this->model->crear($name, $email, $password);
    
            $_SESSION['mensaje'] = "Usuario registrado correctamente";
            $_SESSION['email'] = $email;
            $_SESSION['password'] = $password;
            
            #Vuelve login
            header("location:". URL. "login");
        }
        


    }

}

?>