<?php

// Incluye el archivo de configuración que contiene la conexión a la base de datos.
include('../app/config.php');

// Obtiene el ID del usuario a eliminar (desactivar) desde la URL (GET).
$id_rol = $_GET['id_rol'];

// Define el nuevo estado del usuario como "0", indicando que está inactivo.
$estado_inactivo = "0";

// Establece la zona horaria para asegurar que la fecha y hora se registren correctamente.
date_default_timezone_set("America/Bogota");

// Obtiene la fecha y hora actual para registrar cuándo se realizó la desactivación.
$fechaHora = date("Y-m-d h:i:s");

// Prepara la consulta SQL para actualizar el estado del usuario a inactivo y registrar la fecha de eliminación.
$sentencia = $pdo->prepare("UPDATE tb_roles SET
    estado = :estado,
    fyh_eliminacion = :fyh_eliminacion 
    WHERE id_rol = :id_rol");

// Asocia los valores a los parámetros de la consulta para evitar inyección SQL.
$sentencia->bindParam(':estado', $estado_inactivo);
$sentencia->bindParam(':fyh_eliminacion', $fechaHora);
$sentencia->bindParam(':id_rol', $id_rol);

// Ejecuta la consulta y verifica si fue exitosa.
if ($sentencia->execute()) {
    // Si la desactivación fue exitosa, muestra un mensaje de éxito.
    echo "Se eliminó el rol exitosamente";
    ?>
    <!-- Redirige automáticamente a la lista de usuarios después de la eliminación. -->
    <script>location.href = "../roles/";</script>
    <?php
} else {
    // Si hubo un error al ejecutar la consulta, muestra un mensaje de error.
    echo "Error al eliminar el rol";
}
