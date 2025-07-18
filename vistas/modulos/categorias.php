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

            Administrar categorías

        </h1>

        <ol class="breadcrumb">

            <li><a href="inicio"><i class="fa fa-home"></i>Inicio</a></li>

            <li>Maestro</li>

            <li class="active">Categorías</li>

        </ol>

    </section>

    <section class="content">

        <div class="box">

            <div class="box-header with-border">

                <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCategoria">
                    <i class="fa fa-plus-circle fa-lg" style="margin-right: 5px;"></i>
                    Agregar categoría
                </button>

            </div>

            <div class="box-body">

                <table class="table table-bordered table-striped dt-responsive tablas" width="100%">

                    <thead>

                        <tr>

                            <th style="width:10px">#</th>
                            <th>Categoría</th>
                            <th>Acciones</th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php

                        $item = null;
                        $valor = null;

                        $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);


                        foreach ($categorias as $key => $value) {

                            echo ' <tr>

                    <td>' . ($key + 1) . '</td>

                    <td>' . $value["categoria"] . '</td>
                    

                    <td>

                      <div class="btn-group">
                          
                        <button class="btn btn-warning btnEditarCategoria" idCategoria="' . $value["id"] . '" data-toggle="modal" data-target="#modalEditarCategoria"><i class="fa fa-pencil"></i></button>';

                            if ($_SESSION["perfil"] == "Administrador") {

                                echo '<button class="btn btn-danger btnEliminarCategoria" idCategoria="' . $value["id"] . '"><i class="fa fa-times"></i></button>';
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
MODAL AGREGAR CATEGORÍA
======================================-->

<div id="modalAgregarCategoria" class="modal fade" role="dialog">


    <style>
        .error {
            color: red;

        }
    </style>
    <div class="modal-dialog">

        <div class="modal-content">

            <form role="form" method="post" id="form_nueva_categoria">

                <!--=====================================
                CABEZA DEL MODAL
                ======================================-->

                <div class="modal-header" style="background:#3f668d; color:white">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title">Agregar categoría</h4>

                </div>

                <!--=====================================
                CUERPO DEL MODAL
                ======================================-->

                <div class="modal-body">

                    <div class="box-body">

                        <!-- ENTRADA PARA EL NOMBRE -->

                        <div class="form-group">
                            <div class="d-inline-block bg-primary"
                                style="background-color:#3c8dbc;font-size:16px;font-weight:bold;text-indent: 11px">Categoría
                            </div>
                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                                <input type="text" class="form-control input" name="nuevaCategoria"
                                    placeholder="Ingresar categoría" required>

                            </div>

                        </div>

                    </div>

                </div>

                <!--=====================================
                PIE DEL MODAL
                ======================================-->

                <div class="modal-footer">

                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

                    <button type="submit" class="btn btn-primary" name="crear_categoria">Guardar categoría</button>

                </div>

                <?php

                $crearCategoria = new ControladorCategorias();
                $crearCategoria->ctrCrearCategoria();

                ?>

            </form>

        </div>

    </div>

</div>

<!--=====================================
MODAL EDITAR CATEGORÍA
======================================-->

<div id="modalEditarCategoria" class="modal fade" role="dialog">

    <div class="modal-dialog">

        <div class="modal-content">

            <form role="form" method="post" id="form_editar_categoria">

                <!--=====================================
                CABEZA DEL MODAL
                ======================================-->

                <div class="modal-header" style="background:#3f668d; color:white">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title">Editar categoría</h4>

                </div>

                <!--=====================================
                CUERPO DEL MODAL
                ======================================-->

                <div class="modal-body">

                    <div class="box-body">

                        <!-- ENTRADA PARA EL NOMBRE -->

                        <div class="form-group">
                            <div class="d-inline-block bg-primary"
                                style="background-color:#3c8dbc;font-size:16px;font-weight:bold;text-indent:11px">Categoría
                            </div>
                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                                <input type="text" class="form-control input" name="editarCategoria"
                                    id="editarCategoria" required>

                                <input type="hidden" name="idCategoria" id="idCategoria" required>

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

                $editarCategoria = new ControladorCategorias();
                $editarCategoria->ctrEditarCategoria();

                ?>

            </form>

        </div>

    </div>

</div>

<?php

$borrarCategoria = new ControladorCategorias();
$borrarCategoria->ctrBorrarCategoria();

?>