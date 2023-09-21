<?php

    /*  
        model.index.php

        Mostrar contenido de la tabla fp.alumnos

        Mostrará la tabla como array de objetos
    */

    $conexion = new Libros();
    $libros = $conexion->getLibros();


?>