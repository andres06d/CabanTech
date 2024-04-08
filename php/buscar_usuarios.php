<?php
 

// Obtén el valor del filtro desde la solicitud POST
$filtroNombre = $_POST['filtroNombre'];

require 'conexion.php';

$sql = "SELECT ID, Nombre, Apellidos FROM usuarios WHERE Nombre LIKE '%$filtroNombre%'";
$result = $conn->query($sql);

// Almacena los resultados en un array
$resultados = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $resultados[] = $row;
    }
}

// Envía los resultados como JSON
header('Content-Type: application/json');
echo json_encode($resultados);

$conn->close();
?>
