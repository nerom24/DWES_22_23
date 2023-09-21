<?php

    $articulos = generar_tabla();
    $categorias = generar_tabla_categorias();

    // Extraer índice del artículo que voy a editar
    $indice = $_GET['key'];

    // obtengo el array correspondiente a ese artículo
    $articulo = $articulos[$indice];

?>