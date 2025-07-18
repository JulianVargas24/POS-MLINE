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

            EDITAR ORDEN DE VESTUARIO

        </h1>

        <ol class="breadcrumb">

            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>

            <li class="active">Editar orden</li>

        </ol>

    </section>

    <section class="content">
        <div class="box">
            <div class="box-body">
                <form role="form" method="post" class="formularioOrdenVestuario">
                    <?php

                    $item = "id";
                    $valor = $_GET["idOrdenVestuario"];

                    $ordenVestuario = ControladorOrdenVestuario::ctrMostrarOrdenVestuario($item, $valor);

                    $itemCliente = "id";
                    $valorCliente = $ordenVestuario["id_cliente"];
                    $cliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

                    $itemCentro = "id";
                    $valorCentro = $ordenVestuario["id_centro"];
                    $centro = ControladorCentros::ctrMostrarCentros($itemCentro, $valorCentro);

                    $itemBodega = "id";
                    $valorBodega = $ordenVestuario["id_bodega"];
                    $bodega = ControladorBodegas::ctrMostrarBodegas($itemBodega, $valorBodega);

                    $itemPlazo = "id";
                    $valorPlazo = $ordenVestuario["id_plazo_pago"];
                    $plazo = ControladorPlazos::ctrMostrarPlazos($itemPlazo, $valorPlazo);

                    $itemMedio = "id";
                    $valorMedio = $ordenVestuario["id_medio_pago"];
                    $medio = ControladorMediosPago::ctrMostrarMedios($itemMedio, $valorMedio);


                    // $porcentajeImpuesto =  $venta["impuesto"] * 100 / $venta["neto"];


                    ?>
                    <div class="row">
                        <div class="col-xs-5">
                            <div class="box box-info">
                                <div class="box-body">
                                    <h4 class="box-title" style="font-weight:bold; font-size:20px;">Cliente
                                        asociado</h4>
                                    <div class="row" style="margin-bottom:5px;">
                                        <div class="col-xs-12">

                                            <div class="form-group">
                                                <div class="input-group" style="display:block;">
                                                    <input type="hidden" name="idOrdenVestuario" id="idOrdenVestuario"
                                                           value="<?php echo $ordenVestuario["id"]; ?>">
                                                    <select class="form-control" id="nuevoCliente" name="nuevoCliente"
                                                            required readonly>
                                                        <option value="<?php echo $cliente["id"]; ?>"><?php echo $cliente["nombre"]; ?></option>
                                                        <optgroup label="---Cambiar Proveedor--"></optgroup>

                                                        <?php

                                                        $item = null;
                                                        $valor = null;

                                                        $clientes = ControladorClientes::ctrMostrarClientes($item, $valor);

                                                        foreach ($clientes as $key => $value) {

                                                            echo '<option disabled class="seleccionarCliente" value="' . $value["id"] . '">' . $value["nombre"] . ' </option>';

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
                                                    <input type="text" class="form-control" id="traerRutVestuario"
                                                           value="" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-6">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon">Dirección</span>
                                                    <input type="text" class="form-control" id="traerDireccionVestuario"
                                                           value="" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-6">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon">Actividad</span>
                                                    <input type="text" class="form-control" id="traerActividadVestuario"
                                                           value="" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-6">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon">Ejecutivo</span>
                                                    <input type="text" class="form-control" id="traerEjecutivoVestuario"
                                                           value="" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-6">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon">Teléfono</span>
                                                    <input type="text" class="form-control" id="traerTelefonoVestuario"
                                                           value="" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-6">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon"> <i
                                                                class="fa fa-at"></i> Correo</span>
                                                    <input type="text" class="form-control" id="traerEmailVestuario"
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
                                    <h4 class="box-title" style="font-weight:bold; font-size:20px;">Datos de orden</h4>
                                    <div class="row" style="margin-bottom:5px;">
                                        <div class="col-xs-6">
                                            <div class="d-block" style="font-size:14px;">Fecha emisión</div>
                                            <div class="form-group">
                                                <div class="input-group">

                                                    <input type="date" class="form-control input-sm"
                                                           name="nuevaFechaEmision" id="nuevaFechaEmision" readonly
                                                           value="<?php echo $ordenVestuario["fecha_emision"]; ?>">
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
                                                           value="<?php echo $ordenVestuario["fecha_vencimiento"]; ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xs-6">
                                            <div class="d-block" style="font-size:14px;">Centro de costo</div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <select class="form-control input" id="nuevoCentro"
                                                            name="nuevoCentro" required>
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
                                        </div>
                                        <div class="col-xs-6">
                                            <div class="d-block" style="font-size:14px;">Bodega de destino</div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <select class="form-control input" id="nuevaBodega"
                                                            name="nuevaBodega" required>
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
                            </div>
                        </div>

                        <div class="col-xs-3">
                            <div class="box box-info">
                                <div class="box-body">
                                    <h4 class="box-title"
                                        style="color:#39b616;font-weight:bold; font-size:21px; color:green;"> ORDEN DE
                                        VESTUARIO</h4>
                                    <div class="row" style="margin-top:2px;">
                                        <div class="col-xs-7">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon"
                                                          style="background-color:red; color:white; font-weight:bold">FOLIO</span>
                                                    <input type="text" style="font-weight:bold; font-size:16px;"
                                                           class="form-control" name="nuevoCodigo" id="nuevoCodigo"
                                                           value="<?php echo $ordenVestuario["codigo"]; ?>" readonly
                                                           required>
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
                                        <h4 class="box-title text-center" style="font-weight:bold; font-size:20px;">
                                            Personal</h4>
                                        <div class="row" style="padding:5px 15px">
                                            <div class="col-xs-2">
                                                <h4 class="box-title text-center"
                                                    style="font-weight:bold; font-size:18px;">Nombre</h4>
                                            </div>
                                            <div class="col-xs-2">
                                                <h4 class="box-title text-center"
                                                    style="font-weight:bold; font-size:18px;">RUT</h4>
                                            </div>
                                            <div class="col-xs-2">
                                                <h4 class="box-title text-center"
                                                    style="font-weight:bold; font-size:18px;">Empresa</h4>
                                            </div>
                                            <div class="col-xs-2">
                                                <h4 class="box-title text-center"
                                                    style="font-weight:bold; font-size:18px;">Medidas</h4>
                                            </div>
                                        </div>

                                        <?php

                                        $listaProducto = json_decode($ordenVestuario["personal"], true);

                                        foreach ($listaProducto as $key => $value) {

                                            echo '<div class="row" id="personal' . $value["id"] . '" style="padding:5px 15px">
                                                <div class="col-xs-2" style="padding-right:0px">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">
                                                        <button type="button" class="btn btn-danger btn-xs quitarPersonal" idPersonal="' . $value["id"] . '"><i class="fa fa-times"></i></button>
                                                        </span>
                                                        <input type="text" class="form-control nuevoNombrePersonal" idPersonal="' . $value["id"] . '" name="agregarPersonal" value="' . $value["nombre"] . '" readonly required>
                                                    </div>
                                                </div>
                                                <div class="col-xs-2" style="padding-right:0px">
                                                    <input type="text" class="form-control nuevoRutPersonal" name="nuevoRutPersonal" value="' . $value["rut"] . '" readonly required>
                                                </div>
                                                <div class="col-xs-2" style="padding-right:0px">
                                                    <input type="text"  class="form-control nuevaEmpresaPersonal"   name="nuevaEmpresaPersonal" value="' . $value['empresa'] . '" readonly required>
                                                </div>
                                                <div class="col-xs-2 btngroup" style="padding-right:0px">
                                                <button type="button"  idPersonal="' . $value["id"] . '" data-dismiss="modal" class="btn btn-warning btnEditarMedidasPersonal">Editar</button>
                                                <button type="button" data-toggle="modal" data-target="#modalVerMedidas" idPersonal="' . $value["id"] . '" data-dismiss="modal" class="btn btn-success btnVerPersonal">Ver</button>
                                        </div>
                                                </div>';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>


                        </div>


                        <div class="col-lg-4 col-xs-12 ">

                            <div class="box box-success">
                                <div class="box-header with-border"></div>
                                <div class="box-body">
                                    <h4 class="box-title text-center" style="font-weight:bold; font-size:20px;">
                                        Personal para seleccionar</h4>
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
                                <input name="listaPersonal" id="listaPersonal" type="hidden">
                                <textarea name="nuevaObservacion" id="nuevaObservacion" cols="60"
                                          rows="6"><?php echo $ordenVestuario["observacion"]; ?></textarea>
                                <h4>Subir Archivo</h4>
                                <input type="file" multiple>
                            </div>
                        </div>
                    </div>
            </div>

            <a href="orden-trabajo">
                <button type="button" class="btn btn-default">Salir</button>
            </a>
            <button type="submit" class="btn btn-primary">Editar orden</button>
            </form>
            <?php

            $editarOrdenCompra = new ControladorOrdenCompra();
            $editarOrdenCompra->ctrEditarOrdenCompra();

            ?>
        </div>
</div>
</section>

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

<div id="modalVerMedidas" class="modal fade" role="dialog">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <form role="form" method="post" id="form_nuevo_personal" enctype="multipart/form-data">

                <!--=====================================
                CABEZA DEL MODAL
                ======================================-->

                <div class="modal-header" style="background:#3f668d; color:white">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title">Editar personal</h4>

                </div>

                <!--=====================================
                CUERPO DEL MODAL
                ======================================-->

                <div class="modal-body">

                    <div class="box-body">

                        <!-- ENTRADA PARA LOS DATOS PERSONAL -->
                        <h4 class="box-title" style="font-weight:bold;margin:auto;margin-bottom:4px;">Datos
                            Personal</h4>
                        <div class="box box-info">
                            <div class="box-body">
                                <div class="form-group row">
                                    <div class="col-lg-4 col-xs-6">
                                        <div class="d-inline-block text-center"
                                             style="font-size:16px;font-weight:bold;margin-top:15px;">Nombre
                                        </div>
                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>

                                            <input type="hidden" name="idPersonal" id="idPersonal">
                                            <input type="text" class="form-control input" name="editarPersonal"
                                                   id="editarPersonal" readonly>

                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-xs-6">
                                        <div class="d-inline-block  text-center"
                                             style="font-size:16px;font-weight:bold;margin-top:15px;">RUT
                                        </div>
                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-th"></i></span>

                                            <input type="text" class="form-control input" name="editarRutId"
                                                   id="editarRutId" readonly>

                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-xs-6">
                                        <div class="d-block text-center"
                                             style="font-size:16px;font-weight:bold;margin-top:15px;">Empresa
                                        </div>
                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-phone"></i></span>

                                            <select class="form-control input" id="editarEmpresa" name="editarEmpresa"
                                                    readonly>

                                                <option value="">Seleccionar empresa</option>

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
                                        <div class="d-block text-center"
                                             style="font-size:16px;font-weight:bold;margin-top:15px;">Fono
                                        </div>
                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-phone"></i></span>

                                            <input type="tel" class="form-control input" name="editarTelefono"
                                                   id="editarTelefono" readonly>

                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-xs-6">
                                        <div class="d-block text-center"
                                             style="font-size:16px;font-weight:bold;margin-top:15px;">Email
                                        </div>
                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>

                                            <input type="text" class="form-control input" name="editarEmail"
                                                   id="editarEmail" readonly>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <h4 class="box-title text-center" style="font-weight:bold; font-size:20px;">Medidas
                                superiores</h4>
                            <div class="box box-success">
                                <div class="box-body">
                                    <div class="col-xs-12">

                                        <div class="col-xs-3" style="margin: 8px 0px;">
                                            <div class="d-block text-center" style="font-size:16px;font-weight:bold">
                                                Busto
                                            </div>
                                            <div class="input-group">
                                                <input type="text" class="form-control input" name="editarBusto"
                                                       id="editarBusto" readonly>
                                            </div>
                                        </div>
                                        <div class="col-xs-3" style="margin: 8px 0px;">
                                            <div class="d-block text-center" style="font-size:16px;font-weight:bold">
                                                Cintura
                                            </div>
                                            <div class="input-group">
                                                <input type="text" class="form-control input" name="editarCintura"
                                                       id="editarCintura" placeholder="Ingresar talla en centímetros"
                                                       readonly>
                                            </div>
                                        </div>
                                        <div class="col-xs-3" style="margin: 8px 0px;">
                                            <div class="d-block text-center" style="font-size:16px;font-weight:bold">
                                                Cadera
                                            </div>
                                            <div class="input-group">
                                                <input type="text" class="form-control input" name="editarCadera"
                                                       id="editarCadera" placeholder="Ingresar talla en centímetros"
                                                       readonly>
                                            </div>
                                        </div>
                                        <div class="col-xs-3" style="margin: 8px 0px;">
                                            <div class="d-block text-center" style="font-size:16px;font-weight:bold">
                                                Ancho espalda
                                            </div>
                                            <div class="input-group">
                                                <input type="text" class="form-control input" name="editarAnchoEspalda"
                                                       id="editarAnchoEspalda"
                                                       placeholder="Ingresar talla en centímetros" readonly>
                                            </div>
                                        </div>
                                        <div class="col-xs-3" style="margin: 8px 0px;">
                                            <div class="d-block text-center" style="font-size:16px;font-weight:bold">
                                                Talle delantero
                                            </div>
                                            <div class="input-group">
                                                <input type="text" class="form-control input"
                                                       name="editarTalleDelantero" id="editarTalleDelantero"
                                                       placeholder="Ingresar talla en centímetros" readonly>
                                            </div>
                                        </div>
                                        <div class="col-xs-3" style="margin: 8px 0px;">
                                            <div class="d-block text-center" style="font-size:16px;font-weight:bold">
                                                Talle espalda
                                            </div>
                                            <div class="input-group">
                                                <input type="text" class="form-control input" name="editarTalleEspalda"
                                                       id="editarTalleEspalda"
                                                       placeholder="Ingresar talla en centímetros" readonly>
                                            </div>
                                        </div>
                                        <div class="col-xs-3" style="margin: 8px 0px;">
                                            <div class="d-block text-center" style="font-size:16px;font-weight:bold">
                                                Largo manga
                                            </div>
                                            <div class="input-group">
                                                <input type="text" class="form-control input" name="editarLargoManga"
                                                       id="editarLargoManga" placeholder="Ingresar talla en centímetros"
                                                       readonly>
                                            </div>
                                        </div>
                                        <div class="col-xs-3" style="margin: 8px 0px;">
                                            <div class="d-block text-center" style="font-size:16px;font-weight:bold">
                                                Largo blusa
                                            </div>
                                            <div class="input-group">
                                                <input type="text" class="form-control input" name="editarLargoBlusa"
                                                       id="editarLargoBlusa" placeholder="Ingresar talla en centímetros"
                                                       readonly>
                                            </div>
                                        </div>
                                        <div class="col-xs-3" style="margin: 8px 0px;">
                                            <div class="d-block text-center" style="font-size:16px;font-weight:bold">
                                                Largo guillete
                                            </div>
                                            <div class="input-group">
                                                <input type="text" class="form-control input" name="editarLargoGuillete"
                                                       id="editarLargoGuillete"
                                                       placeholder="Ingresar talla en centímetros" readonly>
                                            </div>
                                        </div>
                                        <div class="col-xs-3" style="margin: 8px 0px;">
                                            <div class="d-block text-center" style="font-size:16px;font-weight:bold">
                                                Largo chaqueta
                                            </div>
                                            <div class="input-group">
                                                <input type="text" class="form-control input" name="editarLargoChaqueta"
                                                       id="editarLargoChaqueta"
                                                       placeholder="Ingresar talla en centímetros" readonly>
                                            </div>
                                        </div>
                                        <div class="col-xs-3" style="margin: 8px 0px;">
                                            <div class="d-block text-center" style="font-size:16px;font-weight:bold">
                                                Largo polera
                                            </div>
                                            <div class="input-group">
                                                <input type="text" class="form-control input" name="editarLargoPolera"
                                                       id="editarLargoPolera"
                                                       placeholder="Ingresar talla en centímetros" readonly>
                                            </div>
                                        </div>
                                        <div class="col-xs-3" style="margin: 8px 0px;">
                                            <div class="d-block text-center" style="font-size:16px;font-weight:bold">
                                                Largo parka
                                            </div>
                                            <div class="input-group">
                                                <input type="text" class="form-control input" name="editarLargoParka"
                                                       id="editarLargoParka" placeholder="Ingresar talla en centímetros"
                                                       readonly>
                                            </div>
                                        </div>
                                        <div class="col-xs-3" style="margin: 8px 0px;">
                                            <div class="d-block text-center" style="font-size:16px;font-weight:bold">
                                                Largo polar
                                            </div>
                                            <div class="input-group">
                                                <input type="text" class="form-control input" name="editarLargoPolar"
                                                       id="editarLargoPolar" placeholder="Ingresar talla en centímetros"
                                                       readonly>
                                            </div>
                                        </div>
                                        <div class="col-xs-3" style="margin: 8px 0px;">
                                            <div class="d-block text-center" style="font-size:16px;font-weight:bold">
                                                Largo vestido
                                            </div>
                                            <div class="input-group">
                                                <input type="text" class="form-control input" name="editarLargoVestido"
                                                       id="editarLargoVestido"
                                                       placeholder="Ingresar talla en centímetros" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <h3 class="box-title text-center" style="font-weight:bold; font-size:20px;">Medidas
                                Inferiores</h3>
                                <div class="box box-warning">
                                    <div class="box-body">
                                        <div class="col-xs-12">
                                            <div class="col-xs-12">
                                                <h4 style="font-weight:bold;color:green;font-size:24px;">Pantalón</h4>
                                            </div>
                                            <div class="col-xs-3" style="margin: 8px 0px;">
                                                <div class="d-block text-center"
                                                     style="font-size:16px;font-weight:bold">Cintura
                                                </div>
                                                <div class="input-group">
                                                    <input type="text" class="form-control input"
                                                           name="editarCinturaPantalon" id="editarCinturaPantalon"
                                                           placeholder="Ingresar talla en centímetros" readonly>
                                                </div>
                                            </div>
                                            <div class="col-xs-3" style="margin: 8px 0px;">
                                                <div class="d-block text-center"
                                                     style="font-size:16px;font-weight:bold">Cadera
                                                </div>
                                                <div class="input-group">
                                                    <input type="text" class="form-control input"
                                                           name="editarCaderaPantalon" id="editarCaderaPantalon"
                                                           placeholder="Ingresar talla en centímetros" readonly>
                                                </div>
                                            </div>
                                            <div class="col-xs-3" style="margin: 8px 0px;">
                                                <div class="d-block text-center"
                                                     style="font-size:16px;font-weight:bold">Tiro
                                                </div>
                                                <div class="input-group">
                                                    <input type="text" class="form-control input"
                                                           name="editarTiroPantalon" id="editarTiroPantalon"
                                                           placeholder="Ingresar talla en centímetros" readonly>
                                                </div>
                                            </div>
                                            <div class="col-xs-3" style="margin: 8px 0px;">
                                                <div class="d-block text-center"
                                                     style="font-size:16px;font-weight:bold">Entrepierna
                                                </div>
                                                <div class="input-group">
                                                    <input type="text" class="form-control input"
                                                           name="editarEntrepiernaPantalon"
                                                           id="editarEntrepiernaPantalon"
                                                           placeholder="Ingresar talla en centímetros" readonly>
                                                </div>
                                            </div>
                                            <div class="col-xs-3" style="margin: 8px 0px;">
                                                <div class="d-block text-center"
                                                     style="font-size:16px;font-weight:bold">Contorno muslo
                                                </div>
                                                <div class="input-group">
                                                    <input type="text" class="form-control input-sm"
                                                           name="editarMusloPantalon" id="editarMusloPantalon"
                                                           placeholder="Ingresar talla en centímetros" readonly>
                                                </div>
                                            </div>
                                            <div class="col-xs-3" style="margin: 8px 0px;">
                                                <div class="d-block text-center"
                                                     style="font-size:16px;font-weight:bold">Contorno rodilla
                                                </div>
                                                <div class="input-group">
                                                    <input type="text" class="form-control input-sm"
                                                           name="editarRodillaPantalon" id="editarRodillaPantalon"
                                                           placeholder="Ingresar talla en centímetros" readonly>
                                                </div>
                                            </div>
                                            <div class="col-xs-3" style="margin: 8px 0px;">
                                                <div class="d-block text-center"
                                                     style="font-size:16px;font-weight:bold">Contorno basta
                                                </div>
                                                <div class="input-group">
                                                    <input type="text" class="form-control input-sm"
                                                           name="editarBastaPantalon" id="editarBastaPantalon"
                                                           placeholder="Ingresar talla en centímetros" readonly>
                                                </div>
                                            </div>
                                            <div class="col-xs-3" style="margin: 8px 0px;">
                                                <div class="d-block text-center"
                                                     style="font-size:16px;font-weight:bold">Largo total
                                                </div>
                                                <div class="input-group">
                                                    <input type="text" class="form-control input"
                                                           name="editarLargoPantalon" id="editarLargoPantalon"
                                                           placeholder="Ingresar talla en centímetros" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12">
                                            <div class="col-xs-12">
                                                <h4 style="font-weight:bold;color:green;font-size:24px;">Falda</h4>
                                            </div>
                                            <div class="col-xs-3">
                                                <div class="d-block text-center"
                                                     style="font-size:16px;font-weight:bold">Cintura
                                                </div>
                                                <div class="input-group">
                                                    <input type="text" class="form-control input"
                                                           name="editarCinturaFalda" id="editarCinturaFalda"
                                                           placeholder="Ingresar talla en centímetros" readonly>
                                                </div>
                                            </div>
                                            <div class="col-xs-3">
                                                <div class="d-block text-center"
                                                     style="font-size:16px;font-weight:bold">Cadera
                                                </div>
                                                <div class="input-group">
                                                    <input type="text" class="form-control input"
                                                           name="editarCaderaFalda" id="editarCaderaFalda"
                                                           placeholder="Ingresar talla en centímetros" readonly>
                                                </div>
                                            </div>
                                            <div class="col-xs-3">
                                                <div class="d-block text-center"
                                                     style="font-size:16px;font-weight:bold">Largo total
                                                </div>
                                                <div class="input-group">
                                                    <input type="text" class="form-control input"
                                                           name="editarLargoFalda" id="editarLargoFalda"
                                                           placeholder="Ingresar talla en centímetros" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <!-- ENTRADA PARA STOCK -->


                        <div class="modal-footer">

                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

                            <button type="submit" class="btn btn-primary text-center">Guardar cambios</button>

                        </div>
                    </div>

                </div>

                <!--=====================================
                PIE DEL MODAL
                ======================================-->


            </form>

        </div>

    </div>

</div>
