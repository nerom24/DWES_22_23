<?php

    echo "ERROR: ";
    echo "<hr>";
    echo "Mensaje:         " . $e->getMessage() . "<br>";
    echo "Codigo de error: " . $e->getCode() . "<br>";
    echo "Fichero:         " . $e->getFile() . "<br>";
    echo "Linea:           " . $e->getLine() . "<br>";
    echo "Trace:           " . $e->getTraceAsString() . "<br>";