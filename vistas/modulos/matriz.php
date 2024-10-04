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
      Administrar Matriz
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Matriz</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
      <?php
        if($_SESSION["nombre"] == "MLINE"){
          echo '<button class="btn btn-primary" data-toggle="modal" data-target="#modalCrearMatriz">
          
         Crear Matriz

        </button>';
        }
      ?>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           <th>Razon Social</th>
           <th>RUT</th>
           <th>Actividad</th>
           <th>Region</th>
           <th>Comuna</th>
           <th>Direccion</th>
           <th>Ejecutivo</th>
           <th>Telefono</th>
           <th>Correo</th>
           <th>Inicio Servicio</th>
           <th>Vcto. Servicio</th>
           <th>Tipo Cliente</th>
           <th>Tipo Producto</th>
           <th>Acciones</th>
         </tr> 

        </thead>

        <tbody>

        <?php
          $item = null;
          $valor = null;

          $matrices = ControladorMatrices::ctrMostrarMatrices($item, $valor);

          foreach ($matrices as $key => $value) {

            echo '<tr>

                    <td>'.$value["razon_social"].'</td>
                    <td>'.$value["rut"].'</td> 
                    <td>'.$value["actividad"].'</td>
                    <td>'.$value["region"].'</td>
                    <td>'.$value["comuna"].'</td>
                    <td>'.$value["direccion"].'</td>  
                    <td>'.$value["ejecutivo"].'</td> 
                    <td>'.$value["telefono"].'</td> 
                    <td>'.$value["email"].'</td>
                    <td>'.$value["fecha_inicio"].'</td> 
                    <td>'.$value["fecha_vencimiento"].'</td> 
                    <td>'.$value["tipo_cliente"].'</td> 
                    <td>'.$value["tipo_producto"].'</td>  

                    <td>

                        <div class="btn-group">';

                            if($_SESSION["perfil"] == "Administrador" && $_SESSION["nombre"] == "MLINE"){
                                echo '<button class="btn btn-warning btnEditarMatriz" idMatriz="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarMatriz"><i class="fa fa-pencil"></i></button>;
                                <button class="btn btn-danger btnEliminarMatriz" idMatriz="'.$value["id"].'"><i class="fa fa-times"></i></button>';

                            }if($_SESSION["perfil"] == "Administrador"){
                                echo '<button class="btn btn-success btnEditarMatrizCliente" idMatrizCliente="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarMatrizCliente"><i class="fa fa-pencil"></i></button>';
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
  .error{
    color: red;
  }
</style>
<!--
  <div id="modalCrearMatriz" class="modal fade"  role="dialog">
    
    <div class="modal-dialog modal-lg">

      <div class="modal-content">

        <form role="form" method="post" id="form_nueva_matriz" enctype="multipart/form-data">

      

          <div class="modal-header" style="background:#3f668d; color:white">

            <button type="button" class="close" data-dismiss="modal">&times;</button>

            <h4 class="modal-title">Crear Matriz</h4>

          </div>


          <div class="modal-body">

            <div class="box-body">
              
              <h4 class="box-title" style="font-weight:bold;margin:auto;margin-bottom:4px;">Datos Matriz</h4>
              <div class="box box-info">
                <div class="box-body">                
                    <div class="form-group row">              
                      <div class="col-lg-5">
                        <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold;margin-top:10px">Razon Social</div>
                        <div class="input-group">
                        
                          <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                          <input type="text" class="form-control input" name="nuevaMatriz" id="nuevaMatriz" placeholder="Ingrese Razon Social" required>

                        </div>
                      </div>             
                      <div class="col-lg-5 col-xs-offset-1">
                        <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold;margin-top:10px">Region</div>
                        <div class="input-group">
                        
                          <span class="input-group-addon"><i class="fa fa-globe"></i></span> 

                          <input type="text" class="form-control input" name="nuevaRegion" id="nuevaRegion" placeholder="Ingrese Region" required>

                        </div>
                      </div>
                      <div class="col-lg-5">
                          <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold;margin-top:10px">Direccion</div>
                          <div class="input-group">
                          
                          <span class="input-group-addon"><i class="fa fa-globe"></i></span> 

                          <input type="text" class="form-control input" name="nuevaDireccion" id="nuevaDireccion" placeholder="Ingrese Direccion" required>

                          </div>
                      </div>
                      <div class="col-lg-5 col-xs-offset-1">
                          <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold;margin-top:10px">Ejecutivo</div>
                            <div class="input-group">
                            
                              <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                              <input type="text" class="form-control input" name="nuevoEjecutivo" id="nuevoEjecutivo" placeholder="Ingresar Ejecutivo" required>

                            </div>
                      </div>
                      <div class="col-lg-5">
                        <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold;margin-top:10px">Numero de Telefono</div>
                          <div class="input-group">
                          
                            <span class="input-group-addon"><i class="fa fa-phone"></i></span> 

                            <input type="tel" class="form-control input" name="nuevoTelefono" id="nuevoTelefono" placeholder="Ingresar teléfono" required>

                          </div>
                      </div>
                      <div class="col-lg-5 col-xs-offset-1">
                        <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold;margin-top:10px">Correo Electronico</div>
                          <div class="input-group">
                          
                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 

                            <input type="text" class="form-control input" name="nuevoEmail" id="nuevoEmail" placeholder="Ingresar Email" required>

                          </div>
                      </div>
                      <div class="col-lg-5">
                        <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold;margin-top:10px">Actividad</div>
                          <div class="input-group">
                          
                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 

                            <input type="text" class="form-control input" name="nuevaActividad" id="nuevaActividad" placeholder="Ingresar Actividad" required>

                          </div>
                      </div>
                    <div>
                </div>
              </div>    
              <h4 class="box-title" style="font-weight:bold;margin:auto;margin-bottom:4px;">Datos de Servicio</h4>
                <div class="box box-success">
                  <div class="box-body">
                    <div class="form-group row">
                        <div class="col-lg-5 ">
                          <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold;margin-top:10px">Fecha Inicio Servicio</div>
                            <div class="input-group">
                            
                              <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 

                              <input type="date" class="form-control input" name="nuevaActividad" id="nuevoInicio" placeholder="Ingresar Actividad" required>

                            </div>
                        </div>
                        <div class="col-lg-5 col-xs-offset-1">
                          <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold;margin-top:10px">Fecha Vcto Servicio</div>
                            <div class="input-group">
                            
                              <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 

                              <input type="date" class="form-control input" name="nuevaActividad" id="nuevaActividad" placeholder="Ingresar Actividad" required>

                            </div>
                        </div>
                        <div class="col-lg-5">
                          <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold;margin-top:10px">Tipo Cliente</div>
                            <div class="input-group">
                            
                              <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 

                              <input type="text" class="form-control input" name="nuevaActividad" id="nuevaActividad" placeholder="Ingresar Actividad" required>

                            </div>
                        </div>
                        <div class="col-lg-5 col-xs-offset-1 ">
                          <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold;margin-top:10px">Tipo Producto</div>
                            <div class="input-group">
                            
                              <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 

                              <input type="text" class="form-control input" name="nuevaActividad" id="nuevaActividad" placeholder="Ingresar Actividad" required>

                            </div>
                        </div>
                    </div>    
                  </div>
                </div>  
            </div>

          </div>


              <div class="modal-footer">

                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

                <button type="submit" class="btn btn-primary text-center">Guardar Matriz</button>

              </div>
        

        </form>
 

      </div>

    </div>

  </div>
 --> 
<div id="modalCrearMatriz" class="modal fade" role="dialog">  
  
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form role="form" method="post" id="form_nueva_matriz">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3f668d; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Matriz</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL, REGION, CIUDAD, DIRECCION
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <h4 class="box-title" style="font-weight:bold;margin:auto;margin-bottom:4px;">Datos de Matriz</h4>
              <div class="box box-info">
                <div class="box-body">                
                  <div class="form-group row">              
                      <div class="col-lg-6 col-xs-6">
                        <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold;margin-top:10px">Razon Social</div>
                        <div class="input-group">
                        
                          <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                          <input type="text" class="form-control input" name="nuevaMatriz" id="nuevaMatriz" placeholder="Ingrese Razon Social" required>

                        </div>
                      </div>
                      <div class="col-lg-6 col-xs-6 ">
                        <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold;margin-top:10px">RUT</div>
                        <div class="input-group">
                        
                          <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                          <input type="text" class="form-control input" name="nuevoRut" id="nuevoRut" placeholder="Ejemplo: 76948123-5" required>

                        </div>
                      </div>              
                      <div class="col-lg-6 col-xs-6">
                        <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold;margin-top:10px">Pais</div>
                        <div class="input-group">
                        
                          <span class="input-group-addon"><i class="fa fa-globe"></i></span> 

                          <input type="text" class="form-control input" name="nuevoPais" id="nuevoPais" placeholder="Ingrese Pais" required value="Chile">

                        </div>
                      </div>
                         
                      <div class="col-lg-6 col-xs-6">
                        <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold;margin-top:10px">Region</div>
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
                      <div class=" col-lg-6 col-xs-6">
                          <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold;margin-top:10px">Comuna</div>
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
                      
                      <div class="col-lg-6 col-xs-6">
                          <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold;margin-top:10px">Direccion</div>
                          <div class="input-group">
                          
                          <span class="input-group-addon"><i class="fa fa-bookmark"></i></span> 

                          <input type="text" class="form-control input" name="nuevaDireccion" id="nuevaDireccion" placeholder="Ingrese Direccion" required>

                          </div>
                      </div>
                      <div class="col-lg-6 col-xs-6 ">
                          <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold;margin-top:10px">Ejecutivo</div>
                            <div class="input-group">
                            
                              <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                              <input type="text" class="form-control input" name="nuevoEjecutivo" id="nuevoEjecutivo" placeholder="Ingresar Ejecutivo" required>

                            </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold;margin-top:10px">Numero de Telefono</div>
                          <div class="input-group">
                          
                            <span class="input-group-addon"><i class="fa fa-phone"></i></span> 

                            <input type="tel" class="form-control input" name="nuevoTelefono" id="nuevoTelefono" placeholder="Ingresar teléfono" required>

                          </div>
                      </div>
                      <div class="col-lg-6 col-xs-6 ">
                        <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold;margin-top:10px">Correo Electronico</div>
                          <div class="input-group">
                          
                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 

                            <input type="text" class="form-control input" name="nuevoEmail" id="nuevoEmail" placeholder="Ingresar Email" required>

                          </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold;margin-top:10px">Actividad</div>
                          <div class="input-group">
                          
                            <span class="input-group-addon"><i class="fa fa-industry"></i></span> 

                            <input type="text" class="form-control input" name="nuevaActividad" id="nuevaActividad" placeholder="Ingresar Actividad" required>

                          </div>
                      </div>
                      
                  </div> 
                </div>  
              </div>

              <h4 class="box-title" style="font-weight:bold;margin:auto;margin-bottom:4px;">Datos de Servicio</h4>
                <div class="box box-success">
                  <div class="box-body">
                    <div class="form-group row">
                        <div class="col-lg-5 ">
                          <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold;margin-top:10px">Fecha Inicio Servicio</div>
                            <div class="input-group">
                            
                              <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 

                              <input type="date" class="form-control input" name="nuevoInicio" id="nuevoInicio"  required>

                            </div>
                        </div>
                        <div class="col-lg-5 col-xs-offset-1">
                          <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold;margin-top:10px">Fecha Vcto Servicio</div>
                            <div class="input-group">
                            
                              <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 

                              <input type="date" class="form-control input" name="nuevoVencimiento" id="nuevoVencimiento" required>

                            </div>
                        </div>
                        <div class="col-lg-5">
                          <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold;margin-top:10px">Tipo Cliente</div>
                            <div class="input-group">
                            
                              <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 

                              <select class="form-control input" id="nuevoTipoCliente" name="nuevoTipoCliente" required>
          
                              <option value="">Tipo de Cliente</option>
                              <option value="SERCOTEC">SERCOTEC </option>
                              <option value="Otro">Otro</option>
                              </select>

                            </div>
                        </div>
                        <div class="col-lg-5 col-xs-offset-1 ">
                          <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold;margin-top:10px">Tipo Producto</div>
                            <div class="input-group">
                            
                              <span class="input-group-addon"><i class="fa fa-briefcase "></i></span> 

                              <select class="form-control input" id="nuevoTipoProducto" name="nuevoTipoProducto" required>
          
                              <option value="">Tipo de Producto </option>
                              <option value="POS PyMe">POS PyMe </option>
                              <option value="POS Basico">POS Basico</option>
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

          <button type="submit" class="btn btn-primary">Guardar Matriz</button>

        </div>

      </form>

      <?php

        $crearMatriz = new ControladorMatrices();
        $crearMatriz -> ctrCrearMatriz();

      ?>

    </div>

  </div>

</div>

<div id="modalEditarMatriz" class="modal fade" role="dialog">  
  
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form role="form" method="post" id="form_nueva_matriz">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3f668d; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Matriz</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL, REGION, CIUDAD, DIRECCION
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <h4 class="box-title" style="font-weight:bold;margin:auto;margin-bottom:4px;">Datos de Matriz</h4>
              <div class="box box-info">
                <div class="box-body">                
                  <div class="form-group row">              
                      <div class="col-lg-6 col-xs-6">
                        <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold;margin-top:10px">Razon Social</div>
                        <div class="input-group">
                        
                          <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                          <input type="hidden" name="idMatriz" id="idMatriz">
                          <input type="text" class="form-control input" name="editarMatriz" id="editarMatriz"  required>

                        </div>
                      </div>
                      <div class="col-lg-6 col-xs-6 ">
                        <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold;margin-top:10px">RUT</div>
                        <div class="input-group">
                        
                          <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                          <input type="text" class="form-control input" name="editarRut" id="editarRut"  required>

                        </div>
                      </div>              
                      <div class="col-lg-6 col-xs-6">
                        <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold;margin-top:10px">Pais</div>
                        <div class="input-group">
                        
                          <span class="input-group-addon"><i class="fa fa-globe"></i></span> 

                          <input type="text" class="form-control input" name="editarPais" id="editarPais" required >

                        </div>
                      </div>
                         
                      <div class="col-lg-6 col-xs-6">
                        <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold;margin-top:10px">Region</div>
                          <div class="input-group">
                      
                            <span class="input-group-addon"><i class="fa fa-globe"></i></span> 

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
                  <!-- ENTRADA PARA LA CIUDAD -->
                      <div class=" col-lg-6 col-xs-6">
                          <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold;margin-top:10px">Comuna</div>
                            <div class="input-group">
                            
                              <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 

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
                      
                      <div class="col-lg-6 col-xs-6">
                          <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold;margin-top:10px">Direccion</div>
                          <div class="input-group">
                          
                          <span class="input-group-addon"><i class="fa fa-bookmark"></i></span> 

                          <input type="text" class="form-control input" name="editarDireccion" id="editarDireccion" required>

                          </div>
                      </div>
                      <div class="col-lg-6 col-xs-6 ">
                          <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold;margin-top:10px">Ejecutivo</div>
                            <div class="input-group">
                            
                              <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                              <input type="text" class="form-control input" name="editarEjecutivo" id="editarEjecutivo"  required>

                            </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold;margin-top:10px">Numero de Telefono</div>
                          <div class="input-group">
                          
                            <span class="input-group-addon"><i class="fa fa-phone"></i></span> 

                            <input type="tel" class="form-control input" name="editarTelefono" id="editarTelefono"  required>

                          </div>
                      </div>
                      <div class="col-lg-6 col-xs-6 ">
                        <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold;margin-top:10px">Correo Electronico</div>
                          <div class="input-group">
                          
                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 

                            <input type="text" class="form-control input" name="editarEmail" id="editarEmail"  required>

                          </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold;margin-top:10px">Actividad</div>
                          <div class="input-group">
                          
                            <span class="input-group-addon"><i class="fa fa-industry"></i></span> 

                            <input type="text" class="form-control input" name="editarActividad" id="editarActividad"  required>

                          </div>
                      </div>
                      
                  </div> 
                </div>  
              </div>

              <h4 class="box-title" style="font-weight:bold;margin:auto;margin-bottom:4px;">Datos de Servicio</h4>
                <div class="box box-success">
                  <div class="box-body">
                    <div class="form-group row">
                        <div class="col-lg-5 ">
                          <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold;margin-top:10px">Fecha Inicio Servicio</div>
                            <div class="input-group">
                            
                              <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 

                              <input type="date" class="form-control input" name="editarFechaInicio" id="editarFechaInicio"  required>

                            </div>
                        </div>
                        <div class="col-lg-5 col-xs-offset-1">
                          <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold;margin-top:10px">Fecha Vcto Servicio</div>
                            <div class="input-group">
                            
                              <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 

                              <input type="date" class="form-control input" name="editarFechaVencimiento" id="editarFechaVencimiento" required>

                            </div>
                        </div>
                        <div class="col-lg-5">
                          <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold;margin-top:10px">Tipo Campaña</div>
                            <div class="input-group">
                            
                              <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 

                              <select class="form-control input" id="editarTipoCliente" name="editarTipoCliente" required>
          
                              <option value="">Tipo de Cliente</option>
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
                        <div class="col-lg-5 col-xs-offset-1 ">
                          <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold;margin-top:10px">Tipo Producto</div>
                            <div class="input-group">
                            
                              <span class="input-group-addon"><i class="fa fa-briefcase "></i></span> 

                              <select class="form-control input" id="editarTipoProducto" name="editarTipoProducto" required>
          
                              <option value="">Tipo de Producto </option>
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

          <button type="submit" class="btn btn-primary">Editar Matriz</button>

        </div>

      </form>

      <?php

        $editarMatriz = new ControladorMatrices();
        $editarMatriz -> ctrEditarMatriz();

      ?>

    </div>

  </div>

</div>

<div id="modalEditarMatrizCliente" class="modal fade" role="dialog">  
  
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form role="form" method="post" id="form_nueva_matriz">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3f668d; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Matriz</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL, REGION, CIUDAD, DIRECCION
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <h4 class="box-title" style="font-weight:bold;margin:auto;margin-bottom:4px;">Datos de Matriz</h4>
              <div class="box box-info">
                <div class="box-body">                
                  <div class="form-group row">              
                      <div class="col-lg-6 col-xs-6">
                        <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold;margin-top:10px">Razon Social</div>
                        <div class="input-group">
                        
                          <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                          <input type="hidden" name="idMatrizCliente" id="idMatrizCliente">
                          <input type="text" class="form-control input" name="editarMatrizCliente" id="editarMatrizCliente"  required>

                        </div>
                      </div>
                      <div class="col-lg-6 col-xs-6 ">
                        <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold;margin-top:10px">RUT</div>
                        <div class="input-group">
                        
                          <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                          <input type="text" class="form-control input" name="editarRutCliente" id="editarRutCliente"  required>

                        </div>
                      </div>              
                      <div class="col-lg-6 col-xs-6">
                        <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold;margin-top:10px">Pais</div>
                        <div class="input-group">
                        
                          <span class="input-group-addon"><i class="fa fa-globe"></i></span> 

                          <input type="text" class="form-control input" name="editarPaisCliente" id="editarPaisCliente" required >

                        </div>
                      </div>
                         
                      <div class="col-lg-6 col-xs-6">
                        <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold;margin-top:10px">Region</div>
                          <div class="input-group">
                      
                            <span class="input-group-addon"><i class="fa fa-globe"></i></span> 

                            <select class="form-control input" id="editarRegionCliente" name="editarRegionCliente" required>
                                                                            
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
                      <div class=" col-lg-6 col-xs-6">
                          <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold;margin-top:10px">Comuna</div>
                            <div class="input-group">
                            
                              <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 

                                <select class="form-control input" id="editarComunaCliente" name="editarComunaCliente" required>
                                                                              
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
                      
                      <div class="col-lg-6 col-xs-6">
                          <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold;margin-top:10px">Direccion</div>
                          <div class="input-group">
                          
                          <span class="input-group-addon"><i class="fa fa-bookmark"></i></span> 

                          <input type="text" class="form-control input" name="editarDireccionCliente" id="editarDireccionCliente" required>

                          </div>
                      </div>
                      <div class="col-lg-6 col-xs-6 ">
                          <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold;margin-top:10px">Ejecutivo</div>
                            <div class="input-group">
                            
                              <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                              <input type="text" class="form-control input" name="editarEjecutivoCliente" id="editarEjecutivoCliente"  required>

                            </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold;margin-top:10px">Numero de Telefono</div>
                          <div class="input-group">
                          
                            <span class="input-group-addon"><i class="fa fa-phone"></i></span> 

                            <input type="tel" class="form-control input" name="editarTelefonoCliente" id="editarTelefonoCliente"  required>

                          </div>
                      </div>
                      <div class="col-lg-6 col-xs-6 ">
                        <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold;margin-top:10px">Correo Electronico</div>
                          <div class="input-group">
                          
                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 

                            <input type="text" class="form-control input" name="editarEmailCliente" id="editarEmailCliente"  required>

                          </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold;margin-top:10px">Actividad</div>
                          <div class="input-group">
                          
                            <span class="input-group-addon"><i class="fa fa-industry"></i></span> 

                            <input type="text" class="form-control input" name="editarActividadCliente" id="editarActividadCliente"  required>

                          </div>
                      </div>
                      
                  </div> 
                </div>  
              </div>

              <h4 class="box-title" style="font-weight:bold;margin:auto;margin-bottom:4px;">Datos de Servicio</h4>
                <div class="box box-success">
                  <div class="box-body">
                    <div class="form-group row">
                        <div class="col-lg-5 ">
                          <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold;margin-top:10px">Fecha Inicio Servicio</div>
                            <div class="input-group">
                            
                              <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 

                              <input type="date" class="form-control input" name="editarInicioCliente" id="editarInicioCliente" readonly required>

                            </div>
                        </div>
                        <div class="col-lg-5 col-xs-offset-1">
                          <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold;margin-top:10px">Fecha Vcto Servicio</div>
                            <div class="input-group">
                            
                              <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 

                              <input type="date" class="form-control input" name="editarVencimientoCliente" id="editarVencimientoCliente" readonly required>

                            </div>
                        </div>
                        <div class="col-lg-5">
                          <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold;margin-top:10px">Tipo Campaña</div>
                            <div class="input-group">
                            
                              <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 

                              <select class="form-control input" id="editarTipoClienteCliente" name="editarTipoClienteCliente" disabled required>
          
                              <option value="">Tipo de Cliente</option>
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
                        <div class="col-lg-5 col-xs-offset-1 ">
                          <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold;margin-top:10px">Tipo Producto</div>
                            <div class="input-group">
                            
                              <span class="input-group-addon"><i class="fa fa-briefcase "></i></span> 

                              <select class="form-control input" id="editarTipoProductoCliente" name="editarTipoProductoCliente" required>
          
                              <option value="">Tipo de Producto </option>
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

          <button type="submit" class="btn btn-primary">Editar Matriz</button>

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



