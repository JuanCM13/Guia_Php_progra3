<?php   
    class Usuario
    {
        private $nombre;
        private $mail;
        private $clave;
        private $id;

        public function  __construct($nombre , $mail , $clave , $id = -1)
        {
            $this->nombre = $nombre;
            $this->mail = $mail;
            $this->clave = $clave;
            if($id == -1)
            {
                $id = rand(1,1500);
            }
            
            $this->id = $id;
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
            return "Nombre: " . $this->nombre . "\nMail: " . $this->mail . "\nClave: " . $this->clave . "\nID: " . $this->id;
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
    }
?>