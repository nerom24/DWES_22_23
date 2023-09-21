<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

    class Contactar Extends Controller {
        public function render() {
            session_start();
            if (isset($_SESSION['mensaje'])) {
                $this->view->mensaje = $_SESSION['mensaje'];
                unset($_SESSION['mensaje']);
            }
            $this->view->name = null;
            $this->view->email = null;
            $this->view->password = null;
            if (isset($_SESSION['error'])) {
                $this->view->error = $_SESSION['error'];
                unset($_SESSION['error']);
                $this->view->name = $_SESSION['name'];
                $this->view->email = $_SESSION['email'];
                $this->view->password = $_SESSION['password'];
                unset($_SESSION['name']);
                unset($_SESSION['email']);
                unset($_SESSION['password']);
                $this->view->errores = $_SESSION['errores'];
                unset($_SESSION['errores']);
            }
            $this->view->render('contactar/index');
        }

        function validar($param = []){
            sec_session_start();
            $nombre = $_POST['nombre'];
            $email = $_POST['email'];
            $asunto = $_POST['asunto'];
            $mensaje = $_POST['mensaje'];
            $mail = new PHPMailer(true);
            if (empty($nombre)) {
                $errores["nombre"] = "Campo obligatorio.";
            }
            if (empty($mensaje)) {
                $errores["mensaje"] = "Campo obligatorio.";
            }
            if (empty($asunto)) {
                $errores["asunto"] = "Campo obligatorio.";
            }
            if (empty($email)) {
                $errores["email"] = "Campo obligatorio.";
            } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errores["email"] = "Formato incorrecto.";
            }
            if (!empty($errores)) {
                $_SESSION["error"] = "El formulario no ha sido validado";
                $_SESSION["errores"] = $errores;
                header('Location:' . URL . 'contactar');
            } else {
                $this->view->title = "Tabla Cuentas";
                $_SESSION["mensaje"] = "El cliente se ha creado correctamente";
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
                $mail->Username = 'albertomm30@gmail.com';
                $mail->Password = 'cvfwpmdekkgopvox';
                $mail->setFrom($email, $email);
                $mail->addReplyTo('albertomm30@gmail.com', 'Email respuesta');
                $mail->addAddress('nerom24@gmail.com', 'Alberto');
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