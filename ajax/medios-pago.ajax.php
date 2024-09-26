<?php

require_once "../controladores/medios-pago.controlador.php";
require_once "../modelos/medios-pago.modelo.php";

class AjaxMedios{

	/*=============================================
	EDITAR MEDIOS PAGO
	=============================================*/	

	public $idMedio;

	public function ajaxEditarMedio(){

		$item = "id";
		$valor = $this->idMedio;

		$respuesta = ControladorMediosPago::ctrMostrarMedios($item, $valor);

		echo json_encode($respuesta);	

	}
}

/*=============================================
EDITAR MEDIOS PAGO
=============================================*/	
if(isset($_POST["idMedio"])){

	$categoria = new AjaxMedios();
	$categoria -> idMedio = $_POST["idMedio"];
	$categoria -> ajaxEditarMedio();
}
