<?php

// Incluye el archivo de configuración que contiene la conexión a la base de datos.
include('../app/config.php');

$cantidad = $_GET['cantidad'];
$detalle = $_GET['detalle'];
$precio = $_GET['precio'];

// Establece la zona horaria para asegurar que la fecha y hora se registren correctamente.
date_default_timezone_set("America/Bogota");

// Obtiene la fecha y hora actual para registrar cuándo se creó el usuario.
$fechaHora = date("Y-m-d h:i:s");

$sentencia = $pdo->prepare('INSERT INTO tb_precios
(cantidad,detalle,precio, fyh_creacion, estado)
VALUES ( :cantidad,:detalle,:precio,:fyh_creacion,:estado)');

$sentencia->bindParam(':cantidad', $cantidad);
$sentencia->bindParam(':detalle', $detalle);
$sentencia->bindParam(':precio', $precio);
$sentencia->bindParam('fyh_creacion', $fechaHora);
$sentencia->bindParam('estado', $estado_del_registro);

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
