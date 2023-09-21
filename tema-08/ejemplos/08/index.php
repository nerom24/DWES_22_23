<?php

   echo "Directorio Actual: ". getcwd();
   echo "<br>";

   // chdir('archivos');
   echo "Directorio Actual: ". getcwd();

   // $contenido = scandir('archivos', 0);

   // print_r($contenido);

    # Cambio carpeta raiz
  chroot('C:\xampp\htdocs\dwes\curso22-23\tema-08\ejemplos\08\archivos');
?>