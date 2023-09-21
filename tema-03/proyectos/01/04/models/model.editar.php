<?php
    /*

    EDITAR.PHP

        - Modifica los datos de un libro
        - Recibo por GET indice del libro a editar

    */

    # editar.php?key=$indice

    $indice = $_GET['key'];

    # Cargar la tabla de libros
    $libros = generar_Tabla();

    # Crear el registro que vamos a editar
    $libro = $libros[$indice];
    
?>