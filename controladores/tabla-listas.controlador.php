<?php

class ControladorTablaListas{

	/*=============================================
	CREAR Rubros
	=============================================*/

	static public function ctrCrearTablaLista(){

		if(isset($_POST["nuevaTablaLista"])){


				$tabla = "tabla_listas";

				$datos = array("nombre" => $_POST["nuevaTablaLista"]);

				$respuesta = ModeloTablaListas::mdlIngresarTablaLista($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La Tabla Lista ha sido guardada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "tabla-listas";

									}
								})

					</script>';

			} 

		}

	}

	/*=============================================
	MOSTRAR Rubros
	=============================================*/

	static public function ctrMostrarTablaListas($item, $valor){

		$tabla = "tabla_listas";

		$respuesta = ModeloTablaListas::mdlMostrarTablaListas($tabla, $item, $valor);

		return $respuesta;
	
	}

	/*=============================================
	EDITAR IMPUESTO
	=============================================*/

	static public function ctrEditarTablaLista(){

		if(isset($_POST["editarTablaLista"])){

		

				$tabla = "tabla_listas";

                $datos = array("id"=>$_POST["idTablaLista"],
                               "nombre"=>$_POST["editarTablaLista"]
                               );


				$respuesta = ModeloTablaListas::mdlEditarTablaLista($tabla, $datos);

				if($respuesta == "ok"){

                    echo'<script>
                    
                    
					swal({
						  type: "success",
						  title: "La Tabla para Lista ha sido editada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "tabla-listas";

									}
								})

					</script>';

				}


			

		}

	}

	/*=============================================
	BORRAR CATEGORIA
	=============================================*/

	static public function ctrBorrarTablaLista(){

		if(isset($_GET["idTablaLista"])){

			$tabla ="tabla_listas";
			$datos = $_GET["idTablaLista"];

			$respuesta = ModeloTablaListas::mdlBorrarTablaLista($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

					swal({
						  type: "success",
						  title: "La Tabla para Lista ha sido borrada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "tabla-listas";

									}
								})

					</script>';
			}
		}
		
	}
}
