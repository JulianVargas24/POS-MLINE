<?php

require_once "conexion.php";

class ModeloSubunidades
{

    /*=============================================
    CREAR SUBUNIDAD
    =============================================*/

    static public function mdlCrearSubunidad($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_unidad, subunidad) VALUES (:id_unidad, :subunidad)");

        $stmt->bindParam(":id_unidad", $datos["id_unidad"], PDO::PARAM_INT);
        $stmt->bindParam(":subunidad", $datos["subunidad"], PDO::PARAM_STR);

        if ($stmt->execute()) {

            return "ok";

        } else {

            return "error";

        }

        $stmt->close();
        $stmt = null;

    }

    /*=============================================
    MOSTRAR SUBUNIDADES
    =============================================*/

    static public function mdlMostrarSubunidades($tabla, $item, $valor)
    {

        if ($item != null) {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetch();

        } else {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

            $stmt->execute();

            return $stmt->fetchAll();

        }

        $stmt->close();

        $stmt = null;

    }


    /*=============================================
    EDITAR SUBUNIDAD
    =============================================*/

    static public function mdlEditarSubunidad($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET subunidad = :subunidad WHERE id = :id");

        $stmt->bindParam(":subunidad", $datos["subunidad"], PDO::PARAM_STR);
        $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);

        if ($stmt->execute()) {

            return "ok";

        } else {

            return "error";

        }

        $stmt->close();
        $stmt = null;

    }

    /*=============================================
    BORRAR SUBUNIDAD
    =============================================*/

    static public function mdlBorrarSubunidad($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

        $stmt->bindParam(":id", $datos, PDO::PARAM_INT);

        if ($stmt->execute()) {

            return "ok";

        } else {

            return "error";

        }

        $stmt->close();

        $stmt = null;

    }

}

