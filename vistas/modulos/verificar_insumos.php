<?php
// verificar_insumo.php

require_once "conexion.php";

// Obtener el id_producto enviado a través del POST
$idProducto = $_POST['id_producto'];

// Consultar en la base de datos si el insumo con el id_producto ya existe
$sql = "SELECT * FROM orden_produccion_materiales WHERE id_producto = :id_producto";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id_producto', $idProducto);
$stmt->execute();

// Verificar si se encontró algún resultado
if ($stmt->rowCount() > 0) {
    echo "existe"; // El insumo ya existe
} else {
    echo "no_existe"; // El insumo no existe
}
