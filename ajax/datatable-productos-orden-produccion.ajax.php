<?php
require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

require_once "../controladores/tabla-listas.controlador.php";
require_once "../modelos/tabla-listas.modelo.php";

class TablaProduccion
{
	private function obtenerTablaLista($idTablaLista)
	{
		$tablaLista = ControladorTablaListas::ctrMostrarTablaListas("id", $idTablaLista);
		return $tablaLista ? $tablaLista["nombre"] : "No definido";
	}

	private function accionBotonAgregar($producto)
	{
		return "<div class='btn-group'>
			<button type='button' 
				class='btn btn-primary agregarProducto recuperarBoton' 
				idProducto='{$producto["id"]}' 
				nombreProducto='{$producto["descripcion"]}'
				precioCompra='{$producto["precio_compra"]}'
				idMedida='{$producto["id_medida"]}'>
				Agregar
			</button>
		</div>";
	}

	private function filtrarProductosPorTipo($productos, $tipoProduccion)
	{
		return array_filter($productos, function ($producto) use ($tipoProduccion) {
			$nombreTablaLista = $this->obtenerTablaLista($producto["id_tabla_lista"]);
			return $nombreTablaLista === $tipoProduccion;
		});
	}

	private function formatearDatosProducto($producto, $index)
	{
		return [
			$index + 1,
			"<img src='{$producto["imagen"]}' width='40px'>",
			$producto["codigo"],
			$producto["descripcion"],
			$this->obtenerTablaLista($producto["id_tabla_lista"]),
			$producto["precio_compra"],
			$this->accionBotonAgregar($producto)
		];
	}

	public function mostrarTablaProduccion()
	{
		$productos = ControladorProductos::ctrMostrarProductos(null, null, "id");
		$tipoProduccion = $_GET["tipoProduccion"] ?? "Producto";

		$productosFiltrados = $this->filtrarProductosPorTipo($productos, $tipoProduccion);

		if (empty($productosFiltrados)) {
			echo '{"data": []}';
			return;
		}

		$datosJson = ["data" => []];
		foreach ($productosFiltrados as $index => $producto) {
			$datosJson["data"][] = $this->formatearDatosProducto($producto, $index);
		}

		echo json_encode($datosJson, JSON_UNESCAPED_UNICODE);
	}
}

$activarProduccion = new TablaProduccion();
$activarProduccion->mostrarTablaProduccion();
