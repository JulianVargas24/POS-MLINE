<?php

require_once "conexion.php";

class ModeloVentaFactura
{

    /*=============================================
    CREAR SUBCATEGORIA
    =============================================*/

    static public function mdlIngresarVentaAfecta($tabla, $datos) {

        $con = Conexion::conectar();
        $stmt = $con->prepare("INSERT INTO $tabla(codigo, id_cliente, fecha_emision, fecha_vencimiento, id_vendedor, id_unidad_negocio, id_bodega, subtotal, descuento, total_neto, iva, total_final,  id_medio_pago, id_plazo_pago, observacion, productos, pagado, pendiente, documento, fecha_documento, motivo_documento, folio_documento, razon_documento) 
                                                        VALUES (:codigo, :id_cliente, :fecha_emision, :fecha_vencimiento, :id_vendedor, :id_unidad_negocio, :id_bodega, :subtotal, :descuento, :total_neto, :iva, :total_final, :id_medio_pago, :id_plazo_pago, :observacion, :productos, :pagado, :pendiente, :documento, :fecha_documento, :motivo_documento, :folio_documento, :razon_documento)");

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
        $stmt->bindParam(":pagado", $datos["pagado"], PDO::PARAM_STR);
        $stmt->bindParam(":pendiente", $datos["pendiente"], PDO::PARAM_STR);
        $stmt->bindParam(":id_medio_pago", $datos["id_medio_pago"], PDO::PARAM_INT);
        $stmt->bindParam(":id_plazo_pago", $datos["id_plazo_pago"], PDO::PARAM_INT);
        $stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);
        $stmt->bindParam(":observacion", $datos["observacion"], PDO::PARAM_STR);
        $stmt->bindParam(":productos", $datos["productos"], PDO::PARAM_STR);
        $stmt->bindParam(":id_vendedor", $datos["id_vendedor"], PDO::PARAM_STR);
        $stmt->bindParam(":documento", $datos["documento"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_documento", $datos["fecha_documento"], PDO::PARAM_STR);
        $stmt->bindParam(":motivo_documento", $datos["motivo_documento"], PDO::PARAM_STR);
        $stmt->bindParam(":folio_documento", $datos["folio_documento"], PDO::PARAM_INT);
        $stmt->bindParam(":razon_documento", $datos["razon_documento"], PDO::PARAM_STR);


        if ($stmt->execute()) {

            if ($con->lastInsertId() > 0) {
                foreach ($datos["productos"] as $producto) {
                    $datos = [
                        "id_producto" => $producto["id"],
                        "id_salida" => $con->lastInsertId(),
                        "tipo_salida" => "venta_afecta",
                        "cantidad" => $producto["cantidad"],
                        "descripcion" => $producto["descripcion"],
                        // TODO cambiar id_bodega por nombre del dato en formulario
                        "id_bodega" => $datos["id_bodega"],

                    ];
                    ModeloSalidasInventario::mdlSalidaPorVenta($datos);
                }
            }

            return "ok";
        } else {

            return "error";
        }
    }

    static public function mdlActualizarEstadoCotizacion($datos){

        $estado = 'Cerrada';

        $stmt = Conexion::conectar()->prepare("UPDATE cotizaciones SET estado = :estado WHERE codigo = :id;");


        $stmt->bindParam(":estado", $estado, PDO::PARAM_STR);
        $stmt->bindParam(":id", $datos["cotizacion"], PDO::PARAM_INT);
        if ($stmt->execute()) {

            return "true";
        } else {

            return "false";
        }

        $stmt->close();
        $stmt = null;
    }

    static public function mdlActualizarEstadoCotizacionExenta($datos)
    {

        $estado = 'Cerrada';

        $stmt = Conexion::conectar()->prepare("UPDATE cotizaciones_exentas SET estado = :estado WHERE codigo = :id;");


        $stmt->bindParam(":estado", $estado, PDO::PARAM_STR);
        $stmt->bindParam(":id", $datos["cotizacion"], PDO::PARAM_INT);
        if ($stmt->execute()) {

            return "true";
        } else {

            return "false";
        }

        $stmt->close();
        $stmt = null;
    }

    static public function mdlIngresarVentaExenta($tabla, $datos)
    {

        $con = Conexion::conectar();
        $stmt = $con->prepare("INSERT INTO $tabla(codigo, id_cliente, fecha_emision, fecha_vencimiento, id_vendedor, id_unidad_negocio, id_bodega, subtotal, descuento, exento, iva, total_final,  id_medio_pago, id_plazo_pago, observacion, productos, pagado, pendiente, documento, fecha_documento, motivo_documento, folio_documento, razon_documento) 
                                                    VALUES (:codigo, :id_cliente, :fecha_emision, :fecha_vencimiento, :id_vendedor, :id_unidad_negocio, :id_bodega, :subtotal, :descuento, :exento, :iva, :total_final, :id_medio_pago, :id_plazo_pago, :observacion, :productos, :pagado, :pendiente, :documento, :fecha_documento, :motivo_documento, :folio_documento, :razon_documento)");

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
        $stmt->bindParam(":pagado", $datos["pagado"], PDO::PARAM_STR);
        $stmt->bindParam(":pendiente", $datos["pendiente"], PDO::PARAM_STR);
        $stmt->bindParam(":id_medio_pago", $datos["id_medio_pago"], PDO::PARAM_INT);
        $stmt->bindParam(":id_plazo_pago", $datos["id_plazo_pago"], PDO::PARAM_INT);
        $stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);
        $stmt->bindParam(":observacion", $datos["observacion"], PDO::PARAM_STR);
        $stmt->bindParam(":productos", $datos["productos"], PDO::PARAM_STR);
        $stmt->bindParam(":id_vendedor", $datos["id_vendedor"], PDO::PARAM_STR);
        $stmt->bindParam(":documento", $datos["documento"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_documento", $datos["fecha_documento"], PDO::PARAM_STR);
        $stmt->bindParam(":motivo_documento", $datos["motivo_documento"], PDO::PARAM_STR);
        $stmt->bindParam(":folio_documento", $datos["folio_documento"], PDO::PARAM_INT);
        $stmt->bindParam(":razon_documento", $datos["razon_documento"], PDO::PARAM_STR);




        if ($stmt->execute()) {

            if ($con->lastInsertId() > 0) {
                foreach ($datos["productos"] as $producto) {
                    $datos = [
                        "id_producto" => $producto["id"],
                        "id_salida" => $con->lastInsertId(),
                        "tipo_salida" => "venta_exenta",
                        "cantidad" => $producto["cantidad"],
                        "descripcion" => $producto["descripcion"],
                        "id_bodega" => $datos["id_bodega"],

                    ];
                    ModeloSalidasInventario::mdlSalidaPorVenta($datos);
                }
            }

            return "ok";
        } else {

            return "error";
        }

        $stmt->close();
        $stmt = null;
    }

    static public function mdlBorrarVentaAfecta($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

    }
    
    static public function mdlBorrarVentaExenta($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}
}
