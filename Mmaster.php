<?php

/* 
 * Ini adalah halaman koneksi ke database.
 * 
 * Create by : Fendy Christianto
 */

class Mmaster extends MY_Model {
    
    function get_list_jenis_kelamin() {
        $sql = "SELECT a.kdjeniskelamin, a.namajeniskelamin
                FROM jaim_301_jenis_kelamin a
                ORDER BY a.namajeniskelamin";
        $db = $this->db->query($sql);
        $data = $db->result_array();
        $db->free_result();
        
        return $data;
    }
    
    function get_list_hubungan() {
        $sql = "SELECT a.kdhubungan, a.namahubungan, a.nourut
                FROM jaim_301_hubungan a
                ORDER BY a.nourut";
        $db = $this->db->query($sql);
        $data = $db->result_array();
        $db->free_result();
        
        return $data;
    }
    
    function get_list_produk($kdjabatanagen) {
        /*if($kdjabatanagen == '29') {
            $produk = "and a.kdproduk = 'JL4BLN'";
        } else {
            $produk = '';
        }*/
        $sql = "SELECT a.kdproduk, a.namaproduk, a.usiamin, a.usiamax, a.premimin, a.premimax,
                    uamin, uamax
                FROM jaim_301_produk a
                WHERE kdstatus = 1
                ORDER BY a.namaproduk";
        
        $db = $this->db->query($sql);
        $data = $db->result_array();
        $db->free_result();
        
        return $data; 
    }
    
    function get_list_pekerjaan() {
        $sql = "SELECT a.kdpekerjaan, a.namapekerjaan
                FROM jaim_301_pekerjaan a
                WHERE kdstatus = 1
                ORDER BY a.namapekerjaan";
        $db = $this->db->query($sql);
        $data = $db->result_array();
        $db->free_result();
        
        return $data;
    }
    
    function get_list_hobi() {
        $sql = "SELECT a.kdhobi, a.namahobi
                FROM jaim_301_hobi a
                WHERE kdstatus = 1
                ORDER BY a.namahobi";
        $db = $this->db->query($sql);
        $data = $db->result_array();
        $db->free_result();
        
        return $data;
    }
    
    function get_list_resiko($kdpekerjaan, $kdhobi) {
        $sql = "SELECT a.kdresiko, a.kdpekerjaan, a.kdhobi, a.kdjenisresiko, a.resiko, a.pembagi, a.flag
                FROM jaim_301_resiko a
                WHERE ".($kdpekerjaan ? "kdpekerjaan = '$kdpekerjaan'" : "").
                    ($kdhobi ? "kdhobi = '$kdhobi'" : "");
        $db = $this->db->query($sql);
        $data = $db->result_array();
        $db->free_result();
        
        return $data;
    }
    
    function get_list_provinsi() {
        $DBJL = $this->load->database('jlindo', TRUE);
        
        $sql = "SELECT a.kdpropinsi, a.namapropinsi
                FROM tabel_108_propinsi a
                WHERE kdstatus = 1
                ORDER BY a.namapropinsi";
        $db = $DBJL->query($sql);
        $data = $db->result_array();
        $db->free_result();
        
        return $data;
    }
    
    function get_list_kota($kdprovinsi) {
        $DBJL = $this->load->database('jlindo', TRUE);
        
        $sql = "SELECT a.kdpropinsi, a.kdkotamadya, a.namakotamadya
                FROM tabel_109_kotamadya a
                WHERE a.kdpropinsi LIKE '%$kdprovinsi%'
                    AND a.kdstatus = 1
                ORDER BY a.namakotamadya";
        $db = $DBJL->query($sql);
        $data = $db->result_array();
        $db->free_result();
        
        return $data;
    }
    
    function get_list_kecamatan($kdkotamadya) {
        $DBJL = $this->load->database('jlindo', TRUE);
        
        $sql = "SELECT a.kdpropinsi, a.kdkotamadya, a.kdkecamatan, a.namakecamatan
                FROM tabel_110_kecamatan a
                WHERE a.kdkotamadya LIKE '%$kdkotamadya%'
                ORDER BY a.namakecamatan";
        $db = $DBJL->query($sql);
        $data = $db->result_array();
        $db->free_result();
        
        return $data;
    }
    
    function get_list_kelurahan($kdkecamatan) {
        $DBJL = $this->load->database('jlindo', TRUE);
        
        $sql = "SELECT a.kdpropinsi, a.kdkotamadya, a.kdkecamatan, a.kdkelurahan, a.namakelurahan, a.kodepos
                FROM tabel_111_kelurahan a
                WHERE a.kdkecamatan LIKE '%$kdkecamatan%'
                ORDER BY a.namakelurahan";
        $db = $DBJL->query($sql);
        $data = $db->result_array();
        $db->free_result();
        
        return $data;
    }
    
    function get_list_cara_bayar() {
        $DBJL = $this->load->database('jlindo', TRUE);
        
        $sql = "SELECT a.kdcarabayar, a.namacarabayar
                FROM tabel_305_cara_bayar a
                WHERE kdstatus = 1
                ORDER BY a.namacarabayar";
        $db = $DBJL->query($sql);
        $data = $db->result_array();
        $db->free_result();
        
        return $data;
    }
    
    function get_list_dana($kdproduk) {
        $sql = "SELECT a.kdfund, b.namafund, a.rendah, a.sedang, a.tinggi
                FROM jaim_301_produk_fund a
                INNER JOIN jaim_301_fund b ON a.kdfund = b.kdfund
                WHERE a.kdproduk = '$kdproduk'
                ORDER BY b.namafund";
        $db = $this->db->query($sql);
        $data = $db->result_array();
        $db->free_result();
        
        return $data;
    }
    
    function get_list_agenjlindo() {
        $DBJL = $this->load->database('jlindo', TRUE);
        $sql = "SELECT a.noagen, b.namaklien1, b.emailtetap, a.kdstatusagen, c.namastatusagen, a.kdjabatanagen, 
                    e.namajabatanagen, a.kdareaoffice, a.kdunitproduksi, a.kdkantor, d.namakantor, 
                    CASE WHEN d.phone01 IS NOT NULL AND d.phone02 IS NOT NULL THEN d.phone01 || ' / ' || d.phone02
                        WHEN d.phone01 IS NOT NULL AND d.phone02 IS NULL THEN d.phone01 ELSE d.phone02 
                    END AS phonekantor, d.email emailkantor, 
                    f.namakantor namainduk, 
                    CASE WHEN f.phone01 IS NOT NULL AND f.phone02 IS NOT NULL THEN f.phone01 || ' / ' || f.phone02
                        WHEN f.phone01 IS NOT NULL AND f.phone02 IS NULL THEN f.phone01 ELSE f.phone02 
                    END AS phoneinduk,
                    f.email emailinduk,
                    a.nolisensiagen, TO_CHAR(a.tglmulailisensi, 'dd-mm-yyyy') tglmulailisensi,
                    TO_CHAR(a.tglakhirlisensi, 'dd-mm-yyyy') tglakhirlisensi
                FROM tabel_400_agen a
                INNER JOIN tabel_100_klien b ON a.noagen = b.noklien
                LEFT OUTER JOIN tabel_409_status_agen c ON a.kdstatusagen = c.kdstatusagen
                LEFT OUTER JOIN tabel_001_kantor d ON a.kdkantor = d.kdkantor
                LEFT OUTER JOIN tabel_413_jabatan_agen e ON a.kdjabatanagen = e.kdjabatanagen
                LEFT OUTER JOIN tabel_001_kantor f ON d.kdkantorinduk = f.kdkantor
                ORDER BY b.namaklien1";
        $db = $DBJL->query($sql);
        $data = $db->result_array();
        $db->free_result();
        
        return $data;
    }
    
    function get_hubungan($kdhubungan) {
        $sql = "SELECT a.kdhubungan, a.namahubungan, a.nourut
                FROM jaim_301_hubungan a
                WHERE a.kdhubungan = '$kdhubungan'";
        $db = $this->db->query($sql);
        $data = $db->row_array();
        $db->free_result();
        
        return $data;
    }
    
    function get_jenis_kelamin($kdjeniskelamin) {
        $sql = "SELECT a.kdjeniskelamin, a.namajeniskelamin
                FROM jaim_301_jenis_kelamin a
                WHERE a.kdjeniskelamin = '$kdjeniskelamin'";
        $db = $this->db->query($sql);
        $data = $db->row_array();
        $db->free_result();
        
        return $data;
    }
    
    function get_produk($kdproduk) {
        $sql = "SELECT a.kdproduk, a.namaproduk, a.usiamin, a.usiamax, a.premimin, a.premimax,
                    uamin, uamax
                FROM jaim_301_produk a
                WHERE kdproduk = '$kdproduk'";
        $db = $this->db->query($sql);
        $data = $db->row_array();
        $db->free_result();
        
        return $data;
    }
    
    function get_pekerjaan($kdpekerjaan) {
        $sql = "SELECT a.kdpekerjaan, a.namapekerjaan
                FROM jaim_301_pekerjaan a
                WHERE kdpekerjaan = '$kdpekerjaan'";
        $db = $this->db->query($sql);
        $data = $db->row_array();
        $db->free_result();
        
        return $data;
    }
    
    function get_hobi($kdhobi) {
        $sql = "SELECT a.kdhobi, a.namahobi
                FROM jaim_301_hobi a
                WHERE kdhobi = '$kdhobi'";
        $db = $this->db->query($sql);
        $data = $db->row_array();
        $db->free_result();
        
        return $data;
    }
    
    function get_provinsi($kdprovinsi) {
        $DBJL = $this->load->database('jlindo', TRUE);
        
        $sql = "SELECT a.kdpropinsi, a.namapropinsi
                FROM tabel_108_propinsi a
                WHERE a.kdpropinsi = '$kdprovinsi'";
        $db = $DBJL->query($sql);
        $data = $db->row_array();
        $db->free_result();
        
        return $data;
    }
    
    function get_kota($kdkotamadya) {
        $DBJL = $this->load->database('jlindo', TRUE);
        
        $sql = "SELECT a.kdpropinsi, a.kdkotamadya, a.namakotamadya
                FROM tabel_109_kotamadya a
                WHERE a.kdkotamadya = '$kdkotamadya'";
        $db = $DBJL->query($sql);
        $data = $db->row_array();
        $db->free_result();
        
        return $data;
    }
    
    function get_kecamatan($kdkecamatan) {
        $DBJL = $this->load->database('jlindo', TRUE);
        
        $sql = "SELECT a.kdpropinsi, a.kdkotamadya, a.kdkecamatan, a.namakecamatan
                FROM tabel_110_kecamatan a
                WHERE a.kdkecamatan = '$kdkecamatan'";
        $db = $DBJL->query($sql);
        $data = $db->row_array();
        $db->free_result();
        
        return $data;
    }
    
    function get_kelurahan($kdkelurahan) {
        $DBJL = $this->load->database('jlindo', TRUE);
        
        $sql = "SELECT a.kdpropinsi, a.kdkotamadya, a.kdkecamatan, a.kdkelurahan, a.namakelurahan, a.kodepos
                FROM tabel_111_kelurahan a
                WHERE a.kdkelurahan = '$kdkelurahan'";
        $db = $DBJL->query($sql);
        $data = $db->row_array();
        $db->free_result();
        
        return $data;
    }
    
    function get_cara_bayar($kdcarabayar) {
        $DBJL = $this->load->database('jlindo', TRUE);
        
        $sql = "SELECT a.kdcarabayar, a.namacarabayar
                FROM tabel_305_cara_bayar a
                WHERE kdcarabayar = '$kdcarabayar'";
        $db = $DBJL->query($sql);
        $data = $db->row_array();
        $db->free_result();
        
        return $data;
    }
    
    function get_dana($kdproduk, $kdfund) {
        $sql = "SELECT a.kdfund, b.namafund, a.rendah, a.sedang, a.tinggi
                FROM jaim_301_produk_fund a
                INNER JOIN jaim_301_fund b ON a.kdfund = b.kdfund
                WHERE a.kdfund = '$kdfund'
                    AND a.kdproduk = '$kdproduk'";
        $db = $this->db->query($sql);
        $data = $db->row_array();
        $db->free_result();
        
        return $data;
    }
    
    function get_agen($username) {
        $sql = "SELECT iduser, kdrole, username, password, namalengkap, email, sessionid, firebasetoken
                FROM jaim_900_user
                WHERE LOWER(username) = '".strtolower($username)."'";
        $db = $this->db->query($sql);
        $data = $db->row_array();
        $db->free_result();
        
        return $data;
    }
    
    function get_agenjlindo($username) {
        $DBJL = $this->load->database('jlindo', TRUE);
        $sql = "SELECT a.noagen, b.namaklien1, b.emailtetap, a.kdstatusagen, c.namastatusagen, a.kdjabatanagen, 
                    e.namajabatanagen, a.kdareaoffice, a.kdunitproduksi, a.kdkantor, d.namakantor, 
                    CASE WHEN d.phone01 IS NOT NULL AND d.phone02 IS NOT NULL THEN d.phone01 || ' / ' || d.phone02
                        WHEN d.phone01 IS NOT NULL AND d.phone02 IS NULL THEN d.phone01 ELSE d.phone02 
                    END AS phonekantor, d.email emailkantor, 
                    f.namakantor namainduk, 
                    CASE WHEN f.phone01 IS NOT NULL AND f.phone02 IS NOT NULL THEN f.phone01 || ' / ' || f.phone02
                        WHEN f.phone01 IS NOT NULL AND f.phone02 IS NULL THEN f.phone01 ELSE f.phone02 
                    END AS phoneinduk,
                    f.email emailinduk
                FROM tabel_400_agen a
                INNER JOIN tabel_100_klien b ON a.noagen = b.noklien
                LEFT OUTER JOIN tabel_409_status_agen c ON a.kdstatusagen = c.kdstatusagen
                LEFT OUTER JOIN tabel_001_kantor d ON a.kdkantor = d.kdkantor
                LEFT OUTER JOIN tabel_413_jabatan_agen e ON a.kdjabatanagen = e.kdjabatanagen
                LEFT OUTER JOIN tabel_001_kantor f ON d.kdkantorinduk = f.kdkantor
                WHERE a.noagen = '$username'";
        $db = $DBJL->query($sql);
        $data = $db->row_array();
        $db->free_result();
        
        return $data;
    }
    
    function get_log($log) {
        $sql = "SELECT a.*, FLOOR((sysdate - a.tglrekam) * 24 * 60) selisihmenit
                FROM jaim_999_log a
                WHERE log LIKE '%$log%'
                ORDER BY tglrekam DESC";
        $db = $this->db->query($sql);
        $data = $db->row_array();
        $db->free_result();
        
        return $data;
    }
    
    function get_tarif($kdtarif, $kdproduk, $kdbenefit, $kdjeniskelamin, $usiath, $usiabl, $bk) {
        $sql = "SELECT kdtarif, kdproduk, kdbenefit, kdjeniskelamin, usiath, usiabl, bk, tarif
                FROM jaim_301_tarif
                WHERE kdtarif LIKE '%$kdtarif%'
                    AND kdproduk LIKE '%$kdproduk%'
                    AND kdbenefit LIKE '%$kdbenefit%'
                    AND kdjeniskelamin LIKE '%$kdjeniskelamin%'
                    AND usiath LIKE '%$usiath%'
                    AND usiabl LIKE '%$usiabl%'
                    AND bk LIKE '%$bk%'";
        $db = $this->db->query($sql);
        $data = $db->row_array();
        $db->free_result();
        
        return $data;
    }
	
	function get_user_log() {
        $sql = "SELECT iduser, kdrole, username, password, namalengkap, email, sessionid, firebasetoken, token
                FROM jaim_900_user";
        $db = $this->db->query($sql);
        $data = $db->result_array();
        $db->free_result();
        
        return $data;
    }
	
	function get_jenis_document($where='')
    {
        $this->db->select('*');
        $this->db->from('JAIM_301_JENIS_DOKUMEN');
        if (@$where != null) {
            $this->db->where($where);
        }
        return $this->db->get();
    }
	
	function get_history_mutasi($where, $order = '', $orderWhere = 'asc'){
		$dba = $this->load->database('jlindo', TRUE);
		$this->db->select("a.NOSPAJ, a.BUILDID, b.PREFIXPERTANGGUNGAN, b.NOPERTANGGUNGAN, b.NOPOLBARU, c.*, to_char(c.TGLMUTASI, 'dd-mm-yyyy hh24:mi:ss' ) as tgl_mutasi, to_char(c.AGENDA_DATE, 'dd-mm-yyyy hh24:mi:ss' ) as AGENDA_DATE");
		$this->db->from('TABEL_SPAJ_ONLINE@JLINDO a');
		$this->db->join('TABEL_200_PERTANGGUNGAN@JLINDO b', 'a.NOSPAJ = b.NOSP', 'inner');
		$this->db->join('TABEL_600_HISTORIS_MUTASI_PERT@JLINDO c', 'b.PREFIXPERTANGGUNGAN = c.PREFIXPERTANGGUNGAN AND b.NOPERTANGGUNGAN = c.NOPERTANGGUNGAN', 'inner');
		$this->db->where($where);
		
		if(@$order != ''){
			$this->db->order_by($order, $orderWhere);
		}else{
			$this->db->order_by('c.TGLMUTASI', 'desc');
		}
		return $this->db->get();
	}
	
	function history_mutasi_followup($where, $order = 'z.TGLMUTASI asc') {
		$dba = $this->load->database('jlindo', TRUE);
        $sql = "SELECT c.*, z.*, to_char(z.TGLMUTASI, 'dd-mm-yyyy hh24:mi:ss' ) as tgl_mutasi, to_char(z.AGENDA_DATE, 'dd-mm-yyyy hh24:mi:ss' ) as AGENDA_DATE FROM 
				(SELECT distinct a.NOSPAJ, a.BUILDID, b.PREFIXPERTANGGUNGAN, b.NOPERTANGGUNGAN, b.NOPOLBARU 
				FROM TABEL_SPAJ_ONLINE@JLINDO a INNER JOIN TABEL_200_PERTANGGUNGAN@JLINDO b ON a.NOSPAJ = b.NOSP) c 
				INNER JOIN TABEL_600_HISTORIS_MUTASI_PERT@JLINDO z ON c.PREFIXPERTANGGUNGAN||c.NOPERTANGGUNGAN = z.PREFIXPERTANGGUNGAN||z.NOPERTANGGUNGAN 
				WHERE z.KDMUTASI = {$where['KDMUTASI']} AND z.KDSTATUS = {$where['KDSTATUS']}";
				
		if(@$where['AGENDA_DATE']){
			$sql .= " AND trunc(z.AGENDA_DATE) = {$where['AGENDA_DATE']}";
		}elseif(@$where['from'] && @$where['to']){
			$sql .= " AND trunc(z.AGENDA_DATE) BETWEEN {$where['from']} AND {$where['to']}";
		}elseif(@$where['bundle']){
			$sql .= " AND trunc(z.AGENDA_DATE, 'MM') = {$where['bundle']}";
		}
		
		$sql .= " order by ".$order;
		
        $db = $this->db->query($sql);
        $data = $db->result();
        $db->free_result();
        
        return $data;
    }
	
	function get_polis_mutasi($where){
		$dba = $this->load->database('jlindo', TRUE);
		$this->db->select("a.NOSPAJ, a.BUILDID, b.PREFIXPERTANGGUNGAN, b.NOPERTANGGUNGAN, b.NOPOLBARU");
		$this->db->from('TABEL_SPAJ_ONLINE@JLINDO a');
		$this->db->join('TABEL_200_PERTANGGUNGAN@JLINDO b', 'a.NOSPAJ = b.NOSP', 'inner');
		$this->db->where($where);
		
		return $this->db->get();
	}

    function get_BuildId($where)
    {
		$this->db->select('a.*, b.JENIS_DOKUMEN');
		$this->db->from('JAIM_302_DOKUMEN a');
		$this->db->join('JAIM_301_JENIS_DOKUMEN b', 'a.JENIS_DOKUMEN_ID = b.ID', 'inner');
		$this->db->where($where);
        return $this->db->get();
    }

    function insertDokumen($object)
    {
        $this->db->insert('JAIM_302_DOKUMEN', $object);
        return $this->db->affected_rows() > 0 ? true : false ;
    }
	
	function updateDokumen($object, $where)
    {
        $this->db->where($where);
        $this->db->update('JAIM_302_DOKUMEN', $object);
        return $this->db->affected_rows() > 0 ? true : false ;
    }
	
	public function get_processBuildWelcoming($where)
    {
		$dba = $this->load->database('jlindo', TRUE);
        if (empty($where)) {
            return [];
        }
        
        return $this->db->get_where('TABEL_SPAJ_ONLINE@JLINDO', $where);
    }
	
	
    public function insertMutasiWelcoming($object)
    {
        $dba = $this->load->database('jlindo', TRUE);
		
		$this->db->where([
			'PREFIXPERTANGGUNGAN' => $object['PREFIXPERTANGGUNGAN'],
			'NOPERTANGGUNGAN' => $object['NOPERTANGGUNGAN'],
			'KDMUTASI' => 52
		]);
		$this->db->update('TABEL_600_HISTORIS_MUTASI_PERT@JLINDO', ['FINALSTATUS' => 0]);

        $this->db->insert('TABEL_600_HISTORIS_MUTASI_PERT@JLINDO', $object);
        return $this->db->affected_rows() > 0 ? true : false ;
    }
}
