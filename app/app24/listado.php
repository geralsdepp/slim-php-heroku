<?php
    include "./usuario.php";
    if (isset($_GET["nombreListado"])) {
        $listado = $_GET["nombreListado"];

        switch ($listado) {
            case 'usuarios.json':                                               
                $arrayUsuarios = Usuario::listarJson($listado);
                echo Usuario::dibujarListaJson($arrayUsuarios);
                break;
            
            default:
                # code...
                break;
        }
    }

?>