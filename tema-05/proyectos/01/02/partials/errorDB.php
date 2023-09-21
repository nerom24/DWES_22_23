<?php
    echo "ERROR BASE DE DATOS: ";
    echo "<HR>";
    echo "Mensaje:      ". $error->getMessage(). '<BR>';
    echo 'Código Error: '. $error->getCode(). '<BR>';
    echo 'Fichero:      '. $error->getFile(). '<BR>';
    echo 'Linea:        '. $error->getLine(). '<BR>';
    echo 'Trace:        '. $error->getTraceAsString(). '<BR>';
  
?>