$(document).ready(function () {
  /*=============================================
   * Botón para filtrar por rango de fechas
   *=============================================*/
  if (window.location.href.includes("cotizaciones")) {
    // Configuración del Date Range Picker
    $("#daterange-cotizaciones").daterangepicker({
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
    $("#daterange-cotizaciones").on(
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
        window.location.href = `index.php?ruta=cotizaciones&fechaInicial=${fechaInicial}&fechaFinal=${fechaFinal}`;
      }
    );

    // Evento al cancelar
    $("#daterange-cotizaciones").on("cancel.daterangepicker", function () {
      localStorage.removeItem("capturarRango");
      window.location.href = "cotizaciones";
    });
  }
});
