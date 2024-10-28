<?php

// Incluye el archivo de configuración que contiene la conexión a la base de datos.
include('../app/config.php');

// Obtiene los valores de 'nombre' desde los parámetros GET de la URL.
$nombre_parqueo = $_GET['nombre_parqueo'];
$nombre_parqueo = strtoupper($nombre_parqueo);

$actividad_empresa = $_GET['actividad_empresa'];
$actividad_empresa = strtoupper($actividad_empresa);

$sucursal = $_GET['sucursal'];
$sucursal = strtoupper($sucursal);

$direccion = $_GET['direccion'];
$direccion = strtoupper($direccion);

$telefono = $_GET['telefono'];
$telefono = strtoupper($telefono);

$departamento_ciudad = $_GET['departamento_ciudad'];
$departamento_ciudad = strtoupper($departamento_ciudad);

$pais = $_GET['pais'];
$pais = strtoupper($pais);

// Establece la zona horaria para asegurar que la fecha y hora se registren correctamente.
date_default_timezone_set("America/Bogota");

// Obtiene la fecha y hora actual para registrar cuándo se creó el usuario.
$fechaHora = date("Y-m-d h:i:s");

// Prepara la consulta SQL para insertar un nuevo usuario en la tabla 'tb_usuarios'.
$sentencia = $pdo->prepare('INSERT INTO tb_informaciones
(nombre_parqueo,actividad_empresa,sucursal,direccion,telefono,departamento_ciudad,pais, fyh_creacion, estado)
VALUES ( :nombre_parqueo,:actividad_empresa,:sucursal,:direccion,:telefono,:departamento_ciudad,:pais,:fyh_creacion,:estado)');

// Asocia los valores a los parámetros de la consulta para evitar inyección SQL.
$sentencia->bindParam(':nombre_parqueo',$nombre_parqueo);
$sentencia->bindParam(':actividad_empresa',$actividad_empresa);
$sentencia->bindParam(':sucursal',$sucursal);
$sentencia->bindParam(':direccion',$direccion);
$sentencia->bindParam(':telefono',$telefono);
$sentencia->bindParam(':departamento_ciudad',$departamento_ciudad);
$sentencia->bindParam(':pais',$pais);
$sentencia->bindParam('fyh_creacion',$fechaHora);
$sentencia->bindParam('estado',$estado_del_registro);

// Ejecuta la consulta y verifica si fue exitosa.
if ($sentencia->execute()) {
    // Si la creación del usuario fue exitosa, muestra un mensaje de éxito.
    echo "Información registrada con exito";
    ?>
    <!-- Redirige automáticamente al usuario a la página principal (index.php) después de la creación. -->
    <script>location.href = "informaciones.php"</script>
    <?php
} else {
    // Si hubo un error al ejecutar la consulta, muestra un mensaje indicando el fallo.
    echo "No se pudo registrar la información";
}
