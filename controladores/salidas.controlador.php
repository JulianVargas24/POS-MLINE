<?php
 

class ControladorSalidasInventario{

    static public function ctrCrearSalida(){

		if(isset($_POST["nuevoTipoSalida"])){
			   	$datos = array("codigo"=>$_POST["nuevoCodigo"],
                               "fecha_emision"=>$_POST["nuevaFecha"],
                               "tipo_salida"=>$_POST["nuevoTipoSalida"],
                               "observaciones"=>$_POST["nuevaObservacion"],	
                               "id_bodega_origen"=>$_POST["nuevaBodegaOrigen"],
                               "valor_tipo_salida"=>$_POST["nuevoValorTipoSalida"]);
                               $productos = json_decode($_POST["listaProductos"], true);

                               $tabla = "salidas";
                
                               $respuesta = ModeloSalidasInventario::mdlIngresarSalida($tabla, $datos);
                
                               
                                  if($respuesta > 0){
               
                                   foreach($productos as $key => $value){
                                       $tabla = "salida_producto";
                                       $value["id_salida"] = $respuesta;
                                       $res = ModeloSalidasInventario::mdlIngresarProducto($tabla, $value);
                                       
                                   }
                                   return '<script>
                                   swal({
                                         type: "success",
                                         title: "Salida guardada exitosamente",
                                         showConfirmButton: true,
                                         confirmButtonText: "Cerrar"
                                         }).then(function(result){
                                                   if (result.value) {
               
               
                                                   }
                                               })
               
                                   </script>';
               
               
                               }else {
               
                                   echo '<script>
                                       console.log("'.var_dump($respuesta).'");
                                       console.log("Error de vida");
                                   </script>';
               
                               }
               
                }else if(isset($_POST["nuevoTipoSalida1"])){
                    $datos = array("codigo"=>$_POST["nuevoCodigo1"],
                    "fecha_emision"=>$_POST["nuevaFecha1"],
                    "tipo_salida"=>$_POST["nuevoTipoSalida1"],
                    "observaciones"=>$_POST["nuevaObservacion1"],	
                    "id_bodega_origen"=>$_POST["nuevaBodegaOrigen1"],
                    "valor_tipo_salida"=>$_POST["nuevoValorTipoSalida1"]);
                    $productos = json_decode($_POST["listaProductos1"], true);
                    $tabla = "salidas";
                
                    $respuesta = ModeloSalidasInventario::mdlIngresarSalida($tabla, $datos);
     
                    
                       if($respuesta > 0){
    
                        foreach($productos as $key => $value){
                            $tabla = "salida_producto";
                            $value["id_salida"] = $respuesta;
                            $res = ModeloSalidasInventario::mdlIngresarProducto($tabla, $value);
                            
                        }
                        return '<script>
                        swal({
                              type: "success",
                              title: "Salida guardada exitosamente",
                              showConfirmButton: true,
                              confirmButtonText: "Cerrar"
                              }).then(function(result){
                                        if (result.value) {
    
    
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
        
        static public function ctrMostrarSalidas(){
            $tabla = "salidas";
    
            $respuesta = ModeloSalidasInventario::mdlMostrarSalidas($tabla, $item, $valor);
    
            return $respuesta;
        }

}
    

