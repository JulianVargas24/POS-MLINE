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
      
      Administrar O.T
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar O.T</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">


        <a href="orden-vestuario">

          <button class="btn btn-primary">
            
            Crear orden de vestuario

          </button>

        </a>



      </div>

      <div class="box-tools pull-right" style="margin-bottom:5px">
          <a href="vistas/modulos/descargar-reporte-orden-vestuario.php?reporte=reporte">
            <button class="btn btn-success" style="margin-top:5px">Reporte Excel: orden de vestuario</button>
          </a>


      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive  tablas" width="100%">
         
        <thead>
         
        <tr>
           
           <th>Folio</th>
           <th>Tipo DTE</th>
           <th>Emisión</th>
           <th>Unidad de negocio</th>
           <th>Bodega</th>
           <th>Cliente</th>
           <th>Nombre orden</th>
           <th>Observación</th>

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

          $vestuario = ControladorOrdenVestuario::ctrMostrarOrdenVestuario($item, $valor);


          $centros = ControladorCentros::ctrMostrarCentros($item, $valor);
          $bodegas = ControladorBodegas::ctrMostrarBodegas($item, $valor);
          $clientes = ControladorClientes::ctrMostrarClientes($item, $valor);
          $plazos = ControladorPlazos::ctrMostrarPlazos($item,$valor);
          $medios = ControladorMediosPago::ctrMostrarMedios($item,$valor);


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




