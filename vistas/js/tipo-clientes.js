
$(".tablas").on("click", ".btnEditarTipoCliente", function(){

	var idTipoCliente = $(this).attr("idTipoCliente");

	var datos = new FormData();
	datos.append("idTipoCliente", idTipoCliente);

	$.ajax({
		url: "ajax/tipo-clientes.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){
			console.log(respuesta);
             $("#editarTipoCliente").val(respuesta["nombre"]);
             $("#editarCodigoCliente").val(respuesta["codigo"]);
     		 $("#idTipoCliente").val(respuesta["id"]);

     	}

	})


})

/*=============================================
ELIMINAR NEGOCIO
=============================================*/
$(".tablas").on("click", ".btnEliminarTipoCliente", function(){
	 var idTipoCliente = $(this).attr("idTipoCliente");

	 swal({
	 	title: '¿Está seguro de borrar el Tipo de Cliente?',
	 	text: "¡Si no lo está puede cancelar la acción!",
	 	type: 'warning',
	 	showCancelButton: true,
	 	confirmButtonColor: '#3085d6',
	 	cancelButtonColor: '#d33',
	 	cancelButtonText: 'Cancelar',
	 	confirmButtonText: 'Si, borrar Tipo de Cliente!'
	 }).then(function(result){

	 	if(result.value){

            window.location = "index.php?ruta=tipo-cliente&idTipoCliente="+idTipoCliente;

	 	}

	 })

})