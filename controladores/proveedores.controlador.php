<?php

class ControladorProveedores
{

	/*=============================================
    CREAR PROVEEDORES
    =============================================*/

	static public function ctrCrearProveedores()
	{

		if (isset($_POST["nuevoProveedor"])) {

			$tabla = "proveedores";

			$datos = array(
				"razon_social" => $_POST["nuevoProveedor"],
				"rut" => $_POST["nuevoRutId"],
				"comuna" => $_POST["nuevaComuna"],
				"region" => $_POST["nuevaRegion"],
				"pais" => $_POST["nuevoPais"],
				"nro_cuenta" => $_POST["nuevoNroCuenta"],
				"banco" => $_POST["nuevoBanco"],
				"telefono" => $_POST["nuevoTelefono"],
				"email" => $_POST["nuevoEmail"],
				"actividad" => $_POST["nuevaActividad"],
				"ejecutivo" => $_POST["nuevoEjecutivo"],
				"rubros" => $_POST["nuevoRubro"],
				"direccion" => $_POST["nuevaDireccion"],
				"id_plazo" => $_POST["nuevoPlazo"]
			);

			$respuesta = ModeloProveedores::mdlIngresarProveedor($tabla, $datos);

			if ($respuesta == "ok") {

				echo '<script>
					
					swal({
						  type: "success",
						  title: "El Proveedor ha sido guardado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "proveedores";

									}
								})

					</script>';
			}
		}
	}

	/*=============================================
    MOSTRAR PROVEEDORES
    =============================================*/

	static public function ctrMostrarProveedores($item, $valor)
	{

		$tabla = "proveedores";

		$respuesta = ModeloProveedores::mdlMostrarProveedores($tabla, $item, $valor);

		return $respuesta;
	}

	/*=============================================
    EDITAR PROVEEDORES
    =============================================*/

	static public function ctrEditarProveedor()
	{

		if (isset($_POST["editarProveedor"])) {

			$tabla = "proveedores";

			$datos = array(
				"id" => $_POST["idProveedor"],
				"razon_social" => $_POST["editarProveedor"],
				"rut" => $_POST["editarRutId"],
				"comuna" => $_POST["editarComuna"],
				"region" => $_POST["editarRegion"],
				"pais" => $_POST["editarPais"],
				"nro_cuenta" => $_POST["editarNroCuenta"],
				"banco" => $_POST["editarBanco"],
				"telefono" => $_POST["editarTelefono"],
				"email" => $_POST["editarEmail"],
				"actividad" => $_POST["editarActividad"],
				"ejecutivo" => $_POST["editarEjecutivo"],
				"rubros" => $_POST["editarRubro"],
				"direccion" => $_POST["editarDireccion"],
				"id_plazo" => $_POST["editarPlazo"]
			);


			$respuesta = ModeloProveedores::mdlEditarProveedor($tabla, $datos);

			if ($respuesta == "ok") {
				echo '<script>
					
					swal({
						  type: "success",
						  title: "El Proveedor ha sido cambiado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "proveedores";

									}
								})

					</script>';
			}
		}
	}

	/*=============================================
    ELIMINAR PROVEEDORES
    =============================================*/

	static public function ctrEliminarProveedores()
	{

		if (isset($_GET["idProveedor"])) {

			$tabla = "proveedores";
			$datos = $_GET["idProveedor"];

			$respuesta = ModeloProveedores::mdlBorrarProveedor($tabla, $datos);

			if ($respuesta == "ok") {

				echo '<script>

				swal({
					  type: "success",
					  title: "El Proveedor ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result){
								if (result.value) {

								window.location = "proveedores";

								}
							})

				</script>';
			}
		}
	}

	static public function ctrDescargarReporteProveedores()
	{

		if (isset($_GET["reporte"])) {

			$tabla = "proveedores";

			if (isset($_GET["fechaInicial"]) && isset($_GET["fechaFinal"])) {

				$ventas = ModeloVentas::mdlRangoFechasVentas($tabla, $_GET["fechaInicial"], $_GET["fechaFinal"]);
			} else {

				$item = null;
				$valor = null;

				$proveedores = ModeloProveedores::mdlMostrarProveedores($tabla, $item, $valor);
			}


			/*=============================================
            CREAMOS EL ARCHIVO DE EXCEL
            =============================================*/

			$Name = $_GET["reporte"] . '-proveedores.xls';

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
                    <td style='font-weight:bold; border:1px solid #eee;'>RAZON SOCIAL</td> 
                    <td style='font-weight:bold; border:1px solid #eee;'>RUT</td>
                    <td style='font-weight:bold; border:1px solid #eee;'>EMAIL</td>
                    <td style='font-weight:bold; border:1px solid #eee;'>TELEFONO</td>
                    <td style='font-weight:bold; border:1px solid #eee;'>REGION</td>
                    <td style='font-weight:bold; border:1px solid #eee;'>COMUNA</td>
                    <td style='font-weight:bold; border:1px solid #eee;'>DIRECCION</td>
					<td style='font-weight:bold; border:1px solid #eee;'>ACTIVIDAD</td>
					<td style='font-weight:bold; border:1px solid #eee;'>BANCO</td>
					<td style='font-weight:bold; border:1px solid #eee;'>N° CUENTA</td>
	
                    </tr>");

			foreach ($proveedores as $row => $item) {


				echo utf8_decode("<tr>
                        <td style='border:1px solid #eee;'>" . $item["razon_social"] . "</td> 
                        <td style='border:1px solid #eee;'>" . $item["rut"] . "</td>
						 <td style='border:1px solid #eee;'>" . $item["email"] . "</td>
						 <td style='border:1px solid #eee;'>" . $item["telefono"] . "</td>
						 <td style='border:1px solid #eee;'>" . $item["region"] . "</td>
						 <td style='border:1px solid #eee;'>" . $item["comuna"] . "</td>
						 <td style='border:1px solid #eee;'>" . $item["direccion"] . "</td>
						 <td style='border:1px solid #eee;'>" . $item["actividad"] . "</td>
						 <td style='border:1px solid #eee;'>" . $item["banco"] . "</td>
						 <td style='border:1px solid #eee;'>" . $item["nro_cuenta"] . "</td>

                        
	
		 			</tr>");
			}


			echo "</table>";
		}
	}
}
