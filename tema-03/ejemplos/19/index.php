<?php

    /*
        Ejemplo 13.

        Array o Matrices

        Matriz bidimensional con índices escalares
    */

    // Usando corchetes
    $matriz = 
            [ 
                [4, 4, 1, 6, 7, 2],
                [4, 5, 1, 6, 7, 0],
                [1, 4, 1, 9, 7, 10],
                [4, 4, 1, 6, 7, 11],
                [9, 4, 1, 3, 4, 6],

            ];

    // muestra un valor de la matriz        
    echo $matriz[3] [1]; 
    echo '<BR>';

    foreach ($matriz as $i => $array) {
        foreach ($array as $j => $valor) {
            echo 'matriz['.$i.']['.$j.'] = '.$valor;
            echo '<BR>';
        }
    }

?>