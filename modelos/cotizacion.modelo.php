<?php

require_once "conexion.php";

class ModeloCotizacion
{

	/*=============================================
	CREAR SUBCATEGORIA
	=============================================*/

	static public function mdlIngresarCotizacion($tabla, $datos)
	{

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(codigo, id_cliente, fecha_emision, fecha_vencimiento, id_vendedor, id_unidad_negocio, id_bodega, subtotal, descuento, total_neto, iva, total_final,  id_medio_pago, id_plazo_pago, observacion, productos, nombre_orden) 
                                                        VALUES (:codigo, :id_cliente, :fecha_emision, :fecha_vencimiento, :id_vendedor, :id_unidad_negocio, :id_bodega, :subtotal, :descuento, :total_neto, :iva, :total_final, :id_medio_pago, :id_plazo_pago, :observacion, :productos, :nombre_orden)");

		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_INT);
		$stmt->bindParam(":fecha_emision", $datos["fecha_emision"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_vencimiento", $datos["fecha_vencimiento"], PDO::PARAM_STR);
		$stmt->bindParam(":id_unidad_negocio", $datos["id_unidad_negocio"], PDO::PARAM_INT);
		$stmt->bindParam(":id_bodega", $datos["id_bodega"], PDO::PARAM_INT);
		$stmt->bindParam(":subtotal", $datos["subtotal"], PDO::PARAM_STR);
		$stmt->bindParam(":descuento", $datos["descuento"], PDO::PARAM_STR);
		$stmt->bindParam(":total_neto", $datos["total_neto"], PDO::PARAM_STR);
		$stmt->bindParam(":iva", $datos["iva"], PDO::PARAM_STR);
		$stmt->bindParam(":total_final", $datos["total_final"], PDO::PARAM_STR);
		$stmt->bindParam(":id_medio_pago", $datos["id_medio_pago"], PDO::PARAM_INT);
		$stmt->bindParam(":id_plazo_pago", $datos["id_plazo_pago"], PDO::PARAM_INT);
		$stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);
		$stmt->bindParam(":observacion", $datos["observacion"], PDO::PARAM_STR);
		$stmt->bindParam(":productos", $datos["productos"], PDO::PARAM_STR);
		$stmt->bindParam(":id_vendedor", $datos["id_vendedor"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre_orden", $datos["nombre_orden"], PDO::PARAM_STR);




		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();
		$stmt = null;
	}
	static public function mdlIngresarCotizacionExenta($tabla, $datos)
	{

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(codigo, id_cliente, fecha_emision, fecha_vencimiento, id_vendedor, id_unidad_negocio, id_bodega, subtotal, descuento, exento, iva, total_final,  id_medio_pago, id_plazo_pago, observacion, productos, nombre_orden) 
													VALUES (:codigo, :id_cliente, :fecha_emision, :fecha_vencimiento, :id_vendedor, :id_unidad_negocio, :id_bodega, :subtotal, :descuento, :exento, :iva, :total_final, :id_medio_pago, :id_plazo_pago, :observacion, :productos, :nombre_orden)");

		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_INT);
		$stmt->bindParam(":fecha_emision", $datos["fecha_emision"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_vencimiento", $datos["fecha_vencimiento"], PDO::PARAM_STR);
		$stmt->bindParam(":id_unidad_negocio", $datos["id_unidad_negocio"], PDO::PARAM_INT);
		$stmt->bindParam(":id_bodega", $datos["id_bodega"], PDO::PARAM_INT);
		$stmt->bindParam(":subtotal", $datos["subtotal"], PDO::PARAM_STR);
		$stmt->bindParam(":descuento", $datos["descuento"], PDO::PARAM_STR);
		$stmt->bindParam(":exento", $datos["exento"], PDO::PARAM_STR);
		$stmt->bindParam(":iva", $datos["iva"], PDO::PARAM_STR);
		$stmt->bindParam(":total_final", $datos["total_final"], PDO::PARAM_STR);
		$stmt->bindParam(":id_medio_pago", $datos["id_medio_pago"], PDO::PARAM_INT);
		$stmt->bindParam(":id_plazo_pago", $datos["id_plazo_pago"], PDO::PARAM_INT);
		$stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);
		$stmt->bindParam(":observacion", $datos["observacion"], PDO::PARAM_STR);
		$stmt->bindParam(":productos", $datos["productos"], PDO::PARAM_STR);
		$stmt->bindParam(":id_vendedor", $datos["id_vendedor"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre_orden", $datos["nombre_orden"], PDO::PARAM_STR);



		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();
		$stmt = null;
	}

	static public function mdlEditarCotizacion($tabla, $datos)
	{
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET codigo = :codigo, fecha_emision = :fecha_emision, fecha_vencimiento = :fecha_vencimiento, id_unidad_negocio = :id_unidad_negocio, id_bodega = :id_bodega, subtotal = :subtotal,
											descuento = :descuento, total_neto = :total_neto, iva = :iva, total_final = :total_final, id_medio_pago = :id_medio_pago, id_plazo_pago = :id_plazo_pago, id_cliente = :id_cliente,
											observacion = :observacion, productos = :productos, nombre_orden = :nombre_orden WHERE id = :id");
		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_INT);
		$stmt->bindParam(":fecha_emision", $datos["fecha_emision"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_vencimiento", $datos["fecha_vencimiento"], PDO::PARAM_STR);
		$stmt->bindParam(":id_unidad_negocio", $datos["id_unidad_negocio"], PDO::PARAM_INT);
		$stmt->bindParam(":id_bodega", $datos["id_bodega"], PDO::PARAM_INT);
		$stmt->bindParam(":subtotal", $datos["subtotal"], PDO::PARAM_STR);
		$stmt->bindParam(":descuento", $datos["descuento"], PDO::PARAM_STR);
		$stmt->bindParam(":total_neto", $datos["total_neto"], PDO::PARAM_STR);
		$stmt->bindParam(":iva", $datos["iva"], PDO::PARAM_STR);
		$stmt->bindParam(":total_final", $datos["total_final"], PDO::PARAM_STR);
		$stmt->bindParam(":id_medio_pago", $datos["id_medio_pago"], PDO::PARAM_INT);
		$stmt->bindParam(":id_plazo_pago", $datos["id_plazo_pago"], PDO::PARAM_INT);
		$stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);
		$stmt->bindParam(":observacion", $datos["observacion"], PDO::PARAM_STR);
		$stmt->bindParam(":productos", $datos["productos"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre_orden", $datos["nombre_orden"], PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();
		$stmt = null;
	}

	static public function mdlEditarCotizacionExenta($tabla, $datos)
	{

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla 
                                            SET id_cliente = :id_cliente, 
                                                fecha_emision = :fecha_emision, 
                                                fecha_vencimiento = :fecha_vencimiento, 
                                                id_vendedor = :id_vendedor, 
                                                id_unidad_negocio = :id_unidad_negocio, 
                                                id_bodega = :id_bodega, 
                                                subtotal = :subtotal, 
                                                descuento = :descuento, 
                                                exento = :exento, 
                                                iva = :iva, 
                                                total_final = :total_final,  
                                                id_medio_pago = :id_medio_pago, 
                                                id_plazo_pago = :id_plazo_pago, 
                                                observacion = :observacion, 
                                                productos = :productos ,
												nombre_orden = :nombre_orden
                                            WHERE codigo = :codigo");

		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_INT); // El código sigue siendo el identificador único

		// Los demás campos se actualizan con los nuevos valores
		$stmt->bindParam(":fecha_emision", $datos["fecha_emision"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_vencimiento", $datos["fecha_vencimiento"], PDO::PARAM_STR);
		$stmt->bindParam(":id_unidad_negocio", $datos["id_unidad_negocio"], PDO::PARAM_INT);
		$stmt->bindParam(":id_bodega", $datos["id_bodega"], PDO::PARAM_INT);
		$stmt->bindParam(":subtotal", $datos["subtotal"], PDO::PARAM_STR);
		$stmt->bindParam(":descuento", $datos["descuento"], PDO::PARAM_STR);
		$stmt->bindParam(":exento", $datos["exento"], PDO::PARAM_STR);
		$stmt->bindParam(":iva", $datos["iva"], PDO::PARAM_STR);
		$stmt->bindParam(":total_final", $datos["total_final"], PDO::PARAM_STR);
		$stmt->bindParam(":id_medio_pago", $datos["id_medio_pago"], PDO::PARAM_INT);
		$stmt->bindParam(":id_plazo_pago", $datos["id_plazo_pago"], PDO::PARAM_INT);
		$stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);
		$stmt->bindParam(":observacion", $datos["observacion"], PDO::PARAM_STR);
		$stmt->bindParam(":productos", $datos["productos"], PDO::PARAM_STR);
		$stmt->bindParam(":id_vendedor", $datos["id_vendedor"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre_orden", $datos["nombre_orden"], PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();
		$stmt = null;
	}

	static public function mdlMostrarCotizaciones($tabla, $item, $valor, $fechaInicial = null, $fechaFinal = null)
	{
		// Si se proporcionan fechas, filtra por rango de fechas
		if ($fechaInicial && $fechaFinal) {
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha_emision BETWEEN :fechaInicial AND :fechaFinal");
			$stmt->bindParam(":fechaInicial", $fechaInicial, PDO::PARAM_STR);
			$stmt->bindParam(":fechaFinal", $fechaFinal, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt->fetchAll(); // Devuelve todas las filas que coinciden
		} elseif ($item != null) {
			// Si hay un ítem específico, filtra por ese ítem
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
			$stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt->fetch(); // Devuelve solo una fila
		} else {
			// Si no hay filtros, devuelve todas las cotizaciones
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
			$stmt->execute();
			return $stmt->fetchAll(); // Devuelve todas las filas
		}
	}


	static public function mdlEliminarCotizacion($tabla, $datos)
	{

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt->bindParam(":id", $datos, PDO::PARAM_INT);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();

		$stmt = null;
	}

	static public function mdlEliminarCotizacionconCotizacion($idCotizacion)
	{
		try {
			$stmt = Conexion::conectar()->prepare("DELETE FROM cotizaciones WHERE codigo = :codigo");
			$stmt->bindParam(":codigo", $idCotizacion, PDO::PARAM_STR);
			if ($stmt->execute()) {
				return "ok"; // Retorna "ok" si la eliminación fue exitosa
			} else {
				return "error"; // Retorna "error" si algo salió mal
			}
		} catch (Exception $e) {
			return "error"; // Manejo de errores
		}
	}

	static public function mdlEliminarCotizacionExenta($tabla, $datos)
	{

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt->bindParam(":id", $datos, PDO::PARAM_INT);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();

		$stmt = null;
	}

	static public function mdlEliminarCotizacionExentaconCotizacion($idCotizacion)
	{
		try {
			$stmt = Conexion::conectar()->prepare("DELETE FROM cotizaciones_exentas WHERE codigo = :codigo");
			$stmt->bindParam(":codigo", $idCotizacion, PDO::PARAM_STR);
			if ($stmt->execute()) {
				return "ok"; // Retorna "ok" si la eliminación fue exitosa
			} else {
				return "error"; // Retorna "error" si algo salió mal
			}
		} catch (Exception $e) {
			return "error"; // Manejo de errores
		}
	}
}
