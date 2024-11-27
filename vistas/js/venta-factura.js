$(".tablaVentaFactura").DataTable({
  ajax: "ajax/datatable-ventas.ajax.php",
  deferRender: true,
  retrieve: true,
  processing: true,
  language: {
    sProcessing: "Procesando...",
    sLengthMenu: "Mostrar _MENU_ registros",
    sZeroRecords: "No se encontraron resultados",
    sEmptyTable: "Ningún dato disponible en esta tabla",
    sInfo: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
    sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0",
    sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
    sInfoPostFix: "",
    sSearch: "Buscar:",
    sUrl: "",
    sInfoThousands: ",",
    sLoadingRecords: "Cargando...",
    oPaginate: {
      sFirst: "Primero",
      sLast: "Último",
      sNext: "Siguiente",
      sPrevious: "Anterior",
    },
    oAria: {
      sSortAscending: ": Activar para ordenar la columna de manera ascendente",
      sSortDescending:
        ": Activar para ordenar la columna de manera descendente",
    },
  },
});

$(".tablaVentaFactura tbody").on(
  "click",
  "button.agregarProducto",
  function () {
    var idProducto = $(this).attr("idProducto");

    $(this).removeClass("btn-primary agregarProducto");

    $(this).addClass("btn-default");

    var datos = new FormData();
    datos.append("idProducto", idProducto);

    $.ajax({
      url: "ajax/productos.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function (respuesta) {
        console.table(respuesta, "respuesta");
        var descripcion = respuesta["descripcion"];
        var precio =
          respuesta["precio_venta"] * (1 - $("#traerFactor").val() / 100);
        var desc = 0;
        var total_neto = precio - desc;
        var impuesto = precio * 0.19;
        var total = Number(precio) + Number(impuesto);
        console.log(precio);

        $(".nuevoProducto").append(
          '<div class="row" style="padding:5px 15px">' +
            "<!-- Descripción del producto -->" +
            '<div class="col-xs-2" style="padding-right:0px">' +
            '<div class="input-group">' +
            '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto="' +
            idProducto +
            '"><i class="fa fa-times"></i></button></span>' +
            '<input type="text" class="form-control nuevaDescripcionProducto" idProducto="' +
            idProducto +
            '" name="agregarProducto" value="' +
            descripcion +
            '" readonly required>' +
            "</div>" +
            "</div>" +
            "<!-- Cantidad del producto -->" +
            '<div class="col-xs-1 cantidadProducto" style="padding-right:0px">' +
            '<input type="text" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="1"  required>' +
            "</div>" +
            "<!-- Precio Unitario -->" +
            '<div class="col-xs-1 precioUnitario" style="padding-right:0px">' +
            '<input type="text"  class="form-control nuevoPrecioUnitario" style="padding:5px; padding-left:1px"  name="nuevoPrecioUnitario" value="' +
            precio +
            '" required>' +
            "</div>" +
            "<!-- Subtotal Neto -->" +
            '<div class="col-xs-1 subtotalProducto" style="padding-right:0px">' +
            '<input type="text" class="form-control nuevoSubtotalProducto" style="padding:5px" name="nuevoSubtotalProducto" min="0" value="' +
            precio +
            '"  readonly required>' +
            "</div>" +
            "<!-- Descuento -->" +
            '<div class="col-xs-1 descuentoProducto" style="padding-right:0px">' +
            '<input type="text" class="form-control nuevoDescuentoProducto" style="padding:5px" name="nuevoDescuentoProducto" min="0" value="' +
            desc +
            '"  required>' +
            "</div>" +
            "<!-- Precio Total Neto del producto -->" +
            '<div class="col-xs-2 ingresoPrecio" style="padding-right:0px">' +
            '<input   type="text" class="form-control nuevoPrecioProducto" onchange="cambios()" precioReal="' +
            precio +
            '" name="nuevoPrecioProducto" value="' +
            total_neto +
            '" readonly required>' +
            "</div>" +
            "<!-- IVA del producto -->" +
            '<div class="col-xs-1 ivaProducto" style="padding-right:0px">' +
            '<input type="text" class="form-control nuevoIvaProducto" style="padding:5px" name="nuevoIvaProducto" min="0" value="' +
            impuesto +
            '"  readonly required>' +
            "</div>" +
            "<!-- OTROS IMPUESTOS del producto -->" +
            '<div class="col-xs-1 " style="padding-right:0px">' +
            '<input type="text" class="form-control nuevoOtrosImpuestosProducto" style="padding:5px" name="nuevoOtrosImpuestosProducto" min="0" value="0"  required>' +
            "</div>" +
            '<div class="col-xs-2 totalProducto style="padding-right:0px">' +
            '<input type="text" class="form-control nuevoTotalProducto" name="nuevoTotalProducto" min="0" value="' +
            total +
            '" readonly required>' +
            "</div>" +
            "</div>"
        );

        // SUMAR TOTAL DE PRECIOS

        sumarTotalPrecios();

        // AGREGAR IMPUESTO

        agregarImpuesto();

        // AGRUPAR PRODUCTOS EN FORMATO JSON

        listarProductos();

        // PONER FORMATO AL PRECIO DE LOS PRODUCTOS

        $(".nuevoPrecioProducto").number(true, 0);
        $(".nuevoTotalProducto").number(true, 0);
        $(".nuevoDescuentoProducto").number(true, 0);
        $(".nuevoPrecioUnitario").number(true, 0);
        $(".nuevoSubtotalProducto").number(true, 0);
        $(".nuevoIvaProducto").number(true, 0);
        $("#nuevoTotalFinal").number(true, 0);
        $("#nuevoTotalIva").number(true, 0);
        $("#nuevoSubtotal").number(true, 0);

        localStorage.removeItem("quitarProducto");
      },
    });
  }
);

$("#nuevoClienteFactura").change(function () {
  var idCliente = $(this).val();
  var idLista = $("option:selected", this).attr("idLista");
  console.log(idCliente);
  console.log(idLista);
  var datos = new FormData();
  datos.append("idCliente", idCliente);
  var datos2 = new FormData();
  datos2.append("idLista", idLista);

  $.ajax({
    url: "ajax/listas.ajax.php",
    method: "POST",
    data: datos2,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      var factor = respuesta["factor"];
      var nombre_lista = respuesta["nombre_lista"];
      var factor_lista = nombre_lista + " - " + factor + " %";
      $.ajax({
        url: "ajax/clientes.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
          console.log("respuesta", respuesta);
          $("#traerId").val(respuesta["id"]);
          $("#traerRut").val(respuesta["rut"]);
          $("#traerDireccion").val(respuesta["direccion"]);
          $("#traerTelefono").val(respuesta["telefono"]);
          $("#traerEmail").val(respuesta["email"]);
          $("#traerActividad").val(respuesta["actividad"]);
          $("#traerEjecutivo").val(respuesta["ejecutivo"]);
          $("#traerFactor").val(factor);
          $("#traerLista").val(factor_lista);
        },
      });
    },
  });
});

$(".tablas").on("click", ".btnEliminarVentaAfecta", function () {
  var idAfecta = $(this).attr("idAfecta");

  swal({
    title: "¿Está seguro de borrar esta venta afecta?",
    text: "Si no lo está, puede cancelar la acción.",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    cancelButtonText: "Cancelar",
    confirmButtonText: "Sí, borrar venta",
  }).then(function (result) {
    if (result.value) {
      window.location = "index.php?ruta=ventas&idAfecta=" + idAfecta;
    }
  });
});

$(".tablas").on("click", ".btnImprimirVentaAfecta", function () {
  var codigoVenta = $(this).attr("codigoVenta");
  var tipoDocumento = "Factura_Afecta";

  window.open(
    "extensiones/tcpdf/pdf/documento.php?codigo=" +
      codigoVenta +
      "&documento=" +
      tipoDocumento,
    "_blank"
  );
});

$(".tablas").on("click", ".btnNotaVentaAfecta", function () {
  var idVenta = $(this).attr("idVenta");

  window.location = "index.php?ruta=nota-credito&idVenta=" + idVenta;
});

$(".tablas").on("click", ".btnNotaVentaExenta", function () {
  var idVenta = $(this).attr("idVenta");

  window.location = "index.php?ruta=nota-credito-exenta&idVenta=" + idVenta;
});

$(".tablas").on("click", ".btnNotaVentaBoleta", function () {
  var idVenta = $(this).attr("idVenta");

  window.location = "index.php?ruta=nota-credito-boleta&idVenta=" + idVenta;
});

$(".tablas").on("click", ".btnNotaVentaBoletaExenta", function () {
  var idVenta = $(this).attr("idVenta");

  window.location =
    "index.php?ruta=nota-credito-boleta-exenta&idVenta=" + idVenta;
});
