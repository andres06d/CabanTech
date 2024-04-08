<?php
// Establecer la conexión a la base de datos
require 'conexion.php';
// Consultar la tabla de cambios de LED
$sql = "SELECT LED_Numero, Estado, Fecha, Hora FROM led_cambios";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $ledChanges = array();

    // Recorrer los resultados y almacenarlos en un arreglo
    while ($row = $result->fetch_assoc()) {
        $ledChange = array(
            'LED_Numero' => $row['LED_Numero'],
            'Estado' => $row['Estado'],
            'Fecha' => $row['Fecha'],
            'Hora' => $row['Hora']
        );

        $ledChanges[] = $ledChange;
    }

    // Devolver los cambios de LED como respuesta en formato JSON
    header('Content-Type: application/json');
    echo json_encode($ledChanges);
} else {
    echo "No se encontraron cambios de LED";
}

$conn->close();
?>
