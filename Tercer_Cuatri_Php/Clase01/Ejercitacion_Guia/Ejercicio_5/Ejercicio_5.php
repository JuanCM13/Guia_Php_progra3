<?php
/*Aplicación No 5 (Números en letras)
Realizar un programa que en base al valor numérico de una variable $num, pueda mostrarse
por pantalla, el nombre del número que tenga dentro escrito con palabras, para los números
entre el 20 y el 60.
Por ejemplo, si $num = 43 debe mostrarse por pantalla “cuarenta y tres”.*/


    //los primeros 20 nums son unicos, despues nomas cambia el inicio de la palabra por decena.
    
    $numero = 30;
    $rango;
    $resultado = "Rompi todo..";
    if($numero > 19 && $numero < 61)
    {
        $arrayNums = array("uno","dos","tres","cuatro","cinco","seis","siete","ocho","nueve");
        $rango = strval($numero); 
        $arrayChar = str_split($rango);

        switch($arrayChar[0])
        {
            case 2:
                $resultado = "veint";
                $resultado .= $arrayChar[1] > 0 ? "i" : "e";
            break;
            case 3:
                $resultado = "treinta";
                //$resultado .= $arrayChar[1] > 0 ? " y " : "";
            break;
            case 4:
                $resultado = "cuarenta";
                //$resultado .= $arrayChar[1] > 0 ? " y " : "";
            break;
            case 5:
                $resultado = "cincuenta";
                //$resultado .= $arrayChar[1] > 0 ? " y " : "";
            break;
            case 6:
                $resultado = "sesenta";
                //$resultado .= $arrayChar[1] > 0 ? " y " : "";
            break;
        }

        if($arrayChar[1] > 0)
        {
            if($arrayChar[0] > 2)
            {
                $resultado .= $arrayChar[1] > 0 ? " y " : "";
            }

            $index = ($arrayChar[1]) - 1;
            $resultado .= ($arrayNums[$index]);
            //print_r($arrayNums);
            //echo $index;
        }
    }       
    echo "Resultado: $resultado";  
?>