<?php

require_once "../../controladores/proveedores.controlador.php";
require_once "../../modelos/proveedores.modelo.php";


$reporte = new ControladorProveedores();
$reporte -> ctrDescargarReporteProveedores();