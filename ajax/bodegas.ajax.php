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

if (isset($_POST['regionId'])) {
    $regionId = $_POST['regionId'];

    // Llamar al controlador para obtener las comunas de la región seleccionada
    $item = 'region_id';
    $valor = $regionId;
    $comunas = ControladorRegiones::ctrMostrarComunas($item, $valor);

    // Devolver las comunas como JSON
    echo json_encode($comunas);
}