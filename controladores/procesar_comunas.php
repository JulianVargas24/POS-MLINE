<?php
// Asegúrate de que las rutas son correctas
require_once 'regiones.controlador.php'; // Archivo del controlador
require_once '../modelos/Conexion.php'; // Archivo de conexión a la base de datos


// Verificar si se recibe el ID de la región
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['regionId'])) {
    $regionId = $_POST['regionId'];

    // Llamar al controlador para obtener las comunas de la región seleccionada
    $item = 'region_id';
    $comunas = ControladorRegiones::ctrMostrarComunas($item, $regionId);

    // Verificar si se obtuvieron comunas y devolver en formato JSON
    echo json_encode($comunas ? $comunas : []);
} else {
    // Si no se recibe regionId, podrías optar por devolver un error, si es necesario
    echo json_encode(['error' => 'No se recibió regionId']);
}
?>