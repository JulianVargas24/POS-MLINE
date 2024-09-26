
<?php

require_once "../../controladores/compra.controlador.php";
require_once "../../modelos/compra.modelo.php";

require_once "../../controladores/proveedores.controlador.php";
require_once "../../modelos/proveedores.modelo.php";

require_once "../../controladores/centros.controlador.php";
require_once "../../modelos/centros.modelo.php";

require_once "../../controladores/bodegas.controlador.php";
require_once "../../modelos/bodegas.modelo.php";

require_once "../../controladores/plazos.controlador.php";
require_once "../../modelos/plazos.modelo.php";

require_once "../../controladores/medios-pago.controlador.php";
require_once "../../modelos/medios-pago.modelo.php";

$reporte = new ControladorCompra();
$reporte -> ctrDescargarReporteCompra();