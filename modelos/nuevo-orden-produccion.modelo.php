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
}
