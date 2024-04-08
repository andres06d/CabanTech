<?php
require 'conexion.php';

// Recuperar el ID Cabaña del formulario
$idCabaña = $_POST['idCabaña'];

// Consultar la programación de luces para la cabaña específica
$sql = "SELECT luces.Nombre,`encendido programado`.`ID VAlidar`, `encendido programado`.`Hora de Encendido`, `encendido programado`.`Hora de Apagado`, `encendido programado`.`Estado Actual`
        FROM luces, `encendido programado`
        WHERE luces.`ID Luz` = `encendido programado`.`ID LUZ` AND luces.`ID Cabaña` = $idCabaña";

$result = $conn->query($sql);

$programacionLuces = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $programacionLuces[] = $row;
    }
}

// Enviar datos como JSON al frontend
echo json_encode($programacionLuces);

$conn->close();
?>