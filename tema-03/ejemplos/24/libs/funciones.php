<?php

    /*

        Nombre: Función sumar(x, y)

        Descripción: suma dos números
        Argumentos: valor 1 y valor2
        Return: devuelve el resultado de la suma
        fecha: 24/10/20222

    */

    function sumar($valor1, $valor2) {

        return ($valor1 + $valor2);
    }

    
    /*

        Nombre: Función sumar(x, y)

        Descripción: suma dos números pasando los parámetros por referencia
        Argumentos: valor 1 y valor2
        Return: devuelve el resultado de la suma
        fecha: 24/10/20222

    */


    function sumar2(&$valor1, &$valor2)  {

        $valor1++;
        $valor2--;

        return ($valor1+$valor2);

    }

       /*

        Argumentos con valores predeterminados

        Nombre: Función sumar(x, y)

        Descripción: suma dos números pasando los parámetros por referencia
        Argumentos: valor 1 y valor2
        Return: devuelve el resultado de la suma
        fecha: 24/10/20222

    */

    function sumar3($valor1 = 0, $valor2 = 10 )  {

        return ($valor1+$valor2);

    }

?>