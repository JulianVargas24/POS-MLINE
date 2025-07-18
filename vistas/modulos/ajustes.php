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
        <h1 style="color:green;font-weight:bold">

            AJUSTES

        </h1>

        <ol class="breadcrumb">

            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

            <li class="active">Formulario Ajustes</li>

        </ol>

    </section>

    <section class="content">

        <div class="box box-success">

            <div class="box-body">

                <form role="form" method="post" class="formularioAjustesInventario">
                    <div class="row" style="margin-bottom:5px;">
                        <div class="col-xs-5">

                            <div class="form-group">
                                <div class="input-group">
                                    <label for="">Fecha Emisión</label>
                                    <input type="date" class="form-control input-sm" name="nuevaFechaEmision"
                                           id="nuevaFechaEmision" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-2 col-xs-offset-5">
                            <div class="d-block" style="font-size:16px;color:green;font-weight:bold;">Ajuste</div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">Folio</span>
                                    <?php
                                    $tabla = "ajustes";
                                    $atributo = "ajuste_inventario";
                                    $folio = ModeloParametrosDocumentos::mdlMostrarFolio($tabla, $atributo);
                                    ?>
                                    <input type="text" style="font-weight:bold; font-size:16px;" class="form-control"
                                           name="nuevoCodigo" id="nuevoCodigo" value="<?php echo $folio + 1 ?>" readonly
                                           required>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row" style="margin-bottom:5px;">
                        <div class="col-xs-5">
                            <label for="">Causal</label>
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="radio" value="MERMA" name="tipoAjuste">
                                    <label for="radio1" style="font-weight:normal; margin-left: 3px;">Merma</label>
                                </div>
                                <div class="input-group">
                                    <input type="radio" value="ROBO" name="tipoAjuste">
                                    <label for="radio2" style="font-weight:normal; margin-left: 3px;">Robo</label>
                                </div>
                                <div class="input-group">
                                    <input type="radio" value="PERDIDA" name="tipoAjuste">
                                    <label for="radio3" style="font-weight:normal; margin-left: 3px;">Perdida</label>
                                </div>
                                <div class="input-group">
                                    <input type="radio" value="AJUSTE" name="tipoAjuste" value="diferencia">
                                    <label for="radio3" style="font-weight:normal; margin-left: 3px;">Ajuste de
                                        Inventario</label>
                                </div>
                                <div class="input-group">
                                    <input type="radio" value="OTRO" name="tipoAjuste">
                                    <label for="radio4" style="font-weight:normal; margin-left: 3px;">Otro</label>
                                </div>

                            </div>
                        </div>
                        <div class="col-xs-5">
                            <label for="">Observaciones</label>
                            <div class="form-group">
                                <input type="text" name="nuevaObservacion" class="form-control form-lg">
                            </div>

                            <input type="hidden" id="listaProductos" name="listaProductos">

                        </div>


                    </div>
                    <div class="row">
                        <div class="col-xs-12" id="ajuste">
                            <div class="box box-info">
                                <h4 class="box-title">Ajuste de Inventario </h4>
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <div class="col-xs-6">
                                                <div class="d-block" style="font-size:14px;">Bodega Origen</div>
                                                <div class="form-group">
                                                    <div class="input-group">

                                                        <span class="input-group-addon"><i
                                                                    class="fa fa-check"></i></span>

                                                        <select style="padding-left:0px" class="form-control input"
                                                                id="nuevaBodega" name="nuevaBodega" required>

                                                            <option value="">Seleccionar Bodega</option>
                                                            <?php

                                                            $item = null;
                                                            $valor = null;

                                                            $bodegas = ControladorBodegas::ctrMostrarBodegas($item, $valor);

                                                            foreach ($bodegas as $key => $value) {

                                                                echo '<option value="' . $value["id"] . '">' . $value["nombre"] . '</option>';
                                                            }

                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="col-xs-12 nuevoProductoDiferencia">

                                            </div>
                                        </div>
                                        <div class="col-xs-6">
                                            <div class="box box-success">
                                                <div class="box-header with-border"></div>
                                                <div class="box-body">
                                                    <h4 class="box-title text-center"
                                                        style="font-weight:bold; font-size:20px;"> Productos para Seleccionar</h4>
                                                    <table id="dt-ajuste"
                                                           class="table table-bordered table-striped dt-responsive tablaAjustes">


                                                        <thead>

                                                        <tr>
                                                            <th style="width: 10px">#</th>
                                                            <th>Imagen</th>
                                                            <th>Código</th>
                                                            <th>Nombre</th>
                                                            <th>Acciones</th>
                                                        </tr>

                                                        </thead>

                                                    </table>

                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                    <!-- BOTONES DE SALIR Y APLICAR AJUSTES -->
                                    <button type="button" class="btn btn-default" onclick="window.location.href='ajuste';">Salir</button>
                                    <button type="submit" class="btn btn-primary">Aplicar Ajustes</button>
                                </div>

                            </div>

                        </div>
                    </div>
            </div>


        </div>

        <?php
        $ajuste = new ControladorAjustesInventario();
        echo $ajuste->ctrCrearAjuste();
        ?>
    </section>

</div>

<style>
    .error {
        color: red;
    }
</style>