<?php

    /*
        model.buscar.php

    */
    
    // Escapamos el criterio por seguridad
    $expresion = htmlspecialchars($_GET['expresion']);

    $conexion = new Alumnos();
    $alumnos = $conexion->filtrar($expresion);

?>