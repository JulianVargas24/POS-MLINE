<?php

class ControladorRegiones{


	/*=============================================
	MOSTRAR REGIONES
	=============================================*/

	static public function ctrMostrarRegiones($item, $valor){

		$tabla = "regiones";

		$respuesta = ModeloRegiones::mdlMostrarRegiones($tabla, $item, $valor);

		return $respuesta;
	
    }

    static public function ctrMostrarComunas($item, $valor){
       
		$tabla = "comunas";
		$respuesta = ModeloRegiones::mdlMostrarComunas($tabla, $item, $valor);

		return $respuesta;
	
    }

    
    
    
}