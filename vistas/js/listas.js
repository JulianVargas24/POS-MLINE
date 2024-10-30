/*=============================================
ELIMINAR LISTA
=============================================*/
$(".tablas").on("click", ".btnEliminarListas", function(){

    var idLista = $(this).attr("idLista");

    swal({
        title: '¿Está seguro de borrar la lista de precios?',
        text: "¡Si no lo está, puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Sí, borrar lista de precios'
    }).then(function(result){
        if(result.value){
            window.location = "index.php?ruta=listas&idLista="+idLista;
        }
    })
})

/*=============================================
EDITAR LISTA
=============================================*/
$(".tablas").on("click", ".btnEditarListas", function(){

	var idLista = $(this).attr("idLista");

	var datos = new FormData();
	datos.append("idLista", idLista);

	$.ajax({
		url: "ajax/listas.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){
     		$("#editarLista").val(respuesta["nombre_lista"]);
             $("#editarFactor").val(respuesta["factor"]);
             $("#idLista").val(respuesta["id"]);

     	}
	})
})