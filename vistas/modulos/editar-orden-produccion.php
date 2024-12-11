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

  <style>
    /*=========================
   * Estilo de los Modales
   *=========================*/
    /* Configuración del modal grande */
    .modal-lg {
      width: 90%;
      max-width: 1200px;
    }

    /*=========================
   * Tipo de Orden
   *=========================*/
    /* Ocultar el radio button original */
    .btn-orden input[type="radio"] {
      position: absolute;
      opacity: 0;
    }

    /* Contenedor de opciones de radio */
    .radio-options {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      margin: 20px 0;
    }

    /* Estilo para los botones de orden */
    .btn-orden {
      flex: 1;
      position: relative;
      cursor: pointer;
      margin: 0;
      min-width: 150px;
    }

    /* Contenido de los botones de orden */
    .orden-content {
      display: flex;
      align-items: center;
      flex-direction: column;
      padding: 12px 8px;
      border: 2px solid #ddd;
      border-radius: 8px;
      transition: all 0.2s ease;
      background: #f8f9fa;
      min-height: 100%;
      user-select: none;
    }

    /* Íconos en los botones de orden */
    .orden-content i {
      font-size: 24px;
      color: #3c8dbc;
      margin-bottom: 8px;
    }

    /* Texto en los botones de orden */
    .orden-content span {
      text-align: center;
      font-size: 14px;
      white-space: nowrap;
    }

    /* Estilo cuando está seleccionado */
    .btn-orden input[type="radio"]:checked+.orden-content {
      border-color: #28a745;
      background: #fff;
    }

    /* Cambiar color del ícono cuando está seleccionado */
    .btn-orden input[type="radio"]:checked+.orden-content i {
      color: #28a745;
    }

    /* Añadir check cuando está seleccionado */
    .btn-orden input[type="radio"]:checked+.orden-content::after {
      content: '✓';
      position: absolute;
      top: 8px;
      right: 8px;
      color: #28a745;
      font-size: 14px;
      font-weight: bold;
    }

    /*=========================
   * Tipo de Producción
   *=========================*/
    /* Ocultar el radio button original */
    .production-option input[type="radio"] {
      position: absolute;
      opacity: 0;
    }

    /* Contenedor de opciones de producción */
    .production-options-container {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      margin: 20px 0;
    }

    /* Estilo para opciones de producción */
    .production-option {
      flex: 1;
      position: relative;
      cursor: pointer;
      margin: 0;
      min-width: 150px;
      user-select: none;
    }

    /* Contenido de la opción de producción */
    .option-content {
      display: flex;
      align-items: center;
      padding: 8px 12px;
      border: 2px solid #ddd;
      border-radius: 6px;
      transition: all 0.2s ease;
      background: #f8f9fa;
      min-height: 100%;
    }

    /* Íconos en las opciones de producción */
    .option-content i {
      font-size: 20px;
      color: #3c8dbc;
      margin-right: 10px;
    }

    /* Contenedor de texto */
    .option-text {
      display: flex;
      flex-direction: column;
    }

    /* Estilo del título */
    .option-title {
      font-size: 14px;
      font-weight: bold;
      color: #333;
      line-height: 1.2;
    }

    /* Estilo de la descripción */
    .option-description {
      font-size: 12px;
      color: #666;
      line-height: 1.2;
    }

    /* Estilo cuando está seleccionado */
    .production-option input[type="radio"]:checked+.option-content {
      border-color: #28a745;
      background: #fff;
    }

    /* Cambiar color del ícono cuando está seleccionado */
    .production-option input[type="radio"]:checked+.option-content i {
      color: #28a745;
    }

    /* Añadir check cuando está seleccionado */
    .production-option input[type="radio"]:checked+.option-content::after {
      content: '✓';
      position: absolute;
      top: 8px;
      right: 8px;
      color: #28a745;
      font-size: 14px;
      font-weight: bold;
    }
  </style>
</head>

<body>
  <div class="content-wrapper">

    <!-- Encabezado de la página -->
    <section class="content-header">
      <h1 style="color:green;font-weight:bold">
        EDITAR ORDEN DE PRODUCCIÓN
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Inicio</a></li>
        <li class="active">Crear Orden de Producción</li>
      </ol>
    </section>

    <!-- Contenido de la página -->
    <section class="content">

      <div class="box">
        <form role="form" method="post" class="formularioOrdenProduccion">

          <?php

          $item = "id";
          $valor = $_GET["idOrdenProduccion"];

          $ordenProduccion = ControladorOrdenProduccion::ctrNuevaMostrarOrdenesProduccion($item, $valor);
          $insumos = ControladorOrdenProduccion::ctrMostrarInsumosPorOrden($valor);

          $itemBodega = "id";
          $valorBodega = $ordenProduccion["bodega_destino"];
          $bodega = ControladorBodegas::ctrMostrarBodegas($itemBodega, $valorBodega);

          $itemCentro = "id";
          $valorCentro = $ordenProduccion["centro_costo"];
          $centro = ControladorCentros::ctrMostrarCentros($itemCentro, $valorCentro);

          $itemCliente = "id";
          $valorCliente = $ordenProduccion["id_cliente"];
          $clientes = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

          $itemUnidad = "id";
          $valorUnidad = $ordenProduccion["id_unidad"];
          $unidades = ControladorUnidades::ctrMostrarUnidades($itemUnidad, $valorUnidad);

          $itemCotizacion = "id";
          $valorCotizacion = $ordenProduccion["id_cotizacion"];
          $cotizacion = ControladorCotizacion::ctrMostrarCotizaciones($itemCotizacion, $valorCotizacion);
          $valorCotizacionExcenta = $ordenProduccion["id_cotizacion_exenta"];
          $cotizacionExcenta = ControladorCotizacion::ctrMostrarCotizacionesExentas($itemCotizacion, $valorCotizacionExcenta);

          $itemProducto = null;
          $valorProducto = null;
          $productos = ControladorProductos::ctrMostrarProductosPredeterminado($itemProducto, $valorProducto);

          $itemLista = null;
          $valorLista = null;
          $listas = ControladorTablaListas::ctrMostrarTablaListas($itemLista, $valorLista);

          $productosPorId = [];
          foreach ($productos as $producto) {
            $productosPorId[$producto['id']] = $producto['descripcion']; // Guardar descripción del producto con su id
          }

          $listasPorId = [];
          foreach ($listas as $lista) {
            $listasPorId[$lista['id']] = $lista['nombre']; // Guardar nombre de tipo de material con su id
          }

          foreach ($insumos as $key => $insumo) {
            if (isset($productosPorId[$insumo['id_producto']])) {
              $insumos[$key]['nombre_producto'] = $productosPorId[$insumo['id_producto']]; // Asignamos la descripción
            } else {
              $insumos[$key]['nombre_producto'] = 'Producto desconocido';
            }

            if (isset($listasPorId[$insumo['id_tipo_material']])) {
              $insumos[$key]['nombre_tipo_material'] = $listasPorId[$insumo['id_tipo_material']]; // Asignamos el nombre del tipo de material
            } else {
              $insumos[$key]['nombre_tipo_material'] = 'Tipo de material desconocido';
            }
          }

          $insumosJSON = json_encode($insumos);

          ?>

          <div class="box-body">

            <!-- Tipo de Orden, Cliente Asociado, Datos de Orden y Orden de Producción -->
            <div class="row">

              <!-- Tipo de Orden -->
              <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                <div class="box box-info">
                  <div class="box-body">
                    <h2 class="box-title" style="font-weight:bold; font-size:20px; margin-top: 0;">
                      Tipo de Orden
                    </h2>

                    <!-- Opciones de Tipo de Orden -->
                    <div class="radio-options">
                      <label class="btn-orden">
                        <input type="radio" id="tipoOrden" name="tipoOrden" value="Para Stock" <?= $ordenProduccion['tipo_orden'] == "Para Stock" ? 'checked' : '' ?>>
                        <div class="orden-content">
                          <i class="fa fa-cubes"></i>
                          <span>Para Stock</span>
                        </div>
                      </label>
                      <label class="btn-orden">
                        <input type="radio" id="tipoOrden" name="tipoOrden" value="Cliente sin Cotización" <?= $ordenProduccion['tipo_orden'] == "Cliente sin Cotización" ? 'checked' : '' ?>>
                        <div class="orden-content">
                          <i class="fa fa-user"></i>
                          <span>Cliente sin Cotización</span>
                        </div>
                      </label>
                      <label class="btn-orden">
                        <input type="radio" id="tipoOrden" name="tipoOrden" value="Cliente con Cotización" <?= $ordenProduccion['tipo_orden'] == "Cliente con Cotización" ? 'checked' : '' ?>>
                        <div class="orden-content">
                          <i class="fa fa-file-text"></i>
                          <span>Cliente con Cotización</span>
                        </div>
                      </label>
                    </div>

                    <!-- Sección de Cliente -->
                    <div class="row" id="clienteAsociado" style="display: none;">
                      <!-- Cliente Asociado -->
                      <div class="col-xs-12">
                        <h2 class="box-title" style="font-weight:bold; font-size:20px; margin-bottom: 20px; margin-top: 0;">
                          Cliente Asociado
                        </h2>
                        <div class="form-group">
                          <div class="input-group">
                            <input type="hidden" name="traerIdCliente" id="traerIdCliente">
                            <input type="text" class="form-control"
                              id="nombreCliente"
                              placeholder="Seleccionar cliente"
                              readonly
                              style="cursor: pointer;"
                              data-toggle="modal"
                              data-id="<?php $clientes['id']; ?>"
                              data-target="#modalSeleccionarCliente">
                            <span class="input-group-btn">
                              <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modalSeleccionarCliente">
                                <i class="fa fa-search"></i>
                              </button>
                            </span>
                          </div>
                        </div>
                      </div>

                      <!-- Datos del cliente -->
                      <div class="col-lg-6 col-md-12 col-sm-6 col-xs-12">
                        <div class="form-group">
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-address-card"></i> RUT</span>
                            <input type="text" class="form-control" id="traerRut" value="" readonly>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-12 col-sm-6 col-xs-12">
                        <div class="form-group">
                          <div class="input-group">
                            <span class="input-group-addon">Dirección</span>
                            <input type="text" class="form-control" id="traerDireccion" value="" readonly>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-12 col-sm-6 col-xs-12">
                        <div class="form-group">
                          <div class="input-group">
                            <span class="input-group-addon">Actividad</span>
                            <input type="text" class="form-control" id="traerActividad" value="" readonly>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-12 col-sm-6 col-xs-12">
                        <div class="form-group">
                          <div class="input-group">
                            <span class="input-group-addon">Ejecutivo</span>
                            <input type="text" class="form-control" id="traerEjecutivo" value="" readonly>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-12 col-sm-6 col-xs-12">
                        <div class="form-group">
                          <div class="input-group">
                            <span class="input-group-addon">Teléfono</span>
                            <input type="text" class="form-control" id="traerTelefono" value="" readonly>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-12 col-sm-6 col-xs-12">
                        <div class="form-group">
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-at"></i> Correo</span>
                            <input type="text" class="form-control" id="traerEmail" value="" readonly>
                          </div>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
              </div>

              <!-- Datos de Orden -->
              <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="box box-info">
                  <div class="box-body">
                    <h2 class="box-title" style="font-weight:bold; font-size:20px; margin-bottom: 20px; margin-top: 0;">
                      Datos de Orden
                    </h2>
                    <div class="row" style="margin-bottom:5px;">

                      <!-- Fecha de emisión -->
                      <div class="col-lg-6 col-md-12 col-sm-6 col-xs-12">
                        <div class="form-group">
                          <p>Fecha de emisión</p>
                          <input type="date" class="form-control"
                            name="nuevaFechaEmision" id="nuevaFechaEmision"
                            readonly value="<?php echo $ordenProduccion["fecha_orden_emision"]; ?>">
                        </div>
                      </div>

                      <!-- Fecha de vencimiento -->
                      <div class="col-lg-6 col-md-12 col-sm-6 col-xs-12">
                        <div class="form-group">
                          <p>Fecha de vencimiento</p>
                          <input type="date" class="form-control"
                            name="nuevaFechaVencimiento" id="nuevaFechaVencimiento"
                            value="<?php echo $ordenProduccion["fecha_orden_vencimiento"]; ?>"
                            onchange="validarFechas('nuevaFechaEmision', this.id)">
                        </div>
                      </div>

                      <!-- Centro de costo -->
                      <div class="col-lg-6 col-md-12 col-sm-6 col-xs-12">
                        <div class="form-group">
                          <p>Centro de costo</p>
                          <select class="form-control" id="nuevoCentro"
                            name="nuevoCentro">
                            <option selected
                              value="<?php echo $centro["id"]; ?>"><?php echo $centro["centro"]; ?></option>
                            <optgroup label="---Cambiar Centro de Costo--"></optgroup>

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

                      <!-- Bodega de destino -->
                      <div class="col-lg-6 col-md-12 col-sm-6 col-xs-12">
                        <div class="form-group">
                          <p>Bodega de destino</p>
                          <select class="form-control" id="nuevaBodega"
                            name="nuevaBodega">
                            <option selected
                              value="<?php echo $bodega["id"]; ?>"><?php echo $bodega["nombre"]; ?></option>
                            <optgroup label="---Cambiar Bodega--"></optgroup>

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

                <!-- Seleccionar Cotización -->
                <div class="box box-info" id="seleccionarCotizacion" style="display: none;">
                  <div class="box-body">
                    <h2 class="box-title" style="font-weight:bold; font-size:20px; margin-bottom: 20px; margin-top: 0;">
                      Cotización
                    </h2>

                    <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-7 col-xs-12">
                        <div class="form-group">
                          <div class="input-group">
                            <input type="hidden" name="traerIdCotizacionAfecta" id="traerIdCotizacionAfecta">
                            <input type="hidden" name="traerIdCotizacionExenta" id="traerIdCotizacionExenta">
                            <span class="input-group-addon"><i class="fa fa-file-text"></i></span>
                            <input type="text" class="form-control"
                            value="<?php 
                                      echo isset($cotizacion['nombre_orden']) 
                                        ? $cotizacion['nombre_orden'] . ' - Folio: ' . $cotizacion['codigo'] 
                                        : $cotizacionExcenta['nombre_orden'] . ' - Folio: ' . $cotizacionExcenta['codigo']; 
                                    ?>"
                              id="nombreCotizacion"
                              placeholder="Seleccionar cotización"
                              readonly
                              style="cursor: pointer;"
                              data-toggle="modal"
                              data-target="#modalSeleccionarCotizacion">
                            <span class="input-group-btn">
                              <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modalSeleccionarCotizacion">
                                <i class="fa fa-search"></i>
                              </button>
                            </span>
                          </div>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
              </div>

              <!-- Orden de Producción y Nombre de la Orden -->
              <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">

                <div class="box box-info">
                  <div class="box-body">

                    <!-- Folio -->
                    <h2 class="box-title"
                      style="font-weight:bold; font-size:20px; color:red; margin-bottom: 20px; margin-top: 0;">
                      ORDEN DE PRODUCCIÓN
                    </h2>
                    <div class="row">
                      <div class="col-lg-6 col-md-8 col-sm-4 col-xs-6">
                        <div class="form-group">
                          <div class="input-group">
                            <span class="input-group-addon" style="background-color:red; color:white; font-weight:bold">FOLIO</span>
                            <input type="text" style="font-weight:bold; font-size:16px;" class="form-control text-center" name="nuevoFolio"
                              id="nuevoFolio" value="<?php echo $ordenProduccion["folio_orden_produccion"]; ?>" readonly
                              required>
                          </div>
                        </div>
                      </div>
                    </div>

                    <!-- Nombre de la orden -->
                    <h2 class="box-title"
                      style="color:#39b616;font-weight:bold; font-size:20px; margin-bottom: 20px; margin-top: 10px;">
                      NOMBRE DE ORDEN
                    </h2>
                    <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
                        <div class="form-group">
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-file"></i></span>
                            <input type="text" style="font-weight:bold; font-size:16px;" class="form-control"
                              name="nuevoNombreOrden" id="nuevoNombreOrden" value="<?php echo $ordenProduccion['nombre_orden']; ?>" required>
                          </div>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
              </div>

            </div>

            <!-- Tipo de Producción y Resumen de Producción -->
            <div class="row">

              <!-- Tipo de Producción y Detalle de Producción -->
              <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">

                <!-- Tipo de Producción -->
                <div class="box box-info">
                  <div class="box-body">
                    <h2 class="box-title" style="font-weight:bold; font-size:20px; margin-top: 0; margin-bottom: 10px;">
                      Tipo de Producción
                    </h2>
                    <div class="production-options-container">

                      <!-- Opción de Producción -->
                      <label class="production-option">
                        <input type="radio" name="tipoProduccion" value="Producto" <?= $ordenProduccion['tipo_produccion'] == "Producto" ? 'checked' : '' ?>>
                        <div class="option-content">
                          <i class="fa fa-cubes"></i>
                          <div class="option-text">
                            <span class="option-title">Producción</span>
                            <span class="option-description">Seleccione un producto para producir</span>
                          </div>
                        </div>
                      </label>

                      <!-- Opción de Pack -->
                      <label class="production-option">
                        <input type="radio" name="tipoProduccion" value="Pack" <?= $ordenProduccion['tipo_produccion'] == "Pack" ? 'checked' : '' ?>>
                        <div class="option-content">
                          <i class="fa fa-archive"></i>
                          <div class="option-text">
                            <span class="option-title">Pack</span>
                            <span class="option-description">Seleccione una agrupación de varios productos</span>
                          </div>
                        </div>
                      </label>

                    </div>
                  </div>
                </div>

                <!-- Detalle de Producción -->
                <div class="box box-info" id="boxDetalleProduccion" style="display: none;">
                  <div class="box-body">
                    <h2 class="box-title" style="font-weight:bold; font-size:20px; margin-bottom: 20px; margin-top: 0;">
                      Detalle de Producción
                    </h2>
                    <div class="row">
                      <script>
                        $("#boxDetalleProduccion").show();
                      </script>

                      <!-- Producto en Producción -->
                      <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
                        <div class="form-group">
                          <label>Producto en Producción</label>
                          <div class="input-group">
                            <!-- Campo oculto para almacenar el ID del producto -->
                            <input type="hidden"
                              name="idProductoProduccion"
                              id="idProductoProduccion"
                              value="<?php echo $ordenProduccion['id_producto_produccion']; ?>">

                            <span class="input-group-addon"><i class="fa fa-cube"></i></span>

                            <!-- Campo visible para mostrar el nombre del producto -->
                            <input type="text"
                              class="form-control"
                              id="detalleProductoProduccion"
                              name="detalleProductoProduccion"
                              value="<?php
                                      echo isset($productosPorId[$ordenProduccion['id_producto_produccion']])
                                        ? $productosPorId[$ordenProduccion['id_producto_produccion']]
                                        : 'Producto desconocido';
                                      ?>"
                              placeholder="Seleccione un producto"
                              readonly
                              style="cursor: pointer;"
                              data-toggle="modal"
                              data-target="#modalSeleccionarProducto">

                            <span class="input-group-btn">
                              <button type="button"
                                class="btn btn-default"
                                data-toggle="modal"
                                data-target="#modalSeleccionarProducto">
                                <i class="fa fa-search"></i>
                              </button>
                            </span>
                          </div>
                        </div>
                      </div>


                      <!-- Unidad de producción -->
                      <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
                        <div class="form-group">
                          <label>Unidad de Producción</label>
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-balance-scale"></i></span>
                            <select class="form-control" id="detalleUnidad" name="detalleUnidad">
                              <option value=""><?php echo $unidades['medida']; ?></option>
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
                      <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
                        <div class="form-group">
                          <label>Cantidad a Producir</label>
                          <div class="input-group">
                            <span class="input-group-addon""><i class=" fa fa-cubes"></i></span>
                            <input type="number" class="form-control" value="<?php echo $ordenProduccion['cantidad_produccion']; ?>" required
                              id="detalleCantidadProducir"
                              name="detalleCantidadProducir"
                              min="1"
                              placeholder="Ingrese la cantidad a producir">
                          </div>
                        </div>
                      </div>

                      <!-- Fecha de elaboración -->
                      <div class="col-lg-6 col-md-12 col-sm-6 col-xs-12">
                        <div class="form-group">
                          <label>Fecha de Elaboración</label>
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <input type="date" class="form-control"
                              id="detalleFechaElaboracion"
                              name="detalleFechaElaboracion"
                              onchange="validarFechas(this.id, 'detalleFechaElaboracionVencimiento')"
                              value="<?php echo $ordenProduccion["fecha_elaboracion"]; ?>">
                          </div>
                        </div>
                      </div>

                      <!-- Fecha de vencimiento -->
                      <div class="col-lg-6 col-md-12 col-sm-6 col-xs-12">
                        <div class="form-group">
                          <label>Fecha de Vencimiento</label>
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar-times-o"></i></span>
                            <input type="date" class="form-control"
                              id="detalleFechaElaboracionVencimiento"
                              name="detalleFechaElaboracionVencimiento"
                              onchange="validarFechas('detalleFechaElaboracion', this.id)"
                              value="<?php echo $ordenProduccion["fecha_elaboracion_vencimiento"]; ?>">
                          </div>
                        </div>
                      </div>

                      <!-- Código de lote -->
                      <div class="col-lg-12 col-md-12 col-sm-6 col-xs-12">
                        <div class="form-group">
                          <label>Código de Lote</label>
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-barcode"></i></span>
                            <input type="text" class="form-control" value="<?php echo $ordenProduccion['codigo_lote']; ?>" required
                              id="detalleCodigoLote"
                              name="detalleCodigoLote"
                              placeholder="Ingrese el código de lote"
                              maxlength="12"
                              minlength="12">
                          </div>
                          <small id="codigoLoteError" class="text-danger" style="display: none;">
                            Código inválido. Ingrese un código EAN-13 válido para generar el código de barras.
                          </small>
                        </div>

                        <!-- Generar código de barras -->
                        <div class="form-group">
                          <button type="button" class="btn btn-success" style="margin-bottom: 10px;"
                            onclick="generarbarcodeOP();">Generar código de barras
                          </button>
                          <div id="cuadroCodigoBarras" class="text-center" style="display:none; border: 1px solid #ddd;">
                            <div id="print">
                              <svg id="barcode" class="barcode"></svg>
                            </div>
                          </div>
                          <button type="button" id="btnImprimir" class="btn btn-info" style="display: none; margin-top: 10px; margin-right: 5px;"
                            onclick="imprimir();">
                            <i class="fa fa-print"></i> Imprimir
                          </button>
                          <button type="button" id="btnOcultar" class="btn btn-default" style="display: none; margin-top: 10px;"
                            onclick="ocultarCodigoBarras();">
                            <i class="fa fa-eye-slash"></i> Ocultar
                          </button>
                        </div>

                      </div>

                      <!-- Observaciones -->
                      <div class="col-xs-12">
                        <div class="form-group">
                          <label>Observaciones</label>
                          <textarea class="form-control"
                            id="detalleObservacion"
                            name="detalleObservacion"
                            rows="4"
                            style="resize: none;"
                            placeholder="Ingrese las observaciones de la producción"><?php echo $ordenProduccion['observaciones']; ?></textarea>
                        </div>
                      </div>

                    </div>
                  </div>
                </div>

              </div>

              <!-- Resumen de Producción y Tabla de Insumos Seleccionados -->
              <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <div class="box box-info">
                  <div class="box-body">

                    <input type="hidden" id="costoEmbalajeTotal" name="costoEmbalajeTotal">
                    <input type="hidden" id="costoProduccionTotal" name="costoProduccionTotal">
                    <input type="hidden" id="costoProduccionTotalConEmbalaje" name="costoProduccionTotalConEmbalaje">

                    <!-- Resumen de Producción -->
                    <div class="row">
                      <div class="col-xs-12">
                        <h2 class="box-title" style="font-weight:bold; font-size:20px; margin-bottom: 20px; margin-top: 0;">
                          Resumen de Producción
                        </h2>
                      </div>

                      <!-- Costo del Embalaje -->
                      <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="info-box">
                          <span class="info-box-icon bg-aqua">
                            <i class="fa fa-cube"></i>
                          </span>
                          <div class="info-box-content">
                            <span class="info-box-text">Costo del Embalaje</span>
                            <span class="info-box-number" id="resumenCostoEmbalaje">$0</span>
                          </div>
                        </div>
                      </div>

                      <!-- Costo sin Embalaje -->
                      <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="info-box">
                          <span class="info-box-icon bg-green">
                            <i class="fa fa-cubes"></i>
                          </span>
                          <div class="info-box-content">
                            <span class="info-box-text">Costo sin Embalaje</span>
                            <span class="info-box-number" id="resumenCostoSinEmbalaje">$0</span>
                          </div>
                        </div>
                      </div>

                      <!-- Costo Total del Lote -->
                      <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="info-box">
                          <span class="info-box-icon bg-yellow">
                            <i class="fa fa-calculator"></i>
                          </span>
                          <div class="info-box-content">
                            <span class="info-box-text">Costo Total del Lote</span>
                            <span class="info-box-number" id="resumenCostoTotalLote">$0</span>
                          </div>
                        </div>
                      </div>

                    </div>
                  </div>
                </div>

                <!-- Tabla de Selección de Insumos -->
                <div class="box box-success" id="boxInsumos" style="display: none;">
                  <div class="box-body">
                    <div class="row insumosSeleccionados">
                      <div class="table-responsive" style="padding: 10px;">
                        <h2 class="box-title" style="font-weight:bold; font-size:20px; margin-bottom: 20px; margin-top: 0;">
                          Seleccionar Insumos y Embalaje
                        </h2>

                        <!-- Barra para agregar Insumos -->
                        <div class="form-group">
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-search"></i></span>
                            <input type="text"
                              class="form-control input-lg"
                              placeholder="Buscar y agregar insumos y embalaje"
                              id="agregarInsumos"
                              readonly
                              style="cursor: pointer;"
                              data-toggle="modal"
                              data-target="#modalAgregarInsumos">
                            <span class="input-group-addon"
                              style="border-left: none; cursor: pointer;"
                              data-toggle="modal"
                              data-target="#modalAgregarInsumos">
                              <i class="fa fa-plus-circle fa-lg"></i>
                            </span>
                            <script>
                              $("#boxInsumos").show();
                            </script>
                          </div>
                        </div>

                        <table class="table table-bordered table-striped">
                          <thead>
                            <tr>
                              <th style="width:25%">Nombre</th>
                              <th style="width:10%">Tipo</th>
                              <th style="width:10%">Unidad</th>
                              <th style="width:10%">Cantidad</th>
                              <th style="width:20%">Precio unitario</th>
                              <th style="width:20%">Costo total</th>
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

          </div>

          <!-- Pie de la página -->
          <div class="box-footer">
            <a href="administrar-orden-produccion" class="btn btn-default">Salir</a>
            <button type="submit" class="btn btn-primary">Editar Orden</button>
          </div>

        </form>

        <?php
        $editarOrdenProduccion = new ControladorOrdenProduccion();
        $editarOrdenProduccion->ctrEditarOrdenProduccion();
        ?>

      </div>
    </section>
  </div>

  <!-- Modal Seleccionar Cliente -->
  <div id="modalSeleccionarCliente" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title">Seleccionar Cliente</h3>
        </div>
        <div class="modal-body">
          <div class="box-body">
            <table class="table table-bordered table-striped dt-responsive tablaClientes" width="100%">
              <thead>
                <tr>
                  <th>Nombre</th>
                  <th>RUT</th>
                  <th>Actividad</th>
                  <th>Acciones</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Seleccionar Cotización -->
  <div id="modalSeleccionarCotizacion" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header" style="background:#3c8dbc; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title">Seleccionar Cotización</h3>
        </div>
        <div class="modal-body">
          <div class="box-body">
            <table class="table table-bordered table-striped dt-responsive tablaCotizaciones" width="100%">
              <thead>
                <tr>
                  <th>Cliente</th>
                  <th>Nombre Orden</th>
                  <th>Folio</th>
                  <th>Fecha Emisión</th>
                  <th>Fecha Vencimiento</th>
                  <th>Total</th>
                  <th>Tipo DTE</th>
                  <th>Acciones</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>

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
                  <th style="width:32%">Nombre</th>
                  <th style="width:10%">Tabla Lista</th>
                  <th style="width:15%">Precio de compra</th>
                  <th style="width:10%">Acción</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal para añadir insumos -->
  <div id="modalAgregarInsumos" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header" style="background:#008f39; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title">Seleccionar Insumos y Embalaje</h3>
        </div>
        <div class="modal-body">
          <div class="box-body">
            <table class="table table-bordered table-striped dt-responsive tablaInsumos" width="100%">
              <thead>
                <tr>
                  <th style="width:5%">#</th>
                  <th style="width:8%">Imagen</th>
                  <th style="width:20%">Código</th>
                  <th style="width:32%">Nombre</th>
                  <th style="width:10%">Tabla Lista</th>
                  <th style="width:15%">Precio de compra</th>
                  <th style="width:10%">Acción</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    $(document).ready(function() {
      $.getScript('vistas/js/nueva-orden-produccion.js');

      // Verificar qué tipo de orden está seleccionado al cargar la página
      let tipoOrdenSeleccionado = $('input[name="tipoOrden"]:checked').val();

      if (tipoOrdenSeleccionado === "Cliente con Cotización") {
        $("#clienteAsociado").show();
        $("#seleccionarCotizacion").show();
        limpiarDatosCliente();

        // Recargar la tabla con clientes que tienen cotizaciones
        $(".tablaClientes")
          .DataTable()
          .ajax.url(`ajax/datatable-clientes.ajax.php?tipoOrden=${tipoOrdenSeleccionado}`)
          .load();
      } else if (tipoOrdenSeleccionado === "Cliente sin Cotización") {
        $("#clienteAsociado").show();
        $("#seleccionarCotizacion").hide();
        limpiarDatosCliente();
        limpiarDatosCotizacion();

        // Recargar la tabla con todos los clientes
        $(".tablaClientes")
          .DataTable()
          .ajax.url(`ajax/datatable-clientes.ajax.php?tipoOrden=${tipoOrdenSeleccionado}`)
          .load();
      } else if (tipoOrdenSeleccionado === "Para Stock") {
        $("#clienteAsociado").hide();
        $("#seleccionarCotizacion").hide();
        limpiarDatosCliente();
        limpiarDatosCotizacion();
      }


    });
  </script>

  <script>
    $(document).ready(function() {
      // Convertir el JSON generado en PHP directamente en una variable de JavaScript
      const insumosExistentes = <?php echo $insumosJSON; ?>;

      function formatearMoneda(valor) {
        return $.number(valor, 0, ',', '.');
      }

      // Inicializar el array de insumos seleccionados
      window.insumosSeleccionados = []; // Usamos window para hacerla global

      // Agregar los insumos existentes al array
      insumosExistentes.forEach(insumo => {
        insumosSeleccionados.push({
          id_producto: insumo.id_producto,
          nombre_producto: insumo.nombre_producto,
          id_tipo_material: insumo.id_tipo_material,
          nombre_tipo_material: insumo.nombre_tipo_material,
          id_unidad: insumo.id_unidad,
          cantidad: insumo.cantidad, // O cualquier valor que tengas en la base de datos
          precio_unitario: insumo.precio_unitario,
          costo_total: insumo.costo_total
        });
      });

      // Agregar los insumos a la tabla
      insumosSeleccionados.forEach(insumo => {
        let nombreUnidad = $("#detalleUnidad option[value='" + insumo.id_unidad + "']").text();

        let nuevaFila = `
        <tr>
            <td>${insumo.nombre_producto}</td> 
            <td>${insumo.nombre_tipo_material}</td> 
            <td>${nombreUnidad}</td> 
            <td>
                <input type="number" class="form-control cantidadInsumo"
                       min="1" value="${insumo.cantidad}" style="width:80px">
            </td>
            <td>
                <span class="precioUnitarioFormateado">${formatearMoneda(insumo.precio_unitario)}</span>
            </td>
            <td class="costoTotal">
                <span class="costoTotalFormateado">${formatearMoneda(insumo.costo_total)}</span>
            </td>
            <td>
                <div class="btn-group">
                    <button class="btn btn-danger eliminarInsumo">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
            </td>
        </tr>
    `;

        $(".insumosSeleccionados tbody").append(nuevaFila);
      });

      // Llamar a la función actualizarTotales después de cargar los insumos
      actualizarTotales();

      // Función para actualizar los totales
      function actualizarTotales() {
        // Inicializar totales
        let costoEmbalajeFinal = 0;
        let costoInsumosFinal = 0;
        let costoTotalLoteFinal = 0;

        // Procesar cada fila de insumos
        $(".insumosSeleccionados table tbody tr").each(function() {
          const index = $(this).index(); // Obtener el índice de la fila actual
          if (window.insumosSeleccionados[index]) {
            const cantidad = parseInt($(this).find(".cantidadInsumo").val()) || 0; // Obtener la cantidad
            const precioUnitario = window.insumosSeleccionados[index].precio_unitario;
            const costoFilaTotal = cantidad * precioUnitario;

            // Actualizar el array insumosSeleccionados
            window.insumosSeleccionados[index].cantidad = cantidad;
            window.insumosSeleccionados[index].costo_total = costoFilaTotal;

            // Actualizar visualización en la tabla
            $(this).find(".costoTotalFormateado").text(formatearMoneda(costoFilaTotal));

            // Actualizar totales
            $(this).find("td:eq(1)").text().trim() === "Embalaje" ?
              (costoEmbalajeFinal += costoFilaTotal) :
              (costoInsumosFinal += costoFilaTotal);

            // Sumar el costo total de la fila al total del lote
            costoTotalLoteFinal += costoFilaTotal;
          }
        });

        // Actualizar resúmenes visuales
        $("#resumenCostoEmbalaje").text(formatearMoneda(costoEmbalajeFinal));
        $("#resumenCostoSinEmbalaje").text(formatearMoneda(costoInsumosFinal));
        $("#resumenCostoTotalLote").text(formatearMoneda(costoTotalLoteFinal));

        // Actualizar los campos ocultos
        $("#costoEmbalajeTotal").val(costoEmbalajeFinal);
        $("#costoProduccionTotal").val(costoInsumosFinal);
        $("#costoProduccionTotalConEmbalaje").val(costoTotalLoteFinal);
      }
    });
  </script>



</body>

</html>