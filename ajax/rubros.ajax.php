<?php

require_once "../controladores/rubros.controlador.php";
require_once "../modelos/rubros.modelo.php";

class AjaxRubros{

	/*=============================================
	EDITAR PROVEEDOR
	=============================================*/	

	public $idRubro;

	public function ajaxEditarRubro(){

		$item = "id";
		$valor = $this->idRubro;

		$respuesta = ControladorRubros::ctrMostrarRubros($item, $valor);

		echo json_encode($respuesta);


	}

}

/*=============================================
EDITAR PROVEEDOR
=============================================*/	

if(isset($_POST["idRubro"])){

	$rubro = new AjaxRubros();
    $rubro -> idRubro = $_POST["idRubro"];
	$rubro -> ajaxEditarRubro();

}