/*=============================================
EDITAR CATEGORIA
=============================================*/



$(".tablas").on("click", ".btnEditarUnidades", function(){

	var idUnidad = $(this).attr("idUnidad");

	var datos = new FormData();
	datos.append("idUnidad", idUnidad);

	$.ajax({
		url: "ajax/unidades.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){
			console.log(respuesta);
     		$("#editarMedida").val(respuesta["medida"]);
     		$("#idUnidad").val(respuesta["id"]);

     	}

	})


})

/*=============================================
ELIMINAR UNIDAD
=============================================*/
$(".tablas").on("click", ".btnEliminarUnidad", function(){

	 var idUnidad = $(this).attr("idUnidad");

	 swal({
	 	title: '¿Está seguro de borrar esta unidad?',
	 	text: "Si no lo está, puede cancelar la acción.",
	 	type: 'warning',
	 	showCancelButton: true,
	 	confirmButtonColor: '#3085d6',
	 	cancelButtonColor: '#d33',
	 	cancelButtonText: 'Cancelar',
	 	confirmButtonText: 'Sí, borrar unidad'
	 }).then(function(result){

	 	if(result.value){

	 		window.location = "index.php?ruta=unidades&idUnidad="+idUnidad;

	 	}

	 })

})