<?php
require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

class AjaxProductos{

    public $idCategoria;
    public function ajaxCrearCodigoProducto(){

        $item = "id_categoria";
        $valor = $this->idCategoria;

        $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor);

        echo json_encode($respuesta);

    }

    public $idProducto;

    public function ajaxEditarProducto(){
        $item = "id";
        $valor = $this->idProducto;

        $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor);

        echo json_encode($respuesta);
    }

}

if(isset($_POST["idCategoria"])){

    $codigoProducto = new  AjaxProductos();
    $codigoProducto ->idCategoria = $_POST["idCategoria"];
    $codigoProducto -> ajaxCrearCodigoProducto();

}

/* EDITAR PRODUCTO */
if(isset($_POST["idProducto"])){

    $editarProducto = new  AjaxProductos();
    $editarProducto ->idProducto = $_POST["idProducto"];
    $editarProducto -> ajaxEditarProducto();

}