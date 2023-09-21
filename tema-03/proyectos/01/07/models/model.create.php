<?php

    /*

        Mediante método POST recibe los detallas del nuevo libro
        y añade el libro a la tabla mediante la función nuevo().

    */

    // Debemos generar nuevamente la tabla
    $libros = generar_tabla();

    // Recibo los detalles del libro
    $libro = 

        [
            'Id' => $_POST['id'],
            'Título' => $_POST['titulo'],
            'Autor' => $_POST['autor'],
            'Género' => $_POST['genero'],
            'Precio' => $_POST['precio']
        ];

    $libros = nuevo($libros, $libro);

    // $libros[] = $libro;

?>