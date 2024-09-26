<?php


class ControladorVentaFactura
{

    /*=============================================
    CREAR COTIZACION
    =============================================*/

    static public function ctrCrearVentaAfecta(){

        if (isset($_POST["nuevoCodigo"])) {

            $tabla = "venta_afecta";

            $datos = array(
                "codigo" => $_POST["nuevoCodigo"],
                "id_cliente" => $_POST["nuevoClienteFactura"],
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
                "productos" => $_POST["listaProductos"],
                "documento" => $_POST["nuevoDocumento"],
                "folio_documento" => $_POST["nuevoFolioDocumento"],
                "fecha_documento" => $_POST["nuevaFechaDocumento"],
                "motivo_documento" => $_POST["nuevoMotivoDocumento"],
                "razon_documento" => $_POST["nuevaRazonDocumento"],
                "cotizacion" => $_POST["nuevoIdCotizacion"]
            );

            $respuesta = ModeloVentaFactura::mdlIngresarVentaAfecta($tabla, $datos);
            $productos = json_decode($datos["productos"], true);
            foreach($productos as $producto) {
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
                        console.log(" ' . $datos["documento"] . '");
                    swal({
                          type: "success",
                          title: "La Venta con Factura Afecta ha sido guardada correctamente",
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
    static public function ctrCrearVentaAfectaConCotizacion(){

        if (isset($_POST["nuevoCodigo"])) {

            $tabla = "venta_afecta";

            $datos = array(
                "codigo" => $_POST["nuevoCodigo"],
                "id_cliente" => $_POST["nuevoClienteCotizacion"],
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
                "productos" => $_POST["listaProductos"],
                "documento" => $_POST["nuevoDocumento"],
                "folio_documento" => $_POST["nuevoFolioDocumento"],
                "fecha_documento" => $_POST["nuevaFechaDocumento"],
                "motivo_documento" => $_POST["nuevoMotivoDocumento"],
                "razon_documento" => $_POST["nuevaRazonDocumento"],
                "cotizacion" => $_POST["nuevoIdCotizacion"]
            );

            $respuesta1 = ModeloVentaFactura::mdlActualizarEstadoCotizacion($datos);
            $respuesta = ModeloVentaFactura::mdlIngresarVentaAfecta($tabla, $datos);
             $productos = json_decode($datos["productos"], true);
            foreach($productos as $producto) {
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
                        console.log(" ' . $datos["documento"] . '");
                    swal({
                          type: "success",
                          title: "La Venta con Factura Afecta ha sido guardada correctamente",
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
    static public function ctrCrearVentaExentaConCotizacion(){

        if (isset($_POST["nuevoCodigo"])) {

            $tabla = "venta_exenta";

            $datos = array(
                "codigo" => $_POST["nuevoCodigo"],
                "id_cliente" => $_POST["nuevoClienteFactura"],
                "id_vendedor" => $_POST["nuevoVendedor"],
                "fecha_emision" => $_POST["nuevaFechaEmision"],
                "fecha_vencimiento" => $_POST["nuevaFechaVencimiento"],
                "id_unidad_negocio" => $_POST["nuevoNegocio"],
                "id_bodega" => $_POST["nuevaBodega"],
                "subtotal" => $_POST["nuevoSubtotal"],
                "descuento" => $_POST["nuevoTotalDescuento"],
                "exento" => $_POST["nuevoTotalExento"],
                "iva" => $_POST["nuevoTotalIva"],
                "total_final" => $_POST["nuevoTotalFinal"],
                "id_medio_pago" => $_POST["nuevoMedioPago"],
                "id_plazo_pago" => $_POST["nuevoPlazo"],
                "observacion" => $_POST["nuevaObservacion"],
                "pagado" => $_POST["nuevoTotalPagado"],
                "pendiente" => $_POST["nuevoTotalPendiente"],
                "productos" => $_POST["listaProductos"],
                "documento" => $_POST["nuevoDocumento"],
                "folio_documento" => $_POST["nuevoFolioDocumento"],
                "fecha_documento" => $_POST["nuevaFechaDocumento"],
                "motivo_documento" => $_POST["nuevoMotivoDocumento"],
                "razon_documento" => $_POST["nuevaRazonDocumento"],
                "cotizacion" => $_POST["nuevoIdCotizacion"]

            );

            $respuesta1 = ModeloVentaFactura::mdlActualizarEstadoCotizacionExenta($datos);
            $respuesta = ModeloVentaFactura::mdlIngresarVentaAfecta($tabla, $datos);


            if ($respuesta == "ok") {

                echo '<script>
                        console.log(" ' . $datos["documento"] . '");
                    swal({
                          type: "success",
                          title: "La Venta con Factura Exenta ha sido guardada correctamente",
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
    static public function ctrCrearVentaExenta(){

        if (isset($_POST["nuevoCodigo"])) {

            $tabla = "venta_exenta";

            $datos = array(
                "codigo" => $_POST["nuevoCodigo"],
                "id_cliente" => $_POST["nuevoClienteFactura"],
                "id_vendedor" => $_POST["nuevoVendedor"],
                "fecha_emision" => $_POST["nuevaFechaEmision"],
                "fecha_vencimiento" => $_POST["nuevaFechaVencimiento"],
                "id_unidad_negocio" => $_POST["nuevoNegocio"],
                "id_bodega" => $_POST["nuevaBodega"],
                "subtotal" => $_POST["nuevoSubtotal"],
                "descuento" => $_POST["nuevoTotalDescuento"],
                "exento" => $_POST["nuevoTotalExento"],
                "iva" => $_POST["nuevoTotalIva"],
                "total_final" => $_POST["nuevoTotalFinal"],
                "id_medio_pago" => $_POST["nuevoMedioPago"],
                "id_plazo_pago" => $_POST["nuevoPlazo"],
                "observacion" => $_POST["nuevaObservacion"],
                "pagado" => $_POST["nuevoTotalPagado"],
                "pendiente" => $_POST["nuevoTotalPendiente"],
                "productos" => $_POST["listaProductos"],
                "documento" => $_POST["nuevoDocumento"],
                "folio_documento" => $_POST["nuevoFolioDocumento"],
                "fecha_documento" => $_POST["nuevaFechaDocumento"],
                "motivo_documento" => $_POST["nuevoMotivoDocumento"],
                "razon_documento" => $_POST["nuevaRazonDocumento"],
                "cotizacion" => $_POST["nuevoIdCotizacion"]

            );
            $respuesta1 = ModeloVentaFactura::mdlActualizarEstadoCotizacionExenta($datos);
            $respuesta = ModeloVentaFactura::mdlIngresarVentaExenta($tabla, $datos);

            if ($respuesta == "ok") {

                echo '<script>

                    swal({
                          type: "success",
                          title: "La Venta con Factura Exenta ha sido guardada correctamente",
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

    static public function ctrDescargarReporteVentaAfecta() {

        if (isset($_GET["reporte"])) {

            $tabla = "venta_afecta";

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

            $Name = $_GET["reporte"] . '-venta-factura-afecta.xls';

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
                    <td style='font-weight:bold; border:1px solid #eee;'>TOTAL_NETO</td>	
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
    static public function ctrDescargarReporteVentaExenta(){

        if (isset($_GET["reporte"])) {

            $tabla = "venta_exenta";

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

            $Name = $_GET["reporte"] . '-venta-factura-exenta.xls';

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
                    <td style='border:1px solid #eee;'> $ " . number_format(intval(str_replace(',', '', $item["exento"])), 0,  '', '.') . "</td>	
                    <td style='border:1px solid #eee;'> $ " . number_format(intval(str_replace(',', '', $item["iva"])), 0,  '', '.') . "</td>	
                    <td style='border:1px solid #eee;'> $ " . number_format(intval(str_replace(',', '', $item["total_final"])), 0,  '', '.') . "</td>
                    <td style='border:1px solid #eee;'>" . substr($item["fecha_emision"], 0, 10) . "</td>		
                    </tr>");
            }


            echo "</table>";
        }
    }

    static public function ctrEliminarVentaAfecta(){

        if(isset($_GET["idAfecta"])){

			$tabla ="venta_afecta";
			$datos = $_GET["idAfecta"];

			$respuesta = ModeloVentaFactura::mdlBorrarVentaAfecta($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "La Venta Afecta ha sido borrada correctamente",
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
    static public function ctrEliminarVentaExenta(){

        if(isset($_GET["idExenta"])){

			$tabla ="venta_exenta";
			$datos = $_GET["idExenta"];

			$respuesta = ModeloVentaFactura::mdlBorrarVentaExenta($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "La Venta Exenta ha sido borrada correctamente",
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
