/*=============================================
EDITAR CATEGORIA
=============================================*/
$(".tablas").on("click", ".btnEditarMedio", function(){

	var idMedio = $(this).attr("idMedio");
	var datos = new FormData();
	datos.append("idMedio", idMedio);
	$.ajax({
		url: "ajax/medios-pago.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){
     		$("#editarMedio").val(respuesta["medio_pago"]);
     		$("#idMedio").val(respuesta["id"]);
            console.log(respuesta);
     	}

	})


})

/*=============================================
ELIMINAR CATEGORIA
=============================================*/
$(".tablas").on("click", ".btnEliminarMedio", function(){

	 var idMedio = $(this).attr("idMedio");

	 swal({
	 	title: '¿Está seguro de borrar el medio de pago?',
	 	text: "¡Si no lo está puede cancelar la acción!",
	 	type: 'warning',
	 	showCancelButton: true,
	 	confirmButtonColor: '#3085d6',
	 	cancelButtonColor: '#d33',
	 	cancelButtonText: 'Cancelar',
	 	confirmButtonText: 'Si, borrar medio de pago!'
	 }).then(function(result){

	 	if(result.value){

	 		window.location = "index.php?ruta=medios-pagos&idMedio="+idMedio;

	 	}

	 })

})