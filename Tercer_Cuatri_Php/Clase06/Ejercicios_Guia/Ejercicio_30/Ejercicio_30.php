<?php

    /*Aplicación No 30 ( AltaProducto BD)
Archivo: altaProducto.php
método:POST
Recibe los datos del producto(código de barra (6 sifras ),nombre ,tipo, stock, precio )por POST
, carga la fecha de creación y crear un objeto ,se debe utilizar sus métodos para poder
verificar si es un producto existente,
si ya existe el producto se le suma el stock , de lo contrario se agrega .
Retorna un :
“Ingresado” si es un producto nuevo
“Actualizado” si ya existía y se actualiza el stock.
“no se pudo hacer“si no se pudo hacer
Hacer los métodos necesarios en la clase*/


    include "../Ejercicio_28/Producto.php";

    $requestType = $_SERVER['REQUEST_METHOD'];
    $requestExpected = "POST";
    if($requestType === $requestExpected)
    {
        if((!empty($_POST['codigo']) && !empty($_POST['nombre']) && !empty($_POST['tipo']) && !empty($_POST['stock'])
        && !empty($_POST['precio'])))
        {
            $prod = new Producto(
                                -1,
                                $_POST['codigo'],
                                $_POST['nombre'],
                                $_POST['tipo'],
                                $_POST['stock'],
                                $_POST['precio']);       
            //var_dump($prod);
            echo Producto::insertOrUpdate_Product_BD($prod);
        }
        else
        {
            echo "Error, alguno de los parametros vino nullo...";
        }
    }
    else
    {
        echo "Error, se esperaba una peticion de tipo GET...";
    }
?>