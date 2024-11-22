<?php
require_once "../controladores/cotizacion.controlador.php";
require_once "../modelos/cotizacion.modelo.php";

require_once "../controladores/clientes.controlador.php";
require_once "../modelos/clientes.modelo.php";

class TablaCotizacionesOrdenProduccion
{
  private function obtenerNombreCliente($idCliente)
  {
    $cliente = ControladorClientes::ctrMostrarClientes("id", $idCliente);
    return $cliente ? $cliente["nombre"] : "Cliente no encontrado";
  }

  private function accionBotonSeleccionar($cotizacion)
  {
    $tipoCotizacion = isset($cotizacion["tipo_cotizacion"]) ? $cotizacion["tipo_cotizacion"] : "afecta";

    return "<button class='btn btn-primary btnSeleccionarCotizacion' 
      idCotizacion='{$cotizacion["id"]}'
      tipoCotizacion='{$tipoCotizacion}'>
      Seleccionar
    </button>";
  }

  private function formatearDatosCotizacion($cotizacion)
  {
    $totalFinal = number_format(intval(str_replace(',', '', $cotizacion["total_final"])), 0, '', '.');

    $cotizacion["tipo_cotizacion"] = isset($cotizacion["tipo_cotizacion"]) ? $cotizacion["tipo_cotizacion"] : "afecta";

    return [
      $this->obtenerNombreCliente($cotizacion["id_cliente"]),
      $cotizacion["nombre_orden"],
      $cotizacion["codigo"],
      date('d/m/Y', strtotime($cotizacion["fecha_emision"])),
      date('d/m/Y', strtotime($cotizacion["fecha_vencimiento"])),
      "$" . $totalFinal,
      $cotizacion["tipo_dte"],
      $this->accionBotonSeleccionar($cotizacion)
    ];
  }

  public function mostrarTablaCotizaciones()
  {
    $idCliente = $_GET["idCliente"] ?? null;

    $cotizacionesAfectas = array_map(function ($cot) {
      $cot["tipo_cotizacion"] = "afecta";
      return $cot;
    }, ControladorCotizacion::ctrMostrarCotizaciones(null, null) ?? []);

    $cotizacionesExentas = array_map(function ($cot) {
      $cot["tipo_cotizacion"] = "exenta";
      return $cot;
    }, ControladorCotizacion::ctrMostrarCotizacionesExentas(null, null) ?? []);

    $todasLasCotizaciones = array_merge($cotizacionesAfectas, $cotizacionesExentas);

    $todasLasCotizaciones = array_filter($todasLasCotizaciones, function ($cotizacion) use ($idCliente) {
      $cumpleEstado = $cotizacion["estado"] === "Abierta";
      $cumpleCliente = !$idCliente || $cotizacion["id_cliente"] == $idCliente;
      return $cumpleEstado && $cumpleCliente;
    });

    if (empty($todasLasCotizaciones)) {
      echo '{"data": []}';
      return;
    }

    $datosJson = ["data" => []];
    foreach ($todasLasCotizaciones as $cotizacion) {
      $datosJson["data"][] = $this->formatearDatosCotizacion($cotizacion);
    }

    echo json_encode($datosJson, JSON_UNESCAPED_UNICODE);
  }
}

$activarCotizaciones = new TablaCotizacionesOrdenProduccion();
$activarCotizaciones->mostrarTablaCotizaciones();
