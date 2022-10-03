<?php

//Mendez Juan Cruz, div 3d
/*Aplicación No 8 (Carga aleatoria)
Imprima los valores del vector asociativo siguiente usando la estructura de control foreach:
$v[1]=90; $v[30]=7; $v['e']=99; $v['hola']= 'mundo';*/

    $v[1]=90; $v[30]=7; $v['e']=99; $v['hola']= ' mundo';

    foreach($v as $key => $value)
    {
        echo $key ." - ". $value;
        echo "<br>";
    }
?>