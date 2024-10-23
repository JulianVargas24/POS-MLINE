/*=============================================
EDITAR BANCO
=============================================*/
$(".tablas").on("click", ".btnEditarBanco", function() {
    var idBanco = $(this).attr("idBanco"); 
    var datos = new FormData();
    datos.append("idBanco", idBanco);
    console.log(idBanco, "banco");

    $.ajax({
        url: "ajax/bancos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
            console.log(respuesta); 
            $("#editarBanco").val(respuesta["nombre_banco"]);
            $("#idBanco").val(respuesta["id"]);
            $("#editarCodigoSBIF").val(respuesta["codigo"]);
        }
        
    })
})



/*=============================================
ELIMINAR BANCO
=============================================*/
$(".tablas").on("click", ".btnEliminarBanco", function() {

    var idBanco = $(this).attr("idBanco");
    
    swal({
        title: '¿Está seguro de borrar este Banco?',
        text: "Si no lo está, puede cancelar la acción.",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Sí, borrar banco'
    }).then(function(result) {
        
        if (result.value) {

            window.location = "index.php?ruta=bancos&idBanco=" + idBanco;
        }
    })
})
