<?php

class ControladorCompra
{
    /**
     * Método para crear una compra
     */
    static public function ctrCrearCompra()
    {
        if (isset($_POST["nuevoCodigo"])) {

            $tabla = "compras";

            $datos = array(
                "codigo" => $_POST["nuevoCodigo"],
                "id_proveedor" => $_POST["nuevoProveedor"],
                "fecha_emision" => $_POST["nuevaFechaEmision"],
                "id_centro" => $_POST["nuevoCentro"],
                "id_bodega" => $_POST["nuevaBodega"],
                "subtotal" => $_POST["nuevoSubtotal"],
                "descuento" => $_POST["nuevoTotalDescuento"],
                "total_neto" => $_POST["nuevoTotalNeto"],
                "iva" => $_POST["nuevoTotalIva"],
                "total_final" => $_POST["nuevoTotalFinal"],
                "id_medio_pago" => $_POST["nuevoMedioPago"],
                "id_plazo_pago" => $_POST["nuevoPlazoPago"],
                "observacion" => $_POST["nuevaObservacion"],
                "productos" => $_POST["listaProductos"],
                "folio_oc" => $_POST["nuevoFolioOC"]
            );

            $respuesta = ModeloCompra::mdlIngresarCompra($tabla, $datos);

            $productos = json_decode($datos["productos"], true);

            foreach ($productos as $producto) {
                $datos = [
                    "id_producto" => $producto["id"],
                    "cantidad" => $producto["cantidad"],
                    "descripcion" => $producto["descripcion"],
                    "id_bodega" => $datos["id_bodega"],
                ];
                ModeloEntradasInventario::mdlEntradaPorCompra($datos);
            }

            if ($respuesta == "ok") {
                echo '<script>
					swal({
						  type: "success",
						  title: "La Compra ha sido guardada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {
									window.location = "compras";
									}
								})
					</script>';
            }
        }
    }

    /**
     * Método para crear una compra con una orden de compra
     */
    static public function ctrCrearCompraConOrden()
    {
        if (isset($_POST["nuevoCodigo"])) {
            $tabla = "compras";
            $datos = array(
                "codigo" => $_POST["nuevoCodigo"],
                "id_proveedor" => $_POST["nuevoProveedor"],
                "fecha_emision" => $_POST["nuevaFechaEmision"],
                "id_centro" => $_POST["nuevoCentro"],
                "id_bodega" => $_POST["nuevaBodega"],
                "subtotal" => $_POST["nuevoSubtotal"],
                "descuento" => $_POST["nuevoTotalDescuento"],
                "total_neto" => $_POST["nuevoTotalNeto"],
                "iva" => $_POST["nuevoTotalIva"],
                "total_final" => $_POST["nuevoTotalFinal"],
                "id_medio_pago" => $_POST["nuevoMedioPago"],
                "id_plazo_pago" => $_POST["nuevoPlazoPago"],
                "observacion" => $_POST["nuevaObservacion"],
                "folio_oc" => $_POST["nuevoFolioOC"],
                "productos" => $_POST["listaProductos"]
            );

            $respuesta = ModeloCompra::mdlIngresarCompra($tabla, $datos);

            $productos = json_decode($datos["productos"], true);
            $respuesta1 = ModeloCompra::mdlActualizarEstadoOrdenCompra($datos);
            /**echo '<pre>';
            var_dump($datos);
            echo '</pre>';
            exit;*/
            foreach ($productos as $producto) {
                $datos = [
                    "id_producto" => $producto["id"],
                    "cantidad" => $producto["cantidad"],
                    "descripcion" => $producto["descripcion"],
                    "id_bodega" => $datos["id_bodega"],
                ];
                ModeloEntradasInventario::mdlEntradaPorCompra($datos);
            }

            if ($respuesta == "ok") {
                echo '<script>
					swal({
						  type: "success",
						  title: "La Compra ha sido guardada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {
									window.location = "compras";
									}
								})
					</script>';
            }
        }
    }

    /**
     * Método para editar una compra
     */
    static public function ctrEditarCompra()
    {
        if (isset($_POST["nuevoCodigo"])) {
            $tabla = "compras";
            $datos = array(
                "id" => $_POST["idCompra"],
                "codigo" => $_POST["nuevoCodigo"],
                "id_proveedor" => $_POST["nuevoProveedor"],
                "fecha_emision" => $_POST["nuevaFechaEmision"],
                "fecha_vencimiento" => $_POST["nuevaFechaVencimiento"],
                "id_centro" => $_POST["nuevoCentro"],
                "id_bodega" => $_POST["nuevaBodega"],
                "id_plazo_pago" => $_POST["nuevoPlazoPago"],
                "id_medio_pago" => $_POST["nuevoMedioPago"],
                "productos" => $_POST["listaProductos"],
                "observacion" => $_POST["nuevaObservacion"],
                "subtotal" => $_POST["nuevoSubtotal"],
                "total_neto" => $_POST["nuevoTotalNeto"],
                "descuento" => $_POST["nuevoTotalDescuento"],
                "iva" => $_POST["nuevoTotalIva"],
                "total_final" => $_POST["nuevoTotalFinal"]
            );

            $respuesta = ModeloCompra::mdlEditarCompra($tabla, $datos);

            if ($respuesta == "ok") {
                echo '<script>
			 swal({
				   type: "success",
				   title: "La compra ha sido actualizada correctamente.",
				   showConfirmButton: true,
				   confirmButtonText: "Cerrar"
				   }).then(function(result){
							 if (result.value) {
							 window.location = "compras";
							 }
						 })
			 </script>';
            } else {
                echo '<script>alert("Error al actualizar la compra.");</script>';
            }
        }
    }

    /**
     * Método para mostrar las compras
     */
    static public function ctrMostrarCompras($item, $valor)
    {
        $tabla = "compras";

        $fechaInicial = isset($_GET["fechaInicial"]) ? $_GET["fechaInicial"] : null;
        $fechaFinal = isset($_GET["fechaFinal"]) ? $_GET["fechaFinal"] : null;

        $respuesta = ModeloCompra::mdlMostrarCompras($tabla, $item, $valor, $fechaInicial, $fechaFinal);

        return $respuesta;
    }

    /**
     * Método para eliminar una compra
     */
    static public function ctrEliminarCompra()
    {
        if (isset($_GET["idCompra"])) {
            $tabla = "compras";
            $datos = $_GET["idCompra"];

            $respuesta = ModeloCompra::mdlEliminarCompra($tabla, $datos);
            if ($respuesta == "ok") {

                echo '<script>
				swal({
					  type: "success",
					  title: "La Compra ha sido borrada correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result){
								if (result.value) {
								window.location = "compras";
								}
							})
				</script>';
            }
        }
    }

    /**
     * Método para descargar el reporte de compras
     */
    static public function ctrDescargarReporteCompra()
    {
        if (isset($_GET["reporte"])) {

            $tabla = "compras";

            // Verificar que ambas fechas están presentes y no están vacías
            if (!empty($_GET["fechaInicial"]) && !empty($_GET["fechaFinal"])) {
                $fechaInicial = $_GET["fechaInicial"];
                $fechaFinal = $_GET["fechaFinal"];
                $orden = ModeloCompra::mdlMostrarCompras($tabla, null, null, $fechaInicial, $fechaFinal);
                $Name = ucfirst($_GET["reporte"]) . ' de compras (' . $fechaInicial . ' al ' . $fechaFinal . ').xls';
            } else {
                // Si no hay fechas se descarga el reporte completo
                $orden = ModeloCompra::mdlMostrarCompras($tabla, null, null);
                $Name = ucfirst($_GET["reporte"]) . ' de compras.xls';
            }

            /*=============================================
            CREAMOS EL ARCHIVO DE EXCEL
            =============================================*/
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
					<td style='font-weight:bold; border:1px solid #eee;'>CÓDIGO</td> 
					<td style='font-weight:bold; border:1px solid #eee;'>PROVEEDOR</td>
					<td style='font-weight:bold; border:1px solid #eee;'>CENTRO DE COSTO</td>
					<td style='font-weight:bold; border:1px solid #eee;'>BODEGA</td>
					<td style='font-weight:bold; border:1px solid #eee;'>ID PRODUCTO</td>
					<td style='font-weight:bold; border:1px solid #eee;'>CANTIDAD</td>
					<td style='font-weight:bold; border:1px solid #eee;'>PRODUCTOS</td>
					<td style='font-weight:bold; border:1px solid #eee;'>PRECIO PRODUCTO</td>
					<td style='font-weight:bold; border:1px solid #eee;'>METODO DE PAGO</td>
					<td style='font-weight:bold; border:1px solid #eee;'>SUBTOTAL</td>
					<td style='font-weight:bold; border:1px solid #eee;'>DESCUENTO</td>	
					<td style='font-weight:bold; border:1px solid #eee;'>TOTAL NETO</td>	
					<td style='font-weight:bold; border:1px solid #eee;'>IVA</td>
					<td style='font-weight:bold; border:1px solid #eee;'>TOTAL FINAL</td>			
					<td style='font-weight:bold; border:1px solid #eee;'>FECHA EMISION</td>		
					</tr>");

            foreach ($orden as $row => $item) {
                $proveedor = ControladorProveedores::ctrMostrarProveedores("id", $item["id_proveedor"]);
                $bodega = ControladorBodegas::ctrMostrarBodegas("id", $item["id_bodega"]);
                $plazos = ControladorPlazos::ctrMostrarPlazos("id", $item["id_plazo_pago"]);
                $medios = ControladorMediosPago::ctrMostrarMedios("id", $item["id_medio_pago"]);
                $centros = ControladorCentros::ctrMostrarCentros("id", $item["id_centro"]);

                echo utf8_decode("<tr>
			 			<td style='border:1px solid #eee;'>" . $item["codigo"] . "</td> 
			 			<td style='border:1px solid #eee;'>" . $proveedor["razon_social"] . "</td>
						 <td style='border:1px solid #eee;'>" . $centros["centro"] . "</td>
						 <td style='border:1px solid #eee;'>" . $bodega["nombre"] . "</td>
						 <td style='border:1px solid #eee;'>");

                $productos = json_decode($item["productos"], true);

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
                    echo number_format($valueProductos["precio"], 0, '', '.') . "<br>";
                }

                echo utf8_decode("</td>
					<td style='border:1px solid #eee;'>" . $medios["medio_pago"] . "</td>
					<td style='border:1px solid #eee;'> $ " . number_format(intval(str_replace(',', '', $item["subtotal"])), 0, '', '.') . "</td>
					<td style='border:1px solid #eee;'> $ " . number_format(intval(str_replace(',', '', $item["descuento"])), 0, '', '.') . "</td>	
					<td style='border:1px solid #eee;'> $ " . number_format(intval(str_replace(',', '', $item["total_neto"])), 0, '', '.') . "</td>	
					<td style='border:1px solid #eee;'> $ " . number_format(intval(str_replace(',', '', $item["iva"])), 0, '', '.') . "</td>	
					<td style='border:1px solid #eee;'> $ " . number_format(intval(str_replace(',', '', $item["total_final"])), 0, '', '.') . "</td>
					<td style='border:1px solid #eee;'>" . substr($item["fecha_emision"], 0, 10) . "</td>		
		 			</tr>");
            }

            echo "</table>";
        }
    }
}
