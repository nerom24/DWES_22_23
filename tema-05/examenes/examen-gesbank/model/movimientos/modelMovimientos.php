<?php

    //Clases
    include_once('class/conexion.php');
    include_once('class/conexion_gesbank.php');

    # Obtener id cuenta
    $id_cuenta = $_GET['id'];

    //Creamos la conexión
    $conexion = new Conexion_gesbank();

    //Obtener corredores
    $movimientos = $conexion->getMovimientos($id_cuenta);


?>