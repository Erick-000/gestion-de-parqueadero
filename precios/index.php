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

                <h2> Listado de Precios </h2>

                <br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-outline card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Precios establecidos </h3>
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
                                    <th>Cantidad</th>
                                    <th>Detalle</th>
                                    <th>Precio</th>
                                    <th>
                                        <center>Acción</center>
                                    </th>
                                    <?php
                                    //BUSCA SI EL CLIENTE YA ESTA REGISTRADO
                                    $contador_precio = 0;
                                    $query_precios = $pdo->prepare("SELECT * FROM tb_precios WHERE estado = '1'  ");
                                    $query_precios->execute();
                                    $datos_precios = $query_precios->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($datos_precios as $datos_precio) {
                                        $contador_precio = $contador_precio + 1;

                                        $id_precio = $datos_precio['id_precio'];
                                        $cantidad = $datos_precio['cantidad'];
                                        $detalle = $datos_precio['detalle'];
                                        $precio = $datos_precio['precio'];

                                    ?>

                                        <!-- Muestra los datos de cada usuario en una fila de la tabla. -->
                                        <tr>
                                            <td>
                                                <center><?php echo $contador_precio; ?></center>
                                            </td>
                                            <td><center><?php echo $cantidad; ?></center></td>
                                            <td><center><?php echo $detalle; ?></center></td>
                                            <td><center><?php echo $precio; ?></center></td>
                                            <td>
                                                <center>
                                                    <!-- Enlace para eliminar el usuario, redirige a 'delete.php' con el ID del usuario. -->
                                                    <a href="update.php?id=<?php echo $id_precio ?>" class="btn btn-primary">Editar</a>
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