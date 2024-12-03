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

        <h1>

            Administrar Entradas
        </h1>

        <ol class="breadcrumb">

            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

            <li class="active">Administrar Entradas</li>

        </ol>

    </section>

    <section class="content">

        <div class="box">

            <div class="box-header with-border">

                <a href="entradas">

                    <button class="btn btn-primary">
                        <i class="fa fa-plus-circle fa-lg" style="margin-right: 5px;"></i>
                        Crear entrada
                    </button>

                </a>


            </div>


            <div class="box-body">


                <table class="table table-bordered table-striped dt-responsive tablas" width="100%">

                    <thead>

                        <tr>
                            <th>Folio</th>
                            <th>Movimiento</th>
                            <th>Emision</th>
                            <th>Bodega Destino</th>
                            <th>Origen</th>
                            <th>Observaciones</th>
                            <th>Acciones</th> <!-- Apartado de Acciones para la tabla -->
                        </tr>

                    </thead>

                    <tbody>

                        <?php

                        $item = null;
                        $valor = null;

                        $entradas = ControladorEntradasInventario::ctrMostrarEntradas($item, $valor);
                        $bodegas = ControladorBodegas::ctrMostrarBodegas($item, $valor);
                        $plantel = ControladorPlantel::ctrMostrarPlantel($item, $valor);

                        foreach ($entradas as $key => $value) {
                            for ($i = 0; $i < count($bodegas); ++$i) {
                                if ($bodegas[$i]["id"] == $value["id_bodega_destino"]) {
                                    $bodega = $bodegas[$i]["nombre"];
                                }
                            }
                            if ($value["tipo_entrada"] == "Bodega a Bodega") {
                                for ($i = 0; $i < count($bodegas); ++$i) {
                                    if ($bodegas[$i]["id"] == $value["valor_tipo_entrada"]) {
                                        $origen = $bodegas[$i]["nombre"];
                                    }
                                }
                            } else if ($value["tipo_entrada"] == "Ingreso Manual a Bodega") {
                                for ($i = 0; $i < count($plantel); ++$i) {
                                    if ($plantel[$i]["id"] == $value["valor_tipo_entrada"]) {
                                        $origen = $plantel[$i]["nombre"];
                                    }
                                }
                            }


                            echo '<tr>


                    <td>' . $value["codigo"] . '</td>

                    <td style="font-weight:bold;font-size:15px;color:black;">' . $value["tipo_entrada"] . '</td>

                    <td>' . $value["fecha_emision"] . '</td>

                    <td>' . $bodega . '</td>
                    
                    <td>' . $origen . '</td>

                    <td>' . $value["observaciones"] . '</td>
                    
                    <td> <!-- Acciones para la tabla -->
                        <div class="btn-group">
                            <button class="btn btn-warning btnEditarEntrada" idEntrada="' . $value["id"] . '" data-toggle="modal" data-target="#modalEditarEntrada"><i class="fa fa-pencil"></i></button>
                                
                            <button class="btn btn-danger btnEliminarEntrada" idEntrada="' . $value["id"] . '"><i class="fa fa-times"></i></button>
                        </div>
                    </td> <!-- Valores de Acciones para la tabla -->
                    
                  </tr>';
                        }

                        ?>

                    </tbody>

                </table>


            </div>

        </div>

    </section>

    <!--=====================================
    MODAL EDITAR ENTRADA
    ======================================-->

    <div id="modalEditarEntrada" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form role="form" method="post" id="form_editar_Entrada">
                    <!--=====================================
                    CABEZA DEL MODAL
                    ======================================-->
                    <div class="modal-header" style="background:#FFA500; color:white">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Editar Entrada</h4>
                    </div>

                    <!--=====================================
                    CUERPO DEL MODAL
                    ======================================-->
                    <div class="modal-body">
                        <div class="box-body">

                            <!-- TIPO DE ENTRADA -->
                            <div class="form-group">
                                <label for="editarTipoEntrada">Tipo de Entrada / Movimiento</label>
                                <div class="input-group">
                                    <select class="form-control input" id="editarTipoEntrada" name="editarTipoEntrada" readonly="true">
                                        <option value="">Seleccionar Tipo Entrada</option>
                                        <?php
                                        $tiposEntrada = ControladorEntradasInventario::ctrMostrarTiposEntradaUnicos();
                                        foreach ($tiposEntrada as $tipo) {
                                            echo '<option value="' . $tipo["tipo_entrada"] . '">' . $tipo["tipo_entrada"] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <!-- FECHA DE EMISIÓN -->
                            <div class="form-group">
                                <label for="editarFechaEmision">Fecha de Emisión</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <input type="date" class="form-control" id="editarFechaEmision"
                                        name="editarFechaEmision" required>
                                </div>
                            </div>
                            <!-- ORIGEN / INGRESADO POR -->
                            <div class="form-group">
                                <label for="editarValorTipoEntrada">Origen / Ingresado por</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-check"></i></span>
                                    <select class="form-control" id="editarValorTipoEntrada" name="editarValorTipoEntrada"
                                        required>
                                        <option value="">Seleccionar Bodega</option>
                                        <!-- Opciones dinámicas de Plantel -->
                                        <?php
                                        $plantel = ControladorPlantel::ctrMostrarPlantel(null, null);
                                        foreach ($plantel as $key => $value) {
                                            echo '<option value="' . $value["id"] . '">' . $value["nombre"] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <!-- BODEGA DESTINO -->
                            <div class="form-group">
                                <label for="editarBodegaDestino">Bodega Destino</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-check"></i></span>
                                    <select class="form-control" id="editarBodegaDestino" name="editarBodegaDestino"
                                        required>
                                        <option value="">Seleccionar Bodega</option>
                                        <!-- Opciones dinámicas de bodega -->
                                        <?php
                                        $bodegas = ControladorBodegas::ctrMostrarBodegas(null, null);
                                        foreach ($bodegas as $key => $value) {
                                            echo '<option value="' . $value["id"] . '">' . $value["nombre"] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <!-- OBSERVACIONES -->
                            <div class="form-group">
                                <label for="editarObservaciones">Observaciones</label>
                                <textarea class="form-control" id="editarObservaciones" name="editarObservaciones"
                                    rows="3"></textarea>
                            </div>

                            <!-- CAMPO OCULTO PARA ID DE LA ENTRADA -->
                            <input type="hidden" id="idEntradaEditar" name="idEntradaEditar">
                        </div>
                    </div>

                    <!--=====================================
                    PIE DEL MODAL
                    ======================================-->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    </div>
                    <?php


                    $editarEntrada = new ControladorEntradasInventario();
                    $editarEntrada->ctrEditarEntrada();


                    ?>
                </form>
            </div>
        </div>
    </div>


</div>


<?php

$eliminarEntrada = new ControladorEntradasInventario();
$eliminarEntrada->ctrEliminarEntrada();

?>