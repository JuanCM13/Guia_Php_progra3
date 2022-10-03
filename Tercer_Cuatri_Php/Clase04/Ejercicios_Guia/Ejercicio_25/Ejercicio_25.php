<?php

//Mendez Juan Cruz -- Div 3d, ejercicio 25
/*
    Recibir por POST datos de producto (codigo barras(6 cifras),nombre,tipo,stock,precio)
    Generar ID auto incremental(random 1 -- 1000)
    verificar si ya existe se le suma stock , de lo contrario se agrega el producto al csv en un nuevo renglon.
    retorna:
    ingresado si es producto nuevo
    actualizado si es producto existente
    no se pudo hacer, si hay algun error de datos
*/

    include "./Producto.php";
    $requestTypeExpected = "POST";
    $requestType = $_SERVER['REQUEST_METHOD'];

    if($requestType == $requestTypeExpected)
    {
    //    echo "Entre";
        if(!empty($_POST['codigo']) && !empty($_POST['nombre']) && !empty($_POST['tipo']) && !empty($_POST['stock']) && !empty($_POST['precio']))
        {
            echo Producto::_validateProduct(new Producto($_POST['codigo'],$_POST['nombre'],$_POST['tipo'],$_POST['stock'],$_POST['precio']),"productos.csv",false);
        }
        else
        {
            echo "Error, alguno de los datos de los atributos, vino nulo..\n";
        }
    }
    else
    {
        echo "Error, se esperaba una peticion de tipo POST..\n";
    }
?>