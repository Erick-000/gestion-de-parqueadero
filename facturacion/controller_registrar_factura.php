<?php

include('../app/config.php');
include('literal.php');

// Establece la zona horaria para asegurar que la fecha y hora se registren correctamente.
date_default_timezone_set("America/Bogota");

// Obtiene la fecha y hora actual para registrar cuándo se creó el usuario.
$fechaHora = date("Y-m-d h:i:s");
$dia = date("d");
$mes = date("m");
if ($mes == "1") $mes = "Enero";
if ($mes == "2") $mes = "Febrero";
if ($mes == "3") $mes = "Marzo";
if ($mes == "4") $mes = "Abril";
if ($mes == "5") $mes = "Mayo";
if ($mes == "6") $mes = "Junio";
if ($mes == "7") $mes = "Julio";
if ($mes == "8") $mes = "Agosto";
if ($mes == "9") $mes = "Septiembre";
if ($mes == "10") $mes = "Octubre";
if ($mes == "11") $mes = "Noviembre";
if ($mes == "12") $mes = "Diciembre";
$anio = date("Y");


$id_informacion = $_GET['id_informacion'];
$nro_factura = $_GET['nro_factura'];
$id_cliente = $_GET['id_cliente'];


//Recuperar el departamento o ciudad de la tabla informaciones

// Prepara una consulta para obtener todos los usuarios que estén activos (estado = '1').
$query_info = $pdo->prepare("SELECT * FROM tb_informaciones WHERE id_informacion = '$id_informacion' AND estado = '1' ");

// Ejecuta la consulta.
$query_info->execute();

// Obtiene todos los resultados de la consulta y los almacena en un array.
$infos = $query_info->fetchAll(PDO::FETCH_ASSOC);

// Itera sobre cada usuario obtenido de la base de datos.
foreach ($infos as $info) {
    // Extrae los datos de cada usuario.
    $departamento = $info['departamento_ciudad'];
}
$fecha_factura = $departamento . ", " . $dia . " de " . $mes . " del " . $anio;
$fecha_ingreso = $_GET['fecha_ingreso'];
$hora_ingreso = $_GET['hora_ingreso'];


$fecha_salida = date('Y/m/d');

$fecha_salida_para_calcular = date('Y/m/d');

$hora_salida = date('H:i');

//Calcula la diferencia entre el tiempo de entrada y salida
$fecha_hora_ingreso = $fecha_ingreso . " " . $hora_ingreso;
$fecha_hora_salida = $fecha_salida . " " . $hora_salida;

$fecha_hora_ingreso = new DateTime($fecha_hora_ingreso);
$fecha_hora_salida = new DateTime($fecha_hora_salida);
$diff = $fecha_hora_ingreso->diff($fecha_hora_salida);

$tiempo = $diff->days . " día(s) con " . $diff->h . " hora(s) con " . $diff->i . " minuto(s) ";
///////////////////////////////////////////////////////////////

$cuviculo = $_GET['cuviculo'];
$detalle = "Servicio de parqueo de " . $tiempo;


// Calcula el precio del cliente en horas 

$query_precios = $pdo->prepare("SELECT * FROM tb_precios WHERE cantidad = '$diff->h' AND detalle = 'HORA(S)' AND estado = '1' ");
$query_precios->execute();
$datos_precios = $query_precios->fetchAll(PDO::FETCH_ASSOC);
foreach ($datos_precios as $datos_precio) {
    $precio_hora = $datos_precio['precio'];
}


// Calcula el precio del cliente en días 

$precio_dia = "0";
$query_precios_dias = $pdo->prepare("SELECT * FROM tb_precios WHERE cantidad = '$diff->days' AND detalle = 'DIA(S)' AND estado = '1' ");
$query_precios_dias->execute();
$datos_precios_dias = $query_precios_dias->fetchAll(PDO::FETCH_ASSOC);
foreach ($datos_precios_dias as $datos_precio_dia) {
    $precio_dia = $datos_precio_dia['precio'];
}

$precio_final = $precio_dia + $precio_hora;


$cantidad = "1";

$total = ($precio_final * $cantidad);

$monto_total = $total;


$monto_literal = numtoletras($monto_total);

$user_sesion = $_GET['user_sesion'];

$query_clientes = $pdo->prepare("SELECT * FROM tb_clientes WHERE id_cliente = '$id_cliente' AND estado = '1'  ");
$query_clientes->execute();
$datos_clientes = $query_clientes->fetchAll(PDO::FETCH_ASSOC);
foreach ($datos_clientes as $datos_cliente) {
    $id_cliente = $datos_cliente['id_cliente'];
    $nombre_cliente = $datos_cliente['nombre_cliente'];
    $cc_cliente = $datos_cliente['cc_cliente'];
    $placa_auto = $datos_cliente['placa_auto'];
}

$qr = "Factura realizada por el sistema de paqueo, al cliente " . $nombre_cliente . " 
con el CC: " . $cc_cliente . ", el vehiculo con número de placa " . $placa_auto . ", 
esta factura se generó en " . $fecha_factura . " a las: " . $hora_salida . " ";

$sentencia = $pdo->prepare('INSERT INTO tb_facturaciones
(id_informacion,nro_factura,id_cliente,fecha_factura,fecha_ingreso,hora_ingreso,fecha_salida,hora_salida,tiempo,cuviculo,detalle,precio,cantidad,total,monto_total,monto_literal,user_sesion,qr, fyh_creacion, estado)
VALUES ( :id_informacion,:nro_factura,:id_cliente,:fecha_factura,:fecha_ingreso,:hora_ingreso,:fecha_salida,:hora_salida,:tiempo,:cuviculo,:detalle,:precio,:cantidad,:total,:monto_total,:monto_literal,:user_sesion,:qr,:fyh_creacion,:estado)');

$sentencia->bindParam(':id_informacion', $id_informacion);
$sentencia->bindParam(':nro_factura', $nro_factura);
$sentencia->bindParam(':id_cliente', $id_cliente);
$sentencia->bindParam(':fecha_factura', $fecha_factura);
$sentencia->bindParam(':fecha_ingreso', $fecha_ingreso);
$sentencia->bindParam(':hora_ingreso', $hora_ingreso);
$sentencia->bindParam(':fecha_salida', $fecha_salida);
$sentencia->bindParam(':hora_salida', $hora_salida);
$sentencia->bindParam(':tiempo', $tiempo);
$sentencia->bindParam(':cuviculo', $cuviculo);
$sentencia->bindParam(':detalle', $detalle);
$sentencia->bindParam(':precio', $precio_final);
$sentencia->bindParam(':cantidad', $cantidad);
$sentencia->bindParam(':total', $total);
$sentencia->bindParam(':monto_total', $monto_total);
$sentencia->bindParam(':monto_literal', $monto_literal);
$sentencia->bindParam(':user_sesion', $user_sesion);
$sentencia->bindParam(':qr', $qr);
$sentencia->bindParam('fyh_creacion', $fechaHora);
$sentencia->bindParam('estado', $estado_del_registro);


if ($sentencia->execute()) {
    echo 'success';

    $estado_espacio = "LIBRE";
    date_default_timezone_set("America/Bogota");
    $fechaHora = date("Y-m-d h:i:s");
    $sentencia = $pdo->prepare("UPDATE tb_mapeos SET
    estado_espacio = :estado_espacio,
    fyh_actualizacion = :fyh_actualizacion 
    WHERE nro_espacio = :nro_espacio");
    $sentencia->bindParam(':estado_espacio', $estado_espacio);
    $sentencia->bindParam(':fyh_actualizacion', $fechaHora);
    $sentencia->bindParam(':nro_espacio', $cuviculo);
    $sentencia->execute();

    $estado_espacio_ticket = "LIBRE";
    $sentencia_ticket = $pdo->prepare("UPDATE tb_tickets SET
    estado_ticket = :estado_ticket WHERE fecha_ingreso = :fecha_ingreso AND hora_ingreso = :hora_ingreso");
    $sentencia_ticket->bindParam(':estado_ticket', $estado_espacio_ticket);
    $sentencia_ticket->bindParam(':fecha_ingreso', $fecha_ingreso);
    $sentencia_ticket->bindParam(':hora_ingreso', $hora_ingreso);
    $sentencia_ticket->execute();

?>
    <script>
        location.href = "facturacion/factura.php";
    </script>
<?php
} else {
    echo 'error al registrar a la base de datos';
}
