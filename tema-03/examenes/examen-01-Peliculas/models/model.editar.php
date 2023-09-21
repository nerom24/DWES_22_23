<?php

    /*

    editarModel.PHP

        - Carga los datos
        - Recibo por GET indice de la película que se desea editar

    */

    # editar?indice=$key
    $indice = $_GET['indice'];

    # Cargar el array de géneros
    $generos = getGeneros();
    
    # Cargar la tabla películas
    $peliculas = getPeliculas();

    # Crear el registro que vamos a editar
    $pelicula = $peliculas[$indice];
    
    

?>