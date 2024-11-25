<div class="content-wrapper">

    <section class="content-header">

        <h1>

            Configuración general

        </h1>

        <ol class="breadcrumb">

            <li><a href="#"><i class="fa fa-home"></i>Inicio</a></li>

            <li>Parámetros</li>

            <li class="active">Generales</li>

        </ol>

    </section>

    <section class="content">
        <div class="box">
            <div class="box-body">
                <form role="form" method="post" class="formularioOrdenCompra">
                    <!--=====================================
                    FECHAS Y TIPO DE DOCUMENTO
                        ======================================-->
                    <div class="row">

                        <div class="col-xs-4">
                            <div class="box box-info">
                                <div class="box-body">
                                    <h4 class="box-title" style="font-weight:bold; font-size:20px;">Parámetros
                                        generales</h4>
                                    <div class="row" style="margin-bottom:5px;">

                                        <div class="col-xs-12">
                                            <div class="d-block" style="font-size:14px;font-weight:bold">% IVA</div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input type="text" class="form-control input-sm"
                                                           name="nuevaFechaVencimiento" id="nuevaFechaVencimiento"
                                                           value="19" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-4">
                                            <div class="d-block" style="font-size:14px;font-weight:bold">Tipo punto de
                                                venta
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">

                                                    <input type="radio" name="1" id="ventaRadio1" value="Fijo">
                                                    <label for="radio1" style="font-weight:normal;margin-right:10px;">Fijo</label>

                                                    <input type="radio" name="1" id="ventaRadio2" value="Meson">
                                                    <label for="radio2" style="font-weight:normal;">Meson</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-4">
                                            <div class="d-block" style="font-size:14px;font-weight:bold">Precios</div>
                                            <div class="form-group">
                                                <div class="input-group">

                                                    <input type="radio" name="preciosRadio" id="preciosRadio1"
                                                           value="Bruto">
                                                    <label for="radio1" style="font-weight:normal;margin-right:10px;">Bruto</label>

                                                    <input type="radio" name="preciosRadio" id="preciosRadio2"
                                                           value="Neto" checked>
                                                    <label for="radio2" style="font-weight:normal;">Neto</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-4">
                                            <div class="d-block" style="font-size:14px;font-weight:bold">Cliente
                                                sistema
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">

                                                    <input type="radio" name="estadoSistemaRadio"
                                                           id="estadoSistemaRadio1" value="Activo" checked>
                                                    <label for="radio1" style="font-weight:normal;margin-right:9px;">Activo</label>

                                                    <input type="radio" name="estadoSistemaRadio"
                                                           id="estadoSistemaRadio2" value="Inactivo">
                                                    <label for="radio2" style="font-weight:normal;">Inactivo</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-4">
                                            <div class="d-block" style="font-size:14px;font-weight:bold"> Cliente
                                                crédito bloqueado
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">

                                                    <input type="radio" name="estadoCreditoRadio"
                                                           id="estadoCreditoRadio1" value="Si">
                                                    <label for="radio1"
                                                           style="font-weight:normal;margin-right:10px;">Sí</label>

                                                    <input type="radio" name="estadoCreditoRadio" checked
                                                           id="estadoCreditoRadio2" value="No">
                                                    <label for="radio2" style="font-weight:normal;">No</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-4">
                                            <div class="d-block" style="font-size:14px;font-weight:bold">Venta sin
                                                stock
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">

                                                    <input type="checkbox" name="venta" id="ventastock" checked>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-4">
                                            <div class="d-block"
                                                 style="font-size:14px;font-weight:bold;">Cargar logo
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">

                                                    <input type="file" name="venta" id="ventastock">
                                                </div>
                                            </div>
                                        </div>


                                    </div>

                                </div>
                            </div>
                        </div>
                        <!--
<div class="col-xs-4">
<div class="box box-info">
<div class="box-body">
<h4 class="box-title" style="font-weight:bold; font-size:20px;">Datos de Facturacion</h4>
    <div class="row" style="margin-bottom:5px;">
        <div class="col-xs-12">
        <textarea name="nuevaObservacion" id="nuevaObservacion" cols="50" rows="6"></textarea>

        </div>


    </div>
</div>
</div>
</div> -->
                        <div class="col-xs-4">
                            <div class="box box-info">
                                <div class="box-body">

                                    <h4 class="box-title" style="font-weight:bold; font-size:20px;">Datos condición de
                                        venta/pago</h4>
                                    <div class="row" style="margin-bottom:5px;">
                                        <div class="col-xs-12">
                                            <textarea name="nuevaCondicionVenta" id="nuevaCondicionVenta" cols="50"
                                                      rows="6">
                                            <?php

                                            $item = null;
                                            $valor = null;

                                            $matrices = ControladorMatrices::ctrMostrarMatrices($item, $valor);

                                            foreach ($matrices as $key => $value) {
                                                $condicion = $value["condicion_venta"];
                                                echo ' ' . $condicion . ' ';
                                            }
                                            ?>
                                            </textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-default" onclick="window.location.href='inicio';">Salir
                    </button>
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                </form>

                <?php

                $editarCondicion = new ControladorMatrices();
                $editarCondicion->ctrEditarCondicionVenta();

                ?>

            </div>
        </div>
    </section>
</div>