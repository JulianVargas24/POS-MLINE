<?php

require_once "conexion.php";

class ModeloPersonal{

	/*=============================================
	CREAR PERSONAL
	=============================================*/

	static public function mdlIngresarPersonal($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre, rut, email, telefono, id_cliente, busto, cintura, cadera, ancho_espalda, talle_delantero, talle_espalda, largo_manga, largo_blusa, largo_guillete, largo_chaqueta, largo_polera, largo_parka, largo_polar, largo_vestido, pantalon_cintura, pantalon_cadera, pantalon_tiro, pantalon_entrepierna, pantalon_muslo, pantalon_rodilla, pantalon_basta, largo_pantalon, falda_cintura, falda_cadera, largo_falda) 
												VALUES (:nombre, :rut, :email, :telefono, :id_cliente, :busto, :cintura, :cadera, :ancho_espalda, :talle_delantero, :talle_espalda, :largo_manga, :largo_blusa, :largo_guillete, :largo_chaqueta, :largo_polera, :largo_parka, :largo_polar, :largo_vestido, :pantalon_cintura, :pantalon_cadera, :pantalon_tiro, :pantalon_entrepierna, :pantalon_muslo, :pantalon_rodilla, :pantalon_basta, :largo_pantalon, :falda_cintura, :falda_cadera, :largo_falda)");

		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":rut", $datos["rut"], PDO::PARAM_STR);
		$stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt->bindParam(":id_cliente", $datos["empresa"], PDO::PARAM_INT);
		$stmt->bindParam(":busto", $datos["busto"], PDO::PARAM_STR);
		$stmt->bindParam(":cintura", $datos["cintura"], PDO::PARAM_STR);
		$stmt->bindParam(":cadera", $datos["cadera"], PDO::PARAM_STR);
		$stmt->bindParam(":ancho_espalda", $datos["ancho_espalda"], PDO::PARAM_STR);
		$stmt->bindParam(":talle_delantero", $datos["talle_delantero"], PDO::PARAM_STR);
		$stmt->bindParam(":talle_espalda", $datos["talle_espalda"], PDO::PARAM_STR);
		$stmt->bindParam(":largo_manga", $datos["largo_manga"], PDO::PARAM_STR);
		$stmt->bindParam(":largo_blusa", $datos["largo_blusa"], PDO::PARAM_STR);
		$stmt->bindParam(":largo_guillete", $datos["largo_guillete"], PDO::PARAM_STR);
		$stmt->bindParam(":largo_chaqueta", $datos["largo_chaqueta"], PDO::PARAM_STR);
		$stmt->bindParam(":largo_polera", $datos["largo_polera"], PDO::PARAM_STR);
		$stmt->bindParam(":largo_parka", $datos["largo_parka"], PDO::PARAM_STR);
		$stmt->bindParam(":largo_polar", $datos["largo_polar"], PDO::PARAM_STR);
		$stmt->bindParam(":largo_vestido", $datos["largo_vestido"], PDO::PARAM_STR);
		$stmt->bindParam(":pantalon_cintura", $datos["pantalon_cintura"], PDO::PARAM_STR);
		$stmt->bindParam(":pantalon_cadera", $datos["pantalon_cadera"], PDO::PARAM_STR);
		$stmt->bindParam(":pantalon_tiro", $datos["pantalon_tiro"], PDO::PARAM_STR);
		$stmt->bindParam(":pantalon_entrepierna", $datos["pantalon_entrepierna"], PDO::PARAM_STR);
		$stmt->bindParam(":pantalon_muslo", $datos["pantalon_muslo"], PDO::PARAM_STR);
		$stmt->bindParam(":pantalon_rodilla", $datos["pantalon_rodilla"], PDO::PARAM_STR);
		$stmt->bindParam(":pantalon_basta", $datos["pantalon_basta"], PDO::PARAM_STR);
		$stmt->bindParam(":largo_pantalon", $datos["largo_pantalon"], PDO::PARAM_STR);
		$stmt->bindParam(":falda_cintura", $datos["falda_cintura"], PDO::PARAM_STR);
		$stmt->bindParam(":falda_cadera", $datos["falda_cadera"], PDO::PARAM_STR);
		$stmt->bindParam(":largo_falda", $datos["largo_falda"], PDO::PARAM_STR);



		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	MOSTRAR PERSONAL
	=============================================*/

	static public function mdlMostrarPersonal($tabla, $item, $valor){

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
	EDITAR PERSONAL
	=============================================*/

	static public function mdlEditarPersonal($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, rut = :rut, email = :email, telefono = :telefono, id_cliente = :id_cliente, busto = :busto, cintura = :cintura, cadera = :cadera, ancho_espalda = :ancho_espalda, talle_delantero = :talle_delantero, talle_espalda = :talle_espalda, largo_manga = :largo_manga, largo_blusa = :largo_blusa, largo_guillete = :largo_guillete, largo_chaqueta = :largo_chaqueta, largo_polera = :largo_polera, largo_parka = :largo_parka, largo_polar = :largo_polar, largo_vestido = :largo_vestido, pantalon_cintura = :pantalon_cintura, pantalon_cadera = :pantalon_cadera, pantalon_tiro = :pantalon_tiro, pantalon_entrepierna = :pantalon_entrepierna, pantalon_muslo = :pantalon_muslo, pantalon_rodilla = :pantalon_rodilla, pantalon_basta = :pantalon_basta, largo_pantalon = :largo_pantalon, falda_cintura = :falda_cintura, falda_cadera = :falda_cadera, largo_falda = :largo_falda WHERE id = :id");

		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":rut", $datos["rut"], PDO::PARAM_STR);
		$stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt->bindParam(":id_cliente", $datos["empresa"], PDO::PARAM_INT);
		$stmt->bindParam(":busto", $datos["busto"], PDO::PARAM_STR);
		$stmt->bindParam(":cintura", $datos["cintura"], PDO::PARAM_STR);
		$stmt->bindParam(":cadera", $datos["cadera"], PDO::PARAM_STR);
		$stmt->bindParam(":ancho_espalda", $datos["ancho_espalda"], PDO::PARAM_STR);
		$stmt->bindParam(":talle_delantero", $datos["talle_delantero"], PDO::PARAM_STR);
		$stmt->bindParam(":talle_espalda", $datos["talle_espalda"], PDO::PARAM_STR);
		$stmt->bindParam(":largo_manga", $datos["largo_manga"], PDO::PARAM_STR);
		$stmt->bindParam(":largo_blusa", $datos["largo_blusa"], PDO::PARAM_STR);
		$stmt->bindParam(":largo_guillete", $datos["largo_guillete"], PDO::PARAM_STR);
		$stmt->bindParam(":largo_chaqueta", $datos["largo_chaqueta"], PDO::PARAM_STR);
		$stmt->bindParam(":largo_polera", $datos["largo_polera"], PDO::PARAM_STR);
		$stmt->bindParam(":largo_parka", $datos["largo_parka"], PDO::PARAM_STR);
		$stmt->bindParam(":largo_polar", $datos["largo_polar"], PDO::PARAM_STR);
		$stmt->bindParam(":largo_vestido", $datos["largo_vestido"], PDO::PARAM_STR);
		$stmt->bindParam(":pantalon_cintura", $datos["pantalon_cintura"], PDO::PARAM_STR);
		$stmt->bindParam(":pantalon_cadera", $datos["pantalon_cadera"], PDO::PARAM_STR);
		$stmt->bindParam(":pantalon_tiro", $datos["pantalon_tiro"], PDO::PARAM_STR);
		$stmt->bindParam(":pantalon_entrepierna", $datos["pantalon_entrepierna"], PDO::PARAM_STR);
		$stmt->bindParam(":pantalon_muslo", $datos["pantalon_muslo"], PDO::PARAM_STR);
		$stmt->bindParam(":pantalon_rodilla", $datos["pantalon_rodilla"], PDO::PARAM_STR);
		$stmt->bindParam(":pantalon_basta", $datos["pantalon_basta"], PDO::PARAM_STR);
		$stmt->bindParam(":largo_pantalon", $datos["largo_pantalon"], PDO::PARAM_STR);
		$stmt->bindParam(":falda_cintura", $datos["falda_cintura"], PDO::PARAM_STR);
		$stmt->bindParam(":falda_cadera", $datos["falda_cadera"], PDO::PARAM_STR);
		$stmt->bindParam(":largo_falda", $datos["largo_falda"], PDO::PARAM_STR);


		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	ELIMINAR PERSONAL
	=============================================*/

	static public function mdlEliminarPersonal($tabla, $datos){

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