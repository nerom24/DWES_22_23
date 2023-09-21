<?php

    /*
        Ejemplo 13.

        Array o Matrices

        Array con índice asociativo mediante corchetes
    */

    // Usando corchetes
    $alumno = 
            [ 
                    'id' => 1,
                    'nombre' => 'Juan',
                    'apellidos' => 'García Pérez',
                    'fecha' => '2000/12/31',
                    'curso' => '2DAW',
                    'poblacion' => 'Ubrique'
            ];

    echo $alumno['apellidos']; 
    echo '<BR>';

    foreach ($alumno as $i => $valor) {
        echo 'alumno['.$i.'] = '.$valor;
        echo '<BR>';
    }

?>