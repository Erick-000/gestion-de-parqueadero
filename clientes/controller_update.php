<?php

// Incluye el archivo de configuración que contiene la conexión a la base de datos.
include('../app/config.php');

$nombre_cliente = $_GET['nombre_cliente'];
$cc_cliente = $_GET['cc_cliente'];
$placa_auto = $_GET['placa_auto'];
$id_cliente = $_GET['id_cliente'];

// Establece la zona horaria para asegurar que la fecha y hora se registren correctamente.
date_default_timezone_set("America/Bogota");

// Obtiene la fecha y hora actual para registrar cuándo se realizó la actualización.
$fechaHora = date("Y-m-d h:i:s");

$sentencia = $pdo->prepare("UPDATE tb_clientes SET
    nombre_cliente = :nombre_cliente,
    cc_cliente = :cc_cliente,
    placa_auto = :placa_auto,
    fyh_actualizacion = :fyh_actualizacion 
    WHERE id_cliente = :id_cliente");

$sentencia->bindParam(':nombre_cliente', $nombre_cliente);
$sentencia->bindParam(':cc_cliente', $cc_cliente);
$sentencia->bindParam(':placa_auto', $placa_auto);
$sentencia->bindParam('fyh_actualizacion', $fechaHora);
$sentencia->bindParam('id_cliente', $id_cliente);

if ($sentencia->execute()) {
    echo 'Se actualizó el cliente exitosamente';
?>
    <!-- Redirige automáticamente a la lista de usuarios después de la actualización. -->
    <script>
        location.href = "index.php";
    </script>
<?php
} else {
    echo 'error al registrar a la base de datos';
}
