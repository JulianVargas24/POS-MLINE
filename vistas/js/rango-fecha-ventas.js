/*=============================================
VARIABLE LOCAL STORAGE
=============================================*/

if(localStorage.getItem("capturarRangoVentas") != null){

	$("#daterange-ventas span").html(localStorage.getItem("capturarRangoVentas"));

} else {

	$("#daterange-ventas span").html('<i class="fa fa-calendar"></i> Rango de fecha');

}

/*=============================================
RANGO DE FECHAS
=============================================*/
$('#daterange-ventas').daterangepicker(
  {
    ranges   : {
      'Hoy'       : [moment(), moment()],
      'Ayer'      : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
      'Últimos 7 días' : [moment().subtract(6, 'days'), moment()],
      'Últimos 30 días': [moment().subtract(29, 'days'), moment()],
      'Este mes'  : [moment().startOf('month'), moment().endOf('month')],
      'Último mes': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    },
    startDate: moment(),
    endDate  : moment()
  },
  function (start, end) {
    $('#daterange-ventas span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

    var fechaInicial = start.format('YYYY-MM-DD');
    var fechaFinal = end.format('YYYY-MM-DD');

    var capturarRangoVentas = $("#daterange-ventas span").html();
   
   	localStorage.setItem("capturarRangoVentas", capturarRangoVentas);

   	window.location = "index.php?ruta=ventas&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;

  }

)

/*=============================================
CANCELAR RANGO DE FECHAS
=============================================*/
$(".daterangepicker.opensright .range_inputs .cancelBtn").on("click", function() {
    // Verificar si el rango actual corresponde a ventas o a cotizaciones
    if (window.location.href.includes("ventas")) {
        localStorage.removeItem("capturarRangoVentas");
        window.location = "ventas";
    } else if (window.location.href.includes("cotizaciones")) {
        localStorage.removeItem("capturarRangoCotizacion");
        window.location = "cotizaciones";
    }
});


/*=============================================
CAPTURAR HOY
=============================================*/

$(".daterangepicker.opensright .ranges li").on("click", function(){

	var textoHoy = $(this).attr("data-range-key");

	if(textoHoy == "Hoy"){

        var d = new Date();
        
        var dia = d.getDate();
        var mes = d.getMonth()+1;
        var año = d.getFullYear();

        if(mes < 10){

          var fechaInicial = año+"-0"+mes+"-"+dia;
          var fechaFinal = año+"-0"+mes+"-"+dia;

        }else if(dia < 10){

          var fechaInicial = año+"-"+mes+"-0"+dia;
          var fechaFinal = año+"-"+mes+"-0"+dia;

        }else if(mes < 10 && dia < 10){

          var fechaInicial = año+"-0"+mes+"-0"+dia;
          var fechaFinal = año+"-0"+mes+"-0"+dia;

        }else{

          var fechaInicial = año+"-"+mes+"-"+dia;
          var fechaFinal = año+"-"+mes+"-"+dia;

        } 

        // Verificar si la URL incluye "ventas" o "cotizaciones" para decidir el almacenamiento y redirección
        if (window.location.href.includes("ventas")) {
            localStorage.setItem("capturarRangoVentas", "Hoy");
            window.location = `index.php?ruta=ventas&fechaInicial=${fechaInicial}&fechaFinal=${fechaFinal}`;
        } else if (window.location.href.includes("cotizaciones")) {
            localStorage.setItem("capturarRangoCotizacion", "Hoy");
            window.location = `index.php?ruta=cotizaciones&fechaInicial=${fechaInicial}&fechaFinal=${fechaFinal}`;
        }

	}

})
