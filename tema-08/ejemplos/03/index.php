<?php

$a = file_get_contents('datos.txt');

echo $a;

file_put_contents("datos.txt", 'Hola estos son mis datos de contacto');
$a = file_get_contents('datos.txt');

echo $a;

?>