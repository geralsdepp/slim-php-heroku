<?php

include "./usuario.php";

$usuario = new Usuario(" ", $_POST["clave"], $_POST["mail"]);

    echo Usuario::login($usuario);

?>