<?php

$item = null;
$valor = null;
$orden = "id";
$fechaInicial = $_GET["fechaInicial"];
$fechaFinal = $_GET["fechaFinal"];
/**$ventas = ControladorVentas::ctrSumaTotalVentasPorFecha($fechaInicial, $fechaFinal);

$categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);
$totalCategorias = count($categorias);

$clientes = ControladorClientes::ctrMostrarClientes($item, $valor);$totalClientes = count($clientes);

$productos = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);
$totalProductos = count($productos);

$proveedores = ControladorProveedores::ctrMostrarProveedores($item, $valor, $orden);
$totalProveedores = count($proveedores);

$usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor, $orden);/$totalUsuarios = count($usuarios) - 1;

$bodegas = ControladorBodegas::ctrMostrarBodegas($item, $valor, $orden);
$totalBodegas = count($bodegas);**/
?>
<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Tablero
      
      <small>Panel de Control</small>
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Tablero</li>
    
    </ol>

  </section>
  <section class="content">

      <div class="row">
        
      <div class="col-lg-3 col-xs-6">

        <div class="small-box bg-aqua">
          
          <div class="inner">
            
            <h3>$<?php echo number_format($ventas,0); ?></h3>

            <p>Ventas</p>
            <p>Desde: <?php echo $fechaInicial; ?> -- Hasta: <?php echo $fechaFinal; ?></p>
          
          </div>
          
          <div class="icon">
            
            <i class="ion ion-social-usd"></i>
          
          </div>
          
          <a href="ventas" class="small-box-footer">
            
            Más info <i class="fa fa-arrow-circle-right"></i>
          
          </a>

        </div>

      </div>

    <div class="col-lg-3 col-xs-6">

    <div class="small-box bg-green">
      
      <div class="inner">
      
        <h3><?php echo number_format($totalCategorias); ?></h3>

        <p>Categorías</p>
      
      </div>
      
      <div class="icon">
      
        <i class="ion ion-clipboard"></i>
      
      </div>
      
      <a href="categorias" class="small-box-footer">
        
        Más info <i class="fa fa-arrow-circle-right"></i>
      
      </a>

    </div>

    </div>

    <div class="col-lg-3 col-xs-6">

    <div class="small-box bg-yellow">
      
      <div class="inner">
      
        <h3><?php echo number_format($totalClientes); ?></h3>

        <p>Clientes</p>

      </div>
      
      <div class="icon">
      
        <i class="ion ion-person-add"></i>
      
      </div>
      
      <a href="clientes" class="small-box-footer">

        Más info <i class="fa fa-arrow-circle-right"></i>

      </a>

    </div>

    </div>

    <div class="col-lg-3 col-xs-6">

    <div class="small-box bg-red">

      <div class="inner">
      
        <h3><?php echo number_format($totalProductos); ?></h3>

        <p>Productos</p>
      
      </div>
      
      <div class="icon">
        
        <i class="ion ion-ios-cart"></i>
      
      </div>
      
      <a href="productos" class="small-box-footer">
        
        Más info <i class="fa fa-arrow-circle-right"></i>
      
      </a>

    </div>

    </div>

        </div> 

        <div class="row">

      <div class="box-header with-border">
        <?php
        if($_SESSION["perfil"]=="Administrador")
        ?> 
        
          <div class="row" style="margin-bottom:5px;">
                                                  
            <div class="col-xs-2 col-md-2 col-lg-1">
                <div class="d-block" style="font-size:14px;">Desde:</div>
                <div class="form-group">
                    <div class="input-group">
                        
                        <input type="date" class="form-control input-sm" name="FechaInicio" id="FechaInicio" >
                    </div>
                </div>

            </div>
            <div class="col-xs-2 col-md-2 col-lg-1">
                <div class="d-block" style="font-size:14px;">Hasta:</div>
                <div class="form-group">
                    <div class="input-group">

                        <input type="date" class="form-control input-sm" name="FechaFin" id="FechaFin">
                    </div>
                </div>
            </div>
            <div class="col-xs-2 col-md-2 col-lg-1">
              
                <div class="form-group">
                    <div class="input-group">                    
                          <button style="margin-top:14px;"  class="btn btn-success btnGenerarVenta">GENERAR VENTAS</button>  
                    </div>
                </div>
            </div>
          
          </div>

          <!--
          <div class="box-tools pull-right">

              <?php

              if(isset($_GET["fechaInicial"])){

                echo '<a href="vistas/modulos/descargar-reporte.php?reporte=reporte&fechaInicial='.$_GET["fechaInicial"].'&fechaFinal='.$_GET["fechaFinal"].'">';

              }else{

                echo '<a href="vistas/modulos/descargar-reporte.php?reporte=reporte">';

              }         

              ?>
            
              <button class="btn btn-success" style="margin-top:5px">Descargar reporte en Excel</button>

              </a>

            </div> 
            -->
      
      </div>
    <!-- RANGO DE FECHA Y REPORTE DE EXCEL PRUEBA --> 

          
            <div class="col-lg-12">

            <div class="col-lg-3 col-xs-6">

    <div class="small-box bg-purple">
      
      <div class="inner">
      
        <h3><?php echo number_format($totalBodegas); ?></h3>

        <p>Bodegas</p>
      
      </div>
      
      <div class="icon">
      
        <i class="ion ion-clipboard"></i>
      
      </div>
      
      <a href="bodegas" class="small-box-footer">
        
        Más info <i class="fa fa-arrow-circle-right"></i>
      
      </a>

    </div>

    </div>

    <div class="col-lg-3 col-xs-6">

    <div class="small-box bg-blue">
      
      <div class="inner">
      
        <h3><?php echo number_format($totalUsuarios); ?></h3>

        <p>Usuarios</p>

      </div>
      
      <div class="icon">
      
        <i class="ion ion-person-add"></i>
      
      </div>
      
      <a href="usuarios" class="small-box-footer">

        Más info <i class="fa fa-arrow-circle-right"></i>

      </a>

    </div>

    </div>

    <div class="col-lg-3 col-xs-6">

    <div class="small-box bg-orange">

      <div class="inner">
      
        <h3><?php echo number_format($totalProveedores); ?></h3>

        <p>Proveedores</p>
      
      </div>
      
      <div class="icon">
        
        <i class="ion ion-ios-cart"></i>
      
      </div>
      
      <a href="proveedores" class="small-box-footer">
        
        Más info <i class="fa fa-arrow-circle-right"></i>
      
      </a>

    </div>

    </div>  

            </div>


            <div class="col-lg-6">

              <?php

              if($_SESSION["perfil"] =="Administrador"){
              
              include "inicio/productos-recientes.php";

            }

              ?>

            </div>

            <div class="col-lg-12">
              
              <?php

              if($_SESSION["perfil"] =="Especial" || $_SESSION["perfil"] =="Vendedor"){

                echo '<div class="box box-success">

                <div class="box-header">

                <h1>Bienvenid@ ' .$_SESSION["nombre"].'</h1>

                </div>

                </div>';

              }

              ?>

            </div>

        </div>

  </section>
 
</div>

<script>

$(document).ready(function() {
   $(".btnGenerarVenta").click(function(){
    var fechaInicial = $("#FechaInicio").val();
	var fechaFinal = $("#FechaFin").val();
  console.log("F fecha");
	window.location = "index.php?ruta=inicio&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;
   })
});
</script>