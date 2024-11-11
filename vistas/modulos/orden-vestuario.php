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

            CREAR ORDEN DE VESTUARIO

        </h1>

        <ol class="breadcrumb">

            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>

            <li class="active">Crear orden de vestuario</li>

        </ol>

    </section>

    <section class="content">
        <div class="box">
            <div class="box-body">
                <form role="form" method="post" class="formularioOrdenVestuario">
                    <!--=====================================
                FECHAS Y TIPO DE DOCUMENTO
                    ======================================-->

                    <div class="row">


                        <div class="col-xs-5">
                            <div class="box box-info">
                                <div class="box-body">
                                    <h4 class="box-title" style="font-weight:bold; font-size:20px;">Cliente asociado</h4>
                                    <div class="row" style="margin-bottom:5px;">
                                        <div class="col-xs-12">

                                            <div class="form-group">
                                                <div class="input-group" style="display:block;">
                                                    <select class="form-control" id="nuevoCliente" name="nuevoCliente" required>

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
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input type="hidden" id="traerId">
                                                    <span class="input-group-addon"> <i class="fa fa-address-card"></i> RUT</span>
                                                    <input type="text" class="form-control" id="traerRut" value="" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-6">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon">Dirección</span>
                                                    <input type="text" class="form-control" id="traerDireccion" value="" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-6">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon">Actividad</span>
                                                    <input type="text" class="form-control" id="traerActividad" value="" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-6">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon">Ejecutivo</span>
                                                    <input type="text" class="form-control" id="traerEjecutivo" value="" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-6">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon">Teléfono</span>
                                                    <input type="text" class="form-control" id="traerTelefono" value="" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-6">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon"> <i class="fa fa-at"></i> Correo</span>
                                                    <input type="text" class="form-control" id="traerEmail" value="" readonly>
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
                                    <h4 class="box-title" style="font-weight:bold; font-size:20px;">Datos de orden</h4>
                                    <div class="row" style="margin-bottom:5px;">
                                        <div class="col-xs-6">
                                            <div class="d-block" style="font-size:14px;">Fecha emisión</div>
                                            <div class="form-group">
                                                <div class="input-group">

                                                    <input type="date" class="form-control input-sm" name="nuevaFechaEmision" id="nuevaFechaEmision"
                                                        onchange="validarFechas(this.id, 'nuevaFechaVencimiento')">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-xs-6">
                                            <div class="d-block" style="font-size:14px;">Fecha vencimiento</div>
                                            <div class="form-group">
                                                <div class="input-group">

                                                    <input type="date" class="form-control input-sm" name="nuevaFechaVencimiento" id="nuevaFechaVencimiento"
                                                        onchange="validarFechas('nuevaFechaEmision', this.id)">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xs-6">
                                            <div class="d-block" style="font-size:14px;">Centro de costo</div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <select class="form-control input" id="nuevoCentro" name="nuevoCentro" required>

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
                                            <div class="d-block" style="font-size:14px;">Bodega destino</div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <select class="form-control input" id="nuevaBodega" name="nuevaBodega" required>

                                                        <option value="">Seleccionar Bodega</option>

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
                                <?php
                                $tabla = "orden_vestuario";
                                $atributo = "orden_vestuario";
                                $folio = ModeloParametrosDocumentos::mdlMostrarFolio($tabla, $atributo);
                                ?>
                                <div class="box-body">
                                    <h4 class="box-title" style="color:#39b616;font-weight:bold; font-size:21px;"> ORDEN DE VESTUARIO</h4>
                                    <div class="row" style="margin-top:5px;">
                                        <div class="col-xs-7">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon" style="background-color:red; color:white; font-weight:bold">FOLIO</span>
                                                    <input type="text" style="font-weight:bold; font-size:16px;" class="form-control" name="nuevoCodigo" id="nuevoCodigo" value="<?php echo $folio + 1; ?>" readonly required>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <h4 class="box-title" style="color:#39b616;font-weight:bold; font-size:21px;">NOMBRE DE ORDEN</h4>
                                    <div class="row" style="margin-top:5px;">
                                        <div class="col-xs-10">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-file"></i></span>
                                                    <input type="text" style="font-weight:bold; font-size:16px;" class="form-control" name="nuevoNombreOrden" id="nuevoNombreOrden" required>
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
                                    <div class="row nuevoPersonal">
                                        <h4 class="box-title text-center" style="font-weight:bold; font-size:20px;">Personal</h4>
                                        <div class="row" style="padding:5px 15px">
                                            <div class="col-xs-2">
                                                <h4 class="box-title text-center" style="font-weight:bold; font-size:18px;">Nombre</h4>
                                            </div>
                                            <div class="col-xs-2">
                                                <h4 class="box-title text-center" style="font-weight:bold; font-size:18px;">RUT</h4>
                                            </div>
                                            <div class="col-xs-2">
                                                <h4 class="box-title text-center" style="font-weight:bold; font-size:18px;">Empresa</h4>
                                            </div>
                                            <div class="col-xs-2">
                                                <h4 class="box-title text-center" style="font-weight:bold; font-size:18px;">Medidas</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                        </div>



                        <div class="col-lg-4 col-xs-12 ">

                            <div class="box box-success">
                                <div class="box-header with-border"></div>
                                <div class="box-body">
                                    <h4 class="box-title text-center" style="font-weight:bold; font-size:20px;"> Personal para seleccionar</h4>
                                    <table class="table table-bordered table-striped dt-responsive tablaPersonal">
                                        <thead>
                                            <tr>
                                                <th style="width: 10px">#</th>
                                                <th>Nombre</th>
                                                <th>RUT</th>
                                                <th>Empresa</th>
                                                <th>Medidas</th>
                                            </tr>

                                        </thead>

                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="box box-warning">
                            <div class="box-body">
                                <h4 class="box-title" style="font-weight:bold; font-size:20px;">Observaciones</h4>
                                <input type="hidden" name="listaPersonal" id="listaPersonal">
                                <textarea name="nuevaObservacion" id="nuevaObservacion" cols="60" rows="6"></textarea>
                                <h4>Subir Archivo</h4>
                                <input type="file" multiple>
                            </div>
                        </div>
                    </div>
            </div>



            <a href="orden-trabajo">
                <button type="button" class="btn btn-default">Salir</button>
            </a>
            <button type="submit" class="btn btn-primary">Guardar orden</button>
            </form>
            <?php

            $agregarOrdenVestuario = new ControladorOrdenVestuario();
            $agregarOrdenVestuario->ctrCrearOrdenVestuario();

            ?>
        </div>
</div>
</section>

</div>

<style>
    .error {
        color: red;

    }

    input[type=number] {
        -moz-appearance: textfield;
    }
</style>


<div id="modalVerMedidas" class="modal fade" role="dialog">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <form role="form" method="post" id="form_nuevo_personal" enctype="multipart/form-data">

                <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

                <div class="modal-header text-center" style="background:#FFA500; color:white">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title">Editar Medidas</h4>

                </div>

                <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

                <div class="modal-body">

                    <div class="box-body">

                        <!-- ENTRADA PARA LOS DATOS PERSONAL -->
                        <h4 class="box-title" style="font-weight:bold;margin:auto;margin-bottom:4px;">Datos Personal</h4>
                        <div class="box box-info">
                            <div class="box-body">
                                <div class="form-group row">
                                    <div class="col-lg-4 col-xs-6">
                                        <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold;margin-top:15px;">Nombre</div>
                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>

                                            <input type="hidden" name="idPersonal" id="idPersonal">
                                            <input type="text" class="form-control input" name="editarPersonal" id="editarPersonal" readonly>

                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-xs-6">
                                        <div class="d-inline-block  text-center" style="font-size:16px;font-weight:bold;margin-top:15px;">RUT</div>
                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-th"></i></span>

                                            <input type="text" class="form-control input" name="editarRutId" id="editarRutId" readonly>

                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-xs-6">
                                        <div class="d-block text-center" style="font-size:16px;font-weight:bold;margin-top:15px;">Empresa</div>
                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-phone"></i></span>

                                            <select class="form-control input" id="editarEmpresa" name="editarEmpresa" readonly>

                                                <option value="">Seleccionar Empresa</option>

                                                <?php

                                                $item = null;
                                                $valor = null;

                                                $clientes = ControladorClientes::ctrMostrarClientes($item, $valor);

                                                foreach ($clientes as $key => $value) {
                                                    echo '<option  value="' . $value["id"] . '">' . $value["nombre"] . ' </option>';
                                                }

                                                ?>

                                            </select>

                                        </div>
                                    </div>
                                    <!-- ENTRADA PARA LA SUBCATEGORIA -->
                                    <div class="col-lg-4 col-xs-6">
                                        <div class="d-block text-center" style="font-size:16px;font-weight:bold;margin-top:15px;">Fono</div>
                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-phone"></i></span>

                                            <input type="tel" class="form-control input" name="editarTelefono" id="editarTelefono" readonly>

                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-xs-6">
                                        <div class="d-block text-center" style="font-size:16px;font-weight:bold;margin-top:15px;">Email</div>
                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>

                                            <input type="text" class="form-control input" name="editarEmail" id="editarEmail" readonly>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <h4 class="box-title text-center" style="font-weight:bold; font-size:20px;">Medidas Superiores</h4>
                            <div class="box box-success">
                                <div class="box-body">
                                    <div class="col-xs-12">

                                        <div class="col-xs-3" style="margin: 8px 0px;">
                                            <div class="d-block text-center" style="font-size:16px;font-weight:bold">Busto</div>
                                            <div class="input-group">
                                                <input type="number" class="form-control input" name="editarBusto" id="editarBusto" placeholder="Ingresar Talla en Centimetros" min="0" sept="any">
                                            </div>
                                        </div>
                                        <div class="col-xs-3" style="margin: 8px 0px;">
                                            <div class="d-block text-center" style="font-size:16px;font-weight:bold">Cintura</div>
                                            <div class="input-group">
                                                <input type="number" class="form-control input" name="editarCintura" id="editarCintura" placeholder="Ingresar Talla en Centimetros" min="0" sept="any">
                                            </div>
                                        </div>
                                        <div class="col-xs-3" style="margin: 8px 0px;">
                                            <div class="d-block text-center" style="font-size:16px;font-weight:bold">Cadera</div>
                                            <div class="input-group">
                                                <input type="number" class="form-control input" name="editarCadera" id="editarCadera" placeholder="Ingresar Talla en Centimetros" min="0" sept="any">
                                            </div>
                                        </div>
                                        <div class="col-xs-3" style="margin: 8px 0px;">
                                            <div class="d-block text-center" style="font-size:16px;font-weight:bold">Ancho Espalda</div>
                                            <div class="input-group">
                                                <input type="number" class="form-control input" name="editarAnchoEspalda" id="editarAnchoEspalda" placeholder="Ingresar Talla en Centimetros" min="0" sept="any">
                                            </div>
                                        </div>
                                        <div class="col-xs-3" style="margin: 8px 0px;">
                                            <div class="d-block text-center" style="font-size:16px;font-weight:bold">Talle Delantero</div>
                                            <div class="input-group">
                                                <input type="number" class="form-control input" name="editarTalleDelantero" id="editarTalleDelantero" placeholder="Ingresar Talla en Centimetros" min="0" sept="any">
                                            </div>
                                        </div>
                                        <div class="col-xs-3" style="margin: 8px 0px;">
                                            <div class="d-block text-center" style="font-size:16px;font-weight:bold">Talle Espalda</div>
                                            <div class="input-group">
                                                <input type="number" class="form-control input" name="editarTalleEspalda" id="editarTalleEspalda" placeholder="Ingresar Talla en Centimetros" min="0" sept="any">
                                            </div>
                                        </div>
                                        <div class="col-xs-3" style="margin: 8px 0px;">
                                            <div class="d-block text-center" style="font-size:16px;font-weight:bold">Largo Manga</div>
                                            <div class="input-group">
                                                <input type="number" class="form-control input" name="editarLargoManga" id="editarLargoManga" placeholder="Ingresar Talla en Centimetros" min="0" sept="any">
                                            </div>
                                        </div>
                                        <div class="col-xs-3" style="margin: 8px 0px;">
                                            <div class="d-block text-center" style="font-size:16px;font-weight:bold">Largo Blusa</div>
                                            <div class="input-group">
                                                <input type="number" class="form-control input" name="editarLargoBlusa" id="editarLargoBlusa" placeholder="Ingresar Talla en Centimetros" min="0" sept="any">
                                            </div>
                                        </div>
                                        <div class="col-xs-3" style="margin: 8px 0px;">
                                            <div class="d-block text-center" style="font-size:16px;font-weight:bold">Largo Guillete</div>
                                            <div class="input-group">
                                                <input type="number" class="form-control input" name="editarLargoGuillete" id="editarLargoGuillete" placeholder="Ingresar Talla en Centimetros" min="0" sept="any">
                                            </div>
                                        </div>
                                        <div class="col-xs-3" style="margin: 8px 0px;">
                                            <div class="d-block text-center" style="font-size:16px;font-weight:bold">Largo Chaqueta</div>
                                            <div class="input-group">
                                                <input type="number" class="form-control input" name="editarLargoChaqueta" id="editarLargoChaqueta" placeholder="Ingresar Talla en Centimetros" min="0" sept="any">
                                            </div>
                                        </div>
                                        <div class="col-xs-3" style="margin: 8px 0px;">
                                            <div class="d-block text-center" style="font-size:16px;font-weight:bold">Largo Polera</div>
                                            <div class="input-group">
                                                <input type="number" class="form-control input" name="editarLargoPolera" id="editarLargoPolera" placeholder="Ingresar Talla en Centimetros" min="0" sept="any">
                                            </div>
                                        </div>
                                        <div class="col-xs-3" style="margin: 8px 0px;">
                                            <div class="d-block text-center" style="font-size:16px;font-weight:bold">Largo Parka</div>
                                            <div class="input-group">
                                                <input type="number" class="form-control input" name="editarLargoParka" id="editarLargoParka" placeholder="Ingresar Talla en Centimetros" min="0" sept="any">
                                            </div>
                                        </div>
                                        <div class="col-xs-3" style="margin: 8px 0px;">
                                            <div class="d-block text-center" style="font-size:16px;font-weight:bold">Largo Polar</div>
                                            <div class="input-group">
                                                <input type="number" class="form-control input" name="editarLargoPolar" id="editarLargoPolar" placeholder="Ingresar Talla en Centimetros" min="0" sept="any">
                                            </div>
                                        </div>
                                        <div class="col-xs-3" style="margin: 8px 0px;">
                                            <div class="d-block text-center" style="font-size:16px;font-weight:bold">Largo Vestido</div>
                                            <div class="input-group">
                                                <input type="number" class="form-control input" name="editarLargoVestido" id="editarLargoVestido" placeholder="Ingresar Talla en Centimetros" min="0" sept="any">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <h4 class="box-title text-center" style="font-weight:bold; font-size:20px;">Medidas Inferiores</h4>
                            <div class="box box-warning">
                                <div class="box-body">
                                    <div class="col-xs-12">
                                        <div class="col-xs-12">
                                            <h4 style="font-weight:bold;color:green;font-size:24px;">Pantalon</h4>
                                        </div>
                                        <div class="col-xs-3" style="margin: 8px 0px;">
                                            <div class="d-block text-center" style="font-size:16px;font-weight:bold">Cintura</div>
                                            <div class="input-group">
                                                <input type="number" class="form-control input" name="editarCinturaPantalon" id="editarCinturaPantalon" placeholder="Ingresar Talla en Centimetros" min="0" sept="any">
                                            </div>
                                        </div>
                                        <div class="col-xs-3" style="margin: 8px 0px;">
                                            <div class="d-block text-center" style="font-size:16px;font-weight:bold">Cadera</div>
                                            <div class="input-group">
                                                <input type="number" class="form-control input" name="editarCaderaPantalon" id="editarCaderaPantalon" placeholder="Ingresar Talla en Centimetros" min="0" sept="any">
                                            </div>
                                        </div>
                                        <div class="col-xs-3" style="margin: 8px 0px;">
                                            <div class="d-block text-center" style="font-size:16px;font-weight:bold">Tiro</div>
                                            <div class="input-group">
                                                <input type="number" class="form-control input" name="editarTiroPantalon" id="editarTiroPantalon" placeholder="Ingresar Talla en Centimetros" min="0" sept="any">
                                            </div>
                                        </div>
                                        <div class="col-xs-3" style="margin: 8px 0px;">
                                            <div class="d-block text-center" style="font-size:16px;font-weight:bold">Entrepierna</div>
                                            <div class="input-group">
                                                <input type="number" class="form-control input" name="editarEntrepiernaPantalon" id="editarEntrepiernaPantalon" placeholder="Ingresar Talla en Centimetros" min="0" sept="any">
                                            </div>
                                        </div>
                                        <div class="col-xs-3" style="margin: 8px 0px;">
                                            <div class="d-block text-center" style="font-size:16px;font-weight:bold">Contorno Muslo</div>
                                            <div class="input-group">
                                                <input type="number" class="form-control input-sm" name="editarMusloPantalon" id="editarMusloPantalon" placeholder="Ingresar Talla en Centimetros" min="0" sept="any">
                                            </div>
                                        </div>
                                        <div class="col-xs-3" style="margin: 8px 0px;">
                                            <div class="d-block text-center" style="font-size:16px;font-weight:bold">Contorno Rodilla</div>
                                            <div class="input-group">
                                                <input type="number" class="form-control input-sm" name="editarRodillaPantalon" id="editarRodillaPantalon" placeholder="Ingresar Talla en Centimetros" min="0" sept="any">
                                            </div>
                                        </div>
                                        <div class="col-xs-3" style="margin: 8px 0px;">
                                            <div class="d-block text-center" style="font-size:16px;font-weight:bold">Contorno Basta</div>
                                            <div class="input-group">
                                                <input type="number" class="form-control input-sm" name="editarBastaPantalon" id="editarBastaPantalon" placeholder="Ingresar Talla en Centimetros" min="0" sept="any">
                                            </div>
                                        </div>
                                        <div class="col-xs-3" style="margin: 8px 0px;">
                                            <div class="d-block text-center" style="font-size:16px;font-weight:bold">Largo Total</div>
                                            <div class="input-group">
                                                <input type="number" class="form-control input" name="editarLargoPantalon" id="editarLargoPantalon" placeholder="Ingresar Talla en Centimetros" min="0" sept="any">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12">
                                        <div class="col-xs-12">
                                            <h4 style="font-weight:bold;color:green;font-size:24px;">Falda</h4>
                                        </div>
                                        <div class="col-xs-3">
                                            <div class="d-block text-center" style="font-size:16px;font-weight:bold">Cintura</div>
                                            <div class="input-group">
                                                <input type="number" class="form-control input" name="editarCinturaFalda" id="editarCinturaFalda" placeholder="Ingresar Talla en Centimetros" min="0" sept="any">
                                            </div>
                                        </div>
                                        <div class="col-xs-3">
                                            <div class="d-block text-center" style="font-size:16px;font-weight:bold">Cadera</div>
                                            <div class="input-group">
                                                <input type="number" class="form-control input" name="editarCaderaFalda" id="editarCaderaFalda" placeholder="Ingresar Talla en Centimetros" min="0" sept="any">
                                            </div>
                                        </div>
                                        <div class="col-xs-3">
                                            <div class="d-block text-center" style="font-size:16px;font-weight:bold">Largo Total</div>
                                            <div class="input-group">
                                                <input type="number" class="form-control input" name="editarLargoFalda" id="editarLargoFalda" placeholder="Ingresar Talla en Centimetros" min="0" sept="any">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ENTRADA PARA STOCK -->


                        <div class="modal-footer">

                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

                            <button type="submit" class="btn btn-primary text-center">Guardar Cambios</button>

                        </div>
                    </div>

                </div>

            </form>
            <?php
            $editarPersonalOrdenVestuario = new ControladorPersonal();
            $editarPersonalOrdenVestuario->ctrEditarPersonalCrearOrdenVestuario();
            ?>
        </div>

    </div>

</div>