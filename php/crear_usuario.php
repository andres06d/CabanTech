<?php
// Recibir datos del formulario
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$tipoDocumento = $_POST['tipoDocumento'];
$numeroDocumento = $_POST['numeroDocumento'];
$telefono = $_POST['telefono'];
$direccion = $_POST['direccion'];
$fechaNacimiento = $_POST['fechaNacimiento'];
$contraseña = $_POST['contraseña'];
$rol = $_POST['rol'];
$correo = $_POST['correo'];

// Conectar a la base de datos (ajusta la información de conexión según tu entorno)
require 'conexion.php';
// Insertar datos en la tabla usuarios
$sql = "INSERT INTO usuarios (Nombre, Apellidos, `Tipo de Documento`, `Numero de Documento`, `Fecha de Nacimiento`, Telefono, Direccion, Correo, Contraseña, Rol)
        VALUES ('$nombre', '$apellido', '$tipoDocumento', $numeroDocumento, '$fechaNacimiento', $telefono, '$direccion','$correo', '$contraseña', '$rol')";


echo($sql);


if ($conn->query($sql) === TRUE) {
    // Enviar respuesta JSON al cliente (puedes personalizar el formato según tus necesidades)
    echo json_encode(['success' => true, 'message' => 'Usuario creado con éxito']);
} else {
    // Enviar respuesta JSON al cliente en caso de error
    echo json_encode(['success' => false, 'message' => 'Error al crear usuario: ' . $conn->error]);
}

// Cerrar la conexión a la base de datos
$conn->close();
?>