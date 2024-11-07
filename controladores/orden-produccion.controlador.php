<?php

class ControladorOrdenProduccion
{
  /**
   * Crear Orden de Producción
   */
  static public function ctrCrearOrdenProduccion()
  {
    if (isset($_POST["nuevoCodigo"])) {
      // Crear orden principal
      $tabla = "orden_produccion";
      $datos = array(
        "folio_orden_produccion" => $_POST["nuevoCodigo"],
        "id_cliente" => $_POST["tipoOrden"] === "Producción Stock" || $_POST["tipoOrden"] === "PACK" ?
          NULL : $_POST["nuevoCliente"],
        "tipo_orden" => $_POST["tipoOrden"],
        "nombre_orden" => $_POST["nuevoNombreOrden"],
        "fecha_emision" => $_POST["nuevaFechaEmision"],
        "fecha_vencimiento" => $_POST["nuevaFechaVencimiento"],
        "centro_costo" => $_POST["nuevoCentro"],
        "bodega_destino" => $_POST["nuevaBodega"],
        "cantidad_producida_total" => $_POST["cantidadProducidaTotal"],
        "costo_unitario_total" => $_POST["costoUnitarioTotal"],
        "costo_produccion_total" => $_POST["costoProduccionTotal"],
        "costo_embalaje_total" => $_POST["costoEmbalajeTotal"],
        "costo_total_con_embalaje" => $_POST["costoTotalConEmbalaje"]
      );

      $respuesta = ModeloOrdenProduccion::mdlCrearOrdenProduccion($tabla, $datos);

      if ($respuesta == "ok") {
        // Obtener el folio de la orden recién creada
        $folioOrden = $_POST["nuevoCodigo"];

        /**
         * Crear Detalle de la Orden de Producción
         */
        $tabla = "orden_produccion_detalle";
        $productos = json_decode($_POST["productosOrden"], true);

        foreach ($productos as $producto) {
          $datosDetalle = array(
            "folio_orden_produccion" => $folioOrden,
            "id_producto" => $producto["id_producto"],
            "id_unidad" => $producto["id_unidad"],
            "codigo_lote" => $producto["codigo_lote"],
            "fecha_produccion" => $producto["fecha_produccion"],
            "fecha_vencimiento" => $producto["fecha_vencimiento"],
            "cantidad_producida" => $producto["cantidad_producida"],
            "costo_unitario" => $producto["costo_unitario"],
            "costo_produccion" => $producto["costo_produccion"],
            "costo_embalaje" => $producto["costo_embalaje"],
            "costo_produccion_con_embalaje" => $producto["costo_produccion_con_embalaje"]
          );

          $respuestaDetalle = ModeloOrdenProduccion::mdlCrearOrdenProduccionDetalle($tabla, $datosDetalle);

          if ($respuestaDetalle != "ok") {
            echo '<script>
              console.error("Error en datos:", ' . json_encode($datosDetalle) . ');
              swal({
                type: "error",
                title: "Error al crear el detalle de la orden",
                text: "' . $respuestaDetalle . '",
                showConfirmButton: true,
                confirmButtonText: "Cerrar"
              });
            </script>';
            return;
          }
        }
        echo '<script>
          swal({
            type: "success",
            title: "La orden de producción ha sido creada correctamente",
            showConfirmButton: true,
            confirmButtonText: "Cerrar"
          }).then(function(result) {
            if (result.value) {
              window.location = "administrar-orden-produccion";
            }
          });
        </script>';
      } else {
        echo '<script>
          swal({
            type: "error",
            title: "Error al crear la orden de producción",
            text: "Por favor, intente nuevamente",
            showConfirmButton: true,
            confirmButtonText: "Cerrar"
          });
        </script>';
      }
    }
  }

  /**
   * Obtener el último folio de la orden de producción
   */
  public static function ctrObtenerUltimoFolio()
  {
    $tabla = "orden_produccion";
    $respuesta = ModeloOrdenProduccion::mdlObtenerUltimoFolio($tabla);
    return ($respuesta) ? $respuesta["folio_orden_produccion"] + 1 : 1;
  }

    /**
   * Mostrar todas las órdenes de producción
   */
  static public function ctrMostrarOrdenesProduccion($item, $valor)
  {
      $tabla = "orden_produccion";
      $respuesta = ModeloOrdenProduccion::mdlMostrarOrdenesProduccion($tabla, $item, $valor);
      return $respuesta;
  }

  
  /**
   * Eliminar orden de produccion como su detalle
   */
  static public function ctrEliminarOrdenProduccion() {
    if (isset($_GET["idOrdenProduccion"])) {
        // Eliminar detalles de la orden de producción
        $tablaDetalle = "orden_produccion_detalle";
        $folioOrden = $_GET["idOrdenProduccion"];				
  
        $respuestaDetalle = ModeloOrdenProduccion::mdlEliminarOrdenProduccionDetalle($tablaDetalle, $folioOrden);

        if ($respuestaDetalle == "ok") {
            // Eliminar la orden de producción principal
            $tabla = "orden_produccion";
            $respuesta = ModeloOrdenProduccion::mdlEliminarOrdenProduccion($tabla, $folioOrden);

            if ($respuesta == "ok") {
                echo '<script>
                    swal({
                        type: "success",
                        title: "La orden de producción ha sido eliminada correctamente",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then(function(result) {
                        if (result.value) {
                            window.location = "administrar-orden-produccion";
                        }
                    });
                </script>';
            } else {
                echo '<script>
                    swal({
                        type: "error",
                        title: "Error al eliminar la orden de producción",
                        text: "Por favor, intente nuevamente",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    });
                </script>';
            }
        } else {
            echo '<script>
                swal({
                    type: "error",
                    title: "Error al eliminar los detalles de la orden de producción",
                    text: "Por favor, intente nuevamente",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"
                });
            </script>';
        }
    }
}





}
