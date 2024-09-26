<?php

require_once "../controladores/tipo-producto.controlador.php";
require_once "../modelos/tipo-producto.modelo.php";

class AjaxTipoProductos{

	/*=============================================
	EDITAR 
	=============================================*/	

	public $idTipoProducto;

	public function ajaxEditarTipoProducto(){

		$item = "id";
		$valor = $this->idTipoProducto;

		$respuesta = ControladorTipoProductos::ctrMostrarTipoProductos($item, $valor);

		echo json_encode($respuesta);	

	}
}

/*=============================================
EDITAR
=============================================*/	    
if(isset($_POST["idTipoProducto"])){

	$tipoProducto = new AjaxTipoProductos();
	$tipoProducto -> idTipoProducto = $_POST["idTipoProducto"];
	$tipoProducto -> ajaxEditarTipoProducto();
}
