<?php

class Prospek_model extends CI_Model {


    /*===== get notifikasi pending proposal =====*/
    function get_list_pending() {
        $data = array();
		
		$sql = "SELECT NVL(a.keterangan, b.keterangan) keterangan, a.buildid, a.nmpempol
				FROM tabel_spaj_online@jlindo a
				LEFT OUTER JOIN tabel_200_pertanggungan@jlindo b ON a.nospaj = b.nosp
				WHERE a.kodeagen = '".$this->session->USERNAME."'
					AND 1 IN (a.suspend, b.suspend)";

        $q = $this->db->query($sql);

        if ($q->num_rows() > 0)
            $data = $q->result_array();

        $q->free_result();

        return $data;
    }

	/*===== get notifikasi pending proposal =====*/
    function get_list_histories() {
        $data = array();
		
		$sql = "SELECT NVL(a.keterangan, b.keterangan) keterangan, a.buildid, a.nospaj, a.nmpempol, b.PREFIXPERTANGGUNGAN, c.KDMUTASI, c.KDSTATUS
				FROM TABEL_600_HISTORIS_MUTASI_PERT@jlindo c
				JOIN tabel_200_pertanggungan@jlindo b ON c.PREFIXPERTANGGUNGAN = b.PREFIXPERTANGGUNGAN AND c.NOPERTANGGUNGAN = b.NOPERTANGGUNGAN  
				JOIN tabel_spaj_online@jlindo a ON b.nosp = a.nospaj
				WHERE a.kodeagen = '".$this->session->USERNAME."'
				AND c.KDMUTASI = 52 
				AND c.KDSTATUS NOT IN(1,9)
				--OR c.KDSTATUS = 2
				ORDER BY c.TGLMUTASI DESC
				";

        $q = $this->db->query($sql);

        if ($q->num_rows() > 0)
            $data = $q->result_array();

        $q->free_result();

        return $data;
    }
}