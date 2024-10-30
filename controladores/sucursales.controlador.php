<?php

class ControladorSucursales{

	/*=============================================
	CREAR SUCURSAL
	=============================================*/

	static public function ctrCrearSucursal(){

		if(isset($_POST["nuevaSucursal"])){

			   	$tabla = "sucursales";

				   $datos = array("nombre"=>$_POST["nuevaSucursal"],
				   "region"=>$_POST["nuevaRegion"],
					"comuna"=>$_POST["nuevaComuna"],
				   "pais"=>$_POST["nuevoPais"],
				   "direccion"=>$_POST["nuevaDireccion"],	
				   "jefe"=>$_POST["nuevoJefe"],
				   "telefono"=>$_POST["nuevoTelefono"],
				   "email"=>$_POST["nuevoEmail"],
				   "bodega"=>$_POST["nuevaBodega"]);
								

			   	$respuesta = ModeloSucursales::mdlIngresarSucursal($tabla, $datos);

			   	if($respuesta == "ok"){

					

					echo'<script>
						console.log("'.$datos["comuna"].', '.$datos["region"].'")
					swal({
						  type: "success",
						  title: "La Sucursal ha sido guardada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

										window.location = "sucursales";

									}
								})

					</script>';

				}

			
		}

	}

	/*=============================================
	MOSTRAR SUCURSALES
	=============================================*/

	static public function ctrMostrarSucursales($item, $valor){

		$tabla = "sucursales";

		$respuesta = ModeloSucursales::mdlMostrarSucursales($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	EDITAR SUCURSALES
	=============================================*/

	static public function ctrEditarSucursal(){

		if(isset($_POST["editarSucursal"])){

			   	$tabla = "sucursales";

				   $datos = array(
					"id"=>$_POST["idSucursal"],
				   "nombre"=>$_POST["editarSucursal"],
				   "region"=>$_POST["editarRegion"],
					"comuna"=>$_POST["editarComuna"],
				   "pais"=>$_POST["editarPais"],
				   "direccion"=>$_POST["editarDireccion"],	
				   "jefe"=>$_POST["editarJefe"],
				   "telefono"=>$_POST["editarTelefono"],
				   "email"=>$_POST["editarEmail"],
				   "bodega"=>$_POST["editarBodega"]
				);
								

			   	$respuesta = ModeloSucursales::mdlEditarSucursal($tabla, $datos);

			   	if($respuesta == "ok"){

                    echo'<script>
					swal({
						  type: "success",
						  title: "La Sucursal ha sido modificada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "sucursales";

									}
								})

					</script>';

				}


		}

	}

	/*=============================================
	ELIMINAR SUCURSALES
	=============================================*/

	static public function ctrEliminarSucursal(){

		if(isset($_GET["idSucursal"])){

			$tabla ="sucursales";
			$datos = $_GET["idSucursal"];

			$respuesta = ModeloSucursales::mdlBorrarSucursal($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "La Sucursal ha sido borrada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result){
								if (result.value) {

								window.location = "sucursales";

								}
							})

				</script>';

			}		

		}

	}
	

}


