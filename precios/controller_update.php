<?php

// Incluye el archivo de configuración que contiene la conexión a la base de datos.
include('../app/config.php');

$cantidad = $_GET['cantidad'];
$detalle = $_GET['detalle'];
$precio = $_GET['precio'];
$id_precio = $_GET['id_precio'];

// Establece la zona horaria para asegurar que la fecha y hora se registren correctamente.
date_default_timezone_set("America/Bogota");

// Obtiene la fecha y hora actual para registrar cuándo se creó el usuario.
$fechaHora = date("Y-m-d h:i:s");

// Prepara la consulta SQL para actualizar los datos del usuario en la tabla `tb_usuarios`.
$sentencia = $pdo->prepare("UPDATE tb_precios SET
    cantidad = :cantidad,
    detalle = :detalle,
    precio = :precio,
    fyh_actualizacion = :fyh_actualizacion 
    WHERE id_precio = :id_precio");

// Asocia los valores obtenidos a los parámetros de la consulta para evitar inyección SQL.
$sentencia->bindParam(':cantidad', $cantidad);
$sentencia->bindParam(':detalle', $detalle);
$sentencia->bindParam(':precio', $precio);
$sentencia->bindParam(':fyh_actualizacion', $fechaHora);
$sentencia->bindParam(':id_precio', $id_precio);

if ($sentencia->execute()) {
    echo 'success';
?>
    <!-- Redirige automáticamente al usuario a la página principal (index.php) después de la creación. -->
    <script>
        location.href = "../precios/index.php"
    </script>
<?php

} else {
    echo 'error al registrar a la base de datos';
}
