<?php 
include "./usuario.php";
    $usuario = new Usuario($_POST["nombre"], $_POST["clave"], $_POST["mail"]);
    
    Usuario::validarUsuario($usuario);
?>  