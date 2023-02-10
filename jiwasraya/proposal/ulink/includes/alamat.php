<?
class AlamatTagih extends Database {
	var $userid;
	var $passwd;
	//var $noklien;
	function AlamatTagih($userid,$passwd,$noklien)	{
		$this->userid=$userid;
		$this->passwd=$passwd;
		Database::database($userid, $passwd, $DBName);
		$sql="select b.alamattagih01,b.alamattagih02,b.kodepostagih,d.namakotamadya,c.namapropinsi, ".
	       "b.phonetagih01,b.phonetagih02,b.emailtagih ".
				 "from $DBUser.tabel_100_klien b, $DBUser.tabel_109_kotamadya d ,$DBUser.tabel_108_propinsi c ".
				 "where b.noklien='$noklien' and b.kdpropinsitagih=c.kdpropinsi(+) and b.kdkotamadyatagih=d.kdkotamadya(+)";
    //echo $sql;
		Database::parse($sql);
		Database::execute();
		$ary=Database::nextrow();
		$this->alamat01=$ary["ALAMATTAGIH01"];
		$this->alamat02=$ary["ALAMATTAGIH02"];
		$this->kodepos=$ary["KODEPOSTAGIH"];
		$this->kotamadya=$ary["NAMAKOTAMADYA"];
		$this->propinsi=$ary["NAMAPROPINSI"];
		$this->phone01=$ary["PHONETAGIH01"];
		$this->phone02=$ary["PHONETAGIH02"];
		$this->email=$ary["EMAILTAGIH"];
	}
	
	function NamaKodya($kdkotamadya) {
		$sql = "select namakotamadya from $DBUser.tabel_109_kotamadya ".
				   "where kdkotamadya='$kdkotamadya'";
		Database::parse($sql);
		Database::execute();
		$ary=Database::nextrow();
		return $ary["NAMAKOTAMADYA"];
	}
	
	function NamaPropinsi($kdpropinsi){
		$sql ="select namapropinsi from $DBUser.tabel_108_propinsi ".
				 "where kdpropinsi='$kdpropinsi'";
		Database::parse($sql);
		Database::execute();
		$ary=Database::nextrow();
		return $ary["NAMAPROPINSI"];
	}
};

class AlamatTetap extends Database {
	var $userid;
	var $passwd;
	//var $noklien;
	function AlamatTetap($userid,$passwd,$noklien)	{
		$this->userid=$userid;
		$this->passwd=$passwd;
		
		$sql = "select b.alamattetap01,b.alamattetap02,b.kodepostetap,d.namakotamadya,c.namapropinsi, ".
	         "b.phonetetap01,b.phonetetap02,b.emailtetap ".
				   "from $DBUser.tabel_100_klien b, $DBUser.tabel_109_kotamadya d, $DBUser.tabel_108_propinsi c ".
				   "where b.noklien='$noklien' and b.kdpropinsitetap=c.kdpropinsi(+) and b.kdkotamadyatetap=d.kdkotamadya(+)";
    
		Database::database($userid, $passwd, $DBName);
		Database::parse($sql);
		Database::execute();
		$ary=Database::nextrow();
		$this->alamat01=$ary["ALAMATTETAP01"];
		$this->alamat02=$ary["ALAMATTETAP02"];
		$this->kodepos=$ary["KODEPOSTETAP"];
		$this->kotamadya=$ary["NAMAKOTAMADYA"];
		$this->propinsi=$ary["NAMAPROPINSI"];
		$this->phone01=$ary["PHONETETAP01"];
		$this->phone02=$ary["PHONETETAP02"];
		$this->email=$ary["EMAILTETAP"];
	}
};
?>
