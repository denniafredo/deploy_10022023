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

	/*===== data master kantor =====*/
	if (strcasecmp($r, '1') == 0) {
		$sql = "SELECT NAMAKANTOR, KDKANTOR 
				FROM TABEL_001_KANTOR 
				WHERE KDKANTORINDUK = '$p' 
				UNION ALL
				SELECT NAMAKANTOR, KDKANTOR
				FROM TABEL_001_KANTOR
				WHERE KDKANTOR = '$p'
				ORDER BY KDKANTOR";
		
		$DB->parse($sql);
		$DB->execute();
		
		echo json_encode($DB->result());
	}
	
	
	/*===== data master kantor by kdinduk & kdkantor =====*/
	if (strcasecmp($r, '2') == 0) {
		$sql = "SELECT KDKANTOR, NAMAKANTOR
				FROM TABEL_001_KANTOR
				WHERE KDKANTORINDUK LIKE '%$p%'
					AND KDKANTOR LIKE '%$p1%'
				ORDER BY KDKANTOR";
		
		$DB->parse($sql);
		$DB->execute();
		
		echo json_encode($DB->result());
	}
	
	
	/*===== data master agen binaan =====*/
	if (strcasecmp($r, '3') == 0) {
		$areaoffice = empty($p3) ? null : "AND KDAREAOFFICE = '$p3'";
		$unitproduksi = empty($p4) ? null : "AND KDUNITPRODUKSI = '$p4'";
		
		$sql = "SELECT NOAGEN 
				FROM TABEL_400_AGEN a
				LEFT OUTER JOIN TABEL_413_JABATAN_AGEN b ON a.KDJABATANAGEN = b.KDJABATANAGEN
				WHERE KDSTATUSAGEN = '01' 
					AND KDKANTOR = '$p' 
					AND NOAGEN <> '$p2'
					$areaoffice
					$unitproduksi
				ORDER BY b.URUTAN ASC, KDAREAOFFICE ASC NULLS FIRST, KDUNITPRODUKSI ASC NULLS FIRST";
				
		$DB->parse($sql);
		$DB->execute();
		
		//echo json_encode($DB->result());
		echo $sql;
	}
	
	
	/*===== data master semua kantor  =====*/
	if (strcasecmp($r, '4') == 0) {
		$sql = "SELECT NAMAKANTOR, KDKANTOR
				FROM TABEL_001_KANTOR
				WHERE KDKANTOR NOT IN ('RA', 'XA')
				ORDER BY KDKANTOR";
		
		$DB->parse($sql);
		$DB->execute();
		
		echo json_encode($DB->result());
	}


	/*===== data area office =====*/
	if (strcasecmp($r, '5') == 0) {
	    $sql = "SELECT kdkantor, kdareaoffice, namaareaoffice
                FROM tabel_410_area_office
                WHERE kdkantor = '$p'
                    AND status IS NULL
                    AND namaareaoffice NOT LIKE '%KHUSUS%'
                    AND namaareaoffice NOT LIKE '%PK%'
                    AND namaareaoffice NOT LIKE '%BTN%'
                    AND namaareaoffice NOT LIKE '%DI BAWAH%'";
        $DB->parse($sql);
        $DB->execute();

        echo json_encode($DB->result());
    }	
	
	/*===== data agen =====*/
	if (strcasecmp($r, '6') == 0) {

		if(substr($p1,-1) == 'A' ){
			$sktr = " AND a.KDKANTOR in (select kdkantor from JAIM_001_KANTOR@jaim where kdkantorinduk = '$p1')  ";
		} else {
			$sktr = " AND a.KDKANTOR = '$p1'  ";
		}
		
	    $sql = "SELECT distinct a.kdkantor,a.NOAGEN, FA.NAMAKLIEN1, ty.mobiletoken,trim(gp.lat) lat
                FROM TABEL_400_AGEN a
                left join tabel_100_klien fa on  FA.NOKLIEN = a.noagen
                left join JAIM_900_USER@JAIM ty on TY.USERNAME = a.noagen
                left join (select idagen,max(trunc(lat)) lat from JAIM_000_GPS@jaim de group by idagen    )gp 
                    on gp.idagen = a.noagen and trim(gp.lat) is not null 
                WHERE KDSTATUSAGEN = '01' 
					$sktr 
                   and FA.NAMAKLIEN1 is not null
                   and TY.mobiletoken is not null
				   order by lat asc, kdkantor,NOAGEN asc
				   ";
        $DB->parse($sql);
        $DB->execute();

        echo json_encode($DB->result());
    }