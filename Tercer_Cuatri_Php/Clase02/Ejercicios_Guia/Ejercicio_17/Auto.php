<?php
        class Auto
        {
            private $_color;
            private $_precio;
            private $_marca;
            private $_fecha;

            public function __construct($marca , $color , $precio = 0 , $fecha = "")
            {
                $this-> _color = $color;
                $this-> _precio = $precio;
                $this-> _marca = $marca;
                $this-> _fecha = $fecha;
            }

            /*Realizar un método de instancia llamado “AgregarImpuestos”, que recibirá un doble por
            parámetro y que se sumará al precio del objeto.
            Realizar un método de clase llamado “MostrarAuto”, que recibirá un objeto de tipo “Auto”
            por parámetro y que mostrará todos los atributos de dicho objeto.
            Crear el método de instancia “Equals” que permita comparar dos objetos de tipo “Auto”. Sólo
            devolverá TRUE si ambos “Autos” son de la misma marca.
            Crear un método de clase, llamado “Add” que permita sumar dos objetos “Auto” (sólo si son
            de la misma marca, y del mismo color, de lo contrario informarlo) y que retorne un Double con
            la suma de los precios o cero si no se pudo realizar la operación.
            Ejemplo: $importeDouble = Auto::Add($autoUno, $autoDos);
*/
            public function agregarImpuestos($monto)
            {
                if(is_numeric($monto))
                {
                    return $this->_precio += $monto;
                }
                return -1;
            }

            public static function mostrarAuto($au)
            {
                if(!is_null($au))
                {
                    return "Auto marca: ". $au->_marca . "-- Color: " . $au->_color . "-- Precio: " . $au->_precio . "-- Fecha: " . $au->_fecha;
                }
                return "Objeto nulo";
            }

            /*Crear el método de instancia “Equals” que permita comparar dos objetos de tipo “Auto”. Sólo
            devolverá TRUE si ambos “Autos” son de la misma marca.*/
            public function equals($a1)
            {
                if(!is_null($a1))
                {
                    if(strcmp($a1->_marca , $this->_marca) == 0)
                    {
                        return true;
                    }
                }
                return false;
            }

            /*Crear un método de clase, llamado “Add” que permita sumar dos objetos “Auto” (sólo si son
            de la misma marca, y del mismo color, de lo contrario informarlo) y que retorne un Double con
            la suma de los precios o cero si no se pudo realizar la operación.
            Ejemplo: $importeDouble = Auto::Add($autoUno, $autoDos);*/
            public static function add($a1 , $a2)
            {
                if(!is_null($a1) && !is_null($a2))
                {
                    if($a1->equals($a2) && $a1->_color == $a2->_color)
                    {
                        echo "Entre al if de ";
                        return $a1->_precio + $a2->_precio; 
                    }
                    else
                    {
                        echo "ERROR, los autos no son iguales..<br>";
                    }
                    return 0;
                }
                else
                {
                    echo "Error vino nulo algo";   
                }
            }
        }
?>