<?
class Klien extends Database {
	var $userid;
	var $passwd;
	var $nama;
	var $gelar;
	var $jeniskelamin;
	var $meritalstatus;
	var $identitas;
	var $agama;
	var $tinggi;
	var $berat;
	var $tglkawin;
	var $pekerjaan;
	var $tempatlahir;
	var $tgllahir;
	var $hobby;
	var $pendapatan;
	var $usia;
	var $tgl;
	var $umurth;
	var $umurth1;
	var $umurbl;
	var $ponsel;
	
	const DBName = "IFGDB";
	const DBUser = "NADM";
	
	function Klien ($userid,$passwd,$noklien) {
		$this->userid=$userid;
		$this->passwd=$passwd;
		$DBName = Klien::DBName;
		$DBUser = Klien::DBUser;
		
		Database::database($userid, $passwd, $DBName);
		
		$sql="select a.namaklien1,a.namaklien2,".
				 //"replace(a.namaklien1,'"','') as namaklien1,".
				 //"replace(a.namaklien2,'"','') as namaklien2,".
				 "a.gelar, a.jeniskelamin, decode(a.jeniskelamin,'L','Laki-laki','Perempuan') namajk, ". 
				 "decode(a.meritalstatus,'J','Janda','D','Duda','K','Kawin','Lajang') meritalstatus,a.meritalstatus as sttkawin, ".
				 "decode(a.kdid,'KT','KTP - ','SI','SIM - ','PS','PASPOR - ','SN','SURAT HIKAH - ','IJ','IJAZAH - ')||noid identitas,a.kdid as kdidx,a.noid,	b.namaagama, a.tinggibadan, ". 
				 "a.emailtetap,a.emailtagih,a.kdpekerjaan,a.kdagama,".
				 "a.alamattetap01,a.alamattetap02,a.phonetetap01, kdkotamadyatetap,kdpropinsitetap,kodepostetap,kodepostagih, ".
				 "a.alamattagih01,a.alamattagih02,a.phonetagih01, kdkotamadyatagih,kdpropinsitagih, ".
				 "a.beratbadan, to_char(a.tglkawin,'DD/MM/YYYY') tglkawin,c.namapekerjaan,nvl(c.nilairesiko,0) nilairesiko, ".
				 "a.tempatlahir,to_char(a.tgllahir,'DD/MM/YYYY') tgllahir, d.namahobby, a.pendapatan, ".
				 "floor(months_between(sysdate,a.tgllahir)/12) usia,trunc(months_between(sysdate,a.tgllahir) -
    				(trunc(months_between(sysdate,a.tgllahir) / 12) * 12)) as usia_month, decode(a.status,'1','Masih Hidup','0','Sudah Meninggal') namastatus, ".
				 "a.status, decode(a.kdgantipekerjaan,'0','Pernah','1','Tidak') gantikerja, no_ponsel ".  			 
				 "from $DBUser.tabel_100_klien a, $DBUser.tabel_105_pekerjaan c, ".
				 "$DBUser.tabel_114_hobby d,$DBUser.tabel_102_agama b ".
				 "where noklien='$noklien' and ".
				 "a.kdagama=b.kdagama(+) and a.kdpekerjaan=c.kdpekerjaan(+) and a.kdhobby=d.kdhobby(+)";
		
    Database::parse($sql);
		Database::execute();
		$ary=Database::nextrow();
    
		$this->nama=(($ary["GELAR"]=="")||preg_match("/\t\n\r\f/",$ary["GELAR"])) ?  ereg_replace("'","`",$ary["NAMAKLIEN1"]) : ereg_replace("'","`",$ary["NAMAKLIEN1"]).",".$ary["GELAR"];	
		$this->gelar=$ary["GELAR"];
		$this->kdid=$ary["KDIDX"];
		$this->noid=$ary["NOID"];
		$this->jeniskelamin=$ary["JENISKELAMIN"];
		$this->namajk=$ary["NAMAJK"];
		$this->meritalstatus=$ary["MERITALSTATUS"];
		$this->identitas=$ary["IDENTITAS"];
		$this->agama=$ary["NAMAAGAMA"];
		$this->tinggi=$ary["TINGGIBADAN"];
		$this->berat=$ary["BERATBADAN"];
		$this->kdpekerjaan=$ary["KDPEKERJAAN"];
		$this->tglkawin=$ary["TGLKAWIN"];
		$this->pekerjaan=$ary["NAMAPEKERJAAN"];
		$this->nilairesiko=$ary["NILAIRESIKO"];
		$this->tempatlahir=$ary["TEMPATLAHIR"];
		$this->tgllahir=$ary["TGLLAHIR"];
		$this->hobby=$ary["NAMAHOBBY"];
		$this->pendapatan=$ary["PENDAPATAN"];	
		$this->usia=$ary["USIA"];
		$this->usia_month = $ary["USIA_MONTH"];
		$this->status=$ary["STATUS"];
		$this->alamat=$ary["ALAMATTETAP01"]." ".$ary["ALAMATTETAP02"]." ".$this->NamaKodya($ary["KDKOTAMADYATETAP"])." ".$this->NamaPropinsi("KDPROPINSITETAP");
		$this->alamattagih=$ary["ALAMATTAGIH01"]." ".$ary["ALAMATTAGIH02"]." ".$this->NamaKodya($ary["KDKOTAMADYATAGIH"])." ".$this->NamaPropinsi("KDPROPINSITAGIH");
		$this->alamatbk=$ary["ALAMATTETAP01"]." ".$this->NamaPropinsi($ary["KDPROPINSITETAP"]);
		$this->alamattagihbk=$ary["ALAMATTAGIH01"]." ".$this->NamaPropinsi($ary["KDPROPINSITAGIH"]);
		$this->alamattetap1=$ary["ALAMATTETAP01"];
		$this->alamattetap2=$ary["ALAMATTETAP02"];
		$this->alamattagih1=$ary["ALAMATTAGIH01"];
		$this->alamattagih2=$ary["ALAMATTAGIH02"];
		$this->namakodyatetap=$this->NamaKodya($ary["KDKOTAMADYATETAP"]);
		$this->kdkotamadyatetap=$ary["KDKOTAMADYATETAP"];
		$this->kdkotamadyatagih=$ary["KDKOTAMADYATAGIH"];
		$this->telepon=$ary["PHONETETAP01"];
		$this->telptagih=$ary["PHONETAGIH01"];
		$this->meritalstatus=$ary["STTKAWIN"];
		$this->phonetetap01=$ary["PHONETETAP01"];
		$this->ponsel=$ary["NO_PONSEL"];
		$this->phonetagih01=$ary["PHONETAGIH01"];
		$this->kdagama=$ary["KDAGAMA"];
		$this->namastatus=$ary["NAMASTATUS"];
		$this->kdgantipekerjaan=$ary["KDGANTIPEKERJAAN"];
		$this->propinsitetap=$this->NamaPropinsi($ary["KDPROPINSITETAP"]);
		$this->kodepostetap=$ary["KODEPOSTETAP"];
		$this->kodepostagih=$ary["KODEPOSTAGIH"];
		$this->emailtetap=$ary["EMAILTETAP"];
		$this->emailtagih=$ary["EMAILTAGIH"];

	}
	
	function Umur($tanggal="") {
		$DBName = Klien::DBName;
		$DBUser = Klien::DBUser;
	  if (!$tanggal) {
		 $sql="select to_char(sysdate,'DD/MM/YYYY') dates,  floor(months_between(to_date('".$tanggal."','dd/mm/yyyy'),a.tgllahir)/12) usia from dual ";
     Database::parse($sql);
		 Database::execute();
		 $arz=Database::nextrow();
		 $tgl = $arz["DATES"];
		 $usth = $arz["USIA"];
		} else {
		 $tgl=$tanggal;
		} 
		//=============
		$sql="select to_char(sysdate,'DD/MM/YYYY') dates,  floor(months_between(to_date('".$tanggal."','dd/mm/yyyy'),to_date('".$this->tgllahir."','dd/mm/yyyy'))/12) usia from dual ";
     	Database::parse($sql);
		Database::execute();
		$arz=Database::nextrow();
		$usth = $arz["USIA"];
		//=============
		$hrlahir=substr($this->tgllahir,0,2);
		$bllahir=substr($this->tgllahir,3,2);
		$thlahir=substr($this->tgllahir,6,4);
		$blmulas=substr($tgl,3,2);
		$thmulas=substr($tgl,6,4);
	
		if ($hrlahir > 1){
		 $bllahir=$bllahir+1;
		}
		 $umurth = (($thmulas*12+$blmulas) - ($thlahir*12+$bllahir))/12 ;
		 $umurth = $usth; //perhitungkan hari
		 $umurth = ($umurth > 200|| $umurth<0) ? 0 : floor($umurth);
		 
		return $umurth;
		 
	}	 

	function UmurBl($tanggal="") {
		$DBName = Klien::DBName;
		$DBUser = Klien::DBUser;
	  if (!$tanggal) {
		 $sql="select to_char(sysdate,'DD/MM/YYYY') dates from dual ";
     Database::parse($sql);
		 Database::execute();
		 $arz=Database::nextrow();
		 $tgl = $arz["DATES"];
		} else {
		 $tgl=$tanggal;
		} 
		
		$hrlahir=substr($this->tgllahir,0,2);
		$bllahir=substr($this->tgllahir,3,2);
		$thlahir=substr($this->tgllahir,6,4);
		$blmulas=substr($tgl,3,2);
		$thmulas=substr($tgl,6,4);
	
		if ($hrlahir > 1){
		 $bllahir=$bllahir+1;
		}
		if ($bllahir > 12){
		 $thlahir=$thlahir+1;
		 $bllahir=$bllahir-12;
		}
		
		 $umurth = (($thmulas*12+$blmulas) - ($thlahir*12+$bllahir))/12 ;
		 $umurth = ($umurth > 200|| $umurth<0) ? 0 : $umurth;
		 $umurth1= floor($umurth);
		 $umurbl = round(($umurth - $umurth1)*12) ;
		  return $umurbl;
		 
  }

  	/** tambahan UAT20022023 **/
  	function getUmurBulan($tanggal=""){
  		$DBName = Klien::DBName;
		$DBUser = Klien::DBUser;
	  if (!$tanggal) {
		 $sql="select to_char(sysdate,'DD/MM/YYYY') dates from dual ";
     	 Database::parse($sql);
		 Database::execute();
		 $arz=Database::nextrow();
		 $tgl = $arz["DATES"];
		} else {
		 $tgl=$tanggal;
		} 
		
		$hrlahir=substr($this->tgllahir,0,2);
		$bllahir=substr($this->tgllahir,3,2);
		$thlahir=substr($this->tgllahir,6,4);
		$hrmulas=substr($tgl,0,2);
		$blmulas=substr($tgl,3,2);
		$thmulas=substr($tgl,6,4);

		
		 $umurth = (($thmulas*12+$blmulas) - ($thlahir*12+$bllahir))/12 ;
		 $umurth = ($umurth > 200|| $umurth<0) ? 0 : $umurth;
		 $umurth1= floor($umurth);
		 $umurbl = ($umurth - $umurth1)*12 ;

		 return $umurbl;
  	}
  	/** END OF ERA **/
		
	function NamaKodya($kdkotamadya) {
		$DBName = Klien::DBName;
		$DBUser = Klien::DBUser;
		$sql = "select namakotamadya from $DBUser.tabel_109_kotamadya ".
				   "where kdkotamadya='$kdkotamadya'";
		Database::parse($sql);
		Database::execute();
		$ary=Database::nextrow();
		return $ary["NAMAKOTAMADYA"];
	}
	
	function NamaPropinsi($kdpropinsi){
		$DBName = Klien::DBName;
		$DBUser = Klien::DBUser;
		$sql ="select namapropinsi from $DBUser.tabel_108_propinsi ".
				 "where kdpropinsi='$kdpropinsi'";
		Database::parse($sql);
		Database::execute();
		$ary=Database::nextrow();
		return $ary["NAMAPROPINSI"];
	}
	
	
};
?>