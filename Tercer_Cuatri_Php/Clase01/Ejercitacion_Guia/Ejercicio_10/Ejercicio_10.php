<?php

//MENDEZ JUAN CRUZ , DIV 3D
/*Aplicación No 10 (Arrays de Arrays)
Realizar las líneas de código necesarias para generar un Array asociativo y otro indexado que
contengan como elementos tres Arrays del punto anterior cada uno. Crear, cargar y mostrar los
Arrays de Arrays.*/

    //array asociativo punto anterio
    $lapiceras = array
    (
        array("Color" => "Rojo","Marca" => "Maped","Trazo" => "Fino","Precio" => 450),
        array("Color" => "Azul","Marca" => "Bic","Trazo" => "Grueso","Precio" => 300),
        array("Color" => "Negro","Marca" => "Pepe","Trazo" => "Medio","Precio" => 500)
    );


    //array indexado cargado dinamicamente..
    echo "ARRAY INDEXADO CARGADO DINAMICAMENTE: <br><br>";
    $arrayIndexado = array();
    for($i=0 ; $i<count($lapiceras) ; $i++)
    {
        $arrayIndexado[$i] = ($lapiceras[$i]);
    }    

    //$val = count($arrayIndexado);
    //echo "Cantidad de elementos arrayIndexado: " . $val;
    for($fila=0 ; $fila<count($arrayIndexado) ; $fila++)
    {
        echo "Lapicera Nº ".$fila;
        foreach($lapiceras[$fila] as $clave => $valor)
        {
            echo ": ". $clave . " -- ". $valor; 
        }
        echo "<br>";
    }

    echo "<br><br>";
    //array asociado cargado dinamicamente..
    echo "ARRAY ASOCIADO CARGADO DINAMICAMENTE: <br><br>";
    $arrayAsociado = array();
    $auxString;
    for($i=0 ; $i<count($lapiceras) ; $i++)
    {
        $auxString = "Elemento_".$i;
        $arrayAsociado[$auxString] = ($lapiceras[$i]);
    } 

    foreach($arrayAsociado as $fila => $elemento)
    {
        echo $fila . ": ";
        foreach($elemento as $clave => $valor)
        {
            echo ": ". $clave . " -- ". $valor; 
        }
        echo "<br>";
    }
?>