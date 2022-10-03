<?php
        class Auto
        {
            private $_color;
            private $_precio;
            private $_marca;
            private $_fecha;

            public function __construct($marca , $color , $precio = 0 , $fecha = "Sin definir")
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
                        //echo "Entre al if de ";
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

                                    /*
            Crear un método de clase para poder hacer el alta de un Auto, guardando los datos en un
            archivo autos.csv.
            Hacer los métodos necesarios en la clase Auto para poder leer el listado desde el archivo
            autos.csv
            Se deben cargar los datos en un array de autos.
            */
            public static function guardar_Csv($autos)
            {
                if(!is_null($autos))
                {
                    return Auto::guardar_Csv_Nombre($autos , "autos.csv");
                }
                return false;
            }

            public static function guardar_Csv_Nombre($autos,$nombreArchivo)
            {
                if(!is_null($autos) && count($autos) > 0 && gettype($nombreArchivo) == "string" && !empty($nombreArchivo))
                {
                    $ar = fopen($nombreArchivo . ".csv", 'a');
                    foreach($autos as $item)
                    {
                        fwrite($ar,implode(',', get_object_vars($item)) . "\n");                        
                    }                    
                    fclose($ar);
                    return true;
                }
                return false;
            }

            /*
            Hacer los métodos necesarios en la clase Auto para poder leer el listado desde el archivo
            autos.csv*/
            public static function leer_Csv($rutaAr)
            {
                $arrAutos;
                if(!is_null($rutaAr) && file_exists($rutaAr))
                {
                    $arrAutos = array();
                    $file = fopen($rutaAr,'r');
                    if(!is_null($file))
                    {
                        while(!feof($file))
                        {               
                            $linea = fgets($file);
                            if(!empty($linea))
                            {
                                $ret = explode(",",$linea);                                
                                array_push($arrAutos, new Auto($ret[0],$ret[1],$ret[2],$ret[3]));
                            }                                                 
                        }
                    }
                    fclose($file);
                    return $arrAutos;
                }
                return arrAutos;
            }
        }
?>