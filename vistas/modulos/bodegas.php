<?php

if($_SESSION["perfil"] == "Especial"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

?>

<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar Bodegas
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar Bodegas</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarBodega">
          
          Agregar Bodega

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Bodega</th>
           <th>Region</th>
           <th>Comuna</th>
           <th>Direccion</th>
           <th>Jefe Encargado</th>
           <th>Teléfono</th>
           <th>Email</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

          $item = null;
          $valor = null;

          $bodegas = ControladorBodegas::ctrMostrarBodegas($item, $valor);

          foreach ($bodegas as $key => $value) {
            

            echo '<tr>

                    <td>'.($key+1).'</td>

                    <td>'.$value["nombre"].'</td>

                    <td>'.$value["region"].'</td>

                    <td>'.$value["comuna"].'</td>

                    <td>'.$value["direccion"].'</td>

                    <td>'.$value["jefe"].'</td>      

                    <td>'.$value["telefono"].'</td>

                    <td>'.$value["email"].'</td>


                    <td>

                      <div class="btn-group">
                          
                        <button class="btn btn-warning btnEditarBodega" data-toggle="modal" data-target="#modalEditarBodega" idBodega="'.$value["id"].'"><i class="fa fa-pencil"></i></button>';

                      if($_SESSION["perfil"] == "Administrador"){

                          echo '<button class="btn btn-danger btnEliminarBodega" idBodega="'.$value["id"].'"><i class="fa fa-times"></i></button>';

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
MODAL AGREGAR BODEGA
======================================-->
<style>
  .error{
    color: red;
  }
</style>

<div id="modalAgregarBodega" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" id="form_nueva_bodega">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3f668d; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Bodega</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL, REGION, CIUDAD, DIRECCION
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <h4 class="box-title" style="font-weight:bold;margin:auto;margin-bottom:4px;">Datos de Bodega</h4>
              <div class="box box-info">
                <div class="box-body">                
                  <div class="form-group row">              
                    <div class="col-lg-6">
                      <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold;">Nombre Bodega</div>
                      <div class="input-group">
                          
                          <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                          <input type="text" class="form-control input" name="nuevaBodega" placeholder="Ingresar Nombre Bodega" required>

                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="d-inline-block text-center " style="font-size:16px;font-weight:bold;">Region</div>
                          <div class="input-group">
                      
                            <span class="input-group-addon"><i class="fa fa-globe"></i></span> 

                            <select class="form-control input" id="nuevaRegion" name="nuevaRegion" required>
                                                                            
                                <option  value="">Seleccionar Region</option>

                                <?php

                                $item = null;
                                $valor = null;

                                $regiones = ControladorRegiones::ctrMostrarRegiones($item, $valor);

                                foreach ($regiones as $key => $value){
                                echo '<option  value="'.$value["nombre"].'">'.$value["nombre"].' '.$value["ordinal"].' </option>';
                                }

                                ?>
            
                            </select>


                          </div>
                      </div>   
                  <!-- ENTRADA PARA LA CIUDAD -->
                      <div class="col-lg-6" style="margin-top:10px;">
                          <div class="d-block text-center" style="font-size:16px;font-weight:bold">Comuna</div>
                            <div class="input-group">
                            
                              <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 

                                <select class="form-control input" id="nuevaComuna" name="nuevaComuna" required>
                                                                              
                                    <option value="">Seleccionar Comuna</option>

                                    <?php

                                    $item = null;
                                    $valor = null;

                                    
                                    $comunas = ControladorRegiones::ctrMostrarComunas($item, $valor);

                                    foreach ($comunas as $key => $value){
                                    echo '<option  value="'.$value["nombre"].'">'.$value["nombre"].' </option>';
                                    }

                                    ?>
              
                                </select>

                            </div>
                      </div>
                   
                    <!-- ENTRADA PARA LA SUBCATEGORIA -->                           
                      <div class="col-lg-6" style="margin-top:10px;">
                      <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold">Direccion</div>
                      <div class="input-group">
                          
                            <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 

                            <input type="text" class="form-control input" name="nuevaDireccion" placeholder="Ingresar Direccion" required>

                          </div>
                      </div>
                      
                  </div> 
                </div>  
              </div>

            <h4 class="box-title" style="font-weight:bold;margin:auto;margin-bottom:4px;">Datos de Contacto</h4>
            <div class="box box-success">
              <div class="box-body">                
                <div class="form-group row">              
                  <div class="col-lg-6">
                    <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold">Jefe Encargado</div>
                    <div class="input-group">
                        
                          <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                          <input type="tel" class="form-control input" name="nuevoJefe" placeholder="Ingresar Encargado" required>

                        </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="d-inline-block  text-center" style="font-size:16px;font-weight:bold">Telefono</div> 
                    <div class="input-group">
                      
                        <span class="input-group-addon"><i class="fa fa-phone"></i></span> 

                        <input type="tel" class="form-control input" name="nuevoTelefono" placeholder="Ingresar teléfono" required>

                      </div>
                  </div>
                 
                    <div class="col-lg-6" style="margin-top:10px;">
                        <div class="d-inline-block  text-center" style="font-size:16px;font-weight:bold">Correo Electronico</div> 
                        <div class="input-group">
                      
                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 

                        <input type="text" class="form-control input" name="nuevoEmail" placeholder="Ingresar email" required>

                      </div>
                    </div>                 
                  <!-- ENTRADA PARA LA SUBCATEGORIA -->                           
                    
                    
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

          <button type="submit" class="btn btn-primary">Guardar Bodega</button>

        </div>

      </form>

      <?php

        $crearBodega = new ControladorBodegas();
        $crearBodega -> ctrCrearBodega();

      ?>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR PROVEEDOR
======================================-->

<div id="modalEditarBodega" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" id="form_editar_proveedor">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3f668d; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Bodega</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <h4 class="box-title" style="font-weight:bold;margin:auto;margin-bottom:4px;">Datos de Bodega</h4>
              <div class="box box-info">
                <div class="box-body">                
                  <div class="form-group row">              
                    <div class="col-lg-6">
                      <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold;">Nombre Bodega</div>
                      <div class="input-group">
                          
                          <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                          <input type="hidden" name="idBodega" id="idBodega">
                          <input type="text" class="form-control input" name="editarBodega" id="editarBodega" placeholder="Ingresar Nombre Bodega" required>

                        </div>
                    </div>

                    <div class="col-lg-6">
                      <div class="d-inline-block  text-center" style="font-size:16px;font-weight:bold">Region</div> 
                      <div class="input-group">
                          
                          <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                          <select class="form-control input" id="editarRegion" name="editarRegion" required>
                                                                            
                                <option  value="">Seleccionar Region</option>

                                <?php

                                $item = null;
                                $valor = null;

                                $regiones = ControladorRegiones::ctrMostrarRegiones($item, $valor);

                                foreach ($regiones as $key => $value){
                                echo '<option  value="'.$value["nombre"].'">'.$value["nombre"].' '.$value["ordinal"].' </option>';
                                }

                                ?>
            
                            </select>


                        </div>
                    </div>
                    
                  
                      <div class="col-lg-6" style="margin-top:10px;">
                          <div class="d-inline-block  text-center" style="font-size:16px;font-weight:bold">Comuna</div> 
                          <div class="input-group">
                          
                            <span class="input-group-addon"><i class="fa fa-globe"></i></span> 

                            <select class="form-control input" id="editarComuna" name="editarComuna" required>

                            <option value="">Seleccionar Comuna</option>

                                    <?php

                                    $item = null;
                                    $valor = null;

                                    
                                    $comunas = ControladorRegiones::ctrMostrarComunas($item, $valor);

                                    foreach ($comunas as $key => $value){
                                    echo '<option  value="'.$value["nombre"].'">'.$value["nombre"].' </option>';
                                    }

                                    ?>
                          </select>

                          </div>
                      </div>                 
                    <!-- ENTRADA PARA LA SUBCATEGORIA -->                           
                      <div class="col-lg-6" style="margin-top:10px;">
                      <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold">Direccion</div>
                      <div class="input-group">
                          
                            <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 

                            <input type="text" class="form-control input" name="editarDireccion" id="editarDireccion" placeholder="Ingresar Direccion" required>

                          </div>
                      </div>
                      
                  </div> 
                </div>  
              </div>

            <h4 class="box-title" style="font-weight:bold;margin:auto;margin-bottom:4px;">Datos de Contacto</h4>
            <div class="box box-success">
              <div class="box-body">                
                <div class="form-group row">              
                  <div class="col-lg-6">
                    <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold">Jefe Encargado</div>
                    <div class="input-group">
                        
                          <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                          <input type="tel" class="form-control input" name="editarJefe" id="editarJefe" placeholder="Ingresar Encargado" required>

                        </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="d-inline-block  text-center" style="font-size:16px;font-weight:bold">Telefono</div> 
                    <div class="input-group">
                      
                        <span class="input-group-addon"><i class="fa fa-phone"></i></span> 

                        <input type="text" class="form-control input" name="editarTelefono" id="editarTelefono" placeholder="Ingresar teléfono" required>

                      </div>
                  </div>
                 
                    <div class="col-lg-6" style="margin-top:10px;">
                        <div class="d-inline-block  text-center" style="font-size:16px;font-weight:bold">Correo Electronico</div> 
                        <div class="input-group">
                      
                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 

                        <input type="text" class="form-control input" name="editarEmail" id="editarEmail" placeholder="Ingresar email" required>

                      </div>
                    </div>                 
                  <!-- ENTRADA PARA LA SUBCATEGORIA -->                           
                    
                    
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

        $editarBodega = new ControladorBodegas();
        $editarBodega -> ctrEditarBodega();

      ?>

    

    </div>

  </div>

</div>

<?php

  $eliminarBodega = new ControladorBodegas();
  $eliminarBodega -> ctrEliminarBodega();

?>

<script>
document.getElementById('nuevaRegion').addEventListener('change', function() {
    var regionId = this.value; // Obtener el ID de la región seleccionada

    // Verifica que haya una región seleccionada
    if (regionId !== "") {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'controladores/procesar_comunas.php', true); // Ajusta la ruta aquí
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onload = function() {
            if (xhr.status === 200) {
                console.log('Respuesta del servidor: ', xhr.responseText); // Verifica la respuesta

                var comunas = JSON.parse(xhr.responseText); // Parsear la respuesta en JSON
                var comunaSelect = document.getElementById('nuevaComuna');
                comunaSelect.innerHTML = '<option value="">Seleccionar Comuna</option>'; // Limpiar las opciones previas

                // Rellenar las opciones del select de comunas
                comunas.forEach(function(comuna) {
                    var option = document.createElement('option');
                    option.value = comuna.id; // Asumiendo que 'id' es el campo correcto
                    option.textContent = comuna.nombre; // Asumiendo que 'nombre' es el campo correcto
                    comunaSelect.appendChild(option);
                });
            }
        };

        // Enviar el ID de la región seleccionada al servidor
        xhr.send('regionId=' + regionId);
    } else {
        // Si no hay región seleccionada, limpiar el select de comunas
        document.getElementById('nuevaComuna').innerHTML = '<option value="">Seleccionar Comuna</option>';
    }
});

document.getElementById('editarRegion').addEventListener('change', function() {
    var regionId = this.value;
    var comunaActual = document.getElementById('comunaActual').value; // Obtener la comuna actual

    if (regionId !== "") {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'controladores/procesar_comunas.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onload = function() {
            if (xhr.status === 200) {
                var comunas = JSON.parse(xhr.responseText);
                var comunaSelect = document.getElementById('editarComuna');
                comunaSelect.innerHTML = '<option value="">Seleccionar Comuna</option>';

                comunas.forEach(function(comuna) {
                    var option = document.createElement('option');
                    option.value = comuna.id;
                    option.textContent = comuna.nombre;
                    if (comuna.id == comunaActual) {
                        option.selected = true; // Seleccionar la comuna actual
                    }
                    comunaSelect.appendChild(option);
                });
            }
        };

        xhr.send('regionId=' + regionId);
    } else {
        document.getElementById('editarComuna').innerHTML = '<option value="">Seleccionar Comuna</option>';
    }
});
  </script>


