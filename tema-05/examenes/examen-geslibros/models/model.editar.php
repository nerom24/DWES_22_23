<?php

    /*
        model editar

        obtener los detalles de registro que quiero editar
    */

    # id del registro que quiero editar
    $id = $_GET['id'];

    $conexion = new Libros();
    $autores = $conexion->getAutores();
    $editoriales = $conexion->getEditoriales();
    
    # obtener los detalles del libro
    $libro = $conexion->readLibro($id);

?>