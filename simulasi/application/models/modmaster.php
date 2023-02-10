<?php

class Modmaster extends CI_Model {
	private $sql;

    /* ===== fungsi untuk menyaring data dalam query =====
	 * operator -> operator pencarian WHERE, AND, OR
	 * open_wrap -> untuk kurung buka (
	 * text -> nama kolom pada tabel
	 * comparison -> pembanding antara text dengan value =, >, <, LIKE
	 * value -> nilai pada sebuah kolom yang ingin dicari
	 * close_wrap -> untuk kurung tutup )
	 */
    private function where($f) {
        $this->sql = null;

        if (isset($f) && count($f) > 0) {
            foreach ($f as $i => $v) {
                $openwrap = isset($v['openwrap']) ? $v['openwrap'] : null;
                $comparison2 = isset($v['comparison2']) ? $v['comparison2'] : null;
                $value2 = isset($v['value2']) ? $v['value2'] : null;
                $closewrap = isset($v['closewrap']) ? $v['closewrap'] : null;

                $this->sql .= " $v[operator] $openwrap $v[text] $v[comparison] $v[value] $comparison2 $value2 $closewrap ";
            }
        }
    }
	
	
	/*===== daftar pekerjaan =====*/
	function get_list_pekerjaan($f = array()) {
		$data = array();
        $this->where($f);

        $db = $this->db
            ->query("SELECT *
                     FROM jaim_301_pekerjaan
                     $this->sql");

        if ($db->num_rows() > 0)
            $data = $db->result_array();

        $db->free_result();

        return $data;
	}
	
	
	/*===== daftar provinsi =====*/
	function get_list_provinsi($f = array()) {
		$data = array();
        $this->where($f);

        $db = $this->db
            ->query("SELECT *
                     FROM jaim_001_provinsi
                     $this->sql");

        if ($db->num_rows() > 0)
            $data = $db->result_array();

        $db->free_result();

        return $data;
	}
	
	
	/*===== daftar hobi =====*/
	function get_list_hobi($f = array()) {
		$data = array();
        $this->where($f);

        $db = $this->db
            ->query("SELECT *
                     FROM jaim_301_hobi
                     $this->sql");

        if ($db->num_rows() > 0)
            $data = $db->result_array();

        $db->free_result();

        return $data;
	}
	
	
	/*===== data pekerjaan =====*/
    function get_pekerjaan($f = array()) {
        $data = array();
        $this->where($f);

        $db = $this->db
            ->query("SELECT *
                     FROM jaim_400_jenis_pekerjaan
                     $this->sql");

        if ($db->num_rows() > 0)
            $data = $db->row_array();

        $db->free_result();

        return $data;
    }
	
	
	/*===== data hobi =====*/
    function get_hobi($f = array()) {
        $data = array();
        $this->where($f);

        $db = $this->db
            ->query("SELECT *
                     FROM jaim_400_hobi
                     $this->sql");

        if ($db->num_rows() > 0)
            $data = $db->row_array();

        $db->free_result();

        return $data;
    }
	
	
	/*===== data tarif =====*/
	function get_tarif($f = array()) {
		$data = array();
		$this->where($f);
		
		$db = $this->db
			->query("SELECT *
					 FROM jaim_400_tarif
					 $this->sql");
		
		if ($db->num_rows() > 0)
			$data = $db->row_array();
		
		$db->free_result();
		
		return $data;
	}

    /*===== data user =====*/
    function get_user($f = array()) {
        $data = array();
        $this->where($f);

        $db = $this->db
            ->query("SELECT *
                     FROM jaim_900_user
                     $this->sql");

        if ($db->num_rows() > 0)
            $data = $db->row_array();

        $db->free_result();

        return $data;
    }

    

    /*===== data klien =====*/
    function get_klien($f = array()) {
        $data = array();
        $this->where($f);

        $db = $this->db
            ->query("SELECT *
                     FROM jaim_302_klien
                     $this->sql");
        
        if ($db->num_rows() > 0)
            $data = $db->row_array();

        $db->free_result();

        return $data;
    }

    /*===== generate no klien =====*/
    function gen_no_klien() {
        $data = null;

        $db = $this->db
            ->query("SELECT F_GEN_KLIEN as noklien
                     FROM DUAL");

        if ($db->num_rows() > 0) {
            $tmp = $db->row_array();
            $data = $tmp['NOKLIEN'];
        }

        $db->free_result();

        return $data;
    }

    /*===== generate no buildid =====*/
    function gen_build_id() {
        $data = null;

        $db = $this->db
            ->query("SELECT F_GEN_BUILD_ID as buildid
                     FROM DUAL");

        if ($db->num_rows() > 0) {
            $tmp = $db->row_array();
            $data = $tmp['BUILDID'];
        }

        $db->free_result();

        return $data;
    }





    /*===== fungsi insert ke dalam database =====
     * $table (string) : nama tabel
     * $options (array) : data-data yang ingin ditambahkan
     */
    function insert($table = '', $options = array()) {
        if ($table === '') {
            $this->display_error('db_must_set_table');
        }

        $this->db->_protect_identifiers = false;

        foreach ($options as $key => $value) {
            $firstchar = substr($value, 0, 1);

            if ($firstchar == '~') {
                $this->db->set($key, str_replace('~', null, $value), false);
            } else {
                $this->db->set($key, "'$value'", false);
            }
        }

        $sukses = $this->db->insert($table);

        return ($sukses ? 1 : 0);
    }

    /*===== fungsi update ke dalam database =====
     * $table (string) : nama tabel
     * $options (array) : data-data yang ingin diupdate
     * $where (string/array) : kondisi data yang ingin di filter
     * $value (string) : nilai dari kondisi
     * $insert (bool) : jika data yang diupdate blm ada tambahkan (true), abaikan (false)
     */
    function update($table = '', $options = array(), $where, $value = null, $insert = false) {
        if ($table === '') {
            $this->display_error('db_must_set_table');
        }

        $this->db->_protect_identifiers = false;

        if (is_array($where)) {
            foreach ($where as $key => $val) {
                $firstchar = substr($val, 0, 1);

                if ($firstchar == '~' && $val) {
                    $cond[$key] = str_replace('~', null, $val);
                } else if ($val) {
                    $cond[$key] = "'$val'";
                } else {
                    $cond[$key] = $val;
                }
            }
        } else {
            $cond = $where;
        }

        if ($value) {
            $firstchar = substr($value, 0, 1);

            if ($firstchar == '~') {
                $value = str_replace('~', null, $value);
            } else {
                $value = "'$value'";
            }
        }

        foreach ($options as $key => $val) {
            $firstchar = substr($val, 0, 1);

            if ($firstchar == '~') {
                $this->db->set($key, str_replace('~', null, $val), false);
            } else {
                $this->db->set($key, "'$val'", false);
            }
        }

        $this->db->where($cond, $value, false);

        $this->db->update($table);

        if (!$this->db->affected_rows() && $insert) {
            $this->insert($table, $options);
        }

        return $this->db->affected_rows();
    }
}