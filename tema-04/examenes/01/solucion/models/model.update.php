<?php

    # Creo el objeto de la clase arrayUsuarios
    $usuarios = new arrayUsuarios();

    # Obtengo los perfiles definidos en dicha clase
    $perfiles = $usuarios->getPerfiles();

    # Cargo los datos
    $usuarios->getDatos();

    # Obtener método GET el índice del usuario que quiero editar
    $indice = $_GET['key'];

    # Obtener método POST los valores editados del formulario
    $edit_usuario = new Usuario(
        $_POST['id'],
        $_POST['nombre'],
        $_POST['email'],
        $_POST['password'],
        $_POST['nacionalidad'],
        $_POST['perfiles']
    );

    // uso el método eliminar de la clase arrayUsuarios()
    $usuarios->update($edit_usuario, $indice);

    # Obtengo el array
    $t_usuarios = $usuarios->getArray();

?>