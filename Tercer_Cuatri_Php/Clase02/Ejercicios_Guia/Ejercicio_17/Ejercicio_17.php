<?php

    /*  Mendez Juan Cruz - Div 3D
        Aplicación No 17 (Auto)
        Realizar una clase llamada “Auto” que posea los siguientes atributos privados:

        _color (String)
        _precio (Double)
        _marca (String).
        _fecha (DateTime)

        Realizar un constructor capaz de poder instanciar objetos pasándole como parámetros:

        i. La marca y el color.
        ii. La marca, color y el precio.
        iii. La marca, color, precio y fecha.

        Realizar un método de instancia llamado “AgregarImpuestos”, que recibirá un doble por
        parámetro y que se sumará al precio del objeto.
        Realizar un método de clase llamado “MostrarAuto”, que recibirá un objeto de tipo “Auto”
        por parámetro y que mostrará todos los atributos de dicho objeto.
        Crear el método de instancia “Equals” que permita comparar dos objetos de tipo “Auto”. Sólo
        devolverá TRUE si ambos “Autos” son de la misma marca.
        Crear un método de clase, llamado “Add” que permita sumar dos objetos “Auto” (sólo si son
        de la misma marca, y del mismo color, de lo contrario informarlo) y que retorne un Double con
        la suma de los precios o cero si no se pudo realizar la operación.
        Ejemplo: $importeDouble = Auto::Add($autoUno, $autoDos);
        En testAuto.php:*/
         
        include "Auto.php";

        $autoUno = new Auto("Ford","Rojo");
        $autoDos = new Auto("Chevrolet","Azul",450,"05/10/2201");
        $autoTres = new Auto("Chevrolet","Azul",500,"05/10/2001");

        echo "Importe Auto uno: " . $autoUno->agregarImpuestos(450) . " -- Se esparaba: 450 <br>";
        echo "Importe Auto dos: " . $autoDos->agregarImpuestos(450) . " -- Se esparaba: 900 <br>";

        echo "Informacion auto uno: " . Auto::mostrarAuto($autoUno) . "<br>";
        echo "Informacion auto dos: " . Auto::mostrarAuto($autoDos) . "<br>";

        if($autoUno->equals($autoDos))
        {
            echo "Auto 1 y auto 2 son iguales..<br>";
        }
        else
        {
            echo "Auto 1 y auto 2 s no son iguales..<br>";
        }

        if($autoDos->equals($autoTres))
        {
            echo "Auto 1 y auto 3 son iguales..<br>";
        }
        else
        {
            echo "Auto 1 y auto 3 s no son iguales..<br>";
        }

        echo "La suma de auto uno y auto dos es: " . Auto::add($autoUno , $autoDos) . " -- Se esperaba: 1350<br>";
        echo "La suma de auto dos y auto tres es: " . Auto::add($autoDos , $autoTres) . " -- Se esperaba: 1400<br>";
        Auto::add($autoUno,null);
?>