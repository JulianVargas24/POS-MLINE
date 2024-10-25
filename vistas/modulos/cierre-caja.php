<?php
$fechaCierre = $_GET["fechaCierre"];
//SUMA DOCUMENTOS
$facturasAfectas = count(ModeloVentas::mdlSumaDocumentosVentas("venta_afecta", $fechaCierre));
$facturasExentas = count(ModeloVentas::mdlSumaDocumentosVentas("venta_exenta", $fechaCierre));
$boletasAfectas = count(ModeloVentas::mdlSumaDocumentosVentas("venta_boleta", $fechaCierre));
$boletasExentas = count(ModeloVentas::mdlSumaDocumentosVentas("venta_boleta_exenta", $fechaCierre));
$sumaDocumentos = $facturasAfectas + $facturasExentas + $boletasExentas + $boletasAfectas;
//SUMA CONTADO
$contadoFA = ModeloVentas::mdlSumaContadoVentas("venta_afecta", $fechaCierre);
$contadoFE = ModeloVentas::mdlSumaContadoVentas("venta_exenta", $fechaCierre);
$contadoBA = ModeloVentas::mdlSumaContadoVentas("venta_boleta", $fechaCierre);
$contadoBE = ModeloVentas::mdlSumaContadoVentas("venta_boleta_exenta", $fechaCierre);
$sumaContado =  $contadoFA + $contadoFE + $contadoBA + $contadoBE;
//SUMA CREDITO
$creditoFA = ModeloVentas::mdlSumaPendienteVentas("venta_afecta", $fechaCierre);
$creditoFE = ModeloVentas::mdlSumaPendienteVentas("venta_exenta", $fechaCierre);
$creditoBA = ModeloVentas::mdlSumaPendienteVentas("venta_boleta", $fechaCierre);
$creditoBE = ModeloVentas::mdlSumaPendienteVentas("venta_boleta_exenta", $fechaCierre);
$sumaPendiente =  $creditoFA + $creditoFE + $creditoBA + $creditoBE;

$sumaTotalFA= $contadoFA + $creditoFA;
$sumaTotalFE= $contadoFE + $creditoFE;
$sumaTotalBA= $contadoBA + $creditoBA;
$sumaTotalBE= $contadoBE + $creditoBE;
$sumaTotalFinal = $sumaTotalFA + $sumaTotalFE + $sumaTotalBA + $sumaTotalBE;



?>
<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Cierre de Caja <?php if (!empty($fechaCierre)) { echo 'al ' . $fechaCierre; } ?>
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Cierre de Caja</li>
    <button class="btnGenerarCierre"> 1</button>
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
</a>
      </div>

      <div class="box-body">
                                  <form role="form" method="post">
                                  <div class="row">
                                        
                                        <div class="col-lg-2">
                                            <div class="d-block" style="font-size:14px;">Fecha:</div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    
                                                  <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 

                                                    <input class="form-control" type="date" name="fechaCierre" id="fechaCierre">
                                                </div>
                                            </div>

                                        </div>


                                        <div class="col-lg-2">
                                            <input class="btn btn-primary btnGenerarCierre" style="margin-top:20px;" value="CONSULTAR" readonly/>
                                                
                                        </div>
                                        
                                        
                                  </div>
                                  </form>


                                  <div class="modal-dialog modal-lg">
                                  <div class="row">
                                  <div class="modal-content">

                                    <form role="form" method="post" id="form_nuevo_producto" enctype="multipart/form-data">

                                      <!--=====================================
                                      CABEZA DEL MODAL
                                      ======================================-->

                                      <div class="modal-header" style="background:#3f668d; color:white">

                                        <button type="button" class="close" data-dismiss="modal">&times;</button>

                                        <h4 class="modal-title">DETALLE CIERRE DE CAJA</h4>

                                      </div>

                                      <!--=====================================
                                      CUERPO DEL MODAL
                                      ======================================-->

                                      <div class="modal-body">

                                        <div class="box-body">


                                          <!-- ENTRADA PARA SELECCIONAR CATEGORÍA -->

                                          

                                          <!-- ENTRADA PARA LA DESCRIPCIÓN -->
                                          <div class="box box-info">
                                            <div class="box-body">
                                              <div class="form-group row">              
                                                <div class="col-xs-6">
                                                  <div class="d-inline-block  text-center" style="font-size:16px;font-weight:bold">Encargado</div> 
                                                    <div class="input-group">
                                                    
                                                      <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                                                      <input type="text" class="form-control input" name="nuevaDescripcion" placeholder="Nombre de Encargado" readonly>

                                                    </div>
                                                </div>
                                                
                                              </div>  
                                              
                                            </div>  
                                          </div>
                                          <!-- ENTRADA PARA STOCK -->
                                          
                                                  <div class="box box-success">
                                                          <div class="box-title">
                                                              <h4 style="font-weight:bold">VENTAS DEL DIA</h4>
                                                          </div>
                                                          <div class="box-body">
                                                              <div class="form-group row">
                                                                  <div class="col-xs-12">
                                                                  <table class="table table-bordered table-striped dt-responsive" width="50%">
                                                                      <tr>
                                                                      <th>#</th>
                                                                      <th>Factura Afecta</th>
                                                                      <th>Factura Exenta</th>
                                                                      <th>Boleta Afecta</th>
                                                                      <th>Boleta Exenta</th>
                                                                      <th>Totales</th>
                                                                      </tr>
                                                                      <tr>
                                                                      <td style="font-weight:bold;font-size:16px;">Cantidad</td>
                                                                      <td> <?php echo $facturasAfectas ?></td>
                                                                      <td><?php echo $facturasExentas ?></td>
                                                                      <td><?php echo $boletasAfectas ?></td>
                                                                      <td><?php echo $boletasExentas ?></td>
                                                                      <td><?php echo $sumaDocumentos ?></td>
                                                                      </tr>
                                                                      <tr>
                                                                      <td style="font-weight:bold;font-size:16px;">Contado</td>
                                                                      <td>$ <?php echo number_format($contadoFA, 0) ?></td>
                                                                      <td>$ <?php echo number_format($contadoFE, 0) ?></td>
                                                                      <td>$ <?php echo number_format($contadoBA, 0) ?></td>
                                                                      <td>$ <?php echo number_format($contadoBE, 0) ?></td>
                                                                      <td>$ <?php echo number_format($sumaContado, 0) ?></td>
                                                                      </tr>
                                                                      <tr>
                                                                      <td style="font-weight:bold;font-size:16px;">Credito</td>
                                                                      <td>$ <?php echo number_format($creditoFA, 0) ?></td>
                                                                      <td>$ <?php echo number_format($creditoFE, 0) ?></td>
                                                                      <td>$ <?php echo number_format($creditoBA, 0) ?></td>
                                                                      <td>$ <?php echo number_format($creditoBE, 0) ?></td>
                                                                      <td>$ <?php echo number_format($sumaPendiente, 0) ?></td>
                                                                      </tr>
                                                                      <tr>
                                                                      <td style="font-weight:bold;font-size:16px;">Total Ventas</td>
                                                                      <td>$ <?php echo number_format($sumaTotalFA, 0) ?></td>
                                                                      <td>$ <?php echo number_format($sumaTotalFE, 0) ?></td>
                                                                      <td>$ <?php echo number_format($sumaTotalBA, 0) ?></td>
                                                                      <td>$ <?php echo number_format($sumaTotalBE, 0) ?></td>
                                                                      <td>$ <?php echo number_format($sumaTotalFinal, 0) ?></td>
                                                                      </tr>
                                                                  </table>
                                                                  </div>


                                                              </div>
                                                          
                                                          </div>
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
                                  

       <input type="hidden" value="<?php echo $_SESSION['perfil']; ?>" id="perfilOculto">

      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL VER DETALLE PRODUCTO
======================================-->
<style>
  .error{
    color: red;
  }
</style>
<div id="modalVerDetalle" class="modal fade"  role="dialog">
  
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form role="form" method="post" id="form_nuevo_producto" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3f668d; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">DETALLE CIERRE DE CAJA</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">


            <!-- ENTRADA PARA SELECCIONAR CATEGORÍA -->

            

            <!-- ENTRADA PARA LA DESCRIPCIÓN -->
            <div class="box box-info">
              <div class="box-body">
                <div class="form-group row">              
                  <div class="col-xs-4">
                    <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold">Producto</div>
                    <div class="input-group">
                    
                      <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span> 

                      <input type="text" class="form-control input" name="nuevaDescripcion" placeholder="Nombre Producto" required>

                    </div>
                  </div>
                  <div class="col-xs-4">
                    <div class="d-inline-block  text-center" style="font-size:16px;font-weight:bold">Bodega</div> 
                      <div class="input-group">
                      
                        <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                        <input type="text" class="form-control input" name="nuevaDescripcion" placeholder="Nombre Producto" required>

                      </div>
                  </div>
                  <div class="col-xs-4">
                    <div class="d-inline-block  text-center" style="font-size:16px;font-weight:bold">Fecha</div> 
                      <div class="input-group">
                      
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 

                        <input type="date" class="form-control input" value="<?php echo date("Y-m-d"); ?>">

                      </div>
                  </div>
                </div>  
                
              </div>  
            </div>
             <!-- ENTRADA PARA STOCK -->
             
             <!-- ENTRADA PARA EL CÓDIGO -->
              <div class="form-group row">
                <div class="box-title">
                <div class="col-xs-4">
                    <div class="d-inline-block text-left" style="font-size:28px; font-weight:bold;">VENTAS DEL DIA</div>
                    </div>
                    <div class="col-xs-3 col-xs-offset-5">
                    <div class="d-inline-block text-center" style="font-size:22px;">${valor-inicial}</div> 
                    </div>
                </div>
              </div>
            <div class="box box-success">
                            <div class="box-title">
                            <h4 style="font-weight:bold">ENTRADAS</h4></div>
              <div class="box-body">
                <div class="form-group row"> 
                    <div class="col-xs-4">
                    <div class="d-inline-block text-left" style="font-size:22px;">Compras</div>
                    </div>
                    <div class="col-xs-2 col-xs-offset-6">
                    <div class="d-inline-block text-center" style="font-size:22px;">${cantidad}</div> 
                    </div>
                    <div class="col-xs-4">
                    <div class="d-inline-block text-left" style="font-size:22px;">Nota de Credito</div>
                    </div>
                    <div class="col-xs-2 col-xs-offset-6">
                    <div class="d-inline-block text-center" style="font-size:22px;">${cantidad}</div> 
                    </div>
                    <div class="col-xs-4">
                    <div class="d-inline-block text-left" style="font-size:22px;">Bodega a Bodega</div>
                    </div>
                    <div class="col-xs-2 col-xs-offset-6">
                    <div class="d-inline-block text-center" style="font-size:22px;">${cantidad}</div> 
                    </div>
                    <div class="col-xs-4">
                    <div class="d-inline-block text-left" style="font-size:22px;">Ingreso Manual a Bodega</div>
                    </div>
                    <div class="col-xs-2 col-xs-offset-6">
                    <div class="d-inline-block text-center" style="font-size:22px;">${cantidad}</div> 
                    </div>
                    <div class="col-xs-4">
                    <div class="d-inline-block text-left" style="font-size:22px;">OT a Bodega</div>
                    </div>
                    <div class="col-xs-2 col-xs-offset-6">
                    <div class="d-inline-block text-center" style="font-size:22px;">${cantidad}</div> 
                    </div>
                    <div class="col-xs-4">
                    <div class="d-inline-block text-left" style="font-size:22px;">Ajuste de Inventario</div>
                    </div>
                    <div class="col-xs-2 col-xs-offset-6">
                    <div class="d-inline-block text-center" style="font-size:22px;">${cantidad}</div> 
                    </div>
                    </hr>
                    <div class="col-xs-4 col-xs-offset-4">
                    <div class="d-inline-block text-left" style="font-size:22px; font-weight:bold">Total Entradas</div>
                    </div>
                    <div class="col-xs-3 col-xs-offset-1">
                    <div class="d-inline-block text-right" style="font-size:20px;">${Total_Entradas}</div>
                    </div>

                            

                </div>
              </div> 
            </div>
            <div class="box box-warning">
                            <div class="box-title">
                            <h4 style="font-weight:bold">SALIDAS</h4></div>
              <div class="box-body">
                <div class="form-group row"> 
                    <div class="col-xs-4">
                    <div class="d-inline-block text-left" style="font-size:22px;">Factura Afecta</div>
                    </div>
                    <div class="col-xs-2 col-xs-offset-6">
                    <div class="d-inline-block text-center" style="font-size:22px;">${cantidad}</div> 
                    </div>
                    <div class="col-xs-4">
                    <div class="d-inline-block text-left" style="font-size:22px;">Factura Exenta</div>
                    </div>
                    <div class="col-xs-2 col-xs-offset-6">
                    <div class="d-inline-block text-center" style="font-size:22px;">${cantidad}</div> 
                    </div>
                    <div class="col-xs-4">
                    <div class="d-inline-block text-left" style="font-size:22px;">Venta Boleta</div>
                    </div>
                    <div class="col-xs-2 col-xs-offset-6">
                    <div class="d-inline-block text-center" style="font-size:22px;">${cantidad}</div> 
                    </div>
                    <div class="col-xs-4">
                    <div class="d-inline-block text-left" style="font-size:22px;">Nota Debito</div>
                    </div>
                    <div class="col-xs-2 col-xs-offset-6">
                    <div class="d-inline-block text-center" style="font-size:22px;">${cantidad}</div> 
                    </div>
                    <div class="col-xs-4">
                    <div class="d-inline-block text-left" style="font-size:22px;">Salida Manual</div>
                    </div>
                    <div class="col-xs-2 col-xs-offset-6">
                    <div class="d-inline-block text-center" style="font-size:22px;">${cantidad}</div> 
                    </div>
                    <div class="col-xs-4">
                    <div class="d-inline-block text-left" style="font-size:22px;">Bodega a OT</div>
                    </div>
                    <div class="col-xs-2 col-xs-offset-6">
                    <div class="d-inline-block text-center" style="font-size:22px;">${cantidad}</div> 
                    </div>
                    <div class="col-xs-4">
                    <div class="d-inline-block text-left" style="font-size:22px;">Ajuste de Inventario</div>
                    </div>
                    <div class="col-xs-2 col-xs-offset-6">
                    <div class="d-inline-block text-center" style="font-size:22px;">${cantidad}</div> 
                    </div>
                    </hr>
                    <div class="col-xs-4 col-xs-offset-4">
                    <div class="d-inline-block text-left" style="font-size:22px; font-weight:bold">Total Salidas</div>
                    </div>
                    <div class="col-xs-3 col-xs-offset-1">
                    <div class="d-inline-block text-right" style="font-size:20px;">${Total_Salidas}</div>
                    </div>
                            

                </div>
              </div> 
            </div>
            <div class="form-group row">
                <div class="box-title">
                <div class="col-xs-4">
                    <div class="d-inline-block text-left" style="font-size:28px; font-weight:bold;">TOTAL INVENTARIO</div>
                    </div>
                    <div class="col-xs-3 col-xs-offset-5">
                    <div class="d-inline-block text-center" style="font-size:22px;">${valor_inventario}</div> 
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

        </div>

      </form>



    </div>

  </div>

</div>
<script>

$(document).ready(function() {
  console.log("CIERRE ACTIVADO");
   $(".btnGenerarCierre").click(function(){
     var fechaCierre = $("#fechaCierre").val();
    console.log(fechaCierre);
    window.location = "index.php?ruta=cierre-caja&fechaCierre="+fechaCierre;
   })
});
</script>




