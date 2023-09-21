<?php

    /* 
        Devolver el item de una calificación
            - Insuficiente, Suficiente, Bien, Notable y Sobresaliente 

        switch
    */

    $nota = 7;

    switch (true) {
    case ($nota < 5): 
        $item = "Insuficiente";
        break;
    case ($nota < 6): 
        $item = "Suficiente";
        break;
    case ($nota < 7):
        $item = "Bien";
        break;
    case ($nota < 9):
        $item = "Notable";
        break;
    default:
        $tiem = "Sobresaliente";
    }

    echo $item;

?>