$(".tablaCompras").DataTable({
  ajax: "ajax/datatable-compras.ajax.php",
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
$(".tablaCompra tbody").on("click", "button.agregarProducto", function () {
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
      var precio = respuesta["precio_venta"];
      var impuesto = precio * 0.19;
      var descuento = 0;
      var total = Number(precio) + Number(impuesto);

      $(".nuevoProducto").append(
        `<div class="row" style="padding:5px 15px">
			  	<!-- Descripción del producto -->
				<div class="col-xs-2" style="padding-right:0px">
					<div class="input-group">
					<span class="input-group-addon">
						<button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto="${idProducto}"><i class="fa fa-times"></i></button>
					</span>
						<input type="text" class="form-control nuevaDescripcionProducto" idProducto="${idProducto}" name="agregarProducto" value="${descripcion}" readonly required>
					</div>
				</div>
					<!-- Cantidad del producto -->
				<div class="col-xs-1 cantidadProducto" style="padding-right:0px">
					<input type="text" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" id="nuevaCantidadProducto" min="1" value=""  required>
				</div>
					<!-- Precio Unitario -->
				<div class="col-xs-1 precioUnitario" style="padding-right:0px">
				<input type="text"  class="form-control nuevoPrecioUnitario" style="padding:5px; padding-left:0px"  name="nuevoPrecioUnitario" value="${precio}" required>
				</div>
					<!-- Subtotal Neto -->
				<div class="col-xs-1 subtotalProducto" style="padding-right:0px">
					<input type="text" class="form-control nuevoSubtotalProducto" style="padding:5px" name="nuevoSubtotalProducto" min="0" value="${precio}"  readonly required>
				</div>
					<!-- Descuento -->
				<div class="col-xs-1 descuentoProducto" style="padding-right:0px">
					<input type="text" class="form-control nuevoDescuentoProducto" style="padding:5px" name="nuevoDescuentoProducto" min="0" value="${descuento}"  required>
				</div>
					<!-- Precio Total Neto del producto -->
				<div class="col-xs-2 ingresoPrecio" style="padding-right:0px">
					<input   type="text" class="form-control nuevoPrecioProducto" onchange="cambios()" precioReal="${precio}" name="nuevoPrecioProducto" value="${precio}" readonly required>
				</div>
					<!-- IVA del producto -->
				<div class="col-xs-1 ivaProducto" style="padding-right:0px">
					<input type="text" class="form-control nuevoIvaProducto" style="padding:5px" name="nuevoIvaProducto" min="0" value="${impuesto}"  required>
				</div>
					<!-- OTROS IMPUESTOS del producto -->
				<div class="col-xs-1 " style="padding-right:0px">
					<input type="text" class="form-control nuevoOtrosImpuestosProducto" style="padding:5px" name="nuevoOtrosImpuestosProducto" min="0" value="${descuento}"  readonly required>
				</div>
				<div class="col-xs-2 totalProducto style="padding-right:0px">
					<input type="text" class="form-control nuevoTotalProducto" name="nuevoTotalProducto" min="0" value="${total}" readonly required>
				</div>
			  </div>`
      );

      // SUMAR TOTAL DE PRECIOS

      sumarTotalPrecios();

      // AGREGAR IMPUESTO

      agregarImpuesto();

      // AGRUPAR PRODUCTOS EN FORMATO JSON

      listarProductosCompra();

      // PONER FORMATO AL PRECIO DE LOS PRODUCTOS

      $(".nuevoPrecioProducto").number(true, 0);
      $(".nuevoTotalProducto").number(true, 0);
      $(".nuevoDescuentoProducto").number(true, 0);
      $(".nuevoPrecioUnitario").number(true, 0);
      $(".nuevoSubtotalProducto").number(true, 0);
      $(".nuevoIvaProducto").number(true, 0);

      localStorage.removeItem("quitarProducto");
    },
  });
});

function cambios() {
  sumarTotalPrecios();

  // AGREGAR IMPUESTO

  agregarImpuesto();

  // AGRUPAR PRODUCTOS EN FORMATO JSON

  listarProductosCompra();
}

/*=============================================
CUANDO CARGUE LA TABLA CADA VEZ QUE NAVEGUE EN ELLA
=============================================*/
$(".tablaCompra").on("draw.dt", function () {
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

$(".formularioCompra").on("click", "button.quitarProducto", function () {
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

    sumarTotalPrecios();

    // AGREGAR IMPUESTO

    agregarImpuesto();

    // AGRUPAR PRODUCTOS EN FORMATO JSON

    listarProductosCompra();
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

      sumarTotalPrecios();

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

$(".formularioCompra").on(
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

        listarProductosCompra();
      },
    });
  }
);

/*=============================================
MODIFICAR PRECIO UNITARIO
=============================================*/
$(".formularioCompra").on("change", "input.nuevoPrecioUnitario", function () {
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
  var ivaFinal = precioFinal * 0.19;
  var totalFinal = precioFinal + ivaFinal;
  iva.val(ivaFinal);
  precio.val(precioFinal);
  subtotal.val(subtotalFinal);
  total.val(totalFinal);

  listarProductosCompra();
  sumarTotalPrecios();
});
/*=============================================
MODIFICAR LA CANTIDAD
=============================================*/

$(".formularioCompra").on("change", "input.nuevaCantidadProducto", function () {
  console.log("Cambio de Cantidad Producto Compra");
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
  var ivaFinal = precioFinal * 0.19;
  var totalFinal = precioFinal + ivaFinal;
  iva.val(ivaFinal);
  precio.val(precioFinal);
  subtotal.val(subtotalFinal);
  total.val(totalFinal);

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

    sumarTotalPrecios();

    swal({
      title: "La cantidad supera el Stock",
      text: "¡Sólo hay " + $(this).attr("stock") + " unidades!",
      type: "error",
      confirmButtonText: "¡Cerrar!",
    });

    return;
  }

  // SUMAR TOTAL DE PRECIOS

  sumarTotalPrecios();

  // AGREGAR IMPUESTO

  agregarImpuesto();

  // AGRUPAR PRODUCTOS EN FORMATO JSON

  listarProductosCompra();
});

$("#formularioCompra").click("input.nuevaCantidadProduction", function () {
  console.log("CLICKEADO!");
});
/*=============================================
MODIFICAR DESCUENTO
=============================================*/

$(".formularioCompra").on(
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
    var ivaFinal = precioFinal * 0.19;
    var totalFinal = precioFinal + ivaFinal;
    iva.val(ivaFinal);
    precio.val(precioFinal);
    total.val(totalFinal);

    sumarTotalPrecios();

    listarProductosCompra();
  }
);

/*=============================================
SUMAR TODOS LOS PRECIOS
=============================================*/

function sumarTotalPrecios() {
  var precioItem = $(".nuevoPrecioProducto");

  var arraySumaPrecio = [];

  for (var i = 0; i < precioItem.length; i++) {
    arraySumaPrecio.push(Number($(precioItem[i]).val()));
  }

  function sumaArrayPrecios(total, numero) {
    return total + numero;
  }

  var sumaTotalPrecio = arraySumaPrecio.reduce(sumaArrayPrecios);

  $("#nuevoTotalNeto").val(sumaTotalPrecio);
  $("#nuevoTotalNeto").attr("total", sumaTotalPrecio);
  $("#nuevoTotalNeto").number(true, 0);
  $("#nuevoTotalDescuento").number(true, 0);
  $("#nuevoTotalIva").number(true, 0);
  $("#nuevoSubtotal").number(true, 0);
  $("#nuevoTotalCompra").number(true, 0);
  sumarSubtotal();
  sumarDescuentos();
  sumarIva();
  sumarTotales();
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

/*function restar3(){

    var total = $("#TotalVenta").val();

    var pagado  = $("#TotalPagado").val();

    var pendiente = Number(total - pagado);

    $("#TotalPendientePago2").val(pendiente);


}

function restar2(){

    var total = $("#totalVenta").val();

    var pagado  = $("#TotalPagado").val();

    var pendiente = Number(total - pagado);

    $("#TotalPendientePago").val(pendiente);


}*/
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

  $("#nuevoTotalCompra").val(sumaTotales);
  $("#nuevoTotalCompra").attr("total", sumaTotales);
}

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
  var idProveedor = $("#nuevoProveedor").val();
  console.log(idProveedor);
  var datos = new FormData();
  datos.append("idProveedor", idProveedor);

  $.ajax({
    url: "ajax/proveedores.ajax.php",
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
      $("#traerDireccion").val(respuesta["ciudad"]);
      $("#traerTelefono").val(respuesta["telefono"]);
      $("#traerEmail").val(respuesta["email"]);
      $("#traerActividad").val(respuesta["actividad"]);
      $("#traerEjecutivo").val(respuesta["ejecutivo"]);

      sumarTotalPrecios();
      listarProductosCompra();
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
CAMBIO EN PENDIENTE PAGO
=============================================*/
$(".formulario").on("change", "input#nuevoValorPendientePago", function () {
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
});

/*=============================================
CAMBIO TRANSACCIÓN
=============================================*/
$(".formulario").on("change", "input#nuevoCodigoTransaccion", function () {
  // Listar método en la entrada
  listarMetodos();
});

/*=============================================
LISTAR TODOS LOS PRODUCTOS
=============================================*/

function listarProductosCompra() {
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
  console.log(listaProductos);
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
BOTON EDITAR ORDEN COMPRA
=============================================*/
$(".tablas").on("click", ".btnEditarCompra", function () {
  var idCompra = $(this).attr("idCompra");

  window.location = "index.php?ruta=editar-compra&idCompra=" + idCompra;
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
BORRAR ORDEN COMPRA
=============================================*/
$(".tablas").on("click", ".btnEliminarCompra", function () {
  var idCompra = $(this).attr("idCompra");

  swal({
    title: "¿Está seguro de borrar esta compra?",
    text: "Si no lo está, puede cancelar la acción.",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    cancelButtonText: "Cancelar",
    confirmButtonText: "Sí, borrar orden",
  }).then(function (result) {
    if (result.value) {
      window.location = "index.php?ruta=compras&idCompra=" + idCompra;
    }
  });
});

$("#nuevoProveedor").change(function () {
  var idProveedor = $(this).val();
  console.log(idProveedor);
  var datos = new FormData();
  datos.append("idProveedor", idProveedor);

  $.ajax({
    url: "ajax/proveedores.ajax.php",
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
      $("#traerDireccion").val(respuesta["ciudad"]);
      $("#traerTelefono").val(respuesta["telefono"]);
      $("#traerEmail").val(respuesta["email"]);
      $("#traerActividad").val(respuesta["actividad"]);
      $("#traerEjecutivo").val(respuesta["ejecutivo"]);
    },
  });
});

/*=============================================
IMPRIMIR FACTURA
=============================================*/

$(".tablas").on("click", ".btnImprimirFactura", function () {
  var codigoVenta = $(this).attr("codigoVenta");

  window.open(
    "extensiones/tcpdf/pdf/factura.php?codigo=" + codigoVenta,
    "_blank"
  );
});

/*=============================================
BOTON PARA VER FACTURA HISTORIAL DE VENTAS
=============================================*/

$(".tablas").on("click", ".btnImprimirHistorial", function () {
  var codigoVenta = $(this).attr("codigoVenta");

  window.open(
    "extensiones/tcpdf/pdf/historial_ventas.php?codigo=" + codigoVenta,
    "_blank"
  );
});

/*=============================================
IMPRIMIR Ticket
=============================================*/

$(".tablas").on("click", ".btnImprimirTicket", function () {
  var codigoVenta = $(this).attr("codigoVenta");

  window.open(
    "extensiones/tcpdf/pdf/ticket.php?codigo=" + codigoVenta,
    "_blank"
  );
});

/*=============================================
 * BOTÓN  PARA FILTRAR POR RANGO DE FECHAS
 *=============================================*/
if (window.location.href.includes("compras")) {
  // Configuración del Date Range Picker
  $("#daterange-compras").daterangepicker({
    locale: {
      format: "YYYY-MM-DD",
      applyLabel: "Aplicar",
      cancelLabel: "Cancelar",
      customRangeLabel: "Rango Personalizado",
      firstDay: 1,
      daysOfWeek: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
      monthNames: [
        "Enero",
        "Febrero",
        "Marzo",
        "Abril",
        "Mayo",
        "Junio",
        "Julio",
        "Agosto",
        "Septiembre",
        "Octubre",
        "Noviembre",
        "Diciembre",
      ],
    },
    ranges: {
      Hoy: [moment(), moment()],
      Ayer: [moment().subtract(1, "days"), moment().subtract(1, "days")],
      "Últimos 7 días": [moment().subtract(6, "days"), moment()],
      "Últimos 30 días": [moment().subtract(29, "days"), moment()],
      "Este mes": [moment().startOf("month"), moment().endOf("month")],
      "Mes anterior": [
        moment().subtract(1, "month").startOf("month"),
        moment().subtract(1, "month").endOf("month"),
      ],
    },
    startDate: moment(),
    endDate: moment(),
    showCancelButton: true,
  });

  // Evento al seleccionar fechas
  $("#daterange-compras").on("apply.daterangepicker", function (ev, picker) {
    const fechaInicial = picker.startDate.format("YYYY-MM-DD");
    const fechaFinal = picker.endDate.format("YYYY-MM-DD");

    // Actualizar el texto del botón
    $(this)
      .find("span")
      .html(
        picker.startDate.format("YYYY-MM-DD") +
          " - " +
          picker.endDate.format("YYYY-MM-DD")
      );

    // Guardar en localStorage y redirigir
    localStorage.setItem("capturarRango", $(this).find("span").html());
    window.location.href = `index.php?ruta=compras&fechaInicial=${fechaInicial}&fechaFinal=${fechaFinal}`;
  });

  // Evento al cancelar
  $("#daterange-compras").on("cancel.daterangepicker", function () {
    localStorage.removeItem("capturarRango");
    window.location.href = "compras";
  });
}

/*=============================================
ABRIR ARCHIVO XML EN NUEVA PESTAÑA
=============================================*/
$(".abrirXML").click(function () {
  var archivo = $(this).attr("archivo");
  window.open(archivo, "_blank");
});

/*=============================================
PDF
=============================================*/
$(".tablas").on("click", ".btnImprimirCompra", function () {
  var codigoCompra = $(this).attr("codigoCompra");
  var tipoDocumento = "Compra";

  window.open(
    "extensiones/tcpdf/pdf/documento.php?codigo=" +
      codigoCompra +
      "&documento=" +
      tipoDocumento,
    "_blank"
  );
});
