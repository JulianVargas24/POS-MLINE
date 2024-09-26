<?php

require_once "conexion.php";

class ModeloVentas{

	/*=============================================
	MOSTRAR VENTAS
	=============================================*/

	static public function mdlMostrarVentas($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id ASC");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id ASC");

			$stmt -> execute();

			return $stmt -> fetchAll(); 

		}
		
		$stmt -> close();

		$stmt = null;

	}


	/*=============================================
	REGISTRO DE VENTA
	=============================================*/

	static public function mdlIngresarVenta($tabla, $datos, $productos){

		$con = Conexion::conectar();

		$stmt = $con->prepare("INSERT INTO $tabla(codigo, id_cliente, id_vendedor, productos, impuesto, neto, total, metodo_pago, total_pagado, total_pendiente_pago, descuento, observacion) VALUES (:codigo, :id_cliente, :id_vendedor, :productos, :impuesto, :neto, :total, :metodo_pago, :total_pagado, :total_pendiente_pago, :descuento, :observacion)");

		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_INT);
		$stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);
		$stmt->bindParam(":id_vendedor", $datos["id_vendedor"], PDO::PARAM_INT);
		$stmt->bindParam(":productos", $datos["productos"], PDO::PARAM_STR);
		$stmt->bindParam(":impuesto", $datos["impuesto"], PDO::PARAM_STR);
		$stmt->bindParam(":neto", $datos["neto"], PDO::PARAM_STR);
		$stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);
		$stmt->bindParam(":metodo_pago", $datos["metodo_pago"], PDO::PARAM_STR);
		$stmt->bindParam(":total_pagado", $datos["total_pagado"], PDO::PARAM_STR);
		$stmt->bindParam(":total_pendiente_pago", $datos["total_pendiente_pago"], PDO::PARAM_STR);
		$stmt->bindParam(":descuento", $datos["descuento"], PDO::PARAM_STR);
		$stmt->bindParam(":observacion", $datos["observacion"], PDO::PARAM_STR);

		if($stmt->execute()){

			if ($con->lastInsertId() > 0) {
				foreach($productos as $producto) {
					$datos = [
						"id_producto" => $producto["id"],
						"id_salida" => $con->lastInsertId(),
						"tipo_salida" => "ventas",
						"cantidad" => $producto["cantidad"],
						"descripcion" => $producto["descripcion"],
						"id_bodega" => $datos["id_bodega"],

					];
					ModeloSalidasInventario::mdlSalidaPorVenta($datos);
				}

			}

			return "ok";

		}else{

			return "error";
		
		}

	}

	/*=============================================
	EDITAR VENTA
	=============================================*/

	static public function mdlEditarVenta($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET  id_cliente = :id_cliente, id_vendedor = :id_vendedor, productos = :productos, impuesto = :impuesto, neto = :neto, total= :total, total_pagado = :total_pagado, total_pendiente_pago = :total_pendiente_pago, descuento = :descuento, metodo_pago = :metodo_pago, observacion = :observacion WHERE codigo = :codigo");

		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_INT);
		$stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);
		$stmt->bindParam(":id_vendedor", $datos["id_vendedor"], PDO::PARAM_INT);
		$stmt->bindParam(":productos", $datos["productos"], PDO::PARAM_STR);
		$stmt->bindParam(":impuesto", $datos["impuesto"], PDO::PARAM_STR);
		$stmt->bindParam(":neto", $datos["neto"], PDO::PARAM_STR);
		$stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);
		$stmt->bindParam(":metodo_pago", $datos["metodo_pago"], PDO::PARAM_STR);
		$stmt->bindParam(":total_pagado", $datos["total_pagado"], PDO::PARAM_STR);
		$stmt->bindParam(":total_pendiente_pago", $datos["total_pendiente_pago"], PDO::PARAM_STR);
		$stmt->bindParam(":descuento", $datos["descuento"], PDO::PARAM_STR);
		$stmt->bindParam(":observacion", $datos["observacion"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	ELIMINAR VENTA
	=============================================*/

	static public function mdlEliminarVenta($tabla, $datos){

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

	/*=============================================
	RANGO FECHAS
	=============================================*/	

	static public function mdlRangoFechasVentas($tabla, $fechaInicial, $fechaFinal){

		if($fechaInicial == null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();	 


		}else if($fechaInicial == $fechaFinal){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha like '%$fechaFinal%'");

			$stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}else{

			$fechaActual = new DateTime();
			$fechaActual ->add(new DateInterval("P1D"));
			$fechaActualMasUno = $fechaActual->format("d-m-Y");

			$fechaFinal2 = new DateTime($fechaFinal);
			$fechaFinal2 ->add(new DateInterval("P1D"));
			$fechaFinalMasUno = $fechaFinal2->format("d-m-Y");

			if($fechaFinalMasUno == $fechaActualMasUno){

				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno'");

			}else{


				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinal'");

			}
		
			$stmt -> execute();

			return $stmt -> fetchAll();

		}

	}

	/*=============================================
	SUMAR EL TOTAL DE VENTAS
	=============================================*/

	static public function mdlSumaTotalVentas(){	

			$con = Conexion::conectar();
	
			$stmt = $con->prepare("SELECT SUM(total_final) as boleta_afecta FROM venta_boleta");
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$boletaAfecta = $row["boleta_afecta"] ?? 0;
	
			$stmt = $con->prepare("SELECT SUM(total_final) as boleta_exenta FROM venta_boleta_exenta");
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$boletaExenta = $row["boleta_exenta"] ?? 0;
	
			$stmt = $con->prepare("SELECT SUM(total_final) as venta_afecta FROM venta_afecta");
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$ventaAfecta = $row["venta_afecta"] ?? 0;

			$stmt = $con->prepare("SELECT SUM(total_final) as venta_exenta FROM venta_exenta");
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$ventaExenta = $row["venta_exenta"] ?? 0;

			$stmt = $con->prepare("SELECT SUM(total_final) as nota_credito FROM nota_credito");
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$notaCredito = $row["nota_credito"] ?? 0;

			$stmt = $con->prepare("SELECT SUM(total_final) as nota_credito_boleta FROM nota_credito_boleta");
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$notaCreditoBoleta = $row["nota_credito_boleta"] ?? 0;

			$stmt = $con->prepare("SELECT SUM(total_final) as nota_credito_exenta FROM nota_credito_exenta");
			$stmt->execute();
			$row = $stmt->fetch(PDO::FETCH_ASSOC);
			$notaCreditoExenta = $row["nota_credito_exenta"] ?? 0;
	
			return (($ventaAfecta + $boletaAfecta - $notaCredito - $notaCreditoBoleta) / 1.19) + $ventaExenta + $boletaExenta - $notaCreditoExenta;

	

	}

	static public function mdlSumaTotalVentasPorFecha($fechaInicial, $fechaFinal){	

		$con = Conexion::conectar();

		$stmt = $con->prepare("SELECT SUM(total_final) as boleta_afecta FROM venta_boleta WHERE fecha_emision BETWEEN '$fechaInicial' AND '$fechaFinal'");

		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$boletaAfecta = $row["boleta_afecta"] ?? 0;

		$stmt = $con->prepare("SELECT SUM(total_final) as boleta_exenta FROM venta_boleta_exenta WHERE fecha_emision BETWEEN '$fechaInicial' AND '$fechaFinal'");
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$boletaExenta = $row["boleta_exenta"] ?? 0;

		$stmt = $con->prepare("SELECT SUM(total_final) as venta_afecta FROM venta_afecta WHERE fecha_emision BETWEEN '$fechaInicial' AND '$fechaFinal'");
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$ventaAfecta = $row["venta_afecta"] ?? 0;

		$stmt = $con->prepare("SELECT SUM(total_final) as venta_exenta FROM venta_exenta WHERE fecha_emision BETWEEN '$fechaInicial' AND '$fechaFinal'");
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$ventaExenta = $row["venta_exenta"] ?? 0;

		$stmt = $con->prepare("SELECT SUM(total_final) as nota_credito FROM nota_credito WHERE fecha_emision BETWEEN '$fechaInicial' AND '$fechaFinal'");
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$notaCredito = $row["nota_credito"] ?? 0;

		$stmt = $con->prepare("SELECT SUM(total_final) as nota_credito_boleta FROM nota_credito_boleta WHERE fecha_emision BETWEEN '$fechaInicial' AND '$fechaFinal'");
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$notaCreditoBoleta = $row["nota_credito_boleta"] ?? 0;

		$stmt = $con->prepare("SELECT SUM(total_final) as nota_credito_exenta FROM nota_credito_exenta WHERE fecha_emision BETWEEN '$fechaInicial' AND '$fechaFinal'");
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$notaCreditoExenta = $row["nota_credito_exenta"] ?? 0;

			$documentosAfectos = ($ventaAfecta + $boletaAfecta - $notaCredito - $notaCreditoBoleta) / 1.19;
			$documentosExentos = $ventaExenta + $boletaExenta - $notaCreditoExenta;
		return $documentosAfectos + $documentosExentos;
	}

	static public function mdlSumaDocumentosVentas($tabla, $fecha){
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha_emision = '$fecha'");
			$stmt -> execute();
			return $stmt -> fetchAll(); 
	}

	static public function mdlSumaContadoVentas($tabla, $fecha){
		$stmt = Conexion::conectar()->prepare("SELECT SUM(pagado) as pagado FROM $tabla WHERE fecha_emision = '$fecha'");
		$stmt -> execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row["pagado"] ?? 0;
	}

	static public function mdlSumaPendienteVentas($tabla, $fecha){
		$stmt = Conexion::conectar()->prepare("SELECT SUM(pendiente) as pendiente FROM $tabla WHERE fecha_emision = '$fecha'");
		$stmt -> execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		return $row["pendiente"] ?? 0;
	}


	
}
