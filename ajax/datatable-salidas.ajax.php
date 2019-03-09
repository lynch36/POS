<?php
require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";

class TablaProductosSalidas{
    
    /* MOSTRAR TABLA */
    public function mostrarTablaProductosSalidas(){

        $item = null;
        $valor = null;

        $productos = ControladorProductos::ctrMostrarProductos($item, $valor);

        $datosJson = '{
                        "data": [';
                        for($i = 0; $i<count($productos); $i++){

                            $botones =  "<div class='btn-group'><button class='btn btn-primary agregarProducto recuperarBoton' idProducto='".$productos[$i]["id"]."'>Agregar</button></div>"; 

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
                                            "'.$stock.'",
                                            "",
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
$activarProductos = new TablaProductosSalidas();
$activarProductos -> mostrarTablaProductosSalidas();