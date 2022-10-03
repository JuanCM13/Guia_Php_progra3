<?php
/*Aplicación No 28 ( Listado BD)
Archivo: listado.php
método:GET
Recibe qué listado va a retornar(ej:usuarios,productos,ventas)
cada objeto o clase tendrán los métodos para responder a la petición
devolviendo un listado <ul> o tabla de html <table>*/
include "../Ejercicio_27/Usuario.php";
include "../Ejercicio_28/Producto.php";
include "../Ejercicio_28/Venta.php";

$requestType = $_SERVER['REQUEST_METHOD'];
$requestExpected = "GET";

if($requestType === $requestExpected && !empty($_GET['tipo']))
{
    echo "Entre";
    switch($_GET['tipo'])
    {
        case "usuarios":
            echo "\nEntre 2\n";
            $listadoRetornado = Usuario::getAllUsers_BD();
            if(!is_null($listadoRetornado) && count($listadoRetornado) > 0)
            {
                foreach($listadoRetornado as $user)
                {
                    echo "-" . $user->_mostrarUsuario();
                }
            }
            else
            {
                echo "Vino nulo el listado, o vacio..";
            }
        break;
        case "productos":
            $listadoRetornado = Producto::getAllProducts_BD();
            if(!is_null($listadoRetornado) && count($listadoRetornado) > 0)
            {
                foreach($listadoRetornado as $producto)
                {
                    echo "-" . $producto->printProduct_Data();
                }
            }
            else
            {
                echo "Vino nulo el listado, o vacio..";
            }
        break;
        case "ventas":
            $listadoRetornado = Venta::getAllSells_BD();
            if(!is_null($listadoRetornado) && count($listadoRetornado) > 0)
            {
                foreach($listadoRetornado as $venta)
                {
                    echo "-" . $venta->printSell_Data();
                }
            }
            else
            {
                echo "Vino nulo el listado, o vacio..";
            }
        break;
    }
}
else
{
    echo "Error, se esperaba una peticion de tipo GET...";
}

?>