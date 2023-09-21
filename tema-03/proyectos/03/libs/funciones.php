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
        Generar la tabla de categorías
    */
    # Genero la tabla de categorías
    function generar_tabla_categorias(){
    
        $Categorias = [
            'Portátiles',
            'PCs sobremesa',
            'Componentes',
            'Pantallas',
            'Impresoras',
            'Tablets',
            'Móviles'
        ];

        return $Categorias;
    }


    /*
        Genera una tabla

            - Salida. Devuelve array con la tabla generada
    */

    function generar_tabla() {

        $tabla = [
        
            [
                'id' => 1,
                'Descripción'=>'Portátil HP MD12345',
                'Modelo'=>'HP 15-1234-20',
                'Categoría'=> [0, 1, 3],
                'Unidades'=> 12,
                'Precio'=> 550.50
            ],
            [
                'id' => 2,
                'Descripción'=>'Tablet - Samsung Galaxy Tab A (2019)',
                'Modelo'=>'Exynos',
                'Categoría'=> [1, 2, 4],
                'Unidades'=> 200,
                'Precio'=> 300
            ],
            [
                'id' => 3,
                'Descripción'=>'Impresora multifunción - HP',
                'Modelo'=>'DeskJet 3762',
                'Categoría'=> [4],
                'Unidades'=> 2000,
                'Precio'=> 69
            ],
            [
                'id' => 4,
                'Descripción'=>'TV LED 40" - Thomson 40FE5606 - Full HD',
                'Modelo'=>'Thomson 40FE5606',
                'Categoría'=> [2, 6],
                'Unidades'=> 300,
                'Precio'=> 259
            ],
            [
                'id' => 5,
                'Descripción'=>'PC Sobremesa - Acer Aspire XC-830',
                'Modelo'=>'Acer Aspire XC-830',
                'Categoría'=> [4, 5],
                'Unidades'=> 20,
                'Precio'=> 329
            ]
    
        ];
    
        return $tabla; 
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
        if  (in_array($expresion, $registro)) {
            
                $aux[] = $registro;
        }
    }

    if (empty($aux)){
        $aux = $tabla;
    }
    
    return ($aux);

}

function listaCategorias($categoriasArticulo=[], $categorias=[]) {

    $arrayCategorias = [];

    foreach($categoriasArticulo as $indiceCategoria) {

        $arrayCategorias[] = $categorias[$indiceCategoria];

    }

    return $arrayCategorias;

}



?>