<?php

//Mendez Juan Cruz-- Div 3d
/*Aplicación No 29( Login con bd)
Archivo: Login.php
método:POST
Recibe los datos del usuario(clave,mail )por POST ,
crear un objeto y utilizar sus métodos para poder verificar si es un usuario registrado en la
base de datos,
Retorna un :
“Verificado” si el usuario existe y coincide la clave también.
“Error en los datos” si esta mal la clave.
“Usuario no registrado si no coincide el mail“
Hacer los métodos necesarios en la clase usuario.*/

    include "../Ejercicio_27/Usuario.php";

    $requestType = $_SERVER['REQUEST_METHOD'];
    $requestExpected = "POST";
    if($requestType === $requestExpected)
    {
        if(!empty($_POST['mail']) && !empty($_POST['clave']))
        {
            switch(Usuario::userExists($_POST['mail'],$_POST['clave']))
            {
                case 0:
                    echo "Verificado..";
                    break;
                case -1:
                    echo "Usuario no registrado..";
                    break;
                case -2:
                    echo "Error en los datos..";
                    break;
            } 
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