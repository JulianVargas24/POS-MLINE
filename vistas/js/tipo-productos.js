
$(".tablas").on("click", ".btnEditarTipoProducto", function(){

	var idTipoProducto = $(this).attr("idTipoProducto");

	var datos = new FormData();
	datos.append("idTipoProducto", idTipoProducto);

	$.ajax({
		url: "ajax/tipo-productos.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){
			console.log(respuesta);
             $("#editarTipoProducto").val(respuesta["nombre"]);
             $("#editarCodigoProducto").val(respuesta["codigo"]);
     		 $("#idTipoProducto").val(respuesta["id"]);

     	}

	})


})

/*=============================================
ELIMINAR NEGOCIO
=============================================*/
$(".tablas").on("click", ".btnEliminarTipoProducto", function(){
	 var idTipoProducto = $(this).attr("idTipoProducto");

	 swal({
	 	title: '¿Está seguro de borrar el Tipo de Producto?',
	 	text: "¡Si no lo está puede cancelar la acción!",
	 	type: 'warning',
	 	showCancelButton: true,
	 	confirmButtonColor: '#3085d6',
	 	cancelButtonColor: '#d33',
	 	cancelButtonText: 'Cancelar',
	 	confirmButtonText: 'Si, borrar Tipo de Producto!'
	 }).then(function(result){

	 	if(result.value){

            window.location = "index.php?ruta=tipo-producto&idTipoProducto="+idTipoProducto;

	 	}

	 })

})