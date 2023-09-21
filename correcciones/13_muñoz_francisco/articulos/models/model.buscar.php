<?php

    $categorias = generar_tabla_categorias();
    $articulos = generar_tabla();

    $expresion = $_GET['expresion'];

    $articulos = filtrar($articulos,$expresion);

?>