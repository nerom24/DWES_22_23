<?php

    /*
        Ejemplo 13.

        Array o Matrices

        Tipo Escalar. Sólo un índice numérico
    */

    // Usando corchetes
    $numeros = [
                    1, 
                    9, 
                    20, 
                    40, 
                    91, 
                    12, 
                    40
                ];

    echo implode($numeros);

    $numeros[] =12;

    print_r($numeros);


?>