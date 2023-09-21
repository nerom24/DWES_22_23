<?php

    /*
        model.buscar.php

    */
    
    // Escapamos el criterio por seguridad
    $expresion = htmlspecialchars($_GET['expresion']);

    $conexion = new Libros();
    $libros = $conexion->filtrar($expresion);

?>