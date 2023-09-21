<?php

    /*

    ejemplo 1
    
    ejemplo archivos texto planos - apertura - escritura y cierre

    */

    # apertura
    $file = fopen('ejemplo.txt', 'w');

    # escritura
    fwrite($file, 'Mi primer');

    # cierre
    fclose($file);

?>