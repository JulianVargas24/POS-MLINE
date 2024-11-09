<?php
if ($_SESSION["perfil"] == "Especial") {
  echo '<script>window.location = "inicio";</script>';
  return;
}

$xml = ControladorVentas::ctrDescargarXML();
if ($xml) {
  rename($_GET["xml"] . ".xml", "xml/" . $_GET["xml"] . ".xml");
  echo '<a class="btn btn-block btn-success abrirXML" archivo="xml/' . $_GET["xml"] . '.xml" href="ventas">Se ha creado correctamente el archivo XML <span class="fa fa-times pull-right"></span></a>';
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Administrar Ordenes de Producción</title>
</head>

<body>
  <div class="content-wrapper">

    <section class="content-header">
      <h1>
        Administrar Ordenes de Producción
      </h1>
      <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Administrar Ordenes de Producción</li>
      </ol>
    </section>

    <section class="content">

      <div class="box">

        <!-- Botón Crear Orden -->
        <div class="box-header with-border">
          <a href="orden-produccion">
            <button class="btn btn-primary">
              Crear Orden de Producción
            </button>
          </a>
        </div>

        <!-- Filtro de fechas y botón descargar -->
        <div class="box-header with-border">

          <!-- Botón para filtrar por rango de fechas -->
          <div class="input-group">
            <button type="button" class="btn btn-default" id="daterange-orden-produccion">
              <span>
                <i class="fa fa-calendar"></i>
                <?php
                if (isset($_GET["fechaInicial"])) {
                  echo $_GET["fechaInicial"] . " - " . $_GET["fechaFinal"];
                } else {
                  echo 'Rango de fecha';
                }
                ?>
              </span>
              <i class="fa fa-caret-down"></i>
            </button>
          </div>

          <!-- Botón para descargar el reporte -->
          <div class="box-tools pull-right" style="margin-bottom:5px">
            <a href="vistas/modulos/descargar-reporte-orden-produccion.php?reporte=reporte&fechaInicial=<?php echo $_GET['fechaInicial']; ?>&fechaFinal=<?php echo $_GET['fechaFinal']; ?>"
              <button class="btn btn-success" style="margin-top:5px">Descargar Orden de Producción</button>
            </a>
          </div>

          <!-- Tabla de Ordenes de Producción -->
          <div class="box-body">
            <table class="table table-bordered table-striped dt-responsive  tablas" width="100%">
              <thead>
                <tr>
                  <th>Folio</th>
                  <th>Tipo de orden</th>
                  <th>Nombre Orden</th>
                  <th>Cliente</th>
                  <th>Unidad de Negocio</th>
                  <th>Bodega</th>
                  <th>Emisión</th>
                  <th>Vencimiento</th>
                  <th>Cantidad Producida</th>
                  <th>Código de Lote</th>
                  <th>Acciones</th>
                </tr>
              </thead>

              <!-- Cuerpo de la tabla -->
              <tbody>
                <?php
                $item = null;
                $valor = null;

                $ordenesProduccion = ControladorOrdenProduccion::ctrMostrarOrdenesProduccion($item, $valor);
                $centros = ControladorCentros::ctrMostrarCentros($item, $valor);
                $bodegas = ControladorBodegas::ctrMostrarBodegas($item, $valor);
                $clientes = ControladorClientes::ctrMostrarClientes($item, $valor);
                $negocios = ControladorNegocios::ctrMostrarNegocios($item, $valor);

                // Iterar sobre las órdenes de producción
                foreach ($ordenesProduccion as $key => $orden) {
                  $negocio = '';
                  $centro = '';
                  $bodega = '';
                  $cliente = '';

                  // Buscar y asignar el nombre de la unidad de negocio
                  foreach ($negocios as $neg) {
                    if ($neg["id"] == $orden["id_unidad_negocio"]) {
                      $negocio = $neg["unidad_negocio"];
                      break;
                    }
                  }

                  // Buscar y asignar el nombre del centro de costo
                  foreach ($centros as $cen) {
                    if ($cen["id"] == $orden["centro_costo"]) {
                      $centro = $cen["centro"];
                      break;
                    }
                  }

                  // Buscar y asignar el nombre de la bodega
                  foreach ($bodegas as $bod) {
                    if ($bod["id"] == $orden["bodega_destino"]) {
                      $bodega = $bod["nombre"];
                      break;
                    }
                  }

                  // Buscar y asignar el nombre del cliente
                  foreach ($clientes as $cli) {
                    if ($cli["id"] == $orden["id_cliente"]) {
                      $cliente = $cli["nombre"];
                      break;
                    }
                  }

                  // Obtener los detalles de producción relacionados con la orden actual
                  $ordenesProduccionDetalle = ControladorOrdenProduccion::ctrMostrarOrdenesProduccionDetalle("folio_orden_produccion", $orden["folio_orden_produccion"]);

                  // Crear una cadena con los códigos de los detalles
                  $codigosDetalle = [];
                  foreach ($ordenesProduccionDetalle as $detalle) {
                    $codigosDetalle[] = $detalle["codigo_lote"];
                  }
                  $codigosDetalleStr = implode(", ", $codigosDetalle);

                  echo '<tr>
                    <td>' . $orden["folio_orden_produccion"] . '</td>
                    <td style="font-weight:bold;font-size:15px;color:black;">' . $orden["tipo_orden"] . '</td>
                    <td>' . $orden["nombre_orden"] . '</td>
                    <td>' . $cliente . '</td>
                    <td>' . $centro . '</td>
                    <td>' . $bodega . '</td>
                    <td>' . $orden["fecha_emision"] . '</td>
                    <td>' . $orden["fecha_vencimiento"] . '</td>
                    <td>' . $orden["cantidad_producida_total"] . '</td>
                    <td>' . $codigosDetalleStr . '</td>

                    <td>

                    <div class="btn-group">';

                  if ($_SESSION["perfil"] == "Administrador") {
                    echo ' 
                     <button class="btn btn-warning btnEditarOrdenProduccion" idOrdenProduccion="' . $orden["id"] . '"><i class="fa fa-pencil"></i></button>
                     <button class="btn btn-danger btnEliminarOrdenProduccion" idOrdenProduccion="' . $orden["id"] . '"><i class="fa fa-times"></i></button>';
                  }
                  echo '</div></td></tr>';
                }
                ?>
              </tbody>

              <script>
                $(".tablas").on("click", ".btnEliminarOrdenProduccion", function() {

                  var idOrdenProduccion = $(this).attr("idOrdenProduccion");

                  swal({
                    title: "¿Está seguro de borrar la Orden de Producción?",
                    text: "Si no lo está puede cancelar la acción",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    cancelButtonText: "Cancelar",
                    confirmButtonText: "Sí, borrar orden"
                  }).then(function(result) {
                    if (result.value) {
                      // Redirige al controlador de eliminación
                      window.location = "index.php?ruta=administrar-orden-produccion&idOrdenProduccion=" + idOrdenProduccion;
                    }
                  });
                });
              </script>

            </table>

            <?php
            $eliminarOrden = new ControladorOrdenProduccion();
            $eliminarOrden->ctrEliminarOrdenProduccion();
            ?>

          </div>
        </div>
    </section>
  </div>

</body>

</html>

<script>
  $(document).ready(function() {
    /**
     * Botón para filtrar por rango de fechas
     */
    if (window.location.href.includes("administrar-orden-produccion")) {
      // Configuración del Date Range Picker
      $("#daterange-orden-produccion").daterangepicker({
        locale: {
          format: 'YYYY-MM-DD',
          applyLabel: 'Aplicar',
          cancelLabel: 'Cancelar',
          customRangeLabel: 'Rango Personalizado',
          firstDay: 1,
          daysOfWeek: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
          monthNames: [
            'Enero', 'Febrero', 'Marzo', 'Abril',
            'Mayo', 'Junio', 'Julio', 'Agosto',
            'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
          ]
        },
        ranges: {
          'Hoy': [moment(), moment()],
          'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Últimos 7 días': [moment().subtract(6, 'days'), moment()],
          'Últimos 30 días': [moment().subtract(29, 'days'), moment()],
          'Este mes': [moment().startOf('month'), moment().endOf('month')],
          'Mes anterior': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment(),
        endDate: moment(),
        showCancelButton: true,
      });

      // Evento al seleccionar fechas
      $("#daterange-orden-produccion").on('apply.daterangepicker', function(ev, picker) {
        const fechaInicial = picker.startDate.format('YYYY-MM-DD');
        const fechaFinal = picker.endDate.format('YYYY-MM-DD');

        // Actualizar el texto del botón
        $(this).find('span').html(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));

        // Guardar en localStorage y redirigir
        localStorage.setItem('capturarRango', $(this).find('span').html());
        window.location.href = `index.php?ruta=administrar-orden-produccion&fechaInicial=${fechaInicial}&fechaFinal=${fechaFinal}`;
      });

      // Evento al cancelar
      $("#daterange-orden-produccion").on('cancel.daterangepicker', function() {
        localStorage.removeItem('capturarRango');
        window.location.href = 'administrar-orden-produccion';
      });
    }
  });
</script>