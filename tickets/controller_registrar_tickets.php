<?php

include('../app/config.php');

$nombre_cliente = $_GET['nombre_cliente'];
$cc_cliente = $_GET['cc_cliente'];
$cuviculo = $_GET['cuviculo'];
$fecha_ingreso = $_GET['fecha_ingreso'];
$hora_ingreso = $_GET['hora_ingreso'];
$user_sesion = $_GET['user_sesion'];

// Establece la zona horaria para asegurar que la fecha y hora se registren correctamente.
date_default_timezone_set("America/Bogota");

// Obtiene la fecha y hora actual para registrar cuándo se creó el usuario.
$fechaHora = date("Y-m-d h:i:s");

$sentencia = $pdo->prepare('INSERT INTO tb_tickets
(nombre_cliente,cc_cliente,cuviculo,fecha_ingreso,hora_ingreso,user_sesion, fyh_creacion, estado)
VALUES ( :nombre_cliente,:cc_cliente,:cuviculo,:fecha_ingreso,:hora_ingreso,:user_sesion,:fyh_creacion,:estado)');

$sentencia->bindParam(':nombre_cliente', $nombre_cliente);
$sentencia->bindParam(':cc_cliente', $cc_cliente);
$sentencia->bindParam(':cuviculo', $cuviculo);
$sentencia->bindParam(':fecha_ingreso', $fecha_ingreso);
$sentencia->bindParam(':hora_ingreso', $hora_ingreso);
$sentencia->bindParam(':user_sesion', $user_sesion);
$sentencia->bindParam('fyh_creacion', $fechaHora);
$sentencia->bindParam('estado', $estado_del_registro);

if ($sentencia->execute()) {
    echo 'success';
    ?>
    <script> location.href = "tickets/generar_ticket.php"; </script>
    <?php
} else {
    echo 'error al registrar a la base de datos';
}
