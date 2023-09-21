<?php

    /*
        Muestra formulario para crear nuevo libro

        Necesito obtener las editoriales y los autores para generación dinámica del combox 
        para autores y editoriales
    */

    $conexion = new Libros();

    // Obtengo un objeto de la clase pdostatement con los autores
    $autores = $conexion->getAutores();
    // Obtengo un objeto de la clase pdostatement con las editoriales
    $editoriales = $conexion->getEditoriales();
    
?>