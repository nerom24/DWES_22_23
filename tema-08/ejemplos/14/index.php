<?php

    # Importación CSV

    

    include_once('config/config.php');

    // Acceder a la base de datos para obtener las columnas indicadas de todos los
    // alumnos

    include_once('models/alumnosModel.php');

    // abro el archivo para sólo lectura
    $csv = fopen("csv/alumnos.csv", "r");

    while ($alumno = fgetcsv($csv, 150, ";")) {

        # Insertar alumno
        insertar_csv($alumno);

    }

    fclose($csv);

    echo "Archivo Importado Correctamente";





?>