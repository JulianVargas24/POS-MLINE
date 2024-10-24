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

                Administrar tabla para listas

            </h1>

            <ol class="breadcrumb">

                <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

                <li class="active">Administrar tabla para listas</li>

            </ol>

        </section>

        <section class="content">

            <div class="box">

                <div class="box-header with-border">


                    <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarTablaLista">

                        Agregar tabla para listas

                    </button>


                </div>

                <div class="box-body">

                    <table class="table table-bordered table-striped dt-responsive tablas" width="100%">

                        <thead>

                        <tr>

                            <th style="width:10px">#</th>
                            <th>Nombre</th>
                            <th>Acciones</th>

                        </tr>

                        </thead>

                        <tbody>

                        <?php

                        $item = null;
                        $valor = null;

                        $tablas = ControladorTablaListas::ctrMostrarTablaListas($item, $valor);

                        foreach ($tablas as $key => $value) {


                            echo ' <tr>

                    <td>' . ($key + 1) . '</td>
                    <td>' . $value["nombre"] . '</td>
                    <td>

                      <div class="btn-group">
                          
                        <button class="btn btn-warning btnEditarTablaLista" idTablaLista="' . $value["id"] . '" data-toggle="modal" data-target="#modalEditarTablaLista"><i class="fa fa-pencil"></i></button>';
                            if ($_SESSION["perfil"] == "Administrador") {

                                echo '<button class="btn btn-danger btnEliminarTablaLista" idTablaLista="' . $value["id"] . '"><i class="fa fa-times"></i></button>';

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

    <div id="modalAgregarTablaLista" class="modal fade" role="dialog">

        <style>
            .error {
                color: red;

            }
        </style>
        <div class="modal-dialog">

            <div class="modal-content">

                <form role="form" method="post" id="form_nueva_tabla_lista">

                    <!--=====================================
                    CABEZA DEL MODAL
                    ======================================-->

                    <div class="modal-header" style="background:#3f668d; color:white">

                        <button type="button" class="close" data-dismiss="modal">&times;</button>

                        <h4 class="modal-title">Agregar tabla para listas</h4>

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
                                    Tabla para listas
                                </div>
                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-th"></i></span>

                                    <input type="text" class="form-control input" name="nuevaTablaLista"
                                           id="nuevaTablaLista" placeholder="Ingresar Tabla para Listas" required>

                                </div>
                            </div>


                        </div>

                    </div>

                    <!--=====================================
                    PIE DEL MODAL
                    ======================================-->

                    <div class="modal-footer">

                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

                        <button type="submit" class="btn btn-primary" name="crear_rubro">Agregar tabla para listas
                        </button>

                    </div>

                    <?php

                    $crearTabla = new ControladorTablaListas();
                    $crearTabla->ctrCrearTablaLista();

                    ?>

                </form>

            </div>

        </div>

    </div>

    <!--=====================================
    MODAL EDITAR SUBCATEGORÍA
    ======================================-->

    <div id="modalEditarTablaLista" class="modal fade" role="dialog">

        <div class="modal-dialog">

            <div class="modal-content">

                <form role="form" method="post" id="form_editar_impuesto">

                    <!--=====================================
                    CABEZA DEL MODAL
                    ======================================-->

                    <div class="modal-header" style="background:#3c8dbc; color:white">

                        <button type="button" class="close" data-dismiss="modal">&times;</button>

                        <h4 class="modal-title">Editar tabla para listas</h4>

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
                                    Nombre
                                </div>
                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-th"></i></span>

                                    <input type="text" class="form-control input" id="editarTablaLista"
                                           name="editarTablaLista" required>

                                    <input type="hidden" id="idTablaLista" name="idTablaLista" required>

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

                    $editarTablaLista = new ControladorTablaListas();
                    $editarTablaLista->ctrEditarTablaLista();

                    ?>

                </form>

            </div>

        </div>

    </div>

<?php

$borrarTablaLista = new ControladorTablaListas();
$borrarTablaLista->ctrBorrarTablaLista();

?>