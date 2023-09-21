<?php

    if (is_file('datos.txt')) {
        echo 'Es un fichero';
        echo '<br>';
        echo 'Tamaño fichero: '. filesize('datos.txt'). ' B';
    }

    echo '<br>';

    if (is_dir('archivos')) {
        echo 'Es una carpeta';
    }

    

?>