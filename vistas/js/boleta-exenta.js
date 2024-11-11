$(".tablaVentaBoletaExenta").DataTable({
  ajax: "ajax/datatable-ventas-exentas.ajax.php",
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

/*=============================================
AGREGANDO PRODUCTOS A LA VENTA DESDE LA TABLA
=============================================*/

$(".tablaVentaBoletaExenta tbody").on(
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
        var descripcion = respuesta["descripcion"];
        var precio =
          respuesta["precio_venta"] * (1 - $("#traerFactor").val() / 100);
        var desc = 0;
        var total_neto = precio - desc;
        var impuesto = 0;
        var total = Number(precio) + Number(impuesto);

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
            '<input   type="hidden" class="form-control nuevoPrecioProducto" onchange="cambios()" precioReal="' +
            precio +
            '" name="nuevoPrecioProducto" value="' +
            total_neto +
            '" readonly required>' +
            '<input type="hidden" class="form-control nuevoIvaProducto" style="padding:5px" name="nuevoIvaProducto" min="0" value="' +
            impuesto +
            '"  readonly required>' +
            '<input type="hidden" class="form-control nuevoOtrosImpuestosProducto" style="padding:5px" name="nuevoOtrosImpuestosProducto" min="0" value="0" readonly required>' +
            '<div class="col-xs-2 totalProducto style="padding-right:0px">' +
            '<input type="text" class="form-control nuevoTotalProducto" name="nuevoTotalProducto" id="nuevoTotalProducto" min="0" value="' +
            total +
            '" readonly required>' +
            "</div>" +
            "</div>"
        );

        // SUMAR TOTAL DE PRECIOS

        sumarTotalPreciosCotizacionExenta();

        // AGREGAR IMPUESTO

        agregarImpuesto();

        // AGRUPAR PRODUCTOS EN FORMATO JSON

        listarProductos();

        // PONER FORMATO AL PRECIO DE LOS PRODUCTOS

        // Poner formato al precio de los productos
        $(".nuevoPrecioProducto").number(true, 0); // 0 decimales
        $(".nuevoTotalProducto").number(true, 0); // 0 decimales
        $(".nuevoDescuentoProducto").number(true, 0); // 0 decimales
        $(".nuevoPrecioUnitario").number(true, 0); // 0 decimales
        $(".nuevoSubtotalProducto").number(true, 0); // 0 decimales
        $(".nuevoIvaProducto").number(true, 0); // 0 decimales
        $("#nuevoTotalFinal").number(true, 0); // 0 decimales

        localStorage.removeItem("quitarProducto");
      },
    });
  }
);

$(document).ready(function () {
  // Poner formato al precio de las notas de credito y edicion de cotizaciones afectas y exentas
  $(".nuevoPrecioProducto").number(true, 0); // 0 decimales
  $(".nuevoTotalProducto").number(true, 0); // 0 decimales
  $(".nuevoDescuentoProducto").number(true, 0); // 0 decimales
  $(".nuevoPrecioUnitario").number(true, 0); // 0 decimales
  $(".nuevoSubtotalProducto").number(true, 0); // 0 decimales
  $(".nuevoIvaProducto").number(true, 0); // 0 decimales
  $("#nuevoTotalFinal").number(true, 0); // 0 decimales
});

function cambios() {
  sumarTotalPreciosCotizacionExenta();

  // AGREGAR IMPUESTO

  agregarImpuesto();

  // AGRUPAR PRODUCTOS EN FORMATO JSON

  listarProductos();
}

/*=============================================
CUANDO CARGUE LA TABLA CADA VEZ QUE NAVEGUE EN ELLA
=============================================*/

$(".tablaCompras").on("draw.dt", function () {
  if (localStorage.getItem("quitarProducto") != null) {
    var listaIdProductos = JSON.parse(localStorage.getItem("quitarProducto"));

    for (var i = 0; i < listaIdProductos.length; i++) {
      $(
        "button.recuperarBoton[idProducto='" +
          listaIdProductos[i]["idProducto"] +
          "']"
      ).removeClass("btn-default");
      $(
        "button.recuperarBoton[idProducto='" +
          listaIdProductos[i]["idProducto"] +
          "']"
      ).addClass("btn-primary agregarProducto");
    }
  }
});

/*=============================================
QUITAR PRODUCTOS DE LA VENTA Y RECUPERAR BOTÓN
=============================================*/

var idQuitarProducto = [];

localStorage.removeItem("quitarProducto");

$(".formularioFacturaExenta").on("click", "button.quitarProducto", function () {
  $(this).parent().parent().parent().parent().remove();

  var idProducto = $(this).attr("idProducto");

  /*=============================================
	ALMACENAR EN EL LOCALSTORAGE EL ID DEL PRODUCTO A QUITAR
	=============================================*/

  if (localStorage.getItem("quitarProducto") == null) {
    idQuitarProducto = [];
  } else {
    idQuitarProducto.concat(localStorage.getItem("quitarProducto"));
  }

  idQuitarProducto.push({ idProducto: idProducto });

  localStorage.setItem("quitarProducto", JSON.stringify(idQuitarProducto));

  $("button.recuperarBoton[idProducto='" + idProducto + "']").removeClass(
    "btn-default"
  );

  $("button.recuperarBoton[idProducto='" + idProducto + "']").addClass(
    "btn-primary agregarProducto"
  );

  if ($(".nuevoProducto").children().length == 0) {
    $("#nuevoImpuestoVenta").val(0);
    $("#nuevoTotalVenta").val(0);
    $("#totalVenta").val(0);
    $("#nuevoTotalVenta").attr("total", 0);
    $("#TotalPagado").val(0);
  } else {
    // SUMAR TOTAL DE PRECIOS

    sumarTotalPreciosCotizacionExenta();

    // AGREGAR IMPUESTO

    agregarImpuesto();

    // AGRUPAR PRODUCTOS EN FORMATO JSON

    listarProductos();
  }
});

/*=============================================
AGREGANDO PRODUCTOS DESDE EL BOTÓN PARA DISPOSITIVOS
=============================================*/

var numProducto = 0;

$(".btnAgregarProducto").click(function () {
  numProducto++;

  var datos = new FormData();
  datos.append("traerProductos", "ok");

  $.ajax({
    url: "ajax/productos.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      $(".nuevoProducto").append(
        '<div class="row" style="padding:5px 15px">' +
          "<!-- Descripción del producto -->" +
          '<div class="col-xs-6" style="padding-right:0px">' +
          '<div class="input-group">' +
          '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto><i class="fa fa-times"></i></button></span>' +
          '<select class="form-control nuevaDescripcionProducto" id="producto' +
          numProducto +
          '" idProducto name="nuevaDescripcionProducto" required>' +
          "<option>Seleccione el producto</option>" +
          "</select>" +
          "</div>" +
          "</div>" +
          "<!-- Cantidad del producto -->" +
          '<div class="col-xs-3 ingresoCantidad">' +
          '<input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="0" stock nuevoStock required>' +
          "</div>" +
          "<!-- Precio del producto -->" +
          '<div class="col-xs-3 ingresoPrecio" style="padding-left:0px">' +
          '<div class="input-group">' +
          '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>' +
          '<input type="text" class="form-control nuevoPrecioProducto" precioReal="" name="nuevoPrecioProducto" readonly required>' +
          "</div>" +
          "</div>" +
          "</div>"
      );

      // AGREGAR LOS PRODUCTOS AL SELECT

      respuesta.forEach(funcionForEach);

      function funcionForEach(item, index) {
        if (item.stock != 0) {
          $("#producto" + numProducto).append(
            '<option idProducto="' +
              item.id +
              '" value="' +
              item.descripcion +
              '">' +
              item.descripcion +
              "</option>"
          );
        }
      }

      // SUMAR TOTAL DE PRECIOS

      sumarTotalPreciosCotizacionExenta();

      // AGREGAR IMPUESTO

      agregarImpuesto();

      // PONER FORMATO AL PRECIO DE LOS PRODUCTOS

      $(".nuevoPrecioProducto").number(true, 0);
    },
  });
});

/*=============================================
SELECCIONAR PRODUCTO
=============================================*/

$(".formularioFacturaExenta").on(
  "change",
  "select.nuevaDescripcionProducto",
  function () {
    var nombreProducto = $(this).val();

    var nuevaDescripcionProducto = $(this)
      .parent()
      .parent()
      .parent()
      .children()
      .children()
      .children(".nuevaDescripcionProducto");

    var nuevoPrecioProducto = $(this)
      .parent()
      .parent()
      .parent()
      .children(".ingresoPrecio")
      .children()
      .children(".nuevoPrecioProducto");

    var nuevaCantidadProducto = $(this)
      .parent()
      .parent()
      .parent()
      .children(".ingresoCantidad")
      .children(".nuevaCantidadProducto");

    var datos = new FormData();
    datos.append("nombreProducto", nombreProducto);

    $.ajax({
      url: "ajax/productos.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function (respuesta) {
        $(nuevaDescripcionProducto).attr("idProducto", respuesta["id"]);
        $(nuevaCantidadProducto).attr("stock", respuesta["stock"]);
        $(nuevaCantidadProducto).attr(
          "nuevoStock",
          Number(respuesta["stock"]) - 1
        );
        $(nuevoPrecioProducto).val(respuesta["precio_venta"]);
        $(nuevoPrecioProducto).attr("precioReal", respuesta["precio_venta"]);

        // AGRUPAR PRODUCTOS EN FORMATO JSON

        listarProductos();
      },
    });
  }
);

/*=============================================
MODIFICAR PRECIO UNITARIO
=============================================*/
$(".formularioFacturaExenta").on(
  "change",
  "input.nuevoPrecioUnitario",
  function () {
    var descuento = $(this)
      .parent()
      .parent()
      .children(".descuentoProducto")
      .children(".nuevoDescuentoProducto");
    var cantidad = $(this)
      .parent()
      .parent()
      .children(".cantidadProducto")
      .children(".nuevaCantidadProducto");
    var precio = $(this)
      .parent()
      .parent()
      .children(".ingresoPrecio")
      .children(".nuevoPrecioProducto");
    var subtotal = $(this)
      .parent()
      .parent()
      .children(".subtotalProducto")
      .children(".nuevoSubtotalProducto");
    var iva = $(this)
      .parent()
      .parent()
      .children(".ivaProducto")
      .children(".nuevoIvaProducto");
    var total = $(this)
      .parent()
      .parent()
      .children(".totalProducto")
      .children(".nuevoTotalProducto");
    var subtotalFinal = cantidad.val() * $(this).val();
    var precioFinal = cantidad.val() * $(this).val() - descuento.val();
    var ivaFinal = 0;
    var totalFinal = precioFinal + ivaFinal;
    iva.val(ivaFinal);
    precio.val(precioFinal);
    subtotal.val(subtotalFinal);
    total.val(totalFinal);
    $("#nuevoTotalPagar").val(total.val()).number(true, 0);

    listarProductos();
    sumarTotalPreciosCotizacionExenta();
  }
);
/*=============================================
MODIFICAR LA CANTIDAD
=============================================*/

$(".formularioFacturaExenta").on(
  "change",
  "input.nuevaCantidadProducto",
  function () {
    var preciou = $(this)
      .parent()
      .parent()
      .children(".precioUnitario")
      .children(".nuevoPrecioUnitario");
    var precio = $(this)
      .parent()
      .parent()
      .children(".ingresoPrecio")
      .children(".nuevoPrecioProducto");
    var descuento = $(this)
      .parent()
      .parent()
      .children(".descuentoProducto")
      .children(".nuevoDescuentoProducto");
    var subtotal = $(this)
      .parent()
      .parent()
      .children(".subtotalProducto")
      .children(".nuevoSubtotalProducto");
    var iva = $(this)
      .parent()
      .parent()
      .children(".ivaProducto")
      .children(".nuevoIvaProducto");
    var total = $(this)
      .parent()
      .parent()
      .children(".totalProducto")
      .children(".nuevoTotalProducto");
    var subtotalFinal = preciou.val() * $(this).val();
    var precioFinal = $(this).val() * preciou.val() - descuento.val();
    var ivaFinal = 0;
    var totalFinal = precioFinal + ivaFinal;
    iva.val(ivaFinal);
    precio.val(precioFinal);
    subtotal.val(subtotalFinal);
    total.val(totalFinal);
    $("#nuevoTotalPagar").val(total.val()).number(true, 0);
    var nuevoStock = Number($(this).attr("stock")) - $(this).val();

    $(this).attr("nuevoStock", nuevoStock);

    if (Number($(this).val()) > Number($(this).attr("stock"))) {
      /*=============================================
		SI LA CANTIDAD ES SUPERIOR AL STOCK REGRESAR VALORES INICIALES
		=============================================*/

      $(this).val(0);

      $(this).attr("nuevoStock", $(this).attr("stock"));

      var precioFinal = $(this).val() * precio.attr("precioReal");

      precio.val(precioFinal);

      sumarTotalPreciosCotizacionExenta();

      swal({
        title: "La cantidad supera el Stock",
        text: "¡Sólo hay " + $(this).attr("stock") + " unidades!",
        type: "error",
        confirmButtonText: "¡Cerrar!",
      });

      return;
    }

    // SUMAR TOTAL DE PRECIOS

    sumarTotalPreciosCotizacionExenta();

    // AGREGAR IMPUESTO

    agregarImpuesto();

    // AGRUPAR PRODUCTOS EN FORMATO JSON

    listarProductos();
  }
);
/*=============================================
MODIFICAR DESCUENTO
=============================================*/

$(".formularioFacturaExenta").on(
  "change",
  "input.nuevoDescuentoProducto",
  function () {
    var preciou = $(this)
      .parent()
      .parent()
      .children(".precioUnitario")
      .children(".nuevoPrecioUnitario");
    var precio = $(this)
      .parent()
      .parent()
      .children(".ingresoPrecio")
      .children(".nuevoPrecioProducto");
    var cantidad = $(this)
      .parent()
      .parent()
      .children(".cantidadProducto")
      .children(".nuevaCantidadProducto");
    var iva = $(this)
      .parent()
      .parent()
      .children(".ivaProducto")
      .children(".nuevoIvaProducto");
    var total = $(this)
      .parent()
      .parent()
      .children(".totalProducto")
      .children(".nuevoTotalProducto");
    var precioFinal = cantidad.val() * preciou.val() - $(this).val();
    var ivaFinal = 0;
    var totalFinal = precioFinal + ivaFinal;
    iva.val(ivaFinal);
    precio.val(precioFinal);
    total.val(totalFinal);

    sumarTotalPreciosCotizacionExenta();
    listarProductos();
  }
);
/*=============================================
SUMAR TODOS LOS PRECIOS
=============================================*/

function sumarTotalPreciosCotizacionExenta() {
  var precioItem = $(".nuevoPrecioProducto");

  var arraySumaPrecio = [];

  for (var i = 0; i < precioItem.length; i++) {
    arraySumaPrecio.push(Number($(precioItem[i]).val()));
  }

  function sumaArrayPrecios(total, numero) {
    return total + numero;
  }

  var sumaTotalPrecio = arraySumaPrecio.reduce(sumaArrayPrecios);

  $("#nuevoTotalExento").val(sumaTotalPrecio);
  $("#nuevoTotalExento").attr("total", sumaTotalPrecio);
  $("#nuevoTotalExento").number(true, 0);
  $("#nuevoTotalDescuento").number(true, 0);
  $("#nuevoTotalIva").number(true, 0);
  $("#nuevoSubtotal").number(true, 0);
  $("#nuevoTotalFinal").number(true, 0);
  sumarSubtotal();
  sumarDescuentos();
  sumarIva();
  sumarTotales();
  restarPago();
}

/*=============================================
FUNCIÓN AGREGAR IMPUESTO
=============================================*/

function agregarImpuesto() {
  var descuento = $("#nuevoDescuentoVenta").val();
  var impuesto = $("#nuevoImpuestoVenta").val();
  var precioTotal = $("#nuevoTotalVenta").attr("total");

  var precioImpuesto = Number((precioTotal * impuesto) / 100);

  var totalConImpuesto =
    Number(precioImpuesto) + Number(precioTotal) - Number(descuento);

  var result = Number(totalConImpuesto - descuento);

  $("#nuevoTotalVenta").val(totalConImpuesto);

  $("#totalVenta").val(totalConImpuesto);

  $("#nuevoPrecioImpuesto").val(precioImpuesto);

  $("#nuevoPrecioNeto").val(precioTotal);
}

function restarVentas() {
  var total = $("#TotalPendientePago2").val();

  var pagado = $("#TotalPagado").val();

  var pendiente = Number(total - pagado);

  $("#TotalPendientePago").val(pendiente);
}

function sumarTotales() {
  var totalItem = $(".nuevoTotalProducto");
  var arraySumaTotales = [];
  for (var i = 0; i < totalItem.length; i++) {
    arraySumaTotales.push(Number($(totalItem[i]).val()));
  }

  function sumaArrayTotales(total, numero) {
    return total + numero;
  }

  var sumaTotales = arraySumaTotales.reduce(sumaArrayTotales);

  $("#nuevoTotalFinal").val(sumaTotales);
  $("#nuevoTotalFinal").attr("total", sumaTotales);
  $("#nuevoTotalPagar").val(sumaTotales).number(true, 0);
  $("#nuevoTotalPagar").attr("total", sumaTotales);
}

function formatNumber(num) {
  // Asegúrate de que el número sea válido y convertirlo a un número
  num = parseFloat(num);
  if (isNaN(num)) return "0"; // Si no es un número, devuelve "0"
  // Formatear el número
  return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function restarPago() {
  var deuda = 0;
  var pagado = 0;

  // Verificar si los elementos existen y tienen un valor
  if ($("#nuevoTotalPagar").val()) {
    deuda = parseFloat($("#nuevoTotalPagar").val().replace(/,/g, "")); // Quitar comas para convertir a número
  }

  if ($("#nuevoTotalPagado").val()) {
    pagado = parseFloat($("#nuevoTotalPagado").val().replace(/,/g, "")); // Quitar comas para convertir a número
  }

  var final = null;

  if (pagado >= deuda) {
    final = 0;
  } else {
    final = deuda - pagado;
  }

  $("#nuevoTotalPendiente").val(formatNumber(final)); // Aplicar formato numérico
  if (final === 0) {
    $("#nuevoTotalPendiente").css({
      "background-color": "#90ee90",
      color: "#000",
    });
  } else {
    $("#nuevoTotalPendiente").css({
      "background-color": "#F63C45",
      color: "#000",
    });
  }
}

$("#nuevoTotalPagado").on("change", function () {
  // Obtener valores y formatearlos
  var pagado = parseFloat($(this).val().replace(/,/g, ""));
  var totalPagar = parseFloat($("#nuevoTotalPagar").val().replace(/,/g, ""));

  if (pagado > totalPagar && $("#nuevoTotalVuelto").val() == 0) {
    var vuelto = pagado - totalPagar;
    $("#nuevoTotalVuelto").css({
      "background-color": "orange",
      color: "white",
    });
    $("#nuevoTotalVuelto").val(formatNumber(vuelto)); // Aplicar formato numérico
  } else if (pagado > totalPagar) {
    $(this).val(formatNumber(totalPagar)); // Aplicar formato al total pagado
  }
  restarPago();
});

function sumarDescuentos() {
  var descuentoItem = $(".nuevoDescuentoProducto");

  var arraySumaDescuento = [];

  for (var i = 0; i < descuentoItem.length; i++) {
    arraySumaDescuento.push(Number($(descuentoItem[i]).val()));
  }

  function sumaArrayDescuentos(total, numero) {
    return total + numero;
  }

  var sumaTotalDescuento = arraySumaDescuento.reduce(sumaArrayDescuentos);

  $("#nuevoTotalDescuento").val(sumaTotalDescuento);
  $("#nuevoTotalDescuento").attr("total", sumaTotalDescuento);
}

function sumarSubtotal() {
  var cantidadItem = $(".nuevaCantidadProducto");
  var preciouItem = $(".nuevoPrecioUnitario");
  var arraySumaSubtotal = [];

  for (var i = 0; i < cantidadItem.length; i++) {
    arraySumaSubtotal.push(
      Number($(cantidadItem[i]).val() * $(preciouItem[i]).val())
    );
  }
  function sumaArraySubtotales(total, numero) {
    return total + numero;
  }
  var sumaTotalSubtotal = arraySumaSubtotal.reduce(sumaArraySubtotales);
  $("#nuevoSubtotal").val(sumaTotalSubtotal);
  $("#nuevoSubtotal").attr("total", sumaTotalSubtotal);
}
function sumarIva() {
  var ivaItem = $(".nuevoIvaProducto");

  var arraySumaIva = [];

  for (var i = 0; i < ivaItem.length; i++) {
    arraySumaIva.push(Number($(ivaItem[i]).val()));
  }

  function sumaArrayIvas(total, numero) {
    return total + numero;
  }

  var sumaTotalIva = arraySumaIva.reduce(sumaArrayIvas);

  $("#nuevoTotalIva").val(sumaTotalIva);
  $("#nuevoTotalIva").attr("total", sumaTotalIva);
}

function costoExtra() {
  var costo = $("#nuevoCostoExtra").val();
  var total = $("#totalVenta").val();

  var total_costo = Number(costo) + Number(total);

  $("#nuevoTotalVenta").val(total_costo);
}

$(document).ready(function () {
  var idCliente = $("#nuevoCliente").val();
  var datos = new FormData();
  datos.append("idCliente", idCliente);

  $.ajax({
    url: "ajax/clientes.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      $("#traerId").val(respuesta["id"]);
      $("#traerRut").val(respuesta["rut"]);
      $("#traerDireccion").val(respuesta["direccion"]);
      $("#traerTelefono").val(respuesta["telefono"]);
      $("#traerEmail").val(respuesta["email"]);
      $("#traerActividad").val(respuesta["actividad"]);
      $("#traerEjecutivo").val(respuesta["ejecutivo"]);
      $("#traerFactor").val(respuesta["factor_lista"]);

      sumarTotalPreciosCotizacionExenta();
      listarProductos();
    },
  });

  $("#seleccionarCliente").select2();
});

$("#nuevoCostoExtra").change(function () {
  costoExtra();
});

$("#totalVenta").change(function () {
  costoExtra();
});

/*=============================================
CUANDO CAMBIA EL IMPUESTO
=============================================*/

$("#nuevoImpuestoVenta").change(function () {
  agregarImpuesto();
});

$("#TotalPendientePago").change(function () {
  desc();
});

$("#nuevoDescuentoVenta").change(function () {
  agregarImpuesto();
  desc();
});

/*=============================================
FORMATO AL PRECIO FINAL
=============================================*/

$("#nuevoTotalVenta").number(true, 0);

/*=============================================
SELECCIONAR MÉTODO DE PAGO
=============================================*/

$("#nuevoMetodoPago").change(function () {
  var metodo = $(this).val();
  var metodo2 = $(this).val();
  var metodo3 = $(this).val();
  var metodo4 = $(this).val();
  var metodo5 = $(this).val();

  if (metodo == "Efectivo") {
    $(this).parent().parent().removeClass("col-xs-6");

    $(this).parent().parent().addClass("col-xs-4");

    $(this)
      .parent()
      .parent()
      .parent()
      .children(".cajasMetodoPago")
      .html(
        '<div class="col-xs-4">' +
          '<div class="input-group">' +
          '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>' +
          '<input type="number" class="form-control cal" id="nuevoValorEfectivo" name="TotalPagado" onkeyup="restar2()" placeholder="000000" required>' +
          "</div>" +
          "</div>" +
          '<div class="col-xs-4" id="capturarCambioEfectivo" style="padding-left:0px">' +
          '<div class="input-group">' +
          '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>' +
          '<input type="number" class="form-control cal" id="nuevoCambioEfectivo" name="TotalPendientePago" placeholder="000000" readonly required>' +
          "</div>" +
          "</div>"
      );

    // Agregar formato al precio

    $("#nuevoValorEfectivo").number(true, 0);
    $("#nuevoCambioEfectivo").number(true, 0);

    // Listar método en la entrada
    listarMetodos();
  }

  if (metodo2 == "Cheque") {
    $(this).parent().parent().removeClass("col-xs-6");

    $(this).parent().parent().addClass("col-xs-4");

    $(this)
      .parent()
      .parent()
      .parent()
      .children(".cajasMetodoPago")
      .html(
        '<div class="col-xs-4">' +
          '<div class="input-group">' +
          '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>' +
          '<input type="number" class="form-control cal" id="nuevoValorCheque" name="TotalPagado" placeholder="000000" required>' +
          "</div>" +
          "</div>" +
          '<div class="col-xs-4" id="capturarCambioCheque" style="padding-left:0px">' +
          '<div class="input-group">' +
          '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>' +
          '<input type="number" class="form-control cal" id="nuevoCambioCheque" name="TotalPendientePago" placeholder="000000" readonly required>' +
          "</div>" +
          "</div>"
      );

    // Agregar formato al precio

    $("#nuevoValorCheque").number(true, 0);
    $("#nuevoCambioCheque").number(true, 0);

    // Listar método en la entrada
    listarMetodos();
  }

  if (metodo3 == "Transferencia") {
    $(this).parent().parent().removeClass("col-xs-6");

    $(this).parent().parent().addClass("col-xs-4");

    $(this)
      .parent()
      .parent()
      .parent()
      .children(".cajasMetodoPago")
      .html(
        '<div class="col-xs-4">' +
          '<div class="input-group">' +
          '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>' +
          '<input type="number" class="form-control" id="nuevoValorTransferencia" name="TotalPagado" placeholder="000000" required>' +
          "</div>" +
          "</div>" +
          '<div class="col-xs-4" id="capturarCambioTransferencia" style="padding-left:0px">' +
          '<div class="input-group">' +
          '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>' +
          '<input type="number" class="form-control" id="nuevoCambioTransferencia" name="TotalPendientePago" placeholder="000000" readonly required>' +
          "</div>" +
          "</div>"
      );

    // Agregar formato al precio

    $("#nuevoValorTransferencia").number(true, 0);
    $("#nuevoCambioTransferencia").number(true, 0);

    // Listar método en la entrada
    listarMetodos();
  }

  if (metodo4 == "Otro") {
    $(this).parent().parent().removeClass("col-xs-6");

    $(this).parent().parent().addClass("col-xs-4");

    $(this)
      .parent()
      .parent()
      .parent()
      .children(".cajasMetodoPago")
      .html(
        '<div class="col-xs-4">' +
          '<div class="input-group">' +
          '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>' +
          '<input type="number" class="form-control" id="nuevoValorOtro" name="TotalPagado" placeholder="000000" required>' +
          "</div>" +
          "</div>" +
          '<div class="col-xs-4" id="capturarCambioOtro" style="padding-left:0px">' +
          '<div class="input-group">' +
          '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>' +
          '<input type="number" class="form-control" id="nuevoCambioOtro" name="TotalPendientePago" placeholder="000000" readonly required>' +
          "</div>" +
          "</div>"
      );

    // Agregar formato al precio

    $("#nuevoValorOtro").number(true, 0);
    $("#nuevoCambioOtro").number(true, 0);

    // Listar método en la entrada
    listarMetodos();
  }

  if (metodo5 == "Pendiente pago") {
    $(this).parent().parent().removeClass("col-xs-6");

    $(this).parent().parent().addClass("col-xs-4");

    $(this)
      .parent()
      .parent()
      .parent()
      .children(".cajasMetodoPago")
      .html(
        '<div class="col-xs-4">' +
          '<div class="input-group">' +
          '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>' +
          '<input type="number" class="form-control" id="nuevoValorPendientePago" name="TotalPagado" placeholder="000000" required>' +
          "</div>" +
          "</div>" +
          '<div class="col-xs-4" id="capturarCambioPendientePago" style="padding-left:0px">' +
          '<div class="input-group">' +
          '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>' +
          '<input type="number" class="form-control" id="nuevoCambioPendientePago" name="TotalPendientePago" placeholder="000000" readonly required>' +
          "</div>" +
          "</div>"
      );

    // Agregar formato al precio

    $("#nuevoValorPendientePago").number(true, 0);
    $("#nuevoCambioPendientePago").number(true, 0);

    // Listar método en la entrada
    listarMetodos();
  }
});

/*=============================================
CAMBIO EN EFECTIVO
=============================================*/
$(".formularioVenta").on("keyup", "input#nuevoValorEfectivo", function () {
  var efectivo = $(this).val();

  var cambio = Number($("#nuevoTotalVenta").val()) - Number(efectivo);

  var nuevoCambioEfectivo = $(this)
    .parent()
    .parent()
    .parent()
    .children("#capturarCambioEfectivo")
    .children()
    .children("#nuevoCambioEfectivo");

  nuevoCambioEfectivo.val(cambio);
});

/*=============================================
CAMBIO EN CHEQUE
=============================================*/
$(".formularioVenta").on("change", "input#nuevoValorCheque", function () {
  var cheque = $(this).val();

  var cambio = Number($("#nuevoTotalVenta").val()) - Number(cheque);

  var nuevoCambioCheque = $(this)
    .parent()
    .parent()
    .parent()
    .children("#capturarCambioCheque")
    .children()
    .children("#nuevoCambioCheque");

  nuevoCambioCheque.val(cambio);
});

/*=============================================
CAMBIO EN TRANSFERENCIA
=============================================*/
$(".formularioVenta").on(
  "change",
  "input#nuevoValorTransferencia",
  function () {
    var transferencia = $(this).val();

    var cambio = Number($("#nuevoTotalVenta").val()) - Number(transferencia);

    var nuevoCambioTransferencia = $(this)
      .parent()
      .parent()
      .parent()
      .children("#capturarCambioTransferencia")
      .children()
      .children("#nuevoCambioTransferencia");

    nuevoCambioTransferencia.val(cambio);
  }
);

/*=============================================
CAMBIO EN OTRO
=============================================*/
$(".formularioVenta").on("change", "input#nuevoValorOtro", function () {
  var otro = $(this).val();

  var cambio = Number($("#nuevoTotalVenta").val()) - Number(otro);

  var nuevoCambioOtro = $(this)
    .parent()
    .parent()
    .parent()
    .children("#capturarCambioOtro")
    .children()
    .children("#nuevoCambioOtro");

  nuevoCambioOtro.val(cambio);
});

/*=============================================
CAMBIO EN PENDIENTE PAGO
=============================================*/
$(".formularioVenta").on(
  "change",
  "input#nuevoValorPendientePago",
  function () {
    var pendiente = $(this).val();

    var cambio = Number($("#nuevoTotalVenta").val()) - Number(pendiente);

    var nuevoCambioPendientePago = $(this)
      .parent()
      .parent()
      .parent()
      .children("#capturarCambioPendientePago")
      .children()
      .children("#nuevoCambioPendientePago");

    nuevoCambioPendientePago.val(cambio);
  }
);

/*=============================================
CAMBIO TRANSACCIÓN
=============================================*/
$(".formularioVenta").on("change", "input#nuevoCodigoTransaccion", function () {
  // Listar método en la entrada
  listarMetodos();
});

/*=============================================
LISTAR TODOS LOS PRODUCTOS
=============================================*/

function listarProductos() {
  var listaProductos = [];

  var descripcion = $(".nuevaDescripcionProducto");

  var cantidad = $(".nuevaCantidadProducto");

  var precio = $(".nuevoPrecioUnitario");

  var descuento = $(".nuevoDescuentoProducto");

  var iva = $(".nuevoIvaProducto");

  var total = $(".nuevoTotalProducto");

  for (var i = 0; i < descripcion.length; i++) {
    listaProductos.push({
      id: $(descripcion[i]).attr("idProducto"),
      descripcion: $(descripcion[i]).val(),
      cantidad: $(cantidad[i]).val(),
      precio: $(precio[i]).val(),
      descuento: $(descuento[i]).val(),
      iva: $(iva[i]).val(),
      total: $(total[i]).val(),
    });
  }

  $("#listaProductos").val(JSON.stringify(listaProductos));
}

/*=============================================
LISTAR MÉTODO DE PAGO
=============================================*/

function listarMetodos() {
  var listaMetodos = "";

  if ($("#nuevoMetodoPago").val() == "Efectivo") {
    $("#listaMetodoPago").val("Efectivo");
  }
  if ($("#nuevoMetodoPago").val() == "Cheque") {
    $("#listaMetodoPago").val("Cheque");
  }
  if ($("#nuevoMetodoPago").val() == "Transferencia") {
    $("#listaMetodoPago").val("Transferencia");
  }
  if ($("#nuevoMetodoPago").val() == "Otro") {
    $("#listaMetodoPago").val("Otro");
  }
  if ($("#nuevoMetodoPago").val() == "Pendiente pago") {
    $("#listaMetodoPago").val("Pendiente pago");
  }
}

/*=============================================
BOTON EDITAR VENTA
=============================================*/
$(".tablas").on("click", ".btnEditarCotizacion", function () {
  console.log("f");
  var idCotizacion = $(this).attr("idCotizacion");

  window.location =
    "index.php?ruta=editar-cotizacion&idCotizacion=" + idCotizacion;
});

/*=============================================
BOTON VER HISTORIAL VENTAS
=============================================*/
$(".tablas").on("click", ".btnHistorial", function () {
  var codigoVenta = $(this).attr("codigoVenta");

  window.location = "index.php?ruta=historial-venta&codigoVenta=" + codigoVenta;
});

/*=============================================
FUNCIÓN PARA DESACTIVAR LOS BOTONES AGREGAR CUANDO EL PRODUCTO YA HABÍA SIDO SELECCIONADO EN LA CARPETA
=============================================*/

function quitarAgregarProducto() {
  //Capturamos todos los id de productos que fueron elegidos en la venta
  var idProductos = $(".quitarProducto");

  //Capturamos todos los botones de agregar que aparecen en la tabla
  var botonesTabla = $(".tablaVentas tbody button.agregarProducto");

  //Recorremos en un ciclo para obtener los diferentes idProductos que fueron agregados a la venta
  for (var i = 0; i < idProductos.length; i++) {
    //Capturamos los Id de los productos agregados a la venta
    var boton = $(idProductos[i]).attr("idProducto");

    //Hacemos un recorrido por la tabla que aparece para desactivar los botones de agregar
    for (var j = 0; j < botonesTabla.length; j++) {
      if ($(botonesTabla[j]).attr("idProducto") == boton) {
        $(botonesTabla[j]).removeClass("btn-primary agregarProducto");
        $(botonesTabla[j]).addClass("btn-default");
      }
    }
  }
}

/*=============================================
CADA VEZ QUE CARGUE LA TABLA CUANDO NAVEGAMOS EN ELLA EJECUTAR LA FUNCIÓN:
=============================================*/

$(".tablaVentas").on("draw.dt", function () {
  quitarAgregarProducto();
});

/*=============================================
BORRAR VENTA
=============================================*/
$(".tablas").on("click", ".btnEliminarCotizacion", function () {
  var idCotizacion = $(this).attr("idCotizacion");

  swal({
    title: "¿Está seguro de borrar esta Cotización?",
    text: "Si no lo está, puede cancelar la acción.",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    cancelButtonText: "Cancelar",
    confirmButtonText: "Sí, borrar cotización",
  }).then(function (result) {
    if (result.value) {
      window.location =
        "index.php?ruta=cotizaciones&idCotizacion=" + idCotizacion;
    }
  });
});

$("#nuevoClienteFactura").change(function () {
  var idCliente = $(this).val();
  var idLista = $("option:selected", this).attr("idLista");
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

$(".tablas").on("click", ".btnImprimirVentaExenta", function () {
  var codigoVenta = $(this).attr("codigoVenta");
  var tipoDocumento = "Factura_Exenta";

  window.open(
    "extensiones/tcpdf/pdf/documento.php?codigo=" +
      codigoVenta +
      "&documento=" +
      tipoDocumento,
    "_blank"
  );
});

$(".tablas").on("click", ".btnImprimirBoletaExenta", function () {
  var codigoVenta = $(this).attr("codigoVenta");
  var tipoDocumento = "Boleta_Exenta";

  window.open(
    "extensiones/tcpdf/pdf/documento.php?codigo=" +
      codigoVenta +
      "&documento=" +
      tipoDocumento,
    "_blank"
  );
});

$(".tablas").on("click", ".btnEliminarVentaExenta", function () {
  var idExenta = $(this).attr("idExenta");

  swal({
    title: "¿Está seguro de borrar esta Venta Exenta?",
    text: "Si no lo está, puede cancelar la acción.",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    cancelButtonText: "Cancelar",
    confirmButtonText: "Sí, borrar venta exenta",
  }).then(function (result) {
    if (result.value) {
      window.location = "index.php?ruta=ventas&idExenta=" + idExenta;
    }
  });
});
