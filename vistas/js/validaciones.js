/**
 *  Validar RUT chileno.
 *  Esta función verifica si el RUT ingresado es válido con el dígito verificador y formateando su estructura.
 */

function formatearRut(inputRutId) {
  let rut = inputRutId.value.trim();

  // Eliminar puntos.
  rut = rut.replace(/\./g, "");
  // Reemplazar k minúscula por K mayúscula.
  rut = rut.replace(/k/g, "K");
  // Verifica si el RUT ya tiene un guion.
  if (!rut.includes("-")) {
    if (rut.length >= 8) {
      rut = rut.slice(0, 8) + "-" + rut[8];
    }
  }

  inputRutId.addEventListener("input", function () {
    inputRutId.setCustomValidity("");
  });

  if (!RutValidator.validarRut(rut)) {
    inputRutId.setCustomValidity("El RUT ingresado no es válido.");
    inputRutId.reportValidity();
    inputRutId.focus();
  } else {
    inputRutId.setCustomValidity("");
    inputRutId.value = rut;
  }
}

var RutValidator = {
  validarRut: function (rutCompleto) {
    rutCompleto = rutCompleto.replace("‐", "-");
    if (!/^[0-9]+[-|‐]{1}[0-9kK]{1}$/.test(rutCompleto)) return false;
    var partesRut = rutCompleto.split("-");
    var digitoVerificador = partesRut[1];
    var rutBase = partesRut[0];

    return RutValidator.calcularDV(rutBase) == digitoVerificador;
  },
  calcularDV: function (numeroRut) {
    var multiplicador = 0,
      sumar = 1;
    for (; numeroRut; numeroRut = Math.floor(numeroRut / 10))
      sumar = (sumar + (numeroRut % 10) * (9 - (multiplicador++ % 6))) % 11;
    return sumar ? sumar - 1 : "K";
  },
};

/**
 *  Validar número de teléfono.
 */
function validarTelefono(inputTelefono) {
  if (inputTelefono.value === "") {
    inputTelefono.value = "+";
  }

  inputTelefono.addEventListener("input", function () {
    inputTelefono.value = inputTelefono.value.replace(/[^0-9\+]/g, "");
    if (!inputTelefono.value.startsWith("+")) {
      inputTelefono.value = "+" + inputTelefono.value.slice(1);
    }

    inputTelefono.setCustomValidity(
      inputTelefono.validity.patternMismatch
        ? "Ingrese el número de teléfono completo."
        : ""
    );
  });
}

/**
 *  Validar línea de crédito.
 */

function formatearLineaCredito(inputLineaCredito) {
  // Elimina cualquier carácter que no sea un número.
  let value = inputLineaCredito.value.replace(/[^0-9]/g, "");

  // Eliminar ceros a la izquierda.
  value = value.replace(/^0+/, "");

  // Formatea con puntos como separadores de miles.
  inputLineaCredito.value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

//Validar Region y comuna.

//Funcion que filtra las comunas por region en crear:

function filtrarComunasPorRegion(
  regionSelectId,
  comunaSelectId,
  campoNombreRegionId
) {
  // Obtiene los elementos de la región, comuna y el campo oculto donde se guardará el nombre de la región
  var regionSelect = document.getElementById(regionSelectId);
  var comunaSelect = document.getElementById(comunaSelectId);
  var campoNombreRegion = document.getElementById(campoNombreRegionId);

  // Función que se ejecuta cuando cambia la región
  regionSelect.addEventListener("change", function () {
    var regionId = this.value; // Obtiene el id de la región seleccionada
    var regionNombre =
      this.options[this.selectedIndex].getAttribute("data-nombre-region"); // Obtiene el nombre de la región seleccionada

    // Guarda el nombre de la región seleccionada en el campo oculto
    campoNombreRegion.value = regionNombre;

    // Filtra las comunas según la región seleccionada
    for (var i = 0; i < comunaSelect.options.length; i++) {
      var option = comunaSelect.options[i];
      var optionRegionId = option.getAttribute("data-region-id");

      if (regionId === optionRegionId || option.value === "") {
        option.style.display = "block"; // Mostrar comunas que correspondan a la región seleccionada
      } else {
        option.style.display = "none"; // Ocultar comunas que no correspondan
      }
    }

    // Reiniciar la selección de comuna
    comunaSelect.value = "";
  });
}

//funcion de filtrar las comunas de las regiones en editar:

function inicializarFiltroComunas(regionSelectId, comunaSelectId) {
  var regionSelect = document.getElementById(regionSelectId);
  var comunaSelect = document.getElementById(comunaSelectId);

  function filterComunas() {
    var selectedRegionId = regionSelect.value;

    // Limpiar selección de comunas
    comunaSelect.value = "";

    // Muestra todas las comunas
    for (var i = 0; i < comunaSelect.options.length; i++) {
      var option = comunaSelect.options[i];
      var optionRegionId = option.getAttribute("data-region-id");

      // Muestra las comunas que pertenecen a la región seleccionada
      if (optionRegionId === selectedRegionId || option.value === "") {
        option.style.display = "block"; // Mostrar comuna
      } else {
        option.style.display = "none"; // Ocultar comuna
      }
    }
  }

  // Filtrar comunas cuando se carga la página
  filterComunas();

  // Filtrar comunas cuando se cambia la región
  regionSelect.addEventListener("change", filterComunas);
}
