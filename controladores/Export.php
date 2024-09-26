<?php
    function descargarCSV($csv)
    {

        header('Content-Description: File Transfer');
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename=reporte.csv');
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($csv));

        ob_clean();
        flush();
        readfile($csv);

        unlink($csv);
    }

    function ordenCompraCSV($datos)
    {
        $tmpName = tempnam(sys_get_temp_dir(), 'reporte');
        $csv = fopen($tmpName, "w");

        fputcsv($csv, [
            "FECHA", "CODIGO", "PROVEEDOR",
            "FECHA EMISION", "FECHA VENCIMIENTO",
            "CENTRO", "BODEGA", "MEDIO PAGO",
            "PLAZO PAGO", "ESTADO", "SUBTOTAL",
            "TOTAL NETO", "DESCUENTO", "IVA",
            "TOTAL FINAL", "OBSERVACION", "DETALLE",
            "CANTIDAD", "PRECIO", "DESCUENTO", "IVA",
            "TOTAL"
        ]);

        if (count($datos) > 0) {
            foreach ($datos as $dato) {
                fputcsv($csv, [
                    $dato["fecha"], $dato["codigo"], $dato["proveedor"],
                    $dato["fechaEmision"], $dato["fechaVencimiento"],
                    $dato["centro"], $dato["bodega"], $dato["medioPago"],
                    $dato["plazoPago"], $dato["estado"], $dato["subtotal"],
                    $dato["totalNeto"], $dato["descuento"], $dato["iva"],
                    $dato["totalFinal"], $dato["observacion"]
                ]);
                foreach (json_decode($dato["productos"], true) as $producto) {
                    fputcsv($csv, [
                        "", "", "",
                        "", "", "",
                        "", "", "",
                        "", "", "",
                        "", "", "",
                        "", $producto["descripcion"],
                        $producto["cantidad"], $producto["precio"],
                        $producto["descuento"], $producto["iva"],
                        $producto["total"]
                    ]);
                }
            }
        }

        fclose($csv);

        descargarCSV($tmpName);
    }

    function CotizacionCSV($datos)
    {
        $tmpName = tempnam(sys_get_temp_dir(), 'reporte');
        $csv = fopen($tmpName, "w");

        fputcsv($csv, [
            "CLIENTE", "CODIGO",
            "FECHA EMISION", "FECHA VENCIMIENTO",
            "UNIDAD NEGOCIO", "BODEGA", "MEDIO PAGO",
            "PLAZO PAGO", "SUBTOTAL",
            "TOTAL NETO", "DESCUENTO", "IVA",
            "TOTAL FINAL", "OBSERVACION", "DETALLE",
            "CANTIDAD", "PRECIO", "DESCUENTO", "IVA",
            "TOTAL"
        ]);

        if (count($datos) > 0) {
            foreach ($datos as $dato) {
                fputcsv($csv, [
                    $dato["cliente"], $dato["codigo"],
                    $dato["fechaEmision"], $dato["fechaVencimiento"],
                    $dato["unidadNegocio"], $dato["bodega"], $dato["medioPago"],
                    $dato["plazoPago"], $dato["subtotal"],
                    $dato["totalNeto"], $dato["descuento"], $dato["iva"],
                    $dato["totalFinal"], $dato["observacion"]
                ]);
                foreach (json_decode($dato["productos"], true) as $producto) {
                    fputcsv($csv, [
                        "", "", "",
                        "", "", "",
                        "", "", "",
                        "", "", "",
                        "", "", "",
                        "", $producto["descripcion"],
                        $producto["cantidad"], $producto["precio"],
                        $producto["descuento"], $producto["iva"],
                        $producto["total"]
                    ]);
                }
            }
        }

            fclose($csv);

        descargarCSV($tmpName);
    }

?>