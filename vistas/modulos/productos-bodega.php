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

            Productos por bodega

        </h1>

        <ol class="breadcrumb">

            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

            <li class="active">Administrar productos por bodega</li>

        </ol>

    </section>

    <section class="content">

        <div class="box">

            <div class="box-header with-border">
                <?php

                echo '<a href="vistas/modulos/descargar-reporte-bodegas.php?reporte=reporte">';
                ?>
                <button class="btn btn-success">Descargar reporte de bodegas</button>
                </a>
            </div>

            <div class="box-body">
                <form role="form" method="post">
                    <!--<div class="row">
                                        
                                        <div class="col-lg-4">
                                            <div class="d-block" style="font-size:14px;">Bodega:</div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                    
                                                  <span class="input-group-addon"><i class="fa fa-check"></i></span> 

                                                    <select style="padding-left:0px" class="form-control input" id="idBodega" name="idBodega" required>
                                                        
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


                                        <div class="col-lg-2">
                                            <button type="submit" class="btn btn-primary" style="margin-top:20px;">CONSULTAR</button>
                                        </div>
                                        
                                        
                                  </div>-->
                </form>


                <?php
                $productosBodega = new ControladorProductos();
                $res = $productosBodega->ctrMostrarProductosPorBodega();
                echo '<h1>BODEGAS</h1>';
                foreach ($res as $key => $value) {
                    $prod = $value["productos"];

                    echo '
                                  <div class="col-md-5">
                                  <h2>' . $value["bodega"] . '</h2>
                                  <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
                                  <thead>
                                   
                                   <tr>
                                     
                                     <th>Descripción</th>
                                     <th>Stock</th>
                                     <th>Alerta de stock</th>
                                     <th>Stock mínimo</th>
                                  
                          
                                   </tr> 
                          
                                  </thead>
                          
                                  <tbody>
                                      
                                    <tr>';
                    foreach ($prod as $key => $val) {
                        echo '<td>

                                      ' . $val["producto"] . '
                                      </td>';

                        if ($val["stock"] > $val["stock_alerta"]) {
                            echo '<td idProducto="' . $val["id"] . '"><button class="btn btn-success">' . $val["stock"] . ' </button></td>';
                        } else if ($val["stock"] <= $val["stock_alerta"] && $val["stock"] > $val["stock_min"]) {
                            echo '<td  idProducto="' . $val["id"] . '"><button class="btn btn-warning">' . $val["stock"] . ' </button></td>';
                        } else if ($val["stock"] <= $val["stock_min"]) {
                            echo '<td  idProducto="' . $val["id"] . '"><button class="btn btn-danger">' . $val["stock"] . ' </button></td>';
                        }


                        echo '
                                      <td>' . $val["stock_alerta"] . '</td>
                                      <td>' . $val["stock_min"] . '</td>
                                      </tr>';
                    }
                    echo '
                                    
                                  </tbody>
                          
                                 </table>
                                 </div>';


                }
                ?>


                <input type="hidden" value="<?php echo $_SESSION['perfil']; ?>" id="perfilOculto">

            </div>

        </div>

    </section>

</div>

<!--=====================================
MODAL VER DETALLE PRODUCTO
======================================-->
<style>
    .error {
        color: red;
    }
</style>
<div id="modalVerDetalle" class="modal fade" role="dialog">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <form role="form" method="post" id="form_nuevo_producto" enctype="multipart/form-data">

                <!--=====================================
                CABEZA DEL MODAL
                ======================================-->

                <div class="modal-header" style="background:#3f668d; color:white">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title">DETALLE INVENTARIO</h4>

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
                                    <div class="col-xs-4">
                                        <div class="d-inline-block text-center" style="font-size:16px;font-weight:bold">
                                            Producto
                                        </div>
                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>

                                            <input type="text" class="form-control input" name="nuevaDescripcion"
                                                   placeholder="Nombre Producto" required>

                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="d-inline-block  text-center"
                                             style="font-size:16px;font-weight:bold">Bodega
                                        </div>
                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-th"></i></span>

                                            <input type="text" class="form-control input" name="nuevaDescripcion"
                                                   placeholder="Nombre Producto" required>

                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="d-inline-block  text-center"
                                             style="font-size:16px;font-weight:bold">Fecha
                                        </div>
                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                                            <input type="date" class="form-control input"
                                                   value="<?php echo date("Y-m-d"); ?>">

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- ENTRADA PARA STOCK -->

                        <!-- ENTRADA PARA EL CÓDIGO -->
                        <div class="form-group row">
                            <div class="box-title">
                                <div class="col-xs-4">
                                    <div class="d-inline-block text-left" style="font-size:28px; font-weight:bold;">
                                        CARGA INICIAL
                                    </div>
                                </div>
                                <div class="col-xs-3 col-xs-offset-5">
                                    <div class="d-inline-block text-center" style="font-size:22px;">${valor-inicial}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box box-success">
                            <div class="box-title">
                                <h4 style="font-weight:bold">ENTRADAS</h4></div>
                            <div class="box-body">
                                <div class="form-group row">
                                    <div class="col-xs-4">
                                        <div class="d-inline-block text-left" style="font-size:22px;">Compras</div>
                                    </div>
                                    <div class="col-xs-2 col-xs-offset-6">
                                        <div class="d-inline-block text-center" style="font-size:22px;">${cantidad}
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="d-inline-block text-left" style="font-size:22px;">Nota de Credito
                                        </div>
                                    </div>
                                    <div class="col-xs-2 col-xs-offset-6">
                                        <div class="d-inline-block text-center" style="font-size:22px;">${cantidad}
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="d-inline-block text-left" style="font-size:22px;">Bodega a Bodega
                                        </div>
                                    </div>
                                    <div class="col-xs-2 col-xs-offset-6">
                                        <div class="d-inline-block text-center" style="font-size:22px;">${cantidad}
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="d-inline-block text-left" style="font-size:22px;">Ingreso Manual a
                                            Bodega
                                        </div>
                                    </div>
                                    <div class="col-xs-2 col-xs-offset-6">
                                        <div class="d-inline-block text-center" style="font-size:22px;">${cantidad}
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="d-inline-block text-left" style="font-size:22px;">OT a Bodega</div>
                                    </div>
                                    <div class="col-xs-2 col-xs-offset-6">
                                        <div class="d-inline-block text-center" style="font-size:22px;">${cantidad}
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="d-inline-block text-left" style="font-size:22px;">Ajuste de
                                            Inventario
                                        </div>
                                    </div>
                                    <div class="col-xs-2 col-xs-offset-6">
                                        <div class="d-inline-block text-center" style="font-size:22px;">${cantidad}
                                        </div>
                                    </div>
                                    </hr>
                                    <div class="col-xs-4 col-xs-offset-4">
                                        <div class="d-inline-block text-left" style="font-size:22px; font-weight:bold">
                                            Total Entradas
                                        </div>
                                    </div>
                                    <div class="col-xs-3 col-xs-offset-1">
                                        <div class="d-inline-block text-right" style="font-size:20px;">
                                            ${Total_Entradas}
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="box box-warning">
                            <div class="box-title">
                                <h4 style="font-weight:bold">SALIDAS</h4></div>
                            <div class="box-body">
                                <div class="form-group row">
                                    <div class="col-xs-4">
                                        <div class="d-inline-block text-left" style="font-size:22px;">Factura Afecta
                                        </div>
                                    </div>
                                    <div class="col-xs-2 col-xs-offset-6">
                                        <div class="d-inline-block text-center" style="font-size:22px;">${cantidad}
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="d-inline-block text-left" style="font-size:22px;">Factura Exenta
                                        </div>
                                    </div>
                                    <div class="col-xs-2 col-xs-offset-6">
                                        <div class="d-inline-block text-center" style="font-size:22px;">${cantidad}
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="d-inline-block text-left" style="font-size:22px;">Venta Boleta</div>
                                    </div>
                                    <div class="col-xs-2 col-xs-offset-6">
                                        <div class="d-inline-block text-center" style="font-size:22px;">${cantidad}
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="d-inline-block text-left" style="font-size:22px;">Nota Debito</div>
                                    </div>
                                    <div class="col-xs-2 col-xs-offset-6">
                                        <div class="d-inline-block text-center" style="font-size:22px;">${cantidad}
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="d-inline-block text-left" style="font-size:22px;">Salida Manual
                                        </div>
                                    </div>
                                    <div class="col-xs-2 col-xs-offset-6">
                                        <div class="d-inline-block text-center" style="font-size:22px;">${cantidad}
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="d-inline-block text-left" style="font-size:22px;">Bodega a OT</div>
                                    </div>
                                    <div class="col-xs-2 col-xs-offset-6">
                                        <div class="d-inline-block text-center" style="font-size:22px;">${cantidad}
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="d-inline-block text-left" style="font-size:22px;">Ajuste de
                                            Inventario
                                        </div>
                                    </div>
                                    <div class="col-xs-2 col-xs-offset-6">
                                        <div class="d-inline-block text-center" style="font-size:22px;">${cantidad}
                                        </div>
                                    </div>
                                    </hr>
                                    <div class="col-xs-4 col-xs-offset-4">
                                        <div class="d-inline-block text-left" style="font-size:22px; font-weight:bold">
                                            Total Salidas
                                        </div>
                                    </div>
                                    <div class="col-xs-3 col-xs-offset-1">
                                        <div class="d-inline-block text-right" style="font-size:20px;">
                                            ${Total_Salidas}
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="box-title">
                                <div class="col-xs-4">
                                    <div class="d-inline-block text-left" style="font-size:28px; font-weight:bold;">
                                        TOTAL INVENTARIO
                                    </div>
                                </div>
                                <div class="col-xs-3 col-xs-offset-5">
                                    <div class="d-inline-block text-center" style="font-size:22px;">
                                        ${valor_inventario}
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

                </div>

            </form>


        </div>

    </div>

</div>
<script>


</script>




