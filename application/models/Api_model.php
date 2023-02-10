<?php

class Api_model extends CI_Model {

    //==================================================================================\\
    //                                       AGEN                                       \\
    //==================================================================================\\

    /*===== tarik data agen untuk session aplikasi =====*/
    function get_sesi_agen($noagen) {
        $data = array();

        $sql = "SELECT KDUNITPRODUKSI, a.KDKANTOR, KDJABATANAGEN, KDAREAOFFICE, b.NAMAKLIEN1 as NAMALENGKAP,
				    FOTOAGEN as AVATAR, b.EMAILTETAP, c.NAMAKANTOR, 
				    CASE WHEN c.PHONE01 IS NOT NULL AND c.PHONE02 IS NOT NULL THEN c.PHONE01 || ' / ' || c.PHONE02 
				        WHEN c.PHONE01 IS NOT NULL AND c.PHONE02 IS NULL THEN c.PHONE01 ELSE c.PHONE02 END AS PHONEKANTOR,
				    c.EMAIL AS EMAILKANTOR,
				    d.NAMAKANTOR AS NAMAINDUK,
				    CASE WHEN d.PHONE01 IS NOT NULL AND d.PHONE02 IS NOT NULL THEN d.PHONE01 || ' / ' || d.PHONE02 
				        WHEN d.PHONE01 IS NOT NULL AND d.PHONE02 IS NULL THEN d.PHONE01 ELSE d.PHONE02 END AS PHONEINDUK,
				    d.EMAIL AS EMAILINDUK, a.KDSTATUSAGEN
				FROM TABEL_400_AGEN@jlindo a
				LEFT OUTER JOIN TABEL_100_KLIEN@jlindo b ON a.NOAGEN = b.NOKLIEN
				LEFT OUTER JOIN TABEL_001_KANTOR@jlindo c ON a.KDKANTOR = c.KDKANTOR
				LEFT OUTER JOIN TABEL_001_KANTOR@jlindo d ON c.KDKANTORINDUK = d.KDKANTOR
				WHERE NOAGEN = '$noagen'";

        $q = $this->db->query($sql);
        if ($q->num_rows() > 0)
            $data = $q->row_array();

        return $data;
    }


    /*===== tarik data kancab & kanwil untuk session aplikasi =====*/
    function get_sesi_kantor($kdkantor) {
        $data = array();

        $sql = "SELECT a.NAMAKANTOR, 
					CASE WHEN a.PHONE01 IS NOT NULL AND a.PHONE02 IS NOT NULL THEN a.PHONE01 || ' / ' || a.PHONE02 
						 WHEN a.PHONE01 IS NOT NULL AND a.PHONE02 IS NULL THEN a.PHONE01 ELSE a.PHONE02 
					END AS PHONEKANTOR, a.EMAIL AS EMAILKANTOR, b.NAMAKANTOR AS NAMAINDUK, 
					CASE WHEN b.PHONE01 IS NOT NULL AND b.PHONE02 IS NOT NULL THEN b.PHONE01 || ' / ' || b.PHONE02 
						 WHEN b.PHONE01 IS NOT NULL AND b.PHONE02 IS NULL THEN b.PHONE01 ELSE b.PHONE02 
					END AS PHONEINDUK, b.EMAIL AS EMAILINDUK,
					'' KDSTATUSAGEN, c.NAMALENGKAP, '' KDJABATANAGEN, a.KDKANTOR, '' KDAREAOFFICE,
					'' KDUNITPRODUKSI, c.AVATAR, a.EMAIL EMAILTETAP
				FROM TABEL_001_KANTOR@jlindo a 
				LEFT OUTER JOIN TABEL_001_KANTOR@jlindo b ON a.KDKANTORINDUK = b.KDKANTOR 
				LEFT OUTER JOIN JAIM_900_USER c ON a.KDKANTOR = c.USERNAME
				WHERE a.KDKANTOR = '$kdkantor'";

        $q = $this->db->query($sql);
        if ($q->num_rows() > 0)
            $data = $q->row_array();

        return $data;
    }


    /*===== identitas agen =====*/
    function get_identitas_agen($noagen) {
        $data = array();

        $sql = "SELECT NOAGEN, b.NAMAKLIEN1, d.NAMASTATUSAGEN, b.TEMPATLAHIR, b.TGLLAHIR, c.NAMAJABATANAGEN, 
					a.NOLISENSIAGEN, TO_CHAR(a.TGLMULAILISENSI, 'DD/MM/YYYY') AS TGLMULAILISENSI, 
					TO_CHAR(a.TGLAKHIRLISENSI, 'DD/MM/YYYY') AS TGLAKHIRLISENSI
				FROM TABEL_400_AGEN@jlindo a
				INNER JOIN TABEL_100_KLIEN@jlindo b ON a.NOAGEN = b.NOKLIEN
				LEFT OUTER JOIN TABEL_413_JABATAN_AGEN@jlindo c ON a.KDJABATANAGEN = c.KDJABATANAGEN
				LEFT OUTER JOIN TABEL_409_STATUS_AGEN@jlindo d ON a.KDSTATUSAGEN = d.KDSTATUSAGEN
				WHERE NOAGEN = '$noagen'";

        $q = $this->db->query($sql);
        if ($q->num_rows() > 0)
            $data = $q->row_array();

        return $data;
    }


    /*===== riwayat keluarga =====*/
    function get_list_keluarga_agen($noagen) {
        $data = array();

        $sql = "SELECT NAMA, HUBUNGAN, TEMPAT_LAHIR, TO_CHAR(TGL_LAHIR, 'DD/MM/YYYY') AS TGLLAHIR
				FROM TABEL_420_KELUARGA_AGEN@jlindo
				WHERE NOAGEN = '$noagen'
				ORDER BY TGL_LAHIR";

        $q = $this->db->query($sql);
        if ($q->num_rows() > 0)
            $data = $q->result_array();

        return $data;
    }


    /*===== pendidikan formal =====*/
    function get_list_pendidikan_agen($noagen) {
        $data = array();

        $sql = "SELECT TO_CHAR(TGLMULAI, 'DD/MM/YYYY') TGLMULAI, NAMAJENISPENDIDIKAN, KETERANGAN
				FROM TABEL_414_HISTORI_PENDIDIKAN@jlindo a
				INNER JOIN TABEL_999_JENIS_PENDIDIKAN@jlindo b ON a.KDJENISPENDIDIKAN = b.KDJENISPENDIDIKAN
				WHERE KDKATEGORIPENDIDIKAN = '01' AND NOAGEN = '$noagen'
				ORDER BY TGLMULAI DESC";

        $q = $this->db->query($sql);
        if ($q->num_rows() > 0)
            $data = $q->result_array();

        return $data;
    }


    /*===== pendidikan extern =====*/
    function get_list_extern_agen($noagen) {
        $data = array();

        $sql = "SELECT TO_CHAR(TGLMULAI, 'DD/MM/YYYY') TGLMULAI, URAIAN AS NAMAJENISPENDIDIKAN, KETERANGAN
				FROM TABEL_414_HISTORI_PENDIDIKAN@jlindo a
				INNER JOIN TABEL_999_JENIS_PENDIDIKAN@jlindo b ON a.KDJENISPENDIDIKAN = b.KDJENISPENDIDIKAN
				WHERE KDKATEGORIPENDIDIKAN = '03' AND NOAGEN = '$noagen'
				ORDER BY a.TGLMULAI DESC";

        $q = $this->db->query($sql);
        if ($q->num_rows() > 0)
            $data = $q->result_array();

        return $data;
    }


    /*===== pengalaman kerja =====*/
    function get_list_pengalaman_kerja_agen($noagen) {
        $data = array();

        $sql = "SELECT TO_CHAR(TGLMULAI, 'DD/MM/YYYY') TGLMULAI, URAIAN AS PERUSAHAAN, KETERANGAN
				FROM TABEL_415_HISTORI_KERJA@jlindo a
				WHERE NOAGEN = '$noagen'
				ORDER BY a.TGLMULAI DESC";

        $q = $this->db->query($sql);
        if ($q->num_rows() > 0)
            $data = $q->result_array();

        return $data;
    }


    /*===== prestasi =====*/
    function get_list_prestasi_agen($noagen) {
        $data = array();

        $sql = "SELECT TO_CHAR(TGLJASA, 'DD/MM/YYYY') TGLJASA, URAIAN, KETERANGAN
				FROM TABEL_416_HISTORI_JASA@jlindo a
				WHERE NOAGEN = '$noagen' AND KDJENISJASA = '1'
				ORDER BY a.TGLJASA DESC";

        $q = $this->db->query($sql);
        if ($q->num_rows() > 0)
            $data = $q->result_array();

        return $data;
    }


    /*===== riwayat jabatan =====*/
    function get_list_riwayat_jabatan_agen($noagen) {
        $data = array();

        $sql = "SELECT TO_CHAR(a.TGLJABATAN, 'DD/MM/YYYY') TGLJABATAN, a.URAIAN, a.KETERANGAN, a.KDJABATANAGEN,
					a.KDKELASAGEN, b.NAMAJABATANAGEN, c.NAMAKELASAGEN
				FROM TABEL_417_HISTORI_JABATAN@jlindo a
				INNER JOIN TABEL_413_JABATAN_AGEN@jlindo b ON a.KDJABATANAGEN = b.KDJABATANAGEN
				INNER JOIN TABEL_408_KODE_KELAS_AGEN@jlindo c ON a.KDKELASAGEN = c.KDKELASAGEN
				WHERE NOAGEN = '$noagen'
				ORDER BY a.TGLJABATAN DESC";

        $q = $this->db->query($sql);
        if ($q->num_rows() > 0)
            $data = $q->result_array();

        return $data;
    }

    /*===== All Agen Aktif =====*/
    function get_agen_aktif($noagen='9999999999') {
        $data = array();

        $sql = "/* Formatted on 9/17/2021 10:43:38 AM (QP5 v5.326) */
			SELECT prefixagen,
				   noagen,
				   kdstatusagen,
				   DECODE (kdstatusagen, '01', 'AKTIF', '-')     STATUSAGEN,
				   TO_CHAR (tglskagen, 'DD/MM/YYYY')             TGLSKAGEN
			  FROM tabel_400_agen@jlindo";

        $q = $this->db->query($sql);
        if ($q->num_rows() > 0)
            $data = $q->result_array();

        return $data;
    }


    //==================================================================================\\
    //                                    WORKBOOK                                      \\
    //==================================================================================\\

    /*===== tarik data agenda agen sebawah =====*/
    function get_list_agenda_agen($p, $jmlhalaman, $kdkantor, $noagen, $cari, $office, $unit, $total = false) {
        $data = array();
        $office = !empty($office) ? " AND a.KDAREAOFFICE = '$office' " : null;
        $unit = !empty($unit) ? " AND a.KDUNITPRODUKSI = '$unit' " : null;

        $sql = "SELECT a.PREFIXAGEN, a.NOAGEN, NAMAKLIEN1, a.KDJABATANAGEN, c.URUTAN, c.NAMAJABATANAGEN, 
                    e.KDAREAOFFICE, e.NAMAAREAOFFICE, a.KDUNITPRODUKSI, f.NAMAUNITPRODUKSI, COUNT(b.NOAGENDA) JMLAGENDA, 
                    MAX(b.TGLREKAM) TGLREKAM
                FROM TABEL_400_AGEN@jlindo a 
                LEFT OUTER JOIN JAIM_200_AGENDA b ON a.NOAGEN = b.NOAGEN 
                INNER JOIN TABEL_413_JABATAN_AGEN@jlindo c ON a.KDJABATANAGEN = c.KDJABATANAGEN 
                INNER JOIN TABEL_100_KLIEN@jlindo d ON a.NOAGEN = d.NOKLIEN 
                LEFT OUTER JOIN TABEL_410_AREA_OFFICE@jlindo e ON a.KDKANTOR = e.KDKANTOR AND a.KDAREAOFFICE = e.KDAREAOFFICE 
                LEFT OUTER JOIN TABEL_410_KODE_UNIT_PRODUKSI@jlindo f ON a.KDKANTOR = f.KDKANTOR AND a.KDAREAOFFICE = f.KDAREAOFFICE 
                    AND a.KDUNITPRODUKSI = f.KDUNITPRODUKSI 
                LEFT OUTER JOIN JAIM_900_USER g ON a.NOAGEN = g.USERNAME
                WHERE a.KDSTATUSAGEN = '01' AND a.KDKANTOR = '$kdkantor' AND a.NOAGEN <> '$noagen'
                    $office $unit 
                    AND (LOWER(a.PREFIXAGEN) || LOWER(a.NOAGEN) LIKE '%$cari%' OR 
                    LOWER(NAMAKLIEN1) LIKE '%$cari%' OR
                    LOWER(c.NAMAJABATANAGEN) LIKE '%$cari%' OR
                    LOWER(e.NAMAAREAOFFICE) LIKE '%$cari%' OR
                    LOWER(f.NAMAUNITPRODUKSI) LIKE '%$cari%')
                GROUP BY a.PREFIXAGEN, a.NOAGEN, NAMAKLIEN1, a.KDJABATANAGEN, c.URUTAN, c.NAMAJABATANAGEN,
                    e.KDAREAOFFICE, e.NAMAAREAOFFICE, a.KDUNITPRODUKSI, f.NAMAUNITPRODUKSI, g.IDUSER
                ORDER BY TGLREKAM DESC NULLS LAST, JMLAGENDA DESC, KDAREAOFFICE NULLS FIRST, KDUNITPRODUKSI NULLS FIRST, URUTAN, NAMAKLIEN1";

        if ($total) {
            $q = $this->db->query($sql);
            return $q->num_rows();
        } else {
            $q = $this->db->query("
                SELECT * FROM 
                (
                    SELECT tbl.*, rownum no 
                    FROM ($sql) tbl 
                    WHERE rownum < (($p * $jmlhalaman) + 1 ) 
                ) WHERE no >= ((($p-1) * $jmlhalaman) + 1)");
            if ($q->num_rows() > 0)
                $data = $q->result_array();
            return $data;
        }
    }
}