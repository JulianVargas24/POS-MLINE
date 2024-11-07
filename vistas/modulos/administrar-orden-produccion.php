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
      
      Administrar O.T.P
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar O.T.P</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
        <a href="orden-produccion">
          <button class="btn btn-primary">
            Crear Orden de Producción
          </button>
        </a>
      </div>

      <div class="box-header with-border">
      <div class="input-group">
          <button type="button" class="btn btn-default" id="#">         
            <span>
              <i class="fa fa-calendar"></i> 
              <?php
                if(isset($_GET["fechaInicial"])){
                  echo $_GET["fechaInicial"]." - ".$_GET["fechaFinal"];                
                }else{               
                  echo 'Rango de fecha';
                }
              ?>
            </span>
            <i class="fa fa-caret-down"></i>
          </button>
        </div>
      

      <div class="box-tools pull-right" style="margin-bottom:5px">

          <a href="#">
            <button class="btn btn-success" style="margin-top:5px">Descargar Oreden de Producción</button>
          </a>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive  tablas" width="100%">
         
        <thead>
         
        <tr>
           
           <th>Folio</th>
           <th>Tipo de orden</th>
           <th>Emisión</th>
           <th>Unidad de Negocio</th>
           <th>Bodega</th>
           <th>Cliente</th>
           <th>Nombre Orden</th>
           <th>Acciones</th>
         </tr> 

        </thead>

        <tbody>
        
        <?php

          $item = null;
          $valor = null;
          
          $ordenesProduccion = ControladorOrdenProduccion::ctrMostrarOrdenesProduccion($item, $valor);
          
          $centros = ControladorCentros::ctrMostrarCentros($item, $valor);
          $bodegas = ControladorBodegas::ctrMostrarBodegas($item, $valor);
          $clientes = ControladorClientes::ctrMostrarClientes($item, $valor);
          $negocios = ControladorNegocios::ctrMostrarNegocios($item,$valor);

          

            // Iterar sobre las órdenes de producción
foreach ($ordenesProduccion as $key => $orden) {
  $negocio = '';
  $centro = '';
  $bodega = '';
  $cliente = '';

              // Buscar y asignar el nombre de la unidad de negocio
              foreach ($negocios as $neg) {
                  if ($neg["id"] == $orden["id_unidad_negocio"]) {
                      $negocio = $neg["unidad_negocio"];
                      break;
                  }
              }

              // Buscar y asignar el nombre del centro de costo
              foreach ($centros as $cen) {
                  if ($cen["id"] == $orden["centro_costo"]) {
                      $centro = $cen["centro"];
                      break;
                  }
              }

              // Buscar y asignar el nombre de la bodega
              foreach ($bodegas as $bod) {
                  if ($bod["id"] == $orden["bodega_destino"]) {
                      $bodega = $bod["nombre"];
                      break;
                  }
              }

              // Buscar y asignar el nombre del cliente
              foreach ($clientes as $cli) {
                  if ($cli["id"] == $orden["id_cliente"]) {
                      $cliente = $cli["nombre"];
                      break;
                  }
              }
              
            

              echo '<tr>


                    <td>'.$orden["folio_orden_produccion"].'</td>

                    <td style="font-weight:bold;font-size:15px;color:black;">'.$orden["tipo_orden"].'</td>

                    <td>'.$orden["fecha_emision"].'</td>

                    <td>'.$centro.'</td>

                    <td>'.$bodega.'</td>      

                    <td>'.$cliente.'</td>

                    <td>'.$orden["nombre_orden"].'</td>

                    <td>

                    <div class="btn-group">';

                      if($_SESSION["perfil"] == "Administrador"){
                     echo' 
                     <button class="btn btn-warning btnEditarOrdenProduccion" idOrdenProduccion="'.$orden["id"].'"><i class="fa fa-pencil"></i></button>
                     <button class="btn btn-danger btnEliminarOrdenProduccion" idOrdenProduccion="'.$orden["id"].'"><i class="fa fa-times"></i></button>';
                    }

                    echo '</div>  

                  </td>


                  </tr>';
          
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




