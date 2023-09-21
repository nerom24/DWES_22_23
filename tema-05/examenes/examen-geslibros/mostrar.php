<?php

    # Cargamos config
    include('config/config.php');
   
    # Cargamos las clases bbdd
    include("class/class.conexion.php");
    include("class/class.alumnos.php");

    # Modelo
    include("models/model.mostrar.php");

    # Vista
    include("views/view.mostrar.php");

?>