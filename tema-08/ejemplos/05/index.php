<?php

    $a = fopen("datos.txt", "r");

    while(!feof($a)) {

        echo fgets($a);
        echo "<BR>";

    }

    fclose($a);

?>