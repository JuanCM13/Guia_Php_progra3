<?php

//Mendez Juan Cruz -- Div 3D
/*Aplicación No 27 (Registro BD)
Archivo: registro.php
método:POST
Recibe los datos del usuario( nombre,apellido, clave,mail,localidad )por POST ,
crear un objeto con la fecha de registro y utilizar sus métodos para poder hacer el alta,
guardando los datos la base de datos
retorna si se pudo agregar o no.*/

include "./Usuario.php";
$requestType = $_SERVER['REQUEST_METHOD'];
$expectedRequest = "POST";

if($requestType === $expectedRequest)
{
    if(!empty($_POST['id']) && !empty($_POST['nombre']) && !empty($_POST['apellido']) && !empty($_POST['clave']) && !empty($_POST['mail']) && !empty($_POST['localidad']))
    {
        echo "Clave: " . $_POST['clave'];
        try
        {
            $userToPush = new Usuario($_POST['id'],$_POST['nombre'],$_POST['apellido'],$_POST['clave'],$_POST['mail'],$_POST['localidad']);
            if(!is_null($userToPush))
            {
                $userToPush->pushUser_DB();
            }
        }
        catch(Exception $ex)
        {
            echo $ex->getMessage() . "\n";
        }
    }
}
else
{
    echo "Peticion incorrecta";
}
?>