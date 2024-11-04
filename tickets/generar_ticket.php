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

//Cargar la información del ticket 

// Prepara una consulta para obtener todos los usuarios que estén activos (estado = '1').
$query_tickets = $pdo->prepare("SELECT * FROM tb_tickets WHERE estado = '1'");

// Ejecuta la consulta.
$query_tickets->execute();

// Obtiene todos los resultados de la consulta y los almacena en un array.
$tickets = $query_tickets->fetchAll(PDO::FETCH_ASSOC);

// Itera sobre cada usuario obtenido de la base de datos.
foreach ($tickets as $ticket) {
    // Extrae los datos de cada usuario.
    $id_ticket = $ticket['id_ticket'];
    $nombre_cliente = $ticket['nombre_cliente'];
    $cc_cliente = $ticket['cc_cliente'];
    $cuviculo = $ticket['cuviculo'];
    $fecha_ingreso = $ticket['fecha_ingreso'];
    $hora_ingreso = $ticket['hora_ingreso'];
    $user_sesion = $ticket['user_sesion'];
}


// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, array(79, 80), true, 'UTF-8', false);

// set document information
$pdf->setCreator(PDF_CREATOR);
$pdf->setAuthor('Nicola Asuni');
$pdf->setTitle('TCPDF Example 002');
$pdf->setSubject('TCPDF Tutorial');
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

/*
$id_ticket = $ticket['id_ticket'];
    $nombre_cliente = $ticket['nombre_cliente'];
    $cc_cliente = $ticket['cc_cliente'];
    $cuviculo = $ticket['cuviculo'];
    $fecha_ingreso = $ticket['fecha_ingreso'];
    $hora_ingreso = $ticket['hora_ingreso'];
    $user_sesion = $ticket['user_sesion'];
*/

// create some HTML content
$html = '
<div>
    <p style="text-align: center">
        <b> ' . $nombre_parqueo . ' </b> <br>
        ' . $actividad_empresa . ' <br>
        Sucursal No ' . $sucursal . '<br>
        DIRECCIÓN: ' . $direccion . ' <br>
        TELÉFONO: ' . $telefono . ' <br>
        ' . $departamento_ciudad . '
        -----------------------------------------------------------------------------------
        <div style="text-align:left" > 
            <b> DATOS DEL CLIENTE </b> <br>
            <b> CLIENTE: </b> '. $nombre_cliente .' <br>
            <b> CC: </b> '. $cc_cliente .'
            ----------------------------------------------------------------------------------- <br>
            <b> CUVICULO DE PARQUEO: </b> '. $cuviculo .' <br>
            <b> FECHA DE INGRESO: </b> '. $fecha_ingreso .' <br>
            <b> HORA DE INGRESO: </b> '. $hora_ingreso .'
            ----------------------------------------------------------------------------------- <br>
            <b> USUARIO:</b> '. $user_sesion .' 
        </div>
    </p>
</div>
';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');


//Close and output PDF document
$pdf->Output('example_002.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
