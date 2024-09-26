<?php

require_once "../../controladores/clientes.controlador.php";
require_once "../../modelos/clientes.modelo.php";


$reporte = new ControladorClientes();
$reporte -> ctrDescargarReporteCliente();