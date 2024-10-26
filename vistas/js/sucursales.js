
$(".tablas").on("click", ".btnEliminarSucursal", function(){

    var idSucursal = $(this).attr("idSucursal");

    swal({
        title: '¿Está seguro de borrar esta Sucursal?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar Sucursal!'
    }).then(function(result){

        if(result.value){

            window.location = "index.php?ruta=sucursales&idSucursal="+idSucursal;

        }

    })

})


$(".tablas").on("click", ".btnEditarSucursal", function(){
	var idSucursal = $(this).attr("idSucursal");
	var datos = new FormData();
	datos.append("idSucursal", idSucursal);
	console.log(idSucursal, "sucursal");

	$.ajax({
		url: "ajax/sucursales.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){
			console.log("respuesta", respuesta);
            $("#idSucursal").val(respuesta["id"]);
            $("#editarSucursal").val(respuesta["nombre"]);
            $("#editarBodega").val(respuesta["bodega"]);
            $("#editarPais").val(respuesta["pais"]);
            $("#editarRegion").val(respuesta["region"]);
            $("#editarComuna").val(respuesta["comuna"]);
            $("#editarDireccion").val(respuesta["direccion"]);
            $("#editarTelefono").val(respuesta["telefono"]);
			$("#editarEmail").val(respuesta["email"]);
			$("#editarJefe").val(respuesta["jefe"]);
        

     	}

	})


})


