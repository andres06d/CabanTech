<?php
// obtener_datos.php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtener el ID de la cabaña desde la solicitud POST
    $idCabaña = $_POST["idCabaña"];

    // Tu código de conexión a la base de datos aquí
    require 'conexion.php';
    // Realizar la consulta
    $sql = "SELECT luces.Nombre, `historial de encendido`.`Estado`, `historial de encendido`.`Fecha`, `historial de encendido`.`Hora`
            FROM luces, `historial de encendido`
            WHERE `historial de encendido`.`ID LUZ` = luces.`ID Luz` AND luces.`ID Cabaña` = $idCabaña";

    // Ejecutar la consulta
    $result = $conn->query($sql);

    // Verificar si hay resultados
    if ($result->num_rows > 0) {
        // Inicializar un array para almacenar los resultados
        $ledChanges = array();

        // Obtener los resultados y agregarlos al array
        while ($row = $result->fetch_assoc()) {
            $ledChanges[] = $row;
        }

        // Devolver los resultados como JSON
        echo json_encode($ledChanges);
    } else {
        // No hay resultados
        echo json_encode(array());
    }

    // Cerrar la conexión a la base de datos
    $conn->close();
} else {
    // Si no es una solicitud POST, devolver un error
    echo json_encode(["error" => "Invalid request method"]);
}
?>
