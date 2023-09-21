<?php

    $categorias = generar_tabla_categorias();
    $articulos = generar_tabla();

    $criterio = $_GET['criterio'];

    $articulos = ordenar($articulos, $criterio);

?>