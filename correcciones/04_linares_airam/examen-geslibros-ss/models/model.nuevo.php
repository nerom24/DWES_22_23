<?php

    /*
        Muestra formulario para crear nuevo alumno

        Necesito obtener los cursos, para crear de forma dinámica
        La lista de cursos
    */

    $conexion = new Libros();

    // Obtengo un objeto de la clase pdostatement con los cursos
    $autores = $conexion->getCursos();
    $editoriales = $conexion->getEditoriales();
    
?>