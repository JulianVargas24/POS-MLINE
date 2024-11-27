<?php

require_once "conexion.php";

class ModeloNuevoOrdenProduccion
{
  /**
   * Crear Orden de Producción
   */
  static public function mdlCrearOrdenProduccion($tabla, $datos)
  {
    try {
      $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(
        folio_orden_produccion,
        nombre_orden,
        estado_orden,
        tipo_orden,
        id_cliente,
        id_cotizacion,
        id_cotizacion_exenta,
        fecha_orden_emision,
        fecha_orden_vencimiento,
        centro_costo,
        bodega_destino,
        tipo_produccion,
        id_producto_produccion,
        id_unidad,
        cantidad_produccion,
        fecha_elaboracion,
        fecha_elaboracion_vencimiento,
        codigo_lote,
        observaciones,
        costo_embalaje_total,
        costo_produccion_total,
        costo_produccion_total_con_embalaje
      ) VALUES (
        :folio_orden_produccion,
        :nombre_orden,
        :estado_orden,
        :tipo_orden,
        :id_cliente,
        :id_cotizacion,
        :id_cotizacion_exenta,
        :fecha_orden_emision,
        :fecha_orden_vencimiento,
        :centro_costo,
        :bodega_destino,
        :tipo_produccion,
        :id_producto_produccion,
        :id_unidad,
        :cantidad_produccion,
        :fecha_elaboracion,
        :fecha_elaboracion_vencimiento,
        :codigo_lote,
        :observaciones,
        :costo_embalaje_total,
        :costo_produccion_total,
        :costo_produccion_total_con_embalaje
      )");

      $stmt->bindParam(":folio_orden_produccion", $datos["folio_orden_produccion"], PDO::PARAM_INT);
      $stmt->bindParam(":nombre_orden", $datos["nombre_orden"], PDO::PARAM_STR);
      $stmt->bindParam(":estado_orden", $datos["estado_orden"], PDO::PARAM_STR);
      $stmt->bindParam(":tipo_orden", $datos["tipo_orden"], PDO::PARAM_STR);

      if ($datos["id_cliente"] === null) {
        $stmt->bindValue(":id_cliente", null, PDO::PARAM_NULL);
      } else {
        $stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);
      }

      if ($datos["id_cotizacion"] === null) {
        $stmt->bindValue(":id_cotizacion", null, PDO::PARAM_NULL);
      } else {
        $stmt->bindParam(":id_cotizacion", $datos["id_cotizacion"], PDO::PARAM_INT);
      }

      if ($datos["id_cotizacion_exenta"] === null) {
        $stmt->bindValue(":id_cotizacion_exenta", null, PDO::PARAM_NULL);
      } else {
        $stmt->bindParam(":id_cotizacion_exenta", $datos["id_cotizacion_exenta"], PDO::PARAM_INT);
      }

      $stmt->bindParam(":fecha_orden_emision", $datos["fecha_orden_emision"], PDO::PARAM_STR);
      $stmt->bindParam(":fecha_orden_vencimiento", $datos["fecha_orden_vencimiento"], PDO::PARAM_STR);
      $stmt->bindParam(":centro_costo", $datos["centro_costo"], PDO::PARAM_INT);
      $stmt->bindParam(":bodega_destino", $datos["bodega_destino"], PDO::PARAM_INT);
      $stmt->bindParam(":tipo_produccion", $datos["tipo_produccion"], PDO::PARAM_STR);
      $stmt->bindParam(":id_producto_produccion", $datos["id_producto_produccion"], PDO::PARAM_INT);
      $stmt->bindParam(":id_unidad", $datos["id_unidad"], PDO::PARAM_INT);
      $stmt->bindParam(":cantidad_produccion", $datos["cantidad_produccion"], PDO::PARAM_INT);
      $stmt->bindParam(":fecha_elaboracion", $datos["fecha_elaboracion"], PDO::PARAM_STR);
      $stmt->bindParam(":fecha_elaboracion_vencimiento", $datos["fecha_elaboracion_vencimiento"], PDO::PARAM_STR);
      $stmt->bindParam(":codigo_lote", $datos["codigo_lote"], PDO::PARAM_STR);

      if ($datos["observaciones"] === "") {
        $stmt->bindValue(":observaciones", null, PDO::PARAM_NULL);
      } else {
        $stmt->bindParam(":observaciones", $datos["observaciones"], PDO::PARAM_STR);
      }

      $stmt->bindParam(":costo_embalaje_total", $datos["costo_embalaje_total"], PDO::PARAM_INT);
      $stmt->bindParam(":costo_produccion_total", $datos["costo_produccion_total"], PDO::PARAM_INT);
      $stmt->bindParam(":costo_produccion_total_con_embalaje", $datos["costo_produccion_total_con_embalaje"], PDO::PARAM_INT);

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
   * Crear Materiales de la Orden de Producción
   */
  static public function mdlCrearOrdenProduccionMateriales($tabla, $datos)
  {
    try {
      $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(
        id_orden_produccion,
        id_producto,
        id_tipo_material,
        id_unidad,
        cantidad,
        precio_unitario,
        costo_total
      ) VALUES (
        :id_orden_produccion,
        :id_producto,
        :id_tipo_material,
        :id_unidad,
        :cantidad,
        :precio_unitario,
        :costo_total
      )");

      $stmt->bindParam(":id_orden_produccion", $datos["id_orden_produccion"], PDO::PARAM_INT);
      $stmt->bindParam(":id_producto", $datos["id_producto"], PDO::PARAM_INT);
      $stmt->bindParam(":id_tipo_material", $datos["id_tipo_material"], PDO::PARAM_INT);
      $stmt->bindParam(":id_unidad", $datos["id_unidad"], PDO::PARAM_INT);
      $stmt->bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_INT);
      $stmt->bindParam(":precio_unitario", $datos["precio_unitario"], PDO::PARAM_INT);
      $stmt->bindParam(":costo_total", $datos["costo_total"], PDO::PARAM_INT);

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
   * Obtener el último ID de la Orden de Producción
   */
  static public function mdlObtenerUltimoId()
  {
    try {
      $stmt = Conexion::conectar()->prepare("SELECT id FROM nueva_orden_produccion ORDER BY id DESC LIMIT 1");
      $stmt->execute();
      $resultado = $stmt->fetch();
      return ($resultado) ? $resultado["id"] : false;
    } catch (PDOException $e) {
      return "error: " . $e->getMessage();
    } finally {
      $stmt = null;
    }
  }

  static public function mdlMostrarOrdenesProduccion($tabla, $item, $valor, $fechaInicial = null, $fechaFinal = null)
  {
    if ($fechaInicial && $fechaFinal) {
      $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha_orden_emision BETWEEN :fechaInicial AND :fechaFinal");

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

  static public function mdlMostrarOrdenesProduccionMateriales($tabla, $item, $valor)
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

  static public function mdlEditarOrdenProduccion($tabla, $datos)
{
    try {
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET
            folio_orden_produccion = :folio_orden_produccion,
            nombre_orden = :nombre_orden,
            estado_orden = :estado_orden,
            tipo_orden = :tipo_orden,
            id_cliente = :id_cliente,
            id_cotizacion = :id_cotizacion,
            id_cotizacion_exenta = :id_cotizacion_exenta,
            fecha_orden_emision = :fecha_orden_emision,
            fecha_orden_vencimiento = :fecha_orden_vencimiento,
            centro_costo = :centro_costo,
            bodega_destino = :bodega_destino,
            tipo_produccion = :tipo_produccion,
            id_producto_produccion = :id_producto_produccion,
            id_unidad = :id_unidad,
            cantidad_produccion = :cantidad_produccion,
            fecha_elaboracion = :fecha_elaboracion,
            fecha_elaboracion_vencimiento = :fecha_elaboracion_vencimiento,
            codigo_lote = :codigo_lote,
            observaciones = :observaciones,
            costo_embalaje_total = :costo_embalaje_total,
            costo_produccion_total = :costo_produccion_total,
            costo_produccion_total_con_embalaje = :costo_produccion_total_con_embalaje
        WHERE id = :id");

        // Vincular los parámetros
        $stmt->bindParam(":folio_orden_produccion", $datos["folio_orden_produccion"], PDO::PARAM_INT);
        $stmt->bindParam(":nombre_orden", $datos["nombre_orden"], PDO::PARAM_STR);
        $stmt->bindParam(":estado_orden", $datos["estado_orden"], PDO::PARAM_STR);
        $stmt->bindParam(":tipo_orden", $datos["tipo_orden"], PDO::PARAM_STR);

        if ($datos["id_cliente"] === null) {
            $stmt->bindValue(":id_cliente", null, PDO::PARAM_NULL);
        } else {
            $stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);
        }

        if ($datos["id_cotizacion"] === null) {
            $stmt->bindValue(":id_cotizacion", null, PDO::PARAM_NULL);
        } else {
            $stmt->bindParam(":id_cotizacion", $datos["id_cotizacion"], PDO::PARAM_INT);
        }

        if ($datos["id_cotizacion_exenta"] === null) {
            $stmt->bindValue(":id_cotizacion_exenta", null, PDO::PARAM_NULL);
        } else {
            $stmt->bindParam(":id_cotizacion_exenta", $datos["id_cotizacion_exenta"], PDO::PARAM_INT);
        }

        $stmt->bindParam(":fecha_orden_emision", $datos["fecha_orden_emision"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_orden_vencimiento", $datos["fecha_orden_vencimiento"], PDO::PARAM_STR);
        $stmt->bindParam(":centro_costo", $datos["centro_costo"], PDO::PARAM_INT);
        $stmt->bindParam(":bodega_destino", $datos["bodega_destino"], PDO::PARAM_INT);
        $stmt->bindParam(":tipo_produccion", $datos["tipo_produccion"], PDO::PARAM_STR);
        $stmt->bindParam(":id_producto_produccion", $datos["id_producto_produccion"], PDO::PARAM_INT);
        $stmt->bindParam(":id_unidad", $datos["id_unidad"], PDO::PARAM_INT);
        $stmt->bindParam(":cantidad_produccion", $datos["cantidad_produccion"], PDO::PARAM_INT);
        $stmt->bindParam(":fecha_elaboracion", $datos["fecha_elaboracion"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_elaboracion_vencimiento", $datos["fecha_elaboracion_vencimiento"], PDO::PARAM_STR);
        $stmt->bindParam(":codigo_lote", $datos["codigo_lote"], PDO::PARAM_STR);

        if ($datos["observaciones"] === "") {
            $stmt->bindValue(":observaciones", null, PDO::PARAM_NULL);
        } else {
            $stmt->bindParam(":observaciones", $datos["observaciones"], PDO::PARAM_STR);
        }

        $stmt->bindParam(":costo_embalaje_total", $datos["costo_embalaje_total"], PDO::PARAM_INT);
        $stmt->bindParam(":costo_produccion_total", $datos["costo_produccion_total"], PDO::PARAM_INT);
        $stmt->bindParam(":costo_produccion_total_con_embalaje", $datos["costo_produccion_total_con_embalaje"], PDO::PARAM_INT);
        $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
    } catch (PDOException $e) {
        return "error: " . $e->getMessage();
    }
}



  static public function mdlEliminarOrdenProduccionMateriales($tabla, $folioOrden)
  {
    $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_orden_produccion = :folio");
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
  static public function mdlEliminarNuevaOrdenProduccion($tabla, $folioOrden)
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
}
