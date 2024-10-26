<?php

require_once "../controladores/bancos.controlador.php";
require_once "../modelos/bancos.modelo.php";

class AjaxBancos {

    /*=============================================
    EDITAR BANCO
    =============================================*/    
    
    public $idBanco;

    public function ajaxEditarBanco() {
        
        $item = "id";
        $valor = $this->idBanco;

        $respuesta = ControladorBancos::ctrMostrarBancos($item, $valor);

        echo json_encode($respuesta);    
    }
}

/*=============================================
EDITAR BANCO
=============================================*/    
if(isset($_POST["idBanco"])) 
{
    $banco = new AjaxBancos();
    $banco -> idBanco = $_POST["idBanco"];
    $banco -> ajaxEditarBanco();
}

