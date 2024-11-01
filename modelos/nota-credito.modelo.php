<?php

require_once "conexion.php";

class ModeloNotaCredito{

	/*=============================================
	CREAR SUBCATEGORIA
	=============================================*/

	static public function mdlIngresarNotaCredito($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(codigo, id_cliente, fecha_emision, fecha_vencimiento, id_unidad_negocio, id_bodega, subtotal, descuento, total_neto, iva, total_final,  id_medio_pago, id_plazo_pago, observacion, productos, folio_documento) 
                                                        VALUES (:codigo, :id_cliente, :fecha_emision, :fecha_vencimiento, :id_unidad_negocio, :id_bodega, :subtotal, :descuento, :total_neto, :iva, :total_final, :id_medio_pago, :id_plazo_pago, :observacion, :productos, :folio_documento)");

        $stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_INT);
        $stmt->bindParam(":fecha_emision", $datos["fecha_emision"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_vencimiento", $datos["fecha_vencimiento"], PDO::PARAM_STR);
        $stmt->bindParam(":id_unidad_negocio", $datos["id_unidad_negocio"], PDO::PARAM_INT);
        $stmt->bindParam(":id_bodega", $datos["id_bodega"], PDO::PARAM_INT);
        $stmt->bindParam(":subtotal", $datos["subtotal"], PDO::PARAM_STR);
        $stmt->bindParam(":descuento", $datos["descuento"], PDO::PARAM_STR);
        $stmt->bindParam(":total_neto", $datos["total_neto"], PDO::PARAM_STR);
        $stmt->bindParam(":iva", $datos["iva"], PDO::PARAM_STR);
        $stmt->bindParam(":total_final", $datos["total_final"], PDO::PARAM_STR);
        $stmt->bindParam(":id_medio_pago", $datos["id_medio_pago"], PDO::PARAM_INT);
        $stmt->bindParam(":id_plazo_pago", $datos["id_plazo_pago"], PDO::PARAM_INT);
        $stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);
        $stmt->bindParam(":observacion", $datos["observacion"], PDO::PARAM_STR);
		$stmt->bindParam(":productos", $datos["productos"], PDO::PARAM_STR);
        $stmt->bindParam(":folio_documento", $datos["folio_documento"], PDO::PARAM_INT);




       

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

    }

    static public function mdlIngresarNotaCreditoBoletaExenta($tabla, $datos) {
        try {
            // Preparar la consulta SQL
            $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(codigo, id_cliente, fecha_emision, fecha_vencimiento, id_unidad_negocio, id_bodega, subtotal, descuento, total_neto, iva, total_final, id_medio_pago, id_plazo_pago, observacion, productos, folio_documento) 
                                                    VALUES (:codigo, :id_cliente, :fecha_emision, :fecha_vencimiento, :id_unidad_negocio, :id_bodega, :subtotal, :descuento, :total_neto, :iva, :total_final, :id_medio_pago, :id_plazo_pago, :observacion, :productos, :folio_documento)");
    
            // Vincular los parámetros
            $stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_INT);
            $stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);
            $stmt->bindParam(":fecha_emision", $datos["fecha_emision"], PDO::PARAM_STR);
            $stmt->bindParam(":fecha_vencimiento", $datos["fecha_vencimiento"], PDO::PARAM_STR);
            $stmt->bindParam(":id_unidad_negocio", $datos["id_unidad_negocio"], PDO::PARAM_INT);
            $stmt->bindParam(":id_bodega", $datos["id_bodega"], PDO::PARAM_INT);
            $stmt->bindParam(":subtotal", $datos["subtotal"], PDO::PARAM_STR);
            $stmt->bindParam(":descuento", $datos["descuento"], PDO::PARAM_STR);
            $stmt->bindParam(":total_neto", $datos["total_neto"], PDO::PARAM_STR);
            $stmt->bindParam(":iva", $datos["iva"], PDO::PARAM_STR);
            $stmt->bindParam(":total_final", $datos["total_final"], PDO::PARAM_STR);
            $stmt->bindParam(":id_medio_pago", $datos["id_medio_pago"], PDO::PARAM_INT);
            $stmt->bindParam(":id_plazo_pago", $datos["id_plazo_pago"], PDO::PARAM_INT);
            $stmt->bindParam(":observacion", $datos["observacion"], PDO::PARAM_STR);
            $stmt->bindParam(":productos", $datos["productos"], PDO::PARAM_STR);
            $stmt->bindParam(":folio_documento", $datos["folio_documento"], PDO::PARAM_INT);
    
            // Ejecutar la sentencia
            if ($stmt->execute()) {
                return "ok"; // Devolver "ok" si la inserción fue exitosa
            } else {
                return "Error en la ejecución de la consulta."; // Mensaje genérico si no se ejecuta
            }
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage(); // Mensaje específico de error
        } finally {
            $stmt->closeCursor();
            $stmt = null; // Limpiar la variable
        }
    }


    static public function mdlIngresarNotaCreditoBoleta($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(codigo, id_cliente, fecha_emision, fecha_vencimiento, id_unidad_negocio, id_bodega, subtotal, descuento, total_neto, iva, total_final,  id_medio_pago, id_plazo_pago, observacion, productos, folio_documento) 
                                                        VALUES (:codigo, :id_cliente, :fecha_emision, :fecha_vencimiento, :id_unidad_negocio, :id_bodega, :subtotal, :descuento, :total_neto, :iva, :total_final, :id_medio_pago, :id_plazo_pago, :observacion, :productos, :folio_documento)");

        $stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_INT);
        $stmt->bindParam(":fecha_emision", $datos["fecha_emision"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_vencimiento", $datos["fecha_vencimiento"], PDO::PARAM_STR);
        $stmt->bindParam(":id_unidad_negocio", $datos["id_unidad_negocio"], PDO::PARAM_INT);
        $stmt->bindParam(":id_bodega", $datos["id_bodega"], PDO::PARAM_INT);
        $stmt->bindParam(":subtotal", $datos["subtotal"], PDO::PARAM_STR);
        $stmt->bindParam(":descuento", $datos["descuento"], PDO::PARAM_STR);
        $stmt->bindParam(":total_neto", $datos["total_neto"], PDO::PARAM_STR);
        $stmt->bindParam(":iva", $datos["iva"], PDO::PARAM_STR);
        $stmt->bindParam(":total_final", $datos["total_final"], PDO::PARAM_STR);
        $stmt->bindParam(":id_medio_pago", $datos["id_medio_pago"], PDO::PARAM_INT);
        $stmt->bindParam(":id_plazo_pago", $datos["id_plazo_pago"], PDO::PARAM_INT);
        $stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);
        $stmt->bindParam(":observacion", $datos["observacion"], PDO::PARAM_STR);
		$stmt->bindParam(":productos", $datos["productos"], PDO::PARAM_STR);
        $stmt->bindParam(":folio_documento", $datos["folio_documento"], PDO::PARAM_INT);




       

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

    }

    static public function mdlIngresarNotaCreditoExenta($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(codigo, id_cliente, fecha_emision, fecha_vencimiento, id_unidad_negocio, id_bodega, subtotal, descuento, exento, iva, total_final,  id_medio_pago, id_plazo_pago, observacion, productos, folio_documento) 
                                                        VALUES (:codigo, :id_cliente, :fecha_emision, :fecha_vencimiento, :id_unidad_negocio, :id_bodega, :subtotal, :descuento, :exento, :iva, :total_final, :id_medio_pago, :id_plazo_pago, :observacion, :productos, :folio_documento)");

        $stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_INT);
        $stmt->bindParam(":fecha_emision", $datos["fecha_emision"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_vencimiento", $datos["fecha_vencimiento"], PDO::PARAM_STR);
        $stmt->bindParam(":id_unidad_negocio", $datos["id_unidad_negocio"], PDO::PARAM_INT);
        $stmt->bindParam(":id_bodega", $datos["id_bodega"], PDO::PARAM_INT);
        $stmt->bindParam(":subtotal", $datos["subtotal"], PDO::PARAM_STR);
        $stmt->bindParam(":descuento", $datos["descuento"], PDO::PARAM_STR);
        $stmt->bindParam(":exento", $datos["exento"], PDO::PARAM_STR);
        $stmt->bindParam(":iva", $datos["iva"], PDO::PARAM_STR);
        $stmt->bindParam(":total_final", $datos["total_final"], PDO::PARAM_STR);
        $stmt->bindParam(":id_medio_pago", $datos["id_medio_pago"], PDO::PARAM_INT);
        $stmt->bindParam(":id_plazo_pago", $datos["id_plazo_pago"], PDO::PARAM_INT);
        $stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);
        $stmt->bindParam(":observacion", $datos["observacion"], PDO::PARAM_STR);
		$stmt->bindParam(":productos", $datos["productos"], PDO::PARAM_STR);
        $stmt->bindParam(":folio_documento", $datos["folio_documento"], PDO::PARAM_INT);




       

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt->close();
		$stmt = null;

    }


    static public function mdlMostrarNotas($tabla, $item, $valor, $fechaInicial = null, $fechaFinal = null){

		// Si se proporcionan fechas, filtra por rango de fechas
		if ($fechaInicial && $fechaFinal) {
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha_emision BETWEEN :fechaInicial AND :fechaFinal");
			$stmt->bindParam(":fechaInicial", $fechaInicial, PDO::PARAM_STR);
			$stmt->bindParam(":fechaFinal", $fechaFinal, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt->fetchAll(); // Devuelve todas las filas que coinciden
		} elseif ($item != null) {
			// Si hay un ítem específico, filtra por ese ítem
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
			$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
			$stmt->execute();
			return $stmt->fetch(); // Devuelve solo una fila
		} else {
			// Si no hay filtros, devuelve todas las cotizaciones
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
			$stmt->execute();
			return $stmt->fetchAll(); // Devuelve todas las filas
		}

	}

    static public function mdlActualizarEstadoFacturaAfecta($datos)
    {

        $estado = 'Cerrada';

        $stmt = Conexion::conectar()->prepare("UPDATE venta_afecta SET estado = :estado WHERE codigo = :id;");


        $stmt->bindParam(":estado", $estado, PDO::PARAM_STR);
        $stmt->bindParam(":id", $datos["factura"], PDO::PARAM_INT);
        if ($stmt->execute()) {

            return "true";
        } else {

            return "false";
        }

        $stmt->close();
        $stmt = null;
    }
	static public function mdlActualizarEstadoFacturaExenta($datos)
    {

        $estado = 'Cerrada';

        $stmt = Conexion::conectar()->prepare("UPDATE venta_exenta SET estado = :estado WHERE codigo = :id;");


        $stmt->bindParam(":estado", $estado, PDO::PARAM_STR);
        $stmt->bindParam(":id", $datos["factura"], PDO::PARAM_INT);
        if ($stmt->execute()) {

            return "true";
        } else {

            return "false";
        }

        $stmt->close();
        $stmt = null;
    }
    static public function mdlActualizarEstadoBoleta($datos)
    {

        $estado = 'Cerrada';

        $stmt = Conexion::conectar()->prepare("UPDATE venta_boleta SET estado = :estado WHERE codigo = :id;");


        $stmt->bindParam(":estado", $estado, PDO::PARAM_STR);
        $stmt->bindParam(":id", $datos["factura"], PDO::PARAM_INT);
        if ($stmt->execute()) {

            return "true";
        } else {

            return "false";
        }

        $stmt->close();
        $stmt = null;
    }


}
