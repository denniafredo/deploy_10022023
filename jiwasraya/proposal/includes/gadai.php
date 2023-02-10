<?php
class Gadai extends Database {
var $bng;
var $tglgadai;

	function Gadai($userid="",$passwd="",$prefix="",$nopert="",$tglgadai="") {
	  Database::database($userid, $passwd, $DBName);
		$this->prefix=$prefix;
	  $this->nopert=$nopert;
		$this->userid=$userid;
		$this->passwd=$passwd;
		if (!$tglgadai||$tglgadai=='') {
		 $sql = "select to_char(tglgadai,'DD/MM/YYYY') tglgadai from $DBUser.tabel_700_gadai ".
		        "where prefixpertanggungan='$prefix' and nopertanggungan='$nopert' and status ='3' ";
		 //echo $sql;
		 Database::parse($sql);
		 Database::execute();
		 $arr=Database::nextrow();
		 $tglgadai=$arr["TGLGADAI"];
		 //echo $tglgadai;
		} 
		 $this->tglgadai=$tglgadai;
		//echo $this->tglgadai;
		 $sql = "select to_char(sysdate,'DD/MM/YYYY') sisdate from dual";
		 //echo $sql;
		 Database::parse($sql);
		 Database::execute();
		 $arr=Database::nextrow();
		 $this->sysdate=$arr["SISDATE"];		 
			
		$sql= "SELECT bunga FROM $DBUser.tabel_999_bunga ".
					"WHERE kdbunga='01' AND tglberlaku=(select max(tglberlaku) from $DBUser.tabel_999_bunga where kdbunga='01' ".
					 "and tglberlaku<=sysdate)";
		Database::parse($sql);
		Database::execute();
		$arr=Database::nextrow();
		$bng=$arr["BUNGA"];
		$this->bunga=$arr["BUNGA"];
		
		$sql = "SELECT a.pokokpinjaman,a.status,a.nilaigadai, a.lamagadai, a.kdvaluta, decode(a.kdcarabayar,'1',12,'2',4,'3',2,'4',1,'M',12,'Q',4,'H',2,'A',1,1) fakcb, ".
  				 	 "to_char(a.tglmohon,'DD/MM/YYYY') tglmohon, to_char(a.tglbayar,'DD/MM/YYYY') tglbayar, a.nopenerima, ".
  					 "to_char(add_months(a.tglgadai,(a.lamagadai-1)),'DD/MM/YYYY') akhirgadai, a.bungagadai, (nvl(a.sisagadai,nilaigadai)) sisagadai, ".
  					 "to_char(a.mulaibayar,'DD/MM/YYYY') mulaibayar,to_char(a.mulainunggakpremi,'DD/MM/YYYY') mulainunggakpremi,sbgadai,sbdenda, ".
  					 "decode(a.kdvaluta,'0','RpI','1','Rp','3','US$','') notasi,nvl(a.gadailama,0) as jenisgadai ".
					 "FROM $DBUser.tabel_700_gadai a ".
					 "WHERE a.prefixpertanggungan='$prefix' AND a.nopertanggungan='$nopert' and to_char(a.tglgadai,'DD/MM/YYYY')='$this->tglgadai'";
		//echo $sql;
		Database::parse($sql);
		Database::execute();
		$arr=Database::nextrow();
		$this->nilaigadai=$arr["NILAIGADAI"];
		$this->lamagadai=$arr["LAMAGADAI"];
		$this->akhirgadai=$arr["AKHIRGADAI"];
		$this->faktorcb=$arr["FAKCB"];
		$this->tglmohon=$arr["TGLMOHON"];
		$this->tglbayar=$arr["TGLBAYAR"];
		$this->nopenerima=$arr["NOPENERIMA"];
		$this->kdvaluta=$arr["KDVALUTA"];
		$this->jenisgadai= "NORMAL";
		$this->bungagadai=$arr["BUNGAGADAI"];
		$this->statusgadai=$arr["STATUS"];
		$this->pokokgadai=$arr["POKOKPINJAMAN"];
		$this->sisagadai=($this->statusgadai <> '3') ? $arr["NILAIGADAI"] : $arr["SISAGADAI"];
		$this->sbgadai=$arr["SBGADAI"];
		$this->sbdenda=$arr["SBDENDA"];
		$this->mulaibayar=$arr["MULAIBAYAR"];
		$this->mulainunggakpremi=$arr["MULAINUNGGAKPREMI"];
		$this->kdjenisgadai=$arr["JENISGADAI"];
		$this->notasi = $arr["NOTASI"];
		//echo "ini sisa gadai : " . $this->sisagadai . "ini status gadai : " . $this->statusgadai;
		//if (($this->sisagadai < 1) && $this->sisagadai <> 0  && $this->statusgadai=='3') {
		if ($this->statusgadai=='5') {
		 $this->statuslunas="SUDAH LUNAS";
		} elseif ($this->sisagadai == 0 && $this->statusgadai=='3') {
		 $this->statuslunas="BELUM DIBAYAR";
		} elseif ($this->sisagadai < 1 && $this->statusgadai=='2') {
		 $this->statuslunas="BELUM DIBAYAR";
		} elseif ($this->statusgadai=='4') {
		 $this->statuslunas="<font face=Verdana size=2 color=#ff3366>GADAI ULANG</font>";
		} else {
		 $this->statuslunas="BELUM LUNAS";
		}
	}
	
	function JumlahCicilan() {
	 return $this->faktorcb * $this->lamagadai;
	}
	
	function CicilanKe() {
	  $sql = "select min(periodebayar) ck from $DBUser.tabel_701_pelunasan_gadai ".
	  	     "where prefixpertanggungan='$this->prefix' and nopertanggungan='$this->nopert' ".
					 "and tglseatled is null and to_char(tglgadai,'DD/MM/YYYY')='$this->tglgadai' ";
 		//echo $sql;
		Database::parse($sql);
		Database::execute();
		$arr=Database::nextrow();
		return $arr["CK"];			
	}
	
	function TglBook($i="") {
	 $i=(!$i) ? $this->CicilanKe() : $i;
	 $sql = "select to_char(tglbooked,'DD/MM/YYYY') tglbooked from $DBUser.tabel_701_pelunasan_gadai ".
	  	     "where prefixpertanggungan='$this->prefix' and nopertanggungan='$this->nopert' ".
					 "and to_char(tglgadai,'DD/MM/YYYY')='$this->tglgadai' and periodebayar=$i";
		//echo $sql;
		Database::parse($sql);
		Database::execute();
		$arr=Database::nextrow();
		return $arr["TGLBOOKED"];	
	}
	
	
	function AngsuranPokok($i="") {
	 $i=(!$i) ? $this->CicilanKe() : $i;
	  $sql = "select angsuranpokok  from $DBUser.tabel_701_pelunasan_gadai ".
	  	     "where prefixpertanggungan='$this->prefix' and nopertanggungan='$this->nopert' ".
					 "and to_char(tglgadai,'DD/MM/YYYY')='$this->tglgadai' ".
					 "and periodebayar=$i";
 		Database::parse($sql);
		Database::execute();
		$arr=Database::nextrow();
		return $arr["ANGSURANPOKOK"];			
	}
		
	function AngsuranBunga($i="") {
	 $i=(!$i) ? $this->CicilanKe() : $i;
	  $sql = "select angsuranbunga  from $DBUser.tabel_701_pelunasan_gadai ".
	  	     "where prefixpertanggungan='$this->prefix' and nopertanggungan='$this->nopert' ".
					 "and to_char(tglgadai,'DD/MM/YYYY')='$this->tglgadai' ".
					 "and periodebayar=$i";
 		Database::parse($sql);
		Database::execute();
		$arr=Database::nextrow();
		return $arr["ANGSURANBUNGA"];				
	}
	function SaldoPinjaman($i="") {
	 $i=(!$i) ? $this->CicilanKe() : $i;
	  $sql = "select saldopinjaman from $DBUser.tabel_701_pelunasan_gadai ".
	  	     "where prefixpertanggungan='$this->prefix' and nopertanggungan='$this->nopert' ".
					 "and to_char(tglgadai,'DD/MM/YYYY')='$this->tglgadai' ".
					 "and periodebayar=$i";
 		//echo $sql;
		Database::parse($sql);
		Database::execute();
		$arr=Database::nextrow();
		return $arr["SALDOPINJAMAN"];			
	}	
	function DendaPinjaman($i="") {
	 $i=(!$i) ? $this->CicilanKe() : $i;
	  $sql = "select denda from $DBUser.tabel_701_pelunasan_gadai ".
	  	     "where prefixpertanggungan='$this->prefix' and nopertanggungan='$this->nopert' ".
					 "and to_char(tglgadai,'DD/MM/YYYY')='$this->tglgadai' ".
					 "and periodebayar=$i";
 		//echo $sql;
		Database::parse($sql);
		Database::execute();
		$arr=Database::nextrow();
		return $arr["DENDA"];			
	}
	function NomorBS($i="") {
	 $i=(!$i) ? $this->CicilanKe() : $i;
	  $sql = "select nobs from $DBUser.tabel_701_pelunasan_gadai ".
	  	     "where prefixpertanggungan='$this->prefix' and nopertanggungan='$this->nopert' ".
					 "and to_char(tglgadai,'DD/MM/YYYY')='$this->tglgadai' ".
					 "and periodebayar=$i";
 		//echo $sql;
		Database::parse($sql);
		Database::execute();
		$arr=Database::nextrow();
		return $arr["NOBS"];			
	}	
	function NilaiPembayaran($i="") {
	 $i=(!$i) ? $this->CicilanKe() : $i;
	  $sql = "select nilaipembayaran from $DBUser.tabel_701_pelunasan_gadai ".
	  	     "where prefixpertanggungan='$this->prefix' and nopertanggungan='$this->nopert' ".
					 "and to_char(tglgadai,'DD/MM/YYYY')='$this->tglgadai' ".
					 "and periodebayar=$i";
 		//echo $sql;
		Database::parse($sql);
		Database::execute();
		$arr=Database::nextrow();
		return $arr["NILAIPEMBAYARAN"];			
	}	

 function Denda($i="",$tglseatled="") {
	 $i=(!$i) ? $this->CicilanKe() : $i;
	 $tglseatled=(!$tglseatled) ? $this->sysdate : $tglseatled;
	  $sql = "select ceil(months_between(to_date('$tglseatled','DD/MM/YYYY'),add_months(tglbooked,1))) jmlbln from $DBUser.tabel_701_pelunasan_gadai ".
	  	     "where prefixpertanggungan='$this->prefix' and nopertanggungan='$this->nopert' ".
					 "and to_char(tglgadai,'DD/MM/YYYY')='$this->tglgadai' ".
					 "and periodebayar=$i";
		//echo $sql;			 
 		Database::parse($sql);
		Database::execute();
		$arr=Database::nextrow();
		$jmlbln=($arr["JMLBLN"] < 0) ? 0 : $arr["JMLBLN"];
		//return $jmlbln;
		return $this->bunga * $jmlbln / 1200 * ($this->AngsuranPokok ($i) + $this->AngsuranBunga($i));			
 }	
			
};

?>