<?php

    /*

    buscar.php

        - Realiza la búsqueda de la expresión en la tabla libros
        - Recibo por GET criterio búsqueda
      

    */

    # Recibo formulario tipo GET
    # la variable exprsion
    $expresion = $_GET['expresion'];

    # Cargar la tabla de libros
    $libros = generar_Tabla();

    # Filtro la tabla
    $libros = filtrar($libros, $expresion);
    
?>