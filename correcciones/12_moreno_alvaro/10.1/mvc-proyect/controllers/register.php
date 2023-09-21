<?php

    
    # Instalación

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

    class Register Extends Controller {

        public function render() {

            # iniciamos o continuar sessión
            session_start();

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

        $mail = new PHPMailer(true);

        # Iniciamos o continuamos con la sesión
        session_start();

        # Saneamos el formulario
        $name = filter_var($_POST['name'],FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
        $password = filter_var($_POST['password'],FILTER_SANITIZE_SPECIAL_CHARS);
        $password_confirm = filter_var($_POST['password-confirm'],FILTER_SANITIZE_SPECIAL_CHARS);

        # Validaciones

        $errores = [];

        # Validar name
        if (empty($name)) {
            $errores["name"]= "campo obligatorio";
        }else if (!$this->model->validarName($name)) {
            $errores['name'] = "Nombre de usuario no permitido";
        }

        # Validar Email

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errores['email'] = "Email no válido";
        } elseif (!$this->model->validaEmailUnique($email)) {
            $errores['email'] = "Email existente";
        }

        # Validar password
        if (empty($password) || empty($password_confirm)) {
            $errores['password'] = "Password campo obligatorio";
        }else if (strcmp($password, $password_confirm) !== 0) {
            $errores['password'] = "Password no coincidentes";
        } elseif (!$this->model->validarPass($password)) {
            $errores['password'] = "Password:No permitido";
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

            try {

                $mail->CharSet = "UTF-8";
                $mail->Encoding = "quoted-printable";
                $mail->isHTML(true);
        
                // Activación servidor SMTP google
                $mail->isSMTP();
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = 'ssl';
                $mail->Host = 'smtp.gmail.com';
                $mail->Port = 465;
        
                // Autentificación
                $mail->Username = 'alvaromorenogil1@gmail.com';
                $mail->Password = 'skdzenotemoqegdk';
        
                // Dirección de remitente
                $mail->setFrom("alvaromorenogil1@gmail.com", "GesBank");
        
                // Dirección de respuesta
                $mail->addReplyTo('alvaromorenogil1@gmail.com', 'Email respuesta');
        
                // Dirección de envio
                $mail->addAddress($email, $email);
        
                // Asunto
                $mail->Subject = "Confirmación de registro";
        
                // Mensaje
                $mail->Body = "Te has registrado correctamente con el email <b>".$email."</b> y con el nombre <b>". $name.".</b>";
        
                // Envía
                $mail->send();
                Echo "Mensaje enviado con éxito";
        
            } catch (Exception $e) {
                Echo "Error al enviar correo: " . $mail->ErrorInfo;
                exit();
            }
        }
        


    }

}

?>