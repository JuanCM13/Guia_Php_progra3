<?php

$i = 1;
$acum = 0;
$aux = 0;

while(true)
{
    $acum += $i;    
    echo "Numero: . $i . Se sumo..";
    echo "<br>";
    $i++;

    if(($aux += $i) > 1000)
    {
        break;
    }
}

echo "El total de la suma fue de: . $acum . En total se sumaron: . $i numeros..";

?>