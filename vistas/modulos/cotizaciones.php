<?php


if ($_SESSION["perfil"] == "Especial") {

    echo '<script>

    window.location = "inicio";

  </script>';

    return;
}

$xml = ControladorVentas::ctrDescargarXML();

if ($xml) {

    rename($_GET["xml"] . ".xml", "xml/" . $_GET["xml"] . ".xml");

    echo '<a class="btn btn-block btn-success abrirXML" archivo="xml/' . $_GET["xml"] . '.xml" href="ventas">Se ha creado correctamente el archivo XML <span class="fa fa-times pull-right"></span></a>';
}

?>
<div class="content-wrapper">

    <section class="content-header">

        <h1>

            Administrar cotizaciones
        </h1>

        <ol class="breadcrumb">

            <li><a href="inicio"><i class="fa fa-home"></i>Inicio</a></li>
            <li>Ventas</li>
            <li class="active">Administrar cotizaciones</li>

        </ol>

    </section>

    <section class="content">

        <div class="box">

            <div class="box-header with-border">
                <a href="cotizacion">
                    <button class="btn btn-primary" style="margin-right: 5px;">
                        <i class="fa fa-plus-circle fa-lg" style="margin-right: 5px;"></i> Crear cotización: Afecta
                    </button>
                </a>
                <a href="cotizacion-exenta">
                    <button class="btn btn-warning">
                        <i class="fa fa-plus-circle fa-lg" style="margin-right: 5px;"></i> Crear cotización: Exenta
                    </button>
                </a>
            </div>

            <div class="box-header with-border">
                <?php
                if ($_SESSION["perfil"] == "Administrador")
                ?>
                <div class="input-group">

                    <button type="button" class="btn btn-default" id="daterange-cotizaciones">

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

                <div class="box-tools pull-right" style="margin-top: 5px;">
                    <a href="vistas/modulos/descargar-reporte-cotizacion.php?reporte=reporte&fechaInicial=<?php echo $_GET['fechaInicial']; ?>&fechaFinal=<?php echo $_GET['fechaFinal']; ?>">
                        <button class="btn btn-success" style="margin-right: 5px;">
                            <i class="fa fa-download fa-lg" style="margin-right: 5px;"></i>
                            Reporte en Excel: Afectas
                        </button>
                    </a>

                    <a href="vistas/modulos/descargar-reporte-cotizacion-exenta.php?reporte=reporte&fechaInicial=<?php echo $_GET['fechaInicial']; ?>&fechaFinal=<?php echo $_GET['fechaFinal']; ?>">
                        <button class="btn btn-success">
                            <i class="fa fa-download fa-lg" style="margin-right: 5px;"></i>
                            Reporte en Excel: Exentas
                        </button>
                    </a>
                </div>

            </div>


            <div class="box-body">


                <table class="table table-bordered table-striped dt-responsive tablas" width="100%">

                    <thead>

                        <tr>

                            <th>Folio</th>
                            <th>Documento</th>
                            <th>Emision</th>
                            <th>Vencimiento</th>
                            <th>Vendedor</th>
                            <th>Unidad de negocio</th>
                            <th>Bodega</th>
                            <th>Plazo de pago</th>
                            <th>Medio de pago</th>
                            <th>Cliente</th>
                            <th>Observación</th>
                            <th>Total</th>
                            <th>Acciones</th>
                        </tr>

                    </thead>

                    <tbody>

                        <?php

                        $item = null;
                        $valor = null;

                        $cotizaciones = ControladorCotizacion::ctrMostrarCotizaciones($item, $valor);
                        $exentas = ControladorCotizacion::ctrMostrarCotizacionesExentas($item, $valor);
                        $negocios = ControladorNegocios::ctrMostrarNegocios($item, $valor);
                        $bodegas = ControladorBodegas::ctrMostrarBodegas($item, $valor);
                        $clientes = ControladorClientes::ctrMostrarClientes($item, $valor);
                        $plazos = ControladorPlazos::ctrMostrarPlazos($item, $valor);
                        $medios = ControladorMediosPago::ctrMostrarMedios($item, $valor);
                        $plantel = ControladorPlantel::ctrMostrarPlantel($item, $valor);

                        foreach ($cotizaciones as $key => $value) {
                            for ($i = 0; $i < count($negocios); ++$i) {
                                if ($negocios[$i]["id"] == $value["id_unidad_negocio"]) {
                                    $negocio = $negocios[$i]["unidad_negocio"];
                                }
                            }
                            for ($i = 0; $i < count($bodegas); ++$i) {
                                if ($bodegas[$i]["id"] == $value["id_bodega"]) {
                                    $bodega = $bodegas[$i]["nombre"];
                                }
                            }
                            for ($i = 0; $i < count($clientes); ++$i) {
                                if ($clientes[$i]["id"] == $value["id_cliente"]) {
                                    $cliente = $clientes[$i]["nombre"];
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
                            for ($i = 0; $i < count($plantel); ++$i) {
                                if ($plantel[$i]["id"] == $value["id_vendedor"]) {
                                    $vendedor = $plantel[$i]["nombre"];
                                }
                            }

                            if ($value["estado"] != "Cerrada") {
                                echo '<tr>


                    <td>' . $value["codigo"] . '</td>

                    <td style="font-weight:bold;font-size:15px;color:black;">' . $value["tipo_dte"] . '</td>

                    <td>' . $value["fecha_emision"] . '</td>

                    <td>' . $value["fecha_vencimiento"] . '</td>

                    <td>' . $vendedor . '</td>

                    <td>' . $negocio . '</td>

                    <td>' . $bodega . '</td>      

                    <td>' . $plazo . '</td>

                    <td>' . $medio . '</td>

                    <td>' . $cliente . '</td>

                    <td>' . $value["observacion"] . '</td>
      
                    <td>$ ' . $value["total_final"] . '</td>
                    <td>

                    <div class="btn-group">
                    <button class="btn btn-success btnFacturarCotizacionAfecta" idCotizacion="' . $value["codigo"] . '">Facturar</button>
                        
                      <button class="btn btn-info btnImprimirCotizacionAfecta" codigoCotizacion="' . $value["codigo"] . '">

                      PDF

                      </button>';

                                if ($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Vendedor") {


                                    echo '
                            <button class="btn btn-warning btnEditarCotizacion" idCotizacion="' . $value["id"] . '"><i class="fa fa-pencil"></i></button> ';
                                }
                                if ($_SESSION["perfil"] == "Administrador") {
                                    echo ' <button class="btn btn-danger btnEliminarCotizacion" idCotizacion="' . $value["id"] . '"><i class="fa fa-times"></i></button>';
                                }

                                echo '</div>  

                            </td>


                            </tr>';
                            }
                        }

                        //MOSTRAR COTIZACION EXENTA
                        foreach ($exentas as $key2 => $value) {
                            for ($i = 0; $i < count($negocios); ++$i) {
                                if ($negocios[$i]["id"] == $value["id_unidad_negocio"]) {
                                    $negocio = $negocios[$i]["unidad_negocio"];
                                }
                            }
                            for ($i = 0; $i < count($bodegas); ++$i) {
                                if ($bodegas[$i]["id"] == $value["id_bodega"]) {
                                    $bodega = $bodegas[$i]["nombre"];
                                }
                            }
                            for ($i = 0; $i < count($clientes); ++$i) {
                                if ($clientes[$i]["id"] == $value["id_cliente"]) {
                                    $cliente = $clientes[$i]["nombre"];
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
                            for ($i = 0; $i < count($plantel); ++$i) {
                                if ($plantel[$i]["id"] == $value["id_vendedor"]) {
                                    $vendedor = $plantel[$i]["nombre"];
                                }
                            }

                            if ($value["estado"] != "Cerrada") {

                                echo '<tr>

                          <td>' . $value["codigo"] . '</td>

                          <td style="font-weight:bold;font-size:15px; color:black;">' . $value["tipo_dte"] . '</td>

                          <td>' . $value["fecha_emision"] . '</td>

                          <td>' . $value["fecha_vencimiento"] . '</td>

                          <td>' . $vendedor . '</td>

                          <td>' . $negocio . '</td>

                          <td>' . $bodega . '</td>      

                          <td>' . $plazo . '</td>

                          <td>' . $medio . '</td>

                          <td>' . $cliente . '</td>

                          <td>' . $value["observacion"] . '</td>
            
                          <td>$ ' . $value["total_final"] . '</td>
                          <td>

                          <div class="btn-group">

                          <button class="btn btn-success btnFacturarCotizacionExenta" idCotizacion="' . $value["codigo"] . '">Facturar</button>
                              
                            <button  class="btn btn-info btnImprimirCotizacionExenta" codigoCotizacion="' . $value["codigo"] . '">

                            PDF

                            </button>';

                                if ($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Vendedor") {
                                    echo '<a href="index.php?ruta=editar-cotizacion-exenta&idCotizacion=' . $value["id"] . '" class="btn btn-warning btnEditarCotizacion">
                                      <i class="fa fa-pencil"></i>
                                    </a>';
                                }
                                if ($_SESSION["perfil"] == "Administrador") {
                                    echo ' <button class="btn btn-danger btnEliminarCotizacion" idCotizacion="' . $value["id"] . '"><i class="fa fa-times"></i></button>';
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

                $eliminarCotizacion = new ControladorCotizacion();
                $eliminarCotizacion->ctrEliminarCotizacion();

                ?>

                <?php

                $eliminarCotizacionExenta = new ControladorCotizacion();
                $eliminarCotizacionExenta->ctrEliminarCotizacionExenta();

                ?>

            </div>

        </div>

    </section>

</div>