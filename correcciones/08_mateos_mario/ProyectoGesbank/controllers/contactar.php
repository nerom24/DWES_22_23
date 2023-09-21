<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

    class Contactar Extends Controller {

        public function render() {

            # inicio sesión
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
        
            $this->view->render('contactar/index');
        }
    

        function validar($param = []) {

            //inicio sesion 
            sec_session_start();
    
            //Saneamos los datos del formulario Filter_sanitize

            $nombre = $_POST['nombre'];
            $email = $_POST['email'];
            $asunto = $_POST['asunto'];
            $mensaje = $_POST['mensaje'];
            $mail = new PHPMailer(true);

            // Nombre. Obligatorio
            if (empty($nombre)) {
                $errores["nombre"] = "Campo obligatorio.";
            }

            // Mensaje. Obligatorio
            if (empty($mensaje)) {
                $errores["mensaje"] = "Campo obligatorio.";
            }

            // Asunto. Obligatorio
            if (empty($asunto)) {
                $errores["asunto"] = "Campo obligatorio.";
            }

            // Email. Obligatorio, formato EMAIL válido, ha de ser único en la tabla de clientes.
            if (empty($email)) {
                $errores["email"] = "Campo obligatorio.";
            } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errores["email"] = "Formato incorrecto.";
            }

            //Comprobar validacion

            if (!empty($errores)) {

                $_SESSION["error"] = "Formulario no ha sido validado";
                $_SESSION["errores"] = $errores;

                //redireccionamos a nuevo alumno
                header('Location:' . URL . 'contactar');
            } else {

                $this->view->title = "Tabla Clientes";
                $_SESSION["mensaje"] = "Cliente creado correctamente";
                header("Location:" . URL . "main");
            }

            try {

                $mail->CharSet = "UTF-8";
                $mail->Encoding = "quoted-printable";
                $mail->isHTML(true);
                $mail->isSMTP();
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = 'ssl';
                $mail->Host = 'smtp.gmail.com';
                $mail->Port = 465;
        
                $mail->Username = 'mariomateosmateos@gmail.com';
                $mail->Password = 'vfdprvxyqhrrovdy';
        
                $mail->setFrom($email, $email);
                $mail->addReplyTo('mariomateosmateos@gmail.com', 'Email respuesta');
                $mail->addAddress('nerom24@gmail.com', 'Mario');
        
                $mail->Subject = $asunto;

                $mail->Body = $mensaje.". Mensaje enviado por ".$email;

                $mail->send();
                Echo "Mensaje enviado con éxito";
        
            } catch (Exception $e) {
                Echo "Error al enviar correo: " . $mail->ErrorInfo;
                exit();
            }
            
        }

}