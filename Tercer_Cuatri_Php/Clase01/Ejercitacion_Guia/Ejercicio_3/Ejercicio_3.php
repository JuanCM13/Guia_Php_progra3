<?php
/*Aplicación No 3 (Obtener el valor del medio)
Dadas tres variables numéricas de tipo entero $a, $b y $c realizar una aplicación que muestre
el contenido de aquella variable que contenga el valor que se encuentre en el medio de las tres
variables. De no existir dicho valor, mostrar un mensaje que indique lo sucedido.
Ejemplo 1: $a = 6; $b = 9; $c = 8; => se muestra 8.
Ejemplo 2: $a = 5; $b = 1; $c = 5; => se muestra un mensaje “No hay valor del medio”*/

        /*  1   5   3     el 3 es del medio --T
            5   1   5   no hay numero del medio --T
            3  5   1     el 3 es del medio --T
            3   1   5    el 3 es del medio --T
            5   3   1    el 3 es del medio --T
            1  5  1    no hay numero del medio --T*/
    $a = 1; 
    $b = 5;
    $c = 1;

    if($a == $b || $a == $c || $b == $a || $b == $c)
    {
        echo "No hay numero del medio.."; 
    } 
    else
    {
        if($a < $b && $a > $c || $a > $c && $a < $b || $a > $b && $a < $c)
        {
            echo "El numero: $a es el del medio..";
        }
        else
        {
            if($b > $a && $b < $c || $b > $c && $b < $a)
            {
                echo "El numero: $b es el del medio..";
            }
            else
            {
                echo "El numero: $c es el del medio..";
            }
        }
    }
?>