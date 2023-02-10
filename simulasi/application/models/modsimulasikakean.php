<?php

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Connection: close");


class Modsimulasikakean extends CI_Model {

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
	
	function getDetailProduct($controller){
		$sql = "select * from JAIM_300_PRODUK where CONTROLLER='".$controller."'";
		
		$query = $this->db->query($sql);
		$query->result();
		
		if($query->result() > 0){
	    	foreach ($query->result() as $city) {
	    		$row = $city;
	    	}
	   		return $row;
	    }else{
	    	return FALSE;
	    }
	}
	
	function insertNasabah($data){
		//$sql = "select * from tbl_produk where controller='".$controller."'";
		//$sql = "INSERT INTO JAIM_300_NASABAH ("ID_NASABAH", "NAMA", "ALAMAT", "KOTA", "PROVINSI", "EMAIL", "TELP", "TGL_LAHIR", "JENIS_KEL", "SESSION_ID") VALUES (1, 0, 0, 0, 0, 0, 0, 'TO_DATE(''1970-01-01'', ''YYYY-MM-DD'')', 0, 0)";
		
		//var_dump($data['ID_NASABAH']);
		//var_dump($data['NAMA']);
		//var_dump($data['ALAMAT']);
		//var_dump($data['KOTA']);
		//var_dump($data['PROVINSI']);
		//var_dump($data['EMAIL']);
		//var_dump($data['TELP']);
		//var_dump($data['TGL_LAHIR']);
		//var_dump($data['JENIS_KEL']);
		//var_dump($data['SESSION_ID']);
		
		echo $data['ID_NASABAH'];
		echo $data['NAMA'];
		echo $data['ALAMAT'];
		echo $data['KOTA'];
		echo $data['PROVINSI'];
		echo $data['EMAIL'];
		echo $data['TELP'];
		echo $data['TGL_LAHIR'];
		echo $data['JENIS_KEL'];
		echo $data['SESSION_ID'];
		
		$sql = "INSERT INTO JAIM_300_NASABAH (ID_NASABAH, NAMA, ALAMAT, KOTA, PROVINSI, EMAIL, TELP, TGL_LAHIR, JENIS_KEL, SESSION_ID) 
				VALUES (".$data['ID_NASABAH'].", ".$data['NAMA'].", ".$data['ALAMAT'].", ".$data['KOTA'].", ".$data['PROVINSI'].", ".$data['EMAIL'].", ".$data['TELP'].", TO_DATE(".$data['TGL_LAHIR'].", 'YYYY-MM-DD'), ".$data['JENIS_KEL'].", ".$data['SESSION_ID'].")";
		
		//echo $sql;
		$query = $this->db->query($sql);

		if ($query->num_rows() > 0)
		{
		   $row = $query->row_array(); 

		   return $row;
		}
		
		/*
		$this->db->_protect_identifiers = false;
		
		$query = $this->db->insert('JAIM_300_NASABAH',$data, FALSE);
		$insert_id = $this->db->insert_id();
		return $insert_id;
		*/
		//echo $query;
		//$query = $this->db->query($sql);
		//$query->result();
	}
	
	function insertSimulasi($data){
		$query = $this->db->insert('JAIM_300_HITUNG',$data);
		
		echo $query;
	}
	
	//Tambahan Model untuk POS PROMAPAN yang terbaru Teguh
	function getTarifUA_all($yearscalontertanggung){
		
		$sql = "select * from JAIM_300_TARIF_PROMAPAN_NEW where USIA = '$yearscalontertanggung' ";
		$query = $this->db->query($sql);

		if ($query->num_rows() > 0)
		{
			$row = $query->row_array(); 
			return $row;
		}
	}

	//Tambahan Model untuk POS PROMAPAN yang terbaru Teguh
	function getTarifUAPremi($kdproduk, $yearscalontertanggung){
		
		$sql = "SELECT * 
				FROM JAIM_300_TARIF_PREMI 
				WHERE KDPRODUK = '$kdproduk'
					AND USIA = '$yearscalontertanggung' ";
		$query = $this->db->query($sql);

		if ($query->num_rows() > 0)
		{
			$row = $query->row_array(); 
			return $row;
		}
	}

	function getAsumsiDanaInvest($yearscalontertanggung){		
		$sql = "select * from JAIM_400_ASUMSI_DANA_INVEST where USIA = '$yearscalontertanggung' ";
		$query = $this->db->query($sql);

		if ($query->num_rows() > 0)
		{
			$row = $query->row_array(); 
			return $row;
		}
	}

	function getTarifUA_SpousePayor($yearscalonpemegangpolis){
		
		$sql = "select * from JAIM_300_TARIF_PROMAPAN_NEW where USIA = '$yearscalonpemegangpolis' ";
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

	function getResikoAwal($kdnpert){
		
		$sql = "select * from JAIM_400_RESIKO_AWAL where NPERT = '$kdnpert'";
		$query = $this->db->query($sql);

		if ($query->num_rows() > 0)
		{
		   $row = $query->row_array(); 
		   return $row;
		}
	}

	//Tambahan Selesai


	function getBiayaAsuransi($yearscalontertanggung){
		$sql = "select * from JAIM_300_TARIF_TERMLIFE where TAHUNKE = '".$yearscalontertanggung."' AND BASISCODE='TU-02/12'";
		
		//echo $sql;
		$query = $this->db->query($sql);

		if ($query->num_rows() > 0)
		{
		   $row = $query->row_array(); 

		   return $row;
		}
	}
	
	function getNilaiTunaiTotal($key, $controller, $uangAsuransi){
		$sql = "SELECT $key/1000 * $uangAsuransi as NT FROM JAIM_300_NILAI_TUNAI a, JAIM_300_PRODUK b WHERE a.ID_PRODUK = 2 AND b.CONTROLLER = '".$controller."'";
										  
		$query = $this->db->query($sql);
										  
		$result = $query->row_array();

		return $result;
	}
	
	function getNilaiTunaiTotalOpt9($key, $controller, $uangAsuransi){
		$sql = "SELECT $key/1000 * $uangAsuransi as NT FROM JAIM_300_NILAI_TUNAI a, JAIM_300_PRODUK b WHERE a.ID_PRODUK = 3 AND b.CONTROLLER = '".$controller."'";
										  
		$query = $this->db->query($sql);
										  
		$result = $query->row_array();

		return $result;
	}
	
	
	function getNilaiTunai($controller){
		$sql = "SELECT a.* FROM JAIM_300_NILAI_TUNAI a, JAIM_300_PRODUK b WHERE a.ID_PRODUK = b.ID_PRODUK
				AND b.CONTROLLER = '".$controller."'";
				
		//echo $sql;
		$query = $this->db->query($sql);
		$query->result();
		
		if($query->result() > 0){
	    	foreach ($query->result() as $city) {
	    		$row = $city;
	    	}
	   		return $row;
	    }else{
	    	return FALSE;
	    }
	}
	
	function getTarif($modul,$masa,$usia, $uangasuransi){
		$sql = "select b.CARA_BAYAR, a.TARIF, a.MEDICAL, A.TARIF * ('".$uangasuransi."' / 1000) as HASILKALI from JAIM_300_TARIF a, JAIM_300_CARA_BAYAR b 
                where a.USIA = '".$usia."' and a.MASA = '".$masa."' and 
                a.PRODUK = '".$modul."' and a.CARABAYAR = b.KD_CARA_BAYAR";
		
		//echo $sql;
		$query = $this->db->query($sql);
		$query->result();
		
		if($query->result() > 0){
	    	foreach ($query->result() as $city) {
	    		$row[] = $city;
	    	}
	   		return $row;
	    }else{
	    	return FALSE;
	    }
	}
	
	function getTarif2($modul,$masa,$usia, $uangasuransi, $statusmedical){
		$sql = "select b.CARA_BAYAR, a.TARIF, a.MEDICAL, A.TARIF * ('".$uangasuransi."' / 1000) as HASILKALI from JAIM_300_TARIF a, JAIM_300_CARA_BAYAR b 
                where a.USIA = '".$usia."' and a.MASA = '".$masa."' and 
                a.PRODUK = '".$modul."' and a.CARABAYAR = b.KD_CARA_BAYAR and
				a.MEDICAL = '".$statusmedical."'";
		
		//echo $sql;
		$query = $this->db->query($sql);
		$query->result();
		
		if($query->result() > 0){
	    	foreach ($query->result() as $city) {
	    		$row[] = $city;
	    	}
	   		return $row;
	    }else{
	    	return FALSE;
	    }
	}
	
	function getPremiTambahanCI($masa, $usia, $kdtarif){
		$sql = "SELECT TARIF FROM JAIM_300_TARIF_JSLINKRAIDER
				WHERE MASA = '$masa'
				AND USIA = '$usia'
				AND CARA = 'B' AND KDTARIF = '$kdtarif'";
										  
		$query = $this->db->query($sql);
										  
		$result = $query->row_array();

		return $result;
	}
	
	function getPremiTambahanPA($masa, $usia, $kdtarif){
		$sql = "SELECT TARIF FROM JAIM_300_TARIF_JSLINKRAIDER
				WHERE MASA = '$masa'
				AND USIA = '$usia'
				AND CARA = 'B' AND KDTARIF = '$kdtarif'";
										  
		$query = $this->db->query($sql);
										  
		$result = $query->row_array();

		return $result;
	}
	
	function getPremiTambahanCTT($masa, $usia, $kdtarif){
		$sql = "SELECT TARIF FROM JAIM_300_TARIF_JSLINKRAIDER
				WHERE MASA = '$masa'
				AND USIA = '$usia'
				AND CARA = 'B' AND KDTARIF = '$kdtarif'";
										  
		$query = $this->db->query($sql);
										  
		$result = $query->row_array();

		return $result;
	}
	
	function getPremiTambahanWP($masa, $usia, $kdtarif){
		$sql = "SELECT TARIF FROM JAIM_300_TARIF_JSLINKRAIDER
				WHERE MASA = '$masa'
				AND USIA = '$usia'
				AND CARA = 'B' AND KDTARIF = '$kdtarif'";
										  
		$query = $this->db->query($sql);
										  
		$result = $query->row_array();

		return $result;
		
	}
	
	function getPremiTambahanWPDwigunaMenaik($masa, $usia, $kdtarif, $hasiltemp, $faktorkali){
		$sql = "SELECT TARIF/100*$hasiltemp*$faktorkali AS HASIL FROM JAIM_300_TARIF_JSLINKRAIDER
                WHERE MASA = '1'
                AND USIA = $usia
                AND CARA = 'B' AND KDTARIF = 'WPC'";
										  
		$query = $this->db->query($sql);
										  
		$result = $query->row_array();

		return $result;
		
	}
	
	function getPremiTambahanCPM($masa, $usia, $kdtarif){
		$sql = "SELECT TARIF FROM JAIM_300_TARIF_JSLINKRAIDER
				WHERE MASA = '$masa'
				AND USIA = '$usia'
				AND CARA = 'B' AND KDTARIF = '$kdtarif'";
										  
		$query = $this->db->query($sql);
										  
		$result = $query->row_array();

		return $result;
	}
	
	function getPremiTambahanCPB($masa, $usia, $kdtarif){
		$sql = "SELECT TARIF FROM JAIM_300_TARIF_JSLINKRAIDER
				WHERE MASA = '$masa'
				AND USIA = '$usia'
				AND CARA = 'B' AND KDTARIF = '$kdtarif'";
										  
		$query = $this->db->query($sql);
										  
		$result = $query->row_array();

		return $result;
	}
	
	function getPremiTambahanTERM($masa, $usia, $kdtarif){
		$sql = "SELECT TARIF FROM JAIM_300_TARIF_JSLINKRAIDER
				WHERE MASA = '$masa'
				AND USIA = '$usia'
				AND CARA = 'B' AND KDTARIF = '$kdtarif'";
										  
		$query = $this->db->query($sql);
										  
		$result = $query->row_array();

		return $result;
	}
	
	function getDetailProduk($kd_produk){
		$sql = "SELECT * FROM JAIM_300_PROD WHERE KD_PRODUK = '$kd_produk'";
										  
		$query = $this->db->query($sql);
										  
		$result = $query->row_array();

		return $result;
	}
	
	function getMinimalUA($usiasekarang){
		$sql = "SELECT MINIMAL FROM JAIM_300_FAKTOR_PENGALI WHERE USIA = '$usiasekarang'";
										  
		$query = $this->db->query($sql);
										  
		$result = $query->row_array();

		return $result;
	}
	
	function getMaksimalUA($usiasekarang){
		$sql = "SELECT MAKSIMAL FROM JAIM_300_FAKTOR_PENGALI WHERE USIA = '$usiasekarang'";
										  
		$query = $this->db->query($sql);
										  
		$result = $query->row_array();

		return $result;
	}
	
	function getBiayaAsuransiPerBulanAsuransiDasar($usia){
		$sql = "SELECT * FROM JAIM_300_TARIF_TERMLIFE WHERE TAHUNKE = '$usia' and BASISCODE = 'TU-02/12'";
										  
		$query = $this->db->query($sql);
										  
		$result = $query->row_array();

		return $result;
	}
	
	function getBiayaAsuransiPerBulanADDB($usia){
		$sql = "SELECT * FROM JAIM_300_TARIF_ADDB WHERE USIA = '$usia'";
										  
		$query = $this->db->query($sql);
										  
		$result = $query->row_array();

		return $result;
	}
	
	function getBiayaAsuransiPerBulanCI53($usia){
		$sql = "SELECT * FROM JAIM_300_TARIF_CI53 WHERE USIA = '$usia'";
										  
		$query = $this->db->query($sql);
										  
		$result = $query->row_array();

		return $result;
	}
	
	function getBiayaAsuransiPerBulanCI53JSProMapan($usia){
		$sql = "SELECT * FROM JAIM_300_TARIF_CI53_JSPROMAPAN WHERE USIA = '$usia'";
										  
		$query = $this->db->query($sql);
										  
		$result = $query->row_array();

		return $result;
	}
	
	function getBiayaAsuransiPerBulanHCP($yearscalontertanggung, $ranap, $statkelaminhcp){
		$sql = "SELECT * FROM JAIM_300_TARIF_HCP WHERE AGE = '$yearscalontertanggung' and RANAP = '$ranap' and TIPE = 'MURNI' and SEX = '$statkelaminhcp'";
										  
		$query = $this->db->query($sql);
										  
		$result = $query->row_array();

		return $result;
	}
	
	function getBiayaAsuransiPerBulanHCPDwigunaMenaik($yearscalontertanggung, $plafon, $statkelaminhcp){
		$sql = "SELECT TARIF FROM JAIM_300_TARIF_HCP WHERE AGE = '$yearscalontertanggung' and PLAFON = '$plafon' and TIPE = 'MURNI' and SEX = '$statkelaminhcp'";
										  
		$query = $this->db->query($sql);
										  
		$result = $query->row_array();

		return $result;
	}
	
	function getBiayaAsuransiPerBulanHCPJSProMapan($yearscalontertanggung, $plafon, $statkelaminhcp){
		$sql = "SELECT TARIF FROM JAIM_300_TARIF_HCP_JSPROMAPAN WHERE AGE = '$yearscalontertanggung' and PLAFON = '$plafon' and TIPE = 'MURNI' and SEX = '$statkelaminhcp'";
										  
		$query = $this->db->query($sql);
										  
		$result = $query->row_array();

		return $result;
	}
	
	function getBiayaAsuransiPerBulanHCPBJSProMapan($yearscalontertanggung, $plafon, $statkelaminhcp){
		$sql = "SELECT TARIF FROM JAIM_300_TARIF_HCP_JSPROMAPAN WHERE AGE = '$yearscalontertanggung' and PLAFON = '$plafon' and TIPE = 'BEDAH' and SEX = '$statkelaminhcp'";
										  
		$query = $this->db->query($sql);
										  
		$result = $query->row_array();

		return $result;
	}
	
	function getBiayaAsuransiPerBulanHCPBedah($yearscalontertanggung, $statkelaminhcp, $plafonhcpbedah){
		$sql = "SELECT * FROM JAIM_300_TARIF_HCP WHERE AGE = '$yearscalontertanggung' and TIPE = 'BEDAH' and SEX = '$statkelaminhcp' and PLAFON = '$plafonhcpbedah'";
										  
		$query = $this->db->query($sql);
										  
		$result = $query->row_array();

		return $result;
	}
	
	function getBiayaAsuransiPerBulanHCPBedahDwigunaMenaik($yearscalontertanggung, $statkelaminhcp, $plafonhcpbedah){
		$sql = "SELECT TARIF FROM JAIM_300_TARIF_HCP WHERE AGE = '$yearscalontertanggung' and TIPE = 'BEDAH' and SEX = '$statkelaminhcp' and PLAFON = '$plafonhcpbedah'";
										  
		$query = $this->db->query($sql);
										  
		$result = $query->row_array();

		return $result;
	}
	
	
	
	function getBiayaAsuransiPerBulanHCPS($usiasekarang, $uangasuransihcpjssinergy, $carabayar){
		$sql = "SELECT TARIF FROM JAIM_300_TARIF_HCPS WHERE AGE = '$usiasekarang' and PLAFON = '$uangasuransihcpjssinergy' and CARABAYAR= '$carabayar'";
										  
		$query = $this->db->query($sql);
										  
		$result = $query->row_array();

		return $result;
	}
	
	function getBiayaAsuransiPerBulanTPD($usia){
		$sql = "SELECT * FROM JAIM_300_TARIF_TPD WHERE USIA = '$usia'";
										  
		$query = $this->db->query($sql);
										  
		$result = $query->row_array();

		return $result;
	}
	
	function getBiayaAsuransiPerBulanTPDJSProMapan($usia){
		$sql = "SELECT * FROM JAIM_300_TARIF_TPD_JSPROMAPAN WHERE USIA = '$usia'";
										  
		$query = $this->db->query($sql);
										  
		$result = $query->row_array();

		return $result;
	}
	
	function getBiayaAsuransiPerBulanTermLife($usia){
		$sql = "SELECT * FROM JAIM_300_TARIF_TERMLIFE WHERE TAHUNKE = '$usia' and BASISCODE = 'TU-02/10'";
										  
		$query = $this->db->query($sql);
										  
		$result = $query->row_array();

		return $result;
	}
	
	function getBiayaAsuransiPerBulanTermJSProMapan($usia){
		$sql = "SELECT * FROM JAIM_300_TARIF_TL_JSPROMAPAN WHERE TAHUNKE = '$usia' and BASISCODE = 'TU-02/10'";
										  
		$query = $this->db->query($sql);
										  
		$result = $query->row_array();

		return $result;
	}
	
	function getBiayaAsuransiPerBulanTerm($usia){
		$sql = "SELECT * FROM JAIM_300_TARIF_TERM WHERE USIA = '$usia'";
										  
		$query = $this->db->query($sql);
										  
		$result = $query->row_array();

		return $result;
	}
	
	function getBiayaAsuransiPerBulanTermLifeJL3($usia){
		$sql = "SELECT * FROM JAIM_300_TARIF_TERMLIFE WHERE TAHUNKE = '$usia' and BASISCODE = 'TU/040-15'";
										  
		$query = $this->db->query($sql);
										  
		$result = $query->row_array();

		return $result;
	}
	
	function getBiayaAsuransiPerBulanPBD($usia){
		$sql = "SELECT * FROM JAIM_300_TARIF_PBD WHERE USIA = '$usia'";
										  
		$query = $this->db->query($sql);
										  
		$result = $query->row_array();

		return $result;
	}
	
	function getBiayaAsuransiPerBulanPBTPD($usia){
		$sql = "SELECT * FROM JAIM_300_TARIF_PB_TPD WHERE USIA = '$usia'";
										  
		$query = $this->db->query($sql);
										  
		$result = $query->row_array();

		return $result;
	}
	
	function getBiayaAsuransiPerBulanSPD($usia){
		$sql = "SELECT * FROM JAIM_300_TARIF_SPD WHERE USIA = '$usia'";
										  
		$query = $this->db->query($sql);
										  
		$result = $query->row_array();

		return $result;
	}
	
	function getBiayaAsuransiPerBulanSPTPD($usia){
		$sql = "SELECT * FROM JAIM_300_TARIF_SP_TPD WHERE USIA = '$usia'";
										  
		$query = $this->db->query($sql);
										  
		$result = $query->row_array();

		return $result;
	}
	
	function getJSSiharta($carabayar, $rangeusia){
		$sql = "SELECT * FROM JAIM_300_TARIF_JSSIHARTA WHERE CARABAYAR = '$carabayar'and RANGEUSIA = '$rangeusia' and (SELECT COUNT(NO) FROM JAIM_300_TARIF_JSSIHARTA WHERE CARABAYAR = '$carabayar'and RANGEUSIA = '$rangeusia' )  <= '35' ORDER BY NO ASC";
										  
		$query = $this->db->query($sql);
										  
		$result = $query->result_array();

		return $result;
	}
	
	function getPremiSekaligusDwiguna($masaasuransi, $usiasekarang){
		$sql = "SELECT * FROM JAIM_300_TARIF_JSDWIGUNA WHERE MASAPEMB = '$masaasuransi'and USIA = '$usiasekarang' and TIPETARIF = 'sekaligus'";
										  
		$query = $this->db->query($sql);
										  
		$result = $query->row_array();

		return $result;
	
	}
	
	function getPremiTahunanDwiguna($masaasuransi, $usiasekarang){
		$sql = "SELECT * FROM JAIM_300_TARIF_JSDWIGUNA WHERE MASAPEMB = '$masaasuransi'and USIA = '$usiasekarang' and TIPETARIF = 'tahunan'";
										  
		$query = $this->db->query($sql);
										  
		$result = $query->row_array();

		return $result;
	
	}
	
	function getPremiSekaligusDwigunaMenaik($masaasuransi, $usiasekarang){
		$sql = "SELECT * FROM JAIM_300_TARIF_JSDWIGUNAMENAIK WHERE MASAPEMB = '$masaasuransi'and USIA = '$usiasekarang' and TIPETARIF = 'sekaligus'";
										  
		$query = $this->db->query($sql);
										  
		$result = $query->row_array();

		return $result;
	
	}
	
	function getPremi5TahunPertamaDwigunaMenaik($masaasuransi, $usiasekarang){
		$sql = "SELECT * FROM JAIM_300_TARIF_JSDWIGUNAMENAIK WHERE MASAPEMB = '$masaasuransi'and USIA = '$usiasekarang' and TIPETARIF = 'tahunan'";
										  
		$query = $this->db->query($sql);
										  
		$result = $query->row_array();

		return $result;
	
	}
	
	function getPremi5TahunBerikutnyaDwigunaMenaik($masaasuransi, $usiasekarang){
		$sql = "SELECT * FROM JAIM_300_TARIF_JSDWIGUNAMENAIK WHERE MASAPEMB = '$masaasuransi'and USIA = '$usiasekarang' and TIPETARIF = 'tahunan'";
										  
		$query = $this->db->query($sql);
										  
		$result = $query->row_array();

		return $result;
	
	}
	
	function getPremi5TahunPertamaDMPPlus($masaasuransi, $usiasekarang){
		$sql = "SELECT * FROM JAIM_300_TARIF_JSDMPPLUS WHERE MASAPEMB = '$masaasuransi'and USIA = '$usiasekarang' and TIPETARIF = 'tahunan'";
										  
		$query = $this->db->query($sql);
										  
		$result = $query->row_array();

		return $result;
	
	}
	
	function getPremi5TahunBerikutnyaDMPPlus($masaasuransi, $usiasekarang){
		$sql = "SELECT * FROM JAIM_300_TARIF_JSDMPPLUS WHERE MASAPEMB = '$masaasuransi'and USIA = '$usiasekarang' and TIPETARIF = 'tahunan'";
										  
		$query = $this->db->query($sql);
										  
		$result = $query->row_array();

		return $result;
	
	}
	
	function getPremiSekaligusDMPPlus($masaasuransi, $usiasekarang){
		$sql = "SELECT * FROM JAIM_300_TARIF_JSDMPPLUS WHERE MASAPEMB = '$masaasuransi'and USIA = '$usiasekarang' and TIPETARIF = 'sekaligus'";
										  
		$query = $this->db->query($sql);
										  
		$result = $query->row_array();

		return $result;
	
	}
	
	function GetPremiSekaligusNilaiTebusJSDMPPlus($idx){
		$sql ="SELECT * FROM JAIM_300_TARIF_NILAITEBUS WHERE IDX = '$idx'and TIPENILAITEBUS = 'sekaligus'";
										  
		$query = $this->db->query($sql);
										  
		$result = $query->row_array();

		return $result;
	
	}
	
	function GetPremiTahunanNilaiTebusJSDMPPlus($idx){
		$sql ="SELECT * FROM JAIM_300_TARIF_NILAITEBUS WHERE IDX = '$idx'and TIPENILAITEBUS = 'tahunan'";
										  
		$query = $this->db->query($sql);
										  
		$result = $query->row_array();

		return $result;
	
	}
	
	/*
	function testJaim(){
		$sql = "SELECT * FROM jaim.JAIM_001_KANTOR where KDKANTOR='KP'";
		$query = $this->db2->query($sql);
										  
		$result = $query->row_array();

		return $result;
	}
	
	function cariDataAgen($noAgen){
		$sql = "SELECT * FROM jaim.JAIM_000_USER where USERID = '$noAgen'";
		$query = $this->db2->query($sql);
										  
		$result = $query->row_array();

		return $result;
	}
	*/
	
	function cariDataKantor($kodeKantor){
		$sql = "SELECT REPLACE( NAMAKANTOR, 'KANTOR CABANG', '' ) AS NAMAKANTOR FROM JAIM_001_KANTOR where KDKANTOR= '$kodeKantor'";
		$query = $this->db->query($sql);
										  
		$result = $query->row_array();

		return $result;
	}
	
	/*function getBeasiswaYangDiterimaJSCaturKarsa($masaasuransi, $usiasekarang){
		$sql = "SELECT * FROM `tbl_tarif_jscaturkarsa` WHERE masapemb = '$masaasuransi'and usia = '$usiasekarang' and tipetarif = 'sekaligus'";
		
		$query = $this->db->query($sql);
										  
		$result = $query->row_array();

		return $result;
	}*/
	
	function getPremiSekaligusJSCaturKarsa($masaasuransi, $usiasekarang){
		$sql = "SELECT * FROM JAIM_300_TARIF_JSCATURKARSA WHERE MASAPEMB = '$masaasuransi'and USIA = '$usiasekarang' and TIPETARIF = 'sekaligus'";
		
		$query = $this->db->query($sql);
										  
		$result = $query->row_array();

		return $result;
	}
	
	function getPremiTahunanJSCaturKarsa($masaasuransi, $usiasekarang){
		$sql = "SELECT * FROM JAIM_300_TARIF_JSCATURKARSA WHERE MASAPEMB = '$masaasuransi'and USIA = '$usiasekarang' and TIPETARIF = 'tahunan'";
		
		$query = $this->db->query($sql);
										  
		$result = $query->row_array();

		return $result;
	}
	
	function getJumlahRisikoAwalJSKelangsunganPendidikan($masaasuransi, $usiasekarang){
		$sql = "SELECT $masaasuransi FROM JAIM_300_TARIF_RISIKO_AWAL_JKP WHERE USIA = '$usiasekarang'";
		
		$query = $this->db->query($sql);
										  
		$result = $query->row_array();

		return $result;
	}
	
	function getPremiSekaligusJSKelangsunganPendidikan($masaasuransi, $usiasekarang){
		$sql = "SELECT $masaasuransi FROM JAIM_300_TARIF_PREMI_SKG_JKP WHERE USIA = '$usiasekarang'";
		
		$query = $this->db->query($sql);
										  
		$result = $query->row_array();

		return $result;
	}
	
	function getJumlahRisikoAwalJSGajiTerusanPlatinum($masaasuransijsgajiterusan){
		$sql = "SELECT TARIF FROM JAIM_300_TARIF_RISIKO_AWAL_GTP WHERE MASAASURANSI = '$masaasuransijsgajiterusan'";
		
		$query = $this->db->query($sql);
										  
		$result = $query->row_array();

		return $result;
	}
	
	function getPremiJSGajiTerusanPlatinum($masaasuransijsgajiterusan, $usiasekarang){
		$sql = "SELECT $usiasekarang FROM JAIM_300_TARIF_PREMI_GTP WHERE MASAASURANSI = '$masaasuransijsgajiterusan'";
		
		$query = $this->db->query($sql);
										  
		$result = $query->row_array();

		return $result;
	}
	
	function getPremiJsPrestasiAnakKe1($statusmedical, $usiaanakket, $usiatertanggung1jssiharta){
		$sql = "SELECT $usiaanakket FROM JAIM_300_TARIF_JSPRESTASI_THN WHERE USIA = '$usiatertanggung1jssiharta' AND STATUSMEDICAL = '$statusmedical'";
		
		$query = $this->db->query($sql);
										  
		$result = $query->row_array();

		return $result;
	}
	
	function getPremiJsPrestasiAnakKe2($statusmedical2, $usiaanakket2, $usiatertanggung2jssiharta){
		$sql = "SELECT $usiaanakket2 FROM JAIM_300_TARIF_JSPRESTASI_THN WHERE USIA = '$usiatertanggung2jssiharta' AND STATUSMEDICAL = '$statusmedical2'";
		
		$query = $this->db->query($sql);
										  
		$result = $query->row_array();

		return $result;
	}
	
	function GetTarifAnuitasASP($usiasekarang, $statuskawin){
		$sql = "SELECT * FROM JAIM_300_TARIF_JSANUITAS WHERE USIA = '$usiasekarang' and JENISANUITAS = 'ASP' and STATUSKAWIN = '$statuskawin'";
		
		$query = $this->db->query($sql);
										  
		$result = $query->row_array();

		return $result;
	}
	
	function GetTarifAnuitasASI($usiasekarang, $statuskawin){
		$sql = "SELECT * FROM JAIM_300_TARIF_JSANUITAS WHERE USIA = '$usiasekarang' and JENISANUITAS = 'ASI' and STATUSKAWIN = '$statuskawin'";
		
		$query = $this->db->query($sql);
										  
		$result = $query->row_array();

		return $result;
	}
	
	function GetTarifAnuitasANI($usiasekarang, $statuskawin){
		$sql = "SELECT * FROM JAIM_300_TARIF_JSANUITAS WHERE USIA = '$usiasekarang' and JENISANUITAS = 'ANI' and STATUSKAWIN = '$statuskawin'";
		
		$query = $this->db->query($sql);
										  
		$result = $query->row_array();

		return $result;
	}
	
	function GetTarifAnuitasAEP($usiasekarang, $statuskawin){
		$sql = "SELECT * FROM JAIM_300_TARIF_JSANUITAS WHERE USIA = '$usiasekarang' and JENISANUITAS = 'AEP' and STATUSKAWIN = '$statuskawin'";
		
		$query = $this->db->query($sql);
										  
		$result = $query->row_array();

		return $result;
	}
	
	function GetTarifAnuitasAIP($usiasekarang){
		$sql = "SELECT * FROM JAIM_300_TARIF_JSANUITAS WHERE USIA = '$usiasekarang' and JENISANUITAS = 'AIP' and STATUSKAWIN = 'kawin'";
		
		$query = $this->db->query($sql);
										  
		$result = $query->row_array();

		return $result;
	}
	
	function getDataJSProteksiKeluarga($status){
		
		$sql = "SELECT * FROM JAIM_300_TARIF_JSPK WHERE STATUS = '".$status."'";
	
		$query = $this->db->query($sql);
										  
		$result = $query->row_array();

		return $result;
	}
	
	function getPremiJSSin3rgy($paket, $carabayarpremi, $usiasekarang){
		
		$sql = "SELECT $paket FROM JAIM_300_TARIF_JSSIN3RGY WHERE USIA = '$usiasekarang' AND CARABAYAR = '$carabayarpremi'";
	
		$query = $this->db->query($sql);
										  
		$result = $query->row_array();

		return $result;	
	
	}
	
	function getPremiBulananJSSin3rgy($paket, $usiasekarang){
		
		$sql = "SELECT $paket FROM JAIM_300_TARIF_JSSIN3RGY WHERE USIA = '$usiasekarang' AND CARABAYAR = 'Bulanan'";
	
		$query = $this->db->query($sql);
										  
		$result = $query->row_array();

		return $result;	
	
	}
	
	function getPremiTahunanJSSin3rgy($paket, $usiasekarang){
		
		$sql = "SELECT $paket FROM JAIM_300_TARIF_JSSIN3RGY WHERE USIA = '$usiasekarang' AND CARABAYAR = 'Tahunan'";
	
		$query = $this->db->query($sql);
										  
		$result = $query->row_array();

		return $result;	
	
	}
	
	function getDataPaket($paket){
		
		$sql = "select * FROM JAIM_300_TARIF_PAKET_JSSIN3RGY WHERE PAKET = '$paket'";
	
		$query = $this->db->query($sql);
										  
		$result = $query->row_array();

		return $result;	
	
	}
	
	function GetIdHit(){
		$sql = "SELECT MAX(ID_HIT) AS ID_HIT FROM JAIM_300_HITUNG";
		
		$query = $this->db->query($sql);
										  
		$result = $query->row_array();

		return $result;
		
	}
	
	function GetIdNasabah(){
		$sql = "SELECT COUNT (*) AS ID_NASABAH FROM JAIM_300_NASABAH";
		
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
	
	function GetDataAgen2($NoProspek){
		$sql = "SELECT* FROM JAIM_201_PROSPEK WHERE NOPROSPEK = '$NoProspek'";
		
		$query = $this->db->query($sql);
										  
		$result = $query->row_array();

		return $result;
		
	}
	
	function GetDataProvinsi($KodeProvinsi){
		$sql = "SELECT* FROM JAIM_001_PROVINSI WHERE KDPROVINSI = '$KodeProvinsi'";
		
		$query = $this->db->query($sql);
										  
		$result = $query->row_array();

		return $result;
		
	}
	
	function pdfoptima7($namaFile){
		$namaFile = time();
		
 		$this->pdf->AddPage();
	    $this->pdf->SetFont('Arial','',10);
	    $this->pdf->WriteHTML($html);
	    $this->pdf->Output('./files/pdf/'.$namaFile.'.pdf','F');

	}
	
	function insertProposal($nama_customer, $nama_produk, $kode_proposal, $nomer_agen){
		//$sql="insert into tbl_proposal (NAMA_CUSTOMER, NAMA_PRODUK, KODE_PROPOSAL, NOMER_AGEN) values ('".$nama_customer."', '".$nama_produk."', '".$kode_proposal."', '".$nomer_agen."')";
		
		//$query = $this->db->query($sql);
		

	}
	
	function CallGenerateHasilTemp($IDProposal) {
	
		$sql = "CALL GENERATE_HASIL_TEMP('".$IDProposal."')";
		
		//var_dump($sql);
		
		$this->db->query($sql);
		
	}
	
	function insertSessionTemp($data) {
		
		$query = $this->db->insert('SESSION_TEMP',$data);
		
	}

	function getManfaat1Kepret($id) {
		$sql = "SELECT tahun, usia, premi, topup, manfaat_rendah, manfaat_sedang, manfaat_tinggi,
					meninggal_rendah, meninggal_sedang, meninggal_tinggi
				FROM manfaat1_temp
				WHERE id_proposal = '$id'
				ORDER BY tahun";
				
		$query = $this->db->query($sql);
		
		$result = $query->result_array();
		
		return $result;
	}
	
	function getManfaat2Kepret($id) {
		$sql = "SELECT tahun, usia, premi, topup, manfaat_rendah, manfaat_sedang, manfaat_tinggi,
					meninggal_rendah, meninggal_sedang, meninggal_tinggi
				FROM manfaat2_temp
				WHERE id_proposal = '$id'
				ORDER BY tahun";
				
		$query = $this->db->query($sql);
		
		$result = $query->result_array();
		
		return $result;
		
	}
	
	//ASKRED
	
	function getTarifAskred($usiasekarang){
		$sql = "SELECT * FROM JAIM_300_TARIF_ASKRED WHERE MASAASURANSI = '$usiasekarang'";
										  
		$query = $this->db->query($sql);
										  
		$result = $query->row_array();

		return $result;
	}
	
	function getTarifJSPNS($usiasekarang, $statusjspns, $carabayarpremijspns){
		$sql = "SELECT * FROM JAIM_300_TARIF_JSPNS WHERE USIA = '$usiasekarang' AND STATUS = '$statusjspns' AND CARABAYAR = '$carabayarpremijspns'";
										  
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
		
		echo($query);
	}

	function insertProJua($data){
		
		$query = $this->db->insert('PRO_JUA',$data);
		
		echo($query);
	}

	// End Tambahan Baru
	
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
	 
	function GenerateAllDataV2($buildid){
		$sql = "CALL JAIM.gen_all_data_v2('".$buildid."')";
		
		$query = $this->db->query($sql);
		//echo $query;
	}
	
	//PDF
	
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
		 from PRO_ALOKASI_DANA A 
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
	
	function selectProAlokasiDanaIFG($buildid){
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
		 from PRO_ALOKASI_DANA A 
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
	
	function getSaranUA($carabayarjspromapannew, $usiasekarang, $totalpremi){
		$sql = "select f_ua_suggest('$carabayarjspromapannew','$usiasekarang','$totalpremi') as suggest from dual";
		
		$query = $this->db->query($sql);
										  
		$result = $query->row_array();

		return $result;
		
	}
	
	function getBuildID(){
		$sql = "select F_GEN_BUILD_ID AS BUILDID from dual";
		
		$query = $this->db->query($sql);
										  
		$result = $query->row_array();

		return $result;
		
	}
	
	
	/*enhanced iie : 02052019*/
	
	function setUAByRider($data){
		
		
		$as_BUILDID = $data['as_BUILDID'];
		$as_cb 		= $data['as_cb'];
		$as_usia 	= $data['as_usia'];
		$as_dana 	= $data['as_dana'];
		
		$sql = "CALL JAIM.set_UA_by_RIDER('".$as_BUILDID."', '".$as_cb."', '".$as_usia."', '".$as_dana."')";
		
		$query = $this->db->query($sql);		
		
		
		/*
		$as_BUILDID = $data['as_BUILDID'];
		$sql = "select * from PRO_DATA_RIDER where build_id =".$as_BUILDID;
		
		$query = $this->db->query($sql);
		*/
		
		return $query;
		
	}
	
	
	function getDataProRiderAll($buildID){
		
		
		$sql = "SELECT a.* FROM JAIM.PRO_DATA_RIDER a WHERE a.BUILD_ID = '$buildID' ";		
		$query = $this->db->query($sql);										  
		$result = $query->row_array();

		if (isset($result))
		{
			$resultz = $result['BUILD_ID']."|".$result['ADB']."|".$result['WAIVER_TPD']."|".$result['WAIVER_CI']."|".$result['CI']."|".$result['PLAFON_HCP_MURNI']."|".$result['IS_PAYOR_DEATH']."|".$result['IS_PAYOR_TPD']."|".$result['PAYOR_DEATH']."|".$result['PAYOR_TPD']."|".$result['IS_SPOUSE_DEATH']."|".$result['IS_SPOUSE_TPD']."|".$result['SPOUSE_DEATH']."|".$result['SPOUSE_TPD'];
		}
		
		$sql = "SELECT a.* FROM JAIM.PRO_ASURANSI_POKOK a WHERE a.BUILD_ID = '$buildID' ";		
		$query = $this->db->query($sql);										  
		$result2 = $query->row_array();
		
		if (isset($result2))
		{
			$resulty = $result2['UA'];
		}
		
		$xresult = $resultz."^".$resulty;
		
		return $xresult;
		//return $this->db->last_query();
		
	}
	
	function updateByRider($fieldName, $fieldNameUnset, $BUILDID){
		
		if($fieldName != "")
		{
			$sql = "UPDATE JAIM.PRO_DATA_RIDER SET $fieldName = '1', $fieldNameUnset WHERE BUILD_ID = '$BUILDID' ";	
		}
		else
		{
			$sql = "UPDATE JAIM.PRO_DATA_RIDER SET $fieldNameUnset WHERE BUILD_ID = '$BUILDID' ";	
		}
		$query = $this->db->query($sql);		
		
		
				
		return $query;
		
	}



	/*end of enhanced : iie 02052019*/
	
	
	/*enhanced Salman : 20082019*/
	
	function setUAByRiderv2($data){
		
		
		$as_BUILDID = $data['as_BUILDID'];
		$as_cb 		= $data['as_cb'];
		$as_usia 	= $data['as_usia'];
		$as_dana 	= $data['as_dana'];
		
		$sql = "CALL JAIM.set_UA_by_RIDER_v2('".$as_BUILDID."', '".$as_cb."', '".$as_usia."', '".$as_dana."')";
		
		$query = $this->db->query($sql);		
		
	
		return $query;
		
	}
	
	function getDataProRiderAllv2($buildID){
		
		
		$sql = "SELECT a.* FROM JAIM.PRO_DATA_RIDER a WHERE a.BUILD_ID = '$buildID' ";		
		$query = $this->db->query($sql);										  
		$result = $query->row_array();

		if (isset($result))
		{
			$resultz = $result['BUILD_ID']."|".$result['ADB']."|".$result['WAIVER_TPD']."|".$result['WAIVER_CI']."|".$result['CI']."|".$result['PLAFON_HCP_MURNI']."|".$result['IS_PAYOR_DEATH']."|".$result['IS_PAYOR_TPD']."|".$result['PAYOR_DEATH']."|".$result['PAYOR_TPD']."|".$result['IS_SPOUSE_DEATH']."|".$result['IS_SPOUSE_TPD']."|".$result['SPOUSE_DEATH']."|".$result['SPOUSE_TPD']."|".$result['IS_PAYOR_CI']."|".$result['IS_SPOUSE_CI']."|".$result['PAYOR_CI']."|".$result['SPOUSE_CI'];
		}
		
		$sql = "SELECT a.* FROM JAIM.PRO_ASURANSI_POKOK a WHERE a.BUILD_ID = '$buildID' ";		
		$query = $this->db->query($sql);										  
		$result2 = $query->row_array();
		
		if (isset($result2))
		{
			$resulty = $result2['UA'];
		}
		
		$xresult = $resultz."^".$resulty;
		
		return $xresult;
		//return $this->db->last_query();
		
	}
	
	/*enhanced Salman : 20082019*/
	
}