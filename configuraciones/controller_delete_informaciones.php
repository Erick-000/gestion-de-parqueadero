<?php

// Incluye el archivo de configuración que contiene la conexión a la base de datos.
include('../app/config.php');

// Obtiene los valores de 'nombre' desde los parámetros GET de la URL.
$id_informacion = $_GET['id_informacion'];

// Define el nuevo estado del usuario como "0", indicando que está inactivo.
$estado_inactivo = "0";

// Establece la zona horaria para asegurar que la fecha y hora se registren correctamente.
date_default_timezone_set("America/Bogota");

// Obtiene la fecha y hora actual para registrar cuándo se creó el usuario.
$fechaHora = date("Y-m-d h:i:s");

// Prepara la consulta SQL para insertar un nuevo usuario en la tabla 'tb_usuarios'.
$sentencia = $pdo->prepare("UPDATE tb_informaciones SET
    estado = :estado,
    fyh_eliminacion = :fyh_eliminacion 
    WHERE id_informacion = :id_informacion");

// Asocia los valores a los parámetros de la consulta para evitar inyección SQL.
$sentencia->bindParam(':estado', $estado_inactivo);
$sentencia->bindParam('fyh_eliminacion', $fechaHora);
$sentencia->bindParam('id_informacion', $id_informacion);

// Ejecuta la consulta y verifica si fue exitosa.
if ($sentencia->execute()) {
    // Si la creación del usuario fue exitosa, muestra un mensaje de éxito.
    echo "Información eliminada con exito";
?>
    <!-- Redirige automáticamente al usuario a la página principal (index.php) después de la creación. -->
    <script>
        location.href = "informaciones.php"
    </script>
<?php
} else {
    // Si hubo un error al ejecutar la consulta, muestra un mensaje indicando el fallo.
    echo "No se pudo eliminar la información";
}