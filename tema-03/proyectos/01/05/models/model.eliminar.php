<?php

    /*

        Mediante método GET recibo el índice de la tabla
        que voy a elimnar

    */

    $libros = generar_tabla();

    $indice = $_GET['key'];
    $libros = eliminar($libros, $indice);

?>