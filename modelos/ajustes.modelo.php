<?php


class ModeloAjustesInventario{
    
    static public function mdlIngresarAjuste($tabla, $datos){

        $con = Conexion::conectar();
        
        
        $stmt = $con->prepare("INSERT INTO $tabla(codigo, fecha_emision, causal, observaciones, id_bodega_origen)
		VALUES (:codigo, :fecha_emision, :causal,  :observaciones, :id_bodega_origen)");

		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_INT);
        $stmt->bindParam(":fecha_emision", $datos["fecha_emision"], PDO::PARAM_STR);
        $stmt->bindParam(":causal", $datos["causal"], PDO::PARAM_STR);
        $stmt->bindParam(":observaciones", $datos["observaciones"], PDO::PARAM_STR);
        $stmt->bindParam(":id_bodega_origen", $datos["id_bodega_origen"], PDO::PARAM_INT);

				
		if($stmt->execute()){
			return $con->lastInsertId(); 

		}else{
			return $stmt->errorInfo();
		
		}

		$stmt->close();
		$stmt = null;

	}

    static public function mdlIngresarProducto($tabla, $datos){

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_producto, id_ajuste, id_bodega, cantidad, descripcion, diferencia) VALUES (:id_producto, :id_ajuste, :id_bodega, :cantidad,  :descripcion, :diferencia)");

		$stmt->bindParam(":id_producto", $datos["id_producto"], PDO::PARAM_INT);
        $stmt->bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_INT);
		$stmt->bindParam(":id_ajuste", $datos["id_ajuste"], PDO::PARAM_INT);
		$stmt->bindParam(":id_bodega", $datos["id_bodega"], PDO::PARAM_INT);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":diferencia", $datos["diferencia"], PDO::PARAM_STR);


				

		if($stmt->execute()){

			return "ok";

		}else{
			return $stmt->errorInfo();
		
		}

		$stmt->close();
		$stmt = null;

	}
	
	static public function mdlMostrarAjustes($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}
    
	

}