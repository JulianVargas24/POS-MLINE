<?php

require_once "../controladores/personal.controlador.php";
require_once "../modelos/personal.modelo.php";
require_once "../controladores/clientes.controlador.php";
require_once "../modelos/clientes.modelo.php";


class TablaPersonalVestuario{

 	/*=============================================
 	 MOSTRAR LA TABLA DE PRODUCTOS
  	=============================================*/ 

	public function mostrarTablaPersonalVestuario(){

		$item = null;
    	$valor = null;
    	$orden = "id";

  		$personal = ControladorPersonal::ctrMostrarPersonal($item, $valor);
		$clientes = ControladorClientes::ctrMostrarClientes($item, $valor);
	  
		if(count($personal) == 0){

  			echo '{"data": []}';

		  	return;
  		}	
		
  		$datosJson = '{
		  "data": [';

		  for($i = 0; $i < count($personal); $i++){
			for($x = 0; $x < count($clientes); $x++){
				if ($clientes[$x]["id"] == $personal[$i]["id_cliente"]) {
				  $cliente = $clientes[$x]["nombre"];
				  $idCliente = $clientes[$x]["id"];
				}
			  }
		  	$botones =  "<div class='btn-group'><button type='button' class='btn btn-primary agregarPersonal recuperarBoton' idCliente ='".$idCliente."' idPersonal='".$personal[$i]["id"]."'>Agregar</button></div>"; 

		  	$datosJson .='[
			      "'.($i+1).'",
			      "'.$personal[$i]["nombre"].'",
			      "'.$personal[$i]["rut"].'",
				  "'.$cliente.'",
			      "'.$botones.'"
			    ],';

		  }

		  $datosJson = substr($datosJson, 0, -1);

		 $datosJson .=   '] 

		 }';
		
		echo $datosJson;


	}


}

$activarPersonalVestuario = new TablaPersonalVestuario();
$activarPersonalVestuario -> mostrarTablaPersonalVestuario();