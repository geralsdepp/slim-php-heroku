<?php

class Usuario
{
    public $nombre;
    public $clave;
    public $mail;
    public $id;
    public $fechaDeRegistro;

    public function __construct($nombre, $clave, $mail){
        $ruta = "ultimoId.txt";
        $this->nombre = $nombre;
        $this->clave = $clave;
        $this->mail = $mail;
        $this->SetId();
        $this->SetFechaDeRegistro();
        
    }

    public function SetId()
    {
        $this->id = rand(1,1000000000);
        return true;
    }

    public function SetFechaDeRegistro()
    {
        $this->fechaDeRegistro = date("d-m-Y");
        return true;
    }

    public static function agregarUsuarioJson($usuario, $nombreArchivo){
        $retorno = false;
        if (is_a($usuario, "Usuario") && $nombreArchivo != null && strlen($nombreArchivo) > 5) {
            $atributo = "w";
            $saltoDeLinea = "";
            if (file_exists($nombreArchivo)) {
                $atributo = "a";
                $saltoDeLinea = "\n";
            }
            $miArhivo = fopen($nombreArchivo, $atributo);
            fwrite($miArhivo, $saltoDeLinea.json_encode($usuario));
            fclose($miArhivo);
            $retorno = true;
        }
        return $retorno;
    }

    public static function subirFoto($usuario, $file, $path){
        $retorno = false;
        if (is_a($usuario, "Usuario") && $file != null && strlen($path) > 2 && strpos($path, "/") != null) {
            switch ($file["type"]) {
                case "image/jpeg":
                    $extension = ".jpg";
                    break;
                case "image/gif":
                    $extension = ".gif";
                    break;
                case "image/png":
                    $extension = ".png";
                    break;
                default:
                    return "NO ES UN ARCHHIVO IMAGEN";
                    break;
            }

            $destino = $path.$usuario->nombre."_".$usuario->id.$extension;
           
            move_uploaded_file($file["tmp_name"],$destino);
            $retorno = "SE SUBIO la imagen correctamente";
        }
        return $retorno;
    }

    public static function listarJson($nombreArchivo)
    {
        $retorno = "No se pudo crear la lista";
        $arrayUsuarios = array();
        
        if ($nombreArchivo != null) {
            $retorno = "";
            
            $miArhivo = fopen($nombreArchivo, "r");
            while (!feof($miArhivo)) {
                array_push($arrayUsuarios, json_decode(fgets($miArhivo)));                
            }
            fclose($miArhivo);
        }
        if (count($arrayUsuarios) > 0) {
            $retorno = $arrayUsuarios;
        }
        return $retorno;
    }

    public static function dibujarListaJson($arrayUsuarios)
    {
        $retorno = "";
        if ($arrayUsuarios != null) {
            foreach ($arrayUsuarios as $value) {
                $retorno .= "<ul>";
                $retorno .= "<li>". $value->nombre . "," . $value->nombre."_".$value->id.".jpg"."</li>";
                $retorno .= "</ul>";
            }
        }
        return $retorno;
    }


    public static function validarUsuario(Usuario $usuario)
    {
        
        if (isset($usuario->nombre) && isset($usuario->clave) && isset($usuario->mail)) {
                    
            Usuario::guardarUsuarioCSV($usuario);
            echo "Archivo Guardado"; 
                                                                                                   
        }
        else{
            echo "faltan datos";            
        } 
    }

    private static function guardarUsuarioCSV(Usuario $usuario)
    {
        $archivo = fopen("usuarios.csv", "a");
        fwrite($archivo, "$usuario->nombre, $usuario->clave, $usuario->mail\n");
        fclose($archivo);
    }

    public static function getArrayUsuariosCSV($listado){
        $retorno = "No se cargó la lista";
        $arrayUsuarios = array();
        
        if ($listado != null) {
            $retorno = "";
            
            $archivo = fopen("$listado.csv", "r");
            while (!feof($archivo)) {
                $tempArray = explode(",",fgets($archivo));
                    
                $tempArrayKeyValue = array("nombre"=>$tempArray[0], "clave"=>$tempArray[1], "mail"=>$tempArray[2]);     
                       
                $objTemp = new Usuario($tempArrayKeyValue["nombre"],$tempArrayKeyValue["clave"],$tempArrayKeyValue["mail"]);                
                array_push($arrayUsuarios,$objTemp);
            }
            fclose($archivo);   
        }
        if(count($arrayUsuarios) > 0)
        {
            $retorno = $arrayUsuarios;
        }
        return $retorno;
    }

    public static function listarUsuriosCSV($arrayUsuarios)
    {
        $retorno = "";
        if ($arrayUsuarios != null) {
            foreach ($arrayUsuarios as $value) {                
                $retorno .="<ul>";
                foreach ($value as $dato){
                    $retorno .= "<li>".$dato."</li>";
                }
                $retorno .= "</ul>";
            }
        }
        return $retorno;
    }

    public static function loginCSV($usuario){
        $arrayUsuarios = Usuario::getArrayUsuariosCSV("usuarios");
        $mensaje = "Error en los datos";

        if ($arrayUsuarios != null) {
            foreach ($arrayUsuarios as $value) {
                if ($usuario->mail == $value->mail) {
                    $mensaje = "No coincide la clave";
                    if ($value->clave === $usuario->clave) {                        
                        $mensaje = "Verificado";
                        break;
                    }                
                }                
            }
        }

        return $mensaje;
    }
}

?>
