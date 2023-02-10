<?php

class Spajonline_model extends CI_Model {
	
    //function SPAJ Log
	function postLog_SPAJ($username){
		$sukses = 0;
		$kdlog = 'SPAJ'.date("dmY");
		$log = 'SPAJ LOGIN USER : '.$username;
		
        $this->db->trans_begin();

        $this->db->query("INSERT INTO JAIM_999_LOG (KDLOG, LOG, TGLREKAM, USERREKAM) VALUES ('$kdlog', '$log', sysdate, '$username')");
					 
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        }
        else {
            $sukses = $this->db->trans_commit();
        }

        return ($sukses ? C_STATUS_SUKSES_SIMPAN : C_STATUS_GAGAL_SIMPAN);
	}

	/*===== daftar status proposal =====*/
    function get_token($username,$password) {
        $data = array(); 

        $q = $this->db
            ->query("SELECT * FROM JAIM_900_USER WHERE upper(username) = '$username' and upper(password) = '$password' ");

        if ($q->num_rows() > 0) {
            $data = $q->result();
			if(is_array($q->result())){
				$data = $q->result();
				$data = $data[0];
			}
        }
        $q->free_result();

		
        return $data->MOBILETOKEN;
    }
	
	/*===== get follow up by id =====*/
    function get_spaj($buildid) {
        $data = array();

        $q = $this->db
           ->query("SELECT a.nospaj, a.status, a.kodeagen, TO_CHAR(a.tanggalrekam, 'dd-mm-yyyy hh24:mi:ss') tglrekam, a.tanggalrekam, a.tanggalupdate, 
						a.userupdate, a.menyetujuiketentuan, a.mengertiketentuan, a.guid, a.dokumenaksep, a.buildid, a.produk, a.keterangan1, a.keterangan2,
						statussoa, nopolis, scapproved, scusername, tglscapproved, nomorspajcetak, nmpempol, nmtertanggung, 
						a.kdkirimpolis, b.namaklien1 namaagen, NVL(c.namauser, d.namaklien1) namauser
					FROM tabel_spaj_online@jlindo a
					LEFT OUTER JOIN tabel_100_klien@jlindo b ON a.kodeagen = b.noklien
						AND b.kdklien = 'A'
					LEFT OUTER JOIN tabel_888_userid@jlindo c ON a.userupdate = c.userid
					LEFT OUTER JOIN tabel_100_klien@jlindo d ON a.userupdate = d.noklien
						AND d.kdklien = 'A'
					WHERE a.nospaj = (SELECT MAX(nospaj) FROM tabel_spaj_online@jlindo WHERE buildid = '$buildid' /*AND status >= '2'*/)");

        if ($q->num_rows() > 0)
            $data = $q->row_array();

        $q->free_result();

        return $data;
    }
}