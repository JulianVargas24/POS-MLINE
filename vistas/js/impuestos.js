/*=============================================
EDITAR IMPUESTO
=============================================*/

$(".tablas").on("click", ".btnEditarImpuesto", function () {
  var idImpuesto = $(this).attr("idImpuesto");

  var datos = new FormData();
  datos.append("idImpuesto", idImpuesto);

  $.ajax({
    url: "ajax/impuestos.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      console.log(respuesta);
      $("#editarFactor").val(respuesta["factor"]);
      $("#editarCodigo").val(respuesta["codigo"]);
      $("#editarImpuesto").val(respuesta["nombre"]);
      $("#editarDescripcion").val(respuesta["descripcion"]); 
      $("#idImpuesto").val(respuesta["id"]);
    },
  });
});

/*=============================================
ELIMINAR IMPUESTO
=============================================*/
$(".tablas").on("click", ".btnEliminarImpuesto", function () {
  var idImpuesto = $(this).attr("idImpuesto");

  swal({
    title: "¿Está seguro de borrar este impuesto?",
    text: "Si no lo está, puede cancelar la acción.",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    cancelButtonText: "Cancelar",
    confirmButtonText: "Sí, borrar categoría",
  }).then(function (result) {
    if (result.value) {
      window.location = "index.php?ruta=impuestos&idImpuesto=" + idImpuesto;
    }
  });
});
