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

      Administrar matriz

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-home"></i>Inicio</a></li>

        <li>Parámetros</li>

      <li class="active">Matriz</li>

    </ol>

  </section>

  <section class="content">

  <div class="box">

    <div class="box-header with-border">
      <button class="btn btn-primary" data-toggle="modal" data-target="#modalCrearMatriz">
    
        Crear matriz

    </button>


  </div>  

      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tablas" width="100%">

          <thead>

            <tr>
              <th>Razón Social</th>
              <th>RUT</th>
              <th>Actividad</th>
              <th>Región</th>
              <th>Comuna</th>
              <th>País</th>
              <th>Dirección</th>
              <th>Ejecutivo</th>
              <th>Teléfono</th>
              <th>Correo</th>
              <th>Inicio servicio</th>
              <th>Vcto. servicio</th>
              <th>Tipo cliente</th>
              <th>Tipo producto</th>
              <th>Acciones</th>

            </tr>

          </thead>

          <tbody>

            <?php

            $item = null;
            $valor = null;

            $matrices = ControladorMatrices::ctrMostrarMatrices($item, $valor);

            foreach ($matrices as $key => $value) {
              // Obtener los nombres de la región y la comuna
              $regionNombre = ControladorRegiones::ctrMostrarRegiones('id', $value['region']);
              $comunaNombre = ControladorRegiones::ctrMostrarComunas('id', $value['comuna']);
  
              // Asignar nombres o mostrar el ID si no se encuentra el nombre
              $regionDisplay = $regionNombre ? htmlspecialchars($regionNombre['nombre']) : ''.$value['region'];
              $comunaDisplay = $comunaNombre ? htmlspecialchars($comunaNombre[0]['nombre']) : ''.$value['comuna'];

              echo '<tr>

                    <td>'.$value["razon_social"].'</td>
                    <td>'.$value["rut"].'</td> 
                    <td>'.$value["actividad"].'</td>
                    <td>'.$regionDisplay.'</td>
                    <td>'.$comunaDisplay.'</td>
                    <td>'.$value["pais"].'</td>  
                    <td>'.$value["direccion"].'</td>  
                    <td>'.$value["ejecutivo"].'</td> 
                    <td>'.$value["telefono"].'</td> 
                    <td>'.$value["email"].'</td>
                    <td>'.$value["fecha_inicio"].'</td> 
                    <td>'.$value["fecha_vencimiento"].'</td> 
                    <td>'.$value["tipo_cliente"].'</td> 
                    <td>'.$value["tipo_producto"].'</td> 

                    <td>

                        <div class="btn-group">
                      
                        <button class="btn btn-warning btnEditarMatriz" data-toggle="modal" data-target="#modalEditarMatriz" idMatriz="'.$value["id"].'"><i class="fa fa-pencil"></i></button>';

                      if($_SESSION["perfil"] == "Administrador"){

                          echo '<button class="btn btn-danger btnEliminarMatriz" idMatriz="'.$value["id"].'"><i class="fa fa-times"></i></button>';

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
  MODAL AGREGAR CLIENTE
  ======================================-->
<style>
  .error {
    color: red;
  }
</style>

<div id="modalCrearMatriz" class="modal fade" role="dialog">

  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form role="form" method="post" id="form_nueva_matriz">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
        <div class="modal-header" style="background:#3f668d; color:white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Crear matriz</h4>
        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
        <div class="modal-body">
          <div class="box-body">

            <h4 class="box-title" style="font-weight:bold; margin-bottom: 10px;">Datos de matriz</h4>
            <div class="box box-info">
              <div class="box-body">
                <div class="form-group row">

                  <!-- Razón Social -->
                  <div class="col-lg-6 col-xs-6">
                        <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold;margin-top:10px">Razón social</div>
                        <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-user"></i></span>
                      <input type="text" class="form-control" name="nuevaMatriz" id="nuevaMatriz" placeholder="Ingrese razón social" required>
                    </div>
                  </div>

                  <!-- RUT -->
                  <div class="col-lg-6 col-xs-6 ">
                        <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold;margin-top:10px">RUT</div>
                        <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-user"></i></span>
                      <input type="text" class="form-control input" name="nuevoRut" id="nuevoRut"  placeholder="Ingresar Rut" required onblur="formatearRut(this)">
                    </div>
                  </div>

                  

                  <!-- Region -->
                  <div class="col-xs-6">
                        <div class="d-inline-block text-center " style="font-size:16px;font-weight:bold">Región</div>
                          <div class="input-group">
                      
                            <span class="input-group-addon"><i class="fa fa-globe"></i></span> 

                            <select class="form-control input" id="nuevaRegion" name="nuevaRegion" required>
                                                                            
                                <option  value="">Seleccionar región</option>

                                <?php
                                $regiones = ControladorRegiones::ctrMostrarRegiones(null, null); // Consultar todas las regiones
                                foreach ($regiones as $region) {
                                    echo '<option value="'.$region["id"].'">'.$region["nombre"].'</option>';
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

                   
                  <!-- País -->
                  <div class="col-lg-6 col-xs-6">
                        <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold;margin-top:10px">País</div>
                        <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-globe"></i></span>
                      <input type="text" class="form-control" name="nuevoPais" id="nuevoPais" placeholder="Ingrese país" required value="Chile">
                    </div>
                  </div>    

                  <!-- Dirección -->
                  <div class="col-lg-6 col-xs-6">
                          <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold;margin-top:10px">Dirección</div>
                          <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-bookmark"></i></span>
                      <input type="text" class="form-control" name="nuevaDireccion" id="nuevaDireccion" placeholder="Ingrese dirección" required>
                    </div>
                  </div>

                  <!-- Ejecutivo -->
                  <div class="col-lg-6 col-xs-6 ">
                          <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold;margin-top:10px">Ejecutivo</div>
                            <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-user"></i></span>
                      <input type="text" class="form-control" name="nuevoEjecutivo" id="nuevoEjecutivo" placeholder="Ingresar ejecutivo" required>
                    </div>
                  </div>

                  <!-- Teléfono -->
                  <div class="col-lg-6">
                        <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold;margin-top:10px">Número de teléfono</div>
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
                          this.setCustomValidity(this.validity.patternMismatch ? 'Ingrese el número de teléfono completo.' 
                          : '');">

                        </div>
                  </div>

                  <!-- Correo Electrónico -->
                  <div class="col-lg-6 col-xs-6 ">
                        <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold;margin-top:10px">Correo electrónico</div>
                          <div class="input-group">
                          
                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                            <input type="text" class="form-control input" name="nuevoEmail" id="nuevoEmail"
                            placeholder="Ingresar email" required
                            pattern="^[^@]+@[^@]+\.[a-zA-Z]{2,}$"
                            title="El email debe contener un arroba (@) y un punto (.) después del arroba">
                    </div>
                  </div>

                  <!-- Actividad -->
                  <div class="col-lg-6 col-xs-6 ">
                        <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold;margin-top:10px">Actividad</div>
                          <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-industry"></i></span>
                      <input type="text" class="form-control" name="nuevaActividad" id="nuevaActividad" placeholder="Ingresar Actividad" required>
                    </div>
                  </div>

                </div>
              </div>
            </div>
 
            <!-- Actividad -->
            <h4 class="box-title" style="font-weight:bold; margin-bottom: 10px;">Datos de servicio</h4>
            <div class="box box-success">
              <div class="box-body">
                <div class="form-group row">

                  <!-- Fecha Inicio Servicio -->
                  <div class="col-lg-5 ">
                          <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold;margin-top:10px">Fecha inicio servicio</div>
                            <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                      <input type="date" class="form-control" name="nuevoInicio" id="nuevoInicio" required>
                    </div>
                  </div>

                  <!-- Fecha Vcto Servicio -->
                  <div class="col-lg-5 col-xs-offset-1">
                          <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold;margin-top:10px">Fecha vcto. servicio</div>
                            <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                      <input type="date" class="form-control" name="nuevoVencimiento" id="nuevoVencimiento" required>
                    </div>
                  </div>

                  <!-- Tipo Cliente -->
                  <div class="col-lg-5">
                          <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold;margin-top:10px">Tipo cliente</div>
                            <div class="input-group">
                            
                              <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 

                              <select class="form-control input" id="nuevoTipoCliente" name="nuevoTipoCliente" required>
          
                              <option value="">Tipo de cliente</option>
                              <?php

                                $item = null;
                                $valor = null;

                                $campaña = ControladorTipoClientes::ctrMostrarTipoClientes($item, $valor);

                                foreach ($campaña as $key => $value){
                                echo '<option  value="'.$value["nombre"].'">'.$value["nombre"].' </option>';
                                }

                                ?>
                              </select>

                            </div>
                  </div>

                  <!-- Tipo Producto -->
                  <div class="col-lg-5 col-xs-offset-1 ">
                          <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold;margin-top:10px">Tipo producto</div>
                            <div class="input-group">
                            
                              <span class="input-group-addon"><i class="fa fa-briefcase "></i></span> 

                              <select class="form-control input" id="nuevoTipoProducto" name="nuevoTipoProducto" required>
          
                              <option value="">Tipo de producto</option>
                              <?php

                                $item = null;
                                $valor = null;

                                $producto= ControladorTipoProductos::ctrMostrarTipoProductos($item, $valor);

                                foreach ($producto as $key => $value){
                                echo '<option  value="'.$value["nombre"].'">'.$value["nombre"].' </option>';
                                }

                                ?>
                              </select>
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
          <button type="submit" class="btn btn-primary">Guardar matriz</button>
        </div>

      </form>

      <?php

      $crearMatriz = new ControladorMatrices();
      $crearMatriz->ctrCrearMatriz();

      ?>

    </div>
  </div>
</div>


<!--=====================================
  MODAL EDITAR MATRIZ
  ======================================-->

  <div id="modalEditarMatriz" class="modal fade" role="dialog">  
  
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form role="form" method="post" id="form_editar_matriz">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3f668d; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar matriz</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL, REGION, CIUDAD, DIRECCION
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <h4 class="box-title" style="font-weight:bold;margin:auto;margin-bottom:4px;">Datos de matriz</h4>
              <div class="box box-info">
                <div class="box-body">                
                  <div class="form-group row">
                    
                  <!-- RAZON SOCIAL -->
                      <div class="col-lg-6 col-xs-6">
                        <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold;margin-top:10px">Razón social</div>
                        <div class="input-group">
                        
                          <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                          <input type="hidden" name="idMatriz" id="idMatriz">
                          <input type="text" class="form-control input" name="editarMatriz" id="editarMatriz"  required>

                        </div>
                      </div>

                      <!-- RUT -->
                      <div class="col-lg-6 col-xs-6 ">
                        <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold;margin-top:10px">RUT</div>
                        <div class="input-group">
                        
                          <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                          <input type="text" class="form-control input" name="editarRut" id="editarRut"  placeholder="Ingresar RUT" required onblur="formatearRut(this)">

                        </div>
                      </div>
                    
                      
                      <!-- REGION -->
                      <div class="col-xs-6">
                        <div class="d-inline-block text-center " style="font-size:16px;font-weight:bold">Región</div>
                          <div class="input-group">
                      
                            <span class="input-group-addon"><i class="fa fa-globe"></i></span> 

                            <select class="form-control input" id="editarRegion" name="editarRegion" required>
                                                                            
                                <option  value="">Seleccionar región</option>

                                <?php

                                $item = null;
                                $valor = null;
                                $regiones = ControladorRegiones::ctrMostrarRegiones(null, null); // Consultar todas las regiones
                                foreach ($regiones as $region) {
                                    echo '<option value="'.$region["id"].'">'.$region["nombre"].'</option>';
                                  }
                                  ?>
            
                            </select>

                          </div>
                      </div>

                  <!-- CIUDAD -->
                      <div class="col-xs-6">
                          <div class="d-block text-center" style="font-size:16px;font-weight:bold">Comuna</div>
                            <div class="input-group">
                            
                              <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 

                                <select class="form-control input" id="editarComuna" name="editarComuna" required>
                                                                              
                                    <option value="">Seleccionar comuna</option>
              
                                </select>

                            </div>
                      </div>

                      <!-- PAIS -->
                      <div class="col-lg-6 col-xs-6">
                        <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold;margin-top:10px">País</div>
                        <div class="input-group">
                        
                          <span class="input-group-addon"><i class="fa fa-globe"></i></span> 

                          <input type="text" class="form-control input" name="editarPais" id="editarPais" required >

                        </div>
                      </div>

                      <!-- Dirección -->
                      <input type="hidden" id="comunaActual" value="<?php echo $cliente['comuna']; ?>">
                      
                      <div class="col-lg-6 col-xs-6">
                          <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold;margin-top:10px">Dirección</div>
                          <div class="input-group">
                          
                          <span class="input-group-addon"><i class="fa fa-bookmark"></i></span> 

                          <input type="text" class="form-control input" name="editarDireccion" id="editarDireccion" required>

                          </div>
                      </div>

                      <!-- EJECUTIVO -->
                      <div class="col-lg-6 col-xs-6 ">
                          <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold;margin-top:10px">Ejecutivo</div>
                            <div class="input-group">
                            
                              <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                              <input type="text" class="form-control input" name="editarEjecutivo" id="editarEjecutivo"  required>

                            </div>
                      </div>

                      <!-- TELEFONO -->
                      <div class="col-lg-6">
                        <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold;margin-top:10px">Número de teléfono</div>
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
                            this.setCustomValidity(this.validity.patternMismatch ? 'Ingrese el número de teléfono completo.' 
                            : '');">

                          </div>
                      </div>

                      <!-- CORREO -->
                      <div class="col-lg-6 col-xs-6 ">
                        <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold;margin-top:10px">Correo electrónico</div>
                          <div class="input-group">
                          
                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                            <input type="text" class="form-control input" name="editarEmail" id="editarEmail"
                            placeholder="Ingresar email" required
                            pattern="^[^@]+@[^@]+\.[a-zA-Z]{2,}$"
                            title="El email debe contener un arroba (@) y un punto (.) después del arroba">

                          </div>
                      </div>

                      <!-- ACTIVIDAD -->
                      <div class="col-lg-6 col-xs-6 ">
                        <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold;margin-top:10px">Actividad</div>
                          <div class="input-group">
                          
                            <span class="input-group-addon"><i class="fa fa-industry"></i></span> 

                            <input type="text" class="form-control input" name="editarActividad" id="editarActividad"  required>

                          </div>
                      </div>
                      
                  </div> 
                </div>  
              </div>


              <!-- DATOS DE SERVICIO -->
              <h4 class="box-title" style="font-weight:bold;margin:auto;margin-bottom:4px;">Datos de servicio</h4>
                <div class="box box-success">
                  <div class="box-body">
                    <div class="form-group row">

                    <!-- FECHA INICIO -->
                        <div class="col-lg-5 ">
                          <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold;margin-top:10px">Fecha inicio servicio</div>
                            <div class="input-group">
                            
                              <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 

                              <input type="date" class="form-control input" name="editarInicio" id="editarInicio"  required>

                            </div>
                        </div>

                        <!-- FECHA VENCIMIENTO -->
                        <div class="col-lg-5 col-xs-offset-1">
                          <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold;margin-top:10px">Fecha vcto. servicio</div>
                            <div class="input-group">
                            
                              <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 

                              <input type="date" class="form-control input" name="editarVencimiento" id="editarVencimiento" required>

                            </div>
                        </div>

                        <!-- TIPO CAMPAÑA -->
                        <div class="col-lg-5">
                          <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold;margin-top:10px">Tipo cliente</div>
                            <div class="input-group">
                            
                              <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 

                              <select class="form-control input" id="editarTipoCliente" name="editarTipoCliente" required>
          
                              <option value="">Tipo de cliente</option>
                              <?php

                                $item = null;
                                $valor = null;

                                $campaña = ControladorTipoClientes::ctrMostrarTipoClientes($item, $valor);

                                foreach ($campaña as $key => $value){
                                echo '<option  value="'.$value["nombre"].'">'.$value["nombre"].' </option>';
                                }

                                ?>
                              </select>

                            </div>
                        </div>

                        <!-- TIPO PRODUCTO -->
                        <div class="col-lg-5 col-xs-offset-1 ">
                          <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold;margin-top:10px">Tipo producto</div>
                            <div class="input-group">
                            
                              <span class="input-group-addon"><i class="fa fa-briefcase "></i></span> 

                              <select class="form-control input" id="editarTipoProducto" name="editarTipoProducto" required>
          
                              <option value="">Tipo de producto </option>
                              <?php

                                $item = null;
                                $valor = null;

                                $producto= ControladorTipoProductos::ctrMostrarTipoProductos($item, $valor);

                                foreach ($producto as $key => $value){
                                echo '<option  value="'.$value["nombre"].'">'.$value["nombre"].' </option>';
                                }

                                ?>
                              </select>
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

          <button type="submit" class="btn btn-primary">Editar matriz</button>

        </div>

      </form>

      <?php

        $editarMatriz = new ControladorMatrices();
        $editarMatriz -> ctrEditarMatriz();

      ?>

    </div>

  </div>

</div>

<?php

  $eliminarMatriz = new ControladorMatrices();
  $eliminarMatriz -> ctrEliminarMatriz();

?>

<script>
$(document).ready(function() {
    $('#nuevaRegion').change(function() {
        var selectedValue = $(this).val();

        $.ajax({
            url: './vistas/modulos/obtenerRegiones.php',
            data: { id: selectedValue },
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
            data: { id: selectedValue },
            type: 'POST',
            success: function(response) {
              console.log(response)
                $('#editarComuna').html(response);
            }
        });
    });
});
  </script>
  