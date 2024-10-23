/*=============================================
EDITAR CATEGORIA
=============================================*/
$(".tablas").on("click", ".btnEditarMatriz", function(){
    
	var idMatriz = $(this).attr("idMatriz");
    console.log("IDMATRIZ: " + idMatriz);
	var datos = new FormData();
	datos.append("idMatriz", idMatriz);

	$.ajax({
		url: "ajax/matriz.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){
			console.log("respuesta", respuesta);
            $("#idMatriz").val(respuesta["id"]);
            $("#editarMatriz").val(respuesta["razon_social"]);
            $("#editarRut").val(respuesta["rut"]);
            $("#editarPais").val(respuesta["pais"]);
            $("#editarRegion").val(respuesta["region"]);
            $("#editarComuna").val(respuesta["comuna"]);
            $("#editarDireccion").val(respuesta["direccion"]);
            $("#editarEjecutivo").val(respuesta["ejecutivo"]);
            $("#editarEmail").val(respuesta["email"]);
            $("#editarTelefono").val(respuesta["telefono"]);
            $("#editarActividad").val(respuesta["actividad"]);
            $("#editarFechaInicio").val(respuesta["fecha_inicio"]);
            $("#editarFechaVencimiento").val(respuesta["fecha_vencimiento"]);
            $("#editarTipoProducto").val(respuesta["tipo_producto"]);
            $("#editarTipoCliente").val(respuesta["tipo_cliente"]);

           

     	}

	})


})


$(".tablas").on("click", ".btnEditarMatrizCliente", function(){
    console.log("F");
	var idMatriz = $(this).attr("idMatrizCliente");
    console.log("IDMATRIZ: " + idMatriz);
	var datos = new FormData();
	datos.append("idMatriz", idMatriz);

	$.ajax({
		url: "ajax/matriz.ajax.php",
		method: "POST",
      	data: datos,
      	cache: false,
     	contentType: false,
     	processData: false,
     	dataType:"json",
     	success: function(respuesta){
			console.log("respuesta", respuesta);
            $("#idMatrizCliente").val(respuesta["id"]);
            $("#editarMatrizCliente").val(respuesta["razon_social"]);
            $("#editarRutCliente").val(respuesta["rut"]);
            $("#editarPaisCliente").val(respuesta["pais"]);
            $("#editarRegionCliente").val(respuesta["region"]);
            $("#editarComunaCliente").val(respuesta["comuna"]);
            $("#editarDireccionCliente").val(respuesta["direccion"]);
            $("#editarEjecutivoCliente").val(respuesta["ejecutivo"]);
            $("#editarEmailCliente").val(respuesta["email"]);
            $("#editarTelefonoCliente").val(respuesta["telefono"]);
            $("#editarActividadCliente").val(respuesta["actividad"]);
            $("#editarInicioCliente").val(respuesta["fecha_inicio"]);
            $("#editarVencimientoCliente").val(respuesta["fecha_vencimiento"]);
            $("#editarTipoProductoCliente").val(respuesta["tipo_producto"]);
            $("#editarTipoClienteCliente").val(respuesta["tipo_cliente"]);



           

     	}

	})


})

/*=============================================
ELIMINAR PROVEEDOR
=============================================*/
$(".tablas").on("click", ".btnEliminarMatriz", function(){


    var idMatriz = $(this).attr("idMatriz");

    swal({
        title: '¿Está seguro de borrar esta Matriz?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar Matriz!'
    }).then(function(result){

        if(result.value){

            window.location = "index.php?ruta=matriz&idMatriz="+idMatriz;

        }

    })

})