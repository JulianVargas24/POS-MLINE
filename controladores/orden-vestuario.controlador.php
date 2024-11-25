<?php

class ControladorOrdenVestuario
{
	/**
	 * Método para crear una orden de vestuario
	 */
	static public function ctrCrearOrdenVestuario()
	{
		if (isset($_POST["nuevoCodigo"])) {

			$tabla = "orden_vestuario";

			$datos = array(
				"codigo" => $_POST["nuevoCodigo"],
				"fecha_emision" => $_POST["nuevaFechaEmision"],
				"nombre_orden" => $_POST["nuevoNombreOrden"],
				"fecha_vencimiento" => $_POST["nuevaFechaVencimiento"],
				"id_centro" => $_POST["nuevoCentro"],
				"id_bodega" => $_POST["nuevaBodega"],
				"id_cliente" => $_POST["nuevoCliente"],
				"observacion" => $_POST["nuevaObservacion"],
				"personal" => $_POST["listaPersonal"]
			);

			$respuesta = ModeloOrdenVestuario::mdlIngresarOrdenVestuario($tabla, $datos);

			if ($respuesta == "ok") {
				echo '<script>
					swal({
						  type: "success",
						  title: "La Orden de Vestuario ha sido guardada correctamente",    
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "orden-trabajo";

									}
								})

					</script>';
			}
		}
	}

	/**
	 * Método para editar una orden de vestuario
	 */
	static public function ctrEditarOrdenVestuario()
	{
		if (isset($_POST["nuevoCodigo"])) {

			$tabla = "orden_vestuario";

			// Crear un array con los datos del formulario
			$datos = array(
				"codigo" => $_POST["nuevoCodigo"],
				"fecha_emision" => $_POST["nuevaFechaEmision"],
				"nombre_orden" => $_POST["nuevoNombreOrden"],
				"fecha_vencimiento" => $_POST["nuevaFechaVencimiento"],
				"id_centro" => $_POST["nuevoCentro"],
				"id_bodega" => $_POST["nuevaBodega"],
				"id_cliente" => $_POST["nuevoCliente"],
				"observacion" => $_POST["nuevaObservacion"],
				"personal" => $_POST["listaPersonal"]
			);

			// Verificamos si estamos en modo de edición (si el ID existe en el formulario)
			if (isset($_POST["idOrdenVestuario"]) && !empty($_POST["idOrdenVestuario"])) {

				// Agregar el id al array de datos para la edición
				$datos["id"] = $_POST["idOrdenVestuario"];

				// Llamar al método para editar la orden de vestuario
				$respuesta = ModeloOrdenVestuario::mdlEditarOrdenVestuario($tabla, $datos);

				if ($respuesta == "ok") {
					echo '<script>
						swal({
							type: "success",
							title: "La Orden de Vestuario ha sido editada correctamente",    
							showConfirmButton: true,
							confirmButtonText: "Cerrar"
						}).then(function(result) {
							if (result.value) {
								window.location = "orden-trabajo";
							}
						});
					</script>';
				}
			} else {
				// Si no hay ID, se crea una nueva orden
				$respuesta = ModeloOrdenVestuario::mdlIngresarOrdenVestuario($tabla, $datos);

				if ($respuesta == "ok") {
					echo '<script>
						swal({
							type: "success",
							title: "La Orden de Vestuario ha sido guardada correctamente",    
							showConfirmButton: true,
							confirmButtonText: "Cerrar"
						}).then(function(result) {
							if (result.value) {
								window.location = "orden-trabajo";
							}
						});
					</script>';
				}
			}
		}
	}

	/**
	 * Método para eliminar una orden de vestuario
	 */
	static public function ctrEliminarOrdenVestuario()
	{
		if (isset($_GET["idOrdenVestuario"])) {

			$tabla = "orden_vestuario";
			$datos = $_GET["idOrdenVestuario"];

			// Llamamos al modelo para eliminar la orden en la base de datos
			$respuesta = ModeloOrdenVestuario::mdlEliminarOrdenVestuario($tabla, $datos);

			if ($respuesta == "ok") {
				echo '<script>
					swal({
						type: "success",
						title: "La Orden de Vestuario ha sido eliminada correctamente",    
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
					}).then(function(result){
						if (result.value) {
							window.location = "orden-trabajo";
						}
					});
				</script>';
			} else {
				echo '<script>
					swal({
						type: "error",
						title: "Error al eliminar la Orden de Vestuario",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
					}).then(function(result){
						if (result.value) {
							window.location = "orden-trabajo";
						}
					});
				</script>';
			}
		}
	}

	/**
	 * Método para mostrar una orden de vestuario
	 */
	static public function ctrMostrarOrdenVestuario($item, $valor)
	{
		$tabla = "orden_vestuario";

		$fechaInicial = isset($_GET["fechaInicial"]) ? $_GET["fechaInicial"] : null;
		$fechaFinal = isset($_GET["fechaFinal"]) ? $_GET["fechaFinal"] : null;

		$respuesta = ModeloOrdenVestuario::mdlMostrarOrdenVestuario($tabla, $item, $valor, $fechaInicial, $fechaFinal);

		return $respuesta;
	}

	/**
	 * Método para descargar un reporte de orden de vestuario
	 */
	public function ctrDescargarReporteVestuario()
	{
		if (isset($_GET["reporte"])) {

			$tabla = "orden_vestuario";

			// Verificar que ambas fechas están presentes y no están vacías
			if (!empty($_GET["fechaInicial"]) && !empty($_GET["fechaFinal"])) {
				$fechaInicial = $_GET["fechaInicial"];
				$fechaFinal = $_GET["fechaFinal"];
				$vestuarios = ModeloOrdenVestuario::mdlMostrarOrdenVestuario($tabla, null, null, $fechaInicial, $fechaFinal);
				$Name = ucfirst($_GET["reporte"]) . ' de vestuario (' . $fechaInicial . ' al ' . $fechaFinal . ').xls';
			} else {
				// Si no hay fechas se descarga el reporte completo
				$vestuarios = ModeloOrdenVestuario::mdlMostrarOrdenVestuario($tabla, null, null);
				$Name = ucfirst($_GET["reporte"]) . ' de vestuario.xls';
			}

			/*=============================================
			CREAMOS EL ARCHIVO DE EXCEL
			=============================================*/

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
					<td style='font-weight:bold; border:1px solid #eee;'>BODEGA</td>
					<td style='font-weight:bold; border:1px solid #eee;'>ID PERSONAL</td>
					<td style='font-weight:bold; border:1px solid #eee;'>NOMBRE</td>
					<td style='font-weight:bold; border:1px solid #eee;'>R.U.T</td>
					<td style='font-weight:bold; border:1px solid #eee;'>EMPRESA</td>
					<td style='font-weight:bold; border:1px solid #eee;'>MEDIDAS</td>		
					<td style='font-weight:bold; border:1px solid #eee;'>FECHA EMISION</td>
					<td style='font-weight:bold; border:1px solid #eee;'>OBSERVACIONES</td>				
					</tr>");

			foreach ($vestuarios as $row => $item) {

				$cliente = ControladorClientes::ctrMostrarClientes("id", $item["id_cliente"]);
				$bodega = ControladorBodegas::ctrMostrarBodegas("id", $item["id_bodega"]);
				$centro = ControladorCentros::ctrMostrarCentros("id", $item["id_centro"]);


				echo utf8_decode("<tr>
			 			<td style='border:1px solid #eee;'>" . $item["codigo"] . "</td> 
			 			<td style='border:1px solid #eee;'>" . $cliente["nombre"] . "</td>
						 <td style='border:1px solid #eee;'>" . $bodega["nombre"] . "</td>
						 <td style='border:1px solid #eee;'>");

				$personal =  json_decode($item["personal"], true);

				foreach ($personal as $key => $valuePersonal) {

					echo utf8_decode($valuePersonal["id"] . "<br>");
				}
				echo utf8_decode("</td><td style='border:1px solid #eee;'>");

				foreach ($personal as $key => $valuePersonal) {

					echo utf8_decode($valuePersonal["nombre"] . "<br>");
				}

				echo utf8_decode("</td><td style='border:1px solid #eee;'>");

				foreach ($personal as $key => $valuePersonal) {

					echo utf8_decode($valuePersonal["rut"] . "<br>");
				}

				echo utf8_decode("</td><td style='border:1px solid #eee;'> ");

				foreach ($personal as $key => $valuePersonal) {

					echo utf8_decode($valuePersonal["empresa"] . "<br>");
				}

				echo utf8_decode("</td><td style='border:1px solid #eee;'> ");

				foreach ($personal as $key => $valuePersonal) {

					echo  json_encode($valuePersonal["medidas"], true) . "<br>";
				}

				echo utf8_decode("</td>
					<td style='border:1px solid #eee;'>" . substr($item["fecha_emision"], 0, 10) . "</td>	
					<td style='border:1px solid #eee;'>" . $item["observacion"] . "</td>	
		 			</tr>");
			}

			echo "</table>";
		}
	}
}
