/*=============================================
EDITAR CLIENTE
=============================================*/
$(".tablas").on("click", ".btnEditarCliente", function () {
  var idCliente = $(this).attr("idCliente");

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
      console.log("respuesta", respuesta);
      $.ajax({
        url: "./vistas/modulos/obtenerRegiones.php",
        data: { id: respuesta["region"] },
        type: "POST",
        success: function (response) {
          console.log(response);
          $("#editarComuna").html(response);
          $("#idCliente").val(respuesta["id"]);
          $("#editarCliente").val(respuesta["nombre"]);
          $("#editarRutId").val(respuesta["rut"]);
          $("#editarEmail").val(respuesta["email"]);
          $("#editarTelefono").val(respuesta["telefono"]);
          $("#editarDireccion").val(respuesta["direccion"]);
          $("#editarRegion").val(respuesta["region"]);
          $("#editarComuna").val(respuesta["comuna"]);
          $("#editarPais").val(respuesta["pais"]);
          $("#editarEjecutivo").val(respuesta["ejecutivo"]);
          $("#editarActividad").val(respuesta["actividad"]);
          $("#editarPlazo").val(respuesta["id_plazo"]);
          $("#editarVendedor").val(respuesta["id_vendedor"]);
          $("#editarTipoCampana").val(respuesta["id_campana"]);
          $("#editarTipoProducto").val(respuesta["id_producto"]);
          $("#editarFactor").val(respuesta["factor_lista"]);
          $("#editarEstado").val(respuesta["estado"]);
          $("#editarContactoCobranza").val(respuesta["contacto_cobranza"]);
          $("#editarEmailCobranza").val(respuesta["email_cobranza"]);
          $("#editarTelefonoCobranza").val(respuesta["telefono_cobranza"]);
          $("#editarLineaCredito").val(respuesta["linea_credito"]);
          $("#editarBloqueoCredito").val(respuesta["bloqueo_credito"]);
          $("#editarObservacion").val(respuesta["observacion"]);
        },
      });
    },
  });
});

/*=============================================
ELIMINAR CLIENTE
=============================================*/
$(".tablas").on("click", ".btnEliminarCliente", function () {
  var idCliente = $(this).attr("idCliente");

  swal({
    title: "¿Está seguro de borrar este cliente?",
    text: "Si no lo está, puede cancelar la acción.",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    cancelButtonText: "Cancelar",
    confirmButtonText: "Sí, borrar cliente",
  }).then(function (result) {
    if (result.value) {
      window.location = "index.php?ruta=clientes&idCliente=" + idCliente;
    }
  });
});
