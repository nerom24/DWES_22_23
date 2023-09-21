<?php

    /** Fichero: eliminarModel.php
    *   Descripción: Elimina un registro de la tabla
    *   $_GET: indice - elemento que deseamos eliminar
	**/

    # Recibo indice del elemento mediante la url
    # eliminar.php?indice=xx
    $indice = $_GET['indice'];

    # Cargo el array de géneros
    $generos = getGeneros();
    
    # Cargo las películas
    $peliculas = getPeliculas();

    # Elimino el registro
    $peliculas = eliminar($peliculas, $indice);
    
?>