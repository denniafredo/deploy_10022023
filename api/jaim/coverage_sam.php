<?php
	/*
	* API file untuk aplikasi jaim
	* method untuk data evaluasi
	*/
	require_once 'includes/config.php';
	require_once 'includes/database.php';
	
	$p	= isset($_GET['p']) ? $_GET['p'] : '';
	
$DB = new Database(C_USER_DB_JLINDO, C_PASS_DB_JLINDO, C_DB_JLINDO);

$sql ="SELECT 	kode_kantor, (SELECT t.namakantor FROM tabel_001_kantor t where t.kdkantor = m.kode_kantor) as namakantor
	   FROM tabel_400_sam_kantor_merge m
	        WHERE m.NO_SAM = '$p'
	    ";
//echo $sql;
$DB->parse($sql);
$DB->execute();
echo json_encode($DB->result());
?>