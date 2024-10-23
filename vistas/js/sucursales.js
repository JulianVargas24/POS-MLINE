$(".tablas").on("click", ".btnEliminarSucursal", function(){

    var idSucursal = $(this).attr("idSucursal");

    swal({
        title: '¿Está seguro de borrar esta Sucursal?',
        text: "Si no lo está, puede cancelar la acción.",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Sí, borrar sucursal'
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

const regiones = [
	["Tarapaca", "I"],
	["Antofagasta", "II"],
	["Atacama", "III"],
	["Coquimbo", "IV"],
	["Valparaiso", "V"],
	["Libertador General Bernardo O'Higgins", "VI"],
	["Maule", "VII"],
	["Biobio", "VIII"],
	["La Araucania", "IX"],
	["Los Lagos", "X"],
	["Aysen del General Carlos Ibañez del Campo", "XI"],
	["Magallanes y Antartica Chilena", "XII"],
	["Metropolitana de Santiago", "RM"],
	["Los Rios", "XIV"],
	["Arica y Parinacota", "XV"],
	["Ñuble", "XVI"]
]
