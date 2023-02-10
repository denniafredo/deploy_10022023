<?php

class User_model extends CI_Model {	
    
    function get_data_spaj_pending($iduser){

   
        // Query untuk dapetin data spaj yang pending secara organisasi
    
           $DBJL = $this->load->database('jlindo', TRUE);
    
            $sql = "SELECT 
                    A.NOSPAJ,
                    B.NOAGEN,
                    B.PREFIXPERTANGGUNGAN || B.NOPERTANGGUNGAN AS NOPOLLAMA,
                    B.NOPOLBARU,
                    A.BUILDID AS NO_PROPOSAL,
                    A.NMPEMPOL AS NAMA_PEMEGANG_POLIS,
                    (SELECT NAMAKLIEN1
                    FROM TABEL_100_KLIEN E
                    WHERE E.NOKLIEN = A.KODEAGEN)
                    NAMA_AGEN,
                    (SELECT NAMAKANTOR
                    FROM    TABEL_001_KANTOR F
                            JOIN
                            TABEL_400_AGEN G
                            ON F.KDKANTOR = G.KDKANTOR
                    WHERE G.NOAGEN = A.KODEAGEN)NAMA_KANTOR,
                    J.JUMLAH_PREMI,
                    (SELECT TELP FROM JAIM_201_PROSPEK@JAIM K WHERE K.NOPROSPEK=J.NO_PROSPEK AND J.BUILD_ID = A.BUILDID  ) NO_TELP_PEMPOL,
                    (SELECT HP FROM JAIM_201_PROSPEK@JAIM K WHERE K.NOPROSPEK=J.NO_PROSPEK AND J.BUILD_ID = A.BUILDID  ) NO_HP_PEMPOL,
                    I.NAMAPRODUK,
                    A.KETERANGAN
                FROM TABEL_SPAJ_ONLINE A
                    LEFT JOIN TABEL_200_PERTANGGUNGAN B
                    ON A.NOSPAJ = B.NOSP
                    LEFT JOIN TABEL_100_KLIEN H
                    ON B.NOPEMEGANGPOLIS = H.NOKLIEN
                    LEFT JOIN TABEL_202_PRODUK I
                    ON A.PRODUK = I.KDPRODUK 
                    LEFT JOIN JAIM_300_HITUNG@jaim J
                    ON A.BUILDID=J.BUILD_ID
                WHERE A.KODEAGEN IN
                    (SELECT '$iduser' NOAGEN from DUAL
                        UNION ALL
                        SELECT NOAGEN FROM TABEL_400_AGEN
                            WHERE KDSTATUSAGEN = '01'
                                AND KDJABATANAGEN IN ('25','26','24')
                            START WITH ATASAN = '$iduser'
                            CONNECT BY PRIOR NOAGEN = ATASAN)
                    AND A.SUSPEND = 1
                    AND TO_CHAR(A.TANGGALREKAM,'YYYY') = TO_CHAR(SYSDATE,'YYYY')
                    AND A.KETERANGAN IS NOT NULL";
        
            $db = $DBJL->query($sql);
            $data = $db->result_array();
            $db->free_result();
            
            return $data;
        }

    function get_data_nasabah_lapse($iduser){

        //Query untuk dapetin data nasabah lapse secara organisasi

        $DBJL = $this->load->database('jlindo', TRUE);
        
        $sql = "SELECT A.NOAGEN,
                    A.PREFIXPERTANGGUNGAN || A.NOPERTANGGUNGAN AS NOPOLLAMA,
                    (SELECT NAMAKLIEN1
                    FROM TABEL_100_KLIEN B
                    WHERE B.NOKLIEN = A.NOPEMEGANGPOLIS)
                    NAMA_PEMEGANG_POLIS,
                    (SELECT NAMAKLIEN1
                    FROM TABEL_100_KLIEN C
                    WHERE C.NOKLIEN = A.NOAGEN)
                    NAMA_AGEN,
                    (SELECT NAMAKANTOR
                    FROM    TABEL_001_KANTOR F
                            JOIN
                            TABEL_400_AGEN G
                            ON G.KDKANTOR = F.KDKANTOR
                    WHERE G.NOAGEN = A.NOAGEN)
                    NAMA_KANTOR,
                    A.NOPOLBARU,
                    A.PREMI1,
                    D.PHONETETAP01 AS NO_TELP_PEMPOL,
                    D.NO_PONSEL AS NO_HP_PEMPOL,
                    E.NAMAPRODUK
            FROM TABEL_200_PERTANGGUNGAN A
                    LEFT JOIN TABEL_100_KLIEN D
                    ON A.NOPEMEGANGPOLIS = D.NOKLIEN
                    LEFT JOIN TABEL_202_PRODUK E
                    ON A.KDPRODUK = E.KDPRODUK
            WHERE a.NOAGEN IN
                    (SELECT '$iduser' NOAGEN from DUAL
                        UNION ALL
                        SELECT NOAGEN FROM TABEL_400_AGEN
                            WHERE KDSTATUSAGEN = '01'
                                AND KDJABATANAGEN IN ('25','26','24')
                            START WITH ATASAN = '$iduser'
                            CONNECT BY PRIOR NOAGEN = ATASAN)
                    AND A.KDSTATUSFILE = 'A'
                    AND TO_CHAR(A.MULAS,'YYYY') = TO_CHAR(SYSDATE,'YYYY')
                    AND KDPERTANGGUNGAN = '2'";
    
        $db = $DBJL->query($sql);
        $data = $db->result_array();
        $db->free_result();
        
        return $data;
    }

    function countdown($id){
        $result = array();
        
        $q = $this->db->query("select tglakhirlisensi,
        ADD_MONTHS(tglakhirlisensi, -3) as tglsetelahkurang
        from tabel_400_agen@jlindo where noagen = '$id'");
        
        if ($q->num_rows() > 0)
            $result = $q->row_array();

        $q->free_result();

        return $result;
    }

    function get_jumlah_nasabah_lapse($iduser){
        
        // Load connection ke database NADM
        $DBJL = $this->load->database('jlindo', TRUE);
        
        $sql = "SELECT  SUM(COUNT (A.NOPERTANGGUNGAN)) AS JUMLAH_DATA 
        FROM TABEL_200_PERTANGGUNGAN A 
        WHERE A.NOAGEN IN (SELECT '$iduser' NOAGEN FROM DUAL
            UNION ALL
            SELECT NOAGEN FROM TABEL_400_AGEN
                WHERE KDSTATUSAGEN = '01'
                      AND KDJABATANAGEN IN ('25','26','24')
                START WITH ATASAN = '$iduser'
                CONNECT BY PRIOR NOAGEN = ATASAN) 
         AND A.KDSTATUSFILE = 'A'
         AND TO_CHAR(A.MULAS,'YYYY') = TO_CHAR(SYSDATE,'YYYY') 
         and KDPERTANGGUNGAN = '2'
         GROUP BY A.NOAGEN";
    
    
        $db = $DBJL->query($sql);
        $data = $db->row_array();
        $db->free_result();
        
        return $data;
    }

    function get_jumlah_spaj_pending($iduser){
        
        // Load connection ke database NADM
        $DBJL = $this->load->database('jlindo', TRUE);
        

        $sql = " SELECT SUM(COUNT(A.NOSPAJ)) AS JUMLAH_DATA
        FROM TABEL_SPAJ_ONLINE A
       WHERE  A.KODEAGEN IN (SELECT '$iduser' NOAGEN from DUAL
        UNION ALL
        SELECT NOAGEN FROM TABEL_400_AGEN
                WHERE KDSTATUSAGEN = '01'
                      AND KDJABATANAGEN IN ('25','26','24')
                START WITH ATASAN = '$iduser'
                CONNECT BY PRIOR NOAGEN = ATASAN)
                AND A.SUSPEND = 1 
                AND TO_CHAR(A.TANGGALREKAM,'YYYY') = TO_CHAR(SYSDATE,'YYYY')
                AND A.KETERANGAN IS NOT NULL
       GROUP BY A.KODEAGEN";
    
        $db = $DBJL->query($sql);
        $data = $db->row_array();
        $db->free_result();
        
        return $data;
    }
    
    function get_polis_aktif($iduser){
        $data = array();
        $tglMulai = '01/01/'.date('Y');
        $q = $this->db->query(" SELECT
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
            FROM TABEL_200_PERTANGGUNGAN@jlindo e 
            WHERE e.KDSTATUSFILE = '1'
        	         AND e.KDPERTANGGUNGAN = '2'
        	         AND e.NOAGEN IN ( (SELECT   NOAGEN
                           FROM   TABEL_400_AGEN@jlindo 
                           WHERE    KDSTATUSAGEN = '01'
                           AND KDJABATANAGEN IN ('24','25','26')
                           START WITH   ATASAN = '$iduser' 
                           CONNECT BY   PRIOR NOAGEN = ATASAN
                           UNION ALL
                           SELECT   '$iduser'  FROM DUAL
                        )
                      )
        AND e.MULAS BETWEEN TO_DATE('$tglMulai', 'DD/MM/YYYY') AND TRUNC(SYSDATE)
        ");

        if ($q->num_rows() > 0)
        $data = $q->row_array();

        $q->free_result();

        return $data;
    }

    function get_polis_and_ape($iduser){
        $data = array();
        $tglMulai = '01/01/'.date('Y');
        $q = $this->db->query(" SELECT
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
            FROM TABEL_200_PERTANGGUNGAN@jlindo e 
            WHERE e.KDSTATUSFILE NOT IN ('X','C')
        	         AND e.KDPERTANGGUNGAN = '2'
        	         AND e.NOAGEN IN ( (SELECT   NOAGEN
                           FROM   TABEL_400_AGEN@jlindo 
                           WHERE  KDJABATANAGEN IN ('24','25','26')  
                           --AND KDSTATUSAGEN = '01'
                           START WITH   ATASAN = '$iduser' 
                           CONNECT BY   PRIOR NOAGEN = ATASAN
                           UNION ALL
                           SELECT   '$iduser'  FROM DUAL
                        )
                      )
        AND e.MULAS BETWEEN TO_DATE('$tglMulai', 'DD/MM/YYYY') AND TRUNC(SYSDATE)
        ");

        if ($q->num_rows() > 0)
        $data = $q->row_array();

        $q->free_result();

        return $data;
    }

    function get_agen_rekrut_by_id($iduser){
        $data = array();
        $q = $this->db->query("SELECT COUNT (noagen) as JML_SEBAWAH
  		FROM tabel_400_agen@jlindo
		 WHERE noagen IN
           (SELECT '$iduser' noagen FROM DUAL
            UNION ALL
                SELECT noagen
                  FROM TABEL_400_AGEN@jlindo
                 WHERE     kdstatusagen = '01'
                       AND KDJABATANAGEN IN ('25', '26', '24')
            START WITH atasan = '$iduser'
            CONNECT BY PRIOR noagen = atasan)");

       

        if ($q->num_rows() > 0)
        $data = $q->row_array();

        $q->free_result();

        return $data;
    }

    function get_jumlah_rekrut_by_id($iduser){
        $data = array();
        
       $q = $this->db->query("SELECT count(noagen) as JMLREKRUT from tabel_400_agen@jlindo where
                            noagenrekr in (
                select '$iduser' from dual
                union all            
                SELECT noagen
                FROM tabel_400_agen@jlindo 
                WHERE   KDSTATUSAGEN = '01'
                START WITH   ATASAN = '$iduser'
                CONNECT BY nocycle PRIOR NOAGEN = ATASAN)
                and to_char(tglrekam,'yyyy') = to_char(sysdate,'yyyy')
                and kdjabatanagen = '24'");


        if ($q->num_rows() > 0)
            $data = $q->row_array();

        $q->free_result();

        return $data;
    }

    function get_polis_expirasi_super(){
        $data = array();
        $tglMulai = '01/01/'.date('Y');
        $q = $this->db->query("SELECT COUNT (e.NOPERTANGGUNGAN)    AS TOTAL_POLIS
                FROM TABEL_200_PERTANGGUNGAN@jlindo e
                LEFT JOIN TABEL_400_AGEN@jlindo g
                ON e.NOAGEN=g.noagen
                WHERE     e.KDSTATUSFILE in ('3')
			AND KDPRODUK NOT IN ('IFGETRIP')
                        AND e.KDPERTANGGUNGAN = '2'
                        AND g.KDSTATUSAGEN = '01'
                        AND g.KDJABATANAGEN IN ('24','25','26')
                    AND e.MULAS BETWEEN TO_DATE ('$tglMulai', 'DD/MM/YYYY')
                                    AND TRUNC(SYSDATE)");

        if ($q->num_rows() > 0)
        $data = $q->row_array();

        $q->free_result();

        return $data;
    }

    function get_polis_tebus_super(){
        $data = array();
        $tglMulai = '01/01/'.date('Y');
        $q = $this->db->query("SELECT COUNT (e.NOPERTANGGUNGAN)    AS TOTAL_POLIS
            FROM TABEL_200_PERTANGGUNGAN@jlindo e
            LEFT JOIN TABEL_400_AGEN@jlindo g
            ON e.NOAGEN=g.noagen
            WHERE     e.KDSTATUSFILE in ('5')
                    AND e.KDPERTANGGUNGAN = '2'
		    AND KDPRODUK NOT IN ('IFGETRIP')
                    AND g.KDSTATUSAGEN = '01'
                    AND g.KDJABATANAGEN IN ('24','25','26')
                AND e.MULAS BETWEEN TO_DATE ('$tglMulai', 'DD/MM/YYYY')
                                AND TRUNC(SYSDATE)");

        if ($q->num_rows() > 0)
        $data = $q->row_array();

        $q->free_result();

        return $data;
    }


    function get_polis_aktif_super(){
        $data = array();
        $tglMulai = '01/01/'.date('Y');
        $q = $this->db->query("SELECT COUNT (e.NOPERTANGGUNGAN)    AS TOTAL_POLIS
        FROM TABEL_200_PERTANGGUNGAN@jlindo e
        LEFT JOIN TABEL_400_AGEN@jlindo g
        ON e.NOAGEN=g.noagen
        WHERE     e.KDSTATUSFILE = '1'
                AND e.KDPERTANGGUNGAN = '2'
                AND g.KDSTATUSAGEN = '01'
		AND KDPRODUK NOT IN ('IFGETRIP')
                AND g.KDJABATANAGEN IN ('24','25','26')
            AND e.MULAS BETWEEN TO_DATE ('$tglMulai', 'DD/MM/YYYY')
                            AND TRUNC(SYSDATE)");

        if ($q->num_rows() > 0)
        $data = $q->row_array();

        $q->free_result();

        return $data;
    }


    function get_polis_and_ape_super(){
        $data = array();
        $tglMulai = '01/01/'.date('Y');
        $q = $this->db->query("SELECT COUNT (e.NOPERTANGGUNGAN)    AS TOTAL_POLIS,
                NVL (
                    SUM (
                        CASE
                            WHEN e.KDCARABAYAR IN ('1', 'M') THEN e.premi1 * 12
                            WHEN e.KDCARABAYAR IN ('2', 'Q') THEN e.premi1 * 4
                            WHEN e.KDCARABAYAR IN ('3', 'H') THEN e.premi1 * 2
			    WHEN e.KDCARABAYAR IN ('X') THEN e.premi1 * 0.1
                            ELSE e.premi1
                        END),
                    0)                       AS TOTAL_APE
            FROM TABEL_200_PERTANGGUNGAN@jlindo e
            LEFT JOIN TABEL_400_AGEN@jlindo g
            ON e.NOAGEN=g.noagen
            WHERE     e.KDSTATUSFILE NOT IN ('X','C')
                    AND e.KDPERTANGGUNGAN = '2'
                    --AND g.KDSTATUSAGEN = '01'
		    AND KDPRODUK NOT IN ('IFGETRIP')
                    AND g.KDJABATANAGEN IN ('24','25','26')
                AND e.MULAS BETWEEN TO_DATE ('$tglMulai', 'DD/MM/YYYY')
                                AND TRUNC(SYSDATE)");


            if ($q->num_rows() > 0)
            $data = $q->row_array();

            $q->free_result();

            return $data;
    }


    function get_total_agen_aktif(){

        $data = array();
        $q = $this->db->query("SELECT COUNT(NOAGEN) AS TOTAL_AGEN_AKTIF 
                                    FROM TABEL_400_AGEN@jlindo
                                        WHERE KDSTATUSAGEN='01' 
                                        AND KDJABATANAGEN IN ('24','25','26')
					AND NOAGEN NOT IN ('9999999999','agen1','agen2','agen3','agen4','agen5','dummy','FENDY','0012129305')");


        if ($q->num_rows() > 0)
            $data = $q->row_array();

        $q->free_result();

        return $data;
    }


    function get_total_fyp($iduser){
        $data = array();

        $q = $this->db->query("SELECT SUM(KOMISIAGEN) total_fyp
                              FROM (
                                      SELECT C.NOAGEN, 
                                      NVL(case 
						when kdcarabayar IN ('X') then A.PREMITAGIHAN * 0.1
						else A.PREMITAGIHAN
					  END,0) AS KOMISIAGEN 
                                      FROM TABEL_300_HISTORIS_PREMI@jlindo A
                                      INNER JOIN TABEL_200_PERTANGGUNGAN@jlindo B ON A.PREFIXPERTANGGUNGAN||A.NOPERTANGGUNGAN = B.PREFIXPERTANGGUNGAN||B.NOPERTANGGUNGAN
                                      INNER JOIN TABEL_400_AGEN@jlindo C ON C.NOAGEN = B.NOAGEN
                                      WHERE TO_CHAR(A.TGLSEATLED,'YYYY') = TO_CHAR (SYSDATE, 'YYYY')
                                      /* PENGECEKAN UMUR POLIS <= 1 TAHUN */
                                      AND (FLOOR(MONTHS_BETWEEN(A.TGLBOOKED, TRUNC(B.MULAS,'MM')))) < 12
                                      AND B.KDSTATUSFILE NOT IN ('X','C')
                                      --AND C.KDSTATUSAGEN = '01'
                                      AND B.KDPERTANGGUNGAN = '2'
                                      --AND B.KDPRODUK IN ('JL4BLN', 'JL4BPRO')
                                      AND C.KDJABATANAGEN IN ('24','25','26')
                                      AND C.NOAGEN IN (SELECT   NOAGEN
                                                        FROM   TABEL_400_AGEN@jlindo 
                                                        WHERE  KDJABATANAGEN IN ('24','25','26')
                                                        START WITH   ATASAN = '$iduser' 
                                                        CONNECT BY   PRIOR NOAGEN = ATASAN
                                                        UNION ALL
                                                        SELECT   '$iduser'  FROM DUAL
                                                        )
                                      /* END PRODUKSI PREMI */
                                      UNION ALL
                                      /* PRODUKSI TOPUP SEKALIGUS */
                                      SELECT AGN.NOAGEN NOAGEN, NVL((TUP.PREMI)*0.1,0) KOMISIAGEN
                                      FROM TABEL_200_PERTANGGUNGAN@jlindo PER,
                                           TABEL_400_AGEN@jlindo AGN,
                                           TABEL_500_PENAGIH@jlindo PEN,
                                           (
                                               SELECT PREFIXPERTANGGUNGAN||NOPERTANGGUNGAN AS NOPOLIS, PREMI AS PREMI, TGLTRANSFER
                                               FROM TABEL_UL_TRANSAKSI_TOPUP@jlindo 
                                                WHERE TO_CHAR(TGLTRANSFER,'YYYY') = TO_CHAR (SYSDATE, 'YYYY')
                                               UNION
                                               SELECT A.NOPOLIS, (A.PREMI - B.PREMI1) PREMI, A.TGLUPDATED AS TGLTRANSFER
                                               FROM TABEL_315_PELUNASAN_VA@jlindo A
                                                INNER JOIN TABEL_200_PERTANGGUNGAN@jlindo B ON A.NOPOLIS = B.PREFIXPERTANGGUNGAN||B.NOPERTANGGUNGAN
                                                  WHERE TO_CHAR(A.TGLUPDATED,'YYYY') = TO_CHAR (SYSDATE, 'YYYY')
                                                   AND (A.PREMI - B.PREMI1) >= 1000000
                                               UNION
                                               SELECT A.NO_POLIS AS NOPOLIS, (A.BILL_AMOUNT - B.PREMI1) PREMI, A.PROCCESS_DATE AS TGLTRANSFER
                                                FROM TABEL_315_PELUNASAN_H2H@jlindo A
                                                  INNER JOIN TABEL_200_PERTANGGUNGAN@jlindo B ON A.NO_POLIS = B.PREFIXPERTANGGUNGAN||B.NOPERTANGGUNGAN
                                                   WHERE TO_CHAR(A.PROCCESS_DATE,'YYYY') = TO_CHAR (SYSDATE, 'YYYY')
                                                   AND (A.BILL_AMOUNT - B.PREMI1) >= 1000000
                                           )TUP
                                    WHERE   PER.PREFIXPERTANGGUNGAN||PER.NOPERTANGGUNGAN = TUP.NOPOLIS 
                                    AND PER.NOPENAGIH = PEN.NOPENAGIH
                                    AND PER.NOAGEN = AGN.NOAGEN
                                    AND AGN.NOAGEN IN (SELECT   NOAGEN
                                                        FROM   TABEL_400_AGEN@jlindo 
                                                        WHERE KDJABATANAGEN IN ('24','25','26')
                                                        START WITH   ATASAN = '$iduser' 
                                                        CONNECT BY   PRIOR NOAGEN = ATASAN
                                                        UNION ALL
                                                        SELECT   '$iduser'  FROM DUAL
                                                        )
                                    AND PER.KDSTATUSFILE NOT IN ('X','C')
                                    AND (FLOOR(MONTHS_BETWEEN(TUP.TGLTRANSFER, TRUNC(PER.MULAS,'MM')))) < 12
                                    AND PER.KDPERTANGGUNGAN = '2'
                                    --AND PER.KDPRODUK IN ('JL4BLN')
                                    AND PER.NOPENAGIH = PEN.NOPENAGIH
                                    --AND AGN.KDSTATUSAGEN = '01'
                                    AND AGN.KDJABATANAGEN IN ('24','25','26')
                                    /* END TOUP */
              )X");


        if ($q->num_rows() > 0)
            $data = $q->row_array();

            $q->free_result();

        return $data;
    }

    function get_total_fyp_super(){

        // Query untuk dapetin data spaj yang pending secara organisasi
       $DBJL = $this->load->database('jlindo', TRUE);

       $sql = "SELECT SUM(KOMISIAGEN) TOTAL_FYP_SUPER
                FROM (
                SELECT C.NOAGEN, 
                NVL(case 
			when kdcarabayar IN ('X') then A.PREMITAGIHAN * 0.1
			else A.PREMITAGIHAN
		    END,0) AS KOMISIAGEN
                FROM TABEL_300_HISTORIS_PREMI A
                INNER JOIN TABEL_200_PERTANGGUNGAN B ON A.PREFIXPERTANGGUNGAN||A.NOPERTANGGUNGAN = B.PREFIXPERTANGGUNGAN||B.NOPERTANGGUNGAN
                INNER JOIN TABEL_400_AGEN C ON C.NOAGEN = B.NOAGEN
                WHERE TO_CHAR(A.TGLSEATLED,'YYYY') = TO_CHAR (SYSDATE, 'YYYY')
                    /* PENGECEKAN UMUR POLIS <= 1 TAHUN */
                    AND (FLOOR(MONTHS_BETWEEN(A.TGLBOOKED, TRUNC(B.MULAS,'MM')))) < 12
                AND B.KDSTATUSFILE NOT IN ('X','C')
                --AND C.KDSTATUSAGEN = '01'
                AND B.KDPERTANGGUNGAN = '2'
                AND KDPRODUK NOT IN ('IFGETRIP')
		and c.noagen not in ('9999999999','agen1','agen2','agen3','agen4','agen5','dummy','0012129305')             
		AND C.KDJABATANAGEN IN ('24','25','26')
                --AND C.NOAGEN = '".$FILTER["NOAGEN"]."'
            /* END PRODUKSI PREMI */
                UNION ALL
            /* PRODUKSI TOPUP SEKALIGUS */
                SELECT  
                        AGN.NOAGEN NOAGEN,
                        NVL((TUP.PREMI)*0.1,0) KOMISIAGEN
                FROM    TABEL_200_PERTANGGUNGAN PER,
                        TABEL_400_AGEN AGN,
                        TABEL_500_PENAGIH PEN,
                        (
                            SELECT PREFIXPERTANGGUNGAN||NOPERTANGGUNGAN AS NOPOLIS, PREMI AS PREMI, TGLTRANSFER
                            FROM TABEL_UL_TRANSAKSI_TOPUP 
                            --WHERE TRUNC(TGLTRANSFER) BETWEEN TO_DATE('$TGLAWAL','DD/MM/YYYY') AND TO_DATE('$TGLAKHIR','DD/MM/YYYY')
                            WHERE TO_CHAR(TGLTRANSFER,'YYYY') = TO_CHAR (SYSDATE, 'YYYY')
                            UNION
                            SELECT A.NOPOLIS, (A.PREMI - B.PREMI1) PREMI, A.TGLUPDATED AS TGLTRANSFER
                            FROM TABEL_315_PELUNASAN_VA A
                            INNER JOIN TABEL_200_PERTANGGUNGAN B ON A.NOPOLIS = B.PREFIXPERTANGGUNGAN||B.NOPERTANGGUNGAN
                        -- WHERE TRUNC(A.TGLUPDATED) BETWEEN TO_DATE('$TGLAWAL','DD/MM/YYYY') AND TO_DATE('$TGLAKHIR','DD/MM/YYYY')
                        WHERE TO_CHAR(A.TGLUPDATED,'YYYY') = TO_CHAR (SYSDATE, 'YYYY')
                                AND (A.PREMI - B.PREMI1) >= 1000000
                            UNION
                            SELECT A.NO_POLIS AS NOPOLIS, (A.BILL_AMOUNT - B.PREMI1) PREMI, A.PROCCESS_DATE AS TGLTRANSFER
                            FROM TABEL_315_PELUNASAN_H2H A
                            INNER JOIN TABEL_200_PERTANGGUNGAN B ON A.NO_POLIS = B.PREFIXPERTANGGUNGAN||B.NOPERTANGGUNGAN
                            --WHERE TRUNC(A.PROCCESS_DATE) BETWEEN  TO_DATE('$TGLAWAL','DD/MM/YYYY') AND TO_DATE('$TGLAKHIR','DD/MM/YYYY')
                                WHERE TO_CHAR(A.PROCCESS_DATE,'YYYY') = TO_CHAR (SYSDATE, 'YYYY')
                                AND (A.BILL_AMOUNT - B.PREMI1) >= 1000000
                        )TUP
                WHERE   PER.PREFIXPERTANGGUNGAN||PER.NOPERTANGGUNGAN = TUP.NOPOLIS 
                        AND PER.NOPENAGIH = PEN.NOPENAGIH
                        AND PER.NOAGEN = AGN.NOAGEN
                        --AND AGN.NOAGEN = '".$FILTER["NOAGEN"]."'
                        AND PER.KDSTATUSFILE NOT IN ('X','C')
                        AND (FLOOR(MONTHS_BETWEEN(TUP.TGLTRANSFER, TRUNC(PER.MULAS,'MM')))) < 12
                        AND PER.KDPERTANGGUNGAN = '2'
                        AND KDPRODUK NOT IN ('IFGETRIP')
                        AND PER.NOPENAGIH = PEN.NOPENAGIH
			and AGN.noagen not in ('9999999999','agen1','agen2','agen3','agen4','agen5','dummy','0012129305')
                        --AND AGN.KDSTATUSAGEN = '01'
                    	--AND AGN.KDJABATANAGEN = '29'
                        AND AGN.KDJABATANAGEN IN ('24','25','26')
                        /* END TOUP */)X";

   
       $db = $DBJL->query($sql);
       $data = $db->result_array();
       $db->free_result();
       
       return $data;
    }

    function get_total_jumlah_rekrut(){
        $data = array();
        $q = $this->db->query("SELECT count(noagen) JMLREKRUT
  	FROM tabel_400_agen@jlindo
 	WHERE     TO_CHAR (tglrekam, 'YYYY') = TO_CHAR (SYSDATE, 'YYYY')
       AND kdjabatanagen IN ('24', '25', '26')
       and kdstatusagen = '01'
       order by tglrekam desc");


        if ($q->num_rows() > 0)
            $data = $q->row_array();

        $q->free_result();

        return $data;
    }

    function get_jumlah_nasabah_lapse_super(){
        
        // Load connection ke database NADM
        $DBJL = $this->load->database('jlindo', TRUE);
        
        $sql = "SELECT  COUNT(A.NOPERTANGGUNGAN) AS JUMLAH_DATA
        FROM TABEL_200_PERTANGGUNGAN A JOIN TABEL_SPAJ_ONLINE B ON A.NOSP=B.NOSPAJ 
        WHERE A.KDSTATUSFILE = 'A' 
         AND B.STATUS = 3
         AND A.KDPERTANGGUNGAN = '2'
	 AND KDPRODUK NOT IN ('IFGETRIP')
         AND TO_CHAR(A.MULAS,'YYYY') = TO_CHAR(SYSDATE,'YYYY')";
    
    
        $db = $DBJL->query($sql);
        $data = $db->row_array();
        $db->free_result();
        
        return $data;
    }



    /*log login */
    function postLog_login($username){
		$sukses = 0;
		$kdlog = 'LOGIN'.date("dmY");
		$log = 'JAIM LOGIN USER : '.$username;
		
        $this->db->trans_begin();

        $this->db->query("INSERT INTO JAIM_999_LOG (KDLOG, LOG, TGLREKAM, USERREKAM) VALUES ('$kdlog', '$log', sysdate, '$username')");
					 
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        }
        else {
            $sukses = $this->db->trans_commit();
        }

        return ($sukses ? C_STATUS_SUKSES_SIMPAN : C_STATUS_GAGAL_SIMPAN);
	}
    /* end log login */

     //function untuk mengambil data akun yang terdapat di AIM
    function getAkun(){
		$data = array();
		$q = $this->db->query("SELECT a.iduser, a.username, B.NAMAROLE, NAMAKLIEN1 FROM JAIM.JAIM_900_USER a 
		left join JAIM_901_ROLE B ON a.KDROLE = b.KDROLE
		left join TABEL_100_KLIEN@jlindo C ON C.NOKLIEN = A.username
		where a.username not in ('SUPERADMIN','SUPERUSER') ");
        
        if ($q->num_rows() > 0)
            $data = $q->result_array();

        $q->free_result();

        return $data;
	}

    //function untuk resetpassowrd
	function resetpassword($username,$iduser){
		$sukses = 0;

        $this->db->trans_begin();

        $this->db
            ->query("UPDATE JAIM.JAIM_900_USER SET
                         PASSWORD = '$username'
                     WHERE IDUSER = '$iduser' ");
					 
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        }
        else {
            $sukses = $this->db->trans_commit();
        }

        return ($sukses ? C_STATUS_SUKSES_SIMPAN : C_STATUS_GAGAL_SIMPAN);
	}

    /*===== get daftar keluarga agen by id =====*/
    function get_list_keluarga_by_id($iduser) {
        $data = array();
        
        $q = $this->db
                ->query("SELECT nama, hubungan, tempat_lahir, TO_CHAR(tgl_lahir, 'DD/MM/YYYY') AS tgllahir
                         FROM tabel_420_keluarga_agen@jlindo 
                         WHERE noagen = '$iduser'
                         ORDER BY TGL_LAHIR");
        
        if ($q->num_rows() > 0)
            $data = $q->result_array();

        $q->free_result();

        return $data;
    }
    
    
    /*===== get daftar pendidikan formal agen by id =====*/
    function get_list_pendidikan_formal_by_id($iduser) {
        $data = array();
        
        $q = $this->db
                ->query("SELECT TO_CHAR(tglmulai, 'DD/MM/YYYY') tglmulai, namajenispendidikan, keterangan
                         FROM tabel_414_histori_pendidikan@jlindo a
                         INNER JOIN tabel_999_jenis_pendidikan@jlindo b ON a.kdjenispendidikan = b.kdjenispendidikan
                         WHERE kdkategoripendidikan = '01' AND noagen = '$iduser'
                         ORDER BY tglmulai DESC");
        
        if ($q->num_rows() > 0)
            $data = $q->result_array();

        $q->free_result();

        return $data;
    }
    
    
    /*===== get daftar pendidikan extern agen by id =====*/
    function get_list_pendidikan_extern_by_id($iduser) {
        $data = array();
        
        $q = $this->db
                ->query("SELECT TO_CHAR(tglmulai, 'DD/MM/YYYY') tglmulai, uraian AS namajenispendidikan, keterangan
                         FROM tabel_414_histori_pendidikan@jlindo a
                         INNER JOIN tabel_999_jenis_pendidikan@jlindo b ON a.kdjenispendidikan = b.kdjenispendidikan
                         WHERE kdkategoripendidikan = '03' AND noagen = '$iduser'
                         ORDER BY a.tglmulai DESC");
        
        if ($q->num_rows() > 0)
            $data = $q->result_array();

        $q->free_result();

        return $data;
    }
    
    
    /*===== get daftar pengalaman kerja agen by id =====*/
    function get_list_pengalaman_by_id($iduser) {
        $data = array();
        
        $q = $this->db
                ->query("SELECT TO_CHAR(tglmulai, 'DD/MM/YYYY') tglmulai, uraian AS perusahaan, keterangan
                         FROM tabel_415_histori_kerja@jlindo a
                         WHERE noagen = '$iduser'
                         ORDER BY a.tglmulai DESC");
        
        if ($q->num_rows() > 0)
            $data = $q->result_array();

        $q->free_result();

        return $data;
    }
    
    
    /*===== get daftar riwayat jabatan agen by id =====*/
    function get_list_riwayat_jabatan_by_id($iduser) {
        $data = array();
        
        $q = $this->db
                ->query("SELECT TO_CHAR(a.tgljabatan, 'DD/MM/YYYY') tgljabatan, a.uraian, a.keterangan, a.kdjabatanagen,
                             a.kdkelasagen, b.namajabatanagen, c.namakelasagen
                         FROM tabel_417_histori_jabatan@jlindo a
                         INNER JOIN tabel_413_jabatan_agen@jlindo b ON a.kdjabatanagen = b.kdjabatanagen
                         INNER JOIN tabel_408_kode_kelas_agen@jlindo c ON a.kdkelasagen = c.kdkelasagen
                         WHERE noagen = '$p'
                         ORDER BY a.tgljabatan DESC");
        
        if ($q->num_rows() > 0)
            $data = $q->result_array();

        $q->free_result();

        return $data;
    }
    
    
    /*===== get daftar prestasi agen by id =====*/
    function get_list_prestasi_by_id($iduser) {
        $data = array();
        
        $q = $this->db
                ->query("SELECT TO_CHAR(tgljasa, 'DD/MM/YYYY') tgljasa, uraian, keterangan
                         FROM tabel_416_histori_jasa@jlindo a
                         WHERE noagen = '$iduser' 
                             AND kdjenisjasa = '1'
                         ORDER BY a.tgljasa DESC");
        
        if ($q->num_rows() > 0)
            $result = $q->result_array();

        $q->free_result();

        return $result;
    }
    
    
    /*===== get daftar polis agen by id =====*/
    function get_list_polis_by_id($iduser) {
        $data = array();
        
        $q = $this->db
           ->query("SELECT a.*, ROWNUM no
                    FROM (
                        SELECT a.prefixpertanggungan, a.nopertanggungan, b.namaklien1, to_char(mulas,'dd/mm/yyyy') mulas, a.kdstatusfile, a.kdproduk
                        FROM tabel_200_pertanggungan@jlindo a
                        INNER JOIN tabel_100_klien@jlindo b ON a.nopemegangpolis = b.noklien
                        WHERE a.noagen = '$iduser'
                            AND kdpertanggungan = '2'
                            AND to_char(mulas,'yyyy') = to_char(sysdate,'yyyy')
                        ORDER BY a.mulas DESC) a
                    WHERE ROWNUM < (6)");
        
        if ($q->num_rows() > 0)
            $data = $q->result_array();

        $q->free_result();

        return $data;
    }
    
    
    /*===== get daftar proposal pos agen by id =====*/
    function get_list_proposal_pos_by_id($iduser) {
        $data = array();
        
        $q = $this->db
                    ->query("SELECT build_id noproposal, nama_produk, jumlah_premi, namaklien1, namakantor, noagen,
                    CASE WHEN a.kdstatus = '3' AND a.dokumenlengkap = 0 
                            THEN b.namastatus || ' (Pending)' 
                            ELSE b.namastatus 
                        END namastatus, a.namastatusfile
                    FROM (
                        SELECT a.build_id, b.nama_produk, a.jumlah_premi, c.dokumenlengkap, h.namaklien1, j.namakantor, i.noagen,
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
                        FROM jaim_300_hitung a
                        LEFT OUTER JOIN jaim_300_produk b ON a.id_produk = b.id_produk
                        LEFT OUTER JOIN tabel_ul_spaj_temp@jlindo c ON a.build_id = c.buildid
                        LEFT OUTER JOIN tabel_200_pertanggungan@jlindo d ON c.nosp = d.nosp
                        LEFT OUTER JOIN tabel_214_underwriting@jlindo e ON d.prefixpertanggungan = e.prefixpertanggungan
                            AND d.nopertanggungan = e.nopertanggungan
                        LEFT OUTER JOIN tabel_214_acceptance_dokumen@jlindo f ON d.prefixpertanggungan = f.prefixpertanggungan
                            AND d.nopertanggungan = f.nopertanggungan
                        LEFT OUTER JOIN tabel_299_status_file@jlindo g ON d.kdstatusfile = g.kdstatusfile
                        LEFT OUTER JOIN tabel_100_klien@jlindo h ON a.id_agen = h.noklien
                        LEFT OUTER JOIN tabel_400_agen@jlindo i ON h.noklien = i.noagen
                        LEFT OUTER JOIN tabel_001_kantor@jlindo j ON i.kdkantor = j.kdkantor
                        WHERE a.id_agen IN (select '$iduser' noagen from dual
                            union ALL
                            SELECT noagen FROM TABEL_400_AGEN@jlindo
                                            WHERE kdstatusagen = '01'
                                                AND KDJABATANAGEN IN ('25','26','24')
                                            START WITH atasan = '$iduser'
                                            CONNECT BY PRIOR noagen = atasan)
                        -- bp = 26; bm = 25; be = 24 (kdjabatanagen)
                        ORDER BY a.tgl_rekam DESC NULLS LAST
                    ) a
                    LEFT OUTER JOIN jaim_201_status_prospek b ON a.kdstatus = b.kdstatus
                    WHERE ROWNUM < (6)");
        
        if ($q->num_rows() > 0)
            $data = $q->result_array();

        $q->free_result();

        return $data;
    }
    

    /*===== get tabel user by id =====*/
    function get_user_by_id($iduser) {
        $result = null;
        
		/*
        $q = $this->db
           ->query("SELECT a.iduser, a.username, a.password, a.kdrole,
                        CASE WHEN null IS NULL THEN a.namalengkap ELSE null END namalengkap,
                        null kdjabatanagen, null kdkantor, null kdareaoffice, null kdunitproduksi, null emailtetap,
                        null fotoagen, a.avatar, a.pointour, null namakantor,
                        CASE WHEN null IS NOT NULL AND null IS NOT NULL THEN null || ' / ' || null
                            WHEN null IS NOT NULL AND null IS NULL THEN null ELSE null END AS phonekantor,
                        null emailkantor, null namainduk, 
                        CASE WHEN null IS NOT NULL AND null IS NOT NULL THEN null || ' / ' || null
                            WHEN null IS NOT NULL AND null IS NULL THEN null ELSE null END AS phoneinduk,
                        null emailinduk, null versi, '01' kdstatusagen
                    FROM jaim_900_user a
                    INNER JOIN jaim_910_historis_app b ON b.kdstatus = 1
                    WHERE LOWER(a.username) = LOWER('$iduser')");
		*/
					
					
	/*
	$q = $this->db->query("SELECT a.iduser, a.username, a.password, a.kdrole,
                             CASE WHEN c.namaklien1 IS NULL THEN a.namalengkap ELSE c.namaklien1 END namalengkap,
                             d.kdjabatanagen, d.kdkantor, d.kdareaoffice, d.kdunitproduksi, c.emailtetap,
                             d.fotoagen, a.avatar, a.pointour, e.namakantor,
                             CASE WHEN e.phone01 IS NOT NULL AND e.phone02 IS NOT NULL THEN e.phone01 || ' / ' || e.phone02
                                 WHEN e.phone01 IS NOT NULL AND e.phone02 IS NULL THEN e.phone01 ELSE e.phone02 END AS phonekantor,
                             e.email emailkantor, f.namakantor namainduk, 
                             CASE WHEN f.phone01 IS NOT NULL AND f.phone02 IS NOT NULL THEN f.phone01 || ' / ' || f.phone02
                                 WHEN f.phone01 IS NOT NULL AND f.phone02 IS NULL THEN f.phone01 ELSE f.phone02 END AS phoneinduk,
                             f.email emailinduk, b.versi, d.kdstatusagen
                         FROM jaim_900_user a
                         INNER JOIN jaim_910_historis_app b ON b.kdstatus = 1
                         LEFT OUTER JOIN tabel_100_klien@jlindo c ON a.username = c.noklien
                         LEFT OUTER JOIN tabel_400_agen@jlindo d ON a.username = d.noagen
                         LEFT OUTER JOIN tabel_001_kantor@jlindo e ON d.kdkantor = e.kdkantor
                         LEFT OUTER JOIN tabel_001_kantor@jlindo f ON e.kdkantorinduk = f.kdkantor
                         WHERE LOWER(a.username) = LOWER('$iduser')");
						 
						 */
						 
	$q = $this->db->query("SELECT a.* FROM GET_USER_BY_ID a WHERE LOWER(a.username) = LOWER('$iduser') ");

        if ($q->num_rows() > 0)
            $result = $q->row_array();

        $q->free_result();

        return $result;
    }
    
    
    /*===== get biodata agen by id =====*/
    function get_biodata_by_id($iduser) {
        $result = array();
        
		/*
        $q = $this->db->query("SELECT a.noagen, b.namaklien1, d.namastatusagen, b.tempatlahir, b.tgllahir, a.kdjabatanagen, 
                             c.namajabatanagen, a.nolisensiagen, TO_CHAR(a.tglmulailisensi, 'DD/MM/YYYY') AS tglmulailisensi, 
                             TO_CHAR(a.tglakhirlisensi, 'DD/MM/YYYY') AS tglakhirlisensi,
                             FLOOR(MONTHS_BETWEEN(sysdate, a.tglakhirlisensi) / 12) yearexpls,
                             FLOOR(MONTHS_BETWEEN(sysdate, e.tglpkajagen) / 12) yearexppkaj,
                             CASE WHEN FLOOR(ADD_MONTHS(e.tglpkajagen, 24) - sysdate) > 0 THEN FLOOR(ADD_MONTHS(e.tglpkajagen, 24) - sysdate) ELSE 0 END sisapkaj
                         FROM tabel_400_agen@jlindo a
                         INNER JOIN tabel_100_klien@jlindo b ON a.noagen = b.noklien
                         LEFT OUTER JOIN tabel_413_jabatan_agen@jlindo c ON a.kdjabatanagen = c.kdjabatanagen
                         LEFT OUTER JOIN tabel_409_status_agen@jlindo d ON a.kdstatusagen = d.kdstatusagen
                         LEFT OUTER JOIN (
                             SELECT noagen, MAX(tglpkajagen) tglpkajagen
                             FROM tabel_400_pkaj_agen@jlindo
                             GROUP BY noagen
                         ) e ON a.noagen = e.noagen
                         WHERE a.noagen = '$iduser'");
		*/
		
		 $q = $this->db->query("SELECT a.* FROM GET_BIODATA_AGEN a WHERE a.noagen = '$iduser'");
	
		
		
        
        if ($q->num_rows() > 0)
            $result = $q->row_array();

        $q->free_result();

        return $result;
    }


    /*===== agen terpilih untuk kick off =====*/
    function get_agen_kickoff($iduser) {
	$result = array();

	$q = $this->db->query("SELECT username FROM jaim_900_user WHERE username IN (
		'0000068598', '0000028359', '0000054123', '0000055905', '0000004162', '0000005672', '0000066019', '0000069497', '0000057371', '0000006742',
		'0000061021', '0000027002', '0000046347', '0000066580', '0000010575', '0000004588', '0000065124', '0000026167', '0000003899', '0000036891',
		'0000003824', '0000063297', '0000021191', '0000051586', '0000020583', '0000001107', '0000049682', '0000001103', '0000061046', '0000020522',
		'0000009162', '0000040209', '0000022537', '0000051895', '0000006044', '0000000097', '0000051524', '0000017086', '0000000067', '0000000071',
		'0000000148', '0000007091', '0000028721', '0000068554', '0000043844', '0000032413', '0000000079', '0000066114', '0000072311', '0000071188',
		'0000062297', '0000071425', '0000072314', '0000010156', '0000021832', '0000007055', '0000015847', '0000004071', '0000001384', '0000011128',
		'0000013841', '0000052032', '0000020295', '0000004186', '0000023724', '0000016082', '0000004251', '0000012474', '0000004243', '0000070843',
		'0000056759', '0000028681', '0000001988', '0000029127', '0000030490', '0000004683', '0000033622', '0000044316', '0000009608', '0000031422',
		'0000004700', '0000029519', '0000031506', '0000070288', '0000000037', '0000065691', '0000072271', '0000010182', '0000004355', '0000004366',
		'0000011483', '0000017513', '0000057374', '0000005610', '0000018677', '0000014045', '0000033218', '0000051549', '0000001259', '0000055751',
		'0000036251', '0000026469', '0000070600', '0000029707', '0000048899', '0000039609', '0000026092', '0000009305', '0000004497', '0000072140',
		'0000072142', '0000008398', '0000004420', '0000051867', '0000034113', '0000023249', '0000031738', '0000004415', '0000004465', '0000007772',
		'0000004390', '0000056805', '0000004454', '0000030171', '0000025418', '0000055258', '0000055259', '0000072093', '0000025095', '0000004580',
		'0000004517', '0000004515', '0000004447', '0000000162', '0000063219', '0000031187', '0000045220', '0010591400', '0000000166', '0000000132',
		'0000035183', '0000000127', '0000036905', '0000000155', '0000049027', '0000007984', '0000072986', '0000000182'
	         ) AND username = 'ASEM'");
	
	if ($q->num_rows() > 0)
	    $result = $q->row_array();

	$q->free_result();

	return $result;
    }

    
    /*===== get data polis, premi dan komisi agen by id hirarki =====*/
    function get_polis_premi_komisi($iduser) {
        $result = array();
        
        $q = $this->db
           ->query("SELECT
                        (SELECT COUNT(nopertanggungan) jmlpolis
                        FROM tabel_200_pertanggungan@jlindo
                        WHERE noagen = '$iduser'
                            AND kdpertanggungan = '2'
                            AND to_char(mulas,'yyyy') = to_char(sysdate,'yyyy')
                            AND kdproduk NOT IN ('PAA','PAB','AKM')
                            AND kdstatusfile IN ('1','4','L','3','9','6','8')) jmlpolis,
                        (SELECT NVL(SUM(NVL(nilairp,premitagihan)),0)
                        FROM tabel_200_pertanggungan@jlindo a
                        INNER JOIN tabel_300_historis_premi@jlindo b ON a.prefixpertanggungan = b.prefixpertanggungan
                            AND a.nopertanggungan = b.nopertanggungan
                        WHERE noagen = '$iduser'
                            AND kdpertanggungan = '2'
                            AND kdkuitansi IN ('BP3','NB1')
                            AND to_char(tglseatled,'yyyy') = to_char(sysdate,'yyyy')
                            AND kdproduk NOT IN ('PAA','PAB','AKM')) jmlpremi,
                        (SELECT NVL(SUM(komisiagen)/to_number(to_char(sysdate,'mm')),0)
                        FROM tabel_404_komisi_agen@jlindo a
                        WHERE noagen = '$iduser'
                            AND to_char(tglupdated,'yyyy') = to_char(sysdate,'yyyy')
                            AND komisiagen > 0) jmlkomisi,
                        (SELECT COUNT(nopertanggungan)
                        FROM tabel_200_pertanggungan@jlindo
                        WHERE to_char(mulas,'yyyy') = to_char(sysdate,'yyyy')
                            AND kdpertanggungan = '2'
                            AND noagen = '$iduser'
                            AND kdproduk NOT IN ('PAA','PAB','AKM')
                            AND kdstatusfile = '1') jmlpolisaktif,
                        (SELECT COUNT(nopertanggungan)
                        FROM tabel_200_pertanggungan@jlindo
                        WHERE to_char(mulas,'yyyy') = to_char(sysdate,'yyyy')
                            AND noagen = '$iduser'
                            AND kdpertanggungan = '2'
                            AND kdproduk NOT IN ('PAA','PAB','AKM')
                            AND kdstatusfile IN ('4','L')) jmlpolisbpo,
                        (SELECT COUNT(nopertanggungan)
                        FROM tabel_200_pertanggungan@jlindo
                        WHERE to_char(mulas,'yyyy') = to_char(sysdate,'yyyy')
                            AND noagen = '$iduser'
                            AND kdpertanggungan = '2'
                            AND kdproduk NOT IN ('PAA','PAB','AKM')
                            AND kdstatusfile IN ('3','9')) jmlpolisexpirasi,
                        (SELECT COUNT(nopertanggungan)
                        FROM tabel_200_pertanggungan@jlindo
                        WHERE to_char(mulas,'yyyy') = to_char(sysdate,'yyyy')
                            AND noagen = '$iduser'
                            AND kdpertanggungan = '2'
                            AND kdproduk NOT IN ('PAA','PAB','AKM')
                            AND kdstatusfile = '5') jmlpolistebus
                    FROM DUAL");
        
        if ($q->num_rows() > 0)
            $result = $q->row_array();

        $q->free_result();

        return $result;
    }
    
    
    /*===== get data poin tur agen by id =====*/
    function get_poin_tur($iduser, $tglawal, $tglakhir) {
        $result = array();
        $dollar = 15000;
        
        $q = $this->db
           ->query("SELECT b.kdkantor, a.noagen, c.namaklien1, b.kdjabatanagen, d.namajabatanagen, 
                        SUM(premi) jmlpremi, NVL(SUM(poin),0) jmlpoin, TO_CHAR(e.tglpkajagen, 'dd/mm/yyyy') tglpkajagen, 
                        floor(months_between(sysdate, e.tglpkajagen) /12) yearexppkaj, b.nolisensiagen,
                        floor(months_between(sysdate, b.tglakhirlisensi) /12) yearexpls,
                        (
                            SELECT COUNT(DISTINCT z.nopertanggungan) 
                            FROM tabel_200_pertanggungan@jlindo z
                            INNER JOIN tabel_300_historis_premi@jlindo y ON z.prefixpertanggungan = y.prefixpertanggungan
                                AND z.nopertanggungan = y.nopertanggungan
                            WHERE y.kdkuitansi = 'BP3'
                                AND y.tglbooked BETWEEN TO_DATE('$tglawal','dd/mm/yyyy') AND TO_DATE('$tglakhir','dd/mm/yyyy')
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
                        FROM tabel_300_historis_premi@jlindo a
                        INNER JOIN tabel_200_pertanggungan@jlindo b ON a.prefixpertanggungan = b.prefixpertanggungan
                            AND a.nopertanggungan = b.nopertanggungan
                        INNER JOIN tabel_421_poin_agen@jlindo c ON b.kdproduk = c.kdproduk
                        INNER JOIN tabel_305_cara_bayar@jlindo d ON b.kdcarabayar = d.kdcarabayar
                        INNER JOIN tabel_500_penagih@jlindo e ON b.nopenagih = e.nopenagih
                        WHERE a.kdkuitansi IN ('BP3', 'NB1')
                            AND a.tglseatled IS NOT NULL
                            AND tglbooked BETWEEN TO_DATE('$tglawal','dd/mm/yyyy') AND TO_DATE('30/06/2018', 'dd/mm/yyyy')
                            AND b.kdstatusfile NOT IN ('7', 'X', '5')
                            AND c.status = '1'
                            AND SUBSTR(b.kdproduk, 0, 2) != 'JL'
                            AND (c.kdproduk, c.tglberlaku) IN (
                                SELECT kdproduk, MAX(tglberlaku)
                                FROM tabel_421_poin_agen@jlindo
                                WHERE tglberlaku <= TO_DATE('30/06/2018', 'dd/mm/yyyy')
                                GROUP BY kdproduk
                             )
                            AND b.noagen = '$iduser'

                        UNION ALL

                        SELECT noagen, b.prefixpertanggungan, b.nopertanggungan,
                            CASE WHEN b.kdvaluta = '3' THEN SUM(a.rp_gross) * $dollar ELSE SUM(a.rp_gross) END premi,
                            CASE WHEN d.kdjeniscb = 'X' THEN 
                                    CASE WHEN b.kdvaluta = '3' THEN SUM(a.rp_gross) * $dollar ELSE SUM(a.rp_gross) END * c.faktorpremix / c.faktorpembagix
                                WHEN d.kdjeniscb = 'B' THEN
                                    CASE WHEN b.kdvaluta = '3' THEN SUM(a.rp_gross) * $dollar ELSE SUM(a.rp_gross) END * c.faktorpremib / c.faktorpembagib
                            END poin 
                        FROM tabel_ul_transaksi@jlindo a
                        INNER JOIN tabel_200_pertanggungan@jlindo b ON a.nomor_polis = b.prefixpertanggungan || b.nopertanggungan 
                        INNER JOIN tabel_421_poin_agen@jlindo c ON b.kdproduk = c.kdproduk
                        INNER JOIN tabel_305_cara_bayar@jlindo d ON b.kdcarabayar = d.kdcarabayar
                        INNER JOIN tabel_500_penagih@jlindo e ON b.nopenagih = e.nopenagih
                        WHERE a.trx_type IN ('S', 'T')
                            AND LOWER(description) NOT LIKE '%sekaligus%'
                            AND trx_date BETWEEN TO_DATE('$tglawal','dd/mm/yyyy') AND TO_DATE('30/06/2018', 'dd/mm/yyyy')
                            /*AND b.taltup <> '1'*/
                            AND b.kdstatusfile NOT IN ('7', 'X', '5')
                            AND c.status = '1'
                            AND (c.kdproduk, c.tglberlaku) IN (
                                SELECT kdproduk, MAX(tglberlaku)
                                FROM tabel_421_poin_agen@jlindo
                                WHERE tglberlaku <= TO_DATE('30/06/2018', 'dd/mm/yyyy')
                                GROUP BY kdproduk
                            )
			    AND ADD_MONTHS(b.mulas, 12) > a.tgl_booked
                            AND b.noagen = '$iduser'
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
                        FROM tabel_300_historis_premi@jlindo a
                        INNER JOIN tabel_200_pertanggungan@jlindo b ON a.prefixpertanggungan = b.prefixpertanggungan
                            AND a.nopertanggungan = b.nopertanggungan
                        INNER JOIN tabel_421_poin_agen@jlindo c ON b.kdproduk = c.kdproduk
                        INNER JOIN tabel_305_cara_bayar@jlindo d ON b.kdcarabayar = d.kdcarabayar
                        INNER JOIN tabel_500_penagih@jlindo e ON b.nopenagih = e.nopenagih
                        WHERE a.kdkuitansi IN ('BP3', 'NB1')
                            AND a.tglseatled IS NOT NULL
                            AND tglbooked BETWEEN TO_DATE('01/07/2018','dd/mm/yyyy') AND TO_DATE('$tglakhir', 'dd/mm/yyyy')
                            AND b.taltup <> '1'
                            AND b.kdstatusfile IN ('1')
                            AND c.status = '1'
                            AND SUBSTR(b.kdproduk, 0, 2) != 'JL'
                            AND (c.kdproduk, c.tglberlaku) IN (
                                SELECT kdproduk, MAX(tglberlaku)
                                FROM tabel_421_poin_agen@jlindo
                                WHERE tglberlaku >= TO_DATE('01/07/2018', 'dd/mm/yyyy')
                                GROUP BY kdproduk
                             )
                            AND b.noagen = '$iduser'

                        UNION ALL

                        SELECT noagen, b.prefixpertanggungan, b.nopertanggungan,
                            CASE WHEN b.kdvaluta = '3' THEN SUM(a.rp_gross) * $dollar ELSE SUM(a.rp_gross) END premi,
                            CASE WHEN d.kdjeniscb = 'X' THEN 
                                    CASE WHEN b.kdvaluta = '3' THEN SUM(a.rp_gross) * $dollar ELSE SUM(a.rp_gross) END * c.faktorpremix / c.faktorpembagix
                                WHEN d.kdjeniscb = 'B' THEN
                                    CASE WHEN b.kdvaluta = '3' THEN SUM(a.rp_gross) * $dollar ELSE SUM(a.rp_gross) END * c.faktorpremib / c.faktorpembagib
                            END poin 
                        FROM tabel_ul_transaksi@jlindo a
                        INNER JOIN tabel_200_pertanggungan@jlindo b ON a.nomor_polis = b.prefixpertanggungan || b.nopertanggungan 
                        INNER JOIN tabel_421_poin_agen@jlindo c ON b.kdproduk = c.kdproduk
                        INNER JOIN tabel_305_cara_bayar@jlindo d ON b.kdcarabayar = d.kdcarabayar
                        INNER JOIN tabel_500_penagih@jlindo e ON b.nopenagih = e.nopenagih
                        WHERE a.trx_type IN ('S', 'T')
                            AND LOWER(description) NOT LIKE '%sekaligus%'
                            AND trx_date BETWEEN TO_DATE('01/07/2018','dd/mm/yyyy') AND TO_DATE('$tglakhir', 'dd/mm/yyyy')
                            AND b.taltup <> '1'
                            AND b.kdstatusfile IN ('1')
                            AND c.status = '1'
                            AND (c.kdproduk, c.tglberlaku) IN (
                                SELECT kdproduk, MAX(tglberlaku)
                                FROM tabel_421_poin_agen@jlindo
                                WHERE tglberlaku >= TO_DATE('01/07/2018', 'dd/mm/yyyy')
                                GROUP BY kdproduk
                             )
			    AND ADD_MONTHS(b.mulas, 12) > a.tgl_booked
                            AND b.noagen = '$iduser'
                        GROUP BY noagen, b.prefixpertanggungan, b.nopertanggungan, b.kdvaluta, d.kdjeniscb,
                            c.faktorpremix, c.faktorpembagix, c.faktorpremib, c.faktorpembagib
                    ) a
                    INNER JOIN tabel_400_agen@jlindo b ON a.noagen = b.noagen
                    INNER JOIN tabel_100_klien@jlindo c ON a.noagen = c.noklien
                    INNER JOIN tabel_413_jabatan_agen@jlindo d ON b.kdjabatanagen = d.kdjabatanagen
                    LEFT OUTER JOIN (
                        SELECT noagen, MAX(tglpkajagen) tglpkajagen
                        FROM tabel_400_pkaj_agen@jlindo
                        GROUP BY noagen
                    ) e ON a.noagen = e.noagen
                    GROUP BY a.noagen, b.kdkantor, c.namaklien1, b.kdjabatanagen, d.namajabatanagen, e.tglpkajagen, b.nolisensiagen, 
                        b.tglakhirlisensi
                    ORDER BY jmlpoin DESC");

        if ($q->num_rows() > 0)
            $result = $q->row_array();
        
        $q->free_result();
        
        return $result;
    }
    

    /*===== update tabel user  for session info=====*/
    function update_user_info($avatar) {
        try {
            $useragent = $this->session->userdata('USERAGENT');
            $ipaddress = $this->session->userdata('IPADDRESS');
            $sessionid = $this->session->userdata('SESSIONID');
            $iduser = $this->session->userdata('IDUSER');

            $this->db
                ->query("UPDATE JAIM_900_USER SET USERAGENT = '$useragent',
                             IPADDRESS = '$ipaddress',
                             SESSIONID = '$sessionid',
                             LASTACTIVITY = SYSDATE,
                             AVATAR = '$avatar'
                         WHERE IDUSER = $iduser");
        }
        catch (Exception $e) {

        }
    }


    /*===== update password user =====*/
    function update_password($newpassword) {
        $sukses = 0;

        $this->db->trans_begin();

        $this->db
            ->query("UPDATE JAIM_900_USER SET
                         PASSWORD = '$newpassword'
                     WHERE USERNAME = '".$this->session->USERNAME."'");

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        }
        else {
            $sukses = $this->db->trans_commit();
        }

        return ($sukses ? C_STATUS_SUKSES_SIMPAN : C_STATUS_GAGAL_SIMPAN);
    }
	
	
    /*===== cek user role menu =====*/
    function check_user_role_menu($kd_menu) {
        $jml = 0;

        $q = $this->db
            ->from("JAIM_904_ROLE_MENU")
            ->where("KDROLE", $this->session->KDROLE)
            ->where("STATUS", 1)
            ->where("KDMENU", "'$kd_menu'")
            ->get();

        $jml = $q->num_rows();

        $q->free_result();

        return $jml;
    }
}