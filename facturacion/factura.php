<?php
//============================================================+
// File name   : example_002.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 002 for TCPDF class
//               Removing Header and Footer
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Removing Header and Footer
 * @author Nicola Asuni
 * @since 2008-03-04
 * @group header
 * @group footer
 * @group page
 * @group pdf
 */

// Include the main TCPDF library (search for installation path).
require_once('../app/templeates/TCPDF-main/TCPDF-main/tcpdf.php');
include('../app/config.php');

//Cargar el encabezado 

// Prepara una consulta para obtener todos los usuarios que estén activos (estado = '1').
$query_informaciones = $pdo->prepare("SELECT * FROM tb_informaciones WHERE estado = '1'");

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


// Tomar la información de la factura

// Prepara una consulta para obtener todos los usuarios que estén activos (estado = '1').
$query_facutras = $pdo->prepare("SELECT * FROM tb_facturaciones WHERE estado = '1'");

// Ejecuta la consulta.
$query_facutras->execute();

// Obtiene todos los resultados de la consulta y los almacena en un array.
$facturas = $query_facutras->fetchAll(PDO::FETCH_ASSOC);

// Itera sobre cada usuario obtenido de la base de datos.
foreach ($facturas as $factura) {
    // Extrae los datos de cada usuario.
    $id_facturacion = $factura['id_facturacion'];
    $id_informacion = $factura['id_informacion'];
    $nro_factura = $factura['nro_factura'];
    $id_cliente = $factura['id_cliente'];
    $fecha_factura = $factura['fecha_factura'];
    $fecha_ingreso = $factura['fecha_ingreso'];
    $hora_ingreso = $factura['hora_ingreso'];
    $fecha_salida = $factura['fecha_salida'];
    $hora_salida = $factura['hora_salida'];
    $tiempo = $factura['tiempo'];
    $cuviculo = $factura['cuviculo'];
    $detalle = $factura['detalle'];
    $precio = $factura['precio'];
    $cantidad = $factura['cantidad'];
    $total = $factura['total'];
    $monto_total = $factura['monto_total'];
    $monto_literal = $factura['monto_literal'];
    $user_sesion = $factura['user_sesion'];
    $qr = $factura['qr'];
}


// Tomando datos del cliente 
$query_clientes = $pdo->prepare("SELECT * FROM tb_clientes WHERE id_cliente = '$id_cliente' AND estado = '1'  ");
$query_clientes->execute();
$datos_clientes = $query_clientes->fetchAll(PDO::FETCH_ASSOC);
foreach ($datos_clientes as $datos_cliente) {
    $id_cliente = $datos_cliente['id_cliente'];
    $nombre_cliente = $datos_cliente['nombre_cliente'];
    $cc_cliente = $datos_cliente['cc_cliente'];
    $placa_auto = $datos_cliente['placa_auto'];
}

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, array(79, 175), true, 'UTF-8', false);

// set document information
$pdf->setCreator(PDF_CREATOR);
$pdf->setAuthor('Sistema de parqueo');
$pdf->setTitle('Sistema de parqueo');
$pdf->setSubject('Sistema de parqueo');
$pdf->setKeywords('TCPDF, PDF, example, test, guide');

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set default monospaced font
$pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->setMargins(5, 5, 5);

// set auto page breaks
$pdf->setAutoPageBreak(TRUE, 5);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
    require_once(dirname(__FILE__) . '/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->setFont('Helvetica', '', 7);

// add a page
$pdf->AddPage();


// create some HTML content
$html = '
<div>
    <p style="text-align: center">
        <b> '.$nombre_parqueo.' </b> <br>
        '.$actividad_empresa.' <br>
        NIT: 900882406-5 <br>	
        Sucursal No ' .$sucursal.'<br>
        DIRECCIÓN: '.$direccion.' <br>
        TELÉFONO: '.$telefono.' <br>
        '.$departamento_ciudad.' 
        -----------------------------------------------------------------------------------
            <b> Facura Nro. </b> '.$nro_factura.'
        -----------------------------------------------------------------------------------
            <div style="text-align:left">
            <b> DATOS DEL CLIENTE </b> <br> 
            <b> CLIENTE: </b> '.$nombre_cliente.' <br> 
            <b> CC: </b> '.$cc_cliente.' <br>
            <b> Fecha de la factura: </b> '.$fecha_factura.'
            -----------------------------------------------------------------------------------<br>
            <b> De: </b> '.$fecha_ingreso.' <b> Hora: </b> '.$hora_ingreso.' <br>
            <b> A: </b> '.$fecha_salida.' <b> Hora: </b> '.$hora_salida.' <br>
            <b> Tiempo: </b> '.$tiempo.' 
            -----------------------------------------------------------------------------------<br>
            <table border="1" cellpadding ="1" >
            <tr>
                <td style="text-align:center" width="101px" ><b> Detalle </b></td>
                <td style="text-align:center" width="45px" ><b> Precio </b></td>
                <td style="text-align:center" width="45px" ><b> Cantidad </b></td>
                <td style="text-align:center" width="45px" ><b> Total </b></td>
            </tr>

            <tr>
                <td> '.$detalle.' </td>
                <td style="text-align:center"> '.$precio.' </td>
                <td style="text-align:center"> '.$cantidad.' </td>
                <td style="text-align:center"> COL$ '.$total.' </td>
            </tr>
            </table>
            <p style="text-align:rigth">
            <b> Monto Total: </b> COL$ '.$monto_total.'
            </p>

            <p>
             <b> Son: </b> '.$monto_literal.'
            </p>
             ----------------------------------------------------------------------------------- <br>
            <b> USUARIO:</b> '.$user_sesion.' <br><br><br><br><br><br><br><br><br>
            <p style="text-align:center" >
            </p>

            <p style="text-align:center" ><b> GRACIAS POR SU PREFERENCIA </b></p>

        </div>
    </p>
</div>
';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

$style = array(
    'border' => 0,
    'vpadding' => 'auto',
    'hpadding' => 'auto',
    'fgcolor' => array(0, 0, 0),
    'bgcolor' => false, //array(255,255,255)
    'module_width' => 1, // width of a single module in points
    'module_height' => 1 // height of a single module in points
);

$pdf->write2DBarcode($qr,'QRCODE,L',  25,112,30,30, $style);



//Close and output PDF document
$pdf->Output('Factura.pdf', 'I');


//============================================================+
// END OF FILE
//============================================================+
