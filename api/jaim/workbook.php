<?php
	/*
	* API file untuk aplikasi jaim
	* method untuk data workbook
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
	$p7 = isset($_GET['p7']) ? $_GET['p7'] : '';
	
	$DB = new Database(C_USER_DB_JLINDO, C_PASS_DB_JLINDO, C_DB_JLINDO);
	
	/*===== tarik data agenda agen sebawah =====*/
	if (strcasecmp($r, '1') == 0) {
		$office = !empty($p6) ? " AND a.KDAREAOFFICE = '$p6' " : null;
		$unit = !empty($p7) ? " AND a.KDUNITPRODUKSI = '$p7' " : null;
		
		$sql = "SELECT * FROM 
				(
					SELECT tbl.*, rownum no 
					FROM 
					(
						SELECT a.PREFIXAGEN, a.NOAGEN, NAMAKLIEN1, a.KDJABATANAGEN, c.URUTAN, c.NAMAJABATANAGEN, 
							e.KDAREAOFFICE, e.NAMAAREAOFFICE, a.KDUNITPRODUKSI, f.NAMAUNITPRODUKSI, COUNT(b.NOAGENDA) JMLAGENDA, 
							MAX(b.TGLREKAM) TGLREKAM
						FROM TABEL_400_AGEN a 
						LEFT OUTER JOIN JAIM_200_AGENDA@JAIM b ON a.NOAGEN = b.NOAGEN 
						INNER JOIN TABEL_413_JABATAN_AGEN c ON a.KDJABATANAGEN = c.KDJABATANAGEN 
						INNER JOIN TABEL_100_KLIEN d ON a.NOAGEN = d.NOKLIEN 
						LEFT OUTER JOIN TABEL_410_AREA_OFFICE e ON a.KDKANTOR = e.KDKANTOR AND a.KDAREAOFFICE = e.KDAREAOFFICE 
						LEFT OUTER JOIN TABEL_410_KODE_UNIT_PRODUKSI f ON a.KDKANTOR = f.KDKANTOR AND a.KDAREAOFFICE = f.KDAREAOFFICE 
							AND a.KDUNITPRODUKSI = f.KDUNITPRODUKSI 
						LEFT OUTER JOIN JAIM_900_USER@JAIM g ON a.NOAGEN = g.USERNAME
						WHERE a.KDSTATUSAGEN = '01' AND a.KDKANTOR = '$p3' AND a.NOAGEN <> '$p4'
							$office $unit 
							AND (LOWER(a.PREFIXAGEN) || LOWER(a.NOAGEN) LIKE '%$p5%' OR 
							LOWER(NAMAKLIEN1) LIKE '%$p5%' OR
							LOWER(c.NAMAJABATANAGEN) LIKE '%$p5%' OR
							LOWER(e.NAMAAREAOFFICE) LIKE '%$p5%' OR
							LOWER(f.NAMAUNITPRODUKSI) LIKE '%$p5%')
						GROUP BY a.PREFIXAGEN, a.NOAGEN, NAMAKLIEN1, a.KDJABATANAGEN, c.URUTAN, c.NAMAJABATANAGEN,
							e.KDAREAOFFICE, e.NAMAAREAOFFICE, a.KDUNITPRODUKSI, f.NAMAUNITPRODUKSI, g.IDUSER
						ORDER BY TGLREKAM DESC NULLS LAST, JMLAGENDA DESC, KDAREAOFFICE NULLS FIRST, KDUNITPRODUKSI NULLS FIRST, URUTAN, NAMAKLIEN1
					) tbl 
					WHERE rownum < (($p * $p2) + 1 ) 
				) 
				WHERE no >= ((($p-1) * $p2) + 1)";
		
		$DB->parse($sql);
		$DB->execute();
		
		echo json_encode($DB->result());
		//echo $sql;
	}
	
	
	/*===== tarik total agenda sebawah =====*/
	if (strcasecmp($r, '2') == 0) {
		$office = !empty($p6) ? " AND a.KDAREAOFFICE = '$p6' " : null;
		$unit = !empty($p7) ? " AND a.KDUNITPRODUKSI = '$p7' " : null;
		
		$sql = "SELECT a.PREFIXAGEN, a.NOAGEN, NAMAKLIEN1, a.KDJABATANAGEN, c.URUTAN, c.NAMAJABATANAGEN, 
					e.KDAREAOFFICE, e.NAMAAREAOFFICE, a.KDUNITPRODUKSI, f.NAMAUNITPRODUKSI, COUNT(b.NOAGENDA) JMLAGENDA
				FROM TABEL_400_AGEN a 
				LEFT OUTER JOIN JAIM_200_AGENDA@JAIM b ON a.NOAGEN = b.NOAGEN 
				INNER JOIN TABEL_413_JABATAN_AGEN c ON a.KDJABATANAGEN = c.KDJABATANAGEN 
				INNER JOIN TABEL_100_KLIEN d ON a.NOAGEN = d.NOKLIEN 
				LEFT OUTER JOIN TABEL_410_AREA_OFFICE e ON a.KDKANTOR = e.KDKANTOR AND a.KDAREAOFFICE = e.KDAREAOFFICE 
				LEFT OUTER JOIN TABEL_410_KODE_UNIT_PRODUKSI f ON a.KDKANTOR = f.KDKANTOR AND a.KDAREAOFFICE = f.KDAREAOFFICE 
					AND a.KDUNITPRODUKSI = f.KDUNITPRODUKSI 
				LEFT OUTER JOIN JAIM_900_USER@JAIM g ON a.NOAGEN = g.USERNAME
				WHERE a.KDSTATUSAGEN = '01' AND a.KDKANTOR = '$p3' AND a.NOAGEN <> '$p4'
					$office $unit 
					AND (LOWER(a.PREFIXAGEN) || LOWER(a.NOAGEN) LIKE '%$p5%' OR 
					LOWER(NAMAKLIEN1) LIKE '%$p5%' OR
					LOWER(c.NAMAJABATANAGEN) LIKE '%$p5%' OR
					LOWER(e.NAMAAREAOFFICE) LIKE '%$p5%' OR
					LOWER(f.NAMAUNITPRODUKSI) LIKE '%$p5%')
				GROUP BY a.PREFIXAGEN, a.NOAGEN, NAMAKLIEN1, a.KDJABATANAGEN, c.URUTAN, c.NAMAJABATANAGEN,
					e.KDAREAOFFICE, e.NAMAAREAOFFICE, a.KDUNITPRODUKSI, f.NAMAUNITPRODUKSI, g.IDUSER
				ORDER BY JMLAGENDA DESC, KDAREAOFFICE NULLS FIRST, KDUNITPRODUKSI NULLS FIRST, URUTAN, NAMAKLIEN1";
		
		$DB->parse($sql);
		$DB->execute();
		
		echo count($DB->result());
		//echo $sql;*/
	}
	
	
	/*===== tarik data prospek agen cabang sebawah =====*/
	if (strcasecmp($r, '3') == 0) {
		$office = !empty($p6) ? " AND a.KDAREAOFFICE = '$p6' " : null;
		$unit = !empty($p7) ? " AND a.KDUNITPRODUKSI = '$p7' " : null;
		
		$sql = "SELECT * FROM 
				(
					SELECT tbl.*, rownum no 
					FROM 
					(
						SELECT a.PREFIXAGEN, a.NOAGEN, NAMAKLIEN1, a.KDJABATANAGEN, c.URUTAN, c.NAMAJABATANAGEN, 
							e.KDAREAOFFICE, e.NAMAAREAOFFICE, a.KDUNITPRODUKSI, f.NAMAUNITPRODUKSI, COUNT(b.NOPROSPEK) JMLPROSPEK,
							MAX(b.TGLREKAM) TGLREKAM
						FROM TABEL_400_AGEN a 
						LEFT OUTER JOIN JAIM_201_PROSPEK@JAIM b ON a.NOAGEN = b.NOAGEN AND a.KDKANTOR = b.KDKANTOR
						INNER JOIN TABEL_413_JABATAN_AGEN c ON a.KDJABATANAGEN = c.KDJABATANAGEN 
						INNER JOIN TABEL_100_KLIEN d ON a.NOAGEN = d.NOKLIEN 
						LEFT OUTER JOIN TABEL_410_AREA_OFFICE e ON a.KDKANTOR = e.KDKANTOR AND a.KDAREAOFFICE = e.KDAREAOFFICE 
						LEFT OUTER JOIN TABEL_410_KODE_UNIT_PRODUKSI f ON a.KDKANTOR = f.KDKANTOR AND a.KDAREAOFFICE = f.KDAREAOFFICE 
							AND a.KDUNITPRODUKSI = f.KDUNITPRODUKSI 
						LEFT OUTER JOIN JAIM_900_USER@JAIM g ON a.NOAGEN = g.USERNAME
						WHERE a.KDSTATUSAGEN = '01' AND a.KDKANTOR = '$p3' AND a.NOAGEN <> '$p4'
							$office $unit 
							AND (LOWER(a.PREFIXAGEN) || LOWER(a.NOAGEN) LIKE '%$p5%' OR 
							LOWER(NAMAKLIEN1) LIKE '%$p5%' OR
							LOWER(c.NAMAJABATANAGEN) LIKE '%$p5%' OR
							LOWER(e.NAMAAREAOFFICE) LIKE '%$p5%' OR
							LOWER(f.NAMAUNITPRODUKSI) LIKE '%$p5%')
						GROUP BY a.PREFIXAGEN, a.NOAGEN, NAMAKLIEN1, a.KDJABATANAGEN, c.URUTAN, c.NAMAJABATANAGEN,
							e.KDAREAOFFICE, e.NAMAAREAOFFICE, a.KDUNITPRODUKSI, f.NAMAUNITPRODUKSI, g.IDUSER
						ORDER BY TGLREKAM DESC NULLS LAST, JMLPROSPEK DESC, KDAREAOFFICE NULLS FIRST, KDUNITPRODUKSI NULLS FIRST, URUTAN, NAMAKLIEN1
					) tbl 
					WHERE rownum < (($p * $p2) + 1 ) 
				) 
				WHERE no >= ((($p-1) * $p2) + 1)";
		
		$DB->parse($sql);
		$DB->execute();
		
		echo json_encode($DB->result());
		//echo $sql;
	}
	
	
	/*===== tarik total prospek agen cabang sebawah =====*/
	if (strcasecmp($r, '4') == 0) {
		$office = !empty($p6) ? " AND a.KDAREAOFFICE = '$p6' " : null;
		$unit = !empty($p7) ? " AND a.KDUNITPRODUKSI = '$p7' " : null;
		
		$sql = "SELECT a.PREFIXAGEN, a.NOAGEN, NAMAKLIEN1, a.KDJABATANAGEN, c.URUTAN, c.NAMAJABATANAGEN, 
					e.KDAREAOFFICE, e.NAMAAREAOFFICE, a.KDUNITPRODUKSI, f.NAMAUNITPRODUKSI, COUNT(b.NOPROSPEK) JMLPROSPEK
				FROM TABEL_400_AGEN a 
				LEFT OUTER JOIN JAIM_201_PROSPEK@JAIM b ON a.NOAGEN = b.NOAGEN AND a.KDKANTOR = b.KDKANTOR
				INNER JOIN TABEL_413_JABATAN_AGEN c ON a.KDJABATANAGEN = c.KDJABATANAGEN 
				INNER JOIN TABEL_100_KLIEN d ON a.NOAGEN = d.NOKLIEN 
				LEFT OUTER JOIN TABEL_410_AREA_OFFICE e ON a.KDKANTOR = e.KDKANTOR AND a.KDAREAOFFICE = e.KDAREAOFFICE 
				LEFT OUTER JOIN TABEL_410_KODE_UNIT_PRODUKSI f ON a.KDKANTOR = f.KDKANTOR AND a.KDAREAOFFICE = f.KDAREAOFFICE 
					AND a.KDUNITPRODUKSI = f.KDUNITPRODUKSI 
				LEFT OUTER JOIN JAIM_900_USER@JAIM g ON a.NOAGEN = g.USERNAME
				WHERE a.KDSTATUSAGEN = '01' AND a.KDKANTOR = '$p3' AND a.NOAGEN <> '$p4'
					$office $unit 
					AND (LOWER(a.PREFIXAGEN) || LOWER(a.NOAGEN) LIKE '%$p5%' OR 
					LOWER(NAMAKLIEN1) LIKE '%$p5%' OR
					LOWER(c.NAMAJABATANAGEN) LIKE '%$p5%' OR
					LOWER(e.NAMAAREAOFFICE) LIKE '%$p5%' OR
					LOWER(f.NAMAUNITPRODUKSI) LIKE '%$p5%')
				GROUP BY a.PREFIXAGEN, a.NOAGEN, NAMAKLIEN1, a.KDJABATANAGEN, c.URUTAN, c.NAMAJABATANAGEN,
					e.KDAREAOFFICE, e.NAMAAREAOFFICE, a.KDUNITPRODUKSI, f.NAMAUNITPRODUKSI, g.IDUSER
				ORDER BY JMLPROSPEK DESC, KDAREAOFFICE NULLS FIRST, KDUNITPRODUKSI NULLS FIRST, URUTAN, NAMAKLIEN1";
		
		$DB->parse($sql);
		$DB->execute();
		
		echo count($DB->result());
		//echo $sql;*/
	}
	
	
	/*===== tarik data prospek agen wilayah sebawah =====*/
	if (strcasecmp($r, '5') == 0) {
		$office = !empty($p6) ? " AND a.KDAREAOFFICE = '$p6' " : null;
		$unit = !empty($p7) ? " AND a.KDUNITPRODUKSI = '$p7' " : null;
		
		$sql = "SELECT * FROM 
				(
					SELECT tbl.*, rownum no 
					FROM 
					(
						SELECT a.PREFIXAGEN, a.NOAGEN, NAMAKLIEN1, a.KDJABATANAGEN, c.URUTAN, c.NAMAJABATANAGEN, 
							e.KDAREAOFFICE, e.NAMAAREAOFFICE, a.KDUNITPRODUKSI, f.NAMAUNITPRODUKSI, COUNT(b.NOPROSPEK) JMLPROSPEK, MAX(b.TGLREKAM) TGLREKAM,
							a.KDKANTOR
						FROM TABEL_400_AGEN a 
						LEFT OUTER JOIN JAIM_201_PROSPEK@JAIM b ON a.NOAGEN = b.NOAGEN AND a.KDKANTOR = b.KDKANTOR
						INNER JOIN TABEL_413_JABATAN_AGEN c ON a.KDJABATANAGEN = c.KDJABATANAGEN 
						INNER JOIN TABEL_100_KLIEN d ON a.NOAGEN = d.NOKLIEN 
						LEFT OUTER JOIN TABEL_410_AREA_OFFICE e ON a.KDKANTOR = e.KDKANTOR AND a.KDAREAOFFICE = e.KDAREAOFFICE 
						LEFT OUTER JOIN TABEL_410_KODE_UNIT_PRODUKSI f ON a.KDKANTOR = f.KDKANTOR AND a.KDAREAOFFICE = f.KDAREAOFFICE 
							AND a.KDUNITPRODUKSI = f.KDUNITPRODUKSI 
						LEFT OUTER JOIN JAIM_900_USER@JAIM g ON a.NOAGEN = g.USERNAME
						LEFT OUTER JOIN TABEL_001_KANTOR h ON a.KDKANTOR = h.KDKANTOR
						WHERE a.KDSTATUSAGEN = '01' AND (a.KDKANTOR = '$p3' OR h.KDKANTORINDUK = '$p3') AND a.NOAGEN <> '$p4'
							$office $unit 
							AND (LOWER(a.PREFIXAGEN) || LOWER(a.NOAGEN) LIKE '%$p5%' OR 
							LOWER(NAMAKLIEN1) LIKE '%$p5%' OR
							LOWER(c.NAMAJABATANAGEN) LIKE '%$p5%' OR
							LOWER(e.NAMAAREAOFFICE) LIKE '%$p5%' OR
							LOWER(f.NAMAUNITPRODUKSI) LIKE '%$p5%')
						GROUP BY a.PREFIXAGEN, a.NOAGEN, NAMAKLIEN1, a.KDJABATANAGEN, c.URUTAN, c.NAMAJABATANAGEN,
							e.KDAREAOFFICE, e.NAMAAREAOFFICE, a.KDUNITPRODUKSI, f.NAMAUNITPRODUKSI, g.IDUSER, a.KDKANTOR
						ORDER BY TGLREKAM DESC NULLS LAST, JMLPROSPEK DESC, KDAREAOFFICE NULLS FIRST, KDUNITPRODUKSI NULLS FIRST, URUTAN, NAMAKLIEN1
					) tbl 
					WHERE rownum < (($p * $p2) + 1 ) 
				) 
				WHERE no >= ((($p-1) * $p2) + 1)";
		
		$DB->parse($sql);
		$DB->execute();
		
		echo json_encode($DB->result());
		//echo $sql;
	}
	
	
	/*===== tarik total prospek agen wilayah sebawah =====*/
	if (strcasecmp($r, '6') == 0) {
		$office = !empty($p6) ? " AND a.KDAREAOFFICE = '$p6' " : null;
		$unit = !empty($p7) ? " AND a.KDUNITPRODUKSI = '$p7' " : null;
		
		$sql = "SELECT a.PREFIXAGEN, a.NOAGEN, NAMAKLIEN1, a.KDJABATANAGEN, c.URUTAN, c.NAMAJABATANAGEN, 
					e.KDAREAOFFICE, e.NAMAAREAOFFICE, a.KDUNITPRODUKSI, f.NAMAUNITPRODUKSI, COUNT(b.NOPROSPEK) JMLPROSPEK, MAX(b.TGLREKAM) TGLREKAM,
					a.KDKANTOR
				FROM TABEL_400_AGEN a 
				LEFT OUTER JOIN JAIM_201_PROSPEK@JAIM b ON a.NOAGEN = b.NOAGEN AND a.KDKANTOR = b.KDKANTOR
				INNER JOIN TABEL_413_JABATAN_AGEN c ON a.KDJABATANAGEN = c.KDJABATANAGEN 
				INNER JOIN TABEL_100_KLIEN d ON a.NOAGEN = d.NOKLIEN 
				LEFT OUTER JOIN TABEL_410_AREA_OFFICE e ON a.KDKANTOR = e.KDKANTOR AND a.KDAREAOFFICE = e.KDAREAOFFICE 
				LEFT OUTER JOIN TABEL_410_KODE_UNIT_PRODUKSI f ON a.KDKANTOR = f.KDKANTOR AND a.KDAREAOFFICE = f.KDAREAOFFICE 
					AND a.KDUNITPRODUKSI = f.KDUNITPRODUKSI 
				LEFT OUTER JOIN JAIM_900_USER@JAIM g ON a.NOAGEN = g.USERNAME
				LEFT OUTER JOIN TABEL_001_KANTOR h ON a.KDKANTOR = h.KDKANTOR
				WHERE a.KDSTATUSAGEN = '01' AND (a.KDKANTOR = '$p3' OR h.KDKANTORINDUK = '$p3') AND a.NOAGEN <> '$p4'
					$office $unit 
					AND (LOWER(a.PREFIXAGEN) || LOWER(a.NOAGEN) LIKE '%$p5%' OR 
					LOWER(NAMAKLIEN1) LIKE '%$p5%' OR
					LOWER(c.NAMAJABATANAGEN) LIKE '%$p5%' OR
					LOWER(e.NAMAAREAOFFICE) LIKE '%$p5%' OR
					LOWER(f.NAMAUNITPRODUKSI) LIKE '%$p5%')
				GROUP BY a.PREFIXAGEN, a.NOAGEN, NAMAKLIEN1, a.KDJABATANAGEN, c.URUTAN, c.NAMAJABATANAGEN,
					e.KDAREAOFFICE, e.NAMAAREAOFFICE, a.KDUNITPRODUKSI, f.NAMAUNITPRODUKSI, g.IDUSER, a.KDKANTOR
				ORDER BY TGLREKAM DESC NULLS LAST, JMLPROSPEK DESC, KDAREAOFFICE NULLS FIRST, KDUNITPRODUKSI NULLS FIRST, URUTAN, NAMAKLIEN1";
		
		$DB->parse($sql);
		$DB->execute();
		
		echo count($DB->result());
		//echo $sql;*/
	}
	
	
	/*===== tarik data rekap prospek agen se wilayah =====*/
	if (strcasecmp($r, '7') == 0) {
		
		$sql = "SELECT e.KDKANTOR, e.NOAGEN, f.NAMAKLIEN1, g.NAMAJABATANAGEN, h.NAMAAREAOFFICE, i.NAMAUNITPRODUKSI,
					NAMA, ALAMAT, KOTA, TELP, HP, TRUNC(MONTHS_BETWEEN(SYSDATE, j.TGLLAHIR)/12) USIA_TH,
					a.BUILD_ID NO_PROPOSAL, k.NAMA_PRODUK, a.CARA_BAYAR, a.JUMLAH_PREMI,
					NVL(d.NAMASTATUS, 'Baru') NAMASTATUS, c.TGLREKAM,
					CASE WHEN l.KDKANTORINDUK IS NOT NULL THEN l.KDKANTORINDUK ELSE e.KDKANTOR END KDWILAYAH
				FROM JAIM_300_HITUNG@JAIM a
				LEFT OUTER JOIN JAIM_300_PRODUK@JAIM b ON a.ID_PRODUK = b.ID_PRODUK
				LEFT OUTER JOIN (
					SELECT MAX(KDSTATUS) KDSTATUS, BUILD_ID, TO_CHAR(MAX(TGLREKAM), 'DD/MM/YYYY') TGLREKAM
					FROM JAIM_203_PROSPEK_FOLLOWUP@JAIM za
					GROUP BY BUILD_ID
				) c ON a.BUILD_ID = c.BUILD_ID
				LEFT OUTER JOIN JAIM_201_STATUS_PROSPEK@JAIM d ON c.KDSTATUS = d.KDSTATUS
				LEFT OUTER JOIN TABEL_400_AGEN e ON a.ID_AGEN = e.NOAGEN
				LEFT OUTER JOIN TABEL_100_KLIEN f ON e.NOAGEN = f.NOKLIEN
				LEFT OUTER JOIN TABEL_413_JABATAN_AGEN g ON e.KDJABATANAGEN = g.KDJABATANAGEN
				LEFT OUTER JOIN TABEL_410_AREA_OFFICE h ON e.KDAREAOFFICE = h.KDAREAOFFICE AND e.KDKANTOR = h.KDKANTOR
				LEFT OUTER JOIN TABEL_410_KODE_UNIT_PRODUKSI i ON e.KDKANTOR = i.KDKANTOR AND e.KDAREAOFFICE = i.KDAREAOFFICE 
					AND e.KDUNITPRODUKSI = i.KDUNITPRODUKSI
				LEFT OUTER JOIN JAIM_201_PROSPEK@JAIM j ON a.NO_PROSPEK = j.NOPROSPEK
				LEFT OUTER JOIN JAIM_300_PRODUK@JAIM k ON a.ID_PRODUK = k.ID_PRODUK
				LEFT OUTER JOIN TABEL_001_KANTOR l ON SUBSTR(NO_PROSPEK, 0, 2) = l.KDKANTOR
				WHERE (SUBSTR(NO_PROSPEK, 0, 2) IN (SELECT KDKANTOR FROM TABEL_001_KANTOR WHERE KDKANTORINDUK = '$p')
					OR SUBSTR(NO_PROSPEK, 0, 2) = '$p')
					AND TO_DATE(c.TGLREKAM, 'dd/mm/yyyy') BETWEEN TO_DATE('$p2', 'dd/mm/yyyy') AND TO_DATE('$p3', 'dd/mm/yyyy')
					AND e.KDSTATUSAGEN = '01'";
		
		$DB->parse($sql);
		$DB->execute();
		
		echo json_encode($DB->result());
		//echo $sql;
	}
	
	
	/*===== tarik data rekap prospek agen se cabang & ho =====*/
	if (strcasecmp($r, '8') == 0) {
		$sql = "SELECT e.KDKANTOR, e.NOAGEN, f.NAMAKLIEN1, g.NAMAJABATANAGEN, h.NAMAAREAOFFICE, i.NAMAUNITPRODUKSI,
					NAMA, ALAMAT, KOTA, TELP, HP, TRUNC(MONTHS_BETWEEN(SYSDATE, j.TGLLAHIR)/12) USIA_TH,
					a.BUILD_ID NO_PROPOSAL, k.NAMA_PRODUK, a.CARA_BAYAR, a.JUMLAH_PREMI,
					NVL(d.NAMASTATUS, 'Baru') NAMASTATUS, c.TGLREKAM,
					CASE WHEN l.KDKANTORINDUK IS NOT NULL THEN l.KDKANTORINDUK ELSE e.KDKANTOR END KDWILAYAH
				FROM JAIM_300_HITUNG@JAIM a
				LEFT OUTER JOIN JAIM_300_PRODUK@JAIM b ON a.ID_PRODUK = b.ID_PRODUK
				LEFT OUTER JOIN (
					SELECT MAX(KDSTATUS) KDSTATUS, BUILD_ID, TO_CHAR(MAX(TGLREKAM), 'DD/MM/YYYY') TGLREKAM
					FROM JAIM_203_PROSPEK_FOLLOWUP@JAIM za
					GROUP BY BUILD_ID
				) c ON a.BUILD_ID = c.BUILD_ID
				LEFT OUTER JOIN JAIM_201_STATUS_PROSPEK@JAIM d ON c.KDSTATUS = d.KDSTATUS
				LEFT OUTER JOIN TABEL_400_AGEN e ON a.ID_AGEN = e.NOAGEN
				LEFT OUTER JOIN TABEL_100_KLIEN f ON e.NOAGEN = f.NOKLIEN
				LEFT OUTER JOIN TABEL_413_JABATAN_AGEN g ON e.KDJABATANAGEN = g.KDJABATANAGEN
				LEFT OUTER JOIN TABEL_410_AREA_OFFICE h ON e.KDAREAOFFICE = h.KDAREAOFFICE AND e.KDKANTOR = h.KDKANTOR
				LEFT OUTER JOIN TABEL_410_KODE_UNIT_PRODUKSI i ON e.KDKANTOR = i.KDKANTOR AND e.KDAREAOFFICE = i.KDAREAOFFICE 
					AND e.KDUNITPRODUKSI = i.KDUNITPRODUKSI
				LEFT OUTER JOIN JAIM_201_PROSPEK@JAIM j ON a.NO_PROSPEK = j.NOPROSPEK
				LEFT OUTER JOIN JAIM_300_PRODUK@JAIM k ON a.ID_PRODUK = k.ID_PRODUK
				LEFT OUTER JOIN TABEL_001_KANTOR l ON SUBSTR(NO_PROSPEK, 0, 2) = l.KDKANTOR
				WHERE SUBSTR(NO_PROSPEK, 0, 2) LIKE '$p%' 
					AND TO_DATE(c.TGLREKAM, 'dd/mm/yyyy') BETWEEN TO_DATE('$p2', 'dd/mm/yyyy') AND TO_DATE('$p3', 'dd/mm/yyyy')
					AND e.NOAGEN <> '0011300167' AND LENGTH(e.NOAGEN) > 0
					AND e.KDSTATUSAGEN = '01'
					OR SUBSTR(NO_PROSPEK, 0, 2) IN (SELECT KDKANTOR FROM TABEL_001_KANTOR WHERE KDKANTORINDUK = '$p')";
		
		$DB->parse($sql);
		$DB->execute();
		
		echo json_encode($DB->result());
		//echo $sql;
	}
	
	
	/*===== tarik data proposal agen by id prospek =====*/
	if (strcasecmp($r, '9') == 0) {
		$sql = "SELECT a.noproposal, a.id_produk, a.nama_produk, a.cara_bayar, a.jumlah_premi, 
					TO_CHAR(a.tgl_rekam,'dd/mm/yyyy') tglrekam, a.file_pdf, a.kdstatus, 
					CASE WHEN (a.kdstatus = '3' AND a.dokumenlengkap = 0) OR (a.kdstatus = '4' AND a.suspend = 1)
                                                THEN b.namastatus || ' (Pending)'
					    ELSE b.namastatus 
					END namastatus, a.namastatusfile, a.JUA
				FROM (
					SELECT a.build_id noproposal, a.id_produk, nama_produk, a.cara_bayar,
						NVL(TRIM(a.jumlah_premi), 0) jumlah_premi, a.tgl_rekam, a.file_pdf,
						CASE WHEN sysdate NOT BETWEEN a.tgl_rekam AND ADD_MONTHS(a.tgl_rekam, 1) AND d.nosp IS NULL THEN '99' 
                            WHEN c.nosp IS NULL AND d.nosp IS NULL AND e.nopertanggungan IS NULL AND f.nopertanggungan IS NULL THEN '2' 
                            WHEN c.nosp IS NOT NULL AND d.nosp IS NULL AND e.nopertanggungan IS NULL AND f.nopertanggungan IS NULL THEN '3' 
                            WHEN d.kdpertanggungan = '1' AND e.nopertanggungan IS NULL AND f.nopertanggungan IS NULL THEN '4' 
                            WHEN d.kdpertanggungan = '1' AND e.kdunderwriting = '1' AND f.nopertanggungan IS NULL THEN '5' 
                            WHEN d.kdpertanggungan = '1' AND e.kdunderwriting = '1' AND f.kdacceptance = '1' THEN '6' 
                            WHEN d.kdpertanggungan = '2' AND f.kdcetakpolis is NULL THEN '7'
                            WHEN f.kdcetakpolis = '1' AND h.kdverifikasi is NULL THEN '8'
                            WHEN h.kdverifikasi = '1' AND h.kdkirim is NULL THEN '9'
                            WHEN h.kdkirim = '1' THEN '10' 
                        END kdstatus, g.namastatusfile, c.dokumenlengkap, a.JUA, d.suspend
					FROM jaim_300_hitung@JAIM a
					LEFT OUTER JOIN jaim_300_produk@JAIM b ON a.id_produk = b.id_produk
					LEFT OUTER JOIN tabel_ul_spaj_temp c ON a.build_id = c.buildid
					LEFT OUTER JOIN tabel_200_pertanggungan d ON c.nosp = d.nosp
					LEFT OUTER JOIN tabel_214_underwriting e ON d.prefixpertanggungan = e.prefixpertanggungan
						AND d.nopertanggungan = e.nopertanggungan
					LEFT OUTER JOIN tabel_214_acceptance_dokumen f ON d.prefixpertanggungan = f.prefixpertanggungan
						AND d.nopertanggungan = f.nopertanggungan
					LEFT OUTER JOIN tabel_299_status_file g ON d.kdstatusfile = g.kdstatusfile
					LEFT OUTER JOIN tabel_214_verify_cetak_polis h ON d.prefixpertanggungan = h.prefixpertanggungan
                        AND d.nopertanggungan = h.nopertanggungan
					WHERE a.no_prospek = '$p' AND a.dihapus = 0
				) a
				LEFT OUTER JOIN jaim_201_status_prospek@JAIM b ON a.kdstatus = b.kdstatus
			  ORDER BY tgl_rekam DESC";
		
		$DB->parse($sql);
		$DB->execute();
		
		echo json_encode($DB->result());
		//echo $sql;
	}
	
	
	/*===== tarik data status proposal agen by build id =====*/
	if (strcasecmp($r, '10') == 0) {
		$sql = "SELECT b.namastatus, 'Agen' oleh, to_char(a.tglrekam, 'dd/mm/yyyy hh24:mi:ss') tglrekam, c.namaklien1, a.keterangan
				FROM jaim_203_prospek_followup@jaim a
				INNER JOIN jaim_201_status_prospek@jaim b ON a.kdstatus = b.kdstatus
				INNER JOIN tabel_100_klien c ON a.userrekam = c.noklien
				WHERE a.build_id = '$p'
				
				UNION ALL
				
				SELECT CASE WHEN a.dokumenlengkap = 0 THEN b.namastatus || ' (Pending)' ELSE b.namastatus END namastatus, 
				    'Operasional' oleh, to_char(a.tglrekam, 'dd/mm/yyyy hh24:mi:ss') tglrekam, 
                    c.namauser, 'no spaj : ' || a.nosp || (
                        CASE WHEN d.nospa IS NOT NULL THEN '<br>Kekurangan Dokumen : ' || d.namadokumen ELSE null END
                    ) keterangan
				FROM tabel_ul_spaj_temp a
				INNER JOIN jaim_201_status_prospek@jaim b ON 3 = b.kdstatus
				INNER JOIN tabel_888_userid c ON a.userrekam = c.userid
				LEFT OUTER JOIN (
                    SELECT nospa, LISTAGG(b.namadokumen, ', ') WITHIN GROUP (ORDER BY a.kddokumen) namadokumen
                    FROM tabel_704_cek_dok_spaj a
                    INNER JOIN tabel_903_dokumen_klaim b ON a.kddokumen = b.kddokumen
                    WHERE status = 0
                    GROUP BY nospa
                ) d ON a.nosp = d.nospa
				WHERE a.buildid = '$p'
				
				UNION ALL
				
				SELECT CASE WHEN b.suspend = 1 THEN c.namastatus || ' (Pending)' ELSE c.namastatus END namastatus, 
				    'Pertanggungan' oleh, to_char(b.tglrekam, 'dd/mm/yyyy hh24:mi:ss') tglrekam, d.namauser, 'no proposal : ' || b.prefixpertanggungan || '-' || b.nopertanggungan ||
				    CASE WHEN b.suspend = 1 THEN '<br>Alasan : ' || b.keterangan ELSE null END keterangan
				FROM tabel_ul_spaj_temp a
				INNER JOIN tabel_200_pertanggungan b ON a.nosp = b.nosp
				INNER JOIN jaim_201_status_prospek@jaim c ON 4 = c.kdstatus
				LEFT OUTER JOIN tabel_888_userid d ON b.userrekam = d.userid
				WHERE a.buildid = '$p'

				UNION ALL
					
				SELECT d.namastatus, 'Pertanggungan' oleh, to_char(c.tglunderwriting, 'dd/mm/yyyy hh24:mi:ss') tglrekam, e.namauser, '' keterangan
				FROM tabel_ul_spaj_temp a
				INNER JOIN tabel_200_pertanggungan b ON a.nosp = b.nosp
				INNER JOIN tabel_214_underwriting c ON b.prefixpertanggungan = c.prefixpertanggungan
					AND b.nopertanggungan = c.nopertanggungan
				INNER JOIN jaim_201_status_prospek@jaim d ON 5 = d.kdstatus
				LEFT OUTER JOIN tabel_888_userid e ON c.userupdated = e.userid
				WHERE a.buildid = '$p'
					AND c.kdunderwriting = '1'
					
				UNION ALL

				SELECT e.namastatus, 'Pembayar Premi' oleh, to_char(d.tglacceptance, 'dd/mm/yyyy hh24:mi:ss') tglrekam, h.namaklien1, 'tgl bayar : ' || TO_CHAR(tglbayar,'dd/mm/yyyy') || ' | ' || g.buktisetor keterangan
				FROM tabel_ul_spaj_temp a
				INNER JOIN tabel_200_pertanggungan b ON a.nosp = b.nosp
				INNER JOIN tabel_214_underwriting c ON b.prefixpertanggungan = c.prefixpertanggungan
					AND b.nopertanggungan = c.nopertanggungan
				INNER JOIN tabel_214_acceptance_dokumen d ON b.prefixpertanggungan = d.prefixpertanggungan
					AND b.nopertanggungan = d.nopertanggungan
				INNER JOIN jaim_201_status_prospek@jaim e ON 6 = e.kdstatus
				LEFT OUTER JOIN tabel_888_userid f ON d.userupdated = f.userid
				INNER JOIN tabel_300_historis_premi g ON b.prefixpertanggungan = g.prefixpertanggungan
				    AND b.nopertanggungan = g.nopertanggungan AND g.kdkuitansi = 'BP3'
				INNER JOIN tabel_100_klien h ON b.nopembayarpremi = h.noklien
				WHERE a.buildid = '$p'
					AND c.kdunderwriting = '1'
					AND d.kdacceptance = '1'
					
				UNION ALL
					
				SELECT c.namastatus, 'Pertanggungan' oleh, to_char(d.tglcetakpolis, 'dd/mm/yyyy hh24:mi:ss') tglrekam, e.namauser, 'status polis : ' || f.namastatusfile keterangan
				FROM tabel_ul_spaj_temp a
				INNER JOIN tabel_200_pertanggungan b ON a.nosp = b.nosp
				INNER JOIN jaim_201_status_prospek@jaim c ON 7 = c.kdstatus
				INNER JOIN tabel_214_acceptance_dokumen d ON b.prefixpertanggungan = d.prefixpertanggungan
					AND b.nopertanggungan = d.nopertanggungan
				LEFT OUTER JOIN tabel_888_userid e ON d.usercetakpolis = e.userid
				LEFT OUTER JOIN tabel_299_status_file f ON b.kdstatusfile = f.kdstatusfile
				WHERE a.buildid = '$p'
					AND b.kdpertanggungan = '2'
                                
                                UNION ALL
                    
                                SELECT c.namastatus, 'Umpeng' oleh, to_char(g.tglkirim, 'dd/mm/yyyy') tglrekam, g.userkirim, 'no resi : ' || g.noresi keterangan
                                FROM tabel_ul_spaj_temp a
                                INNER JOIN tabel_200_pertanggungan b ON a.nosp = b.nosp
                                INNER JOIN jaim_201_status_prospek@jaim c ON 10 = c.kdstatus
                                INNER JOIN tabel_214_verify_cetak_polis g ON b.prefixpertanggungan = g.prefixpertanggungan
                                    AND b.nopertanggungan = g.nopertanggungan
                                WHERE a.buildid = '$p'
                                    AND b.kdpertanggungan = '2'
                                    AND g.kdkirim = '1'";
					
		$DB->parse($sql);
		$DB->execute();
		
		echo json_encode($DB->result());
		//echo $sql;
	}


	/*===== tarik data proposal terakhir =====*/
	if (strcasecmp($r, '11') == 0) {
	    $sql = "SELECT build_id noproposal, nama_produk, jumlah_premi, 
                    CASE WHEN a.kdstatus = '3' AND a.dokumenlengkap = 0 
                        THEN b.namastatus || ' (Pending)' 
                        ELSE b.namastatus 
                    END namastatus, a.namastatusfile
                FROM (
                    SELECT a.build_id, b.nama_produk, a.jumlah_premi, c.dokumenlengkap, 
                        CASE WHEN sysdate NOT BETWEEN tgl_rekam AND ADD_MONTHS(tgl_rekam, 1) AND d.nosp IS NULL THEN '99' ELSE 
                            CASE WHEN c.nosp IS NULL AND d.nosp IS NULL AND e.nopertanggungan IS NULL AND f.nopertanggungan IS NULL THEN '2' ELSE 
                                CASE WHEN c.nosp IS NOT NULL AND d.nosp IS NULL AND e.nopertanggungan IS NULL AND f.nopertanggungan IS NULL THEN '3' ELSE
                                    CASE WHEN d.kdpertanggungan = '1' AND e.nopertanggungan IS NULL AND f.nopertanggungan IS NULL THEN '4' ELSE
                                        CASE WHEN d.kdpertanggungan = '1' AND e.kdunderwriting = '1' AND f.nopertanggungan IS NULL THEN '5' ELSE
                                            CASE WHEN d.kdpertanggungan = '1' AND e.kdunderwriting = '1' AND f.kdacceptance = '1' THEN '6' ELSE 
                                                CASE WHEN d.kdpertanggungan = '2' THEN '7' END
                                            END
                                        END
                                    END
                                END
                            END
                        END kdstatus, g.namastatusfile
                    FROM jaim_300_hitung@jaim a
                    LEFT OUTER JOIN jaim_300_produk@jaim b ON a.id_produk = b.id_produk
                    LEFT OUTER JOIN tabel_ul_spaj_temp c ON a.build_id = c.buildid
                    LEFT OUTER JOIN tabel_200_pertanggungan d ON c.nosp = d.nosp
                    LEFT OUTER JOIN tabel_214_underwriting e ON d.prefixpertanggungan = e.prefixpertanggungan
                        AND d.nopertanggungan = e.nopertanggungan
                    LEFT OUTER JOIN tabel_214_acceptance_dokumen f ON d.prefixpertanggungan = f.prefixpertanggungan
                        AND d.nopertanggungan = f.nopertanggungan
                    LEFT OUTER JOIN tabel_299_status_file g ON d.kdstatusfile = g.kdstatusfile
                    WHERE a.id_agen = '$p'
                    ORDER BY a.tgl_rekam DESC NULLS LAST
                ) a
                LEFT OUTER JOIN jaim_201_status_prospek@JAIM b ON a.kdstatus = b.kdstatus
                WHERE ROWNUM < (6)";
        $DB->parse($sql);
        $DB->execute();

        echo json_encode($DB->result());
        //echo $sql;
    }