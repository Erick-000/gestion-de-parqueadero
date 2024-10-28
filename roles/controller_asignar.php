<?php

// Incluye el archivo de configuración que contiene la conexión a la base de datos.
include('../app/config.php');

$nombre = $_POST['nombre'];
$email = $_POST['email'];
$id_user = $_POST['id_user'];
$rol = $_POST['rol'];

// Establece la zona horaria para asegurar que la fecha y hora se registren correctamente.
date_default_timezone_set("America/Bogota");

// Obtiene la fecha y hora actual para registrar cuándo se realizó la actualización.
$fechaHora = date("Y-m-d h:i:s");

// Prepara la consulta SQL para actualizar los datos del usuario en la tabla `tb_usuarios`.
$sentencia = $pdo->prepare("UPDATE tb_usuarios SET
    rol = :rol
    WHERE id = :id");

// Asocia los valores obtenidos a los parámetros de la consulta para evitar inyección SQL.
$sentencia->bindParam(':rol', $rol);
$sentencia->bindParam(':id', $id_user);

// Ejecuta la consulta y verifica si fue exitosa.
if ($sentencia->execute()) {
    // Si la actualización fue exitosa, muestra un mensaje de éxito.
    echo "Se asignó el rol exitosamente";
    ?>
    <!-- Redirige automáticamente a la lista de usuarios después de la actualización. -->
    <script>location.href = "../roles/asignar.php";</script>
    <?php
} else {
    // Si hubo un error al ejecutar la consulta, muestra un mensaje de error.
    echo "Error al asignar el rol al usaurio";
}

