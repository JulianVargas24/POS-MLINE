<?php

class ControladorEntradasInventario{

    static public function ctrCrearEntrada(){

		if(isset($_POST["nuevoTipoEntrada1"])){
            $entrada = $_POST["nuevoTipoEntrada1"];
            $datos = array("codigo"=>$_POST["nuevoCodigo1"],
                                "fecha_emision"=>$_POST["nuevaFecha1"],
                                "tipo_entrada"=>$entrada,
                                "observaciones"=>$_POST["nuevaObservacion1"],	
                                "id_bodega_destino"=>$_POST["nuevaBodegaDestino1"],
                                "valor_tipo_entrada"=>$_POST["nuevoValorTipoEntrada1"]);
                                $productos = json_decode($_POST["listaProductos1"], true);
                                $tabla = "entradas";
                                $bodega = $_POST["nuevaBodegaDestino1"];

                                $respuesta = ModeloEntradasInventario::mdlIngresarEntrada($tabla, $datos);
                
                                   
                                
                                   if($respuesta > 0){
                
                                    foreach($productos as $key => $value){
                                        $tabla = "entrada_producto";
                                        $value["id_entrada"] = $respuesta;
                                        $value["id_bodega"] = $bodega;
                                        $res = ModeloEntradasInventario::mdlIngresarProducto($tabla, $value);
                
                                        
                                    } return '<script>
                                    swal({
                                          type: "success",
                                          title: "Entrada guardada exitosamente",
                                          showConfirmButton: true,
                                          confirmButtonText: "Cerrar"
                                          }).then(function(result){
                                                    if (result.value) {
                                                        window.location = "entradas";
                
                                                    }
                                                })
                
                                    </script>';
                
                
                                }else {
                
                                    echo '<script>
                                        console.log("'.var_dump($respuesta).'");
                                        console.log("Error de vida");
                                    </script>';
                
                                }}
                else if(isset($_POST["nuevoTipoEntrada"])){
                $entrada = $_POST["nuevoTipoEntrada"];
                $datos = array("codigo"=>$_POST["nuevoCodigo"],
                                    "fecha_emision"=>$_POST["nuevaFecha"],
                                    "tipo_entrada"=>$entrada,
                                    "observaciones"=>$_POST["nuevaObservacion"],	
                                    "id_bodega_destino"=>$_POST["nuevaBodegaDestino"],
                                    "valor_tipo_entrada"=>$_POST["nuevoValorTipoEntrada"]);
                                    $productos = json_decode($_POST["listaProductos"], true);
                                    $tabla = "entradas";
                                    $bodega = $_POST["nuevaBodegaDestino"];
                                    $respuesta = ModeloEntradasInventario::mdlIngresarEntrada($tabla, $datos);
                    
                                       
                                    
                                       if($respuesta > 0){
                    
                                        foreach($productos as $key => $value){
                                            $tabla = "entrada_producto";
                                            $value["id_entrada"] = $respuesta;
                                            $value["id_bodega"] = $bodega;
                                            $res = ModeloEntradasInventario::mdlIngresarProducto($tabla, $value);
                                            $tabla = "salida_producto";
                                            $value["id_bodega"] = $value["id_bodega_origen"];
                                            $sal = ModeloSalidasInventario::mdlIngresarProducto($tabla, $value);
                    
                                            
                                        } return '<script>
                                        swal({
                                              type: "success",
                                              title: "Entrada guardada exitosamente",
                                              showConfirmButton: true,
                                              confirmButtonText: "Cerrar"
                                              }).then(function(result){
                                                        if (result.value) {
                                                            window.location = "entradas";
                    
                                                        }
                                                    })
                    
                                        </script>';
                    
                    
                                    }else {
                    
                                        echo '<script>
                                            console.log("'.var_dump($respuesta).'");
                                            console.log("Error de vida");
                                        </script>';
                    
                                    } }
                    else if(isset($_POST["nuevoTipoEntrada2"])){
                    $entrada = $_POST["nuevoTipoEntrada2"];   
                    $datos = array("codigo"=>$_POST["nuevoCodigo2"],
                                        "fecha_emision"=>$_POST["nuevaFecha2"],
                                        "tipo_entrada"=>$entrada,
                                        "observaciones"=>$_POST["nuevaObservacion2"],	
                                        "id_bodega_destino"=>$_POST["nuevaBodegaDestino2"],
                                        "valor_tipo_entrada"=>$_POST["nuevoValorTipoEntrada2"]);
                                        $productos = json_decode($_POST["listaProductos2"], true);
                                        $bodega = $_POST["nuevaBodegaDestino2"];
                                        return var_dump($datos);

                                        $tabla = "entradas";


                $respuesta = ModeloEntradasInventario::mdlIngresarEntrada($tabla, $datos);

                   
                
                   if($respuesta > 0){

                    foreach($productos as $key => $value){
                        $tabla = "entrada_producto";
                        $value["id_entrada"] = $respuesta;
                        $value["id_bodega"] = $bodega;
                        $res = ModeloEntradasInventario::mdlIngresarProducto($tabla, $value);

                        
                    } return '<script>
                    swal({
                          type: "success",
                          title: "Entrada guardada exitosamente",
                          showConfirmButton: true,
                          confirmButtonText: "Cerrar"
                          }).then(function(result){
                                    if (result.value) {
                                        window.location = "entradas";

                                    }
                                })

                    </script>';


				}else {

                    echo '<script>
                        console.log("'.var_dump($respuesta).'");
                        console.log("Error de vida");
                    </script>';

                }
                    }
                    else if(isset($_POST["nuevoTipoEntrada3"])){
                        $entrada = $_POST["nuevoTipoEntrada3"];   
                        $datos = array("codigo"=>$_POST["nuevoCodigo3"],
                                            "fecha_emision"=>$_POST["nuevaFecha3"],
                                            "tipo_entrada"=>$entrada,
                                            "observaciones"=>$_POST["nuevaObservacion3"],	
                                            "id_bodega_destino"=>$_POST["nuevaBodegaDestino3"],
                                            "valor_tipo_entrada"=>$_POST["nuevoValorTipoEntrada3"]);
                                            $productos = json_decode($_POST["listaProductos3"], true);
                                            $bodega = $_POST["nuevaBodegaDestino3"];
                                            
    
                                            $tabla = "entradas";
    
    
                    $respuesta = ModeloEntradasInventario::mdlIngresarEntrada($tabla, $datos);
    
                       
                    
                       if($respuesta > 0){
    
                        foreach($productos as $key => $value){

                            
                            $tabla = "entrada_producto";
                            $value["id_entrada"] = $respuesta;
                            $value["id_bodega"] = $bodega;
                            $res = ModeloEntradasInventario::mdlIngresarProducto($tabla, $value);
    
                            
                        } return '<script>
                        swal({
                              type: "success",
                              title: "Entrada guardada exitosamente",
                              showConfirmButton: true,
                              confirmButtonText: "Cerrar"
                              }).then(function(result){
                                        if (result.value) {
                                            window.location = "entradas";
    
                                        }
                                    })
    
                        </script>';
    
    
                    }else {
    
                        echo '<script>
                            console.log("'.var_dump($respuesta).'");
                            console.log("Error de vida");
                        </script>';
    
                    }
                        }
           
       
			   	
			   	
              
                

			
    }
    
    static public function ctrMostrarEntradas(){
        $tabla = "entradas";

		$respuesta = ModeloEntradasInventario::mdlMostrarEntradas($tabla, $item, $valor);

		return $respuesta;
    }
    
   
}


    


	


