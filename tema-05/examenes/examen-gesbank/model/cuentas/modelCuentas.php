<?php

    //Clases
    include_once('class/conexion.php');
    include_once('class/cuenta.php');
    include_once('class/conexion_gesbank.php');

    //Creamos la conexión
    $conexion = new Conexion_gesbank();

    //Obtener corredores
    $cuentas = $conexion->getCuentas();


?>