/**
 *  Validar RUT chileno.
 *  Esta función verifica si el RUT ingresado es válido con el dígito verificador y formateando su estructura.
 */
function formatearRut(inputRutId) {
  let rut = inputRutId.value.trim();

  // Eliminar puntos y transformar "k" a mayúscula
  rut = rut.replace(/\./g, "").replace(/k/g, "K");

  // Verifica si el RUT ya tiene un guion
  if (!rut.includes("-") && rut.length >= 8) {
    rut = rut.slice(0, 8) + "-" + rut[8];
  }

  // Validar el RUT
  if (!RutValidator.validarRut(rut)) {
    inputRutId.setCustomValidity("El RUT ingresado no es válido.");
    inputRutId.reportValidity();
    inputRutId.focus();
    return; // Detener la ejecución si el RUT no es válido
  } else {
    inputRutId.setCustomValidity("");
    inputRutId.value = rut;

    // Llamada AJAX para verificar si el RUT ya existe
    const idPlantel = inputRutId.dataset.id || null; // Obtener el ID del data-attribute si está en edición
    verificarRutExistente(rut, idPlantel);
  }
}

function verificarRutExistente(rut, idPlantel = null) {
  if (!rut.trim()) return;

  $.ajax({
    url: "ajax/plantel.ajax.php",
    method: "POST",
    data: { rut: rut, idPlantel: idPlantel },
    dataType: "json",
    success: function (response) {
      const inputRutId =
        document.getElementById("nuevoRutId") ||
        document.getElementById("editarRutId");

      if (response.existe) {
        inputRutId.setCustomValidity(
          "Este RUT ya está registrado para otro usuario."
        );
        inputRutId.reportValidity(); // Mostrar el mensaje de error en el campo
        inputRutId.focus(); // Regresar el foco al input
      } else {
        inputRutId.setCustomValidity(""); // Limpiar mensaje de error si está disponible
      }
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.error("Error en la solicitud AJAX:", textStatus, errorThrown);
    },
  });
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

/**
 *  Validar el inicio y cierre de las fechas.
 */
function validarFechas(idComienzo, idCierre) {
  const fechaComienzoInput = document.getElementById(idComienzo);
  const fechaCierreInput = document.getElementById(idCierre);

  const fechaComienzo = new Date(fechaComienzoInput.value);
  const fechaCierre = new Date(fechaCierreInput.value);

  if (fechaComienzo > fechaCierre) {
    fechaCierreInput.value = "";
    fechaCierreInput.focus();
    return false;
  }
  return true;
}
