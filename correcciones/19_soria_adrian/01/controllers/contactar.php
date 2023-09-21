<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    class Contactar extends Controller {

        
        function formcontactar(){
            //Iniciamos o continuamos sesion
            sec_session_start();

            # Inicializamos los campos del formulario
            $this->view->nombre = null;
            $this->view->correo = null;
            $this->view->asunto = null;
            $this->view->cuerpo = null;
           
            // Compruebo si existe mensaje
            if (isset($_SESSION['error'])) {
                // Mensaje de error
                $this->view->error = $_SESSION['error'];
                unset($_SESSION['error']);

                //Autorrelleno formulario
                $this->view->nombre = $_SESSION['nombre'];
                $this->view->correo = $_SESSION['correo'];
                $this->view->asunto = $_SESSION['asunto'];
                $this->view->cuerpo = $_SESSION['cuerpo'];
                unset($_SESSION['nombre']);
                unset($_SESSION['correo']);
                unset($_SESSION['asunto']);
                unset($_SESSION['cuerpo']);

                // Cargo los errores especificos
                $this->view->errores = $_SESSION['errores'];
                unset($_SESSION['errores']);
            }

            $this->view->title = "Formulario de Contacto";
            
            $this->view->render('contactar/main/index');

            //en la carpeta views tengo que crear la carpeta contactar
            //dentro de la carpeta contactar creo main
            //en la main creo index.php que corresponde a la vista que muestra contactar
        
            
            
        }

        public function validar(){

            //Iniciamos o continuamos sesion
            sec_session_start();

            require 'PHPMailer/src/Exception.php';
            require 'PHPMailer/src/PHPMailer.php';
            require 'PHPMailer/src/SMTP.php';
            
            
            // Saneamiento
            $nombre = filter_var($_POST['nombre'], FILTER_SANITIZE_SPECIAL_CHARS);
            $correo = filter_var($_POST['correo'], FILTER_SANITIZE_EMAIL);
            $asunto = filter_var($_POST['asunto'], FILTER_SANITIZE_SPECIAL_CHARS);
            $cuerpo = filter_var($_POST['cuerpo'], FILTER_SANITIZE_SPECIAL_CHARS);
            
        
            // Validación
            $errores = array();

            // Validación correo
            if (empty($correo)) {
                $errores['correo'] = "Campo Obligatorio";
                
            } else if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
                $errores['correo'] = "Email no válido";
            } 
            // Validación nombre
            if (empty($nombre)) {
                $errores['nombre'] = "Campo Obligatorio";
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
        
            // Enviamos mensaje
            
                try {

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
                    $mail->setFrom($correo, $nombre);

                    // direccion de destinatario
                    $mail->addAddress ('adripolixero19@gmail.com', 'Adrian'); 	

                    // direccion de respuesta
                    $mail->AddReplyTo('respuesta@gamil.com', 'respuesta');

                    // Asunto
                    $mail->Subject = $asunto;

                    $mail->isHTML(true);
                    $mail->Body = $cuerpo;

                    $mail->send(); 
                    $_SESSION['mensaje'] ='Mensaje enviado con éxito. ' ;
                    header("location:". URL. "index");
                    
                        
                } catch (Exception $e) {

                    $_SESSION['error'] = 'Message could not be sent. Mailer Error: '. $mail->ErrorInfo;;
                    $_SESSION['errores'] = $errores;
                    // autorrelleno del formulario
                    $_SESSION['correo'] = $correo;
                    $_SESSION['nombre'] = $nombre;
                    $_SESSION['asunto'] = $asunto;
                    $_SESSION['cuerpo'] = $cuerpo;
                    
                    
                
                }
            } else if (!empty($errores)) {

                print_r($errores);
                //exit();
                
                $_SESSION['error'] = "Formulario no validado";
                $_SESSION['errores'] = $errores;
                // autorrelleno del formulario
                $_SESSION['correo'] = $correo;
                $_SESSION['nombre'] = $nombre;
                $_SESSION['asunto'] = $asunto;
                $_SESSION['cuerpo'] = $cuerpo;

                header("location:" .URL. "contactar/formcontactar");
                
            }
            
            
        }

    }

?>