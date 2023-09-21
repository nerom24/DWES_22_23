<?php

    # Suma los valores del formulario

    
    $num1 = $_POST['valor1'];
    $num2 = $_POST['valor2'];

    $resultado = $num1 / $num2;

    $operacion = "Divide";

    include_once("resultado.php");

?>