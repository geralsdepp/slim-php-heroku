<?php
    include "./usuario.php";
    if (isset($_GET["nombreListado"])) {
        $listado = $_GET["nombreListado"];

        switch ($listado) {
            case 'usuarios':               
                $arrayUsuarios = Usuario::getArrayUsuarios($listado);
                
                echo Usuario::listarUsurios($arrayUsuarios);
                break;
            
            default:
                # code...
                break;
        }
    }

?>