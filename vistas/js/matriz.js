/*=============================================
EDITAR CATEGORIA
=============================================*/
$(".tablas").on("click", ".btnEditarMatriz", function() {
    var idMatriz = $(this).attr("idMatriz");
    var datos = new FormData();
    datos.append("idMatriz", idMatriz);
    console.log(idMatriz, "matriz");

    $.ajax({
        url: "ajax/matriz.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            console.log("respuesta", respuesta);
            $("#idMatriz").val(respuesta["id"]);
            $("#editarMatriz").val(respuesta["razon_social"]);
            $("#editarRut").val(respuesta["rut"]);
            $("#editarPais").val(respuesta["pais"]);
            $("#editarRegion").val(respuesta["region"]);
            $("#editarComuna").val(respuesta["comuna"]);
            $("#editarDireccion").val(respuesta["direccion"]);
            $("#editarEjecutivo").val(respuesta["ejecutivo"]);
            $("#editarEmail").val(respuesta["email"]);
            $("#editarTelefono").val(respuesta["telefono"]);
            $("#editarActividad").val(respuesta["actividad"]);
            $("#editarFechaInicio").val(respuesta["fecha_inicio"]);
            $("#editarFechaVencimiento").val(respuesta["fecha_vencimiento"]);
            $("#editarTipoProducto").val(respuesta["tipo_producto"]);
            $("#editarTipoCliente").val(respuesta["tipo_cliente"]);
        }
    })
})



/*=============================================
ELIMINAR MATRIZ
=============================================*/
$(".tablas").on("click", ".btnEliminarMatriz", function(){

    var idMatriz = $(this).attr("idMatriz");

    swal({
        title: '¿Está seguro de borrar esta matriz?',
        text: "¡Si no lo está, puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Sí, borrar matriz'
    }).then(function(result){
        if(result.value){
            window.location = "index.php?ruta=matriz&idMatriz="+idMatriz;
        }
    })
})
