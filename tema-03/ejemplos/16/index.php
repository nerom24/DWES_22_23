<?php

    /*
        Ejemplo 13.

        Array o Matrices

        Tipo Escalar. Sólo un índice numérico
    */

    // Usando corchetes
    $alumno = [
                    1, 
                    'Pedro', 
                    'García Morales', 
                    '2000/12/31', 
                    '1DAW', 
                    22, 
                    1
                ];

    echo $alumno[4]; 
    echo '<BR>';

    foreach ($alumno as $i => $valor) {
        echo 'alumno['.$i.'] = '.$valor;
        echo '<BR>';
    }

?>