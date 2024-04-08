<?php

include 'php/activar2.php';

// Crear la conexión
require 'php/conexion.php';

// Modificar la consulta SQL para seleccionar luces de la Cabaña con ID = 1
$sql = "SELECT * FROM `luces` WHERE `ID Cabaña` = 1";
$result = $conn->query($sql);

// Arreglo para almacenar los resultados
$estadoLuces = array();

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        // Verificar si la descripción de la luz es "encendido"
        $estadoLuces[] = ($row["Descripcion"] == "encendido") ? 1 : 0;
    }
} else {
    echo "0 results";
}

// Completar con ceros si el tamaño es menor a 20
while(count($estadoLuces) < 20) {
    $estadoLuces[] = 0;
}

// Asegurarse de que el arreglo tenga exactamente 20 elementos
$estadoLuces = array_slice($estadoLuces, 0, 20);

// Mostrar el estado de las luces
echo implode(', ', $estadoLuces);

$conn->close();
?>
