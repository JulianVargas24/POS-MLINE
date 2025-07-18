<?php


class ControladorCotizacion
{

	/*=============================================
	CREAR COTIZACION
	=============================================*/

	static public function ctrCrearCotizacion()
	{

		if (isset($_POST["nuevoCodigo"])) {

			$tabla = "cotizaciones";

			$datos = array(
				"codigo" => $_POST["nuevoCodigo"],
				"id_cliente" => $_POST["nuevoClienteCotizacion"],
				"id_vendedor" => $_POST["nuevoVendedor"],
				"fecha_emision" => $_POST["nuevaFechaEmision"],
				"fecha_vencimiento" => $_POST["nuevaFechaVencimiento"],
				"id_unidad_negocio" => $_POST["nuevoNegocio"],
				"id_bodega" => $_POST["nuevaBodega"],
				"subtotal" => $_POST["nuevoSubtotal"],
				"descuento" => $_POST["nuevoTotalDescuento"],
				"total_neto" => $_POST["nuevoTotalNeto"],
				"iva" => $_POST["nuevoTotalIva"],
				"total_final" => $_POST["nuevoTotalFinal"],
				"id_medio_pago" => $_POST["nuevoMedioPago"],
				"id_plazo_pago" => $_POST["nuevoPlazoPago"],
				"observacion" => $_POST["nuevaObservacion"],
				"productos" => $_POST["listaProductos"],
				"nombre_orden" => $_POST["nuevoNombreOrden"]
			);


			// Imprimir los datos antes de insertarlos
			/*echo '<pre>';
				var_dump($datos);
				echo '</pre>';
				exit; */ // Terminar la ejecución para que no se inserten los datos aún.

			$respuesta = ModeloCotizacion::mdlIngresarCotizacion($tabla, $datos);

			if ($respuesta == "ok") {

				echo '<script>
					swal({
						  type: "success",
						  title: "La Cotizacion afecta ha sido guardada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "cotizaciones";

									}
								})

					</script>';
			}
		}
	}

	static public function ctrCrearCotizacionExenta()
	{

		if (isset($_POST["nuevoCodigo"])) {

			$tabla = "cotizaciones_exentas";

			$datos = array(
				"codigo" => $_POST["nuevoCodigo"],
				"id_cliente" => $_POST["nuevoClienteCotizacion"],
				"id_vendedor" => $_POST["nuevoVendedor"],
				"fecha_emision" => $_POST["nuevaFechaEmision"],
				"fecha_vencimiento" => $_POST["nuevaFechaVencimiento"],
				"id_unidad_negocio" => $_POST["nuevoNegocio"],
				"id_bodega" => $_POST["nuevaBodega"],
				"subtotal" => $_POST["nuevoSubtotal"],
				"descuento" => $_POST["nuevoTotalDescuento"],
				"exento" => $_POST["nuevoTotalExento"],
				"iva" => $_POST["nuevoTotalIva"],
				"total_final" => $_POST["nuevoTotalFinal"],
				"id_medio_pago" => $_POST["nuevoMedioPago"],
				"id_plazo_pago" => $_POST["nuevoPlazoPago"],
				"observacion" => $_POST["nuevaObservacion"],
				"productos" => $_POST["listaProductos"],
				"nombre_orden" => $_POST["nuevoNombreOrden"]
			);


			$respuesta = ModeloCotizacion::mdlIngresarCotizacionExenta($tabla, $datos);

			if ($respuesta == "ok") {

				echo '<script>
			 swal({
				   type: "success",
				   title: "La Cotizacion Exenta ha sido guardada correctamente",
				   showConfirmButton: true,
				   confirmButtonText: "Cerrar"
				   }).then(function(result){
							 if (result.value) {

							 window.location = "cotizaciones";

							 }
						 })

			 </script>';
			}
		}
	}


	static public function ctrEditarCotizacion()
	{
		if (isset($_POST["nuevoCodigo"])) {

			$tabla = "cotizaciones";

			$datos = array(
				"id" => $_POST["idCotizacion"],
				"codigo" => $_POST["nuevoCodigo"],
				"id_cliente" => $_POST["nuevoClienteCotizacion"],
				"fecha_emision" => $_POST["nuevaFechaEmision"],
				"fecha_vencimiento" => $_POST["nuevaFechaVencimiento"],
				"id_unidad_negocio" => $_POST["nuevoNegocio"],
				"id_bodega" => $_POST["nuevaBodega"],
				"subtotal" => $_POST["nuevoSubtotal"],
				"descuento" => $_POST["nuevoTotalDescuento"],
				"total_neto" => $_POST["nuevoTotalNeto"],
				"iva" => $_POST["nuevoTotalIva"],
				"total_final" => $_POST["nuevoTotalFinal"],
				"id_medio_pago" => $_POST["nuevoMedioPago"],
				"id_plazo_pago" => $_POST["nuevoPlazoPago"],
				"observacion" => $_POST["nuevaObservacion"],
				"productos" => $_POST["listaProductos"],
				"nombre_orden" => $_POST["editarNombreOrden"]
			);


			$respuesta = ModeloCotizacion::mdlEditarCotizacion($tabla, $datos);

			if ($respuesta == "ok") {

				echo '<script>
			 swal({
				   type: "success",
				   title: "La Cotizacion afecta ha sido actualizada correctamente",
				   showConfirmButton: true,
				   confirmButtonText: "Cerrar"
				   }).then(function(result){
							 if (result.value) {

							 window.location = "cotizaciones";

							 }
						 })

			 </script>';
			}
		}
	}

	static public function ctrEditarCotizacionExenta()
	{
		if (isset($_POST["nuevoCodigo"])) {

			$tabla = "cotizaciones_exentas";

			$datos = array(
				"codigo" => $_POST["nuevoCodigo"],
				"id_cliente" => $_POST["nuevoClienteCotizacion"],
				"id_vendedor" => $_POST["nuevoVendedor"],
				"fecha_emision" => $_POST["nuevaFechaEmision"],
				"fecha_vencimiento" => $_POST["nuevaFechaVencimiento"],
				"id_unidad_negocio" => $_POST["nuevoNegocio"],
				"id_bodega" => $_POST["nuevaBodega"],
				"subtotal" => $_POST["nuevoSubtotal"],
				"descuento" => $_POST["nuevoTotalDescuento"],
				"exento" => $_POST["nuevoTotalExento"],
				"iva" => $_POST["nuevoTotalIva"],
				"total_final" => $_POST["nuevoTotalFinal"],
				"id_medio_pago" => $_POST["nuevoMedioPago"],
				"id_plazo_pago" => $_POST["nuevoPlazoPago"],
				"observacion" => $_POST["nuevaObservacion"],
				"productos" => $_POST["listaProductos"],
				"nombre_orden" => $_POST["editarNombreOrden"]
			);


			$respuesta = ModeloCotizacion::mdlEditarCotizacionExenta($tabla, $datos);

			if ($respuesta == "ok") {

				echo '<script>
			 swal({
				   type: "success",
				   title: "La Cotizacion exenta ha sido actualizada correctamente",
				   showConfirmButton: true,
				   confirmButtonText: "Cerrar"
				   }).then(function(result){
							 if (result.value) {

							 window.location = "cotizaciones";

							 }
						 })

			 </script>';
			}
		}
	}

	static public function ctrMostrarCotizaciones($item, $valor)
	{
		$tabla = "cotizaciones";

		// Obtener fechas desde la URL
		$fechaInicial = isset($_GET["fechaInicial"]) ? $_GET["fechaInicial"] : null;
		$fechaFinal = isset($_GET["fechaFinal"]) ? $_GET["fechaFinal"] : null;

		// Llamar a la función del modelo para obtener cotizaciones
		return ModeloCotizacion::mdlMostrarCotizaciones($tabla, $item, $valor, $fechaInicial, $fechaFinal);
	}

	static public function ctrMostrarCotizacionesExentas($item, $valor)
	{

		$tabla = "cotizaciones_exentas";
		// Obtener fechas desde la URL
		$fechaInicial = isset($_GET["fechaInicial"]) ? $_GET["fechaInicial"] : null;
		$fechaFinal = isset($_GET["fechaFinal"]) ? $_GET["fechaFinal"] : null;

		// Llamar a la función del modelo para obtener cotizaciones
		return ModeloCotizacion::mdlMostrarCotizaciones($tabla, $item, $valor, $fechaInicial, $fechaFinal);
		//$respuesta = ModeloCotizacion::mdlMostrarCotizaciones($tabla, $item, $valor);

		//return $respuesta;

	}

	static public function ctrEliminarCotizacion()
	{

		if (isset($_GET["idCotizacion"])) {

			$tabla = "cotizaciones";
			$datos = $_GET["idCotizacion"];

			$respuesta = ModeloCotizacion::mdlEliminarCotizacion($tabla, $datos);

			if ($respuesta == "ok") {

				echo '<script>

				swal({
					  type: "success",
					  title: "La Cotizacion afecta ha sido borrada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result){
								if (result.value) {

								window.location = "cotizaciones";

								}
							})

				</script>';
			}
		}
	}
	static public function ctrEliminarCotizacionExenta()
	{

		if (isset($_GET["idCotizacion"])) {

			$tabla = "cotizaciones_exentas";
			$datos = $_GET["idCotizacion"];

			$respuesta = ModeloCotizacion::mdlEliminarCotizacionExenta($tabla, $datos);

			if ($respuesta == "ok") {

				echo '<script>

				swal({
					  type: "success",
					  title: "La Cotizacion exenta ha sido borrada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result){
								if (result.value) {

								window.location = "cotizaciones";

								}
							})

				</script>';
			}
		}
	}

	public function ctrDescargarReporteCotizacion()
	{

		if (isset($_GET["reporte"])) {

			$tabla = "cotizaciones";

			// Obtener las fechas de la URL
			$fechaInicial = isset($_GET["fechaInicial"]) ? $_GET["fechaInicial"] : null;
			$fechaFinal = isset($_GET["fechaFinal"]) ? $_GET["fechaFinal"] : null;

			// Obtener las cotizaciones del modelo
			$cotizaciones = ModeloCotizacion::mdlMostrarCotizaciones($tabla, null, null, $fechaInicial, $fechaFinal);

			/*=============================================
			CREAMOS EL ARCHIVO DE EXCEL DE COTIZACION AFECTA
			=============================================*/

			// Nombre del archivo incluyendo fechas si están disponibles
			$Name = ucfirst($_GET["reporte"]) . ' de cotizaciones afectas';
			if ($fechaInicial && $fechaFinal) {
				$Name .= ' (' . $fechaInicial . ' al ' . $fechaFinal . ')';
			}
			$Name .= '.xls';

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
					<td style='font-weight:bold; border:1px solid #eee;'>FOLIO</td> 
					<td style='font-weight:bold; border:1px solid #eee;'>CLIENTE</td>
					<td style='font-weight:bold; border:1px solid #eee;'>VENDEDOR</td>
					<td style='font-weight:bold; border:1px solid #eee;'>BODEGA</td>
					<td style='font-weight:bold; border:1px solid #eee;'>ID PRODUCTO</td>
					<td style='font-weight:bold; border:1px solid #eee;'>CANTIDAD</td>
					<td style='font-weight:bold; border:1px solid #eee;'>PRODUCTOS</td>
					<td style='font-weight:bold; border:1px solid #eee;'>PRECIO PRODUCTO</td>
					<td style='font-weight:bold; border:1px solid #eee;'>METODO DE PAGO</td>
					<td style='font-weight:bold; border:1px solid #eee;'>SUBTOTAL</td>
					<td style='font-weight:bold; border:1px solid #eee;'>DESCUENTO</td>	
					<td style='font-weight:bold; border:1px solid #eee;'>TOTAL NETO</td>	
					<td style='font-weight:bold; border:1px solid #eee;'>IVA</td>
					<td style='font-weight:bold; border:1px solid #eee;'>TOTAL FINAL</td>			
					<td style='font-weight:bold; border:1px solid #eee;'>FECHA EMISION</td>		
					</tr>");

			foreach ($cotizaciones as $row => $item) {

				$cliente = ControladorClientes::ctrMostrarClientes("id", $item["id_cliente"]);
				$vendedor = ControladorPlantel::ctrMostrarPlantel("id", $item["id_vendedor"]);
				$bodega = ControladorBodegas::ctrMostrarBodegas("id", $item["id_bodega"]);
				$plazos = ControladorPlazos::ctrMostrarPlazos("id", $item["id_plazo_pago"]);
				$medios = ControladorMediosPago::ctrMostrarMedios("id", $item["id_medio_pago"]);
				$negocio = ControladorNegocios::ctrMostrarNegocios("id", $item["id_unidad_negocio"]);

				$clienteNombre = isset($cliente["nombre"]) ? $cliente["nombre"] : "No disponible";

				echo utf8_decode("<tr>
			 			<td style='border:1px solid #eee;'>" . $item["codigo"] . "</td> 
			 			<td style='border:1px solid #eee;'>" . $clienteNombre . "</td>
						 <td style='border:1px solid #eee;'>" . $vendedor["nombre"] . "</td>
						 <td style='border:1px solid #eee;'>" . $bodega["nombre"] . "</td>
						
						 <td style='border:1px solid #eee;'>");

				$productos =  json_decode($item["productos"], true);

				foreach ($productos as $key => $valueProductos) {

					echo utf8_decode($valueProductos["id"] . "<br>");
				}
				echo utf8_decode("</td><td style='border:1px solid #eee;'>");

				foreach ($productos as $key => $valueProductos) {

					echo utf8_decode($valueProductos["cantidad"] . "<br>");
				}

				echo utf8_decode("</td><td style='border:1px solid #eee;'>");

				foreach ($productos as $key => $valueProductos) {

					echo utf8_decode($valueProductos["descripcion"] . "<br>");
				}

				echo utf8_decode("</td><td style='border:1px solid #eee;'> $ ");

				foreach ($productos as $key => $valueProductos) {

					echo number_format($valueProductos["precio"], 0,  '', '.') . "<br>";
				}

				echo utf8_decode("</td>
					 <td style='border:1px solid #eee;'>" . $medios["medio_pago"] . "</td>
					<td style='border:1px solid #eee;'> $ " . number_format(intval(str_replace(',', '', $item["subtotal"])), 0,  '', '.') . "</td>
					<td style='border:1px solid #eee;'> $ " . number_format(intval(str_replace(',', '', $item["descuento"])), 0,  '', '.') . "</td>	
					<td style='border:1px solid #eee;'> $ " . number_format(intval(str_replace(',', '', $item["total_neto"])), 0,  '', '.') . "</td>	
					<td style='border:1px solid #eee;'> $ " . number_format(intval(str_replace(',', '', $item["iva"])), 0,  '', '.') . "</td>	
					<td style='border:1px solid #eee;'> $ " . number_format(intval(str_replace(',', '', $item["total_final"])), 0,  '', '.') . "</td>
					<td style='border:1px solid #eee;'>" . substr($item["fecha_emision"], 0, 10) . "</td>		
		 			</tr>");
			}


			echo "</table>";
		}
	}

	public function ctrDescargarReporteCotizacionExenta()
	{

		if (isset($_GET["reporte"])) {

			$tabla = "cotizaciones_exentas";

			// Obtener las fechas de la URL
			$fechaInicial = isset($_GET["fechaInicial"]) ? $_GET["fechaInicial"] : null;
			$fechaFinal = isset($_GET["fechaFinal"]) ? $_GET["fechaFinal"] : null;

			// Obtener las cotizaciones del modelo
			$cotizaciones = ModeloCotizacion::mdlMostrarCotizaciones($tabla, null, null, $fechaInicial, $fechaFinal);

			/*=============================================
			CREAMOS EL ARCHIVO DE EXCEL DE COTIZACION EXENTA
			=============================================*/

			// Nombre del archivo incluyendo fechas si están disponibles
			$Name = ucfirst($_GET["reporte"]) . ' de cotizaciones exentas';
			if ($fechaInicial && $fechaFinal) {
				$Name .= ' (' . $fechaInicial . ' al ' . $fechaFinal . ')';
			}
			$Name .= '.xls';

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
					<td style='font-weight:bold; border:1px solid #eee;'>FOLIO</td> 
					<td style='font-weight:bold; border:1px solid #eee;'>CLIENTE</td>
					<td style='font-weight:bold; border:1px solid #eee;'>VENDEDOR</td>
					<td style='font-weight:bold; border:1px solid #eee;'>BODEGA</td>
					<td style='font-weight:bold; border:1px solid #eee;'>ID PRODUCTO</td>
					<td style='font-weight:bold; border:1px solid #eee;'>CANTIDAD</td>
					<td style='font-weight:bold; border:1px solid #eee;'>PRODUCTOS</td>
					<td style='font-weight:bold; border:1px solid #eee;'>PRECIO PRODUCTO</td>
					<td style='font-weight:bold; border:1px solid #eee;'>METODO DE PAGO</td>
					<td style='font-weight:bold; border:1px solid #eee;'>SUBTOTAL</td>
					<td style='font-weight:bold; border:1px solid #eee;'>DESCUENTO</td>	
					<td style='font-weight:bold; border:1px solid #eee;'>EXENTO</td>	
					<td style='font-weight:bold; border:1px solid #eee;'>IVA</td>
					<td style='font-weight:bold; border:1px solid #eee;'>TOTAL FINAL</td>			
					<td style='font-weight:bold; border:1px solid #eee;'>FECHA EMISION</td>		
					</tr>");

			foreach ($cotizaciones as $row => $item) {

				$cliente = ControladorClientes::ctrMostrarClientes("id", $item["id_cliente"]);
				$vendedor = ControladorPlantel::ctrMostrarPlantel("id", $item["id_vendedor"]);
				$bodega = ControladorBodegas::ctrMostrarBodegas("id", $item["id_bodega"]);
				$plazos = ControladorPlazos::ctrMostrarPlazos("id", $item["id_plazo_pago"]);
				$medios = ControladorMediosPago::ctrMostrarMedios("id", $item["id_medio_pago"]);
				$negocio = ControladorNegocios::ctrMostrarNegocios("id", $item["id_unidad_negocio"]);


				// Verifica que los resultados no sean falsos
				$clienteNombre = isset($cliente["nombre"]) ? $cliente["nombre"] : "No disponible";
				$vendedorNombre = isset($vendedor["nombre"]) ? $vendedor["nombre"] : "No disponible";
				$bodegaNombre = isset($bodega["nombre"]) ? $bodega["nombre"] : "No disponible";
				$plazoNombre = isset($plazos["nombre"]) ? $plazos["nombre"] : "No disponible";
				$medioNombre = isset($medios["medio_pago"]) ? $medios["medio_pago"] : "No disponible";
				$negocioNombre = isset($negocio["unidad_negocio"]) ? $negocio["unidad_negocio"] : "No disponible";

				echo utf8_decode("<tr>
			 			<td style='border:1px solid #eee;'>" . $item["codigo"] . "</td> 
						<td style='border:1px solid #eee;'>" . $clienteNombre . "</td>
						<td style='border:1px solid #eee;'>" . $vendedorNombre . "</td>
						<td style='border:1px solid #eee;'>" . $bodegaNombre . "</td>
						
						 <td style='border:1px solid #eee;'>");

				$productos =  json_decode($item["productos"], true);

				foreach ($productos as $key => $valueProductos) {

					echo utf8_decode($valueProductos["id"] . "<br>");
				}
				echo utf8_decode("</td><td style='border:1px solid #eee;'>");

				foreach ($productos as $key => $valueProductos) {

					echo utf8_decode($valueProductos["cantidad"] . "<br>");
				}

				echo utf8_decode("</td><td style='border:1px solid #eee;'>");

				foreach ($productos as $key => $valueProductos) {

					echo utf8_decode($valueProductos["descripcion"] . "<br>");
				}

				echo utf8_decode("</td><td style='border:1px solid #eee;'> $ ");

				foreach ($productos as $key => $valueProductos) {

					echo number_format($valueProductos["precio"], 0,  '', '.') . "<br>";
				}

				echo utf8_decode("</td>
					 <td style='border:1px solid #eee;'>" . $medios["medio_pago"] . "</td>
					<td style='border:1px solid #eee;'> $ " . number_format(intval(str_replace(',', '', $item["subtotal"])), 0,  '', '.') . "</td>
					<td style='border:1px solid #eee;'> $ " . number_format(intval(str_replace(',', '', $item["descuento"])), 0,  '', '.') . "</td>	
					<td style='border:1px solid #eee;'> $ " . number_format(intval(str_replace(',', '', $item["exento"])), 0,  '', '.') . "</td>	
					<td style='border:1px solid #eee;'> $ " . number_format(intval(str_replace(',', '', $item["iva"])), 0,  '', '.') . "</td>	
					<td style='border:1px solid #eee;'> $ " . number_format(intval(str_replace(',', '', $item["total_final"])), 0,  '', '.') . "</td>
					<td style='border:1px solid #eee;'>" . substr($item["fecha_emision"], 0, 10) . "</td>		
		 			</tr>");
			}

			echo "</table>";
		}
	}
}
