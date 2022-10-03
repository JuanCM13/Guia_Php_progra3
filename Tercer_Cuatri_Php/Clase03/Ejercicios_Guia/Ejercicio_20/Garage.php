<?php
    include "../Ejercicio_19/Auto.php";
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
        public $_autos;

        public function __construct($razon, $precio = 0,$ar_autos = array())
        {
            $this->_autos = $ar_autos;
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

        /*Ahora asi anda lpm*/
        public static function guardar_garage_csv($garage)
        {
            if(!is_null($garage))
            {
                if(!is_null($garage->_autos) && count($garage->_autos) > 0)
                {
                    $file = fopen("garages.csv", 'a');
                    if(!($file == false))
                    {
                        $garageParams = get_object_vars($garage);
                        if(!is_null($garageParams) && count($garageParams) == 3)
                        {
                            if(is_array($garageParams["_autos"]) && count($garageParams["_autos"]) > 0)
                            {
                                if(Auto::guardar_Csv_Nombre($garageParams["_autos"] , $garageParams["_razonSocial"]))                                
                                {
                                    $necesarys_garageParams = array();
                                    array_push($necesarys_garageParams,$garageParams["_razonSocial"]);
                                    array_push($necesarys_garageParams,$garageParams["_precioPorHora"]);;
                                    fwrite($file,implode(',', $necesarys_garageParams) . "\n");                            
                                }
                            }
                        }             
                        else{
                            throw new Exception("Rompi todo");
                        }           
                    }                    
                    fclose($file);
                    return true;
                }
            }
            return false;
        }

        public static function leer_garages($nomb_arch)
        {
            $ar_garages;
            $ar_autos;
            if(!empty($nomb_arch) && file_exists($nomb_arch . ".csv"))
            {
                $ar_garages = array();
                $file = fopen($nomb_arch . ".csv" , 'r');
                if(!($file == false))
                {
                    while(!feof($file))
                    {               
                        $linea = fgets($file);
                        if(!empty($linea))
                        {
                            $ret = explode(",",$linea);                          
                            $ar_autos = Auto::leer_Csv("../Ejercicio_20/" .$ret[0] . ".csv");
                            /*echo "Data Parseada: \n";
                            var_dump($ar_autos);
                            echo "\n\n";*/
                            array_push($ar_garages, new Garage($ret[0],$ret[1],$ar_autos));                            
                        }                                                 
                    }
                }
            }
            //var_dump($ar_garages);
            return $ar_garages;
        }

        /*
        Crear un método de clase para poder hacer el alta de un Garage y, guardando los datos en un
        archivo garages.csv.
        
        public static function guardar_garages_csv($garage)
        {
            $arAux;
            $newArrayToImplode;
            $autoArrayToImplode;
            if(!is_null($garage) && is_array($garage))
            {
                echo "<br> Es array y no es nulo..<br>";
                if(count($garage) > 0)
                {
                    $ar = fopen('garage.csv', 'a');
                    if($ar != false)
                    {
                        echo "<br> Se creo o existe el archivo..<br>";
                        $newArrayToImplode = array();
                        foreach($garage as $item)
                        {
                            if(!is_null($item))
                            {   
                                echo "<br> Entre al foreach, el garage no es nulo..<br>";
                                $arAux = get_object_vars($item);                             
                                array_push($newArrayToImplode,$arAux['_razonSocial']);
                                array_push($newArrayToImplode,$arAux['_precioPorHora']);
                                echo "<br> Razon social del garaga:.." .$arAux['_razonSocial'] . "<br>";
                                echo "<br> Precio por hora del garaga.." . $arAux['_precioPorHora'] . "<br>";
                                
                                $countAu x = 0;
                                foreach($arAux['_autos'] as $auto)
                                {
                                    echo "<br>Auto numero: " . $countAux . ": <br>";
                                    $autoArrayToImplode = get_object_vars($auto);
                                    echo "<br>" . $autoArrayToImplode['_color'] . "<br>";
                                    echo "<br>" . $autoArrayToImplode['_precio'] . "<br>";
                                    echo "<br>" . $autoArrayToImplode['_marca'] . "<br>";
                                    echo "<br>" . $autoArrayToImplode['_fecha'] . "<br>";
                                    $countAux++;
                                }
                            } 
                        }
                        echo var_dump($newArrayToImplode);
                        /*fwrite($ar,implode(',', get_object_vars($garage)) . "\n");                
                        fclose($ar);
                        return "Parece que se serializo bien..";         
                    }                      
                }                     
                else
                {
                    return "Error, el array vino vacio...";
                }
            }
            return "El objeto recibido no es un garage...";
        }*/
    }
?>