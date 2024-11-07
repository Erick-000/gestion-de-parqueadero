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

                <h2> Registro de Precios </h2>

                <br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-outline card-primary">
                            <div class="card-header">
                                <h3 class="card-title"> Llene los datos cuidadosamente </h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Cantidad <span><b style="color:red">*</b></span> </label>
                                            <input type="number" id="cantidad" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Detalle <span><b style="color:red">*</b></span> </label>
                                            <select name="" id="detalle" class="form-control">
                                                <option value="HORA(S)"> HORA(S) </option>
                                                <option value="DIA(S)"> DIA(S) </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Precio <span><b style="color:red">*</b></span> </label>
                                            <input type="number" id="precio" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <hr>

                                <div class="row">
                                    <div class="col-md-12">
                                        <a href="index.php" class="btn btn-default">Cancelar</a>
                                        <button class="btn btn-primary" id="btn_registrar_precio"> Registrar Precio </button>
                                    </div>
                                </div>

                                <script>
                                    $('#btn_registrar_precio').click(function() {

                                        var cantidad = $('#cantidad').val();
                                        var detalle = $('#detalle').val();
                                        var precio = $('#precio').val();

                                        if (cantidad == "") {
                                            alert("Debe llenar el campo cantidad...");
                                            $('#cantidad').focus();

                                        } else if (precio == "") {
                                            alert("Debe llenar el campo precio...");
                                            $('#precio').focus();

                                        } else {


                                            // Si todos los campos están completos, se envía una petición GET a 'controller_create.php' para guardar los datos.
                                            var url = 'controller_create.php';
                                            $.get(url, {
                                                cantidad: cantidad,
                                                detalle: detalle,
                                                precio: precio
                                            }, function(datos) {
                                                // Muestra la respuesta de la operación en el div con id 'respuesta'.
                                                $('#respuesta').html(datos);
                                            });
                                        }

                                    });
                                </script>

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