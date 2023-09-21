<?php

    //Clases
    include_once('class/conexion.php');
    include_once('class/cuenta.php');
    include_once('class/conexion_gesbank.php');

    # Obtener id cuenta
    $id_cuenta = $_GET['id'];

    //Creamos la conexión
    $conexion = new Conexion_gesbank();

    //Obtener datos cuenta para mostrar en la vista
    $cuenta = $conexion->getCuenta($id_cuenta);


?>