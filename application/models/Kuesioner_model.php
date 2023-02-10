<?php

class Kuesioner_model extends CI_Model {

    /*===== daftar hasil kuesioner by username =====*/
    function get_list_hasil_kuesioner($idgrup) {
        $data = array();

        $q = $this->db
            ->query("SELECT a.username, a.idkuesionerjawaban, c.pertanyaan, d.jawaban
                     FROM jaim_000_hasil_kuesioner a
                     INNER JOIN jaim_000_kuesioner_jawaban b ON a.idkuesionerjawaban = b.idkuesionerjawaban
                     INNER JOIN jaim_000_kuesioner c ON b.idkuesioner = c.idkuesioner
                     INNER JOIN jaim_000_jawaban_kuesioner d ON b.idjawaban = d.idjawaban
                     WHERE a.username = '".$this->session->USERNAME."' AND c.idgrup = '".$idgrup."'
                     ORDER BY b.idkuesioner");

        if ($q->num_rows() > 0)
            $data = $q->result_array();

        $q->free_result();

        return $data;
    }


    /*===== daftar kuesioner by group =====*/
    function get_list_kuesioner($idgroup) {
        $data = array();

        $q = $this->db
            ->query("SELECT b.namagrup, a.idkuesioner, a.pertanyaan, b.kdstatussaran, 
                         CASE WHEN b.wajib = 1 THEN '(Wajib Diisi)' ELSE null END namawajib
                     FROM jaim_000_kuesioner a
                     INNER JOIN jaim_000_grup_kuesioner b ON a.idgrup = b.idgrup
                     WHERE a.KDSTATUS = 1 AND b.KDSTATUS = 1 AND a.IDGRUP = '$idgroup'");

        if ($q->num_rows() > 0)
            $data = $q->result_array();

        $q->free_result();

        return $data;
    }


    /*===== daftar jawaban kuesioner by grup =====*/
    function get_list_jawaban_kuesioner($idgrup) {
        $data = array();

        $q = $this->db
            ->query("SELECT a.idkuesionerjawaban, a.idkuesioner, jawaban
                     FROM jaim_000_kuesioner_jawaban a
                     INNER JOIN jaim_000_jawaban_kuesioner b ON a.idjawaban = b.idjawaban
                     INNER JOIN jaim_000_kuesioner c ON a.idkuesioner = c.idkuesioner
                     WHERE c.idgrup = '$idgrup' AND b.kdstatus = 1
                     ORDER BY a.idkuesioner, a.idkuesionerjawaban");

        if ($q->num_rows() > 0)
            $data = $q->result_array();

        $q->free_result();

        return $data;
    }


    /*===== daftar grup kuesioner yang sedang aktif =====*/
    function get_list_grup_kuesioner() {
        $data = array();

        $q = $this->db
            ->query("SELECT idgrup, idkategori, namagrup
                     FROM jaim_000_grup_kuesioner
                     WHERE kdstatus = 1 AND sysdate BETWEEN periodeawal AND periodeakhir");

        if ($q->num_rows() > 0)
            $data = $q->result_array();

        $q->free_result();

        return $data;
    }


    /*===== daftar user yang belum mengisi kuesioner yang aktif =====*/
    function get_list_grup_kuesioner_user() {
        $data = array();

        $q = $this->db
            ->query("SELECT a.idgrup, a.judul, a.idkategori
                     FROM jaim_000_grup_kuesioner a
                     WHERE a.kdstatus = 1 AND sysdate BETWEEN periodeawal AND periodeakhir
                         AND IDGRUP NOT IN (
                         SELECT DISTINCT c.idgrup
                         FROM jaim_000_hasil_kuesioner a
                         INNER JOIN jaim_000_kuesioner_jawaban b ON a.idkuesionerjawaban = b.idkuesionerjawaban
                         INNER JOIN jaim_000_kuesioner c ON b.idkuesioner = c.idkuesioner
                         WHERE username = '".$this->session->USERNAME."'
                     )");

        if ($q->num_rows() > 0)
            $data = $q->result_array();

        $q->free_result();

        return $data;
    }


    /*===== daftar kuesioner wajib yang belum diisi =====*/
    function get_grup_kuesioner_wajib_user() {
        $data = array();

        $q = $this->db
            ->query("SELECT a.idgrup, a.judul, a.idkategori
                     FROM jaim_000_grup_kuesioner a
                     WHERE a.kdstatus = 1 AND sysdate BETWEEN periodeawal AND periodeakhir
                         AND IDGRUP NOT IN (
                         SELECT DISTINCT c.idgrup
                         FROM jaim_000_hasil_kuesioner a
                         INNER JOIN jaim_000_kuesioner_jawaban b ON a.idkuesionerjawaban = b.idkuesionerjawaban
                         INNER JOIN jaim_000_kuesioner c ON b.idkuesioner = c.idkuesioner
                         WHERE username = '".$this->session->USERNAME."'
                     ) AND a.wajib = 1");

        if ($q->num_rows() > 0)
            $data = $q->row_array();

        $q->free_result();

        return $data;
    }


    /*===== simpan data kuesioner =====*/
    function insert($data, $data2) {
        try {
            $this->db->trans_begin();

            $this->db->insert_batch("JAIM_000_HASIL_KUESIONER", $data);

            $this->db->insert("JAIM_000_HASIL_SARAN", $data2);

            $status = $this->db->trans_commit();
        }
        catch (Exception $e) {
            $this->db->trans_rollback();

            $status = 0;
        }

        return ($status ? C_STATUS_SUKSES_SIMPAN : C_STATUS_GAGAL_SIMPAN);
    }
}