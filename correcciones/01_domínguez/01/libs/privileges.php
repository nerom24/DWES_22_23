<?php

    /* Perfiles
        1. Administrador
        2. Editor
        3. Registrado

        Se define variables globales con los perfiles permitidos en cada provilegio
    */

    $GLOBALS['crear'] = [1, 2];
    $GLOBALS['editar'] = [1, 2];
    $GLOBALS['eliminar'] = [1];
    $GLOBALS['mostrar'] = [1, 2, 3];
    $GLOBALS['buscar'] = [1, 2, 3];
    $GLOBALS['ordenar'] = [1, 2, 3];
    $GLOBALS['admin'] = [1];

?>
