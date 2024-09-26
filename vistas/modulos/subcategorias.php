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
      
Administrar Subcategorias
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar Subcategorías</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarSubcategoria">
          
          Agregar Subcategoría

        </button>

      </div>

      <div class="box-body">

       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Subcategoria</th>
           <th>Categoria</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

          $item = null;
          $valor = null;

          $subcategorias = ControladorSubcategorias::ctrMostrarSubcategorias($item, $valor);
          $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

          foreach ($subcategorias as $key => $value) {
            for($i = 0; $i < count($categorias); ++$i){
              if ($categorias[$i]["id"] == $value["id_categoria"]) {
                $categoria = $categorias[$i]["categoria"];
              }
            }
            
           
            echo ' <tr>

                    <td>'.($key+1).'</td>

                    <td>'.$value["subcategoria"].'</td>
                    <td>'.$categoria.'</td>
                    <td>

                      <div class="btn-group">
                          
                        <button class="btn btn-warning btnEditarSubcategoria" id_subcategoria="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarSubcategoria"><i class="fa fa-pencil"></i></button>';

                        if($_SESSION["perfil"] == "Administrador"){

                          echo '<button class="btn btn-danger btnEliminarSubcategoria" id_subcategoria="'.$value["id"].'"><i class="fa fa-times"></i></button>';

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

<div id="modalAgregarSubcategoria" class="modal fade" role="dialog">
  
<style>
    .error{
        color: red;
        
    }
</style>
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" id="form_nueva_subcategoria">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3f668d; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Subcategoría</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group row">
                <div class="col-xs-6">
                    <div class="d-inline-block bg-primary" style="background-color:#3c8dbc;font-size:16px;font-weight:bold">Categoria</div>
                    <div class="input-group">
                    
                      <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                      <select class="form-control input" id="nuevaCategoria" name="nuevaCategoria" required>
                        
                        <option value="">Seleccionar categoría</option>

                        <?php

                        $item = null;
                        $valor = null;

                        $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

                        foreach ($categorias as $key => $value) {
                          
                          echo '<option value="'.$value["id"].'">'.$value["categoria"].'</option>';
                        }

                        ?>
        
                      </select>

                    </div>
                </div>

                <div class="col-xs-6">
                    <div class="d-inline-block bg-primary" style="background-color:#3c8dbc;font-size:16px;font-weight:bold">Subcategoria</div>
                    <div class="input-group">
                    
                      <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                      <input type="text" class="form-control input" name="nuevaSubcategoria" id="nuevaSubcategoria" placeholder="Ingresar Subcategoría" required>

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

          <button type="submit" class="btn btn-primary" name="crear_subcategoria">Guardar Subcategoría</button>

        </div>

        <?php

          $crearSubcategoria = new ControladorSubcategorias();
          $crearSubcategoria -> ctrCrearSubcategoria();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR SUBCATEGORÍA
======================================-->

<div id="modalEditarSubcategoria" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" id="form_editar_subcategoria">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Subcategoría</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
            <div class="d-inline-block bg-primary" style="background-color:#3c8dbc;font-size:16px;font-weight:bold">Subcategoria</div>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input" name="editarSubcategoria" id="editarSubcategoria" required>

                 <input type="hidden"  name="id_subcategoria" id="id_subcategoria" required>

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

          $editarSubcategoria = new ControladorSubcategorias();
          $editarSubcategoria -> ctrEditarSubcategoria();

        ?> 

      </form>

    </div>

  </div>

</div>

<?php

  $borrarSubcategoria = new ControladorSubcategorias();
  $borrarSubcategoria -> ctrBorrarSubcategoria();

?>