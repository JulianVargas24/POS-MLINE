<?php

require_once "conexion.php";
class ModeloEntradasInventario
{

    static public function mdlIngresarEntrada($tabla, $datos)
    {

        $con = Conexion::conectar();


        $stmt = $con->prepare("INSERT INTO $tabla(codigo, fecha_emision, tipo_entrada, observaciones, id_bodega_destino, valor_tipo_entrada) VALUES (:codigo, :fecha_emision, :tipo_entrada,  :observaciones, :id_bodega_destino, :valor_tipo_entrada)");

        $stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_INT);
        $stmt->bindParam(":fecha_emision", $datos["fecha_emision"], PDO::PARAM_STR);
        $stmt->bindParam(":tipo_entrada", $datos["tipo_entrada"], PDO::PARAM_STR);
        $stmt->bindParam(":observaciones", $datos["observaciones"], PDO::PARAM_STR);
        $stmt->bindParam(":id_bodega_destino", $datos["id_bodega_destino"], PDO::PARAM_INT);
        $stmt->bindParam(":valor_tipo_entrada", $datos["valor_tipo_entrada"], PDO::PARAM_STR);


        if ($stmt->execute()) {
            return $con->lastInsertId();
        } else {
            return $stmt->errorInfo();
        }

        $stmt->close();
        $stmt = null;
    }

    static public function mdlIngresarProducto($tabla, $datos)
    {

        $stmt = Conexion::conectar()
            ->prepare(
                "INSERT INTO `$tabla`(
                    `id_producto`,
                    `id_entrada`,
                    `cantidad`,
                    `descripcion`,
                    `id_bodega`
                )
                VALUES(
                    :id_producto,
                    :id_entrada,
                    :cantidad,
                    :descripcion,
                    :id_bodega
                )"
            );

        $stmt->bindParam(":id_producto", $datos["id_producto"], PDO::PARAM_INT);
        $stmt->bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_INT);
        $stmt->bindParam(":id_entrada", $datos["id_entrada"], PDO::PARAM_INT);
        $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
        $stmt->bindParam(":id_bodega", $datos["id_bodega"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
    }


    /**
     * @param array $datos
     * @return string
     */
    static public function mdlEntradaPorCompra($datos)
    {
        $stmt = Conexion::conectar()
            ->prepare(
                "INSERT INTO `entrada_producto`(
                    `id_producto`,
                    `id_entrada`,
                    `cantidad`,
                    `descripcion`,
                    `id_bodega`
                )
                VALUES(
                    :id_producto,
                    :id_entrada,
                    :cantidad,
                    :descripcion,
                    :id_bodega
                )"
            );

        $stmt->bindParam(":id_producto", $datos["id_producto"], PDO::PARAM_INT);
        $stmt->bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_INT);
        $stmt->bindParam(":id_entrada", $datos["id_entrada"], PDO::PARAM_INT);
        $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
        $stmt->bindParam(":id_bodega", $datos["id_bodega"], PDO::PARAM_STR);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
    }


    static public function mdlMostrarEntradas($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR); #Originalmente estaba en STR.

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
    /*=============================================
	EDITAR ENTRADA
	=============================================*/
    public static function mdlEditarEntrada($tabla, $datos) {
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET codigo = :codigo, fecha_emision = :fecha_emision, tipo_entrada = :tipo_entrada, observaciones = :observaciones, id_bodega_destino = :id_bodega_destino, valor_tipo_entrada = :valor_tipo_entrada WHERE id = :id");
        $idPrueba=7;
        $observacion="primera2222";
        $stmt->bindParam(":id", $idPrueba, PDO::PARAM_INT);
        $stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_emision", $datos["fecha_emision"], PDO::PARAM_STR);
        $stmt->bindParam(":tipo_entrada", $datos["tipo_entrada"], PDO::PARAM_STR);
        $stmt->bindParam(":observaciones", $observacion, PDO::PARAM_STR);
        $stmt->bindParam(":id_bodega_destino", $datos["id_bodega_destino"], PDO::PARAM_INT);
        $stmt->bindParam(":valor_tipo_entrada", $datos["valor_tipo_entrada"], PDO::PARAM_STR);

        if($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }

        $stmt->close();
        $stmt = null;
    }

    /*=============================================
	ELIMINAR ENTRADA
	=============================================*/
    static public function mdlEliminarEntrada($tabla, $idEntrada) {
        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
        $stmt->bindParam(":id", $idEntrada, PDO::PARAM_INT);

        return $stmt->execute() ? "ok" : "error";
    }

    /*=============================================
	MOSTRAR TIPOS DE ENTRADA
	=============================================*/
    public static function mdlMostrarTiposEntradaUnicos($tabla) {
        $stmt = Conexion::conectar()->prepare("SELECT DISTINCT tipo_entrada FROM $tabla");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

