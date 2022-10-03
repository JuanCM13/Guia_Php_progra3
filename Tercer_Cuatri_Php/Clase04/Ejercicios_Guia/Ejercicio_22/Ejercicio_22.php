<?php

    //Mendez Juan Cruz -- Div 3D , Ejercicio 22    
    /*
    Login:
    Recibir los datos del usuario(clave,mail) por POST
    crear un objeto y utilizar sus metodos para poder verificar si esun usuario registrado
    Retornar:
    "Verificado" si el usuario existe y coincide la clave tambien
    "Error en los datos" si esta mal la clave
    "Usuario no registrado" si no coinciden los mails
    */

    include "../Ejercicio_20_2/Usuario.php"; 

    $requestTypeExpected = "POST";
    $requestType = $_SERVER['REQUEST_METHOD'];

    if($requestType == $requestTypeExpected)
    {
        if(!empty($_POST['mail']) && !empty($_POST['contraseña']))
        {
            echo Usuario::exists_User(new Usuario($_POST['nombre'],$_POST['mail'],$_POST['contraseña']));
        }
        else
        {
            echo "Error, alguno de los datos no fue completo..\n";
        }
    }
    else
    {
        echo "Error, se esperaba una peticion tipo POST..\n";
    }
?>