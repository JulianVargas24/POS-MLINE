<?php
if ($_SESSION["perfil"] == "Especial") {

    echo '<script>

    window.location = "inicio";

  </script>';

    return;
}
?>

<div class="content-wrapper">

    <section class="content-header">

        <h1 style="color:green;font-weight:bold">
            Facturar Compra (Sin documento previo)
        </h1>

        <ol class="breadcrumb">

            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>

            <li class="active">Crear Compra</li>

        </ol>

    </section>

    <section class="content">
        <div class="box">
            <div class="box-body">
                <form role="form" method="post" class="formularioCompra">
                    <div class="row">
                        <div class="col-xs-5">
                            <div class="box box-info">
                                <div class="box-body">
                                    <h2 class="box-title" style="font-weight:bold; font-size:20px;">
                                        Proveedor Asociado
                                    </h2>
                                    <div class="row" style="margin-bottom:5px;">
                                        <div class="col-xs-12">
                                            <div class="form-group">
                                                <div class="input-group" style="display:block;">
                                                    <select class="form-control" id="nuevoProveedor"
                                                            name="nuevoProveedor" required>

                                                        <option value="">Seleccionar proveedor</option>

                                                        <?php
                                                        $item = null;
                                                        $valor = null;

                                                        $proveedores = ControladorProveedores::ctrMostrarProveedores($item, $valor);

                                                        foreach ($proveedores as $key => $value) {

                                                            echo '<option class="seleccionarProveedor" value="' . $value["id"] . '">' . $value["razon_social"] . ' </option>';
                                                        }
                                                        ?>

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input type="hidden" id="traerIdProveedor">
                                                    <span class="input-group-addon"> <i class="fa fa-address-card"></i> RUT</span>
                                                    <input type="text" class="form-control" id="traerRutProveedor"
                                                           value="" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-6">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon">Dirección</span>
                                                    <input type="text" class="form-control" id="traerDireccionProveedor"
                                                           value="" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-6">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon">Actividad</span>
                                                    <input type="text" class="form-control" id="traerActividadProveedor"
                                                           value="" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-6">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon">Ejecutivo</span>
                                                    <input type="text" class="form-control" id="traerEjecutivoProveedor"
                                                           value="" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-6">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon">Teléfono</span>
                                                    <input type="text" class="form-control" id="traerTelefonoProveedor"
                                                           value="" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-6">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon"> <i
                                                                class="fa fa-at"></i> Correo</span>
                                                    <input type="text" class="form-control" id="traerEmailProveedor"
                                                           value="" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="box box-info">
                                <div class="box-body">
                                    <h2 class="box-title" style="font-weight:bold; font-size:20px;">
                                        Datos de Compra
                                    </h2>
                                    <div class="row" style="margin-bottom:5px;">
                                        <div class="col-xs-6">
                                            <div class="d-block" style="font-size:14px;">Fecha de emisión</div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input type="date" class="form-control input-sm"
                                                           name="nuevaFechaEmision" id="nuevaFechaEmision"
                                                           value="<?php echo date("Y-m-d"); ?>" required
                                                           onchange="validarFechas(this.id, 'nuevaFechaVencimiento')">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-6">
                                            <div class="d-block" style="font-size:14px;">Fecha de vencimiento</div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input type="hidden" id="nuevoEstado" name="nuevoEstado"
                                                           value="Abierta">
                                                    <input type="date" class="form-control input-sm"
                                                           name="nuevaFechaVencimiento" id="nuevaFechaVencimiento"
                                                           required
                                                           onchange="validarFechas('nuevaFechaEmision', this.id)">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xs-6">
                                            <div class="d-block" style="font-size:14px;">Centro de costo</div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <select class="form-control input" id="nuevoCentro"
                                                            name="nuevoCentro" required>

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
                                        <div class="col-xs-6">
                                            <div class="d-block" style="font-size:14px;">Bodega de destino</div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <select class="form-control input" id="nuevaBodega"
                                                            name="nuevaBodega" required>

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

                        <div class="col-xs-3">
                            <div class="box box-info">
                                <div class="box-body">
                                    <h2 class="box-title"
                                        style="color:#39b616;font-weight:bold; font-size:21px; color:red;">
                                        FACTURA DE COMPRA
                                    </h2>
                                    <div class="row" style="margin-top:2px;">
                                        <div class="col-xs-7">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon"
                                                          style="background-color:red; color:white; font-weight:bold">FOLIO</span>
                                                    <input type="hidden" name="nuevoFolioOC" id="nuevoFolioOC"
                                                           value="0">
                                                    <input type="text" style="font-weight:bold; font-size:16px;"
                                                           class="form-control" name="nuevoCodigo" id="nuevoCodigo"
                                                           required pattern="[0-9]+"
                                                           oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-lg-8 col-xs-12">

                            <div class="box box-success">
                                <div class="box-body">
                                    <div class="row nuevoProducto">
                                        <h2 class="box-title text-center" style="font-weight:bold; font-size:20px;">
                                            Productos Seleccionados
                                        </h2>
                                        <div class="row" style="padding:5px 15px">
                                            <div class="col-xs-2 text-center" style="padding-right:0px">
                                                <p style="background-color:#3c8dbc; color:white; border-radius:5px; padding: 5px 0px;">
                                                    Descripción</p>
                                            </div>
                                            <div class="col-xs-1 text-center" style="padding-right:0px">
                                                <p style="background-color:#3c8dbc; color:white; border-radius:5px; padding: 5px 0px;">
                                                    Cantidad</p>
                                            </div>
                                            <div class="col-xs-1 text-center" style="padding-right:0px">
                                                <p style="background-color:#3c8dbc; color:white; border-radius:5px; padding: 5px 0px;">
                                                    Precio U</p>
                                            </div>
                                            <div class="col-xs-1 text-center" style="padding-right:0px">
                                                <p style="background-color:#3c8dbc; color:white; border-radius:5px; padding: 5px 0px;">
                                                    Subtotal</p>
                                            </div>
                                            <div class="col-xs-1 text-center" style="padding-right:0px">
                                                <p style="background-color:#3c8dbc; color:white; border-radius:5px; padding: 5px 0px;">
                                                    Descuento</p>
                                            </div>
                                            <div class="col-xs-2 text-center" style="padding-right:0px">
                                                <p style="background-color:#3c8dbc; color:white; border-radius:5px; padding: 5px 0px;">
                                                    Total Neto</p>
                                            </div>
                                            <div class="col-xs-1 text-center" style="padding-right:0px">
                                                <p style="background-color:#3c8dbc; color:white; border-radius:5px; padding: 5px 0px;">
                                                    IVA</p>
                                            </div>
                                            <div class="col-xs-1 text-center" style="padding-right:0px">
                                                <p style="background-color:#3c8dbc; color:white; border-radius:5px; padding: 5px 0px;">
                                                    Otros Imp.</p>
                                            </div>
                                            <div class="col-xs-2 text-center" style="padding-right:12px">
                                                <p style="background-color:#3c8dbc; color:white; border-radius:5px; padding: 5px 0px;">
                                                    Total Final</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="box box-info">
                                        <div class="box-body">
                                            <h3 class="box-title" style="font-weight:bold; font-size:20px;">Totales</h3>
                                            <div class="row">
                                                <div class="col-xs-7">
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <span class="input-group-addon" style="padding:0px 8px">Subtotal</span>
                                                            <input style="font-size:16px;" type="text"
                                                                   class="form-control" id="nuevoSubtotal" total=""
                                                                   name="nuevoSubtotal" value="" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-7">
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <span class="input-group-addon" style="padding:0px 2px">Descuento</span>
                                                            <input style="font-size:16px;" type="text"
                                                                   class="form-control" id="nuevoTotalDescuento"
                                                                   total="" name="nuevoTotalDescuento" value=""
                                                                   readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-7">
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <span class="input-group-addon" style="padding:0px 3px">Total neto</span>
                                                            <input style="font-size:16px;" type="text"
                                                                   class="form-control" id="nuevoTotalNeto"
                                                                   name="nuevoTotalNeto" total="" value="" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-7">
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Exento</span>
                                                            <input style="font-size:18px;" type="text"
                                                                   class="form-control" readonly>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xs-7">

                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <span class="input-group-addon" style="padding:0px 15px">% IVA</span>
                                                            <input style="font-size:16px;" type="text"
                                                                   class="form-control" id="nuevoTotalIva"
                                                                   name="nuevoTotalIva" total="" value="" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-7">
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <span class="input-group-addon" style="padding:0px">Otros Imp.</span>
                                                            <input style="font-size:18px;" type="text"
                                                                   class="form-control" value="" readonly>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xs-7">
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"
                                                                  style="color:black; font-weight:bold; padding:0px 15px">Total</span>
                                                            <input style="font-size:16px;" type="text"
                                                                   class="form-control input" id="nuevoTotalFinal"
                                                                   name="nuevoTotalFinal" total="" readonly required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="box box-danger">
                                        <div class="box-body">
                                            <h3 class="box-title" style="font-weight:bold; font-size:20px;">
                                                Condición de Pago
                                            </h3>
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <div class="form-group"></div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-6">
                                                    <div class="d-block bg-primary text-center"
                                                         style="background-color:#3c8dbc;font-size:15px;">Plazo de Pago
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="input-group" style="display:block;">
                                                            <select class="form-control input" id="nuevoPlazoPago"
                                                                    name="nuevoPlazoPago" required>

                                                                <option value="">Seleccionar plazo de pago</option>

                                                                <?php
                                                                $item = null;
                                                                $valor = null;

                                                                $plazos = ControladorPlazos::ctrMostrarPlazos($item, $valor);

                                                                foreach ($plazos as $key => $value) {
                                                                    echo '<option  value="' . $value["id"] . '">' . $value["nombre"] . ' </option>';
                                                                }
                                                                ?>

                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6">
                                                    <div class="d-block bg-primary text-center"
                                                         style="background-color:#3c8dbc;font-size:15px;">Medios de Pago
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="input-group" style="display:block;">
                                                            <select name="nuevoMedioPago" id="nuevoMedioPago"
                                                                    class="form-control">
                                                                <option value="">Seleccionar medio de pago</option>

                                                                <?php
                                                                $item = null;
                                                                $valor = null;

                                                                $medios = ControladorMediosPago::ctrMostrarMedios($item, $valor);

                                                                foreach ($medios as $key => $value) {
                                                                    echo '<option  value="' . $value["id"] . '">' . $value["medio_pago"] . ' </option>';
                                                                }
                                                                ?>

                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="box box-warning">
                                        <div class="box-body">
                                            <h3 class="box-title" style="font-weight:bold; font-size:20px;">
                                                Observaciones</h3>
                                            <textarea name="nuevaObservacion" id="nuevaObservacion" cols="60"
                                                      rows="6"></textarea>
                                            <input type="hidden" id="listaProductos" name="listaProductos">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-xs-12 ">

                            <div class="box box-success">
                                <div class="box-header with-border"></div>
                                <div class="box-body">
                                    <h2 class="box-title text-center" style="font-weight:bold; font-size:20px;">
                                        Productos para Seleccionar
                                    </h2>
                                    <table class="table table-bordered table-striped dt-responsive tablaCompras">
                                        <thead>
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Imagen</th>
                                            <th>Código</th>
                                            <th>Nombre</th>
                                            <th>Acciones</th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>

            <a href="compras">
                <button type="button" class="btn btn-default">Salir</button>
            </a>
            <button type="submit" class="btn btn-primary">Guardar Compra</button>
            </form>

            <?php
            $agregarCompra = new ControladorCompra();
            $agregarCompra->ctrCrearCompra();
            ?>

        </div>
</div>

<div id="modalVerOrdenCompra" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form role="form" method="post" id="form_editar_plantel">

                <!--=====================================
                    CABEZA DEL MODAL
                    ======================================-->

                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <button type="button" class="close" data-dismiss="modal">&times;
                    </button>
                    <h2 class="modal-title">Órdenes de Compra</h2>
                </div>

                <!--=====================================
                    CUERPO DEL MODAL
                    ======================================-->

                <div class="modal-body">
                    <table class="table table-bordered table-striped dt-responsive tablas"
                           width="100%">
                        <thead>
                        <tr>
                            <th style="width:10px">#</th>
                            <th>Folio</th>
                            <th>Proveedor</th>
                            <th>Fecha Emisión</th>
                            <th>Total Final</th>
                            <th>Observación</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php
                        $item = null;
                        $valor = null;

                        $ordenCompra = ControladorOrdenCompra::ctrMostrarOrdenCompra($item, $valor);
                        $proveedores = ControladorProveedores::ctrMostrarProveedores($item, $valor);

                        foreach ($ordenCompra as $key => $value) {
                            for ($i = 0; $i < count($proveedores); ++$i) {
                                if ($proveedores[$i]["id"] == $value["id_proveedor"]) {
                                    $proveedor = $proveedores[$i]["razon_social"];
                                }
                            }

                            echo '<tr>

                                    <td>' . ($key + 1) . '</td>

                                    <td>' . $value["codigo"] . '</td>

                                    <td>' . $proveedor . '</td>

                                    <td>' . $value["fecha_emision"] . '</td>

                                    <td>' . $value["total_final"] . '</td>

                                    <td>' . $value["observacion"] . '</td>

                                </tr>';
                        }
                        ?>

                        </tbody>
                    </table>
                </div>

                <!--=====================================
                    PIE DEL MODAL
                    ======================================-->

                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left"
                            data-dismiss="modal">Salir
                    </button>
                    <button type="submit" class="btn btn-primary">Guardar cambios
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="modalVerOrdenVestuario" class="modal fade" role="dialog">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">
            <form role="form" method="post" id="form_editar_plantel">

                <!--=====================================
                    CABEZA DEL MODAL
                    ======================================-->

                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h2 class="modal-title">Órdenes de Vestuario</h2>
                </div>

                <!--=====================================
                    CUERPO DEL MODAL
                    ======================================-->

                <div class="modal-body">
                    <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
                        <thead>
                        <tr>
                            <th style="width:10px">#</th>
                            <th>Folio</th>
                            <th>Nombre</th>
                            <th>Fecha Emisión</th>
                            <th>Observación</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php
                        $item = null;
                        $valor = null;

                        $vestuarios = ControladorOrdenVestuario::ctrMostrarOrdenVestuario($item, $valor);

                        foreach ($vestuarios as $key => $value) {

                            echo '<tr>

                                    <td>' . ($key + 1) . '</td>

                                    <td>' . $value["folio"] . '</td>

                                    <td>' . $value["nombre_orden"] . '</td>

                                    <td>' . $value["fecha_emision"] . '</td>

                                    <td>' . $value["observacion"] . '</td>

                                    <td> <button type="button" class="btn btn-warning">TRAER</button> </td>

                                </tr>';
                        }
                        ?>

                        </tbody>
                    </table>
                </div>

                <!--=====================================
                    PIE DEL MODAL
                    ======================================-->

                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                </div>

            </form>
        </div>
    </div>
</div>

<style>
    .error {
        color: red;
    }

    textarea {
        resize: none;
    }

    input[type=number] {
        -moz-appearance: textfield;
    }
</style>
