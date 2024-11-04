/*=============================================
EDITAR CATEGORIA
=============================================*/
$(".tablas").on("click", ".btnEditarBodega", function () {
  var idBodega = $(this).attr("idBodega");
  var datos = new FormData();
  datos.append("idBodega", idBodega);
  console.log(idBodega, "bodega");

  $.ajax({
    url: "ajax/bodegas.ajax.php",
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
          $("#idBodega").val(respuesta["id"]);
          $("#editarBodega").val(respuesta["nombre"]);
          $("#editarRegion").val(respuesta["region"]);
          $("#editarComuna").val(respuesta["comuna"]);
          $("#editarDireccion").val(respuesta["direccion"]);
          $("#editarTelefono").val(respuesta["telefono"]);
          $("#editarEmail").val(respuesta["email"]);
          $("#editarJefe").val(respuesta["jefe"]);
        },
      });
    },
  });
});

/*=============================================
ELIMINAR PROVEEDOR
=============================================*/
$(".tablas").on("click", ".btnEliminarBodega", function () {
  var idBodega = $(this).attr("idBodega");

  swal({
    title: "¿Está seguro de borrar esta Bodega?",
    text: "Si no lo está, puede cancelar la acción.",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    cancelButtonText: "Cancelar",
    confirmButtonText: "Sí, borrar bodega",
  }).then(function (result) {
    if (result.value) {
      window.location = "index.php?ruta=bodegas&idBodega=" + idBodega;
    }
  });
});
