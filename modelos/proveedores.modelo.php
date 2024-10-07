<?php

require_once "conexion.php";

class ModeloProveedores
{
    /*=============================================
    CREAR PROVEEDOR
    =============================================*/

    static public function mdlIngresarProveedor($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(razon_social, rut, comuna, nro_cuenta, banco, telefono, email, actividad, ejecutivo, rubros, pais, region, direccion, id_plazo) VALUES (:razon_social, :rut, :comuna, :nro_cuenta, :banco, :telefono, :email, :actividad, :ejecutivo, :rubros, :pais, :region, :direccion, :id_plazo)");

        $stmt->bindParam(":razon_social", $datos["razon_social"], PDO::PARAM_STR);
        $stmt->bindParam(":rut", $datos["rut"], PDO::PARAM_STR);
        $stmt->bindParam(":comuna", $datos["comuna"], PDO::PARAM_STR);
        $stmt->bindParam(":region", $datos["region"], PDO::PARAM_STR);
        $stmt->bindParam(":pais", $datos["pais"], PDO::PARAM_STR);
        $stmt->bindParam(":nro_cuenta", $datos["nro_cuenta"], PDO::PARAM_STR);
        $stmt->bindParam(":banco", $datos["banco"], PDO::PARAM_STR);
        $stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
        $stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
        $stmt->bindParam(":actividad", $datos["actividad"], PDO::PARAM_STR);
        $stmt->bindParam(":ejecutivo", $datos["ejecutivo"], PDO::PARAM_STR);
        $stmt->bindParam(":rubros", $datos["rubros"], PDO::PARAM_STR);
        $stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
        $stmt->bindParam(":id_plazo", $datos["id_plazo"], PDO::PARAM_STR);

        if ($stmt->execute()) {

            return "ok";

        } else {
            return "error";

        }

        $stmt->close();
        $stmt = null;

    }

    /*=============================================
    MOSTRAR PROVEEDORES
    =============================================*/

    static public function mdlMostrarProveedores($tabla, $item, $valor)
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
    EDITAR PROVEEDOR
    =============================================*/

    static public function mdlEditarProveedor($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET razon_social = :razon_social, rut = :rut, comuna = :comuna, pais = :pais, region = :region, rubros = :rubros, id_plazo = :id_plazo, direccion = :direccion, nro_cuenta = :nro_cuenta, banco = :banco, telefono = :telefono,  email = :email, actividad = :actividad, ejecutivo = :ejecutivo WHERE id = :id");

        $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
        $stmt->bindParam(":razon_social", $datos["razon_social"], PDO::PARAM_STR);
        $stmt->bindParam(":rut", $datos["rut"], PDO::PARAM_STR);
        $stmt->bindParam(":comuna", $datos["comuna"], PDO::PARAM_STR);
        $stmt->bindParam(":region", $datos["region"], PDO::PARAM_STR);
        $stmt->bindParam(":pais", $datos["pais"], PDO::PARAM_STR);
        $stmt->bindParam(":nro_cuenta", $datos["nro_cuenta"], PDO::PARAM_STR);
        $stmt->bindParam(":banco", $datos["banco"], PDO::PARAM_STR);
        $stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
        $stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
        $stmt->bindParam(":actividad", $datos["actividad"], PDO::PARAM_STR);
        $stmt->bindParam(":ejecutivo", $datos["ejecutivo"], PDO::PARAM_STR);
        $stmt->bindParam(":rubros", $datos["rubros"], PDO::PARAM_STR);
        $stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
        $stmt->bindParam(":id_plazo", $datos["id_plazo"], PDO::PARAM_STR);


        if ($stmt->execute()) {

            return "ok";

        } else {

            return "error";

        }

        $stmt->close();

        $stmt = null;

    }

    /*=============================================
    BORRAR PROVEEDOR
    =============================================*/

    static public function mdlBorrarProveedor($tabla, $datos)
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

