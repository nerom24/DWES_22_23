<?php

    /*
        model delete

    */

    # id del registro que quiero editar
    $id = $_GET['id'];

    # conexion con la base de datos
    $conexion = new Alumnos();

    $conexion->delete($id);

?>