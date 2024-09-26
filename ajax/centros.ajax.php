<?php

require_once "../controladores/centros.controlador.php";
require_once "../modelos/centros.modelo.php";

class AjaxCentros{

	/*=============================================
	EDITAR CENTROS
	=============================================*/	

	public $idCentro;

	public function ajaxEditarCentro(){

		$item = "id";
		$valor = $this->idCentro;

		$respuesta = ControladorCentros::ctrMostrarCentros($item, $valor);

		echo json_encode($respuesta);	

	}
}

/*=============================================
EDITAR CENTRO
=============================================*/	    
if(isset($_POST["idCentro"])){

	$centro = new AjaxCentros();
	$centro -> idCentro = $_POST["idCentro"];
	$centro -> ajaxEditarCentro();
}
