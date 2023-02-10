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


}