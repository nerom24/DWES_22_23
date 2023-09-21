<?php

    /*
        Ejemplo 13.

        Array o Matrices

        Tipo Escalar. Sólo un índice numérico
    */

    // Usando el constructor arra()
    $numeros = array(1, 9, 20, 40, 91);

    echo $numeros[0]; 
    echo '<BR>';

    foreach ($numeros as $i => $valor) {
        echo $valor;
        echo '<BR>';
    }

?>