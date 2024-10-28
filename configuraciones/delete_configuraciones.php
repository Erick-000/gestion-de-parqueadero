<?php
include('../app/config.php');
include('../layout/admin/datos_usuario_sesion.php');
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <?php include('../layout/admin/head.php'); ?>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <?php include('../layout/admin/menu.php'); ?>
        <div class="content-wrapper">
            <br>
            <div class="container">

                <h2> Eliminar la información</h2>

                <br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-outline card-danger">
                            <div class="card-header">
                                <h3 class="card-title"> Está seguro de elimar la iformación? </h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>

                            <?php
                            $id_informacion_get = $_GET['id'];
                            // Prepara una consulta para obtener todos los usuarios que estén activos (estado = '1').
                            $query_informaciones = $pdo->prepare("SELECT * FROM tb_informaciones WHERE estado = '1' AND id_informacion = '$id_informacion_get' ");

                            // Ejecuta la consulta.
                            $query_informaciones->execute();

                            // Obtiene todos los resultados de la consulta y los almacena en un array.
                            $informaciones = $query_informaciones->fetchAll(PDO::FETCH_ASSOC);

                            // Itera sobre cada usuario obtenido de la base de datos.
                            foreach ($informaciones as $informacion) {
                                // Extrae los datos de cada usuario.
                                $id_informacion = $informacion['id_informacion'];
                                $nombre_parqueo = $informacion['nombre_parqueo'];
                                $actividad_empresa = $informacion['actividad_empresa'];
                                $sucursal = $informacion['sucursal'];
                                $direccion = $informacion['direccion'];
                                $telefono = $informacion['telefono'];
                                $departamento_ciudad = $informacion['departamento_ciudad'];
                                $pais = $informacion['pais'];
                            }
                            ?>

                            <div class="card-body" style="display: block;">
                                <div class="row">
                                    <div class="col-md-5">
                                        <label for=""> Nombre del parqueadero <span style="color:red"> <b></b> </span> </label>
                                        <input type="text" class="form-control" id="nombre_parqueo" style="text-transform: uppercase;" value="<?php echo $nombre_parqueo; ?>" disabled >
                                    </div>
                                    <div class="col-md-5">
                                        <label for=""> Actividad de la empresa <span style="color:red"> <b></b> </span> </label>
                                        <input type="text" class="form-control" id="actividad_empresa" style="text-transform: uppercase;" value="<?php echo $actividad_empresa; ?>" disabled >
                                    </div>
                                    <div class="col-md-2">
                                        <label for=""> Sucursal <span style="color:red"> <b></b> </span> </label>
                                        <input type="text" class="form-control" id="sucursal" style="text-transform: uppercase;" value="<?php echo $sucursal; ?>" disabled >
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for=""> Dirección <span style="color:red"> <b></b> </span> </label>
                                        <input type="text" class="form-control" id="direccion" style="text-transform: uppercase;" value="<?php echo $direccion; ?>" disabled >
                                    </div>
                                    <div class="col-md-6">
                                        <label for=""> Teléfono <span style="color:red"> <b></b> </span> </label>
                                        <input type="text" class="form-control" id="telefono" style="text-transform: uppercase;" value="<?php echo $telefono; ?>" disabled >
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for=""> Departamento o Ciudad <span style="color:red"> <b></b> </span> </label>
                                        <input type="text" class="form-control" id="departamento_ciudad" style="text-transform: uppercase;" value="<?php echo $departamento_ciudad; ?>" disabled >
                                    </div>
                                    <div class="col-md-6">
                                        <label for=""> País <span style="color:red"> <b></b> </span> </label>
                                        <input type="text" class="form-control" id="pais" style="text-transform: uppercase;" value="<?php echo $pais; ?>" disabled >
                                    </div>
                                </div>
                                <hr>

                                <div class="row">
                                    <div class="col-md-6">
                                        <a href="informaciones.php" class="btn btn-default btn-block">Cancelar</a>
                                    </div>
                                    <div class="col-md-6">
                                        <button class="btn btn-danger btn-block" id="btn_actualizar_informacion">
                                            Eliminar
                                        </button>
                                    </div>
                                </div>

                                <div id="respuesta">

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content-wrapper -->
        <?php include('../layout/admin/footer.php'); ?>
    </div>
    <?php include('../layout/admin/footer_link.php'); ?>
</body>

</html>

<script>
    // Evento que se activa cuando se hace clic en el botón de registrar.
    $('#btn_actualizar_informacion').click(function() {

        var id_informacion = '<?php echo $id_informacion_get ?>';

            // Si todos los campos están completos, se envía una petición GET a 'controller_create.php' para guardar los datos.
            var url = 'controller_delete_informaciones.php';
            $.get(url, {
                id_informacion:id_informacion
            }, function(datos) {
                // Muestra la respuesta de la operación en el div con id 'respuesta'.
                $('#respuesta').html(datos);
            });
        });
</script>