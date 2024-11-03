<?php

// Incluimos los archivos de configuración y datos del usuario de la sesión
include('app/config.php');
include('layout/admin/datos_usuario_sesion.php');

?>
<!--Declaramos el tipo de documento HTML y el idioma -->
<!DOCTYPE html>
<html lang="es">

<head>

    <!-- Incluimos el encabezado HTML (metadatos, estilos, etc.) -->
    <?php include('layout/admin/head.php') ?>

</head>


<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <?php include('layout/admin/menu.php') ?>

        <div class="content-wrapper">
            <br>
            <div class="container">

                <h2>Bienvenido a OasisPark</h2>

                <br>
                <div class="row">
                    <div class="col-md-12">

                        <div class="card card-outline card-primary">
                            <div class="card-header">
                                <h3 class="card-title"> Mapeo actual de parqueadero </h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>

                            </div>

                            <div class="card-body" style="display: block;">
                                <div class="row">

                                    <?php
                                    // Inicializa un contador para numerar los usuarios.
                                    $contador = 0;

                                    // Prepara una consulta para obtener todos los usuarios que estén activos (estado = '1').
                                    $query_mapeos = $pdo->prepare("SELECT * FROM tb_mapeos WHERE estado = '1'");

                                    // Ejecuta la consulta.
                                    $query_mapeos->execute();

                                    // Obtiene todos los resultados de la consulta y los almacena en un array.
                                    $mapeos = $query_mapeos->fetchAll(PDO::FETCH_ASSOC);

                                    // Itera sobre cada usuario obtenido de la base de datos.
                                    foreach ($mapeos as $mapeo) {
                                        // Extrae los datos de cada usuario.
                                        $id_map = $mapeo['id_map'];
                                        $nro_espacio = $mapeo['nro_espacio'];
                                        $estado_espacio = $mapeo['estado_espacio'];

                                        if ($estado_espacio == "LIBRE") { ?>
                                            <div class="col">
                                                <center>
                                                    <h2><?php echo $nro_espacio; ?></h2>

                                                    <button class="btn btn-success" style="width: 100%;height: 114px"
                                                        data-toggle="modal" data-target="#modal<?php echo $id_map; ?>">
                                                        <p><?php echo $estado_espacio; ?></p>
                                                    </button>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="modal<?php echo $id_map; ?>" tabindex="-1"
                                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel"> INGRESO DEL VEHICULO </h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="form-group row">
                                                                        <label for="staticEmail" class="col-sm-3 col-form-label">Placa: <span><b style="color: red">*</b></span> </label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" style="text-transform: uppercase;" class="form-control" id="placa_buscar<?php echo $id_map; ?>">
                                                                        </div>
                                                                        <div class="col-sm-3">
                                                                            <button class="btn btn-primary" id="btn_buscar_cliente<?php echo $id_map; ?>" type="button">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                                                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                                                                </svg>
                                                                                Buscar
                                                                            </button>
                                                                            <script>
                                                                                $('#btn_buscar_cliente<?php echo $id_map; ?>').click(function() {
                                                                                    var placa = $('#placa_buscar<?php echo $id_map; ?>').val();
                                                                                    var id_map = <?php echo $id_map ?>
                                                                                    // Validaciones para asegurar que los campos no estén vacíos antes de enviar los datos.
                                                                                    if (placa == "") {
                                                                                        alert('Debe llenar el campo placa');
                                                                                        $('#placa_buscar<?php echo $id_map; ?>').focus();
                                                                                    } else {
                                                                                        // Si todos los campos están completos, se envía una petición GET a 'controller_create.php' para guardar los datos.
                                                                                        var url = 'clientes/controller_buscar_cliente.php';
                                                                                        $.get(url, {
                                                                                            placa: placa,
                                                                                            id_map: id_map
                                                                                        }, function(datos) {
                                                                                            // Muestra la respuesta de la operación en el div con id 'respuesta'.
                                                                                            $('#respuesta_buscar_cliente<?php echo $id_map; ?>').html(datos);
                                                                                        });
                                                                                    }
                                                                                });
                                                                            </script>
                                                                        </div>
                                                                    </div>

                                                                    <div id="respuesta_buscar_cliente<?php echo $id_map; ?>">

                                                                    </div>

                                                                    <div class="form-group row">
                                                                        <label for="staticEmail" class="col-sm-4 col-form-label">Fecha de ingreso:</label>
                                                                        <div class="col-sm-8">

                                                                            <?php

                                                                            // Establece la zona horaria para asegurar que la fecha y hora se registren correctamente.
                                                                            date_default_timezone_set("America/Bogota");

                                                                            // Obtiene la fecha y hora actual para registrar cuándo se creó el usuario.
                                                                            $fechaHora = date("Y-m-d h:i:s");
                                                                            $dia = date('d');
                                                                            $mes = date('m');
                                                                            $anio = date('Y');
                                                                            ?>

                                                                            <input type="date" class="form-control" value="<?php echo $anio . "-" . $mes . "-" . $dia; ?>" id="fecha_ingreso<?php echo $id_map; ?>">
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group row">
                                                                        <label for="staticEmail" class="col-sm-4 col-form-label">Hora de ingreso:</label>
                                                                        <div class="col-sm-8">
                                                                            <?php
                                                                            // Establece la zona horaria para asegurar que la fecha y hora se registren correctamente.
                                                                            date_default_timezone_set("America/Bogota");

                                                                            // Obtiene la hora actual en formato de 24 horas para el input de tipo time.
                                                                            $hora24 = date('H'); //Toma el formato 24 horas
                                                                            $minutos = date('i');
                                                                            ?>

                                                                            <input type="time" class="form-control" value="<?php echo $hora24 . ':' . $minutos; ?>" id="hora_ingreso<?php echo $id_map; ?>">
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group row">
                                                                        <label for="staticEmail" class="col-sm-4 col-form-label">Cuviculo:</label> 
                                                                        <div class="col-sm-8">

                                                                            <input type="text" class="form-control" value="<?php echo $nro_espacio; ?>" id="cuviculo<?php echo $id_map; ?>" disabled >
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                                    <button type="button" class="btn btn-primary" id="btn_registrar_ticket<?php echo $id_map; ?>">Imprimir ticket</button>
                                                                    <script>
                                                                        $('#btn_registrar_ticket<?php echo $id_map; ?>').click(function() {
                                                                            var placa = $('#placa_buscar<?php echo $id_map; ?>').val();
                                                                            var nombre_cliente = $('#nombre_cliente<?php echo $id_map; ?>').val();
                                                                            var cc_cliente = $('#cedula_cliente<?php echo $id_map; ?>').val();
                                                                            var fecha_ingreso = $('#fecha_ingreso<?php echo $id_map; ?>').val();
                                                                            var hora_ingreso = $('#hora_ingreso<?php echo $id_map; ?>').val();
                                                                            var cuviculo = $('#cuviculo<?php echo $id_map; ?>').val();
                                                                            var user_sesion = "<?php echo $usuario_sesion ?>";

                                                                            if (placa == "") {
                                                                                alert("Debe llenar el campo Placa...");
                                                                                $('#placa_buscar<?php echo $id_map; ?>').focus();
                                                                            } else if (nombre_cliente == "") {
                                                                                alert("Debe llenar el campo Nombre del cliente...");
                                                                                $('#nombre_cliente<?php echo $id_map; ?>').focus();
                                                                            } else if (cc_cliente == "") {
                                                                                alert("Debe llenar el campo Cedula...")
                                                                                $('#cedula_cliente<?php echo $id_map; ?>').focus();
                                                                            } 
                                                                            else {

                                                                                // Si todos los campos están completos, se envía una petición GET a 'controller_create.php' para guardar los datos.
                                                                                var url_1 = 'parqueo/controller_cambiar_estado_ocupado.php';
                                                                                $.get(url_1, {
                                                                                    cuviculo: cuviculo
                                                                                }, function(datos) {
                                                                                    // Muestra la respuesta de la operación en el div con id 'respuesta'.
                                                                                    $('#respuesta_ticket').html(datos);
                                                                                });

                                                                                // Si todos los campos están completos, se envía una petición GET a 'controller_create.php' para guardar los datos.
                                                                                var url_2 = 'tickets/controller_registrar_tickets.php';
                                                                                $.get(url_2, {
                                                                                    placa: placa,
                                                                                    nombre_cliente: nombre_cliente,
                                                                                    cc_cliente: cc_cliente,
                                                                                    fecha_ingreso: fecha_ingreso,
                                                                                    hora_ingreso: hora_ingreso,
                                                                                    cuviculo: cuviculo,
                                                                                    user_sesion:user_sesion
                                                                                }, function(datos) {
                                                                                    // Muestra la respuesta de la operación en el div con id 'respuesta'.
                                                                                    $('#respuesta_ticket').html(datos);
                                                                                });
                                                                            }

                                                                        });
                                                                    </script>
                                                                </div>
                                                                <div id="respuesta_ticket">

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </center>
                                            </div>
                                        <?php
                                        }

                                        if ($estado_espacio == "OCUPADO") { ?>
                                            <div class="col">
                                                <center>
                                                    <h2><?php echo $nro_espacio; ?></h2>
                                                    <button class="btn btn-danger">
                                                        <img src="<?php $URL; ?>./public/images/auto1.png" width="60px" alt="">
                                                    </button>
                                                    <p><?php echo $estado_espacio; ?></p>
                                                </center>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>



                    </div>
                </div>

            </div>

        </div>
        <!-- /.content-wrapper -->
        <?php include('layout/admin/footer.php') ?>
    </div>
    <?php include('layout/admin/footer_link.php') ?>
</body>

</html>