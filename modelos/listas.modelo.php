<?php

require_once "conexion.php";

class ModeloListas{

	/*=============================================
	CREAR SUBCATEGORIA
	=============================================*/

	static public function mdlIngresarLista($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre_lista, factor) VALUES (:nombre_lista, :factor)");

        $stmt->bindParam(":nombre_lista", $datos["nombre_lista"], PDO::PARAM_STR);
        $stmt->bindParam(":factor", $datos["factor"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	MOSTRAR SUBCATEGORIAS
	=============================================*/

	static public function mdlMostrarListas($tabla, $item, $valor){

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
	EDITAR SUBCATEGORIA
	=============================================*/

	static public function mdlEditarLista($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre_lista = :nombre_lista, factor = :factor WHERE id = :id");

        $stmt -> bindParam(":nombre_lista", $datos["nombre_lista"], PDO::PARAM_STR);
        $stmt -> bindParam(":factor", $datos["factor"], PDO::PARAM_INT);
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
	BORRAR CATEGORIA
	=============================================*/

	static public function mdlBorrarLista($tabla, $datos){

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

