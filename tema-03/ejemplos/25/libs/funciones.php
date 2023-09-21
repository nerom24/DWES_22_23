<?php


    /*

        function ejemplo($param = []) 

    */

    function ejemplo ($param = []) {


        if (array_key_exists('id', $param)) {

            echo 'ID: '. $param['id'];
            echo "<BR>";

        }

        if (array_key_exists('nombre', $param)) {

            echo 'Nombre: '. $param['nombre'];
            echo "<BR>";

        }

        if (array_key_exists('apellidos', $param)) {

            echo 'Apellidos: '. $param['apellidos'];
            echo "<BR>";

        }

        if (array_key_exists('poblacion', $param)) {

            echo 'Población: '. $param['poblacion'];
            echo "<BR>";

        }

        if (array_key_exists('curso', $param)) {

            echo 'Curso: '. $param['curso'];

        }

       


        
        
     
        

    }

?>