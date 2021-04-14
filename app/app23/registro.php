<?php 
include "./usuario.php";

    if (isset($_POST['mail']) && isset($_POST['clave']) && isset($_POST['nombre'])) {
        $mail = $_POST['mail'];
        $clave = $_POST['clave'];
        $nombre = $_POST['nombre'];
        $usuario = new Usuario($nombre, $clave, $mail);
        Usuario::agregarUsuarioJson($usuario, "usuarios.json"); 
        echo Usuario::subirFoto($usuario, $_FILES["archivo_foto"], "usuario/fotos/");
    }
?>  