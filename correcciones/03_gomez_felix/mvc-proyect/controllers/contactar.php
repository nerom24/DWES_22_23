<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

class Contactar extends Controller
{

    function render($param = [])
    {

        sec_session_start();

        if (isset($_SESSION["mensaje"])) {
            $this->view->mensaje = $_SESSION["mensaje"];
            unset($_SESSION["mensaje"]);
        }

        if (isset($_SESSION["error"])) {

            $this->view->error = $_SESSION["error"];

            unset($_SESSION["error"]);

            $this->view->errores = $_SESSION["errores"];
            unset($_SESSION["errores"]);
        }

        $this->view->render("contactar/index");
    }

    function validar($param = [])
    {


        sec_session_start();

        //Saneamos los datos del formulario Filter_sanitize

        $nombre = filter_var($_POST['nombre'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $remitente = filter_var($_POST['remitente'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $asunto = filter_var($_POST['asunto'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
        $mensaje = filter_var($_POST['mensaje'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);


        // Nombre. Obligatorio, tamaño máximo 20
        if (empty($nombre)) {
            $errores["nombre"] = "Campo obligatorio.";
        } else if (strlen($nombre) > 20) {
            $errores["nombre"] = "Nombre superior a 20 caracteres.";
        }
        if (empty($asunto)) {
            $errores["asunto"] = "Campo obligatorio.";
        }
        if (empty($mensaje)) {
            $errores["mensaje"] = "Campo obligatorio.";
        }


        // Email. Obligatorio, formato EMAIL válido, ha de ser único en la tabla de clientes.
        if (empty($remitente)) {
            $errores["remitente"] = "Campo obligatorio.";
        } else if (!filter_var($remitente, FILTER_VALIDATE_EMAIL)) {
            $errores["remitente"] = "Formato incorrecto.";
        }

        //Comprobar validacion

        if (!empty($errores)) {

            $_SESSION["error"] = "Formulario no ha sido validado";
            $_SESSION["errores"] = $errores;

            //redireccionamos a nuevo alumno
            header('Location:' . URL . 'contactar');
        } else {

            $mail = new PHPMailer(true);

            try {



                $mail->CharSet = "UTF-8";
                $mail->Encoding = "quoted-printable";
                $mail->isHTML(true);

                $mail->IsSMTP();
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = 'ssl';
                $mail->Host = "smtp.gmail.com";
                $mail->Port = 465;

                $mail->Username = "felixmihmo@gmail.com";
                $mail->Password = "vqxzebbhjvxrcfil";

                //remitente
                $mail->setFrom($remitente, $nombre);
                //direccion de envio
                $mail->addAddress("nerom24@gmail.com", 'Felix ');

                $mail->Subject = $asunto;

                $mail->Body = $mensaje;

                $mail->send();
            } catch (Exception $th) {
                echo "Error al enviar el correo: " . $mail->ErrorInfo;
            }

            $_SESSION["mensaje"] = "Email enviado";
            header("Location:" . URL . "main");
        }
    }
}
