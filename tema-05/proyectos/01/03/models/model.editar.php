<?php

    /*
        model editar

        obtener los detalles de registro que quiero editar
    */

    # id del registro que quiero editar
    $id = $_GET['id'];

    $conexion = new Alumnos();
    $alumno = $conexion->readAlumno($id);

    var_dump($alumno);
    exit();

?>