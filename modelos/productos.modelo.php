<?php

require_once "conexion.php";

class ModeloProductos
{

	/*=============================================
	MOSTRAR PRODUCTOS
	=============================================*/

	static public function mdlMostrarProductos($tabla, $item, $valor, $orden){

		if ($item != null) {

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id DESC");

			$stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetch();
		} else {

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY $orden ASC");

			$stmt->execute();

			return $stmt->fetchAll();
		}

		$stmt->close();

		$stmt = null;
	}


		static public function mdlMostrarProductoPorId($id){

		

			$stmt = Conexion::conectar()->prepare("SELECT * FROM productos WHERE id = $id");

			$stmt->execute();

			return $stmt->fetch();
		
			$stmt->close();

			$stmt = null;
	}

	/*=============================================
	REGISTRO DE PRODUCTO
	=============================================*/
	static public function mdlIngresarProducto($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_categoria, codigo, descripcion, imagen, stock, precio_compra, precio_venta, stock_alerta, stock_min, id_bodega, id_subcategoria, id_medida, id_rubro, tipo_producto) VALUES (:id_categoria, :codigo, :descripcion, :imagen, :stock, :precio_compra, :precio_venta, :stock_alerta, :stock_min, :id_bodega, :id_subcategoria, :id_medida, :id_rubro, :tipo_producto)");

		$stmt->bindParam(":id_categoria", $datos["id_categoria"], PDO::PARAM_INT);
		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":imagen", $datos["imagen"], PDO::PARAM_STR);
		$stmt->bindParam(":stock", $datos["stock"], PDO::PARAM_STR);
		$stmt->bindParam(":precio_compra", $datos["precio_compra"], PDO::PARAM_STR);
		$stmt->bindParam(":precio_venta", $datos["precio_venta"], PDO::PARAM_STR);
		$stmt->bindParam(":stock_alerta", $datos["stock_alerta"], PDO::PARAM_STR);
		$stmt->bindParam(":stock_min", $datos["stock_min"], PDO::PARAM_STR);
		$stmt->bindParam(":id_subcategoria", $datos["id_subcategoria"], PDO::PARAM_INT);
		$stmt->bindParam(":id_medida", $datos["id_medida"], PDO::PARAM_INT);
		$stmt->bindParam(":id_bodega", $datos["id_bodega"], PDO::PARAM_INT);
		$stmt->bindParam(":id_rubro", $datos["id_rubro"], PDO::PARAM_INT);
		$stmt->bindParam(":tipo_producto", $datos["tipo_producto"], PDO::PARAM_STR);




		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();
		$stmt = null;
	}

	static public function mdlIngresarProductoPorBodega($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_bodega, id_producto, stock_producto) VALUES (:id_bodega, :id_producto, :stock_producto)");

		$stmt->bindParam(":id_bodega", $datos["id_bodega"], PDO::PARAM_INT);
		$stmt->bindParam(":id_producto", $datos["id_producto"], PDO::PARAM_INT);
		$stmt->bindParam(":id_salida", $datos["id_entrada"], PDO::PARAM_INT);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":id_bodega", $datos["id_bodega"], PDO::PARAM_INT);




		if ($stmt->execute()) {

			return "ok";
		} else {
			return "error";
		}

		$stmt->close();
		$stmt = null;
	}



	/*=============================================
	EDITAR PRODUCTO
	=============================================*/
	static public function mdlEditarProducto($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_categoria = :id_categoria, id_subcategoria = :id_subcategoria, descripcion = :descripcion, stock = :stock, precio_compra = :precio_compra, precio_venta = :precio_venta, stock_alerta = :stock_alerta, stock_min = :stock_min, id_medida = :id_medida, id_subunidad = :id_subunidad, valor_medida = :valor_medida, id_bodega = :id_bodega, id_rubro = :id_rubro, id_tabla_lista = :id_tabla_lista WHERE id = :id");

		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
		$stmt->bindParam(":id_categoria", $datos["id_categoria"], PDO::PARAM_INT);
		$stmt->bindParam(":id_subcategoria", $datos["id_subcategoria"], PDO::PARAM_INT);
		$stmt->bindParam(":id_medida", $datos["id_medida"], PDO::PARAM_INT);
        $stmt->bindParam(":id_subunidad", $datos["id_subunidad"], PDO::PARAM_INT);
        $stmt->bindParam(":valor_medida", $datos["valor_medida"], PDO::PARAM_INT);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":id_bodega", $datos["id_bodega"], PDO::PARAM_INT);
		$stmt->bindParam(":id_rubro", $datos["id_rubro"], PDO::PARAM_INT);
		$stmt->bindParam(":stock", $datos["stock"], PDO::PARAM_STR);
		$stmt->bindParam(":precio_compra", $datos["precio_compra"], PDO::PARAM_STR);
		$stmt->bindParam(":precio_venta", $datos["precio_venta"], PDO::PARAM_STR);
		$stmt->bindParam(":stock_alerta", $datos["stock_alerta"], PDO::PARAM_STR);
		$stmt->bindParam(":stock_min", $datos["stock_min"], PDO::PARAM_STR);
		$stmt->bindParam(":id_tabla_lista", $datos["id_tabla_lista"], PDO::PARAM_STR);


		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();
		$stmt = null;
	}

	static public function mdlEditarPrecioProducto($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET precio_venta = :precio_venta  WHERE id = :id");

		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
		$stmt->bindParam(":precio_venta", $datos["precio_venta"], PDO::PARAM_STR);


		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();
		$stmt = null;
	}

	/*=============================================
	BORRAR PRODUCTO
	=============================================*/

	static public function mdlEliminarProducto($tabla, $datos){

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

	/*=============================================
	ACTUALIZAR PRODUCTO
	=============================================*/

	static public function mdlActualizarProducto($tabla, $item1, $valor1, $valor){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE id = :id");

		$stmt->bindParam(":" . $item1, $valor1, PDO::PARAM_STR);
		$stmt->bindParam(":id", $valor, PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();

		$stmt = null;
	}

	/*=============================================
	MOSTRAR SUMA VENTAS
	=============================================*/

	static public function mdlMostrarSumaVentas($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT SUM(ventas) as total FROM $tabla");

		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();

		$stmt = null;
	}

	/**
	 * Retorna el stock del producto segun id de producto y id de bodega
	 * @param int $idProducto
	 * @param int $idBodega
	 * @return int
	 */
	static public function mdlMostrarStockPorBodega($idProducto, $idBodega){
		$con = Conexion::conectar();

		$query = $con->prepare("
					SELECT
						SUM(cantidad) AS suma
					FROM
						`entrada_producto`
					WHERE
						id_producto = :id_producto AND id_bodega = :id_bodega
					");
		$query->bindParam(":id_producto", $idProducto, PDO::PARAM_INT);
		$query->bindParam(":id_bodega", $idBodega, PDO::PARAM_INT);
		$query->execute();
		$query = $query->fetchAll(PDO::FETCH_ASSOC);

		$entrada = $query[0]["suma"];

		$query = $con->prepare("
					SELECT
						SUM(cantidad) AS suma
					FROM
						`salida_producto`
					WHERE
						id_producto = :id_producto AND id_bodega = :id_bodega
					");
		$query->bindParam(":id_producto", $idProducto, PDO::PARAM_INT);
		$query->bindParam(":id_bodega", $idBodega, PDO::PARAM_INT);
		$query->execute();
		$query = $query->fetchAll(PDO::FETCH_ASSOC);

		$salida = $query[0]["suma"];

		$query = $con->prepare("
					SELECT
						SUM(diferencia) AS suma
					FROM
						`ajuste_producto`
					WHERE
						id_producto = :id_producto AND id_bodega = :id_bodega
					");
		$query->bindParam(":id_producto", $idProducto, PDO::PARAM_INT);
		$query->bindParam(":id_bodega", $idBodega, PDO::PARAM_INT);
		$query->execute();
		$query = $query->fetchAll(PDO::FETCH_ASSOC);

		$ajuste = $query[0]["suma"];
		

		$query = $con->prepare("
		SELECT stock FROM  `productos` WHERE id = :id_producto
		"); 
		return $entrada - $salida + $ajuste;
		
	}
}

