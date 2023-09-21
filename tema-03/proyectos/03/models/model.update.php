<?php

    $articulos = generar_tabla();
    $categorias = generar_tabla_categorias();

    // Extraer índice del artículo que voy a editar
    $indice = $_GET['key'];

    // Extraer los detalles del formulario
    $edit_articulo = [

        'id' => $_POST['id'],
        'Descripción'=>$_POST['descripcion'],
        'Modelo'=>$_POST['modelo'],
        'Categoría'=>$_POST['categoria'] ,
        'Unidades'=> $_POST['unidades'],
        'Precio'=> $_POST['precio']

    ];

    $articulos[$indice] = $edit_articulo;

?>