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

      Administrar O.T.V.

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-home"></i>Inicio</a></li>
      <li>Orden de trabajo</li>
      <li class="active">Administrar O.T</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">


        <a href="orden-vestuario">

          <button class="btn btn-primary">

            Crear orden de vestuario

          </button>

        </a>

      </div>

      <div class="box-tools pull-right" style="margin-bottom:5px">
        <a href="vistas/modulos/descargar-reporte-orden-vestuario.php?reporte=reporte">
          <button class="btn btn-success" style="margin-top:5px">Descargar Orden de Vestuario</button>
        </a>


      </div>

      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive  tablas" width="100%">

          <thead>

            <tr>
              <th>Folio</th>
              <th>Tipo DTE</th>
              <th>Emisión</th>
              <th>Vencimiento</th>
              <th>Unidad de negocio</th>
              <th>Bodega</th>
              <th>Cliente</th>
              <th>Nombre orden</th>
              <th>Observación</th>
              <th>Acciones</th>
            </tr>

          </thead>

          <tbody>

            <?php

            $item = null;
            $valor = null;
            //var_dump($item, $valor);
            $vestuario = ControladorOrdenVestuario::ctrMostrarOrdenVestuario($item, $valor);
            //var_dump($vestuario);
            $centros = ControladorCentros::ctrMostrarCentros($item, $valor);
            $bodegas = ControladorBodegas::ctrMostrarBodegas($item, $valor);
            $clientes = ControladorClientes::ctrMostrarClientes($item, $valor);
            $plazos = ControladorPlazos::ctrMostrarPlazos($item, $valor);
            $medios = ControladorMediosPago::ctrMostrarMedios($item, $valor);
            $negocios = ControladorNegocios::ctrMostrarNegocios($item, $valor);

            //var_dump($negocios, $centros, $bodegas, $clientes);

            foreach ($vestuario as $key => $value) {
              for ($i = 0; $i < count($negocios); ++$i) {
                if ($negocios[$i]["id"] == $value["id_unidad_negocio"]) {
                  $negocio = $negocios[$i]["unidad_negocio"];
                }
              }
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
              for ($i = 0; $i < count($clientes); ++$i) {
                if ($clientes[$i]["id"] == $value["id_cliente"]) {
                  $cliente = $clientes[$i]["nombre"];
                }
              }



              echo '<tr>


                    <td>' . $value["codigo"] . '</td>

                    <td style="color:black;font-weight:bold;">Orden de Vestuario</td>

                    <td>' . $value["fecha_emision"] . '</td>

                    <td>' . $value["fecha_vencimiento"] . '</td>

                    <td>' . $centro . '</td>

                    <td>' . $bodega . '</td>      

                    <td>' . $cliente . '</td>

                    <td>' . $value["nombre_orden"] . '</td>

                    <td>' . $value["observacion"] . '</td>


                    <td>

                    <div class="btn-group">
                     ';

              if ($_SESSION["perfil"] == "Administrador") {
                echo ' 
                     <button class="btn btn-warning btnEditarOrdenVestuario" idOrdenVestuario="' . $value["id"] . '"><i class="fa fa-pencil"></i></button>
                     <button class="btn btn-danger btnEliminarOrdenVestuario" idOrdenVestuario="' . $value["id"] . '"><i class="fa fa-times"></i></button>';
              }

              echo '</div>  

                  </td>


                  </tr>';
            }



            ?>

          </tbody>

        </table>
        <?php

        $eliminarOrdenVestuario = new ControladorOrdenVestuario();
        $eliminarOrdenVestuario->ctrEliminarOrdenVestuario();

        ?>


      </div>

    </div>

  </section>

</div>