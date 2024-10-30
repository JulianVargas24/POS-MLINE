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
      
    Administrar Bancos
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar Bancos</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

      <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarBanco">
          Agregar Banco

        </button>

      </div>

      <div class="box-body">

       <table class="table table-bordered table-hover dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Bancos</th>
           <th>Codigo SBIF</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

          $item = null;
          $valor = null;

          $bancos = ControladorBancos::ctrMostrarBancos($item, $valor);

          foreach ($bancos as $key => $value) {
            
           
            echo ' <tr>

                    <td>'.($key+1).'</td>

                    <td>'.$value["nombre_banco"].'</td>

                    <td>'.$value["codigo"].'</td>

                    <td>

                      <div class="btn-group">
                      
                        <button class="btn btn-warning btnEditarBanco" data-toggle="modal" data-target="#modalEditarBanco" idBanco="'.$value["id"].'"><i class="fa fa-pencil"></i></button>';

                      if($_SESSION["perfil"] == "Administrador"){

                          echo '<button class="btn btn-danger btnEliminarBanco" idBanco="'.$value["id"].'"><i class="fa fa-times"></i></button>';

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
MODAL AGREGAR BANCO
======================================-->

<div id="modalAgregarBanco" class="modal fade" role="dialog">
  
<style>
    .error{
        color: red;
        
    }
</style>
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" id="form_nuevo_Banco">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3f668d; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Banco</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
                
                    <div class="d-inline-block bg-primary" style="text-indent: 12px;background-color:#3c8dbc;font-size:16px;font-weight:bold">Banco</div>
                    <div class="input-group">
                    
                      <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                      <input type="text" class="form-control input" name="nuevoBanco" id="nuevoBanco" placeholder="Ingresar Banco" required>

                    </div>
                </div>

                <div class="form-group">
                            <div class="d-inline-block bg-primary" style="text-indent: 12px;font-size:16px;font-weight:bold">Código SBIF</div>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-code"></i></span>
                                <input type="text" class="form-control input" name="nuevoCodigoSBIF" id="nuevoCodigoSBIF" placeholder="Ingresar Código SBIF" required>
                            </div>
                        </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary" name="crear_Banco">Agregar Banco</button>

        </div>

        <?php

          if(isset($_POST["crear_Banco"])){
            $nombreBanco = $_POST["nuevoBanco"];
            $codigoSBIF = $_POST["nuevoCodigoSBIF"];
            
            $crearBanco = new ControladorBancos();
            $crearBanco -> ctrCrearBanco($nombreBanco, $codigoSBIF);
          }

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR BANCO
======================================-->

<div id="modalEditarBanco" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" id="form_editar_Banco">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3f668d; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Banco</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
                
              <div class="d-inline-block bg-primary" style="text-indent: 12px;background-color:#3c8dbc;font-size:16px;font-weight:bold">Banco</div>
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input" name="editarBanco" id="editarBanco" placeholder="Ingresar Banco" required>

                <input type="hidden" id="idBanco" name="idBanco" required>

              </div>
            </div>

            <!-- ENTRADA PARA EL CÓDIGO SBIF -->
            <div class="form-group">
              <div class="d-inline-block bg-primary" style="text-indent: 12px;font-size:16px;font-weight:bold">Código SBIF</div>
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-code"></i></span>
                
                <input type="text" class="form-control input" name="editarCodigoSBIF" id="editarCodigoSBIF" placeholder="Ingresar Código SBIF" required>
                
              </div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary" >Guardar cambios</button>

        </div>

        <?php

            
            $editarBanco = new ControladorBancos();
            $editarBanco -> ctrEditarBanco();
          

        ?>

      </form>

    </div>

  </div>

</div>


<?php

    $eliminarBanco = new ControladorBancos();
    $eliminarBanco -> ctrEliminarBanco();

?>

