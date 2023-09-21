<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

    class Register Extends Controller {
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
            $this->view->render('aut/register/index');
        }
    

    public function validate() {
        $mail = new PHPMailer(true);
        session_start();
        $name = filter_var($_POST['name'],FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
        $password = filter_var($_POST['password'],FILTER_SANITIZE_SPECIAL_CHARS);
        $password_confirm = filter_var($_POST['password-confirm'],FILTER_SANITIZE_SPECIAL_CHARS);
        $errores = [];
        if (empty($name)) {
            $errores["name"]= "campo obligatorio";
        }else if (!$this->model->validarName($name)) {
            $errores['name'] = "Nombre de usuario no permitido";
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errores['email'] = "Email no válido";
        } elseif (!$this->model->validaEmailUnique($email)) {
            $errores['email'] = "Email existente";
        }
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
            
        $this->model->crear($name, $email, $password);
            $_SESSION['mensaje'] = "Usuario registrado correctamente";
            $_SESSION['email'] = $email;
            $_SESSION['password'] = $password;           
            header("location:". URL. "login"); 
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
                $mail->setFrom("albertomm30@gmail.com", "GesBank");
                $mail->addReplyTo('albertomm30@gmail.com', 'Email de respuesta');
                $mail->addAddress($email, $email);
                $mail->Subject = "Confirmación de registro";
                $mail->Body = "Te has registrado con el email ".$email." y con el nombre ". $name."";
                $mail->send();
                Echo "Mensaje enviado";      
            } catch (Exception $e) {
                Echo "Error al enviar correo: " . $mail->ErrorInfo;
                exit();
            }
        } 
    }
}
?>