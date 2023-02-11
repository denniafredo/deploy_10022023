<?php

/* 
 * Ini adalah halaman koneksi ke database.
 * 
 * Create by : Fendy Christianto
 */

class Mpos extends MY_Model {
    // Sementara sebelum life prime dipindah ke 302_hitung, setelah itu mohon dihapus
    function get_list_pos($noagen, $noid) {
        $DBJL = $this->load->database('jlindo', TRUE);
        
        $sql = "SELECT a.buildid, a.kdproduk, a.namaproduk, a.namacarabayar, a.premi, 
                    TO_CHAR(a.tglrekam, 'dd-mm-yyyy hh24:mi:ss') tglrekam, a.jua, a.noagen, 
                    a.noid, a.namastatusfile, a.suspend, a.kdstatus, b.namastatus, a.keterangan_suspend
                FROM (
                    SELECT a.*, f.namastatusfile, NVL(b.suspend, c.suspend) suspend, NVL(b.keterangan, c.keterangan) keterangan_suspend,
                        CASE 
                            WHEN sysdate NOT BETWEEN a.tglrekam AND ADD_MONTHS(a.tglrekam, 1) AND c.nosp IS NULL THEN '99'
                            WHEN b.nospaj IS NULL AND c.nosp IS NULL AND d.nopertanggungan IS NULL AND e.nopertanggungan IS NULL THEN '2'
                            WHEN b.nospaj IS NOT NULL AND c.nosp IS NULL AND d.nopertanggungan IS NULL AND e.nopertanggungan IS NULL THEN '3'
                            WHEN c.kdpertanggungan = '1' AND d.nopertanggungan IS NULL AND e.nopertanggungan IS NULL THEN '4'
                            WHEN c.kdpertanggungan = '1' AND d.kdunderwriting = '1' AND e.nopertanggungan IS NULL THEN '5'
                            WHEN c.kdpertanggungan = '1' AND d.kdunderwriting = '1' AND e.kdacceptance = '1' THEN '6'
                            WHEN c.kdpertanggungan = '2' AND e.kdcetakpolis IS NULL THEN '7'
                            WHEN e.kdcetakpolis = '1' AND g.kdverifikasi IS NULL THEN '8'
                            WHEN g.kdverifikasi = '1' AND g.kdkirim IS NULL THEN '9'
                            WHEN g.kdkirim = '1' THEN '10'
                        END kdstatus
                    FROM (
                        SELECT TO_CHAR(a.buildid) buildid, a.kdproduk, b.namaproduk, c.namacarabayar, a.premi, a.tglrekam, a.jua, a.noagen, d.noid
                        FROM jaim_302_hitung@jaim a
                        LEFT OUTER JOIN jaim_301_produk@jaim b ON a.kdproduk = b.kdproduk
                        LEFT OUTER JOIN tabel_305_cara_bayar c ON a.kdcarabayar = c.kdcarabayar
                        LEFT OUTER JOIN jaim_302_klien@JAIM d ON a.nocpp = d.noklien
                        WHERE a.flag != 'X'
                        UNION ALL
                        SELECT TO_CHAR(build_id), TO_CHAR(a.id_produk), b.nama_produk, a.cara_bayar, TO_NUMBER(a.jumlah_premi), a.tgl_rekam, TO_NUMBER(a.jua), c.noagen, c.no_ktp
                        FROM jaim_300_hitung@jaim a
                        LEFT OUTER JOIN jaim_300_produk@jaim b ON a.id_produk = b.id_produk
                        LEFT OUTER JOIN jaim_201_prospek@jaim c ON a.no_prospek = c.noprospek
                        WHERE a.dihapus != '1'
                    ) a
                    LEFT OUTER JOIN tabel_spaj_online b ON a.buildid = b.buildid
                    LEFT OUTER JOIN tabel_200_pertanggungan c ON b.nospaj = c.nosp
                    LEFT OUTER JOIN tabel_214_underwriting d ON c.prefixpertanggungan = d.prefixpertanggungan
                        AND c.nopertanggungan = d.nopertanggungan
                    LEFT OUTER JOIN tabel_214_acceptance_dokumen e ON c.prefixpertanggungan = e.prefixpertanggungan
                        AND c.nopertanggungan = e.nopertanggungan
                    LEFT OUTER JOIN tabel_299_status_file f ON c.kdstatusfile = f.kdstatusfile
                    LEFT OUTER JOIN tabel_214_verify_cetak_polis g ON c.prefixpertanggungan = g.prefixpertanggungan
                        AND c.nopertanggungan = g.nopertanggungan
                    WHERE a.noagen = '$noagen'
                        ".($noid?" AND a.noid = '$noid'":"")."
                ) a
                LEFT OUTER JOIN jaim_201_status_prospek@JAIM b ON a.kdstatus = b.kdstatus
                ORDER BY a.tglrekam DESC";
        $db = $DBJL->query($sql);
        $data = $db->result_array();
        $db->free_result();
        
        return $data;
    }
    
    function get_list_fund($buildid) {
        $sql = "SELECT a.kdfund, b.namafund, porsi, d.rendah, d.sedang, d.tinggi
                FROM jaim_302_opsi_fund a
                INNER JOIN jaim_301_fund b ON a.kdfund = b.kdfund
                INNER JOIN jaim_302_hitung c ON a.buildid = c.buildid
                INNER JOIN jaim_301_produk_fund d ON c.kdproduk = d.kdproduk
                    AND a.kdfund = d.kdfund
                WHERE a.buildid = '$buildid'";
        $db = $this->db->query($sql);
        $data = $db->result_array();
        $db->free_result();
        
        return $data;
    }
    
    function get_list_rider($buildid) {
        $sql = "SELECT a.kdbenefit, b.namabenefit, b.deskripsi, biaya, manfaat
                FROM jaim_302_rider a
                INNER JOIN jaim_301_benefit b ON a.kdbenefit = b.kdbenefit
                WHERE buildid = '$buildid'";
        $db = $this->db->query($sql);
        $data = $db->result_array();
        $db->free_result();
        
        return $data;
    }
    
    function get_list_hasil($buildid) {
        $sql = "SELECT a.tahun, a.premi, a.topupsekaligus, a.topupberkala, a.investasirendah, a.investasisedang,
                    a.investasitinggi, a.investasiuarendah, a.investasiuasedang, a.investasiuatinggi, a.usia
                FROM jaim_302_hasil a
                WHERE a.buildid = '$buildid'
                ORDER BY a.tahun";
        $db = $this->db->query($sql);
        $data = $db->result_array();
        $db->free_result();
        
        return $data;
    }
    
    // Sementara sebelum life prime dipindah ke 302_hitung, setelah itu mohon dihapus
    function get_list_status($buildid) {
        $DBJL = $this->load->database('jlindo', TRUE);
        $sql = "SELECT a.buildid nomor, c.namastatus, b.namaklien1 userrekam, TO_CHAR(a.tglrekam, 'dd-mm-yyyy hh24:mi:ss') tglrekam,
                    null keterangan, 1 nourut
                FROM jaim_302_hitung@jaim a
                LEFT OUTER JOIN tabel_100_klien b ON a.noagen = b.noklien
                LEFT OUTER JOIN jaim_301_status_hitung@jaim c ON c.kdstatus = 1
                WHERE buildid = '$buildid'

                UNION

                SELECT a.build_id, c.namastatus, b.namaklien1, TO_CHAR(a.tgl_rekam, 'dd-mm-yyyy hh24:mi:ss'), null, 1 nourut
                FROM jaim_300_hitung@jaim a
                INNER JOIN tabel_100_klien b ON a.id_agen = b.noklien
                INNER JOIN jaim_301_status_hitung@jaim c ON c.kdstatus = 1
                WHERE build_id = '$buildid'

                UNION

                SELECT a.nospaj, CASE WHEN a.suspend = 1 THEN c.namastatus || ' (Pending)' ELSE c.namastatus END, 
                    b.namaklien1, TO_CHAR(a.tanggalrekam, 'dd-mm-yyyy hh24:mi:ss'), 
                    CASE WHEN a.suspend = 1 THEN a.keterangan END, 2 nourut
                FROM tabel_spaj_online a
                INNER JOIN tabel_100_klien b ON a.kodeagen = b.noklien
                INNER JOIN jaim_301_status_hitung@jaim c ON c.kdstatus = 2
                WHERE a.buildid = '$buildid'

                UNION

                SELECT b.nopolbaru, CASE WHEN b.suspend = 1 THEN d.namastatus || ' (Pending)' ELSE d.namastatus END,
                    c.namauser, TO_CHAR(b.tglrekam, 'dd-mm-yyyy hh24:mi:ss'),
                    CASE WHEN b.suspend = 1 THEN b.keterangan END, 3 nourut
                FROM tabel_spaj_online a
                INNER JOIN tabel_200_pertanggungan b ON a.nospaj = b.nosp
                INNER JOIN tabel_888_userid c ON b.userrekam = c.userid
                INNER JOIN jaim_301_status_hitung@jaim d ON d.kdstatus = 3
                WHERE a.buildid = '$buildid'

                UNION

                SELECT b.nopolbaru, e.namastatus, d.namauser, TO_CHAR(c.tglunderwriting, 'dd-mm-yyyy hh24:mi:ss'), null, 4 nourut
                FROM tabel_spaj_online a
                INNER JOIN tabel_200_pertanggungan b ON a.nospaj = b.nosp
                INNER JOIN tabel_214_underwriting c ON b.prefixpertanggungan = c.prefixpertanggungan
                AND b.nopertanggungan = c.nopertanggungan
                LEFT OUTER JOIN tabel_888_userid d ON c.userupdated = d.userid
                INNER JOIN jaim_301_status_hitung@jaim e ON e.kdstatus = 4
                WHERE a.buildid = '$buildid'

                UNION

                SELECT b.nopolbaru, h.namastatus, g.namaklien1, TO_CHAR(f.tglupdated, 'dd-mm-yyyy hh24:mi:ss'), f.buktisetor, 5 nourut
                FROM tabel_spaj_online a
                INNER JOIN tabel_200_pertanggungan b ON a.nospaj = b.nosp
                INNER JOIN tabel_214_underwriting c ON b.prefixpertanggungan = c.prefixpertanggungan
                AND b.nopertanggungan = c.nopertanggungan
                INNER JOIN tabel_214_acceptance_dokumen d ON b.prefixpertanggungan = d.prefixpertanggungan
                AND b.nopertanggungan = d.nopertanggungan
                LEFT OUTER JOIN tabel_888_userid e ON d.userupdated = e.userid
                INNER JOIN tabel_300_historis_premi f ON b.prefixpertanggungan = f.prefixpertanggungan
                AND b.nopertanggungan = f.nopertanggungan
                AND f.kdkuitansi = 'BP3'
                INNER JOIN tabel_100_klien g ON b.nopembayarpremi = g.noklien
                INNER JOIN jaim_301_status_hitung@jaim h ON h.kdstatus = 5
                WHERE a.buildid = '$buildid'
                AND c.kdunderwriting = '1'
                AND d.kdacceptance = '1'

                UNION

                SELECT b.nopolbaru, f.namastatus, 'SYSTEM', TO_CHAR(c.tglacceptance, 'dd-mm-yyyy hh24:mi:ss'), e.namastatusfile, 6 nourut
                FROM tabel_spaj_online a
                INNER JOIN tabel_200_pertanggungan b ON a.nospaj = b.nosp
                INNER JOIN tabel_214_acceptance_dokumen c ON b.prefixpertanggungan = c.prefixpertanggungan
                AND b.nopertanggungan = c.nopertanggungan
                LEFT OUTER JOIN tabel_888_userid d ON c.usercetakpolis = d.userid
                LEFT OUTER JOIN tabel_299_status_file e ON b.kdstatusfile = e.kdstatusfile
                INNER JOIN jaim_301_status_hitung@jaim f ON f.kdstatus = 6
                WHERE a.buildid = '$buildid'
                AND b.kdpertanggungan = '2'

                UNION

                SELECT c.noresi, c.namastatus, 'Ekspedisi', TO_CHAR(c.tglkirim, 'dd-mm-yyyy hh24:mi:ss'), null, 9 nourut
                FROM tabel_spaj_online a
                INNER JOIN tabel_200_pertanggungan b ON a.nospaj = b.nosp
                INNER JOIN tabel_214_verify_cetak_polis c ON b.prefixpertanggungan = c.prefixpertanggungan
                AND b.nopertanggungan = c.nopertanggungan
                INNER JOIN jaim_201_status_prospek@jaim c ON c.kdstatus = 9
                WHERE a.buildid = '$buildid'
                AND b.kdpertanggungan = '2'
                AND c.kdkirim = '1'

                ORDER BY nourut";
        $db = $DBJL->query($sql);
        $data = $db->result_array();
        $db->free_result();
        
        return $data;
    }
    
    function get_pos($buildid) {
        $sql = "SELECT a.buildid, nocpp, noctt, a.noagen, a.kdproduk, c.namaproduk, kdcarabayar, premi, 
                    premiberkala, topupsekaligus, topupberkala, periodetopup, jua, juamaksimal, 
                    a.penghasilan, usiaproduktif, resikoawal, sisaresiko, totalresiko, jpht, jpjdyt,
                    kdstatusmedical, kdpaketmedical, a.flag, buildidmobile, b.noid,
                    TO_CHAR(a.tglrekam, 'dd-mm-yyyy') tglrekam
                FROM jaim_302_hitung a
                LEFT OUTER JOIN jaim_302_hitung_klien b ON a.nocpp = b.noklien
                    AND b.buildid = a.buildid
                LEFT OUTER JOIN jaim_301_produk c ON a.kdproduk = c.kdproduk
                WHERE a.buildid = '$buildid'";
        $db = $this->db->query($sql);
        $data = $db->row_array();
        $db->free_result();
        
        return $data;
    }
    
    function get_klien($buildid, $noklien) {
        $sql = "SELECT a.kdpekerjaan, b.namapekerjaan, a.kdhobi, c.namahobi, a.namaklien, 
                    a.kdjeniskelamin, d.namajeniskelamin, TO_CHAR(a.tgllahir, 'dd-mm-yyyy') tgllahir,
                    a.alamat, a.email, a.telepon, a.hp, a.noid, e.kdhubungan, f.namahubungan, a.merokok
                FROM jaim_302_hitung_klien a
                LEFT OUTER JOIN jaim_301_pekerjaan b ON a.kdpekerjaan = b.kdpekerjaan
                LEFT OUTER JOIN jaim_301_hobi c ON a.kdhobi = c.kdhobi
                LEFT OUTER JOIN jaim_301_jenis_kelamin d ON a.kdjeniskelamin = d.kdjeniskelamin
                LEFT OUTER JOIN jaim_302_insurable e ON a.buildid = e.buildid
                    AND a.noklien = e.noctt
                LEFT OUTER JOIN jaim_301_hubungan f ON e.kdhubungan = f.kdhubungan
                WHERE a.noklien = '$noklien'
                    AND a.buildid = '$buildid'";
        $db = $this->db->query($sql);
        $data = $db->row_array();
        $db->free_result();
        
        return $data;
    }
    
    function get_hitung($buildidmobile, $username) {
        $sql = "SELECT *
                FROM jaim_302_hitung
                WHERE buildidmobile = '$buildidmobile'
                    AND noagen = '$username'";
        $db = $this->db->query($sql);
        $data = $db->row_array();
        $db->free_result();
        
        return $data;
    }
    
    function gen_no_klien() {
        $data = null;

        $db = $this->db
            ->query("SELECT F_GEN_KLIEN as noklien
                     FROM DUAL");

        if ($db->num_rows() > 0) {
            $tmp = $db->row_array();
            $data = $tmp['NOKLIEN'];
        }

        $db->free_result();

        return $data;
    }
    
    function gen_build_id() {
        $data = null;

        $db = $this->db
            ->query("SELECT F_GEN_BUILD_ID as buildid
                     FROM DUAL");

        if ($db->num_rows() > 0) {
            $tmp = $db->row_array();
            $data = $tmp['BUILDID'];
        }

        $db->free_result();

        return $data;
    }
}