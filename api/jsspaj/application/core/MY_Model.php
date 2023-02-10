<?php

/* 
 * Ini adalah kelas model untuk perintah insert, update, delete.
 * 
 * Create by : Fendy Christianto
 */

class MY_Model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    
    /*===== fungsi insert logging parameter =====*/
    function log2($request, $response) {
        // untuk loging
        $log = $request."\n";
        $log .= "Parameter : ".($_POST ? json_encode($_POST) : json_encode($_GET))."\n";
        $log .= $response;
        
        if (strlen($log) > 0 && strlen($log) > 4000) {
            $s = 0;
            $log = trim($log);
            $pembagi = 3996;
            for ($i=0;$i<ceil(strlen($log)/$pembagi);$i++) {
                $l = strrpos(substr($log, $s, $pembagi), ";")+1;
                $f = $s + $l;

                $this->db
                    ->query("INSERT INTO jaim_999_log (kdlog, log, tglrekam, userrekam) 
                             VALUES (F_GEN_KDLOG, '".($i+1)."/".(strlen($log)/$pembagi)." ".replace_to_insert(substr($log, $s, $l))."',
                             sysdate, '".$this->input->ip_address()."')");

                $s = $f+1;
            }
        } else if (strlen($log) > 0 && strlen($log) <= 4000) {
            $this->db
                ->query("INSERT INTO jaim_999_log (kdlog, log, tglrekam, userrekam) 
                         VALUES (F_GEN_KDLOG, '".replace_to_insert($log)."', 
                             sysdate, '".$this->input->ip_address()."')");
        }
    }


    /*===== fungsi insert logging query =====*/
    private function log($sql = '') {
        // untuk loging
    }
    
    
    /*===== fungsi untuk memulai transaksi =====*/
    function start() {
        $this->db->trans_start();
    }
    
    
    /*===== fungsi untuk strict =====*/
    function strict($option = TRUE) {
        // Jika true, salah satu transaksi gagal, maka akan ter-rollback semua
        // Jika false, salah satu transaksi gagal, lainnya yang sukses akan ter-commit
        $this->db->trans_strict($option);
    }
    
    
    /*===== fungsi untuk menyelesaikan transaksi =====*/
    function complete() {
        $this->db->trans_complete();
    }
    
    
    /*===== fungsi untuk status transaksi =====*/
    function status() {
        return $this->db->trans_status();
    }
    
    
    /*===== fungsi untuk membatalkan transaksi =====*/
    function rollback() {
        $this->db->trans_rollback();
    }
    
    
    /*==== fungsi untuk menyimpan transaksi =====*/
    function commit() {
        $this->db->trans_commit();
    }
    
    
    /*===== fungsi sql untuk membentuk data tampil halaman =====*/
    function mypaging($query, $page) {
        $perpage = $this->input->get('per_page') ? $this->input->get('per_page') : C_PAGE_JUMLAH;

        if ($page) {
            $sql = "SELECT * FROM (
                        SELECT a.*, ROWNUM no
                        FROM ($query) a
                        WHERE ROWNUM < (($page * $perpage) + 1)
                    )
                    WHERE no >= ((($page-1) * $perpage) + 1)";
        }
        else {
            $sql = $query;
        }

        return $sql;
    }


    /*===== fungsi insert ke dalam database =====
     * $table (string) : nama tabel
     * $options (array) : data-data yang ingin ditambahkan
     */
    function myinsert($table = '', $options = array()) {
        if ($table === '') {
            $this->display_error('db_must_set_table');
        }

        foreach ($options as $key => $value) {
            $firstchar = substr($value, 0, 1);

            if ($firstchar == C_IDENTIFIER_WITHOUT_QUOTES) {
                $this->db->set($key, str_replace(C_IDENTIFIER_WITHOUT_QUOTES, null, $value), false);
            } else {
                $this->db->set($key, "'$value'");
            }
        }

        $sukses = $this->db->insert($table);
        $this->log();

        return ($sukses ? 1 : 0);
    }


    /*===== fungsi insert batch ke dalam database =====
     * $table (string) : nama tabel
     * $options (array 2 dimensi) : data-data yang ingin ditambahkan
     * $flag (bool) : menggunakan perintah insert_batch (true) atau looping insert (false)
     */
    function myinsert_batch($table = '', $options = array(), $flag = true) {
        if ($table === '') {
            $this->display_error('db_must_set_table');
        }

        if ($flag) {
            $i = 0;
            foreach ($options as $key => $value) {
                foreach ($value as $l => $v) {
                    $firstchar = substr($v, 0, 1);

                    if ($firstchar == C_IDENTIFIER_WITHOUT_QUOTES) {
                        $data[$i][$l] = str_replace(C_IDENTIFIER_WITHOUT_QUOTES, null, $v);
                    }
                    else {
                        $data[$i][$l] = "'$v'";
                    }
                }

                $i++;
            }

            $sukses = $this->db->insert_batch($table, $data, false);
            $this->log();
        } else {
            $sql = '';
            foreach ($options as $key => $value) {
                foreach ($value as $l => $v) {
                    $firstchar = substr($v, 0, 1);

                    if ($firstchar == C_IDENTIFIER_WITHOUT_QUOTES) {
                        $this->db->set($l, str_replace(C_IDENTIFIER_WITHOUT_QUOTES, null, $v), false);
                    } else {
                        $this->db->set($l, "'$v'");
                    }
                }

                $sukses = $this->db->insert($table);
                $sql .= $this->db->last_query().";\n";
            }

            $this->log($sql);
        }

        return ($sukses ? 1 : 0);
    }


    /*===== fungsi update ke dalam database =====
     * $table (string) : nama tabel
     * $options (array) : data-data yang ingin diupdate
     * $where (string/array) : kondisi data yang ingin di filter
     * $value (string) : nilai dari kondisi
     * $insert (bool) : jika data yang diupdate blm ada tambahkan (true), abaikan (false)
     */
    function myupdate($table = '', $options = array(), $where, $value = null, $insert = false) {
        if ($table === '') {
            $this->display_error('db_must_set_table');
        }

        if (is_array($where)) {
            foreach ($where as $key => $val) {
                $firstchar = substr($val, 0, 1);

                if ($firstchar == C_IDENTIFIER_WITHOUT_QUOTES && $val) {
                    $cond[$key] = str_replace(C_IDENTIFIER_WITHOUT_QUOTES, null, $val);
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

            if ($firstchar == C_IDENTIFIER_WITHOUT_QUOTES) {
                $value = str_replace(C_IDENTIFIER_WITHOUT_QUOTES, null, $value);
            } else {
                $value = "'$value'";
            }
        }

        foreach ($options as $key => $val) {
            $firstchar = substr($val, 0, 1);

            if ($firstchar == C_IDENTIFIER_WITHOUT_QUOTES) {
                $this->db->set($key, str_replace(C_IDENTIFIER_WITHOUT_QUOTES, null, $val), false);
            } else {
                $this->db->set($key, "'$val'");
            }
        }

        $this->db->where($cond, $value, false);

        $this->db->update($table);
        $this->log();

        if (!$this->db->affected_rows() && $insert) {
            $this->myinsert($table, $options);
            $this->log();
        }

        return $this->db->affected_rows();
    }


    /*===== fungsi update batch ke dalam database =====
     * $table (string) : nama tabel
     * $options (array 2 dimensi) : data-data yang ingin diupdate
     * $where (string/array) : nama field tabel yang ingin diupdate
     * $flag (bool) : menggunakan perintah update_batch (true) atau looping update (false)
     * $insert (bool) : jika data yang diupdate blm ada tambahkan (true), abaikan (false)
     * $deletewhere (bool/array) : jika ada data yang tidak diupdate, hapus (array), abaikan (false)
     */
    function myupdate_batch($table = '', $options = array(), $where, $flag = true, $insert = true, $deletewhere = false) {
        if ($table === '') {
            $this->display_error('db_must_set_table');
        }

        if (!is_array($where)) { // jika $where sebuah string (single kondisi)
            if ($flag) {
                $i = 0;
                foreach ($options as $key => $val) {
                    foreach ($val as $l => $v) {
                        $firstchar = substr($v, 0, 1);

                        if ($firstchar == C_IDENTIFIER_WITHOUT_QUOTES) {
                            $data[$i][$l] = str_replace(C_IDENTIFIER_WITHOUT_QUOTES, null, $v);
                        }
                        else {
                            $data[$i][$l] = "'$v'";
                        }
                    }

                    $i++;
                }

                $this->db->update_batch($table, $data, $where);
                $this->log();
            } else {
                $sql = '';

                foreach ($options as $key => $val) {
                    foreach ($val as $l => $v) {
                        $firstchar = substr($v, 0, 1);

                        if ($firstchar == C_IDENTIFIER_WITHOUT_QUOTES && $val) {
                            $this->db->set($l, str_replace(C_IDENTIFIER_WITHOUT_QUOTES, null, $v), false);
                            $value = str_replace(C_IDENTIFIER_WITHOUT_QUOTES, null, $val[$where]);
                        } else if ($val) {
                            $this->db->set($l, "'$v'");
                            $value = "'$val[$where]'";
                        } else {
                            $cond[$key] = $val;
                        }
                    }

                    $this->db->where($where, $value, false);

                    $this->db->update($table);

                    if (!$this->db->affected_rows() && $insert) {
                        $this->myinsert($table, $val);
                    }

                    $sql .= $this->db->last_query().";\n";
                }
            }
        } else { // jika $where sebuah array (multiple kondisi)
            $sql = '';

            foreach ($options as $key => $val) {
                foreach ($val as $l => $v) {
                    $firstchar = substr($v, 0, 1);

                    if ($firstchar == C_IDENTIFIER_WITHOUT_QUOTES) {
                        $this->db->set($l, str_replace(C_IDENTIFIER_WITHOUT_QUOTES, null, $v), false);
                    } else {
                        $this->db->set($l, "'$v'");
                    }
                }

                foreach ($where[$key] as $l => $v) {
                    $firstchar = substr($v, 0, 1);

                    if ($firstchar == C_IDENTIFIER_WITHOUT_QUOTES) {
                        $this->db->where($l, str_replace(C_IDENTIFIER_WITHOUT_QUOTES, null, $v), false);
                    } else {
                        $this->db->where($l, "'$v'");
                    }
                }

                $this->db->update($table);

                if (!$this->db->affected_rows() && $insert) {
                    $this->myinsert($table, $val);
                }

                $sql .= $this->db->last_query().";\n";
            }

            if (is_array($deletewhere)) {
                $this->mydelete($table, $deletewhere, false);
            }
        }

        $this->log($sql);

        return $this->db->affected_rows();
    }


    /*===== fungsi untuk reinsert ke dalam database =====
     * $table (string) : nama tabel
     * $options (array 2 dimensi) : data-data yang ingin di reinsert
     * $where (string/array) : kondisi data yang ingin di filter
     * $value (string) : nilai dari kondisi
     * $flag (boold) : menggunakan perintah insert_batch (true) atau looping insert (false)
     */
    function myreinsert_batch($table = '', $options = array(), $where, $value = null, $flag = true) {
        $sql = '';

        if ($table === '') {
            $this->display_error('db_must_set_table');
        }

        if (is_array($where)) {
            foreach ($where as $key => $val) {
                $firstchar = substr($val, 0, 1);

                if ($firstchar == C_IDENTIFIER_WITHOUT_QUOTES && $val) {
                    $cond[$key] = str_replace(C_IDENTIFIER_WITHOUT_QUOTES, null, $val);
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

            if ($firstchar == C_IDENTIFIER_WITHOUT_QUOTES) {
                $value = str_replace(C_IDENTIFIER_WITHOUT_QUOTES, null, $value);
            } else {
                $value = "'$value'";
            }
        }

        $this->db->where($cond, $value, false);

        $this->db->delete($table);
        $sql .= $this->db->last_query().";\n";

        if ($options) {
            if ($flag) {
                $i = 0;
                foreach ($options as $key => $val) {
                    foreach ($val as $l => $v) {
                        $firstchar = substr($v, 0, 1);

                        if ($firstchar == C_IDENTIFIER_WITHOUT_QUOTES) {
                            $data[$i][$l] = str_replace(C_IDENTIFIER_WITHOUT_QUOTES, null, $v);
                        }
                        else {
                            $data[$i][$l] = "'$v'";
                        }
                    }

                    $i++;
                }

                $sukses = $this->db->insert_batch($table, $data, false);
                $sql .= $this->db->last_query().";\n";
                //$this->log();
            } else {
                foreach ($options as $key => $val) {
                    foreach ($val as $l => $v) {
                        $firstchar = substr($v, 0, 1);

                        if ($firstchar == C_IDENTIFIER_WITHOUT_QUOTES) {
                            $this->db->set($l, str_replace(C_IDENTIFIER_WITHOUT_QUOTES, null, $v), false);
                        } else {
                            $this->db->set($l, "'$v'");
                        }
                    }

                    $sukses = $this->db->insert($table);
                    $sql .= $this->db->last_query().";\n";
                    //$this->log();
                }
            }

            $this->log($sql);

            return ($sukses ? 1 : 0);
        }
    }


    /*===== fungsi untuk reinsert ke dalam database =====
     * $table (string/array) : nama tabel2
     * $where (string/array) : kondisi data yang ingin di filter
     * $value (string) : nilai dari kondisi
     */
    function mydelete($table = '', $where, $value = null) {
        if ($table === '') {
            $this->display_error('db_must_set_table');
        }

        if (is_array($where)) {
            foreach ($where as $key => $val) {
                $firstchar = substr($val, 0, 1);

                if ($firstchar == C_IDENTIFIER_WITHOUT_QUOTES && $val) {
                    $cond[$key] = str_replace(C_IDENTIFIER_WITHOUT_QUOTES, null, $val);
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

            if ($firstchar == C_IDENTIFIER_WITHOUT_QUOTES) {
                $value = str_replace(C_IDENTIFIER_WITHOUT_QUOTES, null, $value);
            } else {
                $value = "'$value'";
            }
        }

        if (is_array($table)) {
            $sql = '';
            $sukses = 0;

            foreach ($table as $key => $val) {
                $this->db->where($cond, $value, false);

                $sukses += $this->db->delete($val);
                $sql .= $this->db->last_query().";\n";
                //$this->log();
            }

            $this->log($sql);
        } else {
            $this->db->where($cond, $value, false);

            $sukses = $this->db->delete($table);
            $this->log();
        }

        return ($sukses ? 1 : 0);
    }


    /*===== fungsi untuk menjalankan store procedure =====
     * $sp (string) : nama store procedure
     * $param (array) : parameter-parameter untuk store procedure
     */
    function mysp($sp = '', $param = array()) {
        if ($sp === '') {
            $this->display_error('db_must_set_table');
        }

        $parameter = null;
        foreach ($param as $key => $value) {
            if ($key > 0) {
                $parameter .= ",";
            }

            $parameter .= $value;
        }

        $q = $this->db->query("CALL $sp($parameter)");

        return ($q->result_id ? 1 : 0);
    }
}