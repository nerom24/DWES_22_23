<?php 

    //Perfiles

    /*
        - 1 Administrador
        - 2 Editor
        - 3 Registrado

        En cada privilegio se asignan los perfiles permitidos
       
    */

    $GLOBALS['crear'] = [1, 2];
    $GLOBALS['editar'] = [1, 2];
    $GLOBALS['eliminar'] = [1];
    $GLOBALS['consultar'] = [1, 2, 3];
    $GLOBALS['agregar'] = [1, 2];

    // Consultar incluye: Listar, ordenar, mostrar ficha y buscar


?>