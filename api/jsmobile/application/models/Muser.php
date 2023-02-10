<?php

class Muser extends CI_Model {

    /*===== data user by email =====*/
    function get_user($kdaplikasi, $filter, $filter2 = array()) {
        $data = array();

        $sql = "SELECT userid, username, FROMBASE64(password) password, fullname, 
                    TO_CHAR(birthdate, 'dd/mm/yyyy') birthdate, sex, email, address,
                    city, province_id, zipcode, phone, fax, status, confirmid, 
                    CASE WHEN confirmid_expired >= sysdate THEN 0 ELSE 1 END expired,
                    no_klien, auth_key, image
                FROM tabel_member a
                WHERE kd_aplikasi = ".$this->db->escape($kdaplikasi)."
                    AND (LOWER($filter[field]) = ".$this->db->escape($filter['value']);
        
        if ($filter2) {
            $sql.= " OR LOWER($filter2[field]) = ".$this->db->escape($filter['value']).")";
        } else{
            $sql.= ")";
        }

        $db = $this->db->query($sql);
        if ($db->num_rows() > 0)
            $data = $db->row_array();

        $db->free_result();

        return $data;
    }


    /*===== add new data user =====*/
    function insert_user($data) {
        $sql = "INSERT INTO tabel_member (userid, username, password, fullname, birthdate,
                    sex, email, address, city, province_id, zipcode, phone, fax, added_date,
                    status, confirmid, confirmid_sent, confirmid_expired, no_klien, session_key,
                    auth_key, kd_aplikasi)
                VALUES (idmember.nextval, ".$this->db->escape($data['username']).",
                    TOBASE64(".$this->db->escape($data['password'])."),
                    ".$this->db->escape($data['fullname']).",
                    TO_DATE(".$this->db->escape($data['birthdate']).", 'dd-mm-yyyy'),
                    ".$this->db->escape($data['sex']).",
                    ".$this->db->escape($data['email']).",
                    ".$this->db->escape($data['address']).",
                    ".$this->db->escape($data['city']).",
                    ".$this->db->escape($data['province_id']).",
                    ".$this->db->escape($data['zipcode']).",
                    ".$this->db->escape($data['phone']).",
                    ".$this->db->escape($data['fax']).", sysdate,
                    ".$this->db->escape($data['status']).",
                    ".$this->db->escape($data['confirmid']).", sysdate, sysdate + 1/24,
                    ".$this->db->escape($data['no_klien']).",
                    ".$this->db->escape($data['session_key']).",
                    ".$this->db->escape($data['auth_key']).",
                    ".$this->db->escape($data['kd_aplikasi']).")";
        $this->db->query($sql);

        return $this->db->affected_rows();
    }
    

    /*===== update password user =====*/
    function update_password($filter, $password, $kdaplikasi) {
        $password = $this->db->escape($password);
        $kdaplikasi = $this->db->escape($kdaplikasi);

        $sql = "UPDATE tabel_member SET password = TOBASE64($password)
                WHERE LOWER($filter[field]) = ".$this->db->escape($filter['value'])."
                    AND kd_aplikasi = $kdaplikasi";
        $this->db->query($sql);

        return $this->db->affected_rows();
    }


    /*===== update last login user =====*/
    function update_lastlogin($username, $kdaplikasi) {
        $username = $this->db->escape($username);
        $kdaplikasi = $this->db->escape($kdaplikasi);

        $sql = "UPDATE tabel_member SET last_login = sysdate
                WHERE username = $username
                    AND kd_aplikasi = $kdaplikasi";
        $this->db->query($sql);

        return $this->db->affected_rows();
    }


    /*===== update auth key user =====*/
    function update_authkey($authkey, $username, $kdaplikasi) {
        $authkey = $this->db->escape($authkey);
        $username = $this->db->escape($username);
        $kdaplikasi = $this->db->escape($kdaplikasi);

        $sql = "UPDATE tabel_member SET auth_key = $authkey
                WHERE username = $username
                    AND kd_aplikasi = $kdaplikasi";
        $this->db->query($sql);

        return $this->db->affected_rows();
    }


    /*===== update confirm id user =====*/
    function update_confirmid($confirmid, $username, $kdaplikasi) {
        $confirmid = $this->db->escape($confirmid);
        $username = $this->db->escape($username);
        $kdaplikasi = $this->db->escape($kdaplikasi);

        $sql = "UPDATE tabel_member SET confirmid = $confirmid,
                    confirmid_expired = sysdate + 1/24
                WHERE (username = $username OR email = $username)
                    AND status = 0
                    AND kd_aplikasi = $kdaplikasi";
        $this->db->query($sql);

        return $this->db->affected_rows();
    }


    /*===== update activating user =====*/
    function update_activate_user($username, $kdaplikasi) {
        $username = $this->db->escape($username);

        $sql = "UPDATE tabel_member SET status = 1, activation_date = sysdate
                WHERE username = $username
                    AND status = 0
                    AND kd_aplikasi = ".$this->db->escape($kdaplikasi);

        $this->db->query($sql);

        return $this->db->affected_rows();
    }


    /*===== update data user =====*/
    function update_user($data, $username, $kdaplikasi) {
        $username = $this->db->escape($username);
        $kdaplikasi = $this->db->escape($kdaplikasi);

        $sql = "UPDATE tabel_member SET fullname = ".$this->db->escape($data['fullname']).",
                    birthdate = TO_DATE(".$this->db->escape($data['birthdate']).", 'dd-mm-yyyy'),
                    sex = ".$this->db->escape($data['sex']).",
                    address = ".$this->db->escape($data['address']).",
                    city = ".$this->db->escape($data['city']).",
                    province_id = ".$this->db->escape($data['province_id']).",
                    zipcode = ".$this->db->escape($data['zipcode']).",
                    phone = ".$this->db->escape($data['phone'])."
                WHERE username = $username
                    AND kd_aplikasi = $kdaplikasi";

        $this->db->query($sql);

        return $this->db->affected_rows();
    }


    /*===== update profile picture user =====*/
    function update_profile_picture($namaimage, $username, $kdaplikasi) {
        $namaimage = $this->db->escape($namaimage);
        $username = $this->db->escape($username);
        $kdaplikasi = $this->db->escape($kdaplikasi);

        $sql = "UPDATE tabel_member SET image = $namaimage
                WHERE username = $username
                    AND kd_aplikasi = $kdaplikasi";

        $this->db->query($sql);

        return $this->db->affected_rows();
    }
}