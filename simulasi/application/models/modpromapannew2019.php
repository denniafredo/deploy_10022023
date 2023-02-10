<?php

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Connection: close");


class modpromapannew2019 extends CI_Model {

    var $details;
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library('pdf');
 	}
	
	function selectProTertanggung($buildid){
		$sql = "select A.*, 
				(SELECT NAMAPEKERJAAN FROM JAIM_400_JENIS_PEKERJAAN WHERE KDJENISPEKERJAAN = A.KDJNSPEKERJAAN) NAMAPEKERJAAN,
				(SELECT NAMAHOBI FROM jaim_301_hobi WHERE kdhobi = A.kdhobi) NAMAHOBI,
				(SELECT LIFEEXTRA FROM JAIM_400_JENIS_PEKERJAAN WHERE KDJENISPEKERJAAN= A.KDJNSPEKERJAAN) EKSTRALIFE_CTT,
				(SELECT PAEXTRA FROM JAIM_400_JENIS_PEKERJAAN WHERE KDJENISPEKERJAAN= A.KDJNSPEKERJAAN) EKSTRAPA_CTT,
				(SELECT TPDEXTRA FROM JAIM_400_JENIS_PEKERJAAN WHERE KDJENISPEKERJAAN= A.KDJNSPEKERJAAN) EKSTRATPD_CTT,
				(SELECT resiko FROM JAIM_301_RESIKO WHERE kdhobi = A.kdhobi AND kdjenisresiko = 'LIFE') EKSTRAHOBILIFE_CTT,
				(SELECT resiko FROM JAIM_301_RESIKO WHERE kdhobi = A.kdhobi AND kdjenisresiko = 'PA') EKSTRAHOBIPA_CTT
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
	
	function selectProPempol($buildid){
		$sql = "select A.*, 
				(SELECT NAMAPEKERJAAN FROM JAIM_400_JENIS_PEKERJAAN WHERE KDJENISPEKERJAAN = A.KDJNSPEKERJAAN) NAMAPEKERJAAN,
				(SELECT NAMAHOBI FROM jaim_301_hobi WHERE kdhobi = A.kdhobi) NAMAHOBI,
				(SELECT LIFEEXTRA FROM JAIM_400_JENIS_PEKERJAAN WHERE KDJENISPEKERJAAN= A.KDJNSPEKERJAAN) EKSTRALIFE_CPP,
				(SELECT PAEXTRA FROM JAIM_400_JENIS_PEKERJAAN WHERE KDJENISPEKERJAAN= A.KDJNSPEKERJAAN) EKSTRAPA_CPP,
				(SELECT TPDEXTRA FROM JAIM_400_JENIS_PEKERJAAN WHERE KDJENISPEKERJAAN= A.KDJNSPEKERJAAN) EKSTRATPD_CPP,
				(SELECT resiko FROM JAIM_301_RESIKO WHERE kdhobi = A.kdhobi AND kdjenisresiko = 'LIFE') EKSTRAHOBILIFE_CPP,
				(SELECT resiko FROM JAIM_301_RESIKO WHERE kdhobi = A.kdhobi AND kdjenisresiko = 'PA') EKSTRAHOBIPA_CPP
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
	
	function selectProAsuransiPokok($buildid){
		$sql = "select * from PRO_ASURANSI_POKOK where build_id ='".$buildid."'";
		
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
		$sql = "select build_id,
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

	function selectProDataRiderNew($buildid){
		$sql = "SELECT *
			FROM JAIM.PRO_DATA_RIDER_NEW
			WHERE build_id = '".$buildid."'";
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
	
	function selectProKeteranganRider($buildid){
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
	
	function selectProDataRider($buildid){
		$sql = "SELECT B.JENIS,NAMA,DESKRIPSI,URUT,SU,B.BUILD_ID,B.NILAI PREMI,C.NILAI UA
			FROM PRO_REDAKSI A,pro_premi_th1 B, PRO_JUA C
			WHERE a.jenis = b.jenis
			and a.jenis = c.jenis
			and b.build_id = c.build_id
			and b.build_id = '.$buildid.' 
			and b.nilai > 0
		 order by urut";
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
		$sql = "select * from PRO_TOTAL_BIAYA_ALL where build_id ='".$buildid."'";
		
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
		$sql = "select * from PRO_TOTAL_INVESTASI1 where build_id ='".$buildid."' order by TAHUN";
		
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
		$sql = "select * from PRO_TOTAL_INVESTASI2 where build_id ='".$buildid."' order by TAHUN";
		
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
		$sql = "select * from PRO_TOTAL_INVESTASI1 where build_id ='".$buildid."' order by TAHUN";
		
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