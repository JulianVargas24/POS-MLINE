<?php

require_once "../../controladores/orden-vestuario.controlador.php";
require_once "../../modelos/orden-vestuario.modelo.php";

require_once "../../controladores/clientes.controlador.php";
require_once "../../modelos/clientes.modelo.php";

require_once "../../controladores/centros.controlador.php";
require_once "../../modelos/centros.modelo.php";

require_once "../../controladores/bodegas.controlador.php";
require_once "../../modelos/bodegas.modelo.php";

require_once "../../controladores/plantel.controlador.php";
require_once "../../modelos/plantel.modelo.php";

require_once "../../controladores/plazos.controlador.php";
require_once "../../modelos/plazos.modelo.php";

require_once "../../controladores/medios-pago.controlador.php";
require_once "../../modelos/medios-pago.modelo.php";

$reporte = new ControladorOrdenVestuario();
$reporte -> ctrDescargarReporteVestuario();