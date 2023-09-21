<?php

    # Suma los valores del formulario

    
    $num1 = $_POST['valor1'];
    $num2 = $_POST['valor2'];

    $resultado = $num1 + $num2;

    $operacion = "Suma";


    include_once("resultado.php");

?>