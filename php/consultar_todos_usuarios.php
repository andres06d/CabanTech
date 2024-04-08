<?php
// Conexión a la base de datos
require 'conexion.php';

// Consulta SQL para obtener los datos del usuario
$sql = "SELECT * FROM usuarios";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Retornar los datos como JSON
    $rows = array();
    while($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
    echo json_encode($rows);
} else {
    echo "Usuario no encontrado";
}

$conn->close();
?>
