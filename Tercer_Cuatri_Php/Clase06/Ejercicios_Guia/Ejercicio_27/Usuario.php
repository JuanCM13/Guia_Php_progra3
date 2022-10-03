<?php   
    include "../Ejercicio_27/AccesoDatos_Usuarios.php";
    class Usuario
    {
        private $id;
        private $nombre;
        private $apellido;
        private $clave;
        private $mail;
        private $date;
        private $localidad;

        public function  __construct($id = -1, $nombre , $apellido , $clave , $mail , $localidad , $date = -1 )
        {
            $this->nombre = $nombre;
            $this->apellido = $apellido;
            $this->mail = $mail;
            $this->clave = $clave;
            $this->id = $id;
            $this->localidad = $localidad;
            if($date = -1)
            {
                $date = date('Y-m-d');  
            }
            $this->date = $date;
        }

        public function get_nombre()
        {
            return $this->nombre;
        }
        
        public function get_clave()
        {
            return $this->clave;
        }

        public function get_mail()
        {
            return $this->mail;
        }

        public function get_id()
        {
            return $this->id;
        }

        public function _mostrarUsuario()
        {
            return "Nombre: " . $this->nombre . "\nApellido:" .$this->apellido. "\nMail: " . $this->mail . "\nClave: " . $this->clave . "\nID: " . $this->id.
            "\nFecha de Registro: " . $this->date . "\nLocalidad: ". $this->localidad . "\n\n\n";
        }

        public static function guardar_Csv($usuario , $nombreArchivo)
        {
            if(!is_null($usuario))
            {
                $ar = fopen($nombreArchivo, 'a');            
                if(!is_null($ar))
                {
                    fwrite($ar,implode(',', get_object_vars($usuario)) . "\n");                                   
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

        public static function leer_Csv($rutaAr)
        {
            $arrUsuarios = null;
            if(!is_null($rutaAr) && file_exists($rutaAr))
            {
                $file = fopen($rutaAr,'r');
                if(!is_null($file))
                {
                    $arrUsuarios = array();
                    while(!feof($file))
                    {              
                        $linea = fgets($file);                        
                        if(!empty($linea))
                        {                            
                            $ret = explode(",",$linea);                                       
                            array_push($arrUsuarios, new Usuario($ret[0],$ret[1],$ret[2],$ret[3]));
                        }                                               
                    }
                }
                fclose($file);                
            }
            return $arrUsuarios;
        }

        public static function exists_User($usuario)
        {
            $arrUsers;
            $retorno = "Usuario no registrado\n";
            if(!is_null($usuario))
            {
                $arrUsers = Usuario::leer_Csv("../Ejercicio_20_2/usuarios.csv");
                if(!is_null($arrUsers) && count($arrUsers) > 0)
                {
                    foreach($arrUsers as $itemUser)
                    {
                        $result = Usuario::compare_users($itemUser , $usuario);
                        if($result != -2) 
                        {
                            switch($result)
                            {
                                case -1:
                                    $retorno = "Error, algun element fue nullo..\n";
                                    break;
                                case 1:
                                    $retorno = "Verificado\n"; 
                                    break;
                                case 2:
                                    $retorno = "Error en los datos\n";
                                    break;
                            }
                            break;
                        }    
                    }
                }
                else
                {
                    throw new Exception('Error, el archivo "usuarios.csv" fue nulo o el listado esta vacio, no podemos compararlo..');
                }
            }
            return $retorno;
        }

        private static function compare_users($userA , $userB)
        {
            $ret = -1; //error, por nullidad o por distinto tipo objeto
            if(!is_null($userA) && !is_null($userA) && get_class($userA) == 'Usuario' &&  get_class($userB) == 'Usuario')
            {
                if($userA->mail == $userB->mail)
                {
                    if($userA->clave == $userB->clave)
                    {
                        $ret = 1;//existe y escorrecta la clave
                    }
                    else
                    {
                        $ret = 2; //existe pero esta mal la clave
                    }
                }
                else
                {
                    $ret = -2; //no esta registrado el mail..
                }
            }
            return $ret;
        }

        public static function return_userById($idUser,$filePath)
        {
            if(is_numeric($idUser) && !is_null($filePath) && !empty($filePath))
            {
                $arrUsersList = Usuario::leer_Csv($filePath);
                if(!is_null($arrUsersList) && count($arrUsersList) > 0)
                {
                    //estuve 3 horas, pero claro, al implodearlo, justo al ultimo atributo se le agrega el \n, en usuario al id... duh
                    //al comparar nunca entraba al if, por que uno es solamente el id y el otro es el id+\n...
                    $idUserMasSaltoDeLinea = $idUser . "\n";                    
                    foreach($arrUsersList as $user)
                    {
                        if($user->id == $idUserMasSaltoDeLinea)
                        {
                            return $user;
                        }
                    }
                    return "El usuario no existe en el listado! verifique..\n";
                }
                return "Error, no se encontro el archivo o este vino vacio..!\n";
            }
            return "Error, el parametro debe ser de tipo numerico y la ruta no puede ser nulla o vacia..!\n";
        }

        public function pushUser_DB()
        {
            try
            {
                $instancePDO = AccesoDatos_Usuarios::dameUnObjetoAcceso();
                /*echo "Entre";
                echo "\n\n";
                echo "Id: " . $this->id;
                echo "nombre: " . $this->nombre;
                echo "apellido: " . $this->apellido;
                echo "clave: " . $this->clave;
                echo "mail: " . $this->mail;
                echo "localidad: " . $this->localidad;
                echo "\n\n";*/
                if(!is_null($instancePDO))
                {
                    echo "Clave 2da rep: " . $this->clave;
                    $consult = $instancePDO->RetornarConsulta("insert into usuarios (nombre,apellido,clave,mail,fecha_de_registro,localidad)values(:nom,:ape,:cla,:mai,:fecha,:loc)");
                    $consult->bindValue(":nom",$this->nombre);
                    $consult->bindValue(":ape",$this->apellido);
                    $consult->bindValue(":cla",$this->clave);
                    $consult->bindValue(":mai",$this->mail);
                    $consult->bindValue(":loc",$this->localidad);
                    $consult->bindValue(":fecha",$this->date);
                    $consult->execute();
                    return $consult->rowCount();
                }
            }
            catch(Exception $ex)
            {
                return "Error: " . $ex->getMessage();
            }
        }

        public static function getAllUsers_BD()
        {
            $objPDO = AccesoDatos_Usuarios::dameUnObjetoAcceso();
            if(!is_null($objPDO))
            {
                try
                {
                    $query = $objPDO->RetornarConsulta("select id , nombre , apellido , clave , mail , fecha_de_registro AS date ,
                    localidad FROM usuarios");
                    $query->execute();
                    //Acordarse que con el fetch class no anda esta porqueria
                    $atributos = get_class_vars("Usuario");
                    $arrRet = $query->fetchAll(PDO::FETCH_ASSOC);
                    //var_dump($arrRet);
                    $arrUsers = array();

                    foreach($arrRet as $user)
                    {
                        array_push($arrUsers,new Usuario(
                            $user['id'],
                            $user['nombre'],
                            $user['apellido'],
                            $user['clave'],
                            $user['mail'],
                            $user['localidad'],
                            $user['date']));
                    }
                    
                    return $arrUsers;
                }
                catch(Exception $ex)
                {
                    echo $ex->getMessage();
                }
            }
            return "Rompi todo";
        }

            //Retorna booleano, si lo encuentra true : false
        public static function userExists($userMail, $userPass)
        {
            if(is_numeric($userPass) && gettype($userMail) == "string")
            {
                $objPDO = AccesoDatos_Usuarios::dameUnObjetoAcceso();
                if(!is_null($objPDO))
                {
                    try
                    {
                        $query = $objPDO->RetornarConsulta("SELECT * FROM usuarios WHERE mail = :Mail");
                        $query2 = $objPDO->RetornarConsulta("SELECT * FROM usuarios WHERE clave = :Clave");
                        $query->bindValue(":Mail",$userMail);
                        $query2->bindValue(":Clave",$userPass);
                        
                        $query->execute();
                        $query2->execute();
                        
                        if($query->rowCount() != 0)
                        {
                            if($query2->rowCount() != 0)
                            {
                                return 0;//existe el mail y es correcta la clave
                            }
                            else
                            {
                                return -2;//existe el mail pero mal la clave
                            }
                        }
                        else
                        {
                            return -1; //no existe el mail...
                        }
                    }
                    catch(Exception $ex)
                    {
                        echo $ex->getMessage();
                    }
                }
            }
            return false;
        }
    }
?>



-------------------------------------------------------------------------------------------
<?php
/*    include "../PDO/AccesoDatos.php";
    class Usuario{
        
        private $id;
        private $nombre;
        private $apellido;
        private $clave;
        private $mail;
        private $localidad;
    
        function __construct($id,$nombre,$apellido,$clave,$mail,$localidad)
        {
            $this->id = $id;
            $this->nombre = $nombre;
            $this->apellido = $apellido;
            $this->clave = $clave;
            $this->mail = $mail;
            $this->localidad = $localidad;
        }

        function pushUser_DB()
        {
            try
            {
                $instancePDO = AccesoDatos::dameUnObjetoAcceso();
                echo "Entre";
                echo "\n\n";
                echo "Id: " . $this->id;
                echo "nombre: " . $this->nombre;
                echo "apellido: " . $this->apellido;
                echo "clave: " . $this->clave;
                echo "mail: " . $this->mail;
                echo "localidad: " . $this->localidad;
                echo "\n\n";
                    
                $consult = $instancePDO->RetornarConsulta("insert into usuario (id,nombre,apellido,clave,mail,localidad)values(:id,:nom ,:ape,:cla,:mai,:loc)");
                $consult->bindValue(":id",$this->id);
                $consult->bindValue(":nom",$this->nombre);
                $consult->bindValue(":ape",$this->apellido);
                $consult->bindValue(":cla",$this->clave);
                $consult->bindValue(":mai",$this->mail);
                $consult->bindValue(":loc",$this->localidad);
                $consult->execute();
                return $consult->rowCount();
            }
            catch(Exception $ex)
            {
                return "Error: " . $ex->getMessage();
            }
        }

        
    }*/
?>