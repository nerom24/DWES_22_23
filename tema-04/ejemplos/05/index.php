<?php

   include("class/class.libro.php");

   // Creo el objeto coche a partir de la clase Vehiculo

   
   $libro1 = new Libro('23', '500 días', 'Pérez Reverte', 'Novela');

   var_dump($libro1);

   $libro2 = new Libro();

  $libro2->id = 1;
  
  # En caso de usar propiedad de encapsulamiento
  // $libro2->setId('1');
  
  $libro2->titulo = 'La luz blanca';
  $libro2->autor = 'Romerito';
  $libro2->genero = 'Drama';

  var_dump($libro2);

?>