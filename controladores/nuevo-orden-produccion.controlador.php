<?php

class ControladorNuevoOrdenProduccion
{
  /**
   * Crear Orden de Producción
   */
  static public function ctrCrearOrdenProduccion()
  {
    if (isset($_POST["nuevoFolio"])) {
      // Inicializar variables nulas
      $idCliente = null;
      $idCotizacion = null;
      $idCotizacionExenta = null;

      // Validar cliente según tipo de orden
      if ($_POST["tipoOrden"] !== "Para Stock") {
        $idCliente = $_POST["traerIdCliente"];

        // Validar cotización según tipo de orden
        if ($_POST["tipoOrden"] !== "Cliente sin Cotización") {
          // Validar que solo una cotización esté presente
          if (
            isset($_POST["traerIdCotizacionAfecta"]) && !empty($_POST["traerIdCotizacionAfecta"])
            && (empty($_POST["traerIdCotizacionExenta"]) || !isset($_POST["traerIdCotizacionExenta"]))
          ) {
            $idCotizacion = $_POST["traerIdCotizacionAfecta"];
          } else if (
            isset($_POST["traerIdCotizacionExenta"]) && !empty($_POST["traerIdCotizacionExenta"])
            && (empty($_POST["traerIdCotizacionAfecta"]) || !isset($_POST["traerIdCotizacionAfecta"]))
          ) {
            $idCotizacionExenta = $_POST["traerIdCotizacionExenta"];
          }
        }
      }

      // Crear orden principal
      $tabla = "nueva_orden_produccion";
      $datos = array(
        "folio_orden_produccion" => $_POST["nuevoFolio"],
        "nombre_orden" => $_POST["nuevoNombreOrden"],
        "estado_orden" => "En Proceso",
        "tipo_orden" => $_POST["tipoOrden"],
        "id_cliente" => $idCliente,
        "id_cotizacion" => $idCotizacion,
        "id_cotizacion_exenta" => $idCotizacionExenta,
        "fecha_orden_emision" => $_POST["nuevaFechaEmision"],
        "fecha_orden_vencimiento" => $_POST["nuevaFechaVencimiento"],
        "centro_costo" => $_POST["nuevoCentro"],
        "bodega_destino" => $_POST["nuevaBodega"],
        "tipo_produccion" => $_POST["tipoProduccion"],
        "id_producto_produccion" => $_POST["idProductoProduccion"],
        "id_unidad" => $_POST["detalleUnidad"],
        "cantidad_produccion" => $_POST["detalleCantidadProducir"],
        "fecha_elaboracion" => $_POST["detalleFechaElaboracion"],
        "fecha_elaboracion_vencimiento" => $_POST["detalleFechaElaboracionVencimiento"],
        "codigo_lote" => $_POST["detalleCodigoLote"],
        "observaciones" => $_POST["detalleObservacion"],
        "costo_embalaje_total" => $_POST["costoEmbalajeTotal"],
        "costo_produccion_total" => $_POST["costoProduccionTotal"],
        "costo_produccion_total_con_embalaje" => $_POST["costoProduccionTotalConEmbalaje"]
      );

      $respuesta = ModeloNuevoOrdenProduccion::mdlCrearOrdenProduccion($tabla, $datos);

      if ($respuesta == "ok") {
        // Obtener el ID de la última inserción
        $idOrden = ModeloNuevoOrdenProduccion::mdlObtenerUltimoId();

        if ($idOrden) {
          // Crear materiales de la orden
          $tabla = "orden_produccion_materiales";
          $materiales = json_decode($_POST["materialesOrden"], true);

          foreach ($materiales as $material) {
            $datosMaterial = array(
              "id_orden_produccion" => $idOrden,
              "id_producto" => $material["id_producto"],
              "id_tipo_material" => $material["id_tipo_material"],
              "id_unidad" => $material["id_unidad"],
              "cantidad" => $material["cantidad"],
              "precio_unitario" => $material["precio_unitario"],
              "costo_total" => $material["costo_total"]
            );

            $respuestaMaterial = ModeloNuevoOrdenProduccion::mdlCrearOrdenProduccionMateriales($tabla, $datosMaterial);

            if ($respuestaMaterial != "ok") {
              echo '<script>
                swal({
                  type: "error",
                  title: "Error al crear los materiales de la orden",
                  text: "' . $respuestaMaterial . '",
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
              title: "Error al obtener el ID de la orden",
              showConfirmButton: true,
              confirmButtonText: "Cerrar"
            });
          </script>';
          return;
        }
      } else {
        echo '<script>
          swal({
            type: "error",
            title: "Error al crear la orden de producción",
            text: "' . $respuesta . '",
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
    $tabla = "nueva_orden_produccion";
    $respuesta = ModeloNuevoOrdenProduccion::mdlObtenerUltimoFolio($tabla);
    return ($respuesta) ? $respuesta["folio_orden_produccion"] + 1 : 1;
  }

  static public function ctrNuevaMostrarOrdenesProduccion($item, $valor)
  {
    $tabla = "nueva_orden_produccion";

    $respuesta = ModeloNuevoOrdenProduccion::mdlMostrarOrdenesProduccion($tabla, $item, $valor);

		return $respuesta;
  }

  /**
   * Mostrar el detalle de las Órdenes de Producción
   */
  static public function ctrMostrarOrdenesProduccionMateriales($item, $valor)
  {
    $tabla = "orden_produccion_materiales";
    return ModeloNuevoOrdenProduccion::mdlMostrarOrdenesProduccionMateriales($tabla, $item, $valor);
  }

  static public function ctrEliminarNuevaOrdenProduccion()
  {
    if (isset($_GET["idOrdenProduccion"])) {
      // Obtener el ID de la orden de producción
      $folioOrden = $_GET["idOrdenProduccion"];

      // Eliminar los detalles de la orden de producción primero
      $tablaMateriales = "orden_produccion_materiales";
      $respuestaMateriales = ModeloNuevoOrdenProduccion::mdlEliminarOrdenProduccionMateriales($tablaMateriales, $folioOrden);

      if ($respuestaMateriales == "ok") {
        // Luego eliminar la orden de producción principal
        $tabla = "nueva_orden_produccion";
        $respuesta = ModeloNuevoOrdenProduccion::mdlEliminarNuevaOrdenProduccion($tabla, $folioOrden);

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
