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

      Administrar impuestos

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-home"></i>Inicio</a></li>
      <li>Maestro</li>
      <li class="active">Impuestos</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">


        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarImpuesto">
          <i class="fa fa-plus-circle fa-lg" style="margin-right: 5px;"></i>
          Agregar impuesto
        </button>


      </div>

      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tablas" width="100%">

          <thead>

            <tr>

              <th style="width:10px">#</th>
              <th>Código</th>
              <th>Impuesto</th>
              <th>Porcentaje</th>
              <th>Descripción</th>
              <th>Acciones</th>

            </tr>

          </thead>

          <tbody>

            <?php

            $item = null;
            $valor = null;

            $impuestos = ControladorImpuestos::ctrMostrarImpuestos($item, $valor);

            foreach ($impuestos as $key => $value) {


              echo ' <tr>

                    <td>' . ($key + 1) . '</td>
                    <td>' . $value["codigo"] . '</td>
                    <td>' . $value["nombre"] . '</td>
                    <td>' . $value["factor"] . '%</td>
                    <td>' . $value["descripcion"] . '</td>
                    <td>

                      <div class="btn-group">
                          
                        <button class="btn btn-warning btnEditarImpuesto" idImpuesto="' . $value["id"] . '" data-toggle="modal" data-target="#modalEditarImpuesto"><i class="fa fa-pencil"></i></button>';
              if ($_SESSION["perfil"] == "Administrador") {

                echo '<button class="btn btn-danger btnEliminarImpuesto" idImpuesto="' . $value["id"] . '"><i class="fa fa-times"></i></button>';
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

<div id="modalAgregarImpuesto" class="modal fade" role="dialog">

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

          <h4 class="modal-title">Agregar impuesto</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->

            <div class="form-group">
              <div class="d-inline-block bg-primary" style="background-color:#3c8dbc;font-size:16px;font-weight:bold;text-indent:11px">Código</div>
              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <input type="number" class="form-control input" id="nuevoCodigo" name="nuevoCodigo" placeholder="Ingresar código" required>

              </div>
            </div>

            <div class="form-group">
              <div class="d-inline-block bg-primary" style="background-color:#3c8dbc;font-size:16px;font-weight:bold;text-indent:11px">Impuesto</div>
              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <input type="text" class="form-control input" name="nuevoImpuesto" id="nuevoImpuesto" placeholder="Ingresar impuesto" required>

              </div>
            </div>


            <div class="form-group">
              <div class="d-inline-block bg-primary" style="background-color:#3c8dbc;font-size:16px;font-weight:bold;text-indent:11px">Porcentaje</div>
              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <input type="number" class="form-control input" id="nuevoFactor" name="nuevoFactor" 
                placeholder="Ingresar porcentaje" 
                max="100" min="0" required>

              </div>
            </div>

            <div class="form-group">
              <div class="d-inline-block bg-primary" style="background-color:#3c8dbc;font-size:16px;font-weight:bold;text-indent:11px">Descripción</div>
              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <input type="text" class="form-control input" name="nuevoDescripcion" id="nuevoDescripcion" placeholder="Ingresar descripción" required>

              </div>
            </div>





          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary" name="crear_impuesto">Agregar impuesto</button>

        </div>

        <?php

        $crearImpuesto = new ControladorImpuestos();
        $crearImpuesto->ctrCrearImpuesto();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR SUBCATEGORÍA
======================================-->

<div id="modalEditarImpuesto" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" id="form_editar_impuesto">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar lista</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->

            <div class="form-group">
              <div class="d-inline-block bg-primary" style="background-color:#3c8dbc;font-size:16px;font-weight:bold;text-indent:11px">Código</div>
              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <input type="number" class="form-control input" id="editarCodigo" name="editarCodigo" required>

              </div>
            </div>

            <div class="form-group">
              <div class="d-inline-block bg-primary" style="background-color:#3c8dbc;font-size:16px;font-weight:bold;text-indent:11px">Impuesto</div>
              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <input type="text" class="form-control input" id="editarImpuesto" name="editarImpuesto" required>

                <input type="hidden" id="idImpuesto" name="idImpuesto" required>

              </div>
            </div>


            <div class="form-group">
              <div class="d-inline-block bg-primary" style="background-color:#3c8dbc;font-size:16px;font-weight:bold;text-indent:11px">Factor</div>
              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <input type="number" class="form-control input" id="editarFactor" name="editarFactor" max="100" min="0" required>

              </div>
            </div>

            <div class="form-group">
              <div class="d-inline-block bg-primary" style="background-color:#3c8dbc;font-size:16px;font-weight:bold;text-indent:11px">Descripción</div>
              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <input type="text" class="form-control input" id="editarDescripcion" name="editarDescripcion" required>


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

        $editarImpuesto = new ControladorImpuestos();
        $editarImpuesto->ctrEditarImpuesto();

        ?>

      </form>

    </div>

  </div>

</div>

<?php

$borrarImpuesto = new ControladorImpuestos();
$borrarImpuesto->ctrBorrarImpuesto();

?>