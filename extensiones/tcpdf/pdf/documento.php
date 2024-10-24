<?php

require_once "../../../controladores/ventas.controlador.php";
require_once "../../../modelos/ventas.modelo.php";

require_once "../../../controladores/clientes.controlador.php";
require_once "../../../modelos/clientes.modelo.php";

require_once "../../../controladores/usuarios.controlador.php";
require_once "../../../modelos/usuarios.modelo.php";

require_once "../../../controladores/productos.controlador.php";
require_once "../../../modelos/productos.modelo.php";

require_once "../../../controladores/proveedores.controlador.php";
require_once "../../../modelos/proveedores.modelo.php";

require_once "../../../controladores/orden-compra.controlador.php";
require_once "../../../modelos/orden-compra.modelo.php";

require_once "../../../controladores/compra.controlador.php";
require_once "../../../modelos/compra.modelo.php";

require_once "../../../controladores/cotizacion.controlador.php";
require_once "../../../modelos/cotizacion.modelo.php";

require_once "../../../controladores/matrices.controlador.php";
require_once "../../../modelos/matrices.modelo.php";

require_once "../../../controladores/medios-pago.controlador.php";
require_once "../../../modelos/medios-pago.modelo.php";

class imprimirFactura{

	public $codigo;
	public $documento;

	

	public function traerImpresionFactura(){
		$item = null;
		$valor = null;
		$fecha = null;
		$productos = null;
		$neto = null;
		$subtotal= null;
		$iva = null;
		$observacion = null;
		$exento = null;
		$descuento = null;
		$total = null;
		$receptor = null;
		$mediopago = null;		
		$detalle = null;
		$emisor = null;
		$ordenCliente = null;
		$matriz = ControladorMatrices::ctrMostrarMatrices($id, 1);
		switch($this->documento){

			case "Orden_Compra":
				$emisor = ControladorMatrices::ctrMostrarMatrices($item, $valor);
				$item = "codigo";
				$valor = $this->codigo;
				$doc = "ORDEN DE COMPRA";
				$id = "id";
				$detalle = ControladorOrdenCompra::ctrMostrarOrdenCompra($item, $valor); 
				$receptor = ControladorProveedores::ctrMostrarProveedores($id, $detalle["id_proveedor"]);
				$nombre = $receptor["razon_social"];
				$mediopago = ControladorMediosPago::ctrMostrarMedios($id, $detalle["id_medio_pago"]);
				$border = array('width' => 0.8, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 255));

			break;
			case "Compra":
				$emisor = ControladorMatrices::ctrMostrarMatrices($item, $valor);
				$item = "codigo";
				$valor = $this->codigo;
				$doc = "FACTURA DE COMPRA";
				$id = "id";
				$detalle = ControladorCompra::ctrMostrarCompras($item, $valor); 
				$receptor = ControladorProveedores::ctrMostrarProveedores($id, $detalle["id_proveedor"]);
				$nombre = $receptor["razon_social"];
				$mediopago = ControladorMediosPago::ctrMostrarMedios($id, $detalle["id_medio_pago"]);
				$border = array('width' => 0.8, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 255));
			break;

			case "Cotizacion_Afecta":
				$item = "codigo";
				$doc = "COTIZACION AFECTA";
				$valor = $this->codigo;
				$id = "id";
				$detalle= ControladorCotizacion::ctrMostrarCotizaciones($item, $valor);
				$receptor= ControladorClientes::ctrMostrarClientes($id, $detalle["id_cliente"]); 
				$nombre = $receptor["nombre"];
				$condicion = $matriz[0]["condicion_venta"];
				$mediopago = ControladorMediosPago::ctrMostrarMedios($id, $detalle["id_medio_pago"]);
				$border = array('width' => 0.8, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(7, 150, 7));				
			break;

			case "Cotizacion_Exenta":
				$item = "codigo";
				$doc = "COTIZACION EXENTA";
				$valor = $this->codigo;
				$id = "id";
				$detalle = ControladorCotizacion::ctrMostrarCotizacionesExentas($item, $valor);
				$receptor = ControladorClientes::ctrMostrarClientes($id, $detalle["id_cliente"]);
				$nombre = $receptor["nombre"];
				$condicion = $matriz[0]["condicion_venta"];
				$mediopago = ControladorMediosPago::ctrMostrarMedios($id, $detalle["id_medio_pago"]);
				$border = array('width' => 0.8, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(7, 150, 7));
			break;

			case "Factura_Afecta":
				$item = "codigo";
				$doc = "FACTURACION AFECTA";
				$valor = $this->codigo;
				$id = "id";
				$detalle = ControladorVentas::ctrMostrarVentasAfectas($item, $valor);
				$receptor = ControladorClientes::ctrMostrarClientes($id, $detalle["id_cliente"]);
				$nombre = $receptor["nombre"];
				$condicion = $matriz[0]["condicion_venta"];
				$mediopago = ControladorMediosPago::ctrMostrarMedios($id, $detalle["id_medio_pago"]);
				$border = array('width' => 0.8, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(255, 0, 0));
				$documentoCliente = $detalle["documento"];
				$folioDocumento = $detalle["folio_documento"];
				$fechaDocumento = $detalle["fecha_documento"];
				$motivoDocumento = $detalle["motivo_documento"];
			break;

			case "Nota_Credito_Factura_Afecta":
				$item = "codigo";
				$doc = "NOTA DE CRÉDITO DE FACTURACIÓN AFECTA";
				$valor = $this->codigo;
				$id = "id";
				$detalle = ControladorVentas::ctrMostrarVentasBoletasExentas($item, $valor);
				$receptor = ControladorClientes::ctrMostrarClientes($id, $detalle["id_cliente"]);
				$nombre = $receptor["nombre"];
				$condicion = $matriz[0]["condicion_venta"];
				$mediopago = ControladorMediosPago::ctrMostrarMedios($id, $detalle["id_medio_pago"]);
				$documentoCliente = $detalle["documento"];
				$folioDocumento = $detalle["folio_documento"];
				$fechaDocumento = $detalle["fecha_documento"];
				$motivoDocumento = $detalle["motivo_documento"];
				$border = array('width' => 0.8, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(255, 0, 0));
			break;

			case "Factura_Exenta":
				$item = "codigo";
				$doc = "FACTURACION EXENTA";
				$valor = $this->codigo;
				$id = "id";
				$detalle = ControladorVentas::ctrMostrarVentasExentas($item, $valor);
				$receptor = ControladorClientes::ctrMostrarClientes($id, $detalle["id_cliente"]);
				$nombre = $receptor["nombre"];
				$condicion = $matriz[0]["condicion_venta"];
				$mediopago = ControladorMediosPago::ctrMostrarMedios($id, $detalle["id_medio_pago"]);
				$documentoCliente = $detalle["documento"];
				$folioDocumento = $detalle["folio_documento"];
				$fechaDocumento = $detalle["fecha_documento"];
				$motivoDocumento = $detalle["motivo_documento"];
				$border = array('width' => 0.8, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(255, 0, 0));
			break;
					
			case "Nota_Credito_Factura_Exenta":
				$item = "codigo";
				$doc = "NOTA DE CRÉDITO DE FACTURACIÓN EXENTA";
				$valor = $this->codigo;
				$id = "id";
				$detalle = ControladorVentas::ctrMostrarVentasBoletasExentas($item, $valor);
				$receptor = ControladorClientes::ctrMostrarClientes($id, $detalle["id_cliente"]);
				$nombre = $receptor["nombre"];
				$condicion = $matriz[0]["condicion_venta"];
				$mediopago = ControladorMediosPago::ctrMostrarMedios($id, $detalle["id_medio_pago"]);
				$documentoCliente = $detalle["documento"];
				$folioDocumento = $detalle["folio_documento"];
				$fechaDocumento = $detalle["fecha_documento"];
				$motivoDocumento = $detalle["motivo_documento"];
				$border = array('width' => 0.8, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(255, 0, 0));
			break;

			case "Boleta_Exenta":
				$item = "codigo";
				$doc = "BOLETA EXENTA";
				$valor = $this->codigo;
				$id = "id";
				$detalle = ControladorVentas::ctrMostrarVentasBoletasExentas($item, $valor);
				$receptor = ControladorClientes::ctrMostrarClientes($id, $detalle["id_cliente"]);
				$nombre = $receptor["nombre"];
				$condicion = $matriz[0]["condicion_venta"];
				$mediopago = ControladorMediosPago::ctrMostrarMedios($id, $detalle["id_medio_pago"]);
				$documentoCliente = $detalle["documento"];
				$folioDocumento = $detalle["folio_documento"];
				$fechaDocumento = $detalle["fecha_documento"];
				$motivoDocumento = $detalle["motivo_documento"];
				$border = array('width' => 0.8, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(255, 0, 0));
			break;			

			case "Nota_Credito_Boleta_Exenta":
				$item = "codigo";
				$doc = "NOTA DE CRÉDITO DE BOLETA EXENTA";
				$valor = $this->codigo;
				$id = "id";
				$detalle = ControladorVentas::ctrMostrarVentasBoletasExentas($item, $valor);
				$receptor = ControladorClientes::ctrMostrarClientes($id, $detalle["id_cliente"]);
				$nombre = $receptor["nombre"];
				$condicion = $matriz[0]["condicion_venta"];
				$mediopago = ControladorMediosPago::ctrMostrarMedios($id, $detalle["id_medio_pago"]);
				$documentoCliente = $detalle["documento"];
				$folioDocumento = $detalle["folio_documento"];
				$fechaDocumento = $detalle["fecha_documento"];
				$motivoDocumento = $detalle["motivo_documento"];
				$border = array('width' => 0.8, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(255, 0, 0));
			break;

			case "Nota_Credito_Boleta_Afecta":
				$item = "codigo";
				$doc = "NOTA DE CRÉDITO DE BOLETA AFECTA";
				$valor = $this->codigo;
				$id = "id";
				$detalle = ControladorVentas::ctrMostrarVentasBoletasExentas($item, $valor);
				$receptor = ControladorClientes::ctrMostrarClientes($id, $detalle["id_cliente"]);
				$nombre = $receptor["nombre"];
				$condicion = $matriz[0]["condicion_venta"];
				$mediopago = ControladorMediosPago::ctrMostrarMedios($id, $detalle["id_medio_pago"]);
				$documentoCliente = $detalle["documento"];
				$folioDocumento = $detalle["folio_documento"];
				$fechaDocumento = $detalle["fecha_documento"];
				$motivoDocumento = $detalle["motivo_documento"];
				$border = array('width' => 0.8, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(255, 0, 0));
			break;
		}

			$fecha = date("d-m-Y",strtotime($detalle["fecha_emision"]));
			$productos = json_decode($detalle["productos"], true);
			$subtotal = number_format(intval(str_replace(',', '', $detalle["subtotal"])),0,  '', '.');
			$iva = number_format(intval(str_replace(',', '', $detalle["iva"])),0,  '', '.');
			$neto = number_format(intval(str_replace(',', '', $detalle["total_neto"])),0,  '', '.');

			if($detalle["exento"]){
				$exento = number_format(intval(str_replace(',', '', $detalle["exento"])),0,  '', '.');
			}else{
				$exento = 0;
			}
			$descuento = number_format(intval(str_replace(',', '', $detalle["descuento"])),0,  '', '.');
			$total = number_format(intval(str_replace(',', '', $detalle["total_final"])),0,  '', '.');
			$observacion = $detalle["observacion"];


			//REQUERIMOS LA CLASE TCPDF

			require_once('tcpdf_include.php');

			$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

			$pdf->startPageGroup();
		
			$pdf->AddPage();
			// Image($file, $x='', $y='', $w=0, $h=0, $type='', $link='', $align='', $resize=false, $dpi=300, $palign='', $ismask=false, $imgmask=false, $border=0, $fitbox=false, $hidden=false, $fitonpage=false)
			//Cell($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=0, $link='', $stretch=0, $ignore_min_height=false, $calign='T', $valign='M')
			// MultiCell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0)
			// test Cell stretching
			$pdf->Image('images/mline.png', 10, 11, 32, 32, 'PNG');

			//CREACION DE LA PARTE SUPERIOR
			$pdf->Ln(35);
			$pdf->SetFont('helveticaB', '', 11);
			$pdf->Cell(80,0, $matriz[0]["razon_social"], 0, 0, 'R');
			$pdf->SetTextColor(0, 0, 0);
			$pdf->SetLineStyle($border);
			$pdf->MultiCell(60, 0, "\nR.U.T: ".$matriz[0]["rut"]."\n\n ".$doc."\n\n N° ".$valor." \n\n", 1, "C", 0, 1, 140, 20);
			$pdf->SetTextColor(0, 0, 0);
			$pdf->Ln(2);
			$pdf->SetFont('helvetica', '', 9);
			$pdf->Cell(0,0, $matriz[0]["actividad"], 0, 1, 'L');
			$pdf->SetFont('helveticaB', '', 9);
			$pdf->Cell(20, 5, 'Casa Matriz:', 0, 0, 'L');
			$pdf->SetFont('helvetica', '', 9);
			$pdf->Cell(0,5, $matriz[0]["direccion"], 0, 1, 'L');
			$pdf->SetFont('helveticaB', '', 9);
			$pdf->Cell(10, 5, 'Fono:', 0, 0, 'L');
			$pdf->SetFont('helvetica', '', 9);
			$pdf->Cell(0, 5, $matriz[0]["telefono"], 0, 1, 'L');
			$pdf->SetFont('helveticaB', '', 9);
			$pdf->Cell(12, 5, 'Correo:', 0, 0, 'L');
			$pdf->SetFont('helvetica', '', 9);
			$pdf->Cell(0, 5, $matriz[0]["email"], 0, 1, 'L');
			$pdf->Ln(5);

			//PRIMER CUADRO
			$pdf->SetFont('helveticaB', '', 8);
			$pdf->SetLineStyle(array('width' => 0.4, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
			$pdf->Cell(20, 7, 'Razón Social:', 1, 0, 'L');
			$pdf->SetFont('helvetica', '', 8);
			$pdf->Cell(120, 7, $nombre, 'LT', 0, 'L');
			$pdf->SetFont('helveticaB', '', 8);
			$pdf->Cell(20, 7, 'Emisión:', 1, 0, 'L');
			$pdf->SetFont('helvetica', '', 8);
			$pdf->Cell(0, 7, $detalle["fecha_emision"], "RT", 1, 'L');

			$pdf->SetFont('helveticaB', '', 8);
			$pdf->Cell(20, 7, 'R.U.T:', 1, 0, 'L');
			$pdf->SetFont('helvetica', '', 8);
			$pdf->Cell(120, 7, $receptor["rut"], 'L', 0, 'L');
			$pdf->SetFont('helveticaB', '', 8);
			$pdf->Cell(20, 7, 'Teléfono:', 1, 0, 'L');
			$pdf->SetFont('helvetica', '', 8);
			$pdf->Cell(0, 7, $receptor["telefono"], "R", 1, 'L');

			$pdf->SetFont('helveticaB', '', 8);
			$pdf->Cell(20, 7, 'Dirección', 1, 0, 'L');
			$pdf->SetFont('helvetica', '', 8);
			$pdf->Cell(120, 7, $receptor["direccion"], 'L', 0, 'L');
			$pdf->SetFont('helveticaB', '', 8);
			$pdf->Cell(20, 7, 'Forma Pago:', 1, 0, 'L');
			$pdf->SetFont('helvetica', '', 8);
			$pdf->Cell(0, 7, $mediopago["medio_pago"], 'R', 1, 'L');
			
			$pdf->SetFont('helveticaB', '', 8);
			$pdf->Cell(20, 7, 'Región', 1, 0, 'L');
			$pdf->SetFont('helvetica', '', 8);
			$pdf->Cell(120, 7, $receptor["region"], "L", 0, 'L');
			$pdf->SetFont('helveticaB', '', 8);
			$pdf->Cell(20, 7, 'Comuna:', 1, 0, 'L');
			$pdf->SetFont('helvetica', '', 8);
			$pdf->Cell(0, 7, $receptor["comuna"], 'R', 1, 'L');
	
			
			$pdf->SetFont('helveticaB', '', 8);
			$pdf->Cell(20, 7, 'Actividad:', 1, 0, 'L');
			$pdf->SetFont('helvetica', '', 8);
			$pdf->Cell(120, 7, $receptor["actividad"], "LB", 0, 'L');
			$pdf->SetFont('helveticaB', '', 8);
			$pdf->Cell(20, 7, 'Ejecutivo:', 1, 0, 'L');
			$pdf->SetFont('helvetica', '', 8);
			$pdf->Cell(0, 7, $receptor["ejecutivo"], "LBR", 1, 'L');
			$pdf->Ln(2);

			//SEGUNDO CUADRO
			if($documentoCliente){
			$pdf->SetFont('helveticaB', '', 8);
			$pdf->Cell(60, 5, 'Tipo Documento', 1, 0, 'L');
			$pdf->Cell(25, 5, 'Folio', 1, 0, 'L');
			$pdf->Cell(20, 5, 'Fecha', 1, 0, 'L');
			$pdf->Cell(0, 5, 'Motivo', 1, 1, 'L');
			$pdf->SetFont('helvetica', '', 8);
			$pdf->Cell(60, 5, $documentoCliente, 1, 0, 'L');
			$pdf->Cell(25, 5, $folioDocumento, 1, 0, 'L');
			$pdf->Cell(20, 5, $fechaDocumento, 1, 0, 'L');
			$pdf->Cell(0, 5, $motivoDocumento, 1, 1, 'L');
		}
			$pdf->Ln(1);
			//Encabezados de la Tabla
			$pdf->Ln(1);
			$pdf->SetFont('helveticaB', '', 9);
			$pdf->Cell(20, 5, 'Código', 1, 0, 'C');
			$pdf->Cell(60, 5, 'Descripción', 1, 0, 'C');
			$pdf->Cell(30, 5, 'Valor', 1, 0, 'C');
			$pdf->Cell(20, 5, 'Cantidad', 1, 0, 'C');
			$pdf->Cell(20, 5, 'Descuento', 1, 0, 'C');
			$pdf->Cell(20, 5, 'IVA', 1, 0, 'C');
			$pdf->Cell(0, 5, 'Total', 1, 1, 'C');

			//Contenido de la Tabla
			foreach($productos as $item){
				$pdf->SetFont('helvetica', '', 8);
				$pdf->Cell(20, 5, "", "LR", 0, "L");
				$pdf->Cell(60, 5, $item["descripcion"], "LR", 0, 'L');
				$pdf->Cell(30, 5, number_format(intval(str_replace(',', '', $item["precio"])),0,  '', '.'), "LR", 0, 'R');
				$pdf->Cell(20, 5, $item["cantidad"],"LR", 0, 'R');
				$pdf->Cell(20, 5, number_format(intval(str_replace(',', '', $item["descuento"])),0,  '', '.'), "LR", 0, 'R');
				$pdf->Cell(20, 5, number_format(intval(str_replace(',', '', $item["iva"])),0,  '', '.'), "LR", 0, 'R');
				$pdf->Cell(0, 5, number_format(intval(str_replace(',', '', $item["total"])),0,  '', '.'), "LR", 1, 'R');
			}
			
			//RELLENAR EL ESPACIO EN BLANCO
			 if(count($productos) < 17){
				for( $x = count($productos); $x <= 17; $x++){
					$pdf->SetFont('helvetica', '', 9);
				$pdf->Cell(20, 5,"", "LR", 0, 'C');
				$pdf->Cell(60, 5,"", "LR", 0, 'C');
				$pdf->Cell(30, 5, "", "LR", 0, 'C');
				$pdf->Cell(20, 5, "","LR", 0, 'C');
				$pdf->Cell(20, 5, "", "LR", 0, 'C');
				$pdf->Cell(20, 5, "", "LR", 0, 'C');
				$pdf->Cell(0, 5, "", "LR", 1, 'C');
			}
				}  
			
			
			//Cell($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=0, $link='', $stretch=0, $ignore_min_height=false, $calign='T', $valign='M')
			// MultiCell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0)
			

			$pdf->Cell(0, 0, "", "T", 1);
			//QUINTO CUADRO (IZQUIERDA CONDICIONES DE PAGO)
			$pdf->MultiCell(130, 30, $condicion, 1, "L", 0, 0, 10, 229);			
			//CUARTO CUADRO (DERECHA)
			$pdf->SetLineStyle(array('width' => 0.1, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => array(0, 0, 0)));
			$pdf->Cell(10, 5, "", 0, 0, "C");	
			$pdf->SetFont('helveticaB', '', 9);
			$pdf->Cell(0, 5, "Totales", 1, 1, "C");
			$pdf->Cell(140, 0, "", 0, 0);
			$pdf->SetFont('helveticaB', '', 9);
			$pdf->Cell(20, 5, "Subtotal", "TBL", 0, "L");
			$pdf->SetFont('helvetica', '', 9);
			$pdf->Cell(0, 5, $subtotal, 1, 1, "R");
			$pdf->Cell(140, 5, "", 0, 0);
			$pdf->SetFont('helveticaB', '', 9);
			$pdf->Cell(20, 5, "Descuento", "TBL", 0, "L");
			$pdf->SetFont('helvetica', '', 9);
			$pdf->Cell(0, 5, $descuento, 1, 1, "R");
			$pdf->Cell(140, 5, "", 0, 0);
			$pdf->SetFont('helveticaB', '', 9);
			$pdf->Cell(20, 5, "Exento", "TBL", 0, "L");
			$pdf->SetFont('helvetica', '', 9);
			$pdf->Cell(0, 5, $exento, 1, 1, "R");
			$pdf->Cell(140, 5, "", 0, 0);
			$pdf->SetFont('helveticaB', '', 9);
			$pdf->Cell(20, 5, "Neto", "TBL", 0, "L");
			$pdf->SetFont('helvetica', '', 9);
			$pdf->Cell(0, 5, $neto, 1, 1, "R");
			$pdf->SetFont('helveticaB', '', 9);

			if($doc != "BOLETA EXENTA"){
			$pdf->Cell(140, 5, "", 0, 0);
			$pdf->Cell(20, 5, "I.V.A( 19% )", "TBL", 0, "L");
			$pdf->SetFont('helvetica', '', 9);
			$pdf->Cell(0, 5, $iva, 1, 1, "R");}
			$pdf->Cell(140, 5, "", 0, 0);
			$pdf->SetFont('helveticaB', '', 9);
			$pdf->Cell(20, 5, "Total", "TBL", 0, "L");
			$pdf->SetFont('helvetica', '', 9);
			$pdf->Cell(0, 5, $total, 1, 1, "R");
			
			
			// ---------------------------------------------------------
			//SALIDA DEL ARCHIVO 

			//$pdf->Output('factura.pdf', 'D');
			ob_end_clean();
			$pdf->Output('factura.pdf');

		
		
	}
}

$factura = new imprimirFactura;
$factura -> codigo = $_GET["codigo"];
$factura -> documento = $_GET["documento"];
$factura -> traerImpresionFactura();

?>