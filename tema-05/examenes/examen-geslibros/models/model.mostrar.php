<?php

    /*
        model mostrar

        Mostra los detalles de un registro
    */

    # id del registro que quiero editar
    $id = $_GET['id'];

    # conexion con la base de datos
    $conexion = new Alumnos();

    $alumno = $conexion->readAlumno($id);
    $cursos = $conexion->getCursos();

?>