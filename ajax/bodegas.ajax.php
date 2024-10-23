<?php

require_once "../controladores/bodegas.controlador.php";
require_once "../modelos/bodegas.modelo.php";

class AjaxBodegas{

	/*=============================================
	EDITAR PROVEEDOR
	=============================================*/	

	public $idBodega;

	public function ajaxEditarBodega(){

		$item = "id";
		$valor = $this->idBodega;

		$respuesta = ControladorBodegas::ctrMostrarBodegas($item, $valor);

		echo json_encode($respuesta);


	}

}

/*=============================================
EDITAR PROVEEDOR
=============================================*/	

if(isset($_POST["idBodega"])){

	$bodega = new AjaxBodegas();
    $bodega -> idBodega = $_POST["idBodega"];
	$bodega -> ajaxEditarBodega();

}