<?php 
echo 'Direcotiro Actual: '. chdir('raiz');
echo '<br>';
echo 'Diectorio Actual: ' . getcwd(); 
echo '<br>';
echo 'Cambio Imagenes'. chdir('imagenes');
echo '<br>';
echo 'Diectorio Actual: ' . getcwd();
echo '<br>';
echo 'Directorio Padre:' . dirname(getcwd());
echo '<br>';
echo 'Cambio Padre:' . chdir(dirname(getcwd()));
echo '<br>';
echo 'Diectorio Actual: ' . basename(getcwd());
?>