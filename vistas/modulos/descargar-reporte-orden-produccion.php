<?php

require_once "../../controladores/orden-produccion.controlador.php";
require_once "../../modelos/orden-produccion.modelo.php";

require_once "../../controladores/clientes.controlador.php";
require_once "../../modelos/clientes.modelo.php";

require_once "../../controladores/bodegas.controlador.php";
require_once "../../modelos/bodegas.modelo.php";

require_once "../../controladores/centros.controlador.php";
require_once "../../modelos/centros.modelo.php";

require_once "../../controladores/productos.controlador.php";
require_once "../../modelos/productos.modelo.php";

require_once "../../controladores/unidades.controlador.php";
require_once "../../modelos/unidades.modelo.php";

$reporte = new ControladorOrdenProduccion();
$reporte->ctrDescargarReporteOrdenProduccion();
