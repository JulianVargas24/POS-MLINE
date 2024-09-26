<?php

require_once "../controladores/plantel.controlador.php";
require_once "../modelos/plantel.modelo.php";

class AjaxPlantel{

	/*=============================================
	EDITAR PLANTEL
	=============================================*/	

	public $idPlantel;

	public function ajaxEditarPlantel(){

		$item = "id";
		$valor = $this->idPlantel;

		$respuesta = ControladorPlantel::ctrMostrarPlantel($item, $valor);

		echo json_encode($respuesta);


	}

}

/*=============================================
EDITAR PLANTEL
=============================================*/	

if(isset($_POST["idPlantel"])){

	$plantel = new AjaxPlantel();
	$plantel -> idPlantel = $_POST["idPlantel"];
	$plantel -> ajaxEditarPlantel();

}