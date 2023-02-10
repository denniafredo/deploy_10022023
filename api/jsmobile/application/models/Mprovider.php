<?php

class Mprovider extends CI_Model {
    
    /*===== daftar provider jiwasraya =====*/
    function get_list_provider($order, $kdtipeprovider, $filter) {
        $DB = $this->load->database('askes', TRUE);
        $data = array();
        $kdtipeprovider = $kdtipeprovider == 0 ? '' : $kdtipeprovider;
        
        $sql = "SELECT table_name, column_name, data_type, data_length
                FROM USER_TAB_COLUMNS
                WHERE table_name = 'HC_PROVIDER'
                    AND UPPER(column_name) = UPPER('$order')";
        
        $db = $DB->query($sql);
        if ($db->num_rows() == 0)
            $order = 'nama_provider';

        $sql = "SELECT nama_provider, CASE WHEN kota_provider IS NOT NULL THEN alamat_provider || ', ' || kota_provider ELSE alamat_provider END alamat_provider, 
                    telp_provider, fax_provider, a.kd_tipe_provider, b.tipe_provider
                FROM hc_provider a
                INNER JOIN hc_tipe_provider b ON a.kd_tipe_provider = b.kd_tipe_provider
                WHERE a.kd_tipe_provider LIKE '%$kdtipeprovider%'
                    AND a.kd_status = 1
                    AND (
                        LOWER(nama_provider) LIKE '%$filter%' OR
                        LOWER(alamat_provider) LIKE '%$filter%' OR
                        LOWER(kota_provider) LIKE '%$filter%'
                    )
                ORDER BY $order";

        $db = $DB->query($sql);
        if ($db->num_rows() > 0)
            $data = $db->result_array();

        $db->free_result();

        return $data;
    }
    
    
    /*===== daftar tipe provider =====*/
    function get_list_tipe_provider() {
        $DB = $this->load->database('askes', TRUE);
        $data = array();
        
        $sql = "SELECT 0 kd_tipe_provider, 'Semua' tipe_provider
                FROM dual
                UNION ALL
                SELECT kd_tipe_provider, tipe_provider
                FROM hc_tipe_provider";
        
        $db = $DB->query($sql);
        if ($db->num_rows() > 0)
            $data = $db->result_array();

        $db->free_result();

        return $data;
    }
}