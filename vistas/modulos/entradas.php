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
      
      ENTRADA
    
    </h1>


    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Formulario Entrada</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box box-success">

        <div class="box-body">
        <div class="row" style="margin-bottom:5px;">
                    <div class="col-xs-5">
                        <label for="">Tipo de Entrada</label>
                        <div class="form-group">
                            <div class="input-group">
                                <input type="radio" name="tipoEntrada" value="bodega">
                                <label for="radio1" style="font-weight:normal;">Bodega a Bodega</label>
                            </div>                                                                    
                            <div class="input-group">  
                                <input type="radio" name="tipoEntrada" value="manual" >
                                <label for="radio2" style="font-weight:normal;">Ingreso manual a Bodega</label>
                            </div>
                            <div class="input-group">
                                <input type="radio" name="tipoEntrada" value="orden" >
                                <label for="radio3" style="font-weight:normal;">Orden de Trabajo a Bodega</label>
                            </div>
                            <div class="input-group">
                                <input type="radio" name="tipoEntrada" value="carga" >
                                <label for="radio3" style="font-weight:normal;">Carga de Producto</label>
                            </div>
                        </div>
                    </div>
        
            <form role="form" method="post" class="formularioEntradaInventario" id="bodega">    
                <div class="row" style="margin-bottom:5px;">
                    <div class="col-xs-5">
                        
                            <div class="form-group">
                                <div class="input-group">
                                    <label for="">Fecha Emision</label>
                                    <input type="hidden" name="listaProductos" id="listaProductos">
                                    <input type="date" class="form-control input-sm" name="nuevaFecha" id="nuevaFecha">
                                </div>
                            </div>
                    </div>
                    <div class="col-xs-2 col-xs-offset-5">
                        <div class="d-block" style="font-size:16px;color:green;font-weight:bold;">ENTRADA</div>
                        <?php
                                $tabla = "entradas";
                                $atributo= "entrada_inventario";
                                $folio = ModeloParametrosDocumentos::mdlMostrarFolio($tabla, $atributo);
                        ?>
                            <div class="form-group">
                                <div class="input-group">
                                <span class="input-group-addon">Folio</span>
                                 <input type="text" style="font-weight:bold; font-size:16px;" class="form-control" name="nuevoCodigo" id="nuevoCodigo" value="<?php echo $folio + 1 ?>" readonly required>
                                </div>
                            </div>
                    </div>

                </div>

                
                <div class="col-xs-5">
                    <label for="">Observaciones</label>
                    <div class="form-group">
                    <textarea name="nuevaObservacion" id="nuevaObservacion" cols="40" rows="2"></textarea>

                    </div>
                
                </div>
                
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box box-info">
                            <h4 class="box-title">Bodega a Bodega</h4>
                            <div class="box-body">
                                <div class="row">
                                        <div class="col-xs-6">
                                            <div class="col-xs-6">
                                            <div class="d-block" style="font-size:14px;">Bodega Origen</div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                <input type="hidden" name="nuevoTipoEntrada" id="nuevoTipoEntrada" value="Bodega a Bodega">
                                                <span class="input-group-addon"><i class="fa fa-check"></i></span> 

                                                    <select style="padding-left:0px" class="form-control input" id="nuevoValorTipoEntrada" name="nuevoValorTipoEntrada" required>
                                                        
                                                    <option value="">Seleccionar Bodega</option>
                                                    <?php

                                                        $item = null;
                                                        $valor = null;

                                                        $bodegas = ControladorBodegas::ctrMostrarBodegas($item, $valor);

                                                        foreach ($bodegas as $key => $value) {
                                                        
                                                        echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
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
                                                    
                                                <span class="input-group-addon"><i class="fa fa-check"></i></span> 

                                                    <select style="padding-left:0px" class="form-control input" id="nuevaBodegaDestino" name="nuevaBodegaDestino" required>
                                                        
                                                    <option value="">Seleccionar Bodega</option>
                                                    <?php

                                                        $item = null;
                                                        $valor = null;

                                                        $bodegas = ControladorBodegas::ctrMostrarBodegas($item, $valor);

                                                        foreach ($bodegas as $key => $value) {
                                                        
                                                        echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                                                        }

                                                    ?>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-xs-12 nuevoProductoEntrada1">
                                        </div>
                                </div>
                                <div class="row">                                        
                                    <div class="col-xs-6">
                                        <div class="box box-success">
                                            <div class="box-header with-border"></div>
                                                <div class="box-body">
                                                    <h4 class="box-title text-center" style="font-weight:bold; font-size:20px;"> Productos para Seleccionar</h4>
                                                    
                                                    <table  class="table table-bordered table-striped dt-responsive tablaEntradas1">
                                                
                                                    
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
                            </div>
                        </div>
                    </div>


                                    
                    
                </div>
                
                <!-- Botones en BODEGA a BODEGA -->
                <button type="button" class="btn btn-default" onclick="window.location.href='entrada';">Salir</button>
                <button type="submit" class="btn btn-primary">Guardar Entrada</button>
            </form>
            <form role="form" method="post" class="formularioEntradaInventario" id="manual">    
                <div class="row" style="margin-bottom:5px;">
                    <div class="col-xs-5">
                        
                            <div class="form-group">
                                <div class="input-group">
                                    <label for="">Fecha Emision</label>
                                    <input type="text" name="listaProductos1" id="listaProductos1">
                                    <input type="date" class="form-control input-sm" name="nuevaFecha1" id="nuevaFecha1">
                                </div>
                            </div>
                    </div>
                    <div class="col-xs-2 col-xs-offset-5">
                        <div class="d-block" style="font-size:16px;color:green;font-weight:bold;">ENTRADA</div>
                        <?php
                                $tabla = "entradas";
                                $atributo= "entrada_inventario";
                                $folio = ModeloParametrosDocumentos::mdlMostrarFolio($tabla, $atributo);
                        ?>
                            <div class="form-group">
                                <div class="input-group">
                                <span class="input-group-addon">Folio</span>
                                 <input type="text" style="font-weight:bold; font-size:16px;" class="form-control" name="nuevoCodigo1" id="nuevoCodigo1" value="<?php echo $folio + 1 ?>" readonly required>
                                </div>
                            </div>
                    </div>

                </div>

                
                <div class="col-xs-5">
                    <label for="">Observaciones</label>
                    <div class="form-group">
                    <textarea name="nuevaObservacion1" id="nuevaObservacion1" cols="40" rows="2"></textarea>

                    </div>
                
                </div>
                
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box box-info">
                            <h4 class="box-title">Ingreso Manual a Bodega</h4>
                            <div class="box-body">
                                <div class="row">
                                        <div class="col-xs-6">
                                            <div class="col-xs-6">
                                            <div class="d-block" style="font-size:14px;">Ingresado por:</div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                <input type="hidden" name="nuevoTipoEntrada1" id="nuevoTipoEntrada1" value="Ingreso Manual a Bodega">
                                                <span class="input-group-addon"><i class="fa fa-check"></i></span> 

                                                    <select style="padding-left:0px" class="form-control input" id="nuevoValorTipoEntrada1" name="nuevoValorTipoEntrada1" required>
                                                        
                                                    <option value="">Seleccionar Plantel</option>
                                                    <?php

                                                        $item = null;
                                                        $valor = null;

                                                        $bodegas = ControladorPlantel::ctrMostrarPlantel($item, $valor);

                                                        foreach ($bodegas as $key => $value) {
                                                        
                                                        echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
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
                                                    
                                                <span class="input-group-addon"><i class="fa fa-check"></i></span> 

                                                    <select style="padding-left:0px" class="form-control input" id="nuevaBodegaDestino1" name="nuevaBodegaDestino1" required>
                                                        
                                                    <option value="">Seleccionar Bodega</option>
                                                    <?php

                                                        $item = null;
                                                        $valor = null;

                                                        $bodegas = ControladorBodegas::ctrMostrarBodegas($item, $valor);

                                                        foreach ($bodegas as $key => $value) {
                                                        
                                                        echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                                                        }

                                                    ?>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-xs-12 nuevoProductoEntrada2">
                                        </div>
                                </div>
                                <div class="row">                                        
                                    <div class="col-xs-6">
                                        <div class="box box-success">
                                            <div class="box-header with-border"></div>
                                                <div class="box-body">
                                                    <h4 class="box-title text-center" style="font-weight:bold; font-size:20px;"> Productos para Seleccionar</h4>
                                                    
                                                    <table  class="table table-bordered table-striped dt-responsive tablaEntradas2">
                                                
                                                    
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
                            </div>
                        </div>
                    </div>


                                    
                    
                </div>
                
                <!-- Botones en INGRESO MANUAL a BODEGA -->
                <button type="button" class="btn btn-default" onclick="window.location.href='entrada';">Salir</button>
                <button type="submit" class="btn btn-primary">Guardar Entrada</button>
            </form>
            <form role="form" method="post" class="formularioEntradaInventario" id="orden">    
                <div class="row" style="margin-bottom:5px;">
                    <div class="col-xs-5">
                        
                            <div class="form-group">
                                <div class="input-group">
                                <input type="text" name="listaProductos2" id="listaProductos2">
                                    <label for="">Fecha Emision</label>
                                    <input type="date" class="form-control input-sm" name="nuevaFecha2" id="nuevaFecha2">
                                </div>
                            </div>
                    </div>
                    <div class="col-xs-2 col-xs-offset-5">
                        <div class="d-block" style="font-size:16px;color:green;font-weight:bold;">ENTRADA</div>
                        <?php
                                $tabla = "entradas";
                                $atributo= "entrada_inventario";
                                $folio = ModeloParametrosDocumentos::mdlMostrarFolio($tabla, $atributo);
                        ?>
                            <div class="form-group">
                                <div class="input-group">
                                <span class="input-group-addon">Folio</span>
                                 <input type="text" style="font-weight:bold; font-size:16px;" class="form-control" name="nuevoCodigo2" id="nuevoCodigo2" value="<?php echo $folio + 1 ?>" readonly required>
                                </div>
                            </div>
                    </div>

                </div>

                
                <div class="col-xs-5">
                    <label for="">Observaciones</label>
                    <div class="form-group">
                    <textarea name="nuevaObservacion2" id="nuevaObservacion2" cols="40" rows="2"></textarea>
                    </div>
                
                </div>
                
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box box-info">
                            <h4 class="box-title">Orden de Trabajo a Bodega</h4>
                            <div class="box-body">
                                <div class="row">
                                        <div class="col-xs-6">
                                            <div class="col-xs-6">
                                            <div class="d-block" style="font-size:14px;">Orden de Trabajo</div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                <input type="hidden" name="nuevoTipoEntrada2" id="nuevoTipoEntrada2" value="Orden de Trabajo a Bodega">
                                                <span class="input-group-addon"><i class="fa fa-check"></i></span> 

                                                    <select style="padding-left:0px" class="form-control input" id="nuevoValorTipoEntrada2" name="nuevoValorTipoEntrada2" required>
                                                        
                                                    <option value="">Seleccionar O.T</option>
                                                    <?php

                                                        $item = null;
                                                        $valor = null;

                                                        $orden = ControladorOrdenVestuario::ctrMostrarOrdenVestuario($item, $valor);

                                                        foreach ($orden as $key => $value) {
                                                        
                                                        echo '<option value="'.$value["id"].'">'.$value["nombre_orden"].'</option>';
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
                                                    
                                                <span class="input-group-addon"><i class="fa fa-check"></i></span> 

                                                    <select style="padding-left:0px" class="form-control input" id="nuevaBodegaDestino2" name="nuevaBodegaDestino2" required>
                                                        
                                                    <option value="">Seleccionar Bodega</option>
                                                    <?php

                                                        $item = null;
                                                        $valor = null;

                                                        $bodegas = ControladorBodegas::ctrMostrarBodegas($item, $valor);

                                                        foreach ($bodegas as $key => $value) {
                                                        
                                                        echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                                                        }

                                                    ?>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-xs-12 nuevoProductoEntrada3">
                                        </div>
                                </div>
                                <div class="row">                                        
                                    <div class="col-xs-6">
                                        <div class="box box-success">
                                            <div class="box-header with-border"></div>
                                                <div class="box-body">
                                                    <h4 class="box-title text-center" style="font-weight:bold; font-size:20px;"> Productos para Seleccionar</h4>
                                                    
                                                    <table  class="table table-bordered table-striped dt-responsive tablaEntradas3">
                                                
                                                    
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
                            </div>
                        </div>
                    </div>


                                    
                    
                </div>
                
                <!-- Botones en ORDEN de TRABAJO a BODEGA -->
                <button type="button" class="btn btn-default" onclick="window.location.href='entrada';">Salir</button>
                <button type="submit" class="btn btn-primary">Guardar Entrada</button>
            </form>
            <form role="form" method="post" class="formularioEntradaInventario" id="carga">    
                <div class="row" style="margin-bottom:5px;">
                    <div class="col-xs-5">
                        
                            <div class="form-group">
                                <div class="input-group">
                                    <label for="">Fecha Emision</label>
                                    <input type="text" name="listaProductos3" id="listaProductos3">
                                    <input type="date" class="form-control input-sm" name="nuevaFecha3" id="nuevaFecha3">
                                </div>
                            </div>
                    </div>
                    <div class="col-xs-2 col-xs-offset-5">
                        <div class="d-block" style="font-size:16px;color:green;font-weight:bold;">ENTRADA</div>
                        <?php
                                $tabla = "entradas";
                                $atributo= "entrada_inventario";
                                $folio = ModeloParametrosDocumentos::mdlMostrarFolio($tabla, $atributo);
                        ?>
                            <div class="form-group">
                                <div class="input-group">
                                <span class="input-group-addon">Folio</span>
                                 <input type="text" style="font-weight:bold; font-size:16px;" class="form-control" name="nuevoCodigo3" id="nuevoCodigo3" value="<?php echo $folio + 1 ?>" readonly required>
                                </div>
                            </div>
                    </div>

                </div>

                
                <div class="col-xs-5">
                    <label for="">Observaciones</label>
                    <div class="form-group">
                    <textarea name="nuevaObservacion3" id="nuevaObservacion3" cols="40" rows="2"></textarea>

                    </div>
                
                </div>
                
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box box-info">
                            <h4 class="box-title">Carga Inicial de Productos</h4>
                            <div class="box-body">
                                <div class="row">
                                        <div class="col-xs-6">
                                            <div class="col-xs-6">
                                            <div class="d-block" style="font-size:14px;">Ingresado por:</div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                <input type="hidden" name="nuevoTipoEntrada3" id="nuevoTipoEntrada3" value="Carga Inicial">
                                                <span class="input-group-addon"><i class="fa fa-check"></i></span> 

                                                    <select style="padding-left:0px" class="form-control input" id="nuevoValorTipoEntrada3" name="nuevoValorTipoEntrada3" required>
                                                        
                                                    <option value="">Seleccionar Plantel</option>
                                                    <?php

                                                        $item = null;
                                                        $valor = null;

                                                        $bodegas = ControladorPlantel::ctrMostrarPlantel($item, $valor);

                                                        foreach ($bodegas as $key => $value) {
                                                        
                                                        echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
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
                                                    
                                                <span class="input-group-addon"><i class="fa fa-check"></i></span> 

                                                    <select style="padding-left:0px" class="form-control input" id="nuevaBodegaDestino3" name="nuevaBodegaDestino3" required>
                                                        
                                                    <option value="">Seleccionar Bodega</option>
                                                    <?php

                                                        $item = null;
                                                        $valor = null;

                                                        $bodegas = ControladorBodegas::ctrMostrarBodegas($item, $valor);

                                                        foreach ($bodegas as $key => $value) {
                                                        
                                                        echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';
                                                        }

                                                    ?>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-xs-12 nuevoProductoEntrada4">
                                        </div>
                                </div>
                                <div class="row">                                        
                                    <div class="col-xs-6">
                                        <div class="box box-success">
                                            <div class="box-header with-border"></div>
                                                <div class="box-body">
                                                    <h4 class="box-title text-center" style="font-weight:bold; font-size:20px;"> Productos para Seleccionar</h4>
                                                    
                                                    <table  class="table table-bordered table-striped dt-responsive tablaEntradas4">
                                                
                                                    
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
                            </div>
                        </div>
                    </div>


                                    
                    
                </div>
                
                <!-- Botones en CARGA de PRODUCTO -->
                <button type="button" class="btn btn-default" onclick="window.location.href='entrada';">Salir</button>
                <button type="submit" class="btn btn-primary">Guardar Entrada</button>
            </form>
            
            

                <?php
                    $agregarEntrada = new ControladorEntradasInventario();
                  echo $agregarEntrada -> ctrCrearEntrada();
                ?>     
                
        </div>

    </div>

    

  </section>

</div>


<style>
  .error{
    color: red;
  }
</style>
<script>
$(document).ready(function(){
            $("#bodega").hide();
            $("#orden").hide();
            $("#manual").hide();
            $("#carga").hide();
            $("#tabla").hide();
    $('input[type="radio"]').click(function(){
        var inputValue = $(this).attr("value");
        if(inputValue=='bodega'){
            $("#bodega").show();
            $("#tabla").show();
            $("#orden").hide();
            $("#carga").hide();
            $("#manual").hide();
        }else if(inputValue=='orden'){
            $("#bodega").hide();
            $("#tabla").show();
            $("#orden").show();
            $("#carga").hide();
            $("#manual").hide();
        }else if(inputValue=='manual'){
            $("#bodega").hide();
            $("#carga").hide();
            $("#orden").hide();
            $("#manual").show();
        }else if(inputValue=='carga'){
            $("#carga").show();
            $("#bodega").hide();
            $("#orden").hide();
            $("#manual").hide();
        }
    });
});
</script>






