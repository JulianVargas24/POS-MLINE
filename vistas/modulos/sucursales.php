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

      Administrar sucursales

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-home"></i>Inicio</a></li>

      <li>Parámetros</li>

      <li class="active">Sucursales</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarSucursal">
          <i class="fa fa-plus-circle fa-lg" style="margin-right: 5px;"></i>
          Agregar sucursal
        </button>

      </div>

      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tablas" width="100%">

          <thead>

            <tr>

              <th style="width:10px">#</th>
              <th>Sucursal</th>
              <th>Región</th>
              <th>Comuna</th>
              <th>Dirección</th>
              <th>Bodega asociada</th>
              <th>Jefe encargado</th>
              <th>Teléfono</th>
              <th>Email</th>
              <th>Acciones</th>

            </tr>

          </thead>

          <tbody>

            <?php

            $item = null;
            $valor = null;

            $sucursales = ControladorSucursales::ctrMostrarSucursales($item, $valor);

            foreach ($sucursales as $key => $value) {
              // Obtener los nombres de la región y la comuna
              $regionNombre = ControladorRegiones::ctrMostrarRegiones('id', $value['region']);
              $comunaNombre = ControladorRegiones::ctrMostrarComunas('id', $value['comuna']);

              // Asignar nombres o mostrar el ID si no se encuentra el nombre
              $regionDisplay = $regionNombre ? htmlspecialchars($regionNombre['nombre']) : '' . $value['region'];
              $comunaDisplay = $comunaNombre ? htmlspecialchars($comunaNombre[0]['nombre']) : '' . $value['comuna'];


              echo '<tr>

                    <td>' . ($key + 1) . '</td>

                    <td>' . $value["nombre"] . '</td>

                    <td>' . $regionDisplay . '</td>

                    <td>' . $comunaDisplay . '</td> 

                    <td>' . $value["direccion"] . '</td>

                    <td>' . $value["bodega"] . '</td>

                    <td>' . $value["jefe"] . '</td>

                    <td>' . $value["telefono"] . '</td>

                    <td>' . $value["email"] . '</td>

                    <td>

                      <div class="btn-group">
                          
                        <button class="btn btn-warning btnEditarSucursal" data-toggle="modal" data-target="#modalEditarSucursal" idSucursal="' . $value["id"] . '"><i class="fa fa-pencil"></i></button>';

              if ($_SESSION["perfil"] == "Administrador") {

                echo '<button class="btn btn-danger btnEliminarSucursal" idSucursal="' . $value["id"] . '"><i class="fa fa-times"></i></button>';
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
MODAL AGREGAR SUCURSAL
====================================-->
<style>
  .error {
    color: red;
  }
</style>

<div id="modalAgregarSucursal" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" id="form_nueva_sucursal">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3f668d; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar sucursal</h4>


        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <h4 class="box-title" style="font-weight:bold;margin:auto;margin-bottom:4px;">Datos de sucursal</h4>
            <div class="box box-info">
              <div class="box-body">
                <div class="form-group row">


                  <div class="col-lg-6">
                    <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold;">Nombre de sucursal</div>
                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-user"></i></span>
                      <input type="text" class="form-control input" name="nuevaSucursal" id="nuevaSucursal" placeholder="Ingresar nombre sucursal" required>
                    </div>
                  </div>

                  <div class="col-lg-6 col-xs-6">
                    <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold">País</div>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-globe"></i></span>
                      <input type="text" class="form-control input" name="nuevoPais" id="nuevoPais" placeholder="Ingrese país" required value="Chile">
                    </div>
                  </div>

                  <div class="col-xs-6">
                    <div class="d-inline-block text-center " style="font-size:16px;font-weight:bold">Región</div>
                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-globe"></i></span>

                      <select class="form-control input" id="nuevaRegion" name="nuevaRegion" required>

                        <option value="">Seleccionar Region</option>

                        <?php
                        $regiones = ControladorRegiones::ctrMostrarRegiones(null, null); // Consultar todas las regiones
                        foreach ($regiones as $region) {
                          echo '<option value="' . $region["id"] . '">' . $region["nombre"] . '</option>';
                        }
                        ?>

                      </select>
                    </div>
                  </div>

                  <!-- ENTRADA PARA LA CIUDAD  -->
                  <div class="col-xs-6">
                    <div class="d-block text-center" style="font-size:16px;font-weight:bold">Comuna</div>
                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>

                      <select class="form-control input" id="nuevaComuna" name="nuevaComuna" required>

                        <option value="">Seleccionar comuna</option>

                      </select>
                    </div>
                  </div>

                  <!-- Input hidden para la comuna actual -->
                  <input type="hidden" id="comunaActual" value="<?php echo $cliente['comuna']; ?>">


                  <!-- ENTRADA PARA LA DIRECCIÓN -->
                  <div class="col-lg-6" style="margin-top:10px;">
                    <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold">Dirección</div>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                      <input type="text" class="form-control input" name="nuevaDireccion" placeholder="Ingresar dirección" required>
                    </div>
                  </div>

                  <!-- ENTRADA PARA LA BODEGA -->
                  <div class="col-lg-6" style="margin-top:10px;">
                    <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold">Bodega asociada</div>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                      <select class="form-control input" id="nuevaBodega" name="nuevaBodega" required>
                        <option value="">Seleccionar bodega</option>
                        <?php
                        $item = null;
                        $valor = null;
                        $bodegas = ControladorBodegas::ctrMostrarBodegas($item, $valor);
                        foreach ($bodegas as $key => $value) {
                          echo '<option value="' . $value["nombre"] . '">' . $value["nombre"] . '</option>';
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <h4 class="box-title" style="font-weight:bold;margin:auto;margin-bottom:4px;">Datos de contacto</h4>
            <div class="box box-success">
              <div class="box-body">
                <div class="form-group row">
                  <div class="col-lg-6">
                    <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold">Jefe encargado</div>
                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-user"></i></span>

                      <input type="tel" class="form-control input" name="nuevoJefe" id="nuevoJefe" required>

                    </div>
                  </div>

                  <div class="col-lg-6">
                    <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold">Teléfono</div>
                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                      <input type="tel" class="form-control input" name="nuevoTelefono" id="nuevoTelefono"
                        placeholder="Ingresar teléfono" required
                        maxlength="12"
                        pattern="^\+[0-9]{11}$"
                        title="Ingrese el número de teléfono completo."
                        onfocus="if (this.value === '') { this.value = '+'; }"
                        oninput="this.value = this.value.replace(/[^0-9\+]/g, '');
                      if (!this.value.startsWith('+')) {
                      this.value = '+' + this.value.slice(1);
                      }
                      this.setCustomValidity(this.validity.patternMismatch ? 'Ingrese el número de teléfono completo.' : '');">
                    </div>
                  </div>


                  <div class="col-lg-6" style="margin-top:10px;">
                    <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold;margin-top:10px">Correo Electrónico</div>
                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                      <input type="text" class="form-control input" name="nuevoEmail" id="nuevoEmail" required
                        placeholder="Ingresar email"
                        pattern="^[^@]+@[^@]+\.[a-zA-Z]{2,}$"
                        title="El email debe contener un arroba (@) y un punto (.) después del arroba">
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar sucursal</button>

        </div>

      </form>

      <?php

      $crearSucursal = new ControladorSucursales();
      $crearSucursal->ctrCrearSucursal();
      ?>

    </div>

  </div>

</div>


<!--=====================================
MODAL EDITAR SUCURSAL
======================================-->

<div id="modalEditarSucursal" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" id="form_editar_sucursal">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3f668d; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar sucursal</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <h4 class="box-title" style="font-weight:bold;margin:auto;margin-bottom:4px;">Datos de sucursal</h4>
            <div class="box box-info">
              <div class="box-body">
                <div class="form-group row">

                  <div class="col-lg-6">
                    <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold;">Nombre sucursal</div>
                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-user"></i></span>
                      <input type="hidden" class="form-control input" name="idSucursal" id="idSucursal">
                      <input type="text" class="form-control input" name="editarSucursal" id="editarSucursal" required>

                    </div>
                  </div>
                  <div class="col-lg-6 col-xs-6">
                    <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold">País</div>
                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-globe"></i></span>

                      <input type="text" class="form-control input" name="editarPais" id="editarPais" required>

                    </div>
                  </div>

                  <!-- ENTRADA PARA LA REGION -->

                  <div class="col-xs-6">
                    <div class="d-inline-block text-center " style="font-size:16px;font-weight:bold">Región</div>
                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-globe"></i></span>

                      <select class="form-control input" id="editarRegion" name="editarRegion" required>

                        <option value="">Seleccionar región</option>

                        <?php

                        $item = null;
                        $valor = null;
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

                      <select class="form-control input" id="editarComuna" name="editarComuna" required>

                        <option value="">Seleccionar comuna</option>


                      </select>

                    </div>
                  </div>
                  <!-- Input hidden para la comuna actual -->
                  <input type="hidden" id="comunaActual" value="<?php echo $cliente['comuna']; ?>">

                  <!-- ENTRADA PARA LA DIRECCIÓN -->
                  <div class="col-lg-6" style="margin-top:10px;">
                    <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold">Dirección</div>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                      <input type="text" class="form-control input" id="editarDireccion" name="editarDireccion" placeholder="Ingresar Dirección" required>
                    </div>
                  </div>

                  <div class="col-lg-6" style="margin-top:10px;">
                    <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold">Bodega asociada</div>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                      <select class="form-control input" id="editarBodega" name="editarBodega" required>
                        <option value="">Seleccionar bodega</option>
                        <?php
                        $item = null;
                        $valor = null;
                        $bodegas = ControladorBodegas::ctrMostrarBodegas($item, $valor);
                        foreach ($bodegas as $key => $value) {
                          echo '<option value="' . $value["nombre"] . '">' . $value["nombre"] . '</option>';
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <h4 class="box-title" style="font-weight:bold;margin:auto;margin-bottom:4px;">Datos de contacto</h4>
            <div class="box box-success">
              <div class="box-body">
                <div class="form-group row">
                  <div class="col-lg-6">
                    <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold">Jefe encargado</div>
                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-user"></i></span>

                      <input type="tel" class="form-control input" name="editarJefe" id="editarJefe" required>

                    </div>
                  </div>

                  <div class="col-lg-6">
                    <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold">Teléfono</div>
                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                      <input type="tel" class="form-control input" name="editarTelefono" id="editarTelefono"
                        placeholder="Ingresar teléfono" required
                        maxlength="12"
                        pattern="^\+[0-9]{11}$"
                        title="Ingrese el número de teléfono completo."
                        onfocus="if (this.value === '') { this.value = '+'; }"
                        oninput="this.value = this.value.replace(/[^0-9\+]/g, '');
                      if (!this.value.startsWith('+')) {
                      this.value = '+' + this.value.slice(1);
                      }
                      this.setCustomValidity(this.validity.patternMismatch ? 'Ingrese el número de teléfono completo.' : '');">
                    </div>
                  </div>


                  <div class="col-lg-6" style="margin-top:10px;">
                    <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold;margin-top:10px">Correo electrónico</div>
                    <div class="input-group">

                      <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                      <input type="text" class="form-control input" name="editarEmail" id="editarEmail" required
                        placeholder="Ingresar email"
                        pattern="^[^@]+@[^@]+\.[a-zA-Z]{2,}$"
                        title="El email debe contener un arroba (@) y un punto (.) después del arroba">
                    </div>
                  </div>

                </div>
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

      </form>

      <?php

      $editarSucursal = new ControladorSucursales();
      $editarSucursal->ctrEditarSucursal();

      ?>




    </div>

  </div>

</div>

<?php

$eliminarSucursal = new ControladorSucursales();
$eliminarSucursal->ctrEliminarSucursal();

?>

<script>
  $(document).ready(function() {
    $('#nuevaRegion').change(function() {
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