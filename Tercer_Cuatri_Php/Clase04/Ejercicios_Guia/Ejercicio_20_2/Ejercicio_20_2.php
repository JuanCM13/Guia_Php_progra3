<?php

    //Mendez Juan Cruz, div 3D, ejer 20 parte 2
    /*
    Recibir via pstman, nombre,clave,mail
    crear objeto tipo usuario y guardarlo en usuario.csv
    */

    include "Usuario.php";
    $seP = true;
    $requestType = $_SERVER['REQUEST_METHOD'];

    switch($requestType)
    {
        case 'POST':
            foreach($_POST as $key => $value)
            {
                if(empty($value))
                {
                    $seP = false;                    
                    break;
                }
            }
            if($seP)
            {
                $user = new Usuario($_POST['nombre'],$_POST['mail'],$_POST['contraseña']);
                if(!is_null($user))
                {
                    if(Usuario::guardar_Csv($user,"usuarios.csv"))
                    {
                        echo "USUARIO GUARDADO CON EXITO!\n";
                        echo "\nARCHIVO DE USUARIOS AL MOMENTO: \n\n";
                        $listado = Usuario::leer_Csv("usuarios.csv");
                        if(count($listado) > 0)
                        {
                            foreach($listado as $userParseado)
                            {
                                echo $userParseado->_mostrarUsuario() . "\n";
                            }
                        }
                        else
                        {
                            echo "Error, el listado no pudo leerse..";
                        }
                    }
                    else
                    {
                        echo "NO SE PUDO CREAR EL ARCHIVO :(\n";
                    }
                }                
            }
            else
            {
                echo "Error campos para dar de alta el usuario incompletos..\n";
            }
            break;
        default:
            echo "Tipo de peticion incorrecta, solo tomamos por post..";
            break;
    }




?>