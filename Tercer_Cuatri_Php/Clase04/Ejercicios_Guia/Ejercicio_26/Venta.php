<?php
    include "../Ejercicio_20_2/Usuario.php";
    include "../Ejercicio_25/Producto.php";
    
    class Venta
    {
        private $idCliente;
        private $nombreCliente;
        private $codigoBarras;
        private $nombreProducto;
        private $precioProducto;
        private $cantidadCompra;
        private $precioFinal;
        
        public function __construct($idCliente , $nombreCliente , $codigoProducto ,  $nombreProducto , $precioProducto , $cantProductos , $precioFinal)
        {

            $this->idCliente = $idCliente;     
            $this->nombreCliente = $nombreCliente;                               
            $this->codigoBarras = $codigoProducto;
            $this->nombreProducto = $nombreProducto;
            $this->precioProducto = $precioProducto;
            $this->cantidadCompra = $cantProductos; 
            $this->precioFinal = $precioFinal;
        }

        public static function generateSell($idCliente , $codigoProducto , $cantProductos)
        {
            $auxUser = Usuario::return_userById($idCliente,"../Ejercicio_20_2/usuarios.csv");
            if(!is_null($auxUser) && gettype($auxUser) != "string")
            {
                $auxProd = Producto::return_prodByStripesCode($codigoProducto,"../Ejercicio_25/productos.csv");                
                if(!is_null($auxProd) && gettype($auxProd) != "string")
                {
                    //var_dump($auxProd);
                    if($cantProductos > 0)
                    {
                        $retornoTrySell = Venta::try_Sell($auxProd,$cantProductos);
                        if($retornoTrySell == 0)
                        {
                            //echo "AuxProd _stock aca vale: " . $auxProd->get_stock() . " -- Se esperaba: 8\n";
                            //en este punto ya si no tiro excepcion try_Sell, significa que pudoconcretar la venta
                            //y ya resto el stock, asi que me restaria tratar de actualizar el listado, retornando                          
                            $retornoValidateProduct = Producto::_validateProduct($auxProd,"../Ejercicio_25/productos.csv",true);
                            switch($retornoValidateProduct)
                            {
                                case "Actualizado":
                                    $precioTotal = $auxProd->get_precio() * $cantProductos;
                                    if(Venta::saveSell(new Venta($idCliente,$auxUser->get_nombre(),$codigoProducto,$auxProd->get_nombre(),$auxProd->get_precio(),$cantProductos,$precioTotal),"ventas.csv"))
                                    {
                                        return "Venta concretada..";
                                    }
                                break;
                                default:
                                    throw new Exception("Rompi todo de nuevo lcdll\n");
                                break;
                            }
                        }
                        return "No se pudo concretar la venta..";
                    }
                    else
                    {
                        throw new Exception("Error tipo: La cantidad de productos a comprar no pueden ser menores a 1..\n");    
                    }
                }
                else
                {
                    throw new Exception("Error tipo: " . $auxProd . "\n");    
                }
            }
            else
            {
                throw new Exception("Error tipo: " . $auxUser . "\n");
            }
        }

        private static function try_Sell($prod , $prodCant)
        {
            if(!is_null($prod))
            {
                $stockNuevo = $prod->get_stock() - $prodCant; 
                if($stockNuevo > -1)
                {
                    //echo "Entre a tratar de vender, el stock es: " . $prod->get_stock() . " y el stock a restar es: " . $prodCant . "\n";
                    if($prod->set_stock($stockNuevo))
                    {
                        //echo "Pude restar, el stock que queda es: " . $prod->get_stock() . "\n";
                        //echo "Entre, pude vender..\n";
                        return 0; //se pudo concretar la venta;
                    } 
                }
                return -2; //no alcanzo el stock.. 
            }
            return -1; //vino nullo o no es producto
        } 

        public static function saveSell($sell , $sellsFileName)
        {
            if(!is_null($sell) && get_class($sell) == "Venta" && !empty($sellsFileName))
            {
                $ar = fopen($sellsFileName, 'a');            
                if(!is_null($ar))
                {
                    fwrite($ar,implode(',', get_object_vars($sell)) . "\n");                                   
                    fclose($ar);
                    return true;
                }
                else
                {
                    echo "El archivo no se pudo abrir o crear..\n";
                }
            }
            return false;
        }
    }
?>