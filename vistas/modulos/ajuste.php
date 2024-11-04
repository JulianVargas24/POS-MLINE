<?php

if ($_SESSION["perfil"] == "Especial") {
    echo '<script>
        window.location = "inicio";
    </script>';

    return;
}

?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Administrar ajustes</h1>
        <ol class="breadcrumb">
            <li>
                <a href="inicio"><i class="fa fa-home"></i>Inicio</a>
            </li>
            <li>Inventario</li>
            <li class="active">Ajustes</li>
        </ol>
    </section>

    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <a href="ajustes">
                    <button class="btn btn-primary">
                        Crear ajuste
                    </button>
                </a>
            </div>

            <div class="box-body">
                <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
                    <thead>
                        <tr>
                            <th>Folio</th>
                            <th>Movimiento</th>
                            <th>Emisión</th>
                            <th>Bodega afectada</th>
                            <th>Observaciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $item = null;
                        $valor = null;

                        $ajustes = ControladorAjustesInventario::ctrMostrarAjustes($item, $valor);
                        $bodegas = ControladorBodegas::ctrMostrarBodegas($item, $valor);
                        $plantel = ControladorPlantel::ctrMostrarPlantel($item, $valor);

                        foreach ($ajustes as $key => $value) {
                            for ($i = 0; $i < count($bodegas); ++$i) {
                                if ($bodegas[$i]["id"] == $value["id_bodega_origen"]) {
                                    $bodega = $bodegas[$i]["nombre"];
                                }
                            }

                            if ($value["tipo_salida"] == "Salida Manual") {
                                for ($i = 0; $i < count($plantel); ++$i) {
                                    if ($plantel[$i]["id"] == $value["valor_tipo_salida"]) {
                                        $origen = $plantel[$i]["nombre"];
                                    }
                                }
                            }

                            echo '<tr>    
                                <td>' . $value["codigo"] . '</td>        
                                <td style="font-weight:bold;font-size:15px;color:black;">' . $value["causal"] . '</td>       
                                <td>' . $value["fecha_emision"] . '</td>       
                                <td>' . $bodega . '</td>                         
                                <td>' . $value["observaciones"] . '</td>                           
                            </tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>


