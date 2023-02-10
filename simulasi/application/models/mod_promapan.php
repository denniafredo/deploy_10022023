<?php

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Connection: close");


class mod_promapan extends CI_Model {

    var $details;
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library('pdf');
 	}
	
	

/*
$sql2 = 'select * from PRO_TERTANGGUNG where build_id = '.$buildid;
$query2 = $this->db->query($sql2);

$sql3 = 'select * from PRO_ASURANSI_POKOK where build_id = '.$buildid;
$query3 = $this->db->query($sql3);

$sql4 = 'select A.*,
			   (SELECT FUNDALOCNAME FROM PRO_ALOKASI_FUND WHERE FUNDALOCID = A.NAMA_ALOKASI1) NAMA_ALOKASI1,
			   (SELECT FUNDALOCNAME FROM PRO_ALOKASI_FUND WHERE FUNDALOCID = A.NAMA_ALOKASI2) NAMA_ALOKASI2  
		 from PRO_ALOKASI_DANA A 
		 where build_id = '.$buildid;
$query4 = $this->db->query($sql4);

$sql5 = 'SELECT B.JENIS,NAMA,DESKRIPSI,URUT,SU,B.BUILD_ID,B.NILAI PREMI,C.NILAI UA
			FROM PRO_REDAKSI A,pro_premi_th1 B, PRO_JUA C
			WHERE a.jenis = b.jenis
			and a.jenis = c.jenis
			and b.build_id = c.build_id
			and b.build_id = '.$buildid.' 
			and b.nilai > 0
		 order by urut';
$query5 = $this->db->query($sql5);


$sql7 = 'select * from PRO_TOTAL_INVESTASI1 where build_id = '.$buildid;
$query7 = $this->db->query($sql7);

$sql8 = 'select * from PRO_TOTAL_INVESTASI2 where build_id = '.$buildid;
$query8 = $this->db->query($sql8);

$sql9 = 'select * from PRO_TOTAL_RINGKASAN where build_id = '.$buildid;
$query9 = $this->db->query($sql9);

$sql10 = 'select * from PRO_TOTAL_RINGKASAN where build_id = '.$buildid;
$query10 = $this->db->query($sql10);
*/
	
	function getDataPempol(){
		$sql = 'select * from PRO_PEMPOL where build_id = '.$buildid;
		
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
	
	
	
	function GetSessionData($idProposal) {
		$sql = "SELECT * FROM SESSION_TEMP where ID_PROPOSAL = $idProposal";
		
		$query = $this->db->query($sql);
		
		$result = $query->result_array();
		
		return $result;
	}
	
	function insertProTertanggung($data){
		
		$query = $this->db->insert('PRO_TERTANGGUNG',$data);
		
		echo($query);
	}
	
	function insertProPempol($data){
		
		$query = $this->db->insert('PRO_PEMPOL',$data);
		
		echo($query);
	}
	
	function insertProAsuransiPokok($data){
		
		$query = $this->db->insert('PRO_ASURANSI_POKOK',$data);
		
		echo($query);
	}
	
	function insertProAlokasiDana($data){
		
		$query = $this->db->insert('PRO_ALOKASI_DANA',$data);
		
		echo($query);
	}
	
	function insertProDataRider($data){
		
		$query = $this->db->insert('PRO_DATA_RIDER',$data);
		
//		echo($query);
	}
	
	function selectMaxIDTertanggung(){
		$sql = "SELECT MAX(BUILD_ID) AS BUILD_ID FROM PRO_TERTANGGUNG";
		
		$query = $this->db->query($sql);
										  
		$result = $query->row_array();

		return $result;
	}
	
	function selectMaxIDPempol(){
		$sql = "SELECT MAX(BUILD_ID) AS BUILD_ID FROM PRO_PEMPOL";
		
		$query = $this->db->query($sql);
										  
		$result = $query->row_array();

		return $result;
	}
	
	function selectMaxIDAsuransiPokok(){
		$sql = "SELECT MAX(BUILD_ID) AS BUILD_ID FROM PRO_ASURANSI_POKOK";
		
		$query = $this->db->query($sql);
										  
		$result = $query->row_array();

		return $result;
	}
	
	function selectMaxIDAlokasiDana(){
		$sql = "SELECT MAX(BUILD_ID) AS BUILD_ID FROM PRO_ALOKASI_DANA";
		
		$query = $this->db->query($sql);
										  
		$result = $query->row_array();

		return $result;
	}
	
	function selectMaxIDDataRider(){
		$sql = "SELECT MAX(BUILD_ID) AS BUILD_ID FROM PRO_DATA_RIDER";
		
		$query = $this->db->query($sql);
										  
		$result = $query->row_array();

		return $result;
	}
	
	function GenerateAllData($buildid){
		$sql = "CALL JAIM.gen_all_data('".$buildid."')";
		
		$query = $this->db->query($sql);
		
	}
	
	//PDF
	
	function selectProTertanggung($buildid){
		$sql = "select * from PRO_TERTANGGUNG where build_id ='".$buildid."'";
		
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
	
	function selectProPempol($buildid){
		$sql = "select * from PRO_PEMPOL where build_id =".$buildid;
		
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
	
	function selectProAsuransiPokok($buildid){
		$sql = "select * from PRO_ASURANSI_POKOK where build_id =".$buildid;
		
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
	
	function selectProAlokasiDana($buildid){
		$sql = 'select build_id,
					   nama_alokasi1,alokasi1*100 alokasi1,
					   nama_alokasi2,ALOKASI2*100 alokasi2,
			   (SELECT FUNDALOCNAME FROM PRO_ALOKASI_FUND WHERE FUNDALOCID = A.NAMA_ALOKASI1) NAMA_ALOKASI1,
			   (SELECT FUNDALOCNAME FROM PRO_ALOKASI_FUND WHERE FUNDALOCID = A.NAMA_ALOKASI2) NAMA_ALOKASI2,
			   (SELECT LOWPERCENT FROM PRO_ALOKASI_FUND WHERE FUNDALOCID = A.NAMA_ALOKASI1)*100 prolow1,
			   (SELECT MEDIUMPERCENT FROM PRO_ALOKASI_FUND WHERE FUNDALOCID = A.NAMA_ALOKASI1)*100 promed1,
			   (SELECT HIGHPERCENT FROM PRO_ALOKASI_FUND WHERE FUNDALOCID = A.NAMA_ALOKASI1)*100 prohigh1,       
			   (SELECT LOWPERCENT FROM PRO_ALOKASI_FUND WHERE FUNDALOCID = A.NAMA_ALOKASI2)*100 prolow2,
			   (SELECT MEDIUMPERCENT FROM PRO_ALOKASI_FUND WHERE FUNDALOCID = A.NAMA_ALOKASI2)*100 promed2,
			   (SELECT HIGHPERCENT FROM PRO_ALOKASI_FUND WHERE FUNDALOCID = A.NAMA_ALOKASI2)*100 prohigh2	
		 from PRO_ALOKASI_DANA A 
		 where build_id = '.$buildid;
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
	
	function selectProDataRider($buildid){
		$sql = 'SELECT B.JENIS,NAMA,DESKRIPSI,URUT,SU,B.BUILD_ID,B.NILAI PREMI,C.NILAI UA
			FROM PRO_REDAKSI A,pro_premi_th1 B, PRO_JUA C
			WHERE a.jenis = b.jenis
			and a.jenis = c.jenis
			and b.build_id = c.build_id
			and b.build_id = '.$buildid.' 
			and b.nilai > 0
		 order by urut';
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
	
	function selectProTotalBiayaAll($buildid){
		$sql = "select * from PRO_TOTAL_BIAYA_ALL where build_id =".$buildid;
		
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
	
	function selectProTotalInvestasi1($buildid){
		$sql = "select * from PRO_TOTAL_INVESTASI1 where build_id =".$buildid." order by TAHUN";
		
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
	
	function selectProTotalInvestasi2($buildid){
		$sql = "select * from PRO_TOTAL_INVESTASI2 where build_id =".$buildid." order by TAHUN";
		
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
	
	function selectProTotalRingkasan($buildid){
		$sql = "select * from PRO_TOTAL_RINGKASAN where build_id =".$buildid." order by TAHUN";
		
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
	
	function selectProTotalKomparasi($buildid){
		$sql = "select * from PRO_TOTAL_KOMPARASI where build_id =".$buildid." order by TAHUN";
		
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