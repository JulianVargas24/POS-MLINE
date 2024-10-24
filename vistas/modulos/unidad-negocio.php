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
      
      Administrar unidades de negocios
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar unidad de negocio</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUnidadNegocio">
          
          Agregar unidad de negocio

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Unidad de negocio</th>
           <th>Código</th>


         </tr> 

        </thead>

        <tbody>

        <?php

          $item = null;
          $valor = null;

          $negocios = ControladorNegocios::ctrMostrarNegocios($item, $valor);

          foreach ($negocios as $key => $value) {
            

            echo '<tr>

                    <td>'.($key+1).'</td>

                    <td>'.$value["unidad_negocio"].'</td>

                    <td>'.$value["codigo"].'</td>


                    <td>

                      <div class="btn-group">
                          
                        <button class="btn btn-warning btnEditarUnidadNegocio" data-toggle="modal" data-target="#modalEditarUnidadNegocio" idNegocio="'.$value["id"].'"><i class="fa fa-pencil"></i></button>';

                      if($_SESSION["perfil"] == "Administrador"){

                          echo '<button class="btn btn-danger btnEliminarUnidadNegocio" idNegocio="'.$value["id"].'"><i class="fa fa-times"></i></button>';

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
<div id="modalAgregarUnidadNegocio" class="modal fade" role="dialog">
  
  <style>
      .error{
          color: red;
          
      }
  </style>
    <div class="modal-dialog">

      <div class="modal-content">

        <form role="form" method="post" id="form_nuevo_negocio">

          <!--=====================================
          CABEZA DEL MODAL
          ======================================-->

          <div class="modal-header" style="background:#3f668d; color:white">

            <button type="button" class="close" data-dismiss="modal">&times;</button>

            <h4 class="modal-title">Agregar unidad de negocio</h4>

          </div>

          <!--=====================================
          CUERPO DEL MODAL
          ======================================-->

          <div class="modal-body">

            <div class="box-body">

              <!-- ENTRADA PARA EL NOMBRE -->
              
              <div class="form-group">
                  
                      <div class="d-inline-block bg-primary" style="background-color:#3c8dbc;font-size:16px;font-weight:bold;text-indent: 11px">Unidad de negocio</div>
                      <div class="input-group">
                      
                        <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                        <input type="text" class="form-control input" name="nuevoNegocio" id="nuevoNegocio" placeholder="Ingresar Unidad de Negocio" required>

                      </div>
              </div>

              <div class="form-group">
                  
                      <div class="d-inline-block bg-primary" style="background-color:#3c8dbc;font-size:16px;font-weight:bold;text-indent: 11px">Código de unidad</div>
                      <div class="input-group">
                      
                        <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                        <input type="number" class="form-control input" name="nuevoCodigoUnidad" id="nuevoCodigoUnidad" placeholder="Ingresar Código" required>

                      </div>
              </div>
                        
            
            </div>

          </div>

          <!--=====================================
          PIE DEL MODAL
          ======================================-->

          <div class="modal-footer">

            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

            <button type="submit" class="btn btn-primary" name="crear_negocio">Agregar unidad</button>

          </div>

          <?php

            $crearNegocio = new ControladorNegocios();
            $crearNegocio -> ctrCrearNegocio();

          ?>

        </form>

      </div>

    </div>

</div>

<!--=====================================
MODAL EDITAR UNIDAD DE NEGOCIO
======================================-->

<div id="modalEditarUnidadNegocio" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" id="form_editar_negocio">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar unidad de negocio</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->

            <div class="form-group">
                  
                      <div class="d-inline-block bg-primary" style="background-color:#3c8dbc;font-size:16px;font-weight:bold;text-indent: 11px">Unidad de negocio</div>
                      <div class="input-group">
                      
                        <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                        <input type="text" class="form-control input" id="editarNegocio" name="editarNegocio"  required>
                        <input type="hidden" id="idNegocio"  name="idNegocio"  required>
                      </div>
              </div>

              <div class="form-group">
                  
                      <div class="d-inline-block bg-primary" style="background-color:#3c8dbc;font-size:16px;font-weight:bold;text-indent: 11px">Código de unidad</div>
                      <div class="input-group">
                      
                        <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                        <input type="number" class="form-control input" id="editarCodigoUnidad" name="editarCodigoUnidad"  required>

                      </div>
              </div>
  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar unidad</button>

        </div>

      <?php

          $editarNegocio = new ControladorNegocios();
          $editarNegocio -> ctrEditarNegocio();

        ?> 

      </form>

    </div>

  </div>

</div>

<?php

  $eliminarNegocio = new ControladorNegocios();
  $eliminarNegocio -> ctrEliminarNegocio();

?>