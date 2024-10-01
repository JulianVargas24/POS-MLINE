<?php


class ControladorNotaCredito{

	/*=============================================
	CREAR COTIZACION
	=============================================*/

	static public function ctrCrearNotaCredito(){

		if(isset($_POST["nuevoCodigo"])){

			   	$tabla = "nota_credito";

                   $datos = array("codigo"=>$_POST["nuevoCodigo"],
								"id_cliente"=>$_POST["nuevoClienteCotizacion"],
                                "fecha_emision"=>$_POST["nuevaFechaEmision"],
                                "fecha_vencimiento"=>$_POST["nuevaFechaVencimiento"],
                                "id_unidad_negocio"=>$_POST["nuevoNegocio"],	
                                "id_bodega"=>$_POST["nuevaBodega"],
                                "subtotal"=>$_POST["nuevoSubtotal"],
                                "descuento"=>$_POST["nuevoTotalDescuento"],
                                "total_neto"=>$_POST["nuevoTotalNeto"],
                                "iva"=>$_POST["nuevoTotalIva"],
                                "total_final"=>$_POST["nuevoTotalFinal"],
                                "id_medio_pago"=>$_POST["nuevoMedioPago"],
                                "id_plazo_pago"=>$_POST["nuevoPlazoPago"],
                                "observacion"=>$_POST["nuevaObservacion"],
                                "folio_documento"=>$_POST["codigoFactura"],
                                "productos"=>$_POST["listaProductos"],
                                "factura"=>$_POST["codigoFactura"]);
			   	$respuesta = ModeloNotaCredito::mdlIngresarNotaCredito($tabla, $datos);
                $respuesta1 = ModeloNotaCredito::mdlActualizarEstadoFacturaAfecta($datos);
                $productos = json_decode($datos["productos"], true);
                
                foreach($productos as $producto) {
                    $datos = [
                        "id_producto" => $producto["id"],
                        "cantidad" => $producto["cantidad"],
                        "descripcion" => $producto["descripcion"],
                        "id_bodega" => $datos["id_bodega"],
                        ];
                    ModeloEntradasInventario::mdlEntradaPorCompra($datos);
                }
                
			   	if($respuesta == "ok"){
					
                    echo'<script>
					swal({
						  type: "success",
						  title: "La Nota de Credito Afecta ha sido guardada correctamente",
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

    static public function ctrCrearNotaCreditoExenta(){

		if(isset($_POST["nuevoCodigo"])){

			   	$tabla = "nota_credito_exenta";

                   $datos = array("codigo"=>$_POST["nuevoCodigo"],
								"id_cliente"=>$_POST["nuevoClienteCotizacion"],
                                "fecha_emision"=>$_POST["nuevaFechaEmision"],
                                "fecha_vencimiento"=>$_POST["nuevaFechaVencimiento"],
                                "id_unidad_negocio"=>$_POST["nuevoNegocio"],	
                                "id_bodega"=>$_POST["nuevaBodega"],
                                "subtotal"=>$_POST["nuevoSubtotal"],
                                "descuento"=>$_POST["nuevoTotalDescuento"],
                                "exento"=>$_POST["nuevoTotalNeto"],
                                "iva"=>$_POST["nuevoTotalIva"],
                                "total_final"=>$_POST["nuevoTotalFinal"],
                                "id_medio_pago"=>$_POST["nuevoMedioPago"],
                                "id_plazo_pago"=>$_POST["nuevoPlazoPago"],
                                "observacion"=>$_POST["nuevaObservacion"],
                                "folio_documento"=>$_POST["codigoFactura"],
                                "productos"=>$_POST["listaProductos"],
                                "factura"=>$_POST["codigoFactura"]);
			   	$respuesta = ModeloNotaCredito::mdlIngresarNotaCreditoExenta($tabla, $datos);
                $respuesta1 = ModeloNotaCredito::mdlActualizarEstadoFacturaExenta($datos);
                $productos = json_decode($datos["productos"], true);
                
                foreach($productos as $producto) {
                    $datos = [
                        "id_producto" => $producto["id"],
                        "cantidad" => $producto["cantidad"],
                        "descripcion" => $producto["descripcion"],
                        "id_bodega" => $datos["id_bodega"],
                        ];
                    ModeloEntradasInventario::mdlEntradaPorCompra($datos);
                }
                
			   	if($respuesta == "ok"){
					
                    echo'<script>
					swal({
						  type: "success",
						  title: "La Nota de Credito exenta ha sido guardada correctamente",
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

    static public function ctrCrearNotaCreditoBoleta(){

		if(isset($_POST["nuevoCodigo"])){

			   	$tabla = "nota_credito_boleta";

                   $datos = array("codigo"=>$_POST["nuevoCodigo"],
								"id_cliente"=>$_POST["nuevoClienteCotizacion"],
                                "fecha_emision"=>$_POST["nuevaFechaEmision"],
                                "fecha_vencimiento"=>$_POST["nuevaFechaVencimiento"],
                                "id_unidad_negocio"=>$_POST["nuevoNegocio"],	
                                "id_bodega"=>$_POST["nuevaBodega"],
                                "subtotal"=>$_POST["nuevoSubtotal"],
                                "descuento"=>$_POST["nuevoTotalDescuento"],
                                "total_neto"=>$_POST["nuevoTotalNeto"],
                                "iva"=>$_POST["nuevoTotalIva"],
                                "total_final"=>$_POST["nuevoTotalFinal"],
                                "id_medio_pago"=>$_POST["nuevoMedioPago"],
                                "id_plazo_pago"=>$_POST["nuevoPlazoPago"],
                                "observacion"=>$_POST["nuevaObservacion"],
                                "folio_documento"=>$_POST["codigoBoleta"],
                                "productos"=>$_POST["listaProductos"],
                                "boleta"=>$_POST["codigoBoleta"]);
			   	    $respuesta = ModeloNotaCredito::mdlIngresarNotaCreditoBoleta($tabla, $datos);
                   $respuesta1 = ModeloNotaCredito::mdlActualizarEstadoBoleta($datos);
                   $productos = json_decode($datos["productos"], true);
                
                foreach($productos as $producto) {
                    $datos = [
                        "id_producto" => $producto["id"],
                        "cantidad" => $producto["cantidad"],
                        "descripcion" => $producto["descripcion"],
                        "id_bodega" => $datos["id_bodega"],
                        ];
                    ModeloEntradasInventario::mdlEntradaPorCompra($datos);
                }
			   	if($respuesta == "ok"){
					
                    echo'<script>
					swal({
						  type: "success",
						  title: "La Nota de Credito  exenta ha sido guardada correctamente",
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





    static public function  ctrMostrarNotasAfecta(){
        $tabla = "nota_credito";
		$respuesta = ModeloNotaCredito::mdlMostrarNotas($tabla, $item, $valor);

		return $respuesta;
    }
    static public function ctrMostrarNotasExenta(){
        $tabla = "nota_credito_exenta";

		$respuesta = ModeloNotaCredito::mdlMostrarNotas($tabla, $item, $valor);

		return $respuesta;
    }
    static public function ctrMostrarNotasBoleta(){
        $tabla = "nota_credito_boleta";

		$respuesta = ModeloNotaCredito::mdlMostrarNotas($tabla, $item, $valor);

		return $respuesta;
    }

	static public function ctrDescargarReporteNotaCreditoAfecta() {

        if (isset($_GET["reporte"])) {

            $tabla = "nota_credito";

            if (isset($_GET["fechaInicial"]) && isset($_GET["fechaFinal"])) {

                $ventas = ModeloVentas::mdlRangoFechasVentas($tabla, $_GET["fechaInicial"], $_GET["fechaFinal"]);
            } else {

                $item = null;
                $valor = null;

                $notas = ModeloNotaCredito::mdlMostrarNotas($tabla, $item, $valor);
            }


            /*=============================================
            CREAMOS EL ARCHIVO DE EXCEL
            =============================================*/

            $Name = $_GET["reporte"] . '-nota-credito-afecta.xls';

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

            foreach ($notas as $row => $item) {

                $cliente = ControladorClientes::ctrMostrarClientes("id", $item["id_cliente"]);

                $bodega = ControladorBodegas::ctrMostrarBodegas("id", $item["id_bodega"]);
                $plazos = ControladorPlazos::ctrMostrarPlazos("id", $item["id_plazo_pago"]);
                $medios = ControladorMediosPago::ctrMostrarMedios("id", $item["id_medio_pago"]);
                $negocio = ControladorNegocios::ctrMostrarNegocios("id", $item["id_unidad_negocio"]);


                echo utf8_decode("<tr>
                        <td style='border:1px solid #eee;'>" . $item["codigo"] . "</td> 
                        <td style='border:1px solid #eee;'>" . $cliente["nombre"] . "</td>

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

	static public function ctrDescargarReporteNotaCreditoBoleta() {

        if (isset($_GET["reporte"])) {

            $tabla = "nota_credito_boleta";

            if (isset($_GET["fechaInicial"]) && isset($_GET["fechaFinal"])) {

                $ventas = ModeloVentas::mdlRangoFechasVentas($tabla, $_GET["fechaInicial"], $_GET["fechaFinal"]);
            } else {

                $item = null;
                $valor = null;

                $notas = ModeloNotaCredito::mdlMostrarNotas($tabla, $item, $valor);
            }


            /*=============================================
            CREAMOS EL ARCHIVO DE EXCEL
            =============================================*/

            $Name = $_GET["reporte"] . '-nota-credito-boleta.xls';

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

            foreach ($notas as $row => $item) {

                $cliente = ControladorClientes::ctrMostrarClientes("id", $item["id_cliente"]);

                $bodega = ControladorBodegas::ctrMostrarBodegas("id", $item["id_bodega"]);
                $plazos = ControladorPlazos::ctrMostrarPlazos("id", $item["id_plazo_pago"]);
                $medios = ControladorMediosPago::ctrMostrarMedios("id", $item["id_medio_pago"]);
                $negocio = ControladorNegocios::ctrMostrarNegocios("id", $item["id_unidad_negocio"]);


                echo utf8_decode("<tr>
                        <td style='border:1px solid #eee;'>" . $item["codigo"] . "</td> 
                        <td style='border:1px solid #eee;'>" . $cliente["nombre"] . "</td>

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

	static public function ctrDescargarReporteNotaCreditoExenta() {

        if (isset($_GET["reporte"])) {

            $tabla = "nota_credito_exenta";

            if (isset($_GET["fechaInicial"]) && isset($_GET["fechaFinal"])) {

                $ventas = ModeloVentas::mdlRangoFechasVentas($tabla, $_GET["fechaInicial"], $_GET["fechaFinal"]);
            } else {

                $item = null;
                $valor = null;

                $notas = ModeloNotaCredito::mdlMostrarNotas($tabla, $item, $valor);
            }


            /*=============================================
            CREAMOS EL ARCHIVO DE EXCEL
            =============================================*/

            $Name = $_GET["reporte"] . '-nota-credito-exenta.xls';

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

            foreach ($notas as $row => $item) {

                $cliente = ControladorClientes::ctrMostrarClientes("id", $item["id_cliente"]);

                $bodega = ControladorBodegas::ctrMostrarBodegas("id", $item["id_bodega"]);
                $plazos = ControladorPlazos::ctrMostrarPlazos("id", $item["id_plazo_pago"]);
                $medios = ControladorMediosPago::ctrMostrarMedios("id", $item["id_medio_pago"]);
                $negocio = ControladorNegocios::ctrMostrarNegocios("id", $item["id_unidad_negocio"]);


                echo utf8_decode("<tr>
                        <td style='border:1px solid #eee;'>" . $item["codigo"] . "</td> 
                        <td style='border:1px solid #eee;'>" . $cliente["nombre"] . "</td>

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
	
	



}
    