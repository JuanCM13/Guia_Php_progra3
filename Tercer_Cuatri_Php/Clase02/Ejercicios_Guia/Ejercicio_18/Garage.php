<?php
    include "../Ejercicio_17/Auto.php";
/*
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

*/
    class Garage
    {
        private $_razonSocial;
        private $_precioPorHora;
        private $_autos;

        public function __construct($razon, $precio = 0)
        {
            $this->_autos = array();
            $this->_precioPorHora = $precio;
            $this->_razonSocial = $razon;
        }

        /*Crear el método de instancia “Equals” que permita comparar al objeto de tipo Garaje con un
        objeto de tipo Auto. Sólo devolverá TRUE si el auto está en el garaje.*/
        public function equals($auto)
        {
            if($auto instanceof Auto && count($this->_autos) > 0)
            {
                foreach($this->_autos as $item)
                {
                    if($item->equals($auto))
                    {
                        return true;
                    }
                }
            }
            return false;
        }

        /*Crear el método de instancia “Add” para que permita sumar un objeto “Auto” al “Garage”
        (sólo si el auto no está en el garaje, de lo contrario informarlo).*/

        public function add($auto)
        {
            if($this->equals($auto) == false)
            {
                array_push($this->_autos , $auto);
                return true;
            }
            return false;
        }

        /*    Crear el método de instancia “Remove” para que permita quitar un objeto “Auto” del
            “Garage” (sólo si el auto está en el garaje, de lo contrario informarlo).*/

        public function remove($auto)
        {
            if($this->equals($auto))
            {
                $indexA = array_search($auto,$this->_autos);
                if($indexA != false)
                {
                    unset($this->_autos[$indexA]);
                }
            }
            else
            {
                return "El aut no esta en el garage...";
            }
        }

        public function mostrarGarage()
        {
            $ret = "Garage:<br>Razon social: ".$this->_razonSocial." -- Precio por hora: " . $this->_precioPorHora;
            $ret .= "<br>Cantidad de autos: ". count($this->_autos)."<br>"; 
            if(count($this->_autos) > 0)
            {
                $ret .= "Caracteristicas autos: <br>";
                foreach($this->_autos as $auto)
                {
                    $ret .= Auto::mostrarAuto($auto) . "<br>";
                }
            }
            return $ret;
        }
    }
?>