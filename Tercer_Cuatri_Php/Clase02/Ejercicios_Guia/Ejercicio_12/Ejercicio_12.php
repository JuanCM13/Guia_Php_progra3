<?php

/*Mendez Juan Cruz- div 3d
Aplicación No 12 (Invertir palabra)
Realizar el desarrollo de una función que reciba un Array de caracteres y que invierta el orden
de las letras del Array.
Ejemplo: Se recibe la palabra “HOLA” y luego queda “ALOH”.*/

    $palab = array('H','O','L','A');

    $result = convertir($palab);
    echo "Resultado: " . $result;

    function convertir($arrayAconvertir = null)
    {
        $retorno = "error";
        if(!is_null($arrayAconvertir))
        {
            $retorno = "";
            for($i=count($arrayAconvertir)-1 ; $i>-1 ; $i--)
            {
                $retorno .= $arrayAconvertir[$i];
            }
        }
        return $retorno;
    }
?>