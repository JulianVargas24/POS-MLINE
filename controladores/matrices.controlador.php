<?php

class ControladorMatrices{

	/*=============================================
	CREAR SUCURSAL
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
	EDITAR PROVEEDORES
	=============================================*/

	static public function ctrEditarMatriz(){

		if(isset($_POST["editarMatriz"])){

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
	ELIMINAR PROVEEDORES
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


	static public function ctrEditarCondicionVenta(){

		if(isset($_POST["nuevaCondicionVenta"])){

			$tabla = "matrices";

			$datos = array("id"=>4,
						   "condicion_venta"=>$_POST["nuevaCondicionVenta"]);


			$respuesta = ModeloMatrices::mdlEditarCondicionVenta($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>
				
				
				swal({
					  type: "success",
					  title: "Parametros Generales actualizados.",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "parametros-generales";

								}
							})

				</script>';

			}


		

	}

}
	}

