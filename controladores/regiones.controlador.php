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


	/*=============================================
    MOSTRAR DATOS DE COMUNAS CON NOMBRE DE REGIÓN
    =============================================*/
    static public function ctrMostrarDatosConRegion() {

        // Llamada al modelo para obtener los datos
        $respuesta = ModeloRegiones::mdlMostrarDatosConRegion("comunas");

        return $respuesta;  // Devuelve los datos a la vista
    }
    
    
    


}