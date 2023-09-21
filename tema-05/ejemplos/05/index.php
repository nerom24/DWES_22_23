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

   // Obtener array indexado
   // $alumno = $alumnos->fetch_array(MYSQLI_NUM);
   // $alumno = $alumnos->fetch_row();

   // Obtener array asociativo
   // $alumno = $alumnos->fetch_array(MYSQLI_ASSOC);
   $alumno = $alumnos->fetch_assoc();


   var_dump($alumno);
   echo "<br>";
   echo 'Array Asociativo';
   echo "<br>";
   echo 'id: '. $alumno['id'];
   echo "<br>";
   echo 'nombre: ' . $alumno['nombre'];

   echo "<br>";
   echo 'Array Indexado';
   echo "<br>";
   echo 'id: '. $alumno[0];
   echo "<br>";
   echo 'nombre: ' . $alumno[1];
   


?>