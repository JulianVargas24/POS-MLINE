<?php

require_once "conexion.php";

class ModeloSucursales{

	/*=============================================
	CREAR SUCURSALES
	=============================================*/

	static public function mdlIngresarSucursal($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre, region, comuna, direccion, jefe, telefono, email, bodega, pais) VALUES (:nombre, :region, :comuna, :direccion, :jefe, :telefono, :email, :bodega, :pais)");

		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":region", $datos["region"], PDO::PARAM_STR);
        $stmt->bindParam(":comuna", $datos["comuna"], PDO::PARAM_STR);
        $stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
        $stmt->bindParam(":jefe", $datos["jefe"], PDO::PARAM_STR);
        $stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
		$stmt->bindParam(":bodega", $datos["bodega"], PDO::PARAM_STR);
		$stmt->bindParam(":pais", $datos["pais"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{
			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	MOSTRAR SUCURSALES
	=============================================*/

	static public function mdlMostrarSucursales($tabla, $item, $valor){

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
	EDITAR SUCURSALES
	=============================================*/

	static public function mdlEditarSucursal($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, region = :region, comuna = :comuna, direccion = :direccion, jefe = :jefe, telefono = :telefono,  email = :email, bodega = :bodega WHERE id = :id");

		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":region", $datos["region"], PDO::PARAM_STR);
        $stmt->bindParam(":comuna", $datos["comuna"], PDO::PARAM_STR);
        $stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
        $stmt->bindParam(":jefe", $datos["jefe"], PDO::PARAM_STR);
        $stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
        $stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
        $stmt->bindParam(":bodega", $datos["bodega"], PDO::PARAM_STR);
			

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	BORRAR SUCURSALES
	=============================================*/

	static public function mdlBorrarSucursal($tabla, $datos){

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

