<?php

class Myprosales_model extends CI_Model {

    /*===== get daftar agenda by id =====*/
    function get_token_agen($idUser) {
        $result = null;

        $q = $this->db
            ->from("JAIM_900_USER")
            ->where("LOWER(USERNAME)", "LOWER('$idUser')", FALSE)
            ->get();
			
		$q = $this->db
		->query("SELECT MOBILETOKEN FROM JAIM_900_USER WHERE USERNAME = '$idUser'");

        if ($q->num_rows() > 0)
            $result = $q->row_array();

        $q->free_result();

        return $result;
    }


    /*===== get data app pro sales =====*/
    function get_app_version() {
        $data = array();

        $q = $this->db
            ->query("SELECT noappversion, nama, versi, ukuran
						, TO_CHAR(tglrilis, 'dd/mm/yyyy') tglrilis
						, url
						 ,keterangan
                     FROM JAIM_910_HISTORIS_APP
                     WHERE KDSTATUS = 1");

        if ($q->num_rows() > 0)
            $data = $q->row_array();

        $q->free_result();

        return $data;
    }


    /*===== insert data historis download aplikasi pro sales =====*/
    function insert_historis_dl($data) {
        $sukses = 0;

        $this->db->trans_begin();

        $this->db
            ->query("INSERT INTO JAIM_910_HISTORIS_DL_PS (username, ipaddress, useragent, datedownload, noappversion)
                     VALUES ('$data[username]', '$data[ipaddress]', '$data[useragent]', sysdate, '$data[noappversion]')");

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        }
        else {
            $sukses = $this->db->trans_commit();
        }

        return ($sukses ? C_STATUS_SUKSES_SIMPAN : C_STATUS_GAGAL_SIMPAN);
    }
}