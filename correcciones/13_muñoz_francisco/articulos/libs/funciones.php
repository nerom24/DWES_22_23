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
        Generar la tabla de categorias
    */

    function generar_tabla_categorias() {

        $categorias = [
    
          "Portátil",
          "PC sobremesa",
          "Pantalla",
          "Componente",
          "Impresora"
          
        ];
    
        return $categorias;
    
     }

    /*
        Genera una tabla

            - Salida. Devuelve array con la tabla generada
    */

    function generar_tabla() {

        $tabla = [
            
            [ 
            "id" => 1,
            "Descripcion" => "Portátil blanco",
            "Modelo" => "HP 720i",
            "Categoria" => 0,
            "Unidades" => 100,
            "Precio" => 412.89
            ],
            [ 
            "id" => 2,
            "Descripcion" => "Portátil negro",
            "Modelo" => "Legion 40",
            "Categoria" => 0,
            "Unidades" => 150,
            "Precio" => 899.00
            ],
            [ 
            "id" => 3,
            "Descripcion" => "PC sobremesa",
            "Modelo" => "Torrent MSI",
            "Categoria" => 1,
            "Unidades" => 200,
            "Precio" => 989.00
            ],
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