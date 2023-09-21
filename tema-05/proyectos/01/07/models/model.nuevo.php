<?php

    /*
        Muestra formulario para crear nuevo alumno

        Necesito obtener los cursos, para crear de forma dinámica
        La lista de cursos
    */

    $conexion = new Alumnos();

    // Obtengo un objeto de la clase pdostatement con los cursos
    $cursos = $conexion->getCursos();
    
?>