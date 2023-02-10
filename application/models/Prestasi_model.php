<?php

class Prestasi_model extends CI_Model {
    
    /*===== get daftar top premi kantor by id =====*/
    function get_list_top_premi($kdkantor, $kdinduk = '') {
        $data = array();
        $fkdkantor = !empty($kdkantor) ? "AND a.kdkantor = '$kdkantor'" : null;
        $fkdinduk = !empty($kdinduk) ? "AND d.kdkantorinduk = '$kdinduk'" : null;
        
        $q = $this->db
           ->query("SELECT a.NOAGEN, c.NAMAKLIEN1, COUNT(b.NOPERTANGGUNGAN) JMLPOLIS, 
                        SUM(NVL(NILAIRP, PREMITAGIHAN)) JMLPREMI, a.KDKANTOR, d.NAMAKANTOR
                    FROM tabel_400_agen@jlindo a
                    INNER JOIN tabel_200_pertanggungan@jlindo b ON a.NOAGEN = b.NOAGEN
                    INNER JOIN tabel_100_klien@jlindo c ON a.NOAGEN = c.NOKLIEN
                    INNER JOIN tabel_001_kantor@jlindo d ON a.KDKANTOR = d.KDKANTOR
                    INNER JOIN tabel_300_historis_premi@jlindo e ON b.PREFIXPERTANGGUNGAN = e.PREFIXPERTANGGUNGAN
                        AND b.NOPERTANGGUNGAN = e.NOPERTANGGUNGAN
                        AND kdkuitansi IN ('BP3','NB1')
                    WHERE TO_CHAR(e.TGLSEATLED,'yyyy') = TO_CHAR(sysdate,'yyyy')
                        AND kdproduk NOT IN ('PAA','PAB','AKM')
                        AND kdpertanggungan = '2'
                        AND KDSTATUSFILE IN ('1', '4', '5', '6', '8')
                        AND B.NOPOLBARU IS NOT NULL
                        $fkdkantor
                        $fkdinduk
                    GROUP BY a.NOAGEN, c.NAMAKLIEN1, NOAGENREKR, a.KDKANTOR, d.NAMAKANTOR
                    ORDER BY JMLPREMI DESC, JMLPOLIS DESC");
        
        if ($q->num_rows() > 0)
            $data = $q->result_array();

        $q->free_result();

        return $data;
    }

     # Created Ismi
    /*===== get daftar top polis kantor by id =====*/

    function get_list_top_polis($idUser)
    {
        $data = array();

        $q = $this->db
               ->query("SELECT a.NOAGEN, c.NAMAKLIEN1, COUNT(NOPERTANGGUNGAN) JMLPOLIS, 
                       SUM(PREMI1) JMLPREMI, a.KDKANTOR, d.NAMAKANTOR
                   FROM TABEL_400_AGEN@jlindo a
                   INNER JOIN TABEL_200_PERTANGGUNGAN@jlindo b ON a.NOAGEN = b.NOAGEN
                   INNER JOIN TABEL_100_KLIEN@jlindo c ON a.NOAGEN = c.NOKLIEN
                   INNER JOIN TABEL_001_KANTOR@jlindo d ON a.KDKANTOR = d.KDKANTOR
                   WHERE KDPERTANGGUNGAN = 2 
                       AND TO_CHAR(MULAS, 'YYYY') = TO_CHAR(SYSDATE, 'YYYY') 
                       --AND KDSTATUSFILE = '1'
                       AND KDSTATUSFILE NOT IN ('X','C')
                       AND KDSTATUSAGEN = '01'
                       --AND (a.atasan = '$idUser' or a.noagen = '$idUser')
                       AND a.noagen IN (select '$idUser' noagen from dual
                                        union ALL
                                        SELECT noagen FROM TABEL_400_AGEN@jlindo
                                                        WHERE kdstatusagen = '01'
                                                        AND KDJABATANAGEN IN ('25','26','24')
                                                        START WITH atasan = '$idUser'
                                                        CONNECT BY PRIOR noagen = atasan)
                       
                   GROUP BY a.NOAGEN, c.NAMAKLIEN1, NOAGENREKR, a.KDKANTOR, d.NAMAKANTOR
                   ORDER BY JMLPOLIS DESC, JMLPREMI DESC");
                   //echo $this->db->last_query();

        if ($q->num_rows() > 0)
                $data = $q->result_array();
    
            $q->free_result();
    
            return $data;            
    }

    function get_list_top_polis_super()
    {
        $data = array();

        $q = $this->db
               ->query(" SELECT a.NOAGEN, c.NAMAKLIEN1, COUNT(NOPERTANGGUNGAN) JMLPOLIS, 
               SUM(PREMI1) JMLPREMI, a.KDKANTOR, d.NAMAKANTOR
           FROM TABEL_400_AGEN@jlindo a
           INNER JOIN TABEL_200_PERTANGGUNGAN@jlindo b ON a.NOAGEN = b.NOAGEN
           INNER JOIN TABEL_100_KLIEN@jlindo c ON a.NOAGEN = c.NOKLIEN
           INNER JOIN TABEL_001_KANTOR@jlindo d ON a.KDKANTOR = d.KDKANTOR
           WHERE KDPERTANGGUNGAN = 2 
	       AND KDPRODUK NOT IN ('IFGETRIP')
               AND TO_CHAR(MULAS, 'YYYY') = TO_CHAR(SYSDATE, 'YYYY') 
               --AND KDSTATUSFILE = '1'
               AND KDSTATUSFILE NOT IN ('X','C')
               AND KDSTATUSAGEN = '01'
               AND KDJABATANAGEN IN ('25','26','24')
           GROUP BY a.NOAGEN, c.NAMAKLIEN1, NOAGENREKR, a.KDKANTOR, d.NAMAKANTOR
           ORDER BY JMLPOLIS DESC, JMLPREMI DESC");

        if ($q->num_rows() > 0)
                $data = $q->result_array();
    
            $q->free_result();
    
            return $data;            
    }

    # Created Ismi
    /*===== get daftar top rekrut kantor by id =====*/
    function get_list_top_rekrut($idUser)
    {
        $data = array();
        
        $q = $this->db
           ->query("SELECT *
           FROM (  SELECT noagen,
                          namakantor,
                          NAMAKLIEN1,
                          (SELECT COUNT (noagen)
                             FROM tabel_400_agen@jlindo
                            WHERE     noagenrekr = x.noagen
                                  AND TO_CHAR (tglrekam, 'yyyy') =
                                      TO_CHAR (SYSDATE, 'yyyy')
					and kdjabatanagen = '24')    jmlrekrut
                     FROM ((SELECT noagen,
                                   (SELECT namakantor
                                      FROM tabel_001_kantor@jlindo
                                     WHERE kdkantor = a.kdkantor)    namakantor,
                                   (SELECT namaklien1
                                      FROM tabel_100_klien@jlindo
                                     WHERE noklien = a.noagen)       NAMAKLIEN1
                              FROM TABEL_400_AGEN@jlindo a
                             WHERE kdstatusagen = '01' AND noagen = '$idUser'
                            UNION ALL
                                SELECT noagen,
                                       (SELECT namakantor
                                          FROM tabel_001_kantor@jlindo
                                         WHERE kdkantor = a.kdkantor)    namakantor,
                                       (SELECT namaklien1
                                          FROM tabel_100_klien@jlindo
                                         WHERE noklien = a.noagen)       namaagen
                                  FROM TABEL_400_AGEN@jlindo a
                                 WHERE     kdstatusagen = '01'
                                       AND KDJABATANAGEN IN ('25', '26', '24')
                            START WITH atasan = '$idUser'
                            CONNECT BY PRIOR noagen = atasan)) x
                 GROUP BY x.noagen, namakantor, NAMAKLIEN1
                 ORDER BY jmlrekrut DESC) b
          WHERE b.jmlrekrut > 0");
            //echo $this->db->last_query();
        
        if ($q->num_rows() > 0)
            $data = $q->result_array();

        $q->free_result();

        return $data;
    }

    function get_list_top_rekrut_super()
    {
        $data = array();
        
        $q = $this->db->query("SELECT *
        FROM (  SELECT noagen,
                       namakantor,
                       NAMAKLIEN1,
                       (SELECT COUNT (noagen)
                          FROM tabel_400_agen@jlindo
                         WHERE noagenrekr = x.noagen
                               AND TO_CHAR (tglrekam, 'yyyy') =
                                      TO_CHAR (SYSDATE, 'yyyy') and kdjabatanagen = '24' and kdstatusagen = '01')
                          jmlrekrut
                  FROM ( (SELECT noagen,
                                 (SELECT namakantor
                                    FROM tabel_001_kantor@jlindo
                                   WHERE kdkantor = a.kdkantor)
                                    namakantor,
                                 (SELECT namaklien1
                                    FROM tabel_100_klien@jlindo
                                   WHERE noklien = a.noagen)
                                    NAMAKLIEN1
                            FROM TABEL_400_AGEN@jlindo a
                           WHERE kdstatusagen = '01' 
                                 AND KDJABATANAGEN IN ('25', '26', '24'))) x
              GROUP BY x.noagen, namakantor, NAMAKLIEN1
              ORDER BY jmlrekrut DESC) b
       WHERE b.jmlrekrut > 0");

        if ($q->num_rows() > 0)
            $data = $q->result_array();

        $q->free_result();

        return $data;
    }

    
    # Created Ismi
    /*===== get daftar top APE SESSION_USER =====*/
    function get_list_top_ape($idUser)
    {
        $data = array();
        
        $q = $this->db
           ->query("SELECT sum(total_premi) as total_premi, 
                    NOAGEN, 
                    NAMAKLIEN1, 
                    NAMAKANTOR from (
                    select (CASE 
                        WHEN KDCARABAYAR IN ('1','M') THEN premi1 * 12
                        WHEN KDCARABAYAR IN ('2','Q') THEN premi1 * 4
                        WHEN KDCARABAYAR IN ('3','H') THEN premi1 * 2
			WHEN KDCARABAYAR IN ('X') THEN premi1 * 0.1
                        ELSE premi1
                  END) as total_premi, NOAGEN, NAMAKLIEN1, NAMAKANTOR, kdcarabayar
                    from 
                    (select premi1, a.NOAGEN, c.NAMAKLIEN1, d.NAMAKANTOR, kdcarabayar
                    from tabel_200_pertanggungan@jlindo a
                    INNER JOIN TABEL_400_AGEN@jlindo b ON a.NOAGEN = b.NOAGEN
                    INNER JOIN TABEL_100_KLIEN@jlindo c ON a.NOAGEN = c.NOKLIEN
                    INNER JOIN TABEL_001_KANTOR@jlindo d ON b.KDKANTOR = d.KDKANTOR
                    where kdpertanggungan = '2'
                    AND TO_CHAR (MULAS, 'YYYY') = TO_CHAR (SYSDATE, 'YYYY')
                    --AND KDSTATUSFILE IN ('1')
                    AND KDSTATUSFILE NOT IN ('X','C')
                    --AND (b.atasan = '0000040209' or b.noagen = '0000040209')
                    AND b.noagen  IN (select '$idUser' noagen from dual
                                    union ALL
                                    SELECT noagen FROM TABEL_400_AGEN@jlindo
                                                    WHERE kdstatusagen = '01'
                                                    AND KDJABATANAGEN IN ('25','26','24')
                                                    START WITH atasan = '$idUser'
                                                    CONNECT BY PRIOR noagen = atasan)                         
                    )x
                    )b
                    group by NOAGEN, NAMAKLIEN1, 
                    NAMAKANTOR
                    ORDER BY TOTAL_PREMI DESC");

        
        if ($q->num_rows() > 0)
            $data = $q->result_array();
        
        $q->free_result();
        
        return $data;
    }

    function get_list_top_ape_super()
    {
        $data = array();
        
        $q = $this->db->query("SELECT sum(total_premi) as total_premi, 
                    NOAGEN, 
                    NAMAKLIEN1, 
                    NAMAKANTOR from (
                    select (CASE 
                        WHEN KDCARABAYAR IN ('1','M') THEN premi1 * 12
                        WHEN KDCARABAYAR IN ('2','Q') THEN premi1 * 4
                        WHEN KDCARABAYAR IN ('3','H') THEN premi1 * 2
			WHEN KDCARABAYAR IN ('X') THEN premi1 * 0.1
                        ELSE premi1 
                  END) as total_premi, NOAGEN, NAMAKLIEN1, NAMAKANTOR, kdcarabayar
                    from 
                    (select premi1, a.NOAGEN, c.NAMAKLIEN1, d.NAMAKANTOR, kdcarabayar
                    from tabel_200_pertanggungan@jlindo a
                    INNER JOIN TABEL_400_AGEN@jlindo b ON a.NOAGEN = b.NOAGEN
                    INNER JOIN TABEL_100_KLIEN@jlindo c ON a.NOAGEN = c.NOKLIEN
                    INNER JOIN TABEL_001_KANTOR@jlindo d ON b.KDKANTOR = d.KDKANTOR
                    where kdpertanggungan = '2'
		    AND KDPRODUK NOT IN ('IFGETRIP')
		    and kdstatusagen = '01'
                                AND B.KDJABATANAGEN IN ('25', '26', '24')
                                    AND TO_CHAR (MULAS, 'YYYY') =
                                            TO_CHAR (SYSDATE, 'YYYY')
                                    AND KDSTATUSFILE NOT IN ('X','C')
                                    ) X) B
            GROUP BY NOAGEN, NAMAKLIEN1, NAMAKANTOR
            ORDER BY TOTAL_PREMI DESC");

        
        if ($q->num_rows() > 0) {
            $data = $q->result_array();
        
        $q->free_result();
        }
        return $data;
    }
}