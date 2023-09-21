<?php

    /*

    updateModel.PHP

        - Actualiza los datos de una película
        - Recibo por GET indice de la película que deseo actualizar
        - Recibo por POST los datos de la pelicula actualizada

    */

    # URL - GET
    # update?indice=$key

    $indice = $_GET['indice'];

    # Método POST
    $pelicula = [ 

        'id' => $_POST['id'],
        'titulo' => $_POST['titulo'],
        'director' => $_POST['director'],
        'nacionalidad' => $_POST['nacionalidad'],
        'generos' => $_POST['generos'],
        'año' => $_POST['año']
        
    ];

    # Cargar la tabla de generos
    $generos = getGeneros();
    
    # Cargar la tabla de peliculas
    $peliculas = getPeliculas();

    # Actualizar la tabla
    $peliculas[$indice] = $pelicula;

    
    

?>