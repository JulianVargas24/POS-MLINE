<?php

require_once "conexion.php";

class ModeloOrdenProduccion
{
  /**
   * Crear Orden de Producción
   */
  static public function mdlCrearOrdenProduccion($tabla, $datos)
  {
    try {
      $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(
        folio_orden_produccion,
        id_cliente,
        tipo_orden,
        nombre_orden,
        fecha_emision,
        fecha_vencimiento,
        centro_costo,
        bodega_destino,
        cantidad_producida_total,
        costo_unitario_total,
        costo_produccion_total,
        costo_embalaje_total,
        costo_total_con_embalaje
      ) VALUES (
        :folio_orden_produccion,
        :id_cliente,
        :tipo_orden,
        :nombre_orden,
        :fecha_emision,
        :fecha_vencimiento,
        :centro_costo,
        :bodega_destino,
        :cantidad_producida_total,
        :costo_unitario_total,
        :costo_produccion_total,
        :costo_embalaje_total,
        :costo_total_con_embalaje
      )");

      $stmt->bindParam(":folio_orden_produccion", $datos["folio_orden_produccion"], PDO::PARAM_INT);
      $stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);
      $stmt->bindParam(":tipo_orden", $datos["tipo_orden"], PDO::PARAM_STR);
      $stmt->bindParam(":nombre_orden", $datos["nombre_orden"], PDO::PARAM_STR);
      $stmt->bindParam(":fecha_emision", $datos["fecha_emision"], PDO::PARAM_STR);
      $stmt->bindParam(":fecha_vencimiento", $datos["fecha_vencimiento"], PDO::PARAM_STR);
      $stmt->bindParam(":centro_costo", $datos["centro_costo"], PDO::PARAM_STR);
      $stmt->bindParam(":bodega_destino", $datos["bodega_destino"], PDO::PARAM_STR);
      $stmt->bindParam(":cantidad_producida_total", $datos["cantidad_producida_total"], PDO::PARAM_INT);
      $stmt->bindParam(":costo_unitario_total", $datos["costo_unitario_total"], PDO::PARAM_INT);
      $stmt->bindParam(":costo_produccion_total", $datos["costo_produccion_total"], PDO::PARAM_INT);
      $stmt->bindParam(":costo_embalaje_total", $datos["costo_embalaje_total"], PDO::PARAM_INT);
      $stmt->bindParam(":costo_total_con_embalaje", $datos["costo_total_con_embalaje"], PDO::PARAM_INT);

      if ($stmt->execute()) {
        return "ok";
      } else {
        return "error";
      }
    } catch (PDOException $e) {
      return "error: " . $e->getMessage();
    }
  }

  /**
   * Crear Detalle de la Orden de Producción
   */
  static public function mdlCrearOrdenProduccionDetalle($tabla, $datos)
  {
    try {
      // Validar que la unidad exista
      $stmtUnidad = Conexion::conectar()->prepare("SELECT id FROM unidades WHERE id = ?");
      $stmtUnidad->execute([$datos["id_unidad"]]);
      if (!$stmtUnidad->fetch()) {
        return "error: La unidad seleccionada no existe (ID: " . $datos["id_unidad"] . ")";
      }

      $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(
        folio_orden_produccion,
        id_producto,
        id_unidad,
        codigo_lote,
        fecha_produccion,
        fecha_vencimiento,
        cantidad_producida,
        costo_unitario,
        costo_produccion,
        costo_embalaje,
        costo_produccion_con_embalaje
      ) VALUES (
        :folio_orden_produccion,
        :id_producto, 
        :id_unidad,
        :codigo_lote,
        :fecha_produccion,
        :fecha_vencimiento,
        :cantidad_producida,
        :costo_unitario,
        :costo_produccion,
        :costo_embalaje,
        :costo_produccion_con_embalaje
      )");

      // Validar que los datos necesarios estén presentes
      $camposRequeridos = [
        'folio_orden_produccion',
        'id_producto',
        'id_unidad',
        'codigo_lote',
        'fecha_produccion',
        'fecha_vencimiento',
        'cantidad_producida',
        'costo_unitario',
        'costo_produccion',
        'costo_embalaje',
        'costo_produccion_con_embalaje'
      ];

      foreach ($camposRequeridos as $campo) {
        if (!isset($datos[$campo])) {
          return "Error: Falta el campo $campo";
        }
      }

      $stmt->bindParam(":folio_orden_produccion", $datos["folio_orden_produccion"], PDO::PARAM_INT);
      $stmt->bindParam(":id_producto", $datos["id_producto"], PDO::PARAM_INT);
      $stmt->bindParam(":id_unidad", $datos["id_unidad"], PDO::PARAM_INT);
      $stmt->bindParam(":codigo_lote", $datos["codigo_lote"], PDO::PARAM_STR);
      $stmt->bindParam(":fecha_produccion", $datos["fecha_produccion"], PDO::PARAM_STR);
      $stmt->bindParam(":fecha_vencimiento", $datos["fecha_vencimiento"], PDO::PARAM_STR);
      $stmt->bindParam(":cantidad_producida", $datos["cantidad_producida"], PDO::PARAM_INT);
      $stmt->bindParam(":costo_unitario", $datos["costo_unitario"], PDO::PARAM_INT);
      $stmt->bindParam(":costo_produccion", $datos["costo_produccion"], PDO::PARAM_INT);
      $stmt->bindParam(":costo_embalaje", $datos["costo_embalaje"], PDO::PARAM_INT);
      $stmt->bindParam(":costo_produccion_con_embalaje", $datos["costo_produccion_con_embalaje"], PDO::PARAM_INT);

      if ($stmt->execute()) {
        return "ok";
      } else {
        return "error: " . implode(", ", $stmt->errorInfo());
      }
    } catch (PDOException $e) {
      return "error: " . $e->getMessage();
    }
  }

  /**
   * Obtener el último folio de la Orden de Producción
   */
  static public function mdlObtenerUltimoFolio($tabla)
  {
    $stmt = Conexion::conectar()->prepare("SELECT MAX(folio_orden_produccion) as folio_orden_produccion FROM $tabla");
    $stmt->execute();
    return $stmt->fetch();
    $stmt->close();
    $stmt = null;
  }

  /**
   * Mostrar las Órdenes de Producción con filtros de fecha
   */
  static public function mdlMostrarOrdenesProduccion($tabla, $item, $valor, $fechaInicial = null, $fechaFinal = null)
  {
    try {
      // Si se proporcionan fechas lo filtra por el rango de fechas
      if ($fechaInicial && $fechaFinal) {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha_emision BETWEEN :fechaInicial AND :fechaFinal");
        $stmt->bindParam(":fechaInicial", $fechaInicial, PDO::PARAM_STR);
        $stmt->bindParam(":fechaFinal", $fechaFinal, PDO::PARAM_STR);
      }
      // Si no hay filtros, trae todas las órdenes
      else {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
      }
      // Ejecuta la consulta SQL
      $stmt->execute();
      // Obtiene todos los resultados de la consulta como un array, si no hay resultados devuelve un array vacío
      return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
    } catch (PDOException $e) {
      return "error: " . $e->getMessage();
    } finally {
      // Cierra la conexión a la base de datos
      $stmt = null;
    }
  }

  /**
   * Mostrar detalles de las Órdenes de Producción con opción de filtro por rango de fechas.
   */
  static public function mdlMostrarOrdenesProduccionDetalle($tabla, $item, $valor)
  {
    try {
      if ($item != null) {
        // Consulta con un solo criterio
        $stmt = Conexion::conectar()->prepare(
          "SELECT * FROM $tabla WHERE $item = :$item"
        );
        $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
      } else {
        // Consulta sin filtros
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
      }

      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
      return "error: " . $e->getMessage();
    } finally {
      $stmt = null;
    }
  }




  /**
   * Eliminar detalle de Órdenes de Producción
   */
  static public function mdlEliminarOrdenProduccionDetalle($tabla, $folioOrden)
  {
    $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE folio_orden_produccion = :folio");
    $stmt->bindParam(":folio", $folioOrden, PDO::PARAM_INT);

    if ($stmt->execute()) {
      return "ok";
    } else {
      return "error";
    }

    $stmt = null; // Cerrar la conexión
  }

  /**
   * Eliminar Órdenes de Producción
   */
  static public function mdlEliminarOrdenProduccion($tabla, $folioOrden)
  {
    $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE folio_orden_produccion = :folio");
    $stmt->bindParam(":folio", $folioOrden, PDO::PARAM_INT);

    if ($stmt->execute()) {
      return "ok";
    } else {
      return "error";
    }

    $stmt = null; // Cerrar la conexión
  }

  static public function mdlEditarOrdenProduccion($tabla, $datos) {

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla 
											   SET folio_orden_produccion = :folio_orden_produccion, 
												   id_cliente = :id_cliente, 
												   tipo_orden = :tipo_orden, 
												   nombre_orden = :nombre_orden, 
												   fecha_emision = :fecha_emision, 
												   fecha_vencimiento = :fecha_vencimiento, 
												   centro_costo = :centro_costo, 
												   bodega_destino = :bodega_destino, 
												   cantidad_producida_total = :cantidad_producida_total,
                           costo_unitario_total = :costo_unitario_total,
                           costo_produccion_total = :costo_produccion_total,
                           costo_embalaje_total = :costo_embalaje_total,
                           costo_total_con_embalaje = :costo_total_con_embalaje 
											   WHERE id = :id");
	
		$stmt->bindParam(":folio_orden_produccion", $datos["folio_orden_produccion"], PDO::PARAM_INT);
		$stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);
		$stmt->bindParam(":tipo_orden", $datos["tipo_orden"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre_orden", $datos["nombre_orden"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_emision", $datos["fecha_emision"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_vencimiento", $datos["fecha_vencimiento"], PDO::PARAM_STR);
		$stmt->bindParam(":centro_costo", $datos["centro_costo"], PDO::PARAM_INT);
		$stmt->bindParam(":bodega_destino", $datos["bodega_destino"], PDO::PARAM_INT);
		$stmt->bindParam(":cantidad_producida_total", $datos["cantidad_producida_total"], PDO::PARAM_INT);
    $stmt->bindParam(":costo_unitario_total", $datos["costo_unitario_total"], PDO::PARAM_INT);
    $stmt->bindParam(":costo_produccion_total", $datos["costo_produccion_total"], PDO::PARAM_INT);
    $stmt->bindParam(":costo_embalaje_total", $datos["costo_embalaje_total"], PDO::PARAM_INT);
    $stmt->bindParam(":costo_total_con_embalaje", $datos["costo_total_con_embalaje"], PDO::PARAM_INT);
		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);  // Se incluye el ID para identificar qué registro actualizar
	
		if ($stmt->execute()) {
			return "ok";
		} else {
			return "error";
		}
	
		$stmt->close();
		$stmt = null;
	}




}
