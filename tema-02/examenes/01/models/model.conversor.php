<?php

    /*
        Conversor model
    */

    $num = $_POST['numero'];
    $base = (int) $_POST['base'];
    $base_convert= (int) $_POST['base_convert'];
    $num_convert = base_convert($num, $base, $base_convert);

?>