//MOSTRAR PDF DE NOTA DE CREDITO DE BOLETA EXENTA
$(document).ready(function() {
    $(".tablas").on("click", ".btnImprimirNotaCreditoBoletaExenta", function(){
  
    var codigoVenta= $(this).attr("codigoVenta");
    var tipoDocumento = "Nota_Credito_Boleta_Exenta";
  
    window.open("extensiones/tcpdf/pdf/documento.php?codigo="+codigoVenta + "&documento="+tipoDocumento , "_blank"); 
  
  })
  });

//MOSTRAR PDF DE NOTA DE CREDITO DE BOLETA AFECTA
  $(document).ready(function() {
    $(".tablas").on("click", ".btnImprimirNotaCreditoBoletaAfecta", function(){
  
    var codigoVenta= $(this).attr("codigoVenta");
    var tipoDocumento = "Nota_Credito_Boleta_Afecta";
  
    window.open("extensiones/tcpdf/pdf/documento.php?codigo="+codigoVenta + "&documento="+tipoDocumento , "_blank"); 
  
  })
  });

//MOSTRAR PDF DE NOTA DE CREDITO DE FACTURA AFECTA
  $(document).ready(function() {
    $(".tablas").on("click", ".btnImprimirNotaCreditoFacturaAfecta", function(){
  
    var codigoVenta= $(this).attr("codigoVenta");
    var tipoDocumento = "Nota_Credito_Factura_Afecta";
  
    window.open("extensiones/tcpdf/pdf/documento.php?codigo="+codigoVenta + "&documento="+tipoDocumento , "_blank"); 
  
  })
  });

//MOSTRAR PDF DE NOTA DE CREDITO DE FACTURA EXENTA
  $(document).ready(function() {
    $(".tablas").on("click", ".btnImprimirNotaCreditoFacturaExenta", function(){
  
    var codigoVenta= $(this).attr("codigoVenta");
    var tipoDocumento = "Nota_Credito_Factura_Exenta";
  
    window.open("extensiones/tcpdf/pdf/documento.php?codigo="+codigoVenta + "&documento="+tipoDocumento , "_blank"); 
  
  })
  });