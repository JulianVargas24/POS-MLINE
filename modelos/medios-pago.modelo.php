<?php

require_once "conexion.php";

class ModeloMediosPago{

	/*=============================================
	CREAR MEDIOS PAGO
	=============================================*/

	static public function mdlIngresarMedio($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(medio_pago) VALUES (:medio_pago)");

		$stmt->bindParam(":medio_pago", $datos, PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	MOSTRAR MEDIOS PAGOS
	=============================================*/

	static public function mdlMostrarMedios($tabla, $item, $valor){

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
	EDITAR MEDIOS PAGO
	=============================================*/

	static public function mdlEditarMedio($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET medio_pago = :medio_pago WHERE id = :id");

		$stmt -> bindParam(":medio_pago", $datos["medio_pago"], PDO::PARAM_STR);
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
	BORRAR MEDIO PAGO
	=============================================*/

	static public function mdlEliminarMedio($tabla, $datos){

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

