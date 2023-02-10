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
$DB2 = new Database(C_USER_DB_JLINDO, C_PASS_DB_JLINDO, C_DB_JLINDO);

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
$dataEval=array();
while($arr = $DB->nextrow()) {
	$sql2 ="SELECT 	'".$arr["NOAGEN"]."' AS NOAGEN,
					'".$arr["KDKANTOR"]."' AS KDKANTOR,
	           	   	'".$arr["KDJABATANAGEN"]."' AS KDJABATANAGEN,
	           	   	'".$arr["NAMAJABATANAGEN"]."' AS NAMAJABATANAGEN,
	           	  	'".$arr["NAMAAGEN"]."' AS NAMAAGEN,
	           	  	'".$arr["NAMAKANTOR"]."' AS NAMAKANTOR,
	           	  	'".$arr["LEVELHIRARKI"]."' AS LEVELHIRARKI,
	           	  	'".$arr["JABATANATASAN"]."' AS JABATANATASAN,
	           	  	'".$arr["TOTALREKRUT"]."' AS TOTALREKRUT,
	           	  	'".$arr["REKRUTBERLISENSI"]."' AS REKRUTBERLISENSI,
	           		(
	           			SELECT  NVL(SUM(
	                                CASE 
	                                    WHEN B.KDCARABAYAR IN ('1','M') THEN premi1 * 12
	                                    WHEN B.KDCARABAYAR IN ('2','Q') THEN premi1 * 4
	                                    WHEN B.KDCARABAYAR IN ('3','H') THEN premi1 * 2
	                                    ELSE premi1
	                                END
	                            ),0)
		                FROM TABEL_400_AGEN A, TABEL_200_PERTANGGUNGAN B
		                WHERE A.NOAGEN IN( (SELECT   NOAGEN
		                                       FROM   TABEL_400_AGEN 
		                                       WHERE    KDSTATUSAGEN = '01'
		                                                AND KDKANTOR = '$p3' 
		                                       START WITH   ATASAN = '".$arr["NOAGEN"]."' 
		                                       CONNECT BY   PRIOR NOAGEN = ATASAN
		                                       UNION ALL
		                                       SELECT   '".$arr["NOAGEN"]."'  FROM DUAL
		                               	   )
		                                 )
		                      AND B.NOAGEN = A.NOAGEN
		                      AND B.MULAS >= TO_DATE('$p','DD/MM/YYYY') AND B.MULAS <=TO_DATE('$p2','DD/MM/YYYY')
		                      AND A.KDSTATUSAGEN = '01'
		                      AND B.KDSTATUSFILE NOT IN ('7') and B.KDPERTANGGUNGAN ='2'
		                      AND B.KDCARABAYAR NOT IN ('X','E','J')
	           		) as premi_berkala,
	           		(
	           			SELECT COUNT(B.NOPERTANGGUNGAN)
		                FROM TABEL_400_AGEN A, TABEL_200_PERTANGGUNGAN B
		                WHERE A.NOAGEN IN( (SELECT   NOAGEN
		                                       FROM   TABEL_400_AGEN 
		                                       WHERE    KDSTATUSAGEN = '01'
		                                                AND KDKANTOR = '$p3' 
		                                       START WITH   ATASAN = '".$arr["NOAGEN"]."'
		                                       CONNECT BY   PRIOR NOAGEN = ATASAN
		                                       UNION ALL
		                                       SELECT   '".$arr["NOAGEN"]."' FROM DUAL
		                               	   )
		                                 )
		                      AND B.NOAGEN = A.NOAGEN
		                      AND B.MULAS >= TO_DATE('$p','DD/MM/YYYY') AND B.MULAS <=TO_DATE('$p2','DD/MM/YYYY')
		                      AND A.KDSTATUSAGEN = '01'
		                      AND B.KDSTATUSFILE NOT IN ('7') and B.KDPERTANGGUNGAN ='2'
		                      AND B.KDCARABAYAR NOT IN ('X','E','J')
		            ) as polis_berkala,
		            (
	           			SELECT  NVL(SUM(
	                                CASE 
	                                    WHEN B.KDCARABAYAR IN ('1','M') THEN premi1 * 12
	                                    WHEN B.KDCARABAYAR IN ('2','Q') THEN premi1 * 4
	                                    WHEN B.KDCARABAYAR IN ('3','H') THEN premi1 * 2
	                                    ELSE premi1
	                                END
	                            ),0)
		                FROM TABEL_400_AGEN A, TABEL_200_PERTANGGUNGAN B
		                WHERE A.NOAGEN IN( (SELECT   NOAGEN
		                                       FROM   TABEL_400_AGEN 
		                                       WHERE    KDSTATUSAGEN = '01'
		                                                AND KDKANTOR = '$p3' 
		                                       START WITH   ATASAN = '".$arr["NOAGEN"]."' 
		                                       CONNECT BY   PRIOR NOAGEN = ATASAN
		                                       UNION ALL
		                                       SELECT   '".$arr["NOAGEN"]."'  FROM DUAL
		                               	   )
		                                 )
		                      AND B.NOAGEN = A.NOAGEN
		                      AND B.MULAS >= TO_DATE('$p','DD/MM/YYYY') AND B.MULAS <=TO_DATE('$p2','DD/MM/YYYY')
		                      AND A.KDSTATUSAGEN = '01'
		                      AND B.KDSTATUSFILE NOT IN ('7') and B.KDPERTANGGUNGAN ='2'
		                      AND B.KDCARABAYAR IN ('X','E','J')
	           		) as premi_sekaligus,
	           		(
	           			SELECT COUNT(B.NOPERTANGGUNGAN)
		                FROM TABEL_400_AGEN A, TABEL_200_PERTANGGUNGAN B
		                WHERE A.NOAGEN IN( (SELECT   NOAGEN
		                                       FROM   TABEL_400_AGEN 
		                                       WHERE    KDSTATUSAGEN = '01'
		                                                AND KDKANTOR = '$p3' 
		                                       START WITH   ATASAN = '".$arr["NOAGEN"]."'
		                                       CONNECT BY   PRIOR NOAGEN = ATASAN
		                                       UNION ALL
		                                       SELECT   '".$arr["NOAGEN"]."' FROM DUAL
		                               	   )
		                                 )
		                      AND B.NOAGEN = A.NOAGEN
		                      AND B.MULAS >= TO_DATE('$p','DD/MM/YYYY') AND B.MULAS <=TO_DATE('$p2','DD/MM/YYYY')
		                      AND A.KDSTATUSAGEN = '01'
		                      AND B.KDSTATUSFILE NOT IN ('7') and B.KDPERTANGGUNGAN ='2'
		                      AND B.KDCARABAYAR IN ('X','E','J')
		            ) as polis_sekaligus,
		            (
                       SELECT NVL(SUM(NVL(y.PREMI, x.RP_GROSS)), 0)
							FROM TABEL_200_PERTANGGUNGAN z
						 	LEFT OUTER JOIN TABEL_223_TRANSAKSI_TOPUP y ON z.PREFIXPERTANGGUNGAN = y.PREFIXPERTANGGUNGAN
							     AND z.NOPERTANGGUNGAN = y.NOPERTANGGUNGAN
							     AND y.STATUS = '2'
							     AND y.TGLUPDATED BETWEEN TO_DATE ('$p', 'DD/MM/YYYY') AND TO_DATE ('$p2', 'DD/MM/YYYY')
							LEFT OUTER JOIN TABEL_UL_TRANSAKSI x ON z.PREFIXPERTANGGUNGAN = SUBSTR(x.NOMOR_POLIS, 0, 2)
							     AND z.NOPERTANGGUNGAN = SUBSTR(x.NOMOR_POLIS, 3)
							     AND x.TRX_DATE BETWEEN TO_DATE('$p', 'DD/MM/YYYY') AND TO_DATE('$p2', 'DD/MM/YYYY')
							     AND x.DESCRIPTION LIKE 'TOPUP SEKALIGUS%'
						WHERE z.NOAGEN IN( (SELECT   NOAGEN
                                               FROM   TABEL_400_AGEN 
                                               WHERE    KDSTATUSAGEN = '01'
                                                        AND KDKANTOR = '$p3' 
                                               START WITH   ATASAN = '".$arr["NOAGEN"]."'
                                               CONNECT BY   PRIOR NOAGEN = ATASAN
                                               UNION ALL
                                               SELECT   '".$arr["NOAGEN"]."' FROM DUAL
                                       	   )
                                         )
						     AND z.KDPERTANGGUNGAN = '2'
		            )topup_sekaligus,
		            (
						            	
		            	SELECT   COUNT(NOAGEN) AS JML
                       	FROM   TABEL_400_AGEN 
                       	WHERE    KDSTATUSAGEN = '01'
                                AND KDKANTOR = '$p3' 
                       	START WITH   ATASAN = '".$arr["NOAGEN"]."'
                       	CONNECT BY nocycle PRIOR NOAGEN = ATASAN
		            ) formasi,
		            (SELECT NVL(TARGETPOLIS,0)
		            	FROM tabel_403_target_agen_new 
		            	WHERE
		            		 kdkantor = '$p3'
		            		 and kdjabatanagen = '".$arr["KDJABATANAGEN"]."'
		            		 AND THTARGET = '".$tahunsekarang."'
		           	) target_polis,
		           	(SELECT NVL(TARGETPREMI,0)
		            	FROM tabel_403_target_agen_new 
		            	WHERE
		            		 kdkantor = '$p3'
		            		 and kdjabatanagen = '".$arr["KDJABATANAGEN"]."'
		            		 AND THTARGET = '".$tahunsekarang."'
		           	) target_premi,
		           	(
                        SELECT  NVL(SUM(
                                            CASE 
                                                WHEN B.KDCARABAYAR IN ('1','M') THEN premi1 * 12
                                                WHEN B.KDCARABAYAR IN ('2','Q') THEN premi1 * 4
                                                WHEN B.KDCARABAYAR IN ('3','H') THEN premi1 * 2
                                                ELSE premi1
                                            END
                                        ),0)
                        FROM TABEL_400_AGEN A, TABEL_200_PERTANGGUNGAN B
                        WHERE A.NOAGEN IN( (SELECT   NOAGEN
                                               FROM   TABEL_400_AGEN 
                                               WHERE    KDSTATUSAGEN = '01'
                                                        AND KDKANTOR = '$p3' 
                                               START WITH   ATASAN = '".$arr["NOAGEN"]."'
                                               CONNECT BY nocycle PRIOR NOAGEN = ATASAN
                                               UNION ALL
                                               SELECT   '".$arr["NOAGEN"]."' FROM DUAL
                                       	   )
                                         )
                              AND B.NOAGEN = A.NOAGEN
                              AND TO_CHAR(B.MULAS,'YYYY') = '".$tahunsebelum."'
                              AND A.KDSTATUSAGEN = '01'
                              AND B.KDSTATUSFILE NOT IN ('2') and B.KDPERTANGGUNGAN ='2'
                              AND B.KDCARABAYAR NOT IN ('X','E','J')
                    )premi_persistensi,
                    (
                        SELECT  NVL(SUM(
                                        CASE 
                                            WHEN B.KDCARABAYAR IN ('1','M') THEN premi1 * 12
                                            WHEN B.KDCARABAYAR IN ('2','Q') THEN premi1 * 4
                                            WHEN B.KDCARABAYAR IN ('3','H') THEN premi1 * 2
                                            ELSE premi1
                                        END
                                    ),0)
                        FROM TABEL_400_AGEN A, TABEL_200_PERTANGGUNGAN B
                        WHERE A.NOAGEN IN( (SELECT   NOAGEN
                                               FROM   TABEL_400_AGEN 
                                               WHERE    KDSTATUSAGEN = '01'
                                                        AND KDKANTOR = '$p3' 
                                               START WITH   ATASAN = '".$arr["NOAGEN"]."'
                                               CONNECT BY  nocycle PRIOR NOAGEN = ATASAN
                                               UNION ALL
                                               SELECT   '".$arr["NOAGEN"]."' FROM DUAL
                                       	   )
                                         )
                              AND B.NOAGEN = A.NOAGEN
                              AND TO_CHAR(B.MULAS,'YYYY') = '".$tahunsebelum."'
                              AND A.KDSTATUSAGEN = '01'
                              AND B.KDSTATUSFILE IN ('4','5','X') and B.KDPERTANGGUNGAN ='2'
                              AND B.KDCARABAYAR NOT IN ('X','E','J')
                    )batal_tahun_lalu,
                    (
                        SELECT  NVL(SUM(
                                            CASE 
                                                WHEN B.KDCARABAYAR IN ('1','M') THEN premi1 * 12
                                                WHEN B.KDCARABAYAR IN ('2','Q') THEN premi1 * 4
                                                WHEN B.KDCARABAYAR IN ('3','H') THEN premi1 * 2
                                                ELSE premi1
                                            END
                                        ),0)
                        FROM TABEL_400_AGEN A, TABEL_200_PERTANGGUNGAN B
                        WHERE A.NOAGEN IN( (SELECT   NOAGEN
                                               FROM   TABEL_400_AGEN 
                                               WHERE    KDSTATUSAGEN = '01'
                                                        AND KDKANTOR = '$p3' 
                                               START WITH   ATASAN = '".$arr["NOAGEN"]."'
                                               CONNECT BY   PRIOR NOAGEN = ATASAN
                                               UNION ALL
                                               SELECT   '".$arr["NOAGEN"]."' FROM DUAL
                                       	   )
                                         )
                              AND B.NOAGEN = A.NOAGEN
                              AND B.MULAS >= TO_DATE('$p','DD/MM/YYYY') AND B.MULAS <=TO_DATE('$p2','DD/MM/YYYY')
                              AND A.KDSTATUSAGEN = '01'
                              AND B.KDSTATUSFILE IN ('4','5','X') and B.KDPERTANGGUNGAN ='2'
                              AND B.KDCARABAYAR NOT IN ('X','E','J')
                    )premi_batal_tebus

		    from dual
	            ";
	//echo $sql2;
	$DB2->parse($sql2);
	$DB2->execute();
	array_push($dataEval, $DB2->nextrow());
}
//print_r($dataEval);
echo json_encode($dataEval);


?>