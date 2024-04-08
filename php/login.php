<?php
// Configuración de conexión a la base de datos


// Datos de inicio de sesión enviados desde el formulario

use function PHPSTORM_META\sql_injection_subst;


require 'conexion.php';

$email = $_POST['email'];
$password = $_POST['password'];

// Consulta para verificar las credenciales de inicio de sesión
$sql = "SELECT * FROM usuarios WHERE Correo = '$email' AND Contraseña = '$password'";
echo ($sql);
$result = $conn->query($sql);

// Verificar si se encontraron coincidencias
if ($result->num_rows == 1) {
    // Inicio de sesión exitoso
    $row = $result->fetch_assoc();
    $nombre = $row['Nombre'];
    $idUsuario = $row['ID'];
    $apellidos = $row['Apellidos'];
    $telefono = $row['Telefono'];
    $correo = $row['Correo'];
    $tipoDocumento = $row['Tipo de Documento'];
    $numeroDocumento = $row['Numero de Documento'];
    $fechaNacimiento = $row['Fecha de Nacimiento'];
    $direccion = $row['Direccion'];
    $rol = $row['Rol'];

    // Después de verificar las credenciales y antes de redirigir
    setcookie('session', 'logged_in', time() + 3600, '/');

    $sqlCabañas = "SELECT * FROM cabañas WHERE `ID usuario` = $idUsuario";
    $resultCabañas = $conn->query($sqlCabañas);

    $cabañas = array();
    while ($rowCabaña = $resultCabañas->fetch_assoc()) {
        $cabañas[] = array(
            "ID Cabaña" => $rowCabaña['ID Cabaña'],
            "Nombre Cabaña" => $rowCabaña['Nombre'],
            "Ubicacion Cabaña" => $rowCabaña['Ubicacion']
        );
    }
    $cabañaSeleccionada = reset($cabañas);

    $datos_usuario = array(
        "nombre" => $nombre,
        "apellidos" => $apellidos,
        "telefono" => $telefono,
        "correo" => $correo,
        "cabañas" => $cabañas,
        "id usuario" => $idUsuario,
        "Tipo de documento" => $tipoDocumento,
        "Numero de documento" => $numeroDocumento,
        "Fecha de nacimiento" => $fechaNacimiento,
        "Direccion" => $direccion,
        "Rol" => $rol,
        "cabañaSeleccionada" => $cabañaSeleccionada
    );




    // convertir el array en una cadena JSON
    $datos_usuario_json = json_encode($datos_usuario);

    // establecer una cookie que expira en una hora
    setcookie("datos_usuario", $datos_usuario_json, time() + 3600, '/');


    $response = array('message' => 'Inicio de sesión exitoso');
    echo json_encode($response);
} else {
    // Credenciales de inicio de sesión inválidas
    $response = array('error' => 'Credenciales de inicio de sesión inválidas');
    http_response_code(401); // Código de respuesta HTTP 401 - Unauthorized
    echo json_encode($response);
}

$conn->close();
