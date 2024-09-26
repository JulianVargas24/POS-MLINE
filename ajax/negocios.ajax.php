<?php

require_once "../controladores/negocios.controlador.php";
require_once "../modelos/negocios.modelo.php";

class AjaxNegocios{

	/*=============================================
	EDITAR NEGOCIOS
	=============================================*/	

	public $idNegocio;

	public function ajaxEditarNegocio(){

		$item = "id";
		$valor = $this->idNegocio;

		$respuesta = ControladorNegocios::ctrMostrarNegocios($item, $valor);

		echo json_encode($respuesta);	

	}
}

/*=============================================
EDITAR CENTRO
=============================================*/	    
if(isset($_POST["idNegocio"])){

	$negocio = new AjaxNegocios();
	$negocio -> idNegocio = $_POST["idNegocio"];
	$negocio -> ajaxEditarNegocio();
}
