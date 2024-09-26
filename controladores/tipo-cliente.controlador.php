<?php

class ControladorTipoClientes{

	/*=============================================
	CREAR TIPO CLIENTE
	=============================================*/

	static public function ctrCrearTipoCliente(){

		if(isset($_POST["nuevoTipoCliente"])){


				$tabla = "tipo_clientes";

				$datos =  array("nombre"=>$_POST["nuevoTipoCliente"],
                                 "codigo"=>$_POST["nuevoCodigoCliente"]);

				$respuesta = ModeloTipoClientes::mdlIngresarTipoCliente($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El Tipo de Cliente ha sido guardada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "tipo-cliente";

									}
								})

					</script>';

			} 

		}

	}

	/*=============================================
	MOSTRAR UNIDADES
	=============================================*/

	static public function ctrMostrarTipoClientes($item, $valor){

		$tabla = "tipo_clientes";

		$respuesta = ModeloTipoClientes::mdlMostrarTipoClientes($tabla, $item, $valor);

		return $respuesta;
	
    }

    static public function ctrEditarTipoCliente(){

		if(isset($_POST["editarTipoCliente"])){

		

				$tabla = "tipo_clientes";

                $datos = array("nombre"=>$_POST["editarTipoCliente"],
                               "codigo"=>$_POST["editarCodigoCliente"],
							   "id"=>$_POST["idTipoCliente"]);

				$respuesta = ModeloTipoClientes::mdlEditarTipoCliente($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El Tipo de Cliente ha sido actualizado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "tipo-cliente";

									}
								})

					</script>';

				}


			

		}

	}

    static public function ctrEliminarTipoCliente(){

		if(isset($_GET["idTipoCliente"])){

            $tabla ="tipo_clientes";
			$datos = $_GET["idTipoCliente"];

			$respuesta = ModeloTipoClientes::mdlEliminarTipoCliente($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

					swal({
						  type: "success",
						  title: "El Tipo de Cliente ha sido eliminado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "tipo-cliente";

									}
								})

					</script>';
			}
		}
		
	}
    
}