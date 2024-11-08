<?php

// Obtener el valor enviado por AJAX
$id = $_POST['id'];
$conexion = mysqli_connect("localhost","root","","mlinecl_pos_pyme_mline");

// Consultar la base de datos para obtener las opciones correspondientes
$sql = "SELECT * FROM comunas WHERE region_id = $id";
$result = mysqli_query($conexion, $sql);

// Construir el HTML para el segundo select
$html = '<option value="">Selecciona una Comuna</option>';
while ($row = mysqli_fetch_assoc($result)) {
    $html .= '<option value="' . $row['id'] . '">' . $row['nombre'] . '</option>';
}

echo $html;

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>