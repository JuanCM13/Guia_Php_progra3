<?php

//Mendez Juan Cruz -- Div 3D , Ejercicio 26 (Realizar venta)
/*
    Recibir por Post, los datos del producto (CODIGO BARRA), del Usuario el (ID) y la cantidad de items a comprar..
    Crear csv de ventas, con id autincremental y dato del usuario (id usuario, nombre usuario , codigo barras producto
        nombre producto, precio producto , cantidad de productos vendidos y precio final) //asi lo interprete yo..
    
    retornar:
    -Venta realizada si se concreto
    -no se pudo hacer si no se pudo concretar    
*/

    include "./Venta.php";

    $requestType = $_SERVER['REQUEST_METHOD'];
    $requestTypeExpected = "POST";

    if($requestType == $requestTypeExpected)
    {
        if(!empty($_POST['codigo']) && !empty($_POST['id']) && !empty($_POST['cant']))
        {
            try
            {
                echo "RESULTADO DESPUES DE 3 DIAS DE INTENTAR ARREGLAR ESTA PORQUERIA: " . Venta::generateSell($_POST['id'],$_POST['codigo'],$_POST['cant']);
            }
            catch(Exception $ex)
            {
                echo $ex->getMessage();
            }
        }
        else
        {
            echo "Error, uno de los parametros por POST vino vacio..!\n";
        }
    }
    else
    {
        echo "Error, se esperaba una peticion tipo POST..\n";
    }
?>