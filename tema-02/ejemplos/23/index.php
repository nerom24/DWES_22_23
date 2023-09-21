<?php 

    /*
        Conversión de tipos de datos

        array
    */

    

    $var1 = 23;


    $var2 = (array) ($var1);
    
    var_dump($var2);

    $var2[1] = "carlos";

    echo "<BR>";
    var_dump($var2);

    echo "<BR>";

    print_r($var2);






?> 