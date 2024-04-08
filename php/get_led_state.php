<?php
require 'conexion.php';

$sql = 'SELECT LED1, LED2, LED3, LED4, LED5, LED6, LED7, LED8, LED9, LED10,
        LED11, LED12, LED13, LED14, LED15, LED16, LED17, LED18, LED19, LED20
        FROM led WHERE ID = 1';
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $ledState = array_values($row);
    $sum = array_sum($ledState);
    $count = count($ledState);
    echo $sum === 0 ? '0' : ($sum === $count ? '1' : '2');
} else {
    echo '0';
}

$conn->close();
?>
