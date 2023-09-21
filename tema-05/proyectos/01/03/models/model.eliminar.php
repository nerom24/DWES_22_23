<?php

    $articulos = generar_tabla();
    $categorias = generar_tabla_categorias();

    // Extraer índice del artículo que voy a eliminar
    $indice = $_GET['key'];

    // uso la función eliminar de la librería de funciones
    $articulos = eliminar($articulos, $indice);

?>