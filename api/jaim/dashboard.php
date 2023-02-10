<?php
/*
* API file untuk aplikasi jaim
* method untuk data dashboard
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

/*===== tarik data kurs transaksi =====*/
if (strcasecmp($r, '1') == 0) {
    $sql = "SELECT TO_CHAR(TGLKURSBERLAKU, 'DD/MM/YYYY') TGLBERLAKU, KURS, 
                    KDVALUTA, DECODE(KDVALUTA, '0', 'Indeks', 'X', 'Indeks NAB', 'US$') VALUTA
                FROM TABEL_999_KURS_TRANSAKSI a
                WHERE TGLKURSBERLAKU = (SELECT MAX(TGLKURSBERLAKU) FROM TABEL_999_KURS_TRANSAKSI WHERE KDVALUTA = a.KDVALUTA) AND KDVALUTA != '1'
                ORDER BY KDVALUTA";

    $DB->parse($sql);
    $DB->execute();

    echo json_encode($DB->result());
    //echo $sql;
}


/*===== tarik data kurs js fixed =====*/
else if (strcasecmp($r, '2') == 0) {
    $svr = "192.168.4.27";
    $usr = "sa";
    $pwd = "siar";
    $db = "siar";

    $connect = mssql_connect($svr, $usr, $pwd) or die("Couldn't connect to SQL Server on $svr");
    mssql_select_db($db, $connect) or die("Couldn't open database $db");

    $sql = "SELECT convert(varchar, tanggal, 103) AS TGLBERLAKU, tanggal, value AS KURS, 'JSFIXED93/95' AS VALUTA
                FROM tablenab 
                WHERE tanggal IN (SELECT MAX(tanggal) FROM tablenab)";

    $result = mssql_query($sql);

    echo json_encode(mssql_fetch_array($result));
    //echo $sql;
}


/*===== tarik data kurs nab jual =====*/
else if (strcasecmp($r, '3') == 0) {
    $svr = "192.168.4.27";
    $usr = "sa";
    $pwd = "siar";
    $db = "unitlink";

    $connect = mssql_connect($svr, $usr, $pwd) or die("Couldn't connect to SQL Server on $svr");
    mssql_select_db($db, $connect) or die("Couldn't open database $db");

    $sql = "SELECT kode_fund AS VALUTA, convert(varchar, tgl_nab, 103) AS TGLBERLAKU, nab_jual AS KURS
                FROM ul_nab 
                WHERE tgl_nab IN (SELECT MAX(tgl_nab) FROM ul_nab)";

    $result = mssql_query($sql);
    while($v = mssql_fetch_array($result)) {
        $data[] = $v;
    }

    echo json_encode($data);
    //echo $sql;
}


/*===== tarik data kurs nab beli =====*/
else if (strcasecmp($r, '4') == 0) {
    $svr = "192.168.4.27";
    $usr = "sa";
    $pwd = "siar";
    $db = "unitlink";

    $connect = mssql_connect($svr, $usr, $pwd) or die("Couldn't connect to SQL Server on $svr");
    mssql_select_db($db, $connect) or die("Couldn't open database $db");

    $sql = "SELECT kode_fund AS VALUTA, convert(varchar, tgl_nab, 103) AS TGLBERLAKU, nab_beli AS KURS
            FROM ul_nab 
            WHERE tgl_nab IN (SELECT MAX(tgl_nab) FROM ul_nab)";

    $result = mssql_query($sql);
    while($v = mssql_fetch_array($result)) {
        $data[] = $v;
    }

    echo json_encode($data);
    //echo $sql;
}


/*===== tarik data kurs nab js new =====*/
else if (strcasecmp($r, '5') == 0) {
   /* $sql = "SELECT 'JS' || DECODE(KODE_FUND,'EF','LE','BF','LB','FF','LPT','IG','G75','IH','G85','LPU') VALUTA, kode_fund, 
                 TO_CHAR(tgl_nab,'DD/MM/YYYY') TGLBERLAKU, nab_jual KURS 
             FROM tabel_ul_nab
             WHERE (kode_fund, tgl_nab) IN (
                SELECT kode_fund, MAX(tgl_nab) tgl_nab
                FROM tabel_ul_nab
                GROUP BY kode_fund)
             ORDER BY tgl_nab, kode_fund";*/
    $sql = "
		SELECT A.KDFUND AS KODE_FUND, A.NAMAFUND AS VALUTA,
    b.tgl_nab AS TGLBERLAKU,
    B.NAB_JUAL AS KURS,
    B.TOTAL_INVESTASI,
    B.TOTAL_UNIT
FROM tabel_ul_kode_fund A
INNER JOIN TABEL_UL_NAB b ON A.KDFUND = B.KODE_FUND AND B.TGL_NAB = (SELECT MAX(TGL_NAB) FROM TABEL_UL_NAB WHERE KODE_FUND = A.KDFUND)
WHERE A.KDFUND IN ('FF', 'BF', 'EF', 'MM')
	   ";

    /*$sql = "SELECT b.NAMAFUND VALUTA, kode_fund, 
                TO_CHAR(tgl_nab,'DD/MM/YYYY') TGLBERLAKU, nab_jual KURS, TOTAL_INVESTASI, TOTAL_UNIT
            FROM tabel_ul_nab a INNER JOIN tabel_ul_kode_fund b ON a.KODE_FUND = b.KDFUND
            WHERE (kode_fund, tgl_nab) IN (
               SELECT kode_fund, MAX(tgl_nab) tgl_nab
               FROM tabel_ul_nab
               GROUP BY kode_fund)
               AND a.KODE_FUND IN ('FF','BF','EF','MM')
            ORDER BY tgl_nab, kode_fund";*/

    $DB->parse($sql);
    $DB->execute();

    echo json_encode($DB->result());
    //echo $sql;
    //die;
}


/*===== tarik data kampus =====*/
else if (strcasecmp($r, '6') == 0) {
    $sql = "SELECT a.nama, a.deskripsi, a.gambar, b.namakantor, c.namaareaoffice
                FROM jaim_000_kampus@jaim a
                INNER JOIN tabel_001_kantor b ON a.kdkantor = b.kdkantor
                INNER JOIN tabel_410_area_office c ON a.kdkantor = c.kdkantor AND a.kdareaoffice = c.kdareaoffice
                WHERE a.kdstatus = 1
                ORDER BY a.urutan ";

    $DB->parse($sql);
    $DB->execute();

    echo json_encode($DB->result());
    //echo $sql;
}


/*===== tarik data user agen kancab kanwil =====*/
else if (strcasecmp($r, '7') == 0) {
    $sql = "SELECT * FROM
                (
                    SELECT tbl.*, rownum no
                    FROM
                    (
                        SELECT username, password, mobiletoken, 
                            CASE WHEN NVL(b.noklien, 0) = 0 THEN NULL
                            ELSE c.prefixagen||c.noagen END as noagen, 
                            b.namaklien1, b.emailtetap, pointour 
                        FROM JAIM_900_USER@JAIM a
                        LEFT OUTER JOIN TABEL_100_KLIEN b ON a.username = b.noklien
                        LEFT OUTER JOIN TABEL_400_AGEN c ON a.username = c.noagen
                        WHERE KDROLE IN ('1', '2', '3', '4') AND 
                            (
                            LOWER(username) LIKE '%$p%'
                            OR LOWER(b.noklien) LIKE '%$p%'
                            OR LOWER(b.namaklien1) LIKE '%$p%'
                            OR LOWER(b.emailtetap) LIKE '%$p%'
                            )
			    AND username NOT LIKE '%dibekukan%'
                        ORDER BY username
                    ) tbl
                WHERE rownum < (($p2 * $p3) + 1 )
            )
            WHERE no >= ((($p2-1) * $p3) + 1)";

    $DB->parse($sql);
    $DB->execute();

    echo json_encode($DB->result());
    //echo $sql;
}


/*===== tarik total data user agen kancab kanwil =====*/
else if (strcasecmp($r, '8') == 0) {
    $sql = "SELECT username, password, mobiletoken, 
                    CASE WHEN NVL(b.noklien, 0) = 0 THEN NULL
                    ELSE c.prefixagen||c.noagen END as noagen, 
                    b.namaklien1, b.emailtetap, pointour 
                FROM JAIM_900_USER@JAIM a
                LEFT OUTER JOIN TABEL_100_KLIEN b ON a.username = b.noklien
                LEFT OUTER JOIN TABEL_400_AGEN c ON a.username = c.noagen
                WHERE KDROLE IN ('1', '2', '3', '4') AND (
                    LOWER(username) LIKE '%$p%'
                    OR LOWER(b.noklien) LIKE '%$p%'
                    OR LOWER(b.namaklien1) LIKE '%$p%'
                    OR LOWER(b.emailtetap) LIKE '%$p%'
                    )
		    AND username NOT LIKE '%dibekukan%'
                ORDER BY username";

    $DB->parse($sql);
    $DB->execute();

    echo count($DB->result());
    //echo $sql;
}


/*===== data dasbor kantor =====*/
else if (strcasecmp($r, '9') == 0) {
    $filter = $p == 'KP' ? '' : " AND (kdkantor = '$p' OR kdkantor IN (SELECT kdkantor FROM TABEL_001_KANTOR WHERE kdkantorinduk = '$p'))";

    $sql = "SELECT 
                    (SELECT COUNT(username) 
                    FROM JAIM_900_USER@JAIM a INNER JOIN TABEL_400_AGEN b ON a.username = b.noagen
                    WHERE b.kdstatusagen = '01'
                        $filter) jmlagen,
                    
                    (SELECT COUNT(username)
                    FROM JAIM_900_USER@JAIM a INNER JOIN TABEL_400_AGEN b ON a.username = b.noagen
                    WHERE b.kdstatusagen = '01'
                        AND lastactivity BETWEEN TO_DATE('01012016' /*|| TO_CHAR(sysdate, 'yyyy')*/ , 'ddmmyyyy')
                        AND TO_DATE('3112' || TO_CHAR(sysdate, 'yyyy'), 'ddmmyyyy')
                        $filter) jmllogin,
                        
                    (SELECT COUNT(DISTINCT username) 
                    FROM JAIM_910_HISTORIS_DL_PS@JAIM a INNER JOIN TABEL_400_AGEN b ON a.username = b.noagen
                    WHERE b.kdstatusagen = '01'
                        AND datedownload BETWEEN TO_DATE('01012016' /*|| TO_CHAR(sysdate,'yyyy')*/, 'ddmmyyyy')
                        AND TO_DATE('3112' || TO_CHAR(sysdate, 'yyyy'), 'ddmmyyyy')
                        $filter) jmldlapp,
                    
                    (SELECT COUNT(DISTINCT id_agen) 
                    FROM JAIM_300_HITUNG@JAIM a INNER JOIN TABEL_400_AGEN b ON a.id_agen = b.noagen
                    WHERE a.id_agen IS NOT NULL
                        AND tgl_rekam BETWEEN TO_DATE('01012016' /*|| TO_CHAR(sysdate,'yyyy')*/, 'ddmmyyyy')
                        AND TO_DATE('3112' || TO_CHAR(sysdate, 'yyyy'), 'ddmmyyyy')
                        AND b.kdstatusagen = '01'
                        $filter) jmlprop
                FROM DUAL";

    $DB->parse($sql);
    $DB->execute();

    echo json_encode($DB->nextrow());
    //echo $sql;
}


/*===== data formasi kantor pusat =====*/
else if (strcasecmp($r, '10') == 0) {
    $sql = "
                SELECT kdkantor,
                    (SELECT COUNT(kdareaoffice)
                    FROM TABEL_410_AREA_OFFICE z
                    INNER JOIN TABEL_001_KANTOR y ON z.kdkantor = y.kdkantor
                    WHERE status IS NULL 
                        AND namaareaoffice NOT LIKE '%BANCAS%'
                        AND namaareaoffice NOT LIKE '%KHUSUS%'
                        AND namaareaoffice NOT LIKE '%BAWAH%'
                        AND namaareaoffice NOT LIKE 'AO%'
                        AND y.kdkantor = a.kdkantor) uka,
                    (SELECT COUNT(noagen)
                    FROM TABEL_400_AGEN z
                    INNER JOIN TABEL_001_KANTOR y ON z.kdkantor = y.kdkantor
                    WHERE kdstatusagen = '01'
                        AND kdjabatanagen IN ('02', '10')
                        AND y.kdkantor = a.kdkantor) am,
                    (SELECT COUNT(noagen)
                    FROM TABEL_400_AGEN z
                    INNER JOIN TABEL_001_KANTOR y ON z.kdkantor = y.kdkantor
                    WHERE kdstatusagen = '01'
                        AND kdjabatanagen IN ('05', '11')
                        AND y.kdkantor = a.kdkantor) um,
                    (SELECT COUNT(noagen)
                    FROM TABEL_400_AGEN z
                    INNER JOIN TABEL_001_KANTOR y ON z.kdkantor = y.kdkantor
                    WHERE kdstatusagen = '01'
                        AND kdjabatanagen IN ('00', '12')
                        AND y.kdkantor = a.kdkantor) ma
                FROM TABEL_001_KANTOR a
                WHERE kdkantor = '$p'
                    AND kdkantor NOT IN ('KP', 'MA', 'QA', 'RA', 'XA')
                
                UNION
                
                SELECT kdkantor,
                    (SELECT COUNT(kdareaoffice)
                    FROM TABEL_410_AREA_OFFICE z
                    INNER JOIN TABEL_001_KANTOR y ON z.kdkantor = y.kdkantor
                    WHERE status IS NULL 
                        AND namaareaoffice NOT LIKE '%BANCAS%'
                        AND namaareaoffice NOT LIKE '%KHUSUS%'
                        AND namaareaoffice NOT LIKE '%BAWAH%'
                        AND namaareaoffice NOT LIKE 'AO%'
                        AND (y.kdkantor = a.kdkantor OR y.kdkantorinduk = a.kdkantor)) uka,
                    (SELECT COUNT(noagen)
                    FROM TABEL_400_AGEN z
                    INNER JOIN TABEL_001_KANTOR y ON z.kdkantor = y.kdkantor
                    WHERE kdstatusagen = '01'
                        AND kdjabatanagen IN ('02', '10')
                        AND (y.kdkantor = a.kdkantor OR y.kdkantorinduk = a.kdkantor)) am,
                    (SELECT COUNT(noagen)
                    FROM TABEL_400_AGEN z
                    INNER JOIN TABEL_001_KANTOR y ON z.kdkantor = y.kdkantor
                    WHERE kdstatusagen = '01'
                        AND kdjabatanagen IN ('05', '11')
                        AND (y.kdkantor = a.kdkantor OR y.kdkantorinduk = a.kdkantor)) um,
                    (SELECT COUNT(noagen)
                    FROM TABEL_400_AGEN z
                    INNER JOIN TABEL_001_KANTOR y ON z.kdkantor = y.kdkantor
                    WHERE kdstatusagen = '01'
                        AND kdjabatanagen IN ('00', '12')
                        AND (y.kdkantor = a.kdkantor OR y.kdkantorinduk = a.kdkantor)) ma
                FROM TABEL_001_KANTOR a
                WHERE KDKANTORINDUK = '$p'
                    AND KDKANTOR NOT IN ('KP', 'MA', 'QA', 'RA', 'XA')
                
                ORDER BY KDKANTOR";

    $DB->parse($sql);
    $DB->execute();

    echo json_encode($DB->result());
    //echo $sql;
}


/*===== data insentif agen =====*/
else if (strcasecmp($r, '11') == 0) {
    $sql = "SELECT MAX(noagen) noagen, MAX(minrealisasi) minrealisasi, MAX(realisasi) realisasi, MAX(potensi) potensi, 
                CASE 
                    WHEN MAX(minrealisasi) BETWEEN 0 AND 2499999 THEN 2500000 - MAX(realisasi)
                    WHEN MAX(minrealisasi) BETWEEN 2500000 AND 4999999 THEN 5000000 - MAX(realisasi)
                    WHEN MAX(minrealisasi) BETWEEN 5000000 AND 7499999 THEN 7500000 - MAX(realisasi)
                    WHEN MAX(minrealisasi) BETWEEN 7500000 AND 9999999 THEN 10000000 - MAX(realisasi)
                    WHEN MAX(minrealisasi) BETWEEN 10000000 AND 12499999 THEN 12500000 - MAX(realisasi)
                    WHEN MAX(minrealisasi) > 12500000 THEN 0
                END kekurangan, NVL(MAX(lolosinsentif), 0) lolosinsentif
            FROM (
                SELECT a.noagen, a.minrealisasi, SUM(b.komisiagen) realisasi, 0 potensi, null lolosinsentif
                FROM (
                    SELECT MIN(SUM(x.komisiagen)) minrealisasi, MAX(MAX(x.noagen)) noagen
                    FROM tabel_404_temp x
                    INNER JOIN tabel_200_pertanggungan y ON x.prefixpertanggungan = y.prefixpertanggungan
                        AND x.nopertanggungan = y.nopertanggungan
                    INNER JOIN tabel_214_acceptance_dokumen z ON x.prefixpertanggungan = z.prefixpertanggungan
                        AND x.nopertanggungan = z.nopertanggungan
                        AND z.kdacceptance = '1'
                        AND TO_CHAR(y.mulas, 'mmyyyy') = TO_CHAR(z.tglacceptance, 'mmyyyy')
                    WHERE x.noagen = '$p'
						AND x.thnkomisi = '1'
                        AND x.kdkomisiagen = '01'
                        AND y.kdpertanggungan = '2'
                        AND y.kdcarabayar IN ('X', 'E', 'J')
                        AND y.mulas BETWEEN TO_DATE('01082017','ddmmyyyy') AND TO_DATE('31122017','ddmmyyyy')
                        AND y.taltup NOT IN ('1')
                    GROUP BY TO_CHAR(y.mulas, 'mmyyyy')
                ) a
                INNER JOIN tabel_404_temp b ON a.noagen = b.noagen
                INNER JOIN tabel_200_pertanggungan c ON b.prefixpertanggungan = c.prefixpertanggungan
                    AND b.nopertanggungan = c.nopertanggungan 
					AND b.thnkomisi = '1'
					AND b.kdkomisiagen = '01'
					AND c.kdpertanggungan = '2'
					AND c.kdcarabayar IN ('X', 'E', 'J')
					AND TO_CHAR(c.mulas,'mmyyyy') = TO_CHAR(sysdate,'mmyyyy')
					AND c.taltup NOT IN ('1')
                INNER JOIN tabel_214_acceptance_dokumen d ON b.prefixpertanggungan = d.prefixpertanggungan
					AND b.nopertanggungan = d.nopertanggungan
                    AND d.kdacceptance = '1'
                    AND TO_CHAR(c.mulas, 'mmyyyy') = TO_CHAR(d.tglacceptance, 'mmyyyy')
                GROUP BY a.noagen, a.minrealisasi
                UNION ALL
                SELECT MAX(x.noagen), 0, 0, NVL(SUM(komisiagen), 0), null
                FROM tabel_404_temp x
                INNER JOIN tabel_200_pertanggungan y ON x.prefixpertanggungan = y.prefixpertanggungan
                    AND x.nopertanggungan = y.nopertanggungan
                WHERE x.thnkomisi = '1'
					AND x.kdkomisiagen = '01'
					AND y.kdpertanggungan = '1'
					AND y.kdcarabayar IN ('X', 'E', 'J')
                    AND TO_CHAR(y.mulas,'mmyyyy') = TO_CHAR(sysdate,'mmyyyy')
                    AND y.taltup NOT IN ('1')
                    AND x.noagen = '$p'
                UNION ALL
                SELECT null, null, null, null, 
                    CASE WHEN MIN(SUM(x.komisiagen)) >= TRUNC(MONTHS_BETWEEN(TO_DATE(TO_CHAR(sysdate, 'mmyyyy'), 'mmyyyy'), TO_DATE('082017', 'mmyyyy'))) * 2500000 THEN 1 ELSE 0 END
                FROM tabel_404_temp x
                INNER JOIN tabel_200_pertanggungan y ON x.prefixpertanggungan = y.prefixpertanggungan
                    AND x.nopertanggungan = y.nopertanggungan
                INNER JOIN tabel_214_acceptance_dokumen z ON x.prefixpertanggungan = z.prefixpertanggungan
                    AND x.nopertanggungan = z.nopertanggungan
                    AND z.kdacceptance = '1'
                    AND TO_CHAR(y.mulas, 'mmyyyy') = TO_CHAR(z.tglacceptance, 'mmyyyy')
                WHERE x.noagen = '$p'
                    AND x.thnkomisi = '1'
                    AND x.kdkomisiagen = '01'
                    AND y.kdpertanggungan = '2'
                    AND y.kdcarabayar IN ('X', 'E', 'J')
                    AND y.mulas BETWEEN TO_DATE('01082017','ddmmyyyy') AND TO_DATE('31122017','ddmmyyyy')
                    AND y.taltup NOT IN ('1')
                GROUP BY TO_CHAR(y.mulas, 'mmyyyy')
            )";

    $DB->parse($sql);
    $DB->execute();

    echo json_encode($DB->nextrow());
    //echo $sql;
}