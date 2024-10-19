<?php
if($_SESSION["perfil"] == "Vendedor"){
    echo '<script>window.location = "inicio";</script>';
    return;
}
?>

<div class="content-wrapper">
    <section class="content-header">
        <h1>Administrar listas de precios</h1>
        <ol class="breadcrumb">
          <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
          <li class="active">Administrar listas</li>
        </ol>
    </section>

    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarLista">
                    Agregar lista de precios
                </button>
            </div>

            <div class="box-body">
                <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
                    <thead>
                        <tr>
                          <th style="width:10px">#</th>
                          <th>Lista</th>
                          <th>Descuento</th>
                          <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $item = null;
                        $valor = null;

                        $listas = ControladorListas::ctrMostrarListas($item, $valor);

                        foreach ($listas as $key => $value) {
                            echo ' <tr>
                                   <td>'.($key+1).'</td>
                                   <td>'.$value["nombre_lista"].'</td>
                                   <td>'.$value["factor"].'%</td>
                                   <td>
                                       <div class="btn-group">
                                           <button class="btn btn-warning btnEditarListas" idLista="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarLista"><i class="fa fa-pencil"></i></button>
                                           <button class="btn btn-danger btnEliminarListas" idLista="'.$value["id"].'"><i class="fa fa-times"></i></button>
                                       </div>  
                                    </td>
                                  </tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>

<!--=====================================
MODAL AGREGAR LISTA DE PRECIOS
======================================-->
<div id="modalAgregarLista" class="modal fade" role="dialog">
    <style>
        .error{
            color: red;
        }
    </style>
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" method="post" id="form_nueva_unidad">

            <!--=====================================
            CABEZA DEL MODAL
            ======================================-->
                <div class="modal-header" style="background:#3f668d; color:white">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Agregar lista de precios</h4>
                </div>
            <!--=====================================
            CUERPO DEL MODAL
            ======================================-->
                <div class="modal-body">
                    <div class="box-body">
                        <!-- ENTRADA PARA EL NOMBRE -->
                        <div class="form-group">
                            <div class="d-inline-block bg-primary" style="background-color:#3c8dbc;font-size:16px;font-weight:bold">Lista</div>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                                <input type="text" class="form-control input" name="nuevaLista" id="nuevaLista" placeholder="Ingresar lista" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="d-inline-block bg-primary" style="background-color:#3c8dbc;font-size:16px;font-weight:bold">Descuento</div>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                                <input type="number" class="form-control input" id="nuevoFactor" name="nuevoFactor"  placeholder="Ingresar descuento" required max="100">
                            </div>
                        </div>
                    </div>
                </div>
            <!--=====================================
            PIE DEL MODAL
            ======================================-->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
                    <button type="submit" class="btn btn-primary" name="crear_lista">Agregar lista</button>
                </div>

                <?php
                  $crearLista = new ControladorListas();
                  $crearLista -> ctrCrearLista();
                ?>
            </form>
        </div>
    </div>
</div>

<!--=====================================
MODAL EDITAR LISTA
======================================-->

<div id="modalEditarLista" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form role="form" method="post" id="form_editar_lista">
                <!--=====================================
                CABEZA DEL MODAL
                ======================================-->
                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Editar lista de precios</h4>
                </div>
                <!--=====================================
                CUERPO DEL MODAL
                ======================================-->
                <div class="modal-body">
                    <div class="box-body">
                        <!-- ENTRADA PARA EL NOMBRE -->
                        <div class="form-group">
                            <div class="d-inline-block bg-primary" style="background-color:#3c8dbc;font-size:16px;font-weight:bold">Lista</div>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-th"></i></span>
                                    <input type="text" class="form-control input" id="editarLista" name="editarLista"  required>
                                    <input type="hidden" id="idLista"  name="idLista"  required>
                                </div>
                        </div>

                        <div class="form-group">
                            <div class="d-inline-block bg-primary" style="background-color:#3c8dbc;font-size:16px;font-weight:bold">Descuento</div>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                                <input type="number" class="form-control input" id="editarFactor" name="editarFactor"  required max="100">
                            </div>
                        </div>
                    </div>
                </div>

                <!--=====================================
                PIE DEL MODAL
                ======================================-->
                <div class="modal-footer">
                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
                  <button type="submit" class="btn btn-primary">Guardar cambios</button>
                </div>

                <?php

                $editarLista = new ControladorListas();
                $editarLista -> ctrEditarLista();

                ?>
            </form>
        </div>
    </div>
</div>

<?php

$borrarLista = new ControladorListas();
$borrarLista -> ctrBorrarLista();

?>