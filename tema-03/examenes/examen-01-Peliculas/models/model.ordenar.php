<?php

    /*

    ordenarModel.PHP

        - Ordena la tabla de películas
        - Recibo por GET criterio de ordenación:
          Id, Título, ...

    */

    # URL - GET
    # ordenar?criterio=campo
    $criterio = $_GET['criterio'];

    # Cargar array de generos
    $generos = getGeneros();

    # Cargar la tabla de peliculas
    $peliculas = getPeliculas();

    # Ordenar Tabla
    $peliculas = ordenar($peliculas, $criterio);
    

?>