<?php
// Incluye el archivo de configuración que contiene la conexión a la base de datos.
include('../app/config.php');

// Obtiene los datos enviados por medio de la URL (GET).
$nombres = $_GET['nombres']; // Nombre del usuario a actualizar.
$email = $_GET['email']; // Email del usuario a actualizar.
$password_user = $_GET['password_user']; // Contraseña del usuario a actualizar.
$id_user = $_GET['id_user']; // ID del usuario a actualizar.

// Establece la zona horaria para asegurar que la fecha y hora se registren correctamente.
date_default_timezone_set("America/Bogota");

// Obtiene la fecha y hora actual para registrar cuándo se realizó la actualización.
$fechaHora = date("Y-m-d h:i:s");

// Prepara la consulta SQL para actualizar los datos del usuario en la tabla `tb_usuarios`.
$sentencia = $pdo->prepare("UPDATE tb_usuarios SET
    nombres = :nombres,
    email = :email,
    password_user = :password_user,
    fyh_actualizacion = :fyh_actualizacion 
    WHERE id = :id");

// Asocia los valores obtenidos a los parámetros de la consulta para evitar inyección SQL.
$sentencia->bindParam(':nombres', $nombres);
$sentencia->bindParam(':email', $email);
$sentencia->bindParam(':password_user', $password_user);
$sentencia->bindParam(':fyh_actualizacion', $fechaHora);
$sentencia->bindParam(':id', $id_user);

// Ejecuta la consulta y verifica si fue exitosa.
if ($sentencia->execute()) {
    // Si la actualización fue exitosa, muestra un mensaje de éxito.
    echo "Se actualizó el usuario exitosamente";
    ?>
    <!-- Redirige automáticamente a la lista de usuarios después de la actualización. -->
    <script>location.href = "../usuarios/";</script>
    <?php
} else {
    // Si hubo un error al ejecutar la consulta, muestra un mensaje de error.
    echo "Error al actualizar el registro";
}
