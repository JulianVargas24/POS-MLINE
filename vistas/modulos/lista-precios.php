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

            Lista de precios

        </h1>

        <ol class="breadcrumb">

            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

            <li class="active">Lista de precios</li>

        </ol>

    </section>

    <section class="content">

        <div class="box">

            <div class="box-header with-border">


            </div>

            <div class="box-body">

                <table class="table table-bordered table-striped dt-responsive tablas" width="100%">

                    <thead>

                    <tr>

                        <th style="width:10px">#</th>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Tabla lista</th>
                        <th>Clasificación</th>
                        <th>Precio lista neto</th>
                        <th>Precio lista con IVA</th>
                        <th>Editar precio</th>

                    </tr>

                    </thead>

                    <tbody>

                    <?php

                    $item = null;
                    $valor = null;
                    $orden = "id";

                    $productos = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);
                    $tablas = ControladorTablaListas::ctrMostrarTablaListas($item, $valor);

                    foreach ($productos as $key => $value) {

                        for ($i = 0; $i < count($tablas); ++$i) {
                            if ($tablas[$i]["id"] == $value["id_tabla_lista"]) {
                                $tabla = $tablas[$i]["nombre"];
                            }
                        }


                        echo ' <tr>

                    <td>' . ($key + 1) . '</td>
                    <td>' . $value["codigo"] . '</td>
                    <td>' . $value["descripcion"] . '</td>
                    <td>' . $tabla . '</td>
                    <td>' . $value["tipo_producto"] . '</td>
                    <td> $ ' . number_format($value["precio_venta"], 0, '', '.') . '</td>';
                        if ($value["tipo_producto"] == "Afecto") {
                            echo '<td> $ ' . number_format(($value["precio_venta"] * 1.19), 0, '', '.') . '</td>';
                        } else {
                            echo '<td style="font-weight:bold;"> $ ' . number_format($value["precio_venta"], 0, '', '.') . '</td>';
                        }
                        echo '

                    <div class="btn-group">
                          <td>
                            <button class="btn btn-warning btnEditarPrecioProducto"  idProducto="' . $value["id"] . '" data-toggle="modal" data-target="#modalEditarPrecio"><i class="fa fa-pencil"></i></button>';


                        echo '</td>
                      </div> 
                

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


<div id="modalEditarPrecio" class="modal fade" role="dialog">

    <div class="modal-dialog">

        <div class="modal-content">

            <form role="form" method="post" id="form_editar_impuesto">

                <!--=====================================
                CABEZA DEL MODAL
                ======================================-->

                <div class="modal-header" style="background:#3c8dbc; color:white">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title">Editar precio producto</h4>

                </div>

                <!--=====================================
                CUERPO DEL MODAL
                ======================================-->

                <div class="modal-body">

                    <div class="box-body">

                        <!-- ENTRADA PARA EL NOMBRE -->

                        <div class="form-group">
                            <div class="d-inline-block bg-primary"
                                 style="background-color:#3c8dbc;font-size:16px;font-weight:bold;text-indent: 11px">Nombre producto
                            </div>
                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                                <input type="text" class="form-control input" id="editarNombreProducto"
                                       name="editarNombreProducto" readonly required>
                                <input type="hidden" id="idProducto" name="idProducto" required>

                            </div>
                        </div>


                        <div class="form-group">
                            <div class="d-inline-block bg-primary"
                                 style="background-color:#3c8dbc;font-size:16px;font-weight:bold;text-indent: 11px">Precio producto
                            </div>
                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                                <input type="text" class="form-control input" id="editarPrecioProducto"
                                       name="editarPrecioProducto" required>

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

                $editarPrecio = new ControladorProductos();
                $editarPrecio->ctrEditarPrecioProducto();

                ?>

            </form>

        </div>

    </div>

</div>

