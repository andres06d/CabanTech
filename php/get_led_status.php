<?php
require 'conexion.php';

// Consultar el estado de los LED en la base de datos
$sql = "SELECT LED1, LED2, LED3, LED4, LED5, LED6, LED7, LED8, LED9, LED10, LED11, LED12, LED13, LED14, LED15, LED16, LED17, LED18, LED19, LED20 FROM led WHERE ID = 1";
$result = $conn->query($sql);

$ledStatus = array(); // Array para almacenar el estado de los LED

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Agregar el estado de los LED al array
    for ($i = 1; $i <= 20; $i++) {
        $ledStatus[$i] = $row["LED$i"];
    }
}

// Cerrar la conexión a la base de datos
$conn->close();

// Devolver el estado actual de los LED al cliente
$response = array(
    'success' => true,
    'ledStatus' => $ledStatus
);
echo json_encode($response);
?>
