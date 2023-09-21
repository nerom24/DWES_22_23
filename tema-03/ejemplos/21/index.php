<?php

    /*
        Ejemplo 13.

        Array o Matrices

        Matriz bidimensional con:

            - índice primario: asociativo
            - índice secundario: escalar
    */

    // Usando corchetes
    $valores = 
            [ 
                'id' => [3, 4, 5],
                'nombre' => ['Juan', 'Pedro', 'María'],
                'apellido' => ['García Moreno', 'Romero Pérez', 'Gutiérrez'],
                'edad' => [20, 54, 34],
                'poblacion' => ['Ubrique', 'Villamartín', 'Puerto Serrano']
                
            ];

    // muestra un valor de la matriz        
    echo $valores['nombre'] [2]; 
    echo '<BR>';

    foreach ($valores as $i => $array) {
        foreach ($array as $j => $valor) {
            echo 'matriz['.$i.']['.$j.'] = '.$valor;
            echo '<BR>';
        }
    }

?>