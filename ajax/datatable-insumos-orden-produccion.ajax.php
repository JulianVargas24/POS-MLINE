<?php
require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

require_once "../controladores/tabla-listas.controlador.php";
require_once "../modelos/tabla-listas.modelo.php";

class TablaInsumos
{
  private function obtenerTablaLista($idTablaLista)
  {
    $tablaLista = ControladorTablaListas::ctrMostrarTablaListas("id", $idTablaLista);
    return [
      'id' => $tablaLista["id"],
      'nombre' => $tablaLista ? $tablaLista["nombre"] : "No definido"
    ];
  }

  private function accionBotonAgregar($producto)
  {
    $tablaLista = $this->obtenerTablaLista($producto["id_tabla_lista"]);
    return "<div class='btn-group'>
      <button type='button' 
        class='btn btn-primary agregarInsumo recuperarBoton' 
        idProducto='{$producto["id"]}' 
        nombreProducto='{$producto["descripcion"]}'
        precioCompra='{$producto["precio_compra"]}'
        idMedida='{$producto["id_medida"]}'
        idTablaLista='{$tablaLista['id']}'>
        Agregar
      </button>
    </div>";
  }

  private function filtrarInsumosPorTipo($productos)
  {
    return array_filter($productos, function ($producto) {
      $tablaLista = $this->obtenerTablaLista($producto["id_tabla_lista"]);
      return in_array($tablaLista['nombre'], ["Mix", "Embalaje"]);
    });
  }

  private function formatearDatosInsumo($producto, $index)
  {
    $tablaLista = $this->obtenerTablaLista($producto["id_tabla_lista"]);
    return [
      $index + 1,
      "<img src='{$producto["imagen"]}' width='40px'>",
      $producto["codigo"],
      $producto["descripcion"],
      $tablaLista['nombre'],
      $producto["precio_compra"],
      $this->accionBotonAgregar($producto)
    ];
  }

  public function mostrarTablaInsumos()
  {
    $productos = ControladorProductos::ctrMostrarProductos(null, null, "id");

    $insumosFiltrados = $this->filtrarInsumosPorTipo($productos);

    if (empty($insumosFiltrados)) {
      echo '{"data": []}';
      return;
    }

    $datosJson = ["data" => []];
    foreach ($insumosFiltrados as $index => $producto) {
      $datosJson["data"][] = $this->formatearDatosInsumo($producto, $index);
    }

    echo json_encode($datosJson, JSON_UNESCAPED_UNICODE);
  }
}

$activarInsumos = new TablaInsumos();
$activarInsumos->mostrarTablaInsumos();
