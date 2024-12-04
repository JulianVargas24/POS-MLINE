<?php

require_once "../controladores/subunidades.controlador.php";
require_once "../modelos/subunidades.modelo.php";

class AjaxSubunidades{

	/*=============================================
	EDITAR SUBUNIDAD
	=============================================*/	

	public $id_subunidad;

	public function ajaxEditarSubunidad(){

		$item = "id";
		$valor = $this->id_subunidad;

		$respuesta = ControladorSubunidades::ctrMostrarSubunidades($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR CATEGORÍA
=============================================*/	
if(isset($_POST["id_subunidad"])){

	$subunidad = new AjaxSubunidades();
    $subunidad -> id_subunidad = $_POST["id_subunidad"];
    $subunidad -> ajaxEditarSubunidad();
}
