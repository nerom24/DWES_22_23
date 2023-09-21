<?php

    $articulos = generar_tabla();
    $categorias = generar_tabla_categorias();

    // Extraer el indice del articulo que voy a eliminar
    $indice = $_GET['key'];

    //Uso la funciin eliminar de la libreria de funciones
    $articulos = eliminar($articulos, $indice);
    

?>