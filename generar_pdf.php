<?php
require_once('extensiones/tcpdf/tcpdf.php'); // Asegúrate de que la ruta sea correcta

// Crear un nuevo objeto TCPDF
$pdf = new TCPDF();

// Añadir una página
$pdf->AddPage();

// Establecer el contenido del PDF
$pdf->SetFont('helvetica', '', 12);
$pdf->Write(0, '¡Hola, este es un PDF de prueba!');

// Salida del PDF
$pdf->Output('factura.pdf', 'I'); // 'I' para mostrar en el navegador
?>

