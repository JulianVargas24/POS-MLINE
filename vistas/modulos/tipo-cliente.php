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
      
      Administrar Tipos de Campaña
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar Tipos de Campaña</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarTipoCliente">
          
          Agregar Tipo de Campaña

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <theadCampaña
         <tr>
           
           <th style="width:10px">#</th>
           <th>Tipo de Campaña</th>
           <th>Codigo</th>


         </tr> 

        </thead>

        <tbody>

        <?php

          $item = null;
          $valor = null;

          $tipoclientes = ControladorTipoClientes::ctrMostrarTipoClientes($item, $valor);

          foreach ($tipoclientes as $key => $value) {
            

            echo '<tr>

                    <td>'.($key+1).'</td>

                    <td>'.$value["nombre"].'</td>

                    <td>'.$value["codigo"].'</td>


                    <td>

                      <div class="btn-group">
                          
                        <button class="btn btn-warning btnEditarTipoCliente" data-toggle="modal" data-target="#modalEditarTipoCliente" idTipoCliente="'.$value["id"].'"><i class="fa fa-pencil"></i></button>';

                      if($_SESSION["perfil"] == "Administrador"){

                          echo '<button class="btn btn-danger btnEliminarTipoCliente" idTipoCliente="'.$value["id"].'"><i class="fa fa-times"></i></button>';

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
<div id="modalAgregarTipoCliente" class="modal fade" role="dialog">
  
  <style>
      .error{
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

            <h4 class="modal-title">Agregar Tipo de Campaña</h4>

          </div>

          <!--=====================================
          CUERPO DEL MODAL
          ======================================-->

          <div class="modal-body">

            <div class="box-body">

              <!-- ENTRADA PARA EL NOMBRE -->
              
              <div class="form-group">
                  
                      <div class="d-inline-block bg-primary" style="background-color:#3c8dbc;font-size:16px;font-weight:bold">Tipo de Campaña</div>
                      <div class="input-group">
                      
                        <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                        <input type="text" class="form-control input" name="nuevoTipoCliente" id="nuevoTipoCliente" placeholder="Ingresar Tipo de Campaña" required>

                      </div>
              </div>

              <div class="form-group">
                  
                      <div class="d-inline-block bg-primary" style="background-color:#3c8dbc;font-size:16px;font-weight:bold">Codigo de Campaña</div>
                      <div class="input-group">
                      
                        <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                        <input type="number" class="form-control input" name="nuevoCodigoCliente" id="nuevoCodigoCliente" placeholder="Ingresar Codigo de Campaña" required>

                      </div>
              </div>
                        
            
            </div>

          </div>

          <!--=====================================
          PIE DEL MODAL
          ======================================-->

          <div class="modal-footer">

            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

            <button type="submit" class="btn btn-primary" name="crear_negocio">Agregar Tipo de Campaña</button>

          </div>

          <?php

            $crearTipoCliente = new ControladorTipoClientes();
            $crearTipoCliente -> ctrCrearTipoCliente();

          ?>

        </form>

      </div>

    </div>

</div>

<!--=====================================
MODAL EDITAR UNIDAD DE NEGOCIO
======================================-->

<div id="modalEditarTipoCliente" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" id="form_editar_tipo_cliente">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Tipo de Cliente</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->

            <div class="form-group">
                  
                      <div class="d-inline-block bg-primary" style="background-color:#3c8dbc;font-size:16px;font-weight:bold">Tipo de Cliente</div>
                      <div class="input-group">
                      
                        <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                        <input type="text" class="form-control input" id="editarTipoCliente" name="editarTipoCliente"  required>
                        <input type="hidden" id="idTipoCliente"  name="idTipoCliente"  required>
                      </div>
              </div>

              <div class="form-group">
                  
                      <div class="d-inline-block bg-primary" style="background-color:#3c8dbc;font-size:16px;font-weight:bold">Codigo de Cliente</div>
                      <div class="input-group">
                      
                        <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                        <input type="number" class="form-control input" id="editarCodigoCliente" name="editarCodigoCliente"  required>

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

          $editarTipoCliente = new ControladorTipoClientes();
          $editarTipoCliente -> ctrEditarTipoCliente();

        ?> 

      </form>

    </div>

  </div>

</div>

<?php

  $eliminarTipoCliente = new ControladorTipoClientes();
  $eliminarTipoCliente -> ctrEliminarTipoCliente();

?>