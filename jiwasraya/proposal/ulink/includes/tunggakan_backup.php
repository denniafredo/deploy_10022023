<?php
class Tunggakan extends Database {
 
	function Tunggakan($userid="",$passwd="",$prefix="",$nopert="",$tgl="") {
	  $this->prefix=$prefix;
	  $this->nopert=$nopert;
		$this->userid=$userid;
		$this->passwd=$passwd;
		Database::Database($this->userid,$this->passwd,"JSDB");
		
		$sql="select to_char(sysdate,'DD/MM/YYYY') sisdate, ".
				 "to_char(sysdate,'MMYYYY') tonggel from dual";	
		//echo $sql;
		Database::parse($sql);
		Database::execute();
		$arr=Database::nextrow();
		$this->tanggal = (!$tgl || is_null($tgl) || $tgl=='') ? $arr["SISDATE"] : $tgl;
	  $this->tonggel = (!$tgl || is_null($tgl) || $tgl=='') ? $arr["TONGGEL"] : substr($tgl,3,2).substr($tgl,6,4);
		
		/*
		$sql = "select to_char(tglbooked,'DD/MM/YYYY') as tglakhirnunggak ".
				 	 "from $DBUser.tabel_300_historis_premi where ".
					 "prefixpertanggungan='$this->prefix' and nopertanggungan='$this->nopert' and ".
					 "tglbooked in (select max(tglbooked) from $DBUser.tabel_300_historis_premi where ".
					 "prefixpertanggungan='$this->prefix' and nopertanggungan='$this->nopert' and ".
					 "tglseatled is null)";
		//echo "<br><br>".$sql."<br><br>";
		Database::parse($sql);
		Database::execute();
		$arr=Database::nextrow();
		$this->tanggal = $arr["TGLAKHIRNUNGGAK"];
		*/
		
		//echo $arr["SISDATE"]."|".$tgl."|".$this->tanggal;
		
		$sql = "select to_char(to_date(to_char(to_date('$this->tanggal','DD/MM/YYYY'),'MMYYYY'),'MMYYYY'),'DD/MM/YYYY') awalbulan, ".
					 "to_char(add_months(to_date(to_char(to_date('$this->tanggal','DD/MM/YYYY'),'MMYYYY'),'MMYYYY'),-1),'DD/MM/YYYY') awalbulanini ".
					 "from dual";	
		//echo $sql."<br>";
		Database::parse($sql);
		Database::execute();
		$arr=Database::nextrow();
		$this->awalbulan=$arr["AWALBULAN"];
		$this->awalbulanini=$arr["AWALBULANINI"];
		
		$sql = "select count(tglbooked) as ada from $DBUser.tabel_300_historis_premi ".
				 	 "where tglseatled is null and tglbooked < ".
					 "(select min(tglbooked) from $DBUser.tabel_300_historis_premi where status='X' ".
					 "and prefixpertanggungan='$this->prefix' and nopertanggungan='$this->nopert')  and ".
					 "prefixpertanggungan='$this->prefix' and nopertanggungan='$this->nopert'";
		Database::parse($sql);
		Database::execute();
		$arr=Database::nextrow();
		$ono = $arr["ADA"];
		echo "ada apa gak : ".$ono;
		// jika ditemukan kasus lunas sistem ditengah-tengah tunggakan !!!
		/*
		if($ono > 0)
		{
		$sql = "SELECT to_char(max(a.tglbooked),'DD/MM/YYYY') lunas FROM $DBUser.tabel_300_historis_premi a ".
				   "WHERE a.prefixpertanggungan='$this->prefix' AND a.nopertanggungan='$this->nopert' ".
					 "AND a.tglseatled IS NOT NULL and a.status <> 'X'";
		} else	{
		$sql = "SELECT to_char(max(a.tglbooked),'DD/MM/YYYY') lunas FROM $DBUser.tabel_300_historis_premi a ".
				   "WHERE a.prefixpertanggungan='$this->prefix' AND a.nopertanggungan='$this->nopert' ".
					 "AND a.tglseatled IS NOT NULL";
		
		}
		echo "<br />".$sql."<br />";
		Database::parse($sql);
		Database::execute();
		$arr=Database::nextrow();
		
		if ($arr["LUNAS"]=='') {
		*/
		 $sql = "SELECT to_char(max(a.tglbooked),'DD/MM/YYYY') lunas FROM $DBUser.tabel_300_historis_premi a ".
				    "WHERE a.prefixpertanggungan='$this->prefix' AND a.nopertanggungan='$this->nopert' ".
						"and tglseatled is not null";
		 //echo $sql."<br>";
		 Database::parse($sql);
		 Database::execute();
		 $arr=Database::nextrow();
		//}
		
		$premilunas=$arr["LUNAS"];
		//echo "<br>$premilunas<br>";
		
		$sql = "SELECT a.mulas,a.premi1,a.premi2,a.premistd,to_char(a.mulas,'DD/MM')||'/'||to_char(sysdate,'YYYY') premilunas, ".
				   //"decode(a.kdcarabayar,'1',1,'2',3,'3',6,'4',12,'M',1,'Q',3,'H',6,'A',12,'E',60,'J',120,'X',0) faktorcb, ". 
				   "decode(a.kdcarabayar,'1',1,'2',3,'3',6,'4',12,'M',1,'Q',3,'H',6,'A',12,'E',12,'J',12,'X',0) faktorcb, ". 
				   "a.expirasi,a.kdcarabayar,a.kdvaluta,c.graceperiode,to_char(a.tglakhirpremi,'DD/MM/YYYY') lp, ".
					 "to_char(a.mulas,'DD/MM/YYYY') mules,to_char(add_months(a.mulas,60),'DD/MM/YYYY') batas5th ".
					 "FROM $DBUser.tabel_200_pertanggungan a,  $DBUser.tabel_241_grace_periode c ".
					 "WHERE a.prefixpertanggungan='$prefix' AND a.nopertanggungan='$nopert' AND a.kdpertanggungan='2' ".
					 "AND a.kdproduk=c.kdproduk";
		echo "<br><br>".$sql."<br><br>";
		Database::parse($sql);
		Database::execute();
		$arr=Database::nextrow();
		
		echo "<br><br>premi lunas : ".$premilunas."<br><br>";
		
		$this->premilunas=($premilunas=='') ? $arr["PREMILUNAS"] : $premilunas;
		
		$faktorbayar=($arr["FAKTORBAYAR"]==0 || !$arr["FAKTORBAYAR"]) ? 1 : $arr["FAKTORBAYAR"];
		$this->premistdthn = $arr["PREMISTD"];
		$this->premithn = $arr["PREMISTD"];
		$this->premi1=$arr["PREMI1"];
		$this->premi2=$arr["PREMI2"];
		$this->kdvaluta = $arr["KDVALUTA"];
		$this->kdcarabayar = $arr["KDCARABAYAR"];
		$this->grc = (int)$arr["GRACEPERIODE"];
		$this->mules = $arr["MULES"];
		$this->akhirpremi = $arr["LP"];
		$this->batas5th = $arr["BATAS5TH"];
		$this->faktorcb = ($arr["FAKTORCB"]==0) ? 1 : $arr["FAKTORCB"];
		//$this->faktorcb = 12;
		
		$sql= "SELECT bunga FROM $DBUser.tabel_999_bunga ".
					"WHERE kdbunga='02' AND tglberlaku=(select max(tglberlaku) from $DBUser.tabel_999_bunga where kdbunga='02' and kdvaluta='$this->kdvaluta' ".
					"AND tglberlaku<=to_date('$this->tanggal','DD/MM/YYYY')) and kdvaluta='$this->kdvaluta'";
		//echo $sql;
		Database::parse($sql);
		Database::execute();
		$arr=Database::nextrow();
		$this->bungapulih=$arr["BUNGA"];
		//echo $this->bungapulih;
    if($ono > 0)
		{
		$faktorlamatunggak = $ono * $this->faktorcb; // cari jika ada pelunasan by system maka perhitungan 
		$sql = "SELECT to_char(add_months(to_date('$this->premilunas','DD/MM/YYYY'),$this->faktorcb - $faktorlamatunggak),'DD/MM/YYYY') lastpay, ".
				          "to_char(add_months(to_date('$this->premilunas','DD/MM/YYYY'),($this->faktorcb - 1 - $faktorlamatunggak)),'DD/MM/YYYY') lastpay1 ".
					 "from dual";
		}
		else
		{
		$sql = "SELECT to_char(add_months(to_date('$this->premilunas','DD/MM/YYYY'),$this->faktorcb),'DD/MM/YYYY') lastpay, ".
				   "to_char(add_months(to_date('$this->premilunas','DD/MM/YYYY'),($this->faktorcb - 1)),'DD/MM/YYYY') lastpay1 ".
					 "from dual";
		}
		echo "<br><br>".$sql."<br><br>";
		Database::parse($sql);
		Database::execute();
		$arr=Database::nextrow();
		$this->lastpay=$arr["LASTPAY"];
	  $this->lastpay1=$arr["LASTPAY1"];

		$sql = "select months_between(to_date('$this->awalbulan','DD/MM/YYYY'),add_months(to_date('$this->lastpay','DD/MM/YYYY'),-1)) lama, ".
					 "months_between(to_date('$this->batas5th','DD/MM/YYYY'),to_date('$this->lastpay','DD/MM/YYYY')) p1, ".
					 "months_between(to_date('$this->awalbulan','DD/MM/YYYY'),add_months(to_date('$this->batas5th','DD/MM/YYYY'),-1)) p2, ".
					 "months_between(to_date('$this->batas5th','DD/MM/YYYY'),to_date('$this->premilunas','DD/MM/YYYY')) pl5 ".
					 "from dual";
		echo "<br><br>".$sql."<br><br>";
		Database::parse($sql);
		Database::execute();
		$arr=Database::nextrow();
		$this->lama=$arr["LAMA"];
		
		$p1 = ($arr["P1"] > 0) ? $arr["P1"] : 0;
		$p2 = ($arr["P2"] > 0) ? $arr["P2"] : 0;

		$this->p2 = ($p1 == 0) ? $arr["P1"]+$arr["P2"] : $p2;
		$this->p1 = ($p2 == 0) ? $arr["P1"]+$arr["P2"] : $p1;
							
		
		if ($this->lama > 0) {
		  $this->jumlahp1 = ($this->p1==0) ? 0 : ceil($this->p1/$this->faktorcb);
			$this->jumlahp2 = ($this->p2==0) ? 0 : ceil($this->p2/$this->faktorcb);
			$temp = $this->jumlahp1 * $this->premi1 + $this->jumlahp2 * $this->premi2;
		  $this->premitertunggak = ($this->kdcarabayar == 'X') ? 0 : $temp;
		}
  //echo $this->jumlahp1."|".$this->jumlahp2."|".$this->premi1."|".$this->premi2;
  $this->bungatunggakan=0;		
	}
	
	function PremiTertunggakTebus() {
	  $sql = "select months_between(to_date('$this->awalbulanini','DD/MM/YYYY'),add_months(to_date('$this->lastpay1','DD/MM/YYYY'),-1)) lama, ".
					 "months_between(to_date('$this->batas5th','DD/MM/YYYY'),to_date('$this->lastpay1','DD/MM/YYYY')) p1, ".
					 "months_between(to_date('$this->awalbulanini','DD/MM/YYYY'),add_months(to_date('$this->batas5th','DD/MM/YYYY'),-1)) p2 ";
					 "from dual";
		//echo $sql;
		Database::parse($sql);
		Database::execute();
		$arr=Database::nextrow();
		$lama=$arr["LAMA"];
		
		$p1 = ($arr["P1"] > 0) ? $arr["P1"] : 0;
		$p2 = ($arr["P2"] > 0) ? $arr["P2"] : 0;
		$this->p4 = ($p1 == 0) ? $arr["P1"]+$arr["P2"] : $p2;
		$this->p3 = ($p2 == 0) ? $arr["P1"]+$arr["P2"] : $p1;
							
		
		if ($lama > 0) {
		  $jumlahp1 = ($this->p3==0) ? 0 : ceil($this->p3/$this->faktorcb);
			$jumlahp2 = ($this->p4==0) ? 0 : ceil($this->p4/$this->faktorcb);
			$temp = $jumlahp1 * $this->premi1 + $jumlahp2 * $this->premi2;
		  $temp = ($this->kdcarabayar == 'X') ? 0 : $temp;
		//echo $jumlahp1;
		}
    return $temp;
	}
	
	function LamaNunggak() {
		$sql = "select floor(months_between(to_date('$this->tanggal','DD/MM/YYYY'),".
				 	 "to_date('$this->lastpay','DD/MM/YYYY'))/12) lamath, ".
				 	 "ceil(mod(months_between(to_date('$this->tanggal','DD/MM/YYYY'),".
					 "to_date('$this->lastpay','DD/MM/YYYY')),12)) lamabl ".
					 "from dual";
		//echo "<br><br>".$sql."<br><br>";
		Database::parse($sql);
		Database::execute();
		$arr=Database::nextrow();
		
		$th = $arr["LAMATH"];
		if  ($arr["LAMABL"] >= 12) { 
		  $bl = $arr["LAMABL"] %12 ;
			$th +=1;
		} else { 
		  $bl = $arr["LAMABL"];
		}	
		 if ($arr["LAMATH"]<0) {
		  return $bl." bl";
		 } else {
		  return $th." th, ".$bl." bl";
		 }   
	}
	
	function FaktorBunga($usiadlbl) {
		$sql = "SELECT a.faktorbunga ".
				   "FROM $DBUser.tabel_312_faktor_bunga a ".
				   "WHERE ".
					 "a.kdcarabayar='$this->kdcarabayar' AND ".
					 "a.kdvaluta='$this->kdvaluta' ".
					 "AND a.sukubunga=$this->bungapulih ".
					 "AND a.kdfaktor='2' AND a.lamatunggakan=$usiadlbl ";
					 //echo $sql."<br><br>";
		Database::parse($sql);
		Database::execute();
		$arr=Database::nextrow();
		$temp = ($usiadlbl==0) ? 0 : $arr["FAKTORBUNGA"];
		return $temp;	
	}
	//t=1 untuk TEBUS 
	function NilaiTunggakan($t="") {
	 if ($t) {
	  $p1 = $this->p3; 
	  $p2 = $this->p4; 
	 } else {
	  $p1 = $this->p1; 
	  $p2 = $this->p2; 
	 }
	 $temp = ($this->FaktorBunga($p1+$p2) - $this->FaktorBunga($p2)) * $this->premi1 + $this->FaktorBunga($p2)*$this->premi2;
	 return $temp;
	}
	
	function UsiaPolisBPO($a=""){
	 $sql = "select floor(months_between(to_date('$this->lastpay','DD/MM/YYYY'),to_date('$this->mules','DD/MM/YYYY'))/12) usiabpoth,".
	 			  "floor(mod(months_between(to_date('$this->lastpay','DD/MM/YYYY'),to_date('$this->mules','DD/MM/YYYY')),12)) usiabpobl ".
	 			 	"from dual ";
	 //echo $sql;
	 Database::parse($sql);
	 Database::execute();
	 $arr=Database::nextrow();
	 $temp = (!$a) ?  $arr["USIABPOTH"]." th, ".$arr["USIABPOBL"]." bl" : (12 * $arr["USIABPOTH"]) + $arr["USIABPOBL"];
	 return $temp;	
	}

	function NextBook() {
	$delta=0;
	$tgltemp = $this->premilunas;
	//echo $this->premilunas."|".$this->faktorcb."|".$this->kdcarabayar;
	 
	 if (!($this->kdcarabayar == 'X' ||$this->kdcarabayar == 'E' ||$this->kdcarabayar == 'J')) { 
	  while ($delta <= 0 ) {
	   $sql = "SELECT to_char(add_months(to_date('$tgltemp','DD/MM/YYYY'),$this->faktorcb),'DD/MM/YYYY') nbook from dual";
	  //echo $sql."<br>";
		 Database::parse($sql);
	   Database::execute();
		 $arr=Database::nextrow();
		 $tgltemp = $arr["NBOOK"];
	  
	   $sql = "SELECT to_date('$tgltemp','DD/MM/YYYY') - to_date('$this->tanggal','DD/MM/YYYY') delta from dual";
		 //echo $sql;
		 Database::parse($sql);
		 Database::execute();
		 $arr=Database::nextrow();
		 $delta = (int)$arr["DELTA"];	
	   //echo $delta."<br>";
	  }	
	 }	
	 
		$temp = ($delta > 0) ? $tgltemp : $this->lastpay;
	 return $temp;
	}
	 	
};

?>