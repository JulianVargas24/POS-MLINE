/*=============================================
ELIMINAR SUBCATEGORIA
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
EDITAR CATEGORIA
=============================================*/
$(".tablas").on("click", ".btnEditarSubcategoria", function(){

	var id_subcategoria = $(this).attr("id_subcategoria");

	var datos = new FormData();
	datos.append("id_subcategoria", id_subcategoria);

	$.ajax({
		url: "ajax/subcategorias.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){
            console.log(respuesta)
     		$("#editarSubcategoria").val(respuesta["subcategoria"]);
     		$("#id_subcategoria").val(respuesta["id"]);

     	}

	})


})