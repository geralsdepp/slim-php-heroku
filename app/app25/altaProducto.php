<?php
    require_once("./producto.php");
    $nombreArchivoJson = "productos.json";

    if (isset($_POST["codigoBarras"]) && isset($_POST["nombre"]) && isset($_POST["tipo"]) && 
    isset($_POST["stock"]) && isset($_POST["precio"])) {
        $codigoBarras = $_POST["codigoBarras"];
        $nombre = $_POST["nombre"];
        $tipo = $_POST["tipo"];
        $stock = $_POST["stock"];
        $precio = $_POST["precio"];

        $producto = new Producto($codigoBarras, $nombre, $tipo, $stock, $precio);
        var_dump($producto);
        if ($producto::existenceValidate($producto, $nombreArchivoJson)) {
            $producto::addStock($producto, $nombreArchivoJson);
            echo "Actualizado";        
        }
        else{
            $producto::addProducto($producto, $nombreArchivoJson);
            echo "Ingresado";
        }
    }
    else{
        echo "NO SE PUDO AGREGAR, FALTAN DATOS EN EL REQUEST";
    }

?>