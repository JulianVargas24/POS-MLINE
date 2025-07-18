<?php

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";


class TablaProductosVentasAfectas{


	public function mostrarTablaProductosVentasAfectas(){

		$item = null;
    	$valor = null;
    	$orden = "id";

  		$productos = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);
 		
  		if(count($productos) == 0){

  			echo '{"data": []}';

		  	return;
  		}	
		
  		$datosJson = '{
		  "data": [';

                for($i = 0; $i < count($productos); $i++){

                    if($productos[$i]["tipo_producto"] == "Afecto"){

                    /*=============================================
                    TRAEMOS LA IMAGEN
                    =============================================*/ 

                    $imagen = "<img src='".$productos[$i]["imagen"]."' width='40px'>";

                    /*=============================================
                    STOCK
                    =============================================*/ 

                    if($productos[$i]["stock"] <= $productos[$i]["stock_min"]){

                        $stock = "<button class='btn btn-danger'>".$productos[$i]["stock"]."</button>";

                    }else if($productos[$i]["stock"] > $productos[$i]["stock_min"] && $productos[$i]["stock"] <= $productos[$i]["stock_alerta"]){

                        $stock = "<button class='btn btn-warning'>".$productos[$i]["stock"]."</button>";

                    }else{

                        $stock = "<button class='btn btn-success'>".$productos[$i]["stock"]."</button>";

                    }

                    /*=============================================
                    TRAEMOS LAS ACCIONES
                    =============================================*/ 

                    $botones =  "<div class='btn-group'><button type='button' class='btn btn-primary agregarProducto recuperarBoton' idProducto='".$productos[$i]["id"]."'>Agregar</button></div>"; 

                    $datosJson .='[
                        "'.($i+1).'",
                        "'.$imagen.'",
                        "'.$productos[$i]["codigo"].'",
                        "'.$productos[$i]["descripcion"].'",
                        "'.$botones.'"
                        ],';
                    }
                }
            
		  $datosJson = substr($datosJson, 0, -1);

		 $datosJson .=   '] 

		 }';
		
		echo $datosJson;


	}


}

/*=============================================
ACTIVAR TABLA DE PRODUCTOS
=============================================*/ 
$activarProductosVentas = new TablaProductosVentasAfectas();
$activarProductosVentas -> mostrarTablaProductosVentasAfectas();

