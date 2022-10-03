<?php
    /*Juan cruz Mendez - div 3D
    Aplicación No 13 (Invertir palabra)
    Crear una función que reciba como parámetro un string ($palabra) y un entero ($max). La
    función validará que la cantidad de caracteres que tiene $palabra no supere a $max y además
    deberá determinar si ese valor se encuentra dentro del siguiente listado de palabras válidas:
    “Recuperatorio”, “Parcial” y “Programacion”. Los valores de retorno serán:
    1 si la palabra pertenece a algún elemento del listado.
    0 en caso contrario.*/

    $palabraAvalidar = "Programacion";

    $resultado = validarPalabra($palabraAvalidar , 100) == 1 ? "la palabra pertenece a algún elemento del listado" : "Rompi todo"; 
    echo "Resultado: " . $resultado;

    function validarPalabra($stringP , $max)
    { 
        $ret = 0;
        if(!is_null($stringP) && strlen($stringP) <= $max && is_numeric($max))
        {
            $arrayControl = array("Recuperatorio","Parcial","Programacion");
            foreach($arrayControl as $aMatchear)
            {
                if($stringP == $aMatchear)
                {
                    $ret = 1;
                    break;
                }
            }
        }        
        return $ret;
    }
?>