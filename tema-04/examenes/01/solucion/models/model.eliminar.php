<?php

    # Creo el objeto de la clase arrayUsuarios
    $usuarios = new arrayUsuarios();

    # Obtengo los perfiles definidos en dicha clase
    $perfiles = $usuarios->getPerfiles();

    # Cargo los datos
    $usuarios->getDatos();

    # Obtener método GET el índice del usuario que quiero eliminar
    $indice = $_GET['key'];

    // uso el método eliminar de la clase arrayUsuarios()
    $usuarios->delete($indice);

    # Obtengo el array
    $t_usuarios = $usuarios->getArray();
    

?>