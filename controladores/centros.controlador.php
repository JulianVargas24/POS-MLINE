<?php

class ControladorCentros{

	/*=============================================
	CREAR UNIDADES
	=============================================*/

	static public function ctrCrearCentro(){

		if(isset($_POST["nuevoCentro"])){


				$tabla = "centros_costo";

				$datos =  array("centro"=>$_POST["nuevoCentro"],
                                 "codigo"=>$_POST["nuevoCodigoCentro"]);

				$respuesta = ModeloCentros::mdlIngresarCentro($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El Centro de Costo ha sido guardado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "centro-costo";

									}
								})

					</script>';

			} 

		}

	}

	/*=============================================
	MOSTRAR UNIDADES
	=============================================*/

	static public function ctrMostrarCentros($item, $valor){

		$tabla = "centros_costo";

		$respuesta = ModeloCentros::mdlMostrarCentros($tabla, $item, $valor);

		return $respuesta;
	
    }

    static public function ctrEditarCentro(){

		if(isset($_POST["editarCentro"])){

		

				$tabla = "centros_costo";

                $datos = array("centro"=>$_POST["editarCentro"],
                               "codigo"=>$_POST["editarCodigoCentro"],
							   "id"=>$_POST["idCentro"]);

				$respuesta = ModeloCentros::mdlEditarCentro($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El Centro de Costo ha sido cambiado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "centro-costo";

									}
								})

					</script>';

				}


			

		}

	}

    static public function ctrEliminarCentro(){

		if(isset($_GET["idCentro"])){

            $tabla ="centros_costo";
			$datos = $_GET["idCentro"];

			$respuesta = ModeloCentros::mdlEliminarCentro($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

					swal({
						  type: "success",
						  title: "El Centro ha sido eliminado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "centro-costo";

									}
								})

					</script>';
			}
		}
		
	}
    
}