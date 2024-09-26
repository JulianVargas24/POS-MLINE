<?php


class ControladorAjustesInventario{

    static public function ctrCrearAjuste(){


		if(isset($_POST["nuevoCodigo"])){

                   $tabla = "ajustes";
                   

			   	    $datos = array("codigo"=>$_POST["nuevoCodigo"],
                               "fecha_emision"=>$_POST["nuevaFechaEmision"],
                               "causal"=>$_POST["tipoAjuste"],
                               "observaciones"=>$_POST["nuevaObservacion"],	
                               "id_bodega_origen"=>$_POST["nuevaBodega"]);
            
                

                $productos = json_decode($_POST["listaProductos"], true);
                $respuesta = ModeloAjustesInventario::mdlIngresarAjuste($tabla, $datos);
                $bodega_id = $_POST["nuevaBodega"];
                
                   if($respuesta > 0){

                    foreach($productos as $key => $value){
                        $tabla = "ajuste_producto";
                        $value["id_ajuste"] = $respuesta;
                        $value["id_bodega"] = $bodega_id;
                        $res = ModeloAjustesInventario::mdlIngresarProducto($tabla, $value);

                    }

                    return '<script>
                    swal({
                          type: "success",
                          title: "Ajuste guardado exitosamente",
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
    
    static public function ctrMostrarAjustes(){
        $tabla = "ajustes";

        $respuesta = ModeloAjustesInventario::mdlMostrarAjustes($tabla, $item, $valor);

        return $respuesta;
    }


	

}
