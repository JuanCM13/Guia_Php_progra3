<?php

include "../Ejercicio_28/AccesoDatos_Ventas";
class Venta
{
    public $id_producto;
    public $id_usuario;
    public $cantidad;
    public $fecha_de_venta;

    public function __construct($idProd,$idUsuario,$cantidad,$fecha)
    {
        $this->id_producto = $idProd;
        $this->id_usuario = $idUsuario;
        $this->cantidad = $cantidad;
        $this->fecha_de_venta = $fecha;
    }

    public function printSell_Data()
    {
        return "Venta: \nId Producto: " . $this->id_producto . "\nId Usuario: " . $this->id_usuario . "\nFecha: " . $this->fecha_de_venta . 
        "\nCantidad: " . $this->cantidad . "\n";
    }

    public static function getAllSells_BD()
    {
        $objPDO = AccesoDatos_Ventas::dameUnObjetoAcceso();
        if(!is_null($objPDO))
        {
            try
            {
                $query = $objPDO->RetornarConsulta("SELECT id_producto AS idProducto , id_usuario AS idUsuario , cantidad , 
                fecha_de_venta AS fecha FROM ventas");
                $query->execute();
                //Acordarse de pasar el array de atributosde la clase a parsear, sino si le dejas el constructor
                //rompe, sino tambien, sin el constructor funca, pero limita el uso de toda la clase..
                //ESTA PORQUERIA NO FUNCIONA, NOMAS PUDE HACERLO ANDAR CON EL ASSOC Y CREAR OBJETOS A MANOPLA
                $arrRet = $query->fetchAll(PDO::FETCH_ASSOC);
                //var_dump($arrRet);

                $listadoVentas = array();
                foreach($arrRet as $venta)
                { 
                    array_push($listadoVentas,new Venta($venta['idProducto'],$venta['idUsuario'],$venta['cantidad'],$venta['fecha']));
                }

                /*foreach($listadoVentas as $item)
                {
                    echo "ID Producto:" . $item->id_producto . "\nID usuario: " . $item->id_usuario . "\ncantidad: " . $item->cantidad . "\nFecha: " . $item->fecha_de_venta;
                }*/

                return $listadoVentas;
            }
            catch(Exception $ex)
            {
                echo $ex->getMessage();
            }
        }
        return "Rompi todo";
    }

}


?>