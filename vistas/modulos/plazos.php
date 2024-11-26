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

            Administrar plazos de pago

        </h1>

        <ol class="breadcrumb">

            <li><a href="inicio"><i class="fa fa-home"></i>Inicio</a></li>

            <li>Maestro</li>

            <li class="active">Plazos de pago</li>

        </ol>

    </section>

    <section class="content">

        <div class="box">

            <div class="box-header with-border">


                <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarPlazo">
                    <i class="fa fa-plus-circle fa-lg" style="margin-right: 5px;"></i>
                    Agregar plazo
                </button>


            </div>

            <div class="box-body">

                <table class="table table-bordered table-striped dt-responsive tablas" width="100%">

                    <thead>

                        <tr>

                            <th style="width:10px">#</th>

                            <th>Nombre</th>
                            <th>Días</th>
                            <th>Acciones</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php

                        $item = null;
                        $valor = null;

                        $plazos = ControladorPlazos::ctrMostrarPlazos($item, $valor);

                        foreach ($plazos as $key => $value) {


                            echo ' <tr>

                    <td>' . ($key + 1) . '</td>

                    <td>' . $value["nombre"] . '</td>
                    <td>' . $value["numero"] . '</td>
                    <td>

                      <div class="btn-group">
                          
                        <button class="btn btn-warning btnEditarPlazo" idPlazo="' . $value["id"] . '" data-toggle="modal" data-target="#modalEditarPlazo"><i class="fa fa-pencil"></i></button>';
                            if ($_SESSION["perfil"] == "Administrador") {

                                echo '<button class="btn btn-danger btnEliminarPlazo" idPlazo="' . $value["id"] . '"><i class="fa fa-times"></i></button>';
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
    MODAL AGREGAR RUBRO
    ======================================-->

<div id="modalAgregarPlazo" class="modal fade" role="dialog">

    <style>
        .error {
            color: red;

        }
    </style>
    <div class="modal-dialog">

        <div class="modal-content">

            <form role="form" method="post" id="form_nuevo_impuesto">

                <!--=====================================
                    CABEZA DEL MODAL
                    ======================================-->

                <div class="modal-header" style="background:#3f668d; color:white">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title">Agregar plazo</h4>

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
                                Nombre de Plazo
                            </div>
                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                                <input type="text" class="form-control input" name="nuevoPlazo" id="nuevoPlazo"
                                    placeholder="Ingresar nombre de plazo" required>

                            </div>
                        </div>

                        <div class="form-group">
                            <div class="d-inline-block bg-primary"
                                style="background-color:#3c8dbc;font-size:16px;font-weight:bold;text-indent: 11px">
                                Número de días
                            </div>
                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                                <input type="number" class="form-control input" id="nuevoNumero" name="nuevoNumero"
                                    placeholder="Ingresar número de días" required max=200>

                            </div>
                        </div>


                    </div>

                </div>

                <!--=====================================
                    PIE DEL MODAL
                    ======================================-->

                <div class="modal-footer">

                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

                    <button type="submit" class="btn btn-primary" name="crear_plazo">Agregar plazo</button>

                </div>

                <?php

                $crearPlazo = new ControladorPlazos();
                $crearPlazo->ctrCrearPlazo();

                ?>

            </form>

        </div>

    </div>

</div>

<!--=====================================
    MODAL EDITAR SUBCATEGORÍA
    ======================================-->

<div id="modalEditarPlazo" class="modal fade" role="dialog">

    <div class="modal-dialog">

        <div class="modal-content">

            <form role="form" method="post" id="form_editar_plazo">

                <!--=====================================
                    CABEZA DEL MODAL
                    ======================================-->

                <div class="modal-header" style="background:#3c8dbc; color:white">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title">Editar plazo de pago</h4>

                </div>

                <!--=====================================
                    CUERPO DEL MODAL
                    ======================================-->

                <div class="modal-body">

                    <div class="box-body">

                        <!-- ENTRADA PARA EL NOMBRE -->

                        <div class="form-group">
                            <div class="d-inline-block bg-primary"
                                style="background-color:#3c8dbc;font-size:16px;font-weight:bold;text-indent: 11px">
                                Nombre de plazo
                            </div>
                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                                <input type="text" class="form-control input" id="editarPlazo" name="editarPlazo"
                                    required>

                                <input type="hidden" id="idPlazo" name="idPlazo" required>

                            </div>
                        </div>


                        <div class="form-group">
                            <div class="d-inline-block bg-primary"
                                style="background-color:#3c8dbc;font-size:16px;font-weight:bold;text-indent: 11px">
                                Número de días
                            </div>
                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                                <input type="number" class="form-control input" id="editarNumero" name="editarNumero"
                                    required max=200>

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

                $editarPlazo = new ControladorPlazos();
                $editarPlazo->ctrEditarPlazo();

                ?>

            </form>

        </div>

    </div>

</div>

<?php

$borrarPlazo = new ControladorPlazos();
$borrarPlazo->ctrBorrarPlazo();

?>