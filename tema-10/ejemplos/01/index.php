<?php

    # función mail()
    # documento HTML

    // cabecera
    $header =  "Mime-Versión: 1.0". "\n";
    $header .= "Content-Type: text/html; charset-iso-8859-1"."\n";
    $header .= "From: J. Carlos Moreno <nerom24@hotmail.com>\n"; 
    $header .= "cc: juanito@gmail.com"."\n";
    $header .= "bcc: juangarcia@gmail.com"."\n"; 
    $header .= "X-Mailer: PHP/" . phpversion();

    // Parámetros
    $destino = "pedrorios@gmail.com";
    $asunto = "Prueba email()";
    $mensaje = "<b>Lorem ipsum</b> dolor sit amet, <i>consectetur adipiscing elit. 
    Vivamus consectetur elit eu dui suscipit, eu blandit turpis dapibus. 
    Integer</i> efficitur neque non dui viverra iaculis. Duis cursus enim lobortis 
    malesuada condimentum. Aliquam mollis magna eu ultricies molestie. 
    Ut eget dignissim ex. Fusce tempus egestas dui quis venenatis. 
    Morbi accumsan magna massa, vitae luctus tellus blandit in. Quisque 
    rutrum diam sed nunc suscipit tincidunt. Fusce dolor eros, porttitor 
    eget diam ac, pretium vestibulum est. Morbi in imperdiet augue, id semper
    orci. Proin rutrum tellus iaculis, pretium diam in, porttitor magna. 
    Vivamus eleifend nisi nec suscipit tincidunt. Nunc elementum mattis 
    libero a accumsan.";

    if (mail($destino, $asunto, $mensaje, $header)) {
        echo "Mensaje OK";
    } else {
        echo "Error. Mensaje no enviado";
    }



?>