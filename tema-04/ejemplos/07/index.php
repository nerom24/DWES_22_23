<?php

   include("class/class.libro.php");
   include("class/class.enciclopedia.php");

   // Creo el objeto coche a partir de la clase Vehiculo

   
   $libro1 = new Libro('23', '500 días', 'Pérez Reverte', 'Novela');

   var_dump($libro1);

   $enciclopedia1 = new Enciclopedia(
                    '12', 
                    'Datos', 
                    'María', 
                    'Aventuras',
                    '10',
                    '2015',
                    'Alfaguara'
                  );

  

  $enciclopedia1->CambiarTitulo('El quijote');

  var_dump($enciclopedia1);

?>