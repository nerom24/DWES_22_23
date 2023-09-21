<?php

    # Creo el objeto de la clase arrayUsuarios
    $usuarios = new arrayUsuarios();

    # Obtengo los perfiles definidos en dicha clase
    $perfiles = $usuarios->getPerfiles();

    # Cargo los datos
    $usuarios->getDatos();

    # Obtener método GET el índice del usuario que quiero editar
    $indice = $_GET['key'];

    // Obtengo el objeto usuario a partir de ese índice
    $usuario = $usuarios->read($indice);
    

?>