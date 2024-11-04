<?php

include('../app/config.php');

$placa = $_GET['placa'];
$id_map = $_GET['id_map'];

$placa = strtoupper($placa); //Convertir todo a mayusculas

$id_cliente = '';
$nombre_cliente = '';
$cc_cliente = '';

// Prepara una consulta para obtener todos los usuarios que estén activos (estado = '1').
$query_buscar = $pdo->prepare("SELECT * FROM tb_clientes WHERE estado = '1' AND placa_auto = '$placa' ");

// Ejecuta la consulta.
$query_buscar->execute();

// Obtiene todos los resultados de la consulta y los almacena en un array.
$buscar = $query_buscar->fetchAll(PDO::FETCH_ASSOC);

// Itera sobre cada usuario obtenido de la base de datos.
foreach ($buscar as $busca) {
    // Extrae los datos de cada usuario.
    $id_cliente = $busca['id_cliente'];
    $nombre_cliente = $busca['nombre_cliente'];
    $cc_cliente = $busca['cc_cliente'];
}

if ($nombre_cliente == "") {
?>
    <div class="form-group row">
        <label for="staticEmail" class="col-sm-3 col-form-label">Cliente: <span><b style="color: red" >*</b></span> </label>
        <div class="col-sm-9">
            <input type="text" class="form-control" id="nombre_cliente<?php echo $id_map;?>" >
        </div>
    </div>

    <div class="form-group row">
        <label for="staticEmail" class="col-sm-3 col-form-label">Cedula: <span><b style="color: red" >*</b></span> </label>
        <div class="col-sm-9">
            <input type="text" class="form-control" id="cedula_cliente<?php echo $id_map;?>" >
        </div>
    </div>
<?php

} else {
    //echo $nombre_cliente . " - " . $cc_cliente;
?>
    <div class="form-group row">
        <label for="staticEmail" class="col-sm-3 col-form-label">Cliente: <span><b style="color: red" >*</b></span> </label>
        <div class="col-sm-9">
            <input type="text" class="form-control" value="<?php echo $nombre_cliente; ?>" id="nombre_cliente<?php echo $id_map; ?>" >
        </div>
    </div>

    <div class="form-group row">
        <label for="staticEmail" class="col-sm-3 col-form-label">Cedula: <span><b style="color: red" >*</b></span> </label>
        <div class="col-sm-9">
            <input type="text" class="form-control" value="<?php echo $cc_cliente; ?>"  id="cedula_cliente<?php echo $id_map;?>" >
        </div>
    </div>
<?php
}


//Busca la placa en la tabla tickets
$contador_ticket = 0;

$query_tickets = $pdo->prepare("SELECT * FROM tb_tickets WHERE placa_auto = '$placa' AND estado_ticket = 'OCUPADO' AND estado = '1' ");

// Ejecuta la consulta.
$query_tickets->execute();

// Obtiene todos los resultados de la consulta y los almacena en un array.
$datos_tickets = $query_tickets->fetchAll(PDO::FETCH_ASSOC);

// Itera sobre cada usuario obtenido de la base de datos.
foreach ($datos_tickets as $datos_ticket) {
    $contador_ticket = $contador_ticket + 1;
}
if($contador_ticket == "1"){
    ?>
    <div class="alert alert-danger">
    Este vehículo ya está parqueado
    </div>
    <script>
        $('#btn_registrar_ticket<?php echo $id_map; ?>').attr('disabled','disabled');
    </script>
    <?php
}else{
    ?>
    <script>
    $('#btn_registrar_ticket<?php echo $id_map; ?>').removeAttr('disabled');
    </script>
    <?php
    
}

?>