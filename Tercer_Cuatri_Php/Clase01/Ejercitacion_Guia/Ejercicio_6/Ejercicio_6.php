<?php   

    /*Aplicación No 6 (Carga aleatoria)
    Definir un Array de 5 elementos enteros y asignar a cada uno de ellos un número (utilizar la
    función rand). Mediante una estructura condicional, determinar si el promedio de los números
    son mayores, menores o iguales que 6. Mostrar un mensaje por pantalla informando el
    resultado. */

    $lim = 6;
    $array[$lim] = array();
    $acum = 0;
    $aux;

    for($i=0 ; $i<6 ; $i++)
    {
        $array[$i] = rand(); //agregar rango aca..
        $acum += $array[$i];
    }

    if($lim > 0)
    {
        $aux = "Es igual";
        $prom = $acum / $lim;
        if($prom < 6)
        {
            $aux = "Es menor";
        }
        else
        {
            if($prom > 6)
            {
                $aux = "Es mayor";
            }
        }
        echo "El promedio ($prom) es: $aux a seis";
    }    
    else
    {
        echo "Error, el array debe ser de dimension mayor a cero..";
    }
?>