<?php
function edad($fechaNac)
{
    $fechaNacimiento=new DateTime($fechaNac);
    $hoy=new DateTime();
    $edad=$hoy->diff($fechaNacimiento)->y;
    return $edad;
}

?>