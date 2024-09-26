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
      
      Administrar Personal
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar Personal</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarPersonal">
          
          Agregar Personal

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Nombre</th>
           <th>Rut</th>
           <th>Empresa</th>
           <th>Email</th>
           <th>Teléfono</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

          $item = null;
          $valor = null;

          $personal = ControladorPersonal::ctrMostrarPersonal($item, $valor);
          $clientes = ControladorClientes::ctrMostrarClientes($item, $valor);

          foreach ($personal as $key => $value) {
            for($i = 0; $i < count($clientes); ++$i){
              if ($clientes[$i]["id"] == $value["id_cliente"]) {
                $cliente = $clientes[$i]["nombre"];
              }
            }

            echo '<tr>

                    <td>'.($key+1).'</td>

                    <td>'.$value["nombre"].'</td>

                    <td>'.$value["rut"].'</td>
                    
                    <td>'.$cliente.'</td>  

                    <td>'.$value["email"].'</td>

                    <td>'.$value["telefono"].'</td>

                    
                    


                    <td>

                      <div class="btn-group">
                        <button class="btn btn-warning btnEditarPersonal" data-toggle="modal" data-target="#modalEditarPersonal" idPersonal="'.$value["id"].'"><i class="fa fa-pencil"></i></button>';

                      if($_SESSION["perfil"] == "Administrador"){

                          echo '<button class="btn btn-danger btnEliminarPersonal" idPersonal="'.$value["id"].'"><i class="fa fa-times"></i></button>';

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
MODAL AGREGAR PERSONAL
======================================-->
<style>
  .error{
    color: red;
  }
</style>

<div id="modalAgregarPersonal" class="modal fade"  role="dialog">
  
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form role="form" method="post" id="form_nuevo_personal" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3f668d; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Personal</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA LOS DATOS PERSONAL -->
            <h4 class="box-title" style="font-weight:bold;margin:auto;margin-bottom:4px;">Datos Personal</h4>
            <div class="box box-info">
              <div class="box-body">                
                <div class="form-group row">              
                  <div class="col-lg-4 col-xs-6">
                    <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold;margin-top:15px;">Nombre</div>
                    <div class="input-group">
                    
                      <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                      <input type="text" class="form-control input-sm" name="nuevoPersonal" id="nuevoPersonal" placeholder="Ingrese Nombre" required>

                    </div>
                  </div>
                  <div class="col-lg-4 col-xs-6">
                    <div class="d-inline-block  text-center" style="font-size:16px;font-weight:bold;margin-top:15px;">RUT</div> 
                      <div class="input-group">
                      
                        <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                        <input type="text" class="form-control input-sm" name="nuevoRutId" id="nuevoRutId" placeholder="Ingrese su RUT" required>

                      </div>
                  </div>
                 
                  <div class="col-lg-4 col-xs-6">
                        <div class="d-block text-center" style="font-size:16px;font-weight:bold;margin-top:15px;">Empresa</div>
                          <div class="input-group">
                          
                            <span class="input-group-addon"><i class="fa fa-phone"></i></span> 

                            <select class="form-control input-sm" id="nuevaEmpresa" name="nuevaEmpresa" required>
                            
                                <option value="">Seleccionar Empresa</option>

                                <?php

                                $item = null;
                                $valor = null;

                                $clientes = ControladorClientes::ctrMostrarClientes($item, $valor);

                                foreach ($clientes as $key => $value) {
                                echo '<option  value="'.$value["id"].'">'.$value["nombre"].' </option>';
                                }

                                ?>
            
                            </select>

                          </div>
                    </div>            
                  <!-- ENTRADA PARA LA SUBCATEGORIA -->                           
                    <div class="col-lg-4 col-xs-6">
                        <div class="d-block text-center" style="font-size:16px;font-weight:bold;margin-top:15px;">Fono</div>
                          <div class="input-group">
                          
                            <span class="input-group-addon"><i class="fa fa-phone"></i></span> 

                            <input type="tel" class="form-control input-sm" name="nuevoTelefono" id="nuevoTelefono" placeholder="Ingresar Teléfono" required>

                          </div>
                    </div>
                    <div class="col-lg-4 col-xs-6">
                     <div class="d-block text-center" style="font-size:16px;font-weight:bold;margin-top:15px;">Email</div>
                          <div class="input-group">
                          
                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 

                            <input type="text" class="form-control input-sm" name="nuevoEmail" id="nuevoEmail" placeholder="Ingresar Email" required>

                          </div>
                    </div>
                </div> 
              </div>  
            </div>
            <div class="row">
              <h4 class="box-title text-center" style="font-weight:bold; font-size:20px;">Medidas Superiores</h4>
              <div class="box box-success">
                <div class="box-body">
                  <div class="col-xs-12">
                      
                      <div class="col-xs-3" style="margin: 8px 0px;">
                        <div class="d-block text-center" style="font-size:16px;font-weight:bold">Busto</div>
                          <div class="input-group">
                            <input type="text" class="form-control input-sm" name="nuevaBusto" id="nuevaBusto"  placeholder="Ingresar Talla en Centimetros">
                          </div>
                      </div>
                      <div class="col-xs-3" style="margin: 8px 0px;">
                        <div class="d-block text-center" style="font-size:16px;font-weight:bold">Cintura</div>
                          <div class="input-group">
                            <input type="text" class="form-control input-sm" name="nuevaCintura" id="nuevaCintura"  placeholder="Ingresar Talla en Centimetros">
                          </div>
                      </div>
                      <div class="col-xs-3" style="margin: 8px 0px;">
                        <div class="d-block text-center" style="font-size:16px;font-weight:bold">Cadera</div>
                          <div class="input-group">
                            <input type="text" class="form-control input-sm" name="nuevaCadera"  id="nuevaCadera" placeholder="Ingresar Talla en Centimetros">
                          </div>
                      </div>
                      <div class="col-xs-3" style="margin: 8px 0px;">
                        <div class="d-block text-center" style="font-size:16px;font-weight:bold">Ancho Espalda</div>
                          <div class="input-group">
                            <input type="text" class="form-control input-sm" name="nuevaAnchoEspalda" id="nuevaAnchoEspalda" placeholder="Ingresar Talla en Centimetros">
                          </div>
                      </div>
                      <div class="col-xs-3" style="margin: 8px 0px;">
                        <div class="d-block text-center" style="font-size:16px;font-weight:bold">Talle Delantero</div>
                          <div class="input-group">
                            <input type="text" class="form-control input-sm" name="nuevaTalleDelantero" id="nuevaTalleDelantero" placeholder="Ingresar Talla en Centimetros">
                          </div>
                      </div>
                      <div class="col-xs-3" style="margin: 8px 0px;">
                        <div class="d-block text-center" style="font-size:16px;font-weight:bold">Talle Espalda</div>
                          <div class="input-group">
                            <input type="text" class="form-control input-sm" name="nuevaTalleEspalda" id="nuevaTalleEspalda" placeholder="Ingresar Talla en Centimetros">
                          </div>
                      </div>
                      <div class="col-xs-3" style="margin: 8px 0px;">
                        <div class="d-block text-center" style="font-size:16px;font-weight:bold">Largo Manga</div>
                          <div class="input-group">
                            <input type="text" class="form-control input-sm" name="nuevaLargoManga" id="nuevaLargoManga" placeholder="Ingresar Talla en Centimetros">
                          </div>
                      </div>
                      <div class="col-xs-3" style="margin: 8px 0px;">
                        <div class="d-block text-center" style="font-size:16px;font-weight:bold">Largo Blusa</div>
                          <div class="input-group">
                            <input type="text" class="form-control input-sm" name="nuevaLargoBlusa" id="nuevaLargoBlusa" placeholder="Ingresar Talla en Centimetros">
                          </div>
                      </div>
                      <div class="col-xs-3" style="margin: 8px 0px;">
                        <div class="d-block text-center" style="font-size:16px;font-weight:bold">Largo Guillete</div>
                          <div class="input-group">
                            <input type="text" class="form-control input-sm" name="nuevaLargoGuillete" id="nuevaLargoGuillete" placeholder="Ingresar Talla en Centimetros">
                          </div>
                      </div>
                      <div class="col-xs-3" style="margin: 8px 0px;">
                        <div class="d-block text-center" style="font-size:16px;font-weight:bold">Largo Chaqueta</div>
                          <div class="input-group">
                            <input type="text" class="form-control input-sm" name="nuevaLargoChaqueta" id="nuevaLargoChaqueta" placeholder="Ingresar Talla en Centimetros">
                          </div>
                      </div>
                      <div class="col-xs-3" style="margin: 8px 0px;">
                        <div class="d-block text-center" style="font-size:16px;font-weight:bold">Largo Polera</div>
                          <div class="input-group">
                            <input type="text" class="form-control input-sm" name="nuevaLargoPolera" id="nuevaLargoPolera" placeholder="Ingresar Talla en Centimetros">
                          </div>
                      </div>
                      <div class="col-xs-3" style="margin: 8px 0px;">
                        <div class="d-block text-center" style="font-size:16px;font-weight:bold">Largo Parka</div>
                          <div class="input-group">
                            <input type="text" class="form-control input-sm" name="nuevaLargoParka" id="nuevaLargoParka" placeholder="Ingresar Talla en Centimetros">
                          </div>
                      </div>
                      <div class="col-xs-3" style="margin: 8px 0px;">
                        <div class="d-block text-center" style="font-size:16px;font-weight:bold">Largo Polar</div>
                          <div class="input-group">
                            <input type="text" class="form-control input-sm" name="nuevaLargoPolar" id="nuevaLargoPolar" placeholder="Ingresar Talla en Centimetros">
                          </div>
                      </div>
                      <div class="col-xs-3" style="margin: 8px 0px;">
                        <div class="d-block text-center" style="font-size:16px;font-weight:bold">Largo Vestido</div>
                          <div class="input-group">
                            <input type="text" class="form-control input-sm" name="nuevaLargoVestido" id="nuevaLargoVestido" placeholder="Ingresar Talla en Centimetros">
                          </div>
                      </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <h3 class="box-title text-center" style="font-weight:bold; font-size:20px;">Medidas Inferiores</h4>
                <div class="box box-warning">
                  <div class="box-body">
                      <div class="col-xs-12">
                        <div class="col-xs-12">
                            <h4 style="font-weight:bold;color:green;font-size:24px;">Pantalon</h4>
                        </div>
                        <div class="col-xs-3" style="margin: 8px 0px;">
                          <div class="d-block text-center" style="font-size:16px;font-weight:bold">Cintura</div>
                            <div class="input-group">
                              <input type="text" class="form-control input-sm" name="nuevaCinturaPantalon" id="nuevaCinturaPantalon" placeholder="Ingresar Talla en Centimetros" >
                            </div>
                        </div>
                        <div class="col-xs-3" style="margin: 8px 0px;">
                          <div class="d-block text-center" style="font-size:16px;font-weight:bold">Cadera</div>
                            <div class="input-group">
                              <input type="text" class="form-control input-sm" name="nuevaCaderaPantalon" id="nuevaCaderaPantalon" placeholder="Ingresar Talla en Centimetros" >
                            </div>
                        </div>
                        <div class="col-xs-3" style="margin: 8px 0px;">
                          <div class="d-block text-center" style="font-size:16px;font-weight:bold">Tiro</div>
                            <div class="input-group">
                              <input type="text" class="form-control input-sm" name="nuevaTiroPantalon" id="nuevaTiroPantalon" placeholder="Ingresar Talla en Centimetros" >
                            </div>
                        </div>
                        <div class="col-xs-3" style="margin: 8px 0px;">
                          <div class="d-block text-center" style="font-size:16px;font-weight:bold">Entrepierna</div>
                            <div class="input-group">
                              <input type="text" class="form-control input-sm" name="nuevaEntrepiernaPantalon" id="nuevaEntrepiernaPantalon" placeholder="Ingresar Talla en Centimetros" >
                            </div>
                        </div>
                        <div class="col-xs-3" style="margin: 8px 0px;">
                          <div class="d-block text-center" style="font-size:16px;font-weight:bold">Contorno Muslo</div>
                            <div class="input-group">
                              <input type="text" class="form-control input-sm" name="nuevaMusloPantalon" id="nuevaMusloPantalon" placeholder="Ingresar Talla en Centimetros" >
                            </div>
                        </div>
                        <div class="col-xs-3" style="margin: 8px 0px;">
                          <div class="d-block text-center" style="font-size:16px;font-weight:bold">Contorno Rodilla</div>
                            <div class="input-group">
                              <input type="text" class="form-control input-sm" name="nuevaRodillaPantalon" id="nuevaRodillaPantalon" placeholder="Ingresar Talla en Centimetros" >
                            </div>
                        </div>
                        <div class="col-xs-3" style="margin: 8px 0px;">
                          <div class="d-block text-center" style="font-size:16px;font-weight:bold">Contorno Basta</div>
                            <div class="input-group">
                              <input type="text" class="form-control input-sm" name="nuevaBastaPantalon" id="nuevaBastaPantalon" placeholder="Ingresar Talla en Centimetros" >
                            </div>
                        </div>
                        <div class="col-xs-3" style="margin: 8px 0px;">
                          <div class="d-block text-center" style="font-size:16px;font-weight:bold">Largo Total</div>
                            <div class="input-group">
                              <input type="text" class="form-control input-sm" name="nuevaLargoPantalon" id="nuevaLargoPantalon" placeholder="Ingresar Talla en Centimetros" >
                            </div>
                      </div>
                      </div>
                      <div class="col-xs-12">
                        <div class="col-xs-12">
                            <h4 style="font-weight:bold;color:green;font-size:24px;">Falda</h4>
                        </div>
                        <div class="col-xs-3">
                          <div class="d-block text-center" style="font-size:16px;font-weight:bold">Cintura</div>
                            <div class="input-group">
                              <input type="text" class="form-control input-sm" name="nuevaCinturaFalda" id="nuevaCinturaFalda" placeholder="Ingresar Talla en Centimetros">
                            </div>
                        </div>
                        <div class="col-xs-3">
                          <div class="d-block text-center" style="font-size:16px;font-weight:bold">Cadera</div>
                            <div class="input-group">
                              <input type="text" class="form-control input-sm" name="nuevaCaderaFalda"  id="nuevaCaderaFalda" placeholder="Ingresar Talla en Centimetros">
                            </div>
                        </div>
                        <div class="col-xs-3">
                          <div class="d-block text-center" style="font-size:16px;font-weight:bold">Largo Total</div>
                            <div class="input-group">
                              <input type="text" class="form-control input-sm" name="nuevaLargoFalda" id="nuevaLargoFalda" placeholder="Ingresar Talla en Centimetros">
                            </div>
                        </div>
                      </div>
                  </div>
                </div>
            </div>
            
            <div class="modal-footer">

              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

              <button type="submit" class="btn btn-primary text-center">Guardar Personal</button>

            </div>
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

       

      </form>

        <?php

          $crearPersonal = new ControladorPersonal();
          $crearPersonal -> ctrCrearPersonal();

        ?>  

    </div>

  </div>

</div>


<div id="modalEditarPersonal" class="modal fade"  role="dialog">
  
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form role="form" method="post" id="form_nuevo_personal" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3f668d; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Personal</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA LOS DATOS PERSONAL -->
            <h4 class="box-title" style="font-weight:bold;margin:auto;margin-bottom:4px;">Datos Personal</h4>
            <div class="box box-info">
              <div class="box-body">                
                <div class="form-group row">              
                  <div class="col-lg-4 col-xs-6">
                    <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold;margin-top:15px;">Nombre</div>
                    <div class="input-group">
                    
                      <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                                
                      <input type="hidden" name="idPersonal" id="idPersonal">          
                      <input type="text" class="form-control input-sm" name="editarPersonal" id="editarPersonal" required>

                    </div>
                  </div>
                  <div class="col-lg-4 col-xs-6">
                    <div class="d-inline-block  text-center" style="font-size:16px;font-weight:bold;margin-top:15px;">RUT</div> 
                      <div class="input-group">
                      
                        <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                        <input type="text" class="form-control input-sm" name="editarRutId" id="editarRutId" required>

                      </div>
                  </div>
                 
                  <div class="col-lg-4 col-xs-6">
                        <div class="d-block text-center" style="font-size:16px;font-weight:bold;margin-top:15px;">Empresa</div>
                          <div class="input-group">
                          
                            <span class="input-group-addon"><i class="fa fa-phone"></i></span> 

                            <select class="form-control input-sm" id="editarEmpresa" name="editarEmpresa" required>
                            
                                <option value="">Seleccionar Empresa</option>

                                <?php

                                $item = null;
                                $valor = null;

                                $clientes = ControladorClientes::ctrMostrarClientes($item, $valor);

                                foreach ($clientes as $key => $value) {
                                echo '<option  value="'.$value["id"].'">'.$value["nombre"].' </option>';
                                }

                                ?>
            
                            </select>

                          </div>
                    </div>            
                  <!-- ENTRADA PARA LA SUBCATEGORIA -->                           
                    <div class="col-lg-4 col-xs-6">
                        <div class="d-block text-center" style="font-size:16px;font-weight:bold;margin-top:15px;">Fono</div>
                          <div class="input-group">
                          
                            <span class="input-group-addon"><i class="fa fa-phone"></i></span> 

                            <input type="tel" class="form-control input-sm" name="editarTelefono" id="editarTelefono"  required>

                          </div>
                    </div>
                    <div class="col-lg-4 col-xs-6">
                     <div class="d-block text-center" style="font-size:16px;font-weight:bold;margin-top:15px;">Email</div>
                          <div class="input-group">
                          
                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 

                            <input type="text" class="form-control input-sm" name="editarEmail" id="editarEmail" required>

                          </div>
                    </div>
                </div> 
              </div>  
            </div>
            <div class="row">
              <h4 class="box-title text-center" style="font-weight:bold; font-size:20px;">Medidas Superiores</h4>
              <div class="box box-success">
                <div class="box-body">
                  <div class="col-xs-12">
                      
                      <div class="col-xs-3" style="margin: 8px 0px;">
                        <div class="d-block text-center" style="font-size:16px;font-weight:bold">Busto</div>
                          <div class="input-group">
                            <input type="text" class="form-control input-sm" name="editarBusto" id="editarBusto" placeholder="Ingresar Talla en Centimetros">
                          </div>
                      </div>
                      <div class="col-xs-3" style="margin: 8px 0px;">
                        <div class="d-block text-center" style="font-size:16px;font-weight:bold">Cintura</div>
                          <div class="input-group">
                            <input type="text" class="form-control input-sm" name="editarCintura" id="editarCintura"  placeholder="Ingresar Talla en Centimetros">
                          </div>
                      </div>
                      <div class="col-xs-3" style="margin: 8px 0px;">
                        <div class="d-block text-center" style="font-size:16px;font-weight:bold">Cadera</div>
                          <div class="input-group">
                            <input type="text" class="form-control input-sm" name="editarCadera"  id="editarCadera" placeholder="Ingresar Talla en Centimetros">
                          </div>
                      </div>
                      <div class="col-xs-3" style="margin: 8px 0px;">
                        <div class="d-block text-center" style="font-size:16px;font-weight:bold">Ancho Espalda</div>
                          <div class="input-group">
                            <input type="text" class="form-control input-sm" name="editarAnchoEspalda" id="editarAnchoEspalda" placeholder="Ingresar Talla en Centimetros">
                          </div>
                      </div>
                      <div class="col-xs-3" style="margin: 8px 0px;">
                        <div class="d-block text-center" style="font-size:16px;font-weight:bold">Talle Delantero</div>
                          <div class="input-group">
                            <input type="text" class="form-control input-sm" name="editarTalleDelantero" id="editarTalleDelantero" placeholder="Ingresar Talla en Centimetros">
                          </div>
                      </div>
                      <div class="col-xs-3" style="margin: 8px 0px;">
                        <div class="d-block text-center" style="font-size:16px;font-weight:bold">Talle Espalda</div>
                          <div class="input-group">
                            <input type="text" class="form-control input-sm" name="editarTalleEspalda" id="editarTalleEspalda" placeholder="Ingresar Talla en Centimetros">
                          </div>
                      </div>
                      <div class="col-xs-3" style="margin: 8px 0px;">
                        <div class="d-block text-center" style="font-size:16px;font-weight:bold">Largo Manga</div>
                          <div class="input-group">
                            <input type="text" class="form-control input-sm" name="editarLargoManga" id="editarLargoManga" placeholder="Ingresar Talla en Centimetros">
                          </div>
                      </div>
                      <div class="col-xs-3" style="margin: 8px 0px;">
                        <div class="d-block text-center" style="font-size:16px;font-weight:bold">Largo Blusa</div>
                          <div class="input-group">
                            <input type="text" class="form-control input-sm" name="editarLargoBlusa" id="editarLargoBlusa" placeholder="Ingresar Talla en Centimetros">
                          </div>
                      </div>
                      <div class="col-xs-3" style="margin: 8px 0px;">
                        <div class="d-block text-center" style="font-size:16px;font-weight:bold">Largo Guillete</div>
                          <div class="input-group">
                            <input type="text" class="form-control input-sm" name="editarLargoGuillete" id="editarLargoGuillete" placeholder="Ingresar Talla en Centimetros">
                          </div>
                      </div>
                      <div class="col-xs-3" style="margin: 8px 0px;">
                        <div class="d-block text-center" style="font-size:16px;font-weight:bold">Largo Chaqueta</div>
                          <div class="input-group">
                            <input type="text" class="form-control input-sm" name="editarLargoChaqueta" id="editarLargoChaqueta" placeholder="Ingresar Talla en Centimetros">
                          </div>
                      </div>
                      <div class="col-xs-3" style="margin: 8px 0px;">
                        <div class="d-block text-center" style="font-size:16px;font-weight:bold">Largo Polera</div>
                          <div class="input-group">
                            <input type="text" class="form-control input-sm" name="editarLargoPolera" id="editarLargoPolera" placeholder="Ingresar Talla en Centimetros">
                          </div>
                      </div>
                      <div class="col-xs-3" style="margin: 8px 0px;">
                        <div class="d-block text-center" style="font-size:16px;font-weight:bold">Largo Parka</div>
                          <div class="input-group">
                            <input type="text" class="form-control input-sm" name="editarLargoParka" id="editarLargoParka" placeholder="Ingresar Talla en Centimetros">
                          </div>
                      </div>
                      <div class="col-xs-3" style="margin: 8px 0px;">
                        <div class="d-block text-center" style="font-size:16px;font-weight:bold">Largo Polar</div>
                          <div class="input-group">
                            <input type="text" class="form-control input-sm" name="editarLargoPolar" id="editarLargoPolar" placeholder="Ingresar Talla en Centimetros">
                          </div>
                      </div>
                      <div class="col-xs-3" style="margin: 8px 0px;">
                        <div class="d-block text-center" style="font-size:16px;font-weight:bold">Largo Vestido</div>
                          <div class="input-group">
                            <input type="text" class="form-control input-sm" name="editarLargoVestido" id="editarLargoVestido" placeholder="Ingresar Talla en Centimetros">
                          </div>
                      </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <h3 class="box-title text-center" style="font-weight:bold; font-size:20px;">Medidas Inferiores</h4>
                <div class="box box-warning">
                  <div class="box-body">
                      <div class="col-xs-12">
                        <div class="col-xs-12">
                            <h4 style="font-weight:bold;color:green;font-size:24px;">Pantalon</h4>
                        </div>
                        <div class="col-xs-3" style="margin: 8px 0px;">
                          <div class="d-block text-center" style="font-size:16px;font-weight:bold">Cintura</div>
                            <div class="input-group">
                              <input type="text" class="form-control input-sm" name="editarCinturaPantalon" id="editarCinturaPantalon" placeholder="Ingresar Talla en Centimetros" >
                            </div>
                        </div>
                        <div class="col-xs-3" style="margin: 8px 0px;">
                          <div class="d-block text-center" style="font-size:16px;font-weight:bold">Cadera</div>
                            <div class="input-group">
                              <input type="text" class="form-control input-sm" name="editarCaderaPantalon" id="editarCaderaPantalon" placeholder="Ingresar Talla en Centimetros" >
                            </div>
                        </div>
                        <div class="col-xs-3" style="margin: 8px 0px;">
                          <div class="d-block text-center" style="font-size:16px;font-weight:bold">Tiro</div>
                            <div class="input-group">
                              <input type="text" class="form-control input-sm" name="editarTiroPantalon" id="editarTiroPantalon" placeholder="Ingresar Talla en Centimetros" >
                            </div>
                        </div>
                        <div class="col-xs-3" style="margin: 8px 0px;">
                          <div class="d-block text-center" style="font-size:16px;font-weight:bold">Entrepierna</div>
                            <div class="input-group">
                              <input type="text" class="form-control input-sm" name="editarEntrepiernaPantalon" id="editarEntrepiernaPantalon" placeholder="Ingresar Talla en Centimetros" >
                            </div>
                        </div>
                        <div class="col-xs-3" style="margin: 8px 0px;">
                          <div class="d-block text-center" style="font-size:16px;font-weight:bold">Contorno Muslo</div>
                            <div class="input-group">
                              <input type="text" class="form-control input-sm" name="editarMusloPantalon" id="editarMusloPantalon" placeholder="Ingresar Talla en Centimetros" >
                            </div>
                        </div>
                        <div class="col-xs-3" style="margin: 8px 0px;">
                          <div class="d-block text-center" style="font-size:16px;font-weight:bold">Contorno Rodilla</div>
                            <div class="input-group">
                              <input type="text" class="form-control input-sm" name="editarRodillaPantalon" id="editarRodillaPantalon" placeholder="Ingresar Talla en Centimetros" >
                            </div>
                        </div>
                        <div class="col-xs-3" style="margin: 8px 0px;">
                          <div class="d-block text-center" style="font-size:16px;font-weight:bold">Contorno Basta</div>
                            <div class="input-group">
                              <input type="text" class="form-control input-sm" name="editarBastaPantalon" id="editarBastaPantalon" placeholder="Ingresar Talla en Centimetros" >
                            </div>
                        </div>
                        <div class="col-xs-3" style="margin: 8px 0px;">
                          <div class="d-block text-center" style="font-size:16px;font-weight:bold">Largo Total</div>
                            <div class="input-group">
                              <input type="text" class="form-control input-sm" name="editarLargoPantalon" id="editarLargoPantalon" placeholder="Ingresar Talla en Centimetros" >
                            </div>
                      </div>
                      </div>
                      <div class="col-xs-12">
                        <div class="col-xs-12">
                            <h4 style="font-weight:bold;color:green;font-size:24px;">Falda</h4>
                        </div>
                        <div class="col-xs-3">
                          <div class="d-block text-center" style="font-size:16px;font-weight:bold">Cintura</div>
                            <div class="input-group">
                              <input type="text" class="form-control input-sm" name="editarCinturaFalda" id="editarCinturaFalda" placeholder="Ingresar Talla en Centimetros">
                            </div>
                        </div>
                        <div class="col-xs-3">
                          <div class="d-block text-center" style="font-size:16px;font-weight:bold">Cadera</div>
                            <div class="input-group">
                              <input type="text" class="form-control input-sm" name="editarCaderaFalda"  id="editarCaderaFalda" placeholder="Ingresar Talla en Centimetros">
                            </div>
                        </div>
                        <div class="col-xs-3">
                          <div class="d-block text-center" style="font-size:16px;font-weight:bold">Largo Total</div>
                            <div class="input-group">
                              <input type="text" class="form-control input-sm" name="editarLargoFalda" id="editarLargoFalda" placeholder="Ingresar Talla en Centimetros">
                            </div>
                        </div>
                      </div>
                  </div>
                </div>
            </div>
             <!-- ENTRADA PARA STOCK -->

            
            <div class="modal-footer">

              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

              <button type="submit" class="btn btn-primary text-center">Guardar Cambios</button>

            </div>
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

       

      </form>

        <?php

          $editarPersonal = new ControladorPersonal();
          $editarPersonal -> ctrEditarPersonal();

        ?>  

    </div>

  </div>

</div>

<div id="modalVerMedidas" class="modal fade"  role="dialog">
  
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form role="form" method="post" id="form_nuevo_personal" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3f668d; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Personal</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA LOS DATOS PERSONAL -->
            <h4 class="box-title" style="font-weight:bold;margin:auto;margin-bottom:4px;">Datos Personal</h4>
            <div class="box box-info">
              <div class="box-body">                
                <div class="form-group row">              
                  <div class="col-lg-4 col-xs-6">
                    <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold;margin-top:15px;">Nombre</div>
                    <div class="input-group">
                    
                      <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                                
                      <input type="hidden" name="idPersonal" id="idPersonal">          
                      <input type="text" class="form-control input-sm" name="editarPersonal" id="editarPersonal" required>

                    </div>
                  </div>
                  <div class="col-lg-4 col-xs-6">
                    <div class="d-inline-block  text-center" style="font-size:16px;font-weight:bold;margin-top:15px;">RUT</div> 
                      <div class="input-group">
                      
                        <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                        <input type="text" class="form-control input-sm" name="editarRutId" id="editarRutId" required>

                      </div>
                  </div>
                 
                  <div class="col-lg-4 col-xs-6">
                        <div class="d-block text-center" style="font-size:16px;font-weight:bold;margin-top:15px;">Empresa</div>
                          <div class="input-group">
                          
                            <span class="input-group-addon"><i class="fa fa-phone"></i></span> 

                            <select class="form-control input-sm" id="editarEmpresa" name="editarEmpresa" required>
                            
                                <option value="">Seleccionar Empresa</option>

                                <?php

                                $item = null;
                                $valor = null;

                                $clientes = ControladorClientes::ctrMostrarClientes($item, $valor);

                                foreach ($clientes as $key => $value) {
                                echo '<option  value="'.$value["id"].'">'.$value["nombre"].' </option>';
                                }

                                ?>
            
                            </select>

                          </div>
                    </div>            
                  <!-- ENTRADA PARA LA SUBCATEGORIA -->                           
                    <div class="col-lg-4 col-xs-6">
                        <div class="d-block text-center" style="font-size:16px;font-weight:bold;margin-top:15px;">Fono</div>
                          <div class="input-group">
                          
                            <span class="input-group-addon"><i class="fa fa-phone"></i></span> 

                            <input type="tel" class="form-control input-sm" name="editarTelefono" id="editarTelefono"  required>

                          </div>
                    </div>
                    <div class="col-lg-4 col-xs-6">
                     <div class="d-block text-center" style="font-size:16px;font-weight:bold;margin-top:15px;">Email</div>
                          <div class="input-group">
                          
                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 

                            <input type="text" class="form-control input-sm" name="editarEmail" id="editarEmail" required>

                          </div>
                    </div>
                </div> 
              </div>  
            </div>
            <div class="row">
              <h4 class="box-title text-center" style="font-weight:bold; font-size:20px;">Medidas Superiores</h4>
              <div class="box box-success">
                <div class="box-body">
                  <div class="col-xs-12">
                      
                      <div class="col-xs-3" style="margin: 8px 0px;">
                        <div class="d-block text-center" style="font-size:16px;font-weight:bold">Busto</div>
                          <div class="input-group">
                            <input type="text" class="form-control input-sm" name="editarBusto" id="editarBusto" placeholder="Ingresar Talla en Centimetros">
                          </div>
                      </div>
                      <div class="col-xs-3" style="margin: 8px 0px;">
                        <div class="d-block text-center" style="font-size:16px;font-weight:bold">Cintura</div>
                          <div class="input-group">
                            <input type="text" class="form-control input-sm" name="editarCintura" id="editarCintura"  placeholder="Ingresar Talla en Centimetros">
                          </div>
                      </div>
                      <div class="col-xs-3" style="margin: 8px 0px;">
                        <div class="d-block text-center" style="font-size:16px;font-weight:bold">Cadera</div>
                          <div class="input-group">
                            <input type="text" class="form-control input-sm" name="editarCadera"  id="editarCadera" placeholder="Ingresar Talla en Centimetros">
                          </div>
                      </div>
                      <div class="col-xs-3" style="margin: 8px 0px;">
                        <div class="d-block text-center" style="font-size:16px;font-weight:bold">Ancho Espalda</div>
                          <div class="input-group">
                            <input type="text" class="form-control input-sm" name="editarAnchoEspalda" id="editarAnchoEspalda" placeholder="Ingresar Talla en Centimetros">
                          </div>
                      </div>
                      <div class="col-xs-3" style="margin: 8px 0px;">
                        <div class="d-block text-center" style="font-size:16px;font-weight:bold">Talle Delantero</div>
                          <div class="input-group">
                            <input type="text" class="form-control input-sm" name="editarTalleDelantero" id="editarTalleDelantero" placeholder="Ingresar Talla en Centimetros">
                          </div>
                      </div>
                      <div class="col-xs-3" style="margin: 8px 0px;">
                        <div class="d-block text-center" style="font-size:16px;font-weight:bold">Talle Espalda</div>
                          <div class="input-group">
                            <input type="text" class="form-control input-sm" name="editarTalleEspalda" id="editarTalleEspalda" placeholder="Ingresar Talla en Centimetros">
                          </div>
                      </div>
                      <div class="col-xs-3" style="margin: 8px 0px;">
                        <div class="d-block text-center" style="font-size:16px;font-weight:bold">Largo Manga</div>
                          <div class="input-group">
                            <input type="text" class="form-control input-sm" name="editarLargoManga" id="editarLargoManga" placeholder="Ingresar Talla en Centimetros">
                          </div>
                      </div>
                      <div class="col-xs-3" style="margin: 8px 0px;">
                        <div class="d-block text-center" style="font-size:16px;font-weight:bold">Largo Blusa</div>
                          <div class="input-group">
                            <input type="text" class="form-control input-sm" name="editarLargoBlusa" id="editarLargoBlusa" placeholder="Ingresar Talla en Centimetros">
                          </div>
                      </div>
                      <div class="col-xs-3" style="margin: 8px 0px;">
                        <div class="d-block text-center" style="font-size:16px;font-weight:bold">Largo Guillete</div>
                          <div class="input-group">
                            <input type="text" class="form-control input-sm" name="editarLargoGuillete" id="editarLargoGuillete" placeholder="Ingresar Talla en Centimetros">
                          </div>
                      </div>
                      <div class="col-xs-3" style="margin: 8px 0px;">
                        <div class="d-block text-center" style="font-size:16px;font-weight:bold">Largo Chaqueta</div>
                          <div class="input-group">
                            <input type="text" class="form-control input-sm" name="editarLargoChaqueta" id="editarLargoChaqueta" placeholder="Ingresar Talla en Centimetros">
                          </div>
                      </div>
                      <div class="col-xs-3" style="margin: 8px 0px;">
                        <div class="d-block text-center" style="font-size:16px;font-weight:bold">Largo Polera</div>
                          <div class="input-group">
                            <input type="text" class="form-control input-sm" name="editarLargoPolera" id="editarLargoPolera" placeholder="Ingresar Talla en Centimetros">
                          </div>
                      </div>
                      <div class="col-xs-3" style="margin: 8px 0px;">
                        <div class="d-block text-center" style="font-size:16px;font-weight:bold">Largo Parka</div>
                          <div class="input-group">
                            <input type="text" class="form-control input-sm" name="editarLargoParka" id="editarLargoParka" placeholder="Ingresar Talla en Centimetros">
                          </div>
                      </div>
                      <div class="col-xs-3" style="margin: 8px 0px;">
                        <div class="d-block text-center" style="font-size:16px;font-weight:bold">Largo Polar</div>
                          <div class="input-group">
                            <input type="text" class="form-control input-sm" name="editarLargoPolar" id="editarLargoPolar" placeholder="Ingresar Talla en Centimetros">
                          </div>
                      </div>
                      <div class="col-xs-3" style="margin: 8px 0px;">
                        <div class="d-block text-center" style="font-size:16px;font-weight:bold">Largo Vestido</div>
                          <div class="input-group">
                            <input type="text" class="form-control input-sm" name="editarLargoVestido" id="editarLargoVestido" placeholder="Ingresar Talla en Centimetros">
                          </div>
                      </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <h3 class="box-title text-center" style="font-weight:bold; font-size:20px;">Medidas Inferiores</h4>
                <div class="box box-warning">
                  <div class="box-body">
                      <div class="col-xs-12">
                        <div class="col-xs-12">
                            <h4 style="font-weight:bold;color:green;font-size:24px;">Pantalon</h4>
                        </div>
                        <div class="col-xs-3" style="margin: 8px 0px;">
                          <div class="d-block text-center" style="font-size:16px;font-weight:bold">Cintura</div>
                            <div class="input-group">
                              <input type="text" class="form-control input-sm" name="editarCinturaPantalon" id="editarCinturaPantalon" placeholder="Ingresar Talla en Centimetros" >
                            </div>
                        </div>
                        <div class="col-xs-3" style="margin: 8px 0px;">
                          <div class="d-block text-center" style="font-size:16px;font-weight:bold">Cadera</div>
                            <div class="input-group">
                              <input type="text" class="form-control input-sm" name="editarCaderaPantalon" id="editarCaderaPantalon" placeholder="Ingresar Talla en Centimetros" >
                            </div>
                        </div>
                        <div class="col-xs-3" style="margin: 8px 0px;">
                          <div class="d-block text-center" style="font-size:16px;font-weight:bold">Tiro</div>
                            <div class="input-group">
                              <input type="text" class="form-control input-sm" name="editarTiroPantalon" id="editarTiroPantalon" placeholder="Ingresar Talla en Centimetros" >
                            </div>
                        </div>
                        <div class="col-xs-3" style="margin: 8px 0px;">
                          <div class="d-block text-center" style="font-size:16px;font-weight:bold">Entrepierna</div>
                            <div class="input-group">
                              <input type="text" class="form-control input-sm" name="editarEntrepiernaPantalon" id="editarEntrepiernaPantalon" placeholder="Ingresar Talla en Centimetros" >
                            </div>
                        </div>
                        <div class="col-xs-3" style="margin: 8px 0px;">
                          <div class="d-block text-center" style="font-size:16px;font-weight:bold">Largo Total</div>
                            <div class="input-group">
                              <input type="text" class="form-control input-sm" name="editarLargoPantalon" id="editarLargoPantalon" placeholder="Ingresar Talla en Centimetros" >
                            </div>
                      </div>
                      </div>
                      <div class="col-xs-12">
                        <div class="col-xs-12">
                            <h4 style="font-weight:bold;color:green;font-size:24px;">Falda</h4>
                        </div>
                        <div class="col-xs-3">
                          <div class="d-block text-center" style="font-size:16px;font-weight:bold">Cintura</div>
                            <div class="input-group">
                              <input type="text" class="form-control input-sm" name="editarCinturaFalda" id="editarCinturaFalda" placeholder="Ingresar Talla en Centimetros">
                            </div>
                        </div>
                        <div class="col-xs-3">
                          <div class="d-block text-center" style="font-size:16px;font-weight:bold">Cadera</div>
                            <div class="input-group">
                              <input type="text" class="form-control input-sm" name="editarCaderaFalda"  id="editarCaderaFalda" placeholder="Ingresar Talla en Centimetros">
                            </div>
                        </div>
                        <div class="col-xs-3">
                          <div class="d-block text-center" style="font-size:16px;font-weight:bold">Largo Total</div>
                            <div class="input-group">
                              <input type="text" class="form-control input-sm" name="editarLargoFalda" id="editarLargoFalda" placeholder="Ingresar Talla en Centimetros">
                            </div>
                        </div>
                      </div>
                  </div>
                </div>
            </div>
             <!-- ENTRADA PARA STOCK -->

            
            <div class="modal-footer">

              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

              <button type="submit" class="btn btn-primary text-center">Guardar Cambios</button>

            </div>
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

       

      </form> 

    </div>

  </div>

</div>


<?php

  $eliminarPersonal = new ControladorPersonal();
  $eliminarPersonal -> ctrEliminarPersonal();

?>


