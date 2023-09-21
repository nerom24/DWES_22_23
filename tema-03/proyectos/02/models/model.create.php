<?php

    $articulos = generar_tabla();
    $categorias = generar_tabla_categorias();

    $new_articulo = [

        'id' => $_POST['id'],
        'Descripción'=>$_POST['descripcion'],
        'Modelo'=>$_POST['modelo'],
        'Categoría'=>$_POST['categoria'] ,
        'Unidades'=> $_POST['unidades'],
        'Precio'=> $_POST['precio']

    ];

    // $articulos = nuevo($articulos, $new_articulo);

    $articulos[] = $new_articulo;

?>