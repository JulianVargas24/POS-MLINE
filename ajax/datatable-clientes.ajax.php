<?php
require_once "../controladores/clientes.controlador.php";
require_once "../modelos/clientes.modelo.php";

class TablaClientes
{
  private function accionBotonSeleccionar($cliente)
  {
    return "<div class='btn-group'>
      <button class='btn btn-primary btnSeleccionarCliente' 
        idCliente='{$cliente["id"]}' 
        nombreCliente='{$cliente["nombre"]}' 
        rutCliente='{$cliente["rut"]}' 
        direccionCliente='{$cliente["direccion"]}' 
        actividadCliente='{$cliente["actividad"]}' 
        ejecutivoCliente='{$cliente["ejecutivo"]}' 
        telefonoCliente='{$cliente["telefono"]}' 
        emailCliente='{$cliente["email"]}'>
        Seleccionar
      </button>
    </div>";
  }

  private function formatearDatosCliente($cliente)
  {
    return [
      $cliente["nombre"],
      $cliente["rut"],
      $cliente["actividad"],
      $this->accionBotonSeleccionar($cliente)
    ];
  }

  public function mostrarTablaClientes()
  {
    $tipoOrden = $_GET['tipoOrden'] ?? "";

    if ($tipoOrden === 'Cliente con Cotización') {
      // Consulta para clientes con cotizaciones
      $stmt = Conexion::conectar()->prepare("
        SELECT DISTINCT c.*
        FROM clientes c
        INNER JOIN (
          SELECT id_cliente FROM cotizaciones
          UNION
          SELECT id_cliente FROM cotizaciones_exentas
        ) AS cot ON c.id = cot.id_cliente
      ");
    } else {
      // Consulta para todos los clientes
      $stmt = Conexion::conectar()->prepare("
        SELECT * FROM clientes
      ");
    }

    $stmt->execute();
    $clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($clientes)) {
      echo '{"data": []}';
      return;
    }

    $datosJson = ["data" => []];
    foreach ($clientes as $cliente) {
      $datosJson["data"][] = $this->formatearDatosCliente($cliente);
    }

    echo json_encode($datosJson, JSON_UNESCAPED_UNICODE);
  }
}

$activarTablaClientes = new TablaClientes();
$activarTablaClientes->mostrarTablaClientes();
