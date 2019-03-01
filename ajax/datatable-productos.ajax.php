<?php
require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";

class TablaProductos{
    
    /* MOSTRAR TABLA */
    public function mostrarTablaProductos(){

        $item = null;
        $valor = null;

        $productos = ControladorProductos::ctrMostrarProductos($item, $valor);

        $datosJson = '{
                        "data": [';
                        for($i = 0; $i<count($productos); $i++){

                            $botones =  "<div class='btn-group'><button type='button' class='btn btn-warning btnEditarProducto' idProducto='".$productos[$i]["id"]."' data-toggle='modal' data-target='#modalEditarProducto'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnEliminarProducto' idProducto='".$productos[$i]["id"]."' codigo='".$productos[$i]["codigo"]."'><i class='fa fa-times'></i></button></div>"; 

                            $item = "id";
                            $valor = $productos[$i]["id_categoria"];

                            $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

                            if($productos[$i]["stock"] <= 10){
                                $stock = "<button class='btn btn-danger'>".$productos[$i]["stock"]."</button>";    
                            }
                            else if($productos[$i]["stock"] > 11 && $productos[$i]["stock"] <= 15){
                                $stock = "<button class='btn btn-warning'>".$productos[$i]["stock"]."</button>";    
                            }
                            else{
                                $stock = "<button class='btn btn-success'>".$productos[$i]["stock"]."</button>";
                            }


                            $datosJson.= '[

                                            "'.($i+1).'",
                                            "'.$productos[$i]["nombre"].'",
                                            "'.$categorias["categoria"].'",
                                            "'.$productos[$i]["codigo"].'",
                                            "'.$stock.'",
                                            "'.$productos[$i]["precio_compra"].'",
                                            "'.$productos[$i]["precio_venta"].'",
                                            "",
                                            "'.$productos[$i]["fecha"].'",
                                            "'.$botones.'"

                                        ],';

                        }

                        $datosJson=substr($datosJson, 0, -1);

                        $datosJson.= ']
                    }';
                    
        echo $datosJson;

    }

}

/* ACTIVAR TABLA */
$activarProductos = new TablaProductos();
$activarProductos -> mostrarTablaProductos();