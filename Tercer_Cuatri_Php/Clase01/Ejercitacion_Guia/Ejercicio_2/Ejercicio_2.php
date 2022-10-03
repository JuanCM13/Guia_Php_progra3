<?php

/*Aplicación No 2 (Mostrar fecha y estación)
Obtenga la fecha actual del servidor (función date) y luego imprímala dentro de la página con
distintos formatos (seleccione los formatos que más le guste). Además indicar que estación del
año es. Utilizar una estructura selectiva múltiple.*/

$fecha = date("y/m/d");
echo "Fecha 1: . $fecha. <br>";
$fecha = date("Y-m-d");
echo "Fecha 2: . $fecha. <br>";

$mes = date("m");
$dia = date("d");
$estacion;

//$mes = 12;
//$dia = 20;
$estadoFecha = $dia < 21 ? true : false;

if($mes > 0 && $mes < 13)
{
    switch($mes)
    {
        case 12:
        case 1:
        case 2:
            $estacion = "Verano";
            if($mes == 12 && $estadoFecha)
            {    
                $estacion = "Primavera";
            }
        break;
        case 3:
        case 4:
        case 5:
            $estacion = "Otoño";
            if($mes == 3 && $estadoFecha)
            {    
                $estacion = "Verano";
            }
        break;
        case 6:
        case 7:
        case 8:
            $estacion = "Invierno";
            if($mes == 6 && $estadoFecha)
            {    
                $estacion = "Otoño";
            }
        break;
        default:
            $estacion = "Primavera";
            if($mes == 9 && $estadoFecha)
            {    
                $estacion = "Invierno";
            }
        break;
    }
}
else
{
    echo "Rompimos todo!";
}
echo "Estamos en: . $estacion";

?>