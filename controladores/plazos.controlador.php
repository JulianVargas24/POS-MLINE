<?php

class ControladorPlazos{

	/*=============================================
	CREAR Rubros
	=============================================*/

	static public function ctrCrearPlazo(){

		if(isset($_POST["nuevoPlazo"])){


				$tabla = "plazos";

				$datos = array("nombre" => $_POST["nuevoPlazo"],
								"numero" => $_POST["nuevoNumero"]);

				$respuesta = ModeloPlazos::mdlIngresarPlazo($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El Plazo de Pago ha sido guardado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "plazos";

									}
								})

					</script>';

			} 

		}

	}

	/*=============================================
	MOSTRAR Rubros
	=============================================*/

	static public function ctrMostrarPlazos($item, $valor){

		$tabla = "plazos";

		$respuesta = ModeloPlazos::mdlMostrarPlazos($tabla, $item, $valor);

		return $respuesta;
	
	}

	/*=============================================
	EDITAR IMPUESTO
	=============================================*/

	static public function ctrEditarPlazo(){

		if(isset($_POST["editarPlazo"])){

		

				$tabla = "plazos";

                $datos = array("id"=>$_POST["idPlazo"],
                               "nombre"=>$_POST["editarPlazo"],
                               "numero"=>$_POST["editarNumero"],
                               );


				$respuesta = ModeloPlazos::mdlEditarPlazo($tabla, $datos);

				if($respuesta == "ok"){

                    echo'<script>
						
					console.log("'.$datos["id"].'");
					console.log("'.$datos["nombre"].'");
					console.log("'.$datos["numero"].'");
					swal({
						  type: "success",
						  title: "El Plazo de Pago ha sido editado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "plazos";

									}
								})

					</script>';

				}


			

		}

	}

	/*=============================================
	BORRAR CATEGORIA
	=============================================*/

	static public function ctrBorrarPlazo(){

		if(isset($_GET["idPlazo"])){

			$tabla ="plazos";
			$datos = $_GET["idPlazo"];

			$respuesta = ModeloPlazos::mdlBorrarPlazo($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

					swal({
						  type: "success",
						  title: "El Plazo de Pago ha sido borrado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "plazos";

									}
								})

					</script>';
			}
		}
		
	}
}
