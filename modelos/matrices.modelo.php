<?php

require_once "conexion.php";

class ModeloMatrices{

	/*=============================================
	CREAR PROVEEDOR
	=============================================*/

	static public function mdlIngresarMatriz($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(razon_social, rut, pais,  region, comuna, direccion, ejecutivo, telefono, email, actividad, fecha_inicio, fecha_vencimiento, tipo_producto, tipo_cliente) VALUES (:razon_social, :rut, :pais, :region, :comuna, :direccion, :ejecutivo, :telefono, :email, :actividad, :fecha_inicio, :fecha_vencimiento, :tipo_producto, :tipo_cliente)");

		$stmt->bindParam(":razon_social", $datos["razon_social"], PDO::PARAM_STR);
		$stmt->bindParam(":region", $datos["region"], PDO::PARAM_STR);
		$stmt->bindParam(":rut", $datos["rut"], PDO::PARAM_STR);
		$stmt->bindParam(":pais", $datos["pais"], PDO::PARAM_STR);
		$stmt->bindParam(":comuna", $datos["comuna"], PDO::PARAM_STR);
        $stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
        $stmt->bindParam(":ejecutivo", $datos["ejecutivo"], PDO::PARAM_STR);
        $stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
		$stmt->bindParam(":actividad", $datos["actividad"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_inicio", $datos["fecha_inicio"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_vencimiento", $datos["fecha_vencimiento"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo_cliente", $datos["tipo_cliente"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo_producto", $datos["tipo_producto"], PDO::PARAM_STR);

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

	static public function mdlMostrarMatrices($tabla, $item, $valor){

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
	EDITAR PROVEEDOR
	=============================================*/

	static public function mdlEditarMatriz($tabla, $datos) {
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET razon_social = :razon_social, rut = :rut, pais = :pais, region = :region, comuna = :comuna, direccion = :direccion, ejecutivo = :ejecutivo, telefono = :telefono, email = :email, actividad = :actividad, fecha_inicio = :fecha_inicio, fecha_vencimiento = :fecha_vencimiento, tipo_cliente = :tipo_cliente, tipo_producto = :tipo_producto WHERE id = :id");
	
		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
		$stmt->bindParam(":razon_social", $datos["razon_social"], PDO::PARAM_STR);
		$stmt->bindParam(":rut", $datos["rut"], PDO::PARAM_STR);
		$stmt->bindParam(":pais", $datos["pais"], PDO::PARAM_STR);
		$stmt->bindParam(":region", $datos["region"], PDO::PARAM_STR);
		$stmt->bindParam(":comuna", $datos["comuna"], PDO::PARAM_STR);
		$stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
		$stmt->bindParam(":ejecutivo", $datos["ejecutivo"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
		$stmt->bindParam(":actividad", $datos["actividad"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_inicio", $datos["fecha_inicio"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_vencimiento", $datos["fecha_vencimiento"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo_cliente", $datos["tipo_cliente"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo_producto", $datos["tipo_producto"], PDO::PARAM_STR);
	
		if ($stmt->execute()) {
			return "ok";
		} else {
			return "error";
		}
	
		$stmt->close();
		$stmt = null;
	}

	static public function mdlEditarCondicionVenta($tabla, $datos){
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET condicion_venta = :condicion_venta WHERE id = :id");

		$stmt -> bindParam(":id",  $datos["id"], PDO::PARAM_INT);
		$stmt -> bindParam(":condicion_venta", $datos["condicion_venta"], PDO::PARAM_STR);

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

	static public function mdlBorrarMatriz($tabla, $datos){

	
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
