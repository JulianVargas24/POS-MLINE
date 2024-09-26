<?php

require_once "../controladores/listas.controlador.php";
require_once "../modelos/listas.modelo.php";

class AjaxListas{

	/*=============================================
	EDITAR CATEGORÍA
	=============================================*/	

	public $idLista;

	public function ajaxEditarLista(){

		$item = "id";
		$valor = $this->idLista;

		$respuesta = ControladorListas::ctrMostrarListas($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR CATEGORÍA
=============================================*/	
if(isset($_POST["idLista"])){

	$lista = new AjaxListas();
	$lista -> idLista = $_POST["idLista"];
	$lista -> ajaxEditarLista();
}
