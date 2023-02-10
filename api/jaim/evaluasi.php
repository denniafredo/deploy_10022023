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
	
	$DB = new Database(C_USER_DB_JLINDO, C_PASS_DB_JLINDO, C_DB_JLINDO);
	
	/*===== tarik data evaluasi per cabang =====*/
	if (strcasecmp($r, '2') == 0) {
		$sql = "SELECT a.PREFIXAGEN, a.NOAGEN, c.NAMAKLIEN1, b.NAMAJABATANAGEN, e.NAMAAREAOFFICE, 
					a.KDUNITPRODUKSI, f.NAMAUNITPRODUKSI, 
					NVL(d.TRGPOLISNBPPHEAD, 0) TRGPOLISNBPPHEAD, NVL(i.trgpolisnbpphead, 0) trgpolisnbppheadl,
					NVL(d.TRGPREMINBPPHEAD, 0) TRGPREMINBPPHEAD, NVL(i.trgpreminbpphead, 0) trgpreminbppheadl,
					NVL(j.trgpolisnbpporg, 0) trgpolisnbpporgl, NVL(j.trgpreminbpporg, 0) trgpreminbpporgl,
					NVL(H.TRGPOLISNBPPORG, 0) TRGPOLISNBPPORG, NVL(H.TRGPREMINBPPORG, 0) TRGPREMINBPPORG,
					(SELECT COUNT(DISTINCT(z.NOPERTANGGUNGAN)) 
					 FROM TABEL_200_PERTANGGUNGAN z 
					 INNER JOIN TABEL_300_HISTORIS_PREMI y ON z.PREFIXPERTANGGUNGAN = y.PREFIXPERTANGGUNGAN 
					 	 AND z.NOPERTANGGUNGAN = y.NOPERTANGGUNGAN 
						 AND y.KDKUITANSI = 'BP3'
					 WHERE z.KDPERTANGGUNGAN = '2'
						 AND z.NOAGEN = a.NOAGEN 
						 AND z.KDPRODUK NOT IN ('PAA','PAB','AKM')
						 AND z.MULAS BETWEEN TO_DATE('$p', 'DD/MM/YYYY') AND TO_DATE('$p2', 'DD/MM/YYYY')) AS REALISASI_POLIS,
						 
					NVL((SELECT COUNT(DISTINCT CASE WHEN TO_DATE('01/07/2018','dd/mm/yyyy') > TO_DATE('$p','dd/mm/yyyy') AND TO_DATE('01/07/2018','dd/mm/yyyy') > TO_DATE('$p2','dd/mm/yyyy') THEN
                             CASE WHEN z.mulas BETWEEN TO_DATE('$p','dd/mm/yyyy') AND TO_DATE('$p2','dd/mm/yyyy') THEN z.nopertanggungan ELSE null END
                         WHEN TO_DATE('01/07/2018','dd/mm/yyyy') > TO_DATE('$p','dd/mm/yyyy') AND TO_DATE('01/07/2018','dd/mm/yyyy') <= TO_DATE('$p2','dd/mm/yyyy') THEN
                             CASE WHEN z.mulas BETWEEN TO_DATE('$p','dd/mm/yyyy') AND TO_DATE('30/06/2018','dd/mm/yyyy') THEN z.nopertanggungan ELSE null END
                         END)
                     FROM tabel_200_pertanggungan z
                     INNER JOIN tabel_300_historis_premi y ON z.prefixpertanggungan = y.prefixpertanggungan
                         AND z.nopertanggungan = y.nopertanggungan
                         AND y.kdkuitansi = 'BP3'
                     WHERE z.kdpertanggungan = '2'
                         AND z.noagen = a.noagen
                         AND z.kdproduk NOT IN ('PAA','PAB','AKM')
                         AND z.mulas BETWEEN TO_DATE('$p','dd/mm/yyyy') AND TO_DATE('$p2','dd/mm/yyyy')),0) AS realisasi_polisl,
						 
					NVL((SELECT COUNT(DISTINCT CASE WHEN TO_DATE('30/06/2018','dd/mm/yyyy') < TO_DATE('$p','dd/mm/yyyy') AND TO_DATE('30/06/2018','dd/mm/yyyy') < TO_DATE('$p2','dd/mm/yyyy') THEN
                             CASE WHEN z.mulas BETWEEN TO_DATE('$p','dd/mm/yyyy') AND TO_DATE('$p2','dd/mm/yyyy') THEN z.nopertanggungan ELSE null END
                         WHEN TO_DATE('30/06/2018','dd/mm/yyyy') >= TO_DATE('$p','dd/mm/yyyy') AND TO_DATE('30/06/2018','dd/mm/yyyy') < TO_DATE('$p2','dd/mm/yyyy') THEN
                             CASE WHEN z.mulas BETWEEN TO_DATE('01/07/2018','dd/mm/yyyy') AND TO_DATE('$p2','dd/mm/yyyy') THEN z.nopertanggungan ELSE null END
                          END)
                     FROM tabel_200_pertanggungan z
                     INNER JOIN tabel_300_historis_premi y ON z.prefixpertanggungan = y.prefixpertanggungan
                         AND z.nopertanggungan = y.nopertanggungan
                         AND y.kdkuitansi = 'BP3'
                     WHERE z.kdpertanggungan = '2'
                         AND z.noagen = a.noagen
                         AND z.kdproduk NOT IN ('PAA','PAB','AKM')
                         AND z.mulas BETWEEN TO_DATE('$p','dd/mm/yyyy') AND TO_DATE('$p2','dd/mm/yyyy')),0) AS realisasi_polisb,
						 
					(SELECT NVL(SUM(NILAIRP), 0) 
					 FROM TABEL_200_PERTANGGUNGAN z 
					 INNER JOIN TABEL_300_HISTORIS_PREMI y ON z.PREFIXPERTANGGUNGAN = y.PREFIXPERTANGGUNGAN 
					 	 AND z.NOPERTANGGUNGAN = y.NOPERTANGGUNGAN 
					 WHERE z.KDCARABAYAR = 'X' AND y.KDKUITANSI = 'BP3' AND z.MULAS BETWEEN TO_DATE('$p', 'DD/MM/YYYY') AND TO_DATE('$p2', 'DD/MM/YYYY') 
						 AND z.NOAGEN = a.NOAGEN AND z.KDPERTANGGUNGAN = '2'
						 AND z.KDPRODUK NOT IN ('PAA','PAB','AKM')) AS REALISASI_PREMIX, 
						 
					NVL((SELECT SUM(CASE WHEN TO_DATE('01/07/2018','dd/mm/yyyy') > TO_DATE('$p','dd/mm/yyyy') AND TO_DATE('01/07/2018','dd/mm/yyyy') > TO_DATE('$p2','dd/mm/yyyy') THEN
                             CASE WHEN z.mulas BETWEEN TO_DATE('$p','dd/mm/yyyy') AND TO_DATE('$p2','dd/mm/yyyy') THEN y.nilairp ELSE 0 END
                         WHEN TO_DATE('01/07/2018','dd/mm/yyyy') > TO_DATE('$p','dd/mm/yyyy') AND TO_DATE('01/07/2018','dd/mm/yyyy') <= TO_DATE('$p2','dd/mm/yyyy') THEN
                             CASE WHEN z.mulas BETWEEN TO_DATE('$p','dd/mm/yyyy') AND TO_DATE('30/06/2018','dd/mm/yyyy') THEN y.nilairp ELSE 0 END
                         END)
                     FROM tabel_200_pertanggungan z
                     INNER JOIN tabel_300_historis_premi y ON z.prefixpertanggungan = y.prefixpertanggungan
                         AND z.nopertanggungan = y.nopertanggungan
                         AND y.kdkuitansi = 'BP3'
                     INNER JOIN tabel_400_agen x ON z.noagen = x.noagen
                     WHERE z.kdcarabayar = 'X'
                         AND z.kdpertanggungan = '2'
                         AND z.noagen = a.noagen
                         AND z.kdproduk NOT IN ('PAA','PAB','AKM')
                         AND z.mulas BETWEEN TO_DATE('$p','dd/mm/yyyy') AND TO_DATE('$p2','dd/mm/yyyy')),0) AS realisasi_premilx,
						 
                    NVL((SELECT SUM(CASE WHEN TO_DATE('30/06/2018','dd/mm/yyyy') < TO_DATE('$p','dd/mm/yyyy') AND TO_DATE('30/06/2018','dd/mm/yyyy') < TO_DATE('$p2','dd/mm/yyyy') THEN
                             CASE WHEN z.mulas BETWEEN TO_DATE('$p','dd/mm/yyyy') AND TO_DATE('$p2','dd/mm/yyyy') THEN y.nilairp * 0.3 ELSE 0 END
                         WHEN TO_DATE('30/06/2018','dd/mm/yyyy') >= TO_DATE('$p','dd/mm/yyyy') AND TO_DATE('30/06/2018','dd/mm/yyyy') < TO_DATE('$p2','dd/mm/yyyy') THEN
                             CASE WHEN z.mulas BETWEEN TO_DATE('01/07/2018','dd/mm/yyyy') AND TO_DATE('$p2','dd/mm/yyyy') THEN y.nilairp * 0.3 ELSE 0 END
                          END)
                     FROM tabel_200_pertanggungan z
                     INNER JOIN tabel_300_historis_premi y ON z.prefixpertanggungan = y.prefixpertanggungan
                         AND z.nopertanggungan = y.nopertanggungan
                         AND y.kdkuitansi = 'BP3'
                     INNER JOIN tabel_400_agen x ON z.noagen = x.noagen
                     WHERE z.kdcarabayar = 'X'
                         AND z.kdpertanggungan = '2'
                         AND z.noagen = a.noagen
                         AND z.kdproduk NOT IN ('PAA','PAB','AKM')
						 /*AND x.kdjabatanagen NOT IN ('00','09')*/
                         AND z.mulas BETWEEN TO_DATE('$p','dd/mm/yyyy') AND TO_DATE('$p2','dd/mm/yyyy')),0) AS realisasi_premibx,
						 
					(SELECT NVL(SUM(NILAIRP), 0) 
					 FROM TABEL_200_PERTANGGUNGAN z 
					 INNER JOIN TABEL_300_HISTORIS_PREMI y ON z.PREFIXPERTANGGUNGAN = y.PREFIXPERTANGGUNGAN 
					 	 AND z.NOPERTANGGUNGAN = y.NOPERTANGGUNGAN 
					 WHERE z.KDCARABAYAR != 'X' AND y.KDKUITANSI = 'BP3' AND z.MULAS BETWEEN TO_DATE('$p', 'DD/MM/YYYY') AND TO_DATE('$p2', 'DD/MM/YYYY') 
						 AND z.NOAGEN = a.NOAGEN AND z.KDPERTANGGUNGAN = '2'
						 AND z.KDPRODUK NOT IN ('PAA', 'PAB','AKM')) AS REALISASI_PREMIB, 

					NVL((SELECT SUM(CASE WHEN TO_DATE('01/07/2018','dd/mm/yyyy') > TO_DATE('$p','dd/mm/yyyy') AND TO_DATE('01/07/2018','dd/mm/yyyy') > TO_DATE('$p2','dd/mm/yyyy') THEN
                             CASE WHEN z.mulas BETWEEN TO_DATE('$p','dd/mm/yyyy') AND TO_DATE('30/06/2018','dd/mm/yyyy') THEN y.nilairp ELSE 0 END
                         WHEN TO_DATE('01/07/2018','dd/mm/yyyy') > TO_DATE('$p','dd/mm/yyyy') AND TO_DATE('01/07/2018','dd/mm/yyyy') <= TO_DATE('$p2','dd/mm/yyyy') THEN
                             CASE WHEN z.mulas BETWEEN TO_DATE('$p','dd/mm/yyyy') AND TO_DATE('30/06/2018','dd/mm/yyyy') THEN y.nilairp ELSE 0 END
                         END)
                     FROM tabel_200_pertanggungan z
                     INNER JOIN tabel_300_historis_premi y ON z.prefixpertanggungan = y.prefixpertanggungan
                         AND z.nopertanggungan = y.nopertanggungan
                         AND y.kdkuitansi = 'BP3'
                     WHERE z.kdcarabayar != 'X'
                         AND z.kdpertanggungan = '2'
                         AND z.noagen = a.noagen
                         AND z.kdproduk NOT IN ('PAA','PAB','AKM')
                         AND z.mulas BETWEEN TO_DATE('$p','dd/mm/yyyy') AND TO_DATE('$p2','dd/mm/yyyy')),0) AS realisasi_premilb,
						 
					NVL((SELECT SUM(CASE WHEN TO_DATE('30/06/2018','dd/mm/yyyy') < TO_DATE('$p', 'dd/mm/yyyy') AND TO_DATE('30/06/2018','dd/mm/yyyy') < TO_DATE('$p2', 'dd/mm/yyyy') THEN
							 CASE WHEN z.mulas BETWEEN TO_DATE('$p','dd/mm/yyyy') AND TO_DATE ('$p2','dd/mm/yyyy') THEN y.nilairp ELSE 0 END
						 WHEN TO_DATE('30/06/2018','dd/mm/yyyy') >= TO_DATE('$p','dd/mm/yyyy') AND TO_DATE('30/06/2018','dd/mm/yyyy') < TO_DATE('$p2','dd/mm/yyyy') THEN
							 CASE WHEN z.mulas BETWEEN TO_DATE('01/07/2018','dd/mm/yyyy') AND TO_DATE('$p2','dd/mm/yyyy') THEN y.nilairp ELSE 0 END
						 END)
					 FROM tabel_200_pertanggungan z
					 INNER JOIN tabel_300_historis_premi y ON z.prefixpertanggungan = y.prefixpertanggungan
						 AND z.nopertanggungan = y.nopertanggungan
						 AND y.kdkuitansi = 'BP3'
					 WHERE z.kdcarabayar != 'X'
						 AND z.kdpertanggungan = '2'
						 AND z.noagen = a.noagen
						 AND z.kdproduk NOT IN ('PAA', 'PAB', 'AKM')
						 AND z.mulas BETWEEN TO_DATE('$p', 'dd/mm/yyyy') AND TO_DATE('$p2', 'dd/mm/yyyy')),0) AS realisasi_premibb,
						 
					(SELECT NVL(SUM(NILAIRP), 0) 
					 FROM TABEL_200_PERTANGGUNGAN z 
					 INNER JOIN TABEL_300_HISTORIS_PREMI y ON z.PREFIXPERTANGGUNGAN = y.PREFIXPERTANGGUNGAN 
					 	 AND z.NOPERTANGGUNGAN = y.NOPERTANGGUNGAN 
					 WHERE z.KDCARABAYAR != 'X' AND y.KDKUITANSI = 'NB1' AND z.MULAS BETWEEN TO_DATE('$p', 'DD/MM/YYYY') AND TO_DATE('$p2', 'DD/MM/YYYY') 
						 AND z.NOAGEN = a.NOAGEN AND z.KDPERTANGGUNGAN = '2'
						 AND z.KDPRODUK NOT IN ('PAA','PAB','AKM')) AS REALISASI_PREMIBL, 
						 
					NVL((SELECT SUM(CASE WHEN TO_DATE('01/07/2018','dd/mm/yyyy') > TO_DATE('$p','dd/mm/yyyy') AND TO_DATE('01/07/2018','dd/mm/yyyy') > TO_DATE('$p2','dd/mm/yyyy') THEN
                             CASE WHEN z.mulas BETWEEN TO_DATE('$p','dd/mm/yyyy') AND TO_DATE('30/06/2018','dd/mm/yyyy') THEN y.nilairp ELSE 0 END 
                         WHEN TO_DATE('01/07/2018','dd/mm/yyyy') > TO_DATE('$p','dd/mm/yyyy') AND TO_DATE('01/07/2018','dd/mm/yyyy') <= TO_DATE('$p2','dd/mm/yyyy') THEN 
                             CASE WHEN z.mulas BETWEEN TO_DATE('$p','dd/mm/yyyy') AND TO_DATE ('30/06/2018','dd/mm/yyyy') THEN y.nilairp ELSE 0 END 
                         END)
                     FROM tabel_200_pertanggungan z
                     INNER JOIN tabel_300_historis_premi y ON z.prefixpertanggungan = y.prefixpertanggungan
                         AND z.nopertanggungan = y.nopertanggungan
                         AND y.kdkuitansi = 'NB1'
                     WHERE z.kdcarabayar != 'X'
                         AND z.kdpertanggungan = '2'
                         AND z.noagen = a.noagen
                         AND z.kdproduk NOT IN ('PAA', 'PAB', 'AKM')
                         AND z.mulas BETWEEN TO_DATE ('$p','dd/mm/yyyy') AND TO_DATE ('$p2','dd/mm/yyyy')),0) AS realisasi_premilbl,
                         
                    NVL((SELECT SUM(CASE WHEN TO_DATE('30/06/2018','dd/mm/yyyy') < TO_DATE('$p','dd/mm/yyyy') AND TO_DATE ('30/06/2018','dd/mm/yyyy') < TO_DATE('$p2','dd/mm/yyyy') THEN
                             CASE WHEN z.mulas BETWEEN TO_DATE ('$p','dd/mm/yyyy') AND TO_DATE('$p2','dd/mm/yyyy') THEN y.nilairp ELSE 0 END
                         WHEN TO_DATE('30/06/2018','dd/mm/yyyy') >= TO_DATE('$p','dd/mm/yyyy') AND TO_DATE('30/06/2018','dd/mm/yyyy') < TO_DATE('$p2','dd/mm/yyyy') THEN 
                             CASE WHEN z.mulas BETWEEN TO_DATE('01/07/2018','dd/mm/yyyy') AND TO_DATE('$p2','dd/mm/yyyy') THEN y.nilairp ELSE 0 END
                         END)
                     FROM tabel_200_pertanggungan z
                     INNER JOIN tabel_300_historis_premi y ON z.prefixpertanggungan = y.prefixpertanggungan
                         AND z.nopertanggungan = y.nopertanggungan
                         AND y.kdkuitansi = 'NB1'
                     WHERE z.kdcarabayar != 'X'
                         AND z.kdpertanggungan = '2'
                         AND z.noagen = a.noagen
                         AND z.kdproduk NOT IN ('PAA', 'PAB', 'AKM')
                         AND z.mulas BETWEEN TO_DATE('$p','dd/mm/yyyy') AND TO_DATE('$p2','dd/mm/yyyy')),0) AS realisasi_premibbl,
						 
                    (SELECT NVL(SUM(NVL(y.PREMI, x.RP_GROSS)), 0)
					 FROM TABEL_200_PERTANGGUNGAN z
					 LEFT OUTER JOIN TABEL_223_TRANSAKSI_TOPUP y ON z.PREFIXPERTANGGUNGAN = y.PREFIXPERTANGGUNGAN
					     AND z.NOPERTANGGUNGAN = y.NOPERTANGGUNGAN
					     AND y.STATUS = '2'
					 LEFT OUTER JOIN TABEL_UL_TRANSAKSI x ON z.PREFIXPERTANGGUNGAN = SUBSTR(x.NOMOR_POLIS, 0, 2)
					     AND z.NOPERTANGGUNGAN = SUBSTR(x.NOMOR_POLIS, 3)
					     AND x.DESCRIPTION LIKE 'TOPUP SEKALIGUS%'
					 WHERE z.NOAGEN = a.NOAGEN
					     AND z.KDPERTANGGUNGAN = '2'
						 AND z.MULAS BETWEEN TO_DATE ('$p','dd/mm/yyyy') AND TO_DATE ('$p2','dd/mm/yyyy')) AS REALISASI_PREMITOPUP,
						 
					NVL((SELECT SUM(CASE WHEN TO_DATE ('01/07/2018', 'dd/mm/yyyy') > TO_DATE ('$p', 'dd/mm/yyyy') AND TO_DATE ('01/07/2018', 'dd/mm/yyyy') > TO_DATE ('$p2', 'dd/mm/yyyy') THEN
                             CASE WHEN z.mulas BETWEEN TO_DATE('$p','dd/mm/yyyy') AND TO_DATE('30/06/2018','dd/mm/yyyy') THEN NVL(y.premi, x.rp_gross) ELSE 0 END 
                         WHEN TO_DATE('01/07/2018','dd/mm/yyyy') > TO_DATE('$p','dd/mm/yyyy') AND TO_DATE('01/07/2018','dd/mm/yyyy') <= TO_DATE('$p2','dd/mm/yyyy') THEN 
                             CASE WHEN z.mulas BETWEEN TO_DATE('$p','dd/mm/yyyy') AND TO_DATE ('30/06/2018','dd/mm/yyyy') THEN NVL(y.premi, x.rp_gross) ELSE 0 END 
                         END)
                     FROM tabel_200_pertanggungan z
                     LEFT OUTER JOIN tabel_223_transaksi_topup y ON z.prefixpertanggungan = y.prefixpertanggungan
                         AND z.nopertanggungan = y.nopertanggungan
                         AND y.status = '2'
                     LEFT OUTER JOIN tabel_ul_transaksi x ON z.prefixpertanggungan = SUBSTR (x.nomor_polis, 0, 2)
                         AND z.nopertanggungan = SUBSTR (x.nomor_polis, 3) 
                         AND x.description LIKE 'TOPUP SEKALIGUS%'
                     WHERE z.noagen = a.noagen
                         AND z.kdpertanggungan = '2'
                         AND z.mulas BETWEEN TO_DATE('$p','dd/mm/yyyy') AND TO_DATE('$p2','dd/mm/yyyy')),0) AS realisasi_premitopupl,
                         
                    NVL((SELECT SUM(CASE WHEN TO_DATE('30/06/2018','dd/mm/yyyy') < TO_DATE('$p','dd/mm/yyyy') AND TO_DATE ('30/06/2018','dd/mm/yyyy') < TO_DATE('$p2','dd/mm/yyyy') THEN
                             CASE WHEN z.mulas BETWEEN TO_DATE ('$p','dd/mm/yyyy') AND TO_DATE('$p2','dd/mm/yyyy') THEN NVL(y.premi, x.rp_gross) ELSE 0 END
                         WHEN TO_DATE('30/06/2018','dd/mm/yyyy') >= TO_DATE('$p','dd/mm/yyyy') AND TO_DATE('30/06/2018','dd/mm/yyyy') < TO_DATE('$p2','dd/mm/yyyy') THEN 
                             CASE WHEN z.mulas BETWEEN TO_DATE('01/07/2018','dd/mm/yyyy') AND TO_DATE('$p2','dd/mm/yyyy') THEN NVL(y.premi, x.rp_gross) ELSE 0 END
                        END)
                     FROM tabel_200_pertanggungan z
                     LEFT OUTER JOIN tabel_223_transaksi_topup y ON z.prefixpertanggungan = y.prefixpertanggungan
                         AND z.nopertanggungan = y.nopertanggungan
                         AND y.status = '2'
                     LEFT OUTER JOIN tabel_ul_transaksi x ON z.prefixpertanggungan = SUBSTR (x.nomor_polis, 0, 2)
                         AND z.nopertanggungan = SUBSTR (x.nomor_polis, 3) 
                         AND x.description LIKE 'TOPUP SEKALIGUS%'
					 INNER JOIN tabel_400_agen x ON z.noagen = x.noagen
                     WHERE z.noagen = a.noagen
                         AND z.kdpertanggungan = '2'
                         AND z.mulas BETWEEN TO_DATE('$p','dd/mm/yyyy') AND TO_DATE('$p2','dd/mm/yyyy')
						 AND x.kdjabatanagen NOT IN ('00','09')),0) AS realisasi_premitopupb,
						 
					a.KDJABATANAGEN, a.KDAREAOFFICE, g.NAMAKANTOR, b.URUTAN,
					(SELECT COUNT(noagen) FROM tabel_400_agen WHERE kdstatusagen = '01' AND kdjabatanagen = '05' AND kdkantor = a.kdkantor AND kdareaoffice = a.kdareaoffice) jmlumam,
                    (SELECT COUNT(noagen) FROM tabel_400_agen WHERE kdstatusagen = '01' AND kdjabatanagen = '00' AND kdkantor = a.kdkantor AND kdareaoffice = a.kdareaoffice) jmlmaam,
					(SELECT COUNT(noagen) FROM tabel_400_agen WHERE kdstatusagen = '01' AND kdjabatanagen = '00' AND kdkantor = a.kdkantor AND kdareaoffice = a.kdareaoffice AND kdunitproduksi = a.kdunitproduksi ) jmlmaum,
                    CASE WHEN a.kdjabatanagen = '02' THEN 4 ELSE 0 END umam,
                    CASE WHEN a.kdjabatanagen = '02' THEN 20 ELSE 0 END maam,
                    CASE WHEN a.kdjabatanagen = '05' THEN 5 ELSE 0 END maum
				FROM TABEL_400_AGEN a 
				INNER JOIN TABEL_413_JABATAN_AGEN b ON a.KDJABATANAGEN = b.KDJABATANAGEN 
				INNER JOIN TABEL_100_KLIEN c ON a.NOAGEN = C.NOKLIEN 
				LEFT OUTER JOIN TABEL_403_TARGET_AGEN d ON a.KDKANTOR = d.KDKANTOR AND a.KDJABATANAGEN = d.KDJABATANAGEN 
					AND d.THTARGET = TO_CHAR(TO_DATE('$p2', 'DD/MM/YYYY'), 'YYYY')
				LEFT OUTER JOIN TABEL_410_AREA_OFFICE e ON a.KDKANTOR = e.KDKANTOR AND a.KDAREAOFFICE = e.KDAREAOFFICE 
				LEFT OUTER JOIN TABEL_410_KODE_UNIT_PRODUKSI f ON a.KDKANTOR = f.KDKANTOR AND a.KDAREAOFFICE = f.KDAREAOFFICE 
					AND a.KDUNITPRODUKSI = f.KDUNITPRODUKSI
				LEFT OUTER JOIN TABEL_001_KANTOR g ON a.KDKANTOR = g.KDKANTOR
				LEFT OUTER JOIN TABEL_420_TARGET_AREA_OFFICE h ON a.KDKANTOR = h.KDKANTOR AND a.KDAREAOFFICE = h.KDAREAOFFICE AND h.THTARGET = d.THTARGET
				LEFT OUTER JOIN TABEL_403_TARGET_AGEN i ON a.KDKANTOR = i.KDKANTOR AND a.KDJABATANAGEN = i.KDJABATANAGEN 
					AND i.THTARGET = '2017'
				LEFT OUTER JOIN tabel_420_target_area_office j ON a.kdkantor = j.kdkantor AND a.kdareaoffice = j.kdareaoffice
					AND j.thtarget = TO_CHAR(TO_DATE('$p2','dd/mm/yyyy'), 'yyyy')-1
				WHERE a.KDKANTOR = '$p3' AND a.KDSTATUSAGEN = '01'
					AND e.STATUS IS NULL
				/*ORDER BY LPAD(a.KDAREAOFFICE, 4) ASC NULLS FIRST, LPAD(a.KDUNITPRODUKSI, 4) ASC NULLS FIRST, a.KDJABATANAGEN DESC, c.NAMAKLIEN1*/
				
				UNION ALL
				
				/* judul area office */
				SELECT NULL, NULL NOAGEN, NULL, NULL, NAMAAREAOFFICE, NULL KDUNITPRODUKSI, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 
					NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL KDJABATANAGEN, KDAREAOFFICE, NULL, NULL URUTAN, 
					NULL, NULL, NULL, NULL, NULL, NULL
				FROM TABEL_410_AREA_OFFICE 
				WHERE KDKANTOR = '$p3' AND STATUS IS NULL
				
				UNION ALL
				
				/* total se area office */
				SELECT NULL, '9999999999' NOAGEN, NULL, NULL, NAMAAREAOFFICE, 'XXX' KDUNITPRODUKSI, NULL, NULL, NULL, NULL, NULL, 
					NVL(c.trgpolisnbpporg, 0) trgpolisnbpporgl, NVL(c.trgpreminbpporg, 0) trgpreminbpporgl, NVL(b.TRGPOLISNBPPORG, 0) TRGPOLISNBPPORG, 
					NVL(b.TRGPREMINBPPORG, 0) TRGPREMINBPPORG, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 
					NULL, NULL KDJABATANAGEN, a.KDAREAOFFICE, NULL, NULL URUTAN, NULL, NULL, NULL,
					NULL, NULL, NULL
				FROM TABEL_410_AREA_OFFICE a 
				LEFT OUTER JOIN TABEL_420_TARGET_AREA_OFFICE b ON a.KDKANTOR = b.KDKANTOR AND a.KDAREAOFFICE = b.KDAREAOFFICE 
					AND b.THTARGET = TO_CHAR(TO_DATE ('$p2', 'DD/MM/YYYY'), 'YYYY') 
				LEFT OUTER JOIN tabel_420_target_area_office c ON a.kdkantor = c.kdkantor
					AND a.kdareaoffice = c.kdareaoffice
					AND c.thtarget = TO_CHAR(TO_DATE('$p2','dd/mm/yyyy'), 'yyyy')-1
				WHERE a.KDKANTOR = '$p3' AND STATUS IS NULL 
				
				UNION ALL
				
				/* judul unit produksi */
				SELECT NULL, NULL NOAGEN, NULL, NULL, a.NAMAAREAOFFICE, b.KDUNITPRODUKSI, b.NAMAUNITPRODUKSI, NULL, NULL, NULL, NULL, NULL, 
				    NUll, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL KDJABATANAGEN, 
					a.KDAREAOFFICE, NULL, NULL URUTAN, NULL, NULL, NULL, NULL, NULL, NULL
				FROM TABEL_410_AREA_OFFICE a 
				INNER JOIN TABEL_410_KODE_UNIT_PRODUKSI b ON a.KDKANTOR = b.KDKANTOR AND a.KDAREAOFFICE = b.KDAREAOFFICE 
				WHERE a.STATUS IS NULL AND b.STATUS IS NULL AND a.KDKANTOR = '$p3'
				
				UNION ALL
				
				/* total se unit produksi */ 
				SELECT NULL, '9999999999' NOAGEN, NULL, NULL, a.NAMAAREAOFFICE, b.KDUNITPRODUKSI, b.NAMAUNITPRODUKSI, NULL, NULL, NULL, NULL, 
					NVL(d.TRGPOLISNBPPORG,0) TRGPOLISNBPPORGL, NVL(d.TRGPREMINBPPORG,0) TRGPREMINBPPORGL, NVL (c.TRGPOLISNBPPORG, 0) TRGPOLISNBPPORG, 
					NVL (c.TRGPREMINBPPORG, 0) TRGPREMINBPPORG, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 
					NULL, NULL, '0' KDJABATANAGEN, a.KDAREAOFFICE, NULL, 99 URUTAN, NULL, NULL, NULL,
					NULL, NULL, NULL
				FROM TABEL_410_AREA_OFFICE a 
				INNER JOIN TABEL_410_KODE_UNIT_PRODUKSI b ON a.KDKANTOR = b.KDKANTOR AND a.KDAREAOFFICE = b.KDAREAOFFICE 
				LEFT OUTER JOIN TABEL_401_TARGET_UNIT_PRODUKSI c ON a.KDKANTOR = c.KDKANTOR AND b.KDUNITPRODUKSI = c.KDUNITPRODUKSI 
					AND a.KDAREAOFFICE = c.KDAREAOFFICE AND THTARGET = TO_CHAR (TO_DATE ('$p2', 'DD/MM/YYYY'), 'YYYY') 
				LEFT OUTER JOIN TABEL_401_TARGET_UNIT_PRODUKSI d ON a.KDKANTOR = d.KDKANTOR AND b.KDUNITPRODUKSI = d.KDUNITPRODUKSI 
                    AND a.KDAREAOFFICE = d.KDAREAOFFICE AND d.THTARGET = '2017'
				WHERE a.STATUS IS NULL AND b.STATUS IS NULL AND a.KDKANTOR = '$p3'
				
				ORDER BY KDAREAOFFICE ASC NULLS FIRST, KDUNITPRODUKSI ASC NULLS FIRST, URUTAN ASC NULLS FIRST, 
					NOAGEN ASC";
		//echo $sql;
		
		$DB->parse($sql);
		$DB->execute();
		
		echo json_encode($DB->result());
		//echo $sql;
	}
	
	
	/*===== data cabang per wilayah =====*/
	if (strcasecmp($r, '3') == 0) {
		$sql = "SELECT NAMAKANTOR, KDKANTOR FROM TABEL_001_KANTOR WHERE KDKANTOR = '$p' 
				UNION
				SELECT NAMAKANTOR, KDKANTOR FROM TABEL_001_KANTOR WHERE KDKANTORINDUK = '$p' ORDER BY KDKANTOR";
		
		$DB->parse($sql);
		$DB->execute();
		
		echo json_encode($DB->result());
	}
	
	
	/*===== tarik data evaluasi per agen =====*/
	if (strcasecmp($r, '4') == 0) {
		$office1 = !empty($p4) ? " AND KDAREAOFFICE = '$p4' " : null;
		$office2 = !empty($p4) ? " AND a.KDAREAOFFICE = '$p4' " : null;
		$unit1 = !empty($p5) ? " AND KDUNITPRODUKSI = '$p5' " : null;
		$unit2 = !empty($p5) ? " AND a.KDUNITPRODUKSI = '$p5' " : null;
		$unit3 = !empty($p5) ? " AND b.KDUNITPRODUKSI = '$p5' " : null;
		$noagen = !empty($p6) ? " AND a.NOAGEN = '$p6' " : null;
		
		$sql = "SELECT a.PREFIXAGEN, a.NOAGEN, c.NAMAKLIEN1, b.NAMAJABATANAGEN, e.NAMAAREAOFFICE, 
					a.KDUNITPRODUKSI, f.NAMAUNITPRODUKSI, 
					NVL(d.TRGPOLISNBPPHEAD, 0) TRGPOLISNBPPHEAD, NVL(d.TRGPREMINBPPHEAD, 0) TRGPREMINBPPHEAD, i.trgpreminbpphead trgpreminbppheadl,
					NVL(H.TRGPOLISNBPPORG, 0) TRGPOLISNBPPORG, NVL(H.TRGPREMINBPPORG, 0) TRGPREMINBPPORG,
					(SELECT COUNT(DISTINCT(z.NOPERTANGGUNGAN)) 
					 FROM TABEL_200_PERTANGGUNGAN z 
					 INNER JOIN TABEL_300_HISTORIS_PREMI y ON z.PREFIXPERTANGGUNGAN = y.PREFIXPERTANGGUNGAN 
					 	 AND z.NOPERTANGGUNGAN = y.NOPERTANGGUNGAN 
					 WHERE y.KDKUITANSI = 'BP3' AND z.MULAS BETWEEN TO_DATE('$p', 'DD/MM/YYYY') 
					 	 AND TO_DATE('$p2', 'DD/MM/YYYY') AND z.NOAGEN = a.NOAGEN
						 AND z.KDPERTANGGUNGAN = '2') AS REALISASI_POLIS, 
					(SELECT NVL(SUM(NILAIRP), 0) 
					 FROM TABEL_200_PERTANGGUNGAN z 
					 INNER JOIN TABEL_300_HISTORIS_PREMI y ON z.PREFIXPERTANGGUNGAN = y.PREFIXPERTANGGUNGAN 
					 	 AND z.NOPERTANGGUNGAN = y.NOPERTANGGUNGAN 
					 WHERE z.KDCARABAYAR = 'X' 
					     AND y.KDKUITANSI = 'BP3' 
					     AND z.MULAS BETWEEN TO_DATE('$p', 'DD/MM/YYYY') AND TO_DATE('$p2', 'DD/MM/YYYY') 
					     AND z.NOAGEN = a.NOAGEN
						 AND z.KDPERTANGGUNGAN = '2') AS REALISASI_PREMIX, 
                    (SELECT SUM(CASE WHEN TO_DATE('01/07/2018','dd/mm/yyyy') > TO_DATE('$p','dd/mm/yyyy') AND TO_DATE('01/07/2018','dd/mm/yyyy') > TO_DATE('$p2','dd/mm/yyyy') THEN
                             CASE WHEN z.mulas BETWEEN TO_DATE('$p','dd/mm/yyyy') AND TO_DATE('$p2','dd/mm/yyyy') THEN y.nilairp ELSE 0 END
                         WHEN TO_DATE('01/07/2018','dd/mm/yyyy') > TO_DATE('$p','dd/mm/yyyy') AND TO_DATE('01/07/2018','dd/mm/yyyy') <= TO_DATE('$p2','dd/mm/yyyy') THEN
                             CASE WHEN z.mulas BETWEEN TO_DATE('$p','dd/mm/yyyy') AND TO_DATE('30/06/2018','dd/mm/yyyy') THEN y.nilairp ELSE 0 END
                         END)
                     FROM tabel_200_pertanggungan z
                     INNER JOIN tabel_300_historis_premi y ON z.prefixpertanggungan = y.prefixpertanggungan
                         AND z.nopertanggungan = y.nopertanggungan
                         AND y.kdkuitansi = 'BP3'
                     INNER JOIN tabel_400_agen x ON z.noagen = x.noagen
                     WHERE z.kdcarabayar = 'X'
                         AND z.kdpertanggungan = '2'
                         AND z.noagen = a.noagen
                         AND z.kdproduk NOT IN ('PAA','PAB','AKM')
                         AND z.mulas BETWEEN TO_DATE('$p','dd/mm/yyyy') AND TO_DATE('$p2','dd/mm/yyyy')) AS realisasi_premilx,
                    (SELECT SUM(CASE WHEN TO_DATE('30/06/2018','dd/mm/yyyy') < TO_DATE('$p','dd/mm/yyyy') AND TO_DATE('30/06/2018','dd/mm/yyyy') < TO_DATE('$p2','dd/mm/yyyy') THEN
                             CASE WHEN z.mulas BETWEEN TO_DATE('$p','dd/mm/yyyy') AND TO_DATE('$p2','dd/mm/yyyy') THEN y.nilairp * 0.3 ELSE 0 END
                         WHEN TO_DATE('30/06/2018','dd/mm/yyyy') >= TO_DATE('$p','dd/mm/yyyy') AND TO_DATE('30/06/2018','dd/mm/yyyy') < TO_DATE('$p2','dd/mm/yyyy') THEN
                             CASE WHEN z.mulas BETWEEN TO_DATE('01/07/2018','dd/mm/yyyy') AND TO_DATE('$p2','dd/mm/yyyy') THEN y.nilairp * 0.3 ELSE 0 END
                          END)
                     FROM tabel_200_pertanggungan z
                     INNER JOIN tabel_300_historis_premi y ON z.prefixpertanggungan = y.prefixpertanggungan
                         AND z.nopertanggungan = y.nopertanggungan
                         AND y.kdkuitansi = 'BP3'
                     INNER JOIN tabel_400_agen x ON z.noagen = x.noagen
                     WHERE z.kdcarabayar = 'X'
                         AND z.kdpertanggungan = '2'
                         AND z.noagen = '0000042565'
                         AND z.kdproduk NOT IN ('PAA','PAB','AKM')
                         AND z.mulas BETWEEN TO_DATE('$p','dd/mm/yyyy') AND TO_DATE('$p2','dd/mm/yyyy')) AS realisasi_premibx,
					(SELECT NVL(SUM(NILAIRP), 0) 
					 FROM TABEL_200_PERTANGGUNGAN z 
					 INNER JOIN TABEL_300_HISTORIS_PREMI y ON z.PREFIXPERTANGGUNGAN = y.PREFIXPERTANGGUNGAN 
					 	 AND z.NOPERTANGGUNGAN = y.NOPERTANGGUNGAN 
					 WHERE z.KDCARABAYAR != 'X' AND y.KDKUITANSI = 'BP3' AND y.TGLSEATLED BETWEEN TO_DATE('$p', 'DD/MM/YYYY') 
					 	 AND TO_DATE('$p2', 'DD/MM/YYYY') AND z.NOAGEN = a.NOAGEN
						 AND z.KDPERTANGGUNGAN = '2') AS REALISASI_PREMIB, 
					(SELECT NVL(SUM(NILAIRP), 0) 
					 FROM TABEL_200_PERTANGGUNGAN z 
					 INNER JOIN TABEL_300_HISTORIS_PREMI y ON z.PREFIXPERTANGGUNGAN = y.PREFIXPERTANGGUNGAN 
					 	 AND z.NOPERTANGGUNGAN = y.NOPERTANGGUNGAN 
					 WHERE z.KDCARABAYAR != 'X' AND y.KDKUITANSI = 'NB1' AND y.TGLSEATLED BETWEEN TO_DATE('$p', 'DD/MM/YYYY') 
					 	 AND TO_DATE('$p2', 'DD/MM/YYYY') AND z.NOAGEN = a.NOAGEN
						 AND z.KDPERTANGGUNGAN = '2') AS REALISASI_PREMIBL, 
					(SELECT NVL(SUM(NVL(y.PREMI, x.RP_GROSS)), 0)
					 FROM TABEL_200_PERTANGGUNGAN z
					 LEFT OUTER JOIN TABEL_223_TRANSAKSI_TOPUP y ON z.PREFIXPERTANGGUNGAN = y.PREFIXPERTANGGUNGAN
					     AND z.NOPERTANGGUNGAN = y.NOPERTANGGUNGAN
					     AND y.STATUS = '2'
					     AND y.TGLUPDATED BETWEEN TO_DATE ('$p', 'DD/MM/YYYY') AND TO_DATE ('$p2', 'DD/MM/YYYY')
					 LEFT OUTER JOIN TABEL_UL_TRANSAKSI x ON z.PREFIXPERTANGGUNGAN = SUBSTR(x.NOMOR_POLIS, 0, 2)
					     AND z.NOPERTANGGUNGAN = SUBSTR(x.NOMOR_POLIS, 3)
					     AND x.TRX_DATE BETWEEN TO_DATE('$p', 'DD/MM/YYYY') AND TO_DATE('$p2', 'DD/MM/YYYY')
					     AND x.DESCRIPTION LIKE 'TOPUP SEKALIGUS%'
					 WHERE z.NOAGEN = a.NOAGEN
					     AND z.KDPERTANGGUNGAN = '2') AS REALISASI_PREMITOPUP,
					a.KDJABATANAGEN, a.KDAREAOFFICE, g.NAMAKANTOR, b.URUTAN
				FROM TABEL_400_AGEN a 
				INNER JOIN TABEL_413_JABATAN_AGEN b ON a.KDJABATANAGEN = b.KDJABATANAGEN 
				INNER JOIN TABEL_100_KLIEN c ON a.NOAGEN = C.NOKLIEN 
				LEFT OUTER JOIN TABEL_403_TARGET_AGEN d ON a.KDKANTOR = d.KDKANTOR AND a.KDJABATANAGEN = d.KDJABATANAGEN 
					AND d.THTARGET = TO_CHAR(TO_DATE('$p2', 'DD/MM/YYYY'), 'YYYY')
				LEFT OUTER JOIN TABEL_410_AREA_OFFICE e ON a.KDKANTOR = e.KDKANTOR AND a.KDAREAOFFICE = e.KDAREAOFFICE 
				LEFT OUTER JOIN TABEL_410_KODE_UNIT_PRODUKSI f ON a.KDKANTOR = f.KDKANTOR AND a.KDAREAOFFICE = f.KDAREAOFFICE 
					AND a.KDUNITPRODUKSI = f.KDUNITPRODUKSI
				LEFT OUTER JOIN TABEL_001_KANTOR g ON a.KDKANTOR = g.KDKANTOR
				LEFT OUTER JOIN TABEL_420_TARGET_AREA_OFFICE h ON a.KDKANTOR = h.KDKANTOR AND a.KDAREAOFFICE = h.KDAREAOFFICE AND h.THTARGET = d.THTARGET
				LEFT OUTER JOIN TABEL_403_TARGET_AGEN i ON a.KDKANTOR = i.KDKANTOR AND a.KDJABATANAGEN = i.KDJABATANAGEN 
					AND i.THTARGET = '2017'
				WHERE a.KDKANTOR = '$p3' AND a.KDSTATUSAGEN = '01'
					AND e.STATUS IS NULL 
					$office2 
					$unit2
					$noagen
				/*ORDER BY LPAD(a.KDAREAOFFICE, 4) ASC NULLS FIRST, LPAD(a.KDUNITPRODUKSI, 4) ASC NULLS FIRST, a.KDJABATANAGEN DESC, c.NAMAKLIEN1*/
				
				UNION ALL
				
				/* judul area office */
				SELECT NULL, NULL NOAGEN, NULL, NULL, NAMAAREAOFFICE, NULL KDUNITPRODUKSI, NULL, NULL, NULL, NULL, NULL, 
					NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL KDJABATANAGEN, KDAREAOFFICE, NULL, NULL URUTAN
				FROM TABEL_410_AREA_OFFICE 
				WHERE KDKANTOR = '$p3' AND STATUS IS NULL $office1
				
				UNION ALL
				
				/* total se area office */
				SELECT NULL, '9999999999' NOAGEN, NULL, NULL, NAMAAREAOFFICE, 'XXX' KDUNITPRODUKSI, NULL, NULL, NULL, NULL, 
					NVL(TRGPOLISNBPPORG, 0) TRGPOLISNBPPORG, NVL(TRGPREMINBPPORG, 0) TRGPREMINBPPORG, NULL, NULL, NULL, 
					NULL, NULL, NULL, NULL, NULL KDJABATANAGEN, a.KDAREAOFFICE, NULL, NULL URUTAN
				FROM TABEL_410_AREA_OFFICE a 
				LEFT OUTER JOIN TABEL_420_TARGET_AREA_OFFICE b ON a.KDKANTOR = b.KDKANTOR AND a.KDAREAOFFICE = b.KDAREAOFFICE 
					AND THTARGET = TO_CHAR(TO_DATE ('$p2', 'DD/MM/YYYY'), 'YYYY') 
				WHERE a.KDKANTOR = '$p3' AND STATUS IS NULL $office2
				
				UNION ALL
				
				/* judul unit produksi */
				SELECT NULL, NULL NOAGEN, NULL, NULL, a.NAMAAREAOFFICE, b.KDUNITPRODUKSI, b.NAMAUNITPRODUKSI, NULL, NULL, NULL, 
				    NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL KDJABATANAGEN, a.KDAREAOFFICE, NULL, NULL URUTAN
				FROM TABEL_410_AREA_OFFICE a 
				INNER JOIN TABEL_410_KODE_UNIT_PRODUKSI b ON a.KDKANTOR = b.KDKANTOR AND a.KDAREAOFFICE = b.KDAREAOFFICE 
				WHERE a.STATUS IS NULL AND b.STATUS IS NULL AND a.KDKANTOR = '$p3' 
					$office2
					$unit1
				
				UNION ALL
				
				/* total se unit produksi */ 
				SELECT NULL, '9999999999' NOAGEN, NULL, NULL, a.NAMAAREAOFFICE, b.KDUNITPRODUKSI, b.NAMAUNITPRODUKSI, NULL, NULL, 
					NULL, NVL (TRGPOLISNBPPORG, 0) TRGPOLISNBPPORG, NVL (TRGPREMINBPPORG, 0) TRGPREMINBPPORG, NULL, NULL, NULL, NULL, 
					NULL, NULL, NULL, '0' KDJABATANAGEN, a.KDAREAOFFICE, NULL, 99 URUTAN
				FROM TABEL_410_AREA_OFFICE a 
				INNER JOIN TABEL_410_KODE_UNIT_PRODUKSI b ON a.KDKANTOR = b.KDKANTOR AND a.KDAREAOFFICE = b.KDAREAOFFICE 
				LEFT OUTER JOIN TABEL_401_TARGET_UNIT_PRODUKSI c ON a.KDKANTOR = c.KDKANTOR AND b.KDUNITPRODUKSI = c.KDUNITPRODUKSI 
					AND a.KDAREAOFFICE = c.KDAREAOFFICE AND THTARGET = TO_CHAR (TO_DATE ('$p2', 'DD/MM/YYYY'), 'YYYY') 
				WHERE a.STATUS IS NULL AND b.STATUS IS NULL AND a.KDKANTOR = '$p3'
					$office2 
					$unit3
				
				ORDER BY KDAREAOFFICE ASC NULLS FIRST, KDUNITPRODUKSI ASC NULLS FIRST, URUTAN ASC NULLS FIRST, 
					NOAGEN ASC";
		
		
		$DB->parse($sql);
		$DB->execute();
		
		echo json_encode($DB->result());
		//echo $sql;
	}
	
	
	/*===== tarik data target kantor =====*/
	if (strcasecmp($r, '5') == 0) {
		$sql = "SELECT a.kdkantor, b.namakantor, a.tahun, a.target_nb, a.target_ob, a.target_polis
				FROM tabel_401_target_kantor a
				INNER JOIN tabel_001_kantor b ON a.kdkantor = b.kdkantor
				WHERE tahun = TO_CHAR(TO_DATE ('$p2', 'DD/MM/YYYY'), 'YYYY') AND a.kdkantor = '$p3'";
		
		$DB->parse($sql);
		$DB->execute();
		
		echo json_encode($DB->nextrow());
		//echo $sql;
	}
	
	
	/*===== tarik data rekap evaluasi agen se ho =====*/
	if (strcasecmp($r, '6') == 0) {
		$sql = "SELECT a.KDKANTOR, a.KDAREAOFFICE, b.NAMAAREAOFFICE, MAX(c.TRGPOLISNBPPORG) TRGPOLISNBPPORG, 
					MAX(c.TRGPREMINBPPORG) TRGPREMINBPPORG,
					SUM((SELECT COUNT(DISTINCT(z.NOPERTANGGUNGAN)) 
						FROM TABEL_200_PERTANGGUNGAN z 
						INNER JOIN TABEL_300_HISTORIS_PREMI y ON z.PREFIXPERTANGGUNGAN = y.PREFIXPERTANGGUNGAN 
							AND z.NOPERTANGGUNGAN = y.NOPERTANGGUNGAN 
						WHERE y.KDKUITANSI = 'BP3' AND z.MULAS BETWEEN TO_DATE('$p2', 'DD/MM/YYYY') 
							AND TO_DATE('$p3', 'DD/MM/YYYY') AND z.NOAGEN = a.NOAGEN
							AND z.KDPERTANGGUNGAN = '2')
					) AS REALISASI_POLIS,
					SUM((SELECT NVL(SUM(NILAIRP), 0) 
						FROM TABEL_200_PERTANGGUNGAN z 
						INNER JOIN TABEL_300_HISTORIS_PREMI y ON z.PREFIXPERTANGGUNGAN = y.PREFIXPERTANGGUNGAN 
							AND z.NOPERTANGGUNGAN = y.NOPERTANGGUNGAN 
						WHERE z.KDCARABAYAR = 'X' AND y.KDKUITANSI = 'BP3' AND z.MULAS BETWEEN TO_DATE('$p2', 'DD/MM/YYYY') 
							AND TO_DATE('$p3', 'DD/MM/YYYY') AND z.NOAGEN = a.NOAGEN
							AND z.KDPERTANGGUNGAN = '2')
					) AS REALISASI_PREMIX,
					SUM((SELECT NVL(SUM(NILAIRP), 0) 
						FROM TABEL_200_PERTANGGUNGAN z 
						INNER JOIN TABEL_300_HISTORIS_PREMI y ON z.PREFIXPERTANGGUNGAN = y.PREFIXPERTANGGUNGAN 
							AND z.NOPERTANGGUNGAN = y.NOPERTANGGUNGAN 
						WHERE z.KDCARABAYAR != 'X' AND y.KDKUITANSI = 'BP3' AND y.TGLSEATLED BETWEEN TO_DATE('$p2', 'DD/MM/YYYY') 
							AND TO_DATE('$p3', 'DD/MM/YYYY') AND z.NOAGEN = a.NOAGEN
							AND z.KDPERTANGGUNGAN = '2')
					) AS REALISASI_PREMIB, 
					SUM((SELECT NVL(SUM(NILAIRP), 0) 
						FROM TABEL_200_PERTANGGUNGAN z 
						INNER JOIN TABEL_300_HISTORIS_PREMI y ON z.PREFIXPERTANGGUNGAN = y.PREFIXPERTANGGUNGAN 
							AND z.NOPERTANGGUNGAN = y.NOPERTANGGUNGAN 
						WHERE z.KDCARABAYAR != 'X' AND y.KDKUITANSI = 'NB1' AND y.TGLSEATLED BETWEEN TO_DATE('$p2', 'DD/MM/YYYY') 
							AND TO_DATE('$p3', 'DD/MM/YYYY') AND z.NOAGEN = a.NOAGEN
							AND z.KDPERTANGGUNGAN = '2')
					) AS REALISASI_PREMIBL, 
					SUM((SELECT NVL(SUM(PREMI), 0) 
						FROM TABEL_200_PERTANGGUNGAN z 
						INNER JOIN TABEL_223_TRANSAKSI_TOPUP y ON z.PREFIXPERTANGGUNGAN = y.PREFIXPERTANGGUNGAN 
							AND z.NOPERTANGGUNGAN = y.NOPERTANGGUNGAN 
						WHERE y.STATUS = '2' AND y.TGLUPDATED BETWEEN TO_DATE('$p2', 'DD/MM/YYYY') 
							AND TO_DATE('$p3', 'DD/MM/YYYY') AND z.NOAGEN = a.NOAGEN
							AND z.KDPERTANGGUNGAN = '2')
					) AS REALISASI_PREMITOPUP
				FROM TABEL_400_AGEN a
				LEFT OUTER JOIN TABEL_410_AREA_OFFICE b ON a.KDKANTOR = b.KDKANTOR AND a.KDAREAOFFICE = b.KDAREAOFFICE
				LEFT OUTER JOIN TABEL_420_TARGET_AREA_OFFICE c ON a.KDKANTOR = c.KDKANTOR AND a.KDAREAOFFICE = c.KDAREAOFFICE
				WHERE a.KDKANTOR LIKE '%$p%'
					AND a.KDSTATUSAGEN = '01'
					AND c.THTARGET = TO_CHAR(TO_DATE ('$p3', 'DD/MM/YYYY'), 'YYYY')
					AND b.STATUS IS NULL
				GROUP BY a.KDKANTOR, a.KDAREAOFFICE, b.NAMAAREAOFFICE
				ORDER BY a.KDKANTOR, KDAREAOFFICE";
				
		$DB->parse($sql);
		$DB->execute();
		
		echo json_encode($DB->result());
		//echo $sql;
	}