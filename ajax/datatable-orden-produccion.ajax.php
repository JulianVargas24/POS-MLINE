<?php
require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";
require_once "../controladores/categorias.controlador.php";
require_once "../modelos/categorias.modelo.php";
require_once "../controladores/rubros.controlador.php";
require_once "../modelos/rubros.modelo.php";

class TablaProduccion
{
	// Mostrar tabla de productos
	public function mostrarTablaProduccion()
	{
		$item = null;
		$valor = null;
		$orden = "id";

		$productos = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);

		// Verificar si hay productos
		if (count($productos) == 0) {
			echo '{"data": []}';
			return;
		}

		$datosJson = ["data" => []];

		foreach ($productos as $index => $producto) {
			// Imagen
			$imagen = "<img src='" . $producto["imagen"] . "' width='40px'>";

			// Botón para agregar producto a la orden de producción
			$botones = "<div class='btn-group'>
										<button type='button' 
														class='btn btn-primary agregarProducto recuperarBoton' 
														idProducto='" . $producto["id"] . "' 
														nombreProducto='" . $producto["descripcion"] . "'
														precioCompra='" . $producto["precio_compra"] . "'
														idMedida='" . $producto["id_medida"] . "'>Agregar
										</button>
            			</div>";

			// Agregar datos a la tabla
			$datosJson["data"][] = [
				$index + 1,
				$imagen,
				$producto["codigo"],
				$producto["descripcion"],
				$producto["precio_compra"],
				$botones
			];
		}

		// Convertir el array PHP a JSON
		echo json_encode($datosJson, JSON_UNESCAPED_UNICODE);
	}
}

// Activar tabla de producción
$activarProduccion = new TablaProduccion();
$activarProduccion->mostrarTablaProduccion();
