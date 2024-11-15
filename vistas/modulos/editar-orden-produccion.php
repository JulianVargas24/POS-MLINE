<?php
if ($_SESSION["perfil"] == "Especial") {
  echo '<script>window.location = "inicio";</script>';
  return;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Orden de Producción</title>
</head>

<body>
  <div class="content-wrapper">

    <section class="content-header">
      <h1 style="color:green;font-weight:bold">
        EDITAR ORDEN DE PRODUCCIÓN
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Inicio</a></li>
        <li class="active">Crear Orden de Producción</li>
      </ol>
    </section>

    <section class="content">
      <div class="box">
        <div class="box-body">
          <form role="form" method="post" class="formularioOrdenProduccion">
            <?php

            $ordenProduccion = ControladorOrdenProduccion::ctrMostrarOrdenesProduccion($item, $valor);

            ?>

            <!-- Tipo de Orden, Cliente Asociado, Datos de Orden y Orden de Producción -->
            <div class="row">

              <!-- Tipo de Orden -->
              <div class="col-xs-12" style="margin-bottom: 20px;">
                <div class="box box-info">
                  <div class="box-body">
                    <h2 class="box-title" style="font-weight:bold; font-size:20px; margin-bottom: 20px; margin-top: 0;">Tipo de Orden</h2>
                    <div class="radio-options">
                      <label class="btn-orden">
                        <input type="radio" name="tipoOrden" value="Cliente con Cotización">
                        <span><i class="fa fa-file-text"></i> Cliente con Cotización</span>
                      </label>
                      <label class="btn-orden">
                        <input type="radio" name="tipoOrden" value="Cliente sin Cotización">
                        <span><i class="fa fa-user"></i> Cliente sin Cotización</span>
                      </label>
                      <label class="btn-orden">
                        <input type="radio" name="tipoOrden" value="Producción Stock">
                        <span><i class="fa fa-cubes"></i> Producción Stock</span>
                      </label>
                      <label class="btn-orden">
                        <input type="radio" name="tipoOrden" value="PACK">
                        <span><i class="fa fa-archive"></i> PACK</span>
                      </label>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Cliente Asociado -->
              <div class="col-xs-5" id="clienteAsociado" style="display: none;">
                <div class="box box-info">
                  <div class="box-header with-border">
                    <button type="button" class="close cerrar-cliente" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    <h2 class="box-title" style="font-weight:bold; font-size:20px;">Cliente Asociado</h2>
                  </div>

                  <div class="box-body">
                    <!-- Seleccionar Cliente -->
                    <div class="row" style="margin-bottom:5px;">
                      <div class="col-xs-12">
                        <div class="form-group">
                          <div class="input-group" style="display:block;">
                            <select class="form-control" id="editarCliente"
                              name="editarCliente">

                              <option value="">Seleccionar cliente</option>

                              <?php
                              $item = null;
                              $valor = null;

                              $clientes = ControladorClientes::ctrMostrarClientes($item, $valor);

                              foreach ($clientes as $key => $value) {

                                echo '<option class="seleccionarCliente" value="' . $value["id"] . '">' . $value["nombre"] . ' </option>';
                              }
                              ?>

                            </select>
                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- Datos del cliente -->
                    <div class="row">
                      <div class="col-xs-6">
                        <div class="form-group">
                          <div class="input-group">
                            <input type="hidden" id="traerId">
                            <span class="input-group-addon"> <i class="fa fa-address-card"></i> RUT</span>
                            <input type="text" class="form-control" id="traerRut"
                              value="" readonly>
                          </div>
                        </div>
                      </div>
                      <div class="col-xs-6">
                        <div class="form-group">
                          <div class="input-group">
                            <span class="input-group-addon">Dirección</span>
                            <input type="text" class="form-control" id="traerDireccion"
                              value="" readonly>
                          </div>
                        </div>
                      </div>
                      <div class="col-xs-6">
                        <div class="form-group">
                          <div class="input-group">
                            <span class="input-group-addon">Actividad</span>
                            <input type="text" class="form-control" id="traerActividad"
                              value="" readonly>
                          </div>
                        </div>
                      </div>
                      <div class="col-xs-6">
                        <div class="form-group">
                          <div class="input-group">
                            <span class="input-group-addon">Ejecutivo</span>
                            <input type="text" class="form-control" id="traerEjecutivo"
                              value="" readonly>
                          </div>
                        </div>
                      </div>
                      <div class="col-xs-6">
                        <div class="form-group">
                          <div class="input-group">
                            <span class="input-group-addon">Teléfono</span>
                            <input type="text" class="form-control" id="traerTelefono"
                              value="" readonly>
                          </div>
                        </div>
                      </div>
                      <div class="col-xs-6">
                        <div class="form-group">
                          <div class="input-group">
                            <span class="input-group-addon"> <i
                                class="fa fa-at"></i> Correo</span>
                            <input type="text" class="form-control" id="traerEmail"
                              value="" readonly>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>
              </div>

              <!-- Datos de Orden -->
              <div class="col-xs-4">
                <div class="box box-info">
                  <div class="box-body">
                    <h2 class="box-title" style="font-weight:bold; font-size:20px; margin-bottom: 20px; margin-top: 0;">
                      Datos de Orden
                    </h2>
                    <div class="row" style="margin-bottom:5px;">

                      <!-- Fecha de emisión -->
                      <div class="col-xs-6">
                        <div class="d-block" style="font-size:14px;">Fecha de emisión</div>
                        <div class="form-group">
                          <div class="input-group">
                          <input type="date" class="form-control input-sm"
                                                        name="editarFechaEmision" id="editarFechaEmision" readonly
                                                        value="<?php echo $ordenProduccion["fecha_emision"]; ?>"
                                                        onchange="validarFechas(this.id, 'editarFechaVencimiento')">
                          </div>
                        </div>
                      </div>

                      <!-- Fecha de vencimiento -->
                      <div class="col-xs-6">
                        <div class="d-block" style="font-size:14px;">Fecha de vencimiento</div>
                        <div class="form-group">
                          <div class="input-group">
                          <input type="date" class="form-control input-sm"
                                                        name="editarFechaVencimiento" id="editarFechaVencimiento"
                                                        value="<?php echo $ordenProduccion["fecha_vencimiento"]; ?>"
                                                        onchange="validarFechas('editarFechaEmision', this.id)">
                          </div>
                        </div>
                      </div>

                      <!-- Centro de costo -->
                      <div class="col-xs-6">
                        <div class="d-block" style="font-size:14px;">Centro de costo</div>
                        <div class="form-group">
                          <div class="input-group">
                            <select class="form-control input" id="editarCentro"
                              name="editarCentro" required>
                              <option value="">Seleccionar centro</option>

                              <?php
                              $item = null;
                              $valor = null;

                              $centros = ControladorCentros::ctrMostrarCentros($item, $valor);

                              foreach ($centros as $key => $value) {
                                echo '<option value="' . $value["id"] . '">' . $value["centro"] . '</option>';
                              }
                              ?>

                            </select>
                          </div>
                        </div>
                      </div>

                      <!-- Bodega de destino -->
                      <div class="col-xs-6">
                        <div class="d-block" style="font-size:14px;">Bodega de destino</div>
                        <div class="form-group">
                          <div class="input-group">
                            <select class="form-control input" id="editarBodega"
                              name="editarBodega" required>

                              <option value="">Seleccionar bodega</option>

                              <?php
                              $item = null;
                              $valor = null;

                              $bodegas = ControladorBodegas::ctrMostrarBodegas($item, $valor);

                              foreach ($bodegas as $key => $value) {
                                echo '<option  value="' . $value["id"] . '">' . $value["nombre"] . ' </option>';
                              }
                              ?>

                            </select>
                          </div>
                        </div>
                      </div>

                    </div>
                  </div>
                </div>
              </div>

              <!-- Orden de Producción -->
              <div class="col-xs-3">

                <div class="box box-info">
                  <div class="box-body">
                    <h2 class="box-title"
                      style="color:#39b616;font-weight:bold; font-size:21px; color:red; margin-bottom: 20px; margin-top: 0;">
                      ORDEN DE PRODUCCIÓN
                    </h2>

                    <!-- Folio -->
                    <div class="row" style="margin-top:5px;">
                      <div class="col-xs-7">
                        <div class="form-group">
                          <div class="input-group">
                            <span class="input-group-addon" style="background-color:red; color:white; font-weight:bold">FOLIO</span>
                            <input type="text" style="font-weight:bold; font-size:16px;"
                                                        class="form-control" name="editarCodigo" id="editarCodigo"
                                                        value="<?php echo $ordenProduccion["folio_orden_produccion"]; ?>" readonly
                                                        required>
                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- Nombre de la orden -->
                    <h2 class="box-title" style="color:#39b616;font-weight:bold; font-size:21px; margin-bottom: 20px; margin-top: 0;">
                      NOMBRE DE ORDEN
                    </h2>
                    <div class="row" style="margin-top:5px;">
                      <div class="col-xs-10">
                        <div class="form-group">
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-file"></i></span>
                            <input type="text" style="font-weight:bold; font-size:16px;" class="form-control"
                              name="editarNombreOrden" id="editarNombreOrden" required>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            </div>

            <!-- Detalle de Producción y Resumen de Producción -->
            <div class="row">

              <!-- Detalle de Producción -->
              <div class="col-xs-4 col-xs-12">
                <div class="box box-info">
                  <div class="box-body">
                    <h2 class="box-title" style="font-weight:bold; font-size:20px; margin-bottom: 20px; margin-top: 0;">
                      Detalle de Producción
                    </h2>
                    <div class="row">

                      <!-- Producto Terminado -->
                      <div class="col-xs-12">
                        <div class="form-group">
                          <label>Producto Terminado</label>
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-cube"></i></span>
                            <input type="text" class="form-control"
                              id="detalleProductoTerminado"
                              name="detalleProductoTerminado"
                              placeholder="Seleccione un producto"
                              readonly
                              style="cursor: pointer;"
                              onclick="$('#modalSeleccionarProducto').modal('show');">
                            <span class="input-group-addon" style="padding: 0">
                              <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modalSeleccionarProducto">
                                <i class="fa fa-search"></i>
                              </button>
                            </span>
                          </div>
                        </div>
                      </div>

                      <!-- Precio de compra -->
                      <div class="col-xs-4">
                        <div class="form-group">
                          <label>Precio de compra</label>
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                            <input type="text" class="form-control"
                              id="detallePrecioCompra"
                              name="detallePrecioCompra"
                              value=""
                              readonly>
                          </div>
                        </div>
                      </div>

                      <!-- Costo unitario -->
                      <div class="col-xs-4">
                        <div class="form-group">
                          <label>Costo Unitario</label>
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                            <input type="text" class="form-control"
                              id="detalleCostoUnitario"
                              name="detalleCostoUnitario"
                              value="4004"
                              readonly>
                          </div>
                        </div>
                      </div>

                      <!-- Costo de embalaje -->
                      <div class="col-xs-4">
                        <div class="form-group">
                          <label>Costo de Embalaje</label>
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                            <input type="text" class="form-control"
                              id="detalleCostoEmbalaje"
                              name="detalleCostoEmbalaje"
                              value="1000"
                              readonly>
                          </div>
                        </div>
                      </div>

                      <!-- Unidad de producción -->
                      <div class="col-xs-12">
                        <div class="form-group">
                          <label>Unidad de Producción</label>
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-balance-scale"></i></span>
                            <select class="form-control" id="detalleUnidad" name="detalleUnidad">
                              <option value="">Seleccione un tipo de unidad</option>
                              <?php
                              $unidades = ControladorUnidades::ctrMostrarUnidades($item, $valor);
                              foreach ($unidades as $unidad) {
                                echo '<option value="' . $unidad["id"] . '">' . $unidad["medida"] . '</option>';
                              }
                              ?>
                            </select>
                          </div>
                        </div>
                      </div>

                      <!-- Cantidad a producir -->
                      <div class="col-xs-12">
                        <div class="form-group">
                          <label>Cantidad a Producir</label>
                          <div class="input-group">
                            <span class="input-group-addon""><i class=" fa fa-cubes"></i></span>
                            <input type="number" class="form-control"
                              id="detalleCantidadProducir"
                              name="detalleCantidadProducir"
                              min="1"
                              placeholder="Ingrese la cantidad a producir">
                          </div>
                        </div>
                      </div>

                      <!-- Código de lote -->
                      <div class="col-xs-12">
                        <div class="form-group">
                          <label>Código de Lote</label>
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                            <input type="text" class="form-control"
                              id="detalleCodigoLote"
                              name="detalleCodigoLote"
                              placeholder="Ingrese el código de lote">
                          </div>
                        </div>
                      </div>

                      <!-- Fecha de producción -->
                      <div class="col-xs-6">
                        <div class="form-group">
                          <label>Fecha de Producción</label>
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <input type="date" class="form-control"
                              id="detalleFechaProduccion"
                              name="detalleFechaProduccion"
                              onchange="validarFechas(this.id, 'detalleFechaVencimientoProducto')">
                          </div>
                        </div>
                      </div>

                      <!-- Fecha de vencimiento -->
                      <div class="col-xs-6">
                        <div class="form-group">
                          <label>Fecha de Vencimiento</label>
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar-times-o"></i></span>
                            <input type="date" class="form-control"
                              id="detalleFechaVencimientoProducto"
                              name="detalleFechaVencimientoProducto"
                              onchange="validarFechas('detalleFechaProduccion', this.id)">
                          </div>
                        </div>
                      </div>

                      <!-- Botón para Añadir Producto -->
                      <div class="col-xs-12">
                        <div class="form-group">
                          <button type="button" class="btn btn-success btn-lg btn-block" id="btnAnadirProducto">
                            <i class="fa fa-plus-circle" style="margin-right: 10px;"></i> Añadir Producto
                          </button>
                        </div>
                      </div>

                    </div>
                  </div>
                </div>
              </div>

              <!-- Resumen de Producción -->
              <div class="col-lg-3 col-xs-12">
                <div class="box box-info">
                  <div class="box-body">
                    <h2 class="box-title" style="font-weight:bold; font-size:20px; margin-bottom: 20px; margin-top: 0;">
                      Resumen de Producción
                    </h2>
                    <div class="row">

                      <!-- Cantidad Total Producida -->
                      <div class="col-xs-12">
                        <div class="form-group">
                          <label>Cantidad Total Producida</label>
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-cubes"></i></span>
                            <input type="text" class="form-control"
                              id="resumenCantidadTotalProducida"
                              name="resumenCantidadTotalProducida"
                              value=""
                              placeholder="0"
                              readonly>
                          </div>
                        </div>
                      </div>

                      <!-- Costo Unitario Total -->
                      <div class="col-xs-12">
                        <div class="form-group">
                          <label>Costo Unitario Total</label>
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                            <input type="text" class="form-control"
                              id="resumenCostoUnitarioTotal"
                              name="resumenCostoUnitarioTotal"
                              value=""
                              placeholder="$0"
                              readonly>
                          </div>
                        </div>
                      </div>

                      <!-- Costo Total del Lote -->
                      <div class="col-xs-12">
                        <div class="form-group">
                          <label>Costo Total del Lote</label>
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                            <input type="text" class="form-control"
                              id="resumenCostoTotalLote"
                              name="resumenCostoTotalLote"
                              value=""
                              placeholder="$0"
                              readonly>
                          </div>
                        </div>
                      </div>

                      <!-- Costo Total del Embalaje -->
                      <div class="col-xs-12">
                        <div class="form-group">
                          <label>Costo Total del Embalaje</label>
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                            <input type="text" class="form-control"
                              id="resumenEmbalajeTotal"
                              name="resumenEmbalajeTotal"
                              value=""
                              placeholder="$0"
                              readonly>
                          </div>
                        </div>
                      </div>

                      <!-- Costo Total del Lote con Embalaje -->
                      <div class="col-xs-12">
                        <div class="form-group">
                          <label style="font-weight:bold">Costo Total del Lote con Embalaje</label>
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                            <input type="text" class="form-control"
                              id="resumenCostoTotalConEmbalaje"
                              name="resumenCostoTotalConEmbalaje"
                              value=""
                              placeholder="$0"
                              readonly>
                          </div>
                        </div>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Tabla de productos seleccionados -->
            <div class="row">
              <div class="col-xs-12">
                <div class="box box-success">
                  <div class="box-body">
                    <div class="row productosSeleccionados">
                      <div class="table-responsive" style="padding: 10px;">
                        <h2 class="box-title" style="font-weight:bold; font-size:20px; margin-bottom: 20px; margin-top: 0;">
                          Productos Seleccionados
                        </h2>
                        <table class="table table-bordered table-striped">
                          <thead>
                            <tr>
                              <th style="width:15%">Nombre</th>
                              <th style="width:8%">Unidad</th>
                              <th style="width:12%">Precio de compra</th>
                              <th style="width:8%">Cantidad</th>
                              <th style="width:12%">Costo unitario</th>
                              <th style="width:12%">Costo Total</th>
                              <th style="width:12%">Costo de Embalaje</th>
                              <th style="width:16%">Total con Embalaje</th>
                              <th style="width:5%">Acciones</th>
                            </tr>
                          </thead>
                          <tbody>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="box-footer">
              <a href="administrar-orden-produccion" class="btn btn-default">Salir</a>
              <button type="submit" class="btn btn-primary">Crear Orden</button>
            </div>

          </form>

          <?php
          $editarOrdenProduccion = new ControladorOrdenProduccion();
          $editarOrdenProduccion->ctrEditarOrdenProduccion();
          ?>

        </div>
      </div>
    </section>

    <!-- Modal para seleccionar producto -->
    <div id="modalSeleccionarProducto" class="modal fade" role="dialog">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header" style="background:#3c8dbc; color:white">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h3 class="modal-title">Seleccionar Producto</h3>
          </div>
          <div class="modal-body">
            <div class="box-body">
              <table class="table table-bordered table-striped dt-responsive tablaProduccion" width="100%">
                <thead>
                  <tr>
                    <th style="width:5%">#</th>
                    <th style="width:8%">Imagen</th>
                    <th style="width:20%">Código</th>
                    <th style="width:42%">Nombre</th>
                    <th style="width:15%">Precio de compra</th>
                    <th style="width:10%">Acción</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
          </div>
        </div>
      </div>
    </div>

  </div>

</body>

</html>

<style>
  .error {
    color: red;
  }

  .radio-options {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
    margin: 20px 0;
  }

  .btn-orden {
    flex: 1;
    min-width: 200px;
    position: relative;
    padding: 15px;
    background: #f8f9fa;
    border: 2px solid #ddd;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
  }

  .btn-orden:hover {
    background: #e9ecef;
    border-color: #3c8dbc;
  }

  .btn-orden input[type="radio"] {
    position: absolute;
    opacity: 0;
  }

  .btn-orden span {
    display: block;
    text-align: center;
    font-size: 16px;
  }

  .btn-orden i {
    display: block;
    font-size: 24px;
    margin-bottom: 8px;
    color: #3c8dbc;
  }

  .btn-orden input[type="radio"]:checked+span i {
    color: #28a745;
  }

  .btn-orden input[type="radio"]:checked+span::before {
    content: '✓';
    position: absolute;
    top: 5px;
    right: 5px;
    color: #28a745;
  }

  /* Estilos responsivos */
  @media (max-width: 768px) {
    .btn-orden {
      min-width: 150px;
      padding: 10px;
    }
  }

  /* Estilos para el modal y la tabla */
  .modal-lg {
    width: 90%;
    max-width: 1200px;
  }

  .tablaProduccion {
    width: 100% !important;
  }

  /* Evitar que los encabezados se partan en múltiples líneas */
  .tablaProduccion thead th {
    white-space: nowrap;
  }

  /* Ajustar el padding de las celdas para mejor espaciado */
  .tablaProduccion td,
  .tablaProduccion th {
    padding: 10px !important;
  }
</style>

<script>
  $(document).ready(function() {
    $.getScript('vistas/js/orden-produccion.js');
  });
</script>