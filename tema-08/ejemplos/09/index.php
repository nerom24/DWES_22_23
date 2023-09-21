<?php

   if ($gestor = opendir('archivos')) {

      echo "Gestor del directorio: ". $gestor;
      echo "<br>";

      while ($entrada = readdir($gestor)) {

        echo $entrada;
        echo "<br>";

      }

      closedir($gestor);


   }

?>