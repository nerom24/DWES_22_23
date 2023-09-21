<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
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

            try {

                require 'PHPMailer/src/Exception.php';
                require 'PHPMailer/src/PHPMailer.php';
                require 'PHPMailer/src/SMTP.php';

                $mail = new PHPMailer(true);
                
                $mail->CharSet = "UTF-8";
                $mail->Encoding = "quoted-printable";   
                $mail->SMTPDebug = false;
                $mail->do_debug = 0;
                $mail->isSMTP(); 

            
                
                $mail->Username = 'adripolixero19@gmail.com';
                $mail->Password = 'dedxaamjtaphjhin'; 
                
                //$mail->SMTPDebug = 2; 
                $mail->SMTPSecure = 'ssl'; 
                $mail->Host = 'smtp.gmail.com'; 
                $mail->Port = 465;                               
                                                    
                $mail->SMTPAuth = true;                                  
                
                // direccion de remitente
                $mail->setFrom('adripolixero19@gmail.com', 'Adrian');

                // direccion de destinatario
                $mail->addAddress ($email); 	

                // direccion de respuesta
                $mail->AddReplyTo('respuesta@gamil.com', 'respuesta');

                // Asunto
                $mail->Subject = 'Bienvenido a GesBank';

                $mail->isHTML(true);
                $mail->addEmbeddedImage('logo/banco.jpeg','milogo','logo.png');
                $mail->Body ='Gracias por registrarse en Gesbank, a continuación puedes comprobar 
                sus datos de acceso a nuestra web:'.'<br>'
                .'<b>Nombre:</b> ' .$name .'<br>'
                .'<b>Email:</b> ' .$email.'<br>'
                .'<b>Password:</b> ' .$password.'<br>'
                .'<b>Un cordial saludo desde el equipo de GesBank.</b>';

                $mail->send(); 
                #Vuelve login
                header("location:". URL. "login");
                
                
                    
            } catch (Exception $e) {

                $_SESSION['error'] = 'Message could not be sent. Mailer Error: '. $mail->ErrorInfo;;
                $_SESSION['errores'] = $errores;

            }
            
            
            
        }
        


    }

}

?>