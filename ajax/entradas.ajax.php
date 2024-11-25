<?php
require_once "../controladores/entradas.controlador.php";
require_once "../modelos/entradas.modelo.php";

class AjaxEntradas
{

    /*=============================================
    EDITAR ENTRADA
    =============================================*/

    public $idEntrada;

    public function ajaxEditarEntrada()
    {

        $item = "id";
        $valor = $this->idEntrada;
        $respuesta = ControladorEntradasInventario::ctrMostrarEntradas($item, $valor);

        echo json_encode($respuesta);
    }

}

/*=============================================
EDITAR ENTRADAS
=============================================*/
if (isset($_POST["idEntrada"])) {

    $entrada = new AjaxEntradas();
    $entrada -> idEntrada = $_POST["idEntrada"];
    $entrada -> ajaxEditarEntrada();

} else {
    error_log("Error: idEntrada no está definido en la solicitud"); // Mensaje de error si no se recibe el parámetro
}
