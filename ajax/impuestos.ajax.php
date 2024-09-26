<?php

require_once "../controladores/impuestos.controlador.php";
require_once "../modelos/impuestos.modelo.php";

class AjaxImpuestos{

	/*=============================================
	EDITAR IMPUESTO
	=============================================*/	

	public $idImpuesto;

	public function ajaxEditarImpuesto(){

		$item = "id";
		$valor = $this->idImpuesto;

		$respuesta = ControladorImpuestos::ctrMostrarImpuestos($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR IMPUESTO
=============================================*/	
if(isset($_POST["idImpuesto"])){

	$impuesto = new AjaxImpuestos();
	$impuesto -> idImpuesto = $_POST["idImpuesto"];
	$impuesto -> ajaxEditarImpuesto();
}
