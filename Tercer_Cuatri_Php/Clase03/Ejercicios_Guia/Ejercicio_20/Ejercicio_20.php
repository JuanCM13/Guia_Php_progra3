<?php

/*Mendez Juan Cruz - div 3D
Crear un método de clase para poder hacer el alta de un Garage y, guardando los datos en un
archivo garages.csv.
Hacer los métodos necesarios en la clase Garage para poder leer el listado desde el archivo
garage.csv
Se deben cargar los datos en un array de garage.
En testGarage.php, crear autos y un garage. Probar el buen funcionamiento de todos
los métodos.
*/

    include "Garage.php";

    $arrayAutos = array(
        new Auto("Chevrolet","Azul"),
        new Auto("Chevrolet","Rojo"),
        new Auto("Toyota","Gris",600),
        new Auto("Toyota","Gris",750),
        new Auto("Rover","Dorado",950,"10/10/2015") 
    );

    $garage = new Garage("Audi sa",450);
    $ret = "";
    foreach($arrayAutos as $auto)
    {
        $ret = $garage->add($auto) ? "Agregado.." : "Ya existe en el listado..";
        echo "El auto: " . Auto::mostrarAuto($auto) . ": " . $ret . "<br>";
    }

    echo "\n\n";
    if(Garage::guardar_garage_csv($garage))
    {
        echo "Garage serializado con exito!\n\n";
        $garageRet = Garage::leer_garages("garages"); 
        if(count($garageRet) > 0)
        {
            foreach($garageRet as $item)
            {
                echo $item->mostrarGarage();
            }
        }
        else
        {
            echo "Rompi todo otra vez..\n";
        }
    }
    else
    {
        echo "Garage no se pudo serializar!!\n\n\n\n";
    }
    /*$arrayGarage = array(
        $garage
    );
    echo "<br><br> Parte de agregado de autos: <br><br>";
    Garage::guardar_garages_csv($arrayGarage);*/
?>