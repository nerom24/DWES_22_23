<?php

    /*
        Modelo create

        Recibe los valores del formulario nuevo libro
        hay que tener en cuenta que he dejado de utilizar algunos campos
    */

    $nuevo_libro = new Libro (

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

    $conexion = new Libros();
    $conexion->create($nuevo_libro);

?>