<?
class Mutasi extends Database {
	var $userid;
	var $passwd;
	var $prefix;
	var $noper;
	var $maxno;
	
	function Mutasi($userid,$passwd,$prefix,$noper)	{
		$this->userid=$userid;
		$this->passwd=$passwd;
		$this->prefix=$prefix;
		$this->noper=$noper;
		Database::database($userid, $passwd, $DBName);
		$sql = "select keteranganmutasi,userupdated,kdmutasi,to_char(tglmutasi,'DD/MM/YYYY') tglmutasi ".
					 "from $DBUser.tabel_600_historis_mutasi_pert where ".
					 "prefixpertanggungan='$prefix' and nopertanggungan='$noper' and tglmutasi=".
					 "(select max(tglmutasi) from $DBUser.tabel_600_historis_mutasi_pert where ".
					 "prefixpertanggungan='$prefix' and nopertanggungan='$noper')";
					 
    Database::parse($sql);
		Database::execute();
		$ary=Database::nextrow();
		$this->lastkode=$ary["KDMUTASI"];
		$this->lasttgl=$ary["TGLMUTASI"];
		$this->lastuser=$ary["USERUPDATED"];
		$this->lastket=$ary["KETERANGANMUTASI"];
			
	}
	
	function NamaMutasi($kdmutasi) {
		Database::Database($this->userid,$this->passwd,"JSDB");
		$sql="select namamutasi from $DBUser.tabel_601_kode_mutasi where kdmutasi='$kdmutasi'";
    Database::parse($sql);
		Database::execute();
		$ary=Database::nextrow();

		return $ary["NAMAMUTASI"];
	}
	
	function Maxno($kdmutasi) {
		Database::Database($this->userid,$this->passwd,"JSDB");
		$sql = "select count(kdmutasi) maxno from $DBUser.tabel_600_historis_mutasi_pert ".						 
				   "where prefixpertanggungan='$this->prefix' and nopertanggungan='$this->noper' and kdmutasi='$kdmutasi' ".
					 "group by prefixpertanggungan,nopertanggungan ";
    //echo $sql;
		Database::parse($sql);
		Database::execute();
		$ary=Database::nextrow();
		$maxno =($ary["MAXNO"]==0) ? 1 : $ary["MAXNO"];
		return $maxno;
	}

};
?>