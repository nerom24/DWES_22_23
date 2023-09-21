<?php

    if ($a = fopen('datos.txt', 'w+')) {

        # Escribir en el archivo
        fwrite($a, "Nombre: Juan Carlos\n");
        fwrite($a, "Apellidos: Moreno Jiménez\n");
        fwrite($a, "Profesor: DAW\n");

        fclose($a);

        echo "archivo creado correctamente";

    } else {
        echo "error: no se ha podido abrir el archivo";
    }
    


?>