<?php

class Usuario
{
    public $nombre;
    public $clave;
    public $mail;

    public function __construct($nombre, $clave, $mail){
        if ($nombre != null && $clave != null && $mail != null) {
            $this->nombre = $nombre;
            $this->clave = $clave;
            $this->mail = $mail;
        }
        else{
            throw new Exception("No se pudo crear el usuario");
        }
    }
    public static function validarUsuario(Usuario $usuario)
    {
        
        if (isset($usuario->nombre) && isset($usuario->clave) && isset($usuario->mail)) {
                    
        Usuario::guardarUsuario($usuario);
        echo "Archivo Guardado"; 
                                                                                                   
        }
        else{
            echo "faltan datos";            
        } 
    }

    private static function guardarUsuario(Usuario $usuario)
    {
        $archivo = fopen("usuarios.csv", "a");
        fwrite($archivo, "$usuario->nombre, $usuario->clave, $usuario->mail\n");
        fclose($archivo);
    }

    public static function getArrayUsuarios($listado){
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

    public static function listarUsurios($arrayUsuarios)
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
}

?>
