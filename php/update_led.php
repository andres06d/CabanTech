<?php
 
$ledNumber = $_POST['uno'];
$ledValue = $_POST['dos'];
 
require 'conexion.php';
    
$sql = "UPDATE led SET LED$ledNumber = $ledValue WHERE ID = 1";
echo $sql;
if ($conn->query($sql) === FALSE) {
    $response = array(
        'success' => false,
        'message' => 'Error al actualizar el estado del LED en la base de datos: ' . $conn->error
    );
} else {
    $response = array(
        'success' => true,
        'message' => 'Estado del LED actualizado correctamente.'
    );
}

echo json_encode($response);
exit();

$conn->close();
?>