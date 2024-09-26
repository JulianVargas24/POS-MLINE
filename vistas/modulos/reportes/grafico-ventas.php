<?php

$item = null;
$valor = null;
$orden = "id";


$categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);
$totalCategorias = count($categorias);

$clientes = ControladorClientes::ctrMostrarClientes($item, $valor);
$totalClientes = count($clientes);

$productos = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);
$totalProductos = count($productos);

$proveedores = ControladorProveedores::ctrMostrarProveedores($item, $valor, $orden);
$totalProveedores = count($proveedores);

$usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor, $orden);
$totalUsuarios = count($usuarios) - 1;

$bodegas = ControladorBodegas::ctrMostrarBodegas($item, $valor, $orden);
$totalBodegas = count($bodegas);

?>




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