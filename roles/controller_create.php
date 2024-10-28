<?php

// Incluye el archivo de configuración que contiene la conexión a la base de datos.
include('../app/config.php');

// Obtiene los valores de 'nombre' desde los parámetros GET de la URL.
$nombre = $_GET['nombre'];

// Establece la zona horaria para asegurar que la fecha y hora se registren correctamente.
date_default_timezone_set("America/Bogota");

// Obtiene la fecha y hora actual para registrar cuándo se creó el usuario.
$fechaHora = date("Y-m-d h:i:s");

// Prepara la consulta SQL para insertar un nuevo usuario en la tabla 'tb_usuarios'.
$sentencia = $pdo->prepare("INSERT INTO tb_roles 
    (nombre, fyh_creacion, estado) 
    VALUES (:nombre, :fyh_creacion, :estado)");

// Asocia los valores a los parámetros de la consulta para evitar inyección SQL.
$sentencia->bindParam('nombre', $nombre);
$sentencia->bindParam('fyh_creacion', $fechaHora);
$sentencia->bindParam('estado',$estado_del_registro);

// Ejecuta la consulta y verifica si fue exitosa.
if ($sentencia->execute()) {
    // Si la creación del usuario fue exitosa, muestra un mensaje de éxito.
    echo "Rol creado con éxito";
    ?>
    <!-- Redirige automáticamente al usuario a la página principal (index.php) después de la creación. -->
    <script>location.href = "index.php"</script>
    <?php
} else {
    // Si hubo un error al ejecutar la consulta, muestra un mensaje indicando el fallo.
    echo "No se pudo crear el rol";
}
