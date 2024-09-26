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
      
      Administrar Plantel
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar Plantel</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarPlantel">
          
          Agregar Plantel

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Nombre</th>
           <th>Rut</th>
           <th>Cargo</th>
           <th>Comision</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

          $item = null;
          $valor = null;

          $plantel = ControladorPlantel::ctrMostrarPlantel($item, $valor);

          foreach ($plantel as $key => $value) {
            

            echo '<tr>

                    <td>'.($key+1).'</td>

                    <td>'.$value["nombre"].'</td>

                    <td>'.$value["rut"].'</td>

                    <td>'.$value["cargo"].'</td>

                    <td>'.$value["comision"].'%</td>

                    <td>

                      <div class="btn-group">
                          
                        <button class="btn btn-warning btnEditarPlantel" data-toggle="modal" data-target="#modalEditarPlantel" idPlantel="'.$value["id"].'"><i class="fa fa-pencil"></i></button>';

                      if($_SESSION["perfil"] == "Administrador"){

                          echo '<button class="btn btn-danger btnEliminarPlantel" idPlantel="'.$value["id"].'"><i class="fa fa-times"></i></button>';

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


<div id="modalAgregarPlantel" class="modal fade"  role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" id="form_nuevo_plantel" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3f668d; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Plantel</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">


            <!-- ENTRADA PARA SELECCIONAR CATEGORÍA -->

            

            <!-- ENTRADA PARA LOS DATOS CLIENTE -->
            <h4 class="box-title" style="font-weight:bold;margin:auto;margin-bottom:4px;">Datos Plantel</h4>
            <div class="box box-info">
              <div class="box-body">                
                <div class="form-group row">              
                  <div class="col-lg-6">
                    <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold">Nombre</div>
                    <div class="input-group">
                    
                      <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                      <input type="text" class="form-control input" name="nuevoNombre" id="nuevoNombre" placeholder="Ingrese Nombre" required>

                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="d-inline-block  text-center" style="font-size:16px;font-weight:bold">RUT</div> 
                      <div class="input-group">
                      
                        <span class="input-group-addon"><i class="fa fa-address-card"></i></span> 

                        <input type="text" class="form-control input" name="nuevoRutId" id="nuevoRutId" placeholder="Ingrese su RUT" required>

                      </div>
                  </div>
                 
                    <div class="col-lg-6">
                        <div class="d-inline-block  text-center" style="font-size:16px;font-weight:bold">Cargo</div> 
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-file"></i></span> 
                          <input type="text" class="form-control input" name="nuevoCargo" id="nuevoCargo" placeholder="Ingrese Cargo" required>
                        </div>
                    </div>                 
                  <!-- ENTRADA PARA LA SUBCATEGORIA -->
                  <div class="col-xs-6">
                    <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold">Comision</div>
                    <div class="input-group">
                    
                      <span class="input-group-addon"><i class="fa fa-calculator"></i></span> 

                      <input type="text" class="form-control input" name="nuevaComision" id="nuevaComision" placeholder="Ingrese Comision" required>

                    </div>
                  </div>
                    

                </div> 
              </div>  
            </div>
             <!-- ENTRADA PARA STOCK -->

            
             <!-- ENTRADA PARA EL CÓDIGO -->

            

            <div class="modal-footer">

              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

              <button type="submit" class="btn btn-primary text-center">Guardar Plantel</button>

            </div>
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

       

      </form>

        <?php

          $crearPlantel = new ControladorPlantel();
          $crearPlantel -> ctrCrearPlantel();

        ?>  

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR CLIENTE
======================================-->

<div id="modalEditarPlantel" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" id="form_editar_plantel">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Plantel</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

          <h4 class="box-title" style="font-weight:bold;margin:auto;margin-bottom:4px;">Datos Plantel</h4>
            <div class="box box-info">
              <div class="box-body">                
                <div class="form-group row">              
                  <div class="col-lg-6">
                    <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold">Nombre</div>
                    <div class="input-group">
                    
                      <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                      <input type="hidden" name="idPlantel" id="idPlantel">
                      <input type="text" class="form-control input" name="editarNombre" id="editarNombre" placeholder="Ingrese Nombre" required>

                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="d-inline-block  text-center" style="font-size:16px;font-weight:bold">RUT</div> 
                      <div class="input-group">
                      
                        <span class="input-group-addon"><i class="fa fa-address-card"></i></span> 

                        <input type="text" class="form-control input" name="editarRutId" id="editarRutId" placeholder="Ingrese su RUT" required>

                      </div>
                  </div>
                 
                    <div class="col-lg-6">
                        <div class="d-inline-block  text-center" style="font-size:16px;font-weight:bold">Cargo</div> 
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-file"></i></span> 
                          <input type="text" class="form-control input" name="editarCargo" id="editarCargo" placeholder="Ingrese Cargo" required>
                        </div>
                    </div>                 
                  <!-- ENTRADA PARA LA SUBCATEGORIA -->
                  <div class="col-xs-6">
                    <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold">Comision</div>
                    <div class="input-group">
                    
                      <span class="input-group-addon"><i class="fa fa-calculator"></i></span> 

                      <input type="text" class="form-control input" name="editarComision" id="editarComision" placeholder="Ingrese Comision" required>

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

        $editarPlantel = new ControladorPlantel();
        $editarPlantel -> ctrEditarPlantel();

      ?>

    

    </div>

  </div>

</div>

<?php

  $eliminarPlantel = new ControladorPlantel();
  $eliminarPlantel -> ctrEliminarPlantel();

?>


