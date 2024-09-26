<?php

require_once "conexion.php";

class ModeloParametrosDocumentos{


	/*=============================================
	MOSTRAR PRODUCTOS
	=============================================*/

	static public function mdlMostrarParametros($tabla, $item, $valor, $orden){

		$stmt = Conexion::conectar();

		if($item != null){

			$stmt = $stmt->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id DESC");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = $stmt->prepare("SELECT * FROM $tabla ORDER BY $orden DESC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}


		$stmt = null;

	}

	static public function mdlIngresarParametros($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(cotizacion, boleta, orden_compra, factura_exenta, factura_afecta, orden_vestuario, entrada_inventario, salida_inventario, ajuste_inventario) VALUES (:cotizacion, :boleta, :orden_compra, :factura_exenta, :factura_afecta, :orden_vestuario, :entrada_inventario, :salida_inventario, :ajuste_inventario)");

		$stmt->bindParam(":cotizacion", $datos["cotizacion"], PDO::PARAM_INT);
		$stmt->bindParam(":boleta", $datos["boleta"], PDO::PARAM_INT);
		$stmt->bindParam(":orden_compra", $datos["orden_compra"], PDO::PARAM_INT);
		$stmt->bindParam(":factura_exenta", $datos["factura_exenta"], PDO::PARAM_INT);
		$stmt->bindParam(":factura_afecta", $datos["factura_afecta"], PDO::PARAM_INT);
		$stmt->bindParam(":orden_vestuario", $datos["orden_vestuario"], PDO::PARAM_INT);
		$stmt->bindParam(":entrada_inventario", $datos["entrada_inventario"], PDO::PARAM_INT);
		$stmt->bindParam(":salida_inventario", $datos["salida_inventario"], PDO::PARAM_INT);
		$stmt->bindParam(":ajuste_inventario", $datos["ajuste_inventario"], PDO::PARAM_INT);



		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt = null;

	}

	/**
	 * Funcion para conseguir el ultimo folio usado por algun documento
	 * @param $tabla Tabla de la base de datos donde se buscara el codigo o folio
	 * @param $atributo Atributo en la tabla de parametros_documento donde se buscara un folio inicial de ser necesario
	 * @return integer
	 */
	static public function mdlMostrarFolio($tabla, $atributo) {
		
		if (!empty($tabla) && !empty($atributo)) {
			$con = Conexion::conectar();

			$stmt = $con->prepare("SELECT codigo FROM $tabla ORDER BY id DESC LIMIT 1");
			$stmt->execute();
	
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
	
			if ($stmt->rowCount() > 0) {
				return intval($result["codigo"]);
			}

	
			$stmt = $con->prepare("SELECT $atributo
			FROM parametros_documentos
			WHERE $atributo IS NOT NULL
			ORDER BY id DESC LIMIT 1");
	
			$stmt->execute();
			
	
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
	
			if ($stmt->rowCount() > 0) {
				return intval($result[$atributo]);
			}

			return 0;
		}
		

		return 0;

	}



}