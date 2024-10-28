<?php

// Incluye el archivo de configuración que contiene la conexión a la base de datos.
include('../app/config.php');

$nro_espacio = $_GET['nro_espacio'];
$estado_espacio = $_GET['estado_espacio'];
$obs = $_GET['obs'];

// Establece la zona horaria para asegurar que la fecha y hora se registren correctamente.
date_default_timezone_set("America/Bogota");

// Obtiene la fecha y hora actual para registrar cuándo se creó el usuario.
$fechaHora = date("Y-m-d h:i:s");

// Prepara la consulta SQL para insertar un nuevo usuario en la tabla 'tb_usuarios'.
$sentencia = $pdo->prepare("INSERT INTO tb_mapeos 
    (nro_espacio, estado_espacio, obs, fyh_creacion, estado) 
    VALUES (:nro_espacio, :estado_espacio, :obs, :fyh_creacion, :estado)");

// Asocia los valores a los parámetros de la consulta para evitar inyección SQL.
$sentencia->bindParam('nro_espacio', $nro_espacio);
$sentencia->bindParam('estado_espacio', $estado_espacio);
$sentencia->bindParam('obs', $obs);
$sentencia->bindParam('fyh_creacion', $fechaHora);
$sentencia->bindParam('estado',$estado_del_registro);

// Ejecuta la consulta y verifica si fue exitosa.
if ($sentencia->execute()) {
    // Si la creación del usuario fue exitosa, muestra un mensaje de éxito.
    echo "Espacio creado con exito";
    ?>
    <!-- Redirige automáticamente al usuario a la página principal (index.php) después de la creación. -->
    <script> location.href = "mapeo-de-vehiculos.php";</script>
    <?php
} else {
    // Si hubo un error al ejecutar la consulta, muestra un mensaje indicando el fallo.
    echo "No se pudo crear el espacio";
}
