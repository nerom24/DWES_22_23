<?php
 

    

    /*
        funcion que calcula la edad
    */

    function edad($fechaNac) {

        $fecha_nac = new DateTime($fechaNac); // Creo un objeto DateTime de la fecha ingresada
        $fecha_actual =  new DateTime("NOW"); // Creo un objeto DateTime de la fecha de hoy
        $edad = $fecha_nac->diff($fecha_actual);
        
        // La funcion ayuda a calcular la diferencia, esto seria un objeto
        return $edad->y;

    }

    
    

?>