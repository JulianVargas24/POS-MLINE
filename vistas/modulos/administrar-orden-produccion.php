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
            <a href="vistas/modulos/descargar-reporte-orden-produccion.php?reporte=reporte&fechaInicial=<?php echo $_GET['fechaInicial']; ?>&fechaFinal=<?php echo $_GET['fechaFinal']; ?>">
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
                      $clienteRut = $cli["rut"];
                      $clienteEmail = $cli["email"];
                      $clienteTelefono = $cli["telefono"];
                      $clienteDireccion = $cli["direccion"];
                      $clienteEmail = $cli["email"];
                      break;
                    }
                  }

                  // Obtener los detalles de producción relacionados con la orden actual
                  $ordenesProduccionDetalle = ControladorOrdenProduccion::ctrMostrarOrdenesProduccionDetalle("folio_orden_produccion", $orden["folio_orden_produccion"]);
                  $item = null;
                  $valor = null;
                  $unidad = ControladorUnidades::ctrMostrarunidades($item, $valor);
                  $productos = ControladorProductos::ctrMostrarProductosPredeterminado($item, $valor);

                  // Array para almacenar 
                  $codigoDetalle = [];
                  $nombreDetalle = [];
                  $medidaDetalle = [];

                  // Iterar sobre los detalles de producción
                  foreach ($ordenesProduccionDetalle as $detalle) {
                    // Buscar la unidad de medida para cada detalle de producción
                    foreach ($unidad as $cli) {
                      if ($cli["id"] == $detalle["id_unidad"]) {
                        $medidaDetalle[] = $cli["medida"];
                        break; // Romper el bucle una vez que encuentres la unidad
                      }
                    }
                    // Buscar el producto para cada detalle de producción
                    foreach ($productos as $pro) {
                      if ($pro["id"] == $detalle["id_producto"]) {
                        $codigoDetalle[] = $pro["codigo"];
                        $nombreDetalle[] = $pro["descripcion"];
                        break; // Romper el bucle una vez que encuentres la unidad
                      }
                    }
                  }

                  $codigoDetalleStr = implode(", ", $codigoDetalle);
                  $nombreDetalleStr = implode(", ", $nombreDetalle);
                  $medidaDetalleStr = implode(", ", $medidaDetalle);

                  // Inicializar arrays vacíos para cada campo
                  $codigosDetalle = [];
                  $emisionDetalle = [];
                  $vencimientoDetalle = [];
                  $cantidadProducidaDetalle = [];
                  $costoUnitarioDetalle = [];
                  $costoProduccionDetalle = [];
                  $costoEmbalajeDetalle = [];
                  $costoProduccionConEmbalajeDetalle = [];

                  // Recorrer los detalles de las órdenes de producción una sola vez
                  foreach ($ordenesProduccionDetalle as $detalle) {
                    // Añadir los valores correspondientes a cada array
                    $codigosDetalle[] = $detalle["codigo_lote"];
                    $emisionDetalle[] = $detalle["fecha_produccion"];
                    $vencimientoDetalle[] = $detalle["fecha_vencimiento"];
                    $cantidadProducidaDetalle[] = $detalle["cantidad_producida"];
                    $costoUnitarioDetalle[] = $detalle["costo_unitario"];
                    $costoProduccionDetalle[] = $detalle["costo_produccion"];
                    $costoEmbalajeDetalle[] = $detalle["costo_embalaje"];
                    $costoProduccionConEmbalajeDetalle[] = $detalle["costo_produccion_con_embalaje"];
                  }

                  // Convertir los arrays en cadenas separadas por comas
                  $codigosDetalleStr = implode(", ", $codigosDetalle);
                  $emisionDetalleStr = implode(", ", $emisionDetalle);
                  $vencimientoDetalleStr = implode(", ", $vencimientoDetalle);
                  $cantidadProducidaDetalleStr = implode(", ", $cantidadProducidaDetalle);
                  $costoUnitarioDetalleStr = implode(", ", $costoUnitarioDetalle);
                  $costoProduccionDetalleStr = implode(", ", $costoProduccionDetalle);
                  $costoEmbalajeDetalleStr = implode(", ", $costoEmbalajeDetalle);
                  $costoProduccionConEmbalajeDetalleStr = implode(", ", $costoProduccionConEmbalajeDetalle);

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

                    <div class="btn-group">
                    <button class="btn btn-info" data-toggle="modal" data-target="#detalleModal" 
                    data-titulo="' . $orden["tipo_orden"] . '"
                    data-folio="' . $orden["folio_orden_produccion"] . '"
                    data-cliente="' . $cliente . '"
                    data-cliente_rut="' . $clienteRut . '"
                    data-cliente_email="' . $clienteEmail . '"
                    data-cliente_telefono="' . $clienteTelefono . '"
                    data-cliente_direccion="' . $clienteDireccion . '"
                    data-orden="' . $orden["nombre_orden"] . '"
                    data-emision="' . $orden["fecha_emision"] . '"
                    data-vencimiento="' . $orden["fecha_vencimiento"] . '"
                    data-centro_costo="' . $centro . '" 
                    data-bodega_destino="' . $bodega . '" 
                    data-cantidad_producida_total="' . $orden["cantidad_producida_total"] . '" 
                    data-costo_unitario_total="' . $orden["costo_unitario_total"] . '" 
                    data-costo_produccion_total="' . $orden["costo_produccion_total"] . '" 
                    data-costo_embalaje_total="' . $orden["costo_embalaje_total"] . '" 
                    data-costo_total_con_embalaje="' . $orden["costo_total_con_embalaje"] . '"
                    data-nombre="' . $nombreDetalleStr . '"
                    data-codigo="' . $codigoDetalleStr . '"
                    data-medida="' . $medidaDetalleStr . '"
                    data-codigo_lote="' . $codigosDetalleStr . '"
                    data-emision_detalle="' . $emisionDetalleStr . '"
                    data-vencimiento_detalle="' . $vencimientoDetalleStr . '"
                    data-cantidad-producida="' . $cantidadProducidaDetalleStr . '"
                    data-costo-unitario="' . $costoUnitarioDetalleStr . '"
                    data-costo-produccion="' . $costoProduccionDetalleStr . '"
                    data-costo-embalaje="' . $costoEmbalajeDetalleStr . '"
                    data-costo-produccion-con-embalaje="' . $costoProduccionConEmbalajeDetalleStr . '"
                    
                    
                    ><i class="fa fa-search"></i></button>
                    ';

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

<!-- Modal ver detalle de producto -->
<div class="modal fade" id="detalleModal" tabindex="-1" role="dialog" aria-labelledby="detalleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #17a2b8; color: white;">
        <h5 class="modal-title" id="detalleModalLabel"> </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p><strong>Folio:</strong> <span id="modalFolio"></span></p>
        <p><strong>Cliente:</strong> <span id="modalCliente"></span></p>
        <p><strong>RUT:</strong> <span id="modalClienteRut"></span></p>
        <p><strong>Teléfono:</strong> <span id="modalClienteTelefono"></span></p>
        <p><strong>Email:</strong> <span id="modalClienteEmail"></span></p>
        <p><strong>Dirección:</strong> <span id="modalClienteDireccion"></span></p>
        <p><strong>Nombre de Orden:</strong> <span id="modalOrden"></span></p>
        <p><strong>Fecha de emisión:</strong> <span id="modalEmision"></span></p>
        <p><strong>Fecha de vencimiento:</strong> <span id="modalVencimiento"></span></p>
        <p><strong>Centro de Costo:</strong> <span id="modalCentroCosto"></span></p>
        <p><strong>Bodega Destino:</strong> <span id="modalBodegaDestino"></span></p>
        <p><strong>Cantidad Producida Total:</strong> <span id="modalCantidadProducidaTotal"></span></p>
        <p><strong>Costo Unitario Total:</strong> <span id="modalCostoUnitarioTotal"></span></p>
        <p><strong>Costo Producción Total:</strong> <span id="modalCostoProduccionTotal"></span></p>
        <p><strong>Costo Embalaje Total:</strong> <span id="modalCostoEmbalajeTotal"></span></p>
        <p><strong>Costo Total con Embalaje:</strong> <span id="modalCostoTotalConEmbalaje"></span></p>
        <p><strong>PRODUCTO</strong></p>
        <p><strong>Nombre del producto:</strong> <span id="modalNombre"></span></p>
        <p><strong>Código del producto:</strong> <span id="modalCodigo"></span></p>
        <p><strong>Medida:</strong> <span id="modalMedida"></span></p>
        <p><strong>Código del lote:</strong> <span id="modalCodigoLote"></span></p>
        <p><strong>Fecha de emisión:</strong> <span id="modalEmisionDetalle"></span></p>
        <p><strong>Fecha de vencimiento:</strong> <span id="modalVencimientoDetalle"></span></p>
        <p><strong>Cantidad Producida:</strong> <span id="modalCantidadProducida"></span></p>
        <p><strong>Costo Unitario:</strong> <span id="modalCostoUnitario"></span></p>
        <p><strong>Costo Producción:</strong> <span id="modalCostoProduccion"></span></p>
        <p><strong>Costo Embalaje:</strong> <span id="modalCostoEmbalaje"></span></p>
        <p><strong>Costo Producción con Embalaje:</strong> <span id="modalCostoProduccionConEmbalaje"></span></p>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    // Cuando se haga clic en el botón
    $('button[data-toggle="modal"]').on('click', function() {
      // Obtener el valor del atributo data-titulo
      var titulo = $(this).data('titulo');
      var folio = $(this).data('folio');
      var cliente = $(this).data('cliente');
      var clienteRut = $(this).data('cliente_rut');
      var clienteTelefono = $(this).data('cliente_telefono');
      var clienteEmail = $(this).data('cliente_email');
      var clienteDireccion = $(this).data('cliente_direccion');
      var orden = $(this).data('orden');
      var emision = $(this).data('emision');
      var vencimiento = $(this).data('vencimiento');
      var centroCosto = $(this).data('centro_costo');
      var bodegaDestino = $(this).data('bodega_destino');
      var cantidadProducidaTotal = $(this).data('cantidad_producida_total');
      var costoUnitarioTotal = $(this).data('costo_unitario_total');
      var costoProduccionTotal = $(this).data('costo_produccion_total');
      var costoEmbalajeTotal = $(this).data('costo_embalaje_total');
      var costoTotalConEmbalaje = $(this).data('costo_total_con_embalaje');
      var nombre = $(this).data('nombre');
      var codigo = $(this).data('codigo');
      var medida = $(this).data('medida');
      var codigoLote = $(this).data('codigo_lote');
      var emisionDetalle = $(this).data('emision_detalle');
      var VencimientoDetalle = $(this).data('vencimiento_detalle');
      var cantidadProducida = $(this).data('cantidad-producida');
      var costoUnitario = $(this).data('costo-unitario');
      var costoProduccion = $(this).data('costo-produccion');
      var costoEmbalaje = $(this).data('costo-embalaje');
      var costoProduccionConEmbalaje = $(this).data('costo-produccion-con-embalaje');


      // Establecer el nuevo título en el modal
      $('#detalleModalLabel').text('Detalles de ' + titulo);
      $('#modalFolio').text(folio);
      $('#modalCliente').text(cliente);
      $('#modalClienteRut').text(clienteRut);
      $('#modalClienteTelefono').text(clienteTelefono);
      $('#modalClienteEmail').text(clienteEmail);
      $('#modalClienteDireccion').text(clienteDireccion);
      $('#modalOrden').text(orden);
      $('#modalEmision').text(emision);
      $('#modalVencimiento').text(vencimiento);
      $('#modalCentroCosto').text(centroCosto);
      $('#modalBodegaDestino').text(bodegaDestino);
      $('#modalCantidadProducidaTotal').text(cantidadProducidaTotal);
      $('#modalCostoUnitarioTotal').text(costoUnitarioTotal);
      $('#modalCostoProduccionTotal').text(costoProduccionTotal);
      $('#modalCostoEmbalajeTotal').text(costoEmbalajeTotal);
      $('#modalCostoTotalConEmbalaje').text(costoTotalConEmbalaje);
      $('#modalNombre').text(nombre);
      $('#modalCodigo').text(codigo);
      $('#modalMedida').text(medida);
      $('#modalCodigoLote').text(codigoLote);
      $('#modalEmisionDetalle').text(emisionDetalle);
      $('#modalVencimientoDetalle').text(VencimientoDetalle);
      $('#modalCantidadProducida').text(cantidadProducida);
      $('#modalCostoUnitario').text(costoUnitario);
      $('#modalCostoProduccion').text(costoProduccion);
      $('#modalCostoEmbalaje').text(costoEmbalaje);
      $('#modalCostoProduccionConEmbalaje').text(costoProduccionConEmbalaje);

    });
  });

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