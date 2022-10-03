<?php

/* Mendez Juan Cruz - Div 3D
En testAuto.php:
● Crear dos objetos “Auto” de la misma marca y distinto color.
● Crear dos objetos “Auto” de la misma marca, mismo color y distinto precio.
● Crear un objeto “Auto” utilizando la sobrecarga restante.
● Utilizar el método “AgregarImpuesto” en los últimos tres objetos, agregando $ 1500
al atributo precio.
● Obtener el importe sumado del primer objeto “Auto” más el segundo y mostrar el
resultado obtenido.
● Comparar el primer “Auto” con el segundo y quinto objeto e informar si son iguales o
no.
● Utilizar el método de clase “MostrarAuto” para mostrar cada los objetos impares (1, 3,
5)
*/

    include "Auto.php";

    $arrayAutos = array(
        new Auto("Chevrolet","Azul"),
        new Auto("Chevrolet","Rojo"),
        new Auto("Toyota","Gris",600),
        new Auto("Toyota","Gris",750),
        new Auto("Rover","Dorado",950,"10/10/2015") 
    );
    
    $arrayAutos[2]->agregarImpuestos(1500);
    $arrayAutos[3]->agregarImpuestos(1500);
    $arrayAutos[4]->agregarImpuestos(1500);

    $resultSuma = Auto::add($arrayAutos[0] , $arrayAutos[1]);

    echo "Resultado suma: Auto 1 + Auto 2 es: " . $resultSuma . " --- SE ESPERABA: 0 <br>"; 

    if($arrayAutos[0] == $arrayAutos[1])
    {
        echo "Auto 1 y Auto 2 son Iguales <br>";
    }
    else
    {
        if($arrayAutos[0] == $arrayAutos[4])
        {
            echo "Auto 1 y Auto 5 son Iguales <br>";
        }
        else
        {
            echo "Tanto Auto 1 como Auto 2 como Auto 5, son distintos..<br>";
        }
    }
    
    echo "<br> Guardado de Autos";
    if(Auto::guardar_Csv($arrayAutos))
    {
        echo "Anda";
    }
    else
    {
        echo "Rompi todo";
    }

    echo "<br> Lectura de Autos";
    $arRet = Auto::leer_Csv("autos.csv");
    if(!is_null($arRet))
    {
        echo "<br><br> Autos: <br>";
        foreach($arRet as $auto)
        {
            echo Auto::mostrarAuto($auto) . "<br>";
        }
    }
    else
    {
        echo "Rompi todo";
    }
    
?>