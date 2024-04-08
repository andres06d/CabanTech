<?php
// Verificar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $horaInicio = $_POST['horaInicio'];
    $horaFinal = $_POST['horaFinal'];
    $activarControl = isset($_POST['activarControl']) ? 1 : 0;

    require 'conexion.php';

    // Preparar la consulta
    $query = "UPDATE eventos SET hora_inicio = ?, hora_final = ?, activo = ? WHERE id = 1";
    $statement = $conn->prepare($query);

    // Vincular los parámetros de la consulta
    $statement->bind_param('ssi', $horaInicio, $horaFinal, $activarControl);

    // Ejecutar la consulta
    $statement->execute();

    // Cerrar la conexión
    $statement->close();
    $conn->close();

    // Devolver una respuesta exitosa
    echo json_encode(['success' => true]);
} else {
    // El formulario no ha sido enviado correctamente
    echo json_encode(['success' => false]);
}
?>