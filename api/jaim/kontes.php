<?php
	/*
	* API file untuk aplikasi jaim
	* method untuk data master
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
	
	$DB = new Database(C_USER_DB_JLINDO, C_PASS_DB_JLINDO, C_DB_JLINDO);

	/*===== data top reward 156 polis =====*/
	if (strcasecmp($r, '1') == 0) {
		$sql = "SELECT * 
				FROM ( 
					SELECT b.KDKANTOR, c.NAMAKANTOR, b.KDAREAOFFICE, d.NAMAAREAOFFICE, b.KDUNITPRODUKSI, e.NAMAUNITPRODUKSI,  
						COUNT(*) JMLPOLIS, SUM(PREMI1) JMLPREMI 
					FROM TABEL_200_PERTANGGUNGAN a 
					INNER JOIN TABEL_400_AGEN b ON a.NOAGEN = b.NOAGEN 
					INNER JOIN TABEL_001_KANTOR c ON b.KDKANTOR = c.KDKANTOR 
					LEFT OUTER JOIN TABEL_410_AREA_OFFICE d ON b.KDKANTOR = d.KDKANTOR AND b.KDAREAOFFICE = d.KDAREAOFFICE 
					LEFT OUTER JOIN TABEL_410_KODE_UNIT_PRODUKSI e ON b.KDKANTOR = e.KDKANTOR AND b.KDAREAOFFICE = e.KDAREAOFFICE AND b.KDUNITPRODUKSI = e.KDUNITPRODUKSI 
					WHERE MULAS BETWEEN TO_DATE('01/10/2015', 'DD/MM/YYYY') AND TO_DATE('31/12/2015', 'DD/MM/YYYY')
						AND KDPERTANGGUNGAN = '2' 
						AND KDSTATUSFILE = '1' AND KDCARABAYAR NOT IN ('X', 'E', 'J') 
						AND PREMI1 >= 500000 AND KDJABATANAGEN IN ('00', '05', '09') 
					GROUP BY b.KDKANTOR, c.NAMAKANTOR, b.KDAREAOFFICE, d.NAMAAREAOFFICE, b.KDUNITPRODUKSI, e.NAMAUNITPRODUKSI 
					ORDER BY JMLPOLIS DESC, JMLPREMI DESC 
				) 
				WHERE ROWNUM <= 12";
		
		$DB->parse($sql);
		$DB->execute();
		
		echo json_encode($DB->result());
		//echo $sql;
	}
	
	
	/*===== data top reward 156 premi =====*/
	if (strcasecmp($r, '2') == 0) {
		$sql = "SELECT * 
				FROM ( 
					SELECT b.KDKANTOR, c.NAMAKANTOR, b.KDAREAOFFICE, d.NAMAAREAOFFICE, COUNT(*) JMLPOLIS, SUM(PREMI1) JMLPREMI 
					FROM TABEL_200_PERTANGGUNGAN a 
					INNER JOIN TABEL_400_AGEN b ON a.NOAGEN = b.NOAGEN 
					INNER JOIN TABEL_001_KANTOR c ON b.KDKANTOR = c.KDKANTOR 
					LEFT OUTER JOIN TABEL_410_AREA_OFFICE d ON b.KDKANTOR = d.KDKANTOR AND b.KDAREAOFFICE = d.KDAREAOFFICE 
					LEFT OUTER JOIN TABEL_410_KODE_UNIT_PRODUKSI e ON b.KDKANTOR = e.KDKANTOR AND b.KDAREAOFFICE = e.KDAREAOFFICE AND b.KDUNITPRODUKSI = e.KDUNITPRODUKSI 
					WHERE MULAS BETWEEN TO_DATE('01/10/2015', 'DD/MM/YYYY') AND TO_DATE('31/12/2015', 'DD/MM/YYYY')
						AND KDPERTANGGUNGAN = '2' 
						AND KDSTATUSFILE = '1' AND KDCARABAYAR IN ('X', 'E', 'J') 
						AND PREMI1 >= 50000000 AND KDJABATANAGEN IN ('00', '05', '09', '02') 
					GROUP BY b.KDKANTOR, c.NAMAKANTOR, b.KDAREAOFFICE, d.NAMAAREAOFFICE 
					ORDER BY JMLPREMI DESC, JMLPOLIS DESC, NAMAKANTOR 
				) 
				WHERE ROWNUM <= 12";
		
		$DB->parse($sql);
		$DB->execute();
		
		echo json_encode($DB->result());
		//echo $sql;
	}