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
      
      Administrar Clientes
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar Clientes</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border"> 
      
      <a href="vistas/modulos/descargar-reporte-clientes.php?reporte=reporte">
            <button class="btn btn-success">Descargar Reporte Clientes en Excel</button>
          </a>
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCliente">
          
          Agregar Cliente

        </button>
        
       

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Nombre</th>
           <th>Rut</th>
           <th>Email</th>
           <th>Teléfono</th>
           <th>Region</th>
           <th>Comuna</th>
           <th>Dirección</th>
           <th>Actividad</th>
           <th>Ejecutivo</th>
           <th>Descuento</th>

           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

          $item = null;
          $valor = null;

          $clientes = ControladorClientes::ctrMostrarClientes($item, $valor);

          foreach ($clientes as $key => $value) {
            // Obtener los nombres de la región y la comuna
            $regionNombre = ControladorRegiones::ctrMostrarRegiones('id', $value['region']);
            $comunaNombre = ControladorRegiones::ctrMostrarComunas('id', $value['comuna']);

            // Asignar nombres o mostrar el ID si no se encuentra el nombre
            $regionDisplay = $regionNombre ? htmlspecialchars($regionNombre['nombre']) : ''.$value['region'];
            $comunaDisplay = $comunaNombre ? htmlspecialchars($comunaNombre[0]['nombre']) : ''.$value['comuna'];
        
            echo '<tr>
                    <td>'.($key+1).'</td>
                    <td>'.$value["nombre"].'</td>
                    <td>'.$value["rut"].'</td>
                    <td>'.$value["email"].'</td>
                    <td>'.$value["telefono"].'</td>
                    <td>'.$regionDisplay.'</td>
                    <td>'.$comunaDisplay.'</td> 
                    <td>'.$value["direccion"].'</td>  
                    <td>'.$value["actividad"].'</td> 
                    <td>'.$value["ejecutivo"].'</td> 
                    <td>'.$value["factor_lista"].'%</td> 
                    <td>
                        <div class="btn-group">
                            <button class="btn btn-warning btnEditarCliente" data-toggle="modal" data-target="#modalEditarCliente" idCliente="'.$value["id"].'"><i class="fa fa-pencil"></i></button>';
        
            if ($_SESSION["perfil"] == "Administrador") {
                echo '<button class="btn btn-danger btnEliminarCliente" idCliente="'.$value["id"].'"><i class="fa fa-times"></i></button>';
            }
        
            echo '      </div>  
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

<div id="modalAgregarCliente" class="modal fade"  role="dialog">
  
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form role="form" method="post" id="form_nuevo_cliente" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3f668d; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Cliente</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">


            <!-- ENTRADA PARA SELECCIONAR CATEGORÍA -->

            

            <!-- ENTRADA PARA LOS DATOS CLIENTE -->
            <h4 class="box-title" style="font-weight:bold;margin:auto;margin-bottom:4px;">Datos Cliente</h4>
            <div class="box box-info">
              <div class="box-body">                
                <div class="form-group row">              
                  <div class="col-lg-4">
                    <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold">Razon Social</div>
                    <div class="input-group">
                    
                      <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                      <input type="text" class="form-control input" name="nuevoCliente" id="nuevoCliente" placeholder="Ingrese Razon Social" required>

                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="d-inline-block  text-center" style="font-size:16px;font-weight:bold">RUT</div> 
                      <div class="input-group">
                      
                        <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                        <input type="text" class="form-control input" name="nuevoRutId" id="nuevoRutId" 
                          placeholder="Ingrese su RUT" 
                          required
                          onblur="formatearRut(this)">

                      </div>
                  </div>
                 
                    <div class="col-lg-4">
                        <div class="d-inline-block  text-center" style="font-size:16px;font-weight:bold">Actividad</div> 
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-th"></i></span> 
                          <input type="text" class="form-control input" name="nuevaActividad" id="nuevaActividad" placeholder="Ingrese su Actividad" required>
                        </div>
                    </div>                 
                  <!-- ENTRADA PARA LA SUBCATEGORIA -->
                  <div class="col-xs-6">
                    <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold">Pais</div>
                    <div class="input-group">
                    
                      <span class="input-group-addon"><i class="fa fa-globe"></i></span> 

                      <input type="text" class="form-control input" name="nuevoPais" id="nuevoPais" placeholder="Ingrese Pais" required value="Chile">

                    </div>
                  </div>
                  <div class="col-xs-6">
                        <div class="d-inline-block text-center " style="font-size:16px;font-weight:bold">Region</div>
                          <div class="input-group">
                      
                            <span class="input-group-addon"><i class="fa fa-globe"></i></span> 

                            <select class="form-control input" id="nuevaRegion" name="nuevaRegion" required>
                                                                            
                                <option  value="">Seleccionar Region</option>

                                <?php
                                $regiones = ControladorRegiones::ctrMostrarRegiones(null, null); // Consultar todas las regiones
                                foreach ($regiones as $region) {
                                    echo '<option value="'.$region["id"].'">'.$region["nombre"].'</option>';
                                }
                                ?>
            
                            </select>


                          </div>
                      </div>   
                  <!-- ENTRADA PARA LA CIUDAD -->
                      <div class="col-xs-6">
                          <div class="d-block text-center" style="font-size:16px;font-weight:bold">Comuna</div>
                            <div class="input-group">
                            
                              <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 

                                <select class="form-control input" id="nuevaComuna" name="nuevaComuna" required>
                                                                              
                                    <option value="">Seleccionar Comuna</option>
              
                                </select>

                            </div>
                      </div>
     
                    <div class="col-xs-6">
                    <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold">Direccion</div>
                    <div class="input-group">
                    
                      <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 

                      <input type="text" class="form-control input" name="nuevaDireccion" id="nuevaDireccion" placeholder="Ingrese Direccion" required>

                    </div>
                    </div>
                    
                    <div class="col-xs-6">
                    <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold">Tipo Campaña</div>
                    <div class="input-group">
                    
                      <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                      <select class="form-control input" id="nuevoTipoCliente" name="nuevoTipoCliente" required>
                            
                        <option value="">Seleccionar Tipo Cliente</option>
                        <?php

                          $item = null;
                          $valor = null;

                          $tipoCliente = ControladorTipoClientes::ctrMostrarTipoClientes($item, $valor);

                          foreach ($tipoCliente as $key => $value) {
                            
                            echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                          }

                        ?>
                      </select>

                    </div>
                    </div>
                    <div class="col-xs-6">
                    <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold">Tipo Producto</div>
                    <div class="input-group">
                    
                      <span class="input-group-addon"><i class="fa fa-file"></i></span> 

                      <select class="form-control input" id="nuevoTipoProducto" name="nuevoTipoProducto" required>
                            
                            <option value="">Seleccionar Tipo Producto</option>
                            <?php
    
                              $item = null;
                              $valor = null;
    
                              $tipoProducto = ControladorTipoProductos::ctrMostrarTipoProductos($item, $valor);
    
                              foreach ($tipoProducto as $key => $value) {
                                
                                echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                              }
    
                            ?>
                          </select>

                    </div>
                    </div>
                    <div class="col-xs-6">
                    <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold">Lista de Precio Asignada</div>
                    <div class="input-group">
                    
                      <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                      <select class="form-control input" id="nuevoFactor" name="nuevoFactor" required>
                            
                        <option value="1">PRECIO LISTA - 0%</option>
                        <?php

                          $item = null;
                          $valor = null;

                          $listaPrecio = ControladorListas::ctrMostrarListas($item, $valor);

                          foreach ($listaPrecio as $key => $value) {
                            if($value["id"] != 1){
                            echo '<option value="'.$value["id"].'">'.$value["nombre_lista"].'- %'.$value["factor"].'</option>';}
                          }

                        ?>
                      </select>

                    </div>
                    </div>
                </div> 
              </div>  
            </div>
             <!-- ENTRADA PARA STOCK -->

            <h4 class="box-title" style="font-weight:bold;">Datos de Contacto</h4>      
            <div class="box box-warning">
              <div class="box-body">
                <div class="form-group row">
                  <!-- ENTRADA PARA EL EJECUTIVO-->
                  <div class="col-xs-4">
                        <div class="d-block" style="font-size:16px;font-weight:bold;">Ejecutivo</div>
                          <div class="input-group">
                          
                            <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                            <input type="text" class="form-control input" name="nuevoEjecutivo" id="nuevoEjecutivo" placeholder="Ingresar ejecutivo" required>

                          </div>
                      </div>
                  
                  <!-- ENTRADA PARA EL TELEFONO-->
                      <div class="col-xs-4">
                        <div class="d-block" style="font-size:16px;font-weight:bold">Numero de Telefono</div>
                          <div class="input-group">
                          
                            <span class="input-group-addon"><i class="fa fa-phone"></i></span> 

                            <input type="tel" class="form-control input" name="nuevoTelefono"
                                            placeholder="Ingresar teléfono" required
                                            maxlength="12" pattern="^\+[0-9]{11}$"
                                            title="Ingrese el número de teléfono completo incluido el +"
                                            onfocus="validarTelefono(this)">
                          </div>
                      </div>
                      
                  <!-- ENTRADA PARA EL EMAIL-->
                      <div class="col-xs-4">
                        <div class="d-block" style="font-size:16px;font-weight:bold">Correo Electronico</div>
                          <div class="input-group">
                          
                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 

                            <input type="text" class="form-control input" name="nuevoEmail" placeholder="Ingresar email" required pattern="^[^@]+@[^@]+.[a-zA-Z]{2,}$" title="El email debe contener un arroba (@) y un punto (.) después del arroba">

                          </div>
                      </div>
                
                </div>
              </div>
            </div>
             <!-- ENTRADA PARA EL CÓDIGO -->

             <h4 class="box-title" style="font-weight:bold;">Datos de Credito y Cobranza</h4>
            <div class="box box-success">
              <div class="box-body">
                <div class="form-group row"> 
                  <div class="col-xs-4">
                      <div class="d-inline-block  text-center" style="font-size:16px;font-weight:bold">Plazo de Pago</div>
                          <div class="input-group">
                          
                            <span class="input-group-addon"><i class="fa fa-code"></i></span> 
                          
                            <select class="form-control input" id="nuevoPlazo" name="nuevoPlazo" required>
                            
                            <option value="">Seleccionar Plazo de Pago</option>

                            <?php

                            $item = null;
                            $valor = null;

                            $plazos = ControladorPlazos::ctrMostrarPlazos($item, $valor);

                            foreach ($plazos as $key => $value) {
                            echo '<option  value="'.$value["id"].'">'.$value["nombre"].' </option>';
                            }

                            ?>
            
                        </select>
                        
                      </div> 

                  </div>
                  <div class="col-xs-4">
                    <div class="d-inline-block  text-center" style="font-size:16px;font-weight:bold">Vendedor</div>
                    <div class="input-group">
                    
                      <span class="input-group-addon"><i class="fa fa-check"></i></span> 

                      <select class="form-control input" id="nuevoVendedor" name="nuevoVendedor" required>
                            
                        <option value="">Seleccionar Vendedor</option>
                        <?php

                          $item = null;
                          $valor = null;

                          $vendedor = ControladorPlantel::ctrMostrarPlantel($item, $valor);

                          foreach ($vendedor as $key => $value) {
                            
                            echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                          }

                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-xs-4">
                    <div class="d-inline-block  text-center" style="font-size:16px;font-weight:bold">Estado de Cliente en Sistema</div>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-check"></i></span> 

                      <select class="form-control input" id="nuevoEstado" name="nuevoEstado" required>
          
                      <option value="">Seleccionar Estado: </option>
                      <option value="activo">Activo </option>  
                      <option value="inactivo">Inactivo</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="form-group row">                 
                  <div class="col-xs-4">
                    <div class="d-block text-center" style="font-size:16px;font-weight:bold">Contacto Cobranza</div>
                      <div class="input-group">
                      
                        <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                        <input type="tel" class="form-control input" name="nuevoTelefonoCobranza" placeholder="Ingresar contacto" required>

                      </div>
                  </div>
                  <div class="col-xs-4 ">
                    <div class="d-block text-center" style="font-size:16px;font-weight:bold">Correo Electronico</div>
                      <div class="input-group">
                      
                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 

                        <input type="text" class="form-control input" name="nuevoEmail" placeholder="Ingresar email" required pattern="^[^@]+@[^@]+.[a-zA-Z]{2,}$" title="El email debe contener un arroba (@) y un punto (.) después del arroba">

                      </div>
                  </div>
                  <div class="col-xs-4">
                    <div class="d-block text-center" style="font-size:16px;font-weight:bold">Fono</div>
                      <div class="input-group">
                      
                        <span class="input-group-addon"><i class="fa fa-phone"></i></span> 

                        <input type="tel" class="form-control input" name="nuevoTelefono"
                                            placeholder="Ingresar teléfono" required
                                            maxlength="12" pattern="^\+[0-9]{11}$"
                                            title="Ingrese el número de teléfono completo incluido el +"
                                            onfocus="validarTelefono(this)">
                      </div>
                  </div>
                
                </div>
                <div class="form-group row">                 
                  <div class="col-xs-3">
                    <div class="d-block text-center" style="font-size:16px;font-weight:bold;">Linea de Credito</div>
                      <div class="input-group">
                      
                        <span class="input-group-addon"><i class="fa fa-money"></i></span> 

                        <input type="number" class="form-control input" name="nuevaLinea" placeholder="Ingresar Linea de Credito" required>

                      </div>
                  </div>
                  <div class="col-xs-3">
                    <div class="d-block text-center" style="font-size:16px;font-weight:bold">Bloqueo para Credito</div>
                      <div class="input-group">
                      
                        <span class="input-group-addon"><i class="fa fa-bank"></i></span> 

                        <select class="form-control input" name="" id="">
                        <option value="No">No</option>
                        <option value="Si">Si</option>
                        </select>

                      </div>
                  </div>
                  <div class="col-xs-6">
                  <div class="d-block text-center" style="font-size:16px;font-weight:bold">Observacion de Cobranza</div>
                          <textarea style="border-width:1px;border-color:blue" class="form-control input" name="" id="" cols="6" rows="3"></textarea>
                  </div>
                  
                
                </div>              

                  
                 

                </div>
              </div> 
            </div>

            <div class="modal-footer">

              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

              <button type="submit" class="btn btn-primary text-center">Guardar Cliente</button>

            </div>
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

       

      </form>

        <?php

          $crearCliente = new ControladorClientes();
          $crearCliente -> ctrCrearCliente();

        ?>  

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR CLIENTE
======================================-->



<div id="modalEditarCliente" class="modal fade"  role="dialog">
  
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form role="form" method="post" id="form_nuevo_cliente" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#FFA500; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Cliente</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">


            <!-- ENTRADA PARA SELECCIONAR CATEGORÍA -->

            

            <!-- ENTRADA PARA LOS DATOS CLIENTE -->
            <h4 class="box-title" style="font-weight:bold;margin:auto;margin-bottom:4px;">Datos Cliente</h4>
            <div class="box box-info">
              <div class="box-body">                
                <div class="form-group row">              
                  <div class="col-lg-4">
                    <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold">Razon Social</div>
                    <div class="input-group">
                    
                      <span class="input-group-addon"><i class="fa fa-user"></i></span> 
                      <input type="hidden" id="idCliente" name="idCliente">
                      <input type="text" class="form-control input" name="editarCliente" id="editarCliente" placeholder="Ingrese Razon Social" required>

                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="d-inline-block  text-center" style="font-size:16px;font-weight:bold">RUT</div> 
                      <div class="input-group">
                      
                        <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                        <input type="text" class="form-control input" name="editarRutId" id="editarRutId" 
                          placeholder="Ingrese su RUT" 
                          required
                          pattern="^(\d{1,2}\.\d{3}\.\d{3}-[\dkK])$" 
                          title="El RUT debe tener el formato XX.XXX.XXX-X">

                      </div>
                  </div>
                 
                    <div class="col-lg-4">
                        <div class="d-inline-block  text-center" style="font-size:16px;font-weight:bold">Actividad</div> 
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-th"></i></span> 
                          <input type="text" class="form-control input" name="editarActividad" id="editarActividad" placeholder="Ingrese su Actividad" required>
                        </div>
                    </div>                 
                  <!-- ENTRADA PARA LA SUBCATEGORIA -->
                  <div class="col-xs-6">
                    <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold">Pais</div>
                    <div class="input-group">
                    
                      <span class="input-group-addon"><i class="fa fa-globe"></i></span> 

                      <input type="text" class="form-control input" name="editarPais" id="editarPais" placeholder="Ingrese Pais" required value="Chile">

                    </div>
                  </div>
                  <div class="col-xs-6">
                        <div class="d-inline-block text-center " style="font-size:16px;font-weight:bold">Region</div>
                          <div class="input-group">
                      
                            <span class="input-group-addon"><i class="fa fa-globe"></i></span> 

                            <select class="form-control input" id="editarRegion" name="editarRegion" required>
                                                                            
                                <option  value="">Seleccionar Region</option>

                                <?php
                                foreach ($regiones as $region) {
                                    echo '<option value="'.$region['id'].'" '.($region['id'] == $cliente['region'] ? 'selected' : '').'>'.$region['nombre'].'</option>';
                                }
                                ?>
            
                            </select>


                          </div>
                      </div>   
                  <!-- ENTRADA PARA LA CIUDAD -->
                      <div class="col-xs-6">
                          <div class="d-block text-center" style="font-size:16px;font-weight:bold">Comuna</div>
                            <div class="input-group">
                            
                              <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 

                                <select class="form-control input" id="editarComuna" name="editarComuna" required>
                                                                              
                                    <option value="">Seleccionar Comuna</option>
              
                                </select>

                            </div>
                      </div>

                      <!-- Input hidden para la comuna actual -->
                      <input type="hidden" id="comunaActual" value="<?php echo $cliente['comuna']; ?>">
     
                    <div class="col-xs-6">
                    <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold">Direccion</div>
                    <div class="input-group">
                    
                      <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 

                      <input type="text" class="form-control input" name="editarDireccion" id="editarDireccion" placeholder="Ingrese Direccion" required>

                    </div>
                    </div>
                    
                    <div class="col-xs-6">
                    <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold">Tipo Campaña</div>
                    <div class="input-group">
                    
                      <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                      <select class="form-control input" id="nuevoTipoCliente" name="nuevoTipoCliente" required>
                            
                        <option value="">Seleccionar Tipo Cliente</option>
                        <?php

                          $item = null;
                          $valor = null;

                          $tipoCliente = ControladorTipoClientes::ctrMostrarTipoClientes($item, $valor);

                          foreach ($tipoCliente as $key => $value) {
                            
                            echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                          }

                        ?>
                      </select>

                    </div>
                    </div>
                    <div class="col-xs-6">
                    <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold">Tipo Producto</div>
                    <div class="input-group">
                    
                      <span class="input-group-addon"><i class="fa fa-file"></i></span> 

                      <select class="form-control input" id="nuevoTipoProducto" name="nuevoTipoProducto" required>
                            
                            <option value="">Seleccionar Tipo Producto</option>
                            <?php
    
                              $item = null;
                              $valor = null;
    
                              $tipoProducto = ControladorTipoProductos::ctrMostrarTipoProductos($item, $valor);
    
                              foreach ($tipoProducto as $key => $value) {
                                
                                echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                              }
    
                            ?>
                          </select>

                    </div>
                    </div>
                    <div class="col-xs-6">
                    <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold">Lista de Precio Asignada</div>
                    <div class="input-group">
                    
                      <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                      <select class="form-control input" id="editarFactor" name="editarFactor" required>

                      <option value="">PRECIO LISTA - 0%</option>
                        <?php

                          $item = null;
                          $valor = null;

                          $listaPrecio = ControladorListas::ctrMostrarListas($item, $valor);

                          foreach ($listaPrecio as $key => $value) {
                            if($value["id"] != 1){
                            echo '<option value="'.$value["id"].'">'.$value["nombre_lista"].'- %'.$value["factor"].'</option>';}
                          }

                        ?>
                      </select>


                    </div>
                    </div>
                </div> 
              </div>  
            </div>
             <!-- ENTRADA PARA STOCK -->

            <h4 class="box-title" style="font-weight:bold;">Datos de Contacto</h4>      
            <div class="box box-warning">
              <div class="box-body">
                <div class="form-group row">
                  <!-- ENTRADA PARA EL EJECUTIVO-->
                  <div class="col-xs-4">
                        <div class="d-block" style="font-size:16px;font-weight:bold;">Ejecutivo</div>
                          <div class="input-group">
                          
                            <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                            <input type="text" class="form-control input" name="editarEjecutivo" id="editarEjecutivo" placeholder="Ingresar ejecutivo" required>

                          </div>
                      </div>
                  
                  <!-- ENTRADA PARA EL TELEFONO-->
                      <div class="col-xs-4">
                        <div class="d-block" style="font-size:16px;font-weight:bold">Numero de Telefono</div>
                          <div class="input-group">
                          
                            <span class="input-group-addon"><i class="fa fa-phone"></i></span> 

                            <input type="tel" class="form-control input" name="editarTelefono"
                                            id="editarTelefono"
                                            placeholder="Ingresar teléfono" required
                                            maxlength="12" pattern="^\+[0-9]{11}$"
                                            title="Ingrese el número de teléfono completo incluido el +"
                                            onfocus="validarTelefono(this)">
                          </div>
                      </div>
                      
                  <!-- ENTRADA PARA EL EMAIL-->
                      <div class="col-xs-4">
                        <div class="d-block" style="font-size:16px;font-weight:bold">Correo Electronico</div>
                          <div class="input-group">
                          
                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 

                            <input type="text" class="form-control input" name="editarEmail" placeholder="Ingresar email" required pattern="^[^@]+@[^@]+.[a-zA-Z]{2,}$" title="El email debe contener un arroba (@) y un punto (.) después del arroba">

                          </div>
                      </div>
                
                </div>
              </div>
            </div>
             <!-- ENTRADA PARA EL CÓDIGO -->

             <h4 class="box-title" style="font-weight:bold;">Datos de Credito y Cobranza</h4>
            <div class="box box-success">
              <div class="box-body">
                <div class="form-group row"> 
                  <div class="col-xs-4">
                      <div class="d-inline-block  text-center" style="font-size:16px;font-weight:bold">Plazo de Pago</div>
                          <div class="input-group">
                          
                            <span class="input-group-addon"><i class="fa fa-code"></i></span> 
                          
                            <select class="form-control input" id="editarPlazo" name="editarPlazo" required>
                            
                            <option value="">Seleccionar Plazo de Pago</option>

                            <?php

                            $item = null;
                            $valor = null;

                            $plazos = ControladorPlazos::ctrMostrarPlazos($item, $valor);

                            foreach ($plazos as $key => $value) {
                            echo '<option  value="'.$value["id"].'">'.$value["nombre"].' </option>';
                            }

                            ?>
            
                        </select>
                        
                      </div> 

                  </div>
                  <div class="col-xs-4">
                    <div class="d-inline-block  text-center" style="font-size:16px;font-weight:bold">Vendedor</div>
                    <div class="input-group">
                    
                      <span class="input-group-addon"><i class="fa fa-check"></i></span> 

                      <select class="form-control input" id="editarVendedor" name="editarVendedor" required>
                            
                        <option value="">Seleccionar Vendedor</option>
                        <?php

                          $item = null;
                          $valor = null;

                          $vendedor = ControladorPlantel::ctrMostrarPlantel($item, $valor);

                          foreach ($vendedor as $key => $value) {
                            
                            echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                          }

                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-xs-4">
                    <div class="d-inline-block  text-center" style="font-size:16px;font-weight:bold">Estado de Cliente en Sistema</div>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-check"></i></span> 

                      <select class="form-control input" id="nuevoEstado" name="nuevoEstado" required>
          
                      <option value="">Seleccionar Estado: </option>
                      <option value="activo">Activo </option>  
                      <option value="inactivo">Inactivo</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="form-group row">                 
                  <div class="col-xs-4">
                    <div class="d-block text-center" style="font-size:16px;font-weight:bold">Contacto Cobranza</div>
                      <div class="input-group">
                      
                        <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                        <input type="tel" class="form-control input" name="nuevoTelefonoCobranza" placeholder="Ingresar contacto" required>

                      </div>
                  </div>
                  <div class="col-xs-4 ">
                    <div class="d-block text-center" style="font-size:16px;font-weight:bold">Correo Electronico</div>
                      <div class="input-group">
                      
                        <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 

                        <input type="text" class="form-control input" name="editarEmail" placeholder="Ingresar email" required pattern="^[^@]+@[^@]+.[a-zA-Z]{2,}$" title="El email debe contener un arroba (@) y un punto (.) después del arroba">

                      </div>
                  </div>
                  <div class="col-xs-4">
                    <div class="d-block text-center" style="font-size:16px;font-weight:bold">Fono</div>
                      <div class="input-group">
                      
                        <span class="input-group-addon"><i class="fa fa-phone"></i></span> 

                        <input type="tel" class="form-control input" name="editarTelefono"
                                            id="editarTelefono"
                                            placeholder="Ingresar teléfono" required
                                            maxlength="12" pattern="^\+[0-9]{11}$"
                                            title="Ingrese el número de teléfono completo incluido el +"
                                            onfocus="validarTelefono(this)">
                      </div>
                  </div>
                
                </div>
                <div class="form-group row">                 
                  <div class="col-xs-3">
                    <div class="d-block text-center" style="font-size:16px;font-weight:bold;">Linea de Credito</div>
                      <div class="input-group">
                      
                        <span class="input-group-addon"><i class="fa fa-money"></i></span> 

                        <input type="number" class="form-control input" name="nuevaLinea" placeholder="Ingresar Linea de Credito" required>

                      </div>
                  </div>
                  <div class="col-xs-3">
                    <div class="d-block text-center" style="font-size:16px;font-weight:bold">Bloqueo para Credito</div>
                      <div class="input-group">
                      
                        <span class="input-group-addon"><i class="fa fa-bank"></i></span> 

                        <select class="form-control input" name="" id="">
                        <option value="No">No</option>
                        <option value="Si">Si</option>
                        </select>

                      </div>
                  </div>
                  <div class="col-xs-6">
                  <div class="d-block text-center" style="font-size:16px;font-weight:bold">Observacion de Cobranza</div>
                          <textarea style="border-width:1px;border-color:blue" class="form-control input" name="" id="" cols="6" rows="3"></textarea>
                  </div>
                  
                
                </div>              

                  
                 

                </div>
              </div> 
            </div>

            <div class="modal-footer">

              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

              <button type="submit" class="btn btn-primary text-center">Guardar Cliente</button>

            </div>
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

       

      </form>

        <?php

          $editarProducto = new ControladorClientes();
          $editarProducto -> ctrEditarCliente();

        ?>  

    </div>

  </div>

</div>

<?php

  $eliminarCliente = new ControladorClientes();
  $eliminarCliente -> ctrEliminarCliente();

?>

<script>
//FILTRADOR DE NUEVA COMUNA Y REGION 
document.getElementById('nuevaRegion').addEventListener('change', function() {
    var regionId = this.value; // Obtener el ID de la región seleccionada

    // Verifica que haya una región seleccionada
    if (regionId !== "") {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'controladores/procesar_comunas.php', true); // Ajusta la ruta aquí
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onload = function() {
            if (xhr.status === 200) {
                console.log('Respuesta del servidor: ', xhr.responseText); // Verifica la respuesta

                var comunas = JSON.parse(xhr.responseText); // Parsear la respuesta en JSON
                var comunaSelect = document.getElementById('nuevaComuna');
                comunaSelect.innerHTML = '<option value="">Seleccionar Comuna</option>'; // Limpiar las opciones previas

                // Rellenar las opciones del select de comunas
                comunas.forEach(function(comuna) {
                    var option = document.createElement('option');
                    option.value = comuna.id; // Asumiendo que 'id' es el campo correcto
                    option.textContent = comuna.nombre; // Asumiendo que 'nombre' es el campo correcto
                    comunaSelect.appendChild(option);
                });
            }
        };

        // Enviar el ID de la región seleccionada al servidor
        xhr.send('regionId=' + regionId);
    } else {
        // Si no hay región seleccionada, limpiar el select de comunas
        document.getElementById('nuevaComuna').innerHTML = '<option value="">Seleccionar Comuna</option>';
    }
});

//FILTRADOR DE EDITAR COMUNA Y REGION
document.getElementById('editarRegion').addEventListener('change', function() {
    var regionId = this.value;
    var comunaActual = document.getElementById('comunaActual').value; // Obtener la comuna actual

    if (regionId !== "") {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'controladores/procesar_comunas.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onload = function() {
            if (xhr.status === 200) {
                var comunas = JSON.parse(xhr.responseText);
                var comunaSelect = document.getElementById('editarComuna');
                comunaSelect.innerHTML = '<option value="">Seleccionar Comuna</option>';

                comunas.forEach(function(comuna) {
                    var option = document.createElement('option');
                    option.value = comuna.id;
                    option.textContent = comuna.nombre;
                    if (comuna.id == comunaActual) {
                        option.selected = true; // Seleccionar la comuna actual
                    }
                    comunaSelect.appendChild(option);
                });
            }
        };

        xhr.send('regionId=' + regionId);
    } else {
        document.getElementById('editarComuna').innerHTML = '<option value="">Seleccionar Comuna</option>';
    }
});
  </script>
