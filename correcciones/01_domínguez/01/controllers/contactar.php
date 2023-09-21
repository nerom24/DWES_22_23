<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    class Contactar extends Controller {

        public function formContactar (){

            $this->view->title="Formulario Contacto";
            $this->view->render('contactar/main/index');
        }
    
        public function validar (){
            
            require 'PHPMailer/src/Exception.php';
            require 'PHPMailer/src/PHPMailer.php';
            require 'PHPMailer/src/SMTP.php';

            sec_session_start();

            # Saneamiento
            $nombre = filter_var($_POST['nombre'], FILTER_SANITIZE_SPECIAL_CHARS);
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $asunto = filter_var($_POST['asunto'], FILTER_SANITIZE_SPECIAL_CHARS);
            $cuerpo = filter_var($_POST['cuerpo'], FILTER_SANITIZE_SPECIAL_CHARS);

            # Validación
            $errores = array();

            // Validación destinatario
            if (empty($nombre)) {
                $errores['nombre'] = "Campo Obligatorio";
            }

            if (empty($email)) {
                $errores['email'] = "Campo Obligatorio";
            } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errores['email'] = "Email email no es válido";
            } 

            // Validación asunto
            if (empty($asunto)) {
                $errores['asunto'] = "Campo Obligatorio";
            }

            // Validación mensaje
            if (empty($cuerpo)) {
                $errores['cuerpo'] = "Campo Obligatorio";
            }

            if (empty($errores)) {

                # Enviamos mensaje
            
                try {
        
                    $mail = new PHPMailer(true);
                    
                    $mail->CharSet = "UTF-8";
                    $mail->Encoding = "quoted-printable";	
                    $mail->SMTPDebug = false;
                    $mail->do_debug = 0;
                    $mail->isSMTP(); 
        
                    
                    //Server settings smtp gmail
                    //Nos vamos a el perfil de la cuenta de gmail
                    //Activamos la opción de seguridad autentificación a 2 pasos
                    //Generamos una contraseña Temporal
                    //Dicha contraseña la pegamos en la propiedad Password
                    
                    $mail->Username = 'nerom24@gmail.com';                 
                    $mail->Password = 'chretcqbybqfxvpq';  
                    
                    //$mail->SMTPDebug = 2; 
                    $mail->SMTPSecure = 'ssl'; 
                    $mail->Host = 'smtp.gmail.com'; 
                    $mail->Port = 465;                               
                                                        
                    $mail->SMTPAuth = true;                                  
                    
                    $mail->setFrom ( $email );
                    $mail->FromName= $nombre; 
                    
                    $mail->addAddress ('nerom24@gmail.com' ); 		
                    $mail->Subject = $asunto;
                    $mail->isHTML(true);
                    $mail->Body = $cuerpo;
        
                    $mail->send(); 
                    header('location:'.URL. 'index');
                    $_SESSION['mensaje'] ='Mensaje enviado con éxito. ' ;
                    
                    
                        
                } catch (Exception $e) {
        
                    $_SESSION['error'] = 'Message could not be sent. Mailer Error: '. $mail->ErrorInfo;;
                    $_SESSION['errores'] = $errores;
                    // autorrelleno del formulario
                    $_SESSION['nombre'] = $nombre;
                    $_SESSION['email'] = $email;
                    $_SESSION['asunto'] = $asunto;
                    $_SESSION['cuerpo'] = $cuerpo;
                    
                    
                
                }
            } else {
                
                $_SESSION['error'] = "Formulario no validado";
                $_SESSION['errores'] = $errores;
                // autorrelleno del formulario
                $_SESSION['destinatario'] = $destinatario;
                $_SESSION['asunto'] = $asunto;
                $_SESSION['cuerpo'] = $cuerpo;
                header('location:'.URL. 'contactar/formContactar');
                
            }
        
            
        }
    }

   

?>