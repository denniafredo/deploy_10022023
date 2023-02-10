<?php
    /*
    * API file untuk aplikasi jaim
    * method untuk data agen
    */
    require_once 'includes/config.php';
    require_once 'includes/database.php';
	
    $r	= isset($_GET['r']) ? $_GET['r'] : '';
    $p	= isset($_GET['p']) ? $_GET['p'] : '';
    $p2 = isset($_GET['p2']) ? $_GET['p2'] : '';
    $p3 = isset($_GET['p3']) ? $_GET['p3'] : '';
    $dollar = 14000;
	
    $DB = new Database(C_USER_DB_JLINDO, C_PASS_DB_JLINDO, C_DB_JLINDO);
	
    /*===== tarik data agen untuk session aplikasi =====*/
    if (strcasecmp($r, '1') == 0) {
	error_reporting(0);
		
	$p	= addslashes($p);
		
	$sql = "SELECT KDUNITPRODUKSI, a.KDKANTOR, KDJABATANAGEN, KDAREAOFFICE, b.NAMAKLIEN1 as NAMALENGKAP,
		    FOTOAGEN as AVATAR, b.EMAILTETAP, c.NAMAKANTOR, 
		    CASE WHEN c.PHONE01 IS NOT NULL AND c.PHONE02 IS NOT NULL THEN c.PHONE01 || ' / ' || c.PHONE02 
		        WHEN c.PHONE01 IS NOT NULL AND c.PHONE02 IS NULL THEN c.PHONE01 ELSE c.PHONE02 END AS PHONEKANTOR,
		    c.EMAIL AS EMAILKANTOR,
		    d.NAMAKANTOR AS NAMAINDUK,
		    CASE WHEN d.PHONE01 IS NOT NULL AND d.PHONE02 IS NOT NULL THEN d.PHONE01 || ' / ' || d.PHONE02 
		        WHEN d.PHONE01 IS NOT NULL AND d.PHONE02 IS NULL THEN d.PHONE01 ELSE d.PHONE02 END AS PHONEINDUK,
		    d.EMAIL AS EMAILINDUK, a.KDSTATUSAGEN
		FROM TABEL_400_AGEN a
		LEFT OUTER JOIN TABEL_100_KLIEN b ON a.NOAGEN = b.NOKLIEN
		LEFT OUTER JOIN TABEL_001_KANTOR c ON a.KDKANTOR = c.KDKANTOR
		LEFT OUTER JOIN TABEL_001_KANTOR d ON c.KDKANTORINDUK = d.KDKANTOR
		WHERE NOAGEN = '$p'";
		
    $DB->parse($sql);
	$DB->execute();
	$value = $DB->nextrow();
		
	// copy image from API JLINDO to API JAIM
	/*$save_location = "avatar/$value[AVATAR]";
	$from_location = file_get_contents(C_URL_API_JLINDO."/agen/fotoagen/".rawurlencode($value['AVATAR']));
	
	$fp = fopen($save_location, "w");
	fwrite($fp, $from_location);
	fclose($fp);*/
		
	echo json_encode($value);
	//echo $sql;
    }
	
	
    /*===== identitas agen =====*/
    if (strcasecmp($r, '2') == 0) {
	$p = addslashes($p);
		
	$sql = "SELECT a.NOAGEN, b.NAMAKLIEN1, d.NAMASTATUSAGEN, b.TEMPATLAHIR, b.TGLLAHIR, c.NAMAJABATANAGEN, 
                    a.NOLISENSIAGEN, TO_CHAR(a.TGLMULAILISENSI, 'DD/MM/YYYY') AS TGLMULAILISENSI, 
                    TO_CHAR(a.TGLAKHIRLISENSI, 'DD/MM/YYYY') AS TGLAKHIRLISENSI,
                    FLOOR(MONTHS_BETWEEN(SYSDATE, a.TGLAKHIRLISENSI) / 12) YEAREXPLS,
                    FLOOR(MONTHS_BETWEEN(SYSDATE, e.TGLPKAJAGEN) / 12) YEAREXPPKAJ
		FROM TABEL_400_AGEN a
		INNER JOIN TABEL_100_KLIEN b ON a.NOAGEN = b.NOKLIEN
		LEFT OUTER JOIN TABEL_413_JABATAN_AGEN c ON a.KDJABATANAGEN = c.KDJABATANAGEN
		LEFT OUTER JOIN TABEL_409_STATUS_AGEN d ON a.KDSTATUSAGEN = d.KDSTATUSAGEN
		LEFT OUTER JOIN (
		    SELECT NOAGEN, MAX(TGLPKAJAGEN) TGLPKAJAGEN
                    FROM TABEL_400_PKAJ_AGEN
                    GROUP BY NOAGEN
                ) e ON a.NOAGEN = e.NOAGEN
		WHERE a.NOAGEN = '$p'";
		
	$DB->parse($sql);
	$DB->execute();
	$value = $DB->nextrow();
		
	echo json_encode($value);
    }
	
	
    /*===== riwayat keluarga =====*/
    if (strcasecmp($r, '3') == 0) {
	$value = array();
	$p = addslashes($p);
		
	$sql = "SELECT NAMA, HUBUNGAN, TEMPAT_LAHIR, TO_CHAR(TGL_LAHIR, 'DD/MM/YYYY') AS TGLLAHIR
		FROM TABEL_420_KELUARGA_AGEN
		WHERE NOAGEN = '$p'
		ORDER BY TGL_LAHIR";
		
	$DB->parse($sql);
	$DB->execute();
		
	while ($result = $DB->nextrow()) {
            $value[] = $result;
	}
        
        echo json_encode($value);
    }
	
	
    /*===== pendidikan formal =====*/
    if (strcasecmp($r, '4') == 0) {
	$value = array();
	$p = addslashes($p);
		
	$sql = "SELECT TO_CHAR(TGLMULAI, 'DD/MM/YYYY') TGLMULAI, NAMAJENISPENDIDIKAN, KETERANGAN
                FROM TABEL_414_HISTORI_PENDIDIKAN a
		INNER JOIN TABEL_999_JENIS_PENDIDIKAN b ON a.KDJENISPENDIDIKAN = b.KDJENISPENDIDIKAN
		WHERE KDKATEGORIPENDIDIKAN = '01' AND NOAGEN = '$p'
		ORDER BY TGLMULAI DESC";
		
	$DB->parse($sql);
	$DB->execute();
		
	while ($result = $DB->nextrow()) {
            $value[] = $result;
	}

	echo json_encode($value);
    }
	
	
    /*===== pendidikan extern =====*/
    if (strcasecmp($r, '5') == 0) {
	$value = array();
	$p = addslashes($p);
		
	$sql = "SELECT TO_CHAR(TGLMULAI, 'DD/MM/YYYY') TGLMULAI, URAIAN AS NAMAJENISPENDIDIKAN, KETERANGAN
		FROM TABEL_414_HISTORI_PENDIDIKAN a
		INNER JOIN TABEL_999_JENIS_PENDIDIKAN b ON a.KDJENISPENDIDIKAN = b.KDJENISPENDIDIKAN
		WHERE KDKATEGORIPENDIDIKAN = '03' AND NOAGEN = '$p'
		ORDER BY a.TGLMULAI DESC";
		
	$DB->parse($sql);
	$DB->execute();
		
	while($result = $DB->nextrow()) {
            $value[] = $result;
	}
		
	echo json_encode($value);
    }
	
	
    /*===== pengalaman kerja =====*/
    if (strcasecmp($r, '6') == 0) {
	$value = array();
	$p = addslashes($p);
		
	$sql = "SELECT TO_CHAR(TGLMULAI, 'DD/MM/YYYY') TGLMULAI, URAIAN AS PERUSAHAAN, KETERANGAN
		FROM TABEL_415_HISTORI_KERJA a
		WHERE NOAGEN = '$p'
		ORDER BY a.TGLMULAI DESC";
		
	$DB->parse($sql);
	$DB->execute();
		
	while($result = $DB->nextrow()) {
            $value[] = $result;
	}
		
	echo json_encode($value);
    }
	
	
    /*===== prestasi =====*/
    if (strcasecmp($r, '7') == 0) {
	$value = array();
	$p = addslashes($p);
		
	$sql = "SELECT TO_CHAR(TGLJASA, 'DD/MM/YYYY') TGLJASA, URAIAN, KETERANGAN
		FROM TABEL_416_HISTORI_JASA a
		WHERE NOAGEN = '$p' AND KDJENISJASA = '1'
		ORDER BY a.TGLJASA DESC";
		
        $DB->parse($sql);
	$DB->execute();
		
	while($result = $DB->nextrow()) {
            $value[] = $result;
	}
		
	echo json_encode($value);
    }
	
	
    /*===== riwayat jabatan =====*/
    if (strcasecmp($r, '8') == 0) {
        $value = array();
	$p = addslashes($p);
		
	$sql = "SELECT TO_CHAR(a.TGLJABATAN, 'DD/MM/YYYY') TGLJABATAN, a.URAIAN, a.KETERANGAN, a.KDJABATANAGEN,
                    a.KDKELASAGEN, b.NAMAJABATANAGEN, c.NAMAKELASAGEN
		FROM TABEL_417_HISTORI_JABATAN a
		INNER JOIN TABEL_413_JABATAN_AGEN b ON a.KDJABATANAGEN = b.KDJABATANAGEN
		INNER JOIN TABEL_408_KODE_KELAS_AGEN c ON a.KDKELASAGEN = c.KDKELASAGEN
		WHERE NOAGEN = '$p'
		ORDER BY a.TGLJABATAN DESC";
		
	$DB->parse($sql);
	$DB->execute();
	
	while($result = $DB->nextrow()) {
            $value[] = $result;
	}
		
	echo json_encode($value);
    }

	
    /*===== tarik data kancab & kanwil untuk session aplikasi =====*/
    if (strcasecmp($r, '9') == 0) {
	error_reporting(0);
		
	$p	= addslashes($p);
		
	$sql = "SELECT a.NAMAKANTOR, 
                    CASE WHEN a.PHONE01 IS NOT NULL AND a.PHONE02 IS NOT NULL THEN a.PHONE01 || ' / ' || a.PHONE02 
                        WHEN a.PHONE01 IS NOT NULL AND a.PHONE02 IS NULL THEN a.PHONE01 ELSE a.PHONE02 
                    END AS PHONEKANTOR, a.EMAIL AS EMAILKANTOR, b.NAMAKANTOR AS NAMAINDUK, 
                    CASE WHEN b.PHONE01 IS NOT NULL AND b.PHONE02 IS NOT NULL THEN b.PHONE01 || ' / ' || b.PHONE02 
                        WHEN b.PHONE01 IS NOT NULL AND b.PHONE02 IS NULL THEN b.PHONE01 ELSE b.PHONE02 
                    END AS PHONEINDUK, b.EMAIL AS EMAILINDUK,
                    '' KDSTATUSAGEN, c.NAMALENGKAP, '' KDJABATANAGEN, a.KDKANTOR, '' KDAREAOFFICE,
                    '' KDUNITPRODUKSI, c.AVATAR, a.EMAIL EMAILTETAP
		FROM TABEL_001_KANTOR a 
		LEFT OUTER JOIN TABEL_001_KANTOR b ON a.KDKANTORINDUK = b.KDKANTOR 
		LEFT OUTER JOIN JAIM_900_USER@JAIM c ON a.KDKANTOR = c.USERNAME
		WHERE a.KDKANTOR = '$p' ";
		
	$DB->parse($sql);
	$DB->execute();
	$value = $DB->nextrow();
		
	echo json_encode($value);
	//echo $sql;
    }	

    
    /*===== tarik jumlah polis per agen =====*/
    if (strcasecmp($r, '10') == 0) {
	error_reporting(0);
		
	$p = addslashes($p);
		
	$sql = "select count(0) CNT from TABEL_200_PERTANGGUNGAN
		where noagen = '$p'
                    and kdstatusfile = '1'";

	$DB->parse($sql);
	$DB->execute();
		
	while($result = $DB->nextrow()) {
            $value['num_polis_aktif'] = $result['CNT'];
	}
		
	$sql = "select count(0) CNT
		from (
                    select  distinct nopemegangpolis from TABEL_200_PERTANGGUNGAN
                    where
                    noagen = '$p'
			and kdstatusfile = '1'
		)";

	$DB->parse($sql);
	$DB->execute();
		
	while($result = $DB->nextrow()) {
            $value['num_pempol_aktif'] = $result['CNT'];
	}

	echo json_encode($value);
		
    }
	
	
    /*===== tarik data poin tur agen =====*/
    if (strcasecmp($r, '11') == 0) {
        error_reporting(0);

        $p = addslashes($p);

        $sql = "SELECT b.kdkantor, a.noagen, c.namaklien1, b.kdjabatanagen, d.namajabatanagen, 
                    SUM(premi) jmlpremi, NVL(SUM(poin),0) jmlpoin, TO_CHAR(e.tglpkajagen, 'dd/mm/yyyy') tglpkajagen, 
                    floor(months_between(sysdate, e.tglpkajagen) /12) yearexppkaj, b.nolisensiagen,
                    floor(months_between(sysdate, b.tglakhirlisensi) /12) yearexpls,
                    (
                        SELECT COUNT(DISTINCT z.nopertanggungan) 
                        FROM tabel_200_pertanggungan z
                        INNER JOIN tabel_300_historis_premi y ON z.prefixpertanggungan = y.prefixpertanggungan
                            AND z.nopertanggungan = y.nopertanggungan
                        WHERE y.kdkuitansi = 'BP3'
                            AND y.tglbooked BETWEEN TO_DATE('$p2','dd/mm/yyyy') AND TO_DATE('$p3','dd/mm/yyyy')
                            AND z.noagen = a.noagen
                            AND z.kdproduk NOT IN ('PAA','PAB','AKM')
                    ) jmlpolis
                FROM ( 
                    SELECT noagen, a.prefixpertanggungan, a.nopertanggungan,
                        CASE WHEN b.kdvaluta = '3' THEN a.premitagihan * $dollar ELSE a.premitagihan END premi,
                        CASE WHEN d.kdjeniscb = 'X' AND a.kdkuitansi IN ('BP3','NB1') THEN 
                                CASE WHEN b.kdvaluta = '3' THEN a.premitagihan * $dollar ELSE a.premitagihan END * c.faktorpremix / c.faktorpembagix
                            WHEN d.kdjeniscb = 'B' THEN
                                CASE WHEN b.kdvaluta = '3' THEN a.premitagihan * $dollar ELSE a.premitagihan END * c.faktorpremib / c.faktorpembagib
                        END poin 
                    FROM tabel_300_historis_premi a
                    INNER JOIN tabel_200_pertanggungan b ON a.prefixpertanggungan = b.prefixpertanggungan
                        AND a.nopertanggungan = b.nopertanggungan
                    INNER JOIN tabel_421_poin_agen c ON b.kdproduk = c.kdproduk
                    INNER JOIN tabel_305_cara_bayar d ON b.kdcarabayar = d.kdcarabayar
                    INNER JOIN tabel_500_penagih e ON b.nopenagih = e.nopenagih
                    WHERE a.kdkuitansi IN ('BP3', 'NB1')
                        AND a.tglseatled IS NOT NULL
                        AND tglbooked BETWEEN TO_DATE('$p2','dd/mm/yyyy') AND TO_DATE('30/06/2018', 'dd/mm/yyyy')
                        /*AND b.taltup <> '1'*/
                        AND b.kdstatusfile NOT IN ('7', 'X', '5')
                        AND c.status = '1'
                        AND SUBSTR(b.kdproduk, 0, 2) != 'JL'
                        AND (c.kdproduk, c.tglberlaku) IN (
                            SELECT kdproduk, MAX(tglberlaku)
                            FROM tabel_421_poin_agen
                            WHERE tglberlaku <= TO_DATE('30/06/2018', 'dd/mm/yyyy')
                            GROUP BY kdproduk
                        )
                        AND b.noagen = '$p'
                        
                    UNION ALL
                        
                    SELECT noagen, b.prefixpertanggungan, b.nopertanggungan,
                        CASE WHEN b.kdvaluta = '3' THEN SUM(a.rp_gross) * $dollar ELSE SUM(a.rp_gross) END premi,
                        CASE WHEN d.kdjeniscb = 'X' THEN 
                                CASE WHEN b.kdvaluta = '3' THEN SUM(a.rp_gross) * $dollar ELSE SUM(a.rp_gross) END * c.faktorpremix / c.faktorpembagix
                            WHEN d.kdjeniscb = 'B' THEN
                                CASE WHEN b.kdvaluta = '3' THEN SUM(a.rp_gross) * $dollar ELSE SUM(a.rp_gross) END * c.faktorpremib / c.faktorpembagib
                        END poin 
                    FROM tabel_ul_transaksi a
                    INNER JOIN tabel_200_pertanggungan b ON a.nomor_polis = b.prefixpertanggungan || b.nopertanggungan 
                    INNER JOIN tabel_421_poin_agen c ON b.kdproduk = c.kdproduk
                    INNER JOIN tabel_305_cara_bayar d ON b.kdcarabayar = d.kdcarabayar
                    INNER JOIN tabel_500_penagih e ON b.nopenagih = e.nopenagih
                    WHERE a.trx_type IN ('S', 'T')
                        AND LOWER(description) NOT LIKE '%berkala%'
                        AND LOWER(description) NOT LIKE '%topup%'
                        AND trx_date BETWEEN TO_DATE('$p2','dd/mm/yyyy') AND TO_DATE('30/06/2018', 'dd/mm/yyyy')
                        /*AND b.taltup <> '1'*/
                        AND b.kdstatusfile NOT IN ('7', 'X', '5')
                        AND c.status = '1'
                        AND (c.kdproduk, c.tglberlaku) IN (
                            SELECT kdproduk, MAX(tglberlaku)
                            FROM tabel_421_poin_agen
                            WHERE tglberlaku <= TO_DATE('30/06/2018', 'dd/mm/yyyy')
                            GROUP BY kdproduk
                        )
						AND ADD_MONTHS(b.mulas, 12) <= a.tgl_booked
                        AND b.noagen = '$p'
                    GROUP BY noagen, b.prefixpertanggungan, b.nopertanggungan, b.kdvaluta, d.kdjeniscb,
                        c.faktorpremix, c.faktorpembagix, c.faktorpremib, c.faktorpembagib
                        
                    UNION ALL
                    
                    SELECT noagen, a.prefixpertanggungan, a.nopertanggungan,
                        CASE WHEN b.kdvaluta = '3' THEN a.premitagihan * $dollar ELSE a.premitagihan END premi,
                        CASE WHEN d.kdjeniscb = 'X' AND a.kdkuitansi IN ('BP3','NB1') THEN 
                                CASE WHEN b.kdvaluta = '3' THEN a.premitagihan * $dollar ELSE a.premitagihan END * c.faktorpremix / c.faktorpembagix
                            WHEN d.kdjeniscb = 'B' THEN
                                CASE WHEN b.kdvaluta = '3' THEN a.premitagihan * $dollar ELSE a.premitagihan END * c.faktorpremib / c.faktorpembagib
                        END poin 
                    FROM tabel_300_historis_premi a
                    INNER JOIN tabel_200_pertanggungan b ON a.prefixpertanggungan = b.prefixpertanggungan
                        AND a.nopertanggungan = b.nopertanggungan
                    INNER JOIN tabel_421_poin_agen c ON b.kdproduk = c.kdproduk
                    INNER JOIN tabel_305_cara_bayar d ON b.kdcarabayar = d.kdcarabayar
                    INNER JOIN tabel_500_penagih e ON b.nopenagih = e.nopenagih
                    WHERE a.kdkuitansi IN ('BP3', 'NB1')
                        AND a.tglseatled IS NOT NULL
                        AND tglbooked BETWEEN TO_DATE('01/07/2018','dd/mm/yyyy') AND TO_DATE('$p3', 'dd/mm/yyyy')
                        AND b.taltup <> '1'
                        AND b.kdstatusfile IN ('1')
                        AND c.status = '1'
                        AND SUBSTR(b.kdproduk, 0, 2) != 'JL'
                        AND (c.kdproduk, c.tglberlaku) IN (
                            SELECT kdproduk, MAX(tglberlaku)
                            FROM tabel_421_poin_agen
                            WHERE tglberlaku >= TO_DATE('01/07/2018', 'dd/mm/yyyy')
                            GROUP BY kdproduk
                        )
                        AND b.noagen = '$p'
                    
                    UNION ALL
                        
                    SELECT noagen, b.prefixpertanggungan, b.nopertanggungan,
                        CASE WHEN b.kdvaluta = '3' THEN SUM(a.rp_gross) * $dollar ELSE SUM(a.rp_gross) END premi,
                        CASE WHEN d.kdjeniscb = 'X' THEN 
                                CASE WHEN b.kdvaluta = '3' THEN SUM(a.rp_gross) * $dollar ELSE SUM(a.rp_gross) END * c.faktorpremix / c.faktorpembagix
                            WHEN d.kdjeniscb = 'B' THEN
                                CASE WHEN b.kdvaluta = '3' THEN SUM(a.rp_gross) * $dollar ELSE SUM(a.rp_gross) END * c.faktorpremib / c.faktorpembagib
                        END poin 
                    FROM tabel_ul_transaksi a
                    INNER JOIN tabel_200_pertanggungan b ON a.nomor_polis = b.prefixpertanggungan || b.nopertanggungan 
                    INNER JOIN tabel_421_poin_agen c ON b.kdproduk = c.kdproduk
                    INNER JOIN tabel_305_cara_bayar d ON b.kdcarabayar = d.kdcarabayar
                    INNER JOIN tabel_500_penagih e ON b.nopenagih = e.nopenagih
                    WHERE a.trx_type IN ('S', 'T')
                        AND LOWER(description) NOT LIKE '%berkala%'
                        AND LOWER(description) NOT LIKE '%topup%'
                        AND trx_date BETWEEN TO_DATE('01/07/2018','dd/mm/yyyy') AND TO_DATE('$p3', 'dd/mm/yyyy')
                        AND b.taltup <> '1'
                        AND b.kdstatusfile IN ('1')
                        AND c.status = '1'
                        AND (c.kdproduk, c.tglberlaku) IN (
                            SELECT kdproduk, MAX(tglberlaku)
                            FROM tabel_421_poin_agen
                            WHERE tglberlaku >= TO_DATE('01/07/2018', 'dd/mm/yyyy')
                            GROUP BY kdproduk
                        )
						AND ADD_MONTHS(b.mulas, 12) <= a.tgl_booked
                        AND b.noagen = '$p'
                    GROUP BY noagen, b.prefixpertanggungan, b.nopertanggungan, b.kdvaluta, d.kdjeniscb,
                        c.faktorpremix, c.faktorpembagix, c.faktorpremib, c.faktorpembagib
                ) a
                INNER JOIN tabel_400_agen b ON a.noagen = b.noagen
                INNER JOIN tabel_100_klien c ON a.noagen = c.noklien
                INNER JOIN tabel_413_jabatan_agen d ON b.kdjabatanagen = d.kdjabatanagen
                LEFT OUTER JOIN (
                    SELECT noagen, MAX(tglpkajagen) tglpkajagen
                    FROM tabel_400_pkaj_agen
                    GROUP BY noagen
                ) e ON a.noagen = e.noagen
                GROUP BY a.noagen, b.kdkantor, c.namaklien1, b.kdjabatanagen, d.namajabatanagen, e.tglpkajagen, b.nolisensiagen, 
                    b.tglakhirlisensi
                ORDER BY jmlpoin DESC";

        $DB->parse($sql);
        $DB->execute();
        $value = $DB->nextrow();

        echo json_encode($value);
        //echo $sql;
	}
	
	
	/*===== tarik data Polis agen =====*/
	if (strcasecmp($r, '12') == 0) {
	    error_reporting(0);

        $p = addslashes($p);

        $sql = " select 
			prefixpertanggungan||nopertanggungan NOPOLIS,
			(select namaklien1 from tabel_100_klien where noklien = fe.nopemegangpolis) NAMA_PEMPOL
			,(select namaklien1 from tabel_100_klien where noklien = fe.notertanggung) NAMA_TERTANGGUNG
			 from tabel_200_pertanggungan fe where noagen = '$p' and kdstatusfile = '1' ";

        $DB->parse($sql);
        $DB->execute();
        $value = null;
		
		while($result = $DB->nextrow()) {
			$value[] = $result;
		}
		
		$sql = " select 
			distinct 
			(select namaklien1 from tabel_100_klien where noklien = fe.nopemegangpolis) NAMA_PEMPOL
			
			 from tabel_200_pertanggungan fe where noagen = '$p' and kdstatusfile = '1' ";

        $DB->parse($sql);
        $DB->execute();

		
		while($result = $DB->nextrow()) {
			$val[] = $result;
		}		
		$sql = " SELECT b.kdkantor, a.noagen, c.namaklien1, d.namajabatanagen, 
                   prefixpertanggungan||nopertanggungan nopolis, premi jmlpremi, CAST (poin AS DECIMAL(5,2))  jmlpoin
                FROM (
                    SELECT noagen, a.prefixpertanggungan, a.nopertanggungan,
                          CASE WHEN b.kdvaluta = '3' THEN a.premitagihan * $dollar ELSE a.premitagihan END premi,
                        CASE WHEN d.kdjeniscb = 'X' AND a.kdkuitansi = 'BP3' THEN 
                            CASE WHEN b.kdvaluta = '3' THEN a.premitagihan * $dollar ELSE a.premitagihan END * c.faktorpremix / c.faktorpembagix
                        WHEN d.kdjeniscb = 'B' THEN
                            CASE WHEN b.kdvaluta = '3' THEN a.premitagihan * $dollar ELSE a.premitagihan END * c.faktorpremib / c.faktorpembagib
                        END poin 
                    FROM tabel_300_historis_premi a
                    INNER JOIN tabel_200_pertanggungan b ON a.prefixpertanggungan = b.prefixpertanggungan
                        AND a.nopertanggungan = b.nopertanggungan
                    INNER JOIN tabel_421_poin_agen c ON b.kdproduk = c.kdproduk
                    INNER JOIN tabel_305_cara_bayar d ON b.kdcarabayar = d.kdcarabayar
                    WHERE a.kdkuitansi IN ('BP3', 'NB1')
                        AND a.tglseatled IS NOT NULL
                        AND b.noagen = '$p'
                        AND tglbooked BETWEEN TO_DATE('01/01/2017','dd/mm/yyyy') AND TO_DATE('31/12/2017', 'dd/mm/yyyy')
                        AND b.kdstatusfile NOT IN ('7', 'X')
                        AND c.status = '1'
                ) a
                INNER JOIN tabel_400_agen b ON a.noagen = b.noagen
                INNER JOIN tabel_100_klien c ON a.noagen = c.noklien
                INNER JOIN tabel_413_jabatan_agen d ON b.kdjabatanagen = d.kdjabatanagen
                 ";

        $DB->parse($sql);
        $DB->execute();

		
		while($result = $DB->nextrow()) {
			$vals[] = $result;
		}
		
		$ree["list_polis"] = $value;
		$ree["list_nasabah"] = $val;
		$ree["list_point"] = $vals;
		
        echo json_encode($ree);
    }

	
    /*===== tarik data status polis agen =====*/
    else if (strcasecmp($r, '13') == 0) {
        $sql = "SELECT
                    (SELECT COUNT(nopertanggungan) jmlpolis
                    FROM tabel_200_pertanggungan
                    WHERE noagen = '$p'
                        AND kdpertanggungan = '2'
                        AND to_char(mulas,'yyyy') = to_char(sysdate,'yyyy')
                        AND kdproduk NOT IN ('PAA','PAB','AKM')
                        AND kdstatusfile IN ('1','4','L','3','9','6','8')) jmlpolis,
                    (SELECT NVL(SUM(NVL(nilairp,premitagihan)),0)
                    FROM tabel_200_pertanggungan a
                    INNER JOIN tabel_300_historis_premi b ON a.prefixpertanggungan = b.prefixpertanggungan
                        AND a.nopertanggungan = b.nopertanggungan
                    WHERE noagen = '$p'
                        AND kdpertanggungan = '2'
                        AND kdkuitansi IN ('BP3','NB1')
                        AND to_char(tglseatled,'yyyy') = to_char(sysdate,'yyyy')
                        AND kdproduk NOT IN ('PAA','PAB','AKM')) jmlpremi,
                    (SELECT NVL(SUM(komisiagen)/to_number(to_char(sysdate,'mm')),0)
                    FROM tabel_404_komisi_agen a
                    WHERE noagen = '$p'
                        AND to_char(tglupdated,'yyyy') = to_char(sysdate,'yyyy')
                        AND komisiagen > 0) jmlkomisi,
                    (SELECT COUNT(nopertanggungan)
                    FROM tabel_200_pertanggungan
                    WHERE to_char(mulas,'yyyy') = to_char(sysdate,'yyyy')
                        AND kdpertanggungan = '2'
                        AND noagen = '$p'
                        AND kdproduk NOT IN ('PAA','PAB','AKM')
                        AND kdstatusfile = '1') jmlpolisaktif,
                    (SELECT COUNT(nopertanggungan)
                    FROM tabel_200_pertanggungan
                    WHERE to_char(mulas,'yyyy') = to_char(sysdate,'yyyy')
                        AND noagen = '$p'
                        AND kdpertanggungan = '2'
                        AND kdproduk NOT IN ('PAA','PAB','AKM')
                        AND kdstatusfile IN ('4','L')) jmlpolisbpo,
                    (SELECT COUNT(nopertanggungan)
                    FROM tabel_200_pertanggungan
                    WHERE to_char(mulas,'yyyy') = to_char(sysdate,'yyyy')
                        AND noagen = '$p'
                        AND kdpertanggungan = '2'
                        AND kdproduk NOT IN ('PAA','PAB','AKM')
                        AND kdstatusfile IN ('3','9')) jmlpolisexpirasi,
                    (SELECT COUNT(nopertanggungan)
                    FROM tabel_200_pertanggungan
                    WHERE to_char(mulas,'yyyy') = to_char(sysdate,'yyyy')
                        AND noagen = '$p'
                        AND kdpertanggungan = '2'
                        AND kdproduk NOT IN ('PAA','PAB','AKM')
                        AND kdstatusfile = '5') jmlpolistebus
                FROM DUAL";
        $DB->parse($sql);
        $DB->execute();
        $value = $DB->nextrow();

        echo json_encode($value);
        //echo $sql;
    }

	
    /*===== tarif daftar status polis agen =====*/
    else if (strcasecmp($r, '14') == 0) {
        $data = array();

        $sql = "SELECT a.*, ROWNUM no
                FROM (
                    SELECT a.prefixpertanggungan, a.nopertanggungan, b.namaklien1, to_char(mulas,'dd/mm/yyyy') mulas, a.kdstatusfile, a.kdproduk
                    FROM tabel_200_pertanggungan a
                    INNER JOIN tabel_100_klien b ON a.nopemegangpolis = b.noklien
                    WHERE a.noagen = '$p'
                        AND kdpertanggungan = '2'
                        AND to_char(mulas,'yyyy') = to_char(sysdate,'yyyy')
                    ORDER BY a.mulas DESC) a
                WHERE ROWNUM < (6)";
        $DB->parse($sql);
        $DB->execute();

        while($result = $DB->nextrow()) {
            $data[] = $result;
        }

        echo json_encode($data);
        //echo $sql;
    }
	
	
	/*===== update flag cetak e-sertifikat =====*/
	if (strcasecmp($r, '15') == 0) {
		$sql = "UPDATE tabel_400_pelatihan_agen SET
					cetakagen = sysdate
				WHERE nopelatihan = '$p'
					AND noagen = '$p2'";
					
		$DB->parse($sql);
        $DB->execute();
	}


	/*===== copy file avatar agen =====*/
	if (strcasecmp($r, '16') == 0) {
		// copy image from API JLINDO to API JAIM
		$save_location = "../../asset/avatar/$p2";
		$from_location = file_get_contents(C_URL_API_JLINDO."/agen/fotoagen/".rawurlencode($p));

		$fp = fopen($save_location, "w");
		fwrite($fp, $from_location);
		fclose($fp);
	}
?>