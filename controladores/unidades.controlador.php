<?php

class ControladorUnidades{

	/*=============================================
	CREAR UNIDADES
	=============================================*/

	static public function ctrCrearUnidad(){

		if(isset($_POST["nuevaMedida"])){


				$tabla = "unidades";

				$datos = $_POST["nuevaMedida"];

				$respuesta = ModeloUnidades::mdlIngresarUnidad($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La Unidad de Medida ha sido guardada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "unidades";

									}
								})

					</script>';

			} 

		}

	}

	/*=============================================
	MOSTRAR UNIDADES
	=============================================*/

	static public function ctrMostrarUnidades($item, $valor){

		$tabla = "unidades";

		$respuesta = ModeloUnidades::mdlMostrarUnidades($tabla, $item, $valor);

		return $respuesta;
	
	}

	/*=============================================
	EDITAR CATEGORIA
	=============================================*/

	static public function ctrEditarUnidad(){

		if(isset($_POST["editarMedida"])){

		

				$tabla = "unidades";

				$datos = array("medida"=>$_POST["editarMedida"],
							   "id"=>$_POST["idUnidad"]);

				$respuesta = ModeloUnidades::mdlEditarUnidad($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La Unidad de Medida ha sido cambiada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "unidades";

									}
								})

					</script>';

				}


			

		}

	}

	/*=============================================
	BORRAR CATEGORIA
	=============================================*/

	static public function ctrBorrarUnidad(){

		if(isset($_GET["idUnidad"])){

			$tabla ="unidades";
			$datos = $_GET["idUnidad"];

			$respuesta = ModeloUnidades::mdlBorrarUnidad($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

					swal({
						  type: "success",
						  title: "La Unidad de Medida ha sido borrada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "unidades";

									}
								})

					</script>';
			}
		}
		
	}
}
