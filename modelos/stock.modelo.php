<?php

require_once "conexion.php";

class ModeloStock{

	/*=============================================
	MOSTRAR PRODUCTOS
	=============================================*/

	

	static public function mdlMostrarStockPorProducto($id_producto) {
		$con = Conexion::conectar();

		$stmt = $con->prepare("SELECT SUM(cantidad) as entrada FROM entrada_producto WHERE id_producto = :id_producto");
		$stmt->bindParam(":id_producto", $id_producto, PDO::PARAM_INT);
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$entrada = $row["entrada"] ?? 0;

		$stmt = $con->prepare("SELECT SUM(cantidad) as salida FROM salida_producto WHERE id_producto = :id_producto");
		$stmt->bindParam(":id_producto", $id_producto, PDO::PARAM_INT);
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$salida = $row["salida"] ?? 0;

		$stmt = $con->prepare("SELECT SUM(diferencia) as ajuste FROM ajuste_producto WHERE id_producto = :id_producto");
		$stmt->bindParam(":id_producto", $id_producto, PDO::PARAM_INT);
		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		$ajuste = $row["ajuste"] ?? 0;

		return $entrada - $salida + $ajuste;

	}

	static public function mdlMostrarStockPorBodega($id_bodega) {
		$con = Conexion::conectar();

		$stmt = $con->prepare(
			"SELECT
				entrada_producto.descripcion,
				entrada_producto.id_producto,
				SUM(entrada_producto.cantidad) as entrada,
				SUM(salida_producto.cantidad) as salida, 
				SUM(ajuste_producto.diferencia) as ajuste
			FROM entrada_producto
			LEFT JOIN salida_producto ON entrada_producto.id_bodega = salida_producto.id_bodega
			LEFT JOIN ajuste_producto ON entrada_producto.id_bodega = ajuste_producto.id_bodega
			WHERE entrada_producto.id_bodega = :id_bodega
			GROUP BY entrada_producto.id_producto");
		$stmt->bindParam(":id_bodega", $id_bodega, PDO::PARAM_INT);
		$stmt->execute();

		$productos = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$stocks = array_map(function($producto) {
			return [
				"id_producto" => $producto["id_producto"],
				"entrada" => $producto["entrada"],
				"salida" => $producto["salida"],
				"ajuste" => $producto["ajuste"],
				"stock" => $producto["entrada"] + $producto["ajuste"] - $producto["salida"],
			];
		}, $productos);

		return $stocks;
	}


}
