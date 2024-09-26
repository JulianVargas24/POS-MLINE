<?php

require_once "../controladores/subcategorias.controlador.php";
require_once "../modelos/subcategorias.modelo.php";

class AjaxSubcategorias{

	/*=============================================
	EDITAR CATEGORÍA
	=============================================*/	

	public $id_subcategoria;

	public function ajaxEditarSubcategoria(){

		$item = "id";
		$valor = $this->id_subcategoria;

		$respuesta = ControladorSubcategorias::ctrMostrarSubcategorias($item, $valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR CATEGORÍA
=============================================*/	
if(isset($_POST["id_subcategoria"])){

	$subcategoria = new AjaxSubcategorias();
	$subcategoria -> id_subcategoria = $_POST["id_subcategoria"];
	$subcategoria -> ajaxEditarSubcategoria();
}
