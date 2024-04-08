<?php
// Conexión a la base de datos
require 'conexion.php';

$sql = "SELECT * FROM cabañas";
$resultado = $conn->query($sql);

$cabañas = array();
while ($fila = $resultado->fetch_assoc()) {
    $cabañas[] = $fila;
}

echo json_encode($cabañas);

$conn->close();
?>
