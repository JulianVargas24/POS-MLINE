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

        <h1>
            Administrar salidas
        </h1>

        <ol class="breadcrumb">

            <li><a href="inicio"><i class="fa fa-home"></i>Inicio</a></li>
            <li>Inventario</li>
            <li class="active">Salidas</li>

        </ol>

    </section>

    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <a href="salidas">
                    <button class="btn btn-primary">

                        Crear salidas

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
                        <th>Bodega destino</th>
                        <th>Origen</th>
                        <th>Observaciones</th>

                    </tr>

                    </thead>

                    <tbody>

                    <?php

                    $item = null;
                    $valor = null;

                    $salidas = ControladorSalidasInventario::ctrMostrarSalidas($item, $valor);
                    $bodegas = ControladorBodegas::ctrMostrarBodegas($item, $valor);
                    $plantel = ControladorPlantel::ctrMostrarPlantel($item, $valor);

                    foreach ($salidas as $key => $value) {
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

                    <td style="font-weight:bold;font-size:15px;color:black;">' . $value["tipo_salida"] . '</td>

                    <td>' . $value["fecha_emision"] . '</td>

                    <td>' . $bodega . '</td>
                    
                    <td>' . $origen . '</td>

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


