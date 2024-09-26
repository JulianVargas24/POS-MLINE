<?php

class ControladorBancos{


	/*=============================================
	MOSTRAR BANCOS
	=============================================*/

	static public function ctrMostrarBancos($item, $valor){

		$tabla = "bancos";

		$respuesta = ModeloBancos::mdlMostrarBancos($tabla, $item, $valor);

		return $respuesta;
	
    }
    
}