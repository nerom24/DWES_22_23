<?php

    /*
        Modelo create

        Recibe los valores del formulario nuevo alumno
        hay que tener en cuenta que he dejado de utilizar algunos campos
    */

    $nuevo_alumno = new Alumno (

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

    $conexion = new Alumnos();
    $conexion->create($nuevo_alumno);

?>