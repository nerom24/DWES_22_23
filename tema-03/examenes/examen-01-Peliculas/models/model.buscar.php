<?php

    /*

    buscarModel.php

        - Realiza la búsqueda de la expresión en la tabla libros
        - Recibo por GET criterio búsqueda
      

    */

    # Recibo formulario tipo GET
    # la variable exprsion
    $expresion = $_GET['expresion'];

    # Cargar array de generos
    $generos = getGeneros();

    # Cargar la tabla de libros
    $peliculas = getPeliculas();

    # Filtro la tabla
    $peliculas = filtrar($peliculas, $expresion);
    
?>