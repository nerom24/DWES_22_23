<?php

    /*
        Conexión MySQL con la clase mysqli (obsoleta)
        - Mostrar todos los alumnos:
            - id
            - nombre
            - apellidos
            - poblacion
            - nacioanalidad
            - dni
        - Usar array asociativo
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

   // Obtener array indexado
   // $alumno = $alumnos->fetch_array(MYSQLI_NUM);
   // $alumno = $alumnos->fetch_row();

   // Obtener array asociativo
   // $alumno = $alumnos->fetch_array(MYSQLI_ASSOC);
   // $alumno = $alumnos->fetch_assoc();
   
   // $alumnos es un objeto de la clase mysqli_result
   // sin embargo cuando se incluye en un foreach lo considera
   // como un array, además se encarga automáticamente de hacer el fetch
   // que siempre será tipo ASSOC
   foreach ($alumnos as $alumno) {
        echo "<hr>";
        echo "<br>";
        echo 'id: '. $alumno['id'];
        echo "<br>";
        echo 'nombre: ' . $alumno['nombre'];
        echo "<br>";
        echo 'apellidos: ' . $alumno['apellidos'];
        echo "<br>";
        echo 'nacionalidad: ' . $alumno['nacionalidad'];
        echo "<br>";
        echo 'poblacion: ' . $alumno['poblacion'];
        echo "<br>";
        echo 'dni: ' . $alumno['dni'];

   }



   

 
   


?>