<?php

require_once "conexion.php";

class ModeloBancos {
    
    /*=============================================
    MOSTRAR BANCOS
    =============================================*/
    static public function mdlMostrarBancos($tabla, $item, $valor) {
        if($item != null) {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
            $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
            $stmt -> execute();
            return $stmt -> fetch();
        } else {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
            $stmt -> execute();
            return $stmt -> fetchAll();
        }
        $stmt -> close();
        $stmt = null;
    }

    /*=============================================
    INGRESAR BANCO
    =============================================*/
    static public function mdlIngresarBanco($tabla, $datos) {
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (nombre_banco, codigo) VALUES (:nombre_banco, :codigo)");
        $stmt->bindParam(":nombre_banco", $datos["nombre_banco"], PDO::PARAM_STR);
        $stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);

        if($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
        $stmt->close();
        $stmt = null;
    }

    /*=============================================
    EDITAR BANCO
    =============================================*/
    static public function mdlEditarBanco($tabla, $datos) {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre_banco = :nombre_banco, codigo = :codigo WHERE id = :id");

        $stmt->bindParam(":nombre_banco", $datos["nombre_banco"], PDO::PARAM_STR);
        $stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
        $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
    
        if($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt->close();
        $stmt = null;
    }

    /*=============================================
    ELIMINAR BANCO
    =============================================*/
    static public function mdlBorrarBanco($tabla, $datos){
      
        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
      
        $stmt -> bindParam(":id", $datos, PDO::PARAM_INT);
      
        if($stmt -> execute()){
      
            return "ok";
      
        }else{
      
            return "error";	
      
        }
      
        $stmt -> close();
      
        $stmt = null;
      
    }
       
}