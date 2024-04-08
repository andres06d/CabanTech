<?php
require 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Retrieve LED schedule data
    $sql = "SELECT `LED_#`, `HoraEncendido`, `HoraApagado`, `Estado` FROM `led_schedule`";
    $result = $conn->query($sql);

    $ledSchedule = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $ledSchedule[] = $row;
        }
    }

    $conn->close();

    header('Content-Type: application/json');
    echo json_encode($ledSchedule);
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Toggle LED state
    $ledNumber = $_POST['ledNumber'];
    $currentState = $_POST['currentState'];

    // Update the LED state in the database
    $sql2 = "UPDATE `led_schedule` SET `Estado` = '$currentState' WHERE `LED_#` = $ledNumber";
    $result = $conn->query($sql2);

    // Check if the update was successful
    if ($result) {
        // Get the updated state
        $updatedState = ($currentState == 1) ? 0 : 1;

        // Return the updated state as the response
        header('Content-Type: application/json');
        echo json_encode($updatedState);
    } else {
        // Error updating the LED state
        http_response_code(500);
        echo 'Error updating LED state';
    }

    // Close the connection
    $conn->close();
} else {
    // Invalid request method
    http_response_code(405);
    echo 'Invalid request method';
}
?>