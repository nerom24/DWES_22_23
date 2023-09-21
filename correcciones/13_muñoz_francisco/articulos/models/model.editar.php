<?php

    $articulos = generar_tabla();
    $categorias = generar_tabla_categorias();

    // Extraer el indice del articulo que voy a editar
    $indice = $_GET['key'];

    //Obetengo el array correspondiente a ese articulo
    $articulo = $articulos[$indice];
    

?>