<?php

require_once "conexion.php";

class ModeloRegiones{


	/*=============================================
	MOSTRAR UNIDADES
	=============================================*/

	static public function mdlMostrarRegiones($tabla, $item, $valor){

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

	static public function mdlMostrarComunas($tabla, $item, $valor) {
		try {
			if ($item != null) {
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
				$stmt->bindParam(":" . $item, $valor, PDO::PARAM_INT);
				$stmt->execute();
				return $stmt->fetchAll();
			} else {
				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
				$stmt->execute();
				return $stmt->fetchAll();
			}
		} catch (PDOException $e) {
			error_log('Error al obtener comunas: ' . $e->getMessage());
			return []; // Devuelve un array vacío en caso de error
		}
	}


}

