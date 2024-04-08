<?php
require 'conexion.php';

// Recuperar datos del formulario
$startTime = $_POST['startTime'];
$endTime = $_POST['endTime'];
$state = $_POST['state'];
$leds = json_decode($_POST['leds']); // Decodificar la cadena JSON

// Insertar o actualizar datos en la tabla
foreach ($leds as $led) {
    // Verificar si ya existe un registro para este ID LUZ
    $checkIfExistsStmt = $conn->prepare("SELECT `ID VAlidar` FROM `encendido programado` WHERE `ID LUZ` = ?");
    $checkIfExistsStmt->bind_param("i", $led);
    $checkIfExistsStmt->execute();
    $checkIfExistsStmt->store_result();

    if ($checkIfExistsStmt->num_rows > 0) {
        // Actualizar el registro existente
        $stmt = $conn->prepare("UPDATE `encendido programado` SET `Hora de Encendido` = ?, `Hora de Apagado` = ?, `Estado Actual` = ?, `Estado Final` = ? WHERE `ID LUZ` = ?");
        $stmt->bind_param("ssisi", $startTime, $endTime, $state, $state, $led);
        $stmt->execute();
    } else {
        // Insertar un nuevo registro
        $stmt = $conn->prepare("INSERT INTO `encendido programado` (`ID LUZ`, `Hora de Encendido`, `Hora de Apagado`, `Estado Actual`, `Estado Final`) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("issii", $led, $startTime, $endTime, $state, $state);
        $stmt->execute();
    }

    $checkIfExistsStmt->close();
    $stmt->close();
}

$conn->close();
?>
