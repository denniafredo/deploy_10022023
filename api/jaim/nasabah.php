<?php
	/*
	* API file untuk aplikasi jaim
	* method untuk data nasabah
	*/
	require_once 'includes/config.php';
	require_once 'includes/database.php';
	
	$r	= isset($_GET['r']) ? $_GET['r'] : '';
	$p	= isset($_GET['p']) ? $_GET['p'] : '';
	$p1	= isset($_GET['p1']) ? $_GET['p1'] : '';
	$p2 = isset($_GET['p2']) ? $_GET['p2'] : '';
	$p3 = isset($_GET['p3']) ? $_GET['p3'] : '';
	$p4 = isset($_GET['p4']) ? $_GET['p4'] : '';
	$p5 = isset($_GET['p5']) ? $_GET['p5'] : '';
	$p6 = isset($_GET['p6']) ? $_GET['p6'] : '';
	
	$DB = new Database(C_USER_DB_JLINDO, C_PASS_DB_JLINDO, C_DB_JLINDO);
	
	
	/*===== tarik data nasabah agen =====*/
	if (strcasecmp($r, '1') == 0) {
		
		$sql = "SELECT * FROM 
				(
					SELECT tbl.*, rownum no
					FROM
					(
						SELECT PREFIXPERTANGGUNGAN || NOPERTANGGUNGAN NOPOLIS, a.NOPOLBARU, b.NAMAKLIEN1, TO_CHAR(b.TGLLAHIR, 'DD/MM/YYYY') TGLLAHIR, 
							b.ALAMATTETAP01 || b.ALAMATTETAP02 ALAMAT, PHONETAGIH01, PHONETAGIH02, 
							KDPRODUK || ' (' || c.NAMASTATUSFILE || ')' POLIS, PREMI1, PREMI2, 
							ROUND (MONTHS_BETWEEN (SYSDATE, TO_DATE (TO_CHAR(b.TGLLAHIR,'DD/MM/YYYY'), 'DD/MM/YYYY')) / 12) USIA, 
							TO_CHAR(MULAS, 'DD/MM/YYYY') MULAS, TO_CHAR(EXPIRASI, 'DD/MM/YYYY') AKLAS
						FROM TABEL_200_PERTANGGUNGAN a 
						INNER JOIN TABEL_100_KLIEN b ON a.NOPEMEGANGPOLIS = b.NOKLIEN 
						INNER JOIN TABEL_299_STATUS_FILE c ON a.KDSTATUSFILE = c.KDSTATUSFILE
						WHERE NOAGEN = '$p2' AND KDPERTANGGUNGAN = '2' AND a.KDSTATUSFILE NOT IN ('2', '7', 'X') AND (
							LOWER(PREFIXPERTANGGUNGAN) LIKE '%$p3%' OR
							LOWER(NOPERTANGGUNGAN) LIKE '%$p3%' OR
							LOWER(NAMAKLIEN1) LIKE '%$p3%' OR
							TO_CHAR(b.TGLLAHIR, 'DD/MM/YYYY') LIKE '%$p3%' OR
							LOWER(b.ALAMATTETAP01) LIKE '%$p3%' OR
							LOWER(b.ALAMATTETAP02) LIKE '%$p3%' OR
							LOWER(PHONETAGIH01) LIKE '%$p3%' OR
							LOWER(PHONETAGIH02) LIKE '%$p3%' OR
							LOWER(KDPRODUK || '(' || c.NAMASTATUSFILE || ')') LIKE '%$p3%' OR
							PREMI1 LIKE '%$p3%' OR
							ROUND (MONTHS_BETWEEN (SYSDATE, TO_DATE (b.TGLLAHIR, 'DD/MM/YYYY')) / 12) LIKE '%$p3%' OR
							TO_CHAR(MULAS, 'DD/MM/YYYY') LIKE '%$p3%' OR
							TO_CHAR(EXPIRASI, 'DD/MM/YYYY') LIKE '%$p3%'
						)
						ORDER BY b.NAMAKLIEN1
					) tbl
					WHERE rownum < (($p * $p1) + 1 )
				)
				WHERE no >= ((($p-1) * $p1) + 1)";
		//echo $sql;
		$DB->parse($sql);
		$DB->execute();
		
		echo json_encode($DB->result());
		//echo $sql;
	}
	
	
	/*===== tarik data total nasabah agen =====*/
	if (strcasecmp($r, '2') == 0) {
		$sql = "SELECT PREFIXPERTANGGUNGAN || NOPERTANGGUNGAN NOPOLIS, b.NAMAKLIEN1, TO_CHAR(b.TGLLAHIR, 'DD/MM/YYYY') TGLLAHIR, 
							b.ALAMATTETAP01 || b.ALAMATTETAP02 ALAMAT, PHONETAGIH01, PHONETAGIH02, 
							KDPRODUK || ' (' || c.NAMASTATUSFILE || ')' POLIS, PREMI1, PREMI2, 
							ROUND (MONTHS_BETWEEN (SYSDATE, TO_DATE (TO_CHAR(b.TGLLAHIR,'DD/MM/YYYY'), 'DD/MM/YYYY')) / 12) USIA, 
							TO_CHAR(MULAS, 'DD/MM/YYYY') MULAS, TO_CHAR(EXPIRASI, 'DD/MM/YYYY') AKLAS
						FROM TABEL_200_PERTANGGUNGAN a 
						INNER JOIN TABEL_100_KLIEN b ON a.NOPEMEGANGPOLIS = b.NOKLIEN 
						INNER JOIN TABEL_299_STATUS_FILE c ON a.KDSTATUSFILE = c.KDSTATUSFILE
						WHERE NOAGEN = '$p2' AND KDPERTANGGUNGAN = '2' AND a.KDSTATUSFILE NOT IN ('2', '7', 'X') AND (
							LOWER(PREFIXPERTANGGUNGAN) LIKE '%$p3%' OR
							LOWER(NOPERTANGGUNGAN) LIKE '%$p3%' OR
							LOWER(NAMAKLIEN1) LIKE '%$p3%' OR
							TO_CHAR(b.TGLLAHIR, 'DD/MM/YYYY') LIKE '%$p3%' OR
							LOWER(b.ALAMATTETAP01) LIKE '%$p3%' OR
							LOWER(b.ALAMATTETAP02) LIKE '%$p3%' OR
							LOWER(PHONETAGIH01) LIKE '%$p3%' OR
							LOWER(PHONETAGIH02) LIKE '%$p3%' OR
							LOWER(KDPRODUK || '(' || c.NAMASTATUSFILE || ')') LIKE '%$p3%' OR
							PREMI1 LIKE '%$p3%' OR
							ROUND (MONTHS_BETWEEN (SYSDATE, TO_DATE (b.TGLLAHIR, 'DD/MM/YYYY')) / 12) LIKE '%$p3%' OR
							TO_CHAR(MULAS, 'DD/MM/YYYY') LIKE '%$p3%' OR
							TO_CHAR(EXPIRASI, 'DD/MM/YYYY') LIKE '%$p3%'
						)
						ORDER BY b.NAMAKLIEN1";
		
		$DB->parse($sql);
		$DB->execute();
		
		echo count($DB->result());
		//echo $sql;
	}
	
	
	/*===== tarik data ulang tahun nasabah =====*/
	if (strcasecmp($r, '3') == 0) {
		$sql = "SELECT b.NAMAKLIEN1, TO_CHAR(b.TGLLAHIR, 'DD') DLAHIR, TO_CHAR(b.TGLLAHIR, 'MM') MLAHIR, TO_CHAR(SYSDATE, 'YYYY') YNOW, 
					TO_CHAR(b.TGLLAHIR, 'YYYY') YLAHIR, MAX(NOPEMEGANGPOLIS) NOKLIEN, MAX(NVL(PHONETAGIH01,PHONETAGIH02)) PHONETAGIH, 
                    MAX(NO_PONSEL) HP, MAX(b.ALAMATTETAP01 || b.ALAMATTETAP02) ALAMAT, TO_CHAR(SYSDATE, 'YYYY') -  TO_CHAR(b.TGLLAHIR, 'YYYY') USIA
				FROM TABEL_200_PERTANGGUNGAN a 
				INNER JOIN TABEL_100_KLIEN b ON a.NOPEMEGANGPOLIS = b.NOKLIEN 
				WHERE NOAGEN = '$p' AND KDPERTANGGUNGAN = '2' AND a.KDSTATUSFILE NOT IN ('2', '7', 'X') 
				    AND TO_CHAR(b.TGLLAHIR,'mm') = TO_CHAR(sysdate,'mm')
				GROUP BY b.NAMAKLIEN1, b.TGLLAHIR
				ORDER BY TO_CHAR(b.TGLLAHIR, 'DDMM')";
		
		$DB->parse($sql);
		$DB->execute();
		
		echo json_encode($DB->result());
		//echo $sql;
	}
	
	
	/*===== tarik data jatuh tempo benefit nasabah =====*/
	if (strcasecmp($r, '4') == 0) {
		$sql = "SELECT a.PREFIXPERTANGGUNGAN || a.NOPERTANGGUNGAN NOPOLIS, a.NOPOLBARU, d.NAMAKLIEN1, c.NAMABENEFIT, 
					ROUND(b.NILAIBENEFIT) NILAIBENEFIT, e.NOTASI, TO_CHAR(b.EXPIRASI, 'DD') DEXPIRASI, 
					TO_CHAR(b.EXPIRASI, 'MM') MEXPIRASI, TO_CHAR(b.EXPIRASI, 'YYYY') YEXPIRASI,
					NVL(PHONETAGIH01,PHONETAGIH02) PHONETAGIH, NO_PONSEL HP, f.NAMAPRODUK
				FROM TABEL_200_PERTANGGUNGAN a 
				INNER JOIN TABEL_223_TRANSAKSI_PRODUK b ON a.PREFIXPERTANGGUNGAN = b.PREFIXPERTANGGUNGAN 
					AND a.NOPERTANGGUNGAN = b.NOPERTANGGUNGAN 
				INNER JOIN TABEL_207_KODE_BENEFIT c ON b.KDBENEFIT = c.KDBENEFIT 
				INNER JOIN TABEL_100_KLIEN d ON a.NOPEMEGANGPOLIS = d.NOKLIEN 
				LEFT OUTER JOIN TABEL_304_VALUTA e ON a.KDVALUTA = e.KDVALUTA 
				INNER JOIN TABEL_202_PRODUK f ON a.KDPRODUK = f.KDPRODUK
				WHERE b.EXPIRASI IS NOT NULL AND b.NILAIBENEFIT > 0 AND NOAGEN = '$p' 
					AND KDPERTANGGUNGAN = '2' AND b.KDJENISBENEFIT != 'R' 
					AND KDSTATUSFILE NOT IN ('2', '7', 'X') 
					--AND TO_CHAR(b.EXPIRASI,'mmyyyy') = TO_CHAR(sysdate,'mmyyyy')
				ORDER BY TO_CHAR(b.EXPIRASI, 'DDMM')";
		
		$DB->parse($sql);
		$DB->execute();
		
		echo json_encode($DB->result());
		//echo $sql;
	}
	
	
	/*===== tarik data jatuh tempo premi nasabah =====*/
	if (strcasecmp($r, '5') == 0) {
		$sql = "SELECT a.PREFIXPERTANGGUNGAN || a.NOPERTANGGUNGAN NOPOLIS, b.NOPOLBARU, c.NAMAKLIEN1, 
                                CASE WHEN a.KDVALUTA = 0 THEN a.PREMITAGIHAN / b.INDEXAWAL ELSE a.PREMITAGIHAN END PREMITAGIHAN,
                                TO_CHAR(a.TGLBOOKED, 'dd/mm/yyyy') TGLBOOKED, TO_CHAR(a.TGLBOOKED, 'dd') DTGLBOOKED, 
                                TO_CHAR(a.TGLBOOKED, 'mm') MTGLBOOKED, TO_CHAR(a.TGLBOOKED, 'yyyy') YTGLBOOKED ,
                                NVL(PHONETAGIH01,PHONETAGIH02) PHONETAGIH, NO_PONSEL HP, d.NAMAPRODUK, e.NAMASTATUSFILE
                        FROM TABEL_300_HISTORIS_PREMI a 
                        INNER JOIN TABEL_200_PERTANGGUNGAN b ON a.PREFIXPERTANGGUNGAN = b.PREFIXPERTANGGUNGAN 
                                AND a.NOPERTANGGUNGAN = b.NOPERTANGGUNGAN 
                        INNER JOIN TABEL_100_KLIEN c ON b.NOPEMEGANGPOLIS = c.NOKLIEN 
                        INNER JOIN TABEL_202_PRODUK d ON b.KDPRODUK = d.KDPRODUK
                        INNER JOIN TABEL_299_STATUS_FILE e ON b.KDSTATUSFILE = e.KDSTATUSFILE
                        WHERE b.NOAGEN = '$p' AND a.TGLSEATLED IS NULL AND a.TGLBAYAR IS NULL
                            /*AND TO_CHAR(a.TGLBOOKED,'mmyyyy') = TO_CHAR(sysdate,'mmyyyy')*/
                            AND b.kdstatusfile IN ('1','4')
                        ORDER BY a.TGLBOOKED desc";
		
		$DB->parse($sql);
		$DB->execute();
		
		echo json_encode($DB->result());
		//echo $sql;
	}

	/*===== tarik jumlah data jatuh tempo premi nasabah (TESTING) - TEGUH 21/11/2019 =====*/
	if (strcasecmp($r, '20') == 0) {
		$sql = "SELECT COUNT(b.NOPERTANGGUNGAN) AS JML
                        FROM TABEL_300_HISTORIS_PREMI a 
                        INNER JOIN TABEL_200_PERTANGGUNGAN b ON a.PREFIXPERTANGGUNGAN = b.PREFIXPERTANGGUNGAN 
                                AND a.NOPERTANGGUNGAN = b.NOPERTANGGUNGAN 
                        INNER JOIN TABEL_100_KLIEN c ON b.NOPEMEGANGPOLIS = c.NOKLIEN 
                        INNER JOIN TABEL_202_PRODUK d ON b.KDPRODUK = d.KDPRODUK
                        INNER JOIN TABEL_299_STATUS_FILE e ON b.KDSTATUSFILE = e.KDSTATUSFILE
                        WHERE b.NOAGEN = '$p' AND a.TGLSEATLED IS NULL AND a.TGLBAYAR IS NULL
                            AND b.kdstatusfile IN ('1','4')
                            AND TO_CHAR(a.TGLBOOKED, 'MM/YYYY') = TO_CHAR(SYSDATE, 'MM/YYYY') 
                        ";
		
		$DB->parse($sql);
		$DB->execute();
		
		echo json_encode($DB->result());
		//echo $sql;
	}

	/*===== tarik data daftar polis berdasarkan nomor agen =====*/
	if (strcasecmp($r, '21') == 0) {
		$sql = "SELECT DISTINCT(d.NAMAPRODUK)
                        FROM TABEL_300_HISTORIS_PREMI a 
                        INNER JOIN TABEL_200_PERTANGGUNGAN b ON a.PREFIXPERTANGGUNGAN = b.PREFIXPERTANGGUNGAN 
                                AND a.NOPERTANGGUNGAN = b.NOPERTANGGUNGAN 
                        INNER JOIN TABEL_100_KLIEN c ON b.NOPEMEGANGPOLIS = c.NOKLIEN 
                        INNER JOIN TABEL_202_PRODUK d ON b.KDPRODUK = d.KDPRODUK
                        INNER JOIN TABEL_299_STATUS_FILE e ON b.KDSTATUSFILE = e.KDSTATUSFILE
                        WHERE b.NOAGEN = '$p' AND a.TGLSEATLED IS NULL AND a.TGLBAYAR IS NULL
                            AND b.kdstatusfile IN ('1','4')
                        ORDER BY d.NAMAPRODUK ASC";
		$DB->parse($sql);
		$DB->execute();		
		echo json_encode($DB->result());
	}

	/*===== tarik data jatuh tempo premi nasabah (TESTING) - TEGUH 20/11/2019 =====*/
	$statuspolis	= isset($_GET['statuspolis']) ? $_GET['statuspolis'] : '';
	$jenisproduk	= isset($_GET['jenisproduk']) ? $_GET['jenisproduk'] : '';
	$tglawal		= isset($_GET['tglawal']) ? $_GET['tglawal'] : '';
	$tglakhir		= isset($_GET['tglakhir']) ? $_GET['tglakhir'] : '';

	if (strcasecmp($r, '22') == 0) {
		if($statuspolis == ''){
			$caristatuspolis = "b.KDSTATUSFILE IN ('1','4')";
		}else{
			$caristatuspolis = "b.KDSTATUSFILE = '".$statuspolis."'";
		}

		if($jenisproduk == ''){
			$carijenisproduk = "";
		}else{
			$carijenisproduk = "AND d.NAMAPRODUK = '".$jenisproduk."'";
		}

		$tglawal = str_replace('%2F', '/', $tglawal);
		$tglakhir = str_replace('%2F', '/', $tglakhir);
		if($tglawal != '' && $tglakhir != ''){
			$caritgl = "AND TO_DATE(a.TGLBOOKED) >= TO_DATE('$tglawal', 'MM/DD/YYYY') AND TO_DATE(a.TGLBOOKED) <= TO_DATE('$tglakhir', 'MM/DD/YYYY')";
		}elseif ($tglawal != '' && $tglakhir == '') {
			$caritgl = "AND TO_DATE(a.TGLBOOKED) >= TO_DATE('$tglawal', 'MM/DD/YYYY')";
		}elseif ($tglawal == '' && $tglakhir != '') {
			$caritgl = "AND TO_DATE(a.TGLBOOKED) <= TO_DATE('$tglakhir', 'MM/DD/YYYY')";
		}else{
			$caritgl = "";
		}

		$sql = "SELECT a.PREFIXPERTANGGUNGAN || a.NOPERTANGGUNGAN NOPOLIS, c.NAMAKLIEN1, 
                                CASE WHEN a.KDVALUTA = 0 THEN a.PREMITAGIHAN / b.INDEXAWAL ELSE a.PREMITAGIHAN END PREMITAGIHAN,
                                TO_CHAR(a.TGLBOOKED, 'dd/mm/yyyy') TGLBOOKED, TO_CHAR(a.TGLBOOKED, 'dd') DTGLBOOKED, 
                                TO_CHAR(a.TGLBOOKED, 'mm') MTGLBOOKED, TO_CHAR(a.TGLBOOKED, 'yyyy') YTGLBOOKED ,
                                NVL(PHONETAGIH01,PHONETAGIH02) PHONETAGIH, NO_PONSEL HP, d.NAMAPRODUK, e.NAMASTATUSFILE
                        FROM TABEL_300_HISTORIS_PREMI a 
                        INNER JOIN TABEL_200_PERTANGGUNGAN b ON a.PREFIXPERTANGGUNGAN = b.PREFIXPERTANGGUNGAN 
                                AND a.NOPERTANGGUNGAN = b.NOPERTANGGUNGAN 
                        INNER JOIN TABEL_100_KLIEN c ON b.NOPEMEGANGPOLIS = c.NOKLIEN 
                        INNER JOIN TABEL_202_PRODUK d ON b.KDPRODUK = d.KDPRODUK
                        INNER JOIN TABEL_299_STATUS_FILE e ON b.KDSTATUSFILE = e.KDSTATUSFILE
                        WHERE b.NOAGEN = '$p' AND a.TGLSEATLED IS NULL AND a.TGLBAYAR IS NULL
                            AND $caristatuspolis $carijenisproduk $caritgl
                        ORDER BY a.TGLBOOKED ASC";
		
		$DB->parse($sql);
		$DB->execute();
		
		echo json_encode($DB->result());
		//echo $sql;
	}
