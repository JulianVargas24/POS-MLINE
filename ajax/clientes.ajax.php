<?php

require_once "../controladores/clientes.controlador.php";
require_once "../modelos/clientes.modelo.php";

class AjaxClientes{

	/*=============================================
	EDITAR CLIENTE
	=============================================*/	

	public $idCliente;

	public function ajaxEditarCliente(){

		$item = "id";
		$valor = $this->idCliente;

		$respuesta = ControladorClientes::ctrMostrarClientes($item, $valor);

		echo json_encode($respuesta);


	}

}

/*=============================================
EDITAR CLIENTE
=============================================*/	

if(isset($_POST["idCliente"])){

	$cliente = new AjaxClientes();
	$cliente -> idCliente = $_POST["idCliente"];
	$cliente -> ajaxEditarCliente();

}

if (isset($_POST['idCliente'])) {
	$idCliente = $_POST['idCliente'];
	$item = "id"; // Campo por el que buscar
	$valor = $idCliente;
  
	// Obtener datos del cliente
	$respuesta = ControladorClientes::ctrMostrarClientes($item, $valor);
  
	// Retornar en formato JSON
	echo json_encode($respuesta);
  }