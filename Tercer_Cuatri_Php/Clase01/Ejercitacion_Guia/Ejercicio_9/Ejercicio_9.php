<?php
//Mendez Juan Cruz, div 3d
/*Aplicación No 9 (Arrays asociativos)
Realizar las líneas de código necesarias para generar un Array asociativo $lapicera, que
contenga como elementos: ‘color’, ‘marca’, ‘trazo’ y ‘precio’. Crear, cargar y mostrar tres
lapiceras.*/

    $lapicera = array
    (
        array("Color" => "Rojo","Marca" => "Maped","Trazo" => "Fino","Precio" => 450),
        array("Color" => "Azul","Marca" => "Bic","Trazo" => "Grueso","Precio" => 300),
        array("Color" => "Negro","Marca" => "Pepe","Trazo" => "Medio","Precio" => 500),
    );

    foreach($lapicera as $item)
    {
        echo $item["Color"] ." - ". $item["Marca"] ." - ". $item["Trazo"] ." - ". $item["Precio"] ."<br>";
    }
    
/* HAY FORMA DE ESPECIFICAR LAS COLUMNAS Y PARAMETROS EN LA DECLARACION? ALGO PARECIDO A LO SIGUIENTE:
    $segundoArray[[$Color] [$Marca] [$Trazo] [$Precio]] = array
    (
        array("Rojo","Maped","Fino",500),
        array("Rojo","Maped","Fino",500),
        array("Rojo","Maped","Fino",500)
    
        foreach($segundoArray as $item)
        {
            echo $item["Color"] ." - ". $item["Marca"] ." - ". $item["Trazo"] ." - ". $item["Precio"] ."<br>";
        }
    );
*/
?>