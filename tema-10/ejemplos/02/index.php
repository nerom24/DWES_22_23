<?php

    # Documento texto plano

    $para = "destinatario@example.com";
    $asunto = "Prueba de correo electrónico";
    $mensaje = "Hola, este es un correo electrónico de prueba.";

    // Cabeceras del correo electrónico
    $cabeceras = "From: remitente@example.com\r\n";
    $cabeceras .= "Reply-To: remitente@example.com\r\n";
    $cabeceras .= "X-Mailer: PHP/" . phpversion();

    // Enviar el correo electrónico
    if (mail($para, $asunto, $mensaje, $cabeceras)) {
        echo "El correo electrónico se ha enviado correctamente.";
    } else {
        echo "Ha habido un error al enviar el correo electrónico.";
    }

?>




