<?php

include('../app/config.php');

$placa = $_GET['placa'];

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
        <label for="staticEmail" class="col-sm-2 col-form-label">Cliente:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control">
        </div>
    </div>

    <div class="form-group row">
        <label for="staticEmail" class="col-sm-2 col-form-label">Cedula:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control">
        </div>
    </div>
<?php

} else {
    //echo $nombre_cliente . " - " . $cc_cliente;
?>
    <div class="form-group row">
        <label for="staticEmail" class="col-sm-2 col-form-label">Cliente:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" value="<?php echo $nombre_cliente; ?>" >
        </div>
    </div>

    <div class="form-group row">
        <label for="staticEmail" class="col-sm-2 col-form-label">Cedula:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" value="<?php echo $cc_cliente; ?>">
        </div>
    </div>
<?php
}

?>