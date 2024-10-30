<?php

class ControladorMatrices{

	/*=============================================
	CREAR MATRIZ
	=============================================*/

	static public function ctrCrearMatriz(){

		if(isset($_POST["nuevaMatriz"])){
			   	$tabla = "matrices";

				   $datos = array("razon_social"=>$_POST["nuevaMatriz"],
								  "rut"=>$_POST["nuevoRut"],
								"pais"=>$_POST["nuevoPais"],
                               "region"=>$_POST["nuevaRegion"],
                               "comuna"=>$_POST["nuevaComuna"],
                               "direccion"=>$_POST["nuevaDireccion"],	
                               "ejecutivo"=>$_POST["nuevoEjecutivo"],
                               "telefono"=>$_POST["nuevoTelefono"],
                               "email"=>$_POST["nuevoEmail"],
                                "actividad"=>$_POST["nuevaActividad"],
                                "fecha_inicio"=>$_POST["nuevoInicio"],
                                "fecha_vencimiento"=>$_POST["nuevoVencimiento"],
								"tipo_cliente"=>$_POST["nuevoTipoCliente"],
								"tipo_producto"=>$_POST["nuevoTipoProducto"]);


			   	$respuesta = ModeloMatrices::mdlIngresarMatriz($tabla, $datos);

			   	if($respuesta == "ok"){
					
					echo'<script>
						console.log("'.$datos["comuna"].', '.$datos["region"].'")
					swal({
						  type: "success",
						  title: "La Matriz ha sido guardada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "matriz"

									}
								})

					</script>';

				}

			
		}

	}

	/*=============================================
	MOSTRAR MATRIZ
	=============================================*/

	static public function ctrMostrarMatrices($item, $valor){

		$tabla = "matrices";

		$respuesta = ModeloMatrices::mdlMostrarMatrices($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	EDITAR MATRIZ
	=============================================*/

	static public function ctrEditarMatriz(){

		if(isset($_POST["editarMatriz"])){

				$tabla = "matrices";

                $datos = array("id"=>$_POST["idMatriz"],
					"razon_social"=>$_POST["editarMatriz"],
					"rut"=>$_POST["editarRut"],
					"pais"=>$_POST["editarPais"],
                    "region"=>$_POST["editarRegion"],
                	"comuna"=>$_POST["editarComuna"],
                    "direccion"=>$_POST["editarDireccion"],	
                    "ejecutivo"=>$_POST["editarEjecutivo"],
                    "telefono"=>$_POST["editarTelefono"],
                    "email"=>$_POST["editarEmail"],
                    "actividad"=>$_POST["editarActividad"],
                    "fecha_inicio"=>$_POST["editarInicio"],
                    "fecha_vencimiento"=>$_POST["editarVencimiento"],
					"tipo_cliente"=>$_POST["editarTipoCliente"],
					"tipo_producto"=>$_POST["editarTipoProducto"]);


				$respuesta = ModeloMatrices::mdlEditarMatriz($tabla, $datos);

				if($respuesta == "ok"){

                    echo'<script>
                    
                    
					swal({
						  type: "success",
						  title: "La Matriz ha sido editada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "matriz";

									}
								})

					</script>';

				}


			

		}

	}

	/*=============================================
	ELIMINAR MATRIZ
	=============================================*/

	static public function ctrEliminarMatriz(){

		if(isset($_GET["idMatriz"])){

			$tabla ="matrices";
			$datos = $_GET["idMatriz"];

			$respuesta = ModeloMatrices::mdlBorrarMatriz($tabla, $datos);

			if($respuesta == "ok"){
				echo'<script>

				swal({
					  type: "success",
					  title: "La Matriz ha sido borrada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result){
							if (result.value) {
								window.location = "matriz";
                            }
						})
				</script>';

			}		

		}

	}

}
