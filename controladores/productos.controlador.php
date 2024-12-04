<?php

error_reporting(0);

class ControladorProductos
{

	/*=============================================
	MOSTRAR PRODUCTOS
	=============================================*/

	static public function ctrMostrarProductos($item, $valor, $orden)
	{

		$tabla = "productos";

		$respuesta = ModeloProductos::mdlMostrarProductos($tabla, $item, $valor, $orden);

		return $respuesta;
	}

	// Método en el controlador de productos
	static public function ctrMostrarProductosPredeterminado($item, $valor)
	{
		$tabla = "productos";

		// Si $item es null, no se hace filtro
		if ($item == null && $valor == null) {
			$respuesta = ModeloProductos::mdlMostrarProductosPredeterminado($tabla);
		} else {
			// Si se proporciona un filtro, se aplica
			$respuesta = ModeloProductos::mdlMostrarProductosPredeterminado($tabla, $item, $valor);
		}

		return $respuesta;
	}


	static public function ctrMostrarStockPorBodega()
	{
		if (isset($_POST["idBodega"])) {
			$bodega = $_POST["idBodega"];
			$producto = $_POST["idProducto"];

			$respuesta = ModeloProductos::mdlMostrarStockPorBodega($producto, $bodega);
			return  $respuesta;
		}
	}

	static public function ctrMostrarProductoPorId()
	{
		if (isset($_POST["idProducto"])) {

			$producto = $_POST["idProducto"];

			$respuesta = ModeloProductos::mdlMostrarProductoPorId($producto);
			return $respuesta;
		}
	}

	static public function ctrMostrarProductosPorBodega()
	{
		$bodegas = ModeloBodegas::mdlMostrarBodegas("bodegas", null, null);
		$productos = ModeloProductos::mdlMostrarProductos("productos", null, null, "id");

		$data = [];
		foreach ($bodegas as $index => $bodega) {
			$data[] = [
				"bodega" => $bodega["nombre"],
				"productos" => []
			];
			foreach ($productos as $producto) {
				$stock = ModeloProductos::mdlMostrarStockPorBodega($producto["id"], $bodega["id"]);
				$stock = ($stock > 0) ? $stock : 0;
				$data[$index]["productos"][] = [
					"producto" => $producto["descripcion"],
					"stock" => $stock,
					"id" => $producto["id"],
					"stock_alerta" => $producto["stock_alerta"],
					"stock_min" => $producto["stock_min"]
				];
			}
		}

		return $data;
	}


    /*=============================================
    CREAR PRODUCTO
    =============================================*/

	static public function ctrCrearProducto()
	{

		if (isset($_POST["nuevaDescripcion"])) {



			/*=============================================
				VALIDAR IMAGEN
				=============================================*/

			$ruta = "vistas/img/productos/default/anonymous.png";

			if (isset($_FILES["nuevaImagen"]["tmp_name"])) {

				list($ancho, $alto) = getimagesize($_FILES["nuevaImagen"]["tmp_name"]);

				$nuevoAncho = 500;
				$nuevoAlto = 500;

				/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
					=============================================*/

				$directorio = "vistas/img/productos/" . $_POST["nuevoCodigo"];

				mkdir($directorio, 0755);

				/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

				if ($_FILES["nuevaImagen"]["type"] == "image/jpeg") {

					/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

					$aleatorio = mt_rand(100, 999);

					$ruta = "vistas/img/productos/" . $_POST["nuevoCodigo"] . "/" . $aleatorio . ".jpg";

					$origen = imagecreatefromjpeg($_FILES["nuevaImagen"]["tmp_name"]);

					$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

					imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

					imagejpeg($destino, $ruta);
				}

				if ($_FILES["nuevaImagen"]["type"] == "image/png") {

					/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

					$aleatorio = mt_rand(100, 999);

					$ruta = "vistas/img/productos/" . $_POST["nuevoCodigo"] . "/" . $aleatorio . ".png";

					$origen = imagecreatefrompng($_FILES["nuevaImagen"]["tmp_name"]);

					$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

					imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

					imagepng($destino, $ruta);
				}
			}

			$tabla = "productos";

			$datos = array(
				"id_categoria" => $_POST["nuevaCategoria"],
				"codigo" => $_POST["nuevoCodigo"],
				"descripcion" => $_POST["nuevaDescripcion"],
				"stock" => $_POST["nuevoStock"],
				"stock_alerta" => $_POST["nuevoStockAlerta"],
				"stock_min" => $_POST["nuevoStockMin"],
				"precio_compra" => $_POST["nuevoPrecioCompra"],
				"precio_venta" => $_POST["nuevoPrecioVenta"],
				"id_bodega" => $_POST["nuevaBodega"],
				"id_subcategoria" => $_POST["nuevaSubcategoria"],
				"id_medida" => $_POST["nuevaMedida"],
				"id_rubro" => $_POST["nuevoRubro"],
				"tipo_producto" => $_POST["nuevoTipoProducto"],
				"imagen" => $ruta
			);

			$respuesta = ModeloProductos::mdlIngresarProducto($tabla, $datos);

			if ($respuesta == "ok") {

				echo '<script>
					
						swal({
							  type: "success",
							  title: "El producto ha sido guardado correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

										window.location = "productos";

										}
									})

						</script>';
			}
		}
	}

    /*=============================================
    EDITAR PRODUCTO
    =============================================*/

	static public function ctrEditarProducto()
	{

		if (isset($_POST["editarDescripcion"])) {

			$tabla = "productos";

			$datos = array(
				"id_categoria" => $_POST["editarCategoria"],
				"id" => $_POST["editarProducto"],
				"id_subcategoria" => $_POST["editarSubcategoria"],
				"id_bodega" => $_POST["editarBodega"],
				"id_rubro" => $_POST["editarRubro"],
				"descripcion" => $_POST["editarDescripcion"],
				"stock" => $_POST["editarStock"],
				"stock_alerta" => $_POST["editarStockAlerta"],
				"stock_min" => $_POST["editarStockMin"],
				"precio_compra" => $_POST["editarPrecioCompra"],
				"precio_venta" => $_POST["editarPrecioVenta"],
				"id_medida" => $_POST["editarMedida"],
				"id_tabla_lista" => $_POST["editarTablaLista"]
			);

			$respuesta = ModeloProductos::mdlEditarProducto($tabla, $datos);

			if ($respuesta == "ok") {

				echo '<script>
							console.log("ID:' . $datos["id"] . '")
						swal({
							  type: "success",
							  title: "El producto ha sido editado correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

										window.location = "productos";

										}
									})

						</script>';
			}
		}
	}

	static public function ctrEditarPrecioProducto()
	{

		if (isset($_POST["idProducto"])) {

			$tabla = "productos";

			$datos = array(
				"id" => $_POST["idProducto"],
				"precio_venta" => $_POST["editarPrecioProducto"]
			);

			$respuesta = ModeloProductos::mdlEditarPrecioProducto($tabla, $datos);

			if ($respuesta == "ok") {

				echo '<script>
						swal({
							  type: "success",
							  title: "El precio del producto ha sido editado correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

										window.location = "lista-precios";

										}
									})

						</script>';
			}
		}
	}

	/*=============================================
	BORRAR PRODUCTO
	=============================================*/

	static public function ctrEliminarProducto()
	{

		if (isset($_GET["idProducto"])) {

			$tabla = "productos";
			$datos = $_GET["idProducto"];

			if ($_GET["imagen"] != "" && $_GET["imagen"] != "vistas/img/productos/default/anonymous.png") {

				unlink($_GET["imagen"]);
				rmdir('vistas/img/productos/' . $_GET["codigo"]);
			}

            }

            $respuesta = ModeloProductos::mdlEliminarProducto($tabla, $datos);

            if ($respuesta == "ok") {

                echo '<script>

				swal({
					  type: "success",
					  title: "El producto ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "productos";

								}
							})

				</script>';
			}
	}

	/*=============================================
    MOSTRAR SUMA VENTAS
    =============================================*/

	static public function ctrMostrarSumaVentas()
	{

        $tabla = "productos";

        $respuesta = ModeloProductos::mdlMostrarSumaVentas($tabla);

		return $respuesta;
	}

	static public function ctrDescargarReporteProductos()
	{

		if (isset($_GET["reporte"])) {

			$tabla = "productos";

			if (isset($_GET["fechaInicial"]) && isset($_GET["fechaFinal"])) {

				$ventas = ModeloVentas::mdlRangoFechasVentas($tabla, $_GET["fechaInicial"], $_GET["fechaFinal"]);
			} else {

				$item = null;
				$valor = null;
				$orden = "id";

				$productos = ModeloProductos::mdlMostrarProductos($tabla, $item, $valor, $orden);
			}


			/*=============================================
            CREAMOS EL ARCHIVO DE EXCEL
            =============================================*/

			$Name = $_GET["reporte"] . '-productos.xls';

			header('Expires: 0');
			header('Cache-control: private');
			header("Content-type: application/vnd.ms-excel"); // Archivo de Excel
			header("Cache-Control: cache, must-revalidate");
			header('Content-Description: File Transfer');
			header('Last-Modified: ' . date('D, d M Y H:i:s'));
			header("Pragma: public");
			header('Content-Disposition:; filename="' . $Name . '"');
			header("Content-Transfer-Encoding: binary");

			echo utf8_decode("<table border='0'> 

                    <tr> 
                    <td style='font-weight:bold; border:1px solid #eee;'>ID</td> 
                    <td style='font-weight:bold; border:1px solid #eee;'>DESCRIPCION</td>
					<td style='font-weight:bold; border:1px solid #eee;'>CATEGORIA</td>
					<td style='font-weight:bold; border:1px solid #eee;'>SUBCATEGORIA</td>
                    <td style='font-weight:bold; border:1px solid #eee;'>PRECIO COMPRA NETO</td>
                    <td style='font-weight:bold; border:1px solid #eee;'>PRECIO VENTA NETO</td>
                    <td style='font-weight:bold; border:1px solid #eee;'>TIPO PRODUCTO</td>

	
                    </tr>");

			foreach ($productos as $row => $item) {
				$categoria = ControladorCategorias::ctrMostrarCategorias("id", $item["id_categoria"]);
				if ($item["id_subcategoria"] == 0) {
					$subcategoria = "NO TIENE";
				} else {
					$subcategoria = ControladorSubcategorias::ctrMostrarSubcategorias("id", $item["id_subcategoria"]);
				}


				echo utf8_decode("<tr>
                        <td style='border:1px solid #eee;'>" . $item["id"] . "</td> 
                        <td style='border:1px solid #eee;'>" . $item["descripcion"] . "</td>
						<td style='border:1px solid #eee;'>" . $categoria["categoria"] . "</td>
						<td style='border:1px solid #eee;'>" . $subcategoria["subcategoria"] . "</td>
						<td style='border:1px solid #eee;'>" . $item["precio_compra"] . "</td>
						<td style='border:1px solid #eee;'>" . $item["precio_venta"] . "</td>
						<td style='border:1px solid #eee;'>" . $item["tipo_producto"] . "</td>

                        
	
		 			</tr>");
			}

			echo "</table>";
		}
	}
}
