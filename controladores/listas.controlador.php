<?php

class ControladorListas{

	/*=============================================
	CREAR UNIDADES
	=============================================*/

	static public function ctrCrearLista(){

		if(isset($_POST["nuevaLista"])){


				$tabla = "lista_precios";

				$datos = array("nombre_lista" => $_POST["nuevaLista"],
								"factor" => $_POST["nuevoFactor"]);

				$respuesta = ModeloUnidades::mdlIngresarLista($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La Lista ha sido guardada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "listas";

									}
								})

					</script>';

			} 

		}

	}

	/*=============================================
	MOSTRAR UNIDADES
	=============================================*/

	static public function ctrMostrarListas($item, $valor){

		$tabla = "lista_precios";

		$respuesta = ModeloListas::mdlMostrarListas($tabla, $item, $valor);

		return $respuesta;
	
	}

	/*=============================================
	EDITAR CATEGORIA
	=============================================*/

	static public function ctrEditarLista(){

		if(isset($_POST["editarLista"])){

		

				$tabla = "lista_precios";

                $datos = array("id"=>$_POST["idLista"],
                               "nombre_lista"=>$_POST["editarLista"],
                               "factor"=>$_POST["editarFactor"],
                               );


				$respuesta = ModeloListas::mdlEditarLista($tabla, $datos);

				if($respuesta == "ok"){

                    echo'<script>
                    
                    
					swal({
						  type: "success",
						  title: "La Lista ha sido editada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "listas";

									}
								})

					</script>';

				}


			

		}

	}

	/*=============================================
	BORRAR CATEGORIA
	=============================================*/

	static public function ctrBorrarLista(){

		if(isset($_GET["id_lista"])){

			$tabla ="lista_precios";
			$datos = $_GET["id_lista"];

			$respuesta = ModeloUnidades::mdlBorrarLista($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

					swal({
						  type: "success",
						  title: "La Lista ha sido borrada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "listas";

									}
								})

					</script>';
			}
		}
		
	}
}
