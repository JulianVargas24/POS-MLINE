$(".tablaPersonal").DataTable({
  ajax: "ajax/datatable-personal.ajax.php",
  deferRender: true,
  retrieve: true,
  processing: true,
  language: {
    sProcessing: "Procesando...",
    sLengthMenu: "Mostrar _MENU_ registros",
    sZeroRecords: "No se encontraron resultados",
    sEmptyTable: "Ningún dato disponible en esta tabla",
    sInfo: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
    sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0",
    sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
    sInfoPostFix: "",
    sSearch: "Buscar:",
    sUrl: "",
    sInfoThousands: ",",
    sLoadingRecords: "Cargando...",
    oPaginate: {
      sFirst: "Primero",
      sLast: "Último",
      sNext: "Siguiente",
      sPrevious: "Anterior",
    },
    oAria: {
      sSortAscending: ": Activar para ordenar la columna de manera ascendente",
      sSortDescending:
        ": Activar para ordenar la columna de manera descendente",
    },
  },
});

/*=============================================
AGREGANDO PERSONAL A LA ORDEN VESTUARIO DESDE LA TABLA
=============================================*/
$(".tablaPersonal tbody").on("click", "button.agregarPersonal", function () {
  var idPersonal = $(this).attr("idPersonal");
  var idCliente = $(this).attr("idCliente");

  $(this).removeClass("btn-primary agregarPersonal");

  $(this).addClass("btn-default");

  var datos = new FormData();
  datos.append("idPersonal", idPersonal);

  var datos2 = new FormData();
  datos2.append("idCliente", idCliente);

  $.ajax({
    url: "ajax/personal.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      var nombre = respuesta["nombre"];
      var rut = respuesta["rut"];
      var nombre_cliente = "";
      var busto = respuesta["busto"];
      var cintura = respuesta["cintura"];
      var cadera = respuesta["cadera"];
      var ancho_espalda = respuesta["ancho_espalda"];
      var talle_delantero = respuesta["talle_delantero"];
      var talle_espalda = respuesta["talle_espalda"];
      var largo_manga = respuesta["largo_manga"];
      var largo_blusa = respuesta["largo_blusa"];
      var largo_guillete = respuesta["largo_guillete"];
      var largo_chaqueta = respuesta["largo_chaqueta"];
      var largo_polera = respuesta["largo_polera"];
      var largo_parka = respuesta["largo_parka"];
      var largo_polar = respuesta["largo_polar"];
      var largo_vestido = respuesta["largo_vestido"];
      var pantalon_cintura = respuesta["pantalon_cintura"];
      var pantalon_cadera = respuesta["pantalon_cadera"];
      var pantalon_tiro = respuesta["pantalon_tiro"];
      var pantalon_entrepierna = respuesta["pantalon_entrepierna"];
      var largo_pantalon = respuesta["largo_pantalon"];
      var falda_cintura = respuesta["falda_cintura"];
      var falda_cadera = respuesta["falda_cadera"];
      var largo_falda = respuesta["largo_falda"];

      $.ajax({
        url: "ajax/clientes.ajax.php",
        method: "POST",
        data: datos2,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (res) {
          nombre_cliente = res["nombre"];

          $(".nuevoPersonal").append(
            `<div class="row" id="personal${idPersonal}" style="padding:5px 15px">
                                    <div class="col-xs-2" style="padding-right:0px">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                            <button type="button" class="btn btn-danger btn-xs quitarPersonal" idPersonal="${idPersonal}"><i class="fa fa-times"></i></button>
                                            </span>
                                            <input type="text" class="form-control nuevoNombrePersonal" idPersonal="${idPersonal}" name="agregarPersonal" value="${nombre}" readonly required>
                                        </div>
                                    </div>
                                    <div class="col-xs-2" style="padding-right:0px">
                                        <input type="text" class="form-control nuevoRutPersonal" name="nuevoRutPersonal" value="${rut}" readonly required>
                                    </div>
                                    <div class="col-xs-2" style="padding-right:0px">
                                        <input type="text"  class="form-control nuevaEmpresaPersonal"   name="nuevaEmpresaPersonal" value="${nombre_cliente}"  readonly required>
                                    </div>
                                        <input class="form-control busto" type="hidden" name="" id="" value="${busto}">
                                        <input class="form-control cintura" type="hidden" name="" id="" value="${cintura}">
                                        <input class="form-control cadera" type="hidden" name="" id="" value="${cadera}">
                                        <input class="form-control ancho-espalda" type="hidden" name="" id="" value="${ancho_espalda}">
                                        <input class="form-control talle-delantero" type="hidden" name="" id="" value="${talle_delantero}">
                                        <input class="form-control talle-espalda" type="hidden" name="" id="" value="${talle_espalda}">
                                        <input class="form-control largo-manga" type="hidden" name="" id="" value="${largo_manga}">
                                        <input class="form-control largo-blusa" type="hidden" name="" id="" value="${largo_blusa}">
                                        <input class="form-control largo-guillete" type="hidden" name="" id="" value="${largo_guillete}">
                                        <input class="form-control largo-chaqueta" type="hidden" name="" id="" value="${largo_chaqueta}">
                                        <input class="form-control largo-polera" type="hidden" name="" id="" value="${largo_polera}">
                                        <input class="form-control largo-parka" type="hidden" name="" id="" value="${largo_parka}">
                                        <input class="form-control largo-polar" type="hidden" name="" id="" value="${largo_polar}">
                                        <input class="form-control largo-vestido" type="hidden" name="" id="" value="${largo_vestido}">
                                        <input class="form-control pantalon-cintura" type="hidden" name="" id="" value="${pantalon_cintura}">
                                        <input class="form-control pantalon-cadera" type="hidden" name="" id="" value="${pantalon_cadera}">
                                        <input class="form-control pantalon-tiro" type="hidden" name="" id="" value="${pantalon_tiro}">
                                        <input class="form-control pantalon-entrepierna" type="hidden" name="" id="" value="${pantalon_entrepierna}">
                                        <input class="form-control largo-pantalon" type="hidden" name="" id="" value="${largo_pantalon}">
                                        <input class="form-control falda-cadera" type="hidden" name="" id="" value="${falda_cadera}">
                                        <input class="form-control falda-cintura" type="hidden" name="" id="" value="${falda_cintura}">
                                        <input class="form-control largo-falda" type="hidden" name="" id="" value="${largo_falda}">
                                    <div class="col-xs-2 btngroup" style="padding-right:0px">
                                            <button type="button"  idPersonal="${idPersonal}" data-dismiss="modal" class="btn btn-info btnEditarMedidasPersonal">Mostrar</button>
                                            <button type="button" data-toggle="modal" data-target="#modalVerMedidas" idPersonal="${idPersonal}" data-dismiss="modal" class="btn btn-warning btnVerPersonal">Editar</button>
                                    </div>
                                </div>

                                `
          );

          listarPersonal();
        },
      });

      localStorage.removeItem("quitarPersonal");
    },
  });
});

$(".tablaPersonal").on("draw.dt", function () {
  if (localStorage.getItem("quitarPersonal") != null) {
    var listaIdPersonal = JSON.parse(localStorage.getItem("quitarPersonal"));

    for (var i = 0; i < listaIdPersonal.length; i++) {
      $(
        "button.recuperarBoton[idProducto='" +
          listaIdPersonal[i]["idPersonal"] +
          "']"
      ).removeClass("btn-default");
      $(
        "button.recuperarBoton[idProducto='" +
          listaIdPersonal[i]["idPersonal"] +
          "']"
      ).addClass("btn-primary agregarPersonal");
    }
  }
});

/*=============================================
QUITAR PRODUCTOS DE LA VENTA Y RECUPERAR BOTÓN
=============================================*/
var idQuitarPersonal = [];

localStorage.removeItem("quitarPersonal");

$(".nuevoPersonal").on("click", "button.quitarPersonal", function () {
  $(this).parent().parent().parent().parent().remove();

  var idPersonal = $(this).attr("idPersonal");

  /*=============================================
	ALMACENAR EN EL LOCALSTORAGE EL ID DEL PRODUCTO A QUITAR
	=============================================*/

  if (localStorage.getItem("quitarPersonal") == null) {
    idQuitarPersonal = [];
  } else {
    idQuitarPersonal.concat(localStorage.getItem("quitarPersonal"));
  }

  idQuitarPersonal.push({ idPersonal: idPersonal });

  localStorage.setItem("quitarPersonal", JSON.stringify(idQuitarPersonal));

  $("button.recuperarBoton[idPersonal='" + idPersonal + "']").removeClass(
    "btn-default"
  );

  $("button.recuperarBoton[idPersonal='" + idPersonal + "']").addClass(
    "btn-primary agregarPersonal"
  );
});

$(".nuevoPersonal").on("click", "button.quitarPersonal", function () {
  console.log("Quitar Personal");
});

$(".nuevoPersonal").on("click", ".btnVerPersonal", function () {
  var idPersonal = $(this).attr("idPersonal");
  console.log(idPersonal);
  var datos = new FormData();
  datos.append("idPersonal", idPersonal);

  $.ajax({
    url: "ajax/personal.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
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
    },
  });
});

/*=============================================
EDITAR MEDIDAS EN ORDEN DE VESTUARIO
=============================================*/
$(".nuevoPersonal").on("click", ".btnEditarMedidasPersonal", function () {
  var idPersonal = $(this).attr("idPersonal");

  $(this).removeClass("btn-warning btnEditarMedidasPersonal");
  $(this).text("Ocultar");

  $(this).addClass("btn-danger btnOcultarMedidasPersonal");

  var datos = new FormData();
  datos.append("idPersonal", idPersonal);

  $.ajax({
    url: "ajax/personal.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      console.log(respuesta);
      var id = respuesta["id"];
      var busto = respuesta["busto"];
      var cintura = respuesta["cintura"];
      var cadera = respuesta["cadera"];
      var ancho_espalda = respuesta["ancho_espalda"];
      var talle_delantero = respuesta["talle_delantero"];
      var talle_espalda = respuesta["talle_espalda"];
      var largo_manga = respuesta["largo_manga"];
      var largo_blusa = respuesta["largo_blusa"];
      var largo_guillete = respuesta["largo_guillete"];
      var largo_chaqueta = respuesta["largo_chaqueta"];
      var largo_polera = respuesta["largo_polera"];
      var largo_parka = respuesta["largo_parka"];
      var largo_polar = respuesta["largo_polar"];
      var largo_vestido = respuesta["largo_vestido"];
      var pantalon_cintura = respuesta["pantalon_cintura"];
      var pantalon_cadera = respuesta["pantalon_cadera"];
      var pantalon_tiro = respuesta["pantalon_tiro"];
      var pantalon_entrepierna = respuesta["pantalon_entrepierna"];
      var pantalon_muslo = respuesta["pantalon_muslo"];
      var pantalon_rodilla = respuesta["pantalon_rodilla"];
      var pantalon_basta = respuesta["pantalon_basta"];
      var largo_pantalon = respuesta["largo_pantalon"];
      var falda_cintura = respuesta["falda_cintura"];
      var falda_cadera = respuesta["falda_cadera"];
      var largo_falda = respuesta["largo_falda"];

      $("#personal" + id).append(
        `
		 <div class="col-xs-12" id="medidas${id}" style="margin-top:5px;">
                            <div class="row">
                                <div class="col-xs-4">
                                    <h4 class="box-title" style="font-weight:bold; font-size:20px;">Medidas Superiores</h4>
                                    <div class="col-xs-6">
                                        Busto
                                    </div>
                                    <div class="col-xs-6">
                                        <input class="form-control input-sm" type="text" name="" id="" value="${busto}" readonly>
                                    </div>
                                    <div class="col-xs-6">
                                        Cintura
                                    </div>
                                    <div class="col-xs-6">
                                        <input class="form-control input-sm" type="text" name="" id="" value="${cintura}" readonly>
                                    </div>
                                    <div class="col-xs-6">
                                        Cadera
                                    </div>
                                    <div class="col-xs-6">
                                        <input class="form-control input-sm" type="text" name="" id="" value="${cadera}" readonly>
                                    </div>
                                    <div class="col-xs-6">
                                        Ancho Espalda
                                    </div>
                                    <div class="col-xs-6">
                                        <input class="form-control input-sm" type="text" name="" id="" value="${ancho_espalda}" readonly>
                                    </div>
                                    <div class="col-xs-6">
                                        Talle Delantero
                                    </div>
                                    <div class="col-xs-6">
                                        <input class="form-control input-sm" type="text" name="" id="" value="${talle_delantero}" readonly>
                                    </div>
                                    <div class="col-xs-6">
                                        Talle Espalda
                                    </div>
                                    <div class="col-xs-6">
                                        <input class="form-control input-sm" type="text" name="" id="" value="${talle_espalda}" readonly>
                                    </div>
                                    <div class="col-xs-6">
                                        Largo Manga
                                    </div>
                                    <div class="col-xs-6">
                                        <input class="form-control input-sm" type="text" name="" id="" value="${largo_manga}" readonly>
                                    </div>
                                    <div class="col-xs-6">
                                        Largo Blusa
                                    </div>
                                    <div class="col-xs-6">
                                        <input class="form-control input-sm" type="text" name="" id="" value="${largo_blusa}" readonly>
                                    </div>
                                    <div class="col-xs-6">
                                        Largo Guillete
                                    </div>
                                    <div class="col-xs-6">
                                        <input class="form-control input-sm" type="text" name="" id="" value="${largo_guillete}" readonly>
                                    </div>
                                    <div class="col-xs-6">
                                        Largo Chaqueta
                                    </div>
                                    <div class="col-xs-6">
                                        <input class="form-control input-sm" type="text" name="" id="" value="${largo_chaqueta}" readonly>
                                    </div>
                                    <div class="col-xs-6">
                                        Largo Polera
                                    </div>
                                    <div class="col-xs-6">
                                        <input class="form-control input-sm" type="text" name="" id="" value="${largo_polera}" readonly>
                                    </div>
                                    <div class="col-xs-6">
                                        Largo Parka
                                    </div>
                                    <div class="col-xs-6">
                                        <input class="form-control input-sm" type="text" name="" id="" value="${largo_parka}" readonly>
                                    </div>
                                    <div class="col-xs-6">
                                        Largo Polar
                                    </div>
                                    <div class="col-xs-6">
                                        <input class="form-control input-sm" type="text" name="" id="" value="${largo_polar}" readonly>
                                    </div>
                                    <div class="col-xs-6">
                                        Largo Vestido
                                    </div>
                                    <div class="col-xs-6">
                                        <input class="form-control input-sm" type="text" name="" id="" value="${largo_vestido}" readonly>
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <h4 class="box-title" style="font-weight:bold; font-size:20px;">Medidas Inferiores</h4>
                                    <div class="col-xs-12">
                                        <h4 style="font-weight:bold;color:green;">Pantalon</h4>
                                    </div>
                                    <div class="col-xs-6">
                                        Cintura
                                    </div>
                                    <div class="col-xs-6">
                                        <input class="form-control input-sm" type="text" name="" id="" value="${pantalon_cintura}" readonly>
                                    </div>
                                    <div class="col-xs-6">
                                        Cadera
                                    </div>
                                    <div class="col-xs-6">
                                        <input class="form-control input-sm" type="text" name="" id="" value="${pantalon_cadera}" readonly>
                                    </div>
                                    <div class="col-xs-6">
                                        Tiro
                                    </div>
                                    <div class="col-xs-6">
                                        <input class="form-control input-sm" type="text" name="" id="" value="${pantalon_tiro}" readonly>
                                    </div>
                                    <div class="col-xs-6">
                                        Entrepierna
                                    </div>
                                    <div class="col-xs-6">
                                        <input class="form-control input-sm" type="text" name="" id="" value="${pantalon_entrepierna}" readonly>
                                    </div>
                                    <div class="col-xs-6">
                                        Contorno Muslo
                                    </div>
                                    <div class="col-xs-6">
                                        <input class="form-control input-sm" type="text" name="" id="" value="${pantalon_muslo}" readonly>
                                    </div>
                                    <div class="col-xs-6">
                                        Contorno Rodilla
                                    </div>
                                    <div class="col-xs-6">
                                        <input class="form-control input-sm" type="text" name="" id="" value="${pantalon_rodilla}" readonly>
                                    </div>
                                    <div class="col-xs-6">
                                        Contorno Basta
                                    </div>
                                    <div class="col-xs-6">
                                        <input class="form-control input-sm" type="text" name="" id="" value="${pantalon_basta}" readonly>
                                    </div>
                                    <div class="col-xs-6">
                                        Largo Total
                                    </div>
                                    <div class="col-xs-6">
                                        <input class="form-control input-sm" type="text" name="" id="" value="${largo_pantalon}" readonly>
                                    </div>
                                    <div class="col-xs-12">
                                        <h4 style="font-weight:bold;color:green;">Falda</h4> 
                                    </div>
                                    <div class="col-xs-6">
                                        Cintura
                                    </div>
                                    <div class="col-xs-6">
                                        <input class="form-control input-sm" type="text" name="" id="" value="${falda_cadera}" readonly>
                                    </div>
                                    <div class="col-xs-6">
                                        Cadera
                                    </div>
                                    <div class="col-xs-6">
                                        <input class="form-control input-sm" type="text" name="" id="" value="${falda_cintura}" readonly>
                                    </div>
                                    <div class="col-xs-6">
                                        Largo Total 
                                    </div>
                                    <div class="col-xs-6">
                                        <input class="form-control input-sm" type="text" name="" id="" value="${largo_falda}" readonly> 
                                    </div>
                                
                                </div>
                            <hr>
                                
                            </div>
                                             
   </div>
`
      );
    },
  });
});

function listarPersonal() {
  var listaPersonal = [];
  var nombre = $(".nuevoNombrePersonal");
  var rut = $(".nuevoRutPersonal");
  var empresa = $(".nuevaEmpresaPersonal");
  for (var i = 0; i < nombre.length; i++) {
    listaPersonal.push({
      id: $(nombre[i]).attr("idPersonal"),
      nombre: $(nombre[i]).val(),
      rut: $(rut[i]).val(),
      empresa: $(empresa[i]).val(),
      medidas: [
        {
          busto: "120",
          cintura: "120",
          cadera: "120",
          ancho_espalda: "120",
          talle_delantero: "120",
          talle_espalda: "120",
          largo_manga: "120",
          largo_blusa: "120",
          largo_guillete: "120",
          largo_chaqueta: "120",
          largo_polera: "120",
          largo_parka: "120",
          largo_polar: "120",
          largo_vestido: "120",
          pantalon_cintura: "120",
          pantalon_cadera: "120",
          pantalon_tiro: "120",
          pantalon_enterpierna: "120",
          largo_pantalon: "120",
          falda_cintura: "120",
          falda_cadera: "120",
          largo_falda: "120",
        },
      ],
    });
  }
  console.log(listaPersonal);
  $("#listaPersonal").val(JSON.stringify(listaPersonal));
}

$(".nuevoPersonal").on("click", ".btnOcultarMedidasPersonal", function () {
  var idPersonal = $(this).attr("idPersonal");
  $(this).removeClass("btn-danger btnOcultarMedidasPersonal");
  $(this).text("Mostrar");
  $("#medidas" + idPersonal).hide();
  $(this).addClass("btn-info btnMostrarMedidasPersonal");
});

$(".nuevoPersonal").on("click", ".btnMostrarMedidasPersonal", function () {
  var idPersonal = $(this).attr("idPersonal");
  $(this).removeClass("btn-info btnMostrarMedidasPersonal");
  $(this).text("Ocultar");
  $("#medidas" + idPersonal).show();
  $(this).addClass("btn-danger btnOcultarMedidasPersonal");
});

$("#nuevoCliente").change(function () {
  var idCliente = $(this).val();
  console.log(idCliente);
  var datos = new FormData();
  datos.append("idCliente", idCliente);

  $.ajax({
    url: "ajax/clientes.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      console.log("respuesta", respuesta);
      $("#traerId").val(respuesta["id"]);
      $("#traerRut").val(respuesta["rut"]);
      $("#traerDireccion").val(respuesta["direccion"]);
      $("#traerTelefono").val(respuesta["telefono"]);
      $("#traerEmail").val(respuesta["email"]);
      $("#traerActividad").val(respuesta["actividad"]);
      $("#traerEjecutivo").val(respuesta["ejecutivo"]);
    },
  });
});

$(document).ready(function () {
  var idCliente = $("#nuevoCliente").val();
  console.log(idCliente);
  var datos = new FormData();
  datos.append("idCliente", idCliente);

  $.ajax({
    url: "ajax/clientes.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      console.log("respuesta de cliente orden", respuesta);
      $("#traerIdVestuario").val(respuesta["id"]);
      $("#traerRutVestuario").val(respuesta["rut"]);
      $("#traerDireccionVestuario").val(respuesta["direccion"]);
      $("#traerTelefonoVestuario").val(respuesta["telefono"]);
      $("#traerEmailVestuario").val(respuesta["email"]);
      $("#traerActividadVestuario").val(respuesta["actividad"]);
      $("#traerEjecutivoVestuario").val(respuesta["ejecutivo"]);

      sumarTotalPrecios();
      listarProductos();
    },
  });

  $("#seleccionarCliente").select2();
});

/*=============================================
EDITAR ORDEN DE VESTUARIO
=============================================*/
$(".tablas").on("click", ".btnEditarOrdenVestuario", function () {
  console.log("F Orden Vestuario");
  var idOrdenVestuario = $(this).attr("idOrdenVestuario");

  window.location =
    "index.php?ruta=editar-orden-vestuario&idOrdenVestuario=" +
    idOrdenVestuario;
});

/*=============================================
Eliminar ORDEN DE VESTUARIO
=============================================*/
$(".tablas").on("click", ".btnEliminarOrdenVestuario", function () {
  var idOrdenVestuario = $(this).attr("idOrdenVestuario");

  swal({
    title: "¿Está seguro de borrar la Orden de Vestuario?",
    text: "¡Si no lo está puede cancelar la acción!",
    type: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    cancelButtonText: "Cancelar",
    confirmButtonText: "Sí, borrar orden!",
  }).then(function (result) {
    if (result.value) {
      // Redirige al controlador de eliminación
      window.location =
        "index.php?ruta=orden-trabajo&idOrdenVestuario=" + idOrdenVestuario;
    }
  });
});

/*=============================================
 * Botón para filtrar por rango de fechas
 *=============================================*/
if (window.location.href.includes("orden-trabajo")) {
  // Configuración del Date Range Picker
  $("#daterange-orden-vestuario").daterangepicker({
    locale: {
      format: "YYYY-MM-DD",
      applyLabel: "Aplicar",
      cancelLabel: "Cancelar",
      customRangeLabel: "Rango Personalizado",
      firstDay: 1,
      daysOfWeek: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
      monthNames: [
        "Enero",
        "Febrero",
        "Marzo",
        "Abril",
        "Mayo",
        "Junio",
        "Julio",
        "Agosto",
        "Septiembre",
        "Octubre",
        "Noviembre",
        "Diciembre",
      ],
    },
    ranges: {
      Hoy: [moment(), moment()],
      Ayer: [moment().subtract(1, "days"), moment().subtract(1, "days")],
      "Últimos 7 días": [moment().subtract(6, "days"), moment()],
      "Últimos 30 días": [moment().subtract(29, "days"), moment()],
      "Este mes": [moment().startOf("month"), moment().endOf("month")],
      "Mes anterior": [
        moment().subtract(1, "month").startOf("month"),
        moment().subtract(1, "month").endOf("month"),
      ],
    },
    startDate: moment(),
    endDate: moment(),
    showCancelButton: true,
  });

  // Evento al seleccionar fechas
  $("#daterange-orden-vestuario").on(
    "apply.daterangepicker",
    function (ev, picker) {
      const fechaInicial = picker.startDate.format("YYYY-MM-DD");
      const fechaFinal = picker.endDate.format("YYYY-MM-DD");

      // Actualizar el texto del botón
      $(this)
        .find("span")
        .html(
          picker.startDate.format("YYYY-MM-DD") +
            " - " +
            picker.endDate.format("YYYY-MM-DD")
        );

      // Guardar en localStorage y redirigir
      localStorage.setItem("capturarRango", $(this).find("span").html());
      window.location.href = `index.php?ruta=orden-trabajo&fechaInicial=${fechaInicial}&fechaFinal=${fechaFinal}`;
    }
  );

  // Evento al cancelar
  $("#daterange-orden-vestuario").on("cancel.daterangepicker", function () {
    localStorage.removeItem("capturarRango");
    window.location.href = "orden-trabajo";
  });
}
