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

                <h2> Listado de Clientes </h2>

                <br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-outline card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Clientes registrados </h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">

                                <!-- Tabla que muestra el listado de usuarios. -->
                                <table class="table table-bordered table-sm table-striped">
                                    <th>
                                        <center>Nro</center>
                                    </th>
                                    <th>Nombre del Cliente</th>
                                    <th>Cedula del cliente</th>
                                    <th>Placa del vehículo</th>
                                    <th>
                                        <center>Acción</center>
                                    </th>
                                    <?php
                                    //BUSCA SI EL CLIENTE YA ESTA REGISTRADO
                                    $contador_cliente = 0;
                                    $query_clientes = $pdo->prepare("SELECT * FROM tb_clientes WHERE estado = '1'  ");
                                    $query_clientes->execute();
                                    $datos_clientes = $query_clientes->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($datos_clientes as $datos_cliente) {
                                        $contador_cliente = $contador_cliente + 1;

                                        $id_cliente = $datos_cliente['id_cliente'];
                                        $nombre_cliente = $datos_cliente['nombre_cliente'];
                                        $cc_cliente = $datos_cliente['cc_cliente'];
                                        $placa_auto = $datos_cliente['placa_auto'];

                                    ?>

                                        <!-- Muestra los datos de cada usuario en una fila de la tabla. -->
                                        <tr>
                                            <td>
                                                <center><?php echo $contador_cliente; ?></center>
                                            </td>
                                            <td><?php echo $nombre_cliente; ?></td>
                                            <td><?php echo $cc_cliente; ?></td>
                                            <td><?php echo $placa_auto; ?></td>
                                            <td>
                                                <center>
                                                    <!-- Enlace para eliminar el usuario, redirige a 'delete.php' con el ID del usuario. -->
                                                    <a href="update.php?id=<?php echo $id_cliente ?>" class="btn btn-primary">Editar</a>
                                                </center>
                                            </td>
                                        </tr>

                                    <?php
                                    }
                                    ?>
                                </table>

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