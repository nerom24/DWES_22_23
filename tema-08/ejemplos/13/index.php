<?php

    # Exportación CSV

    // Generar un fichero CSV con todos los alumnos de la base de datos
    // fp
    // Columnas exportación: nombre, apellidos, email, telefono, dni, fechaNac

    include_once('config/config.php');

    // Acceder a la base de datos para obtener las columnas indicadas de todos los
    // alumnos

    include_once('models/alumnosModel.php');

    $alumnos = get();

    $csv = fopen("csv/alumnos.csv", "ab");

    foreach($alumnos as $alumno) {
        fputcsv($csv, $alumno, ';' );
    }

    fclose($csv);

    echo "Archivo Alumnos exportado correctamente";



?>