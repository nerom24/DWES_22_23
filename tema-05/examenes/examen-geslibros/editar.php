<?php

     # Cargamos config
     include('config/config.php');
   
     # Cargamos las clases bbdd
     include("class/class.conexion.php");
     include("class/class.libros.php");
 
     # Modelo
     include("models/model.editar.php");
 
     # Vista
     include("views/view.editar.php");

?>