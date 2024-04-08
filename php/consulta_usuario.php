<?php
// Conexión a la base de datos
require 'conexion.php';
// Obtener el ID del usuario
$usuario_id = $_POST['usuario_id'];

// Consulta SQL para obtener los datos del usuario
$sql = "SELECT * FROM usuarios WHERE ID = $usuario_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Retornar los datos como JSON
    $row = $result->fetch_assoc();
    echo json_encode($row);
} else {
    echo "Usuario no encontrado";
}

$conn->close();
?>
