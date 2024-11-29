<?php
// Mostrar todos los errores (solo para depuración)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Función para mostrar errores de forma estructurada
function mostrar_error($mensaje)
{
    echo json_encode(["error" => $mensaje]);
    exit;
}

// Verificar si estamos en la vista de edición (si se pasa 'idOrdenProduccion' en la URL)
if (isset($_GET['idOrdenProduccion'])) {
    $id_orden_produccion = intval($_GET['idOrdenProduccion']); // Convertir a entero para mayor seguridad

    // Validar que el ID de la orden sea válido
    if (!$id_orden_produccion) {
        mostrar_error("Error: El ID de la orden de producción es inválido.");
    }
    // Solo mostramos el ID en el log de depuración si es necesario, no como respuesta
    // echo "Estás editando la orden de producción con ID: " . $id_orden_produccion;
} else {
    // Si no se pasa 'idOrdenProduccion', asumimos que es una nueva orden de producción
    $id_orden_produccion = null; // No hay ID para una nueva orden
    // echo "Estás creando una nueva orden de producción."; // Eliminado para simplificación
}

// Obtener los valores enviados por POST y validarlos
$id_producto = isset($_POST['id_producto']) ? intval($_POST['id_producto']) : null;
$id_tipo_material = isset($_POST['id_tipo_material']) ? intval($_POST['id_tipo_material']) : null;
$id_unidad = isset($_POST['id_unidad']) ? intval($_POST['id_unidad']) : null;

// Validar que todos los parámetros necesarios estén presentes
if (!$id_producto || !$id_tipo_material || !$id_unidad) {
    mostrar_error("Error: Faltan datos requeridos.");
}

// Conectar a la base de datos
$conexion = mysqli_connect("localhost:3306", "root", "", "mlinecl_pos_pyme_mline");

if (!$conexion) {
    mostrar_error("Error de conexión: " . mysqli_connect_error());
}

// Usar sentencia preparada para prevenir inyección SQL
$sql = "SELECT * FROM orden_produccion_materiales 
        WHERE id_producto = ? 
          AND id_tipo_material = ? 
          AND id_unidad = ? 
          AND id_orden_produccion = ?";

// Preparar la consulta solo si estamos en modo de edición
if ($id_orden_produccion !== null) {
    $stmt = mysqli_prepare($conexion, $sql);
    if (!$stmt) {
        mostrar_error("Error en la preparación de la consulta: " . mysqli_error($conexion));
    }

    // Vincular los parámetros a la consulta preparada
    mysqli_stmt_bind_param($stmt, "iiii", $id_producto, $id_tipo_material, $id_unidad, $id_orden_produccion);

    // Ejecutar la consulta
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Verificar si el insumo ya existe
    if (mysqli_num_rows($result) > 0) {
        echo "existe"; // El insumo ya está registrado en la base de datos
    } else {
        echo "no_existe"; // El insumo no existe en la base de datos
    }

    // Liberar recursos y cerrar la conexión
    mysqli_free_result($result);
    mysqli_close($conexion);
} else {
    // Si no hay ID (es una nueva orden), puedes realizar otro tipo de lógica aquí
    echo "no_existe"; // Para nuevas órdenes, asumimos que el insumo no existe
}
