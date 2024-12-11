<?php
require_once "../controladores/orden-produccion.controlador.php";
require_once "../modelos/orden-produccion.modelo.php";

if (isset($_POST["accion"]) && $_POST["accion"] == "finalizarOrden") {
    if (isset($_POST["idOrdenProduccion"])) {
        $idOrdenProduccion = $_POST["idOrdenProduccion"];
        $respuesta = ControladorOrdenProduccion::ctrFinalizarOrden($idOrdenProduccion);
        echo $respuesta;
    } else {
        echo "error";
    }
} else {
    echo "error";
}