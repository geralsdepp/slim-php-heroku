<?php

class Usuario
{
    public $nombre;
    public $clave;
    public $mail;

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
        fwrite($archivo, "$usuario->nombre, $usuario->clave, $usuario->mail,".date("Ymd")."\n");
        fclose($archivo);
    }
}

?>
