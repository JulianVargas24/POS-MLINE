<?php

require_once "../controladores/plazos.controlador.php";
require_once "../modelos/plazos.modelo.php";

class AjaxPlazos{

	/*=============================================
	EDITAR PROVEEDOR
	=============================================*/	

	public $idPlazo;

	public function ajaxEditarPlazo(){

		$item = "id";
		$valor = $this->idPlazo;

		$respuesta = ControladorPlazos::ctrMostrarPlazos($item, $valor);

		echo json_encode($respuesta);


	}

}

/*=============================================
EDITAR PROVEEDOR
=============================================*/	

if(isset($_POST["idPlazo"])){

	$plazo = new AjaxPlazos();
    $plazo -> idPlazo = $_POST["idPlazo"];
	$plazo -> ajaxEditarPlazo();

}