<?php
class ControladorProductos{
    
    /* MOSTRAR PRODUCTOS */
    public static function ctrMostrarProductos($item, $valor){
        $tabla = "productos";

        $respuesta = ModeloProductos::mdlMostrarProductos($tabla, $item, $valor);

        return $respuesta;
    }

    public static function ctrCrearProducto(){
        
        if(isset($_POST["nuevoNombre"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"]) &&
			   preg_match('/^[0-9]+$/', $_POST["nuevaCantidad"]) &&	
			   preg_match('/^[0-9.]+$/', $_POST["nuevoPrecioCompra"]) &&
			   preg_match('/^[0-9.]+$/', $_POST["nuevoPrecioVenta"])){

                $tabla = "productos";

                $datos = array("id_categoria" => $_POST["nuevaCategoria"],
                               "codigo" => $_POST["nuevoCodigo"],
                               "nombre" => $_POST["nuevoNombre"],
                               "stock" => $_POST["nuevaCantidad"],
                               "precio_compra" => $_POST["nuevoPrecioCompra"],
                               "precio_venta" => $_POST["nuevoPrecioVenta"]);

                $respuesta = ModeloProductos::mdlIngresarProducto($tabla, $datos);

                if($respuesta == "ok"){
                    
                    echo '<script>
    
                            swal({
    
                                type: "success",
                                title: "El producto ha sido guardado correctamente",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar"
    
                            }).then(function(result){
    
                                if(result.value){
                                
                                    window.location = "productos";
    
                                }
    
                            });
                    
                        </script>';

                }

            }
            else{
                echo '<script>

                        swal({

                            type: "error",
                            title: "¡No puede llevar campos vacios o tener caracteres especial",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"

                        }).then(function(result){

                            if(result.value){
                            
                                window.location = "productos";

                            }

                        });
				
					</script>';
            }

        }

    }


    public static function ctrEditarProducto(){
        
        if(isset($_POST["editarNombre"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombre"]) &&
			   preg_match('/^[0-9]+$/', $_POST["editarCantidad"]) &&	
			   preg_match('/^[0-9.]+$/', $_POST["editarPrecioCompra"]) &&
			   preg_match('/^[0-9.]+$/', $_POST["editarPrecioVenta"])){

                $tabla = "productos";

                $datos = array("id_categoria" => $_POST["editarCategoria"],
                               "codigo" => $_POST["editarCodigo"],
                               "nombre" => $_POST["editarNombre"],
                               "stock" => $_POST["editarCantidad"],
                               "precio_compra" => $_POST["editarPrecioCompra"],
                               "precio_venta" => $_POST["editarPrecioVenta"]);

                $respuesta = ModeloProductos::mdlEditarProducto($tabla, $datos);

                if($respuesta == "ok"){
                    
                    echo '<script>
    
                            swal({
    
                                type: "success",
                                title: "El producto ha sido editado correctamente",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar"
    
                            }).then(function(result){
    
                                if(result.value){
                                
                                    window.location = "productos";
    
                                }
    
                            });
                    
                        </script>';

                }

            }
            else{
                echo '<script>

                        swal({

                            type: "error",
                            title: "¡No puede llevar campos vacios o tener caracteres especial",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"

                        }).then(function(result){

                            if(result.value){
                            
                                window.location = "productos";

                            }

                        });
				
					</script>';
            }

        }

    }


    /* BORRAR PRODUCTO */
    public static function ctrEliminarProducto(){

        if(isset($_GET["idProducto"])){

            $tabla = "productos";
            $datos = $_GET["idProducto"];
            
            $respuesta = ModeloProductos::mdlEliminarProductos($tabla, $datos);

            if($respuesta == "ok"){
                    
                echo '<script>

                        swal({

                            type: "success",
                            title: "El producto ha sido eliminado correctamente",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"

                        }).then(function(result){

                            if(result.value){
                            
                                window.location = "productos";

                            }

                        });
                
                    </script>';

            }

        }

    }

}
