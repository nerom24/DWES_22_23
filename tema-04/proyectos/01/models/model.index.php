<?php

    # Creo el objeto de la clase arrayUsuarios
    $usuarios = new arrayUsuarios();

    # Obtengo los perfiles definidos en dicha clase
    $perfiles = $usuarios->getPerfiles();

    # Cargo los datos
    $usuarios->getDatos();

    # Obtengo la tabla de usuarios mediante método getArray()
    $t_usuarios = $usuarios->getArray();

?>