<?php

    /*  
        model.index.php

        Mostrar contenido de la tabla fp.alumnos

        Mostrará la tabla como array de objetos
    */

    $conexion = new Alumnos();
    $alumnos = $conexion->getAlumnos();


?>