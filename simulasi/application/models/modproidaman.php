<?php

// header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
// header("Cache-Control: post-check=0, pre-check=0", false);
// header("Pragma: no-cache");
// header("Connection: close");


class Modproidaman extends CI_Model {

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
	
	function insertSimulasi($data){
		$query = $this->db->insert('JAIM_300_HITUNG',$data);
		
		echo $query;
	}
	
	//Tambahan Model untuk POS PROMAPAN yang terbaru Teguh
	function getTarifUA_all($yearscalontertanggung){
		
		$sql = "select * from JAIM_300_TARIF_PROIDAMAN where USIA = '$yearscalontertanggung' ";
		$query = $this->db->query($sql);

		if ($query->num_rows() > 0)
		{
			$row = $query->row_array(); 
			return $row;
		}
	}



	function getEkstraPremi($kdjenispekerjaan){
		
		$sql = "select * from JAIM_400_JENIS_PEKERJAAN where KDJENISPEKERJAAN = '$kdjenispekerjaan' ";
		$query = $this->db->query($sql);

		if ($query->num_rows() > 0)
		{
		   $row = $query->row_array(); 
		   return $row;
		}
	}

	//Tambahan Selesai

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
	
	function insertProTertanggung($data){
		
		$query = $this->db->insert('PRO_TERTANGGUNG',$data);
		
		echo($query);
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
	function insertProAlokasiDanaNew($data){
		
		$query = $this->db->insert('PRO_ALOKASI_DANA_NEW',$data);
		
		echo($query);
	}
	function insertProDataRiderNew($data){
		
		$query = $this->db->insert('PRO_DATA_RIDER_NEW',$data);
		
		echo($query);
	}

	function insertProDataRiderOld($data){
		
		$query = $this->db->insert('PRO_DATA_RIDER',$data);
		
		//echo($query);
	}

	function insertProJua($data){
		
		$query = $this->db->insert('PRO_JUA',$data);
		
		//echo($query);
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
		
		
		/*tambahan untuk delete dulu supaya ga bentrok build_id nya : 02052019 */
		$build_id = $data['BUILD_ID'];
		
		$sql = "DELETE FROM PRO_DATA_RIDER WHERE BUILD_ID = '$build_id' ";		
		$this->db->query($sql);
		
		/*end of tambahan untuk delete dulu supaya ga bentrok build_id nya : 02052019 */
		
		
		$query = $this->db->insert('PRO_DATA_RIDER',$data);
		
		//echo($query);
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
	
	function selectProAsuransiPokok($buildid){
		$sql = "select * from PRO_ASURANSI_POKOK where build_id ='".$buildid."'";
		
		$query = $this->db->query($sql);
		
		return $result;
		
	}
	
	function selectProAlokasiDana($buildid){
		$sql = "select * from PRO_ALOKASI_DANA where build_id ='".$buildid."'";
		
		$query = $this->db->query($sql);
		
		return $result;
		
	}
	
	function selectProDataRider($buildid){
		$sql = "select * from PRO_DATA_RIDER where build_id ='".$buildid."'";
		
		$query = $this->db->query($sql);
		
		return $result;
		
	}
	
	function selectProTotalBiayaAll($buildid){
		$sql = "select * from PRO_TOTAL_BIAYA_ALL where build_id ='".$buildid."'";
		
		$query = $this->db->query($sql);
		
		return $result;
		
	}
	
	function selectProTotalInvestasi1($buildid){
		$sql = "select * from PRO_TOTAL_INVESTASI1 where build_id ='".$buildid."'";
		
		$query = $this->db->query($sql);
		
		return $result;
		
	}
	
	function selectProTotalInvestasi2($buildid){
		$sql = "select * from PRO_TOTAL_INVESTASI2 where build_id ='".$buildid."'";
		
		$query = $this->db->query($sql);
		
		return $result;
		
	}
	
	function selectProTotalRingkasan($buildid){
		$sql = "select * from PRO_TOTAL_RINGKASAN where build_id ='".$buildid."'";
		
		$query = $this->db->query($sql);
		
		return $result;
		
	}
	
	function selectProTotalKomparasi($buildid){
		$sql = "select * from PRO_TOTAL_KOMPARASI where build_id ='".$buildid."'";
		
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
		$sql = "select A.*, 
				(SELECT NAMAPEKERJAAN FROM JAIM_400_JENIS_PEKERJAAN WHERE KDJENISPEKERJAAN = A.KDJNSPEKERJAAN) NAMAPEKERJAAN,
				(SELECT LIFEEXTRA FROM JAIM_400_JENIS_PEKERJAAN WHERE KDJENISPEKERJAAN= A.KDJNSPEKERJAAN) EKSTRALIFE_CTT,
				(SELECT PAEXTRA FROM JAIM_400_JENIS_PEKERJAAN WHERE KDJENISPEKERJAAN= A.KDJNSPEKERJAAN) EKSTRAPA_CTT,
				(SELECT TPDEXTRA FROM JAIM_400_JENIS_PEKERJAAN WHERE KDJENISPEKERJAAN= A.KDJNSPEKERJAAN) EKSTRATPD_CTT
				from PRO_TERTANGGUNG A where build_id ='".$buildid."'";
		
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
		$sql = "select A.*, 
				(SELECT NAMAPEKERJAAN FROM JAIM_400_JENIS_PEKERJAAN WHERE KDJENISPEKERJAAN = A.KDJNSPEKERJAAN) NAMAPEKERJAAN,
				(SELECT LIFEEXTRA FROM JAIM_400_JENIS_PEKERJAAN WHERE KDJENISPEKERJAAN= A.KDJNSPEKERJAAN) EKSTRALIFE_CPP,
				(SELECT PAEXTRA FROM JAIM_400_JENIS_PEKERJAAN WHERE KDJENISPEKERJAAN= A.KDJNSPEKERJAAN) EKSTRAPA_CPP,
				(SELECT TPDEXTRA FROM JAIM_400_JENIS_PEKERJAAN WHERE KDJENISPEKERJAAN= A.KDJNSPEKERJAAN) EKSTRATPD_CPP
				from PRO_PEMPOL A where build_id ='".$buildid."'";
		
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
	
	function selectProAsuransiPokokPdf($buildid){
		$sql = "SELECT * FROM PRO_ASURANSI_POKOK WHERE build_id ='".$buildid."'";
		
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
	
	function selectProAlokasiDanaPdf($buildid) {
		$sql = "select build_id,
					   nama_alokasi1,alokasi1*100 alokasi1,
					   nama_alokasi2,ALOKASI2*100 alokasi2,
			   (SELECT FUNDALOCNAME FROM PRO_ALOKASI_FUND_NEW WHERE FUNDALOCID = A.NAMA_ALOKASI1) NAMA_ALOKASI1,
			   (SELECT FUNDALOCNAME FROM PRO_ALOKASI_FUND_NEW WHERE FUNDALOCID = A.NAMA_ALOKASI2) NAMA_ALOKASI2,
			   (SELECT LOWPERCENT FROM PRO_ALOKASI_FUND_NEW WHERE FUNDALOCID = A.NAMA_ALOKASI1)*100 prolow1,
			   (SELECT MEDIUMPERCENT FROM PRO_ALOKASI_FUND_NEW WHERE FUNDALOCID = A.NAMA_ALOKASI1)*100 promed1,
			   (SELECT HIGHPERCENT FROM PRO_ALOKASI_FUND_NEW WHERE FUNDALOCID = A.NAMA_ALOKASI1)*100 prohigh1,       
			   (SELECT LOWPERCENT FROM PRO_ALOKASI_FUND_NEW WHERE FUNDALOCID = A.NAMA_ALOKASI2)*100 prolow2,
			   (SELECT MEDIUMPERCENT FROM PRO_ALOKASI_FUND_NEW WHERE FUNDALOCID = A.NAMA_ALOKASI2)*100 promed2,
			   (SELECT HIGHPERCENT FROM PRO_ALOKASI_FUND_NEW WHERE FUNDALOCID = A.NAMA_ALOKASI2)*100 prohigh2	
		 from PRO_ALOKASI_DANA_NEW A 
		 where build_id = '".$buildid."'";
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

	function selectProDataRiderNewPdf($buildid){
		$sql = "SELECT * FROM JAIM.PRO_DATA_RIDER_NEW WHERE build_id = '".$buildid."'";
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

	function selectProKeteranganRiderPdf($buildid){
		$sql = 'SELECT * FROM JAIM.PRO_REDAKSI';
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

	function selectProTotalInvestasi1Pdf($buildid){
		$sql = "SELECT * FROM PRO_TOTAL_INVESTASI1 WHERE build_id =".$buildid." ORDER BY TAHUN";
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
	
	function selectProTotalInvestasi2Pdf($buildid){
		$sql = "select * from PRO_TOTAL_INVESTASI2 where build_id ='".$buildid."' ORDER BY TAHUN";
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
	
	function selectProTotalKomparasiPdf($buildid){
		$sql = "SELECT * FROM PRO_TOTAL_INVESTASI1 WHERE build_id =".$buildid." ORDER BY TAHUN";
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

	/*End Create PDF*/
	
}