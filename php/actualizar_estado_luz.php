<?php
// actualizar_estado_luz.php

// Check if the request is a POST request
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve the parameters from the POST request
    $idValidar = $_POST["idValidar"];
    $newState = $_POST["newState"];

    // Your database connection code goes here
    require 'conexion.php';
    // Update the Estado Actual in the database
    $sql = "UPDATE `encendido programado` SET `Estado Actual` = $newState WHERE `ID VAlidar` = $idValidar";

    if ($conn->query($sql) === TRUE) {
        // The update was successful
        echo json_encode(["status" => "success", "message" => "Estado actualizado correctamente"]);
    } else {
        // There was an error with the update
        echo json_encode(["status" => "error", "message" => "Error al actualizar el estado: " . $conn->error]);
    }

    // Close the database connection
    $conn->close();
} else {
    // If it's not a POST request, return an error
    echo json_encode(["status" => "error", "message" => "Invalid request method"]);
}
?>