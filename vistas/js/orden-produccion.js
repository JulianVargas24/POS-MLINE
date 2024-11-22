$(document).ready(function () {
    // Variable para rastrear si se seleccionó un producto
    let productoSeleccionado = false;
    // Variable para almacenar el precio de compra del producto
    let precioCompraBase = 0;
    // Array para almacenar los productos seleccionados
    let productosSeleccionados = [];

    // Variables globales para almacenar los totales
    let totales = {
        cantidadTotal: 0,
        costoUnitarioTotal: 0,
        costoTotalLote: 0,
        costoTotalEmbalaje: 0,
        costoTotalConEmbalaje: 0,
    };

    // Manejo de la visibilidad del cliente asociado y limpieza de datos
    $('input[name="tipoOrden"]').change(function () {
        if (
            $(this).val() === "Cliente con Cotización" ||
            $(this).val() === "Cliente sin Cotización"
        ) {
            $("#clienteAsociado").show();
        } else {
            $("#clienteAsociado").hide();
            // Limpiar los datos del cliente
            limpiarDatosCliente();
        }
    });

    // Botón para cerrar la vista de cliente asociado
    $(".cerrar-cliente").click(function () {
        $("#clienteAsociado").hide();
        $('input[name="tipoOrden"]').prop("checked", false);
        // Limpiar los datos del cliente
        limpiarDatosCliente();
    });

    // Función para limpiar los campos del cliente asociado
    function limpiarDatosCliente() {
        $("#nuevoCliente").val("");
        $("#traerId").val("");
        $("#traerRut").val("");
        $("#traerDireccion").val("");
        $("#traerActividad").val("");
        $("#traerEjecutivo").val("");
        $("#traerTelefono").val("");
        $("#traerEmail").val("");
    }

    /**
     * Cuando se agrega un producto del modal "Seleccionar producto"
     */
    $(document).on("click", ".agregarProducto", function () {
        let idProducto = $(this).attr("idProducto");
        let nombreProducto = $(this).attr("nombreProducto");
        let idMedida = $(this).attr("idMedida");
        precioCompraBase = parseFloat($(this).attr("precioCompra"));

        // Se cambia el estado a que se ha seleccionado un producto
        productoSeleccionado = true;

        // Cerrar el modal automáticamente al agregar un producto
        $("#modalSeleccionarProducto").modal("hide");

        // Mostrar el nombre del producto
        $("#detalleProductoTerminado")
            .val(nombreProducto)
            .attr("idProducto", idProducto);

        // Seleccionar la unidad de medida del producto
        $("#detalleUnidad").val(idMedida);

        // Mostrar el precio de compra formateado
        $("#detallePrecioCompra").val(
            new Intl.NumberFormat("es-CL", {
                style: "currency",
                currency: "CLP",
            }).format(precioCompraBase)
        );
    });

    /**
     * Funciones que se realiza al presionar el botón "Añadir producto"
     */
    $("#btnAnadirProducto").click(function () {
        // Obtener los datos del producto
        let idProducto = $("#detalleProductoTerminado").attr("idProducto");
        let nombreProducto = $("#detalleProductoTerminado").val();
        let unidad = $("#detalleUnidad").val();
        let cantidad = parseInt($("#detalleCantidadProducir").val());
        let codigoLote = $("#detalleCodigoLote").val();
        let fechaProduccion = $("#detalleFechaProduccion").val();
        let fechaVencimiento = $("#detalleFechaVencimientoProducto").val();

        // Obtener costos desde los campos
        let costoUnitario = parseFloat($("#detalleCostoUnitario").val()) || 0;
        let costoEmbalaje = parseFloat($("#detalleCostoEmbalaje").val()) || 0;

        /**
         * Validar que los campos de "Detalle de Producción" estén completos
         */

        // Validar producto seleecionado
        if (!productoSeleccionado) {
            swal({
                type: "error",
                title: "Error",
                text: "No ha seleccionado ningún producto",
                showConfirmButton: true,
                confirmButtonText: "Cerrar",
            });
            return;
        }
        // Validar unidad
        if (!unidad) {
            swal({
                type: "error",
                title: "Error",
                text: "Seleccione una unidad de medida para el producto",
                showConfirmButton: true,
                confirmButtonText: "Cerrar",
            });
            return;
        }
        // Validar que la cantidad a producir sea mayor a 0
        if (!cantidad || cantidad <= 0) {
            swal({
                title: "Error",
                text: "Ingrese una cantidad a producir",
                type: "error",
                confirmButtonText: "Cerrar",
            });
            return;
        }
        // Validar código de lote
        if (!codigoLote) {
            swal({
                type: "error",
                title: "Error",
                text: "Ingrese el código de lote",
                showConfirmButton: true,
                confirmButtonText: "Cerrar",
            });
            return;
        }
        // Validar fecha de producción
        if (!fechaProduccion) {
            swal({
                type: "error",
                title: "Error",
                text: "Seleccione la fecha de producción del producto",
                showConfirmButton: true,
                confirmButtonText: "Cerrar",
            });
            return;
        }
        // Validar fecha de vencimiento
        if (!fechaVencimiento) {
            swal({
                type: "error",
                title: "Error",
                text: "Seleccione la fecha de vencimiento del producto",
                showConfirmButton: true,
                confirmButtonText: "Cerrar",
            });
            return;
        }

        /**
         * Calcular costos
         */
        let costoTotal = precioCompraBase * cantidad;
        let costoTotalConEmbalaje = costoTotal + costoEmbalaje;

        // Crear objeto con los datos del producto
        let productoDetalle = {
            id_producto: idProducto,
            id_unidad: unidad,
            codigo_lote: codigoLote,
            fecha_produccion: fechaProduccion,
            fecha_vencimiento: fechaVencimiento,
            cantidad_producida: cantidad,
            costo_unitario: costoUnitario,
            costo_produccion: costoTotal,
            costo_embalaje: costoEmbalaje,
            costo_produccion_con_embalaje: costoTotalConEmbalaje,
        };

        // Agregar el producto al array
        productosSeleccionados.push(productoDetalle);

        // Crear una nueva fila en la tabla de productos seleccionados
        let nuevaFila = `
          <tr>
            <td>${nombreProducto}</td>
            <td>${$("#detalleUnidad option:selected").text()}</td>
            <td>${new Intl.NumberFormat("es-CL", {
                style: "currency",
                currency: "CLP",
            }).format(precioCompraBase)}</td>
            <td>${cantidad}</td>
            <td>${new Intl.NumberFormat("es-CL", {
                style: "currency",
                currency: "CLP",
            }).format(costoUnitario)}</td>
            <td>${new Intl.NumberFormat("es-CL", {
                style: "currency",
                currency: "CLP",
            }).format(costoTotal)}</td>
            <td>${new Intl.NumberFormat("es-CL", {
                style: "currency",
                currency: "CLP",
            }).format(costoEmbalaje)}</td>
            <td>${new Intl.NumberFormat("es-CL", {
                style: "currency",
                currency: "CLP",
            }).format(costoTotalConEmbalaje)}</td>
            <td>
              <button type="button" class="btn btn-danger eliminarProducto">
                <i class="fa fa-times"></i>
              </button>
            </td>
          </tr>
        `;

        // Añadir la fila a la tabla
        $(".productosSeleccionados table tbody").append(nuevaFila);

        // Actualizar totales
        actualizarTotales();

        // Limpiar campos del formulario de producto
        limpiarCamposProducto();
    });

    // Función para limpiar campos de detalle de producción
    function limpiarCamposProducto() {
        // Limpiar campos de producto
        $("#detalleProductoTerminado").val("").removeAttr("idProducto");
        $("#detallePrecioCompra").val("");
        //$("#detalleCostoUnitario").val("");
        //$("#detalleCostoEmbalaje").val("");
        $("#detalleUnidad").val("");
        $("#detalleCantidadProducir").val("");
        $("#detalleCodigoLote").val("");
        $("#detalleFechaProduccion").val("");
        $("#detalleFechaVencimientoProducto").val("");

        // Reiniciar variables
        precioCompraBase = 0;
        productoSeleccionado = false;
    }

    /**
     * Cuando se elimina un producto de la tabla
     */
    $(document).on("click", ".eliminarProducto", function () {
        let indice = $(this).closest("tr").index();
        productosSeleccionados.splice(indice, 1);
        $(this).closest("tr").remove();
        actualizarTotales();
    });

    /**
     * Funciones que se realizan cuando se envía el formulario
     */
    $(".formularioOrdenProduccion").on("submit", function (e) {
        e.preventDefault();

        // Validar que se haya seleccionado un tipo de orden
        if (!$('input[name="tipoOrden"]:checked').val()) {
            swal({
                type: "error",
                title: "Error",
                text: "No ha seleccionado un tipo de orden",
                showConfirmButton: true,
                confirmButtonText: "Cerrar",
            });
            return false;
        }

        // Validar que se hayan seleeccionado productos
        if (productosSeleccionados.length === 0) {
            swal({
                type: "error",
                title: "Error",
                text: "No ha agregado ningún producto a la orden",
                showConfirmButton: true,
                confirmButtonText: "Cerrar",
            });
            return false;
        }

        // Agrega campos ocultos con los totales de "Resumen de Producción"
        $(this).append(`
          <input type="hidden" name="cantidadProducidaTotal" value="${totales.cantidadTotal}">
          <input type="hidden" name="costoUnitarioTotal" value="${totales.costoUnitarioTotal}">
          <input type="hidden" name="costoProduccionTotal" value="${totales.costoTotalLote}">
          <input type="hidden" name="costoEmbalajeTotal" value="${totales.costoTotalEmbalaje}">
          <input type="hidden" name="costoTotalConEmbalaje" value="${totales.costoTotalConEmbalaje}">
        `);

        // Agregar el array de productos como campo oculto
        let inputProductos = $("<input>")
            .attr("type", "hidden")
            .attr("name", "productosOrden")
            .val(JSON.stringify(productosSeleccionados));

        $(this).append(inputProductos);

        // Enviar el formulario
        this.submit();
    });

    /**
     * Función para actualizar los totales del "Resumen de Producción"
     */
    function actualizarTotales() {
        // Reiniciar totales
        totales.cantidadTotal = 0;
        totales.costoUnitarioTotal = 0;
        totales.costoTotalLote = 0;
        totales.costoTotalEmbalaje = 0;
        totales.costoTotalConEmbalaje = 0;

        // Recorrer todas las filas de la tabla
        $(".productosSeleccionados table tbody tr").each(function () {
            // Obtener valores de cada columna
            totales.cantidadTotal +=
                parseInt($(this).find("td:eq(3)").text()) || 0;

            // Obtener los valores numéricos directamente del array productosSeleccionados
            let indice = $(this).index();
            let producto = productosSeleccionados[indice];

            totales.costoUnitarioTotal += producto.costo_unitario || 0;
            totales.costoTotalLote += producto.costo_produccion || 0;
            totales.costoTotalEmbalaje += producto.costo_embalaje || 0;
            totales.costoTotalConEmbalaje +=
                producto.costo_produccion_con_embalaje || 0;
        });

        // Actualizar los campos del resumen con formato de moneda
        $("#resumenCantidadTotalProducida").val(totales.cantidadTotal);

        // Formatear valores monetarios
        $("#resumenCostoUnitarioTotal").val(
            new Intl.NumberFormat("es-CL", {
                style: "currency",
                currency: "CLP",
            }).format(totales.costoUnitarioTotal)
        );

        $("#resumenCostoTotalLote").val(
            new Intl.NumberFormat("es-CL", {
                style: "currency",
                currency: "CLP",
            }).format(totales.costoTotalLote)
        );

        $("#resumenEmbalajeTotal").val(
            new Intl.NumberFormat("es-CL", {
                style: "currency",
                currency: "CLP",
            }).format(totales.costoTotalEmbalaje)
        );

        $("#resumenCostoTotalConEmbalaje").val(
            new Intl.NumberFormat("es-CL", {
                style: "currency",
                currency: "CLP",
            }).format(totales.costoTotalConEmbalaje)
        );
    }

    // Mostrar la tabla de productos en el modal
    $(".tablaProduccion").DataTable({
        ajax: "ajax/datatable-orden-produccion.ajax.php",
        deferRender: true,
        retrieve: true,
        processing: true,
        responsive: true,
        autoWidth: false,
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
        },
    });
});


function generarbarcodeOP() {
    
    const codigo = $("#detalleCodigoLote").val();
    const fechaProduccion = $("#detalleFechaProduccion").val();
    const fechaVencimiento = $("#detalleFechaVencimientoProducto").val();

    const barcode = document.querySelector("#barcode");

    // Generar el código de barras
    JsBarcode(barcode, codigo, {
        format: "EAN13",
    });

    const barcodeHeight = barcode.height.baseVal.value; // Obtiene la altura del código de barras
    const barcodeWidth = barcode.width.baseVal.value; // Obtiene el ancho del código de barras
    const espacioExtra = 50; // Espacio adicional para que entren las fechas

    // Ajustar el tamaño del SVG
    barcode.setAttribute("viewBox", `0 0 ${barcodeWidth} ${barcodeHeight + espacioExtra}`);
    barcode.setAttribute("height", barcodeHeight + espacioExtra);

    // Añadir texto a la izquierda y las fechas a la derecha)
    const fechaProdTexto = `<text x="10" y="${barcodeHeight + 20}" style="font-size: 15px; font-family: Arial; fill: #000;">Fecha elaboración:</text>`;
    const fechaVencTexto = `<text x="10" y="${barcodeHeight + 45}" style="font-size: 15px; font-family: Arial; fill: #000;">Fecha vencimiento:</text>`;
    const fechaProd = `<text x="${barcodeWidth - 10 - (fechaProduccion ? fechaProduccion.length * 7 : 80)}" y="${barcodeHeight + 20}" style="font-size: 14px; font-family: Arial; fill: #000;">${fechaProduccion || "No ingresada"}</text>`;
    const fechaVenc = `<text x="${barcodeWidth - 10 - (fechaVencimiento ? fechaVencimiento.length * 7 : 80)}" y="${barcodeHeight + 45}" style="font-size: 14px; font-family: Arial; fill: #000;">${fechaVencimiento || "No ingresada"}</text>`;

    // Añadir los textos al SVG
    barcode.innerHTML += fechaProdTexto + fechaVencTexto + fechaProd + fechaVenc;

    // Mostrar el área para imprimir
    $("#print").show();

}   

function imprimir()
{
	$("#print").printArea();
}