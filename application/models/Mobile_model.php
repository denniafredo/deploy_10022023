<?php

class Mobile_model extends CI_Model {

    /*===== daftar ebook ilustrasi (brosur) produk JS =====*/
    function get_list_ilustrasi() {
        $data = array();

        $q = $this->db
            ->query("SELECT KDEBOOK, NAMAEBOOK, KETERANGAN, EBOOK, TO_CHAR(TGLREKAM, 'DD/MM/YYYY') TGLREKAM
                     FROM JAIM_000_EBOOK
                     WHERE STATUS = 1 AND NAMAEBOOK LIKE 'Brosur%'
        			 ORDER BY URUTAN");

        if ($q->num_rows() > 0)
            $data = $q->result_array();

        $q->free_result();

        return $data;
    }

    /*===== daftar prospek =====*/
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
}