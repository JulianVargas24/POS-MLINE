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
      
    Administrar Impuestos
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar Impuestos</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarImpuesto">
            
            Agregar Impuesto

        </button>


      </div>

      <div class="box-body">

       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Codigo</th>
           <th>Impuesto</th>
           <th>Porcentaje</th>
           <th>Descripcion</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

          $item = null;
          $valor = null;

          $impuestos = ControladorImpuestos::ctrMostrarImpuestos($item, $valor);

          foreach ($impuestos as $key => $value) {
            
           
            echo ' <tr>

                    <td>'.($key+1).'</td>
                    <td>'.$value["codigo"].'</td>
                    <td>'.$value["nombre"].'</td>
                    <td>'.$value["factor"].'%</td>
                    <td>'.$value["descripcion"].'</td>
                    <td>

                      <div class="btn-group">
                          
                        <button class="btn btn-warning btnEditarImpuesto" idImpuesto="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarImpuesto"><i class="fa fa-pencil"></i></button>';
                        if($_SESSION["perfil"] == "Administrador"){

                            echo '<button class="btn btn-danger btnEliminarImpuesto" idImpuesto="'.$value["id"].'"><i class="fa fa-times"></i></button>';
  
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

<div id="modalAgregarImpuesto" class="modal fade" role="dialog">
  
<style>
    .error{
        color: red;
        
    }
</style>
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" id="form_nuevo_impuesto">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3f668d; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Impuesto</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">              
                    <div class="d-inline-block bg-primary" style="background-color:#3c8dbc;font-size:16px;font-weight:bold">Impuesto</div>
                    <div class="input-group">
                    
                      <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                      <input type="text" class="form-control input" name="nuevoImpuesto" id="nuevoImpuesto" placeholder="Ingresar Impuesto" required>

                    </div>
            </div>

            <div class="form-group">
                <div class="d-inline-block bg-primary" style="background-color:#3c8dbc;font-size:16px;font-weight:bold">Factor</div>
                <div class="input-group">
                
                    <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                    <input type="text" class="form-control input" id="nuevoFactor" name="nuevoFactor" placeholder="Ingresar Factor"  required>

                </div>
            </div>
  
                      
          
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary" name="crear_impuesto">Agregar Impuesto</button>

        </div>

        <?php

          $crearImpuesto = new ControladorImpuestos();
          $crearImpuesto -> ctrCrearImpuesto();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR SUBCATEGORÍA
======================================-->

<div id="modalEditarImpuesto" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" id="form_editar_impuesto">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Lista</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
                <div class="d-inline-block bg-primary" style="background-color:#3c8dbc;font-size:16px;font-weight:bold">Impuesto</div>
                    <div class="input-group">
                    
                        <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                        <input type="text" class="form-control input" id="editarImpuesto" name="editarImpuesto"  required>

                        <input type="hidden" id="idImpuesto"  name="idImpuesto"  required>

                    </div>
            </div>

            
            <div class="form-group">
                <div class="d-inline-block bg-primary" style="background-color:#3c8dbc;font-size:16px;font-weight:bold">Factor</div>
                <div class="input-group">
                
                    <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                    <input type="text" class="form-control input" id="editarFactor" name="editarFactor"  required>

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

          $editarImpuesto = new ControladorImpuestos();
          $editarImpuesto -> ctrEditarImpuesto();

        ?> 

      </form>

    </div>

  </div>

</div>

<?php

  $borrarImpuesto = new ControladorImpuestos();
  $borrarImpuesto -> ctrBorrarImpuesto();

?>