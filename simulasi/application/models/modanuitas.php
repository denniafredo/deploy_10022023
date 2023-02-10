<?php

// header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
// header("Cache-Control: post-check=0, pre-check=0", false);
// header("Pragma: no-cache");
// header("Connection: close");


class Modanuitas extends CI_Model {

    var $details;
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library('pdf');
 	}
	
	function allProvince(){
		$sql = "select * from JAIM_001_PROVINSI order by NAMAPROVINSI asc";
		
		$query = $this->db->query($sql);
		$query->result();
		
		if($query->result() > 0){
	    	foreach ($query->result() as $city) {
	    		$row[$city->KDPROVINSI] = $city->NAMAPROVINSI;
	    	}
	   		return $row;
	    }else{
	    	return FALSE;
	    }
	}
	
	function allProduct(){
		$sql = "select * from JAIM_300_PRODUK order by ID_PRODUK asc";
		
		$query = $this->db->query($sql);
		$query->result();
		
		if($query->result() > 0){
	    	foreach ($query->result() as $city) {
	    		$row[$city->ID_PRODUK.'|'.$city->CONTROLLER] = $city->NAMA_PRODUK;
	    	}
	   		return $row;
	    }else{
	    	return FALSE;
	    }	
	}
	
	//Tambahan Model untuk POS PROMAPAN yang terbaru Teguh
	function getTarifAnuitas($usia_th, $usia_bl, $statuskawin){
		
		$sql = "SELECT tarif FROM JAIM_301_TARIF WHERE KDPRODUK = 'AJSAN' AND KDTARIF = 'STD' AND USIATH = '$usia_th' AND USIABL = '$usia_bl' AND BK = '$statuskawin' ";
		$query = $this->db->query($sql);

		if ($query->num_rows() > 0)
		{
			$row = $query->row_array(); 
			return $row;
		}
	}

	function insertSimulasi($data){
		$query = $this->db->insert('JAIM_300_HITUNG',$data);
		
		echo $query;
	}
	

	function cariDataKantor($kodeKantor){
		$sql = "SELECT REPLACE( NAMAKANTOR, 'KANTOR CABANG', '' ) AS NAMAKANTOR FROM JAIM_001_KANTOR where KDKANTOR= '$kodeKantor'";
		$query = $this->db->query($sql);
										  
		$result = $query->row_array();

		return $result;
	}
	
	function GetDataAgen($KodeProspek){
		$sql = "SELECT* FROM JAIM_201_PROSPEK WHERE NOPROSPEK = '$KodeProspek'";
		
		$query = $this->db->query($sql);
										  
		$result = $query->row_array();

		return $result;
		
	}
	
	function GetDataProvinsi($KodeProvinsi){
		$sql = "SELECT * FROM JAIM_001_PROVINSI WHERE KDPROVINSI = '$KodeProvinsi'";
		
		$query = $this->db->query($sql);
										  
		$result = $query->row_array();

		return $result;
		
	}
	
	function GetSessionData($idProposal) {
		$sql = "SELECT * FROM SESSION_TEMP where ID_PROPOSAL = $idProposal";
		
		$query = $this->db->query($sql);
		
		$result = $query->result_array();
		
		return $result;
	}
	

	//Tambahan Untuk POS PROMAPAN Baru - Teguh
	function insertProPempolNew($data){
		
		$query = $this->db->insert('PRO_PEMPOL',$data);
		
		echo($query);
	}
	function insertProTertanggungNew($data){
		
		$query = $this->db->insert('PRO_TERTANGGUNG',$data);
		
		echo($query);
	}

	
	function selectProTertanggung($buildid){
		$sql = "select * from PRO_TERTANGGUNG where build_id ='".$buildid."'";
		
		$query = $this->db->query($sql);
		
		$result = $query->row_array();
		
		return $result;
		
	}
	
	function selectProPempol($buildid){
		$sql = "select * from PRO_PEMPOL where build_id ='".$buildid."'";
		
		$query = $this->db->query($sql);
		
		return $result;
		
	}
	
	function getBuildID(){
		$sql = "select F_GEN_BUILD_ID AS BUILDID from dual";
		
		$query = $this->db->query($sql);
										  
		$result = $query->row_array();

		return $result;
		
	}

	/*Function untuk Create PDF - Teguh 26/11/2019*/
	function selectProTertanggungPdf($buildid){
		$sql = "SELECT * FROM PRO_TERTANGGUNG WHERE build_id ='".$buildid."'";
		
		$query = $this->db->query($sql);
		
		if($query->result() > 0){
			foreach ($query->result() as $data) {
				$row[] = $data;
			}
			return $row;
		}else{
			return FALSE;
		}
	}

	function selectProPempolPdf($buildid){
		$sql = "SELECT * FROM PRO_PEMPOL WHERE build_id ='".$buildid."'";
		
		$query = $this->db->query($sql);
		
		if($query->result() > 0){
	    	foreach ($query->result() as $data) {
	    		$row[] = $data;
	    	}
	   		return $row;
	    }else{
	    	return FALSE;
	    }	
	}

	function select300HitungPdf($buildid){
		$sql = "SELECT JUMLAH_PREMI, PHT, TO_CHAR(TGL_REKAM, 'DD/MM/YYYY') MULAS FROM JAIM_300_HITUNG WHERE build_id ='".$buildid."'";
		
		$query = $this->db->query($sql);
		
		if($query->result() > 0){
	    	foreach ($query->result() as $data) {
	    		$row[] = $data;
	    	}
	   		return $row;
	    }else{
	    	return FALSE;
	    }	
	}
	
	
}