<?php
require_once "conexion.php";

class ModeloProductos{

    /* MOSTRAR PRODUCTOS */
    public static function mdlMostrarProductos($tabla, $item, $valor){

        if($item != null){

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla  WHERE $item = :$item ORDER BY id DESC");

            $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

            $stmt -> execute();

            return $stmt -> fetch();
        }
        else{
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

            $stmt -> execute();

            return $stmt -> fetchAll();
        }

        $stmt -> close();

        $stmt = null;

    }

    /* REGISTRO */
    public static function mdlIngresarProducto($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_categoria, codigo, nombre, stock, precio_compra, precio_venta) VALUES (:id_categoria, :codigo, :nombre, :stock, :precio_compra, :precio_venta)");

        $stmt->bindParam(":id_categoria", $datos["id_categoria"], PDO::PARAM_INT);
        $stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":stock", $datos["stock"], PDO::PARAM_STR);
        $stmt->bindParam(":precio_compra", $datos["precio_compra"], PDO::PARAM_STR);
        $stmt->bindParam(":precio_venta", $datos["precio_venta"], PDO::PARAM_STR);

        if($stmt->execute()){
            return "ok";
            /* echo "Filas insertadas: ".$stmt->rowCount(); */
        }
        else{
            return "error";
            /* echo "Error: ".$stmt->errorInfo()[2]; */
            /* var_dump($stmt); */
        }

        $stmt->close();
        $stmt = null;

    }


    /* EDITAR */
    public static function mdlEditarProducto($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_categoria = :id_categoria, nombre = :nombre, 
        stock = :stock, precio_compra = :precio_compra, precio_venta = :precio_venta WHERE codigo = :codigo");

        $stmt->bindParam(":id_categoria", $datos["id_categoria"], PDO::PARAM_INT);
        $stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":stock", $datos["stock"], PDO::PARAM_STR);
        $stmt->bindParam(":precio_compra", $datos["precio_compra"], PDO::PARAM_STR);
        $stmt->bindParam(":precio_venta", $datos["precio_venta"], PDO::PARAM_STR);

        if($stmt->execute()){
            return "ok";
        }
        else{
            return "error";
        }

        $stmt->close();
        $stmt = null;

    }


    /* BORRAR PRODUCTO */
    public static function mdlEliminarProductos($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
        $stmt->bindParam(":id", $datos, PDO::PARAM_INT);

        if($stmt->execute()){
            return "ok";
        }
        else{
            return "error";
        }

        $stmt->close();
        $stmt = null;

    }

    /*=============================================
	ACTUALIZAR PRODUCTOS
	=============================================*/

	public static function mdlActualizarProducto($tabla, $item1, $valor1, $valor){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE id = :id");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":id", $valor, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

}