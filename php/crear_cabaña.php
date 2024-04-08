<?php
// Recibir datos del formulario
$id = $_POST['usuario'];
$nombre = $_POST['Nombre'];
$ubicacion = $_POST['Ubicacion'];

require 'conexion.php';
// Insertar datos en la tabla luces
$sql = "INSERT INTO cabañas (`ID usuario`, Nombre, Ubicacion)
        VALUES ($id, '$nombre', '$ubicacion')";

if ($conn->query($sql) === TRUE) {
    // Enviar respuesta JSON al cliente (puedes personalizar el formato según tus necesidades)
    echo json_encode(['success' => true, 'message' => 'Cabaña creada con éxito']);
} else {
    // Enviar respuesta JSON al cliente en caso de error
    echo json_encode(['success' => false, 'message' => 'Error al crear Cabaña : ' . $conn->error]);
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
