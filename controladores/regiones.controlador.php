<?php

class ControladorRegiones
{

    /*=============================================
    MOSTRAR REGIONES
    =============================================*/
    static public function ctrMostrarRegiones($item, $valor)
    {
        $tabla = "regiones";
        $respuesta = ModeloRegiones::mdlMostrarRegiones($tabla, $item, $valor);
        return $respuesta;
    }

    /*=============================================
    MOSTRAR COMUNAS
    =============================================*/
   static public function ctrMostrarComunas($item, $valor) {
        $tabla = "comunas"; // Tabla donde se guardan las comunas

        if ($item != null) {
            // Consulta para obtener las comunas que coincidan con el valor del item
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(); // Retorna todas las comunas encontradas
        } else {
            // Si no hay filtro, retornar todas las comunas
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
            $stmt->execute();
            return $stmt->fetchAll(); // Retorna todas las comunas
        }
    }
}
