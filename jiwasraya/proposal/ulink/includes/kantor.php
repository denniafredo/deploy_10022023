<?
class Kantor extends Database {
	var $userid;
	var $passwd;
  var $kdkantor;

	function Kantor($userid,$passwd,$kdkantor)	{
		$this->userid=$userid;
		$this->passwd=$passwd;
		$this->kdkantor=$kdkantor;
				
		Database::Database($this->userid,$this->passwd,"JSDB");
		$sql="select a.emailxlindo,a.emailopr,a.emailadlog, decode(a.kdjeniskantor,'1','KANTOR CABANG','2','KANTOR PERWAKILAN') jeniskantor, ".
				 "a.kdkantorinduk, a.namakantor, a.kdkantorinduk, a.alamat01,a.alamat02,a.kodepos,a.phone01,a.phone02,a.phone03,a.phone04, ".
				 "(select namakantor from $DBUser.tabel_001_kantor where kdkantor=a.kdkantorinduk) as namakantorinduk,".
				 "b.namakotamadya,c.namapropinsi ".
				 "from $DBUser.tabel_001_kantor a, ".
				 "$DBUser.tabel_109_kotamadya b,$DBUser.tabel_108_propinsi c ".
				 "where a.kdkantor='$kdkantor' and ".
				 "a.kdkotamadya=b.kdkotamadya(+) and ".
				 "a.propinsi=c.kdpropinsi(+)";
				 "e.namajabatan like (select  from $DBUser.tabel_001_kantor ".
				 "where kdkantor='$kdkantor') ";
    //echo $sql;
	//die;
		Database::parse($sql);
		Database::execute();
		$ary=Database::nextrow();
		$this->alamat01=$ary["ALAMAT01"];
		$this->alamat02=$ary["ALAMAT02"];
		$this->kodepos=$ary["KODEPOS"];
		$this->phone01=$ary["PHONE01"];
		$this->phone02=$ary["PHONE02"];
		$this->phone03=$ary["PHONE03"];
		$this->phone04=$ary["PHONE04"];
		$this->emailxlindo=$ary["EMAILXLINDO"];
		$this->emailopr=$ary["EMAILOPR"];
		$this->emailadlog=$ary["EMAILADLOG"];
		$this->jeniskantor=$ary["JENISKANTOR"];
		$this->namakantor=$ary["NAMAKANTOR"];
		$this->namakantorinduk=$ary["NAMAKANTORINDUK"];
		$this->kdkantorinduk=$ary["KDKANTORINDUK"];
		$this->kotamadya=$ary["NAMAKOTAMADYA"];
		$this->propinsi=$ary["NAMAPROPINSI"];

	  if($this->kdkantor=="OD")
		{
		$sql = "select b.namapejabat, b.namajabatan ".
	 			   "from $DBUser.tabel_002_pejabat b, $DBUser.tabel_001_kantor a ".
					 "where a.kdkantor='$this->kdkantor' and a.kdkantor=b.kdkantor ".
					 "and b.namajabatan like (select decode(a.kdjeniskantor,'2','%REGIONAL MANAGER','3','%KEPALA UNIT DAERAH') ".
					  "from $DBUser.tabel_001_kantor where kdkantor='$this->kdkantor' )";
					  
	 }
		else
		{
		$sql = "select b.namapejabat, b.namajabatan ".
	 			   "from $DBUser.tabel_002_pejabat b, $DBUser.tabel_001_kantor a ".
					 "where a.kdkantor='$this->kdkantor' and a.kdkantor=b.kdkantor ".
					 "and b.namajabatan like (select decode(a.kdjeniskantor,'1','%REGIONAL MANAGER','2','%BRANCH MANAGER','3','%KEPALA UNIT DAERAH') ".
					  "from $DBUser.tabel_001_kantor where kdkantor='$this->kdkantor' )";
	  }
		//echo $sql;
		//die;
		Database::parse($sql);
		Database::execute();
		$ary=Database::nextrow();
		$this->kepala=$ary["NAMAPEJABAT"];
		$this->jabatan=$ary["NAMAJABATAN"];
		
		$sql = "select a.namakantor,b.namapejabat,b.namajabatan ".
	 			   "from $DBUser.tabel_002_pejabat b, $DBUser.tabel_001_kantor a ".
					 "where ".
					 "a.kdkantor IN (select kdkantorinduk from $DBUser.tabel_001_kantor where kdkantor ='$this->kdkantor') ".
					 "and a.kdkantor=b.kdkantor ".
					 "and b.namajabatan like (select decode(a.kdjeniskantor,'1','%REGIONAL MANAGER','2','%BRANCH MANAGER','3','%KEPALA UNIT DAERAH') ".
					  "from $DBUser.tabel_001_kantor where kdkantor='$this->kdkantor' )";
	  //echo $sql;
	  //die;
		Database::parse($sql);
		Database::execute();
		$ary=Database::nextrow();
		$this->rm=$ary["NAMAPEJABAT"];
    $this->jabatan_rm=$ary["NAMAJABATAN"];
		$this->nama_ro=$ary["NAMAKANTOR"];
		
		
		$sql = "select a.namapejabat, a.kdorganisasi ".
	 			   "from $DBUser.tabel_002_pejabat a ".
					 "where a.kdkantor='$this->kdkantor' and a.kdorganisasi = '161'";
	  //echo $sql;
		Database::parse($sql);
		Database::execute();
		$ary=Database::nextrow();
		$this->kasieopr=$ary["NAMAPEJABAT"];
    
	  $sql = "select a.namapejabat, a.kdorganisasi ".
	 			   "from $DBUser.tabel_002_pejabat a ".
					 "where a.kdkantor='$this->kdkantor' and a.kdorganisasi = '162'";
	  //echo $sql;
		Database::parse($sql);
		Database::execute();
		$ary=Database::nextrow();
		$this->kasieper=$ary["NAMAPEJABAT"];
		
	  $sql = "select a.namapejabat, a.kdorganisasi ".
	 			   "from $DBUser.tabel_002_pejabat a ".
					 "where a.kdkantor='$this->kdkantor' and a.kdorganisasi = '163'";
	  //echo $sql;
		Database::parse($sql);
		Database::execute();
		$ary=Database::nextrow();
		$this->kasieadlog=$ary["NAMAPEJABAT"];
		 
		$sql = "select a.namapejabat, a.kdorganisasi,a.namajabatan ".
	 			   "from $DBUser.tabel_002_pejabat a ".
					 "where a.kdkantor='$this->kdkantor' and a.kdorganisasi = '160'";
	  //echo $sql;
		Database::parse($sql);
		Database::execute();
		$arp=Database::nextrow();
		$this->branchmanager=$arp["NAMAPEJABAT"];
		$this->jabatanmanager=$arp["NAMAJABATAN"];
		
		//Regional Office
		$sql = "select a.namapejabat, a.kdorganisasi,a.namajabatan ".
	 			   "from $DBUser.tabel_002_pejabat a ".
					 "where a.kdkantor='$this->kdkantorinduk' and a.kdorganisasi = '100'";
	  //echo $sql;
		Database::parse($sql);
		Database::execute();
		$arp=Database::nextrow();
		$this->regionalmanager=$arp["NAMAPEJABAT"];
		$this->jabatanrm=$arp["NAMAJABATAN"];
		
		//kabag pertanggungan
		$sql = "select a.namapejabat, a.kdorganisasi,a.namajabatan ".
	 			   "from $DBUser.tabel_002_pejabat a ".
					 "where a.kdkantor='$this->kdkantorinduk' and a.kdorganisasi = '120'";
	  //echo $sql;
		Database::parse($sql);
		Database::execute();
		$arp=Database::nextrow();
		$this->kabagtangrm=$arp["NAMAPEJABAT"];
		$this->jabatankabagtangrm=$arp["NAMAJABATAN"];
		
	}

	
};

class KantorPusat extends Database {
	var $userid;
	var $passwd;
	
	function KantorPusat($userid,$passwd)	{
		$this->userid=$userid;
		$this->passwd=$passwd;
		
		Database::database($userid, $passwd, $DBName);
		$sql = "select ".
					 "(select namapejabat from $DBUser.tabel_002_pejabat ".
				 	 "where kdkantor='KP' and namajabatan like '%KEPALA DIVISI' and kdorganisasi='200') kadivkai, ".
					 "(select namapejabat from $DBUser.tabel_002_pejabat ".
				 	 "where kdkantor='KP' and namajabatan like '%KEPALA DIVISI' and kdorganisasi='300') kadivpp, ".
					 "(SELECT namajabatan ".
              "FROM $DBUser.tabel_002_pejabat ".
             "WHERE kdkantor = 'KP' ".
               "AND namajabatan LIKE '%KEPALA DIVISI' ".
               "AND kdorganisasi = '300') jabatankadivpp, ".
           "(SELECT namapejabat ".
              "FROM $DBUser.tabel_002_pejabat ".
             "WHERE kdkantor = 'KP' ".
               "AND kdorganisasi = '103') dirptg, ".
           "(SELECT namajabatan ".
              "FROM $DBUser.tabel_002_pejabat ".
             "WHERE kdkantor = 'KP' ".
               "AND kdorganisasi = '103') jabatandirptg, ".
					 "(select namapejabat from $DBUser.tabel_002_pejabat ".
				 	 "where kdkantor='KP' and namajabatan like '%KEPALA DIVISI' and kdorganisasi='400') kadivpmsr ".
					 "from dual ";
		//echo $sql;			 
		Database::parse($sql);
		Database::execute();
		$ary=Database::nextrow();
		$this->kadivkai=$ary["KADIVKAI"];
		$this->kadivpp=$ary["KADIVPP"];
		$this->kadivpmsr=$ary["KADIVPMSR"];
		$this->nama_dirtang=$ary["DIRPTG"];
		$this->jabatan_dirtang=$ary["JABATANDIRPTG"];

		$sql = "select emailxlindo,emailopr,emailadlog,namakantor from $DBUser.tabel_001_kantor ".
				   "where kdkantor='KP'";
		Database::parse($sql);
		Database::execute();
		$ary=Database::nextrow();
		$this->emailxlindo=$ary["EMAILXLINDO"];
		$this->emailopr=$ary["EMAILOPR"];	
		$this->emailadlog=$ary["EMAILADLOG"];	
		$this->nama_ho=$ary["NAMAKANTOR"];							 
	}
};


?>
