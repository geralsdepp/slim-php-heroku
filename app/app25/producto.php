<?php

class Producto
{
    public $codigoBarras;
    public $nombre;
    public $tipo;
    public $stock;
    public $precio;
    public $id;

    public function __construct($codigoBarras, $nombre, $tipo, $stock, $precio)
    {
        $ultimoId = "ultimoId.txt";
        $this->codigoBarras = $codigoBarras;
        $this->nombre = $nombre;
        $this->tipo = $tipo;
        $this->stock = $stock;
        $this->precio = $precio;
        $this->SetId();
    }

    static function addProducto($producto, $nombreArchivo)
    {        
        if ($producto != null && $nombreArchivo != null && strlen($nombreArchivo) > 5) {
            $atributo = "w";
            $saltoLinea = "";

            if (file_exists($nombreArchivo)) {
                $atributo = "a";
                $saltoLinea = "\n";            
            }
            
            $miArchivo = fopen($nombreArchivo, $atributo);
            fwrite($miArchivo, $saltoLinea.json_encode($producto));
            fclose($miArchivo);
            $retorno = true;
        }

        return $retorno;
    }

    static function listar($nombreArchivo)
    {
        $retorno = "No se pudo crear la lista";
        $arrayProductos = array();

        if ($nombreArchivo != null && file_exists($nombreArchivo)) {
            $retorno = "";
            $miArchivo = fopen($nombreArchivo, "r");
            while (!feof($miArchivo)) {
                array_push($arrayProductos, json_decode(fgets($miArchivo)));                
            }
            fclose($miArchivo);
        }
        if (count($arrayProductos) > 0) {
            $retorno = $arrayProductos;
        }
        return $retorno;
    }

    private function SetId()
    {
        $this->id = rand(1,1000000000);
        return true;
    }
    
    static function existenceValidate($producto, $nombreArchivo)
    {                
        $retorno = false;

        if ($producto != null && $nombreArchivo != null && strlen($nombreArchivo) > 5) {
            $arrayProductos = array();
            $arrayProductos = Producto::listar($nombreArchivo);
       
            foreach ($arrayProductos as $producto) {
                if ($producto->codigoBarras == $producto->codigoBarras) {
                    $retorno = true;
                    break;
                }                
            }
        }
        return $retorno;
    }

    static function addStock($producto, $nombreArchivo){
        $retorno = false;

        if (is_a($producto, "Producto")) {
            $arrayProductos = Producto::listar($nombreArchivo);
            unlink($nombreArchivo);
            foreach ($arrayProductos as $productoJson) {
                if ($producto->codigoBarras == $productoJson->codigoBarras) {
                    $productoJson->stock += intval($producto->stock);
                    $retorno = true;                
                }
                Producto::addProducto($productoJson, $nombreArchivo);
            }
        }
        return $retorno;
    }

}


?>