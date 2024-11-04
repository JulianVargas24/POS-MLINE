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
      Administrar proveedores
    </h1>
    <ol class="breadcrumb">
      <li><a href="inicio"><i class="fa fa-home"></i> Inicio</a></li>
      <li>Adquisiciones</li>
      <li class="active">Proveedores</li>
    </ol>
  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarProveedor">
          Agregar proveedor
        </button>
      </div>

      <div class="box-tools pull-right" style="margin-bottom:5px">
        <a href="vistas/modulos/descargar-reporte-proveedores.php?reporte=reporte">
          <button class="btn btn-success">Descargar reporte proveedores en Excel</button>
        </a>
      </div>

      <div class="box-body">
        <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
          <thead>
            <tr>
              <th style="width:10px">#</th>
              <th>Razón social</th>
              <th>RUT</th>
              <th>Actividad</th>
              <th>Región</th>
              <th>Nro. cuenta</th>
              <th>Banco</th>
              <th>Ejecutivo</th>
              <th>Teléfono</th>
              <th>Email</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>

            <?php

            $item = null;
            $valor = null;

            $proveedores = ControladorProveedores::ctrMostrarProveedores($item, $valor);

            foreach ($proveedores as $key => $value) {


              echo '<tr>

                    <td>' . ($key + 1) . '</td>

                    <td>' . $value["razon_social"] . '</td>

                    <td>' . $value["rut"] . '</td>

                    <td>' . $value["actividad"] . '</td>

                    <td>' . $value["region"] . '</td>

                    <td>' . $value["nro_cuenta"] . '</td>

                    <td>' . $value["banco"] . '</td>  
                    
                    <td>' . $value["ejecutivo"] . '</td>

                    <td>' . $value["telefono"] . '</td>

                    <td>' . $value["email"] . '</td>


                    <td>

                      <div class="btn-group">
                        <button class="btn btn-warning btnEditarProveedor" data-toggle="modal" data-target="#modalEditarProveedor" idProveedor="' . $value["id"] . '"><i class="fa fa-pencil"></i></button>';

              if ($_SESSION["perfil"] == "Administrador") {

                echo '<button class="btn btn-danger btnEliminarProveedor" idProveedor="' . $value["id"] . '"><i class="fa fa-times"></i></button>';
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
MODAL AGREGAR PROVEEDOR
======================================-->
<style>
  .error {
    color: red;
  }
</style>

<div id="modalAgregarProveedor" class="modal fade" role="dialog">

  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form role="form" method="post" id="form_nuevo_proveedor">

        <!--=====================================
                CABEZA DEL MODAL
                ======================================-->

        <div class="modal-header" style="background:#3f668d; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar proveedor</h4>

        </div>

        <!--=====================================
                CUERPO DEL MODAL, REGION, CIUDAD, DIRECCION
                ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <h4 class="box-title" style="font-weight:bold;">
              Datos de proveedor
            </h4>
            <div class="box box-success">

              <div class="box-body">
                <div class="form-group row">
                  <!-- ENTRADA PARA LA RAZON SOCIAL -->
                  <div class="col-xs-6">
                    <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold">
                      Razón Social
                    </div>
                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-user"></i></span>

                      <input type="text" class="form-control input" name="nuevoProveedor"
                        id="nuevoProveedor" placeholder="Ingresar razón social" required>

                    </div>
                  </div>
                  <!-- ENTRADA PARA EL RUT ID -->
                  <div class="col-xs-6">
                    <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold">
                      RUT
                    </div>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-key"></i></span>
                      <input type="text" class="form-control input" name="nuevoRutId"
                        id="nuevoRutId" placeholder="Ingresar RUT" required
                        onblur="formatearRut(this)">
                    </div>
                  </div>
                </div>
              </div>

              <div class="form-group row">
                <!-- ENTRADA PARA LA ACTIVIDAD -->
                <div class="col-xs-6">
                  <div class="d-block text-center" style="font-size:16px;font-weight:bold">
                    Actividad
                  </div>
                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-globe"></i></span>

                    <input type="text" class="form-control input" name="nuevaActividad"
                      id="nuevaActividad" placeholder="Ingrese actividad">

                  </div>
                </div>
                <div class="col-xs-6">
                  <div class="d-inline-block text-center " style="font-size:16px;font-weight:bold">
                    País
                  </div>
                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-globe"></i></span>

                    <input type="text" class="form-control input" name="nuevoPais" id="nuevoPais"
                      value="Chile" required>

                  </div>
                </div>

              </div>
              <div class="form-group row">
                <div class="col-xs-6">
                  <div class="d-inline-block text-center " style="font-size:16px;font-weight:bold">
                    Región
                  </div>
                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-globe"></i></span>

                    <select class="form-control input" id="nuevaRegion" name="nuevaRegion" required>

                      <option value="">Seleccionar región</option>

                      <?php

                      $item = null;
                      $valor = null;

                      $regiones = ControladorRegiones::ctrMostrarRegiones($item, $valor);

                      foreach ($regiones as $key => $value) {
                        echo '<option  value="' . $value["nombre"] . '">' . $value["nombre"] . ' ' . $value["ordinal"] . ' </option>';
                      }

                      ?>

                    </select>


                  </div>
                </div>
                <!-- ENTRADA PARA LA CIUDAD -->
                <div class="col-xs-6">
                  <div class="d-block text-center" style="font-size:16px;font-weight:bold">
                    Comuna
                  </div>
                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>

                    <select class="form-control input" id="nuevaComuna" name="nuevaComuna" required>

                      <option value="">Seleccionar comuna</option>

                      <?php

                      $item = null;
                      $valor = null;


                      $comunas = ControladorRegiones::ctrMostrarComunas($item, $valor);

                      foreach ($comunas as $key => $value) {
                        echo '<option  value="' . $value["nombre"] . '">' . $value["nombre"] . ' </option>';
                      }

                      ?>

                    </select>

                  </div>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-xs-6">
                  <div class="d-block text-center" style="font-size:16px;font-weight:bold">
                    Dirección
                  </div>
                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-globe"></i></span>

                    <input type="text" class="form-control input" name="nuevaDireccion"
                      id="nuevaDireccion" placeholder="Ingrese dirección" required>

                  </div>
                </div>
                <div class="col-xs-6">
                  <div class="d-block text-center" style="font-size:16px;font-weight:bold">
                    Rubro Principal
                  </div>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-apple"></i></span>
                    <select class="form-control input" id="nuevoRubro" name="nuevoRubro" required>

                      <?php

                      $item = null;
                      $valor = null;

                      $rubros = ControladorRubros::ctrMostrarRubros($item, $valor);

                      foreach ($rubros as $key => $value) {
                        echo '<option  value="' . $value["nombre"] . '">' . $value["nombre"] . ' </option>';
                      }

                      ?>


                    </select>

                  </div>
                </div>

              </div>

            </div>
          </div>
          <h4 class="box-title" style="font-weight:bold;">Datos de pago</h4>
          <div class="box box-info">
            <div class="box-body">
              <div class="form-group row">
                <!-- ENTRADA PARA EL N° CUENTA BANCARIA-->
                <div class="col-xs-6">
                  <div class="d-block text-center" style="font-size:16px;font-weight:bold">
                    Número de Cuenta
                  </div>
                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-ticket"></i></span>

                    <input type="text" class="form-control input" name="nuevoNroCuenta"
                      placeholder="Ingresar número de cuenta" required
                      pattern="[0-9]+"
                      oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                  </div>
                </div>
                <!-- ENTRADA PARA EL BANCO -->
                <div class="col-xs-6">
                  <div class="d-block text-center" style="font-size:16px;font-weight:bold">
                    Banco
                  </div>
                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-university"></i></span>

                    <select class="form-control input" id="nuevoBanco" name="nuevoBanco" required>

                      <option value="">Seleccionar banco</option>

                      <?php

                      $item = null;
                      $valor = null;

                      $bancos = ControladorBancos::ctrMostrarBancos($item, $valor);

                      foreach ($bancos as $key => $value) {
                        echo '<option  value="' . $value["nombre_banco"] . '">' . $value["nombre_banco"] . ' </option>';
                      }

                      ?>

                    </select>

                  </div>
                </div>
              </div>
              <div class="form-group row">
                <!-- ENTRADA PARA LÍNEA DE CRÉDITO-->
                <div class="col-xs-6">
                  <div class="d-block text-center" style="font-size:16px;font-weight:bold">
                    Línea de Crédito
                  </div>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-ticket"></i></span>
                    <input type="text" class="form-control input"
                      placeholder="Ingresar línea de crédito" required
                      oninput="formatearLineaCredito(this)">
                  </div>
                </div>
                <!-- ENTRADA PARA EL BANCO -->
                <div class="col-xs-6">
                  <div class="d-block text-center" style="font-size:16px;font-weight:bold">
                    Plazo de Pago
                  </div>
                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-university"></i></span>

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
              </div>

            </div>
          </div>
          <h4 class="box-title" style="font-weight:bold;">Datos de contacto</h4>
          <div class="box box-warning">
            <div class="box-body">
              <div class="form-group row">
                <!-- ENTRADA PARA EL TELEFONO-->
                <div class="col-xs-6">
                  <div class="d-block text-center" style="font-size:16px;font-weight:bold">
                    Número de teléfono
                  </div>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                    <input type="tel" class="form-control input" name="nuevoTelefono"
                      placeholder="Ingresar teléfono" required
                      maxlength="12" pattern="^\+[0-9]{11}$"
                      title="Ingrese el número de teléfono completo."
                      onfocus="validarTelefono(this)">
                  </div>
                </div>
                <!-- ENTRADA PARA EL EMAIL-->
                <div class="col-xs-6">
                  <div class="d-block text-center" style="font-size:16px;font-weight:bold">
                    Correo Electrónico
                  </div>
                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>

                    <input type="text" class="form-control input" name="nuevoEmail"
                      placeholder="Ingresar email" required
                      pattern="^[^@]+@[^@]+\.[a-zA-Z]{2,}$"
                      title="El email debe contener un arroba (@) y un punto (.) después del arroba.">
                  </div>
                </div>
              </div>

              <div class="form-group row">
                <!-- ENTRADA PARA EL EJECUTIVO-->
                <div class="col-xs-6">
                  <div class="d-block text-center"
                    style="font-size:16px;font-weight:bold;margin-top:5px;">
                    Ejecutivo
                  </div>
                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-user"></i></span>

                    <input type="text" class="form-control input" name="nuevoEjecutivo"
                      placeholder="Ingresar ejecutivo" required>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary ">Guardar proveedor</button>

        </div>
      </form>  
    </div>

    <!--=====================================
            PIE DEL MODAL
            ======================================-->
    <?php

    $crearProveedor = new ControladorProveedores();
    $crearProveedor->ctrCrearProveedores();

    ?>

  </div>

</div>

<!--=====================================
MODAL EDITAR PROVEEDOR
======================================-->

<div id="modalEditarProveedor" class="modal fade" role="dialog">

  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form role="form" method="post" id="form_nuevo_proveedor">

        <!--=====================================
                CABEZA DEL MODAL
                ======================================-->

        <div class="modal-header" style="background:#3f668d; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Proveedor</h4>

        </div>

        <!--=====================================
                CUERPO DEL MODAL, REGION, CIUDAD, DIRECCION
                ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <h4 class="box-title" style="font-weight:bold;">Datos de Proveedor</h4>
            <div class="box box-success">

              <div class="box-body">
                <div class="form-group row">
                  <!-- ENTRADA PARA LA RAZON SOCIAL -->
                  <div class="col-xs-6">
                    <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold">
                      Razón Social
                    </div>
                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-user"></i></span>
                      <input type="hidden" name="idProveedor" id="idProveedor">
                      <input type="text" class="form-control input" name="editarProveedor"
                        id="editarProveedor" placeholder="Ingresar razón social" required>
                    </div>
                  </div>
                  <!-- ENTRADA PARA EL RUT ID -->
                  <div class="col-xs-6">
                    <div class="d-inline-block text-center"
                      style="font-size:16px;font-weight:bold">
                      RUT
                    </div>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-key"></i></span>
                      <input type="text" class="form-control input" name="editarRutId"
                        id="editarRutId" placeholder="Ingresar RUT" required
                        onblur="formatearRut(this)">
                    </div>
                  </div>
                </div>
              </div>

              <div class="form-group row">
                <!-- ENTRADA PARA LA ACTIVIDAD -->
                <div class="col-xs-6">
                  <div class="d-block text-center" style="font-size:16px;font-weight:bold">
                    Actividad
                  </div>
                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-globe"></i></span>

                    <input type="text" class="form-control input" name="editarActividad"
                      id="editarActividad" placeholder="Ingrese actividad">

                  </div>
                </div>
                <div class="col-xs-6">
                  <div class="d-inline-block text-center " style="font-size:16px;font-weight:bold">
                    País
                  </div>
                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-globe"></i></span>

                    <input type="text" class="form-control input" name="editarPais" id="editarPais"
                      value="Chile" required>

                  </div>
                </div>

              </div>
              <div class="form-group row">
                <div class="col-xs-6">
                  <div class="d-inline-block text-center " style="font-size:16px;font-weight:bold">
                    Región
                  </div>
                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-globe"></i></span>

                    <select class="form-control input" id="editarRegion" name="editarRegion"
                      required>

                      <option value="">Seleccionar región</option>

                      <?php

                      $item = null;
                      $valor = null;

                      $regiones = ControladorRegiones::ctrMostrarRegiones($item, $valor);

                      foreach ($regiones as $key => $value) {
                        echo '<option  value="' . $value["nombre"] . '">' . $value["nombre"] . ' ' . $value["ordinal"] . ' </option>';
                      }

                      ?>

                    </select>


                  </div>
                </div>
                <!-- ENTRADA PARA LA CIUDAD -->
                <div class="col-xs-6">
                  <div class="d-block text-center" style="font-size:16px;font-weight:bold">
                    Comuna
                  </div>
                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>

                    <select class="form-control input" id="editarComuna" name="editarComuna"
                      required>

                      <option value="">Seleccionar comuna</option>

                      <?php

                      $item = null;
                      $valor = null;


                      $comunas = ControladorRegiones::ctrMostrarComunas($item, $valor);

                      foreach ($comunas as $key => $value) {
                        echo '<option  value="' . $value["nombre"] . '">' . $value["nombre"] . ' </option>';
                      }

                      ?>

                    </select>

                  </div>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-xs-6">
                  <div class="d-block text-center" style="font-size:16px;font-weight:bold">
                    Dirección
                  </div>
                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-globe"></i></span>

                    <input type="text" class="form-control input" name="editarDireccion"
                      id="editarDireccion" placeholder="Ingrese dirección" required>

                  </div>
                </div>
                <div class="col-xs-6">
                  <div class="d-block text-center" style="font-size:16px;font-weight:bold">
                    Rubro Principal
                  </div>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-apple"></i></span>
                    <select class="form-control input" id="editarRubro" name="editarRubro" required>

                      <?php

                      $item = null;
                      $valor = null;

                      $rubros = ControladorRubros::ctrMostrarRubros($item, $valor);

                      foreach ($rubros as $key => $value) {
                        echo '<option  value="' . $value["nombre"] . '">' . $value["nombre"] . ' </option>';
                      }

                      ?>


                    </select>

                  </div>
                </div>

              </div>

            </div>
          </div>
          <h4 class="box-title" style="font-weight:bold;">Datos de pago</h4>
          <div class="box box-info">
            <div class="box-body">
              <div class="form-group row">
                <!-- ENTRADA PARA EL N° CUENTA BANCARIA-->
                <div class="col-xs-6">
                  <div class="d-block text-center" style="font-size:16px;font-weight:bold">
                    Número de Cuenta
                  </div>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-ticket"></i></span>
                    <input type="text" class="form-control input" name="editarNroCuenta"
                      id="editarNroCuenta" placeholder="Ingresar número de cuenta" required
                      pattern="[0-9]+"
                      oninput="this.value = this.value.replace(/[^0-9]/g, '');">

                  </div>
                </div>
                <!-- ENTRADA PARA EL BANCO -->
                <div class="col-xs-6">
                  <div class="d-block text-center" style="font-size:16px;font-weight:bold">
                    Banco
                  </div>
                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-university"></i></span>

                    <select class="form-control input" id="editarBanco" name="editarBanco" required>

                      <option value="">Seleccionar banco</option>

                      <?php

                      $item = null;
                      $valor = null;

                      $bancos = ControladorBancos::ctrMostrarBancos($item, $valor);

                      foreach ($bancos as $key => $value) {
                        echo '<option  value="' . $value["nombre_banco"] . '">' . $value["nombre_banco"] . ' </option>';
                      }

                      ?>

                    </select>

                  </div>
                </div>
              </div>
              <div class="form-group row">
                <!-- ENTRADA PARA LÍNEA DE CRÉDITO-->
                <div class="col-xs-6">
                  <div class="d-block text-center" style="font-size:16px;font-weight:bold">
                    Línea de Crédito
                  </div>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-ticket"></i></span>
                    <input type="text" class="form-control input" name="editarLinea"
                      id="editarLinea" value="0" required
                      oninput="formatearLineaCredito(this)">
                  </div>
                </div>
                <!-- ENTRADA PARA EL BANCO -->
                <div class="col-xs-6">
                  <div class="d-block text-center" style="font-size:16px;font-weight:bold">
                    Plazo de Pago
                  </div>
                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-university"></i></span>

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
              </div>

            </div>
          </div>
          <h4 class="box-title" style="font-weight:bold;">Datos de contacto</h4>
          <div class="box box-warning">
            <div class="box-body">
              <div class="form-group row">
                <!-- ENTRADA PARA EL TELEFONO-->
                <div class="col-xs-6">
                  <div class="d-block text-center" style="font-size:16px;font-weight:bold">
                    Número de Teléfono
                  </div>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                    <input type="tel" class="form-control input" name="editarTelefono"
                      id="editarTelefono" placeholder="Ingresar teléfono" required
                      maxlength="12" pattern="^\+[0-9]{11}$"
                      title="Ingrese el número de teléfono completo."
                      onfocus="validarTelefono(this)">
                  </div>
                </div>
                <!-- ENTRADA PARA EL EMAIL-->
                <div class="col-xs-6">
                  <div class="d-block text-center" style="font-size:16px;font-weight:bold">
                    Correo Electrónico
                  </div>
                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>

                    <input type="text" class="form-control input" name="editarEmail"
                      id="editarEmail" placeholder="Ingresar email" required
                      pattern="^[^@]+@[^@]+\.[a-zA-Z]{2,}$"
                      title="El email debe contener un arroba (@) y un punto (.) después del arroba.">
                  </div>
                </div>
              </div>

              <div class="form-group row">
                <!-- ENTRADA PARA EL EJECUTIVO-->
                <div class="col-xs-6">
                  <div class="d-block text-center"
                    style="font-size:16px;font-weight:bold;margin-top:5px;">
                    Ejecutivo
                  </div>
                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-user"></i></span>

                    <input type="text" class="form-control input" name="editarEjecutivo"
                      id="editarEjecutivo" placeholder="Ingresar ejecutivo" required>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary ">Guardar proveedor</button>

        </div>
      </form>  
    </div>

    <!--=====================================
            PIE DEL MODAL
            ======================================-->

    <?php

    $editarProveedor = new ControladorProveedores();
    $editarProveedor->ctrEditarProveedor();

    ?>

  </div>

</div>

<?php
$eliminarProveedor = new ControladorProveedores();
$eliminarProveedor->ctrEliminarProveedores();
?>