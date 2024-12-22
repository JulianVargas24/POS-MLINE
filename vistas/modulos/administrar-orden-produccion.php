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
  <title>Administrar Órdenes de Producción</title>
</head>

<body>
  <div class="content-wrapper">

    <section class="content-header">
      <h1>
        Administrar Órdenes de Producción
      </h1>

      <ol class="breadcrumb">
        <li><a href="inicio"><i class="fa fa-home"></i>Inicio</a></li>
        <li>Orden de trabajo</li>
        <li class="active">Administrar Ordenes de Producción</li>
      </ol>
    </section>

    <section class="content">

      <div class="box">

        <!-- Botón Crear Orden -->
        <div class="box-header with-border">
          <a href="crear-orden-produccion">
            <button class="btn btn-primary">
              <i class="fa fa-plus-circle fa-lg" style="margin-right: 5px;"></i>
              Crear orden de producción
            </button>
          </a>
        </div>

        <!-- Filtro de fechas y botón descargar -->
        <div class="box-header with-border">

          <!-- Botón para filtrar por rango de fechas -->
          <div class="input-group">
            <button type="button" class="btn btn-default" id="daterange-orden-produccion">
              <span>
                <i class="fa fa-calendar" style="margin-right: 5px;"></i>
                <?php
                if (isset($_GET["fechaInicial"])) {
                  echo $_GET["fechaInicial"] . " - " . $_GET["fechaFinal"];
                } else {
                  echo 'Rango de fecha';
                }
                ?>
              </span>
              <i class="fa fa-caret-down" style="margin-left: 2px"></i>
            </button>
          </div>

          <!-- Botón para descargar el reporte -->
          <div class="box-tools pull-right" style="margin-top:5px">
            <a href="vistas/modulos/descargar-reporte-orden-produccion.php?reporte=reporte&fechaInicial=<?php echo $_GET['fechaInicial']; ?>&fechaFinal=<?php echo $_GET['fechaFinal']; ?>">
              <button class="btn btn-success" disabled>
                <i class="fa fa-download fa-lg" style="margin-right: 5px;"></i>
                Reporte en Excel
              </button>
            </a>
          </div>
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
                <th>Estado</th>
                <th>Acciones</th>
              </tr>
            </thead>

            <!-- Cuerpo de la tabla -->
            <tbody>
              <?php
              $item = null;
              $valor = null;

              $ordenesProduccion = ControladorOrdenProduccion::ctrMostrarOrdenesProduccion($item, $valor);
              $ordenesMateriales = ControladorOrdenProduccion::ctrMostrarOrdenesProduccionMateriales($item, $valor);
              $centros = ControladorCentros::ctrMostrarCentros($item, $valor);
              $bodegas = ControladorBodegas::ctrMostrarBodegas($item, $valor);
              $clientes = ControladorClientes::ctrMostrarClientes($item, $valor);
              $negocios = ControladorNegocios::ctrMostrarNegocios($item, $valor);
              $regiones = ControladorRegiones::ctrMostrarRegiones($item, $valor);
              $comunas = ControladorRegiones::ctrMostrarComunas($item, $valor);



              // Iterar sobre las órdenes de producción
              foreach ($ordenesProduccion as $key => $orden) {
                $negocio = '';
                $centro = '';
                $bodega = '';
                $cliente = '';
                $clienteRut = '';
                $clienteEmail = '';
                $clienteTelefono = '';
                $clienteDireccion = '';
                $clientePais = '';
                $clienteRegion = '';
                $clienteComuna = '';

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

                // Buscar y asignar los datos del cliente
                foreach ($clientes as $cli) {
                  if ($cli["id"] == $orden["id_cliente"]) {
                    // Asignamos los datos del cliente
                    $cliente = $cli["nombre"];
                    $clienteRut = $cli["rut"];
                    $clienteEmail = $cli["email"];
                    $clienteTelefono = $cli["telefono"];
                    $clienteDireccion = $cli["direccion"];
                    $clientePais = $cli["pais"];

                    // Buscar la región del cliente
                    if (is_numeric($cli["region"])) {
                      // Si la región es un ID (numérico), buscamos el nombre
                      foreach ($regiones as $reg) {
                        if ($reg["id"] == $cli["region"]) {
                          $clienteRegion = $reg["nombre"];
                          break;
                        }
                      }
                    } else {
                      // Si la región es un nombre (cadena), simplemente asignamos el valor
                      $clienteRegion = $cli["region"];
                    }

                    // Buscar la comuna del cliente
                    if (is_numeric($cli["comuna"])) {
                      // Si la comuna es un ID (numérico), buscamos el nombre
                      foreach ($comunas as $com) {
                        if ($com["id"] == $cli["comuna"]) {
                          $clienteComuna = $com["nombre"];
                          break;
                        }
                      }
                    } else {
                      // Si la comuna es un nombre (cadena), simplemente asignamos el valor
                      $clienteComuna = $cli["comuna"];
                    }

                    break;
                  }
                }


                // Obtener los detalles de producción relacionados con la orden actual
                $ordenesProduccionDetalle = ControladorOrdenProduccion::ctrMostrarOrdenesProduccionMateriales("folio_orden_produccion", $orden["folio_orden_produccion"]);
                $item = null;
                $valor = null;
                $unidad = ControladorUnidades::ctrMostrarunidades($item, $valor);
                $productos = ControladorProductos::ctrMostrarProductosPredeterminado($item, $valor);

                // Inicializar arrays vacíos para cada campo
                $codigoDetalle = [];
                $nombreDetalle = [];
                $medidaDetalle = [];
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

                //mostrar en la tabla
                //$codigosDetalleStr = implode(", ", $codigosDetalle);
                $codigosDetalleStr = implode("<br>", $codigosDetalle);
                //$codigosDetalleStr = implode("<li>", $codigosDetalle);
                /**$codigosDetalleStr = '';
                foreach ($codigosDetalle as $codigo) {
                  $codigosDetalleStr .= "<div class='p-2 m-1' style='border: 1px solid #ddd; padding-left: 10px;  padding-right: 10px; background-image: url(icon.png); background-size: 16px 16px;'>$codigo</div>";
                }*/

                // Convertir los arrays a formato JSON
                $codigoDetalleJson = json_encode($codigoDetalle);
                $nombreDetalleJson = json_encode($nombreDetalle);
                //$dataNombreJson = json_encode($nombreDetalle, JSON_UNESCAPED_UNICODE);
                $medidaDetalleJson = json_encode($medidaDetalle);
                $codigoLoteDetalleJson = json_encode($codigosDetalle);
                $emisionDetalleJson = json_encode($emisionDetalle);
                $vencimientoDetalleJson = json_encode($vencimientoDetalle);
                $cantidadProducidaDetalleJson = json_encode($cantidadProducidaDetalle);
                $costoUnitarioDetalleJson = json_encode($costoUnitarioDetalle);
                $costoProduccionDetalleJson = json_encode($costoProduccionDetalle);
                $costoEmbalajeDetalleJson = json_encode($costoEmbalajeDetalle);
                $costoProduccionConEmbalajeDetalleJson = json_encode($costoProduccionConEmbalajeDetalle);

                // Sanitiza el JSON para asegurarte de que se pueda insertar correctamente en el atributo HTML
                $codigoDetalleJson = htmlspecialchars($codigoDetalleJson, ENT_QUOTES, 'UTF-8');
                $dataNombre = htmlspecialchars($nombreDetalleJson, ENT_QUOTES, 'UTF-8');
                //echo 'data-nombre=\'' . htmlspecialchars($dataNombreJson, ENT_QUOTES, 'UTF-8') . '\'';
                $medidaDetalleJson = htmlspecialchars($medidaDetalleJson, ENT_QUOTES, 'UTF-8');
                $codigoLoteDetalleJson = htmlspecialchars($codigoLoteDetalleJson, ENT_QUOTES, 'UTF-8');
                $emisionDetalleJson = htmlspecialchars($emisionDetalleJson, ENT_QUOTES, 'UTF-8');
                $vencimientoDetalleJson = htmlspecialchars($vencimientoDetalleJson, ENT_QUOTES, 'UTF-8');
                $cantidadProducidaDetalleJson = htmlspecialchars($cantidadProducidaDetalleJson, ENT_QUOTES, 'UTF-8');
                $costoUnitarioDetalleJson = htmlspecialchars($costoUnitarioDetalleJson, ENT_QUOTES, 'UTF-8');
                $costoProduccionDetalleJson = htmlspecialchars($costoProduccionDetalleJson, ENT_QUOTES, 'UTF-8');
                $costoEmbalajeDetalleJson = htmlspecialchars($costoEmbalajeDetalleJson, ENT_QUOTES, 'UTF-8');
                $costoProduccionConEmbalajeDetalleJson = htmlspecialchars($costoProduccionConEmbalajeDetalleJson, ENT_QUOTES, 'UTF-8');
                //var_dump($dataNombre);
                //echo 'data-nombre=\'' . $dataNombre . '\'';

                echo '<tr>
                    <td>' . $orden["folio_orden_produccion"] . '</td>
                    <td style="font-weight:bold;font-size:15px;color:black;">' . $orden["tipo_orden"] . '</td>
                    <td>' . $orden["nombre_orden"] . '</td>
                    <td>' . $cliente . '</td>
                    <td>' . $centro . '</td>
                    <td>' . $bodega . '</td>
                    <td>' . $orden["fecha_orden_emision"] . '</td>
                    <td>' . $orden["fecha_orden_vencimiento"] . '</td>
                    <td>' . $orden["cantidad_produccion"] . '</td>
                    <td>' . $orden["estado_orden"] . '</td>
                    

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
                    data-cliente_Pais="' . $clientePais . '"
                    data-cliente_Region="' . $clienteRegion . '"
                    data-cliente_Comuna="' . $clienteComuna . '"
                    data-orden="' . $orden["nombre_orden"] . '"
                    data-emision="' . $orden["fecha_orden_emision"] . '"
                    data-vencimiento="' . $orden["fecha_orden_vencimiento"] . '"
                    data-centro_costo="' . $centro . '" 
                    data-bodega_destino="' . $bodega . '" 
                    data-cantidad_producida_total="' . $orden["cantidad_producida_total"] . '" 
                    data-costo_unitario_total="' . $orden["costo_unitario_total"] . '" 
                    data-costo_produccion_total="' . $orden["costo_produccion_total"] . '" 
                    data-costo_embalaje_total="' . $orden["costo_embalaje_total"] . '" 
                    data-costo_total_con_embalaje="' . $orden["costo_produccion_total_con_embalaje"] . '"
                    data-nombre="' . $dataNombre . '"
                    data-codigo="' . $codigoDetalleJson . '"
                    data-medida="' . $medidaDetalleJson . '"
                    data-codigo_lote="' . $codigoLoteDetalleJson . '"
                    data-emision_detalle="' . $emisionDetalleJson . '"
                    data-vencimiento_detalle="' . $vencimientoDetalleJson . '"
                    data-cantidad_producida="' . $cantidadProducidaDetalleJson . '"
                    data-costo_unitario="' . $costoUnitarioDetalleJson . '"
                    data-costo_produccion="' . $costoProduccionDetalleJson . '"
                    data-costo_embalaje="' . $costoEmbalajeDetalleJson . '"
                    data-costo_produccion_con_embalaje="' . $costoProduccionConEmbalajeDetalleJson . '"
                    
                    
                    ><i class="fa fa-search"></i></button>
                    ';

                if ($_SESSION["perfil"] == "Administrador") {

                  $deshabilitarBoton = $orden["estado_orden"] === "Finalizada" ? 'disabled' : '';

                  echo ' 
                     <button class="btn btn-warning btnEditarOrdenProduccion" idOrdenProduccion="' . $orden["id"] . '"><i class="fa fa-pencil"></i></button>
                     <button class="btn btn-danger btnEliminarOrdenProduccion" idOrdenProduccion="' . $orden["folio_orden_produccion"] . '"><i class="fa fa-times"></i></button>
                     <button class="btn btn-success btnFinalizarOrdenProduccion" idOrdenProduccion="' . $orden["id"] . '" ' . $deshabilitarBoton . '><i class="fa fa-check"></i></button>';
                }
                echo '</div></td></tr>';
              }
              ?>
            </tbody>
          </table>

        </div>
    </section>
  </div>

</body>

</html>

<!-- Modal ver detalle de producto -->
<div class="modal fade" id="detalleModal" tabindex="-1" role="dialog" aria-labelledby="detalleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-info text-white text-center">
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title mb-0" id="detalleModalLabel" style="color: black; font-weight: bold"></h4>
      </div>
      <div class="modal-body">
        <!-- Información de la orden -->
        <div class="container-fluid">
          <h4 class="pb-2" style="font-weight: bold">Información General</h4>
          <div style="height: 3px; width: 100%;background-color: #007bff; margin-bottom: 15px;"></div>
          <div class="row">
            <div class="col-md-5">
              <p><strong>Folio:</strong> <span id="modalFolio"></span></p>
              <p><strong>Cliente:</strong> <span id="modalCliente"></span></p>
              <p><strong>RUT:</strong> <span id="modalClienteRut"></span></p>
              <p><strong>Teléfono:</strong> <span id="modalClienteTelefono"></span></p>
              <p><strong>Email:</strong> <span id="modalClienteEmail"></span></p>
              <p><strong>Dirección:</strong> <span id="modalClienteDireccion"></span></p>

            </div>
            <div class="col-md-5">
              <p><strong>Nombre de orden:</strong> <span id="modalOrden"></span></p>
              <p><strong>País:</strong> <span id="modalClientePais"></span></p>
              <p><strong>Región:</strong> <span id="modalClienteRegion"></span></p>
              <p><strong>Comuna:</strong> <span id="modalClienteComuna"></span></p>
              <p><strong>Centro de costo:</strong> <span id="modalCentroCosto"></span></p>
              <p><strong>Bodega de destino:</strong> <span id="modalBodegaDestino"></span></p>
            </div>
          </div>
        </div>

        <!-- Información de fechas -->
        <div class="container-fluid">
          <h4 class="pb-2" style="font-weight: bold">Fechas</h4>
          <div style="height: 3px; width: 100%; background-color: #28a745; margin-bottom: 15px;"></div>
          <div class="row">
            <div class="col-md-5">
              <p><strong>Fecha de emisión:</strong> <span id="modalEmision"></span></p>
            </div>
            <div class="col-md-5">
              <p><strong>Fecha de vencimiento:</strong> <span id="modalVencimiento"></span></p>
            </div>
          </div>
        </div>

        <!-- Costos y totales -->
        <div class="container-fluid">
          <h4 class="pb-2" style="font-weight: bold">Costos y Totales</h4>
          <div style="height: 3px; width: 100%; background-color: #ffc107; margin-bottom: 15px;"></div>
          <div class="row">
            <div class="col-md-5">
              <p><strong>Costo sin embalaje:</strong> <span id="modalCostoProduccionTotal"></span></p>
              <p><strong>Costo total del lote:</strong> <span id="modalCostoTotalConEmbalaje"></span></p>
            </div>
            <div class="col-md-5">
              <p><strong>Costo del embalaje:</strong> <span id="modalCostoEmbalajeTotal"></span></p>

            </div>
          </div>
        </div>

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
    $(document).on('click', 'button[data-toggle="modal"]', function() {
      // Obtener el valor del atributo data-titulo
      var titulo = $(this).data('titulo');
      var folio = $(this).data('folio');
      var cliente = $(this).data('cliente');
      var clienteRut = $(this).data('cliente_rut');
      var clienteTelefono = $(this).data('cliente_telefono');
      var clienteEmail = $(this).data('cliente_email');
      var clienteDireccion = $(this).data('cliente_direccion');
      var clientePais = $(this).data('cliente_pais');
      var clienteRegion = $(this).data('cliente_region');
      var clienteComuna = $(this).data('cliente_comuna');
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
      // Obtener el JSON del atributo 
      var nombresJson = $(this).data('nombre');
      var codigosJson = $(this).data('codigo');
      var medidasJson = $(this).data('medida');
      var codigosLoteJson = $(this).data('codigo_lote');
      var emisionDetalleJson = $(this).data('emision_detalle');
      var vencimientoDetalleJson = $(this).data('vencimiento_detalle');
      var cantidadProducidaJson = $(this).data('cantidad_producida');
      var costoUnitarioJson = $(this).data('costo_unitario');
      var costoProduccionJson = $(this).data('costo_produccion');
      var costoEmbalajeJson = $(this).data('costo_embalaje');

      // Limpiar el contenedor del modal antes de agregar los nuevos productos
      $('#productosContainer').empty();

      for (var i = 0; i < nombresJson.length; i++) {
        var productoHtml = `
        <div class="producto-detalle mb-3 p-2 border rounded" style="margin-bottom: 10px;">
        <div style="height: 3px; width: 840px; background-color: #dc3545; margin-bottom: 15px;"></div>
        <p><strong>Nombre del producto:</strong> ${nombresJson[i]}</p>
        <p><strong>Código del producto:</strong> ${codigosJson[i]}</p>
        <p><strong>Medida:</strong> ${medidasJson[i]}</p>
        <p><strong>Código de Lote:</strong> ${codigosLoteJson[i]}</p>
        <p><strong>Fecha de Emisión:</strong> ${emisionDetalleJson[i]}</p>
        <p><strong>Fecha de Vencimiento:</strong> ${vencimientoDetalleJson[i]}</p>
        <p><strong>Cantidad Producida:</strong> ${cantidadProducidaJson[i]}</p>
        <p><strong>Costo Unitario:</strong> ${costoUnitarioJson[i]}</p>
        <p><strong>Costo Producción:</strong> ${costoProduccionJson[i]}</p>
        <p><strong>Costo Embalaje:</strong> ${costoEmbalajeJson[i]}</p>
        <p><strong>Costo Producción con Embalaje:</strong> ${costoProduccionConEmbalajeJson[i]}</p>
        </div>
        `;
        $('#productosContainer').append(productoHtml);
      }

      // Establecer el nuevo título en el modal
      $('#detalleModalLabel').text('Detalles de ' + titulo);
      $('#modalFolio').text(folio);
      $('#modalCliente').text(cliente);
      $('#modalClienteRut').text(clienteRut);
      $('#modalClienteTelefono').text(clienteTelefono);
      $('#modalClienteEmail').text(clienteEmail);
      $('#modalClienteDireccion').text(clienteDireccion);
      $('#modalClientePais').text(clientePais);
      $('#modalClienteRegion').text(clienteRegion);
      $('#modalClienteComuna').text(clienteComuna);
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

      // Llamar a la función de verificación después de actualizar los datos
      verificarCliente();
    });

    function verificarCliente() {
      var cliente = $("#modalCliente").text().trim();

      if (cliente === "" || cliente === null) {
        $("#modalCliente, #modalClienteRut, #modalClienteTelefono, #modalClienteEmail, #modalClienteDireccion, #modalClientePais, #modalClienteRegion, #modalClienteComuna").closest('p').hide();
      } else {
        $("#modalCliente, #modalClienteRut, #modalClienteTelefono, #modalClienteEmail, #modalClienteDireccion, #modalClientePais, #modalClienteRegion, #modalClienteComuna").closest('p').show();
      }
    }

  });

  $(document).ready(function() {
    /**
     * funcion para eliminar
     */
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

  /*=============================================
EDITAR ORDEN DE VESTUARIO
=============================================*/

  $(".tablas").on("click", ".btnEditarOrdenProduccion", function() {
    console.log("F Orden Produccion")
    var idOrdenProduccion = $(this).attr("idOrdenProduccion");

    window.location = "index.php?ruta=editar-orden-produccion&idOrdenProduccion=" + idOrdenProduccion;


  })

  /*=============================================
  FINALIZAR ORDEN DE PRODUCCIÓN
  =============================================*/
  $(document).ready(function() {
    $(".tablas").on("click", ".btnFinalizarOrdenProduccion", function() {
      var idOrdenProduccion = $(this).attr("idOrdenProduccion");

      swal({
        title: "¿Está seguro de finalizar esta orden?",
        text: "¡Una vez finalizada ya no se podrá modificar!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sí, finalizar",
        cancelButtonText: "Cancelar",
      }).then(function(result) {

        if (result.value) { // Solo proceder si el usuario confirma
          $.ajax({
            url: "ajax/orden-produccion.ajax.php",
            method: "POST",
            data: {
              idOrdenProduccion: idOrdenProduccion,
              accion: "finalizarOrden"
            },
            success: function(respuesta) {
              if ($.trim(respuesta) === "ok") {
                swal({
                  title: "Finalizado",
                  text: "La orden ha sido finalizada exitosamente.",
                  type: "success",
                }).then(function() {
                  location.reload();
                });
              } else {
                swal(
                  "Error",
                  "Hubo un problema al finalizar la orden.",
                  "error"
                );
              }
            },
            error: function(xhr, status, error) {
              swal(
                "Error",
                "No se pudo procesar la solicitud.",
                "error"
              );
            }
          });
        }
      });
    });
  });
</script>

<?php
$eliminarOrden = new ControladorOrdenProduccion();
$eliminarOrden->ctrEliminarOrdenProduccion();
?>