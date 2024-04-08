<?php
// Obtener los datos enviados por el formulario
$startTime = $_POST['startTime'];
$endTime = $_POST['endTime'];
$state = $_POST['state'];
$leds = $_POST['leds'];

// Realizar las operaciones necesarias para actualizar los registros en la base de datos
// Aquí debes implementar tu lógica para actualizar la tabla 'led_schedule' con los nuevos valores

// Ejemplo de conexión a la base de datos utilizando PDO
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pas2";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8mb4", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
    // Actualizar los registros en la base de datos
    if (strpos($leds, ',') !== false) {
        // Caso en que se envían múltiples LEDs separados por comas
        $ledsArray = explode(',', $leds);
        foreach ($ledsArray as $led) {
            $sql = "UPDATE led_schedule SET HoraEncendido = '$startTime', HoraApagado = '$endTime', Estado = '$state' WHERE `LED_#` = $led";
            echo($sql);
            $stmt = $conn->query($sql);
        }
    } else {
        // Caso en que se envía un solo LED sin comas
        $sql = "UPDATE led_schedule SET HoraEncendido = '$startTime', HoraApagado = '$endTime', Estado = '$state' WHERE `LED_#` = $leds";
        $stmt = $conn->query($sql);
    }

    // Verificar si se realizó la actualización correctamente
    $updatedRows = $stmt->rowCount();
    if ($updatedRows > 0) {
        // Enviar una respuesta de éxito al cliente
        $response = ['success' => true, 'message' => 'Los cambios se guardaron correctamente.'];
        echo json_encode($response);
    } else {
        // En caso de que no se haya actualizado ningún registro, enviar una respuesta de error al cliente
        $response = ['success' => false, 'message' => 'No se pudo actualizar ningún registro.'];
        echo json_encode($response);
    }
} catch (PDOException $e) {
    // En caso de error, enviar una respuesta de error al cliente
    $response = ['success' => false, 'message' => 'Hubo un error al guardar los cambios.'];
    echo json_encode($response);
}
?>