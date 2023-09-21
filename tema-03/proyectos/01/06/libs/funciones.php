<?php

    /*
        Function: eliminar()
        Descripción: Elimina elemento de la tabla
        Entrada:
                - tabla
                - indice
        Salida:
                - tabla actualizada
    */
    function eliminar( $tabla=[], $indice ) {

        # Eliminar elemento de la tabla
        unset($tabla[$indice]);
    
        # reconstruye los índices primarios de la tabla
        $tabla = array_values($tabla);

        return $tabla;
    }

    /*
        Genera una tabla

            - Salida. Devuelve array con la tabla generada
    */

    function generar_tabla() {

        $libros = [

            [
                'Id' => 1,
                'Título' => 'Los señores del Tiempo',
                'Autor' => 'Gracía Zend de Urturi',
                'Género' => 'Novela',
                'Precio' => 18.50
            ],
    
            [
                'Id' => 2,
                'Título' => 'El Rey Recibe',
                'Autor' => 'Eduardo Mendoza',
                'Género' => 'Novela',
                'Precio' => 20.50
            ],
    
            [
                'Id' => 3,
                'Título' => 'Diario de una Mujer',
                'Autor' => 'Eduardo Mendoza',
                'Género' => 'Juvenil',
                'Precio' => 12.95
            ],
            [
                'Id' => 4,
                'Título' => 'El Quijote de la Mancha',
                'Autor' => 'Miguel de Cervantes',
                'Género' => 'Novela',
                'Precio' => 15.95
            ],
            [
                'Id' => 5,
                'Título' => 'La Playa Infinita',
                'Autor' => 'Antonio Iturbe',
                'Género' => 'Historia',
                'Precio' => 9.70
            ],
            [
                'Id' => 6,
                'Título' => 'Las Voces',
                'Autor' => 'Muriel Spark',
                'Género' => 'Ciencia',
                'Precio' => 19.95
            ],
            [
                'Id' => 7,
                'Título' => 'La Historia interminable',
                'Autor' => 'Mikel End',
                'Género' => 'Ficción',
                'Precio' => 30.95
            ]
    
            ];
        
        return $libros;

    }

    /*
    Function: nuevo()
    Descripción: Añade un nuevo elemento a la tabla
    Entrada:
            - tabla (array)
            - nuevo registro de la tabla (array indexado)
    Salida:
            - tabla actualizada
    */
    function nuevo($tabla, $registro) {

        $tabla[] = $registro;
        return $tabla;

    }

    /*
    Function: read()
    Descripción: Obtiene un libro a partir del índice
    Entrada:
            - tabla (array)
            - indice
    Salida:
            - registro
    */
    function read($tabla, $indice) {

        $registro = $tabla[$indice];
        return $registro;

    }

    /*
    Function: update()
    Descripción: Actualiza los datos de un libro
    Entrada:
            - tabla (array)
            - registro
            - indice
    Salida:
            - tabla actualizada
    */
    function update($tabla, $registro, $indice) {

        $tabla[$indice] = $registro;
        return $tabla;

    }

    /*
    Function: ordenar()
    Descripción: Ordena la tabla por alguno de los campos
    Entrada:
            - tabla (array)
            - criterio de ordenación
    Salida:
            - tabla ordenada
*/
function ordenar($tabla, $criterio) {

    # Crea un array con los valores del campo 
    # por el que quiero ordenar
    
    // foreach ($tabla as $key => $registro) {
    //     $aux[$key] = $registro[$criterio];
    // }

    $aux = array_column($tabla, $criterio);


    array_multisort($aux, SORT_ASC, $tabla);

    return ($tabla);

}

/*
    Function: filtrar()
    Descripción: filtra la tabla a partir de una expresión de búsqueda
    Entrada:
            - tabla (array)
            - criterio de búsqueda
    Salida:
            - tabla filtrada
*/
function filtrar($tabla, $expresion) {

    # Recorro la tabla libros
    # Busco la expresión en cada registro mediante la función in_array()
    
    $aux=[];

    foreach ($tabla as $registro) {
        if (in_array($expresion, $registro)) {
            $aux[] = $registro;
        }
    }

    if (empty($aux)){
        $aux = $tabla;
    }
    return ($aux);

}



?>