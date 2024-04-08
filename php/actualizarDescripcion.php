<?php
require 'conexion.php';

// Datos enviados desde el frontend
$idLuz = $_POST['idLuz'];
$nuevaDescripcion = $_POST['descripcion'];

// Actualizar la descripción en la base de datos
$sql = "UPDATE luces SET Descripcion = '$nuevaDescripcion' WHERE `ID Luz` = $idLuz";
$result = $conn->query($sql);

// Manejar la respuesta (puedes ajustar según tus necesidades)
if ($result) {
    echo "Actualización exitosa";
} else {
    echo "Error al actualizar: " . $conn->error;
}

$conn->close();
?>