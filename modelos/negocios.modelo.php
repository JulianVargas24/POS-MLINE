<?php

require_once "conexion.php";

class ModeloNegocios{

	/*=============================================
	CREAR NEGOCIO
	=============================================*/

	static public function mdlIngresarNegocio($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(unidad_negocio, codigo) VALUES (:unidad_negocio, :codigo)");

        $stmt->bindParam(":unidad_negocio", $datos["unidad_negocio"], PDO::PARAM_STR);
        $stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;
	}

	/*=============================================
	MOSTRAR NEGOCIOS
	=============================================*/

	static public function mdlMostrarNegocios($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

    }

    static public function mdlEditarNegocio($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET unidad_negocio = :unidad_negocio, codigo = :codigo WHERE id = :id");

        $stmt -> bindParam(":unidad_negocio", $datos["unidad_negocio"], PDO::PARAM_STR);
        $stmt -> bindParam(":codigo", $datos["codigo"], PDO::PARAM_INT);
		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}


    static public function mdlEliminarNegocio($tabla, $datos){

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