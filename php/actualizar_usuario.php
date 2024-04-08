<?php
require 'conexion.php';
// Obtener datos del formulario
$usuarioID = $_POST['usuario_id'];
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$tipoDocumento = $_POST['tipoDocumento'];
$numeroDocumento = $_POST['numeroDocumento'];
$telefono = $_POST['telefono'];
$direccion = $_POST['direccion'];
$fechaNacimiento = $_POST['fechaNacimiento'];
$contrasena = $_POST['contrasena'];

// Actualizar la información del usuario en la base de datos
$sql = "UPDATE usuarios SET 
        Nombre = '$nombre',
        Apellidos = '$apellidos',
        `Tipo de Documento` = '$tipoDocumento',
        `Numero de Documento` = '$numeroDocumento',
        Telefono = '$telefono',
        Direccion = '$direccion',
        `Fecha de Nacimiento` = '$fechaNacimiento',
        Contraseña = '$contrasena'
        WHERE ID = $usuarioID";

if ($conn->query($sql) === TRUE) {
    echo "Información del usuario actualizada con éxito";
} else {
    echo "Error al actualizar la información del usuario: " . $conn->error;
}

$conn->close();
?>