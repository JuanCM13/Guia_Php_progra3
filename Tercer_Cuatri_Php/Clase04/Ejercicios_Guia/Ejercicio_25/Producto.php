<?php

class Producto
{
    //codigo barras(6 cifras),nombre,tipo,stock,precio
    private $_codigoBarras;
    private $_nombre;
    private $_tipo;
    private $_stock;
    private $_precio;
    private $_id;

    public function __construct($codB , $nomb , $tip , $stock , $prec)
    {
        $this->_codigoBarras = $codB;
        $this->_nombre = $nomb;
        $this->_tipo = $tip;
        $this->_stock = $stock;
        $this->_precio = $prec;
        $this->_id = rand(1,1000);
    }

    public function get_codigoBarras()
    {
        return $this->_codigoBarras;
    }

    public function get_nombre()
    {
        return $this->_nombre;
    }

    public function get_tipo()
    {
        return $this->_tipo;
    }

    public function get_stock()
    {
        return $this->_stock;
    }

    public function get_precio()
    {
        return $this->_precio;
    }

    public function get_id()
    {
        return $this->_id;
    }

    public function set_stock($valor)
    {
        if(is_numeric($valor) && $valor > -1)
        {
            $this->_stock = $valor;
            return true;
        }        
        return false;
    }

    //El tercer param recibe true si se desea mantener el producto intacto, si hay que actualizar por venta,
    //false, si desea agregar un producto ya existente y quiere sumarle el stock...
    public static function _validateProduct($produc , $fileName , $boolAgregarStockO_actualizarEnVenta)
    {
        $messageReturn = "No se pudo hacer";
        $addNewElement = true;

        //echo "Entre al segundo if validate product\n";
        if(!is_null($produc) && get_class($produc) == "Producto")
        {
            //echo "Entre al _validateProduct y pase el primer filtro..\n";
            $productsList = array($produc);
            //var_dump($productsList);
            if(file_exists($fileName))
            {
                $productsList = []; //vacio el array
                $productsList = Producto::leer_csv($fileName);
                if($productsList > 0)
                {
                    //echo "Entre al tercer if validate product, el listado de leer_csv fue mayor a cero..\n";
                    foreach($productsList as $itemProd)
                    {
                        if(Producto::compareProducts($itemProd , $produc))
                        {
                            if(!$boolAgregarStockO_actualizarEnVenta)
                            {
                                //echo "\nEntre al compare, son iguales..\n";
                                $itemProd->_stock += $produc->_stock;                             
                            }
                            else
                            {
                                $itemProd->set_stock($produc->get_stock());
                            }
                            $addNewElement = false;   
                            break;
                        }
                    }
                }

                if($addNewElement)
                {
                    array_push($productsList,$produc);
                }
            }

            if(Producto::saveProducts($productsList , $fileName))
            {
                if(!$addNewElement)
                {
                    $messageReturn = "Actualizado";
                }
                else
                {
                    $messageReturn = "Ingresado";
                }
            }
        }
        return $messageReturn;
    }

    public static function compareProducts($prodOne , $prodTwo)
    {
        if(!is_null($prodOne) && !is_null($prodTwo) && get_class($prodOne) == "Producto" && get_class($prodTwo) == "Producto")
        {
            return (strcmp($prodOne->_codigoBarras , $prodTwo->_codigoBarras) == 0 && strcmp($prodOne->_nombre , $prodTwo->_nombre) == 0);
        }
        return false;
    }

    public static function saveProducts($producAr , $fileName)
    {
        if(!is_null($producAr) && count($producAr) > 0)
        {
            $ar = fopen($fileName, 'w');            
            if(!is_null($ar))
            {
                foreach($producAr as $produc)
                {
                    fwrite($ar,implode(',', get_object_vars($produc)) . "\n");                                   
                }
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

    public static function leer_csv($fileName)
    {
        $arrProductos = array();
        if(!is_null($fileName) && file_exists($fileName))
        {
            $file = fopen($fileName,'r');
            if(!is_null($file))
            {
                //$arrProductos = array();
                while(!feof($file))
                {              
                    $linea = fgets($file);                        
                    if(!empty($linea))
                    {                            
                        $ret = explode(",",$linea);                                       
                        array_push($arrProductos, new Producto($ret[0],$ret[1],$ret[2],$ret[3],$ret[4]));
                    }                                               
                }
            }
            fclose($file);                
        }
        return $arrProductos;
    }

    public static function return_prodByStripesCode($stripesCode,$filePath)
    {
        //echo "Codigo barras: " . $stripesCode . "\n";
        if(!empty($stripesCode) && !is_null($filePath) && !empty($filePath))
        {
            $arrProdList = Producto::leer_Csv($filePath);
            if(!is_null($arrProdList) && count($arrProdList) > 0)
            {
                foreach($arrProdList as $prod)
                {
                    if($prod->_codigoBarras === $stripesCode)
                    {
                        return $prod;
                    }
                }
                return "El producto no existe en el listado! verifique..\n";
            }
            return "Error, no se encontro el archivo o este vino vacio..!\n";
        }
        return "Error, el parametro debe ser de tipo numerico y la ruta no puede ser nulla o vacia..!\n";
    }
}
?>