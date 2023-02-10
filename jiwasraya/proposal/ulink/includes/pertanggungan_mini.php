<?php
class Pertanggungan extends Database {
	var $usiapolis_th;
	var $usiapolis_bl;
	var $usiapolis_bl1;
	var $sysdate;
	
	function Pertanggungan($userid="",$passwd="",$prefix="",$nopert="") {
	  $this->prefix=$prefix;
	  $this->nopert=$nopert;
		$this->userid=$userid;
		$this->passwd=$passwd;
		
		Database::database($userid, $passwd, $DBName);
		
		$sql="select a.nopol,nvl(a.gadaiotomatis,'0') gpo, a.premistd, ".
				 "decode(a.kdpertanggungan,'1','Proposal','Polis') kdper,a.nobp3, a.juamainproduk,floor(months_between(sysdate,mulas)/12) usiapolisth,b.faktorkomisi, ".
				 "a.usia_th, a.kdproduk, c.namaproduk, a.kdstatusmedical,decode(a.kdstatusmedical,'M','MEDICAL','NON MEDICAL') statusmedical, a.kdvaluta, to_char(a.tglbp3,'DD/MM/YYYY') tglbp3, ".
				 "decode(a.kdvaluta,'0','RUPIAH INDEX','1','RUPIAH','DOLLAR AS') namavaluta, decode(a.kdvaluta,'0','RpI','1','Rp','US$') notasi, ".
				 "a.nosp,to_char(a.tglsp,'DD/MM/YYYY') tglsp,a.kdcarabayar, b.namacarabayar, a.lamapembpremi_th, a.lamaasuransi_th, a.lamapembpremi_bl, a.lamaasuransi_bl,a.nopembayarpremi, ".
		     "a.noagen, a.nopenagih, a.nopemegangpolis,a.kdstatusfile, ".
				 "z.namastatusfile,a.risk,usia_bl, ".
				 "a.notertanggung, a.premi1, a.premi2, to_char(a.tglupdated,'DD/MM/YYYY HH:MI:SS') lastupdate, ".
				 "to_char(a.tglakhirpremi,'DD/MM/YYYY') akhirpremi,to_char(a.tglnextbook,'DD/MM/YYYY') tglnextbook,to_char(a.tgllastpayment,'DD/MM/YYYY') tgllastpayment,".
				 "to_char(a.mulas,'DD/MM/YYYY') mulas,to_char(a.expirasi,'DD/MM/YYYY') expirasi, ".
				 "a.indexawal, to_char(a.tglbpo,'DD/MM/YYYY') tglbpo,a.lockmutasi, ".
				 "decode(a.tglrekam,NULL,'',to_char(a.tglrekam,'DD/MM/YYYY')||' oleh '||a.userrekam) rekam, ".
				 "decode(a.tglupdated,NULL,'',to_char(a.tglupdated,'DD/MM/YYYY')||' oleh '||a.userupdated) updated ".
				 "from ".
				 "$DBUser.tabel_200_pertanggungan a, ".
				 "$DBUser.tabel_202_produk c, $DBUser.tabel_305_cara_bayar b, ".
				 "$DBUser.tabel_299_status_file z ".
				 "where ".
				 "a.kdstatusfile=z.kdstatusfile and ".
				 "a.prefixpertanggungan='$prefix' and a.nopertanggungan='$nopert' and ".
				 "a.kdcarabayar=b.kdcarabayar and a.kdproduk=c.kdproduk";
				 
		//echo $sql;		 
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
		$this->nobp3 = $arr["NOBP3"];
		$this->tglsp = $arr["TGLSP"];
    $this->nosp = $arr["NOSP"];
		$this->namavaluta = $arr["NAMAVALUTA"];
		$this->notasi = $arr["NOTASI"];
		$this->kdcarabayar = $arr["KDCARABAYAR"];
		$this->namacarabayar = $arr["NAMACARABAYAR"];
		$this->lamapremi = $arr["LAMAPEMBPREMI_TH"];
		$this->lamaasuransi = $arr["LAMAASURANSI_TH"];
		$this->lamapremi_bl = $arr["LAMAPEMBPREMI_BL"];
		$this->lamaasuransi_bl = $arr["LAMAASURANSI_BL"];
		$this->noagen = $arr["NOAGEN"];
		$this->nopenagih = $arr["NOPENAGIH"];
		$this->notertanggung = $arr["NOTERTANGGUNG"];
		$this->nopemegangpolis = $arr["NOPEMEGANGPOLIS"];
		$this->nopembayarpremi = $arr["NOPEMBAYARPREMI"];
		$this->premi1 = $arr["PREMI1"];
		$this->premi2 = $arr["PREMI2"];
		$this->lastupdate = $arr["LASTUPDATE"];
		$this->akhirpremi = $arr["AKHIRPREMI"];
		$this->tglnextbook = $arr["TGLNEXTBOOK"];
		$this->tgllastpayment = $arr["TGLLASTPAYMENT"];
		$this->tglbpo = $arr["TGLBPO"];
		$this->mulas = $arr["MULAS"];
		$this->expirasi = $arr["EXPIRASI"];
		$this->indexawal = $arr["INDEXAWAL"];
		$this->usiapolisth = $arr["USIAPOLISTH"];
		$this->statusfile = $arr["NAMASTATUSFILE"];
		$this->lockmutasi = $arr["LOCKMUTASI"];
		$this->nopol = $arr["NOPOL"];
		$this->gpo = $arr["GPO"];
		$this->premistandar = $arr["PREMISTD"];
		$this->risk = $arr["RISK"];
		$this->kdstatusfile = $arr["KDSTATUSFILE"];
		$this->namastatusfile = $arr["NAMASTATUSFILE"];
		$this->rekam = $arr["REKAM"];
		$this->update = $arr["UPDATED"];
		
		$this->label = $prefix."-".$nopert;
	 	$this->namatertanggung = $this->GetClient ($this->notertanggung);
		$this->namapemegangpolis = $this->GetClient ($this->nopemegangpolis);
		$this->namapembayarpremi = $this->GetClient ($this->nopembayarpremi);
		$this->namaagen = $this->GetClient ($this->noagen);
		$this->namapenagih = $this->GetClient ($this->nopenagih);	
		
  }
		
	function GetClient ($noklien) {
	 $sql = "select namaklien1,gelar from $DBUser.tabel_100_klien ".
	 			  "where noklien='$noklien'";
   Database::parse($sql);
	 Database::execute();
	 $arr=Database::nextrow();
	 $nama = (strlen($arr["GELAR"])==0) ? $arr["NAMAKLIEN1"] : $arr["NAMAKLIEN1"].",".$arr["GELAR"];
	 return ereg_replace("'","`",$nama);				
	}
	
						 
};

?>