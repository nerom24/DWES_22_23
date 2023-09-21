<?php

    require_once("libs/funcione.php");


    $id = 1;
    $nombre = 'Juan';
    $apellidos = 'Pérez Romero';
    $poblacion = 'Prado del Rey';
    $curso = '2DAW';

    ejemplo ([
                'id' => $id, 
                'nombre' => $nombre,
                'apellidos' => $apellidos, 
                
                'poblacion' => $poblacion,
                'curso' => $curso
    ]);



?>