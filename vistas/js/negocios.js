/*=============================================
EDITAR NEGOCIO
=============================================*/



$(".tablas").on("click", ".btnEditarUnidadNegocio", function(){

	var idNegocio = $(this).attr("idNegocio");

	var datos = new FormData();
	datos.append("idNegocio", idNegocio);

	$.ajax({
		url: "ajax/negocios.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){
			console.log(respuesta);
             $("#editarNegocio").val(respuesta["unidad_negocio"]);
             $("#editarCodigoUnidad").val(respuesta["codigo"]);
     		 $("#idNegocio").val(respuesta["id"]);

     	}

	})


})

/*=============================================
ELIMINAR NEGOCIO
=============================================*/
$(".tablas").on("click", ".btnEliminarUnidadNegocio", function(){

	 var idNegocio = $(this).attr("idNegocio");

	 swal({
	 	title: '¿Está seguro de borrar esta unidad de negocio?',
	 	text: "Si no lo está, puede cancelar la accíón.",
	 	type: 'warning',
	 	showCancelButton: true,
	 	confirmButtonColor: '#3085d6',
	 	cancelButtonColor: '#d33',
	 	cancelButtonText: 'Cancelar',
	 	confirmButtonText: 'Sí, borrar unidad de negocio'
	 }).then(function(result){

	 	if(result.value){

            window.location = "index.php?ruta=unidad-negocio&idNegocio="+idNegocio;

	 	}

	 })

})