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

      Administrar Clientes

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-home"></i>Inicio</a></li>
      <li>Ventas</li>
      <li class="active"> Asministrar Clientes</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCliente">
          <i class="fa fa-plus-circle fa-lg" style="margin-right: 5px;"></i>
          Agregar cliente
        </button>

        <div class="box-tools pull-right" style="margin-top: 5px;">
          <a href="vistas/modulos/descargar-reporte-clientes.php?reporte=reporte">
            <button class="btn btn-success">
              <i class="fa fa-download fa-lg" style="margin-right: 5px;"></i>
              Reporte en Excel
            </button>
          </a>
        </div>

      </div>

      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tablas" width="100%">

          <thead>

            <tr>

              <th style="width:10px">#</th>
              <th>Nombre</th>
              <th>Rut</th>
              <th>Email</th>
              <th>Teléfono</th>
              <th>Region</th>
              <th>Comuna</th>
              <th>Dirección</th>
              <th>Actividad</th>
              <th>Ejecutivo</th>
              <th>Descuento</th>

              <th>Acciones</th>

            </tr>

          </thead>

          <tbody>

            <?php

            $item = null;
            $valor = null;

            $clientes = ControladorClientes::ctrMostrarClientes($item, $valor);

            foreach ($clientes as $key => $value) {
              // Obtener los nombres de la región y la comuna
              $regionNombre = ControladorRegiones::ctrMostrarRegiones('id', $value['region']);
              $comunaNombre = ControladorRegiones::ctrMostrarComunas('id', $value['comuna']);

              // Asignar nombres o mostrar el ID si no se encuentra el nombre
              $regionDisplay = $regionNombre ? htmlspecialchars($regionNombre['nombre']) : '' . $value['region'];
              $comunaDisplay = $comunaNombre ? htmlspecialchars($comunaNombre['nombre']) : '' . $value['comuna'];

              echo '<tr>
                    <td>' . ($key + 1) . '</td>
                    <td>' . $value["nombre"] . '</td>
                    <td>' . $value["rut"] . '</td>
                    <td>' . $value["email"] . '</td>
                    <td>' . $value["telefono"] . '</td>
                    <td>' . $regionDisplay . '</td>
                    <td>' . $comunaDisplay . '</td> 
                    <td>' . $value["direccion"] . '</td>  
                    <td>' . $value["actividad"] . '</td> 
                    <td>' . $value["ejecutivo"] . '</td> 
                    <td>' . $value["factor_lista"] . '%</td> 
                    <td>
                        <div class="btn-group">
                            <button class="btn btn-warning btnEditarCliente" data-toggle="modal" data-target="#modalEditarCliente" idCliente="' . $value["id"] . '"><i class="fa fa-pencil"></i></button>';

              if ($_SESSION["perfil"] == "Administrador") {
                echo '<button class="btn btn-danger btnEliminarCliente" idCliente="' . $value["id"] . '"><i class="fa fa-times"></i></button>';
              }

              echo '      </div>  
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
MODAL AGREGAR CLIENTE
======================================-->
<style>
  .error {
    color: red;
  }
</style>

<div id="modalAgregarCliente" class="modal fade" role="dialog">

  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form role="form" method="post" id="form_nuevo_cliente" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3f668d; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title text-center">Agregar cliente</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">


            <!-- ENTRADA PARA SELECCIONAR CATEGORÍA -->



            <!-- ENTRADA PARA LOS DATOS CLIENTE -->
            <h4 class="box-title" style="font-weight:bold;margin:auto;margin-bottom:4px;">Datos del cliente</h4>
            <div class="box box-info">
              <div class="box-body">
                <div class="form-group row">
                  <div class="col-lg-4">
                    <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold">Razón Social</div>
                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-user"></i></span>

                      <input type="text" class="form-control input" name="nuevoCliente" id="nuevoCliente" placeholder="Ingrese razón social" required>

                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="d-inline-block  text-center" style="font-size:16px;font-weight:bold">RUT</div>
                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-th"></i></span>

                      <input type="text" class="form-control input" name="nuevoRutId" id="nuevoRutId"
                        placeholder="Ingrese su RUT"
                        required
                        onblur="formatearRut(this)">

                    </div>
                  </div>

                  <div class="col-lg-4">
                    <div class="d-inline-block  text-center" style="font-size:16px;font-weight:bold">Actividad</div>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-th"></i></span>
                      <input type="text" class="form-control input" name="nuevaActividad" id="nuevaActividad" placeholder="Ingrese su actividad" required>
                    </div>
                  </div>
                  <!-- ENTRADA PARA LA SUBCATEGORIA -->
                  <div class="col-xs-6">
                    <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold">País</div>
                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-globe"></i></span>

                      <input type="text" class="form-control input" name="nuevoPais" id="nuevoPais" placeholder="Ingrese el país" required value="Chile">

                    </div>
                  </div>
                  <div class="col-xs-6">
                    <div class="d-inline-block text-center " style="font-size:16px;font-weight:bold">Región</div>
                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-globe"></i></span>

                      <select class="form-control input" id="nuevaRegion" name="nuevaRegion" required>

                        <option value="">Seleccionar región</option>

                        <?php
                        $regiones = ControladorRegiones::ctrMostrarRegiones(null, null); // Consultar todas las regiones
                        foreach ($regiones as $region) {
                          echo '<option value="' . $region["id"] . '">' . $region["nombre"] . '</option>';
                        }
                        ?>

                      </select>


                    </div>
                  </div>
                  <!-- ENTRADA PARA LA CIUDAD -->
                  <div class="col-xs-6">
                    <div class="d-block text-center" style="font-size:16px;font-weight:bold">Comuna</div>
                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>

                      <select class="form-control input" id="nuevaComuna" name="nuevaComuna" required>

                        <option value="">Seleccionar comuna</option>

                      </select>

                    </div>
                  </div>

                  <div class="col-xs-6">
                    <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold">Dirección</div>
                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>

                      <input type="text" class="form-control input" name="nuevaDireccion" id="nuevaDireccion" placeholder="Ingrese dirección" required>

                    </div>
                  </div>

                  <div class="col-xs-6">
                    <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold">Tipo campaña</div>
                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-user"></i></span>

                      <select class="form-control input" id="nuevoTipoCampana" name="nuevoTipoCampana" required>

                        <option value="">Seleccionar tipo cliente</option>
                        <?php

                        $item = null;
                        $valor = null;

                        $tipoCliente = ControladorTipoClientes::ctrMostrarTipoClientes($item, $valor);

                        foreach ($tipoCliente as $key => $value) {

                          echo '<option value="' . $value["id"] . '">' . $value["nombre"] . '</option>';
                        }

                        ?>
                      </select>

                    </div>
                  </div>
                  <div class="col-xs-6">
                    <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold">Tipo producto</div>
                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-file"></i></span>

                      <select class="form-control input" id="nuevoTipoProducto" name="nuevoTipoProducto" required>

                        <option value="">Seleccionar tipo producto</option>
                        <?php

                        $item = null;
                        $valor = null;

                        $tipoProducto = ControladorTipoProductos::ctrMostrarTipoProductos($item, $valor);

                        foreach ($tipoProducto as $key => $value) {

                          echo '<option value="' . $value["id"] . '">' . $value["nombre"] . '</option>';
                        }

                        ?>
                      </select>

                    </div>
                  </div>
                  <div class="col-xs-6">
                    <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold">Lista de precio asignada</div>
                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-user"></i></span>

                      <select class="form-control input" id="nuevoFactor" name="nuevoFactor" required>

                        <option value="1">PRECIO LISTA - 0%</option>
                        <?php

                        $item = null;
                        $valor = null;

                        $listaPrecio = ControladorListas::ctrMostrarListas($item, $valor);

                        foreach ($listaPrecio as $key => $value) {
                          if ($value["id"] != 1) {
                            echo '<option value="' . $value["id"] . '">' . $value["nombre_lista"] . '- %' . $value["factor"] . '</option>';
                          }
                        }

                        ?>
                      </select>

                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- ENTRADA PARA STOCK -->

            <h4 class="box-title" style="font-weight:bold;">Datos de contacto</h4>
            <div class="box box-warning">
              <div class="box-body">
                <div class="form-group row">
                  <!-- ENTRADA PARA EL EJECUTIVO-->
                  <div class="col-xs-4">
                    <div class="d-block" style="font-size:16px;font-weight:bold;">Ejecutivo</div>
                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-user"></i></span>

                      <input type="text" class="form-control input" name="nuevoEjecutivo" id="nuevoEjecutivo" placeholder="Ingresar ejecutivo" required>

                    </div>
                  </div>

                  <!-- ENTRADA PARA EL TELEFONO-->
                  <div class="col-xs-4">
                    <div class="d-block" style="font-size:16px;font-weight:bold">Numero de teléfono</div>
                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-phone"></i></span>

                      <input type="tel" class="form-control input" name="nuevoTelefono"
                        placeholder="Ingresar teléfono" required
                        maxlength="12" pattern="^\+[0-9]{11}$"
                        title="Ingrese el número de teléfono completo incluido el +"
                        onfocus="validarTelefono(this)">
                    </div>
                  </div>

                  <!-- ENTRADA PARA EL EMAIL-->
                  <div class="col-xs-4">
                    <div class="d-block" style="font-size:16px;font-weight:bold">Correo electrónico</div>
                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-envelope"></i></span>

                      <input type="text" class="form-control input" name="nuevoEmail" placeholder="Ingresar email" required pattern="^[^@]+@[^@]+.[a-zA-Z]{2,}$" title="El email debe contener un arroba (@) y un punto (.) después del arroba">

                    </div>
                  </div>

                </div>
              </div>
            </div>
            <!-- ENTRADA PARA EL CÓDIGO -->

            <h4 class="box-title" style="font-weight:bold;">Datos de crédito y cobranza</h4>
            <div class="box box-success">
              <div class="box-body">
                <div class="form-group row">
                  <div class="col-xs-4">
                    <div class="d-inline-block  text-center" style="font-size:16px;font-weight:bold">Plazo de pago</div>
                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-code"></i></span>

                      <select class="form-control input" id="nuevoPlazo" name="nuevoPlazo" required>

                        <option value="">Seleccionar plazo de pago</option>

                        <?php

                        $item = null;
                        $valor = null;

                        $plazos = ControladorPlazos::ctrMostrarPlazos($item, $valor);

                        foreach ($plazos as $key => $value) {
                          echo '<option  value="' . $value["id"] . '">' . $value["nombre"] . ' </option>';
                        }

                        ?>

                      </select>

                    </div>

                  </div>
                  <div class="col-xs-4">
                    <div class="d-inline-block  text-center" style="font-size:16px;font-weight:bold">Vendedor</div>
                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-check"></i></span>

                      <select class="form-control input" id="nuevoVendedor" name="nuevoVendedor" required>

                        <option value="">Seleccionar Vendedor</option>
                        <?php

                        $item = null;
                        $valor = null;

                        $vendedor = ControladorPlantel::ctrMostrarPlantel($item, $valor);

                        foreach ($vendedor as $key => $value) {

                          echo '<option value="' . $value["id"] . '">' . $value["nombre"] . '</option>';
                        }

                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-xs-4">
                    <div class="d-inline-block  text-center" style="font-size:16px;font-weight:bold">Estado de cliente en sistema</div>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-check"></i></span>

                      <select class="form-control input" id="nuevoEstado" name="nuevoEstado" required>

                        <option value="">Seleccionar estado: </option>
                        <option value="activo">Activo </option>
                        <option value="inactivo">Inactivo</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-xs-4">
                    <div class="d-block text-center" style="font-size:16px;font-weight:bold">Contacto cobranza</div>
                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-user"></i></span>

                      <input type="tel" class="form-control input" name="nuevoContactoCobranza" id="nuevoContactoCobranza" placeholder="Ingresar contacto" required>

                    </div>
                  </div>
                  <div class="col-xs-4 ">
                    <div class="d-block text-center" style="font-size:16px;font-weight:bold">Correo electrónico</div>
                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-envelope"></i></span>

                      <input type="text" class="form-control input" name="nuevoEmailCobranza" id="nuevoEmailCobranza" placeholder="Ingresar email" required pattern="^[^@]+@[^@]+.[a-zA-Z]{2,}$" title="El email debe contener un arroba (@) y un punto (.) después del arroba">

                    </div>
                  </div>
                  <div class="col-xs-4">
                    <div class="d-block text-center" style="font-size:16px;font-weight:bold">Número de télefono</div>
                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-phone"></i></span>

                      <input type="tel" class="form-control input" name="nuevoTelefonoCobranza" id="nuevoTelefonoCobranza"
                        placeholder="Ingresar teléfono" required
                        maxlength="12" pattern="^\+[0-9]{11}$"
                        title="Ingrese el número de teléfono completo incluido el +"
                        onfocus="validarTelefono(this)">
                    </div>
                  </div>

                </div>
                <div class="form-group row">
                  <div class="col-xs-3">
                    <div class="d-block text-center" style="font-size:16px;font-weight:bold;">Línea de crédito</div>
                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-money"></i></span>

                      <input type="number" class="form-control input" name="nuevaLineaCredito" id="nuevaLineaCredito" placeholder="Ingresar Linea de Credito"
                        required oninput="formatearLineaCredito(this)">

                    </div>
                  </div>
                  <div class="col-xs-3">
                    <div class="d-block text-center" style="font-size:16px;font-weight:bold">Bloqueo para crédito</div>
                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-bank"></i></span>

                      <select class="form-control input" name="nuevoBloqueoCredito" id="nuevoBloqueoCredito">
                        <option value="No">No</option>
                        <option value="Si">Si</option>
                      </select>

                    </div>
                  </div>
                  <div class="col-xs-6">
                    <div class="d-block text-center" style="font-size:16px;font-weight:bold">Observacion de cobranza</div>
                    <textarea style="border-width:1px;border-color:blue" class="form-control input" name="nuevaObservacion" id="nuevaObservacion" cols="6" rows="3"></textarea>
                  </div>


                </div>




              </div>
            </div>
          </div>

          <div class="modal-footer">

            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

            <button type="submit" class="btn btn-primary text-center">Guardar cliente</button>

          </div>
        </div>

    </div>

    <!--=====================================
        PIE DEL MODAL
        ======================================-->



    </form>

    <?php

    $crearCliente = new ControladorClientes();
    $crearCliente->ctrCrearCliente();

    ?>

  </div>

</div>

</div>

<!--=====================================
MODAL EDITAR CLIENTE
======================================-->



<div id="modalEditarCliente" class="modal fade" role="dialog">

  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form role="form" method="post" id="form_nuevo_cliente" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#FFA500; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title text-center">Editar cliente</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">


            <!-- ENTRADA PARA SELECCIONAR CATEGORÍA -->



            <!-- ENTRADA PARA LOS DATOS CLIENTE -->
            <h4 class="box-title" style="font-weight:bold;margin:auto;margin-bottom:4px;">Datos del cliente</h4>
            <div class="box box-info">
              <div class="box-body">
                <div class="form-group row">
                  <div class="col-lg-4">
                    <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold">Razón social</div>
                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-user"></i></span>
                      <input type="hidden" id="idCliente" name="idCliente">
                      <input type="text" class="form-control input" name="editarCliente" id="editarCliente" placeholder="Ingrese razón social" required>

                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="d-inline-block  text-center" style="font-size:16px;font-weight:bold">RUT</div>
                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-th"></i></span>

                      <input type="text" class="form-control input" name="editarRutId" id="editarRutId"
                        placeholder="Ingrese su RUT" required onblur="formatearRut(this)">

                    </div>
                  </div>

                  <div class="col-lg-4">
                    <div class="d-inline-block  text-center" style="font-size:16px;font-weight:bold">Actividad</div>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-th"></i></span>
                      <input type="text" class="form-control input" name="editarActividad" id="editarActividad" placeholder="Ingrese su actividad" required>
                    </div>
                  </div>
                  <!-- ENTRADA PARA LA SUBCATEGORIA -->
                  <div class="col-xs-6">
                    <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold">País</div>
                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-globe"></i></span>

                      <input type="text" class="form-control input" name="editarPais" id="editarPais" placeholder="Ingrese el país" required value="Chile">

                    </div>
                  </div>
                  <div class="col-xs-6">
                    <div class="d-inline-block text-center " style="font-size:16px;font-weight:bold">Región</div>
                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-globe"></i></span>

                      <select class="form-control input" id="editarRegion" name="editarRegion" required>

                        <option value="">Seleccionar región</option>

                        <?php
                        foreach ($regiones as $region) {
                          echo '<option value="' . $region['id'] . '" ' . ($region['id'] == $cliente['region'] ? 'selected' : '') . '>' . $region['nombre'] . '</option>';
                        }
                        ?>

                      </select>


                    </div>
                  </div>
                  <!-- ENTRADA PARA LA CIUDAD -->
                  <div class="col-xs-6">
                    <div class="d-block text-center" style="font-size:16px;font-weight:bold">Comuna</div>
                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>

                      <select class="form-control input" id="editarComuna" name="editarComuna" required>

                        <option value="">Seleccionar comuna</option>

                      </select>

                    </div>
                  </div>

                  <!-- Input hidden para la comuna actual -->
                  <input type="hidden" id="comunaActual" value="<?php echo $cliente['comuna']; ?>">

                  <div class="col-xs-6">
                    <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold">Dirección</div>
                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>

                      <input type="text" class="form-control input" name="editarDireccion" id="editarDireccion" placeholder="Ingrese la dirección" required>

                    </div>
                  </div>

                  <div class="col-xs-6">
                    <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold">Tipo de campaña</div>
                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-user"></i></span>

                      <select class="form-control input" id="editarTipoCampana" name="editarTipoCampana" required>

                        <option value="">Seleccionar tipo de cliente</option>
                        <?php

                        $item = null;
                        $valor = null;

                        $tipoCliente = ControladorTipoClientes::ctrMostrarTipoClientes($item, $valor);

                        foreach ($tipoCliente as $key => $value) {

                          echo '<option value="' . $value["id"] . '">' . $value["nombre"] . '</option>';
                        }

                        ?>
                      </select>

                    </div>
                  </div>
                  <div class="col-xs-6">
                    <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold">Tipo de producto</div>
                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-file"></i></span>

                      <select class="form-control input" id="editarTipoProducto" name="editarTipoProducto" required>

                        <option value="">Seleccionar tipo de producto</option>
                        <?php

                        $item = null;
                        $valor = null;

                        $tipoProducto = ControladorTipoProductos::ctrMostrarTipoProductos($item, $valor);

                        foreach ($tipoProducto as $key => $value) {

                          echo '<option value="' . $value["id"] . '">' . $value["nombre"] . '</option>';
                        }

                        ?>
                      </select>

                    </div>
                  </div>
                  <div class="col-xs-6">
                    <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold">Lista de precio asignada</div>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-user"></i></span>
                      <select class="form-control input" id="editarFactor" name="editarFactor" required>
                        <option value="">PRECIO LISTA - 0%</option>
                        <?php

                        $item = null;
                        $valor = null;

                        $listaPrecio = ControladorListas::ctrMostrarListas($item, $valor);

                        foreach ($listaPrecio as $key => $value) {
                          if ($value["id"] != 1) {
                            echo '<option value="' . $value["id"] . '">' . $value["nombre_lista"] . '- %' . $value["factor"] . '</option>';
                          }
                        }

                        ?>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- ENTRADA PARA STOCK -->

            <h4 class="box-title" style="font-weight:bold;">Datos de contacto</h4>
            <div class="box box-warning">
              <div class="box-body">
                <div class="form-group row">
                  <!-- ENTRADA PARA EL EJECUTIVO-->
                  <div class="col-xs-4">
                    <div class="d-block" style="font-size:16px;font-weight:bold;">Ejecutivo</div>
                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-user"></i></span>

                      <input type="text" class="form-control input" name="editarEjecutivo" id="editarEjecutivo" placeholder="Ingresar ejecutivo" required>

                    </div>
                  </div>

                  <!-- ENTRADA PARA EL TELEFONO-->
                  <div class="col-xs-4">
                    <div class="d-block" style="font-size:16px;font-weight:bold">Número de teléfono</div>
                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-phone"></i></span>

                      <input type="tel" class="form-control input" name="editarTelefono"
                        id="editarTelefono"
                        placeholder="Ingresar teléfono" required
                        maxlength="12" pattern="^\+[0-9]{11}$"
                        title="Ingrese el número de teléfono completo incluido el +"
                        onfocus="validarTelefono(this)">
                    </div>
                  </div>

                  <!-- ENTRADA PARA EL EMAIL-->
                  <div class="col-xs-4">
                    <div class="d-block" style="font-size:16px;font-weight:bold">Correo electrónico</div>
                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-envelope"></i></span>

                      <input type="text" class="form-control input" name="editarEmail" id="editarEmail" placeholder="Ingresar email"
                        required pattern="^[^@]+@[^@]+.[a-zA-Z]{2,}$" title="El email debe contener un arroba (@) y un punto (.) después del arroba">

                    </div>
                  </div>

                </div>
              </div>
            </div>
            <!-- ENTRADA PARA EL CÓDIGO -->

            <h4 class="box-title" style="font-weight:bold;">Datos de crédito y cobranza</h4>
            <div class="box box-success">
              <div class="box-body">
                <div class="form-group row">
                  <div class="col-xs-4">
                    <div class="d-inline-block  text-center" style="font-size:16px;font-weight:bold">Plazo de pago</div>
                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-code"></i></span>

                      <select class="form-control input" id="editarPlazo" name="editarPlazo" required>

                        <option value="">Seleccionar plazo de pago</option>

                        <?php

                        $item = null;
                        $valor = null;

                        $plazos = ControladorPlazos::ctrMostrarPlazos($item, $valor);

                        foreach ($plazos as $key => $value) {
                          echo '<option  value="' . $value["id"] . '">' . $value["nombre"] . ' </option>';
                        }

                        ?>

                      </select>

                    </div>

                  </div>
                  <div class="col-xs-4">
                    <div class="d-inline-block  text-center" style="font-size:16px;font-weight:bold">Vendedor</div>
                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-check"></i></span>

                      <select class="form-control input" id="editarVendedor" name="editarVendedor" required>

                        <option value="">Seleccionar vendedor</option>
                        <?php

                        $item = null;
                        $valor = null;

                        $vendedor = ControladorPlantel::ctrMostrarPlantel($item, $valor);

                        foreach ($vendedor as $key => $value) {

                          echo '<option value="' . $value["id"] . '">' . $value["nombre"] . '</option>';
                        }

                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-xs-4">
                    <div class="d-inline-block  text-center" style="font-size:16px;font-weight:bold">Estado de cliente en sistema</div>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-check"></i></span>

                      <select class="form-control input" id="editarEstado" name="editarEstado" required>

                        <option value="">Seleccionar estado: </option>
                        <option value="activo">Activo </option>
                        <option value="inactivo">Inactivo</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-xs-4">
                    <div class="d-block text-center" style="font-size:16px;font-weight:bold">Contacto cobranza</div>
                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-user"></i></span>

                      <input type="text" class="form-control input" name="editarContactoCobranza" id="editarContactoCobranza" placeholder="Ingresar contacto" required>


                    </div>
                  </div>
                  <div class="col-xs-4 ">
                    <div class="d-block text-center" style="font-size:16px;font-weight:bold">Correo electrónico</div>
                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-envelope"></i></span>

                      <input type="text" class="form-control input" name="editarEmailCobranza" id="editarEmailCobranza" placeholder="Ingresar email" required pattern="^[^@]+@[^@]+.[a-zA-Z]{2,}$" title="El email debe contener un arroba (@) y un punto (.) después del arroba">

                    </div>
                  </div>
                  <div class="col-xs-4">
                    <div class="d-block text-center" style="font-size:16px;font-weight:bold">Número de télefono</div>
                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-phone"></i></span>

                      <input type="tel" class="form-control input" name="editarTelefonoCobranza" id="editarTelefonoCobranza"
                        id="editarTelefono"
                        placeholder="Ingresar teléfono" required
                        maxlength="12" pattern="^\+[0-9]{11}$"
                        title="Ingrese el número de teléfono completo incluido el +"
                        onfocus="validarTelefono(this)">
                    </div>
                  </div>

                </div>
                <div class="form-group row">
                  <div class="col-xs-3">
                    <div class="d-block text-center" style="font-size:16px;font-weight:bold;">Línea de crédito</div>
                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-money"></i></span>

                      <input type="number" class="form-control input" name="editarLineaCredito" id="editarLineaCredito" placeholder="Ingresar línea de crédito" required>

                    </div>
                  </div>
                  <div class="col-xs-3">
                    <div class="d-block text-center" style="font-size:16px;font-weight:bold">Bloqueo para crédito</div>
                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-bank"></i></span>

                      <select class="form-control input" name="editarBloqueoCredito" id="editarBloqueoCredito">
                        <option value="No">No</option>
                        <option value="Si">Sí</option>
                      </select>

                    </div>
                  </div>
                  <div class="col-xs-6">
                    <div class="d-block text-center" style="font-size:16px;font-weight:bold">Observación de cobranza</div>
                    <textarea style="border-width:1px;border-color:blue" class="form-control input" name="editarObservacion" id="editarObservacion" cols="6" rows="3">
                    </textarea>
                  </div>


                </div>




              </div>
            </div>
          </div>

          <div class="modal-footer">

            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

            <button type="submit" class="btn btn-primary text-center">Guardar cliente</button>

          </div>
        </div>

    </div>

    <!--=====================================
        PIE DEL MODAL
        ======================================-->



    </form>

    <?php

    $editarProducto = new ControladorClientes();
    $editarProducto->ctrEditarCliente();

    ?>

  </div>

</div>

</div>

<?php

$eliminarCliente = new ControladorClientes();
$eliminarCliente->ctrEliminarCliente();

?>

<script>
  $(document).ready(function() {
    $(' #nuevaRegion').change(function() {
      var selectedValue = $(this).val();

      $.ajax({
        url: './vistas/modulos/obtenerRegiones.php',
        data: {
          id: selectedValue
        },
        type: 'POST',
        success: function(response) {
          console.log(response)
          $('#nuevaComuna').html(response);
        }
      });
    });
  });

  $(document).ready(function() {
    $('#editarRegion').change(function() {
      var selectedValue = $(this).val();

      $.ajax({
        url: './vistas/modulos/obtenerRegiones.php',
        data: {
          id: selectedValue
        },
        type: 'POST',
        success: function(response) {
          console.log(response)
          $('#editarComuna').html(response);
        }
      });
    });
  });
</script>