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

    $sql = "update alumnos set telefono = '956787464' where id = 1";

    // objeto de la clase mysqli_result
   $conexion->query($sql);

?>