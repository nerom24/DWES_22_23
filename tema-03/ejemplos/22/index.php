<?php

    /*
        Ejemplo 13.

        Array o Matrices

        Matriz bidimensional con:

            - índice primario: asociativo
            - índice secundario: asociativo
    */

    // Usando corchetes
    $paises = 
            [ 
                'España' => [
                            'capital' => 'Madrid',
                            'idioma'  => 'Español',
                            'poblacion' => '40 millones'
                ],
                'Francia' => [
                    'capital' => 'París',
                    'idioma'  => 'Francés',
                    'poblacion' => '67 millones'
                ],
                'Inglaterra' => [
                    'capital' => 'Londres',
                    'idioma'  => 'Inglés',
                    'poblacion' => '56 millones'
                ],

                
            ];

    // muestra un valor de la matriz        
    echo $paises['España'] ['idioma']; 
    echo '<BR>';

    foreach ($paises as $i => $array) {
        foreach ($array as $j => $valor) {
            echo 'matriz['.$i.']['.$j.'] = '.$valor;
            echo '<BR>';
        }
    }

?>