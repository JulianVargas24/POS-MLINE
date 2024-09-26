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
      
     Kardex
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Kardex</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Fecha</th>
           <th>Tipo Dcto</th>
           <th>Folio</th>
           <th>Concepto</th>
           <th>Glosa</th>
           <th>Entrada</th>
           <th>Salida</th>
           <th>Saldo</th>
         </tr> 

        </thead>

        <tbody>

        <?php

          $item = null;
          $valor = null;

          $bodegas = ControladorBodegas::ctrMostrarBodega($item, $valor);

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

                    <td> </td>

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
          
            <div class="form-group row">
                <div class="d-block" style="margin-top: -5px" >
                <span class="badge" style="margin: -20px 0px 4px -10px;font-size: 16px;border-radius: 0px 12px 0px 0px;background-color:#3f668d;">Datos Bodega</span>
                </div>
              <!-- ENTRADA PARA EL NOMBRE -->
                  <div class="col-xs-6">
                    <div class="d-inline-block bg-primary" style="background-color:#3c8dbc;font-size:16px;font-weight:bold">
                    Nombre
                    </div> 
                      <div class="input-group">
                        
                        <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                        <input type="text" class="form-control input" name="nuevaBodega" placeholder="Ingresar Nombre Bodega" required>

                      </div>
                  </div>
              <!-- ENTRADA PARA EL RUT ID -->
                  <div class="col-xs-6">
                    <div class="d-inline-block bg-primary" style="background-color:#3c8dbc;font-size:16px;font-weight:bold">Region</div>
                      <div class="input-group">
                        
                        <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                        <select class="form-control input" id="nuevaRegion" name="nuevaRegion" required>
                        
                        <option value="">Seleccionar Region</option>

                        <?php

                        $item = null;
                        $valor = null;

                        $region = ControladorProveedores::ctrMostrarProveedores($item, $valor);

                        foreach ($proveedores as $key => $value) {
                          
                          echo '<option value="'.$value["id"].'">'.$value["razon_social"].'</option>';
                        }

                        ?>
        
                      </select>

                      </div>
                  </div>
            </div>
            
            <div class="form-group row">                
              <!-- ENTRADA PARA LA ACTIVIDAD -->
                  <div class="col-xs-6">
                      <div class="d-block bg-primary" style="background-color:#3c8dbc;font-size:16px;font-weight:bold">Actividad</div>  
                        <div class="input-group">
                        
                          <span class="input-group-addon"><i class="fa fa-globe"></i></span> 

                          <input type="text"  class="form-control input" name="nuevaActividad" placeholder="Ingrese Actividad">

                        </div>
                  </div>
              <!-- ENTRADA PARA LA CIUDAD -->
                  <div class="col-xs-6">
                      <div class="d-block bg-primary" style="background-color:#3c8dbc;font-size:16px;font-weight:bold">Ciudad</div>
                        <div class="input-group">
                        
                          <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 

                          <input type="text" class="form-control input" name="nuevaCiudad" placeholder="Ingresar ciudad" required>

                        </div>
                  </div>
            </div>

            <div class="form-group row">
              <div class="d-block">
              <span class="badge" style="margin: 0px 0px 10px -10px;font-size: 16px;border-radius: 0px 12px 0px 0px;background-color:#3f668d;">Datos Bancarios</span>
              </div>
              <!-- ENTRADA PARA EL N° CUENTA BANCARIA-->
                  <div class="col-xs-6">
                      <div class="d-block bg-primary" style="background-color:#3c8dbc;font-size:16px;font-weight:bold">Numero de Cuenta</div>
                        <div class="input-group">
                        
                          <span class="input-group-addon"><i class="fa fa-ticket"></i></span> 

                          <input type="text" class="form-control input" name="nuevoNroCuenta" placeholder="Ingresar N° Cuenta" required>

                        </div>
                  </div>
              <!-- ENTRADA PARA EL BANCO -->
                  <div class="col-xs-6">
                      <div class="d-block bg-primary" style="background-color:#3c8dbc;font-size:16px;font-weight:bold">Banco</div>
                        <div class="input-group">
                        
                          <span class="input-group-addon"><i class="fa fa-university"></i></span> 

                          <input type="text" class="form-control input" name="nuevoBanco" placeholder="Ingresar Banco" required>

                        </div>
                  </div>
            </div>

            <div class="form-group row">
              <div class="d-block">
              <span class="badge" style="margin: 0px 0px 10px -10px;font-size: 16px;border-radius: 0px 12px 0px 0px;background-color:#3f668d;">Datos de Contacto</span>
              </div>
              <!-- ENTRADA PARA EL TELEFONO-->
                  <div class="col-xs-6">
                    <div class="d-block bg-primary" style="background-color:#3c8dbc;font-size:16px;font-weight:bold">Numero de Telefono</div>
                      <div class="input-group">
                      
                        <span class="input-group-addon"><i class="fa fa-phone"></i></span> 

                        <input type="tel" class="form-control input" name="nuevoTelefono" placeholder="Ingresar teléfono" required>

                      </div>
                  </div>
              <!-- ENTRADA PARA EL EMAIL-->
                  <div class="col-xs-6">
                    <div class="d-block bg-primary" style="background-color:#3c8dbc;font-size:16px;font-weight:bold">Correo Electronico</div>
                      <div class="input-group">
                      
                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 

                        <input type="text" class="form-control input" name="nuevoEmail" placeholder="Ingresar email" required>

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

          <button type="submit" class="btn btn-primary">Guardar proveedor</button>

        </div>

      </form>

      <?php

        $crearProveedor = new ControladorProveedores();
        $crearProveedor -> ctrCrearProveedores();

      ?>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR PROVEEDOR
======================================-->

<div id="modalEditarProveedor" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" id="form_editar_proveedor">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3f668d; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Proveedor</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">
        
          <div class="box-body">

            <!-- ENTRADA PARA LA RAZON SOCIAL -->
  
            <div class="form-group row">
                <div class="d-block" style="margin-top: -5px" >
                  <span class="badge" style="margin: -20px 0px 4px -10px;font-size: 16px;border-radius: 0px 12px 0px 0px;background-color:#3f668d;">Datos Proveedor</span>
                </div>
                  <div class="col-xs-6">
                    <div class="d-inline-block bg-primary" style="background-color:#3c8dbc;font-size:16px;font-weight:bold">Razon Social</div>
                      <div class="input-group">
                      
                        <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                        <input type="text" class="form-control input" name="editarProveedor" id="editarProveedor" required>
                        <input type="hidden" id="idProveedor" name="idProveedor">
                      </div>
                  </div>
            

              <!-- ENTRADA PARA EL RUT ID -->         
           
                <div class="col-xs-6">
                  <div class="d-inline-block bg-primary" style="background-color:#3c8dbc;font-size:16px;font-weight:bold">RUT</div>
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                    <input type="text"  class="form-control input" name="editarRutId" id="editarRutId" required>

                  </div>
              </div>
            </div>

            <div class="form-group row">                
              <!-- ENTRADA PARA LA ACTIVIDAD -->
                  <div class="col-xs-6">
                      <div class="d-block bg-primary" style="background-color:#3c8dbc;font-size:16px;font-weight:bold">Actividad</div>  
                        <div class="input-group">
                        
                          <span class="input-group-addon"><i class="fa fa-globe"></i></span> 

                          <input type="text"  class="form-control input"  name="editarActividad" id="editarActividad" required>

                        </div>
                  </div>
              <!-- ENTRADA PARA LA CIUDAD -->
                  <div class="col-xs-6">
                      <div class="d-block bg-primary" style="background-color:#3c8dbc;font-size:16px;font-weight:bold">Ciudad</div>
                        <div class="input-group">
                        
                          <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 

                          <input type="text" class="form-control input"  name="editarCiudad" id="editarCiudad" required>

                        </div>
                  </div>
            </div>
          

            <div class="form-group row">
              <div class="d-block">
              <span class="badge" style="margin: 0px 0px 10px -10px;font-size: 16px;border-radius: 0px 12px 0px 0px;background-color:#3f668d;">Datos Bancarios</span>
              </div>
              <!-- ENTRADA PARA EL N° CUENTA BANCARIA-->
                  <div class="col-xs-6">
                      <div class="d-block bg-primary" style="background-color:#3c8dbc;font-size:16px;font-weight:bold">Numero de Cuenta</div>
                        <div class="input-group">
                        
                          <span class="input-group-addon"><i class="fa fa-ticket"></i></span> 

                          <input type="text" class="form-control input" name="editarNroCuenta" id="editarNroCuenta" placeholder="Ingresar N° Cuenta" required>

                        </div>
                  </div>
              <!-- ENTRADA PARA EL BANCO -->
                  <div class="col-xs-6">
                      <div class="d-block bg-primary" style="background-color:#3c8dbc;font-size:16px;font-weight:bold">Banco</div>
                        <div class="input-group">
                        
                          <span class="input-group-addon"><i class="fa fa-university"></i></span> 

                          <input type="text" class="form-control input" name="editarBanco" id="editarBanco" placeholder="Ingresar Banco" required>

                        </div>
                  </div>
            </div>
            
            <div class="form-group row">
              <div class="d-block">
              <span class="badge" style="margin: 0px 0px 10px -10px;font-size: 16px;border-radius: 0px 12px 0px 0px;background-color:#3f668d;">Datos de Contacto</span>
              </div>
              <!-- ENTRADA PARA EL TELEFONO-->
                  <div class="col-xs-6">
                    <div class="d-block bg-primary" style="background-color:#3c8dbc;font-size:16px;font-weight:bold">Numero de Telefono</div>
                      <div class="input-group">
                      
                        <span class="input-group-addon"><i class="fa fa-phone"></i></span> 

                        <input type="tel" class="form-control input" name="editarTelefono" id="editarTelefono"  required>

                      </div>
                  </div>
              <!-- ENTRADA PARA EL EMAIL-->
                  <div class="col-xs-6">
                    <div class="d-block bg-primary" style="background-color:#3c8dbc;font-size:16px;font-weight:bold">Correo Electronico</div>
                      <div class="input-group">
                      
                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 

                        <input type="text" class="form-control input" name="editarEmail" id="editarEmail" required>

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

        $editarProveedor = new ControladorProveedores();
        $editarProveedor -> ctrEditarProveedor();

      ?>

    

    </div>

  </div>

</div>

<?php

  $eliminarProveedor = new ControladorProveedores();
  $eliminarProveedor -> ctrEliminarProveedores();

?>


