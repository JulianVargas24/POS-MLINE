<?php

class ControladorClientes
{

	/*=============================================
	CREAR CLIENTES
	=============================================*/

	static public function ctrCrearCliente()
	{

		if (isset($_POST["nuevoCliente"])) {


			$tabla = "clientes";

			$datos = array(
				"nombre" => $_POST["nuevoCliente"],
				"rut" => $_POST["nuevoRutId"],
				"email" => $_POST["nuevoEmail"],
				"telefono" => $_POST["nuevoTelefono"],
				"direccion" => $_POST["nuevaDireccion"],
				"region" => $_POST["nuevaRegion"],
				"comuna" => $_POST["nuevaComuna"],
				"pais" => $_POST["nuevoPais"],
				"actividad" => $_POST["nuevaActividad"],
				"ejecutivo" => $_POST["nuevoEjecutivo"],
				"id_plazo" => $_POST["nuevoPlazo"],
				"id_vendedor" => $_POST["nuevoVendedor"],
				"factor_lista" => $_POST["nuevoFactor"],
				"id_producto" => $_POST["nuevoTipoProducto"],
				"id_campana" => $_POST["nuevoTipoCampana"],
				"contacto_cobranza" => $_POST["nuevoContactoCobranza"],
				"email_cobranza" => $_POST["nuevoEmailCobranza"],
				"telefono_cobranza" => $_POST["nuevoTelefonoCobranza"],
				"linea_credito" => $_POST["nuevaLineaCredito"],
				"observacion" => $_POST["nuevaObservacion"],
				"estado" => $_POST["nuevoEstado"],
				"bloqueo_credito" => $_POST["nuevoBloqueoCredito"]
			);
			/**echo '<pre>';
			var_dump($datos);
			echo '</pre>';*/
			$respuesta = ModeloClientes::mdlIngresarCliente($tabla, $datos);
			/**echo "<script>console.log('Respuesta del servidor: " . $respuesta . "');</script>";
			echo '<pre>';
			var_dump($respuesta);
			echo '</pre>';*/

			if ($respuesta == "ok") {

				echo '<script>	
					swal({
						  type: "success",
						  title: "El Cliente ha sido guardado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "clientes";

									}
								})

					</script>';
			}
		}
	}

	/*=============================================
	MOSTRAR CLIENTES
	=============================================*/

	static public function ctrMostrarClientes($item, $valor)
	{

		$tabla = "clientes";

		$respuesta = ModeloClientes::mdlMostrarClientes($tabla, $item, $valor);

		return $respuesta;
	}

	/*=============================================
	EDITAR CLIENTE
	=============================================*/

	static public function ctrEditarCliente()
	{

		if (isset($_POST["editarCliente"])) {



			$tabla = "clientes";

			$datos = array(
				"id" => $_POST["idCliente"],
				"nombre" => $_POST["editarCliente"],
				"rut" => $_POST["editarRutId"],
				"email" => $_POST["editarEmail"],
				"telefono" => $_POST["editarTelefono"],
				"direccion" => $_POST["editarDireccion"],
				"region" => $_POST["editarRegion"],
				"comuna" => $_POST["editarComuna"],
				"pais" => $_POST["editarPais"],
				"actividad" => $_POST["editarActividad"],
				"ejecutivo" => $_POST["editarEjecutivo"],
				"id_plazo" => $_POST["editarPlazo"],
				"id_vendedor" => $_POST["editarVendedor"],
				"factor_lista" => $_POST["editarFactor"],
				"id_producto" => $_POST["editarTipoProducto"],
				"id_campana" => $_POST["editarTipoCampana"],
				"contacto_cobranza" => $_POST["editarContactoCobranza"],
				"email_cobranza" => $_POST["editarEmailCobranza"],
				"telefono_cobranza" => $_POST["editarTelefonoCobranza"],
				"linea_credito" => $_POST["editarLineaCredito"],
				"observacion" => $_POST["editarObservacion"],
				"estado" => $_POST["editarEstado"],
				"bloqueo_credito" => $_POST["editarBloqueoCredito"]
			);

			$respuesta = ModeloClientes::mdlEditarCliente($tabla, $datos);

			if ($respuesta == "ok") {

				echo '<script>

					swal({
						  type: "success",
						  title: "El cliente ha sido cambiado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "clientes";

									}
								})

					</script>';
			}
		}
	}

	/*=============================================
	ELIMINAR CLIENTE
	=============================================*/

	static public function ctrEliminarCliente()
	{

		if (isset($_GET["idCliente"])) {

			$tabla = "clientes";
			$datos = $_GET["idCliente"];

			$respuesta = ModeloClientes::mdlEliminarCliente($tabla, $datos);

			if ($respuesta == "ok") {

				echo '<script>

				swal({
					  type: "success",
					  title: "El cliente ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result){
								if (result.value) {

								window.location = "clientes";

								}
							})

				</script>';
			}
		}
	}

	static public function ctrDescargarReporteCliente()
	{

		if (isset($_GET["reporte"])) {

			$tabla = "clientes";

			if (isset($_GET["fechaInicial"]) && isset($_GET["fechaFinal"])) {

				$ventas = ModeloVentas::mdlRangoFechasVentas($tabla, $_GET["fechaInicial"], $_GET["fechaFinal"]);
			} else {

				$item = null;
				$valor = null;

				$clientes = ModeloClientes::mdlMostrarClientes($tabla, $item, $valor);
			}


			/*=============================================
            CREAMOS EL ARCHIVO DE EXCEL
            =============================================*/

			$Name = ucfirst($_GET["reporte"]) . ' de clientes.xls';

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
                    <td style='font-weight:bold; border:1px solid #eee;'>NOMBRE</td> 
                    <td style='font-weight:bold; border:1px solid #eee;'>RUT</td>
                    <td style='font-weight:bold; border:1px solid #eee;'>EMAIL</td>
                    <td style='font-weight:bold; border:1px solid #eee;'>TELEFONO</td>
                    <td style='font-weight:bold; border:1px solid #eee;'>REGION</td>
                    <td style='font-weight:bold; border:1px solid #eee;'>COMUNA</td>
                    <td style='font-weight:bold; border:1px solid #eee;'>DIRECCION</td>
                    <td style='font-weight:bold; border:1px solid #eee;'>ACTIVIDAD</td>
	
                    </tr>");

			foreach ($clientes as $row => $value) {
				require_once $_SERVER["DOCUMENT_ROOT"] . '/POS-MLINE/controladores/regiones.controlador.php';
				require_once $_SERVER["DOCUMENT_ROOT"] . '/POS-MLINE/modelos/regiones.modelo.php';

				// Obtener los nombres de la región y la comuna
				$regionNombre = ControladorRegiones::ctrMostrarRegiones('id', $value['region']);
				$comunaNombre = ControladorRegiones::ctrMostrarComunas('id', $value['comuna']);

				// Asignar nombres o mostrar el ID si no se encuentra el nombre
				$regionDisplay = $regionNombre ? htmlspecialchars($regionNombre['nombre']) : '' . $value['region'];
				$comunaDisplay = $comunaNombre ? htmlspecialchars($comunaNombre['nombre']) : '' . $value['comuna'];

				echo utf8_decode("<tr>
								<td style='border:1px solid #eee;'>" . $value["nombre"] . "</td> 
								<td style='border:1px solid #eee;'>" . $value["rut"] . "</td>
								<td style='border:1px solid #eee;'>" . $value["email"] . "</td>
								<td style='border:1px solid #eee;'>" . $value["telefono"] . "</td>
								<td style='border:1px solid #eee;'>" . $regionDisplay . "</td>
								<td style='border:1px solid #eee;'>" . $comunaDisplay . "</td>
								<td style='border:1px solid #eee;'>" . $value["direccion"] . "</td>
								<td style='border:1px solid #eee;'>" . $value["actividad"] . "</td>
							</tr>");
			}


			echo "</table>";
		}
	}
}
