<?php

   /*  
        model.ordenar.php

    */

    $criterio = htmlspecialchars($_GET['criterio']);

    $conexion = new Alumnos();
    $alumnos = $conexion->order($criterio);
?>