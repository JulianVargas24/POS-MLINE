<?php

require_once "conexion.php";

class ModeloVentaBoleta
{



        static public function mdlIngresarVentaBoleta($tabla, $datos) {

                $con = Conexion::conectar();
                $stmt = $con->prepare("INSERT INTO $tabla(codigo, id_cliente, fecha_emision, id_vendedor, id_unidad_negocio, id_bodega, subtotal, descuento, total_neto, iva, total_final,  id_medio_pago, id_plazo_pago, observacion, productos, pagado, pendiente) 
                        VALUES (:codigo, :id_cliente, :fecha_emision, :id_vendedor, :id_unidad_negocio, :id_bodega, :subtotal, :descuento, :total_neto, :iva, :total_final, :id_medio_pago, :id_plazo_pago, :observacion, :productos, :pagado, :pendiente)");

                $stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_INT);
                $stmt->bindParam(":fecha_emision", $datos["fecha_emision"], PDO::PARAM_STR);
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




                if ($stmt->execute()) {
                        if ($con->lastInsertId() > 0) {
                                foreach ($datos["productos"] as $key => $producto) {
                                        $datos = [
                                                "id_producto" => $producto["id"],
                                                "id_salida" => $con->lastInsertId(),
                                                "tipo_salida" => "ventas",
                                                "cantidad" => $producto["cantidad"],
                                                "descripcion" => $producto["descripcion"],
                                                // TODO cambiar id_bodega por nombre del dato en formulario
                                                "id_bodega" => $datos["id_bodega"],

                                        ];
                                        

                                        ModeloSalidasInventario::mdlSalidaPorVenta($datos);
                                        return print_r($datos);
                                }
                        }
                        return "ok";
                } else {

                        return "error";
                }
        }

        static public function mdlIngresarVentaBoletaExenta($tabla, $datos) {

                $con = Conexion::conectar();
                $stmt = $con->prepare("INSERT INTO $tabla(codigo, id_cliente, fecha_emision, id_vendedor, id_unidad_negocio, id_bodega, total_final, subtotal, descuento, id_medio_pago, id_plazo_pago, observacion, productos, pagado, pendiente) 
                        VALUES (:codigo, :id_cliente, :fecha_emision, :id_vendedor, :id_unidad_negocio, :id_bodega, :total_final, :subtotal, :descuento, :id_medio_pago,  :id_plazo_pago, :observacion, :productos, :pagado, :pendiente)");

                $stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_INT);
                $stmt->bindParam(":fecha_emision", $datos["fecha_emision"], PDO::PARAM_STR);
                $stmt->bindParam(":id_unidad_negocio", $datos["id_unidad_negocio"], PDO::PARAM_INT);
                $stmt->bindParam(":id_bodega", $datos["id_bodega"], PDO::PARAM_INT);
                $stmt->bindParam(":total_final", $datos["total_final"], PDO::PARAM_STR);
                $stmt->bindParam(":pagado", $datos["pagado"], PDO::PARAM_STR);
                $stmt->bindParam(":descuento", $datos["descuento"], PDO::PARAM_STR);
                $stmt->bindParam(":subtotal", $datos["subtotal"], PDO::PARAM_STR);
                $stmt->bindParam(":pendiente", $datos["pendiente"], PDO::PARAM_STR);
                $stmt->bindParam(":id_medio_pago", $datos["id_medio_pago"], PDO::PARAM_INT);
                $stmt->bindParam(":id_plazo_pago", $datos["id_plazo_pago"], PDO::PARAM_INT);
                $stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);
                $stmt->bindParam(":observacion", $datos["observacion"], PDO::PARAM_STR);
                $stmt->bindParam(":productos", $datos["productos"], PDO::PARAM_STR);
                $stmt->bindParam(":id_vendedor", $datos["id_vendedor"], PDO::PARAM_STR);




                if ($stmt->execute()) {
                        if ($con->lastInsertId() > 0) {
                                foreach ($datos["productos"] as $key => $producto) {
                                        $datos = [
                                                "id_producto" => $producto["id"],
                                                "id_salida" => $con->lastInsertId(),
                                                "tipo_salida" => "ventas",
                                                "cantidad" => $producto["cantidad"],
                                                "descripcion" => $producto["descripcion"],
                                                // TODO cambiar id_bodega por nombre del dato en formulario
                                                "id_bodega" => $datos["id_bodega"],

                                        ];
                                        

                                        ModeloSalidasInventario::mdlSalidaPorVenta($datos);
                                        return print_r($datos);
                                }
                        }
                        return "ok";
                } else {

                        return "error";
                }
        }

        static public function mdlBorrarVentaBoleta($tabla, $datos){

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
