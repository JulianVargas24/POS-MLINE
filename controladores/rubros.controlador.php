<?php

class ControladorRubros{

	/*=============================================
	CREAR Rubros
	=============================================*/

	static public function ctrCrearRubro(){

		if(isset($_POST["nuevoRubro"])){


				$tabla = "rubros";

				$datos = array("nombre" => $_POST["nuevoRubro"],
								"descripcion" => $_POST["nuevaDescripcion"]);

				$respuesta = ModeloRubros::mdlIngresarRubro($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El Rubro ha sido guardado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "rubros";

									}
								})

					</script>';

			} 

		}

	}

	/*=============================================
	MOSTRAR Rubros
	=============================================*/

	static public function ctrMostrarRubros($item, $valor){

		$tabla = "rubros";

		$respuesta = ModeloRubros::mdlMostrarRubros($tabla, $item, $valor);

		return $respuesta;
	
	}

	/*=============================================
	EDITAR IMPUESTO
	=============================================*/

	static public function ctrEditarRubro(){

		if(isset($_POST["editarRubro"])){

		

				$tabla = "rubros";

                $datos = array("id"=>$_POST["idRubro"],
                               "nombre"=>$_POST["editarRubro"],
                               "descripcion"=>$_POST["editarDescripcion"],
                               );


				$respuesta = ModeloRubros::mdlEditarRubro($tabla, $datos);

				if($respuesta == "ok"){

                    echo'<script>
                    
                    
					swal({
						  type: "success",
						  title: "El Rubro ha sido editado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "rubros";

									}
								})

					</script>';

				}


			

		}

	}

	/*=============================================
	BORRAR CATEGORIA
	=============================================*/

	static public function ctrBorrarRubro(){

		if(isset($_GET["idRubro"])){

			$tabla ="rubros";
			$datos = $_GET["idRubro"];

			$respuesta = ModeloRubros::mdlBorrarRubro($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

					swal({
						  type: "success",
						  title: "El Rubro ha sido borrado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "rubros";

									}
								})

					</script>';
			}
		}
		
	}
}
