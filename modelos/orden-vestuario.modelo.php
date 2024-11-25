<?php

require_once "conexion.php";

class ModeloOrdenVestuario
{
	/**
	 * Método para ingresar una orden de vestuario
	 */
	static public function mdlIngresarOrdenVestuario($tabla, $datos)
	{
		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(codigo, fecha_emision, fecha_vencimiento, id_centro, id_bodega, id_cliente, nombre_orden, observacion, personal) 
                                                        VALUES (:codigo, :fecha_emision, :fecha_vencimiento, :id_centro, :id_bodega, :id_cliente, :nombre_orden, :observacion, :personal)");

		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_INT);
		$stmt->bindParam(":fecha_emision", $datos["fecha_emision"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_vencimiento", $datos["fecha_vencimiento"], PDO::PARAM_STR);
		$stmt->bindParam(":id_centro", $datos["id_centro"], PDO::PARAM_INT);
		$stmt->bindParam(":id_bodega", $datos["id_bodega"], PDO::PARAM_INT);
		$stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);
		$stmt->bindParam(":nombre_orden", $datos["nombre_orden"], PDO::PARAM_STR);
		$stmt->bindParam(":observacion", $datos["observacion"], PDO::PARAM_STR);
		$stmt->bindParam(":personal", $datos["personal"], PDO::PARAM_STR);

		if ($stmt->execute()) {
			return "ok";
		} else {
			return "error";
		}

		$stmt->close();
		$stmt = null;
	}

	/**
	 * Método para mostrar las Órdenes de Vestuario con filtros de fecha
	 */
	static public function mdlMostrarOrdenVestuario($tabla, $item, $valor, $fechaInicial = null, $fechaFinal = null)
	{
		if ($fechaInicial && $fechaFinal) {
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha_emision BETWEEN :fechaInicial AND :fechaFinal");

			$stmt->bindParam(":fechaInicial", $fechaInicial, PDO::PARAM_STR);
			$stmt->bindParam(":fechaFinal", $fechaFinal, PDO::PARAM_STR);
		} elseif ($item != null) {
			// Filtra por el campo específico
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
			$stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
		} else {
			// Devuelve todas las órdenes de compra
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
		}

		$stmt->execute();

		if ($fechaInicial && $fechaFinal) {
			return $stmt->fetchAll();
		} elseif ($item != null) {
			return $stmt->fetch();
		} else {
			return $stmt->fetchAll();
		}

		$stmt->close();
		$stmt = null;
	}

	/**
	 * Método para editar una orden de vestuario
	 */
	static public function mdlEditarOrdenVestuario($tabla, $datos)
	{
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla 
											   SET codigo = :codigo, 
												   fecha_emision = :fecha_emision, 
												   fecha_vencimiento = :fecha_vencimiento, 
												   id_centro = :id_centro, 
												   id_bodega = :id_bodega, 
												   id_cliente = :id_cliente, 
												   nombre_orden = :nombre_orden, 
												   observacion = :observacion, 
												   personal = :personal 
											   WHERE id = :id");

		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_INT);
		$stmt->bindParam(":fecha_emision", $datos["fecha_emision"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_vencimiento", $datos["fecha_vencimiento"], PDO::PARAM_STR);
		$stmt->bindParam(":id_centro", $datos["id_centro"], PDO::PARAM_INT);
		$stmt->bindParam(":id_bodega", $datos["id_bodega"], PDO::PARAM_INT);
		$stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);
		$stmt->bindParam(":nombre_orden", $datos["nombre_orden"], PDO::PARAM_STR);
		$stmt->bindParam(":observacion", $datos["observacion"], PDO::PARAM_STR);
		$stmt->bindParam(":personal", $datos["personal"], PDO::PARAM_STR);
		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);  // Se incluye el ID para identificar qué registro actualizar

		if ($stmt->execute()) {
			return "ok";
		} else {
			return "error";
		}

		$stmt->close();
		$stmt = null;
	}

	/**
	 * Método para eliminar una orden de vestuario
	 */
	static public function mdlEliminarOrdenVestuario($tabla, $idOrdenVestuario)
	{
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
		$stmt->bindParam(":id", $idOrdenVestuario, PDO::PARAM_INT);

		if ($stmt->execute()) {
			return "ok";
		} else {
			return "error";
		}

		$stmt->close();
		$stmt = null;
	}
}
