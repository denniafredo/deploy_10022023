<?php

class Pkaj_model extends CI_Model {


    /*===== get daftar pkaj online =====*/
    function get_list_pkajonline($filter) {
        $data = array();

        $q = $this->db
            ->query("SELECT * FROM
            (
                SELECT tbl.*, rownum no
                FROM
                (
                    SELECT a.noagen, a.nopkajagen, a.epkaj, a.tglpkajagen, a.tglpkaj, a.dsp, a.kdkantor, b.kdjabatanagen
                    FROM (
                        SELECT a.noagen, a.nopkajagen, b.nopkajagen epkaj, TO_CHAR(a.tglpkajagen, 'dd/mm/yyyy') tglpkajagen,
                            TO_CHAR(a.tglpkajagen, 'mmyyyy') tglpkaj,
                            CASE WHEN TO_CHAR(a.tglpkajagen, 'yyyy') < 2015 THEN 'none' ELSE '' END dsp,
                            a.kdkantor, MAX(c.tgljabatan) tgljabatan
                        FROM jsadm.tabel_400_pkaj_agen@jlindo a
                        LEFT OUTER JOIN tabel_400_epkaj_agen b ON a.nopkajagen = b.nopkajagen
                            AND a.noagen = b.noagen
                        LEFT OUTER JOIN jsadm.tabel_417_histori_jabatan@jlindo c ON a.noagen = c.noagen
                            AND a.nopkajagen = c.nopkajagen
                        WHERE a.noagen = '$filter[NOAGEN]'
                        GROUP BY a.noagen, a.nopkajagen, b.nopkajagen, a.tglpkajagen, a.kdkantor
                    ) a
                    LEFT OUTER JOIN jsadm.tabel_417_histori_jabatan@jlindo b ON a.noagen = b.noagen
                        AND a.nopkajagen = b.nopkajagen
                        AND a.tgljabatan = b.tgljabatan
                ) tbl
                WHERE rownum < ((".$filter['p']." * ".C_ROWS_PAGINATION.") + 1 )
            )
            WHERE no >= (((".$filter['p']."-1) * ".C_ROWS_PAGINATION.") + 1)");

        if ($q->num_rows() > 0)
            $data = $q->result_array();

        $q->free_result();

        return $data;
    } 


    function sendOtp($kdkantor, $nopkaj, $notlp, $message, $nmagen)
    {   

        /* old query OTP
          $otherdb = $this->load->database('smsjiwasraya', TRUE); // the TRUE paramater tells CI that you'd like to return the database object.
          $sql = "INSERT INTO smsjiwasraya(PHONE, MESSAGE, JENIS_SMS, KODE_KANTOR, NO_POLIS) VALUES ('$notlp', '$new_otp', 'EPKAJ', '$kdkantor', $nopkaj) ";
          $res = $otherdb->query($sql);
        */

        // $msg = urlencode($message);
        $sql = "INSERT INTO OTP_EPKAJ(KD_KANTOR, NO_EPKAJ, NO_TLP, JENIS_OTP, MESSAGE, USER_RECORD, TGL_RECORD) VALUES ('$kdkantor', '$nopkaj', '$notlp', 'EPKAJ', '$message', '$nmagen', SYSDATE) ";

        $res = $this->db->query($sql);
        if($res){
            $q = "SELECT   *
                  FROM   (SELECT   a.*, MAX (TGL_RECORD) OVER () AS max_created
                            FROM   OTP_EPKAJ a)
                 WHERE   TGL_RECORD = max_created AND KD_KANTOR = '$kdkantor' AND NO_EPKAJ = '$nopkaj' ";

            $query = $this->db->query($q);
            $result = $query->result();

            foreach ($result as $key => $val) {
              # code...
              $NO_TLP  = trim($val->NO_TLP);
              $MESSAGE   = $val->MESSAGE ;

              file_get_contents(C_URL_API_OTP."/otp.sms.php?nohp=".rawurlencode($NO_TLP)."&msg=".rawurlencode($MESSAGE)."&user=".rawurlencode(C_USER_OTP)."&pin=".rawurlencode(C_PASS_OTP), true);

              return true;
            }
        }else{
            return false;
        }
    }


    function get_sendOtp($notlp,$kdkantor, $nopkaj)
    {   

        /* old query OTP
          $otherdb = $this->load->database('smsjiwasraya', TRUE);
          $sql = "SELECT SUBSTRING(MESSAGE, -4) AS MESSAGE FROM smsjiwasraya WHERE JENIS_SMS = 'EPKAJ' AND PHONE = '$notlp' AND KODE_KANTOR = '$kdkantor' AND NO_POLIS = '$nopkaj' ORDER BY id DESC LIMIT 1";
          $row = array();
          $query = $otherdb->query($sql);
          if($query->num_rows() > 0){
              foreach ($query->result() as $otp) {
                  $row = $otp;
              }
          }
        */
        
        $q = "SELECT   SUBSTR(MESSAGE, -4) AS MESSAGE
              FROM   (SELECT   a.*, MAX (TGL_RECORD) OVER () AS max_created
                        FROM   OTP_EPKAJ a)
             WHERE   TGL_RECORD = max_created AND KD_KANTOR = '$kdkantor' AND NO_EPKAJ = '$nopkaj' AND NO_TLP = '$notlp' ";

        $row = array();
        $query = $this->db->query($q);

        if($query->num_rows() > 0){
              foreach ($query->result() as $otp) {
                  $row = $otp;
              }
          }

        return($row);
    }


    /*===== get total rows pkaj online =====*/
    function get_total_pkajonline($filter) {
        $rows = 0;

        $q = $this->db
            ->query("
                    SELECT a.noagen, a.nopkajagen, a.epkaj, a.tglpkajagen, a.tglpkaj, a.dsp, a.kdkantor, b.kdjabatanagen
                    FROM (
                        SELECT a.noagen, a.nopkajagen, b.nopkajagen epkaj, TO_CHAR(a.tglpkajagen, 'dd/mm/yyyy') tglpkajagen,
                            TO_CHAR(a.tglpkajagen, 'mmyyyy') tglpkaj,
                            CASE WHEN TO_CHAR(a.tglpkajagen, 'yyyy') < 2015 THEN 'none' ELSE '' END dsp,
                            a.kdkantor, MAX(c.tgljabatan) tgljabatan
                        FROM jsadm.tabel_400_pkaj_agen@jlindo a
                        LEFT OUTER JOIN tabel_400_epkaj_agen b ON a.nopkajagen = b.nopkajagen
                            AND a.noagen = b.noagen
                        LEFT OUTER JOIN jsadm.tabel_417_histori_jabatan@jlindo c ON a.noagen = c.noagen
                            AND a.nopkajagen = c.nopkajagen
                        WHERE a.noagen = '$filter'
                        GROUP BY a.noagen, a.nopkajagen, b.nopkajagen, a.tglpkajagen, a.kdkantor
                    ) a
                    LEFT OUTER JOIN jsadm.tabel_417_histori_jabatan@jlindo b ON a.noagen = b.noagen
                        AND a.nopkajagen = b.nopkajagen
                        AND a.tgljabatan = b.tgljabatan");

        $rows = $q->num_rows();

        return $rows;
    }


    /*===== get daftar pkaj online =====*/
    function cek_pkajonline($noagen, $nopkaj) {
        $data = array();

        $q = $this->db
            ->query("
                SELECT a.noagen, a.nopkajagen, a.tglpkajagen, a.tglpkaj, a.kdkantor, b.kdjabatanagen
                FROM (
                    SELECT a.noagen, a.nopkajagen, TO_CHAR (a.tglpkajagen, 'dd/mm/yyyy') tglpkajagen,
                        TO_CHAR (tglpkajagen, 'mmyyyy') tglpkaj, a.kdkantor, MAX(b.tgljabatan) tgljabatan
                    FROM jsadm.tabel_400_pkaj_agen@jlindo a
                    LEFT OUTER JOIN jsadm.tabel_417_histori_jabatan@jlindo b ON a.noagen = b.noagen
                        AND a.nopkajagen = b.nopkajagen
                    WHERE a.noagen = '$noagen'
                        AND a.nopkajagen = '$nopkaj'
                    GROUP BY a.noagen, a.nopkajagen, a.tglpkajagen, a.kdkantor
                ) a
                LEFT OUTER JOIN jsadm.tabel_417_histori_jabatan@jlindo b ON a.noagen = b.noagen
                    AND a.nopkajagen = b.nopkajagen
                    AND a.tgljabatan = b.tgljabatan");

        if ($q->num_rows() > 0)
            $data = $q->result_array();

        $q->free_result();

        return $data;
    }
    

    /*===== get daftar pkaj online =====*/
    function data_pkajonline($filter) {
        $data = array();

        $q = $this->db
            ->query("  SELECT  a.NOPKAJAGEN,
                               a.KDKANTOR,
                               a.NOAGENBM,
                               NAMABM,
                               a.NOAGEN NOAGEN,
                               JABATANBM,
                               NIPBM,
                               ALAMATKTR,
                               TELPONKTR,
                               FAXKTR,
                               a.noagen,
                               nomoridagen,
                               alamatagen,
                               notelponagen,
                               saksi1,
                               saksi2,
                               jabatansaksi1,
                               jabatansaksi2,
                               NAMAKLIEN1,
                               TO_CHAR (TGLPKAJAGEN, 'DD') TGL,
                               TO_CHAR (TGLPKAJAGEN, 'MM') BLN,
                               TO_CHAR (TGLPKAJAGEN, 'YYYY') THN,
                               tempatlahir,
                               TO_CHAR (tgllahir, 'DD/MM/YYYY') tgllahir,
                               DECODE (jeniskelamin, 'L', 'LAKI-LAKI', 'PEREMPUAN') jeniskelamin,
                               a.nopkajagen,
                               c.KDJABATANAGEN,
                               c.STATUS_JOIN_TEAM,
                               TO_CHAR (TGLPKAJAGEN, 'DD/MM/YYYY') TGLPKAJAGEN
                        FROM   jsadm.tabel_400_pkaj_agen@jlindo a, jsadm.tabel_100_klien@jlindo b, jsadm.tabel_400_agen@jlindo c
                       WHERE       a.noagen = '$filter[NOAGEN]'
                               AND c.noagen = '$filter[NOAGEN]'
                               AND TO_CHAR (TGLPKAJAGEN, 'DD/MM/YYYY') = '$filter[TGLPKAJAGEN]'
                               AND a.noagen = b.noklien
                    ORDER BY   TGLPKAJAGEN DESC ");

        if ($q->num_rows() > 0)
            $data = $q->result_array();

        $q->free_result();

        return $data;
    }


    /*===== get daftar pkaj online =====*/
    function data_pkaj($filter) {
        $data = array();

        $q = $this->db
            ->query("  SELECT  NOPKAJAGEN,
                               KDKANTOR,
                               NOAGENBM,
                               NAMABM,
                               a.NOAGEN NOAGEN,
                               JABATANBM,
                               NIPBM,
                               ALAMATKTR,
                               TELPONKTR,
                               FAXKTR,
                               noagen,
                               nomoridagen,
                               alamatagen,
                               notelponagen,
                               NAMAKLIEN1,
                               TO_CHAR (TGLPKAJAGEN, 'DD') TGL,
                               TO_CHAR (TGLPKAJAGEN, 'MM') BLN,
                               TO_CHAR (TGLPKAJAGEN, 'YYYY') THN,
                               tempatlahir,
                               TO_CHAR (tgllahir, 'DD/MM/YYYY') tgllahir,
                               DECODE (jeniskelamin, 'L', 'LAKI-LAKI', 'PEREMPUAN') jeniskelamin,
                               nopkajagen,
                               TO_CHAR (TGLPKAJAGEN, 'DD/MM/YYYY') TGLPKAJAGEN
                        FROM   jsadm.tabel_400_pkaj_agen@jlindo a, jsadm.tabel_100_klien@jlindo b
                       WHERE       noagen = '$filter[NOAGEN]'
                               AND NOPKAJAGEN = '$filter[NOPKAJAGEN]'
                               AND a.noagen = b.noklien
                    ORDER BY   TGLPKAJAGEN DESC ");

        if ($q->num_rows() > 0)
            $data = $q->result_array();

        $q->free_result();

        return $data;
    }


    /*===== get data pkaj online =====*/
    function dataotp_pkajonline($filter) {
        $data = array();

        $q = $this->db
            ->query("
                SELECT a.noagen, a.kdkantor, a.nopkajagen, a.tglpkajagen, a.tglpkaj, a.notelponagen
                FROM (
                    SELECT a.noagen, a.nopkajagen, TO_CHAR (a.tglpkajagen, 'dd/mm/yyyy') tglpkajagen,
                        TO_CHAR (tglpkajagen, 'mmyyyy') tglpkaj, a.kdkantor, a.notelponagen,
                        MAX(b.tgljabatan) tgljabatan
                    FROM jsadm.tabel_400_pkaj_agen@jlindo a
                    LEFT OUTER JOIN jsadm.tabel_417_histori_jabatan@jlindo b ON a.noagen = b.noagen
                        AND a.nopkajagen = b.nopkajagen
                    WHERE a.noagen = '$filter[NOAGEN]'
                        AND a.nopkajagen = '$filter[NOPKAJ]'
                        AND TO_CHAR(a.tglpkajagen, 'DD/MM/YYYY') = '$filter[TGLPKAJAGEN]'
                    GROUP BY a.noagen, a.nopkajagen, a.tglpkajagen, a.kdkantor, a.notelponagen
                ) a
                LEFT OUTER JOIN jsadm.tabel_417_histori_jabatan@jlindo b ON a.noagen = b.noagen
                    AND a.nopkajagen = b.nopkajagen
                    AND a.tgljabatan = b.tgljabatan");

        if ($q->num_rows() > 0)
            $data = $q->result_array();

        $q->free_result();

        return $data;
    }


    function insert_pkajonline($nopkaj,$kdkantor,$noagenbm,$namabm,$noagen,$jabatanbm,$nipbm,$alamatktr,$telponktr,$faxktr,$noidagen,$alamatagen,$notelponagen,$namaklien,$tgl,$bln,$thn,$tmptlhr,$tgllhr,$jnskel,$tglpkaj,$image_qragen,$image_noagenbm){

        $sql = "INSERT INTO tabel_400_epkaj_agen (PREFIXAGEN,
                                                NOAGEN,
                                                NOMORIDAGEN,
                                                ALAMATAGEN,
                                                NOPKAJAGEN,
                                                NOTELPONAGEN,
                                                TGLPKAJAGEN,
                                                TGLREKAM,
                                                USERREKAM,
                                                NOAGENBM,
                                                NAMABM,
                                                KDKANTOR,
                                                JABATANBM,
                                                NIPBM,
                                                ALAMATKTR,
                                                TELPONKTR,
                                                FAXKTR,
                                                AGEN_QRCODE,
                                                KANCAB_QRCODE)
                                         VALUES ('$kdkantor',
                                                 '$noagen',
                                                 '$noidagen', 
                                                 '$alamatagen',
                                                 '$nopkaj', 
                                                 '$notelponagen',
                                                 TO_DATE ('$tglpkaj', 'DD/MM/YYYY'), 
                                                 TO_DATE (SYSDATE, 'DD/MM/YYYY HH:MI:SS'),
                                                 '$namaklien', 
                                                 '$noagenbm', 
                                                 '$namabm',
                                                 '$kdkantor', 
                                                 '$jabatanbm', 
                                                 '$nipbm', 
                                                 '$alamatktr',
                                                 '$telponktr', 
                                                 '$faxktr', 
                                                 '$image_qragen',
                                                 '$image_noagenbm')";

        $query = $this->db->query($sql);
        if($query){
            // return $query;
            return "sukses insert E-PKAJ.";
        }else{
            return "gagal isnert E-PKAJ.";
        }
    }
    

    /*===== pkaj online =====*/
    function pkajonline($filter) {
        $data = array();

        $q = $this->db
            ->query("  SELECT  NOPKAJAGEN,
                                KDKANTOR,
                                NOAGENBM,
                                NAMABM,
                                a.NOAGEN NOAGEN,
                                JABATANBM,
                                NIPBM,
                                ALAMATKTR,
                                TELPONKTR,
                                FAXKTR,
                                noagen,
                                nomoridagen,
                                alamatagen,
                                notelponagen,
                                saksi1,
                                saksi2,
                                jabatansaksi1,
                                jabatansaksi2,
                                NAMAKLIEN1,
                                TO_CHAR (TGLPKAJAGEN, 'DD') TGL,
                                TO_CHAR (TGLPKAJAGEN, 'MM') BLN,
                                TO_CHAR (TGLPKAJAGEN, 'YYYY') THN,
                                tempatlahir,
                                TO_CHAR (tgllahir, 'DD/MM/YYYY') tgllahir,
                                DECODE (jeniskelamin, 'L', 'LAKI-LAKI', 'PEREMPUAN') jeniskelamin,
                                nopkajagen,
                                TO_CHAR (TGLPKAJAGEN, 'DD/MM/YYYY') TGLPKAJAGEN,
                                AGEN_QRCODE,
                                KANCAB_QRCODE,
								NVL(b.emailtetap, b.emailtagih) email
                         FROM   tabel_400_epkaj_agen a, jsadm.tabel_100_klien@jlindo b
                        WHERE       noagen = '$filter[noagen]'
                                AND TO_CHAR (TGLPKAJAGEN, 'DD/MM/YYYY') = '$filter[tglpkaj]'
                                AND NOPKAJAGEN = '$filter[nopkaj]'
                                AND a.noagen = b.noklien
                     ORDER BY   TGLPKAJAGEN DESC ");

        if ($q->num_rows() > 0)
            $data = $q->result_array();

        $q->free_result();

        return $data;
    }


    /*===== get daftar prospek by id =====*/
    function get_list_prospek($filter) {
        $data = array();

        $q = $this->db
            ->query("SELECT * FROM
        	(
        		SELECT tbl.*, rownum no
        		FROM
        		(
        			SELECT KDKANTOR, NOAGEN, NAMA, ALAMAT, KOTA, TO_CHAR(TGLLAHIR, 'DD/MM/YYYY') TGLLAHIR, TELP, HP, NOPROSPEK
        			FROM JAIM_201_PROSPEK
                    WHERE NOAGEN = '$filter[noagen]' AND DIHAPUS = 0 AND (
                        LOWER(KDKANTOR) LIKE '%$filter[s]%' OR
                        LOWER(NOAGEN) LIKE '%$filter[s]%' OR
                        LOWER(NAMA) LIKE '%$filter[s]%' OR
                        LOWER(ALAMAT) LIKE '%$filter[s]%' OR
                        LOWER(KOTA) LIKE '%$filter[s]%' OR
                        TO_CHAR(TGLLAHIR, 'DD/MM/YYYY') LIKE '%$filter[s]%' OR
                        TELP LIKE '%$filter[s]%' OR
                        HP LIKE '%$filter[s]%'
                    )
        			ORDER BY TGLREKAM DESC NULLS LAST
        		) tbl
        		WHERE rownum < ((".$filter['p']." * ".C_ROWS_PAGINATION.") + 1 )
        	)
        	WHERE no >= (((".$filter['p']."-1) * ".C_ROWS_PAGINATION.") + 1)");

        if ($q->num_rows() > 0)
            $data = $q->result_array();

        $q->free_result();

        return $data;
    }


    /*===== get daftar prospek by id =====*/
    function get_list_binaan($filter) {
        $data = array();

        $q = $this->db
            ->query("SELECT * FROM
        	(
        		SELECT tbl.*, rownum no
        		FROM
        		(
        			SELECT KDKANTOR, NOAGEN, NAMA, ALAMAT, KOTA, TGLLAHIR, TELP, HP, NOPROSPEK
        			FROM JAIM_201_PROSPEK a
                    WHERE NOAGEN IN $filter[noagen] AND DIHAPUS = 0 AND (
                        LOWER(KDKANTOR) LIKE '%$filter[s]%' OR
                        LOWER(NOAGEN) LIKE '%$filter[s]%' OR
                        LOWER(NAMA) LIKE '%$filter[s]%' OR
                        LOWER(ALAMAT) LIKE '%$filter[s]%' OR
                        LOWER(KOTA) LIKE '%$filter[s]%' OR
                        TO_CHAR(TGLLAHIR, 'DD/MM/YYYY') LIKE '%$filter[s]%' OR
                        TELP LIKE '%$filter[s]%' OR
                        HP LIKE '%$filter[s]%'
                    )
        			ORDER BY TGLREKAM DESC NULLS LAST
        		) tbl
        		WHERE rownum < ((".$filter['p']." * ".C_ROWS_PAGINATION.") + 1 )
        	)
        	WHERE no >= (((".$filter['p']."-1) * ".C_ROWS_PAGINATION.") + 1)");

        if ($q->num_rows() > 0)
            $data = $q->result_array();

        $q->free_result();

        return $data;
    }


    /*===== get daftar proposal by id =====*/
    function get_list_proposal($noprospek) {
        $data = array();

        $q = $this->db
            ->query("SELECT a.BUILD_ID NOPROPOSAL, a.ID_PRODUK, NAMA_PRODUK, a.CARA_BAYAR,
                         NVL(a.JUMLAH_PREMI, 0) JUMLAH_PREMI, NVL(a.JUA, 0) JUA, c.KDSTATUS, NVL(d.NAMASTATUS, 'Baru') NAMASTATUS,
                         c.TGLREKAM, e.FILE_PDF
                     FROM JAIM_300_HITUNG a
                     LEFT OUTER JOIN JAIM_300_PRODUK b ON a.ID_PRODUK = b.ID_PRODUK
                     LEFT OUTER JOIN (
                         SELECT MAX(KDSTATUS) KDSTATUS, BUILD_ID, TO_CHAR(MAX(TGLREKAM), 'DD/MM/YYYY') TGLREKAM,
			     MAX(TGLREKAM) TGLORDER
                         FROM JAIM_203_PROSPEK_FOLLOWUP za
                         GROUP BY BUILD_ID
                     ) c ON a.BUILD_ID = c.BUILD_ID
                     LEFT OUTER JOIN JAIM_201_STATUS_PROSPEK d ON c.KDSTATUS = d.KDSTATUS
                     LEFT OUTER JOIN JAIM_300_HITUNG e ON c.BUILD_ID = e.BUILD_ID
                     WHERE a.NO_PROSPEK = '$noprospek'
                     ORDER BY TGLORDER DESC");

        if ($q->num_rows() > 0)
            $data = $q->result_array();

        $q->free_result();

        return $data;
    }


    /*===== get daftar follow up by id =====*/
    function get_list_follow_up($buildid) {
        $data = array();

        $q = $this->db
            ->query("SELECT a.NOFOLLOWUP, b.NAMASTATUS, KETERANGAN, TO_CHAR(TGLPRESENTASI, 'DD/MM/YYYY') TGLPRESENTASI, NOSPAJ,
                         TO_CHAR(TGLSPAJ, 'DD/MM/YYYY') TGLSPAJ, TO_CHAR(TGLPELUNASAN, 'DD/MM/YYYY') TGLPELUNASAN,
                         TO_CHAR(TGLPEMBATALAN, 'DD/MM/YYYY') TGLPEMBATALAN, TO_CHAR(TGLREKAM, 'DD/MM/YYYY') TGLREKAM,
                         NVL((SELECT KDSTATUS FROM JAIM_203_PROSPEK_FOLLOWUP WHERE BUILD_ID = a.BUILD_ID AND KDSTATUS = 99),
                             (SELECT KDSTATUS FROM JAIM_203_PROSPEK_FOLLOWUP WHERE BUILD_ID = a.BUILD_ID AND KDSTATUS = 5)) KUNCI,
                         a.KDSTATUS, c.FILE_PDF, a.PREMI, c.NO_PROSPEK
                     FROM JAIM_203_PROSPEK_FOLLOWUP a
                     LEFT OUTER JOIN JAIM_201_STATUS_PROSPEK b ON a.KDSTATUS = b.KDSTATUS
                     LEFT OUTER JOIN JAIM_300_HITUNG c ON a.BUILD_ID = c.BUILD_ID
                     WHERE a.BUILD_ID = '$buildid'
                     ORDER BY NOFOLLOWUP");

        if ($q->num_rows() > 0)
            $data = $q->result_array();

        $q->free_result();

        return $data;
    }


    /*===== get follow up by id =====*/
    function get_follow_up($nofollowup) {
        $data = array();

        $q = $this->db
            ->query("SELECT a.NOFOLLOWUP, b.NAMASTATUS, KETERANGAN, TO_CHAR(TGLPRESENTASI, 'DD/MM/YYYY') TGLPRESENTASI, NOSPAJ,
                         TO_CHAR(TGLSPAJ, 'DD/MM/YYYY') TGLSPAJ, TO_CHAR(TGLPELUNASAN, 'DD/MM/YYYY') TGLPELUNASAN,
                         TO_CHAR(TGLPEMBATALAN, 'DD/MM/YYYY') TGLPEMBATALAN, TO_CHAR(TGLREKAM, 'DD/MM/YYYY') TGLREKAM,
                         NVL((SELECT KDSTATUS FROM JAIM_203_PROSPEK_FOLLOWUP WHERE BUILD_ID = a.BUILD_ID AND KDSTATUS = 99),
                             (SELECT KDSTATUS FROM JAIM_203_PROSPEK_FOLLOWUP WHERE BUILD_ID = a.BUILD_ID AND KDSTATUS = 5)) KUNCI,
                         a.KDSTATUS
                     FROM JAIM_203_PROSPEK_FOLLOWUP a
                     LEFT OUTER JOIN JAIM_201_STATUS_PROSPEK b ON a.KDSTATUS = b.KDSTATUS
                     WHERE a.NOFOLLOWUP = '$nofollowup'");

        if ($q->num_rows() > 0)
            $data = $q->row_array();

        $q->free_result();

        return $data;
    }


    /*===== get data prospek =====*/
    function get_prospek($noprospek) {
        $data = array();

        $q = $this->db
            ->query("SELECT KDKANTOR, NOAGEN, NAMA, ALAMAT, KOTA, KDPROVINSI, TO_CHAR(TGLLAHIR, 'DD/MM/YYYY') TGLLAHIR, JENISKELAMIN,
                         TELP, HP, EMAIL, NOPROSPEK
        			 FROM JAIM_201_PROSPEK
        			 WHERE NOPROSPEK = '$noprospek'");

        if ($q->num_rows() > 0)
            $data = $q->row_array();

        $q->free_result();

        return $data;
    }


    /*===== get last no prospek =====*/
    function get_last_no_prospek() {
        $lastno = null;
        $kdkantor = $this->session->KDKANTOR;

        $q = $this->db
            ->query("SELECT MAX(SUBSTR(NOPROSPEK, 9, 6)) AS NO
                     FROM JAIM_201_PROSPEK
                     WHERE SUBSTR(NOPROSPEK, 0, 2) = '$kdkantor'
                         AND SUBSTR(NOPROSPEK, 3, 6) = TO_CHAR(SYSDATE, 'YYMMDD')");

        if ($q->num_rows() > 0) {
            $data = $q->row_array();
            $lastno = $data['NO'];
        }

        $q->free_result();

        return $lastno;
    }


    /*===== get last no follow up =====*/
    function get_last_no_follow_up() {
        $lastno = null;

        $q = $this->db
            ->query("SELECT NVL(MAX(NOFOLLOWUP), 0) + 1 AS NO
                     FROM JAIM_203_PROSPEK_FOLLOWUP");

        if ($q->num_rows() > 0) {
            $data = $q->row_array();
            $lastno = $data['NO'];
        }

        $q->free_result();

        return $lastno;
    }


    /*===== get total rows prospek =====*/
    function get_total_prospek($filter) {
        $rows = 0;

        $q = $this->db
            ->query("SELECT KDKANTOR, NOAGEN, NAMA, ALAMAT, KOTA, TGLLAHIR, TELP, HP, NOPROSPEK
        			 FROM JAIM_201_PROSPEK
        			 WHERE NOAGEN = '$filter[noagen]' AND DIHAPUS = 0 AND (
        			     LOWER(KDKANTOR) LIKE '%$filter[s]%' OR
        			     LOWER(NOAGEN) LIKE '%$filter[s]%' OR
        			     LOWER(NAMA) LIKE '%$filter[s]%' OR
        			     LOWER(ALAMAT) LIKE '%$filter[s]%' OR
        			     LOWER(KOTA) LIKE '%$filter[s]%' OR
        			     TO_CHAR(TGLLAHIR, 'DD/MM/YYYY') LIKE '%$filter[s]%' OR
        			     TELP LIKE '%$filter[s]%' OR
        			     HP LIKE '%$filter[s]%'
        			 )
        			 ORDER BY TGLREKAM DESC NULLS LAST");

        $rows = $q->num_rows();

        return $rows;
    }


    /*===== get total rows prospek binaan =====*/
    function get_total_prospek_binaan($filter) {
        $rows = 0;

        $q = $this->db
            ->query("SELECT KDKANTOR, NOAGEN, NAMA, ALAMAT, KOTA, TGLLAHIR, TELP, HP, NOPROSPEK
        			 FROM JAIM_201_PROSPEK
        			 WHERE NOAGEN IN $filter[noagen] AND DIHAPUS = 0 AND (
        			     LOWER(KDKANTOR) LIKE '%$filter[s]%' OR
        			     LOWER(NOAGEN) LIKE '%$filter[s]%' OR
        			     LOWER(NAMA) LIKE '%$filter[s]%' OR
        			     LOWER(ALAMAT) LIKE '%$filter[s]%' OR
        			     LOWER(KOTA) LIKE '%$filter[s]%' OR
        			     TO_CHAR(TGLLAHIR, 'DD/MM/YYYY') LIKE '%$filter[s]%' OR
        			     TELP LIKE '%$filter[s]%' OR
        			     HP LIKE '%$filter[s]%'
        			 )
        			 ORDER BY TGLREKAM DESC NULLS LAST");

        $rows = $q->num_rows();

        return $rows;
    }


    /*===== cek apakah follow up bisa dihapus =====*/
    function is_delete_followup($buildid) {
        $rows = 0;

        $q = $this->db
            ->query("SELECT KDSTATUS FROM JAIM_203_PROSPEK_FOLLOWUP WHERE BUILD_ID = '$buildid' AND KDSTATUS IN (5, 99)");

        $rows = $q->num_rows();

        return $rows;
    }


    /*===== insert data prospek =====*/
    function insert($data) {
        $sukses = 0;

        $this->db->trans_begin();

        $this->db
            ->query("INSERT INTO JAIM_201_PROSPEK (NOPROSPEK, NOAGEN, KDKANTOR, KDAREAOFFICE, KDUNITPRODUKSI, KDJABATANAGEN, NAMA,
                         ALAMAT, KOTA, KDPROVINSI, TGLLAHIR, JENISKELAMIN, TELP, HP, EMAIL, TGLREKAM, DIHAPUS)
                     VALUES ('$data[NOPROSPEK]', '$data[NOAGEN]', '$data[KDKANTOR]', '$data[KDAREAOFFICE]', '$data[KDUNITPRODUKSI]',
                         '$data[KDJABATANAGEN]', '$data[NAMA]', '$data[ALAMAT]', '$data[KOTA]', '$data[KDPROVINSI]',
                         TO_DATE('$data[TGLLAHIR]', 'DD/MM/YYYY'), '$data[JENISKELAMIN]', '$data[TELP]', '$data[HP]', '$data[EMAIL]',
                         TO_DATE(TO_CHAR(SYSDATE, 'DD/MM/YYYY HH24:MI:SS'), 'DD/MM/YYYY HH24:MI:SS'), $data[DIHAPUS])");

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        }
        else {
            $sukses = $this->db->trans_commit();
        }

        return ($sukses ? C_STATUS_SUKSES_SIMPAN : C_STATUS_GAGAL_SIMPAN);
    }


    /*===== insert data follow up =====*/
    function insert_followup($data) {
        $sukses = 0;

        $this->db->trans_begin();

        $this->db
            ->query("INSERT INTO JAIM_203_PROSPEK_FOLLOWUP (NOFOLLOWUP, BUILD_ID, KDSTATUS, KETERANGAN, TGLPRESENTASI, NOSPAJ,
                         TGLSPAJ, PREMI, TGLPELUNASAN, TGLPEMBATALAN, TGLREKAM, USERREKAM)
                     VALUES ('$data[NOFOLLOWUP]', '$data[BUILD_ID]', '$data[KDSTATUS]', '$data[KETERANGAN]',
                         TO_DATE('$data[TGLPRESENTASI]', 'DD/MM/YYYY'), '$data[NOSPAJ]', TO_DATE('$data[TGLSPAJ]', 'DD/MM/YYYY'),
                         '$data[PREMI]', TO_DATE('$data[TGLPELUNASAN]', 'DD/MM/YYYY'), TO_DATE('$data[TGLPEMBATALAN]', 'DD/MM/YYYY'),
                         TO_DATE(TO_CHAR(SYSDATE, 'DD/MM/YYYY HH24:MI:SS'), 'DD/MM/YYYY HH24:MI:SS'), '$data[USERREKAM]')");

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        }
        else {
            $sukses = $this->db->trans_commit();
        }

        return ($sukses ? C_STATUS_SUKSES_SIMPAN : C_STATUS_GAGAL_SIMPAN);
    }


    /*===== update data agenda =====*/
    function update($data) {
        $sukses = 0;

        $this->db->trans_begin();

        $this->db
            ->query("UPDATE JAIM_201_PROSPEK SET
                         NAMA = '$data[NAMA]',
                         ALAMAT = '$data[ALAMAT]',
                         KOTA = '$data[KOTA]',
                         KDPROVINSI = '$data[KDPROVINSI]',
                         TGLLAHIR = TO_DATE('$data[TGLLAHIR]', 'DD/MM/YYYY'),
                         JENISKELAMIN = '$data[JENISKELAMIN]',
                         TELP = '$data[TELP]',
                         HP = '$data[HP]',
                         EMAIL = '$data[EMAIL]'
                     WHERE NOPROSPEK = '$data[NOPROSPEK]'");

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        }
        else {
            $sukses = $this->db->trans_commit();
        }

        return ($sukses ? C_STATUS_SUKSES_SIMPAN : C_STATUS_GAGAL_SIMPAN);
    }


    /*===== update data follow up =====*/
    function update_followup($data) {
        $sukses = 0;

        $this->db->trans_begin();

        $this->db
            ->query("UPDATE JAIM_203_PROSPEK_FOLLOWUP SET
                         KDSTATUS = '$data[KDSTATUS]',
                         KETERANGAN = '$data[KETERANGAN]',
                         TGLPRESENTASI = TO_DATE('$data[TGLPRESENTASI]', 'DD/MM/YYYY'),
                         NOSPAJ = '$data[NOSPAJ]',
                         TGLSPAJ = TO_DATE('$data[TGLSPAJ]', 'DD/MM/YYYY'),
                         PREMI = '$data[PREMI]',
                         TGLPELUNASAN = TO_DATE('$data[TGLPELUNASAN]', 'DD/MM/YYYY'),
                         TGLPEMBATALAN = TO_DATE('$data[TGLPEMBATALAN]', 'DD/MM/YYYY')
                     WHERE NOFOLLOWUP = '$data[NOFOLLOWUP]'");

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        }
        else {
            $sukses = $this->db->trans_commit();
        }

        return ($sukses ? C_STATUS_SUKSES_SIMPAN : C_STATUS_GAGAL_SIMPAN);
    }


    /*===== delete data prospek update dihapus = 1 =====*/
    function delete($noprospek) {
        $sukses = 0;

        $this->db->trans_begin();

        $this->db
            ->query("UPDATE JAIM_201_PROSPEK SET
                         DIHAPUS = 1, TGLHAPUS = TO_DATE(TO_CHAR(SYSDATE, 'DD/MM/YYYY HH24:MI:SS'), 'DD/MM/YYYY HH24:MI:SS')
                     WHERE NOPROSPEK = '$noprospek'");

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        }
        else {
            $sukses = $this->db->trans_commit();
        }

        return ($sukses ? C_STATUS_SUKSES_HAPUS : C_STATUS_GAGAL_HAPUS);
    }


    /*===== delete data proposal =====*/
    function delete_proposal($buildid) {
        $sukses = 0;

        $this->db->trans_begin();

        $this->db
            ->query("DELETE FROM JAIM_300_HITUNG WHERE BUILD_ID = '$buildid'");

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        }
        else {
            $sukses = $this->db->trans_commit();
        }

        return ($sukses ? C_STATUS_SUKSES_HAPUS : C_STATUS_GAGAL_HAPUS);
    }


    /*===== delete data follow up =====*/
    function delete_followup($nofollowup) {
        $sukses = 0;

        $this->db->trans_begin();

        $this->db
            ->query("DELETE FROM JAIM_203_PROSPEK_FOLLOWUP WHERE NOFOLLOWUP = '$nofollowup'");

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        }
        else {
            $sukses = $this->db->trans_commit();
        }

        return ($sukses ? C_STATUS_SUKSES_HAPUS : C_STATUS_GAGAL_HAPUS);
    }

    function insert_history_sign($activity, $usr, $id_user, $document_no, $document_type, $remark)
    {   
        $sql = "INSERT INTO HISTORY_LOG_PKAJ@JLINDO(ACTIVITY, USR, ID_USER, DOCUMENT_NO, DOCUMENT_TYPE, DATETIME, REMARK, STATUS) VALUES ('$activity', '$usr', '$id_user', '$document_no', '$document_type', SYSDATE, '$remark', '1')";

        $res = $this->db->query($sql);

        if ($res) {
            return true;
        } else {
            return false;
        }
    }
    
    function update_history_sign($activity, $nopkaj)
    {   
        $sql = "UPDATE HISTORY_LOG_PKAJ@JLINDO SET STATUS = '$activity' WHERE LOWER(ACTIVITY) LIKE '%created%' AND DOCUMENT_NO = '$nopkaj'";

        $res = $this->db->query($sql);

        if ($res) {
            return true;
        } else {
            return false;
        }
    }
}