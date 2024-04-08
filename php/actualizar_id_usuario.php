<?php
// Conexión a la base de datos
require 'conexion.php';

$idCabana = $_POST['idCabana'];
$idUsuario = $_POST['idUsuario'];

$sql = "UPDATE cabañas SET `ID usuario` = ? WHERE `ID Cabaña` = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ii', $idUsuario, $idCabana);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo 'ID de usuario actualizado con éxito';
} else {
    echo 'No se pudo actualizar el ID de usuario';
}

$stmt->close();
$conn->close();
?>
