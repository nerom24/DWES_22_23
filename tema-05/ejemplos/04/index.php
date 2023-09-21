<?php

    /*
        Conexión MySQL con la clase mysqli (obsoleta)
    */

    // 127.0.0.1
    $server = 'localhost';
    $usuario = 'root';
    $password = '';
    $bd = 'fp';

    $conexion = new mysqli($server, $usuario, $password, $bd);

    if ($conexion->connect_errno) {
        echo "Número de error: ";
        echo $conexion->connect_errno;
        echo "<br>";
        echo "Mensaje del error: ";
        echo $conexion->connect_error;
        echo "<br>";
        exit();
    }

    echo 'Conexión realizada con éxito';

    $sql = "select * from alumnos order by id";

    // objeto de la clase mysqli_result
   $alumnos = $conexion->query($sql);

   echo "<br>";
   echo "Número de filas: ";
   echo $alumnos->num_rows;
   
   echo "<br>";
   echo "Número de columnas: ";
   echo $alumnos->field_count;


?>