<?php

class ControladorMediosPago{

	/*=============================================
	CREAR MEDIO DE PAGO
	=============================================*/

	static public function ctrCrearMedio(){

		if(isset($_POST["nuevoMedio"])){


				$tabla = "medios_pago";

				$datos = $_POST["nuevoMedio"];

				$respuesta = ModeloMediosPago::mdlIngresarMedio($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El Medio de Pago ha sido guardado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "medios-pago";

									}
								})

					</script>';

				


			}

		}

	}

	/*=============================================
	MOSTRAR MEDIOS PAGO
	=============================================*/

	static public function ctrMostrarMedios($item, $valor){

		$tabla = "medios_pago";

		$respuesta = ModeloMediosPago::mdlMostrarMedios($tabla, $item, $valor);

		return $respuesta;
	
	}

	/*=============================================
	EDITAR MEDIOS PAGO
	=============================================*/

	static public function ctrEditarMedio(){

		if(isset($_POST["editarMedio"])){

		

				$tabla = "medios_pago";

				$datos = array("medio_pago"=>$_POST["editarMedio"],
							   "id"=>$_POST["idMedio"]);

				$respuesta = ModeloMediosPago::mdlEditarMedio($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El Medio de Pago ha sido cambiada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "medios-pago";

									}
								})

					</script>';

				}


			

		}

	}

	/*=============================================
	BORRAR CATEGORIA
	=============================================*/

	static public function ctrEliminarMedio(){

		if(isset($_GET["idMedio"])){

			$tabla ="medios_pago";
			$datos = $_GET["idMedio"];

			$respuesta = ModeloMediosPago::mdlEliminarMedio($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

					swal({
						  type: "success",
						  title: "El Medio de Pago ha sido borrado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "medios-pago";

									}
								})

					</script>';
			}
		}
		
	}
}
