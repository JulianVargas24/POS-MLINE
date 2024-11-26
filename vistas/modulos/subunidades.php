<?php

if ($_SESSION["perfil"] == "Vendedor") {

    echo '<script>

    window.location = "inicio";

  </script>';

    return;

}

?>

    <div class="content-wrapper">

        <section class="content-header">

            <h1>

                Administrar subunidades de medida

            </h1>

            <ol class="breadcrumb">

                <li><a href="inicio"><i class="fa fa-home"></i>Inicio</a></li>

                <li>Maestro</li>

                <li class="active">Subunidades de medida</li>

            </ol>

        </section>

        <section class="content">

            <div class="box">

                <div class="box-header with-border">

                    <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarSubunidad">

                        Agregar subunidad
                    <script> $(document).on("click", '[data-target="#modalAgregarSubunidad"]', function () {
                        console.log("Botón clicado: Agregar Subunidad");

                        $(document).on("click", '[data-target="#modalAgregarSubunidad"]', function () {
                                console.log("Forzando apertura del modal.");
                                $('#modalAgregarSubunidad').modal('show');
                            });
                        });</script>
                    </button>

                </div>

                <div class="box-body">

                    <table class="table table-bordered table-striped dt-responsive tablas" width="100%">

                        <thead>

                        <tr>

                            <th style="width:10px">#</th>
                            <th>Subunidad</th>
                            <th>Unidad</th>
                            <th>Acciones</th>

                        </tr>

                        </thead>

                        <tbody>

                        <?php
                        /*
                        $item = null;
                        $valor = null;

                        $subunidades = ControladorSubunidades::ctrMostrarSubunidades($item, $valor);
                        $unidades = ControladorUnidades::ctrMostrarUnidades($item, $valor);

                        foreach ($subunidades as $key => $value) {
                            for ($i = 0; $i < count($unidades); ++$i) {
                                if ($unidades[$i]["id"] == $value["id_unidad"]) {
                                    $unidad = $unidades[$i]["unidad"];
                                }
                            }


                            echo ' <tr>

                    <td>' . ($key + 1) . '</td>

                    <td>' . $value["subunidad"] . '</td>
                    <td>' . $unidad . '</td>
                    <td>

                      <div class="btn-group">
                          
                        <button class="btn btn-warning btnEditarSubunidad" id_subunidad="' . $value["id"] . '" data-toggle="modal" data-target="#modalEditarSubunidad"><i class="fa fa-pencil"></i></button>';

                            if ($_SESSION["perfil"] == "Administrador") {

                                echo '<button class="btn btn-danger btnEliminarSubunidad" id_subunidad="' . $value["id"] . '"><i class="fa fa-times"></i></button>';

                            }

                            echo '</div>  

                    </td>

                  </tr>';
                        }
                        */
                        ?>
                        </tbody>

                    </table>

                </div>

            </div>

        </section>

    </div>


    <!--=====================================
    MODAL AGREGAR SUBUNIDAD
    ======================================-->

    <div id="modalAgregarSubunidad" class="modal fade" role="dialog">

        <style>
            .error {
                color: red;

            }
        </style>
        <div class="modal-dialog">

            <div class="modal-content">

                <form role="form" method="post" id="form_nueva_subunidad">

                    <!--=====================================
                    CABEZA DEL MODAL
                    ======================================-->

                    <div class="modal-header" style="background:#3f668d; color:white">

                        <button type="button" class="close" data-dismiss="modal">&times;</button>

                        <h4 class="modal-title">Agregar subunidad</h4>

                    </div>

                    <!--=====================================
                    CUERPO DEL MODAL
                    ======================================-->

                    <div class="modal-body">

                        <div class="box-body">

                            <!-- ENTRADA PARA EL NOMBRE -->

                            <div class="form-group row">
                                <div class="col-xs-6">
                                    <div class="d-inline-block bg-primary"
                                         style="background-color:#3c8dbc;font-size:16px;font-weight:bold;text-indent:11px">
                                        Unidad
                                    </div>
                                    <div class="input-group">

                                        <span class="input-group-addon"><i class="fa fa-th"></i></span>

                                        <select class="form-control input" id="nuevaUnidad" name="nuevaUnidad"
                                                required>

                                            <option value="">Seleccionar unidad</option>

                                            <?php

                                            $item = null;
                                            $valor = null;

                                            $unidades = ControladorUnidades::ctrMostrarUnidades($item, $valor);

                                            foreach ($unidades as $key => $value) {

                                                echo '<option value="' . $value["id"] . '">' . $value["unidad"] . '</option>';
                                            }

                                            ?>

                                        </select>

                                    </div>
                                </div>

                                <div class="col-xs-6">
                                    <div class="d-inline-block bg-primary"
                                         style="background-color:#3c8dbc;font-size:16px;font-weight:bold;text-indent:11px">
                                        Subcunidad
                                    </div>
                                    <div class="input-group">

                                        <span class="input-group-addon"><i class="fa fa-th"></i></span>

                                        <input type="text" class="form-control input" name="nuevaSubunidad"
                                               id="nuevaSubunidad" placeholder="Ingresar subunidad" required>

                                    </div>
                                </div>
                            </div>


                        </div>

                    </div>

                    <!--=====================================
                    PIE DEL MODAL
                    ======================================-->

                    <div class="modal-footer">

                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

                        <button type="submit" class="btn btn-primary" name="crear_subunidad">Guardar subunidad
                        </button>

                    </div>

                    <?php

                    $crearSubunidad = new ControladorSubunidades();
                    $crearSubunidad->ctrCrearSubunidad();

                    ?>

                </form>

            </div>

        </div>

    </div>

    <!--=====================================
    MODAL EDITAR SUBUNIDAD
    ======================================-->

    <div id="modalEditarSubunidad" class="modal fade" role="dialog">

        <div class="modal-dialog">

            <div class="modal-content">

                <form role="form" method="post" id="form_editar_subunidad">

                    <!--=====================================
                    CABEZA DEL MODAL
                    ======================================-->

                    <div class="modal-header" style="background:#3c8dbc; color:white">

                        <button type="button" class="close" data-dismiss="modal">&times;</button>

                        <h4 class="modal-title">Editar subunidad</h4>

                    </div>

                    <!--=====================================
                    CUERPO DEL MODAL
                    ======================================-->

                    <div class="modal-body">

                        <div class="box-body">

                            <!-- ENTRADA PARA EL NOMBRE -->

                            <div class="form-group">
                                <div class="d-inline-block bg-primary"
                                     style="background-color:#3c8dbc;font-size:16px;font-weight:bold;text-indent:11px">
                                    Subunidad
                                </div>
                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-th"></i></span>

                                    <input type="text" class="form-control input" name="editarSubunidad"
                                           id="editarSubunidad" required>

                                    <input type="hidden" name="id_subunidad" id="id_subunidad" required>

                                </div>

                            </div>

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

                    $editarSubunidad = new ControladorSubunidades();
                    $editarSubunidad->ctrEditarSubunidad();

                    ?>

                </form>

            </div>

        </div>

    </div>

<?php

$borrarSubunidad = new ControladorSubunidades();
$borrarSubunidad->ctrBorrarSubunidad();

?>