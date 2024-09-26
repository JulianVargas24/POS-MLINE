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
    
  <h1 style="color:green;font-weight:bold">
      
      BOLETA EXENTA
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Crear Venta con Boleta Exenta</li>
    
    </ol>

  </section>

    <section class="content">
        <div class="box">
            <div class="box-body">
                <form role="form" method="post" class="formularioFacturaExenta">
                <!--=====================================
                FECHAS Y TIPO DE DOCUMENTO
                    ======================================-->
                    
                    <div class="row">

                        
                        <div class="col-xs-4">
                            <div class="box box-info">
                                    <div class="box-body">
                                    <h4 class="box-title" style="font-weight:bold; font-size:20px;">Cliente Asociado</h4>
                                        <div class="row" style="margin-bottom:5px;">
                                            <div class="col-xs-12">
                                                    
                                                    <div class="form-group">
                                                        <div class="input-group" style="display:block;">                
                                                        <select class="form-control" id="nuevoClienteBoleta" name="nuevoClienteBoleta" required>

                                                            <option value="">Seleccionar Cliente</option>

                                                            <?php

                                                            $item = null;
                                                            $valor = null;

                                                            $clientes = ControladorClientes::ctrMostrarClientes($item, $valor);

                                                            foreach ($clientes as $key => $value) {

                                                                echo '<option value="'.$value["id"].'" idLista="'.$value["factor_lista"].'">'.$value["nombre"].' </option>';

                                                            }

                                                            ?>

                                                        </select>

                                                        </div>
                                                    </div> 
                                            </div>
                                        </div>
                                        <div class="row"> 
                                            <div class="col-xs-6">
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <input type="hidden" id="traerId">
                                                            <input type="hidden" id="traerFactor">
                                                            <span class="input-group-addon"> <i class="fa fa-address-card"></i> RUT</span>                
                                                            <input type="text" class="form-control" id="traerRut" value="" readonly >
                                                        </div>
                                                    </div> 
                                            </div>
                                            <div class="col-xs-6">                                                  
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                        <span class="input-group-addon">Direccion</span>                
                                                            <input type="text" class="form-control" id="traerDireccion" value="" readonly>
                                                        </div>
                                                    </div> 
                                            </div>
                                            <div class="col-xs-6">   
                                                    <div class="form-group">
                                                        <div class="input-group">   
                                                            <span class="input-group-addon">Actividad</span>             
                                                            <input type="text" class="form-control" id="traerActividad" value="" readonly>
                                                        </div>
                                                    </div> 
                                            </div>
                                            <div class="col-xs-6">                                  
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Ejecutivo</span>                
                                                            <input type="text" class="form-control" id="traerEjecutivo" value="" readonly>
                                                        </div>
                                                    </div> 
                                            </div>
                                            <div class="col-xs-6">                                                  
                                                    <div class="form-group">
                                                        <div class="input-group">                
                                                        <span class="input-group-addon">Telefono</span>
                                                            <input type="text" class="form-control" id="traerTelefono" value="" readonly>
                                                        </div>
                                                    </div> 
                                            </div>
                                            <div class="col-xs-6">
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                        <span class="input-group-addon"> <i class="fa fa-at"></i> Correo</span>                
                                                            <input type="text" class="form-control" id="traerEmail" value="" readonly>
                                                        </div>
                                                    </div> 
                                            </div>
                                            <div class="col-xs-6">
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                        <span class="input-group-addon">Lista Precio</span>                
                                                            <input type="text" class="form-control" id="traerLista" value="" readonly>
                                                        </div>
                                                    </div> 
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="col-xs-4">
                                        <div class="box box-info">
                                                <div class="box-body">
                                                    <h4 class="box-title" style="font-weight:bold; font-size:20px;">Datos de Emision</h4>
                                                        <div class="row" style="margin-bottom:5px;">
                                                        
                                                            <div class="col-xs-6">
                                                                <div class="d-block" style="font-size:14px;">Fecha Emision</div>
                                                                <div class="form-group">
                                                                    <div class="input-group">
                                                                        
                                                                        <input type="date" class="form-control input-sm" name="nuevaFechaEmision" id="nuevaFechaEmision" value="<?php echo date("Y-m-d");?>">
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="col-xs-6">
                                                                <div class="d-block" style="font-size:14px;">Fecha Venc.</div>
                                                                <div class="form-group">
                                                                    <div class="input-group">

                                                                        <input type="date" class="form-control input-sm" name="nuevaFechaVencimiento" id="nuevaFechaVencimiento">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="col-xs-6">
                                                                <div class="d-block" style="font-size:14px;">Unidad de Negocio</div>
                                                                <div class="form-group">
                                                                    <div class="input-group">
                                                                    <select class="form-control input" id="nuevoNegocio" name="nuevoNegocio" required>
                            
                                                                        <option value="">Seleccionar Unidades</option>

                                                                        <?php

                                                                        $item = null;
                                                                        $valor = null;

                                                                        $negocios = ControladorNegocios::ctrMostrarNegocios($item, $valor);

                                                                        foreach ($negocios as $key => $value) {
                                                                        echo '<option value="'.$value["id"].'">'.$value["unidad_negocio"].'</option>';
                                                                        }

                                                                        ?>
                                                        
                                                                    </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-6">
                                                                <div class="d-block" style="font-size:14px;">Bodega Origen</div>
                                                                <div class="form-group">
                                                                    <div class="input-group">
                                                                    <select class="form-control input" id="nuevaBodega" name="nuevaBodega" required>
                            
                                                                        <option value="">Seleccionar Bodega</option>

                                                                        <?php

                                                                        $item = null;
                                                                        $valor = null;

                                                                        $bodegas = ControladorBodegas::ctrMostrarBodegas($item, $valor);

                                                                        foreach ($bodegas as $key => $value) {
                                                                        echo '<option  value="'.$value["id"].'">'.$value["nombre"].' </option>';
                                                                        }

                                                                        ?>
                                                        
                                                                    </select>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-xs-6">
                                                                <div class="d-block" style="font-size:14px;">Vendedor Asociado</div>
                                                                <div class="form-group">
                                                                    <div class="input-group">
                                                                    <select class="form-control input-sm" id="nuevoVendedor" name="nuevoVendedor" required>
                            
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
                                                            </div>
                                                            <hr>
                                                            
                                                                
                                                        
                                                            
                                                </div>
                                                    
                                                </div>
                                        </div>
                        </div>
                        <div class="col-xs-4">
                           <div class="box box-info">
                                <div class="box-body">
                                                        <?php
                                                        $tabla = "venta_boleta_exenta";
                                                        $atributo= "boleta_exenta";
                                                        $folio = ModeloParametrosDocumentos::mdlMostrarFolio($tabla, $atributo);
                                                        ?>
                                        <h4 class="box-title" style="color:#39b616;font-weight:bold; font-size:21px; color:red" id="tipodte">BOLETA EXENTA</h4>
                                        <div class="row">
                                            <div class="col-xs-5">
                                                 <div class="form-group">
                                                        <div class="input-group">
                                                            <span class="input-group-addon" style   ="background-color:red; color:white; font-weight:bold">FOLIO</span>
                                                            <input type="text" style="font-weight:bold; font-size:16px;" class="form-control" name="nuevoCodigo" id="nuevoCodigo" value="<?php  echo $folio + 1;?>" readonly required>
                                                        </div>
                                                </div>
                                            </div> 
                                        </div>

                                </div>
                           </div>
                        </div>
                    </div>
                                                                    
                        
                    <div class="row">
        
                        <div class="col-lg-8 col-xs-12">
                            
                            <div class="box box-success">
                                <div class="box-body">

                                    <div class="row nuevoProducto">
                                        <h4 class="box-title text-center" style="font-weight:bold; font-size:20px;">Productos Seleccionados</h4>
                                        <div class="row" style="padding:5px 15px">
                                            <div class="col-xs-2 text-center" style="padding-right:0px">
                                                <h5 style="background-color:#3c8dbc; color:white; border-radius:5px; padding: 5px 0px;">Descripcion</h4>
                                            </div>
                                            <div class="col-xs-1 text-center" style="padding-right:0px">
                                                <h5 style="background-color:#3c8dbc; color:white; border-radius:5px; padding: 5px 0px;">Cantidad</h4>
                                            </div>
                                            <div class="col-xs-1 text-center" style="padding-right:0px">
                                                <h5 style="background-color:#3c8dbc; color:white; border-radius:5px; padding: 5px 0px;">Precio U</h4>
                                            </div>
                                            <div class="col-xs-1 text-center" style="padding-right:0px">
                                                <h5 style="background-color:#3c8dbc; color:white; border-radius:5px; padding: 5px 0px;">Subtotal</h4>
                                            </div>

                                            <div class="col-xs-1 text-center" style="padding-right:0px">
                                                <h5 style="background-color:#3c8dbc; color:white; border-radius:5px; padding: 5px 0px;">Descuento</h4>
                                            </div>

                                            <div class="col-xs-2 text-center" style="padding-right:12px">
                                                <h5 style="background-color:#3c8dbc; color:white; border-radius:5px; padding: 5px 0px;">Total Final</h4>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="box box-info">
                                        <div class="box-body">
                                                <h4 class="box-title" style="font-weight:bold; font-size:20px;">Totales</h4>
                                            
                                                <div class="row">

                                                            <div class="col-xs-7">
                                                                    <div class="form-group">
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon" style="padding:0px 2px">Subtotal</span>                
                                                                            <input style="font-size:16px;" type="text" class="form-control"  id="nuevoSubtotal" total="" name="nuevoSubtotal" value="" readonly>
                                                                        </div>
                                                                    </div> 
                                                            </div>

                                                            <div class="col-xs-7">
                                                                    <div class="form-group">
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon" style="padding:0px 2px">Descuento</span>                
                                                                            <input style="font-size:16px;" type="text" class="form-control"  id="nuevoTotalDescuento" total="" name="nuevoTotalDescuento" value="" readonly>
                                                                        </div>
                                                                    </div> 
                                                            </div>
                                                           
                                                            <div class="col-xs-7">
                                                                    
                                                                    <div class="form-group">
                                                                        <div class="input-group">
                                                                        <span class="input-group-addon" style="color:black; font-weight:bold; padding:0px 15px">Total</span>                
                                                                        <input style="font-size:16px;" type="number" class="form-control input" id="nuevoTotalFinal" name="nuevoTotalFinal" total="" readonly required>
                                                                        
                                                                        </div>
                                                                        
                                                                    </div> 
                                                            </div>
                                            </div>
                                        </div>
                                    </div>      
                                </div>
                                <div class="col-xs-6">       
                                    <div class="box box-danger">
                                                <div class="box-body">
                                                <h4 class="box-title" style="font-weight:bold; font-size:20px;">Condición de Pago</h4>
                                                    <div class="row">
                                                        <div class="col-xs-12">
                                                            
                                                                <div class="form-group">
                                                                    
                                                                </div> 
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-xs-6">
                                                                <div class="d-block bg-primary text-center" style="background-color:#3c8dbc;font-size:15px;">Plazo de Pago</div>
                                                                <div class="form-group">
                                                                    <div class="input-group" style="display:block;">                                                
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
                                                        </div>
                                                        <div class="col-xs-6">
                                                                <div class="d-block bg-primary text-center" style="background-color:#3c8dbc;font-size:15px;">Medios de Pago</div>
                                                                <div class="form-group">
                                                                <div class="input-group" style="display:block;">                
                                                                <select name="nuevoMedioPago" id="nuevoMedioPago" class="form-control">
                                                                            <option value="">Seleccione:</option>
                                                                            <?php

                                                                            $item = null;
                                                                            $valor = null;

                                                                            $medios = ControladorMediosPago::ctrMostrarMedios($item, $valor);

                                                                            foreach ($medios as $key => $value) {
                                                                            echo '<option  value="'.$value["id"].'">'.$value["medio_pago"].' </option>';
                                                                            }

                                                                            ?>
                                                                            
                                                                        </select>
                                                                    </div>
                                                                </div> 
                                                        </div>
                                                        <div class="col-xs-6">
                                                                <div class="d-block bg-primary text-center" style="background-color:#3c8dbc;font-size:15px; margin-top:5px;">Total a Pagar</div>
                                                                <div class="form-group">
                                                                    <div class="input-group" style="display:block;">                                                
                                                                            <input class="form-control input" type="text" name="nuevoTotalPagar" id="nuevoTotalPagar" value="0" total="" readonly>
                                                                        
                                                                    </div> 
                                                                </div> 
                                                        </div>
                                                        <div class="col-xs-6">
                                                                <div class="d-block bg-primary text-center" style="background-color:#3c8dbc;font-size:15px; margin-top:5px;">Pagado</div>
                                                                <div class="form-group">
                                                                    <div class="input-group" style="display:block;">                                                
                                                                            <input class="form-control input" type="number" name="nuevoTotalPagado" id="nuevoTotalPagado" value="0" total="">
                                                                        
                                                                    </div> 
                                                                </div> 
                                                        </div>
                                                        <div class="col-xs-6">
                                                                <div class="d-block bg-primary text-center" style="background-color:#3c8dbc;font-size:15px; margin-top:5px;">Pendiente</div>
                                                                <div class="form-group">
                                                                    <div class="input-group" style="display:block;">                                                
                                                                            <input class="form-control input" type="text" name="nuevoTotalPendiente" id="nuevoTotalPendiente" value="0" total="" readonly>
                                                                        
                                                                    </div> 
                                                                </div> 
                                                        </div>
                                                    
                                                    </div>
                                                </div>
                                    </div>
                                    <div class="box box-warning">
                                        <div class="box-body">
                                        <h4 class="box-title" style="font-weight:bold; font-size:20px;">Observaciones</h4>                       
                                        <textarea name="nuevaObservacion" id="nuevaObservacion" cols="60" rows="6"></textarea>
                                        <input type="text" name="listaProductos" id="listaProductos">
                                        </div>
                                    </div>
                                </div>     
                            </div>        
                            
                            
                        </div>

                    
                    
                        <div class="col-lg-4 col-xs-12 ">
                                
                                            <div class="box box-success">
                                                <div class="box-header with-border"></div>
                                                    <div class="box-body">
                                                        <h4 class="box-title text-center" style="font-weight:bold; font-size:20px;"> Productos para Seleccionar</h4>
                                                        <table  class="table table-bordered table-striped dt-responsive tablaVentaBoletaExenta">
                                                    
                                                        
                                                            <thead>

                                                                <tr>
                                                                <th style="width: 10px">#</th>
                                                                <th>Imagen</th>
                                                                <th>Código</th>
                                                                <th>Nombre</th>
                                                                <th>Acciones</th>
                                                                </tr>

                                                            </thead>

                                                        </table>

                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                    </div>
                                        
                                    
                    <a href="ventas">                 
                        <button type="button" class="btn btn-default">Salir</button>
                    </a>
                    <button type="submit" class="btn btn-primary">Guardar Venta</button>                 
                </form>
                                    <?php

                                        $agregarVentaExenta = new ControladorVentaBoleta();
                                        echo $agregarVentaExenta -> ctrCrearVentaBoletaExenta();

                                    ?>
            </div>
        </div>
    </section>

</div>


<style>
  .error{
    color: red;
    
  }
  textarea {
  resize: none;
}
input[type=number] {
  -moz-appearance: textfield;
}

</style>
