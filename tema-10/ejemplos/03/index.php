<?php

    # Procesar emial con PHP Mailer

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

    try {

		$mail = new PHPMailer(true);;
		$mail->CharSet = "UTF-8";
		$mail->Encoding = "quoted-printable";

        $mail->Username = 'nerom24@gmail.com';                 
    	$mail->Password = 'chretcqbybqfxvpq';  

    	$mail->SMTPDebug = 2; 
    	$mail->SMTPSecure = 'tls'; 
    	$mail->Host = 'smtp.gmail.com'; 
    	$mail->Port = 587;                               
    	$mail->isSMTP();                                      
    	$mail->SMTPAuth = true;                                  
    	                           

		$destinatario = 'nerom24@gmail.com';
		$remitente    = 'nerom24@gmail.com';
		$asunto       = 'Prueba con PHPMailer';
		$mensaje      = 'Hola a todos';
		

		$mail->setFrom ( $destinatario , '<'.$destinatario.'>' ); 
		$mail->AddReplyTo($remitente, '<'.$remitente.'>'); 
		$mail->addAddress ( $destinatario , '<'.$destinatario.'>' ); 
		
		$mail->Subject = $asunto;
		$mail->isHTML(true);

		

		$mail->Body = "<b>".$mensaje."</b>";
		$mail->send(); 
		Echo 'El mensaje ha sido enviado. ' ;

	} 	catch (Exception $e) {
    
    	echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;

	}
	
	

?>