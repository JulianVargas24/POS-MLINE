<?php


class ControladorVentaBoleta
{

    /*=============================================
    CREAR COTIZACION
    =============================================*/

    static public function ctrCrearVentaBoleta()
    {

        if (isset($_POST["nuevoCodigo"])) {

            $tabla = "venta_boleta";

            $datos = array(
                "codigo" => $_POST["nuevoCodigo"],
                "id_cliente" => $_POST["nuevoClienteBoleta"],
                "id_vendedor" => $_POST["nuevoVendedor"],
                "fecha_emision" => $_POST["nuevaFechaEmision"],
                "fecha_vencimiento" => $_POST["nuevaFechaVencimiento"],
                "id_unidad_negocio" => $_POST["nuevoNegocio"],
                "id_bodega" => $_POST["nuevaBodega"],
                "subtotal" => $_POST["nuevoSubtotal"],
                "descuento" => $_POST["nuevoTotalDescuento"],
                "total_neto" => $_POST["nuevoTotalNeto"],
                "iva" => $_POST["nuevoTotalIva"],
                "total_final" => $_POST["nuevoTotalFinal"],
                "id_medio_pago" => $_POST["nuevoMedioPago"],
                "id_plazo_pago" => $_POST["nuevoPlazo"],
                "observacion" => $_POST["nuevaObservacion"],
                "pagado" => $_POST["nuevoTotalPagado"],
                "pendiente" => $_POST["nuevoTotalPendiente"],
                "productos" => $_POST["listaProductos"]
            );

            // Imprimir los datos antes de insertarlos
            /*echo '<pre>';
				var_dump($datos);
				echo '</pre>';
				exit; */ // Terminar la ejecución para que no se inserten los datos aún.

            $respuesta = ModeloVentaBoleta::mdlIngresarVentaBoleta($tabla, $datos);
            $productos = json_decode($datos["productos"], true);
            foreach ($productos as $producto) {
                $datos = [
                    "id_producto" => $producto["id"],
                    "cantidad" => $producto["cantidad"],
                    "descripcion" => $producto["descripcion"],
                    "id_bodega" => $datos["id_bodega"],
                ];
                ModeloSalidasInventario::mdlSalidaPorVenta($datos);
            }
            if ($respuesta == "ok") {

                echo '<script>
                    
                    swal({
                          type: "success",
                          title: "La Venta con Boleta afecta ha sido guardada correctamente",
                          showConfirmButton: true,
                          confirmButtonText: "Cerrar"
                          }).then(function(result){
                                    if (result.value) {

                                    window.location = "ventas";

                                    }
                                })

                    </script>';
            }
        }
    }

    static public function ctrCrearVentaBoletaExenta()
    {

        if (isset($_POST["nuevoCodigo"])) {

            $tabla = "venta_boleta_exenta";

            $datos = array(
                "codigo" => $_POST["nuevoCodigo"],
                "id_cliente" => $_POST["nuevoClienteBoleta"],
                "id_vendedor" => $_POST["nuevoVendedor"],
                "fecha_emision" => $_POST["nuevaFechaEmision"],
                "fecha_vencimiento" => $_POST["nuevaFechaVencimiento"],
                "id_unidad_negocio" => $_POST["nuevoNegocio"],
                "id_bodega" => $_POST["nuevaBodega"],
                "subtotal" => $_POST["nuevoSubtotal"],
                "total_final" => $_POST["nuevoTotalFinal"],
                "id_medio_pago" => $_POST["nuevoMedioPago"],
                "id_plazo_pago" => $_POST["nuevoPlazo"],
                "observacion" => $_POST["nuevaObservacion"],
                "descuento" => $_POST["nuevoTotalDescuento"],
                "pagado" => $_POST["nuevoTotalPagado"],
                "pendiente" => $_POST["nuevoTotalPendiente"],
                "productos" => $_POST["listaProductos"]
            );

            $respuesta = ModeloVentaBoleta::mdlIngresarVentaBoletaExenta($tabla, $datos);
            $productos = json_decode($datos["productos"], true);
            foreach ($productos as $producto) {
                $datos = [
                    "id_producto" => $producto["id"],
                    "cantidad" => $producto["cantidad"],
                    "descripcion" => $producto["descripcion"],
                    "id_bodega" => $datos["id_bodega"],
                ];
                ModeloSalidasInventario::mdlSalidaPorVenta($datos);
            }
            if ($respuesta == "ok") {

                echo '<script>
                    
                    swal({
                          type: "success",
                          title: "La Venta con Boleta Exenta ha sido guardada correctamente",
                          showConfirmButton: true,
                          confirmButtonText: "Cerrar"
                          }).then(function(result){
                                    if (result.value) {

                                    window.location = "ventas";

                                    }
                                })

                    </script>';
            }
        }
    }

    static public function ctrDescargarReporteVentaBoleta()
    {

        if (isset($_GET["reporte"])) {

            $tabla = "venta_boleta";

            if (isset($_GET["fechaInicial"]) && isset($_GET["fechaFinal"])) {

                $ventas = ModeloVentas::mdlRangoFechasVentas($tabla, $_GET["fechaInicial"], $_GET["fechaFinal"]);
            } else {

                $item = null;
                $valor = null;

                $ventas = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);
            }


            /*=============================================
            CREAMOS EL ARCHIVO DE EXCEL
            =============================================*/

            $Name = $_GET["reporte"] . '-venta-boleta.xls';

            header('Expires: 0');
            header('Cache-control: private');
            header("Content-type: application/vnd.ms-excel"); // Archivo de Excel
            header("Cache-Control: cache, must-revalidate");
            header('Content-Description: File Transfer');
            header('Last-Modified: ' . date('D, d M Y H:i:s'));
            header("Pragma: public");
            header('Content-Disposition:; filename="' . $Name . '"');
            header("Content-Transfer-Encoding: binary");

            echo utf8_decode("<table border='0'> 

                    <tr> 
                    <td style='font-weight:bold; border:1px solid #eee;'>FOLIO</td> 
                    <td style='font-weight:bold; border:1px solid #eee;'>CLIENTE</td>
                    <td style='font-weight:bold; border:1px solid #eee;'>VENDEDOR</td>
                    <td style='font-weight:bold; border:1px solid #eee;'>BODEGA</td>
                    <td style='font-weight:bold; border:1px solid #eee;'>ID PRODUCTO</td>
                    <td style='font-weight:bold; border:1px solid #eee;'>CANTIDAD</td>
                    <td style='font-weight:bold; border:1px solid #eee;'>PRODUCTOS</td>
                    <td style='font-weight:bold; border:1px solid #eee;'>PRECIO PRODUCTO</td>
                    <td style='font-weight:bold; border:1px solid #eee;'>METODO DE PAGO</td>
                    <td style='font-weight:bold; border:1px solid #eee;'>SUBTOTAL</td>
                    <td style='font-weight:bold; border:1px solid #eee;'>DESCUENTO</td>	
                    <td style='font-weight:bold; border:1px solid #eee;'>EXENTO</td>	
                    <td style='font-weight:bold; border:1px solid #eee;'>IVA</td>
                    <td style='font-weight:bold; border:1px solid #eee;'>TOTAL FINAL</td>			
                    <td style='font-weight:bold; border:1px solid #eee;'>FECHA EMISION</td>		
                    </tr>");

            foreach ($ventas as $row => $item) {

                $cliente = ControladorClientes::ctrMostrarClientes("id", $item["id_cliente"]);
                $vendedor = ControladorPlantel::ctrMostrarPlantel("id", $item["id_vendedor"]);
                $bodega = ControladorBodegas::ctrMostrarBodegas("id", $item["id_bodega"]);
                $plazos = ControladorPlazos::ctrMostrarPlazos("id", $item["id_plazo_pago"]);
                $medios = ControladorMediosPago::ctrMostrarMedios("id", $item["id_medio_pago"]);
                $negocio = ControladorNegocios::ctrMostrarNegocios("id", $item["id_unidad_negocio"]);


                echo utf8_decode("<tr>
                        <td style='border:1px solid #eee;'>" . $item["codigo"] . "</td> 
                        <td style='border:1px solid #eee;'>" . $cliente["nombre"] . "</td>
                         <td style='border:1px solid #eee;'>" . $vendedor["nombre"] . "</td>
                         <td style='border:1px solid #eee;'>" . $bodega["nombre"] . "</td>
                        
                         <td style='border:1px solid #eee;'>");

                $productos =  json_decode($item["productos"], true);

                foreach ($productos as $key => $valueProductos) {

                    echo utf8_decode($valueProductos["id"] . "<br>");
                }
                echo utf8_decode("</td><td style='border:1px solid #eee;'>");

                foreach ($productos as $key => $valueProductos) {

                    echo utf8_decode($valueProductos["cantidad"] . "<br>");
                }

                echo utf8_decode("</td><td style='border:1px solid #eee;'>");

                foreach ($productos as $key => $valueProductos) {

                    echo utf8_decode($valueProductos["descripcion"] . "<br>");
                }

                echo utf8_decode("</td><td style='border:1px solid #eee;'> $ ");

                foreach ($productos as $key => $valueProductos) {

                    echo number_format($valueProductos["precio"], 0,  '', '.') . "<br>";
                }

                echo utf8_decode("</td>
                     <td style='border:1px solid #eee;'>" . $medios["medio_pago"] . "</td>
                    <td style='border:1px solid #eee;'> $ " . number_format(intval(str_replace(',', '', $item["subtotal"])), 0,  '', '.') . "</td>
                    <td style='border:1px solid #eee;'> $ " . number_format(intval(str_replace(',', '', $item["descuento"])), 0,  '', '.') . "</td>	
                    <td style='border:1px solid #eee;'> $ " . number_format(intval(str_replace(',', '', $item["total_neto"])), 0,  '', '.') . "</td>	
                    <td style='border:1px solid #eee;'> $ " . number_format(intval(str_replace(',', '', $item["iva"])), 0,  '', '.') . "</td>	
					<td style='border:1px solid #eee;'> $ " . number_format(intval(str_replace(',', '', $item["total_final"])), 0,  '', '.') . "</td>
					<td style='border:1px solid #eee;'>" . substr($item["fecha_emision"], 0, 10) . "</td>		
		 			</tr>");
            }


            echo "</table>";
        }
    }

    static public function ctrDescargarReporteVentaBoletaExenta()
    {

        if (isset($_GET["reporte"])) {

            $tabla = "venta_boleta_exenta";

            if (isset($_GET["fechaInicial"]) && isset($_GET["fechaFinal"])) {

                $ventas = ModeloVentas::mdlRangoFechasVentas($tabla, $_GET["fechaInicial"], $_GET["fechaFinal"]);
            } else {

                $item = null;
                $valor = null;

                $ventas = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);
            }


            /*=============================================
            CREAMOS EL ARCHIVO DE EXCEL
            =============================================*/

            $Name = $_GET["reporte"] . '-venta-boleta-exenta.xls';

            header('Expires: 0');
            header('Cache-control: private');
            header("Content-type: application/vnd.ms-excel"); // Archivo de Excel
            header("Cache-Control: cache, must-revalidate");
            header('Content-Description: File Transfer');
            header('Last-Modified: ' . date('D, d M Y H:i:s'));
            header("Pragma: public");
            header('Content-Disposition:; filename="' . $Name . '"');
            header("Content-Transfer-Encoding: binary");

            echo utf8_decode("<table border='0'> 

                    <tr> 
                    <td style='font-weight:bold; border:1px solid #eee;'>FOLIO</td> 
                    <td style='font-weight:bold; border:1px solid #eee;'>CLIENTE</td>
                    <td style='font-weight:bold; border:1px solid #eee;'>VENDEDOR</td>
                    <td style='font-weight:bold; border:1px solid #eee;'>BODEGA</td>
                    <td style='font-weight:bold; border:1px solid #eee;'>ID PRODUCTO</td>
                    <td style='font-weight:bold; border:1px solid #eee;'>CANTIDAD</td>
                    <td style='font-weight:bold; border:1px solid #eee;'>PRODUCTOS</td>
                    <td style='font-weight:bold; border:1px solid #eee;'>PRECIO PRODUCTO</td>
                    <td style='font-weight:bold; border:1px solid #eee;'>METODO DE PAGO</td>
                    <td style='font-weight:bold; border:1px solid #eee;'>DESCUENTO</td>	
                    <td style='font-weight:bold; border:1px solid #eee;'>TOTAL FINAL</td>			
                    <td style='font-weight:bold; border:1px solid #eee;'>FECHA EMISION</td>		
                    </tr>");

            foreach ($ventas as $row => $item) {

                $cliente = ControladorClientes::ctrMostrarClientes("id", $item["id_cliente"]);
                $vendedor = ControladorPlantel::ctrMostrarPlantel("id", $item["id_vendedor"]);
                $bodega = ControladorBodegas::ctrMostrarBodegas("id", $item["id_bodega"]);
                $plazos = ControladorPlazos::ctrMostrarPlazos("id", $item["id_plazo_pago"]);
                $medios = ControladorMediosPago::ctrMostrarMedios("id", $item["id_medio_pago"]);
                $negocio = ControladorNegocios::ctrMostrarNegocios("id", $item["id_unidad_negocio"]);


                echo utf8_decode("<tr>
                        <td style='border:1px solid #eee;'>" . $item["codigo"] . "</td> 
                        <td style='border:1px solid #eee;'>" . $cliente["nombre"] . "</td>
                         <td style='border:1px solid #eee;'>" . $vendedor["nombre"] . "</td>
                         <td style='border:1px solid #eee;'>" . $bodega["nombre"] . "</td>
                        
                         <td style='border:1px solid #eee;'>");

                $productos =  json_decode($item["productos"], true);

                foreach ($productos as $key => $valueProductos) {

                    echo utf8_decode($valueProductos["id"] . "<br>");
                }
                echo utf8_decode("</td><td style='border:1px solid #eee;'>");

                foreach ($productos as $key => $valueProductos) {

                    echo utf8_decode($valueProductos["cantidad"] . "<br>");
                }

                echo utf8_decode("</td><td style='border:1px solid #eee;'>");

                foreach ($productos as $key => $valueProductos) {

                    echo utf8_decode($valueProductos["descripcion"] . "<br>");
                }

                echo utf8_decode("</td><td style='border:1px solid #eee;'> $ ");

                foreach ($productos as $key => $valueProductos) {

                    echo number_format($valueProductos["precio"], 0,  '', '.') . "<br>";
                }

                echo utf8_decode("</td>
                     <td style='border:1px solid #eee;'>" . $medios["medio_pago"] . "</td>
                    <td style='border:1px solid #eee;'> $ " . number_format(intval(str_replace(',', '', $item["descuento"])), 0,  '', '.') . "</td>	
					<td style='border:1px solid #eee;'> $ " . number_format(intval(str_replace(',', '', $item["total_final"])), 0,  '', '.') . "</td>
					<td style='border:1px solid #eee;'>" . substr($item["fecha_emision"], 0, 10) . "</td>		
		 			</tr>");
            }


            echo "</table>";
        }
    }

    static public function ctrEliminarVentaBoleta()
    {

        if (isset($_GET["idVenta"])) {

            $tabla = "venta_boleta";
            $datos = $_GET["idVenta"];

            $respuesta = ModeloVentaBoleta::mdlBorrarVentaBoleta($tabla, $datos);

            if ($respuesta == "ok") {

                echo '<script>

				swal({
					  type: "success",
					  title: "La Venta con Boleta ha sido borrada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result){
								if (result.value) {

								window.location = "ventas";

								}
							})

				</script>';
            }
        }
    }
}
