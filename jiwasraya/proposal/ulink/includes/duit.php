<?
class Duit extends Database {
	var $userid;
	var $passwd;
	var $kurs;
	var $materai;
	var $beapolis;
	var $sysdate;
	var $tanggal;
	
	function Duit($userid="",$passwd="") {
		$this->userid=$userid;
		$this->passwd=$passwd;
		Database::Database($this->userid,$this->passwd,"IFGDB");
		$sql="select to_char(sysdate,'DD/MM/YYYY') sisdate from dual";	
		Database::parse($sql);
		Database::execute();
		$arr=Database::nextrow();
		$sysdate=$arr["SISDATE"];
		$this->sysdate=$sysdate;	
	} 
	function Kurs($valuta,$tgl="") {
		if (!$tgl) {
	    $tanggal=$this->sysdate;
		} else {
			$tanggal=$tgl;
		}	
		$sql="select kurs from nadm.tabel_999_kurs where tglkursberlaku=".
	       "(select max(tglkursberlaku) from nadm.tabel_999_kurs ".
	     	 "where tglkursberlaku<=to_date('$tanggal','DD/MM/YYYY') and kdvaluta='$valuta') ".
	     	 "and kdvaluta='$valuta'";	
		Database::parse($sql);
		Database::execute();
		$arr=Database::nextrow();
		$kurs=$arr["KURS"];
		$this->kurs=$kurs;
		return $kurs;
	}
	function Matre($nilai=""){
		if(!$nilai){
			$nilai=$this->kurs;
		}
		$sql="select nilaimeterai from nadm.tabel_999_batas_materai ".
	       "where $nilai between batasbawahpremi and batasataspremi ";
		   //echo $sql."<br>"; die;
    Database::parse($sql);
		Database::execute();
		$arr=Database::nextrow();
		$materai=$arr["NILAIMETERAI"];
		return $materai;
	}
	function BeaPolis($kdproduk="",$tanggal=""){
		if(!$tanggal){
			$tanggal=$this->sysdate;
		} else {
			$tanggal=$tanggal;
		}
		if(!$kdproduk){
			$kdproduk='DG0';
		} else {
			$kdproduk=$kdproduk;
		}
	  $sql="select biaya from nadm.tabel_999_biaya_polis ".
       	 "where kdproduk='$kdproduk' and tglbiayaberlaku=(select max(tglbiayaberlaku) from nadm.tabel_999_biaya_polis ".
				 "where tglbiayaberlaku<=to_date('$tanggal','DD/MM/YYYY') and kdproduk='$kdproduk')";
		//echo $sql."<br>"; die;
		Database::parse($sql);
		Database::execute();
		$arr=Database::nextrow();
		$beapolis=$arr["BIAYA"];
		return $beapolis;
	}
	
	 function MatreAktaGadai($tanggal=""){
		if(!$tanggal){
			$tanggal=$this->sysdate;
		} else {
			$tanggal=$tanggal;
		}

	  $sql="select nilai from nadm.tabel_999_materai ".
       	 "where tglberlaku=(select max(tglberlaku) from nadm.tabel_999_materai ".
				 "where tglberlaku<=to_date('$tanggal','DD/MM/YYYY') and kdmaterai='G')  and kdmaterai='G' ";
		//echo $sql;
		Database::parse($sql);
		Database::execute();
		$arr=Database::nextrow();
		$matreakta=$arr["NILAI"];
		return $matreakta;
	}
		
	 function MatreAktaPolis($tanggal=""){
		if(!$tanggal){
			$tanggal=$this->sysdate;
		} else {
			$tanggal=$tanggal;
		}

	  $sql="select nilai from nadm.tabel_999_materai ".
       	 "where tglberlaku=(select max(tglberlaku) from nadm.tabel_999_materai ".
				 "where tglberlaku<=to_date('$tanggal','DD/MM/YYYY') and kdmaterai='P')  and kdmaterai='P' ";
		//echo $sql;
		Database::parse($sql);
		Database::execute();
		$arr=Database::nextrow();
		$matreakta=$arr["NILAI"];
		return $matreakta;
	}
};

class Transaksi extends Database {
	var $userid;
	var $passwd;
	var $kurs;
	var $sysdate;
	var $tanggal;
	function Transaksi($userid="",$passwd="") {
		$this->userid=$userid;
		$this->passwd=$passwd;
		Database::Database($this->userid,$this->passwd,"IFGDB");
		$sql="select to_char(sysdate,'DD/MM/YYYY') sisdate from dual";	
		Database::parse($sql);
		Database::execute();
		$arr=Database::nextrow();
		$sysdate=$arr["SISDATE"];
		$this->sysdate=$sysdate;	
	}
	function Kurs($valuta,$tgl="") {
		if (!$tgl) {
			$tanggal=$this->sysdate;
		} else {
			$tanggal=$tgl;
		}	
		$sql="select kurs from nadm.tabel_999_kurs_transaksi where tglkursberlaku=".
	       "(select max(tglkursberlaku) from nadm.tabel_999_kurs_transaksi ".
	     	 "where tglkursberlaku<=to_date('$tanggal','DD/MM/YYYY') and kdvaluta='$valuta') ".
	     	 "and kdvaluta='$valuta'";	
		//echo $sql;
		Database::parse($sql);
		Database::execute();
		$arr=Database::nextrow();
		$kurs=$arr["KURS"];
		$this->kurs=$kurs;
		return $kurs;
	}
};
?>
