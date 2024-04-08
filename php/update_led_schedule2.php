<?php
// Obtener el número de LED enviado por la solicitud
$ledNumber = $_POST['ledNumber'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pas2";

try {
    // Crear la conexión a la base de datos
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8mb4", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Obtener el estado actual del LED
    $selectQuery = "SELECT Estado FROM led_schedule WHERE `LED_#` = $ledNumber";
    $selectStmt = $conn->query($selectQuery);
    $currentEstado = $selectStmt->fetchColumn();

    // Calcular el nuevo estado del LED
    $newEstado = $currentEstado ? 0 : 1;

    // Actualizar el estado del LED en la base de datos
    $updateQuery = "UPDATE led_schedule SET Estado = $newEstado WHERE `LED_#` = $ledNumber";
    $updateStmt = $conn->query($updateQuery);

    // Verificar si se realizó la actualización correctamente
    $updatedRows = $updateStmt->rowCount();
    if ($updatedRows > 0) {
        // Obtener el nuevo estado del LED
        $selectQuery = "SELECT Estado FROM led_schedule WHERE `LED_#` = $ledNumber";
        $selectStmt = $conn->query($selectQuery);
        $newEstado = $selectStmt->fetchColumn();

        // Preparar la respuesta con el nuevo estado del LED
        $response = ['success' => true, 'Estado' => $newEstado];
        echo json_encode($response);
    } else {
        // En caso de que no se haya actualizado ningún registro, enviar una respuesta de error al cliente
        $response = ['success' => false, 'message' => 'No se pudo actualizar el estado del LED.'];
        echo json_encode($response);
    }
} catch (PDOException $e) {
    // En caso de error, enviar una respuesta de error al cliente
    $response = ['success' => false, 'message' => 'Hubo un error al actualizar el estado del LED.'];
    echo json_encode($response);
}
?>
