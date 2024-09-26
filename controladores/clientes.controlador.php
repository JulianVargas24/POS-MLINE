<?php

class ControladorClientes{

	/*=============================================
	CREAR CLIENTES
	=============================================*/

	static public function ctrCrearCliente(){

		if(isset($_POST["nuevoCliente"])){


			   	$tabla = "clientes";

			   	$datos = array("nombre"=>$_POST["nuevoCliente"],
					           "rut"=>$_POST["nuevoRutId"],
					           "email"=>$_POST["nuevoEmail"],
					           "telefono"=>$_POST["nuevoTelefono"],
							   "direccion"=>$_POST["nuevaDireccion"],
							   "region"=>$_POST["nuevaRegion"],
							   "comuna"=>$_POST["nuevaComuna"],
							   "pais"=>$_POST["nuevoPais"],
							   "actividad"=>$_POST["nuevaActividad"],
							   "ejecutivo"=>$_POST["nuevoEjecutivo"],
							   "id_plazo"=>$_POST["nuevoPlazo"],
							   "id_vendedor"=>$_POST["nuevoVendedor"],
								"factor_lista"=>$_POST["nuevoFactor"]);

			   	$respuesta = ModeloClientes::mdlIngresarCliente($tabla, $datos);

			   	if($respuesta == "ok"){

					echo'<script>	
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

	static public function ctrMostrarClientes($item, $valor){

		$tabla = "clientes";

		$respuesta = ModeloClientes::mdlMostrarClientes($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	EDITAR CLIENTE
	=============================================*/

	static public function ctrEditarCliente(){

		if(isset($_POST["editarCliente"])){

			

			   	$tabla = "clientes";

			   	$datos = array("id"=>$_POST["idCliente"],
					   			"nombre"=>$_POST["editarCliente"],
					           "rut"=>$_POST["editarRutId"],
					           "email"=>$_POST["editarEmail"],
					           "telefono"=>$_POST["editarTelefono"],
							   "direccion"=>$_POST["editarDireccion"],
							   "region"=>$_POST["editarRegion"],
							   "comuna"=>$_POST["editarComuna"],
							   "pais"=>$_POST["editarPais"],
							   "actividad"=>$_POST["editarActividad"],
							   "ejecutivo"=>$_POST["editarEjecutivo"],
							   "id_plazo"=>$_POST["editarPlazo"],
							   "id_vendedor"=>$_POST["editarVendedor"],
								"factor_lista"=>$_POST["editarFactor"]);

			   	$respuesta = ModeloClientes::mdlEditarCliente($tabla, $datos);

			   	if($respuesta == "ok"){

					echo'<script>

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

	static public function ctrEliminarCliente(){

		if(isset($_GET["idCliente"])){

			$tabla ="clientes";
			$datos = $_GET["idCliente"];

			$respuesta = ModeloClientes::mdlEliminarCliente($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

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

	static public function ctrDescargarReporteCliente() {

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

            $Name = $_GET["reporte"] . '-clientes.xls';

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

            foreach ($clientes as $row => $item) {




                echo utf8_decode("<tr>
                        <td style='border:1px solid #eee;'>" . $item["nombre"] . "</td> 
                        <td style='border:1px solid #eee;'>" . $item["rut"] . "</td>
						 <td style='border:1px solid #eee;'>" . $item["email"] . "</td>
						 <td style='border:1px solid #eee;'>" . $item["telefono"] . "</td>
						 <td style='border:1px solid #eee;'>" . $item["region"] . "</td>
						 <td style='border:1px solid #eee;'>" . $item["comuna"] . "</td>
						 <td style='border:1px solid #eee;'>" . $item["direccion"] . "</td>
						 <td style='border:1px solid #eee;'>" . $item["actividad"] . "</td>
                        
	
		 			</tr>");
            }


            echo "</table>";
        }
    }

}

