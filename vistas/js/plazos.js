/*=============================================
EDITAR CATEGORIA
=============================================*/
$(".tablas").on("click", ".btnEditarPlazo", function(){

	var idPlazo = $(this).attr("idPlazo");

	var datos = new FormData();
	datos.append("idPlazo", idPlazo);

	$.ajax({
		url: "ajax/plazos.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){
			console.log("respuesta", respuesta);
            $("#idPlazo").val(respuesta["id"]);
            $("#editarPlazo").val(respuesta["nombre"]);
            $("#editarNumero").val(respuesta["numero"]);

           

     	}

	})


})

/*=============================================
ELIMINAR PROVEEDOR
=============================================*/
$(".tablas").on("click", ".btnEliminarPlazo", function(){


    var idPlazo = $(this).attr("idPlazo");

    swal({
        title: '¿Está seguro de borrar este Plazo?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar Plazo!'
    }).then(function(result){

        if(result.value){

            window.location = "index.php?ruta=plazos&idPlazo="+idPlazo;

        }

    })

})