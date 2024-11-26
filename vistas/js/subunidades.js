$(document).on("click", '[data-target="#modalAgregarSubunidad"]', function () {
    console.log("Botón clicado: Agregar Subunidad");
});

/*=============================================
ELIMINAR SUBUNIDAD
=============================================*/
$(".tablas").on("click", ".btnEliminarSubunidad", function () {

    var id_subunidad = $(this).attr("id_subunidad");

    swal({
        title: '¿Está seguro de borrar esta subunidad?',
        text: "Si no lo está, puede cancelar la acción.",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Sí, borrar subunidad'
    }).then(function (result) {

        if (result.value) {

            window.location = "index.php?ruta=subunidades&id_subunidad=" + id_subunidad;

        }

    })

})

/*=============================================
EDITAR SUBUNIDAD
=============================================*/
$(".tablas").on("click", ".btnEditarSubunidad", function () {

    var id_subunidad = $(this).attr("id_subunidad");

    var datos = new FormData();
    datos.append("id_subunidad", id_subunidad);

    $.ajax({
        url: "ajax/subunidades.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            console.log(respuesta)
            $("#editarSubunidad").val(respuesta["subunidad"]);
            $("#id_subunidad").val(respuesta["id"]);

        }

    })


})