<?php

require_once "../controladores/tabla-listas.controlador.php";
require_once "../modelos/tabla-listas.modelo.php";

class AjaxTablaListas{

	/*=============================================
	EDITAR CATEGORÍA
	=============================================*/	

	public $idTablaLista;

	public function ajaxEditarTablaLista(){

		$item = "id";
		$valor = $this->idTablaLista;

		$respuesta = ControladorTablaListas::ctrMostrarTablaListas($item, $valor);

		echo json_encode($respuesta);	

	}
}

/*=============================================
EDITAR CATEGORÍA
=============================================*/	
if(isset($_POST["idTablaLista"])){

	$tablaLista = new AjaxTablaListas();
	$tablaLista -> idTablaLista = $_POST["idTablaLista"];
	$tablaLista -> ajaxEditarTablaLista();
}