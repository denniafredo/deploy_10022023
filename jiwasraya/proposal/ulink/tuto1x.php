<?php
  include "./includes/database.php"; 
  include "./includes/session.php"; 
	include "./includes/common.php";
  include "./includes/pertanggungan.php";
	include "./includes/klien.php";
  $DB = new Database($userid, $passwd, $DBName);
	$DA = new Database($userid, $passwd, $DBName);


$sql1="select $DBUser.polis.getnotes2('$prefixpertanggungan','$nopertanggungan') notes from dual";
$DB->parse($sql1);
$DB->execute();
$res=$DB->nextrow();
$notes = $res["NOTES"];
//echo "<pre class=sans10>$notes</pre>";
	
include('./includes/fpdf.php');

//$pdf = new FPDF();
$pdf = new FPDF('L','cm',array(27,57));
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,'dd');
$pdf->Output();
?>
