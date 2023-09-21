<?php

    $usuarios = new arrayUsuarios();
    $usuarios->getDatos();
    $perfiles = $usuarios->getPerfiles();

    $new_usuario = new Usuario(
        $_POST['id'],
        $_POST['nombre'],
        $_POST['email'],
        $_POST['password'],
        $_POST['nacionalidad'],
        $_POST['perfiles']
    );

    // Añado nuevo usuario

    $usuarios->create($new_usuario);
    $t_usuarios = $usuarios->getArray();


?>