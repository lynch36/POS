<?php
class ControladorSalidas{

    public static function ctrMostrarSalidas($item, $valor){

        $tabla = "salidas";

        $respuesta = ModeloSalidas::mdlMostrarSalidas($tabla, $item, $valor);

        return $respuesta;

    }

    /* CREAR SALIDA */
    public static function ctrCrearSalida(){

        if(isset($_POST["nuevaSalida"])){

            $listaProductos = json_decode($_POST["listaProductos"], true);

            foreach ($listaProductos as $key => $value) {
                
                $tablaProductos = "productos";

                $item = "id";
                $valor = $value["id"];

                $traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor);

                $item1a = "ventas";
                $valor1a = $value["cantidad"] + $traerProducto["ventas"];

                $nuevasSalidas = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1a, $valor1a, $valor);

                $item1b = "stock";
                $valor1b = $value["stock"];

                $nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1b, $valor1b, $valor);

            }

            /* GUARDAR SALIDA */
            $tabla = "salidas";
            
            $datos = array("usuario" => $_POST["idUsuario"],
                           "codigo" => $_POST["nuevaSalida"],
                           "motivo_salida" => $_POST["motivoSalida"],
                           "productos" => $_POST["listaProductos"],
                           "total" => $_POST["totalSalida"]);

            $respuesta = ModeloSalidas::mdlIngresarSalida($tabla, $datos);

            if($respuesta == "ok"){
                    
                echo '<script>
                        localStorage.removeItem("rango");

                        swal({

                            type: "success",
                            title: "La salida ha sido guardada correctamente",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"

                        }).then(function(result){

                            if(result.value){
                            
                                window.location = "salidas";

                            }

                        });
                
                    </script>';

            }

        }

    }
    
}

