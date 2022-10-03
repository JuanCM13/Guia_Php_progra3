<?php

/*Aplicación No 4 (Calculadora)
Escribir un programa que use la variable $operador que pueda almacenar los símbolos
matemáticos: ‘+’, ‘-’, ‘/’ y ‘*’; y definir dos variables enteras $op1 y $op2. De acuerdo al
símbolo que tenga la variable $operador, deberá realizarse la operación indicada y mostrarse el
resultado por pantalla.*/
    
    $op1 = 5;
    $op2 = 1;
    $operador = '/';
    $mensaje = "Error, no se puede dividir por cero..";

    switch($operador)
    {
        case '+':
            $mensaje = $op1 + $op2;
        break;
        case '-':
            $mensaje = $op1 - $op2;
        break;
        case '*':
            $mensaje = $op1 * $op2;
        break;
        case '/':
            if($op2 != 0)
            {
                $mensaje = $op1 / $op2;
            }            
            else
            {
                $mensaje = "Error, no se puede dividir por cero..";
            }
        break;
    }

    echo "$op1 $operador $op2 = $mensaje";
?>