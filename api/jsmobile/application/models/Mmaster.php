<?php

class Mmaster extends CI_Model {

    /*===== daftar notifikasi umum =====*/
    function get_list_public_notification($lang, $kdaplikasi) {
        $data = array();
        $lang = $this->db->escape(strtoupper($lang));

        $sql = "SELECT a.notification_id, a.notification_lang, a.notification_from, a.notification_to, 
                    TO_CHAR(a.notification_date, 'dd-mm-yyyy hh24:mi:ss') notification_date, a.title, 
                    a.message, a.expired, a.type, 
                    CASE WHEN b.read_date IS NOT NULL THEN 1 ELSE 0 END isread, a.content
                FROM tabel_notification a
                LEFT OUTER JOIN tabel_notification_read b ON a.notification_id = b.notification_id
                WHERE a.notification_lang IN ('ALL', $lang)
                    AND a.type IN ('NEWS', 'PROMO')
                    AND a.notification_to IS NULL
                    AND a.kd_aplikasi = ".$this->db->escape($kdaplikasi);

        $db = $this->db->query($sql);
        if ($db->num_rows() > 0)
            $data = $db->result_array();

        $db->free_result();

        return $data;
    }


    /*===== daftar semua notifikasi user =====*/
    function get_list_all_user_notification($lang, $noklien, $kdaplikasi) {
        $data = array();
        $lang = $this->db->escape(strtoupper($lang));
        $noklien = $this->db->escape($noklien);
        $kdaplikasi = $this->db->escape($kdaplikasi);

        $sql = "SELECT a.notification_id, a.notification_lang, a.notification_from, a.notification_to, 
                    TO_CHAR(a.notification_date, 'dd-mm-yyyy hh24:mi:ss') notification_date, a.title, 
                    a.message, a.expired, a.type, 
                    CASE WHEN b.read_date IS NOT NULL THEN 1 ELSE 0 END isread, a.content
                FROM tabel_notification a
                LEFT OUTER JOIN tabel_notification_read b ON a.notification_id = b.notification_id
                WHERE a.notification_lang IN ('ALL', $lang)
                    AND a.type IN ('NEWS', 'PROMO')
                    AND a.notification_to IS NULL
                    AND a.kd_aplikasi = $kdaplikasi
                    
                UNION
                
                SELECT a.notification_id, a.notification_lang, a.notification_from, a.notification_to, 
                    TO_CHAR(a.notification_date, 'dd-mm-yyyy hh24:mi:ss') notification_date, a.title, 
                    a.message, a.expired, a.type, 
                    CASE WHEN b.read_date IS NOT NULL THEN 1 ELSE 0 END isread, a.content
                FROM tabel_notification a
                LEFT OUTER JOIN tabel_notification_read b ON a.notification_id = b.notification_id
                WHERE a.notification_lang IN ('ALL', $lang)
                    AND a.type IN ('PAYMENT', 'INFO')
                    AND a.notification_to = $noklien
                    AND a.kd_aplikasi = $kdaplikasi
                    
                ORDER BY notification_date desc, notification_id desc";

        $db = $this->db->query($sql);
        if ($db->num_rows() > 0)
            $data = $db->result_array();

        $db->free_result();

        return $data;
    }


    /*===== insert notifikasi as read =====*/
    function update_notifikasi($noklien, $notificationid) {
        $noklien = $this->db->escape($noklien);
        $notificationid = $this->db->escape($notificationid);

        $sql = "INSERT INTO tabel_notification_read (notification_id, no_klien)
                VALUES ($notificationid, $noklien)";
        $this->db->query($sql);

        return $this->db->affected_rows();
    }
}