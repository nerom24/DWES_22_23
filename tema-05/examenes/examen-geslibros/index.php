<?php

    # Cargamos config
    include('config/config.php');

    # Cargamos librería
    include('libs/funciones.php');
   
    # Cargamos las clases bbdd
    include("class/class.conexion.php");
    include("class/class.libros.php");

    # Modelo
    include("models/model.index.php");

    # Vista
    include("views/view.index.php");

?>