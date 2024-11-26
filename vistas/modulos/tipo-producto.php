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

      Administrar tipos de productos
    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-home"></i>Inicio</a></li>
      <li>Comercial</li>
      <li class="active">Tipos de productos</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarTipoProducto">
          <i class="fa fa-plus-circle fa-lg" style="margin-right: 5px;"></i>
          Agregar tipo de producto
        </button>

      </div>

      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tablas" width="100%">

          <thead>

            <tr>

              <th style="width:10px">#</th>
              <th>Tipo de producto</th>
              <th>Código</th>


            </tr>

          </thead>

          <tbody>

            <?php

            $item = null;
            $valor = null;

            $tipoProductos = ControladorTipoProductos::ctrMostrarTipoProductos($item, $valor);

            foreach ($tipoProductos as $key => $value) {


              echo '<tr>

                    <td>' . ($key + 1) . '</td>

                    <td>' . $value["nombre"] . '</td>

                    <td>' . $value["codigo"] . '</td>


                    <td>

                      <div class="btn-group">
                          
                        <button class="btn btn-warning btnEditarTipoProducto" data-toggle="modal" data-target="#modalEditarTipoProducto" idTipoProducto="' . $value["id"] . '"><i class="fa fa-pencil"></i></button>';

              if ($_SESSION["perfil"] == "Administrador") {

                echo '<button class="btn btn-danger btnEliminarTipoProducto" idTipoProducto="' . $value["id"] . '"><i class="fa fa-times"></i></button>';
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
<div id="modalAgregarTipoProducto" class="modal fade" role="dialog">

  <style>
    .error {
      color: red;

    }
  </style>
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" id="form_tipo_cliente">

        <!--=====================================
          CABEZA DEL MODAL
          ======================================-->

        <div class="modal-header" style="background:#3f668d; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar tipo de producto</h4>

        </div>

        <!--=====================================
          CUERPO DEL MODAL
          ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->

            <div class="form-group">

              <div class="d-inline-block bg-primary" style="background-color:#3c8dbc;font-size:16px;font-weight:bold;text-indent: 11px">Tipo de producto</div>
              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                <input type="text" class="form-control input" name="nuevoTipoProducto" id="nuevoTipoProducto" placeholder="Ingresar tipo de producto" required>

              </div>
            </div>

            <div class="form-group">

              <div class="d-inline-block bg-primary" style="background-color:#3c8dbc;font-size:16px;font-weight:bold;text-indent: 11px">Código de producto</div>
              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <input type="number" class="form-control input" name="nuevoCodigoProducto" id="nuevoCodigoProducto" placeholder="Ingresar código de producto" required>

              </div>
            </div>


          </div>

        </div>

        <!--=====================================
          PIE DEL MODAL
          ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary" name="crear_negocio">Agregar tipo de producto</button>

        </div>

        <?php

        $crearTipoProducto = new ControladorTipoProductos();
        $crearTipoProducto->ctrCrearTipoProducto();

        ?>

      </form>

    </div>

  </div>

</div>
<div id="modalEditarTipoProducto" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" id="form_editar_tipo_producto">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar tipo de producto</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->

            <div class="form-group">

              <div class="d-inline-block bg-primary" style="background-color:#3c8dbc;font-size:16px;font-weight:bold;text-indent: 11px">Tipo de producto</div>
              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <input type="text" class="form-control input" id="editarTipoProducto" name="editarTipoProducto" required>
                <input type="hidden" id="idTipoProducto" name="idTipoProducto" required>
              </div>
            </div>

            <div class="form-group">

              <div class="d-inline-block bg-primary" style="background-color:#3c8dbc;font-size:16px;font-weight:bold;text-indent: 11px">Código de producto</div>
              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <input type="number" class="form-control input" id="editarCodigoProducto" name="editarCodigoProducto" required>

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

        $editarTipoProducto = new ControladorTipoProductos();
        $editarTipoProducto->ctrEditarTipoProducto();

        ?>

      </form>

    </div>

  </div>

</div>

<?php

$eliminarTipoProducto = new ControladorTipoProductos();
$eliminarTipoProducto->ctrEliminarTipoProducto();

?>