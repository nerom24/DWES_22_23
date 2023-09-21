<?php

/*  Fichero: funcionesPeliculas.php
    Descripción: Funciones para la gestión completa de una tabla de películas
    Fecha: 22/10/2020
    Autor: Juan Carlos Moreno
*/



    # Generamos el array de categorías
    function getGeneros(){
    
        $generos = [

            "Acción",
            "Aventura",
            "Comedia",
            "Musical",
            "Terror",
            "Bélica",
            "Dramático",
            "Suspense",
            "Histórico",
            "Fantasía"
          ];
      
          return $generos;
    }


    # Generamos la tabla a partir de arrays cuyos índices indican el nombre del campo de una tabla
    function getPeliculas(){
        
        $tabla = 

        [
            
            [ 
              "id" => 1,
              "titulo" => "Joker",
              "director" => "Todd Phillips",
              "nacionalidad" => "Estados Unidos",
              "generos" => [6, 7],
              "año" => 2019
              
            ],
      [ 
              "id" => 2,
              "titulo" => "Mientras dure la guerra",
              "director" => "Alejandro Amenábar",
              "nacionalidad" => "España",
              "generos" => [6, 8],
              "año" => 2019
        ],
            [ 
              "id" => 3,
              "titulo" => "Terminator.Destino oscuro",
              "director" => "Tim Miller",
              "nacionalidad" => "Estados Unidos",
              "generos" => [0, 9],
              "año" => 2019
             
            ],
            [ 
              "id" => 4,
              "titulo" => "La vida es bella",
              "director" => "Roberto Benini",
              "nacionalidad" => "Italia",
              "generos" => [3, 5, 6],
              "año" => 1997
              
            ],
            [ 
                "id" => 5,
                "titulo" => "Interstellar",
                "director" => "Christopher Nolan",
                "nacionalidad" => "Estados Unidos",
                "generos" => [1, 6, 7],
                "año" => 2014
                
              ]
        ];
        return $tabla; 

    }


    # Elimina un elemento del array a partir del índice
    # Reconstruye los índices
    function eliminar($tabla, $indice){

        unset ($tabla[$indice]); 
        $tabla = array_values($tabla); 
        return $tabla; 
    }

    # Añade un elemento al array
    function nuevo($tabla, $registro){
        $tabla[] = $registro;   
        return $tabla;
    }

    # Actualiza los datos de un registro 
    function actualizar($tabla, $registro, $indice){ 
        $tabla[$indice] = $registro;
        return $tabla;
    }


    # Ordena los dato del array asociativo o tabla a partir de alguno de los campos
    function ordenar($tabla, $campo){

        
        # Creo un array auxiliar con los valores del criterio de ordenación
        $aux = array_column($tabla, $campo);

        array_multisort($aux, SORT_ASC, $tabla); 

        return $tabla;
    }


    # Filtra el array a partir de una expresión
    function filtrar($tabla, $expresion){
       
        $aux = []; 

        foreach($tabla as $registro){ 

            if(in_array($expresion, $registro)){
                
                $aux[] = $registro; 
            }
        }

        return (empty($aux)? $tabla: $aux);
    }

    # Devuelve el próximo id 
    function nuevo_id($tabla){
        $ultimo_id = count($tabla) + 1;
        
        return $ultimo_id;
    }

    # Devuelve el array de géneros que le corresponden a una película
    function listaGeneros($generos, $indiceGeneros){
        $aux = [];
        foreach ($indiceGeneros as $genero) {
            $aux[] = $generos[$genero];
        }
        
        return $aux;
    }


?>


