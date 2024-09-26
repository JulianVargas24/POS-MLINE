<?php

require_once "../controladores/tipo-cliente.controlador.php";
require_once "../modelos/tipo-cliente.modelo.php";

class AjaxTipoClientes{

	/*=============================================
	EDITAR NEGOCIOS
	=============================================*/	

	public $idTipoCliente;

	public function ajaxEditarTipoCliente(){

		$item = "id";
		$valor = $this->idTipoCliente;

		$respuesta = ControladorTipoClientes::ctrMostrarTipoClientes($item, $valor);

		echo json_encode($respuesta);	

	}
}

/*=============================================
EDITAR CENTRO
=============================================*/	    
if(isset($_POST["idTipoCliente"])){

	$tipoCliente = new AjaxTipoClientes();
	$tipoCliente -> idTipoCliente = $_POST["idTipoCliente"];
	$tipoCliente -> ajaxEditarTipoCliente();
}
