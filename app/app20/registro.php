<?php 
include "./usuario.php";
    $usuario = new Usuario($usuario->nombre, $usuario->clave, $usuario->mail);
    $usuario->nombre = $_POST["nombre"];
    $usuario->clave = $_POST["clave"];
    $usuario->mail = $_POST["mail"];

    Usuario::validarUsuario($usuario);
?>  