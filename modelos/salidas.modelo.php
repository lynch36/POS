<?php
require_once "conexion.php";

class ModeloSalidas{

    public static function mdlMostrarSalidas($tabla, $item, $valor){

        if($item != null){

            $stmt = Conexion::conectar()->prepare("SELECT *FROM $tabla WHERE $item = :$item ORDER BY fecha DESC");

            $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
            $stmt -> execute();

            return $stmt -> fetch();

        }

        else{

            $stmt = Conexion::conectar()->prepare("SELECT *FROM $tabla ORDER BY fecha DESC");  
            
            $stmt -> execute();

            return $stmt -> fetchAll();

        }

        $stmt -> close();
        $stmt = null;

    }

    /* REGISTRO SALIDA */
    public static function mdlIngresarSalida($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(codigo, motivo_salida, usuario, productos, total) 
        VALUES (:codigo, :motivo_salida, :usuario, :productos, :total)");

        $stmt -> bindParam(":codigo", $datos["codigo"], PDO::PARAM_INT);
        $stmt -> bindParam(":motivo_salida", $datos["motivo_salida"], PDO::PARAM_STR);
        $stmt -> bindParam(":usuario", $datos["usuario"], PDO::PARAM_INT);
        $stmt -> bindParam(":productos", $datos["productos"], PDO::PARAM_STR);
        $stmt -> bindParam(":total", $datos["total"], PDO::PARAM_STR);

        if($stmt->execute()){
            return "ok";
        }
        else{
            return "error";
        }

        $stmt->close();
        $stmt = null;

    }

}