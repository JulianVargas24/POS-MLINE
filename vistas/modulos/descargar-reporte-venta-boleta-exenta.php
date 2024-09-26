<?php

require_once "../../controladores/venta-boleta.controlador.php";
require_once "../../modelos/venta-boleta.modelo.php";
require_once "../../controladores/ventas.controlador.php";
require_once "../../modelos/ventas.modelo.php";

require_once "../../controladores/clientes.controlador.php";
require_once "../../modelos/clientes.modelo.php";

require_once "../../controladores/negocios.controlador.php";
require_once "../../modelos/negocios.modelo.php";

require_once "../../controladores/bodegas.controlador.php";
require_once "../../modelos/bodegas.modelo.php";

require_once "../../controladores/plantel.controlador.php";
require_once "../../modelos/plantel.modelo.php";

require_once "../../controladores/plazos.controlador.php";
require_once "../../modelos/plazos.modelo.php";

require_once "../../controladores/medios-pago.controlador.php";
require_once "../../modelos/medios-pago.modelo.php";

$reporte = new ControladorVentaBoleta();
$reporte -> ctrDescargarReporteVentaBoletaExenta();