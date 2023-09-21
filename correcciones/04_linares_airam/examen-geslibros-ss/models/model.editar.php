<?php

    /*
        model editar

        obtener los detalles de registro que quiero editar
    */

    # id del registro que quiero editar
    $id = $_GET['id'];

    $conexion = new Libros();
    $libro = $conexion->readLibro($id);
    $editoriales = $conexion->getEditoriales();
    $autores = $conexion->getCursos();

?>