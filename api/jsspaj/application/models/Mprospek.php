<?php

/* 
 * Ini adalah halaman koneksi ke database.
 * 
 * Create by : Fendy Christianto
 */

class Mprospek extends MY_Model {
    
    function get_list_prospek($username) {
        $sql = "SELECT noprospek, kdkantor, nama, alamat, kota, TO_CHAR(tgllahir, 'dd-mm-yyyy') tgllahir, hp, telp 
                FROM jaim_201_prospek
                WHERE noagen = '$username'
                ORDER BY tglrekam DESC";
        $db = $this->db->query($sql);
        $data = $db->result_array();
        $db->free_result();
        
        return $data;
    }
    
    function get_list_klien($username) {
        $search = replace_to_insert(strtolower(trim($this->input->get('search'))));
        $page = $this->input->get('page') ? $this->input->get('page') : null;
        
        $sql = "SELECT a.noklien, namaklien, alamat, kdkotamadya, kdprovinsi, kdkelurahan,
                    TO_CHAR(tgllahir, 'dd-mm-yyyy') tgllahir, hp, telepon, noid, b.kdjeniskelamin,
                    c.namajeniskelamin, kdpekerjaan, kdhobi, email
                FROM jaim_302_klien_agen a
                LEFT OUTER JOIN jaim_302_klien b ON a.noklien = b.noklien
                LEFT OUTER JOIN jaim_301_jenis_kelamin c ON b.kdjeniskelamin = c.kdjeniskelamin
                WHERE a.noagen = '$username'
                    AND (
                        noid LIKE '%$search%'
                        OR LOWER(namaklien) LIKE '%$search%'
                        OR LOWER(alamat) LIKE '%$search%'
                        OR TO_CHAR(tgllahir, 'dd-mm-yyyy') LIKE '%$search%'
                        OR hp LIKE '%$search%'
                        OR telepon LIKE '%$search%'
                        OR LOWER(email) LIKE '%$search%'
                    )
                ORDER BY NVL(a.tglubah, a.tglrekam) DESC";
        
        $sql = $this->mypaging($sql, $page);
        
        $db = $this->db->query($sql);
        $data = $db->result_array();
        $db->free_result();
        
        return $data;
    }
    
    function get_prospek($username, $kdprospek) {
        $sql = "SELECT noprospek, noagen, nama, alamat, kota, kdprovinsi, TO_CHAR(tgllahir, 'dd-mm-yyyy') tgllahir,
                    jeniskelamin, kdjenispekerjaan, hp, telp, no_ktp, email
                FROM jaim_201_prospek
                WHERE noagen = '$username'
                    AND noprospek = '$kdprospek'
                    AND dihapus = 0";
        $db = $this->db->query($sql);
        $data = $db->row_array();
        $db->free_result();
         
        return $data;
    }
    
    function get_klien($noid) {
        $sql = "SELECT noklien, namaklien, alamat, kdkotamadya, kdprovinsi, kdkelurahan,
                    TO_CHAR(tgllahir, 'dd-mm-yyyy') tgllahir,
                    hp, telepon, noid, kdjeniskelamin, kdpekerjaan, kdhobi, email, merokok,
                    meritalstatus
                FROM jaim_302_klien
                WHERE noid = '$noid'";
        $db = $this->db->query($sql);
        $data = $db->row_array();
        $db->free_result();
        
        return $data;
    }
    
    function get_klien_agen($noid, $username) {
        $sql = "SELECT a.noklien, namaklien, alamat, kdkotamadya, kdprovinsi, kdkelurahan,
                    TO_CHAR(tgllahir, 'dd-mm-yyyy') tgllahir, 
                    TRUNC(MONTHS_BETWEEN(sysdate, tgllahir)/12) usia, hp, telepon, noid, 
                    b.kdjeniskelamin, c.namajeniskelamin, b.kdpekerjaan, d.namapekerjaan, 
                    b.kdhobi, e.namahobi, email, b.merokok, b.meritalstatus
                FROM jaim_302_klien_agen a
                LEFT OUTER JOIN jaim_302_klien b ON a.noklien = b.noklien
                LEFT OUTER JOIN jaim_301_jenis_kelamin c ON b.kdjeniskelamin = c.kdjeniskelamin
                LEFT OUTER JOIN jaim_301_pekerjaan d ON b.kdpekerjaan = d.kdpekerjaan
                LEFT OUTER JOIN jaim_301_hobi e ON b.kdhobi = e.kdhobi
                WHERE a.noagen = '$username'
                    AND b.noid = '$noid'";
        $db = $this->db->query($sql);
        $data = $db->row_array();
        $db->free_result();
        
        return $data;
    }
    
    function gen_noklien() {
        $sql = "SELECT F_GEN_KLIEN as noklien FROM DUAL";
        $db = $this->db->query($sql);
        $data = $db->row_array();
        $db->free_result();
        
        return $data['NOKLIEN'];
    }
}