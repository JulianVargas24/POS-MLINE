<?php



if($_SESSION["perfil"] == "Especial"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

$xml = ControladorVentas::ctrDescargarXML();

if($xml){

  rename($_GET["xml"].".xml", "xml/".$_GET["xml"].".xml");

  echo '<a class="btn btn-block btn-success abrirXML" archivo="xml/'.$_GET["xml"].'.xml" href="ventas">Se ha creado correctamente el archivo XML <span class="fa fa-times pull-right"></span></a>';

}

?>
<div class="content-wrapper">

  <section class="content-header"> 
    
    <h1>
      
      Administrar ventas
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar ventas</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">


        <a href="venta-boleta">

          <button class="btn btn-primary">
            
            Crear venta con boleta afecta

          </button>

        </a>
        <a href="boleta-exenta">

          <button class="btn btn-danger">
            
            Crear venta con boleta exenta

          </button>

        </a>
        <a href="venta-factura">

          <button class="btn btn-success">
            
           Crear venta con factura afecta

          </button>

        </a>
        <a href="venta-factura-exenta">

          <button class="btn btn-warning">
            
           Crear venta con factura exenta

          </button>

        </a>


      </div>

      <div class="box-tools pull-right" style="margin-bottom:5px">
          <a href="vistas/modulos/descargar-reporte-ventas.php?reporte=reporte">
            <button class="btn btn-success" style="margin-top:5px;margin-right:2px;">Reporte: ventas general</button>
          </a>
          
          

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive  tablas" width="100%">
         
        <thead>
         
        <tr>
           
           <th>Folio</th>
           <th>Tipo DTE</th>
           <th>Emisión</th>
           <th>Vendedor</th>
           <th>Unidad de negocio</th>
           <th>Bodega</th>
           <th>Plazo de pago</th>
           <th>Medio de pago</th>
           <th>Cliente</th>
           <th>Observación</th>
           <th>Total</th>
           <th>Pagado</th>
           <th>Pendiente</th>
           <th>Acciones</th>
         </tr> 

        </thead>

        <tbody>
                
        <?php /*

          if(isset($_GET["fechaInicial"])){

            $fechaInicial = $_GET["fechaInicial"];
            $fechaFinal = $_GET["fechaFinal"];

          }else{

            $fechaInicial = null;
            $fechaFinal = null;

          }

          $respuesta = ControladorVentas::ctrRangoFechasVentas($fechaInicial, $fechaFinal);

          foreach ($respuesta as $key => $value) {
           
           echo '<tr>

                 
                 

                  <td>'.($value["codigo"]).'</td>';

                  $itemCliente = "id";
                  $valorCliente = $value["id_cliente"];

                  $respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

                  echo '<td>'.$respuestaCliente["nombre"].'</td>';

                  $itemUsuario = "id";
                  $valorUsuario = $value["id_vendedor"];

                  $respuestaUsuario = ControladorUsuarios::ctrMostrarUsuarios($itemUsuario, $valorUsuario);

                  echo '<td>'.$respuestaUsuario["nombre"].'</td>

                  <td>'.$value["metodo_pago"].'</td>

                  <td>$ '.number_format($value["descuento"],0,  '', '.').'</td>';

                  $db = new PDO("mysql:host=localhost;dbname=mlinecl_sis_inventario","root","");
                  $codigo = $value["codigo"];
                $sql = "SELECT total_pendiente_pago, SUM(total_pagado) as sumar FROM historial_ventas WHERE codigo = $codigo";
                foreach ($db->query($sql) as $row){

                   echo '<td>$ '.number_format($row["sumar"],0,  '', '.').'</td>';
                }


                echo '<td>$ '.number_format($value["total_pendiente_pago"],0,  '', '.').'</td>

                  <td>$ '.number_format($value["total"],0,  '', '.').'</td>

                  <td>'.$value["fecha"].'</td>

                  <td>

                    <div class="btn-group">



                      <button class="btn btn-success btnImprimirTicket" codigoVenta="'.$value["codigo"].'">

                      Ticket

                      </button>
                        
                      <button class="btn btn-info btnImprimirFactura" codigoVenta="'.$value["codigo"].'">

                      PDF

                      </button>';

                      if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Vendedor"){

                      echo '<button class="btn btn-warning btnEditarVenta" idVenta="'.$value["id"].'"><i class="fa fa-pencil"></i></button>';
                      echo '<button class="btn btn-primary btnHistorial" codigoVenta="'.$value["codigo"].'"><i class="fa fa-search"></i>

                    </button>';

                      }
                      if($_SESSION["perfil"] == "Administrador"){
                     echo' <button class="btn btn-danger btnEliminarVenta" idVenta="'.$value["id"].'"><i class="fa fa-times"></i></button>';


                    }

                    echo '</div>  

                  </td>

                </tr>';
            }

        */?>
        
        <?php

          $item = null;
          $valor = null;
          //VENTAS
          $boletasAfectas = ControladorVentas::ctrMostrarVentasBoletas($item, $valor);
          $boletasExentas = ControladorVentas::ctrMostrarVentasBoletasExentas($item, $valor);
          $facturasAfectas = ControladorVentas::ctrMostrarVentasAfectas($item, $valor);
          $facturasExentas = ControladorVentas::ctrMostrarVentasExentas($item, $valor);
          //NOTAS DE CREDITO
          $notasFacturaAfecta = ControladorNotaCredito::ctrMostrarNotasAfecta($item, $valor);
          $notasFacturaExenta = ControladorNotaCredito::ctrMostrarNotasExenta($item, $valor);
          $notasBoletaAfecta = ControladorNotaCredito::ctrMostrarNotasBoleta($item, $valor);
          $notasBoletaExenta = ControladorNotaCredito::ctrMostrarNotasBoletaExenta($item, $valor);

          $negocios = ControladorNegocios::ctrMostrarNegocios($item, $valor);
          $bodegas = ControladorBodegas::ctrMostrarBodegas($item, $valor);
          $clientes = ControladorClientes::ctrMostrarClientes($item, $valor);
          $plazos = ControladorPlazos::ctrMostrarPlazos($item,$valor);
          $medios = ControladorMediosPago::ctrMostrarMedios($item,$valor);
          $plantel = ControladorPlantel::ctrMostrarPlantel($item, $valor);

          // MOSTRAR VENTAS CON BOLETA AFECTAS
            foreach ($boletasAfectas as $key => $value) {                

              for($i = 0; $i < count($negocios); ++$i){
                if ($negocios[$i]["id"] == $value["id_unidad_negocio"]) {
                  $negocio = $negocios[$i]["unidad_negocio"];
                }
              }
              for($i = 0; $i < count($bodegas); ++$i){
                if ($bodegas[$i]["id"] == $value["id_bodega"]) {
                  $bodega = $bodegas[$i]["nombre"];
                }
              }
              for($i = 0; $i < count($clientes); ++$i){
                if ($clientes[$i]["id"] == $value["id_cliente"]) {
                  $cliente = $clientes[$i]["nombre"];
                }
              }
              for($i = 0; $i < count($plazos); ++$i){
                if ($plazos[$i]["id"] == $value["id_plazo_pago"]) {
                  $plazo = $plazos[$i]["nombre"];
                }
              }
              for($i = 0; $i < count($medios); ++$i){
                if ($medios[$i]["id"] == $value["id_medio_pago"]) {
                  $medio = $medios[$i]["medio_pago"];
                }
                
                }
                        for($i = 0; $i < count($plantel); ++$i){
                    if ($plantel[$i]["id"] == $value["id_vendedor"]) {
                      $vendedor = $plantel[$i]["nombre"];
                    }
                }
            

              echo '<tr>


                    <td>'.$value["codigo"].'</td>

                    <td style="color:black;font-weight:bold;">'.$value["tipo_dte"].'</td>

                    <td>'.$value["fecha_emision"].'</td>

                    <td>'.$vendedor.'</td>

                    <td>'.$negocio.'</td>

                    <td>'.$bodega.'</td>      

                    <td>'.$plazo.'</td>

                    <td>'.$medio.'</td>

                    <td>'.$cliente.'</td>

                    <td style="width:20px;">'.$value["observacion"].'</td>

                    <td>$ '.number_format($value["total_final"], 0, '.', ',').'</td>
                    <td>$ '.number_format($value["pagado"], 0, '.', ',').'</td>
                    <td>$ '.number_format($value["pendiente"], 0, '.', ',').'</td>

                    <td>

                    <div class="btn-group">
                        
                    <button class="btn btn-success btnImprimirTicket" codigoVenta="'.$value["codigo"].'">

                    Ticket

                    </button>'; 
                      if($value["estado"] != "Cerrada"){
                        echo '<button class="btn btn-warning btnNotaVentaBoleta" idVenta="'.$value["id"].'">N.C</button>';}
                      

                    echo '</div>  

                  </td>


                  </tr>';

                  $eliminarVentaBoleta = new ControladorVentaBoleta();
                  $eliminarVentaBoleta -> ctrEliminarVentaBoleta();
          
            }
            //MOSTRAR VENTAS CON BOLETAS EXENTAS
            foreach ($boletasExentas as $key => $value) {
              for($i = 0; $i < count($negocios); ++$i){
                if ($negocios[$i]["id"] == $value["id_unidad_negocio"]) {
                  $negocio = $negocios[$i]["unidad_negocio"];
                }
              }
              for($i = 0; $i < count($bodegas); ++$i){
                if ($bodegas[$i]["id"] == $value["id_bodega"]) {
                  $bodega = $bodegas[$i]["nombre"];
                }
              }
              for($i = 0; $i < count($clientes); ++$i){
                if ($clientes[$i]["id"] == $value["id_cliente"]) {
                  $cliente = $clientes[$i]["nombre"];
                }
              }
              for($i = 0; $i < count($plazos); ++$i){
                if ($plazos[$i]["id"] == $value["id_plazo_pago"]) {
                  $plazo = $plazos[$i]["nombre"];
                }
              }
              for($i = 0; $i < count($medios); ++$i){
                if ($medios[$i]["id"] == $value["id_medio_pago"]) {
                  $medio = $medios[$i]["medio_pago"];
                }
                
                }
                        for($i = 0; $i < count($plantel); ++$i){
                    if ($plantel[$i]["id"] == $value["id_vendedor"]) {
                      $vendedor = $plantel[$i]["nombre"];
                    }
                }
            

              echo '<tr>


                    <td>'.$value["codigo"].'</td>

                    <td style="color:black;font-weight:bold;">'.$value["tipo_dte"].'</td>

                    <td>'.$value["fecha_emision"].'</td>

                    <td>'.$vendedor.'</td>

                    <td>'.$negocio.'</td>

                    <td>'.$bodega.'</td>      

                    <td>'.$plazo.'</td>

                    <td>'.$medio.'</td>

                    <td>'.$cliente.'</td>

                    <td style="width:20px;">'.$value["observacion"].'</td>
      
                    <td>$ '.number_format($value["total_final"], 0, '.', ',').'</td>
                    <td>$ '.number_format($value["pagado"], 0, '.', ',').'</td>
                    <td>$ '.$value["pendiente"].'</td>

                    <td>

                    <div class="btn-group">
                        
                      <button class="btn btn-info btnImprimirBoletaExenta" codigoVenta="'.$value["codigo"].'">

                      PDF

                      </button>'; 
                      if($value["estado"] != "Cerrada"){
                        echo '<button class="btn btn-warning btnNotaVentaBoletaExenta" idVenta="'.$value["id"].'">N.C</button>';}
                        

                    echo '</div>  

                  </td>


                  </tr>';

                  $eliminarVentaBoleta = new ControladorVentaBoleta();
                  $eliminarVentaBoleta -> ctrEliminarVentaBoleta();
          
            }
            //MOSTRAR VENTAS CON FACTURACION AFECTAS
            foreach ($facturasAfectas as $key => $value) {
              for($i = 0; $i < count($negocios); ++$i){
                if ($negocios[$i]["id"] == $value["id_unidad_negocio"]) {
                  $negocio = $negocios[$i]["unidad_negocio"];
                }
              }
              for($i = 0; $i < count($bodegas); ++$i){
                if ($bodegas[$i]["id"] == $value["id_bodega"]) {
                  $bodega = $bodegas[$i]["nombre"];
                }
              }
              for($i = 0; $i < count($clientes); ++$i){
                if ($clientes[$i]["id"] == $value["id_cliente"]) {
                  $cliente = $clientes[$i]["nombre"];
                }
              }
              for($i = 0; $i < count($plazos); ++$i){
                if ($plazos[$i]["id"] == $value["id_plazo_pago"]) {
                  $plazo = $plazos[$i]["nombre"];
                }
              }
              for($i = 0; $i < count($medios); ++$i){
                if ($medios[$i]["id"] == $value["id_medio_pago"]) {
                  $medio = $medios[$i]["medio_pago"];
                }
                
                }
                        for($i = 0; $i < count($plantel); ++$i){
                    if ($plantel[$i]["id"] == $value["id_vendedor"]) {
                      $vendedor = $plantel[$i]["nombre"];
                    }
                }
            

              echo '<tr>


                    <td>'.$value["codigo"].'</td>

                    <td style="color:black;font-weight:bold;">'.$value["tipo_dte"].'</td>

                    <td>'.$value["fecha_emision"].'</td>

                    <td>'.$vendedor.'</td>

                    <td>'.$negocio.'</td>

                    <td>'.$bodega.'</td>      

                    <td>'.$plazo.'</td>

                    <td>'.$medio.'</td>

                    <td>'.$cliente.'</td>

                    <td style="width:20px;">'.$value["observacion"].'</td>

                    <td>$ '.$value["total_final"].'</td>
                    <td>$ '.number_format($value["pagado"], 0, '.', ',').'</td>
                    <td>$ '.number_format($value["pendiente"], 0, '.', ',').'</td>

                    <td>

                    <div class="btn-group">
                        
                      <button class="btn btn-info btnImprimirVentaAfecta" codigoVenta="'.$value["codigo"].'">

                      PDF

                      </button>'; 
                      if($value["estado"] != "Cerrada"){
                        echo '<button class="btn btn-warning btnNotaVentaAfecta" idVenta="'.$value["id"].'">N.C</button>';}
                       

                    echo '</div>  

                  </td>


                  </tr>';

                  $eliminarVentaAfecta = new ControladorVentaFactura();
                  $eliminarVentaAfecta -> ctrEliminarVentaAfecta();
          
            }
            //MOSTRAR VENTAS FACTURA EXENTA
            foreach ($facturasExentas as $key => $value) {
              for($i = 0; $i < count($negocios); ++$i){
                if ($negocios[$i]["id"] == $value["id_unidad_negocio"]) {
                  $negocio = $negocios[$i]["unidad_negocio"];
                }
              }
              for($i = 0; $i < count($bodegas); ++$i){
                if ($bodegas[$i]["id"] == $value["id_bodega"]) {
                  $bodega = $bodegas[$i]["nombre"];
                }
              }
              for($i = 0; $i < count($clientes); ++$i){
                if ($clientes[$i]["id"] == $value["id_cliente"]) {
                  $cliente = $clientes[$i]["nombre"];
                }
              }
              for($i = 0; $i < count($plazos); ++$i){
                if ($plazos[$i]["id"] == $value["id_plazo_pago"]) {
                  $plazo = $plazos[$i]["nombre"];
                }
              }
              for($i = 0; $i < count($medios); ++$i){
                if ($medios[$i]["id"] == $value["id_medio_pago"]) {
                  $medio = $medios[$i]["medio_pago"];
                }
                
                }
                        for($i = 0; $i < count($plantel); ++$i){
                    if ($plantel[$i]["id"] == $value["id_vendedor"]) {
                      $vendedor = $plantel[$i]["nombre"];
                    }
                }
            

              echo '<tr>


                    <td>'.$value["codigo"].'</td>

                    <td style="color:black;font-weight:bold;">'.$value["tipo_dte"].'</td>

                    <td>'.$value["fecha_emision"].'</td>

                    <td>'.$vendedor.'</td>

                    <td>'.$negocio.'</td>

                    <td>'.$bodega.'</td>      

                    <td>'.$plazo.'</td>

                    <td>'.$medio.'</td>

                    <td>'.$cliente.'</td>

                    <td style="width:20px;">'.$value["observacion"].'</td>
      
                    
                    <td>$ '.number_format($value["total_final"], 0, '.', ',').'</td>
                    <td>$ '.number_format($value["pagado"], 0, '.', ',').'</td>
                    <td>$ '.$value["pendiente"].'</td>

                    <td>

                    <div class="btn-group">
                      <button class="btn btn-info btnImprimirVentaExenta" codigoVenta="'.$value["codigo"].'">

                      PDF

                      </button>'; 
                      if($value["estado"] != "Cerrada"){
                        echo '<button class="btn btn-warning btnNotaVentaExenta" idVenta="'.$value["id"].'">N.C</button>';}
                        

                     

                    echo '</div>  

                  </td>


                  </tr>';

                  $eliminarVentaExenta = new ControladorVentaFactura();
                  $eliminarVentaExenta -> ctrEliminarVentaExenta();
          
            }
            //MOSTRAR NOTAS CREDITO DE FACTURA AFECTA
            foreach ($notasFacturaAfecta as $key => $value) {
              for($i = 0; $i < count($negocios); ++$i){
                if ($negocios[$i]["id"] == $value["id_unidad_negocio"]) {
                  $negocio = $negocios[$i]["unidad_negocio"];
                }
              }
              for($i = 0; $i < count($bodegas); ++$i){
                if ($bodegas[$i]["id"] == $value["id_bodega"]) {
                  $bodega = $bodegas[$i]["nombre"];
                }
              }
              for($i = 0; $i < count($clientes); ++$i){
                if ($clientes[$i]["id"] == $value["id_cliente"]) {
                  $cliente = $clientes[$i]["nombre"];
                }
              }
              for($i = 0; $i < count($plazos); ++$i){
                if ($plazos[$i]["id"] == $value["id_plazo_pago"]) {
                  $plazo = $plazos[$i]["nombre"];
                }
              }
              for($i = 0; $i < count($medios); ++$i){
                if ($medios[$i]["id"] == $value["id_medio_pago"]) {
                  $medio = $medios[$i]["medio_pago"];
                }
                
                }
                        for($i = 0; $i < count($plantel); ++$i){
                    if ($plantel[$i]["id"] == $value["id_vendedor"]) {
                      $vendedor = $plantel[$i]["nombre"];
                    }
                }
            

              echo '<tr>


                    <td>'.$value["codigo"].'</td>

                    <td style="color:black;font-weight:bold;">'.$value["tipo_dte"].'</td>

                    <td>'.$value["fecha_emision"].'</td>

                    <td>'.$vendedor.'</td>

                    <td>'.$negocio.'</td>

                    <td>'.$bodega.'</td>      

                    <td>'.$plazo.'</td>

                    <td>'.$medio.'</td>

                    <td>'.$cliente.'</td>

                    <td style="width:20px;">'.$value["observacion"].'</td>
      
                    <td>$ '.number_format($value["total_final"], 0, '.', ',').'</td>
                    <td>$ '.number_format($value["pagado"], 0, '.', ',').'</td>
                    <td>$ 0</td>

                    <td>

                    <div class="btn-group">
                    
                      <button class="btn btn-info btnImprimirNotaCreditoFacturaAfecta" codigoVenta="'.$value["codigo"].'">PDF</button>

                      <!--<button disabled  class="btn btn-warning btnNotaVentaExenta" idVenta="'.$value["id"].'">N.D</button>-->';

                    echo '</div>  

                  </td>


                  </tr>';

                  $eliminarVentaExenta = new ControladorVentaFactura();
                  $eliminarVentaExenta -> ctrEliminarVentaExenta();
          
            }
            //MOSTRAR NOTA CREDITO BOLETA AFECTA
            foreach ($notasBoletaAfecta as $key => $value) {
              for($i = 0; $i < count($negocios); ++$i){
                if ($negocios[$i]["id"] == $value["id_unidad_negocio"]) {
                  $negocio = $negocios[$i]["unidad_negocio"];
                }
              }
              for($i = 0; $i < count($bodegas); ++$i){
                if ($bodegas[$i]["id"] == $value["id_bodega"]) {
                  $bodega = $bodegas[$i]["nombre"];
                }
              }
              for($i = 0; $i < count($clientes); ++$i){
                if ($clientes[$i]["id"] == $value["id_cliente"]) {
                  $cliente = $clientes[$i]["nombre"];
                }
              }
              for($i = 0; $i < count($plazos); ++$i){
                if ($plazos[$i]["id"] == $value["id_plazo_pago"]) {
                  $plazo = $plazos[$i]["nombre"];
                }
              }
              for($i = 0; $i < count($medios); ++$i){
                if ($medios[$i]["id"] == $value["id_medio_pago"]) {
                  $medio = $medios[$i]["medio_pago"];
                }
                
                }
                        for($i = 0; $i < count($plantel); ++$i){
                    if ($plantel[$i]["id"] == $value["id_vendedor"]) {
                      $vendedor = $plantel[$i]["nombre"];
                    }
                }
            

              echo '<tr>


                    <td>'.$value["codigo"].'</td>

                    <td style="color:black;font-weight:bold;">'.$value["tipo_dte"].'</td>

                    <td>'.$value["fecha_emision"].'</td>

                    <td>'.$vendedor.'</td>

                    <td>'.$negocio.'</td>

                    <td>'.$bodega.'</td>      

                    <td>'.$plazo.'</td>

                    <td>'.$medio.'</td>

                    <td>'.$cliente.'</td>

                    <td style="width:20px;">'.$value["observacion"].'</td>
      
                    <td>$ '.number_format($value["total_final"], 0, '.', ',').'</td>
                    <td>$ '.number_format($value["pagado"], 0, '.', ',').'</td>
                    <td>$ 0</td>

                    <td>

                    <div class="btn-group">
                  
                    <button  class="btn btn-info btnImprimirNotaCreditoBoletaAfecta" codigoVenta="'.$value["codigo"].'">PDF</button>

                    <!--<button disabled  class="btn btn-warning btnNotaVentaExenta" idVenta="'.$value["id"].'">N.D</button>-->';

                    echo '</div>  

                  </td>


                  </tr>';

                  $eliminarVentaExenta = new ControladorVentaFactura();
                  $eliminarVentaExenta -> ctrEliminarVentaExenta();
          
            }
            //MOSTRAR NOTA CREDITO FACTURA EXENTA
            foreach ($notasFacturaExenta as $key => $value) {
              for($i = 0; $i < count($negocios); ++$i){
                if ($negocios[$i]["id"] == $value["id_unidad_negocio"]) {
                  $negocio = $negocios[$i]["unidad_negocio"];
                }
              }
              for($i = 0; $i < count($bodegas); ++$i){
                if ($bodegas[$i]["id"] == $value["id_bodega"]) {
                  $bodega = $bodegas[$i]["nombre"];
                }
              }
              for($i = 0; $i < count($clientes); ++$i){
                if ($clientes[$i]["id"] == $value["id_cliente"]) {
                  $cliente = $clientes[$i]["nombre"];
                }
              }
              for($i = 0; $i < count($plazos); ++$i){
                if ($plazos[$i]["id"] == $value["id_plazo_pago"]) {
                  $plazo = $plazos[$i]["nombre"];
                }
              }
              for($i = 0; $i < count($medios); ++$i){
                if ($medios[$i]["id"] == $value["id_medio_pago"]) {
                  $medio = $medios[$i]["medio_pago"];
                }
                
                }
                        for($i = 0; $i < count($plantel); ++$i){
                    if ($plantel[$i]["id"] == $value["id_vendedor"]) {
                      $vendedor = $plantel[$i]["nombre"];
                    }
                }
            

              echo '<tr>


                    <td>'.$value["codigo"].'</td>

                    <td style="color:black;font-weight:bold;">'.$value["tipo_dte"].'</td>

                    <td>'.$value["fecha_emision"].'</td>

                    <td>'.$vendedor.'</td>

                    <td>'.$negocio.'</td>

                    <td>'.$bodega.'</td>      

                    <td>'.$plazo.'</td>

                    <td>'.$medio.'</td>

                    <td>'.$cliente.'</td>

                    <td style="width:20px;">'.$value["observacion"].'</td>
      
                    <td>$ '.number_format($value["total_final"], 0, '.', ',').'</td>
                    <td>$ '.number_format($value["pagado"], 0, '.', ',').'</td>
                    <td>$ '.$value["iva"].'</td>

                    <td>

                    <div class="btn-group">
                  
                      <button class="btn btn-info btnImprimirNotaCreditoFacturaExenta" codigoVenta="'.$value["codigo"].'">PDF</button>

                      <!--<button disabled  class="btn btn-warning btnNotaVentaExenta" idVenta="'.$value["id"].'">N.D</button>-->';

                    echo '</div>  

                  </td>


                  </tr>';

                  $eliminarVentaExenta = new ControladorVentaFactura();
                  $eliminarVentaExenta -> ctrEliminarVentaExenta();
          
            }
            //MOSTAR NOTA CREDITO BOLETA EXENTA
            foreach ($notasBoletaExenta as $key => $value) {
            for($i = 0; $i < count($negocios); ++$i){
              if ($negocios[$i]["id"] == $value["id_unidad_negocio"]) {
                $negocio = $negocios[$i]["unidad_negocio"];
              }
            }
            for($i = 0; $i < count($bodegas); ++$i){
              if ($bodegas[$i]["id"] == $value["id_bodega"]) {
                $bodega = $bodegas[$i]["nombre"];
              }
            }
            for($i = 0; $i < count($clientes); ++$i){
              if ($clientes[$i]["id"] == $value["id_cliente"]) {
                $cliente = $clientes[$i]["nombre"];
              }
            }
            for($i = 0; $i < count($plazos); ++$i){
              if ($plazos[$i]["id"] == $value["id_plazo_pago"]) {
                $plazo = $plazos[$i]["nombre"];
              }
            }
            for($i = 0; $i < count($medios); ++$i){
              if ($medios[$i]["id"] == $value["id_medio_pago"]) {
                $medio = $medios[$i]["medio_pago"];
              }
              
              }
                      for($i = 0; $i < count($plantel); ++$i){
                  if ($plantel[$i]["id"] == $value["id_vendedor"]) {
                    $vendedor = $plantel[$i]["nombre"];
                  }
              }
          

            echo '<tr>


                  <td>'.$value["codigo"].'</td>

                  <td style="color:black;font-weight:bold;">'.$value["tipo_dte"].'</td>

                  <td>'.$value["fecha_emision"].'</td>

                  <td>'.$vendedor.'</td>

                  <td>'.$negocio.'</td>

                  <td>'.$bodega.'</td>      

                  <td>'.$plazo.'</td>

                  <td>'.$medio.'</td>

                  <td>'.$cliente.'</td>

                  <td style="width:20px;">'.$value["observacion"].'</td>
    
                  <td>$ '.number_format($value["total_final"], 0, '.', ',').'</td>
                  <td>$ '.number_format($value["pagado"], 0, '.', ',').'</td>
                  <td>$ '.$value["iva"].'</td>

                  <td>

                  <div class="btn-group">
                
                    <button  class="btn btn-info btnImprimirNotaCreditoBoletaExenta" codigoVenta="'.$value["codigo"].'">PDF</button>

                    <!--<button disabled  class="btn btn-warning btnNotaVentaExenta" idVenta="'.$value["id"].'">N.D</button>-->';

                  echo '</div>  

                </td>


                </tr>';

                $eliminarVentaExenta = new ControladorVentaFactura();
                $eliminarVentaExenta -> ctrEliminarVentaExenta();
        
          }

           
        ?>
               
        </tbody>
        
       </table>
       <?php

        $eliminarVenta = new ControladorVentas();
        $eliminarVenta -> ctrEliminarVenta();

        ?>
     

      </div>

    </div>

  </section>

</div>

<script>
$(document).ready(function() {
  $(".tablas").on("click", ".btnImprimirNotaCreditoBoletaExenta", function(){

  var codigoVenta= $(this).attr("codigoVenta");
  var tipoDocumento = "Nota_Credito_Boleta_Exenta";

  window.open("extensiones/tcpdf/pdf/documento.php?codigo="+codigoVenta + "&documento="+tipoDocumento , "_blank"); 

})
});

$(document).ready(function() {
  $(".tablas").on("click", ".btnImprimirNotaCreditoBoletaAfecta", function(){

  var codigoVenta= $(this).attr("codigoVenta");
  var tipoDocumento = "Nota_Credito_Boleta_Afecta";

  window.open("extensiones/tcpdf/pdf/documento.php?codigo="+codigoVenta + "&documento="+tipoDocumento , "_blank"); 

})
});

$(document).ready(function() {
  $(".tablas").on("click", ".btnImprimirNotaCreditoFacturaAfecta", function(){

  var codigoVenta= $(this).attr("codigoVenta");
  var tipoDocumento = "Nota_Credito_Factura_Afecta";

  window.open("extensiones/tcpdf/pdf/documento.php?codigo="+codigoVenta + "&documento="+tipoDocumento , "_blank"); 

})
});

$(document).ready(function() {
  $(".tablas").on("click", ".btnImprimirNotaCreditoFacturaExenta", function(){

  var codigoVenta= $(this).attr("codigoVenta");
  var tipoDocumento = "Nota_Credito_Factura_Exenta";

  window.open("extensiones/tcpdf/pdf/documento.php?codigo="+codigoVenta + "&documento="+tipoDocumento , "_blank"); 

})
});
</script>


