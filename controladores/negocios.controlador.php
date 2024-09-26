<?php

class ControladorNegocios{

	/*=============================================
	CREAR UNIDADES
	=============================================*/

	static public function ctrCrearNegocio(){

		if(isset($_POST["nuevoNegocio"])){


				$tabla = "unidades_negocio";

				$datos =  array("unidad_negocio"=>$_POST["nuevoNegocio"],
                                 "codigo"=>$_POST["nuevoCodigoUnidad"]);

				$respuesta = ModeloNegocios::mdlIngresarNegocio($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La Unidad de Negocio ha sido guardada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "unidad-negocio";

									}
								})

					</script>';

			} 

		}

	}

	/*=============================================
	MOSTRAR UNIDADES
	=============================================*/

	static public function ctrMostrarNegocios($item, $valor){

		$tabla = "unidades_negocio";

		$respuesta = ModeloNegocios::mdlMostrarNegocios($tabla, $item, $valor);

		return $respuesta;
	
    }

    static public function ctrEditarNegocio(){

		if(isset($_POST["editarNegocio"])){

		

				$tabla = "unidades_negocio";

                $datos = array("unidad_negocio"=>$_POST["editarNegocio"],
                               "codigo"=>$_POST["editarCodigoUnidad"],
							   "id"=>$_POST["idNegocio"]);

				$respuesta = ModeloNegocios::mdlEditarNegocio($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La Unidad de Negocio ha sido actualizada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "unidad-negocio";

									}
								})

					</script>';

				}


			

		}

	}

    static public function ctrEliminarNegocio(){

		if(isset($_GET["idNegocio"])){

            $tabla ="unidades_negocio";
			$datos = $_GET["idNegocio"];

			$respuesta = ModeloNegocios::mdlEliminarNegocio($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

					swal({
						  type: "success",
						  title: "La Unidad de Negocio ha sido eliminada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "unidad-negocio";

									}
								})

					</script>';
			}
		}
		
	}
    
}