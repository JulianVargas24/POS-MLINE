<?php

require_once "conexion.php";

class ModeloBodegas{

	/*=============================================
	CREAR PROVEEDOR
	=============================================*/

	static public function mdlIngresarBodega($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre, region, comuna, direccion, jefe, telefono, email) VALUES (:nombre, :region, :comuna, :direccion, :jefe, :telefono, :email)");

		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":region", $datos["region"], PDO::PARAM_STR);
        $stmt->bindParam(":comuna", $datos["comuna"], PDO::PARAM_STR);
        $stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
        $stmt->bindParam(":jefe", $datos["jefe"], PDO::PARAM_STR);
        $stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
				

		if($stmt->execute()){

			return "ok";

		}else{
			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	MOSTRAR PROVEEDORES
	=============================================*/
	
	static public function mdlMostrarBodegas($tabla, $item, $valor){

		if($item != null){
	
			// Agregar JOIN para obtener el nombre de la región
			$stmt = Conexion::conectar()->prepare("SELECT bodegas.*, regiones.nombre_region 
												   FROM $tabla 
												   JOIN regiones ON bodegas.region = regiones.region_id
												   WHERE $item = :$item");
	
			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt -> execute();
	
			return $stmt -> fetch();
	
		} else {
	
			// Agregar JOIN para mostrar todas las bodegas con el nombre de la región
			$stmt = Conexion::conectar()->prepare("SELECT bodegas.*, regiones.nombre_region 
												   FROM $tabla 
												   JOIN regiones ON bodegas.region = regiones.region_id");
	
			$stmt -> execute();
	
			return $stmt -> fetchAll();
	
		}
	
		$stmt -> close();
		$stmt = null;
	}

	/*=============================================
	EDITAR PROVEEDOR
	=============================================*/

	static public function mdlEditarBodega($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, region = :region, comuna = :comuna, direccion = :direccion, jefe = :jefe, telefono = :telefono,  email = :email WHERE id = :id");

		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":region", $datos["region"], PDO::PARAM_STR);
        $stmt->bindParam(":comuna", $datos["comuna"], PDO::PARAM_STR);
        $stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
        $stmt->bindParam(":jefe", $datos["jefe"], PDO::PARAM_STR);
        $stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
			

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	BORRAR PROVEEDOR
	=============================================*/

	static public function mdlBorrarBodega($tabla, $datos){

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

