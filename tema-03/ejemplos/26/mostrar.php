<?php

    /*
        Pasar parámetros GET a un archivo PHP a través de la 
        URL

    */

    $libros = [

        [
            'Id' => 1,
            'Título' => 'Los señores del Tiempo',
            'Autor' => 'Gracía Zend de Urturi',
            'Género' => 'Novela',
            'Precio' => 18.50
        ],

        [
            'Id' => 2,
            'Título' => 'El Rey Recibe',
            'Autor' => 'Eduardo Mendoza',
            'Género' => 'Novela',
            'Precio' => 20.50
        ],

        [
            'Id' => 3,
            'Título' => 'Diario de una Mujer',
            'Autor' => 'Eduardo Mendoza',
            'Género' => 'Juvenil',
            'Precio' => 12.95
        ],
        [
            'Id' => 4,
            'Título' => 'El Quijote de la Mancha',
            'Autor' => 'Miguel de Cervantes',
            'Género' => 'Novela',
            'Precio' => 15.95
        ],
        [
            'Id' => 5,
            'Título' => 'La Playa Infinita',
            'Autor' => 'Antonio Iturbe',
            'Género' => 'Historia',
            'Precio' => 9.70
        ],
        [
            'Id' => 6,
            'Título' => 'Las Voces',
            'Autor' => 'Muriel Spark',
            'Género' => 'Ciencia',
            'Precio' => 19.95
        ],
        [
            'Id' => 7,
            'Título' => 'La Historia interminable',
            'Autor' => 'Mikel End',
            'Género' => 'Ficción',
            'Precio' => 30.95
        ]

        ];

        $indice = $_GET['key'];

        print_r($libros[$indice]);

?>