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
    
    <h1>
      
      Administrar Entradas
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar Entradas</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <a href="entradas">

          <button class="btn btn-primary">
            
           Crear Entrada

          </button>

        </a>


      </div>
     
       

      <div class="box-body">

      
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
       
        <thead>
         
         <tr>
           
           <th>Folio</th>
           <th>Movimiento</th>
           <th>Emision</th>
           <th>Bodega Destino</th>
           <th>Origen</th>
           <th>Observaciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

          $item = null;
          $valor = null;

          $entradas = ControladorEntradasInventario::ctrMostrarEntradas($item, $valor);
          $bodegas = ControladorBodegas::ctrMostrarBodegas($item, $valor);
          $plantel = ControladorPlantel::ctrMostrarPlantel($item, $valor);

            foreach ($entradas as $key => $value) {
                for($i = 0; $i < count($bodegas); ++$i){
                    if ($bodegas[$i]["id"] == $value["id_bodega_destino"]) {
                      $bodega = $bodegas[$i]["nombre"];
                    }
                  }
                  if($value["tipo_entrada"] == "Bodega a Bodega"){
                    for($i = 0; $i < count($bodegas); ++$i){
                        if ($bodegas[$i]["id"] == $value["valor_tipo_entrada"]) {
                          $origen = $bodegas[$i]["nombre"];
                        }
                      }
                  }else if($value["tipo_entrada"] == "Ingreso Manual a Bodega"){
                    for($i = 0; $i < count($plantel); ++$i){
                        if ($plantel[$i]["id"] == $value["valor_tipo_entrada"]) {
                          $origen = $plantel[$i]["nombre"];
                        }
                      }
                  }
            

              echo '<tr>


                    <td>'.$value["codigo"].'</td>

                    <td style="font-weight:bold;font-size:15px;color:black;">'.$value["tipo_entrada"].'</td>

                    <td>'.$value["fecha_emision"].'</td>

                    <td>'.$bodega.'</td>
                    
                    <td>'.$origen.'</td>

                    <td>'.$value["observaciones"].'</td>
                    


                  </tr>';
          
            }

            

           
        ?>
   
        </tbody>

       </table>
           

      </div>

    </div>

  </section>

</div>




