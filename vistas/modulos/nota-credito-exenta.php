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
      
      NOTA DE CRÉDITO EXENTA
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Crear Nota de Crédito Exenta</li>
    
    </ol>

  </section>

    <section class="content">
        <div class="box">
            <div class="box-body">
                <form role="form" method="post" class="formularioCotizacion">
                <?php

                        $item = "id";
                        $valor = $_GET["idVenta"];

                        $venta = ControladorVentas::ctrMostrarVentasExentas($item, $valor);

                        $itemCliente = "id";
                        $valorCliente = $venta["id_cliente"];
                        $cliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

                        $itemUnidad = "id";
                        $valorUnidad = $venta["id_unidad_negocio"];
                        $unidad = ControladorNegocios::ctrMostrarNegocios($itemUnidad, $valorUnidad);

                        $itemBodega = "id";
                        $valorBodega = $venta["id_bodega"];
                        $bodega = ControladorBodegas::ctrMostrarBodegas($itemBodega, $valorBodega);

                        $itemPlazo = "id";
                        $valorPlazo = $venta["id_plazo_pago"];
                        $plazo = ControladorPlazos::ctrMostrarPlazos($itemPlazo, $valorPlazo);

                        $itemMedio = "id";
                        $valorMedio = $venta["id_medio_pago"];
                        $medio = ControladorMediosPago::ctrMostrarMedios($itemMedio, $valorMedio);


                       // $porcentajeImpuesto =  $venta["impuesto"] * 100 / $venta["neto"];


                    ?>
                <!--=====================================
                FECHAS Y TIPO DE DOCUMENTO
                    ======================================-->
                    
                    <div class="row">
                        <div class="col-xs-5">
                            <div class="box box-info">
                                    <div class="box-body">
                                    <h4 class="box-title" style="font-weight:bold; font-size:20px;">Cliente Asociado</h4>
                                        <div class="row" style="margin-bottom:5px;">
                                            <div class="col-xs-12">
                                                    
                                                    <div class="form-group">
                                                        <div class="input-group" style="display:block;">
                                                        <input type="hidden" name="idCotizacion" id="idCotizacion" value="<?php echo $venta["id"];?>">                
                                                        <select class="form-control" id="nuevoClienteCotizacion" name="nuevoClienteCotizacion" required readonly>
                                                            <option selected idLista="<?php echo $cliente["factor_lista"]?>" value="<?php echo $cliente["id"];?>"><?php echo $cliente["nombre"];?></option>
                                                            <optgroup label="---Cambiar Cliente--"></optgroup>

                                                            <?php

                                                            $item = null;
                                                            $valor = null;

                                                            $clientes = ControladorClientes::ctrMostrarClientes($item, $valor);

                                                            foreach ($clientes as $key => $value) {

                                                                echo '<option disabled class="seleccionarCliente" value="'.$value["id"].'">'.$value["nombre"].' </option>';

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
                                                            <input type="text" class="form-control" id="traerRutEditar" value="" readonly >
                                                        </div>
                                                    </div> 
                                            </div>
                                            <div class="col-xs-6">                                                  
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                        <span class="input-group-addon">Dirección</span>
                                                            <input type="text" class="form-control" id="traerDireccionEditar" value="" readonly>
                                                        </div>
                                                    </div> 
                                            </div>
                                            <div class="col-xs-6">   
                                                    <div class="form-group">
                                                        <div class="input-group">   
                                                            <span class="input-group-addon">Actividad</span>             
                                                            <input type="text" class="form-control" id="traerActividadEditar" value="" readonly>
                                                        </div>
                                                    </div> 
                                            </div>
                                            <div class="col-xs-6">                                  
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Ejecutivo</span>                
                                                            <input type="text" class="form-control" id="traerEjecutivoEditar" value="" readonly>
                                                        </div>
                                                    </div> 
                                            </div>
                                            <div class="col-xs-6">                                                  
                                                    <div class="form-group">
                                                        <div class="input-group">                
                                                        <span class="input-group-addon">Teléfono</span>
                                                            <input type="text" class="form-control" id="traerTelefonoEditar" value="" readonly>
                                                        </div>
                                                    </div> 
                                            </div>
                                            <div class="col-xs-6">
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                        <span class="input-group-addon"> <i class="fa fa-at"></i> Correo</span>                
                                                            <input type="text" class="form-control" id="traerEmailEditar" value="" readonly>
                                                        </div>
                                                    </div> 
                                            </div>
                                            <div class="col-xs-6">
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                        <span class="input-group-addon">Lista Precio</span>                
                                                            <input type="text" class="form-control" id="traerListaEditar" value="" readonly>
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
                                        <h4 class="box-title" style="font-weight:bold; font-size:20px;">Datos de Nota de Crédito</h4>
                                            <div class="row" style="margin-bottom:5px;">
                                                <div class="col-xs-6">
                                                <div class="d-block" style="font-size:14px;">Fecha Emisión</div>
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            
                                                            <input type="date" class="form-control input-sm" name="nuevaFechaEmision" id="nuevaFechaEmision" value="<?php echo $venta["fecha_emision"];?>">
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="col-xs-6">
                                                <div class="d-block" style="font-size:14px;">Fecha Venc.</div>
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <input type="hidden" id="nuevoEstado" name="nuevoEstado" value="Abierta">
                                                            <input type="date" class="form-control input-sm" name="nuevaFechaVencimiento" id="nuevaFechaVencimiento" value="<?php echo $venta["fecha_vencimiento"];?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-xs-6">
                                                <div class="d-block" style="font-size:14px;">Unidad de Negocio</div>
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                        <select class="form-control input" id="nuevoNegocio" name="nuevoNegocio" readonly required>
                                                        <option selected value="<?php echo $unidad["id"];?>"><?php echo $unidad["unidad_negocio"];?></option>
                                                        <optgroup label="---Cambiar Unidad de Negocio--"></optgroup>

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
                                                <div class="d-block" style="font-size:14px;">Bodega Destino</div>
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                        <select class="form-control input" id="nuevaBodega" name="nuevaBodega" readonly required>
                                                        <option selected value="<?php echo $bodega["id"];?>"><?php echo $bodega["nombre"];?></option>
                                                        <optgroup label="---Cambiar Bodega--"></optgroup>


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
                                                
                                                           
                                                
                                            </div>
                                        
                                    </div>
                            </div>
                        </div>
                        
                        <div class="col-xs-3">
                           <div class="box box-info">
                                <div class="box-body">
                                                            
                                        <?php
                                        $tabla = "nota_credito";
                                        $atributo= "nota_credito";
                                        $folio = ModeloParametrosDocumentos::mdlMostrarFolio($tabla, $atributo);
                                        ?>
                                         <h4 class="box-title" style="color:#39b616;font-weight:bold; font-size:21px; color:green;">NOTA DE CRÉDITO EXENTA</h4>
                                        <div class="row" style="margin-top:2px;">
                                            <div class="col-xs-7">
                                                 <div class="form-group">
                                                        <div class="input-group">
                                                        <span class="input-group-addon" style="background-color:green; color:white; font-weight:bold">FOLIO</span>
                                                            <input type="text" style="font-weight:bold; font-size:16px;" class="form-control" name="nuevoCodigo" id="nuevoCodigo" value="<?php echo $folio+1 ?>" readonly required>
                                                        </div>
                                                       
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <h4 class="box-title" style="color:#39b616;font-weight:bold; font-size:21px; color:red;"> FACTURA EXENTA</h4>
                                        <div class="row" style="margin-top:2px;">
                                            <div class="col-xs-7">
                                                 <div class="form-group">
                                                        <div class="input-group">
                                                        <span class="input-group-addon" style="background-color:red; color:white; font-weight:bold">FOLIO</span>
                                                            <input type="text" style="font-weight:bold; font-size:16px;" class="form-control" name="codigoFactura" id="codigoFactura" value="<?php echo $venta["codigo"]; ?>" readonly required>
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
                                                <h5 style="background-color:#3c8dbc; color:white; border-radius:5px; padding: 5px 0px;">Descripción</h5>
                                            </div>
                                            <div class="col-xs-1 text-center" style="padding-right:0px">
                                                <h5 style="background-color:#3c8dbc; color:white; border-radius:5px; padding: 5px 0px;">Cantidad</h5>
                                            </div>
                                            <div class="col-xs-1 text-center" style="padding-right:0px">
                                                <h5 style="background-color:#3c8dbc; color:white; border-radius:5px; padding: 5px 0px;">Precio U</h5>
                                            </div>
                                            <div class="col-xs-1 text-center" style="padding-right:0px">
                                                <h5 style="background-color:#3c8dbc; color:white; border-radius:5px; padding: 5px 0px;">Subtotal</h5>
                                            </div>

                                            <div class="col-xs-1 text-center" style="padding-right:0px">
                                                <h5 style="background-color:#3c8dbc; color:white; border-radius:5px; padding: 5px 0px;">Descuento</h5>
                                            </div>
                                            <div class="col-xs-2 text-center" style="padding-right:0px">
                                                <h5 style="background-color:#3c8dbc; color:white; border-radius:5px; padding: 5px 0px;">Total Exento</h5>
                                            </div>
                                            <div class="col-xs-1 text-center" style="padding-right:0px">
                                                <h5 style="background-color:#3c8dbc; color:white; border-radius:5px; padding: 5px 0px;">IVA</h5>
                                            </div>
                                            <div class="col-xs-1 text-center" style="padding-right:0px">
                                                <h5 style="background-color:#3c8dbc; color:white; border-radius:5px; padding: 5px 0px;">Otros Imp.</h5>
                                            </div>
                                            <div class="col-xs-2 text-center" style="padding-right:12px">
                                                <h5 style="background-color:#3c8dbc; color:white; border-radius:5px; padding: 5px 0px;">Total Final</h5>
                                            </div>
                                            
                                        </div>

                                        <?php

                                                $listaProducto = json_decode($venta["productos"], true);

                                                foreach ($listaProducto as $key => $value) {
                                                        $subtotal = $value["precio"] * $value["cantidad"];
                                                        $neto = $subtotal - $value["descuento"];
                                                echo'
                                                <div class="row" style="padding:5px 15px">
                                                <!-- Descripción del producto -->
                                            <div class="col-xs-2" style="padding-right:0px">
                                                <div class="input-group">
                                                <span class="input-group-addon">
                                                    <button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto="'.$value["id"].'"><i class="fa fa-times"></i></button>
                                                </span>
                                                    <input type="text" class="form-control nuevaDescripcionProducto" idProducto="'.$value["id"].'" name="agregarProducto" value="'.$value["descripcion"].'" readonly required>
                                                </div>
                                            </div>
                                                <!-- Cantidad del producto -->
                                            <div class="col-xs-1 cantidadProducto" style="padding-right:0px">
                                                <input type="text" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="'.$value["cantidad"].'" readonly  required>
                                            </div>
                                                <!-- Precio Unitario -->
                                            <div class="col-xs-1 precioUnitario" style="padding-right:0px">
                                            <input type="text"  class="form-control nuevoPrecioUnitario" style="padding:5px; padding-left:0px"  name="nuevoPrecioUnitario" value="'.$value["precio"].'" readonly required>
                                            </div>
                                                <!-- Subtotal Neto -->
                                            <div class="col-xs-1 subtotalProducto" style="padding-right:0px">
                                                <input type="text" class="form-control nuevoSubtotalProducto" style="padding:5px" name="nuevoSubtotalProducto" min="0" value="'.$subtotal.'"  readonly required>
                                            </div>
                                                <!-- Descuento -->
                                            <div class="col-xs-1 descuentoProducto" style="padding-right:0px">
                                                <input type="text" class="form-control nuevoDescuentoProducto" style="padding:5px" name="nuevoDescuentoProducto" min="0" value="'.$value["descuento"].'" readonly  required>
                                            </div>
                                                <!-- Precio Total Neto del producto -->
                                            <div class="col-xs-2 ingresoPrecio" style="padding-right:0px">
                                                <input   type="text" class="form-control nuevoPrecioProducto" onchange="cambios()" precioReal="'.$value["precio"].'" name="nuevoPrecioProducto" value="'.$neto.'" readonly required>
                                            </div>
                                                <!-- IVA del producto -->
                                            <div class="col-xs-1 ivaProducto" style="padding-right:0px">
                                                <input type="text" class="form-control nuevoIvaProducto" style="padding:5px" name="nuevoIvaProducto" min="0" value="'.$value["iva"].'"  readonly required>
                                            </div>
                                                <!-- OTROS IMPUESTOS del producto -->
                                            <div class="col-xs-1 " style="padding-right:0px">
                                                <input type="text" class="form-control nuevoOtrosImpuestosProducto" style="padding:5px" name="nuevoOtrosImpuestosProducto" min="0" value="0" readonly  required>
                                            </div>
                                            <div class="col-xs-2 totalProducto" style="padding-right:0px">
                                                <input type="text" class="form-control nuevoTotalProducto" name="nuevoTotalProducto" min="0" value="'.$value["total"].'" readonly required>
                                            </div>
                                            </div>';
                                                    
                                                    
                                            }

                                        ?>

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
                                                                            <span class="input-group-addon" style="padding:0px 8px">Subtotal</span>                
                                                                            <input style="font-size:16px;" type="text" class="form-control" id="nuevoSubtotal" total="" name="nuevoSubtotal" value="" readonly>
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
                                                                            <span class="input-group-addon" style="padding:0px 3px">Total Neto</span>               
                                                                            <input style="font-size:16px;" type="text" class="form-control" value="0"  readonly>
                                                                        </div>
                                                                    </div> 
                                                            </div>
                                                            <div class="col-xs-7">
                                                                    <div class="form-group">
                                                                        <div class="input-group">                
                                                                            <span class="input-group-addon">Exento</span>
                                                                            <input style="font-size:18px;" type="text" class="form-control" id="nuevoTotalNeto" name="nuevoTotalNeto" total="" value="" readonly>
                                                                        </div>
                                                                    </div> 
                                                            </div>
                                                            
                                                            <div class="col-xs-7">
                                                                   
                                                                    <div class="form-group">
                                                                        <div class="input-group" >
                                                                            <span class="input-group-addon" style="padding:0px 15px">% IVA</span>                
                                                                            <input style="font-size:16px;" type="text" class="form-control" id="nuevoTotalIva" name="nuevoTotalIva" total="" value="" readonly>
                                                                        </div>
                                                                    </div> 
                                                            </div>
                                                            <div class="col-xs-7">
                                                                    <div class="form-group">
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon" style="padding:0px">Otros Imp.</span>                
                                                                            <input style="font-size:18px;" type="text" class="form-control" value="0" readonly>
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
                                                                            <select class="form-control input" id="nuevoPlazoPago" name="nuevoPlazoPago" required>
                                                                                <option selected value="<?php echo $plazo["id"];?>"><?php echo $plazo["nombre"];?></option>
                                                                                <optgroup label="---Cambiar Plazo de Pago--"></optgroup>

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
                                                                                <option selected value="<?php echo $medio["id"];?>"><?php echo $medio["medio_pago"];?></option>
                                                                                <optgroup label="---Cambiar Medio de Pago--"></optgroup>
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
                                                    
                                                    </div>
                                                </div>
                                    </div>
                                    <div class="box box-warning">
                                        <div class="box-body">
                                        <h4 class="box-title" style="font-weight:bold; font-size:20px;">Observaciones</h4>                       
                                        <textarea name="nuevaObservacion" id="nuevaObservacion" cols="60" rows="6"><?php echo $venta["observacion"]; ?></textarea>
                                        <input type="hidden" id="listaProductos" name="listaProductos"> 
                                        </div>
                                    </div>
                                </div>     
                            </div>        
                            
                            
                        </div>
                        <div class="col-lg-5"> <a href="ventas">                 
                        <button type="button" class="btn btn-default">Salir</button>
                    </a>
                    <button type="submit" class="btn btn-primary">Guardar Nota Exenta</button>     
                        </div>     
                </form>
                                    <?php

$agregarNotaCredito = new ControladorNotaCredito();
$agregarNotaCredito -> ctrCrearNotaCreditoExenta();

                                    ?>
            </div>
        </div>
    </section>

</div>

<!--=====================================
MODAL VER COTIZACIONES
======================================-->





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
