<?php
define('FPDF_FONTPATH','./libs/fpdf/font/');
require('./libs/fpdf/fpdf.php');

$pdf=new FPDF();
$pdf->Open();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,'Hello World!');
$pdf->Output();
?>
