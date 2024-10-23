<?php

use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

class ControladorVentas{

	/*=============================================
	MOSTRAR VENTAS
	=============================================*/

	static public function ctrMostrarVentasBoletas($item, $valor){

		$tabla = "venta_boleta";

		$respuesta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);
 
		return $respuesta;

	}

	static public function ctrMostrarVentasBoletasExentas($item, $valor){

		$tabla = "venta_boleta_exenta";

		$respuesta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);
 
		return $respuesta;

	}

	static public function ctrMostrarVentasAfectas($item, $valor){

		$tabla = "venta_afecta";

		$respuesta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);
 
		return $respuesta;

	}

	static public function ctrMostrarVentasExentas($item, $valor){

		$tabla = "venta_exenta";

		$respuesta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);
 
		return $respuesta;

	}

	/*=============================================
	CREAR VENTA
	=============================================*/

	static public function ctrCrearVenta(){

		if(isset($_POST["nuevaVenta"])){

			/*=============================================
			ACTUALIZAR LAS COMPRAS DEL CLIENTE Y REDUCIR EL STOCK Y AUMENTAR LAS VENTAS DE LOS PRODUCTOS
			=============================================*/

			if($_POST["listaProductos"] == ""){

					echo'<script>

				swal({
					  type: "error",
					  title: "La venta no se ha ejecuta si no hay productos",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "ventas";

								}
							})

				</script>';

				return;
			}


			$listaProductos = json_decode($_POST["listaProductos"], true);

			$totalProductosComprados = array();

			foreach ($listaProductos as $key => $value) {

			   array_push($totalProductosComprados, $value["cantidad"]);
				
			   $tablaProductos = "productos";

			    $item = "id";
			    $valor = $value["id"];
			    $orden = "id";

			    $traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor, $orden);

				$item1a = "ventas";
				$valor1a = $value["cantidad"] + $traerProducto["ventas"];

			    $nuevasVentas = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1a, $valor1a, $valor);

				$item1b = "stock";
				$valor1b = $value["stock"];

				$nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1b, $valor1b, $valor);


			}

			$tablaClientes = "clientes";

			$item = "id";
			$valor = $_POST["seleccionarCliente"];

			$traerCliente = ModeloClientes::mdlMostrarClientes($tablaClientes, $item, $valor);

			$item1a = "compras";
				
			$valor1a = array_sum($totalProductosComprados) + $traerCliente["compras"];

			$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1a, $valor1a, $valor);

			$item1b = "ultima_compra";

			date_default_timezone_set('America/Santiago');

			$fecha = date('d-m-Y');
			$hora = date('H:i:s');
			$valor1b = $fecha.' '.$hora;

			$fechaCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1b, $valor1b, $valor);

			/*=============================================
			GUARDAR LA COMPRA
			=============================================*/	

			$tabla = "ventas";

			$datos = array("id_vendedor"=>$_POST["idVendedor"],
						   "id_cliente"=>$_POST["seleccionarCliente"],
						   "codigo"=>$_POST["nuevaVenta"],
						   "productos"=>$_POST["listaProductos"],
						   "impuesto"=>$_POST["nuevoPrecioImpuesto"],
						   "neto"=>$_POST["nuevoPrecioNeto"],
						   "total"=>$_POST["totalVenta"],
						   "metodo_pago"=>$_POST["listaMetodoPago"],
						   "total_pagado"=>$_POST["TotalPagado"],
						   "total_pendiente_pago"=>$_POST["TotalPendientePago"],
						   "descuento"=>$_POST["nuevoDescuentoVenta"],
						   "observacion"=>$_POST["nuevaObservacion"]);

			$respuesta = ModeloVentas::mdlIngresarVenta($tabla, $datos, $listaProductos);

			if($respuesta == "ok"){
				echo'<script>

				localStorage.removeItem("rango");

				swal({
					  type: "success",
					  title: "La venta ha sido guardada correctamente",
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

	/*=============================================
	EDITAR VENTA
	=============================================*/

	static public function ctrEditarVenta(){

		if(isset($_POST["editarVenta"])){

			/*=============================================
			FORMATEAR TABLA DE PRODUCTOS Y LA DE CLIENTES
			=============================================*/
			$tabla = "ventas";

			$item = "codigo";
			$valor = $_POST["editarVenta"];

			$traerVenta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);

			/*=============================================
			REVISAR SI VIENE PRODUCTOS EDITADOS
			=============================================*/

			if($_POST["listaProductos"] == ""){

				$listaProductos = $traerVenta["productos"];
				$cambioProducto = false;


			}else{

				$listaProductos = $_POST["listaProductos"];
				$cambioProducto = true;
			}

			if($cambioProducto){

				$productos =  json_decode($traerVenta["productos"], true);

				$totalProductosComprados = array();

				foreach ($productos as $key => $value) {

					array_push($totalProductosComprados, $value["cantidad"]);
					
					$tablaProductos = "productos";

					$item = "id";
					$valor = $value["id"];
					$orden = "id";

					$traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor, $orden);

					$item1a = "ventas";
					$valor1a = $traerProducto["ventas"] - $value["cantidad"];

					$nuevasVentas = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1a, $valor1a, $valor);

					$item1b = "stock";
					$valor1b = $value["cantidad"] + $traerProducto["stock"];

					$nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1b, $valor1b, $valor);

				}

				$tablaClientes = "clientes";

				$itemCliente = "id";
				$valorCliente = $_POST["seleccionarCliente"];

				$traerCliente = ModeloClientes::mdlMostrarClientes($tablaClientes, $itemCliente, $valorCliente);

				$item1a = "compras";
				$valor1a = $traerCliente["compras"] - array_sum($totalProductosComprados);		

				$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1a, $valor1a, $valorCliente);

				/*=============================================
				ACTUALIZAR LAS COMPRAS DEL CLIENTE Y REDUCIR EL STOCK Y AUMENTAR LAS VENTAS DE LOS PRODUCTOS
				=============================================*/

				$listaProductos_2 = json_decode($listaProductos, true);

				$totalProductosComprados_2 = array();

				foreach ($listaProductos_2 as $key => $value) {

					array_push($totalProductosComprados_2, $value["cantidad"]);
					
					$tablaProductos_2 = "productos";

					$item_2 = "id";
					$valor_2 = $value["id"];
					$orden = "id";

					$traerProducto_2 = ModeloProductos::mdlMostrarProductos($tablaProductos_2, $item_2, $valor_2, $orden);

					$item1a_2 = "ventas";
					$valor1a_2 = $value["cantidad"] + $traerProducto_2["ventas"];

					$nuevasVentas_2 = ModeloProductos::mdlActualizarProducto($tablaProductos_2, $item1a_2, $valor1a_2, $valor_2);

					$item1b_2 = "stock";
					$valor1b_2 = $value["stock"];

					$nuevoStock_2 = ModeloProductos::mdlActualizarProducto($tablaProductos_2, $item1b_2, $valor1b_2, $valor_2);

				}

				$tablaClientes_2 = "clientes";

				$item_2 = "id";
				$valor_2 = $_POST["seleccionarCliente"];

				$traerCliente_2 = ModeloClientes::mdlMostrarClientes($tablaClientes_2, $item_2, $valor_2);

				$item1a_2 = "compras";

				$valor1a_2 = array_sum($totalProductosComprados_2) + $traerCliente_2["compras"];

				$comprasCliente_2 = ModeloClientes::mdlActualizarCliente($tablaClientes_2, $item1a_2, $valor1a_2, $valor_2);

				$item1b_2 = "ultima_compra";

				date_default_timezone_set('America/Santiago');

				$fecha = date('d-m-Y');
				$hora = date('H:i:s');
				$valor1b_2 = $fecha.' '.$hora;

				$fechaCliente_2 = ModeloClientes::mdlActualizarCliente($tablaClientes_2, $item1b_2, $valor1b_2, $valor_2);

			}

			/*=============================================
			GUARDAR CAMBIOS DE LA COMPRA
			=============================================*/	

			$datos = array("id_vendedor"=>$_POST["idVendedor"],
						   "id_cliente"=>$_POST["seleccionarCliente"],
						   "codigo"=>$_POST["editarVenta"],
						   "productos"=>$listaProductos,
						   "impuesto"=>$_POST["nuevoPrecioImpuesto"],
						   "neto"=>$_POST["nuevoPrecioNeto"],
						   "total"=>$_POST["totalVenta"],
						   "metodo_pago"=>$_POST["editarMetodoPago"],
						   "total_pagado"=>$_POST["TotalPagado"],
						   "total_pendiente_pago"=>$_POST["TotalPendientePago"],
						   "descuento"=>$_POST["nuevoDescuentoVenta"],
						   "observacion"=>$_POST["nuevaObservacion"]);


			$respuesta = ModeloVentas::mdlEditarVenta($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				localStorage.removeItem("rango");

				swal({
					  type: "success",
					  title: "La venta ha sido editada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then((result) => {
								if (result.value) {

								window.location = "ventas";

								}
							})

				</script>';

			}

		}

	}


	/*=============================================
	ELIMINAR VENTA
	=============================================*/

	static public function ctrEliminarVenta(){

		if(isset($_GET["idVenta"])){

			$tabla = "ventas";

			$item = "id";
			$valor = $_GET["idVenta"];

			$traerVenta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);

			/*=============================================
			ACTUALIZAR FECHA ÚLTIMA COMPRA
			=============================================*/

			$tablaClientes = "clientes";

			$itemVentas = null;
			$valorVentas = null;

			$traerVentas = ModeloVentas::mdlMostrarVentas($tabla, $itemVentas, $valorVentas);

			$guardarFechas = array();

			foreach ($traerVentas as $key => $value) {
				
				if($value["id_cliente"] == $traerVenta["id_cliente"]){

					array_push($guardarFechas, $value["fecha"]);

				}

			}

			if(count($guardarFechas) > 1){

				if($traerVenta["fecha"] > $guardarFechas[count($guardarFechas)-2]){

					$item = "ultima_compra";
					$valor = $guardarFechas[count($guardarFechas)-2];
					$valorIdCliente = $traerVenta["id_cliente"];

					$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item, $valor, $valorIdCliente);

				}else{

					$item = "ultima_compra";
					$valor = $guardarFechas[count($guardarFechas)-1];
					$valorIdCliente = $traerVenta["id_cliente"];

					$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item, $valor, $valorIdCliente);

				}


			}else{

				$item = "ultima_compra";
				$valor = "0000-00-00 00:00:00";
				$valorIdCliente = $traerVenta["id_cliente"];

				$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item, $valor, $valorIdCliente);

			}

			/*=============================================
			FORMATEAR TABLA DE PRODUCTOS Y LA DE CLIENTES
			=============================================*/

			$productos =  json_decode($traerVenta["productos"], true);

			$totalProductosComprados = array();

			foreach ($productos as $key => $value) {

				array_push($totalProductosComprados, $value["cantidad"]);
				
				$tablaProductos = "productos";

				$item = "id";
				$valor = $value["id"];
				$orden = "id";

				$traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor, $orden);

				$item1a = "ventas";
				$valor1a = $traerProducto["ventas"] - $value["cantidad"];

				$nuevasVentas = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1a, $valor1a, $valor);

				$item1b = "stock";
				$valor1b = $value["cantidad"] + $traerProducto["stock"];

				$nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1b, $valor1b, $valor);

			}

			$tablaClientes = "clientes";

			$itemCliente = "id";
			$valorCliente = $traerVenta["id_cliente"];

			$traerCliente = ModeloClientes::mdlMostrarClientes($tablaClientes, $itemCliente, $valorCliente);

			$item1a = "compras";
			$valor1a = $traerCliente["compras"] - array_sum($totalProductosComprados);

			$comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1a, $valor1a, $valorCliente);

			/*=============================================
			ELIMINAR VENTA
			=============================================*/

			$respuesta = ModeloVentas::mdlEliminarVenta($tabla, $_GET["idVenta"]);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "La venta ha sido borrada correctamente",
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

	/*=============================================
	RANGO FECHAS
	=============================================*/	

	static public function ctrRangoFechasVentas($fechaInicial, $fechaFinal){

		$tabla = "ventas";

		$respuesta = ModeloVentas::mdlRangoFechasVentas($tabla, $fechaInicial, $fechaFinal);

		return $respuesta;
		
	}

	/*=============================================
	DESCARGAR EXCEL
	=============================================*/

	public function ctrDescargarReporteVentasGeneral(){

		if (isset($_GET["reporte"])) {

            $tabla = "venta_afecta";

            if (isset($_GET["fechaInicial"]) && isset($_GET["fechaFinal"])) {

                $ventas = ModeloVentas::mdlRangoFechasVentas($tabla, $_GET["fechaInicial"], $_GET["fechaFinal"]);
            } else {

                $item = null;
                $valor = null;

                $ventas = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);
				$exentas = ModeloVentas::mdlMostrarVentas("venta_exenta", $item, $valor);
				$boletas = ModeloVentas::mdlMostrarVentas("venta_boleta", $item, $valor);
				$boletaExenta = ModeloVentas::mdlMostrarVentas("venta_boleta_exenta", $item, $valor);
				$notacredito = ModeloVentas::mdlMostrarVentas("nota_credito", $item, $valor);
				$notacreditoboleta = ModeloVentas::mdlMostrarVentas("nota_credito_boleta", $item, $valor);
				$notacreditoexenta = ModeloVentas::mdlMostrarVentas("nota_credito_exenta", $item, $valor);
            }


            /*=============================================
            CREAMOS EL ARCHIVO DE EXCEL
            =============================================*/

            $Name = $_GET["reporte"] . '-venta-generales.xls';

            header('Expires: 0');
            header('Cache-control: private');
            header("Content-type: application/vnd.ms-excel"); // Archivo de Excel
            header("Cache-Control: cache, must-revalidate");
            header('Content-Description: File Transfer');
            header('Last-Modified: ' . date('D, d M Y H:i:s'));
            header("Pragma: public");
            header('Content-Disposition:; filename="' . $Name . '"');
            header("Content-Transfer-Encoding: binary");

            echo utf8_decode("<table border='0'>");
					echo utf8_decode(" <tr><td>FACTURA ELECTRONICA AFECTA (". count($ventas).")</td></tr>
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
								</tr>
								<tr>
								");
					}
					echo utf8_decode("<tr><td>-</td></tr>");
					echo utf8_decode(" <tr><td>FACTURA ELECTRONICA EXENTA (". count($exentas).")</td></tr>
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

					foreach ($exentas as $row => $item) {

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
					echo utf8_decode("<tr><td>-</td></tr>");
					echo utf8_decode(" <tr><td>BOLETA AFECTA (". count($boletas).")</td></tr>
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

					foreach ($boletas as $row => $item) {

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
					echo utf8_decode("<tr><td>-</td></tr>");
					echo utf8_decode(" <tr><td>BOLETA EXENTA (". count($boletaExenta).")</td></tr>
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

					foreach ($boletaExenta as $row => $item) {

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
							<td style='border:1px solid #eee;'> $ " . number_format(intval(str_replace(',', '', $item["total_final"])), 0,  '', '.') . "</td>	
							<td style='border:1px solid #eee;'> $ 0</td>	
							<td style='border:1px solid #eee;'> $ " . number_format(intval(str_replace(',', '', $item["total_final"])), 0,  '', '.') . "</td>
							<td style='border:1px solid #eee;'>" . substr($item["fecha_emision"], 0, 10) . "</td>		
							</tr>");
					}
					echo utf8_decode("<tr><td>-</td></tr>");
					echo utf8_decode(" <tr><td>NOTA DE CREDITO AFECTA (". count($notacredito).")</td></tr>
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

					foreach ($notacredito as $row => $item) {

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
					echo utf8_decode("<tr><td>-</td></tr>");
					echo utf8_decode(" <tr><td>NOTA DE CREDITO AFECTA BOLETA (". count($notacreditoboleta).")</td></tr>
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

					foreach ($notacreditoboleta as $row => $item) {

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
					echo utf8_decode("<tr><td>-</td></tr>");
					echo utf8_decode(" <tr><td>NOTA DE CREDITO EXENTA (". count($notacreditoexenta).")</td></tr>
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

						foreach ($notacreditoexenta as $row => $item) {

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
					echo utf8_decode("<tr><td>-</td></tr>");


            echo "</table>";
        }

	}


	/*=============================================
	SUMA TOTAL VENTAS
	=============================================*/

	public function ctrSumaTotalVentas(){


		$respuesta = ModeloVentas::mdlSumaTotalVentas();

		return $respuesta;

	}

	static public function ctrSumaTotalVentasPorFecha($fechaInicial, $fechaFinal){
		$respuesta = ModeloVentas::mdlSumaTotalVentasPorFecha($fechaInicial, $fechaFinal);
		return $respuesta;
	}
	
	/*=============================================
	DESCARGAR XML
	=============================================*/

	static public function ctrDescargarXML(){

		if(isset($_GET["xml"])){


			$tabla = "ventas";
			$item = "codigo";
			$valor = $_GET["xml"];

			$ventas = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);

			// PRODUCTOS

			$listaProductos = json_decode($ventas["productos"], true);

			// CLIENTE

			$tablaClientes = "clientes";
			$item = "id";
			$valor = $ventas["id_cliente"];

			$traerCliente = ModeloClientes::mdlMostrarClientes($tablaClientes, $item, $valor);

			// VENDEDOR

			$tablaVendedor = "usuarios";
			$item = "id";
			$valor = $ventas["id_vendedor"];

			$traerVendedor = ModeloUsuarios::mdlMostrarUsuarios($tablaVendedor, $item, $valor);


			

			//http://php.net/manual/es/book.xmlwriter.php

			$objetoXML = new XMLWriter();

			$objetoXML->openURI($_GET["xml"].".xml"); //Creación del archivo XML

			$objetoXML->setIndent(true); //recibe un valor booleano para establecer si los distintos niveles de nodos XML deben quedar indentados o no.

			$objetoXML->setIndentString("\t"); // carácter \t, que corresponde a una tabulación

			$objetoXML->startDocument('1.0', 'utf-8');// Inicio del documento
			
			// $objetoXML->startElement("etiquetaPrincipal");// Inicio del nodo raíz

			// $objetoXML->writeAttribute("atributoEtiquetaPPal", "valor atributo etiqueta PPal"); // Atributo etiqueta principal

			// 	$objetoXML->startElement("etiquetaInterna");// Inicio del nodo hijo

			// 		$objetoXML->writeAttribute("atributoEtiquetaInterna", "valor atributo etiqueta Interna"); // Atributo etiqueta interna

			// 		$objetoXML->text("Texto interno");// Inicio del nodo hijo
			
			// 	$objetoXML->endElement(); // Final del nodo hijo
			
			// $objetoXML->endElement(); // Final del nodo raíz


			$objetoXML->writeRaw('<fe:Invoice xmlns:fe="http://www.dian.gov.co/contratos/facturaelectronica/v1" xmlns:cac="urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2" xmlns:cbc="urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2" xmlns:clm54217="urn:un:unece:uncefact:codelist:specification:54217:2001" xmlns:clm66411="urn:un:unece:uncefact:codelist:specification:66411:2001" xmlns:clmIANAMIMEMediaType="urn:un:unece:uncefact:codelist:specification:IANAMIMEMediaType:2003" xmlns:ext="urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2" xmlns:qdt="urn:oasis:names:specification:ubl:schema:xsd:QualifiedDatatypes-2" xmlns:sts="http://www.dian.gov.co/contratos/facturaelectronica/v1/Structures" xmlns:udt="urn:un:unece:uncefact:data:specification:UnqualifiedDataTypesSchemaModule:2" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.dian.gov.co/contratos/facturaelectronica/v1 ../xsd/DIAN_UBL.xsd urn:un:unece:uncefact:data:specification:UnqualifiedDataTypesSchemaModule:2 ../../ubl2/common/UnqualifiedDataTypeSchemaModule-2.0.xsd urn:oasis:names:specification:ubl:schema:xsd:QualifiedDatatypes-2 ../../ubl2/common/UBL-QualifiedDatatypes-2.0.xsd">');

			$objetoXML->writeRaw('<ext:UBLExtensions>');

			foreach ($listaProductos as $key => $value) {
				
				$objetoXML->text($value["descripcion"].", ");
			
			
			}

			
			

			$objetoXML->writeRaw('</ext:UBLExtensions>');

			$objetoXML->writeRaw('</fe:Invoice>');

			$objetoXML->endDocument(); // Final del documento

			return true;	
		}

	}

}
