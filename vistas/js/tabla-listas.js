/*=============================================
EDITAR CATEGORIA
=============================================*/
$(".tablas").on("click", ".btnEditarTablaLista", function(){

	var idTablaLista = $(this).attr("idTablaLista");
	console.log("TablaLista");
	var datos = new FormData();
	datos.append("idTablaLista", idTablaLista);

	$.ajax({
		url: "ajax/tabla-listas.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){

     		$("#editarTablaLista").val(respuesta["nombre"]);
     		$("#idTablaLista").val(respuesta["id"]);

     	}

	})


})

/*=============================================
ELIMINAR CATEGORIA
=============================================*/
$(".tablas").on("click", ".btnEliminarTablaLista", function(){

	 var idTablaLista = $(this).attr("idTablaLista");

	 swal({
	 	title: '¿Está seguro de borrar esta Tabla para Listas?',
	 	text: "Si no lo está, puede cancelar la acción.",
	 	type: 'warning',
	 	showCancelButton: true,
	 	confirmButtonColor: '#3085d6',
	 	cancelButtonColor: '#d33',
	 	cancelButtonText: 'Cancelar',
	 	confirmButtonText: 'Sí, borrar tabla para listas'
	 }).then(function(result){

	 	if(result.value){

	 		window.location = "index.php?ruta=tabla-listas&idTablaLista="+idTablaLista;

	 	}

	 })

})