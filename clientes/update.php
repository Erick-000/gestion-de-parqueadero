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

                <h2> Editar datos del cliente </h2>

                <br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-outline card-success">
                            <div class="card-header">
                                <h3 class="card-title"> Datos del cliente </h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>

                            <?php  
                            $id_cliente_get = $_GET['id'];

                            $query_clientes = $pdo->prepare("SELECT * FROM tb_clientes WHERE id_cliente = '$id_cliente_get' AND estado = '1'");
                                    $query_clientes->execute();
                                    $datos_clientes = $query_clientes->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($datos_clientes as $datos_cliente) {
                                        $id_cliente = $datos_cliente['id_cliente'];
                                        $nombre_cliente = $datos_cliente['nombre_cliente'];
                                        $cc_cliente = $datos_cliente['cc_cliente'];
                                        $placa_auto = $datos_cliente['placa_auto'];
                                    }
                            ?>

                            <div class="card-body">

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for=""> Nombre del cliente </label>
                                            <input type="text" class="form-control" value="<?php echo $nombre_cliente; ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for=""> Cedula del cliente </label>
                                            <input type="text" class="form-control" value="<?php echo $cc_cliente; ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for=""> Placa </label>
                                            <input type="text" class="form-control" value="<?php echo $placa_auto; ?>">
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="row">
                                        <div class="col-md 12">
                                            <div class="form-group">
                                                <a href="index.php" class="btn btn-default">Cancelar</a>
                                                <button class="btn btn-success" >
                                                    Actualizar
                                                </button>
                                            </div>
                                        </div>
                                    </div>

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