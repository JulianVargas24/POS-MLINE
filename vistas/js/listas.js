/*=============================================
ELIMINAR LISTA
=============================================*/
$(".tablas").on("click", ".btnEliminarSubcategoria", function(){

    var id_subcategoria = $(this).attr("id_subcategoria");

    swal({
        title: '¿Está seguro de borrar la subcategoría?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar subcategoría!'
    }).then(function(result){

        if(result.value){

            window.location = "index.php?ruta=subcategorias&id_subcategoria="+id_subcategoria;

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