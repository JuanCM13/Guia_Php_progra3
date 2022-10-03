<?php

    /*Mendez Juan Cruz - div 3D
    Aplicación No 18 (Auto - Garage)
    Crear la clase Garage que posea como atributos privados:

    _razonSocial (String)
    _precioPorHora (Double)
    _autos (Autos[], reutilizar la clase Auto del ejercicio anterior)

    Realizar un constructor capaz de poder instanciar objetos pasándole como parámetros:

    i. La razón social.
    ii. La razón social, y el precio por hora.

    Realizar un método de instancia llamado “MostrarGarage”, que no recibirá parámetros y
    que mostrará todos los atributos del objeto.
    Crear el método de instancia “Equals” que permita comparar al objeto de tipo Garaje con un
    objeto de tipo Auto. Sólo devolverá TRUE si el auto está en el garaje.
    Crear el método de instancia “Add” para que permita sumar un objeto “Auto” al “Garage”
    (sólo si el auto no está en el garaje, de lo contrario informarlo).
    Ejemplo: $miGarage->Add($autoUno);
    Crear el método de instancia “Remove” para que permita quitar un objeto “Auto” del
    “Garage” (sólo si el auto está en el garaje, de lo contrario informarlo).
    Ejemplo: $miGarage->Remove($autoUno);
    En testGarage.php, crear autos y un garage. Probar el buen funcionamiento de todos los
    métodos.*/

    include "Garage.php";
    /*$auto = new Auto("Toyota","Rojo");
    echo Auto::mostrarAuto($auto);*/

    $arrayAutos = array(
        new Auto("Ford","Rojo"),
        new Auto("Chevrolet","Azul",450,"05/10/2201"),
        new Auto("Chevrolet","Azul",500,"05/10/2001")
    );

    $garage = new Garage("Audi sa",450);
    $ret = "";
    foreach($arrayAutos as $auto)
    {
        $ret = $garage->add($auto) ? "Agregado.." : "Ya existe en el listado..";
        echo "El auto: " . Auto::mostrarAuto($auto) . ": " . $ret . "<br>";
    }

    $garage->remove($arrayAutos[2]);

    echo $garage->mostrarGarage();
    
    $autoNoEsta = new Auto("Vw","Negro");
    echo $garage->remove($autoNoEsta);

?>