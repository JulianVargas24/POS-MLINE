<?php

require_once "conexion.php";

class ModeloUnidades{

	/*=============================================
	CREAR SUBCATEGORIA
	=============================================*/

	static public function mdlIngresarUnidad($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(medida) VALUES (:medida)");

		$stmt->bindParam(":medida", $datos, PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;
	}

	/*=============================================
	MOSTRAR UNIDADES
	=============================================*/

	static public function mdlMostrarUnidades($tabla, $item, $valor){

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

	/*=============================================
	EDITAR UNIDAD
	=============================================*/

	static public function mdlEditarUnidad($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET medida = :medida WHERE id = :id");

        $stmt -> bindParam(":medida", $datos["medida"], PDO::PARAM_STR);
		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	BORRAR UNIDAD
	=============================================*/

	static public function mdlBorrarUnidad($tabla, $datos){

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

