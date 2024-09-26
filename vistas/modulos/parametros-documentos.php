<div class="content-wrapper">

    <section class="content-header">

        <h1>

            Configuración Documentos

        </h1>

        <ol class="breadcrumb">

            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>

            <li class="active">Parametros</li>

        </ol>

    </section>

    <section class="content">
        <div class="box">
            <div class="box-body">
                <form role="form" method="POST" class="formularioOrdenCompra">
                    <!--=====================================
                FECHAS Y TIPO DE DOCUMENTO
                    ======================================-->
                    <div class="row">

                        <div class="col-xs-12">
                            <div class="box box-info">
                                <div class="box-body">

                                    <div class="row" style="margin-bottom:5px;">

                                        <div class="col-xs-6">
                                            <table class="table table-bordered table-striped dt-responsive" width="100%">

                                                <thead>

                                                    <tr>


                                                        <th>Documento</th>
                                                        <th>Folio Inicial</th>

                                                    </tr>

                                                </thead>

                                                <tbody>
                                                    <tr>
                                                        <td style="font-size:16px;">Orden de Compra</td>
                                                        <td>
                                                            <input
                                                                value="<?php echo ModeloParametrosDocumentos::mdlMostrarFolio("orden_compra", "orden_compra"); ?>"
                                                                name="orden_compra"
                                                                style="margin-left:10px;"
                                                                type="text"
                                                            >
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="font-size:16px;">Cotizacion Afecta</td>
                                                        <td>
                                                            <input
                                                            value="<?php echo ModeloParametrosDocumentos::mdlMostrarFolio("cotizaciones", "cotizacion"); ?>"
                                                            name="cotizacion"
                                                            style="margin-left:10px;"
                                                            type="text">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="font-size:16px;">Cotizacion Exenta</td>
                                                        <td>
                                                            <input
                                                            value="<?php echo ModeloParametrosDocumentos::mdlMostrarFolio("cotizaciones_exentas", "cotizacion_exenta"); ?>"
                                                            name="cotizacion_exenta"
                                                            style="margin-left:10px;"
                                                            type="text">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="font-size:16px;">Boleta Afecta</td>
                                                        <td>
                                                            <input
                                                                value="<?php echo ModeloParametrosDocumentos::mdlMostrarFolio("venta_boleta", "boleta"); ?>"
                                                                name="boleta"
                                                                style="margin-left:10px;"
                                                                type="text">
                                                    </td>
                                                    </tr>
                                                    <tr>
                                                    
                                                        <td style="font-size:16px;">Boleta Exenta</td>
                                                        <td>
                                                            <input
                                                            value=" <?php  echo ModeloParametrosDocumentos::mdlMostrarFolio("venta_boleta_exenta", "boleta_exenta"); ?>"
                                                            name="boleta_exenta"
                                                            style="margin-left:10px;"
                                                            type="text">
                                                        </td>
                                                    </tr>
                                                        <td style="font-size:16px;">Factura Exenta</td>
                                                        <td>
                                                            <input
                                                            value="<?php echo ModeloParametrosDocumentos::mdlMostrarFolio("venta_exenta", "factura_exenta"); ?>"
                                                            name="factura_exenta"
                                                            style="margin-left:10px;"
                                                            type="text">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="font-size:16px;">Factura Afecta</td>
                                                        <td>
                                                            <input
                                                            value="<?php echo ModeloParametrosDocumentos::mdlMostrarFolio("venta_afecta", "factura_afecta"); ?>"
                                                            name="factura_afecta"
                                                            style="margin-left:10px;"
                                                            type="text">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="font-size:16px;">Nota de Debito</td>
                                                        <td>
                                                            <input
                                                            value="<?php echo ModeloParametrosDocumentos::mdlMostrarFolio("nota_credito", "nota_credito"); ?>"
                                                            name="nota_debito"
                                                            style="margin-left:10px;"
                                                            type="text">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="font-size:16px;">Nota de Credito</td>
                                                        <td>
                                                            <input
                                                            value="<?php echo ModeloParametrosDocumentos::mdlMostrarFolio("nota_credito", "nota_credito"); ?>"
                                                            name="nota_credito"
                                                            style="margin-left:10px;"
                                                            type="text">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="font-size:16px;">Orden de Vestuario</td>
                                                        <td>
                                                            <input
                                                            value="<?php echo ModeloParametrosDocumentos::mdlMostrarFolio("orden_vestuario", "orden_vestuario"); ?>"
                                                            name="orden_vestuario"
                                                            style="margin-left:10px;"
                                                            type="text">
                                                        </td>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <td style="font-size:16px;">Entrada Inventario</td>
                                                        <td>
                                                            <input
                                                            value="<?php echo ModeloParametrosDocumentos::mdlMostrarFolio("entradas", "entrada_inventario"); ?>"
                                                            name="entrada_inventario"
                                                            style="margin-left:10px;"
                                                            type="text">
                                                        </td>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <td style="font-size:16px;">Salida Inventario</td>
                                                        <td>
                                                            <input
                                                            value="<?php echo ModeloParametrosDocumentos::mdlMostrarFolio("salidas", "salida_inventario"); ?>"
                                                            name="salida_inventario"
                                                            style="margin-left:10px;"
                                                            type="text">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                    
                                                        <td style="font-size:16px;">Ajustes Inventario</td>
                                                        <td>
                                                            <input
                                                            value=" <?php  echo ModeloParametrosDocumentos::mdlMostrarFolio("ajustes", "ajuste_inventario"); ?>"
                                                            name="ajuste_inventario"
                                                            style="margin-left:10px;"
                                                            type="text">
                                                        </td>
                                                    </tr>
                                                
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>





                    <button type="reset" class="btn btn-default">Salir</button>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </form>

                <?php

                    if ($_SERVER["REQUEST_METHOD"] == "POST") {

                        $controlador = new ControladorParametrosDocumentos();
                        $controlador->ctrCrearParametro();

                    }


                ?>

            </div>
        </div>
    </section>

</div>