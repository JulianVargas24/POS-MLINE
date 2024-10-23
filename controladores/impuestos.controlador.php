<?php

class ControladorImpuestos{

	/*=============================================
	CREAR IMPUESTOS
	=============================================*/

	static public function ctrCrearImpuesto(){

		if(isset($_POST["nuevoImpuesto"])){


				$tabla = "impuestos";

				$datos = array("nombre" => $_POST["nuevoImpuesto"],
								"factor" => $_POST["nuevoFactor"]);

				$respuesta = ModeloImpuestos::mdlIngresarImpuesto($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El Impuesto ha sido guardado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "impuestos";

									}
								})

					</script>';

			} 

		}

	}

	/*=============================================
	MOSTRAR IMPUESTOS
	=============================================*/

	static public function ctrMostrarImpuestos($item, $valor){

		$tabla = "impuestos";

		$respuesta = ModeloImpuestos::mdlMostrarImpuestos($tabla, $item, $valor);

		return $respuesta;
	
	}

	static public function ctrMostrarDocumentos($item, $valor){

		$tabla = "documentos";

		$respuesta = ModeloImpuestos::mdlMostrarDocumentos($tabla, $item, $valor);

		return $respuesta;
	
	}

	/*=============================================
	EDITAR IMPUESTO
	=============================================*/

	static public function ctrEditarImpuesto(){

		if(isset($_POST["editarImpuesto"])){

		

				$tabla = "impuestos";

                $datos = array("id"=>$_POST["idImpuesto"],
                               "nombre"=>$_POST["editarImpuesto"],
                               "factor"=>$_POST["editarFactor"],
                               );


				$respuesta = ModeloImpuestos::mdlEditarImpuesto($tabla, $datos);

				if($respuesta == "ok"){

                    echo'<script>
                    
                    
					swal({
						  type: "success",
						  title: "El Impuesto ha sido editado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "impuestos";

									}
								})

					</script>';

				}


			

		}

	}

	/*=============================================
	BORRAR CATEGORIA
	=============================================*/

	static public function ctrBorrarImpuesto(){

		if(isset($_GET["idImpuesto"])){

			$tabla ="impuestos";
			$datos = $_GET["idImpuesto"];

			$respuesta = ModeloImpuestos::mdlBorrarImpuesto($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

					swal({
						  type: "success",
						  title: "El Impuesto ha sido borrado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "impuestos";

									}
								})

					</script>';
			}
		}
		
	}
}
