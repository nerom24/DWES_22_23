<?php

    /*
        model.update

    */

    # id del alumno mediante GET
    $id = $_GET['id'];

    # conecto con la base de datos
    $conexion = new Alumnos();

    # objeto de tipo alumno con los datos del formulario
    $edit_alumno = new Alumno (

        null,
        $_POST['nombre'],
        $_POST['apellidos'],
        $_POST['email'],
        null,
        null,
        $_POST['poblacion'],
        null,
        null, 
        $_POST['dni'],      
        $_POST['fechaNac'],
        $_POST['id_curso']

    );

   # actualizo los detalles del alumno
   $conexion->update($edit_alumno, $id);

   

?>