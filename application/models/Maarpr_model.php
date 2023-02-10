<?php

class Maarpr_model extends CI_Model {

    function get_struktur_agen($kantor){
      $sql = "
              SELECT A.*, C.NAMAKLIEN1 AS NAMAAGEN, B.NAMAJABATANAGEN 
              FROM TABEL_400_AGEN@jlindo A, 
                   tabel_413_jabatan_agen@jlindo B,
                   tabel_100_klien@jlindo C
              WHERE A.KDKANTOR = '$kantor' 
                    AND KDSTATUSAGEN = '01'
                    AND A.noagen = C.noklien 
                    AND A.kdjabatanagen = B.kdjabatanagen
                    AND A.KDJABATANAGEN IN ('09','00','02','05','19')
             ";
       $query = $this->db->query($sql);

        if ($query->num_rows() > 0)
            $data = $query->result_array();

        $query->free_result();

        return $data;
    }
    function get_maarmaapr_agen($data) {
        $result = array();

        $sql = "
                SELECT ROUND( (ATAS.AGENAKTIF / BAWAH.TOTAGEN) * 100, 2) AS MAAR,
                     ROUND( DECODE(ATAS.AGENAKTIF,0,0,(ATAS.TOTPOLIS / ATAS.AGENAKTIF)) * 100, 2) AS MAAPR
                FROM
                  (
                      SELECT org.AGENAKTIF + pribadi.AGENAKTIF AS AGENAKTIF,
                             org.TOTPOLIS + pribadi.TOTPOLIS AS TOTPOLIS
                      FROM
                      (SELECT COUNT(DISTINCT(A.NOAGEN)) AS AGENAKTIF, COUNT(B.NOPERTANGGUNGAN) AS TOTPOLIS
                      FROM TABEL_400_AGEN@jlindo A, TABEL_200_PERTANGGUNGAN@jlindo B
                      WHERE A.NOAGEN IN( (SELECT   NOAGEN
                                           FROM   TABEL_400_AGEN@jlindo 
                                           WHERE      KDSTATUSAGEN = '01'
                                                  AND KDKANTOR = '".$data['KANTOR']."' 
                                         START WITH   ATASAN = '".$data['NOAGEN']."'
                                         CONNECT BY   PRIOR NOAGEN = ATASAN)
                                       )
                            AND B.NOAGEN = A.NOAGEN
                            AND TO_CHAR(B.MULAS,'MMYYYY') = '".$data['BULAN'].$data['TAHUN']."'
                            AND A.KDSTATUSAGEN = '01'
                      )org,
                      (SELECT COUNT(A.NOAGEN) AS AGENAKTIF, COUNT(B.NOPERTANGGUNGAN) AS TOTPOLIS
                      FROM TABEL_400_AGEN@jlindo A, TABEL_200_PERTANGGUNGAN@jlindo B
                      WHERE A.NOAGEN = '".$data['NOAGEN']."'
                            AND B.NOAGEN = A.NOAGEN
                            AND TO_CHAR(B.MULAS,'MMYYYY') = '".$data['BULAN'].$data['TAHUN']."'
                            AND A.KDSTATUSAGEN = '01'
                      )pribadi
                  )ATAS,
                  (
                      SELECT COUNT(A.NOAGEN)+1 AS TOTAGEN
                      FROM TABEL_400_AGEN@jlindo A
                      WHERE A.NOAGEN IN( (SELECT   NOAGEN
                                           FROM   TABEL_400_AGEN@jlindo 
                                           WHERE      KDSTATUSAGEN = '01'
                                                  AND KDKANTOR = '".$data['KANTOR']."' 
                                         START WITH   ATASAN = '".$data['NOAGEN']."'
                                         CONNECT BY   PRIOR NOAGEN = ATASAN)
                                       )
                            AND A.KDSTATUSAGEN = '01'
                  )BAWAH ";
        
        //echo $sql;

        $query = $this->db->query($sql);

        foreach ($query->result() as $city) {
          $result = $city;
        }

        return $result;
    }
    function realisasiPribadi($data){
      $result = '';
      $sql = " SELECT NOPERTANGGUNGAN, MULAS,
                (SELECT NAMAPRODUK FROM TABEL_202_PRODUK@jlindo WHERE KDPRODUK = B.KDPRODUK) AS NAMAPRODUK,
                (SELECT NAMACARABAYAR FROM TABEL_305_CARA_BAYAR@jlindo WHERE KDCARABAYAR = B.KDCARABAYAR) AS CARABAYAR,
                B.PREMI1 as PREMI,
                A.NOAGEN
                FROM TABEL_400_AGEN@jlindo A, TABEL_200_PERTANGGUNGAN@jlindo B
                WHERE A.NOAGEN = '".$data['NOAGEN']."'
                      AND B.NOAGEN = A.NOAGEN
                      AND TO_CHAR(B.MULAS,'MMYYYY') = '".$data['BULAN'].$data['TAHUN']."'
                      AND A.KDSTATUSAGEN = '01'
                ORDER BY MULAS ";

      $query = $this->db->query($sql);

      if ($query->num_rows() > 0)
          $result = $query->result_array();

      $query->free_result();

      return $result;
    }
    function realisasiOrganisasi($data){
      $result = '';
      $sql = " SELECT NOPERTANGGUNGAN, MULAS,
              (SELECT NAMAPRODUK FROM TABEL_202_PRODUK@jlindo WHERE KDPRODUK = B.KDPRODUK) AS NAMAPRODUK,
              (SELECT NAMACARABAYAR FROM TABEL_305_CARA_BAYAR@jlindo WHERE KDCARABAYAR = B.KDCARABAYAR) AS CARABAYAR,
              B.PREMI1 AS PREMI,
              A.NOAGEN
              FROM TABEL_400_AGEN@jlindo A, TABEL_200_PERTANGGUNGAN@jlindo B
              WHERE A.NOAGEN IN( (SELECT   NOAGEN
                       FROM   TABEL_400_AGEN@jlindo 
                       WHERE    KDSTATUSAGEN = '01'
                            AND KDKANTOR = '".$data['KANTOR']."' 
                      START WITH   ATASAN = '".$data['NOAGEN']."'
                      CONNECT BY   PRIOR NOAGEN = ATASAN)
                   )
                    AND B.NOAGEN = A.NOAGEN
                    AND TO_CHAR(B.MULAS,'MMYYYY') = '".$data['BULAN'].$data['TAHUN']."'
                    AND A.KDSTATUSAGEN = '01'
              ORDER BY A.NOAGEN
            ";

      $query = $this->db->query($sql);

      if ($query->num_rows() > 0)
          $result = $query->result_array();

      $query->free_result();

      return $result;
    }
}

?>