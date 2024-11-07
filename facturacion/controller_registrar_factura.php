<?php

include('../app/config.php');

// Establece la zona horaria para asegurar que la fecha y hora se registren correctamente.
date_default_timezone_set("America/Bogota");

// Obtiene la fecha y hora actual para registrar cuándo se creó el usuario.
$fechaHora = date("Y-m-d h:i:s");
$dia = date( "d");
$mes = date("m");
if($mes == "1")$mes = "Enero";
if($mes == "2")$mes = "Febrero";
if($mes == "3")$mes = "Marzo";
if($mes == "4")$mes = "Abril";
if($mes == "5")$mes = "Mayo";
if($mes == "6")$mes = "Junio";
if($mes == "7")$mes = "Julio";
if($mes == "8")$mes = "Agosto";
if($mes == "9")$mes = "Septiembre";
if($mes == "10")$mes = "Octubre";
if($mes == "11")$mes = "Noviembre";
if($mes == "12")$mes = "Diciembre";
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
$fecha_factura = $departamento.", ".$dia." de ".$mes." del ".$anio;
$fecha_ingreso = $_GET['fecha_ingreso'];
$hora_ingreso = $_GET['hora_ingreso'];


$fecha_salida = date('d/m/Y');

$hora_salida = date('H:i');

$c_hora_ingreso = strtotime(datetime: $hora_ingreso);

$c_hora_salida = strtotime(datetime: $hora_salida);

$diferencia_hora = ($c_hora_salida - $c_hora_ingreso) / 3600;

round($diferencia_hora, 2);

$hora_calculada = ((int)$diferencia_hora);

$diferencia_minutos = ($c_hora_salida - $c_hora_ingreso) / 60;

$caculando = $hora_calculada * 60;

$minutos_calculados = $diferencia_minutos - $caculando;

$tiempo = $hora_calculada." hora(s) con ".$minutos_calculados." minuto(s)";


$cuviculo = $_GET['cuviculo'];
$detalle = "Servicio de parqueo de ".$tiempo;



/*
$precio = $_GET['precio'];
$cantidad = $_GET['cantidad'];
$total = $_GET['total'];
$monto_total = $_GET['monto_total'];
$monto_literal = $_GET['monto_literal'];
$user_sesion = $_GET['user_sesion'];
$qr = $_GET['qr'];

$sentencia = $pdo->prepare('INSERT INTO tb_facturaciones
(id_informacion,nro_factura,id_cliente,fecha_factura,fecha_ingreso,hora_ingreso,fecha_salida,hora_salida,tiempo,cuviculo,detalle,precio,cantidad,total,monto_total,monto_literal,user_sesion,qr, fyh_creacion, estado)
VALUES ( :id_informacion,:nro_factura,:id_cliente,:fecha_factura,:fecha_ingreso,:hora_ingreso,:fecha_salida,:hora_salida,:tiempo,:cuviculo,:detalle,:precio,:cantidad,:total,:monto_total,:monto_literal,:user_sesion,:qr,:fyh_creacion,:estado)');

$sentencia->bindParam(':id_informacion',$id_informacion);
$sentencia->bindParam(':nro_factura',$nro_factura);
$sentencia->bindParam(':id_cliente',$id_cliente);
$sentencia->bindParam(':fecha_factura',$fecha_factura);
$sentencia->bindParam(':fecha_ingreso',$fecha_ingreso);
$sentencia->bindParam(':hora_ingreso',$hora_ingreso);
$sentencia->bindParam(':fecha_salida',$fecha_salida);
$sentencia->bindParam(':hora_salida',$hora_salida);
$sentencia->bindParam(':tiempo',$tiempo);
$sentencia->bindParam(':cuviculo',$cuviculo);
$sentencia->bindParam(':detalle',$detalle);
$sentencia->bindParam(':precio',$precio);
$sentencia->bindParam(':cantidad',$cantidad);
$sentencia->bindParam(':total',$total);
$sentencia->bindParam(':monto_total',$monto_total);
$sentencia->bindParam(':monto_literal',$monto_literal);
$sentencia->bindParam(':user_sesion',$user_sesion);
$sentencia->bindParam(':qr',$qr);
$sentencia->bindParam('fyh_creacion',$fechaHora);
$sentencia->bindParam('estado',$estado_del_registro);


if($sentencia->execute()){
echo 'success';

//header('Location:' .$URL.'/');
}else{
echo 'error al registrar a la base de datos';
}
*/