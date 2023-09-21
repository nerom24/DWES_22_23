<?php

    # Cargamos config
    include('config/config.php');
   
    # Cargamos las clases bbdd
    include("class/class.conexion.php");
    include("class/class.alumnos.php");

    # Modelo
    include("models/model.delete.php");

   # Cargo index
   header('Location:index.php');

?>