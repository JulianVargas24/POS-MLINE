<?php

require_once "../../controladores/orden-produccion.controlador.php";
require_once "../../modelos/orden-produccion.modelo.php";

require_once "../../controladores/clientes.controlador.php";
require_once "../../modelos/clientes.modelo.php";

require_once "../../controladores/bodegas.controlador.php";
require_once "../../modelos/bodegas.modelo.php";

$reporte = new ControladorOrdenProduccion();
$reporte -> ctrDescargarReporteOrdenProduccion();