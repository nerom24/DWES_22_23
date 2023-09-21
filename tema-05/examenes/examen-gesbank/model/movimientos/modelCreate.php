<?php

    //Clases
    include_once('class/conexion.php');
    include_once('class/movimiento.php');
    include_once('class/cuenta.php');
    include_once('class/conexion_gesbank.php');

    //Creamos la conexión
    $conexion = new Conexion_gesbank();

     # Obtener id cuenta
     $id_cuenta = $_GET['id'];

    //Obtengo los datos de la cuenta
    $cuenta = $conexion->getCuenta($id_cuenta);

    //Actualizamos el saldo
    $cantidad = ($_POST['tipo'] == 'R')? - $_POST['cantidad']:$_POST['cantidad'];
    $saldo = $cuenta->saldo + $cantidad;

   //Crear objeto de la clase movimiento
   $movimiento = new Movimiento (
       null,
       $id_cuenta,
       null,
       $_POST['tipo'],
       $_POST['cantidad'],
       $saldo

   );

   //Crear nuevo movimiento
   $conexion->createMovimiento($movimiento);

   //Actualizar cuenta
   $cuenta->fecha_ul_mov = time();
   $cuenta->num_movtos = $cuenta->num_movtos + 1;
   $cuenta->saldo = $saldo;

   $conexion->actualizar_cuenta($cuenta);

?>