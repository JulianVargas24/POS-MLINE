<?php

class ControladorPlantel{


    static public function ctrCrearPlantel(){

		if(isset($_POST["nuevoNombre"])){

			   	$tabla = "plantel";

			   	$datos = array("nombre"=>$_POST["nuevoNombre"],
                               "rut"=>$_POST["nuevoRutId"],
                               "cargo"=>$_POST["nuevoCargo"],
							   "comision"=>$_POST["nuevaComision"]);

			   	$respuesta = ModeloPlantel::mdlIngresarPlantel($tabla, $datos);

			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El Plantel ha sido agregado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "plantel";

									}
								})

					</script>';

				}

			
		}

	}

    static public function ctrMostrarPlantel($item, $valor){

		$tabla = "plantel";

		$respuesta = ModeloPlantel::mdlMostrarPlantel($tabla, $item, $valor);

		return $respuesta;
	
    }

    static public function ctrEliminarPlantel(){

		if(isset($_GET["idPlantel"])){

			$tabla ="plantel";
			$datos = $_GET["idPlantel"];

			$respuesta = ModeloPlantel::mdlEliminarPlantel($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El Plantel ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result){
								if (result.value) {

								window.location = "plantel";

								}
							})

				</script>';

			}		

		}

    }
    
    static public function ctrEditarPlantel(){

		if(isset($_POST["editarNombre"])){

			

			   	$tabla = "plantel";

			   	$datos = array("id"=>$_POST["idPlantel"],
			   				   "nombre"=>$_POST["editarNombre"],
					           "rut"=>$_POST["editarRutId"],
					           "cargo"=>$_POST["editarCargo"],
					           "comision"=>$_POST["editarComision"]);

			   	$respuesta = ModeloPlantel::mdlEditarPlantel($tabla, $datos);

			   	if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El Plantel ha sido cambiado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "plantel";

									}
								})

					</script>';

				}

			

		}

	}
}
