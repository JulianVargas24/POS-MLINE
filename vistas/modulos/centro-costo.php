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

            Administrar centro de costos

        </h1>

        <ol class="breadcrumb">

            <li><a href="inicio"><i class="fa fa-home"></i>Inicio</a></li>
            <li>Adquisiciones</li>
            <li class="active">Centro de costos</li>

        </ol>

    </section>

    <section class="content">

        <div class="box">

            <div class="box-header with-border">

                <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCentro">
                    <i class="fa fa-plus-circle fa-lg" style="margin-right: 5px;"></i>
                    Agregar centro de costos
                </button>

            </div>

            <div class="box-body">

                <table class="table table-bordered table-striped dt-responsive tablas" width="100%">

                    <thead>

                        <tr>

                            <th style="width:10px">#</th>
                            <th>Centro de costos</th>
                            <th>Código</th>


                        </tr>

                    </thead>

                    <tbody>

                        <?php

                        $item = null;
                        $valor = null;

                        $centros = ControladorCentros::ctrMostrarCentros($item, $valor);

                        foreach ($centros as $key => $value) {


                            echo '<tr>

                                  <td>' . ($key + 1) . '</td>

                                  <td>' . $value["centro"] . '</td>

                                  <td>' . $value["codigo"] . '</td>


                                  <td>

                                    <div class="btn-group">
                          
                                      <button class="btn btn-warning btnEditarCentro" data-toggle="modal" data-target="#modalEditarCentro" idCentro="' . $value["id"] . '"><i class="fa fa-pencil"></i></button>';

                            if ($_SESSION["perfil"] == "Administrador") {

                                echo '<button class="btn btn-danger btnEliminarCentro" idCentro="' . $value["id"] . '"><i class="fa fa-times"></i></button>';
                            }

                            echo '</div>  

                                  </td>

                                  </tr>';
                        }


                        ?>

                    </tbody>

                </table>

            </div>

        </div>

    </section>

</div>

<!--=====================================
    MODAL AGREGAR CENTRO
    ======================================-->
<div id="modalAgregarCentro" class="modal fade" role="dialog">

    <style>
        .error {
            color: red;

        }
    </style>
    <div class="modal-dialog">

        <div class="modal-content">

            <form role="form" method="post" id="form_nuevo_centro">

                <!--=====================================
                    CABEZA DEL MODAL
                    ======================================-->

                <div class="modal-header" style="background:#3f668d; color:white">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title">Agregar centro de costos</h4>

                </div>

                <!--=====================================
                    CUERPO DEL MODAL
                    ======================================-->

                <div class="modal-body">

                    <div class="box-body">

                        <!-- ENTRADA PARA EL NOMBRE -->

                        <div class="form-group">

                            <div class="d-inline-block bg-primary"
                                style="background-color:#3c8dbc;font-size:16px;font-weight:bold;text-indent:11px">Centro de costos
                            </div>
                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                                <input type="text" class="form-control input" name="nuevoCentro" id="nuevoCentro"
                                    placeholder="Ingresar centro" required>

                            </div>
                        </div>

                        <div class="form-group">

                            <div class="d-inline-block bg-primary"
                                style="background-color:#3c8dbc;font-size:16px;font-weight:bold;text-indent:11px">Código de centro
                            </div>
                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                                <input type="number" class="form-control input" name="nuevoCodigoCentro"
                                    id="nuevoCodigoCentro" min="1" placeholder="Ingresar código de centro" required>

                            </div>
                        </div>


                    </div>

                </div>

                <!--=====================================
                    PIE DEL MODAL
                    ======================================-->

                <div class="modal-footer">

                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

                    <button type="submit" class="btn btn-primary" name="crear_centro">Agregar centro</button>

                </div>

                <?php

                $crearCentro = new ControladorCentros();
                $crearCentro->ctrCrearCentro();

                ?>

            </form>

        </div>

    </div>

</div>

<!--=====================================
    MODAL EDITAR PROVEEDOR
    ======================================-->

<div id="modalEditarCentro" class="modal fade" role="dialog">

    <div class="modal-dialog">

        <div class="modal-content">

            <form role="form" method="post" id="form_editar_centro">

                <!--=====================================
                    CABEZA DEL MODAL
                    ======================================-->

                <div class="modal-header" style="background:#3c8dbc; color:white">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title">Editar centro de costos</h4>

                </div>

                <!--=====================================
                    CUERPO DEL MODAL
                    ======================================-->

                <div class="modal-body">

                    <div class="box-body">

                        <!-- ENTRADA PARA EL NOMBRE -->

                        <div class="form-group">

                            <div class="d-inline-block bg-primary"
                                style="background-color:#3c8dbc;font-size:16px;font-weight:bold;text-indent:11px">Centro de costos
                            </div>
                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                                <input type="text" class="form-control input" id="editarCentro" name="editarCentro"
                                    required>
                                <input type="hidden" id="idCentro" name="idCentro" required>
                            </div>
                        </div>

                        <div class="form-group">

                            <div class="d-inline-block bg-primary"
                                style="background-color:#3c8dbc;font-size:16px;font-weight:bold;text-indent:11px">Código de centro
                            </div>
                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                                <input type="number" class="form-control input" id="editarCodigoCentro"
                                    name="editarCodigoCentro" min="1" required>

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

                $editarCentro = new ControladorCentros();
                $editarCentro->ctrEditarCentro();

                ?>

            </form>
        </div>
    </div>
</div>

<?php

$eliminarCentro = new ControladorCentros();
$eliminarCentro->ctrEliminarCentro();

?>