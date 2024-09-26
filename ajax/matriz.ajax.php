<?php

require_once "../controladores/matrices.controlador.php";
require_once "../modelos/matrices.modelo.php";

class AjaxMatrices{

	/*=============================================
	EDITAR PROVEEDOR
	=============================================*/	

	public $idMatriz;

	public function ajaxEditarMatriz(){

		$item = "id";
		$valor = $this->idMatriz;

		$respuesta = ControladorMatrices::ctrMostrarMatrices($item, $valor);

		echo json_encode($respuesta);


	}

}

/*=============================================
EDITAR PROVEEDOR
=============================================*/	

if(isset($_POST["idMatriz"])){

	$matriz = new AjaxMatrices();
    $matriz -> idMatriz = $_POST["idMatriz"];
	$matriz -> ajaxEditarMatriz();

}