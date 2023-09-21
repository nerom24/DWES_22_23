<?php

    /*
        Función que calcula la edad a partir de una fecha
    */

    function edad($fecha_nac ) {

        $nace = new DateTime($fecha_nac);
        $ahora = new DateTime('NOW');
        $diferencia = $ahora->diff($nace);

        return $diferencia->y;
        
    }

   




?>