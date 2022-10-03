<?php

    //Mendez Juan Cruz -- Div 3d , Ejer 21
    /*
    -Recibe que listado va a retornar, ejemplo usuarios productosvehiculos etc*,por ahora solo tenemos usuarios
    -En el caso de usuarios carga los datos del archivo usuarios.csv
    -Se deben cargar los datos en un array de usuarios
    -Retornar los dats que cntiene ese array en una lista, supongo que lo mostramos con un echo?    
    */
    include "../Ejercicio_20_2/Usuario.php";

    $requestTypeExpected = 'GET';
    $requestType = $_SERVER['REQUEST_METHOD'];
    $arrRetornado;
    $boolEmpty = false;
    switch($requestType)
    {
        case $requestTypeExpected:
            switch($_GET['tipo'])
            {
                case 'usuario':
                    //ojo que si no lo apunto al archivo que esta en el ejer 20 haciendo el salto de carpeta ../ no me
                    //reconoce el archivo, como que en esta ejecucion no existe aunque haya importado ../Ejercicio_20_2/Usuario.php";
                    //sino la otra que queda, es copiar y pegar el archivo en esta carpeta de ejercicio_21..
                    $arrRetornado = Usuario::leer_Csv("../Ejercicio_20_2/usuarios.csv");
                    if(count($arrRetornado) > 0)
                    {
                        echo "Usuarios del listado usuarios.csv: \n\n";
                        foreach($arrRetornado as $user)
                        {
                            echo "Usuario:\n". $user->_mostrarUsuario() . "\n\n";
                        }
                    }
                    else
                    {
                        $boolEmpty = true;
                    }
                    break;
                default:
                    echo "Todavia no implementamos todos los tipos de datos.. de momento solo usuario..\n";
                    break;
            }
            if($boolEmpty)
            {
                echo "Error, el listado de: " . $_GET['tipo'] . " Vino vacio...\n";
            }
            break;
        default: 
            echo "Error, se esperaba recibir la peticion por: " . $requestTypeExpected . "...\n";
            break;
    }

    /* hace falta devolver la data en formato lista de html?
    private function _convertData_toHtmlList($arrData)
    {
        $stringRet = "<h1>Error, el array vino nullo o vacio..<br></h1>";
        if(!is_null($arrData) && count($arrData) > 0)
        {
            $stringRet = "<ul>li<>           </ul>"
        }
        return $stringRet;
    }
    */
?>