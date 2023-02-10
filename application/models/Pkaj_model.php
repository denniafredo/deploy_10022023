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
                    SELECT a.noagen, a.nopkajagen, a.tglpkajagen, a.tglpkaj, a.dsp, a.kdkantor, b.kdjabatanagen, a.status
                    FROM (
                        SELECT a.noagen, a.nopkajagen, TO_CHAR(a.tglpkajagen, 'dd/mm/yyyy') tglpkajagen,
                            TO_CHAR(a.tglpkajagen, 'mmyyyy') tglpkaj,
                            CASE WHEN TO_CHAR(a.tglpkajagen, 'yyyy') < 2015 THEN 'none' ELSE '' END dsp,
                            a.kdkantor, MAX(c.tgljabatan) tgljabatan, a.status
                        FROM tabel_400_pkaj_agen@JLINDO a
                        LEFT OUTER JOIN tabel_417_histori_jabatan@JLINDO c ON a.noagen = c.noagen
                            AND a.nopkajagen = c.nopkajagen
                        WHERE a.noagen = '$filter[NOAGEN]'
                        GROUP BY a.noagen, a.nopkajagen, a.tglpkajagen, a.kdkantor, a.status
                    ) a
                    LEFT OUTER JOIN tabel_417_histori_jabatan@JLINDO b ON a.noagen = b.noagen
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


    function sendOtp($kdkantor, $nopkaj, $notlp, $message, $new_otp, $nmagen)
    {   

        // $msg = urlencode($message);
        $sql = "INSERT INTO OTP_EPKAJ(KD_KANTOR, NO_EPKAJ, NO_TLP, JENIS_OTP, KODE_OTP, MESSAGE, USER_RECORD, TGL_RECORD) VALUES ('$kdkantor', '$nopkaj', '$notlp', 'EPKAJ', TRIM('$new_otp'), '$message', '$nmagen', SYSDATE) ";

        $res = $this->db->query($sql);
        if ($res) {
            /*$q = "SELECT *
                  FROM (SELECT a.*, MAX (TGL_RECORD) OVER () AS max_created FROM OTP_EPKAJ a)
				  WHERE TGL_RECORD = max_created AND KD_KANTOR = '$kdkantor' AND NO_EPKAJ = '$nopkaj'";

            $query = $this->db->query($q);
            $result = $query->result();

            foreach ($result as $key => $val) {
				# code...
				//$NO_TLP  = trim($val->NO_TLP);
				$NO_TLP = 081339339961;
				$MESSAGE   = $val->MESSAGE ;

				// new query OTP
				// file_get_contents(C_URL_API_OTP."/send.otp.php?msisdn=".rawurlencode($NO_TLP)."&message=".rawurlencode($MESSAGE), true);
			  
				// old query OTP
				//$dbsms = $this->load->database('sms', TRUE); // the TRUE paramater tells CI that you'd like to return the database object.
				//$sql = "INSERT INTO smsjiwasraya(PHONE, MESSAGE, JENIS_SMS, KODE_KANTOR, NO_POLIS) VALUES ('$notlp', '$MESSAGE', 'EPKAJ', '$kdkantor', $nopkaj) ";
				//$res = $dbsms->query($sql);*/
				
				return true;
            //}
        } else {
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
        
        $q = "SELECT /*SUBSTR(MESSAGE, -4) AS MESSAGE*/ kode_otp AS MESSAGE,
				CASE WHEN expired >= sysdate THEN 0 ELSE 1 END isexpired
              FROM (SELECT a.*, MAX (TGL_RECORD) OVER () AS max_created FROM OTP_EPKAJ a)
              WHERE TGL_RECORD = max_created 
				AND KD_KANTOR = '$kdkantor' 
				AND NO_EPKAJ = '$nopkaj' 
				AND NO_TLP = '$notlp' ";

        $row = array();
        $query = $this->db->query($q);

        if ($query->num_rows() > 0) {
			$row = $query->row();
        }

        return($row);
    }


    /*===== get total rows pkaj online =====*/
    function get_total_pkajonline($filter) {
        $rows = 0;

        $q = $this->db
            ->query("
                    SELECT a.noagen, a.nopkajagen, a.tglpkajagen, a.tglpkaj, a.dsp, a.kdkantor, b.kdjabatanagen
                    FROM (
                        SELECT a.noagen, a.nopkajagen, TO_CHAR(a.tglpkajagen, 'dd/mm/yyyy') tglpkajagen,
                            TO_CHAR(a.tglpkajagen, 'mmyyyy') tglpkaj,
                            CASE WHEN TO_CHAR(a.tglpkajagen, 'yyyy') < 2015 THEN 'none' ELSE '' END dsp,
                            a.kdkantor, MAX(c.tgljabatan) tgljabatan
                        FROM tabel_400_pkaj_agen@JLINDO a
                        LEFT OUTER JOIN tabel_417_histori_jabatan@JLINDO c ON a.noagen = c.noagen
                            AND a.nopkajagen = c.nopkajagen
                        WHERE a.noagen = '$filter'
                        GROUP BY a.noagen, a.nopkajagen, a.tglpkajagen, a.kdkantor
                    ) a
                    LEFT OUTER JOIN tabel_417_histori_jabatan@JLINDO b ON a.noagen = b.noagen
                        AND a.nopkajagen = b.nopkajagen
                        AND a.tgljabatan = b.tgljabatan");

        $rows = $q->num_rows();

        return $rows;
    }

	//crf epkaj 2022
    /*===== get daftar pkaj online =====*/
    function cek_pkajonline($noagen, $nopkaj) {
        $data = array();

        $q = $this->db
            ->query("
                SELECT a.noagen, a.nopkajagen, a.tglpkajagen, a.tglpkaj, a.kdkantor, b.kdjabatanagen, a.userrekam, 
				(select kdjabatanagen from tabel_400_agen@JLINDO where noagen = a.noagen) kdjabatanagen,
				case
					WHEN TO_DATE(tglpkajagen,'DD/MM/YYYY') >= TO_DATE('18042022','DDMMYYYY') THEN 1
					WHEN TO_DATE(tglpkajagen,'DD/MM/YYYY') < TO_DATE('18042022','DDMMYYYY') THEN 2
				end periode,
				case 
					when to_date((select substr(qrperusahaan,-19,2)||substr(qrperusahaan,-16,2)||substr(qrperusahaan,-13,4) from tabel_400_pkaj_agen@JLINDO where noagen = a.noagen and nopkajagen = a.nopkajagen),'DDMMYYYY') >= TO_DATE('18042022','DDMMYYYY') THEN 1
					wHEN to_date((select substr(qrperusahaan,-19,2)||substr(qrperusahaan,-16,2)||substr(qrperusahaan,-13,4) from tabel_400_pkaj_agen@JLINDO where noagen = a.noagen and nopkajagen = a.nopkajagen),'DDMMYYYY') < TO_DATE('18042022','DDMMYYYY') THEN 2
				END	tglsubmit
                FROM (
                    SELECT a.noagen, a.nopkajagen, TO_CHAR (a.tglpkajagen, 'dd/mm/yyyy') tglpkajagen,
                        TO_CHAR (tglpkajagen, 'mmyyyy') tglpkaj, a.kdkantor, MAX(b.tgljabatan) tgljabatan,
						a.userrekam
                    FROM tabel_400_pkaj_agen@JLINDO a
                    LEFT OUTER JOIN tabel_417_histori_jabatan@JLINDO b ON a.noagen = b.noagen
                        AND a.nopkajagen = b.nopkajagen
                    WHERE a.noagen = '$noagen'
                        AND a.nopkajagen = '$nopkaj'
                    GROUP BY a.noagen, a.nopkajagen, a.tglpkajagen, a.kdkantor, a.userrekam
                ) a
                LEFT OUTER JOIN tabel_417_histori_jabatan@JLINDO b ON a.noagen = b.noagen
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
                               a.STATUS,
                               NOAGENBM,
                               NAMABM,
                               a.NOAGEN NOAGEN,
                               JABATANBM,
							   c.KDJABATANAGEN,
                               NIPBM,
                               ALAMATKTR,
                               TELPONKTR,
                               FAXKTR,
                               a.noagen,
							   case
									WHEN TO_DATE(tglpkajagen,'DD/MM/YYYY') >= TO_DATE('06062022','DDMMYYYY') AND TO_DATE(tglpkajagen,'DD/MM/YYYY') < TO_DATE('22072022','DDMMYYYY') THEN 1
									WHEN TO_DATE(tglpkajagen,'DD/MM/YYYY') < TO_DATE('06062022','DDMMYYYY') THEN 2
                  					WHEN TO_DATE(tglpkajagen,'DD/MM/YYYY') >= TO_DATE('22072022','DDMMYYYY') THEN 3
								end PERIODE_PEMBERITAHUAN2, 
								case
									when to_date((select substr(qrperusahaan,-19,2)||substr(qrperusahaan,-16,2)||substr(qrperusahaan,-13,4) from tabel_400_pkaj_agen@JLINDO where noagen = a.noagen and nopkajagen = a.nopkajagen),'DDMMYYYY') >= TO_DATE('06062022','DDMMYYYY') AND to_date((select substr(qrperusahaan,-19,2)||substr(qrperusahaan,-16,2)||substr(qrperusahaan,-13,4) from tabel_400_pkaj_agen@JLINDO where noagen = a.noagen and nopkajagen = a.nopkajagen),'DDMMYYYY') < TO_DATE('22072022','DDMMYYYY') THEN 1
									when to_date((select substr(qrperusahaan,-19,2)||substr(qrperusahaan,-16,2)||substr(qrperusahaan,-13,4) from tabel_400_pkaj_agen@JLINDO where noagen = a.noagen and nopkajagen = a.nopkajagen),'DDMMYYYY') >= TO_DATE('22072022','DDMMYYYY') THEN 3
                  					else 2
								end PERIODE_PEMBERITAHUAN,
                               nomoridagen,
                               alamatagen,
                               notelponagen,
				(NAMABM) NAMA_TTD,
				(NIPBM) NIK_TTD,
				(JABATANBM) JABATAN_TTD,
				(NAMABM) AS NAMA_RAH,
				(select ALAMATTETAP01 FROM TABEL_100_KLIEN@JLINDO WHERE NOKLIEN = c.NOAGENREKR) ALAMAT_TTD,
                               saksi1,
							   a.QRAGEN,
							   a.QRPERUSAHAAN,
                               saksi2,
                               jabatansaksi1,
                               jabatansaksi2,
                               NAMAKLIEN1,
                               TO_CHAR (TGLPKAJAGEN, 'DD') TGL,
                               TO_CHAR (TGLPKAJAGEN, 'MM') BLN,
                               TO_CHAR (TGLPKAJAGEN, 'YYYY') THN,
                               tempatlahir,
							   b.EMAILTETAP,
							   a.noberitaacara,
                               TO_CHAR (tgllahir, 'DD/MM/YYYY') tgllahir,
                               DECODE (jeniskelamin, 'L', 'LAKI-LAKI', 'PEREMPUAN') jeniskelamin,
                               a.nopkajagen,
                               TO_CHAR (TGLPKAJAGEN, 'DD/MM/YYYY') TGLPKAJAGEN
                        FROM   tabel_400_pkaj_agen@JLINDO a, tabel_100_klien@JLINDO b, tabel_400_agen@JLINDO c
                       WHERE       a.noagen = '$filter[NOAGEN]'
							   AND a.noagen =  c.noagen
                               AND TO_CHAR (TGLPKAJAGEN, 'DD/MM/YYYY') = '$filter[TGLPKAJAGEN]'
							   AND a.STATUS = '$filter[STATUS]'
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
                        FROM   tabel_400_pkaj_agen@JLINDO a, tabel_100_klien@JLINDO b
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
                    FROM tabel_400_pkaj_agen@JLINDO a
                    LEFT OUTER JOIN tabel_417_histori_jabatan@JLINDO b ON a.noagen = b.noagen
                        AND a.nopkajagen = b.nopkajagen
                    WHERE a.noagen = '$filter[NOAGEN]'
                        AND a.nopkajagen = '$filter[NOPKAJ]'
                        AND TO_CHAR(a.tglpkajagen, 'DD/MM/YYYY') = '$filter[TGLPKAJAGEN]'
						AND a.status = '0'
                    GROUP BY a.noagen, a.nopkajagen, a.tglpkajagen, a.kdkantor, a.notelponagen
                ) a
                LEFT OUTER JOIN tabel_417_histori_jabatan@JLINDO b ON a.noagen = b.noagen
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
	
	
	function update_pkajonline($kdkantor,$noagen,$tglpkaj,$qragen,$qrperusahaan){
		$sql = "UPDATE tabel_400_pkaj_agen@JLINDO SET status = 1, qragen = '$qragen', qrperusahaan = '$qrperusahaan'
				WHERE kdkantor = '$kdkantor'
					AND noagen = '$noagen'
					AND tglpkajagen = TO_DATE('$tglpkaj', 'dd/mm/yyyy')";

        $query = $this->db->query($sql);
		
        if($query){
            return "sukses insert E-PKAJ.";
        }else{
            return "gagal isnert E-PKAJ.";
        }
    }
    
	//crf epkaj 2022
    /*===== pkaj online =====*/
    function pkajonline($filter) {
        $data = array();

        $q = $this->db
            ->query("  SELECT   a.NOPKAJAGEN,
                               a.KDKANTOR,
                               a.STATUS,
                               NOAGENBM,
                               NAMABM,
                               a.NOAGEN NOAGEN,
                               JABATANBM,
                               NIPBM,
                               ALAMATKTR,
                               TELPONKTR,
                               FAXKTR,
							   c.kdjabatanagen,
							    case
									WHEN TO_DATE(tglpkajagen,'DD/MM/YYYY') >= TO_DATE('06062022','DDMMYYYY') AND TO_DATE(tglpkajagen,'DD/MM/YYYY') < TO_DATE('22072022','DDMMYYYY') THEN 1
									WHEN TO_DATE(tglpkajagen,'DD/MM/YYYY') < TO_DATE('06062022','DDMMYYYY') THEN 2
                                    WHEN TO_DATE(tglpkajagen,'DD/MM/YYYY') >= TO_DATE('22072022','DDMMYYYY') THEN 3
								end PERIODE_PEMBERITAHUAN2, 
								case
									when to_date((select substr(qrperusahaan,-19,2)||substr(qrperusahaan,-16,2)||substr(qrperusahaan,-13,4) from tabel_400_pkaj_agen@JLINDO where noagen = a.noagen and nopkajagen = a.nopkajagen),'DDMMYYYY') >= TO_DATE('06062022','DDMMYYYY') 
                                    AND to_date((select substr(qrperusahaan,-19,2)||substr(qrperusahaan,-16,2)||substr(qrperusahaan,-13,4) from tabel_400_pkaj_agen@JLINDO where noagen = a.noagen and nopkajagen = a.nopkajagen),'DDMMYYYY') < TO_DATE('22072022','DDMMYYYY') THEN 1
									when to_date((select substr(qrperusahaan,-19,2)||substr(qrperusahaan,-16,2)||substr(qrperusahaan,-13,4) from tabel_400_pkaj_agen@JLINDO where noagen = a.noagen and nopkajagen = a.nopkajagen),'DDMMYYYY') >= TO_DATE('22072022','DDMMYYYY') THEN 3
                                    else 2
								end PERIODE_PEMBERITAHUAN,
                               a.noagen,
                               nomoridagen,
                               alamatagen,
                               notelponagen,
							   (NAMABM) NAMA_TTD,
							   (NIPBM) NIK_TTD,
							   (JABATANBM) JABATAN_TTD,
							   (NAMABM) AS NAMA_RAH, 
				(select ALAMATTETAP01 FROM TABEL_100_KLIEN@JLINDO WHERE NOKLIEN = c.NOAGENREKR) ALAMAT_TTD,
							   a.QRAGEN,
							   a.QRPERUSAHAAN,
                               saksi1,
                               saksi2,
                               jabatansaksi1,
                               jabatansaksi2,
                               NAMAKLIEN1,
                               TO_CHAR (TGLPKAJAGEN, 'DD') TGL,
                               TO_CHAR (TGLPKAJAGEN, 'MM') BLN,
                               TO_CHAR (TGLPKAJAGEN, 'YYYY') THN,
                               tempatlahir,
							   b.EMAILTETAP,
							   a.noberitaacara,
                               TO_CHAR (tgllahir, 'DD/MM/YYYY') tgllahir,
                               DECODE (jeniskelamin, 'L', 'LAKI-LAKI', 'PEREMPUAN') jeniskelamin,
                               a.nopkajagen,
                               TO_CHAR (TGLPKAJAGEN, 'DD/MM/YYYY') TGLPKAJAGEN
                        FROM   tabel_400_pkaj_agen@JLINDO a, tabel_100_klien@JLINDO b, tabel_400_agen@JLINDO c
                       WHERE       a.noagen = '$filter[NOAGEN]'
							   AND a.noagen =  c.noagen
                                AND TO_CHAR (TGLPKAJAGEN, 'DD/MM/YYYY') = '$filter[tglpkaj]'
                                AND a.NOPKAJAGEN = '$filter[nopkaj]'
                                AND a.noagen = b.noklien
								AND a.status = '1'
                     ORDER BY   TGLPKAJAGEN DESC ");

        if ($q->num_rows() > 0)
            $data = $q->result_array();

        $q->free_result();

        return $data;
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