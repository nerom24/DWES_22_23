<?php

    /*
        model.update

    */

    # id del alumno mediante GET
    $id = $_GET['id'];

    # conecto con la base de datos
    $conexion = new Libros();

    # objeto de tipo alumno con los datos del formulario
    $edit_libro = new Libro (

        null,
        $_POST['isbn'],
        null,
        $_POST['titulo'],
        $_POST['autor_id'],
        $_POST['editorial_id'],
        $_POST['precio_coste'],
        $_POST['precio_venta'],
        $_POST['stock'],
        0,
        0,
        $_POST['fecha_edicion']

    );

   # actualizo los detalles del alumno
   $conexion->update($edit_libro, $id);

   

?>