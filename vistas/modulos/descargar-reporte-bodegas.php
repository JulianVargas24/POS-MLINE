<?php


require_once "../../controladores/productos.controlador.php";
require_once "../../modelos/productos.modelo.php";

require_once "../../controladores/bodegas.controlador.php";
require_once "../../modelos/bodegas.modelo.php";

$reporte = new ControladorBodegas();
$reporte -> ctrDescargarReporteBodegas();