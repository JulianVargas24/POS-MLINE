$(".tablas").on("click", ".btnEditarPrecioProducto", function(){
    console.log("F");
	var idProducto = $(this).attr("idProducto");

	var datos = new FormData();
	datos.append("idProducto", idProducto);

	$.ajax({
		url: "ajax/productos.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){
     		$("#idProducto").val(respuesta["id"]);
             $("#editarNombreProducto").val(respuesta["descripcion"]);
             $("#editarPrecioProducto").val(respuesta["precio_venta"]);

     	}

	})


})
