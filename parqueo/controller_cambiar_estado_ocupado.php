<?php
// Incluye el archivo de configuración que contiene la conexión a la base de datos.
include('../app/config.php');

// Obtiene los datos enviados por medio de la URL (GET).
$cuviculo = $_GET['cuviculo']; // Cuviculo del usuario a actualizar.
$estado_espacio = "OCUPADO";


// Establece la zona horaria para asegurar que la fecha y hora se registren correctamente.
date_default_timezone_set("America/Bogota");

// Obtiene la fecha y hora actual para registrar cuándo se realizó la actualización.
$fechaHora = date("Y-m-d h:i:s");

// Prepara la consulta SQL para actualizar los datos del usuario en la tabla `tb_usuarios`.
$sentencia = $pdo->prepare("UPDATE tb_mapeos SET
    estado_espacio = :estado_espacio,
    fyh_actualizacion = :fyh_actualizacion 
    WHERE id_map = :id_map");

// Asocia los valores obtenidos a los parámetros de la consulta para evitar inyección SQL.
$sentencia->bindParam(':estado_espacio', $estado_espacio);
$sentencia->bindParam(':fyh_actualizacion', $fechaHora);
$sentencia->bindParam(':id_map', $cuviculo);

// Ejecuta la consulta y verifica si fue exitosa.
if ($sentencia->execute()) {
    // Si la actualización fue exitosa, muestra un mensaje de éxito.
    echo "Se actualizó el cuviculo exitosamente";
    ?>
    <!-- Redirige automáticamente a la lista de usuarios después de la actualización. -->
   <!-- <script>location.href = "../usuarios/";</script> -->
    <?php
} else {
    // Si hubo un error al ejecutar la consulta, muestra un mensaje de error.
    echo "Error al actualizar el registro";
}
