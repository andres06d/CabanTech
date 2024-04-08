<?php
require 'conexion.php';
// ID de la cabaña (puedes pasarlo desde el frontend)
$idCabaña = $_POST['idCabaña'];

// Consultar luces para la cabaña específica
$sql = "SELECT * FROM luces WHERE `ID Cabaña` = $idCabaña";
$result = $conn->query($sql);

$luces = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $luces[] = $row;
    }
}

// Enviar datos como JSON al frontend
echo json_encode($luces);

$conn->close();
?>