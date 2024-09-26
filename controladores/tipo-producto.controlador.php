<?php

class ControladorTipoProductos{

	/*=============================================
	CREAR TIPO PRODUCTO
	=============================================*/

	static public function ctrCrearTipoProducto(){

		if(isset($_POST["nuevoTipoProducto"])){


				$tabla = "tipo_productos";

				$datos =  array("nombre"=>$_POST["nuevoTipoProducto"],
                                 "codigo"=>$_POST["nuevoCodigoProducto"]);

				$respuesta = ModeloTipoProductos::mdlIngresarTipoProducto($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El Tipo de Producto ha sido guardado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "tipo-producto";

									}
								})

					</script>';

			} 

		}

	}

	/*=============================================
	MOSTRAR UNIDADES
	=============================================*/

	static public function ctrMostrarTipoProductos($item, $valor){

		$tabla = "tipo_productos";

		$respuesta = ModeloTipoProductos::mdlMostrarTipoProductos($tabla, $item, $valor);

		return $respuesta;
	
    }

    static public function ctrEditarTipoProducto(){

		if(isset($_POST["editarTipoProducto"])){

		

				$tabla = "tipo_productos";

                $datos = array("nombre"=>$_POST["editarTipoProducto"],
                               "codigo"=>$_POST["editarCodigoProducto"],
							   "id"=>$_POST["idTipoProducto"]);

				$respuesta = ModeloTipoProductos::mdlEditarTipoProducto($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El Tipo de Producto ha sido actualizado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "tipo-producto";

									}
								})

					</script>';

				}


			

		}

	}

    static public function ctrEliminarTipoProducto(){

		if(isset($_GET["idTipoProducto"])){

            $tabla ="tipo_productos";
			$datos = $_GET["idTipoProducto"];

			$respuesta = ModeloTipoProductos::mdlEliminarTipoProducto($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

					swal({
						  type: "success",
						  title: "El Tipo de Producto ha sido eliminado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "tipo-producto";

									}
								})

					</script>';
			}
		}
		
	}
    
}