<?php
// Recibir datos del formulario
$nombreLuz = $_POST['nombreLuz'];
$idCabaña = $_POST['idCabaña'];

require 'conexion.php';
// Insertar datos en la tabla luces
$sql = "INSERT INTO luces (`ID Cabaña`, Nombre, Descripcion)
        VALUES ($idCabaña, '$nombreLuz', 'apagado')";

if ($conn->query($sql) === TRUE) {
    // Enviar respuesta JSON al cliente (puedes personalizar el formato según tus necesidades)
    echo json_encode(['success' => true, 'message' => 'Luz creada con éxito']);
} else {
    // Enviar respuesta JSON al cliente en caso de error
    echo json_encode(['success' => false, 'message' => 'Error al crear luz: ' . $conn->error]);
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
