<?php

//define('FPDF_FONTPATH','./libs/fpdf153/font/');
//require('./libs/fpdf153/fpdf.php');

define('FPDF_FONTPATH','./libs/fpdf/font/');
require('./libs/fpdf/fpdf.php');


// include "./includes/database.php"; 
// include "./includes/pertanggungan.php";
// include "./includes/klien.php";
// $DA = new database($userid, $passwd, $DBName);
// $DB = new database($userid, $passwd, $DBName);

include "./includes/database.php"; 
include "./includes/session.php"; 
include "./includes/common.php";
include "./includes/pertanggungan.php";	
include "./includes/duit.php";
include "./includes/klien.php";

$DA=New database($userid, $passwd, $DBName);
$DB = New database($userid, $passwd, $DBName);


$numspace = 22;
$numindent = 12;

			
$pdf=new FPDF();
$pdf->Open();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,'Hello World!');
$pdf->Output();



?>