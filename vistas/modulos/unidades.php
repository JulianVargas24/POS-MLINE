<?php

if($_SESSION["perfil"] == "Vendedor"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

?>

<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
    Administrar Unidades
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar Unidades</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUnidad">
          
          Agregar Unidad de Medida

        </button>

      </div>

      <div class="box-body">

       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Medida</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

          $item = null;
          $valor = null;

          $unidades = ControladorUnidades::ctrMostrarUnidades($item, $valor);

          foreach ($unidades as $key => $value) {
            
           
            echo ' <tr>

                    <td>'.($key+1).'</td>

                    <td>'.$value["medida"].'</td>
                    <td>

                      <div class="btn-group">
                          
                        <button class="btn btn-warning btnEditarUnidades" idUnidad="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarUnidad"><i class="fa fa-pencil"></i></button>';

                        if($_SESSION["perfil"] == "Administrador"){

                          echo '<button class="btn btn-danger btnEliminarUnidad" idUnidad="'.$value["id"].'"><i class="fa fa-times"></i></button>';

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
MODAL AGREGAR CATEGORÍA
======================================-->
<div id="modalAgregarUnidad" class="modal fade" role="dialog">
  
  <style>
      .error{
          color: red;
          
      }
  </style>
    <div class="modal-dialog">

      <div class="modal-content">

        <form role="form" method="post" id="form_nueva_unidad">

          <!--=====================================
          CABEZA DEL MODAL
          ======================================-->

          <div class="modal-header" style="background:#3f668d; color:white">

            <button type="button" class="close" data-dismiss="modal">&times;</button>

            <h4 class="modal-title">Agregar Unidad</h4>

          </div>

          <!--=====================================
          CUERPO DEL MODAL
          ======================================-->

          <div class="modal-body">

            <div class="box-body">

              <!-- ENTRADA PARA EL NOMBRE -->
              
              <div class="form-group">
                  
                      <div class="d-inline-block bg-primary" style="background-color:#3c8dbc;font-size:16px;font-weight:bold">Medida</div>
                      <div class="input-group">
                      
                        <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                        <input type="text" class="form-control input" name="nuevaMedida" id="nuevaMedida" placeholder="Ingresar Medida" required>

                      </div>
                  </div>
                        
            
            </div>

          </div>

          <!--=====================================
          PIE DEL MODAL
          ======================================-->

          <div class="modal-footer">

            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

            <button type="submit" class="btn btn-primary" name="crear_medida">Agregar Medida</button>

          </div>

          <?php

            $crearUnidad = new ControladorUnidades();
            $crearUnidad -> ctrCrearUnidad();

          ?>

        </form>

      </div>

    </div>

</div>

<!--=====================================
MODAL EDITAR SUBCATEGORÍA
======================================-->

<div id="modalEditarUnidad" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" id="form_editar_unidad">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Unidad de Medida</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
            <div class="d-inline-block bg-primary" style="background-color:#3c8dbc;font-size:16px;font-weight:bold">Medida</div>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input" id="editarMedida" name="editarMedida"  required>

                 <input type="hidden" id="idUnidad"  name="idUnidad"  required>

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

          $editarUnidad = new ControladorUnidades();
          $editarUnidad -> ctrEditarUnidad();

        ?> 

      </form>

    </div>

  </div>

</div>

<?php

  $borrarUnidad = new ControladorUnidades();
  $borrarUnidad -> ctrBorrarUnidad();

?>