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
        <a href="#">
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
           <th>Tipo DTE</th>
           <th>Emisión</th>
           <th>Unidad de Negocio</th>
           <th>Bodega</th>
           <th>Cliente</th>
           <th>Nombre Orden</th>
           <th>Observación</th>
           <th>Acciones</th>
         </tr> 

        </thead>

        <tbody>
        
        <?php

          $item = null;
          $valor = null;
          //var_dump($item, $valor);
          $vestuario = ControladorOrdenVestuario::ctrMostrarOrdenVestuario($item, $valor);
          //var_dump($vestuario);
          $centros = ControladorCentros::ctrMostrarCentros($item, $valor);
          $bodegas = ControladorBodegas::ctrMostrarBodegas($item, $valor);
          $clientes = ControladorClientes::ctrMostrarClientes($item, $valor);
          $plazos = ControladorPlazos::ctrMostrarPlazos($item,$valor);
          $medios = ControladorMediosPago::ctrMostrarMedios($item,$valor);
          $negocios = ControladorNegocios::ctrMostrarNegocios($item,$valor);

          //var_dump($negocios, $centros, $bodegas, $clientes);

            foreach ($vestuario as $key => $value) {
              for($i = 0; $i < count($negocios); ++$i){
                if ($negocios[$i]["id"] == $value["id_unidad_negocio"]) {
                  $negocio = $negocios[$i]["unidad_negocio"];
                }
              }
              for($i = 0; $i < count($centros); ++$i){
                if ($centros[$i]["id"] == $value["id_centro"]) {
                  $centro = $centros[$i]["centro"];
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
              
            

              echo '<tr>


                    <td>'.$value["codigo"].'</td>

                    <td style="color:black;font-weight:bold;">Orden de Vestuario</td>

                    <td>'.$value["fecha_emision"].'</td>

                    <td>'.$centro.'</td>

                    <td>'.$bodega.'</td>      

                    <td>'.$cliente.'</td>

                    <td>'.$value["nombre_orden"].'</td>

                    <td>'.$value["observacion"].'</td>


                    <td>

                    <div class="btn-group">
                      <button disabled class="btn btn-success btnImprimirTicket" codigoVenta="'.$value["codigo"].'">

                      Ticket

                      </button>
                        
                      <button disabled class="btn btn-info btnImprimirFactura" codigoVenta="'.$value["codigo"].'">

                      PDF

                      </button>';

                      if($_SESSION["perfil"] == "Administrador"){
                     echo' 
                     <button class="btn btn-warning btnEditarOrdenVestuario" idOrdenVestuario="'.$value["id"].'"><i class="fa fa-pencil"></i></button>
                     <button class="btn btn-danger btnEliminarOrdenVestuario" idOrdenVestuario="'.$value["id"].'"><i class="fa fa-times"></i></button>';


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




