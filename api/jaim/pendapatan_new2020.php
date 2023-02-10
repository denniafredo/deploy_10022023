<?php 

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
	$p7 = isset($_GET['p7']) ? $_GET['p7'] : '';
	
	$DB = new Database(C_USER_DB_JLINDO, C_PASS_DB_JLINDO, C_DB_JLINDO);
	$DB2 = new Database(C_USER_DB_JLINDO, C_PASS_DB_JLINDO, C_DB_JLINDO);

	if($p != null || $p != "") {
		$kantor = "AND b.KDKANTOR = '$p'";
	} else {
		$kantor = "";
	}
	
	if($p7 != null || $p7 != ""){
	
		$sql = "    SELECT   '".$p7."' AS NOAGEN FROM DUAL
					UNION ALL
					SELECT NOAGEN
						FROM   TABEL_400_AGEN 
						WHERE  KDSTATUSAGEN = '01'
						START WITH   ATASAN = '".$p7."'
						CONNECT BY   PRIOR NOAGEN = ATASAN
			";
	
	
		$DB->parse($sql);
		$DB->execute();
		$datapendapatan=array();
		while($arr = $DB->nextrow()) {
			$sql2 = "SELECT a.PREFIXPERTANGGUNGAN, a.NOPERTANGGUNGAN, H.NOPOLBARU, i.NAMAKLIEN1 NAMAPEMPOL, a.NOAGEN, e.NAMAJABATANAGEN, c.NAMAKLIEN1, 
						NOREKENING, NAMAKOMISIAGEN, 
						CASE WHEN KDJENISCB = 'B' THEN 'Berkala' WHEN KDJENISCB = 'X' THEN 'Sekaligus' ELSE KDJENISCB END CARABAYAR, 
						THNKOMISI, NVL(KOMISIAGENRP, 0) KOMISIAGENRP, TO_CHAR(a.TGLBOOKED, 'DD/MM/YYYY') TGLBOOKED, 
						TO_CHAR(a.TGLPROSES, 'DD/MM/YYYY') TGLPROSES, e.URUTAN, b.KDJABATANAGEN, a.TGLPROSES TGLPERIODE,
						(SELECT NAMAKANTOR FROM TABEL_001_KANTOR j WHERE j.KDKANTOR = b.KDKANTOR) as KTRREPRESENTATIF
					FROM TABEL_404_KOMISI_AGEN a 
					INNER JOIN TABEL_400_AGEN b ON a.NOAGEN = b.NOAGEN 
					INNER JOIN TABEL_100_KLIEN c ON a.NOAGEN = c.NOKLIEN 
					INNER JOIN TABEL_402_KODE_KOMISI_AGEN d ON a.KDKOMISIAGEN = d.KDKOMISIAGEN 
					INNER JOIN TABEL_413_JABATAN_AGEN e ON b.KDJABATANAGEN = e.KDJABATANAGEN 
					INNER JOIN TABEL_200_PERTANGGUNGAN h ON a.PREFIXPERTANGGUNGAN = h.PREFIXPERTANGGUNGAN 
						AND a.NOPERTANGGUNGAN = h.NOPERTANGGUNGAN
					INNER JOIN TABEL_100_KLIEN i ON h.NOPEMEGANGPOLIS = i.NOKLIEN
					WHERE a.KDKOMISIAGEN != '10' AND KDAUTHORISASI = '2'
						AND b.KDSTATUSAGEN = '01' 
						AND a.TGLUPDATED BETWEEN TO_DATE('$p2', 'DD/MM/YYYY') AND TO_DATE('$p3', 'DD/MM/YYYY') 
						AND a.NOAGEN = '".$arr["NOAGEN"]."'
						$kantor
						AND e.URUTAN >= (SELECT URUTAN FROM TABEL_413_JABATAN_AGEN a INNER JOIN TABEL_400_AGEN b ON a.KDJABATANAGEN = b.KDJABATANAGEN WHERE b.NOAGEN = '".$arr["NOAGEN"]."')
				ORDER BY a.NOAGEN ASC
				";
	
			$DB2->parse($sql2);
			$DB2->execute();
			while($arr2 = $DB2->nextrow()) {
				array_push($datapendapatan, $arr2);
			}
		}
	} else {
	
		$sql = "select noagen from tabel_400_agen b where kdstatusagen = '01' $kantor";
		
		$DB->parse($sql);
		$DB->execute();
		$datapendapatan=array();
		while($arr = $DB->nextrow()) {
			$sql2 = "SELECT a.PREFIXPERTANGGUNGAN, a.NOPERTANGGUNGAN, H.NOPOLBARU, i.NAMAKLIEN1 NAMAPEMPOL, a.NOAGEN, e.NAMAJABATANAGEN, c.NAMAKLIEN1, 
						NOREKENING, NAMAKOMISIAGEN, 
						CASE WHEN KDJENISCB = 'B' THEN 'Berkala' WHEN KDJENISCB = 'X' THEN 'Sekaligus' ELSE KDJENISCB END CARABAYAR, 
						THNKOMISI, NVL(KOMISIAGENRP, 0) KOMISIAGENRP, TO_CHAR(a.TGLBOOKED, 'DD/MM/YYYY') TGLBOOKED, 
						TO_CHAR(a.TGLPROSES, 'DD/MM/YYYY') TGLPROSES, e.URUTAN, b.KDJABATANAGEN, a.TGLPROSES TGLPERIODE,
						(SELECT NAMAKANTOR FROM TABEL_001_KANTOR j WHERE j.KDKANTOR = b.KDKANTOR) as KTRREPRESENTATIF
					FROM TABEL_404_KOMISI_AGEN a 
					INNER JOIN TABEL_400_AGEN b ON a.NOAGEN = b.NOAGEN 
					INNER JOIN TABEL_100_KLIEN c ON a.NOAGEN = c.NOKLIEN 
					INNER JOIN TABEL_402_KODE_KOMISI_AGEN d ON a.KDKOMISIAGEN = d.KDKOMISIAGEN 
					INNER JOIN TABEL_413_JABATAN_AGEN e ON b.KDJABATANAGEN = e.KDJABATANAGEN 
					INNER JOIN TABEL_200_PERTANGGUNGAN h ON a.PREFIXPERTANGGUNGAN = h.PREFIXPERTANGGUNGAN 
						AND a.NOPERTANGGUNGAN = h.NOPERTANGGUNGAN
					INNER JOIN TABEL_100_KLIEN i ON h.NOPEMEGANGPOLIS = i.NOKLIEN
					WHERE a.KDKOMISIAGEN != '10' AND KDAUTHORISASI = '2'
						AND b.KDSTATUSAGEN = '01' 
						AND a.TGLUPDATED BETWEEN TO_DATE('$p2', 'DD/MM/YYYY') AND TO_DATE('$p3', 'DD/MM/YYYY') 
						AND a.NOAGEN = '".$arr["NOAGEN"]."'
						$kantor
						AND e.URUTAN >= (SELECT URUTAN FROM TABEL_413_JABATAN_AGEN a INNER JOIN TABEL_400_AGEN b ON a.KDJABATANAGEN = b.KDJABATANAGEN WHERE b.NOAGEN = '".$arr["NOAGEN"]."')
				ORDER BY a.NOAGEN ASC
				";
	
			$DB2->parse($sql2);
			$DB2->execute();
			while($arr2 = $DB2->nextrow()) {
				array_push($datapendapatan, $arr2);
			}
		}
	}
	echo json_encode($datapendapatan);

?>

