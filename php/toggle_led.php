<?php
require 'conexion.php';

if (isset($_POST['state'])) {
    $state = $_POST['state'];
    $sql = 'UPDATE led SET LED1 = '.$state.', LED2 = '.$state.', LED3 = '.$state.', LED4 = '.$state.', LED5 = '.$state.',
            LED6 = '.$state.', LED7 = '.$state.', LED8 = '.$state.', LED9 = '.$state.', LED10 = '.$state.',
            LED11 = '.$state.', LED12 = '.$state.', LED13 = '.$state.', LED14 = '.$state.', LED15 = '.$state.',
            LED16 = '.$state.', LED17 = '.$state.', LED18 = '.$state.', LED19 = '.$state.', LED20 = '.$state.'
            WHERE ID = 1';
    
    echo $conn->query($sql) === TRUE ? 'Estado del LED actualizado correctamente.' : 'Error al actualizar el estado del LED: ' . $conn->error;
}

$conn->close();
?>
