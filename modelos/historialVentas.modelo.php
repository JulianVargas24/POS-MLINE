<?php

require_once "conexion.php";

class ModeloHistorialVentas{

	/*=============================================
	MOSTRAR HISTORIAL VENTAS
	=============================================*/

	

	static public function mdlMostrarHistorialVentas($tabla, $item, $valor){

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
	SUMAR EL TOTAL DE HISTORIAL VENTAS
	=============================================*/

	static public function mdlSumaTotalHistorialVentas($tabla){	

		$stmt = Conexion::conectar()->prepare("SELECT SUM(total_pagado) as total FROM $tabla");

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}

	
}