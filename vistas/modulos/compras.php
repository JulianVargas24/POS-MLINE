<?php
if ($_SESSION["perfil"] == "Especial") {
    echo '<script>window.location = "inicio";</script>';
    return;
}
?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Administrar compras
        </h1>

        <ol class="breadcrumb">
            <li><a href="inicio"><i class="fa fa-home"></i>Inicio</a></li>
            <li>Adquisiciones</li>
            <li class="active">Administrar compras</li>
        </ol>
    </section>

    <section class="content">
        <div class="box">

            <!-- Botón para agregar compra -->
            <div class="box-header with-border">
                <a href="compra">
                    <button class="btn btn-warning" data-toggle="modal" data-target="#modalAgregarCompra">
                        <i class="fa fa-plus-circle fa-lg" style="margin-right: 5px;"></i>
                        Agregar compra
                    </button>
                </a>
            </div>

            <!-- Filtro de fechas y botón descargar -->
            <div class="box-header with-border">
                <?php
                if ($_SESSION["perfil"] == "Administrador")
                ?>

                <!-- Botón para filtrar por rango de fechas -->
                <div class="input-group">
                    <button type="button" class="btn btn-default" id="daterange-compras">
                        <span>
                            <i class="fa fa-calendar" style="margin-right: 5px;"></i>
                            <?php
                        if (isset($_GET["fechaInicial"])) {
                            echo $_GET["fechaInicial"] . " - " . $_GET["fechaFinal"];
                        } else {
                            echo 'Rango de fecha';
                        }
                            ?>
                        </span>
                        <i class="fa fa-caret-down" style="margin-left: 2px"></i>
                    </button>
                </div>

                <!-- Botón para descargar el reporte -->
                <div class="box-tools pull-right" style="margin-top: 5px;">
                    <a href="vistas/modulos/descargar-reporte-compras.php?reporte=reporte&fechaInicial=<?php echo $_GET['fechaInicial']; ?>&fechaFinal=<?php echo $_GET['fechaFinal']; ?>">
                        <button class="btn btn-success">
                            <i class="fa fa-download fa-lg" style="margin-right: 5px;"></i>
                            Reporte en Excel
                        </button>
                    </a>
                </div>
            </div>

            <!-- Tabla de compras -->
            <div class="box-body">
                <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
                    <thead>
                        <tr>
                            <th>Folio</th>
                            <th>Proveedor</th>
                            <th>Emisión</th>
                            <th>Centro de costo</th>
                            <th>Bodega</th>
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

                        $compras = ControladorCompra::ctrMostrarCompras($item, $valor);
                        $centros = ControladorCentros::ctrMostrarCentros($item, $valor);
                        $bodegas = ControladorBodegas::ctrMostrarBodegas($item, $valor);
                        $proveedores = ControladorProveedores::ctrMostrarProveedores($item, $valor);
                        $plazos = ControladorPlazos::ctrMostrarPlazos($item, $valor);
                        $medios = ControladorMediosPago::ctrMostrarMedios($item, $valor);

                        foreach ($compras as $key => $value) {
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

                            echo '<tr>

                          <td>' . $value["codigo"] . '</td> 
                          
                          <td>' . $proveedor . '</td>

                          <td>' . $value["fecha_emision"] . '</td>


                          <td>' . $centro . '</td>

                          <td>' . $bodega . '</td>      


                          <td>' . $medio . '</td>

                          <td>' . $value["observacion"] . '</td>

                          <td>$ ' . $value["total_final"] . '</td>
                          <td>

                          <div class="btn-group">
                            <button class="btn btn-info btnImprimirCompra"  codigoCompra="' . $value["codigo"] . '">
                            PDF
                            </button>';

                            if ($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Vendedor") {
                                echo '<button class="btn btn-warning btnEditarCompra" idCompra="' . $value["id"] . '"><i class="fa fa-pencil"></i></button>';
                            }

                            if ($_SESSION["perfil"] == "Administrador") {
                                echo ' <button class="btn btn-danger btnEliminarCompra" idCompra="' . $value["id"] . '"><i class="fa fa-times"></i></button>';
                            }

                            echo '</div>  
                            </td>
                            </tr>';
                        }
                        ?>

                    </tbody>
                </table>

                <?php
                $eliminarCompra = new ControladorCompra();
                $eliminarCompra->ctrEliminarCompra();
                ?>

            </div>

        </div>
    </section>
</div>

<style>
    .error {
        color: red;
    }
</style>