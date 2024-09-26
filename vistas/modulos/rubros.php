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
      
    Administrar Rubros
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar Rubros</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarRubro">
            
            Agregar Rubro

        </button>


      </div>

      <div class="box-body">

       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>

           <th>Nombre</th>
           <th>Descripcion</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

          $item = null;
          $valor = null;

          $rubros = ControladorRubros::ctrMostrarRubros($item, $valor);

          foreach ($rubros as $key => $value) {
            
           
            echo ' <tr>

                    <td>'.($key+1).'</td>

                    <td>'.$value["nombre"].'</td>
                    <td>'.$value["descripcion"].'</td>
                    <td>

                      <div class="btn-group">
                          
                        <button class="btn btn-warning btnEditarRubro" idRubro="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarRubro"><i class="fa fa-pencil"></i></button>';
                        if($_SESSION["perfil"] == "Administrador"){

                            echo '<button class="btn btn-danger btnEliminarRubro" idRubro="'.$value["id"].'"><i class="fa fa-times"></i></button>';
  
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
MODAL AGREGAR RUBRO
======================================-->

<div id="modalAgregarRubro" class="modal fade" role="dialog">
  
<style>
    .error{
        color: red;
        
    }
</style>
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" id="form_nuevo_rubro">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3f668d; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Rubro</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">              
                    <div class="d-inline-block bg-primary" style="background-color:#3c8dbc;font-size:16px;font-weight:bold">Rubro</div>
                    <div class="input-group">
                    
                      <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                      <input type="text" class="form-control input" name="nuevoRubro" id="nuevoRubro" placeholder="Ingresar Rubro" required>

                    </div>
            </div>

            <div class="form-group">
                <div class="d-inline-block bg-primary" style="background-color:#3c8dbc;font-size:16px;font-weight:bold">Descripcion</div>
                <div class="input-group">
                
                    <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                    <input type="text" class="form-control input" id="nuevaDescripcion" name="nuevaDescripcion" placeholder="Ingresar Descripcion"  required>

                </div>
            </div>
  
                      
          
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary" name="crear_rubro">Agregar Rubro</button>

        </div>

        <?php

          $crearRubro = new ControladorRubros();
          $crearRubro -> ctrCrearRubro();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR SUBCATEGORÍA
======================================-->

<div id="modalEditarRubro" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" id="form_editar_impuesto">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Rubro</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
                <div class="d-inline-block bg-primary" style="background-color:#3c8dbc;font-size:16px;font-weight:bold">Rubro</div>
                    <div class="input-group">
                    
                        <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                        <input type="text" class="form-control input" id="editarRubro" name="editarRubro"  required>

                        <input type="hidden" id="idRubro"  name="idRubro"  required>

                    </div>
            </div>

            
            <div class="form-group">
                <div class="d-inline-block bg-primary" style="background-color:#3c8dbc;font-size:16px;font-weight:bold">Descripcion</div>
                <div class="input-group">
                
                    <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                    <input type="text" class="form-control input" id="editarDescripcion" name="editarDescripcion"  required>

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

          $editarRubro = new ControladorRubros();
          $editarRubro -> ctrEditarRubro();

        ?> 

      </form>

    </div>

  </div>

</div>

<?php

  $borrarRubro = new ControladorRubros();
  $borrarRubro -> ctrBorrarRubro();

?>