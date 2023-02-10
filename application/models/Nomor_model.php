<?php

class Nomor_model extends CI_Model {

    /*===== nomor bod message =====*/
    function get_no_bod_msg() {
        $nomor = 0;

        $q = $this->db
            ->query("SELECT NVL(MAX(IDBODMSG), 0) NOMOR
                     FROM JAIM_000_BOD_MSG");

        if ($q->num_rows() > 0) {
            $row = $q->row();
            $nomor = $row->NOMOR + 1;
        }

        $q->free_result();

        return $nomor;
    }


    /*===== nomor agen of the month =====*/
    function get_no_aotm() {
        $nomor = 0;

        $q = $this->db
            ->query("SELECT NVL(MAX(IDAGENMONTH), 0) NOMOR
                     FROM JAIM_000_AGEN_MONTH");

        if ($q->num_rows() > 0) {
            $row = $q->row();
            $nomor = $row->NOMOR + 1;
        }

        $q->free_result();

        return $nomor;
    }
}