<?php

class ControladorSubcategorias{

	/*=============================================
	CREAR CATEGORIAS
	=============================================*/

	static public function ctrCrearSubcategoria(){

		if(isset($_POST["nuevaSubcategoria"])){


				$tabla = "subcategorias";

				$datos = array("id_categoria" => $_POST["nuevaCategoria"],
								"subcategoria" => $_POST["nuevaSubcategoria"]);

				$respuesta = ModeloSubcategorias::mdlIngresarSubcategoria($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La subcategoría ha sido guardada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "subcategorias";

									}
								})

					</script>';

			} 

		}

	}

	/*=============================================
	MOSTRAR CATEGORIAS
	=============================================*/

	static public function ctrMostrarSubcategorias($item, $valor){

		$tabla = "subcategorias";

		$respuesta = ModeloSubcategorias::mdlMostrarSubcategorias($tabla, $item, $valor);

		return $respuesta;
	
	}

	static public function ctrMostrarSubcategoriasPorID($item, $valor){

		$tabla = "subcategorias";

		$respuesta = ModeloSubcategorias::mdlMostrarSubcategorias($tabla, $item, $valor);

		return $respuesta;
	
	}

	/*=============================================
	EDITAR CATEGORIA
	=============================================*/

	static public function ctrEditarSubcategoria(){

		if(isset($_POST["editarSubcategoria"])){

		

				$tabla = "subcategorias";

				$datos = array("subcategoria"=>$_POST["editarSubcategoria"],
							   "id"=>$_POST["id_subcategoria"]);

				$respuesta = ModeloSubcategorias::mdlEditarSubcategoria($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La subcategoría ha sido cambiada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "subcategorias";

									}
								})

					</script>';

				}


			

		}

	}

	/*=============================================
	BORRAR CATEGORIA
	=============================================*/

	static public function ctrBorrarSubcategoria(){

		if(isset($_GET["id_subcategoria"])){

			$tabla ="subcategorias";
			$datos = $_GET["id_subcategoria"];

			$respuesta = ModeloSubcategorias::mdlBorrarSubcategoria($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

					swal({
						  type: "success",
						  title: "La subcategoría ha sido borrada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "subcategorias";

									}
								})

					</script>';
			}
		}
		
	}
}
