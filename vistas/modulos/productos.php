<?php

if ($_SESSION["perfil"] == "Vendedor") {

    echo '<script>

    window.location = "inicio";

  </script>';

    return;
}

?>
<div class="content-wrapper">

    <section class="content-header">

        <h1>

            Administrar productos

        </h1>

        <ol class="breadcrumb">

            <li><a href="inicio"><i class="fa fa-home"></i>Inicio</a></li>
            <li>Inventario</li>
            <li class="active">Productos</li>

        </ol>

    </section>

    <section class="content">

        <div class="box">

            <div class="box-header with-border">

                <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarProducto">
                    <i class="fa fa-plus-circle fa-lg" style="margin-right: 5px"></i>
                    Agregar producto
                </button>

                <div class="box-tools pull-right" style="margin-top: 5px;">
                    <a href="vistas/modulos/descargar-reporte-productos.php?reporte=reporte">
                        <button class="btn btn-success">
                            <i class="fa fa-download fa-lg" style="margin-right: 5px;"></i>
                            Reporte en Excel
                        </button>
                    </a>
                </div>

            </div>

            <div class="box-body">

                <table class="table table-bordered table-striped dt-responsive tablaProductos" width="100%">

                    <thead>

                        <tr>

                            <th style="width:10px">#</th>
                            <th>Imagen</th>
                            <th>Código</th>
                            <th>Rubro asociado</th>
                            <th>Nombre</th>
                            <th>Categoría</th>
                            <th>Precio compra neto</th>
                            <th>Precio venta neto</th>
                            <th>Acciones</th>

                        </tr>

                    </thead>

                </table>


                <input type="hidden" value="<?php echo $_SESSION['perfil']; ?>" id="perfilOculto">

            </div>

        </div>

    </section>

</div>

<!--=====================================
MODAL AGREGAR PRODUCTO
======================================-->
<style>
    .error {
        color: red;
    }
</style>

<div id="modalAgregarProducto" class="modal fade" role="dialog">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <form role="form" method="post" id="form_nuevo_producto" enctype="multipart/form-data">

                <!--=====================================
                CABEZA DEL MODAL
                ======================================-->

                <div class="modal-header" style="background:#3f668d; color:white">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title">Agregar producto</h4>

                </div>

                <!--=====================================
                CUERPO DEL MODAL
                ======================================-->

                <div class="modal-body">

                    <div class="box-body">


                        <!-- ENTRADA PARA SELECCIONAR CATEGORÍA -->


                        <!-- ENTRADA PARA LA DESCRIPCIÓN -->
                        <div class="box box-info">
                            <div class="box-body">
                                <div class="form-group row">
                                    <div class="col-xs-6">
                                        <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold">
                                            Producto
                                        </div>
                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>

                                            <input type="text" class="form-control input" name="nuevaDescripcion"
                                                placeholder="Nombre producto" required>

                                        </div>
                                    </div>
                                    <div class="col-xs-6">
                                        <div class="d-inline-block  text-center"
                                            style="font-size:16px;font-weight:bold">Rubro asociado
                                        </div>
                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-th"></i></span>

                                            <select class="form-control input" id="nuevoRubro" name="nuevoRubro"
                                                required>

                                                <option value="">Seleccionar rubro</option>

                                                <?php

                                                $item = null;
                                                $valor = null;

                                                $rubros = ControladorRubros::ctrMostrarRubros($item, $valor);

                                                foreach ($rubros as $key => $value) {
                                                    echo '<option value="' . $value["id"] . '">' . $value["nombre"] . '</option>';
                                                }

                                                ?>

                                            </select>

                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-xs-6">
                                        <div class="d-inline-block  text-center"
                                            style="font-size:16px;font-weight:bold">Categoría
                                        </div>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-th"></i></span>
                                            <select class="form-control input" id="nuevaCategoria" name="nuevaCategoria"
                                                required>

                                                <option value="">Seleccionar categoría</option>

                                                <?php

                                                $item = null;
                                                $valor = null;

                                                $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

                                                foreach ($categorias as $key => $value) {
                                                    echo '<option value="' . $value["id"] . '">' . $value["categoria"] . '</option>';
                                                }

                                                ?>

                                            </select>
                                        </div>
                                    </div>
                                    <!-- ENTRADA PARA LA SUBCATEGORIA -->
                                    <div class="col-xs-6">
                                        <div class="d-inline-block  text-center"
                                            style="font-size:16px;font-weight:bold">Subcategoría
                                        </div>
                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-th"></i></span>

                                            <select class="form-control input" id="nuevaSubcategoria"
                                                name="nuevaSubcategoria" required>

                                                <option value="">Seleccionar subcategoría</option>

                                                <?php

                                                $item = null;
                                                $valor = null;

                                                $subcategorias = ControladorSubcategorias::ctrMostrarSubcategorias($item, $valor);

                                                foreach ($subcategorias as $key => $value) {


                                                    echo '<option value="' . $value["id"] . '">' . $value["subcategoria"] . '</option>';
                                                }

                                                ?>

                                            </select>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- ENTRADA PARA STOCK -->
                        <div class="box box-danger">
                            <div class="box-body">
                                <div class="form-group row">
                                    <input type="hidden" class="form-control input" id="nuevaBodega" name="nuevaBodega"
                                        value="1" required>
                                    <input type="hidden" class="form-control input" name="nuevoStock" min="0"
                                        placeholder="Stock" value="0" required>


                                    <div class="col-xs-6">
                                        <div class="d-inline-block  text-center"
                                            style="font-size:16px;font-weight:bold">Alerta de stock
                                        </div>
                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-check"></i></span>

                                            <input type="number" class="form-control input" name="nuevoStockAlerta"
                                                min="0" placeholder="Alerta de stock" required>

                                        </div>
                                    </div>
                                    <div class="col-xs-6">
                                        <div class="d-inline-block  text-center"
                                            style="font-size:16px;font-weight:bold">Stock mínimo
                                        </div>
                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-check"></i></span>

                                            <input type="number" class="form-control input" name="nuevoStockMin" min="0"
                                                placeholder="Stock mínimo" required>

                                        </div>
                                    </div>
                                </div>

                                <!-- ENTRADA PARA PRECIO COMPRA -->

                                <div class="form-group row">

                                    <div class="col-xs-4">
                                        <div class="d-inline-block  text-center"
                                            style="font-size:16px;font-weight:bold">Precio de compra neto
                                        </div>
                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>

                                            <input type="number" class="form-control input" id="nuevoPrecioCompra"
                                                name="nuevoPrecioCompra" step="any" min="0"
                                                placeholder="Precio de compra" required>

                                        </div>

                                    </div>

                                    <!-- ENTRADA PARA PRECIO VENTA -->

                                    <div class="col-xs-4">
                                        <div class="d-inline-block  text-center"
                                            style="font-size:16px;font-weight:bold">Precio lista neto
                                        </div>
                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span>

                                            <input type="number" class="form-control input" id="nuevoPrecioVenta"
                                                name="nuevoPrecioVenta" step="any" min="0"
                                                placeholder="Precio de venta" required>

                                        </div>


                                    </div>

                                    <div class="col-xs-4">
                                        <div class="d-inline-block  text-center"
                                            style="font-size:16px;font-weight:bold">Unidad de medida
                                        </div>
                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-th"></i></span>

                                            <select class="form-control input" id="nuevaMedida" name="nuevaMedida"
                                                required>

                                                <option value="">Seleccionar medida</option>

                                                <?php

                                                $item = null;
                                                $valor = null;

                                                $unidades = ControladorUnidades::ctrMostrarUnidades($item, $valor);

                                                foreach ($unidades as $key => $value) {

                                                    echo '<option value="' . $value["id"] . '">' . $value["medida"] . '</option>';
                                                }

                                                ?>

                                            </select>

                                        </div>


                                    </div>

                                </div>


                            </div>
                        </div>
                        <!-- ENTRADA PARA EL CÓDIGO -->


                        <div class="box box-success">
                            <div class="box-body">
                                <div class="form-group row">

                                    <div class="col-xs-4">
                                        <div class="d-inline-block  text-center"
                                            style="font-size:16px;font-weight:bold">Código de producto
                                        </div>
                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-code"></i></span>

                                            <input type="number" class="form-control input" id="nuevoCodigo"
                                                name="nuevoCodigo"
                                                value="<?php $rand = range(0, 10);
                                                        shuffle($rand);
                                                        foreach ($rand as $val) {
                                                            echo $val;
                                                        } ?>" required>

                                        </div>

                                        <button type="button" class="btn btn-success" style="margin-top: 5px"
                                            onclick="generarbarcode();">Generar
                                        </button>
                                        <button type="button" class="btn btn-info" style="margin-top: 5px"
                                            onclick="imprimir();">Imprimir
                                        </button>
                                        <div id="print" style="display: none;">
                                            <svg id="barcode" class="barcode"></svg>

                                        </div>

                                    </div>


                                    <!-- ENTRADA PARA BODEGA -->


                                    <div class="col-xs-4">
                                        <div class="d-inline-block  text-center"
                                            style="font-size:16px;font-weight:bold">Afecto/Exento
                                        </div>
                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-th"></i></span>

                                            <select class="form-control input" id="nuevoTipoProducto"
                                                name="nuevoTipoProducto" required>

                                                <option value="Afecto">Afecto</option>
                                                <option value="Exento">Exento</option>

                                            </select>

                                        </div>
                                    </div>

                                    <div class="col-xs-4">
                                        <div class="d-inline-block  text-center"
                                            style="font-size:16px;font-weight:bold;margin-top:10px;">Tabla lista
                                        </div>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-check"></i></span>

                                            <select class="form-control input" id="nuevaTablaLista"
                                                name="nuevaTablaLista">

                                                <option value="">Seleccionar:</option>
                                                <option value="">Producto</option>
                                                <option value="">Servicio</option>
                                                <option value="">Insumo</option>
                                                <option value="">Mix</option>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-xs-4">
                                        <div class="d-inline-block  text-center"
                                            style="font-size:16px;font-weight:bold;margin-top:10px;">Impuestos
                                            adicionales
                                        </div>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-check"></i></span>

                                            <select class="form-control input" id="nuevoImpuesto" name="nuevoImpuesto">

                                                <option value="">Seleccionar impuesto adicional</option>

                                                <!--
                                              <select class="form-control input" id="nuevoImpuesto" name="nuevoImpuesto" required>

                                                <option value="">Seleccionar Impuesto</option>-->
                                                <?php

                                                $item = null;
                                                $valor = null;

                                                $impuestos = ControladorImpuestos::ctrMostrarImpuestos($item, $valor);

                                                foreach ($impuestos as $key => $value) {

                                                    echo '<option value="' . $value["id"] . '">' . $value["nombre"] . '- %' . $value["factor"] . '</option>';
                                                }

                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="form-group">

                                            <div class="panel"
                                                style="font-weight:bold;margin-top:10px;margin-bottom:-2px;">SUBIR
                                                IMAGEN
                                            </div>

                                            <input type="file" class="nuevaImagen filestyle" name="nuevaImagen"
                                                data-input="false">

                                            <p class="help-block">Peso máximo de la imagen 2MB</p>


                                            <img src="vistas/img/productos/default/anonymous.png"
                                                class="img-thumbnail previsualizar" height="80px" width="80px">

                                        </div>

                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!--=====================================
                PIE DEL MODAL
                ======================================-->

                <div class="modal-footer">

                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

                    <button type="submit" class="btn btn-primary text-center">Guardar producto</button>

                </div>

            </form>

            <?php

            $crearProducto = new ControladorProductos();
            $crearProducto->ctrCrearProducto();
            ?>

        </div>

    </div>

</div>

<!--=====================================
MODAL EDITAR PRODUCTO
======================================-->


<div id="modalEditarProducto" class="modal fade" role="dialog">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <form role="form" method="post" id="form_editar_producto" enctype="multipart/form-data">

                <!--=====================================
                CABEZA DEL MODAL
                ======================================-->

                <div class="modal-header" style="background:#3f668d; color:white">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title">Editar producto</h4>

                </div>

                <!--=====================================
                CUERPO DEL MODAL
                ======================================-->

                <div class="modal-body">

                    <div class="box-body">


                        <!-- ENTRADA PARA SELECCIONAR CATEGORÍA -->


                        <!-- ENTRADA PARA LA DESCRIPCIÓN -->
                        <div class="box box-info">
                            <div class="box-body">
                                <div class="form-group row">
                                    <div class="col-xs-6">
                                        <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold">
                                            Producto
                                        </div>
                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>
                                            <input type="hidden" id="editarProducto" name="editarProducto">
                                            <input type="text" class="form-control input" id="editarDescripcion"
                                                name="editarDescripcion" placeholder="Nombre Producto" required>

                                        </div>
                                    </div>
                                    <div class="col-xs-6">
                                        <div class="d-inline-block  text-center"
                                            style="font-size:16px;font-weight:bold">Rubro asociado
                                        </div>
                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-th"></i></span>

                                            <select class="form-control input" id="editarRubro" name="editarRubro"
                                                required>

                                                <option value="">Seleccionar rubro</option>

                                                <?php

                                                $item = null;
                                                $valor = null;

                                                $rubros = ControladorRubros::ctrMostrarRubros($item, $valor);

                                                foreach ($rubros as $key => $value) {

                                                    echo '<option value="' . $value["id"] . '">' . $value["nombre"] . '</option>';
                                                }

                                                ?>

                                            </select>

                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-xs-6">
                                        <div class="d-inline-block  text-center"
                                            style="font-size:16px;font-weight:bold">Categoría
                                        </div>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-th"></i></span>
                                            <select class="form-control input" id="editarCategoria"
                                                name="editarCategoria" required>

                                                <option value="">Seleccionar categoría</option>

                                                <?php

                                                $item = null;
                                                $valor = null;

                                                $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

                                                foreach ($categorias as $key => $value) {
                                                    echo '<option value="' . $value["id"] . '">' . $value["categoria"] . '</option>';
                                                }

                                                ?>

                                            </select>
                                        </div>
                                    </div>
                                    <!-- ENTRADA PARA LA SUBCATEGORIA -->
                                    <div class="col-xs-6">
                                        <div class="d-inline-block  text-center"
                                            style="font-size:16px;font-weight:bold">Subcategoría
                                        </div>
                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-th"></i></span>

                                            <select class="form-control input" id="editarSubcategoria"
                                                name="editarSubcategoria" required>

                                                <option value="">Seleccionar subcategoría</option>

                                                <?php

                                                $item = null;
                                                $valor = null;

                                                $subcategorias = ControladorSubcategorias::ctrMostrarSubcategorias($item, $valor);

                                                foreach ($subcategorias as $key => $value) {


                                                    echo '<option value="' . $value["id"] . '">' . $value["subcategoria"] . '</option>';
                                                }

                                                ?>

                                            </select>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ENTRADA PARA STOCK -->
                        <div class="box box-danger">
                            <div class="box-body">
                                <div class="form-group row">


                                    <input type="hidden" class="form-control input" id="editarStock" name="editarStock"
                                        min="0" placeholder="Stock" readonly required>
                                    <input type="hidden" class="form-control input" id="editarBodega"
                                        name="editarBodega" required>

                                    <div class="col-xs-6">
                                        <div class="d-inline-block  text-center"
                                            style="font-size:16px;font-weight:bold">Alerta de stock
                                        </div>
                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-check"></i></span>

                                            <input type="number" class="form-control input" id="editarStockAlerta"
                                                name="editarStockAlerta" min="0" placeholder="Alerta de Stock"
                                                required>

                                        </div>
                                    </div>
                                    <div class="col-xs-6">
                                        <div class="d-inline-block  text-center"
                                            style="font-size:16px;font-weight:bold">Stock mínimo
                                        </div>
                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-check"></i></span>

                                            <input type="number" class="form-control input" id="editarStockMin"
                                                name="editarStockMin" min="0" placeholder="Stock Mínimo" required>

                                        </div>
                                    </div>
                                </div>

                                <!-- ENTRADA PARA PRECIO COMPRA -->

                                <div class="form-group row">

                                    <div class="col-xs-4">
                                        <div class="d-inline-block  text-center"
                                            style="font-size:16px;font-weight:bold">Precio de compra neto
                                        </div>
                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>

                                            <input type="number" class="form-control input" id="editarPrecioCompra"
                                                name="editarPrecioCompra" step="any" min="0"
                                                placeholder="Precio de compra" required>

                                        </div>

                                    </div>

                                    <!-- ENTRADA PARA PRECIO VENTA -->

                                    <div class="col-xs-4">
                                        <div class="d-inline-block  text-center"
                                            style="font-size:16px;font-weight:bold">Precio lista neto
                                        </div>
                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span>

                                            <input type="number" class="form-control input" id="editarPrecioVenta"
                                                name="editarPrecioVenta" step="any" min="0"
                                                placeholder="Precio de venta" required>

                                        </div>


                                    </div>

                                    <div class="col-xs-4">
                                        <div class="d-inline-block  text-center"
                                            style="font-size:16px;font-weight:bold">Unidad de medida
                                        </div>
                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-th"></i></span>

                                            <select class="form-control input" id="editarMedida" name="editarMedida"
                                                required>

                                                <option value="">Seleccionar medida</option>

                                                <?php

                                                $item = null;
                                                $valor = null;

                                                $unidades = ControladorUnidades::ctrMostrarUnidades($item, $valor);

                                                foreach ($unidades as $key => $value) {

                                                    echo '<option value="' . $value["id"] . '">' . $value["medida"] . '</option>';
                                                }

                                                ?>

                                            </select>

                                        </div>


                                    </div>

                                </div>


                            </div>
                        </div>
                        <!-- ENTRADA PARA EL CÓDIGO -->


                        <div class="box box-success">
                            <div class="box-body">
                                <div class="form-group row">

                                    <div class="col-xs-4">
                                        <div class="d-inline-block  text-center"
                                            style="font-size:16px;font-weight:bold">Código de producto
                                        </div>
                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-code"></i></span>

                                            <input type="number" class="form-control input" id="editarCodigo"
                                                name="editarCodigo" readonly required>

                                        </div>

                                        <button type="button" class="btn btn-success" style="margin-top:4px"
                                            onclick="editarbarcode();">Generar
                                        </button>
                                        <button type="button" class="btn btn-info" style="margin-top:4px"
                                            onclick="editarimprimir();">Imprimir
                                        </button>
                                        <div id="editarprint" style="display: none;">
                                            <svg id="editarbarcode"></svg>

                                        </div>

                                    </div>


                                    <!-- ENTRADA PARA BODEGA -->


                                    <div class="col-xs-4">
                                        <div class="d-inline-block  text-center"
                                            style="font-size:16px;font-weight:bold">Afecto/Exento
                                        </div>
                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-th"></i></span>

                                            <select class="form-control input" id="editarTipoProducto"
                                                name="editarTipoProducto" required>

                                                <option value="Afecto">Afecto</option>
                                                <option value="Exento">Exento</option>

                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="d-inline-block  text-center"
                                            style="font-size:16px;font-weight:bold;margin-top:10px;">Impuestos
                                            adicionales
                                        </div>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-check"></i></span>

                                            <select class="form-control input" id="editImpuesto" name="editImpuesto">

                                                <option value="">Seleccionar impuesto adicional</option>

                                                <!--
                                              <select class="form-control input" id="nuevoImpuesto" name="nuevoImpuesto" required>

                                                <option value="">Seleccionar Impuesto</option>-->
                                                <?php

                                                $item = null;
                                                $valor = null;

                                                $impuestos = ControladorImpuestos::ctrMostrarImpuestos($item, $valor);

                                                foreach ($impuestos as $key => $value) {

                                                    echo '<option value="' . $value["id"] . '">' . $value["nombre"] . '- %' . $value["factor"] . '</option>';
                                                }

                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="d-inline-block  text-center"
                                            style="font-size:16px;font-weight:bold;margin-top:10px;">Tabla lista
                                        </div>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-check"></i></span>

                                            <select class="form-control input" id="editarTablaLista"
                                                name="editarTablaLista">

                                                <option value="">Seleccionar:</option>
                                                <?php

                                                $item = null;
                                                $valor = null;

                                                $tablalista = ControladorTablaListas::ctrMostrarTablaListas($item, $valor);

                                                foreach ($tablalista as $key => $value) {

                                                    echo '<option value="' . $value["id"] . '">' . $value["nombre"] . '</option>';
                                                }

                                                ?>
                                            </select>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!--=====================================
                PIE DEL MODAL
                ======================================-->

                <div class="modal-footer">

                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

                    <button type="submit" class="btn btn-primary text-center">Guardar producto</button>

                </div>

            </form>

            <?php

            $editarProducto = new ControladorProductos();
            $editarProducto->ctrEditarProducto();
            ?>

        </div>

    </div>

</div>

<?php

$eliminarProducto = new ControladorProductos();
$eliminarProducto->ctrEliminarProducto();

?>