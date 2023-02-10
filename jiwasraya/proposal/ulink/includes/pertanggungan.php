<?php
class Pertanggungan extends Database {
	var $usiapolis_th;
	var $usiapolis_bl;
	var $usiapolis_bl1;
	var $sysdate;
	
	const DBName = "IFGDB";
	const DBUser = "NADM";
	
	function Pertanggungan($userid="",$passwd="",$prefix="",$nopert="") {
	  $this->prefix=$prefix;
	  $this->nopert=$nopert;
		$this->userid=$userid;
		$this->passwd=$passwd;
		$DBName = Pertanggungan::DBName;
		$DBUser = Pertanggungan::DBUser;
		
		Database::database($userid, $passwd, $DBName);
		
		$sql="select ".
						 "a.nopol,a.nopolbaru,nvl(a.gadaiotomatis,'0') gpo,premistd,nvl(a.kdstatusemail,'0') kdstatusemail,to_char(a.tglsendemail,'DD/MM/YYYY') tglsendemail, ".
    				 "to_char(a.tglkonversi,'DD/MM/YYYY') tglkonversi,to_char(a.tglcetak,'DD/MM/YYYY') tglcetak,a.keterangan,a.nopolswitch, ".				 
    				 "decode(a.kdpertanggungan,'1','Proposal','Polis') kdper,a.nobp3, a.juamainproduk,floor(months_between(sysdate,mulas)/12) usiapolisth,b.faktorkomisi, ".
    				 "a.usia_th, a.kdproduk, c.namaproduk,c.kdcabas, a.kdstatusmedical,decode(a.kdstatusmedical,'M','MEDICAL','NON MEDICAL') statusmedical, a.kdvaluta, to_char(a.tglbp3,'DD/MM/YYYY') tglbp3, ".
    				 "decode(a.kdvaluta,'0','RUPIAH INDEX','1','RUPIAH','DOLLAR AS') namavaluta, decode(a.kdvaluta,'0','RpI','1','Rp','US$') notasi, ".
    				 "decode(a.kdvaluta,'0','RUPIAH DENGAN INDEKS','1','RUPIAH TANPA INDEKS','DOLLAR AS') namavalutalengkap,".
						 "a.nosp,to_char(a.tglsp,'DD/MM/YYYY') tglsp,a.kdcarabayar, b.namacarabayar, a.lamapembpremi_th, a.lamaasuransi_th, a.lamapembpremi_bl, a.lamaasuransi_bl,a.nopembayarpremi, ".
    		     "a.noagen, a.nopenagih, a.nopemegangpolis,a.kdstatusfile, ".
    				 "z.namastatusfile,a.risk,usia_bl, ".
    				 "a.notertanggung, a.premi1, a.premi2, to_char(a.tglupdated,'DD/MM/YYYY HH:MI:SS') lastupdate, ".
    				 "to_char(a.tglakhirpremi,'DD/MM/YYYY') akhirpremi,to_char(a.tglnextbook,'DD/MM/YYYY') tglnextbook,to_char(a.tgllastpayment,'DD/MM/YYYY') tgllastpayment,".
    				 "to_char(a.mulas,'DD/MM/YYYY') mulas,to_char(a.expirasi,'DD/MM/YYYY') expirasi, ".
    				 "a.indexawal, nvl(d.nilaibenefit,0) suspend, ".
    		     "e.noklien ahliwaris1,to_char(a.tglbpo,'DD/MM/YYYY') tglbpo,a.lockmutasi, ".
    				 "decode(a.tglrekam,NULL,'',to_char(a.tglrekam,'DD/MM/YYYY')||' oleh '||a.userrekam) rekam, ".
    				 "decode(a.tglupdated,NULL,'',to_char(a.tglupdated,'DD/MM/YYYY')||' oleh '||a.userupdated) updated, ".
    				 "a.kdpertanggungan, ".
    				 "mm.kdrayonpenagih, ".
    					 "decode(a.taltup,'1','Ya','Tidak') taltup, ".
						 "decode(a.autodebet,'1','Ya','Tidak') autodebet,a.norekeningdebet, ".
    					 "(select namabank from $DBUser.tabel_399_bank where kdbank=a.kdbank) namabank ".
				 "from ".
    				 "$DBUser.tabel_223_transaksi_produk d,".
						 "$DBUser.tabel_219_pemegang_polis_baw e,".
						 "$DBUser.tabel_200_pertanggungan a, ".
    				 "$DBUser.tabel_202_produk c, ".
						 "$DBUser.tabel_305_cara_bayar b, ".
						 "$DBUser.tabel_500_penagih mm, ".
    				 "$DBUser.tabel_299_status_file z ".
				 "where ".
    				 "a.kdstatusfile=z.kdstatusfile(+) and ".
    				 "a.prefixpertanggungan=e.prefixpertanggungan(+) and a.nopertanggungan=e.nopertanggungan(+)  and e.nourut(+)=1 and ".
    				 "a.nopenagih=mm.nopenagih and ".
					 "a.notertanggung=e.notertanggung(+) and ".
    				 "a.prefixpertanggungan='$prefix' and a.nopertanggungan='$nopert' and ".
    				 "a.kdcarabayar=b.kdcarabayar(+) and a.kdproduk=c.kdproduk(+) and ".
    				 "a.nopertanggungan=d.nopertanggungan(+) and a.prefixpertanggungan=d.prefixpertanggungan(+) ".
    				 "and d.kdjenisbenefit(+)='T'";
  
		//echo $sql;// echo "INI YANG LAGI GW CARI ".$PER->namaproduk; 	
		//die;
			 
    Database::parse($sql);
		Database::execute();
		$arr=Database::nextrow();
		
		$this->jenis = $arr["KDPER"];
		$this->jua = $arr["JUAMAINPRODUK"];
		$this->usia = $arr["USIA_TH"];
		$this->usia_bl = $arr["USIA_BL"];
		$this->produk = $arr["KDPRODUK"];
		$this->namaproduk = $arr["NAMAPRODUK"];
		$this->medstat = $arr["KDSTATUSMEDICAL"];
		$this->statusmedical = $arr["STATUSMEDICAL"];
		$this->valuta = $arr["KDVALUTA"];
		$this->tglbp3 = $arr["TGLBP3"];
		$this->nopolswitch = $arr["NOPOLSWITCH"];
		$this->nobp3 = $arr["NOBP3"];
		$this->tglsp = $arr["TGLSP"];
    $this->nosp = $arr["NOSP"];
		$this->namavaluta = $arr["NAMAVALUTA"];
		$this->namavalutalengkap = $arr["NAMAVALUTALENGKAP"];
		$this->notasi = $arr["NOTASI"];
		$this->kdcarabayar = $arr["KDCARABAYAR"];
		$this->namacarabayar = $arr["NAMACARABAYAR"];
		$this->lamapremi = $arr["LAMAPEMBPREMI_TH"];
		$this->lamaasuransi = $arr["LAMAASURANSI_TH"];
		$this->lamapremi_bl = $arr["LAMAPEMBPREMI_BL"];
		$this->lamaasuransi_bl = $arr["LAMAASURANSI_BL"];
		$this->noagen = $arr["NOAGEN"];
		$this->nopenagih = $arr["NOPENAGIH"];
		$this->kdrayonpenagih = $arr["KDRAYONPENAGIH"];
		$this->notertanggung = $arr["NOTERTANGGUNG"];
		$this->notertanggung2 = $arr["NOPEMEGANGPOLIS"];
		$this->nopemegangpolis = $arr["NOPEMEGANGPOLIS"];
		$this->nopembayarpremi = $arr["NOPEMBAYARPREMI"];
		$this->ahliwaris1 = $arr["AHLIWARIS1"];
		$this->premi1 = $arr["PREMI1"];
		$this->premi2 = $arr["PREMI2"];
		$this->lastupdate = $arr["LASTUPDATE"];
		$this->akhirpremi = $arr["AKHIRPREMI"];
		$this->tglnextbook = $arr["TGLNEXTBOOK"];
		$this->tgllastpayment = $arr["TGLLASTPAYMENT"];
		$this->tglbpo = $arr["TGLBPO"];
		$this->mulas = $arr["MULAS"];
		$this->expirasi = $arr["EXPIRASI"];
		$this->suspend = $arr["SUSPEND"];
		$this->indexawal = $arr["INDEXAWAL"];
		$this->usiapolisth = $arr["USIAPOLISTH"];
		$this->statusfile = $arr["NAMASTATUSFILE"];
		$this->lockmutasi = $arr["LOCKMUTASI"];
		$this->nopol = $arr["NOPOL"];
		$this->nopolbaru = $arr['NOPOLBARU'];
		$this->gpo = $arr["GPO"];
		$this->premistandar = $arr["PREMISTD"];
		$this->risk = $arr["RISK"];
		$this->kdstatusfile = $arr["KDSTATUSFILE"];
		$this->namastatusfile = $arr["NAMASTATUSFILE"];
		//echo $this->namastatusfile;
		//die;
		$this->rekam = $arr["REKAM"];
		$this->update = $arr["UPDATED"];
		$this->kdstatusemail = $arr["KDSTATUSEMAIL"];
		$this->tglsendemail = $arr["TGLSENDEMAIL"];
		$this->tglcetak = $arr["TGLCETAK"];
		$this->tglkonversi = $arr["TGLKONVERSI"];
		$this->keterangan = $arr["KETERANGAN"];
		
		$this->label = $prefix."-".$nopert;
	 	$this->namatertanggung = $this->GetClient ($this->notertanggung);
		$this->namatertanggung2 = $this->GetClient ($this->notertanggung2);
		$this->namapemegangpolis = $this->GetClient ($this->nopemegangpolis);
		$this->emailpemegangpolis = $this->GetEmail ($this->nopemegangpolis);
		//echo $this->nopemegangpolis;
		$this->namapembayarpremi = $this->GetClient ($this->nopembayarpremi);
		$this->namaagen = $this->GetClient ($this->noagen);
		$this->namapenagih = $this->GetClient ($this->nopenagih);	
		$this->namaahliwaris1 = $this->GetClient ($this->ahliwaris1);
		$this->faktorkomisi = ($this->kdcarabayar=='X'||$this->kdcarabayar=='E'||$this->kdcarabayar=='J') ? (1/(real)$arr["FAKTORKOMISI"]) :$arr["FAKTORKOMISI"] ;
		
		$this->autodebet = $arr["AUTODEBET"];
		$this->norekeningdebet = $arr["NOREKENINGDEBET"];
		$this->namabank = $arr["NAMABANK"];
		$this->macas = $arr["KDCABAS"];
		$this->kdvaluta = $arr["KDVALUTA"];
		$this->taltup = $arr["TALTUP"];
		
  $sql = "select 'x' x from $DBUser.tabel_223_transaksi_produk ".
			   "where prefixpertanggungan='$prefix' and nopertanggungan='$this->nopert' and kdbenefit='JAMLKP'";
	//echo $sql;
	Database::parse($sql);
	Database::execute();
	$arr=Database::nextrow();
	$this->namaproduk = ($arr["X"]=='x') ? $this->namaproduk." LENGKAP" : $this->namaproduk;

// Tambahan oleh Ari 02/04/2008 ------------------------
  $sql = "select substr(kdbenefit,1,length(kdbenefit)-3) kdbnf from $DBUser.tabel_223_transaksi_produk ".
			   "where prefixpertanggungan='$prefix' and nopertanggungan='$this->nopert' and kdbenefit like 'CP%' ".
				 "group by substr(kdbenefit,1,length(kdbenefit)-3)";
	//echo $sql;
	Database::parse($sql);
	Database::execute();
	$arr=Database::nextrow();
	if (strlen($arr["KDBNF"])>0){
		 $this->cashplan = " + ".$arr["KDBNF"];
	}
// End of Tambahan oleh Ari 02/04/2008 ------------------------
	
	$sql="select sysdate, to_char(sysdate,'DD/MM/YYYY') sisdate,".
	     "floor(months_between(to_date('$this->expirasi','DD/MM/YYYY'),sysdate)/12) maxlama, ".
			 "floor(months_between(to_date('$this->expirasi','DD/MM/YYYY'),sysdate)) maxlamabulan ".
			 "from dual";	
	//echo $sql;
	Database::parse($sql);
	Database::execute();
	$arr=Database::nextrow();
		
		$this->sysdate=$arr["SISDATE"];
		$this->sisdate=$arr["SYSDATE"];
		$this->maxlama=$arr["MAXLAMA"];
		$this->maxlamabulan=$arr["MAXLAMABULAN"];
		
	$sql = "select faktorbayar from $DBUser.tabel_311_faktor_bayar ".
			   "where kdvaluta='$this->valuta' and kdcarabayar='$this->kdcarabayar' ";
	Database::parse($sql);
	Database::execute();
	$arr=Database::nextrow();		

		$this->faktorbayar = $arr["FAKTORBAYAR"];
		
	  //echo $this->faktorkomisi;
	$sql = "select to_char(max(tglbooked),'DD/MM/YYYY') terakhir from $DBUser.tabel_300_historis_premi ".
			   "where prefixpertanggungan='$prefix' and nopertanggungan='$this->nopert' and tglseatled is not null";
	//echo $sql;
	Database::parse($sql);
	Database::execute();
	$arr=Database::nextrow();
	  $this->bayarterakhir = $arr["TERAKHIR"];
	
	$sql = "select $DBUser.resikoawal('$this->prefix','$this->nopert') ra from dual ";
	//echo $sql;
	Database::parse($sql);
	Database::execute();
	$arr=Database::nextrow();
	  $this->resikoawal = $arr["RA"];
	
	$sql = "select namamutasi from $DBUser.tabel_601_kode_mutasi ".
			   "where kdmutasi='$this->lockmutasi' ";
	//echo $sql;
	Database::parse($sql);
	Database::execute();
	$arr=Database::nextrow();
	  $this->namalockmutasi = $arr["NAMAMUTASI"];

	$sql = "select juamainproduk from $DBUser.tabel_237_jua_original ".
			   "where prefixpertanggungan='$prefix' and nopertanggungan='$this->nopert' ";
	Database::parse($sql);
	Database::execute();
	$arr=Database::nextrow();
	$this->juaoriginal = ($arr["JUAMAINPRODUK"]=='' || is_null($arr["JUAMAINPRODUK"])) ? 0 : $arr["JUAMAINPRODUK"];
				 
	$sql = "select graceperiode from $DBUser.tabel_241_grace_periode ".
			   "where kdproduk='$this->produk'";
	Database::parse($sql);
	Database::execute();
	$arr=Database::nextrow();
	  $this->grace = $arr["GRACEPERIODE"];
	
	$sql = "select to_char(min(tglbooked),'DD/MM/YYYY') terakhir,".
			 	 //"to_char(add_months(to_date('$this->bayarterakhir','DD/MM/YYYY'),$this->grace),'DD/MM/YYYY') nb ".
				 "to_char(add_months(to_date('$this->bayarterakhir','DD/MM/YYYY'),DECODE('$this->kdcarabayar','1',1,'2',3,'3',6,'4',12,'M',1,'Q',3,'H',6,'A',12) + $this->grace),'DD/MM/YYYY') nb ".
				 "from $DBUser.tabel_300_historis_premi ".
			   "where prefixpertanggungan='$prefix' and nopertanggungan='$this->nopert' and tglseatled is null";
	//echo $sql;
	Database::parse($sql);
	Database::execute();
	$arr=Database::nextrow();
	  $this->bookterakhir = ($arr["TERAKHIR"]=='') ? $arr["NB"] : $arr["TERAKHIR"];
			
	$sql = "select kdcabas from $DBUser.tabel_202_produk where kdproduk='$this->produk' ";
	Database::parse($sql);
	Database::execute();
	$arr=Database::nextrow();
	  $this->cabas = $arr["KDCABAS"];
	
	$sql = "select sisagadai from $DBUser.tabel_700_gadai ".
				 "where prefixpertanggungan='$prefix' and nopertanggungan='$this->nopert' and status='2'";		 
	Database::parse($sql);
	Database::execute();
	$arr=Database::nextrow();
	  $this->sisagadai = $arr["SISAGADAI"];
	 
	$sql = "select substr(noaccount,0,3)||'-'||substr(noaccount,4,5)||'-'||substr(noaccount,9,9) noaccount from $DBUser.TABEL_100_KLIEN_ACCOUNT where ".
			"prefixpertanggungan='$prefix' and nopertanggungan='$this->nopert' and jenis='VA' ".
			"AND status='0' and kdbank='BNI' "; 
	Database::parse($sql);
	Database::execute();
	$arr=Database::nextrow();
	$this->vaccount = $arr["NOACCOUNT"]; 
	//echo $sql;
		
	}
	
	function UsiaPolis($tanggal="") {
		$DBName = Pertanggungan::DBName;
		$DBUser = Pertanggungan::DBUser;
	 if (!$tanggal) {
	  $sql = "select floor(months_between(sysdate,to_date('$this->mulas','DD/MM/YYYY'))/12) usiapol_th, ".
				   "floor(months_between(sysdate,to_date('$this->mulas','DD/MM/YYYY'))) usiapol_bl1, ".
				   "mod(floor(months_between(sysdate,to_date('$this->mulas','DD/MM/YYYY'))),12) usiapol_bl ".
					 "from dual ";
					  
	 } else {
	  $sql = "select floor(months_between(to_date('$tanggal','DD/MM/YYYY'),to_date('$this->mulas','DD/MM/YYYY'))/12) usiapol_th, ".
				   "floor(months_between(to_date('$tanggal','DD/MM/YYYY'),to_date('$this->mulas','DD/MM/YYYY'))) usiapol_bl1, ".
				   "mod(floor(months_between(to_date('$tanggal','DD/MM/YYYY'),to_date('$this->mulas','DD/MM/YYYY'))),12) usiapol_bl ".
					 "from dual ";
	 }
	 //echo $sql;
	 Database::parse($sql);
	 Database::execute();
	 $arr=Database::nextrow();
	 
	 if ($arr["USIAPOL_TH"] < 0) {
	  $usiapolis_th = 0;
		$usiapolis_bl = 0;
	 } else {
	  $usiapolis_th=$arr["USIAPOL_TH"] ;
	 }
	 $usiapolis_bl= ($usiapolis_th==0) ? $arr["USIAPOL_BL1"] :$arr["USIAPOL_BL"];
	 return $usiapolis_th." th, ".$usiapolis_bl." bl";	
	
	}
	
	function UsiaPolisBl($tanggal="") {
		$DBName = Pertanggungan::DBName;
		$DBUser = Pertanggungan::DBUser;
	 if (!$tanggal) {
	  $sql = "select floor(months_between(sysdate,to_date('$this->mulas','DD/MM/YYYY'))) usiapol_bl ".
					 "from dual ";
					  
	 } else {
	  $sql = "select floor(months_between(to_date('$tanggal','DD/MM/YYYY'),to_date('$this->mulas','DD/MM/YYYY'))) usiapol_bl ".
					 "from dual ";
	 }
	 //echo $sql;
	 Database::parse($sql);
	 Database::execute();
	 $arr=Database::nextrow();
	 
	 return $arr["USIAPOL_BL"];
	}	
	
	function GetClient ($noklien) {
		$DBName = Pertanggungan::DBName;
		$DBUser = Pertanggungan::DBUser;
	 $sql = "select ".
	 				//"namaklien1,".
					"replace(namaklien1,'\"','') as namaklien1,".
					"gelar from $DBUser.tabel_100_klien ".
	 			  "where noklien='$noklien'";
   Database::parse($sql);
	 Database::execute();
	 $arr=Database::nextrow();
	 $nama = (strlen($arr["GELAR"])==0 ||preg_match("/\t\n\r\f/",$ary["GELAR"])) ? $arr["NAMAKLIEN1"] : $arr["NAMAKLIEN1"].",".$arr["GELAR"];
	 //echo $sql;
	 return ereg_replace("'","`",$nama);	
	}

	function GetEmail($noklien) {
		$DBName = Pertanggungan::DBName;
		$DBUser = Pertanggungan::DBUser;
	  $sql = "select NVL(EMAILTAGIH,EMAILTETAP) EMAIL
				from $DBUser.tabel_100_klien
	 			where noklien='$noklien'";
	 //echo $sql;
	 Database::parse($sql);
	 Database::execute();
	 $arr=Database::nextrow();
	 
	 return $arr["EMAIL"];
	}	
	
	function StatusPolis($tanggal=""){
		$DBName = Pertanggungan::DBName;
		$DBUser = Pertanggungan::DBUser;
	 if (!$tanggal) {
	  $tanggal=$this->sisdate;
	 } else {
	  $tanggal=$tanggal;
	 }	
			$sql = "select round(months_between(to_date('$tanggal','DD/MM/YYYY'),to_date('$this->bookterakhir','DD/MM/YYYY')),2) beda from dual ";
	    //echo $sql;
		//die;
			Database::parse($sql);
			Database::execute();
			$arr=Database::nextrow();
			 if ($arr["BEDA"] < 0) {
			  return "AKTIF";
			 } else if ($arr["BEDA"] > $this->grace) {
			  return "BEBAS PREMI";
			 } else {
			  return $this->namastatusfile;
			 }
	}		 
						 
};

?>