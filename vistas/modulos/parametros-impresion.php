<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Configuración Impresion
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Parametros</li>
    
    </ol>

  </section>

    <section class="content">
        <div class="box">
            <div class="box-body">
                <form role="form" method="post" class="formularioOrdenCompra">
                <!--=====================================
                FECHAS Y TIPO DE DOCUMENTO
                    ======================================-->
                    <div class="row">

                        <div class="col-xs-12">
                                        <div class="box box-info">
                                                <div class="box-body">
                                                    
                                                        <div class="row" style="margin-bottom:5px;">
                                                        
                                                            <div class="col-xs-6">
                                                                <table class="table table-bordered table-striped dt-responsive" width="100%">
            
                                                                    <thead>
                                                                    
                                                                    <tr>
                                                                        
                                                                      
                                                                        <th>Documento</th>
                                                                        <th>Carta</th>
                                                                        <th>80</th>
                                                            
                                                                    </tr> 
                                                            
                                                                    </thead>
                                                            
                                                                    <tbody>
                                                                        <?php

                                                                            $item = null;
                                                                            $valor = null;

                                                                            $documentos = ControladorImpuestos::ctrMostrarDocumentos($item, $valor);

                                                                            foreach ($documentos as $key => $value) {
                                                                                if($value["nombre"] == "Orden de Compra" || $value["nombre"] == "Cotización" || $value["nombre"] == "Boleta"  ||
                                                                                $value["nombre"] == "Factura Exenta" || $value["nombre"] == "Factura Afecta" || $value["nombre"] == "Orden de Vestuario" ||
                                                                                $value["nombre"] == "Entrada Inventario" || $value["nombre"] == "Salida Inventario" || $value["nombre"] == "Ajustes Inventario"  
                                                                            ){
                                                                            
                                                                            echo ' <tr>
                                                                                    <td style="font-size:16px;">'.$value["nombre"].'</td>
                                                                                    <td> <input style="margin-left:10px;" type="radio" name="'.$value["nombre"].'Radio" id="'.$value["nombre"].'Radio1" value="'.$value["nombre"].'"></td>
                                                                                    <td><input style="margin-left:10px;" type="radio" name="'.$value["nombre"].'Radio" id="'.$value["nombre"].'Radio1" value="'.$value["nombre"].'"> </td>

                                                                                    </tr>';
                                                                            }}

                                                                        ?>     

                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            
                                                        </div>
                                                    
                                                </div>
                                        </div>
                        </div>

                    </div>
                                                                    
                        
                   
                                        
                                    
                   <button type="button" class="btn btn-default">Salir</button>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>                 
                </form>
                                   
            </div>
        </div>
    </section>

</div>