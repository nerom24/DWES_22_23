<?php

    # Cargamos config
    include('config/config.php');
   
    # Cargamos las clases bbdd
    include("class/class.conexion.php");
    include("class/class.libro.php");
    include("class/class.libros.php");

    # Modelo
    include("models/model.update.php");

    # Cargo index
    header('Location:index.php');

?>