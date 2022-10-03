<?php
include "../Ejercicio_28/AccesoDatos_Productos.php";
class Producto
{

    public $id;
    public $codigo;
    public $nombre;
    public $tipo;
    public $stock;
    public $precio;
    public $fechaIngreso;
    public $fechaModificacion;

    public function __construct($id = -1,$codigo,$nombre,$tipo,$stock,$precio,$fechaIngreso = -1,$fechaMod = -1)
    {
        if($id != -1)
        {
            $this->id = $id;
        }

        $this->codigo = $codigo;
        $this->nombre = $nombre;
        $this->tipo = $tipo;
        $this->stock = $stock;
        $this->precio = $precio;
        if($fechaIngreso != -1)
        {
            $this->fechaIngreso = $fechaIngreso;
        }

        if($fechaMod != -1)
        {
            $this->fechaModificacion = $fechaMod;        
        }
    }

    public function printProduct_Data()
    {
        return "Producto: \nId: " . $this->id . "\nCodigo: " . $this->codigo . "\nNombre: " . $this->nombre . 
        "\nTipo: " . $this->tipo . "\nStock: " . $this->stock . "\nPrecio: " . $this->precio . "\nFecha de Ingreso: " . $this->fechaIngreso . "\n
        Fecha de Modificacion: " . $this->fechaModificacion . "\n";
    }

    public static function getAllProducts_BD()
    {
        $objPDO = AccesoDatos_Productos::dameUnObjetoAcceso();
        if(!is_null($objPDO))
        {
            try
            {
                $query = $objPDO->RetornarConsulta("select id , codigo_de_barra as codigo , nombre , tipo , stock , precio ,
                fecha_de_creacion as fechaIngreso , fecha_de_modificacion as fechaModificacion from productos");
                $query->execute();
                //Acordarse de pasar el array de atributosde la clase a parsear, sino si le dejas el constructor
                //rompe, sino tambien, sin el constructor funca, pero limita el uso de toda la clase..
                $arrRet = $query->fetchAll(PDO::FETCH_ASSOC);
                //var_dump($arrRet);

                $arrProductos = array();
                foreach($arrRet as $producto)
                {
                    array_push($arrProductos,new Producto(
                        $producto['id'],
                        $producto['codigo'],
                        $producto['nombre'],
                        $producto['tipo'],
                        $producto['stock'],
                        $producto['precio'],
                        $producto['fechaIngreso'],
                        $producto['fechaModificacion']));
                }
                return $arrProductos;
            }
            catch(Exception $ex)
            {
                echo $ex->getMessage();
            }
        }
        return "Rompi todo";
    }
    /*  	public static function TraerTodoLosCds()
	{
			$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
			$consulta =$objetoAccesoDato->RetornarConsulta("select id,titel as titulo, interpret as cantante,jahr as año from cds");
			$consulta->execute();			
			return $consulta->fetchAll(PDO::FETCH_CLASS, "cd");		
	}*/

    public static function insertOrUpdate_Product_BD($product)
    {
        if(!is_null($product) && get_class($product) === "Producto")
        {
            $objPDO = AccesoDatos_Productos::dameUnObjetoAcceso();

            if(!is_null($objPDO))
            {
                $arrProds = Producto::getAllProducts_BD();
                $updatear = false;
                $montoAupdate;
                $fechaActual = date('Y-m-d');
                if(!is_null($arrProds) && count($arrProds) > 0)
                {
                    foreach($arrProds as $producto)
                    {
                        if($producto->codigo == $product->codigo)
                        {
                            $updatear = true;
                            $montoAupdate = $producto->stock += $product->stock;
                            break; 
                        }
                    }
                }

                if($updatear)
                {
                    $query = $objPDO->RetornarConsulta("UPDATE productos SET fecha_de_modificacion = :fech_mod , stock = :sto WHERE codigo_de_barra = :cod");
                    $query->bindValue(":cod",$product->codigo);
                    $query->bindValue(":fech_mod",$fechaActual);
                    $query->bindValue(":sto",$montoAupdate);
                }
                else //si no se actualiza, se inserta
                {
                    $query = $objPDO->RetornarConsulta("INSERT INTO productos (codigo_de_barra,nombre,tipo,stock,precio,fecha_de_creacion,fecha_de_modificacion)
                    VALUES (:cod , :nom , :tip , :sto , :pre , :fech_cre , :fech_mod)");
                    $query->bindValue(":cod",$product->codigo);
                    $query->bindValue(":nom",$product->nombre);
                    $query->bindValue(":tip",$product->tipo);
                    $query->bindValue(":sto",$product->stock);
                    $query->bindValue(":pre",$product->precio);
                    $query->bindValue(":fech_cre",$fechaActual);
                    $query->bindValue(":fech_mod","0000-00-00");
                }

                $query->execute();
                if($query->rowCount() > 0)
                {
                    if($updatear)
                    {
                        return "Actualizado";
                    }
                    return "Ingresado";
                }
            }
            return "No se pudo hacer";
        }
    }
                /*
                //echo "\nEntre acaaa\n";
                $existe = Producto::existsProduct_BD($product->codigo);
                $fechaActual = date('Y-m-d');
                //echo "\nEl producto es: " . $existe . "\n";
                if($existe != -1)
                {
                    switch($existe)
                    {
                        case -2: //osea que si cae aca, es por que no esta registrado en la base
                            $query = $objPDO->RetornarConsulta("INSERT INTO productos (codigo_de_barra,nombre,tipo,stock,precio,fecha_de_creacion,fecha_de_modificacion)
                            VALUES (:cod , :nom , :tip , :sto , :pre , :fech_cre , :fech_mod)");
                            $query->bindValue(":cod",$product->codigo);
                            $query->bindValue(":nom",$product->nombre);
                            $query->bindValue(":tip",$product->tipo);
                            $query->bindValue(":sto",$product->stock);
                            $query->bindValue(":pre",$product->precio);
                            $query->bindValue(":fech_cre",$fechaActual);
                            $query->bindValue(":fech_mod","0000-00-00");
                            break;
                        case 0: //cae aca, esta registrado, actualiza el stock..
                            //echo "\nEntre al -2...\n";
                            
                            $query = $objPDO->RetornarConsulta("UPDATE productos SET fecha_de_modificacion = :fech_mod , stock = :sto WHERE codigo_de_barra = :cod");
                            $query->bindValue(":cod",$product->codigo);
                            $query->bindValue(":fech_mod",$fechaActual);
                            $query->bindValue(":sto",$product->stock);
                            break;
                    }

                    $query->execute();
                    echo "\n\nEl row count da: " .$query->rowCount() . "\n\n";
                    if($query->rowCount() > 0)
                    {
                        if($existe == -2)
                        {
                            return "Ingresado";
                        }
                        return "Actualizado";
                    }
                }*/

    public static function existsProduct_BD($codigoBarras)
    {
        if(!is_null($codigoBarras))
        {
            $objPDO = AccesoDatos_Productos::dameUnObjetoAcceso();
            if(!is_null($objPDO))
            {
                $query = $objPDO->RetornarConsulta("SELECT * FROM productos WHERE codigo_de_barra = :Codigo");
                $query->bindValue(":Codigo",$codigoBarras);
                $query->execute();
                if($query->rowCount() > 0)
                {
                    return 0;
                }
                return -2; //no existe en la base..
            }
        }
        return -1; //algo vino mal
    }

}
?>