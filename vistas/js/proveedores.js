$(".tablas").on("click", ".btnEditarProveedor", function () {

    var idProveedor = $(this).attr("idProveedor");

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
            $("#idProveedor").val(respuesta["id"]);
            $("#editarProveedor").val(respuesta["razon_social"]);
            $("#editarRutId").val(respuesta["rut"]);
            $("#editarCiudad").val(respuesta["ciudad"]);
            $("#editarNroCuenta").val(respuesta["nro_cuenta"]);
            $("#editarBanco").val(respuesta["banco"]);
            $("#editarTelefono").val(respuesta["telefono"]);
            $("#editarEmail").val(respuesta["email"]);
            $("#editarActividad").val(respuesta["actividad"]);
            $("#editarEjecutivo").val(respuesta["ejecutivo"]);
            $("#editarComuna").val(respuesta["comuna"]);
            $("#editarRegion").val(respuesta["region"]);
            $("#editarDireccion").val(respuesta["direccion"]);
            $("#editarPlazo").val(respuesta["id_plazo"])
        }
    })
})

/*=============================================
ELIMINAR PROVEEDOR
=============================================*/
$(".tablas").on("click", ".btnEliminarProveedor", function () {

    var idProveedor = $(this).attr("idProveedor");

    swal({
        title: '¿Está seguro de borrar este Proveedor?',
        text: "Si no lo está, puede cancelar la acción.",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Sí, borrar proveedor'
    }).then(function (result) {

        if (result.value) {
            window.location = "index.php?ruta=proveedores&idProveedor=" + idProveedor;
        }
    })
})

$(".tablas").on("click", ".btnEditarRubroProveedor", function () {
    console.log("clicked");
    var idProveedor = $(this).attr("idProveedor");
    console.log("clicked");
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
            $("#idProveedor").val(respuesta["id"]);
            $("#editarProveedor").val(respuesta["razon_social"]);
            $("#editarRutId").val(respuesta["rut"]);
        }
    })
})

$('#nuevoPais').on('change', function () {
    console.log("Change Event Triggered: New Value - " + $(this).val());
    if ($(this).val() == "Chile") {
        $("<option>TEST</option>").insertAfter("#regiones");
    }
});

const regiones = [
    ["Tarapaca", "I"],
    ["Antofagasta", "II"],
    ["Atacama", "III"],
    ["Coquimbo", "IV"],
    ["Valparaiso", "V"],
    ["Libertador General Bernardo O'Higgins", "VI"],
    ["Maule", "VII"],
    ["Biobio", "VIII"],
    ["La Araucania", "IX"],
    ["Los Lagos", "X"],
    ["Aysen del General Carlos Ibañez del Campo", "XI"],
    ["Magallanes y Antartica Chilena", "XII"],
    ["Metropolitana de Santiago", "RM"],
    ["Los Rios", "XIV"],
    ["Arica y Parinacota", "XV"],
    ["Ñuble", "XVI"]
]
