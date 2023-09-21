<?php

   /*  
        model.ordenar.php

    */

    $criterio = htmlspecialchars($_GET['criterio']);

    $conexion = new Libros();
    $libros = $conexion->order($criterio);
?>