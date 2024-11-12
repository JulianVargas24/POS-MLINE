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
    static public function ctrMostrarComunas($item, $valor)
    {
        $tabla = "comunas"; // Tabla donde se guardan las comunas

        if ($item != null) {
            // Verifica si es un número o una cadena
            $paramType = is_numeric($valor) ? PDO::PARAM_INT : PDO::PARAM_STR;

            // Consulta para obtener la comuna que coincida con el valor del item
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
            $stmt->bindParam(":" . $item, $valor, $paramType);
            $stmt->execute();
            return $stmt->fetch(); // Retorna solo una comuna encontrada
        } else {
            // Si no hay filtro, retornar todas las comunas
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
            $stmt->execute();
            return $stmt->fetchAll(); // Retorna todas las comunas
        }
    }
}
