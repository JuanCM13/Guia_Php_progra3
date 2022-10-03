<?php
    //mendez juan cruz, div 3d
/*  Aplicación No 7 (Mostrar impares)
    Generar una aplicación que permita cargar los primeros 10 números impares en un Array.
    Luego imprimir (utilizando la estructura for) cada uno en una línea distinta (recordar que el
    salto de línea en HTML es la etiqueta <br/>). Repetir la impresión de los números utilizando
    las estructuras while y foreach.*/

    $arr[] = array();
    $cont = 0;
    while(1)
    {
        if($cont % 2 != 0)
        {            
            //echo $cont;
            array_push($arr , $cont);
        }
        ++$cont;
        
        if(sizeof($arr) == 11) //nose por que, pero si no le pongo 11 y le pongo 10, me guarda solamente 9 numeros, pero igual
        {                       //el sizeof retorna 10..
            //echo sizeof($arr);
            break;
        }
    }

    for($i=0;$i<sizeof($arr);$i++)
    {
        echo "$arr[$i] <br>";        
    }

    foreach($arr as $value)
    {
        echo "$value <br>";
    }
    echo "<br><br>";

    $cont = 0;
    while($cont < sizeof($arr))
    {
        echo "$arr[$cont] <br>";
        $cont++;
    }
    echo "<br><br>";
?>