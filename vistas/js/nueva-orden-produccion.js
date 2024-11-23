$(document).ready(function () {
  /*==================================================
   * Variables Globales
   *==================================================*/
  // Variable para almacenar el precio de compra del producto
  let precioCompraBase = 0;
  // Array para almacenar los insumos seleccionados
  let insumosSeleccionados = [];

  /*==================================================
   * Funciones Principales
   *==================================================*/
  // Función para limpiar los campos del "Cliente Asociado"
  function limpiarDatosCliente() {
    $("#traerIdCliente").val("");
    $("#nombreCliente").val("");
    $("#traerRut").val("");
    $("#traerDireccion").val("");
    $("#traerActividad").val("");
    $("#traerEjecutivo").val("");
    $("#traerTelefono").val("");
    $("#traerEmail").val("");
  }

  // Función para limpiar los campos de "Cotización"
  function limpiarDatosCotizacion() {
    $("#nombreCotizacion").val("");
    $("#traerIdCotizacionAfecta").val("");
    $("#traerIdCotizacionExenta").val("");
  }

  // Función para limpiar los campos de "Detalle de Producción"
  function limpiarCamposProducto() {
    // Limpiar campos de producto
    $("#idProductoProduccion").val("");
    $("#detalleProductoProduccion").val("").removeAttr("idProducto");
    $("#detallePrecioCompra").val("");
    $("#detalleUnidad").val("");
    $("#detalleCantidadProducir").val("");
    $("#detalleCodigoLote").val("");
    $("#detalleFechaElaboracion").val("");
    $("#detalleFechaElaboracionVencimiento").val("");

    // Ocultar la tabla de insumos
    $("#boxInsumos").hide();

    precioCompraBase = 0;
  }

  // Función para limpiar la tabla de insumos seleccionados
  const limpiarInsumosSeleccionados = () => {
    insumosSeleccionados = [];
    mostrarMensajeEjemploInsumos();
    actualizarTotales();
  };

  // Función para mostrar el mensaje de ejemplo en la tabla de insumos
  const mostrarMensajeEjemploInsumos = () => {
    return $(".insumosSeleccionados tbody").html(`
        <tr class="ejemploSeleccionarInsumo">
          <td colspan="7" class="text-center text-muted">
            <p style="margin: 10px 0">
              <i class="fa fa-info-circle" style="margin-right: 8px;"></i>
              Agregue los insumos y embalaje necesarios para la producción.
            </p>
          </td>
        </tr>
      `);
  };

  /**
   * Manejo de la visibilidad del cliente asociado ycotización
   */
  $('input[name="tipoOrden"]').change(function () {
    let tipoOrden = $(this).val();

    if (tipoOrden === "Cliente con Cotización") {
      $("#clienteAsociado").show();
      $("#seleccionarCotizacion").show();
      limpiarDatosCliente();

      // Recargar la tabla con clientes que tienen cotizaciones
      $(".tablaClientes")
        .DataTable()
        .ajax.url(`ajax/datatable-clientes.ajax.php?tipoOrden=${tipoOrden}`)
        .load();
    } else if (tipoOrden === "Cliente sin Cotización") {
      $("#clienteAsociado").show();
      $("#seleccionarCotizacion").hide();
      limpiarDatosCliente();
      limpiarDatosCotizacion();

      // Recargar la tabla con todos los clientes
      $(".tablaClientes")
        .DataTable()
        .ajax.url(`ajax/datatable-clientes.ajax.php?tipoOrden=${tipoOrden}`)
        .load();
    } else if (tipoOrden === "Para Stock") {
      $("#clienteAsociado").hide();
      $("#seleccionarCotizacion").hide();
      limpiarDatosCliente();
      limpiarDatosCotizacion();
    }
  });

  /**
   * Función para formatear a moneda chilena
   */
  const formatearMoneda = (valor) => {
    return new Intl.NumberFormat("es-CL", {
      style: "currency",
      currency: "CLP",
    }).format(valor);
  };

  /**
   * Función para actualizar los totales del "Resumen de Producción" y crear los materiales de la orden
   */
  function actualizarTotales() {
    // Inicializar totales
    let costoEmbalajeFinal = 0;
    let costoInsumosFinal = 0;
    let costoTotalLoteFinal = 0;

    // Procesar cada fila de insumos
    $(".insumosSeleccionados table tbody tr").each(function () {
      // Obtener el índice de la fila actual
      const index = $(this).index();
      // Actualizar el array insumosSeleccionados con los valores actuales
      if (insumosSeleccionados[index]) {
        // Obtener la cantidad ingresada en el input de cantidad
        const cantidad = parseInt($(this).find(".cantidadInsumo").val()) || 0;
        // Obtener el precio unitario del insumo
        const precioUnitario = insumosSeleccionados[index].precio_unitario;
        // Calcular el costo total de la fila
        const costoFilaTotal = cantidad * precioUnitario;

        // Actualizar el array insumosSeleccionados con los valores actuales
        insumosSeleccionados[index].cantidad = cantidad;
        insumosSeleccionados[index].costo_total = costoFilaTotal;

        // Actualizar visualización en la tabla
        $(this)
          .find(".costoTotalFormateado")
          .text(formatearMoneda(costoFilaTotal));

        // Actualizar totales
        $(this).find("td:eq(1)").text().trim() === "Embalaje"
          ? (costoEmbalajeFinal += costoFilaTotal)
          : (costoInsumosFinal += costoFilaTotal);

        // Sumar el costo total de la fila al total del lote
        costoTotalLoteFinal += costoFilaTotal;
      }
    });

    // Actualizar resúmenes visuales
    $("#resumenCostoEmbalaje").text(formatearMoneda(costoEmbalajeFinal));
    $("#resumenCostoSinEmbalaje").text(formatearMoneda(costoInsumosFinal));
    $("#resumenCostoTotalLote").text(formatearMoneda(costoTotalLoteFinal));

    // Actualizar los campos ocultos
    $("#costoEmbalajeTotal").val(costoEmbalajeFinal);
    $("#costoProduccionTotal").val(costoInsumosFinal);
    $("#costoProduccionTotalConEmbalaje").val(costoTotalLoteFinal);
  }

  // Evento para actualizar los totales cuando se cambie la cantidad
  $(document).on("change", ".cantidadInsumo", function () {
    actualizarTotales();
  });

  /**
   * Eliminar un insumo de la tabla
   */
  $(document).on("click", ".eliminarInsumo", function () {
    let fila = $(this).closest("tr");
    let indice = fila.index();

    // Eliminar del array
    insumosSeleccionados.splice(indice, 1);

    // Eliminar la fila de la tabla
    fila.remove();

    // Si no quedan insumos, mostrar mensaje de ejemplo
    if (insumosSeleccionados.length === 0) {
      mostrarMensajeEjemploInsumos();
    }

    // Actualizar totales
    actualizarTotales();
  });

  /*==================================================
   * Funciones al Enviar el Formulario
   *==================================================*/
  $(".formularioOrdenProduccion").on("submit", function (e) {
    e.preventDefault();

    // Obtener los valores de los campos del formulario
    const tipoOrden = $('input[name="tipoOrden"]:checked').val();

    /**
     * Validar los campos de Tipo de Orden, Cliente y Cotización
     */
    // Validar que se haya seleccionado un Tipo de Orden
    if (!tipoOrden) {
      swal({
        type: "error",
        title: "Error",
        text: "No ha seleccionado un tipo de orden",
        showConfirmButton: true,
        confirmButtonText: "Cerrar",
      });
      return false;
    }
    // Validar el Cliente para órdenes de tipo "Cliente sin Cotización"
    if (tipoOrden === "Cliente sin Cotización" && !$("#traerIdCliente").val()) {
      swal({
        type: "error",
        title: "Error",
        text: "Debe seleccionar un cliente para este tipo de orden",
        showConfirmButton: true,
        confirmButtonText: "Cerrar",
      });
      return false;
    }
    // Validar el Cliente y Cotización para órdenes de tipo "Cliente con Cotización"
    if (tipoOrden === "Cliente con Cotización") {
      if (!$("#traerIdCliente").val()) {
        swal({
          type: "error",
          title: "Error",
          text: "Debe seleccionar un cliente para este tipo de orden",
          showConfirmButton: true,
          confirmButtonText: "Cerrar",
        });
        return false;
      }
      if (
        !$("#traerIdCotizacionAfecta").val() &&
        !$("#traerIdCotizacionExenta").val()
      ) {
        swal({
          type: "error",
          title: "Error",
          text: "Debe seleccionar una cotización para este tipo de orden",
          showConfirmButton: true,
          confirmButtonText: "Cerrar",
        });
        return false;
      }
    }
    // Validar las fechas de emisión y vencimiento de la orden
    if (!$("#nuevaFechaEmision").val() || !$("#nuevaFechaVencimiento").val()) {
      swal({
        type: "error",
        title: "Error",
        text: "Debe especificar las fechas de emisión y vencimiento de la orden",
      });
      return false;
    }
    // Validar centro de costo
    if (!$("#nuevoCentro").val()) {
      swal({
        type: "error",
        title: "Error",
        text: "Debe seleccionar un centro de costo",
      });
      return false;
    }
    // Validar bodega de destino
    if (!$("#nuevaBodega").val()) {
      swal({
        type: "error",
        title: "Error",
        text: "Debe seleccionar una bodega de destino",
      });
      return false;
    }
    // Validar nombre de la orden
    if (!$("#nuevoNombreOrden").val()) {
      swal({
        type: "error",
        title: "Error",
        text: "Debe especificar el nombre de la orden",
      });
      return false;
    }

    /**
     * Validar los campos de Detalle de Producción
     */
    // Validar producto en producción seleccionado
    if (!$("#idProductoProduccion").val()) {
      swal({
        type: "error",
        title: "Error",
        text: "No ha seleccionado ningún producto",
        showConfirmButton: true,
        confirmButtonText: "Cerrar",
      });
      return false;
    }
    // Validar unidad seleccionada
    if (!$("#detalleUnidad").val()) {
      swal({
        type: "error",
        title: "Error",
        text: "Seleccione el tipo de unidad para el producto",
        showConfirmButton: true,
        confirmButtonText: "Cerrar",
      });
      return false;
    }
    // Validar que la cantidad a producir sea mayor a 0
    if (
      !$("#detalleCantidadProducir").val() ||
      $("#detalleCantidadProducir").val() <= 0
    ) {
      swal({
        title: "Error",
        text: "Ingrese una cantidad a producir",
        type: "error",
        confirmButtonText: "Cerrar",
      });
      return false;
    }
    // Validar fecha de elaboración
    if (!$("#detalleFechaElaboracion").val()) {
      swal({
        type: "error",
        title: "Error",
        text: "Seleccione la fecha de elaboración del producto",
        showConfirmButton: true,
        confirmButtonText: "Cerrar",
      });
      return false;
    }
    // Validar fecha de vencimiento
    if (!$("#detalleFechaElaboracionVencimiento").val()) {
      swal({
        type: "error",
        title: "Error",
        text: "Seleccione la fecha de vencimiento del producto",
        showConfirmButton: true,
        confirmButtonText: "Cerrar",
      });
      return false;
    }
    // Validar código de lote
    if (!$("#detalleCodigoLote").val()) {
      swal({
        type: "error",
        title: "Error",
        text: "Ingrese el código de lote",
        showConfirmButton: true,
        confirmButtonText: "Cerrar",
      });
      return false;
    }

    /**
     * Validar los campos de Seleccionar Insumos y Embalaje
     */
    // Validar que se hayan seleccionado insumos
    if (insumosSeleccionados.length === 0) {
      swal({
        type: "error",
        title: "Error",
        text: "No ha agregado ningún insumo a la orden",
        showConfirmButton: true,
        confirmButtonText: "Cerrar",
      });
      return false;
    }

    /**
     * Crear un campo oculto para enviar el array de los materiales de la orden
     */
    let inputMateriales = $("<input>")
      .attr("type", "hidden")
      .attr("name", "materialesOrden")
      .val(JSON.stringify(insumosSeleccionados));

    $(this).append(inputMateriales);

    // Enviar el formulario
    this.submit();
  });

  /*==================================================
   * Modales y funciones dentro de los modales
   *==================================================*/
  /**
   * Modal de Clientes
   */
  $(".tablaClientes").DataTable({
    ajax: "ajax/datatable-clientes.ajax.php",
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

  // Funciones que se realizan al "Seleccionar" Cliente
  $(document).on("click", ".btnSeleccionarCliente", function () {
    let idCliente = $(this).attr("idCliente");
    let nombreCliente = $(this).attr("nombreCliente");
    let rutCliente = $(this).attr("rutCliente");
    let direccionCliente = $(this).attr("direccionCliente");
    let actividadCliente = $(this).attr("actividadCliente");
    let ejecutivoCliente = $(this).attr("ejecutivoCliente");
    let telefonoCliente = $(this).attr("telefonoCliente");
    let emailCliente = $(this).attr("emailCliente");

    // Asignar valores a los campos
    $("#traerIdCliente").val(idCliente);
    $("#nombreCliente").val(nombreCliente);
    $("#traerRut").val(rutCliente);
    $("#traerDireccion").val(direccionCliente);
    $("#traerActividad").val(actividadCliente);
    $("#traerEjecutivo").val(ejecutivoCliente);
    $("#traerTelefono").val(telefonoCliente);
    $("#traerEmail").val(emailCliente);

    // Usar la función existente en lugar de limpiar manualmente
    limpiarDatosCotizacion();

    // Cerrar el modal
    $("#modalSeleccionarCliente").modal("hide");

    // Recargar la tabla de cotizaciones si el tipo de orden es "Cliente con Cotización"
    if (
      $('input[name="tipoOrden"]:checked').val() === "Cliente con Cotización"
    ) {
      $(".tablaCotizaciones")
        .DataTable()
        .ajax.url(`ajax/datatable-cotizaciones.ajax.php?idCliente=${idCliente}`)
        .load();
    }
  });

  /**
   * Modal de Cotizaciones
   */
  $(".tablaCotizaciones").DataTable({
    ajax: "ajax/datatable-cotizaciones.ajax.php",
    deferRender: true,
    retrieve: true,
    processing: true,
    responsive: true,
    autoWidth: false,
    language: {
      sProcessing: "Procesando...",
      sLengthMenu: "Mostrar _MENU_ registros",
      sZeroRecords: "El cliente seleccionado no tiene cotizaciones abiertas.",
      sEmptyTable: "El cliente seleccionado no tiene cotizaciones abiertas.",
      sInfo: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
      sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0",
      sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
      sSearch: "Buscar:",
      sLoadingRecords: "Cargando...",
      oPaginate: {
        sFirst: "Primero",
        sLast: "Último",
        sNext: "Siguiente",
        sPrevious: "Anterior",
      },
    },
  });

  // Validar cliente antes de abrir el modal de Cotización
  $("#modalSeleccionarCotizacion").on("show.bs.modal", function (e) {
    if (!$("#traerIdCliente").val()) {
      // Prevenir que se abra el modal
      e.preventDefault();

      swal({
        type: "warning",
        title: "Atención",
        text: "Debe seleccionar un cliente antes de elegir una cotización",
        showConfirmButton: true,
        confirmButtonText: "Cerrar",
      });
    }
  });

  // Funciones que se realizan al "Seleccionar" Cotización
  $(document).on("click", ".btnSeleccionarCotizacion", function () {
    let idCotizacion = $(this).attr("idCotizacion");
    let tipoCotizacion = $(this).attr("tipoCotizacion");
    let nombreOrden = $(this).closest("tr").find("td:eq(1)").text();
    let folioCotizacion = $(this).closest("tr").find("td:eq(2)").text();

    // Crear el texto combinado
    let nombreOrdeneMasFolio = nombreOrden + " - Folio: " + folioCotizacion;

    // Primero limpiar ambos campos
    $("#traerIdCotizacionAfecta").val("");
    $("#traerIdCotizacionExenta").val("");

    // Asignar el ID según el tipo de cotización
    if (tipoCotizacion === "exenta") {
      $("#traerIdCotizacionExenta").val(idCotizacion);
    } else {
      $("#traerIdCotizacionAfecta").val(idCotizacion);
    }

    // Asignar el nombre de la cotización
    $("#nombreCotizacion").val(nombreOrdeneMasFolio);

    // Cerrar el modal
    $("#modalSeleccionarCotizacion").modal("hide");
  });

  /**
   * Modal de Productos
   */
  $(".tablaProduccion").DataTable({
    ajax: "ajax/datatable-productos-orden-produccion.ajax.php",
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

  // Funciones que se realizan al "Agregar" Producto
  $(document).on("click", ".agregarProducto", function () {
    let idProducto = $(this).attr("idProducto");
    let nombreProducto = $(this).attr("nombreProducto");
    let idMedida = $(this).attr("idMedida");
    precioCompraBase = parseFloat($(this).attr("precioCompra"));

    // Cerrar el modal automáticamente al agregar un producto
    $("#modalSeleccionarProducto").modal("hide");

    // Actualizar el campo oculto con el ID
    $("#idProductoProduccion").val(idProducto);

    // Mostrar el nombre del producto en el campo visible
    $("#detalleProductoProduccion").val(nombreProducto);

    // Seleccionar la unidad de medida del producto
    $("#detalleUnidad").val(idMedida);

    // Mostrar el precio de compra formateado
    $("#detallePrecioCompra").val(
      new Intl.NumberFormat("es-CL", {
        style: "currency",
        currency: "CLP",
      }).format(precioCompraBase)
    );

    // Mostrar la tabla de insumos
    $("#boxInsumos").show();
  });

  // Funciones que se realizan al cambiar el "Tipo de Producción"
  $('input[name="tipoProduccion"]').change(function () {
    let tipoProduccion = $(this).val();

    // Mostrar el boxDetalleProduccion
    $("#boxDetalleProduccion").show();

    // Limpiar campos de "Detalle de Producción" cuando cambie el tipo de producción
    limpiarCamposProducto();

    // Limpiar la tabla de insumos y reiniciar el array
    limpiarInsumosSeleccionados();

    // Recargar la tabla mostrando los productos identificados como "Pack"
    $(".tablaProduccion")
      .DataTable()
      .ajax.url(
        `ajax/datatable-productos-orden-produccion.ajax.php?tipoProduccion=${tipoProduccion}`
      )
      .load();
  });

  /**
   * Modal de Insumos
   */
  $(".tablaInsumos").DataTable({
    ajax: "ajax/datatable-insumos-orden-produccion.ajax.php",
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

  // Funciones que se realizan al "Seleccionar" Insumo
  $(document).on("click", ".agregarInsumo", function () {
    // Obtener los valores
    let idProducto = $(this).attr("idProducto");
    let nombreProducto = $(this).attr("nombreProducto");
    let precioCompra = parseFloat($(this).attr("precioCompra"));
    let idTablaLista = $(this).attr("idTablaLista");
    let nombreTablaLista = $(this).closest("tr").find("td:eq(4)").text();
    let idMedida = $(this).attr("idMedida");

    // Crear objeto con los datos del insumo
    let nuevoInsumo = {
      id_producto: idProducto,
      id_tipo_material: idTablaLista,
      id_unidad: idMedida,
      cantidad: 1, // Valor inicial
      precio_unitario: precioCompra,
      costo_total: precioCompra, // Valor inicial
    };

    // Verificar si el insumo ya existe en el array
    let insumoExistente = insumosSeleccionados.find(
      (insumo) => insumo.id_producto === idProducto
    );

    if (!insumoExistente) {
      // Eliminar la fila de ejemplo
      $(".ejemploSeleccionarInsumo").remove();

      // Agregar el insumo al array
      insumosSeleccionados.push(nuevoInsumo);

      // Obtener el nombre de la unidad de medida
      let nombreUnidad = $(
        "#detalleUnidad option[value='" + idMedida + "']"
      ).text();

      // Crear la fila en la tabla
      let nuevaFila = `
        <tr>
          <td>${nombreProducto}</td>
          <td>${nombreTablaLista}</td>
          <td>${nombreUnidad}</td>
          <td>
            <input type="number" class="form-control cantidadInsumo" 
                   min="1" value="1" style="width:80px">
          </td>
          <td>
            <span class="precioUnitarioFormateado">${formatearMoneda(
              precioCompra
            )}</span>
          </td>
          <td class="costoTotal">
            <span class="costoTotalFormateado">${formatearMoneda(
              precioCompra
            )}</span>
          </td>
          <td>
            <div class="btn-group">
              <button class="btn btn-danger eliminarInsumo">
                <i class="fa fa-times"></i>
              </button>
            </div>
          </td>
        </tr>
      `;

      // Agregar la fila a la tabla
      $(".insumosSeleccionados tbody").append(nuevaFila);

      // Actualizar totales
      actualizarTotales();
    } else {
      swal({
        type: "warning",
        title: "El insumo ya fue agregado",
        showConfirmButton: true,
        confirmButtonText: "Cerrar",
      });
    }
  });
});
