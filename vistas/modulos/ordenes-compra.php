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
            Administrar órdenes de compra
        </h1>

        <ol class="breadcrumb">

            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

            <li class="active">Administrar órdenes de compra</li>

        </ol>

    </section>

    <section class="content">

        <div class="box">

            <div class="box-header with-border">

                <a href="orden-compra">
                    <button class="btn btn-warning" data-toggle="modal" data-target="#modalAgregarCompra">
                        Agregar orden de compra
                    </button>
                </a>
            </div>

            <div class="box-body">
                <div class="box-header with-border">
                    <?php
                    if ($_SESSION["perfil"] == "Administrador")
                    ?>
                    <div class="input-group">

                        <button type="button" class="btn btn-default" id="daterange-orden-compra">

                            <span>
                                <i class="fa fa-calendar"></i>

                                <?php

                                if (isset($_GET["fechaInicial"])) {

                                    echo $_GET["fechaInicial"] . " - " . $_GET["fechaFinal"];
                                } else {

                                    echo 'Rango de fecha';
                                }

                                ?>
                            </span>

                            <i class="fa fa-caret-down"></i>

                        </button>

                    </div>

                    <div class="box-tools pull-right">

                        <?php
                        if (isset($_GET["fechaInicial"])) {
                            echo '<a href="vistas/modulos/descargar-reporte-orden-compra.php?reporte=reporte&fechaInicial=' . $_GET["fechaInicial"] . '&fechaFinal=' . $_GET["fechaFinal"] . '">';
                        } else {
                            echo '<a href="vistas/modulos/descargar-reporte-orden-compra.php?reporte=reporte">';
                        }
                        ?>

                        <button class="btn btn-success" style="margin-top:5px">Descargar reporte en Excel</button>

                        </a>

                    </div>

                </div>
                <table class="table table-bordered table-striped dt-responsive tablas" width="100%">

                    <thead>

                    <tr>
                        <th>Folio</th>
                        <th>Tipo de documento</th>
                        <th>Proveedor</th>
                        <th>Emisión</th>
                        <th>Vencimiento</th>
                        <th>Centro de costo</th>
                        <th>Bodega</th>
                        <th>Estado de orden</th>
                        <th>Plazo de pago</th>
                        <th>Medio de pago</th>
                        <th>Observación</th>
                        <th>Total</th>
                        <th>Acciones</th>
                    </tr>

                    </thead>

                    <tbody>

                    <?php

                    $item = null;
                    $valor = null;

                    $ordenCompra = ControladorOrdenCompra::ctrMostrarOrdenCompra($item, $valor);
                    $centros = ControladorCentros::ctrMostrarCentros($item, $valor);
                    $bodegas = ControladorBodegas::ctrMostrarBodegas($item, $valor);
                    $proveedores = ControladorProveedores::ctrMostrarProveedores($item, $valor);
                    $plazos = ControladorPlazos::ctrMostrarPlazos($item, $valor);
                    $medios = ControladorMediosPago::ctrMostrarMedios($item, $valor);

                    foreach ($ordenCompra as $key => $value) {

                        for ($i = 0; $i < count($centros); ++$i) {
                            if ($centros[$i]["id"] == $value["id_centro"]) {
                                $centro = $centros[$i]["centro"];
                            }
                        }
                        for ($i = 0; $i < count($bodegas); ++$i) {
                            if ($bodegas[$i]["id"] == $value["id_bodega"]) {
                                $bodega = $bodegas[$i]["nombre"];
                            }
                        }
                        for ($i = 0; $i < count($proveedores); ++$i) {
                            if ($proveedores[$i]["id"] == $value["id_proveedor"]) {
                                $proveedor = $proveedores[$i]["razon_social"];
                            }
                        }
                        for ($i = 0; $i < count($plazos); ++$i) {
                            if ($plazos[$i]["id"] == $value["id_plazo_pago"]) {
                                $plazo = $plazos[$i]["nombre"];
                            }
                        }
                        for ($i = 0; $i < count($medios); ++$i) {
                            if ($medios[$i]["id"] == $value["id_medio_pago"]) {
                                $medio = $medios[$i]["medio_pago"];
                            }
                        }

                        if ($value["estado"] != "Cerrada") {
                            echo '<tr>


                    <td>' . $value["codigo"] . '</td> 

                    <td>Orden de Compra</td>
                    
                    <td>' . $proveedor . '</td>

                    <td>' . $value["fecha_emision"] . '</td>

                    <td>' . $value["fecha_vencimiento"] . '</td>

                    <td>' . $centro . '</td>

                    <td>' . $bodega . '</td>      

                    <td>' . $value["estado"] . '</td>

                    <td>' . $plazo . '</td>

                    <td>' . $medio . '</td>

                    <td>' . $value["observacion"] . '</td>
      
                    <td>$ ' . $value["total_final"] . '</td>
                    <td>

                    <div class="btn-group">

                      <button class="btn btn-success btnImprimirTicketOrdenCompra" codigoOrdenCompra="' . $value["codigo"] . '">
                      Ticket
                      </button>
                        
                      <button class="btn btn-info btnImprimirOrdenCompra"  codigoOrden="' . $value["codigo"] . '">
                      PDF
                      </button>';

                            if ($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Vendedor") {
                                echo '
                                <button class="btn btn-success btnFacturarOrdenCompra" idOrdenCompra="' . $value["codigo"] . '">Facturar</button>
                                <button class="btn btn-warning btnEditarOrdenCompra" idOrdenCompra="' . $value["id"] . '"><i class="fa fa-pencil"></i></button> ';
                            }
                            if ($_SESSION["perfil"] == "Administrador") {
                                echo ' <button class="btn btn-danger btnEliminarOrdenCompra" idOrdenCompra="' . $value["id"] . '"><i class="fa fa-times"></i></button>';
                            }
                            echo '</div>

                  </td>

                  </tr>';
                        }
                    }

                    ?>

                    </tbody>

                </table>

                <?php

                $eliminarOrdenCompra = new ControladorOrdenCompra();
                $eliminarOrdenCompra->ctrEliminarOrdenCompra();

                ?>

            </div>

        </div>

    </section>

</div>

<!--=====================================
MODAL AGREGAR BODEGA
======================================-->
<style>
    .error {
        color: red;
    }
</style>
