<?php


class ControladorParametrosDocumentos{

	static public function ctrMostrarParametro($item, $valor, $orden){

		$tabla = "productos";

		$respuesta = ModeloProductos::mdlMostrarProductos($tabla, $item, $valor, $orden);

		return $respuesta;

	}

	static public function ctrCrearParametro(){

		$datos = [
			"orden_compra" => filter_input(INPUT_POST, "orden_compra", FILTER_VALIDATE_INT),
			"cotizacion"=>filter_input(INPUT_POST, "cotizacion", FILTER_VALIDATE_INT),
			"boleta" =>filter_input(INPUT_POST, "boleta", FILTER_VALIDATE_INT),
			"factura_exenta" =>filter_input(INPUT_POST, "factura_exenta", FILTER_VALIDATE_INT),
			"factura_afecta" =>filter_input(INPUT_POST, "factura_afecta", FILTER_VALIDATE_INT),
			"orden_vestuario" =>filter_input(INPUT_POST, "orden_vestuario", FILTER_VALIDATE_INT),
			"entrada_inventario" =>filter_input(INPUT_POST, "entrada_inventario", FILTER_VALIDATE_INT),
			"salida_inventario" =>filter_input(INPUT_POST, "salida_inventario", FILTER_VALIDATE_INT),
			"ajuste_inventario" => filter_input(INPUT_POST, "ajuste_inventario", FILTER_VALIDATE_INT),
		];

		$respuesta = ModeloParametrosDocumentos::mdlIngresarParametros("parametros_documentos", $datos);

		if ($respuesta == "ok") {
			echo'<script>
			swal({
				  type: "success",
				  title: "Parametros de documento ha sido guardado correctamente",
				  showConfirmButton: true,
				  confirmButtonText: "Cerrar"
				  })

			</script>';
		}


	}

}
