/*=============================================
EDITAR CLIENTE
=============================================*/
$(".tablas").on("click", ".btnEditarPlantel", function(){

	var idPlantel = $(this).attr("idPlantel");

	var datos = new FormData();
    datos.append("idPlantel", idPlantel);

    $.ajax({

      url:"ajax/plantel.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){
      
      	   $("#idPlantel").val(respuesta["id"]);
	       $("#editarNombre").val(respuesta["nombre"]);
	       $("#editarRutId").val(respuesta["rut"]);
	       $("#editarCargo").val(respuesta["cargo"]);
	       $("#editarComision").val(respuesta["comision"]);

          
	  }

  	})

})

/*=============================================
ELIMINAR CLIENTE
=============================================*/
$(".tablas").on("click", ".btnEliminarPlantel", function(){

	var idPlantel = $(this).attr("idPlantel");
	
	swal({
        title: '¿Está seguro de borrar el plantel?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar plantel!'
      }).then(function(result){
        if (result.value) {
          
            window.location = "index.php?ruta=plantel&idPlantel="+idPlantel;
        }

  })

})