<?php
 require 'conexion.php';
// Crear la consulta SQL
$sql = "SELECT * FROM `encendido programado`";

// Ejecutar la consulta y obtener el resultado
$result = $conn->query($sql);

// Obtener la fecha actual y la hora actual en formato DateTime
date_default_timezone_set('America/Bogota');
$currentDateTime = new DateTime();

// Recorrer los resultados y mostrarlos
while ($row = $result->fetch_assoc()) {
    $ledNumber = $row['ID LUZ'];
    $encendido = $row['Hora de Encendido'];
    $apagado = $row['Hora de Apagado'];
    $estado = $row['Estado Actual'];
    $estado2 = $row['Estado Final'];

    // Convertir las horas de encendido y apagado a objetos DateTime
    $startTime = DateTime::createFromFormat('H:i:s', $encendido);
    $endTime = DateTime::createFromFormat('H:i:s', $apagado);

    // Comparar las horas de encendido y apagado considerando la posibilidad de cambio de día
    if ($startTime <= $endTime) {
        // El rango de tiempo está dentro del mismo día
        $isWithinRange = $currentDateTime >= $startTime && $currentDateTime <= $endTime;
    } else {
        // El rango de tiempo abarca dos días diferentes
        $isWithinRange = $currentDateTime >= $startTime || $currentDateTime <= $endTime;
    }

    if ($isWithinRange && $estado == 1) {
        // La hora actual está dentro del rango startTime - endTime

        // Actualizar el estado del LED
        $updateSql = "UPDATE luces SET `Descripcion`  = 'encendido' WHERE `ID Luz`=  $ledNumber";
        $conn->query($updateSql);

        $estado2 = 1;
        $updateScheduleSql = "UPDATE `encendido programado` SET `Estado Final` = 1 WHERE `ID LUZ` = $ledNumber";
        $conn->query($updateScheduleSql);
    } else {
        if ($estado2 == 1) {
            $updateScheduleSql = "UPDATE `encendido programado` SET `Estado Final` = 0 WHERE `ID LUZ` = $ledNumber";
            $conn->query($updateScheduleSql);

            $updateSql3 =  "UPDATE luces SET `Descripcion`  = 'apagado' WHERE `ID Luz`=  $ledNumber";
            $conn->query($updateSql3);
        }
    }
}

// Cerrar la conexión
$conn->close();
?>
