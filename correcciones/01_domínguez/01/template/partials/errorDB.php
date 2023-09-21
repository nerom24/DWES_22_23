<?php
    echo "ERROR DE BASE DE DATOS: ";
    echo "<HR>";
    echo "Mensaje:         ". $error->getMessage(). '<br>';
    echo "Código Error:     " . $error->getCode(). '<br>';
    echo "Fichero:      " . $error->getFile(). '<br>';
    echo "Linea:      " . $error->getLine(). '<br>';
    echo "Trace:      " . $error->getTraceAsString(). '<br>';

?>