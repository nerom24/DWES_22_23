<?php

   include("class/clase.vehiculo.php");

   // Creo el objeto coche a partir de la clase Vehiculo

   $coche = new Vehiculo();

   var_dump($coche);


   $coche->setModelo('Fiat 600');
   $coche->setMatricula('HCR 0001');
   $coche->setVelocidad(0);

   var_dump($coche);

   echo "<BR>";
   echo 'Modelo: '. $coche->getModelo();
   echo "<BR>";
   echo 'Matricula: '. $coche->getMatricula();
   echo "<BR>";
   echo 'Velocidad: '. $coche->getVelocidad();

?>