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

            Administrar medios de pago

        </h1>

        <ol class="breadcrumb">

            <li><a href="inicio"><i class="fa fa-home"></i>Inicio</a></li>
            <li>Maestro</li>
            <li class="active">Medios de pago</li>

        </ol>

    </section>

    <section class="content">

        <div class="box">

            <div class="box-header with-border">

                <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarMedioPago">
                    <i class="fa fa-plus-circle fa-lg" style="margin-right: 5px;"></i>
                    Agregar medio de pago
                </button>

            </div>

            <div class="box-body">

                <table class="table table-bordered table-striped dt-responsive tablas" width="100%">

                    <thead>

                        <tr>

                            <th style="width:10px">#</th>
                            <th>Medio de pago</th>
                            <th>Acciones</th>


                        </tr>

                    </thead>

                    <tbody>

                        <?php

                        $item = null;
                        $valor = null;

                        $medios = ControladorMediosPago::ctrMostrarMedios($item, $valor);

                        foreach ($medios as $key => $value) {


                            echo '<tr>

                    <td>' . ($key + 1) . '</td>

                    <td>' . $value["medio_pago"] . '</td>


                    


                    <td>

                      <div class="btn-group">
                          
                        <button class="btn btn-warning btnEditarMedio" data-toggle="modal" data-target="#modalEditarMedioPago" idMedio="' . $value["id"] . '"><i class="fa fa-pencil"></i></button>';

                            if ($_SESSION["perfil"] == "Administrador") {

                                echo '<button class="btn btn-danger btnEliminarMedio" idMedio="' . $value["id"] . '"><i class="fa fa-times"></i></button>';
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
    MODAL AGREGAR UNIDAD DE NEGOCIO
    ======================================-->
<div id="modalAgregarMedioPago" class="modal fade" role="dialog">

    <style>
        .error {
            color: red;

        }
    </style>
    <div class="modal-dialog">

        <div class="modal-content">

            <form role="form" method="post" id="form_nuevo_medio">

                <!--=====================================
                    CABEZA DEL MODAL
                    ======================================-->

                <div class="modal-header" style="background:#3f668d; color:white">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title">Agregar medio de pago</h4>

                </div>

                <!--=====================================
                    CUERPO DEL MODAL
                    ======================================-->

                <div class="modal-body">

                    <div class="box-body">

                        <!-- ENTRADA PARA EL NOMBRE -->

                        <div class="form-group">

                            <div class="d-inline-block bg-primary"
                                style="background-color:#3c8dbc;font-size:16px;font-weight:bold;text-indent:11px">Medio de pago
                            </div>
                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                                <input type="text" class="form-control input" name="nuevoMedio" id="nuevoMedio"
                                    placeholder="Ingresar medio de pago" required>

                            </div>
                        </div>

                    </div>

                </div>

                <!--=====================================
                    PIE DEL MODAL
                    ======================================-->

                <div class="modal-footer">

                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

                    <button type="submit" class="btn btn-primary" name="crear_negocio">Agregar medio de pago
                    </button>

                </div>

                <?php

                $crearMedio = new ControladorMediosPago();
                $crearMedio->ctrCrearMedio();

                ?>

            </form>

        </div>

    </div>

</div>

<!--=====================================
    MODAL EDITAR MEDIO DE PAGO
    ======================================-->

<div id="modalEditarMedioPago" class="modal fade" role="dialog">

    <div class="modal-dialog">

        <div class="modal-content">

            <form role="form" method="post" id="form_editar_medio">

                <!--=====================================
                    CABEZA DEL MODAL
                    ======================================-->

                <div class="modal-header" style="background:#3c8dbc; color:white">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title">Editar medio de pago</h4>

                </div>

                <!--=====================================
                    CUERPO DEL MODAL
                    ======================================-->

                <div class="modal-body">

                    <div class="box-body">

                        <!-- ENTRADA PARA EL NOMBRE -->

                        <div class="form-group">

                            <div class="d-inline-block bg-primary"
                                style="background-color:#3c8dbc;font-size:16px;font-weight:bold;text-indent:11px">Medio de pago
                            </div>
                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                                <input type="text" class="form-control input" id="editarMedio" name="editarMedio"
                                    required>
                                <input type="hidden" id="idMedio" name="idMedio" required>
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

                $editarMedio = new ControladorMediosPago();
                $editarMedio->ctrEditarMedio();

                ?>

            </form>

        </div>

    </div>

</div>

<?php

$eliminarMedio = new ControladorMediosPago();
$eliminarMedio->ctrEliminarMedio();

?>