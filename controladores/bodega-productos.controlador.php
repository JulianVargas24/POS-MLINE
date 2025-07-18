<?php
//include_once "../modelos/bodegas.modelo.php";
//include_once "../modelos/productos.modelo.php";

class ControladorBodegaProductos{

/*=============================================
MOSTRAR PRODUCTOS
=============================================*/

static public function ctrMostrarProductos($item, $valor, $orden){

    $tabla = "productos";

    $respuesta = ModeloProductos::mdlMostrarProductos($tabla, $item, $valor, $orden);

    return $respuesta;

}

/*=============================================
CREAR PRODUCTO 
=============================================*/

static public function ctrCrearBodegaProducto(){

    if(isset($_POST["nuevaDescripcion"]) && isset($_POST["nuevaBodega"])){

        

              

            $tabla = "bodega_productos";

            $datos = array("id_categoria" => $_POST["nuevaCategoria"],								
                           "codigo" => $_POST["nuevoCodigo"],
                           "id_proveedor" => $_POST["nuevoProveedor"],
                           "descripcion" => $_POST["nuevaDescripcion"],
                           "stock" => $_POST["nuevoStock"],
                           "stock_alerta" => $_POST["nuevoStockAlerta"],
                           "stock_min" => $_POST["nuevoStockMin"],
                           "precio_compra" => $_POST["nuevoPrecioCompra"],
                           "precio_venta" => $_POST["nuevoPrecioVenta"],
                           "id_bodega" => $_POST["nuevaBodega"],
                           "id_subcategoria" => $_POST["nuevaSubcategoria"],
                           "id_medida" => $_POST["nuevaMedida"],
                           "imagen" => $ruta ?? "");

            $respuesta = ModeloProductos::mdlIngresarProducto($tabla, $datos);

            if($respuesta == "ok"){

                echo'<script>
                    swal({
                          type: "success",
                          title: "El producto ha sido guardado correctamente",
                          showConfirmButton: true,
                          confirmButtonText: "Cerrar"
                          }).then(function(result){
                                    if (result.value) {

                                    window.location = "productos";

                                    }
                                })

                    </script>';

            }


        
    }

}

/*=============================================
EDITAR PRODUCTO
=============================================*/

static public function ctrEditarProducto(){

    if(isset($_POST["editarDescripcion"])){

        
               /*=============================================
            VALIDAR IMAGEN
            =============================================*/

               $ruta = $_POST["imagenActual"];

               if(isset($_FILES["editarImagen"]["tmp_name"]) && !empty($_FILES["editarImagen"]["tmp_name"])){

                list($ancho, $alto) = getimagesize($_FILES["editarImagen"]["tmp_name"]);

                $nuevoAncho = 500;
                $nuevoAlto = 500;

                /*=============================================
                CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
                =============================================*/

                $directorio = "vistas/img/productos/".$_POST["editarCodigo"];

                /*=============================================
                PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
                =============================================*/

                if(!empty($_POST["imagenActual"]) && $_POST["imagenActual"] != "vistas/img/productos/default/anonymous.png"){

                    unlink($_POST["imagenActual"]);

                }else{

                    mkdir($directorio, 0755);	
                
                }
                
                /*=============================================
                DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
                =============================================*/

                if($_FILES["editarImagen"]["type"] == "image/jpeg"){

                    /*=============================================
                    GUARDAMOS LA IMAGEN EN EL DIRECTORIO
                    =============================================*/

                    $aleatorio = mt_rand(100,999);

                    $ruta = "vistas/img/productos/".$_POST["editarCodigo"]."/".$aleatorio.".jpg";

                    $origen = imagecreatefromjpeg($_FILES["editarImagen"]["tmp_name"]);						

                    $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                    imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                    imagejpeg($destino, $ruta);

                }

                if($_FILES["editarImagen"]["type"] == "image/png"){

                    /*=============================================
                    GUARDAMOS LA IMAGEN EN EL DIRECTORIO
                    =============================================*/

                    $aleatorio = mt_rand(100,999);

                    $ruta = "vistas/img/productos/".$_POST["editarCodigo"]."/".$aleatorio.".png";

                    $origen = imagecreatefrompng($_FILES["editarImagen"]["tmp_name"]);						

                    $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                    imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                    imagepng($destino, $ruta);

                }

            }

            $tabla = "productos";

            $datos = array("id_categoria" => $_POST["editarCategoria"],								
                           "codigo" => $_POST["editarCodigo"],	
                           "codigoBarra" => $_POST["editarCodigoBarra"],
                           "id_proveedor" => $_POST["editarProveedor"],				   
                           "descripcion" => $_POST["editarDescripcion"],
                           "stock" => $_POST["editarStock"],
                           "stock_alerta" => $_POST["editarStockAlerta"],
                           "stock_min" => $_POST["editarStockMin"],
                           "precio_compra" => $_POST["editarPrecioCompra"],
                           "precio_venta" => $_POST["editarPrecioVenta"],
                           "imagen" => $ruta);

            $respuesta = ModeloProductos::mdlEditarProducto($tabla, $datos);

            if($respuesta == "ok"){

                echo'<script>

                    swal({
                          type: "success",
                          title: "El producto ha sido editado correctamente",
                          showConfirmButton: true,
                          confirmButtonText: "Cerrar"
                          }).then(function(result){
                                    if (result.value) {

                                    window.location = "productos";

                                    }
                                })

                    </script>';

            }


        
    }

}

/*=============================================
BORRAR PRODUCTO
=============================================*/

static public function ctrEliminarProducto(){

    if(isset($_GET["idProducto"])){

        $tabla ="productos";
        $datos = $_GET["idProducto"];

        if($_GET["imagen"] != "" && $_GET["imagen"] != "vistas/img/productos/default/anonymous.png"){

            unlink($_GET["imagen"]);
            rmdir('vistas/img/productos/'.$_GET["codigo"]);

        }

        $respuesta = ModeloProductos::mdlEliminarProducto($tabla, $datos);

        if($respuesta == "ok"){

            echo'<script>

            swal({
                  type: "success",
                  title: "El producto ha sido borrado correctamente",
                  showConfirmButton: true,
                  confirmButtonText: "Cerrar"
                  }).then(function(result){
                            if (result.value) {

                            window.location = "productos";

                            }
                        })

            </script>';

        }		
    }


}

/*=============================================
MOSTRAR SUMA VENTAS
=============================================*/

static public function ctrMostrarSumaVentas(){

    $tabla = "productos";

    $respuesta = ModeloProductos::mdlMostrarSumaVentas($tabla);

    return $respuesta;

}

static public function ctrMostrarProductosPorBodega()
{
    $bodegas = ModeloBodegas::mdlMostrarBodegas("bodegas", null, null);
    $productos = ModeloProductos::mdlMostrarProductos("productos", null, null, "id");

    $data = [];
    foreach($bodegas as $index => $bodega) {
        $data[] = [
            "bodega" => $bodega,
            "productos" => []
        ];
        foreach($productos as $producto) {
            $stock = ModeloProductos::mdlMostrarStockPorBodega($producto["id"], $bodega["id"]);
            $stock = ($stock > 0) ? $stock : 0;
            $data[$index]["productos"][] = [
                "producto" => $producto,
                "stock" => $stock,
            ];
        }
    }

    return "1";
}


}

