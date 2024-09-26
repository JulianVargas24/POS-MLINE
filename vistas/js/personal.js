/*=============================================
EDITAR CLIENTE
=============================================*/
$(".tablas").on("click", ".btnEditarPersonal", function(){

	var idPersonal = $(this).attr("idPersonal");
        console.log(idPersonal);
	var datos = new FormData();
    datos.append("idPersonal", idPersonal);

    $.ajax({

      url:"ajax/personal.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){
            console.log(respuesta);
      	       $("#idPersonal").val(respuesta["id"]);
	            $("#editarPersonal").val(respuesta["nombre"]);
              $("#editarRutId").val(respuesta["rut"]);
              $("#editarEmail").val(respuesta["email"]);
              $("#editarTelefono").val(respuesta["telefono"]);
              $("#editarEmpresa").val(respuesta["id_cliente"]);
               $("#editarBusto").val(respuesta["busto"]);
               $("#editarCintura").val(respuesta["cintura"]);
               $("#editarCadera").val(respuesta["cadera"]);
               $("#editarAnchoEspalda").val(respuesta["ancho_espalda"]);
               $("#editarTalleDelantero").val(respuesta["talle_delantero"]);
               $("#editarTalleEspalda").val(respuesta["talle_espalda"]);
               $("#editarLargoManga").val(respuesta["largo_manga"]);
               $("#editarLargoBlusa").val(respuesta["largo_blusa"]);
               $("#editarLargoGuillete").val(respuesta["largo_guillete"]);
               $("#editarLargoChaqueta").val(respuesta["largo_chaqueta"]);
               $("#editarLargoPolera").val(respuesta["largo_polera"]);
               $("#editarLargoParka").val(respuesta["largo_parka"]);
               $("#editarLargoPolar").val(respuesta["largo_polar"]);
               $("#editarLargoVestido").val(respuesta["largo_vestido"]);
               $("#editarCinturaPantalon").val(respuesta["pantalon_cintura"]);
               $("#editarCaderaPantalon").val(respuesta["pantalon_cadera"]);
               $("#editarTiroPantalon").val(respuesta["pantalon_tiro"]);
               $("#editarEntrepiernaPantalon").val(respuesta["pantalon_entrepierna"]);
               $("#editarMusloPantalon").val(respuesta["pantalon_muslo"]);
               $("#editarRodillaPantalon").val(respuesta["pantalon_rodilla"]);
               $("#editarBastaPantalon").val(respuesta["pantalon_basta"]);
               $("#editarLargoPantalon").val(respuesta["largo_pantalon"]);
               $("#editarCinturaFalda").val(respuesta["falda_cintura"]);
               $("#editarCaderaFalda").val(respuesta["falda_cadera"]);
               $("#editarLargoFalda").val(respuesta["largo_falda"]);

	  }

  	})

})


/*=============================================
ELIMINAR PERSONAL
=============================================*/
$(".tablas").on("click", ".btnEliminarPersonal", function(){

	var idPersonal = $(this).attr("idPersonal");
	
	swal({
        title: '¿Está seguro de borrar el personal?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar cliente!'
      }).then(function(result){
        if (result.value) {
          
            window.location = "index.php?ruta=personal&idPersonal="+idPersonal;
        }

  })

})