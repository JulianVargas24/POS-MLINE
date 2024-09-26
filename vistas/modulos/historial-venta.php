<?php

$item = "codigo";
$valor = $_GET["codigoVenta"];

$venta = ControladorhistorialVentas::ctrMostrarHistorialVentas($item, $valor);

$itemCliente = "id";
$valorCliente = $venta["id_cliente"];

$cliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

$itemUsuario = "id";
$valorUsuario = $venta["id_vendedor"];

$vendedor = ControladorUsuarios::ctrMostrarUsuarios($itemUsuario, $valorUsuario);


?>


<div class="content-wrapper" >

  <section class="content-header">
    
    <h1>
      
      Historial De Ventas
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Historial De Ventas</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box" style="width: 100%;">

      <div class="box-header with-border">
      <div>
      <strong style="font-size: 15px;"> Cliente: <input type="text" class="form-group" value="<?php echo $cliente["nombre"]; ?>" style="border: none; background-color:white;"  disabled></strong>
       <input type="hidden" value="<?php echo $cliente["id"]; ?> " >
      </div>
   

      <div>
      <strong style="font-size: 15px;"> Vendedor: <input type="text" class="form-group" value="<?php echo $vendedor["nombre"]; ?>" style="border: none; background-color:white;"  disabled></strong>
       <input type="hidden" value="<?php echo $vendedor["id"]; ?> " >
      </div>

      <div style="text-align: right; position:relative; bottom:70px; color:red;">
      <strong style="font-size: 16px;">Código Factura:<input type="text" class="form-group"  size="2" value="<?php echo $venta["codigo"]; ?>" style="border: none; background-color:white;"  disabled></strong>
       <input type="hidden" value="<?php echo $venta["id"]; ?> " >
      </div>
      </div>

    
      
      <div class="box-body">
      <div class="row">
      <div class="col-md-4">
     <div style="width: fit-content">
      <table class="table table-bordered dt-responsive"  width="100%">
         
      <thead>         
         <tr>           
     
           <th>Producto</th>
           <th>Cantidad</th>
           <th>Valor Unit.</th>
           <th>Valor Total</th>   
          
             

         </tr> 
        </thead>
        <tbody>

                    <?php

                $listaProducto = json_decode($venta["productos"], true);

                foreach ($listaProducto as $key => $value) {

                $item = "id";
                $valor = $value["id"];
                $orden = "id";

                $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);

                ?>
                 <tr>
                        <td><input type="text" class="form-control"  value="<?php echo $value["descripcion"] ?>" disabled style="border: none; background-color:white;"></td>
                        <td><input type="text"  class="form-control"  value="<?php echo $value["cantidad"] ?>" disabled style="border: none; background-color:white;" ></td>
                        <td><input type="text"  class="form-control"  value="<?php echo  "$ " .number_format($value["precio"],0) ?>" disabled style="border: none; background-color:white;"></td>
                        <td><input type="text"  class="form-control"  value="<?php echo  "$ " .number_format($value["total"],0) ?>" disabled style="border: none; background-color:white;"> </td>
                    </tr>
                   
                    <?php } ?>
                   
                   
                    <tr>
                      <td colspan="3"><input type="text" class="form-control" value="SUB TOTAL:" style="text-align: right; font-weight:bold; border: none; background-color:white;" disabled readonly></td>
                      <td><input type="text" class="form-control" size="5" value="<?php echo " $" .number_format($venta["neto"],0)?>" disabled style="border: none; background-color:white;"></td>
                    </tr>
                    </tbody>
                </table>
     
     </div> 
    </div>
    
   
    <br/>
    <div class="box-body">
    
            <div class="col-md-8 float-left" style="bottom: 35px;">
       <table class="table table-bordered table-striped dt-responsive tablaHistorial" width="100%">
         
        <thead>
         
         <tr>
           
      
           <th>Fecha</th>
           <th>Metodo Pago</th>
           <th>Descuento</th>
           <th>Total</th>
           <th>Pagado</th>
           <th>Pendiente</th>
           <td>Acciones</td>
          


         </tr> 

        </thead>

        <tbody>

        <?php
                $codigo = $_GET["codigoVenta"];

                $db = new PDO("mysql:host=localhost;dbname=sis_inventario","root","");
                $sql = "SELECT * FROM historial_ventas WHERE codigo = $codigo";
                foreach ($db->query($sql) as $value){

           
                    echo ' <tr>


                    <td class="text-uppercase">'.$value["fecha"].'</td>
                    <td class="text-uppercase">'.$value["metodo_pago"].'</td>
                    <td class="text-uppercase"> $ '.number_format($value["descuento"],0).'</td>
                    <td class="text-uppercase"> $ '.number_format($value["total"],0).'</td>
                    <td class="text-uppercase"> $ '.number_format($value["total_pagado"],0).'</td>
                    <td class="text-uppercase"> $ '.number_format($value["total_pendiente_pago"],0).'</td>
                

                   <td> <button  class="btn btn-primary btnImprimirHistorial" codigoVenta="'.$value["codigo"].'" >  <i class="fa fa-print"></i> PDF</i></td> 
                ';

                  '</tr>';
          }

        ?>

        </tbody>

       </table>
    </div>
      </div>
    </div>

  </section>

</div>



       




