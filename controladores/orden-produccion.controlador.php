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
   * Mostrar las Órdenes de Producción con rango de fechas
   */
  static public function ctrMostrarOrdenesProduccion($item, $valor)
  {
    $tabla = "orden_produccion";

    $fechaInicial = isset($_GET["fechaInicial"]) ? $_GET["fechaInicial"] : null;
    $fechaFinal = isset($_GET["fechaFinal"]) ? $_GET["fechaFinal"] : null;

    return ModeloOrdenProduccion::mdlMostrarOrdenesProduccion($tabla, $item, $valor, $fechaInicial, $fechaFinal);
  }

  /**
   * Mostrar el detalle de las Órdenes de Producción
   */
  static public function ctrMostrarOrdenesProduccionDetalle($item, $valor)
  {
    $tabla = "orden_produccion_detalle";
    return ModeloOrdenProduccion::mdlMostrarOrdenesProduccionDetalle($tabla, $item, $valor);
  }


  /**
   * Eliminar Orden de Producción como su detalle
   */
  static public function ctrEliminarOrdenProduccion()
  {
    if (isset($_GET["idOrdenProduccion"])) {
      // Obtener el ID de la orden de producción
      $folioOrden = $_GET["idOrdenProduccion"];

      // Eliminar los detalles de la orden de producción primero
      $tablaDetalle = "orden_produccion_detalle";
      $respuestaDetalle = ModeloOrdenProduccion::mdlEliminarOrdenProduccionDetalle($tablaDetalle, $folioOrden);

      if ($respuestaDetalle == "ok") {
        // Luego eliminar la orden de producción principal
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


  /**
   * Descargar reporte de Órdenes de Producción
   */
  public function ctrDescargarReporteOrdenProduccion()
  {
    if (isset($_GET["reporte"])) {

      $tabla = "orden_produccion";

      // Obtener las fechas de la URL
      $fechaInicial = isset($_GET["fechaInicial"]) ? $_GET["fechaInicial"] : null;
      $fechaFinal = isset($_GET["fechaFinal"]) ? $_GET["fechaFinal"] : null;

      $ordenes = ModeloOrdenProduccion::mdlMostrarOrdenesProduccion($tabla, null, null, $fechaInicial, $fechaFinal);

      // Nombre del archivo incluyendo fechas si están disponibles
      $Name = $_GET["reporte"] . '-oreden-producción';
      if ($fechaInicial && $fechaFinal) {
        $Name .= '-desde-' . $fechaInicial . '-hasta-' . $fechaFinal;
      }
      $Name .= '.xls';


      header('Expires: 0');
      header('Cache-control: private');
      header("Content-type: application/vnd.ms-excel"); // Archivo de Excel
      header("Cache-Control: cache, must-revalidate");
      header('Content-Description: File Transfer');
      header('Last-Modified: ' . date('D, d M Y H:i:s'));
      header("Pragma: public");
      header('Content-Disposition:; filename="' . $Name . '"');
      header("Content-Transfer-Encoding: binary");

      // Contadores de órdenes
      $totalConCotizacion = 0;
      $totalSinCotizacion = 0;
      $totalProduccionStock = 0;
      $totalPack = 0;

      // Contar el total de órdenes por tipo
      foreach ($ordenes as $item) {
        if ($item["tipo_orden"] === "Cliente con Cotización") {
          $totalConCotizacion++;
        } elseif ($item["tipo_orden"] === "Cliente sin Cotización") {
          $totalSinCotizacion++;
        } elseif ($item["tipo_orden"] === "Producción Stock") {
          $totalProduccionStock++;
        } elseif ($item["tipo_orden"] === "PACK") {
          $totalPack++;
        }
      }

      echo utf8_decode("<table border='0'>
    <tr>
      <tr><td colspan='23' style='font-weight:bold; background-color:#f0f0f0;'>CLIENTE CON COTIZACIÓN (Total: $totalConCotizacion)</td></tr>
        <td style='font-weight:bold; border:1px solid #eee;'>FOLIO</td>
        <td style='font-weight:bold; border:1px solid #eee;'>CLIENTE</td>
        <td style='font-weight:bold; border:1px solid #eee;'>TIPO DE ORDEN</td>
        <td style='font-weight:bold; border:1px solid #eee;'>NOMBRE DE ORDEN</td>
        <td style='font-weight:bold; border:1px solid #eee;'>FECHA EMISIÓN</td>
        <td style='font-weight:bold; border:1px solid #eee;'>FECHA VENCIMIENTO</td>
        <td style='font-weight:bold; border:1px solid #eee;'>CENTRO DE COSTO</td>
        <td style='font-weight:bold; border:1px solid #eee;'>BODEGA DE DESTINO</td>
        <td style='font-weight:bold; border:1px solid #eee;'>CANTIDAD PRODUCIDA TOTAL</td>
        <td style='font-weight:bold; border:1px solid #eee;'>COSTO UNITARIO TOTAL</td>
        <td style='font-weight:bold; border:1px solid #eee;'>COSTO PRODUCCIÓN TOTAL</td>
        <td style='font-weight:bold; border:1px solid #eee;'>COSTO DE EMBALAJE TOTAL</td>
        <td style='font-weight:bold; border:1px solid #eee;'>COSTO TOTAL CON EMBALAJE</td>
        <td style='font-weight:bold; border:1px solid #eee;'>PRODUCTO</td>
        <td style='font-weight:bold; border:1px solid #eee;'>UNIDAD</td>
        <td style='font-weight:bold; border:1px solid #eee;'>CÓDIGO DE LOTE</td>        
        <td style='font-weight:bold; border:1px solid #eee;'>FECHA DE EMISIÓN</td>
        <td style='font-weight:bold; border:1px solid #eee;'>FECHA DE VENCIMIENTO</td>
        <td style='font-weight:bold; border:1px solid #eee;'>CANTIDAD PRODUCIDA</td>
        <td style='font-weight:bold; border:1px solid #eee;'>COSTO UNITARIO</td>
        <td style='font-weight:bold; border:1px solid #eee;'>COSTO DE PRODUCCIÓN</td>
        <td style='font-weight:bold; border:1px solid #eee;'>COSTO DE EMBALAJE</td>
        <td style='font-weight:bold; border:1px solid #eee;'>COSTO DE PRODUCCIÓN DE EMBALAJE</td>
    </tr>

    ");

      foreach ($ordenes as $row => $item) {
        if ($item["tipo_orden"] === "Cliente con Cotización") {
          $ordenesProduccionDetalle = ControladorOrdenProduccion::ctrMostrarOrdenesProduccionDetalle("folio_orden_produccion", $item["folio_orden_produccion"]);
          $cliente = ControladorClientes::ctrMostrarClientes("id", $item["id_cliente"]);
          $centro = ControladorCentros::ctrMostrarCentros("id", $item["centro_costo"]);
          $bodega = ControladorBodegas::ctrMostrarBodegas("id", $item["bodega_destino"]);

          $clienteNombre = isset($cliente["nombre"]) ? $cliente["nombre"] : "No disponible";
          $centroNombre = isset($centro["centro"]) ? $centro["centro"] : "No disponible";
          $bodegaNombre = isset($bodega["nombre"]) ? $bodega["nombre"] : "No disponible";

          // Crear una cadena con los códigos de los detalles
          $medidaDetalle = [];
          $nombreDetalle = [];
          $codigosDetalle = [];
          $emisionDetalle = [];
          $vencimientoDetalle = [];
          $cantidadProducidaDetalle = [];
          $costoUnitarioDetalle = [];
          $costoProduccionDetalle = [];
          $costoEmbalajeDetalle = [];
          $costoProduccionConEmbalajeDetalle = [];

          foreach ($ordenesProduccionDetalle as $detalle) {
            $itemNo = null;
            $productos = ControladorProductos::ctrMostrarProductosPredeterminado("id", $detalle["id_producto"]);
            $unidad = ControladorUnidades::ctrMostrarunidades($itemNo, $detalle["id_unidad"]);

            $codigosDetalle[] = $detalle["codigo_lote"];
            $emisionDetalle[] = $detalle["fecha_produccion"];
            $vencimientoDetalle[] = $detalle["fecha_vencimiento"];
            $cantidadProducidaDetalle[] = $detalle["cantidad_producida"];
            $costoUnitarioDetalle[] = $detalle["costo_unitario"];
            $costoProduccionDetalle[] = $detalle["costo_produccion"];
            $costoEmbalajeDetalle[] = $detalle["costo_embalaje"];
            $costoProduccionConEmbalajeDetalle[] = $detalle["costo_produccion_con_embalaje"];

            foreach ($unidad as $cli) {
              if ($cli["id"] == $detalle["id_unidad"]) {
                $medidaDetalle[] = $cli["medida"];
                break;
              }
            }

            foreach ($productos as $pro) {
              if ($pro["id"] == $detalle["id_producto"]) {
                $codigoDetalle[] = $pro["codigo"];
                $nombreDetalle[] = $pro["descripcion"];
                break;
              }
            }
          }

          // Crear cadenas con los valores de cada detalle usando implode()
          $medidaDetalleStr = implode("<li>", $medidaDetalle);
          $nombreDetalleStr = implode("<li>", $nombreDetalle);
          $codigosDetalleStr = implode("<li>", $codigosDetalle);
          $emisionDetalleStr = implode("<li>", $emisionDetalle);
          $vencimientoDetalleStr = implode("<li>", $vencimientoDetalle);
          $cantidadProducidaDetalleStr = implode("<li>", $cantidadProducidaDetalle);
          $costoUnitarioDetalleStr = implode("<li>", $costoUnitarioDetalle);
          $costoProduccionDetalleStr = implode("<li>", $costoProduccionDetalle);
          $costoEmbalajeDetalleStr = implode("<li>", $costoEmbalajeDetalle);
          $costoProduccionConEmbalajeDetalleStr = implode("<li>", $costoProduccionConEmbalajeDetalle);

          // Mostrar los datos de la orden
          echo utf8_decode("<tr>
            <td style='border:1px solid #eee;'>" . $item["folio_orden_produccion"] . "</td>
            <td style='border:1px solid #eee;'>" . $clienteNombre . "</td>
            <td style='border:1px solid #eee;'>" . $item["tipo_orden"] . "</td>
            <td style='border:1px solid #eee;'>" . $item["nombre_orden"] . "</td>
            <td style='border:1px solid #eee;'>" . substr($item["fecha_emision"], 0, 10) . "</td>
            <td style='border:1px solid #eee;'>" . substr($item["fecha_vencimiento"], 0, 10) . "</td>
            <td style='border:1px solid #eee;'>" . $centroNombre . "</td>
            <td style='border:1px solid #eee;'>" . $bodegaNombre . "</td>
            <td style='border:1px solid #eee;'>" . $item["cantidad_producida_total"] . "</td>
            <td style='border:1px solid #eee;'>" . $item["costo_unitario_total"] . "</td>
            <td style='border:1px solid #eee;'>" . $item["costo_produccion_total"] . "</td>
            <td style='border:1px solid #eee;'>" . $item["costo_embalaje_total"] . "</td>
            <td style='border:1px solid #eee;'>" . $item["costo_total_con_embalaje"] . "</td>
            <td style='border:1px solid #eee;'>" . $nombreDetalleStr . "</td>
            <td style='border:1px solid #eee;'>" . $medidaDetalleStr . "</td>
            <td style='border:1px solid #eee;'>" . $codigosDetalleStr . "</td>
            <td style='border:1px solid #eee;'>" . $emisionDetalleStr . "</td>
            <td style='border:1px solid #eee;'>" . $vencimientoDetalleStr . "</td>
            <td style='border:1px solid #eee;'>" . $cantidadProducidaDetalleStr . "</td>
            <td style='border:1px solid #eee;'>" . $costoUnitarioDetalleStr . "</td>
            <td style='border:1px solid #eee;'>" . $costoProduccionDetalleStr . "</td>
            <td style='border:1px solid #eee;'>" . $costoEmbalajeDetalleStr . "</td>
            <td style='border:1px solid #eee;'>" . $costoProduccionConEmbalajeDetalleStr . "</td>
            
        </tr>");
        }
      }
      echo "</table>";

      echo utf8_decode("<table border='0'>
    <tr>
    <tr><td colspan='23' style='font-weight:bold; background-color:#f0f0f0;'>CLIENTE SIN COTIZACIÓN (Total: $totalSinCotizacion)</td></tr>
        <td style='font-weight:bold; border:1px solid #eee;'>FOLIO</td>
        <td style='font-weight:bold; border:1px solid #eee;'>CLIENTE</td>
        <td style='font-weight:bold; border:1px solid #eee;'>TIPO DE ORDEN</td>
        <td style='font-weight:bold; border:1px solid #eee;'>NOMBRE DE ORDEN</td>
        <td style='font-weight:bold; border:1px solid #eee;'>FECHA EMISIÓN</td>
        <td style='font-weight:bold; border:1px solid #eee;'>FECHA VENCIMIENTO</td>
        <td style='font-weight:bold; border:1px solid #eee;'>CENTRO DE COSTO</td>
        <td style='font-weight:bold; border:1px solid #eee;'>BODEGA DE DESTINO</td>
        <td style='font-weight:bold; border:1px solid #eee;'>CANTIDAD PRODUCIDA TOTAL</td>
        <td style='font-weight:bold; border:1px solid #eee;'>COSTO UNITARIO TOTAL</td>
        <td style='font-weight:bold; border:1px solid #eee;'>COSTO PRODUCCIÓN TOTAL</td>
        <td style='font-weight:bold; border:1px solid #eee;'>COSTO DE EMBALAJE TOTAL</td>
        <td style='font-weight:bold; border:1px solid #eee;'>COSTO TOTAL CON EMBALAJE</td>
        <td style='font-weight:bold; border:1px solid #eee;'>PRODUCTO</td>
        <td style='font-weight:bold; border:1px solid #eee;'>UNIDAD</td>
        <td style='font-weight:bold; border:1px solid #eee;'>CÓDIGO DE LOTE</td>        
        <td style='font-weight:bold; border:1px solid #eee;'>FECHA DE EMISIÓN</td>
        <td style='font-weight:bold; border:1px solid #eee;'>FECHA DE VENCIMIENTO</td>
        <td style='font-weight:bold; border:1px solid #eee;'>CANTIDAD PRODUCIDA</td>
        <td style='font-weight:bold; border:1px solid #eee;'>COSTO UNITARIO</td>
        <td style='font-weight:bold; border:1px solid #eee;'>COSTO DE PRODUCCIÓN</td>
        <td style='font-weight:bold; border:1px solid #eee;'>COSTO DE EMBALAJE</td>
        <td style='font-weight:bold; border:1px solid #eee;'>COSTO DE PRODUCCIÓN DE EMBALAJE</td>
    </tr>

    ");

      foreach ($ordenes as $row => $item) {
        if ($item["tipo_orden"] === "Cliente sin Cotización") {
          $ordenesProduccionDetalle = ControladorOrdenProduccion::ctrMostrarOrdenesProduccionDetalle("folio_orden_produccion", $item["folio_orden_produccion"]);
          $cliente = ControladorClientes::ctrMostrarClientes("id", $item["id_cliente"]);
          $centro = ControladorCentros::ctrMostrarCentros("id", $item["centro_costo"]);
          $bodega = ControladorBodegas::ctrMostrarBodegas("id", $item["bodega_destino"]);

          $clienteNombre = isset($cliente["nombre"]) ? $cliente["nombre"] : "No disponible";
          $centroNombre = isset($centro["centro"]) ? $centro["centro"] : "No disponible";
          $bodegaNombre = isset($bodega["nombre"]) ? $bodega["nombre"] : "No disponible";

          // Crear una cadena con los códigos de los detalles
          $medidaDetalle = [];
          $nombreDetalle = [];
          $codigosDetalle = [];
          $emisionDetalle = [];
          $vencimientoDetalle = [];
          $cantidadProducidaDetalle = [];
          $costoUnitarioDetalle = [];
          $costoProduccionDetalle = [];
          $costoEmbalajeDetalle = [];
          $costoProduccionConEmbalajeDetalle = [];

          foreach ($ordenesProduccionDetalle as $detalle) {
            $itemNo = null;
            $productos = ControladorProductos::ctrMostrarProductosPredeterminado("id", $detalle["id_producto"]);
            $unidad = ControladorUnidades::ctrMostrarunidades($itemNo, $detalle["id_unidad"]);

            $codigosDetalle[] = $detalle["codigo_lote"];
            $emisionDetalle[] = $detalle["fecha_produccion"];
            $vencimientoDetalle[] = $detalle["fecha_vencimiento"];
            $cantidadProducidaDetalle[] = $detalle["cantidad_producida"];
            $costoUnitarioDetalle[] = $detalle["costo_unitario"];
            $costoProduccionDetalle[] = $detalle["costo_produccion"];
            $costoEmbalajeDetalle[] = $detalle["costo_embalaje"];
            $costoProduccionConEmbalajeDetalle[] = $detalle["costo_produccion_con_embalaje"];

            foreach ($unidad as $cli) {
              if ($cli["id"] == $detalle["id_unidad"]) {
                $medidaDetalle[] = $cli["medida"];
                break;
              }
            }

            foreach ($productos as $pro) {
              if ($pro["id"] == $detalle["id_producto"]) {
                $codigoDetalle[] = $pro["codigo"];
                $nombreDetalle[] = $pro["descripcion"];
                break;
              }
            }
          }

          // Crear cadenas con los valores de cada detalle usando implode()
          $medidaDetalleStr = implode("<li>", $medidaDetalle);
          $nombreDetalleStr = implode("<li>", $nombreDetalle);
          $codigosDetalleStr = implode("<li>", $codigosDetalle);
          $emisionDetalleStr = implode("<li>", $emisionDetalle);
          $vencimientoDetalleStr = implode("<li>", $vencimientoDetalle);
          $cantidadProducidaDetalleStr = implode("<li>", $cantidadProducidaDetalle);
          $costoUnitarioDetalleStr = implode("<li>", $costoUnitarioDetalle);
          $costoProduccionDetalleStr = implode("<li>", $costoProduccionDetalle);
          $costoEmbalajeDetalleStr = implode("<li>", $costoEmbalajeDetalle);
          $costoProduccionConEmbalajeDetalleStr = implode("<li>", $costoProduccionConEmbalajeDetalle);

          // Mostrar los datos de la orden
          echo utf8_decode("<tr>
            <td style='border:1px solid #eee;'>" . $item["folio_orden_produccion"] . "</td>
            <td style='border:1px solid #eee;'>" . $clienteNombre . "</td>
            <td style='border:1px solid #eee;'>" . $item["tipo_orden"] . "</td>
            <td style='border:1px solid #eee;'>" . $item["nombre_orden"] . "</td>
            <td style='border:1px solid #eee;'>" . substr($item["fecha_emision"], 0, 10) . "</td>
            <td style='border:1px solid #eee;'>" . substr($item["fecha_vencimiento"], 0, 10) . "</td>
            <td style='border:1px solid #eee;'>" . $centroNombre . "</td>
            <td style='border:1px solid #eee;'>" . $bodegaNombre . "</td>
            <td style='border:1px solid #eee;'>" . $item["cantidad_producida_total"] . "</td>
            <td style='border:1px solid #eee;'>" . $item["costo_unitario_total"] . "</td>
            <td style='border:1px solid #eee;'>" . $item["costo_produccion_total"] . "</td>
            <td style='border:1px solid #eee;'>" . $item["costo_embalaje_total"] . "</td>
            <td style='border:1px solid #eee;'>" . $item["costo_total_con_embalaje"] . "</td>
            <td style='border:1px solid #eee;'>" . $nombreDetalleStr . "</td>
            <td style='border:1px solid #eee;'>" . $medidaDetalleStr . "</td>
            <td style='border:1px solid #eee;'>" . $codigosDetalleStr . "</td>
            <td style='border:1px solid #eee;'>" . $emisionDetalleStr . "</td>
            <td style='border:1px solid #eee;'>" . $vencimientoDetalleStr . "</td>
            <td style='border:1px solid #eee;'>" . $cantidadProducidaDetalleStr . "</td>
            <td style='border:1px solid #eee;'>" . $costoUnitarioDetalleStr . "</td>
            <td style='border:1px solid #eee;'>" . $costoProduccionDetalleStr . "</td>
            <td style='border:1px solid #eee;'>" . $costoEmbalajeDetalleStr . "</td>
            <td style='border:1px solid #eee;'>" . $costoProduccionConEmbalajeDetalleStr . "</td>
        </tr>");
        }
      }
      echo "</table>";

      echo utf8_decode("<table border='0'>
    <tr>
    <tr><td colspan='22' style='font-weight:bold; background-color:#f0f0f0;'>PRODUCCIÓN EN STOCK (Total: $totalProduccionStock)</td></tr>
        <td style='font-weight:bold; border:1px solid #eee;'>FOLIO</td>
        
        <td style='font-weight:bold; border:1px solid #eee;'>TIPO DE ORDEN</td>
        <td style='font-weight:bold; border:1px solid #eee;'>NOMBRE DE ORDEN</td>
        <td style='font-weight:bold; border:1px solid #eee;'>FECHA EMISIÓN</td>
        <td style='font-weight:bold; border:1px solid #eee;'>FECHA VENCIMIENTO</td>
        <td style='font-weight:bold; border:1px solid #eee;'>CENTRO DE COSTO</td>
        <td style='font-weight:bold; border:1px solid #eee;'>BODEGA DE DESTINO</td>
        <td style='font-weight:bold; border:1px solid #eee;'>CANTIDAD PRODUCIDA TOTAL</td>
        <td style='font-weight:bold; border:1px solid #eee;'>COSTO UNITARIO TOTAL</td>
        <td style='font-weight:bold; border:1px solid #eee;'>COSTO PRODUCCIÓN TOTAL</td>
        <td style='font-weight:bold; border:1px solid #eee;'>COSTO DE EMBALAJE TOTAL</td>
        <td style='font-weight:bold; border:1px solid #eee;'>COSTO TOTAL CON EMBALAJE</td>
        <td style='font-weight:bold; border:1px solid #eee;'>PRODUCTO</td>
        <td style='font-weight:bold; border:1px solid #eee;'>UNIDAD</td>
        <td style='font-weight:bold; border:1px solid #eee;'>CÓDIGO DE LOTE</td>        
        <td style='font-weight:bold; border:1px solid #eee;'>FECHA DE EMISIÓN</td>
        <td style='font-weight:bold; border:1px solid #eee;'>FECHA DE VENCIMIENTO</td>
        <td style='font-weight:bold; border:1px solid #eee;'>CANTIDAD PRODUCIDA</td>
        <td style='font-weight:bold; border:1px solid #eee;'>COSTO UNITARIO</td>
        <td style='font-weight:bold; border:1px solid #eee;'>COSTO DE PRODUCCIÓN</td>
        <td style='font-weight:bold; border:1px solid #eee;'>COSTO DE EMBALAJE</td>
        <td style='font-weight:bold; border:1px solid #eee;'>COSTO DE PRODUCCIÓN DE EMBALAJE</td>
    </tr>

    ");

      foreach ($ordenes as $row => $item) {
        if ($item["tipo_orden"] === "Producción Stock") {
          $ordenesProduccionDetalle = ControladorOrdenProduccion::ctrMostrarOrdenesProduccionDetalle("folio_orden_produccion", $item["folio_orden_produccion"]);

          $centro = ControladorCentros::ctrMostrarCentros("id", $item["centro_costo"]);
          $bodega = ControladorBodegas::ctrMostrarBodegas("id", $item["bodega_destino"]);


          $centroNombre = isset($centro["centro"]) ? $centro["centro"] : "No disponible";
          $bodegaNombre = isset($bodega["nombre"]) ? $bodega["nombre"] : "No disponible";

          // Crear una cadena con los códigos de los detalles
          $medidaDetalle = [];
          $nombreDetalle = [];
          $codigosDetalle = [];
          $emisionDetalle = [];
          $vencimientoDetalle = [];
          $cantidadProducidaDetalle = [];
          $costoUnitarioDetalle = [];
          $costoProduccionDetalle = [];
          $costoEmbalajeDetalle = [];
          $costoProduccionConEmbalajeDetalle = [];

          foreach ($ordenesProduccionDetalle as $detalle) {
            $itemNo = null;
            $productos = ControladorProductos::ctrMostrarProductosPredeterminado("id", $detalle["id_producto"]);
            $unidad = ControladorUnidades::ctrMostrarunidades($itemNo, $detalle["id_unidad"]);

            $codigosDetalle[] = $detalle["codigo_lote"];
            $emisionDetalle[] = $detalle["fecha_produccion"];
            $vencimientoDetalle[] = $detalle["fecha_vencimiento"];
            $cantidadProducidaDetalle[] = $detalle["cantidad_producida"];
            $costoUnitarioDetalle[] = $detalle["costo_unitario"];
            $costoProduccionDetalle[] = $detalle["costo_produccion"];
            $costoEmbalajeDetalle[] = $detalle["costo_embalaje"];
            $costoProduccionConEmbalajeDetalle[] = $detalle["costo_produccion_con_embalaje"];

            foreach ($unidad as $cli) {
              if ($cli["id"] == $detalle["id_unidad"]) {
                $medidaDetalle[] = $cli["medida"];
                break;
              }
            }

            foreach ($productos as $pro) {
              if ($pro["id"] == $detalle["id_producto"]) {
                $codigoDetalle[] = $pro["codigo"];
                $nombreDetalle[] = $pro["descripcion"];
                break;
              }
            }
          }

          // Crear cadenas con los valores de cada detalle usando implode()
          $medidaDetalleStr = implode("<li>", $medidaDetalle);
          $nombreDetalleStr = implode("<li>", $nombreDetalle);
          $codigosDetalleStr = implode("<li>", $codigosDetalle);
          $emisionDetalleStr = implode("<li>", $emisionDetalle);
          $vencimientoDetalleStr = implode("<li>", $vencimientoDetalle);
          $cantidadProducidaDetalleStr = implode("<li>", $cantidadProducidaDetalle);
          $costoUnitarioDetalleStr = implode("<li>", $costoUnitarioDetalle);
          $costoProduccionDetalleStr = implode("<li>", $costoProduccionDetalle);
          $costoEmbalajeDetalleStr = implode("<li>", $costoEmbalajeDetalle);
          $costoProduccionConEmbalajeDetalleStr = implode("<li>", $costoProduccionConEmbalajeDetalle);

          // Mostrar los datos de la orden
          echo utf8_decode("<tr>
            <td style='border:1px solid #eee;'>" . $item["folio_orden_produccion"] . "</td>
            
            <td style='border:1px solid #eee;'>" . $item["tipo_orden"] . "</td>
            <td style='border:1px solid #eee;'>" . $item["nombre_orden"] . "</td>
            <td style='border:1px solid #eee;'>" . substr($item["fecha_emision"], 0, 10) . "</td>
            <td style='border:1px solid #eee;'>" . substr($item["fecha_vencimiento"], 0, 10) . "</td>
            <td style='border:1px solid #eee;'>" . $centroNombre . "</td>
            <td style='border:1px solid #eee;'>" . $bodegaNombre . "</td>
            <td style='border:1px solid #eee;'>" . $item["cantidad_producida_total"] . "</td>
            <td style='border:1px solid #eee;'>" . $item["costo_unitario_total"] . "</td>
            <td style='border:1px solid #eee;'>" . $item["costo_produccion_total"] . "</td>
            <td style='border:1px solid #eee;'>" . $item["costo_embalaje_total"] . "</td>
            <td style='border:1px solid #eee;'>" . $item["costo_total_con_embalaje"] . "</td>
            <td style='border:1px solid #eee;'>" . $nombreDetalleStr . "</td>
            <td style='border:1px solid #eee;'>" . $medidaDetalleStr . "</td>
            <td style='border:1px solid #eee;'>" . $codigosDetalleStr . "</td>
            <td style='border:1px solid #eee;'>" . $emisionDetalleStr . "</td>
            <td style='border:1px solid #eee;'>" . $vencimientoDetalleStr . "</td>
            <td style='border:1px solid #eee;'>" . $cantidadProducidaDetalleStr . "</td>
            <td style='border:1px solid #eee;'>" . $costoUnitarioDetalleStr . "</td>
            <td style='border:1px solid #eee;'>" . $costoProduccionDetalleStr . "</td>
            <td style='border:1px solid #eee;'>" . $costoEmbalajeDetalleStr . "</td>
            <td style='border:1px solid #eee;'>" . $costoProduccionConEmbalajeDetalleStr . "</td>
        </tr>");
        }
      }
      echo "</table>";

      echo utf8_decode("<table border='0'>
    <tr>
    <tr><td colspan='22' style='font-weight:bold; background-color:#f0f0f0;'>PACK (Total: $totalPack)</td></tr>
        <td style='font-weight:bold; border:1px solid #eee;'>FOLIO</td>
        
        <td style='font-weight:bold; border:1px solid #eee;'>TIPO DE ORDEN</td>
        <td style='font-weight:bold; border:1px solid #eee;'>NOMBRE DE ORDEN</td>
        <td style='font-weight:bold; border:1px solid #eee;'>FECHA EMISIÓN</td>
        <td style='font-weight:bold; border:1px solid #eee;'>FECHA VENCIMIENTO</td>
        <td style='font-weight:bold; border:1px solid #eee;'>CENTRO DE COSTO</td>
        <td style='font-weight:bold; border:1px solid #eee;'>BODEGA DE DESTINO</td>
        <td style='font-weight:bold; border:1px solid #eee;'>CANTIDAD PRODUCIDA TOTAL</td>
        <td style='font-weight:bold; border:1px solid #eee;'>COSTO UNITARIO TOTAL</td>
        <td style='font-weight:bold; border:1px solid #eee;'>COSTO PRODUCCIÓN TOTAL</td>
        <td style='font-weight:bold; border:1px solid #eee;'>COSTO DE EMBALAJE TOTAL</td>
        <td style='font-weight:bold; border:1px solid #eee;'>COSTO TOTAL CON EMBALAJE</td>
        <td style='font-weight:bold; border:1px solid #eee;'>PRODUCTO</td>
        <td style='font-weight:bold; border:1px solid #eee;'>UNIDAD</td>
        <td style='font-weight:bold; border:1px solid #eee;'>CÓDIGO DE LOTE</td>        
        <td style='font-weight:bold; border:1px solid #eee;'>FECHA DE EMISIÓN</td>
        <td style='font-weight:bold; border:1px solid #eee;'>FECHA DE VENCIMIENTO</td>
        <td style='font-weight:bold; border:1px solid #eee;'>CANTIDAD PRODUCIDA</td>
        <td style='font-weight:bold; border:1px solid #eee;'>COSTO UNITARIO</td>
        <td style='font-weight:bold; border:1px solid #eee;'>COSTO DE PRODUCCIÓN</td>
        <td style='font-weight:bold; border:1px solid #eee;'>COSTO DE EMBALAJE</td>
        <td style='font-weight:bold; border:1px solid #eee;'>COSTO DE PRODUCCIÓN DE EMBALAJE</td>
    </tr>

    ");

      foreach ($ordenes as $row => $item) {
        if ($item["tipo_orden"] === "PACK") {
          $ordenesProduccionDetalle = ControladorOrdenProduccion::ctrMostrarOrdenesProduccionDetalle("folio_orden_produccion", $item["folio_orden_produccion"]);

          $centro = ControladorCentros::ctrMostrarCentros("id", $item["centro_costo"]);
          $bodega = ControladorBodegas::ctrMostrarBodegas("id", $item["bodega_destino"]);


          $centroNombre = isset($centro["centro"]) ? $centro["centro"] : "No disponible";
          $bodegaNombre = isset($bodega["nombre"]) ? $bodega["nombre"] : "No disponible";

          // Crear una cadena con los códigos de los detalles
          $medidaDetalle = [];
          $nombreDetalle = [];
          $codigosDetalle = [];
          $emisionDetalle = [];
          $vencimientoDetalle = [];
          $cantidadProducidaDetalle = [];
          $costoUnitarioDetalle = [];
          $costoProduccionDetalle = [];
          $costoEmbalajeDetalle = [];
          $costoProduccionConEmbalajeDetalle = [];

          foreach ($ordenesProduccionDetalle as $detalle) {
            $itemNo = null;
            $productos = ControladorProductos::ctrMostrarProductosPredeterminado("id", $detalle["id_producto"]);
            $unidad = ControladorUnidades::ctrMostrarunidades($itemNo, $detalle["id_unidad"]);

            $codigosDetalle[] = $detalle["codigo_lote"];
            $emisionDetalle[] = $detalle["fecha_produccion"];
            $vencimientoDetalle[] = $detalle["fecha_vencimiento"];
            $cantidadProducidaDetalle[] = $detalle["cantidad_producida"];
            $costoUnitarioDetalle[] = $detalle["costo_unitario"];
            $costoProduccionDetalle[] = $detalle["costo_produccion"];
            $costoEmbalajeDetalle[] = $detalle["costo_embalaje"];
            $costoProduccionConEmbalajeDetalle[] = $detalle["costo_produccion_con_embalaje"];

            foreach ($unidad as $cli) {
              if ($cli["id"] == $detalle["id_unidad"]) {
                $medidaDetalle[] = $cli["medida"];
                break;
              }
            }

            foreach ($productos as $pro) {
              if ($pro["id"] == $detalle["id_producto"]) {
                $codigoDetalle[] = $pro["codigo"];
                $nombreDetalle[] = $pro["descripcion"];
                break;
              }
            }
          }

          // Crear cadenas con los valores de cada detalle usando implode()
          $medidaDetalleStr = implode("<li>", $medidaDetalle);
          $nombreDetalleStr = implode("<li>", $nombreDetalle);
          $codigosDetalleStr = implode("<li>", $codigosDetalle);
          $emisionDetalleStr = implode("<li>", $emisionDetalle);
          $vencimientoDetalleStr = implode("<li>", $vencimientoDetalle);
          $cantidadProducidaDetalleStr = implode("<li>", $cantidadProducidaDetalle);
          $costoUnitarioDetalleStr = implode("<li>", $costoUnitarioDetalle);
          $costoProduccionDetalleStr = implode("<li>", $costoProduccionDetalle);
          $costoEmbalajeDetalleStr = implode("<li>", $costoEmbalajeDetalle);
          $costoProduccionConEmbalajeDetalleStr = implode("<li>", $costoProduccionConEmbalajeDetalle);

          // Mostrar los datos de la orden
          echo utf8_decode("<tr>
            <td style='border:1px solid #eee;'>" . $item["folio_orden_produccion"] . "</td>
            
            <td style='border:1px solid #eee;'>" . $item["tipo_orden"] . "</td>
            <td style='border:1px solid #eee;'>" . $item["nombre_orden"] . "</td>
            <td style='border:1px solid #eee;'>" . substr($item["fecha_emision"], 0, 10) . "</td>
            <td style='border:1px solid #eee;'>" . substr($item["fecha_vencimiento"], 0, 10) . "</td>
            <td style='border:1px solid #eee;'>" . $centroNombre . "</td>
            <td style='border:1px solid #eee;'>" . $bodegaNombre . "</td>
            <td style='border:1px solid #eee;'>" . $item["cantidad_producida_total"] . "</td>
            <td style='border:1px solid #eee;'>" . $item["costo_unitario_total"] . "</td>
            <td style='border:1px solid #eee;'>" . $item["costo_produccion_total"] . "</td>
            <td style='border:1px solid #eee;'>" . $item["costo_embalaje_total"] . "</td>
            <td style='border:1px solid #eee;'>" . $item["costo_total_con_embalaje"] . "</td>
            <td style='border:1px solid #eee;'>" . $nombreDetalleStr . "</td>
            <td style='border:1px solid #eee;'>" . $medidaDetalleStr . "</td>
            <td style='border:1px solid #eee;'>" . $codigosDetalleStr . "</td>
            <td style='border:1px solid #eee;'>" . $emisionDetalleStr . "</td>
            <td style='border:1px solid #eee;'>" . $vencimientoDetalleStr . "</td>
            <td style='border:1px solid #eee;'>" . $cantidadProducidaDetalleStr . "</td>
            <td style='border:1px solid #eee;'>" . $costoUnitarioDetalleStr . "</td>
            <td style='border:1px solid #eee;'>" . $costoProduccionDetalleStr . "</td>
            <td style='border:1px solid #eee;'>" . $costoEmbalajeDetalleStr . "</td>
            <td style='border:1px solid #eee;'>" . $costoProduccionConEmbalajeDetalleStr . "</td>
        </tr>");
        }
      }
      echo "</table>";
    }
  }
}
