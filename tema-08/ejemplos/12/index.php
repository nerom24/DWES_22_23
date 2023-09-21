<?php

   echo 'Directorio Actual: '. dirname(getcwd());
   echo '<br>';
   print_r(pathinfo(getcwd()));


?>