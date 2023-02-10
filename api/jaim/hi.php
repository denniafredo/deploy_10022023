<?php
	/*
	* API file untuk aplikasi jaim
	* method untuk data evaluasi
	*/
	require_once 'includes/config.php';
	require_once 'includes/database.php';
	
	$r	= isset($_GET['r']) ? $_GET['r'] : '';
	$p	= isset($_GET['p']) ? $_GET['p'] : '';
	$p2 = isset($_GET['p2']) ? $_GET['p2'] : '';
	$p3 = isset($_GET['p3']) ? $_GET['p3'] : '';
	$p4 = isset($_GET['p4']) ? $_GET['p4'] : '';
	$p5 = isset($_GET['p5']) ? $_GET['p5'] : '';
	$p6 = isset($_GET['p6']) ? $_GET['p6'] : '';
	$tahunsebelum = date('Y')-1;
	$tahunsekarang = date('Y');
$DB = new Database(C_USER_DB_JLINDO, C_PASS_DB_JLINDO, C_DB_JLINDO);

$sql ="SELECT 	m.noagen,
				m.kdkantor,
           	   	m.kdjabatanagen,
           	   	namajabatanagen,
           	  	o.namaklien1 as namaagen,
           		atasan,
           		(SELECT t.namakantor FROM tabel_001_kantor t where t.kdkantor = m.kdkantor) as namakantor,
           		(SELECT z.namaklien1 FROM tabel_100_klien z where atasan = z.noklien) as namaatasan,
           		(SELECT y.kdjabatanagen FROM tabel_400_agen y where m.atasan = y.noagen) as jabatanatasan,
           		(SELECT NVL(count(noagen),0) FROM tabel_400_agen k where k.noagenrekr = m.noagen and k.kdstatusagen = '01') as totalrekrut,
           		(SELECT NVL(count(noagen),0) FROM tabel_400_agen j where j.noagenrekr = m.noagen and j.nolisensiagen is not null and j.kdstatusagen = '01') as rekrutberlisensi,
           		level as levelhirarki
	   FROM tabel_400_agen m, TABEL_413_JABATAN_AGEN n, tabel_100_klien o
	        WHERE m.kdjabatanagen = n.kdjabatanagen 
	        	  AND noagen = o.noklien
	        	  AND m.KDKANTOR = '$p3'
	        	  and m.kdstatusagen not in ('02','04') 
	        	  AND m.KDJABATANAGEN IN ('00','02','05','09','19')
	      	START WITH m.noagen = '$p6'
	      	CONNECT BY nocycle PRIOR noagen = atasan
	    ";
//echo $sql;
$DB->parse($sql);
$DB->execute();
echo json_encode($DB->nextrow());
?>