<?php

class Monitorproposal_model extends CI_Model {

	function get_kantor(){
		$data = array();
		$DBJL = $this->load->database('jlindo', TRUE);
		
		$sql = "Select kdkantor, namakantor from tabel_001_kantor where status = '1' and kdkantor <> 'KN' 
							--and kdkantor in ('11','02','12','04','05','09','03','18','01','15','21')
							and kdkantor != 'KP'
							order by kdkantor asc";
		$db = $DBJL->query($sql);
        $data = $db->result_array();
        $db->free_result();
        
        return $data;
	}
	
	function get_agen_bp(){
		$data = array();
		$DBJL = $this->load->database('jlindo', TRUE);
		
		$sql2 = "select noagen, namaklien1 from tabel_400_agen a 
				inner join tabel_100_klien on a.noagen = noklien
				where a.kdstatusagen = '01'
				and kdjabatanagen = '26'
				order by a.noagen";
		$db = $DBJL->query($sql2);
        $data = $db->result_array();
        $db->free_result();
        
        return $data;
	}
	
    /*===== get daftar pkaj online =====*/
    function get_rekap($filter,$tglawal,$tglakhir,$jbtn,$kantorfilter) {
        $data = array();
		$DBJL = $this->load->database('jlindo', TRUE);
		
		$sqlktr = "";
        if($kantorfilter != 'all'){
          $sqlktr = "AND KDKANTOR = '".$kantorfilter."'";
        }
        
        $sql = "SELECT 
                        '".$filter['NOAGEN']."' as NOAGEN,
                        '".$filter["KDKANTOR"]."' AS KDKANTOR,
                        '".$filter["KDJABATANAGEN"]."' AS KDJABATANAGEN,
                        '".$filter["NAMAJABATANAGEN"]."' AS NAMAJABATANAGEN,
                        '".$filter["NAMAAGEN"]."' AS NAMAAGEN,
                        '".$filter["NAMAKANTOR"]."' AS NAMAKANTOR,
                        '".$filter["LEVELHIRARKI"]."' AS LEVELHIRARKI,
                        '".$filter["JABATANATASAN"]."' AS JABATANATASAN,
                        '".$filter["TOTALREKRUT"]."' AS TOTALREKRUT,
                        '".$filter["REKRUTBERLISENSI"]."' AS REKRUTBERLISENSI,
                        '".$kantorfilter."' AS KDKANTORFILTER,
                        PENAWARAN.JML AS JML_PENAWARAN,
                        PENAWARAN.ANP AS ANP_PENAWARAN,
                        SPAJ.ANP AS ANP_SPAJ,
                        SPAJ.JML AS JML_SPAJ,
                        PROPOSAL.JML AS JML_PROPOSAL,
                        PROPOSAL.ANP AS ANP_PROPOSAL,
                        APPROVAL.JML AS JML_APPROVAL,
                        APPROVAL.ANP AS ANP_APPROVAL,
                        PELUNASAN.JML AS JML_PELUNASAN,
                        PELUNASAN.ANP AS ANP_PELUNASAN,
                        TERKIRIM.JML AS JML_TERKIRIM,
                        TERKIRIM.ANP AS ANP_TERKIRIM,
                        ( SELECT   COUNT(NOAGEN) AS JML_SEBAWAH
                            FROM   TABEL_400_AGEN 
                            WHERE   KDSTATUSAGEN = '01'
                                    ".$sqlktr."
                            START WITH   ATASAN = '".$filter["NOAGEN"]."'
                            CONNECT BY nocycle PRIOR NOAGEN = ATASAN
                        ) AS AGEN_SEBAWAH
                     FROM
                            ( SELECT COUNT(a.ID_AGEN) as JML,
                                     NVL(SUM(
                                                CASE 
                                                    WHEN a.CARA_BAYAR IN ('Bulanan') THEN CAST(a.JUMLAH_PREMI AS int) * 12
                                                    WHEN a.CARA_BAYAR IN ('Kuartalan') THEN CAST(a.JUMLAH_PREMI AS int) * 4
                                                    WHEN a.CARA_BAYAR IN ('Semesteran') THEN CAST(a.JUMLAH_PREMI AS int) * 2
						    WHEN a.CARA_BAYAR IN ('Sekaligus') THEN CAST(a.JUMLAH_PREMI AS int) * 0.1

                                                    ELSE CAST(a.JUMLAH_PREMI AS int)
                                                END
                                        ),0) as ANP
                               FROM JAIM_300_HITUNG@jaim a
                               WHERE a.ID_AGEN IN ( (SELECT   NOAGEN
                                                       FROM   TABEL_400_AGEN 
                                                       WHERE    KDSTATUSAGEN = '01'
                                                                ".$sqlktr." 
                                                       START WITH   ATASAN = '".$filter["NOAGEN"]."' 
                                                       CONNECT BY   PRIOR NOAGEN = ATASAN
                                                       UNION ALL
                                                       SELECT   '".$filter["NOAGEN"]."'  FROM DUAL
                                                    )
                                                  )
                                    AND (a.TGL_REKAM BETWEEN TO_DATE('".$tglawal."', 'DD/MM/YYYY') AND TO_DATE('".$tglakhir."', 'DD/MM/YYYY')
                                         OR a.BUILD_ID IN (  SELECT BUILDID 
                                                            FROM TABEL_SPAJ_ONLINE b,TABEL_200_PERTANGGUNGAN c 
                                                            WHERE b.NOSPAJ = c.NOSP
                                                                  AND c.KDPERTANGGUNGAN IN ('1', '2')
                                                                  AND c.KDSTATUSEMAIL = '1'
                                                                  AND c.MULAS BETWEEN TO_DATE('".$tglawal."', 'DD/MM/YYYY') AND TO_DATE('".$tglakhir."', 'DD/MM/YYYY') 
                                                          )
                                        )
                            ) PENAWARAN,
                            (   SELECT NVL (
                                          SUM (
                                             CASE
                                                WHEN a.BUILD_ID = b.BUILDID 
                                                THEN
                                                    CASE 
                                                        WHEN a.CARA_BAYAR IN ('Bulanan') THEN CAST(a.JUMLAH_PREMI AS int) * 12
                                                        WHEN a.CARA_BAYAR IN ('Kuartalan') THEN CAST(a.JUMLAH_PREMI AS int) * 4
                                                        WHEN a.CARA_BAYAR IN ('Semesteran') THEN CAST(a.JUMLAH_PREMI AS int) * 2
							WHEN a.CARA_BAYAR IN ('Sekaligus') THEN CAST(a.JUMLAH_PREMI AS int) * 0.1

                                                        ELSE CAST(a.JUMLAH_PREMI AS int)
                                                    END
                                                ELSE 0
                                             END),
                                        0) as ANP,
                                    COUNT(b.KODEAGEN) as JML
                                FROM
                                    JAIM_300_HITUNG@jaim a, TABEL_SPAJ_ONLINE b
                                WHERE
                                    a.BUILD_ID = b.BUILDID
                                    AND
                                    b.KODEAGEN IN ( (SELECT   NOAGEN
                                                       FROM   TABEL_400_AGEN 
                                                       WHERE    KDSTATUSAGEN = '01'
                                                                ".$sqlktr." 
                                                       START WITH   ATASAN = '".$filter["NOAGEN"]."' 
                                                       CONNECT BY   PRIOR NOAGEN = ATASAN
                                                       UNION ALL
                                                       SELECT   '".$filter["NOAGEN"]."'  FROM DUAL
                                                    )
                                                  )
                                    AND (b.TANGGALREKAM BETWEEN TO_DATE('".$tglawal."', 'DD/MM/YYYY') AND TO_DATE('".$tglakhir."', 'DD/MM/YYYY')
                                         OR b.NOSPAJ IN (   SELECT NOSP 
                                                            FROM TABEL_200_PERTANGGUNGAN c 
                                                            WHERE c.KDPERTANGGUNGAN IN ('1', '2')
                                                                  AND c.KDSTATUSEMAIL = '1'
                                                                  AND c.MULAS BETWEEN TO_DATE('".$tglawal."', 'DD/MM/YYYY') AND TO_DATE('".$tglakhir."', 'DD/MM/YYYY') 
                                                        )
                                        )

                            ) SPAJ,
                            (
                                SELECT
                                    COUNT(c.NOAGEN) as JML,
                                    NVL(SUM(
                                                CASE 
                                                    WHEN c.KDCARABAYAR IN ('1','M') THEN c.premi1 * 12
                                                    WHEN c.KDCARABAYAR IN ('2','Q') THEN c.premi1 * 4
                                                    WHEN c.KDCARABAYAR IN ('3','H') THEN c.premi1 * 2
						    WHEN c.KDCARABAYAR IN ('X') THEN c.premi1 * 0.1
                                                    ELSE c.premi1
                                                END
                                        ),0) as ANP
                                FROM TABEL_200_PERTANGGUNGAN c
                                WHERE c.KDPERTANGGUNGAN IN ('1', '2')
                                    AND c.KDSTATUSEMAIL = '1' 
                                    AND c.NOAGEN IN ( (SELECT   NOAGEN
                                                       FROM   TABEL_400_AGEN 
                                                       WHERE    KDSTATUSAGEN = '01'
                                                                ".$sqlktr." 
                                                       START WITH   ATASAN = '".$filter["NOAGEN"]."' 
                                                       CONNECT BY   PRIOR NOAGEN = ATASAN
                                                       UNION ALL
                                                       SELECT   '".$filter["NOAGEN"]."'  FROM DUAL
                                                    )
                                                  )
                                    AND c.MULAS BETWEEN TO_DATE('".$tglawal."', 'DD/MM/YYYY') AND TO_DATE('".$tglakhir."', 'DD/MM/YYYY') 
                            ) PROPOSAL,
                            (   SELECT
                                    COUNT(d.NOPERTANGGUNGAN) as JML,
                                    NVL (
                                          SUM (
                                             CASE
                                                WHEN c.NOPERTANGGUNGAN = d.NOPERTANGGUNGAN
                                                THEN
                                                    CASE 
                                                        WHEN c.KDCARABAYAR IN ('1','M') THEN c.premi1 * 12
                                                        WHEN c.KDCARABAYAR IN ('2','Q') THEN c.premi1 * 4
                                                        WHEN c.KDCARABAYAR IN ('3','H') THEN c.premi1 * 2
							WHEN c.KDCARABAYAR IN ('X') THEN c.premi1 * 0.1
                                                        ELSE c.premi1
                                                    END
                                                ELSE 0
                                             END),
                                        0) as ANP
                                FROM TABEL_214_APPROVAL_PROPOSAL d, TABEL_200_PERTANGGUNGAN c
                                WHERE c.NOPERTANGGUNGAN = d.NOPERTANGGUNGAN 
                                    AND c.PREFIXPERTANGGUNGAN = d.PREFIXPERTANGGUNGAN
                                    AND c.KDPERTANGGUNGAN IN ('1', '2')
                                    AND c.KDSTATUSEMAIL = '1'
                                    AND c.NOAGEN IN ( (SELECT   NOAGEN
                                                       FROM   TABEL_400_AGEN 
                                                       WHERE    KDSTATUSAGEN = '01'
                                                                ".$sqlktr." 
                                                       START WITH   ATASAN = '".$filter["NOAGEN"]."' 
                                                       CONNECT BY   PRIOR NOAGEN = ATASAN
                                                       UNION ALL
                                                       SELECT   '".$filter["NOAGEN"]."'  FROM DUAL
                                                    )
                                                  )
                                    AND c.MULAS BETWEEN TO_DATE('".$tglawal."', 'DD/MM/YYYY') AND TO_DATE('".$tglakhir."', 'DD/MM/YYYY') 
                            ) APPROVAL,
                            (
                                SELECT
                                    COUNT(e.NOPERTANGGUNGAN) as JML,
                                    NVL (
                                          SUM (
                                              CASE 
                                                    WHEN e.KDCARABAYAR IN ('1','M') THEN e.premi1 * 12
                                                    WHEN e.KDCARABAYAR IN ('2','Q') THEN e.premi1 * 4
                                                    WHEN e.KDCARABAYAR IN ('3','H') THEN e.premi1 * 2
						    WHEN e.KDCARABAYAR IN ('X') THEN e.premi1 * 0.1
                                                    ELSE e.premi1
                                              END),
                                        0) as ANP
                                FROM TABEL_200_PERTANGGUNGAN e 
                                WHERE e.KDSTATUSFILE NOT IN ('X','C')
                                    AND e.KDPERTANGGUNGAN = '2'
                                    AND e.NOAGEN IN ( (SELECT   NOAGEN
                                                       FROM   TABEL_400_AGEN 
                                                       WHERE    KDSTATUSAGEN IN ('01','02','03','04','05')
                                                                ".$sqlktr." 
                                                       START WITH   ATASAN = '".$filter["NOAGEN"]."' 
                                                       CONNECT BY   PRIOR NOAGEN = ATASAN
                                                       UNION ALL
                                                       SELECT   '".$filter["NOAGEN"]."'  FROM DUAL
                                                    )
                                                  )
                                    AND e.MULAS BETWEEN TO_DATE('".$tglawal."', 'DD/MM/YYYY') AND TO_DATE('".$tglakhir."', 'DD/MM/YYYY')
                            ) PELUNASAN,
                            (
                                SELECT
                                    COUNT(f.NOPERTANGGUNGAN) as JML,
                                    NVL (
                                          SUM (
                                             CASE
                                                WHEN e.NOPERTANGGUNGAN = f.NOPERTANGGUNGAN
                                                THEN
                                                    CASE 
                                                        WHEN e.KDCARABAYAR IN ('1','M') THEN e.premi1 * 12
                                                        WHEN e.KDCARABAYAR IN ('2','Q') THEN e.premi1 * 4
                                                        WHEN e.KDCARABAYAR IN ('3','H') THEN e.premi1 * 2
							 WHEN e.KDCARABAYAR IN ('X') THEN e.premi1 * 0.1
                                                        ELSE e.premi1
                                                    END
                                                ELSE 0
                                             END),
                                        0) as ANP
                                    FROM TABEL_200_PERTANGGUNGAN e, TABEL_214_VERIFY_CETAK_POLIS f 
                                    WHERE e.NOPERTANGGUNGAN = f.NOPERTANGGUNGAN
                                          AND e.PREFIXPERTANGGUNGAN = f.PREFIXPERTANGGUNGAN
                                          AND f.KDKIRIM = '1'
                                          AND f.TGLKIRIM IS NOT NULL 
                                          AND e.NOAGEN IN ( (SELECT   NOAGEN
                                                       FROM   TABEL_400_AGEN 
                                                       WHERE    KDSTATUSAGEN = '01'
                                                                ".$sqlktr." 
                                                       START WITH   ATASAN = '".$filter["NOAGEN"]."' 
                                                       CONNECT BY   PRIOR NOAGEN = ATASAN
                                                       UNION ALL
                                                       SELECT   '".$filter["NOAGEN"]."'  FROM DUAL
                                                    )
                                                  )
                                          AND e.MULAS BETWEEN TO_DATE('".$tglawal."', 'DD/MM/YYYY') AND TO_DATE('".$tglakhir."', 'DD/MM/YYYY') 
                            ) TERKIRIM";
        $db = $DBJL->query($sql);
        $data = $db->row_array();
        $db->free_result();
        
        return $data;
    }
	
	/*===== get daftar pkaj online lpa =====*/
    function get_rekap_lpa($filter,$tglawal,$tglakhir,$jbtn) {
        $data = array();
		$DBJL = $this->load->database('jlindo', TRUE);
        
        $sql = "SELECT 
                        '".$filter['NOAGEN']."' as NOAGEN,
                        '".$filter["KDKANTOR"]."' AS KDKANTOR,
                        '".$filter["KDJABATANAGEN"]."' AS KDJABATANAGEN,
                        '".$filter["NAMAJABATANAGEN"]."' AS NAMAJABATANAGEN,
                        '".$filter["NAMAAGEN"]."' AS NAMAAGEN,
                        '".$filter["NAMAKANTOR"]."' AS NAMAKANTOR,
                        '".$filter["LEVELHIRARKI"]."' AS LEVELHIRARKI,
                        '".$filter["JABATANATASAN"]."' AS JABATANATASAN,
                        '".$filter["TOTALREKRUT"]."' AS TOTALREKRUT,
                        '".$filter["REKRUTBERLISENSI"]."' AS REKRUTBERLISENSI,
                        '' AS KDKANTORFILTER,
                        PENAWARAN.JML AS JML_PENAWARAN,
                        PENAWARAN.ANP AS ANP_PENAWARAN,
                        SPAJ.ANP AS ANP_SPAJ,
                        SPAJ.JML AS JML_SPAJ,
                        PROPOSAL.JML AS JML_PROPOSAL,
                        PROPOSAL.ANP AS ANP_PROPOSAL,
                        APPROVAL.JML AS JML_APPROVAL,
                        APPROVAL.ANP AS ANP_APPROVAL,
                        PELUNASAN.JML AS JML_PELUNASAN,
                        PELUNASAN.ANP AS ANP_PELUNASAN,
                        TERKIRIM.JML AS JML_TERKIRIM,
                        TERKIRIM.ANP AS ANP_TERKIRIM,
			FYP.FYP,
						( SELECT   COUNT(NOAGEN) AS JML_SEBAWAH
                            FROM   TABEL_400_AGEN 
                            WHERE   KDSTATUSAGEN = '01'
                            START WITH   ATASAN = '".$filter["NOAGEN"]."'
                            CONNECT BY nocycle PRIOR NOAGEN = ATASAN
                        ) AS AGEN_SEBAWAH
                     FROM
                            ( SELECT COUNT(a.ID_AGEN) as JML,
                                     NVL(SUM(
                                                CASE 
                                                    WHEN a.CARA_BAYAR IN ('Bulanan') THEN CAST(a.JUMLAH_PREMI AS int) * 12
                                                    WHEN a.CARA_BAYAR IN ('Kuartalan') THEN CAST(a.JUMLAH_PREMI AS int) * 4
                                                    WHEN a.CARA_BAYAR IN ('Semesteran') THEN CAST(a.JUMLAH_PREMI AS int) * 2
                                                    ELSE CAST(a.JUMLAH_PREMI AS int)
                                                END
                                        ),0) as ANP
                               FROM JAIM_300_HITUNG@jaim a
                               WHERE a.ID_AGEN IN ( '".$filter["NOAGEN"]."' )
                                    AND (a.TGL_REKAM BETWEEN TO_DATE('".$tglawal."', 'DD/MM/YYYY') AND TO_DATE('".$tglakhir."', 'DD/MM/YYYY')
                                         OR a.BUILD_ID IN (  SELECT BUILDID 
                                                            FROM TABEL_SPAJ_ONLINE b,TABEL_200_PERTANGGUNGAN c 
                                                            WHERE b.NOSPAJ = c.NOSP
                                                                  AND c.KDPERTANGGUNGAN IN ('1', '2')
                                                                  AND c.KDSTATUSEMAIL = '1'
                                                                  AND c.MULAS BETWEEN TO_DATE('".$tglawal."', 'DD/MM/YYYY') AND TO_DATE('".$tglakhir."', 'DD/MM/YYYY') 
                                                          )
                                        )
                            ) PENAWARAN,
                            (   SELECT NVL (
                                          SUM (
                                             CASE
                                                WHEN a.BUILD_ID = b.BUILDID 
                                                THEN
                                                    CASE 
                                                        WHEN a.CARA_BAYAR IN ('Bulanan') THEN CAST(a.JUMLAH_PREMI AS int) * 12
                                                        WHEN a.CARA_BAYAR IN ('Kuartalan') THEN CAST(a.JUMLAH_PREMI AS int) * 4
                                                        WHEN a.CARA_BAYAR IN ('Semesteran') THEN CAST(a.JUMLAH_PREMI AS int) * 2
                                                        ELSE CAST(a.JUMLAH_PREMI AS int)
                                                    END
                                                ELSE 0
                                             END),
                                        0) as ANP,
                                    COUNT(b.KODEAGEN) as JML
                                FROM
                                    JAIM_300_HITUNG@jaim a, TABEL_SPAJ_ONLINE b
                                WHERE
                                    a.BUILD_ID = b.BUILDID
                                    AND
                                    b.KODEAGEN IN ( '".$filter["NOAGEN"]."' )
									and b.produk IN ('JL4BLN', 'JL4BPRO') 
                                    AND (b.TANGGALREKAM BETWEEN TO_DATE('".$tglawal."', 'DD/MM/YYYY') AND TO_DATE('".$tglakhir."', 'DD/MM/YYYY')
                                         OR b.NOSPAJ IN (   SELECT NOSP 
                                                            FROM TABEL_200_PERTANGGUNGAN c 
                                                            WHERE c.KDPERTANGGUNGAN IN ('1', '2')
                                                                  AND c.KDSTATUSEMAIL = '1'
                                                                  AND c.MULAS BETWEEN TO_DATE('".$tglawal."', 'DD/MM/YYYY') AND TO_DATE('".$tglakhir."', 'DD/MM/YYYY') 
                                                        )
                                        )

                            ) SPAJ,
                            (
                                SELECT
                                    COUNT(c.NOAGEN) as JML,
                                    NVL(SUM(
                                                CASE 
                                                    WHEN c.KDCARABAYAR IN ('1','M') THEN c.premi1 * 12
                                                    WHEN c.KDCARABAYAR IN ('2','Q') THEN c.premi1 * 4
                                                    WHEN c.KDCARABAYAR IN ('3','H') THEN c.premi1 * 2
                                                    ELSE c.premi1
                                                END
                                        ),0) as ANP
                                FROM TABEL_200_PERTANGGUNGAN c
                                WHERE c.KDPERTANGGUNGAN IN ('1', '2')
                                    AND c.KDSTATUSEMAIL = '1'
									and c.kdproduk IN ('JL4BLN', 'JL4BPRO') 
                                    AND c.NOAGEN IN ( '".$filter["NOAGEN"]."' )
                                    AND c.MULAS BETWEEN TO_DATE('".$tglawal."', 'DD/MM/YYYY') AND TO_DATE('".$tglakhir."', 'DD/MM/YYYY') 
                            ) PROPOSAL,
                            (   SELECT
                                    COUNT(d.NOPERTANGGUNGAN) as JML,
                                    NVL (
                                          SUM (
                                             CASE
                                                WHEN c.NOPERTANGGUNGAN = d.NOPERTANGGUNGAN
                                                THEN
                                                    CASE 
                                                        WHEN c.KDCARABAYAR IN ('1','M') THEN c.premi1 * 12
                                                        WHEN c.KDCARABAYAR IN ('2','Q') THEN c.premi1 * 4
                                                        WHEN c.KDCARABAYAR IN ('3','H') THEN c.premi1 * 2
                                                        ELSE c.premi1
                                                    END
                                                ELSE 0
                                             END),
                                        0) as ANP
                                FROM TABEL_214_APPROVAL_PROPOSAL d, TABEL_200_PERTANGGUNGAN c
                                WHERE c.NOPERTANGGUNGAN = d.NOPERTANGGUNGAN 
                                    AND c.PREFIXPERTANGGUNGAN = d.PREFIXPERTANGGUNGAN
                                    AND c.KDPERTANGGUNGAN IN ('1', '2')
                                    AND c.KDSTATUSEMAIL = '1'
									and c.kdproduk IN ('JL4BLN', 'JL4BPRO') 
                                    AND c.NOAGEN IN ( '".$filter["NOAGEN"]."' )
                                    AND c.MULAS BETWEEN TO_DATE('".$tglawal."', 'DD/MM/YYYY') AND TO_DATE('".$tglakhir."', 'DD/MM/YYYY') 
                            ) APPROVAL,
                            (
                                SELECT
                                    COUNT(e.NOPERTANGGUNGAN) as JML,
                                    NVL (
                                          SUM (
                                              CASE 
                                                    WHEN e.KDCARABAYAR IN ('1','M') THEN e.premi1 * 12
                                                    WHEN e.KDCARABAYAR IN ('2','Q') THEN e.premi1 * 4
                                                    WHEN e.KDCARABAYAR IN ('3','H') THEN e.premi1 * 2
                                                    ELSE e.premi1
                                              END),
                                        0) as ANP
                                FROM TABEL_200_PERTANGGUNGAN e 
                                WHERE e.KDSTATUSFILE NOT IN ('X','C')
                                    AND e.KDPERTANGGUNGAN = '2'
				    and e.kdproduk IN ('JL4BLN') 
                                    AND e.NOAGEN IN ( '".$filter["NOAGEN"]."' )
                                    AND e.MULAS BETWEEN TO_DATE('".$tglawal."', 'DD/MM/YYYY') AND TO_DATE('".$tglakhir."', 'DD/MM/YYYY')
                            ) PELUNASAN,
                            (
                                SELECT
                                    COUNT(f.NOPERTANGGUNGAN) as JML,
                                    NVL (
                                          SUM (
                                             CASE
                                                WHEN e.NOPERTANGGUNGAN = f.NOPERTANGGUNGAN
                                                THEN
                                                    CASE 
                                                        WHEN e.KDCARABAYAR IN ('1','M') THEN e.premi1 * 12
                                                        WHEN e.KDCARABAYAR IN ('2','Q') THEN e.premi1 * 4
                                                        WHEN e.KDCARABAYAR IN ('3','H') THEN e.premi1 * 2
                                                        ELSE e.premi1
                                                    END
                                                ELSE 0
                                             END),
                                        0) as ANP
                                    FROM TABEL_200_PERTANGGUNGAN e, TABEL_214_VERIFY_CETAK_POLIS f 
                                    WHERE e.NOPERTANGGUNGAN = f.NOPERTANGGUNGAN
                                          AND e.PREFIXPERTANGGUNGAN = f.PREFIXPERTANGGUNGAN
                                          AND f.KDKIRIM = '1'
										  and e.kdproduk IN ('JL4BLN', 'JL4BPRO') 
                                          AND f.TGLKIRIM IS NOT NULL 
                                          AND e.NOAGEN IN ( '".$filter["NOAGEN"]."' )
                                          AND e.MULAS BETWEEN TO_DATE('".$tglawal."', 'DD/MM/YYYY') AND TO_DATE('".$tglakhir."', 'DD/MM/YYYY') 
                            ) TERKIRIM,
                            (select 
                            sum(komisiagen) FYP
                            from (
                                select c.noagen, 
                                nvl(a.PREMITAGIHAN,0) as komisiagen
                                from tabel_300_historis_premi a
                                inner join tabel_200_pertanggungan b on a.prefixpertanggungan||a.nopertanggungan = b.prefixpertanggungan||b.nopertanggungan
                                inner join tabel_400_agen c on c.noagen = b.noagen
                                WHERE a.TGLSEATLED BETWEEN
                                    /* pengecekan 1 bulan sebelum tgl billing */
                                    to_date('$tglawal','dd/mm/yyyy') and to_date('$tglakhir','dd/mm/yyyy')
                                    /* pengecekan umur polis <= 1 tahun */
                                      AND (FLOOR(MONTHS_BETWEEN(a.tglbooked, TRUNC(b.mulas,'MM')))) < 12
                                AND b.KDSTATUSFILE NOT IN ('X','C')
                                and c.kdstatusagen IN ('01','02','03','04','05')
                                AND b.KDPERTANGGUNGAN = '2'
                                AND b.kdproduk IN ('JL4BLN')
                                and c.kdjabatanagen = '29'
                                and c.noagen = '".$filter["NOAGEN"]."'
                            /* end produksi premi */
                                UNION ALL
                            /* produksi topup sekaligus */
                                SELECT  
                                        agn.noagen noagen,
                                        NVL((tup.premi)*0.1,0) komisiagen
                                FROM    TABEL_200_PERTANGGUNGAN PER,
                                        TABEL_400_AGEN AGN,
                                        tabel_500_penagih pen,
                                        (
                                            SELECT prefixpertanggungan||nopertanggungan as nopolis, premi as premi, tgltransfer
                                            FROM TABEL_UL_TRANSAKSI_TOPUP 
                                            WHERE TRUNC(tgltransfer) BETWEEN 
                                            to_date('$tglawal','dd/mm/yyyy') and to_date('$tglakhir','dd/mm/yyyy')
                                            UNION
                                            SELECT a.nopolis, (a.premi - b.premi1) premi, a.tglupdated as tgltransfer
                                            FROM tabel_315_pelunasan_va a
                                            INNER JOIN tabel_200_pertanggungan b on a.nopolis = b.prefixpertanggungan||b.nopertanggungan
                                            WHERE TRUNC(a.tglupdated) BETWEEN 
                                                to_date('$tglawal','dd/mm/yyyy') and to_date('$tglakhir','dd/mm/yyyy')
                                                AND (a.premi - b.premi1) >= 1000000
                                            UNION
                                            SELECT a.no_polis as nopolis, (a.bill_amount - b.premi1) premi, a.proccess_date as tgltransfer
                                            FROM tabel_315_pelunasan_h2h a
                                            INNER JOIN tabel_200_pertanggungan b on a.no_polis = b.prefixpertanggungan||b.nopertanggungan
                                            WHERE TRUNC(a.proccess_date) BETWEEN 
                                            to_date('$tglawal','dd/mm/yyyy') and to_date('$tglakhir','dd/mm/yyyy')
                                                AND (a.bill_amount - b.premi1) >= 1000000
                                        )tup
                                WHERE   PER.PREFIXPERTANGGUNGAN||PER.NOPERTANGGUNGAN = tup.NOPOLIS 
                                        AND per.nopenagih = pen.nopenagih
                                        AND PER.NOAGEN = AGN.NOAGEN
                                        AND AGN.NOAGEN = '".$filter["NOAGEN"]."'
                                        AND PER.KDSTATUSFILE NOT IN ('X','C')
                                        AND (FLOOR(MONTHS_BETWEEN(tup.tgltransfer, TRUNC(per.mulas,'MM')))) < 12
                                        AND PER.KDPERTANGGUNGAN = '2'
                                        AND per.kdproduk IN ('JL4BLN')
                                        AND per.nopenagih = pen.nopenagih
                                        AND AGN.KDSTATUSAGEN IN ('01','02','03','04','05')
                                        AND AGN.KDJABATANAGEN = '29'
                                        /* end toup */)x ) FYP";
		
        $db = $DBJL->query($sql);
        $data = $db->row_array();
        $db->free_result();
        
        return $data;
    }

    function get_detail_penawaran($filter){
        $data = array();
        $sqlktr = "";
        if($filter["kdkantor"] != 'all'){
          $sqlktr = "AND KDKANTOR = '".$filter["kdkantor"]."'";
        }

        $sql = "SELECT  a.*,NVL(CAST(a.JUMLAH_PREMI AS int),0) as PREMIJML,
                        (SELECT NAMAKLIEN1 FROM TABEL_100_KLIEN@jlindo z WHERE z.NOKLIEN = a.ID_AGEN) AS NAMAAGEN,
                        (SELECT NAMAJABATANAGEN FROM TABEL_413_JABATAN_AGEN@jlindo y WHERE y.KDJABATANAGEN = c.KDJABATANAGEN) AS NAMAJABATAN,
                        (SELECT t.namakantor FROM tabel_001_kantor@jlindo t where t.kdkantor = c.kdkantor) AS NAMAKTR,
                        NVL (
                                CASE
                                    WHEN a.CARA_BAYAR IN ('Bulanan') THEN CAST(a.JUMLAH_PREMI AS int) * 12
                                    WHEN a.CARA_BAYAR IN ('Kuartalan') THEN CAST(a.JUMLAH_PREMI AS int) * 4
                                    WHEN a.CARA_BAYAR IN ('Semesteran') THEN CAST(a.JUMLAH_PREMI AS int) * 2
				    WHEN a.CARA_BAYAR IN ('Sekaligus') THEN CAST(a.JUMLAH_PREMI AS int) * 0.1

                                    ELSE CAST(a.JUMLAH_PREMI AS int)
                                END,
                            0) as ANP_PENAWARAN,
                        (SELECT NAMA FROM PRO_PEMPOL x WHERE x.BUILD_ID = a.BUILD_ID) AS NAMA_PEMPOL,
                        (SELECT NAMA_PRODUK FROM JAIM_300_PRODUK v WHERE v.ID_PRODUK = a.ID_PRODUK) AS NAMA_PRODUK
                FROM JAIM_300_HITUNG a
                LEFT OUTER JOIN TABEL_400_AGEN@jlindo c ON c.NOAGEN = a.ID_AGEN
                WHERE   a.ID_AGEN IN ( (SELECT   NOAGEN
                                           FROM   TABEL_400_AGEN@jlindo 
                                           WHERE    KDSTATUSAGEN = '01'
                                                    ".$sqlktr."
                                           START WITH   ATASAN = '".$filter["noagen"]."' 
                                           CONNECT BY   PRIOR NOAGEN = ATASAN
                                           UNION ALL
                                           SELECT   '".$filter["noagen"]."'  FROM DUAL
                                       )
                                     )
                        AND (a.TGL_REKAM BETWEEN TO_DATE('".$filter['tglawal']."', 'DD/MM/YYYY') AND TO_DATE('".$filter['tglakhir']."', 'DD/MM/YYYY')
                        OR a.BUILD_ID IN (  SELECT BUILDID 
                                                            FROM TABEL_SPAJ_ONLINE@jlindo b,TABEL_200_PERTANGGUNGAN@jlindo c 
                                                            WHERE b.NOSPAJ = c.NOSP
                                                                  AND c.KDPERTANGGUNGAN IN ('1', '2')
                                                                  AND c.KDSTATUSEMAIL = '1'
                                                                  AND c.MULAS BETWEEN TO_DATE('".$filter['tglawal']."', 'DD/MM/YYYY') AND TO_DATE('".$filter['tglakhir']."', 'DD/MM/YYYY') 
                                        )
                            )
                ";
        $q = $this->db
            ->query($sql);
        //echo $sql;
        if($q->num_rows() > 0){
            $data = $q->result_array();
        }

        $q->free_result();

        return $data;
    }

    function get_detail_proposal($filter){
        $data = array();
        $sqlktr = "";
        if($filter["kdkantor"] != 'all'){
          $sqlktr = "AND KDKANTOR = '".$filter["kdkantor"]."'";
        }

        $sql = "
                SELECT
                    c.NOPERTANGGUNGAN,
                    c.PREFIXPERTANGGUNGAN,
					c.nopolbaru,
                    (SELECT NAMAKLIEN1 FROM TABEL_100_KLIEN@jlindo n WHERE n.NOKLIEN = c.NOTERTANGGUNG) AS NMPEMPOL,
                    c.NOSP,
                    (SELECT NAMACARABAYAR FROM TABEL_305_CARA_BAYAR@jlindo m WHERE m.KDCARABAYAR = c.KDCARABAYAR) AS CARA_BAYAR,
                    c.KDPRODUK,
                    e.NOAGEN,
                    c.KDSTATUSFILE AS STATUS,
                    c.PREMI1,
                    c.MULAS,
                    (SELECT NAMAKLIEN1 FROM TABEL_100_KLIEN@jlindo z WHERE z.NOKLIEN = e.NOAGEN) AS NAMAAGEN,
                    (SELECT NAMAJABATANAGEN FROM TABEL_413_JABATAN_AGEN@jlindo y WHERE y.KDJABATANAGEN = e.KDJABATANAGEN) AS NAMAJABATAN,
                    (SELECT t.namakantor FROM tabel_001_kantor@jlindo t where t.kdkantor = e.kdkantor) AS NAMAKTR,
                    NVL (
                            CASE 
                                WHEN c.KDCARABAYAR IN ('1','M') THEN c.premi1 * 12
                                WHEN c.KDCARABAYAR IN ('2','Q') THEN c.premi1 * 4
                                WHEN c.KDCARABAYAR IN ('3','H') THEN c.premi1 * 2
				WHEN c.KDCARABAYAR IN ('X') THEN c.premi1 * 0.1
                                ELSE c.premi1
                            END,
                        0) as ANP,
                    (SELECT n.BUILDID FROM TABEL_SPAJ_ONLINE@jlindo n WHERE n.NOSPAJ = c.NOSP) AS BUILDNO
                FROM TABEL_200_PERTANGGUNGAN@jlindo c, TABEL_400_AGEN@jlindo e
                WHERE c.KDPERTANGGUNGAN IN ('1', '2')
                    AND c.KDSTATUSEMAIL = '1' 
                    AND c.noagen = e.noagen
                    AND c.NOAGEN IN ( (SELECT NOAGEN
                                       FROM   TABEL_400_AGEN@jlindo 
                                       WHERE    KDSTATUSAGEN = '01'
                                                ".$sqlktr." 
                                       START WITH   ATASAN = '".$filter["noagen"]."' 
                                       CONNECT BY   PRIOR NOAGEN = ATASAN
                                       UNION ALL
                                       SELECT   '".$filter["noagen"]."'  FROM DUAL
                                    )
                                  )
                    AND c.MULAS BETWEEN TO_DATE('".$filter['tglawal']."', 'DD/MM/YYYY') AND TO_DATE('".$filter['tglakhir']."', 'DD/MM/YYYY') 
               ";
            $q = $this->db->query($sql);
            //echo $sql;
            if($q->num_rows() > 0){
                $data = $q->result_array();
            }

            $q->free_result();

            return $data;
    }
                                
    function get_detail_spaj($filter){
        $data = array();
        $sqlktr = "";
        if($filter["kdkantor"] != 'all'){
          $sqlktr = "AND KDKANTOR = '".$filter["kdkantor"]."'";
        }

        $sql = "SELECT  b.*, a.JUMLAH_PREMI, a.CARA_BAYAR, 
                        (SELECT NAMAKLIEN1 FROM TABEL_100_KLIEN@jlindo z WHERE z.NOKLIEN = b.KODEAGEN) AS NAMAAGEN,
                        (SELECT NAMAJABATANAGEN FROM TABEL_413_JABATAN_AGEN@jlindo y WHERE y.KDJABATANAGEN = c.KDJABATANAGEN) AS NAMAJABATAN,
                        (SELECT t.namakantor FROM tabel_001_kantor@jlindo t where t.kdkantor = c.kdkantor) AS NAMAKTR,
                        NVL (
                             CASE
                                WHEN a.BUILD_ID = b.BUILDID 
                                THEN
                                    CASE 
                                        WHEN a.CARA_BAYAR IN ('Bulanan') THEN CAST(a.JUMLAH_PREMI AS int) * 12
                                        WHEN a.CARA_BAYAR IN ('Kuartalan') THEN CAST(a.JUMLAH_PREMI AS int) * 4
                                        WHEN a.CARA_BAYAR IN ('Semesteran') THEN CAST(a.JUMLAH_PREMI AS int) * 2
					WHEN a.CARA_BAYAR IN ('Sekaligus') THEN CAST(a.JUMLAH_PREMI AS int) * 0.1
                                        ELSE CAST(a.JUMLAH_PREMI AS int)
                                    END
                                ELSE 0
                             END,
                            0) as ANP_SPAJ
                FROM JAIM_300_HITUNG a
                LEFT OUTER JOIN TABEL_SPAJ_ONLINE@jlindo b ON a.BUILD_ID = b.BUILDID
                LEFT OUTER JOIN TABEL_400_AGEN@jlindo c ON c.NOAGEN = b.KODEAGEN
                WHERE   a.ID_AGEN IN ( (SELECT   NOAGEN
                                           FROM   TABEL_400_AGEN@jlindo 
                                           WHERE    KDSTATUSAGEN = '01'
                                                    ".$sqlktr." 
                                           START WITH   ATASAN = '".$filter["noagen"]."' 
                                           CONNECT BY   PRIOR NOAGEN = ATASAN
                                           UNION ALL
                                           SELECT   '".$filter["noagen"]."'  FROM DUAL
                                       )
                                     )
                        AND (a.TGL_REKAM BETWEEN TO_DATE('".$filter['tglawal']."', 'DD/MM/YYYY') AND TO_DATE('".$filter['tglakhir']."', 'DD/MM/YYYY')
                             OR b.NOSPAJ IN (   SELECT NOSP 
                                                FROM TABEL_200_PERTANGGUNGAN@jlindo d 
                                                WHERE d.KDPERTANGGUNGAN IN ('1', '2')
                                                      AND d.KDSTATUSEMAIL = '1'
                                                      AND d.MULAS BETWEEN TO_DATE('".$filter['tglawal']."', 'DD/MM/YYYY') AND TO_DATE('".$filter['tglakhir']."', 'DD/MM/YYYY') 
                                            )
                            )
                        AND b.KODEAGEN IS NOT NULL
                ";
        $q = $this->db
            ->query($sql);
        //echo $sql;
        if($q->num_rows() > 0){
            $data = $q->result_array();
        }

        $q->free_result();

        return $data;
    }
    function get_detail_approval($filter){
        $data = array();
        $sqlktr = "";
        if($filter["kdkantor"] != 'all'){
          $sqlktr = "AND KDKANTOR = '".$filter["kdkantor"]."'";
        }

        $sql = "
                SELECT
                    d.TGLREKAM,
                    d.NOPERTANGGUNGAN,
                    d.PREFIXPERTANGGUNGAN,
					c.NOPOLBARU,
                    (SELECT NAMAKLIEN1 FROM TABEL_100_KLIEN@jlindo n WHERE n.NOKLIEN = c.NOTERTANGGUNG) AS NMPEMPOL,
                    c.NOSP,
                    (SELECT NAMACARABAYAR FROM TABEL_305_CARA_BAYAR@jlindo m WHERE m.KDCARABAYAR = c.KDCARABAYAR) AS CARA_BAYAR,
                    c.KDPRODUK,
                    d.USERREKAM,
                    e.NOAGEN,
                    c.KDSTATUSFILE AS STATUS,
                    c.PREMI1,
                    c.MULAS,
                    (SELECT NAMAKLIEN1 FROM TABEL_100_KLIEN@jlindo z WHERE z.NOKLIEN = e.NOAGEN) AS NAMAAGEN,
                    (SELECT NAMAJABATANAGEN FROM TABEL_413_JABATAN_AGEN@jlindo y WHERE y.KDJABATANAGEN = e.KDJABATANAGEN) AS NAMAJABATAN,
                    (SELECT t.namakantor FROM tabel_001_kantor@jlindo t where t.kdkantor = e.kdkantor) AS NAMAKTR,
                    NVL (
                            (
                             CASE
                                WHEN c.NOPERTANGGUNGAN = d.NOPERTANGGUNGAN
                                THEN
                                    CASE 
                                        WHEN c.KDCARABAYAR IN ('1','M') THEN c.premi1 * 12
                                        WHEN c.KDCARABAYAR IN ('2','Q') THEN c.premi1 * 4
                                        WHEN c.KDCARABAYAR IN ('3','H') THEN c.premi1 * 2
					WHEN c.KDCARABAYAR IN ('X') THEN c.premi1 * 0.1
                                        ELSE c.premi1
                                    END
                                ELSE 0
                             END),
                        0) as ANP,
                        (SELECT n.BUILDID FROM TABEL_SPAJ_ONLINE@jlindo n WHERE n.NOSPAJ = c.NOSP) AS BUILDNO
                FROM TABEL_214_APPROVAL_PROPOSAL@jlindo d, TABEL_200_PERTANGGUNGAN@jlindo c,
                TABEL_400_AGEN@jlindo e
                WHERE c.NOPERTANGGUNGAN = d.NOPERTANGGUNGAN 
                    AND e.NOAGEN = c.NOAGEN
                    AND c.PREFIXPERTANGGUNGAN = d.PREFIXPERTANGGUNGAN
                    AND c.KDPERTANGGUNGAN IN ('1', '2')
                    AND c.KDSTATUSEMAIL = '1'
                    AND c.NOAGEN IN ( (SELECT   NOAGEN
                                       FROM   TABEL_400_AGEN@jlindo 
                                       WHERE    KDSTATUSAGEN = '01'
                                                ".$sqlktr."
                                       START WITH   ATASAN = '".$filter["noagen"]."' 
                                       CONNECT BY   PRIOR NOAGEN = ATASAN
                                       UNION ALL
                                       SELECT   '".$filter["noagen"]."'  FROM DUAL
                                    )
                                  )
                    AND c.MULAS BETWEEN TO_DATE('".$filter['tglawal']."', 'DD/MM/YYYY') AND TO_DATE('".$filter['tglakhir']."', 'DD/MM/YYYY')
               ";
            $q = $this->db->query($sql);
            //echo $sql;
            if($q->num_rows() > 0){
                $data = $q->result_array();
            }

            $q->free_result();

            return $data;
    }

    function get_detail_pelunasan($filter){
        $data = array();
        $sqlktr = "";
        if($filter["kdkantor"] != 'all'){
          $sqlktr = "AND KDKANTOR = '".$filter["kdkantor"]."'";
        }

        $sql = "
                SELECT
                    e.NOPERTANGGUNGAN,
                    e.PREFIXPERTANGGUNGAN,
					e.NOPOLBARU,
                    (SELECT NAMAKLIEN1 FROM TABEL_100_KLIEN@jlindo n WHERE n.NOKLIEN = e.NOTERTANGGUNG) AS NMPEMPOL,
                    e.NOSP,
                    (SELECT NAMACARABAYAR FROM TABEL_305_CARA_BAYAR@jlindo m WHERE m.KDCARABAYAR = e.KDCARABAYAR) AS CARA_BAYAR,
                    e.KDPRODUK,
                    e.NOAGEN,
                    e.KDSTATUSFILE AS STATUS,
                    e.PREMI1,
                    e.MULAS,
                    (SELECT NAMAKLIEN1 FROM TABEL_100_KLIEN@jlindo z WHERE z.NOKLIEN = e.NOAGEN) AS NAMAAGEN,
                    (SELECT NAMAJABATANAGEN FROM TABEL_413_JABATAN_AGEN@jlindo y WHERE y.KDJABATANAGEN = f.KDJABATANAGEN) AS NAMAJABATAN,
                    (SELECT t.namakantor FROM tabel_001_kantor@jlindo t where t.kdkantor = f.kdkantor) AS NAMAKTR,
                    NVL (
                          CASE 
                                WHEN e.KDCARABAYAR IN ('1','M') THEN e.premi1 * 12
                                WHEN e.KDCARABAYAR IN ('2','Q') THEN e.premi1 * 4
                                WHEN e.KDCARABAYAR IN ('3','H') THEN e.premi1 * 2
				WHEN e.KDCARABAYAR IN ('X') THEN e.premi1 * 0.1
                                ELSE e.premi1
                          END,
                        0) as ANP,
                    (SELECT n.BUILDID FROM TABEL_SPAJ_ONLINE@jlindo n WHERE n.NOSPAJ = e.NOSP) AS BUILDNO
                FROM TABEL_200_PERTANGGUNGAN@jlindo e, TABEL_400_AGEN@jlindo f
                WHERE e.KDSTATUSFILE NOT IN ('X','C')
                    AND e.KDPERTANGGUNGAN = '2'
                    AND e.NOAGEN = f.NOAGEN
                    AND e.NOAGEN IN ( (SELECT   NOAGEN
                                       FROM   TABEL_400_AGEN@jlindo 
                                       WHERE    KDSTATUSAGEN IN ('01','02','03','04','05')
                                                ".$sqlktr." 
                                       START WITH   ATASAN = '".$filter["noagen"]."' 
                                       CONNECT BY   PRIOR NOAGEN = ATASAN
                                       UNION ALL
                                       SELECT   '".$filter["noagen"]."'  FROM DUAL
                                    )
                                  )
                    AND e.MULAS BETWEEN TO_DATE('".$filter['tglawal']."', 'DD/MM/YYYY') AND TO_DATE('".$filter['tglakhir']."', 'DD/MM/YYYY')
               ";
            $q = $this->db->query($sql);
            //echo $sql;
            if($q->num_rows() > 0){
                $data = $q->result_array();
            }

            $q->free_result();

            return $data;
    }

    function get_detail_terkirim($filter){
        $data = array();
        $sqlktr = "";
        if($filter["kdkantor"] != 'all'){
          $sqlktr = "AND KDKANTOR = '".$filter["kdkantor"]."'";
        }

        $sql = "
                SELECT
                    e.NOPERTANGGUNGAN,
                    e.PREFIXPERTANGGUNGAN,
					e.NOPOLBARU,
                    (SELECT NAMAKLIEN1 FROM TABEL_100_KLIEN@jlindo n WHERE n.NOKLIEN = e.NOTERTANGGUNG) AS NMPEMPOL,
                    e.NOSP,
                    (SELECT NAMACARABAYAR FROM TABEL_305_CARA_BAYAR@jlindo m WHERE m.KDCARABAYAR = e.KDCARABAYAR) AS CARA_BAYAR,
                    e.KDPRODUK,
                    e.NOAGEN,
                    e.KDSTATUSFILE AS STATUS,
                    e.PREMI1,
                    e.MULAS,
                    (SELECT NAMAKLIEN1 FROM TABEL_100_KLIEN@jlindo z WHERE z.NOKLIEN = e.NOAGEN) AS NAMAAGEN,
                    (SELECT NAMAJABATANAGEN FROM TABEL_413_JABATAN_AGEN@jlindo y WHERE y.KDJABATANAGEN = f.KDJABATANAGEN) AS NAMAJABATAN,
                    (SELECT t.namakantor FROM tabel_001_kantor@jlindo t where t.kdkantor = f.kdkantor) AS NAMAKTR,
                    NVL (
                          CASE 
                                WHEN e.KDCARABAYAR IN ('1','M') THEN e.premi1 * 12
                                WHEN e.KDCARABAYAR IN ('2','Q') THEN e.premi1 * 4
                                WHEN e.KDCARABAYAR IN ('3','H') THEN e.premi1 * 2
				WHEN e.KDCARABAYAR IN ('X') THEN e.premi1 * 0.1
                                ELSE e.premi1
                          END,
                        0) as ANP,
                    (SELECT n.BUILDID FROM TABEL_SPAJ_ONLINE@jlindo n WHERE n.NOSPAJ = e.NOSP) AS BUILDNO
                FROM TABEL_200_PERTANGGUNGAN@jlindo e, TABEL_214_VERIFY_CETAK_POLIS@jlindo g, TABEL_400_AGEN@jlindo f
                WHERE e.NOPERTANGGUNGAN = g.NOPERTANGGUNGAN
                      AND e.PREFIXPERTANGGUNGAN = g.PREFIXPERTANGGUNGAN
                      AND e.NOAGEN = f.NOAGEN
                      AND g.KDKIRIM = '1'
                      AND g.TGLKIRIM IS NOT NULL 
                      AND e.NOAGEN IN ( (SELECT   NOAGEN
                                   FROM   TABEL_400_AGEN@jlindo 
                                   WHERE    KDSTATUSAGEN = '01'
                                            ".$sqlktr." 
                                   START WITH   ATASAN = '".$filter["noagen"]."' 
                                   CONNECT BY   PRIOR NOAGEN = ATASAN
                                   UNION ALL
                                   SELECT   '".$filter["noagen"]."'  FROM DUAL
                                )
                              )
                      AND e.MULAS BETWEEN TO_DATE('".$filter['tglawal']."', 'DD/MM/YYYY') AND TO_DATE('".$filter['tglakhir']."', 'DD/MM/YYYY')
               ";
            $q = $this->db->query($sql);
            //echo $sql;
            if($q->num_rows() > 0){
                $data = $q->result_array();
            }

            $q->free_result();

            return $data;
    }
    
    function get_detail_gap_approval_proposal($filter){
        $data = array();
        $sql = "SELECT  d.TGLREKAM,
                        d.NOPERTANGGUNGAN,
                        d.PREFIXPERTANGGUNGAN,
						c.NOPOLBARU,
                        b.NMPEMPOL,
                        c.NOSP,
                        a.CARA_BAYAR,
                        b.PRODUK,
                        d.USERREKAM,
                        e.NOAGEN,
                        c.KDSTATUSFILE AS STATUS,
                        c.PREMI1,
                        (SELECT NAMAKLIEN1 FROM TABEL_100_KLIEN@jlindo z WHERE z.NOKLIEN = e.NOAGEN) AS NAMAAGEN,
                        (SELECT NAMAJABATANAGEN FROM TABEL_413_JABATAN_AGEN@jlindo y WHERE y.KDJABATANAGEN = e.KDJABATANAGEN) AS NAMAJABATAN,
                        NVL(SUM(
                                    CASE
                                        WHEN c.KDCARABAYAR IN ('1','M') THEN c.premi1 * 12
                                        WHEN c.KDCARABAYAR IN ('2','Q') THEN c.premi1 * 4
                                        WHEN c.KDCARABAYAR IN ('3','H') THEN c.premi1 * 2
					WHEN c.KDCARABAYAR IN ('X') THEN c.premi1 * 0.1
                                        ELSE c.premi1
                                    END
                            ),0) as ANP_PROPOSAL,
                        COUNT(d.NOPERTANGGUNGAN) as JML_APPROVAL,
                        NVL (
                              SUM (
                                 CASE
                                    WHEN c.NOPERTANGGUNGAN = d.NOPERTANGGUNGAN
                                    THEN
                                        CASE
                                            WHEN c.KDCARABAYAR IN ('1','M') THEN c.premi1 * 12
                                            WHEN c.KDCARABAYAR IN ('2','Q') THEN c.premi1 * 4
                                            WHEN c.KDCARABAYAR IN ('3','H') THEN c.premi1 * 2
					     WHEN c.KDCARABAYAR IN ('X') THEN c.premi1 * 0.1
                                            ELSE c.premi1
                                        END
                                    ELSE 0
                                 END),
                            0) as ANP_APPROVAL
                FROM JAIM_300_HITUNG a
                LEFT OUTER JOIN TABEL_SPAJ_ONLINE@jlindo b ON a.BUILD_ID = b.BUILDID
                LEFT OUTER JOIN TABEL_200_PERTANGGUNGAN@jlindo c ON b.NOSPAJ = c.NOSP
                                                                        AND c.KDPERTANGGUNGAN IN ('1', '2')
                                                                        AND c.KDSTATUSEMAIL = '1'
                LEFT OUTER JOIN TABEL_214_APPROVAL_PROPOSAL@jlindo d ON c.NOPERTANGGUNGAN = d.NOPERTANGGUNGAN AND c.PREFIXPERTANGGUNGAN = d.PREFIXPERTANGGUNGAN
                LEFT OUTER JOIN TABEL_400_AGEN@jlindo e ON e.NOAGEN = c.NOAGEN
                WHERE   a.ID_AGEN IN ( (SELECT   NOAGEN
                                           FROM   TABEL_400_AGEN@jlindo
                                           WHERE    KDSTATUSAGEN = '01'
                                                    AND KDKANTOR = '".$filter["kdkantor"]."'
                                           START WITH   ATASAN = '".$filter["noagen"]."'
                                           CONNECT BY   PRIOR NOAGEN = ATASAN
                                           UNION ALL
                                           SELECT   '".$filter["noagen"]."'  FROM DUAL
                                       )
                                     )
                        AND a.TGL_REKAM BETWEEN TO_DATE('".$filter['tglawal']."', 'DD/MM/YYYY') AND TO_DATE('".$filter['tglakhir']."', 'DD/MM/YYYY')
                        AND b.KODEAGEN IS NOT NULL
                GROUP BY d.TGLREKAM,
                d.NOPERTANGGUNGAN,
                d.PREFIXPERTANGGUNGAN,
                b.NMPEMPOL,
                c.NOSP,
                a.CARA_BAYAR,
                b.PRODUK,
                d.USERREKAM,
                e.NOAGEN,
                c.KDSTATUSFILE, c.PREMI1, e.KDJABATANAGEN
                ";
        $q = $this->db
            ->query($sql);
        //echo $sql;
        if($q->num_rows() > 0){
            $data = $q->result_array();
        }

        $q->free_result();

        return $data;
    }

}
?>
