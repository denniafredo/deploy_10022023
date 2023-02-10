<?php
	/*
	* API file untuk aplikasi jaim
	* method untuk data master
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
        $dollar = 14000;
	
	$DB = new Database(C_USER_DB_JLINDO, C_PASS_DB_JLINDO, C_DB_JLINDO);

	/*===== data top rekruter =====*/
	if (strcasecmp($r, '1') == 0) {
		$sql = "SELECT * 
				FROM (
					SELECT NOAGENREKR, NAMAKLIEN1, COUNT(NOAGEN) JMLREKRUT, SUM(JMLPREMIREKR) JMLPREMIREKR, a.KDKANTOR, c.NAMAKANTOR
					FROM (
						SELECT a.NOAGEN, NOAGENREKR, SUM(CASE WHEN KDVALUTA = 3 THEN PREMI1*$dollar ELSE PREMI1 END) JMLPREMIREKR, a.KDKANTOR
                        FROM TABEL_400_AGEN a
                        INNER JOIN TABEL_200_PERTANGGUNGAN b ON a.NOAGEN = b.NOAGEN
                        WHERE KDPERTANGGUNGAN = 2 
							/*AND PREMI1 >= 500000*/ 
							AND TO_CHAR(MULAS, 'YYYY') = TO_CHAR(SYSDATE, 'YYYY')
                            AND KDSTATUSFILE IN ('1', '4', '5', '6', '8') 
							AND TO_CHAR(a.TGLREKAM, 'YYYY') = TO_CHAR(SYSDATE, 'YYYY')
                            AND NOAGENREKR IS NOT NULL
                        GROUP BY a.NOAGEN, NOAGENREKR, a.KDKANTOR
					) a
					INNER JOIN TABEL_100_KLIEN b ON a.NOAGENREKR = b.NOKLIEN
					INNER JOIN TABEL_001_KANTOR c ON a.KDKANTOR = c.KDKANTOR
					WHERE c.KDKANTORINDUK LIKE '%$p%' AND a.KDKANTOR LIKE '%$p1%'
					GROUP BY NOAGENREKR, NAMAKLIEN1, a.KDKANTOR, c.NAMAKANTOR
					ORDER BY JMLREKRUT DESC, JMLPREMIREKR DESC
				) WHERE ROWNUM <= 10";
		
		$DB->parse($sql);
		$DB->execute();
		
		echo json_encode($DB->result());
		//echo $sql;
	}
	
	
	/*===== data top polis =====*/
	if (strcasecmp($r, '2') == 0) {
		$sql = "SELECT * 
				FROM (
					SELECT a.NOAGEN, c.NAMAKLIEN1, COUNT(NOPERTANGGUNGAN) JMLPOLIS, 
						SUM(CASE WHEN KDVALUTA = 3 THEN PREMI1*$dollar ELSE PREMI1 END) JMLPREMI, a.KDKANTOR, d.NAMAKANTOR
					FROM TABEL_400_AGEN a
					INNER JOIN TABEL_200_PERTANGGUNGAN b ON a.NOAGEN = b.NOAGEN
					INNER JOIN TABEL_100_KLIEN c ON a.NOAGEN = c.NOKLIEN
					INNER JOIN TABEL_001_KANTOR d ON a.KDKANTOR = d.KDKANTOR
					WHERE KDPERTANGGUNGAN = 2 
						/*AND PREMI1 >= 500000*/
						AND TO_CHAR(MULAS, 'YYYY') = TO_CHAR(SYSDATE, 'YYYY') 
						AND KDSTATUSFILE IN ('1', '4', '5', '6', '8') 
						/*AND TO_CHAR(a.TGLREKAM, 'YYYY') = TO_CHAR(SYSDATE, 'YYYY')*/
						AND d.KDKANTORINDUK LIKE '%$p%' 
						AND a.KDKANTOR LIKE '%$p1%'
					GROUP BY a.NOAGEN, c.NAMAKLIEN1, NOAGENREKR, a.KDKANTOR, d.NAMAKANTOR
					ORDER BY JMLPOLIS DESC, JMLPREMI DESC
				) WHERE ROWNUM <= 10";
		
		$DB->parse($sql);
		$DB->execute();
		
		echo json_encode($DB->result());
		//echo $sql;
	}
	
	
	/*===== data top premi =====*/
	if (strcasecmp($r, '3') == 0) {
		/*$sql = "SELECT *
				FROM (
					SELECT a.NOAGEN, c.NAMAKLIEN1, COUNT(NOPERTANGGUNGAN) JMLPOLIS, 
						SUM(CASE WHEN KDVALUTA = 3 THEN PREMI1*$dollar ELSE PREMI1 END) JMLPREMI, a.KDKANTOR, d.NAMAKANTOR
					FROM TABEL_400_AGEN a
					INNER JOIN TABEL_200_PERTANGGUNGAN b ON a.NOAGEN = b.NOAGEN
					INNER JOIN TABEL_100_KLIEN c ON a.NOAGEN = c.NOKLIEN
					INNER JOIN TABEL_001_KANTOR d ON a.KDKANTOR = d.KDKANTOR
					WHERE KDPERTANGGUNGAN = 2 
						/*AND PREMI1 >= 500000*/
						/*AND TO_CHAR(MULAS, 'YYYY') = TO_CHAR(SYSDATE, 'YYYY')
						AND KDSTATUSFILE IN ('1', '4', '5', '6', '8') 
						/*AND TO_CHAR(a.TGLREKAM, 'YYYY') = TO_CHAR(SYSDATE, 'YYYY')*/
						/*AND d.KDKANTORINDUK LIKE '%$p%'
						AND a.KDKANTOR LIKE '%$p1%'
					GROUP BY a.NOAGEN, c.NAMAKLIEN1, NOAGENREKR, a.KDKANTOR, d.NAMAKANTOR
					ORDER BY JMLPREMI DESC, JMLPOLIS DESC
				) WHERE ROWNUM <= 10";*/
        $sql = "SELECT * 
                FROM (
                    SELECT a.NOAGEN, c.NAMAKLIEN1, COUNT(b.NOPERTANGGUNGAN) JMLPOLIS, 
                        SUM(NVL(NILAIRP, PREMITAGIHAN)) JMLPREMI, a.KDKANTOR, d.NAMAKANTOR
                    FROM TABEL_400_AGEN a
                    INNER JOIN TABEL_200_PERTANGGUNGAN b ON a.NOAGEN = b.NOAGEN
                    INNER JOIN TABEL_100_KLIEN c ON a.NOAGEN = c.NOKLIEN
                    INNER JOIN TABEL_001_KANTOR d ON a.KDKANTOR = d.KDKANTOR
                    INNER JOIN TABEL_300_HISTORIS_PREMI e ON b.PREFIXPERTANGGUNGAN = e.PREFIXPERTANGGUNGAN
                        AND b.NOPERTANGGUNGAN = e.NOPERTANGGUNGAN
                        AND kdkuitansi IN ('BP3','NB1')
                    WHERE TO_CHAR(e.TGLSEATLED,'yyyy') = TO_CHAR(sysdate,'yyyy')
                        AND kdproduk NOT IN ('PAA','PAB','AKM')
                        AND kdpertanggungan = '2'
                        AND KDSTATUSFILE IN ('1', '4', '5', '6', '8')
                        AND a.KDKANTOR LIKE '%$p1%'
                        AND d.KDKANTORINDUK LIKE '%$p%'
                    GROUP BY a.NOAGEN, c.NAMAKLIEN1, NOAGENREKR, a.KDKANTOR, d.NAMAKANTOR
                        ORDER BY JMLPREMI DESC, JMLPOLIS DESC
                ) WHERE ROWNUM <= 10";
		
		$DB->parse($sql);
		$DB->execute();
		
		echo json_encode($DB->result());
		//echo $sql;
	}