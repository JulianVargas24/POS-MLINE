<?php

require_once "conexion.php";

class ModeloPlantel{

    static public function mdlMostrarPlantel($tabla, $item, $valor){

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
    
    static public function mdlIngresarPlantel($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre, rut, cargo, comision) VALUES (:nombre, :rut, :cargo, :comision)");

		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":rut", $datos["rut"], PDO::PARAM_STR);
		$stmt->bindParam(":cargo", $datos["cargo"], PDO::PARAM_STR);
		$stmt->bindParam(":comision", $datos["comision"], PDO::PARAM_INT);



		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

    }
    
    static public function mdlEliminarPlantel($tabla, $datos){

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
    
    static public function mdlEditarPlantel($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, rut = :rut, cargo = :cargo, comision = :comision WHERE id = :id");

		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":rut", $datos["rut"], PDO::PARAM_STR);
		$stmt->bindParam(":cargo", $datos["cargo"], PDO::PARAM_STR);
		$stmt->bindParam(":comision", $datos["comision"], PDO::PARAM_INT);


		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	public static function verificarRut($rut, $id = null) {
		$db = Conexion::conectar();
		$sql = "SELECT COUNT(*) as total FROM plantel WHERE rut = :rut";
		
		// Si se está editando, excluye el ID actual de la búsqueda
		if ($id !== null) {
			$sql .= " AND id != :id";
		}
	
		$stmt = $db->prepare($sql);
		$stmt->bindParam(':rut', $rut, PDO::PARAM_STR);
	
		if ($id !== null) {
			$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		}
	
		$stmt->execute();
		$resultado = $stmt->fetch(PDO::FETCH_ASSOC);
		return $resultado['total'] > 0;
	}

}