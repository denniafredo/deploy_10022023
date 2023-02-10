<?
class KomisiAgen extends Database {
	var $userid;
	var $passwd;
  var $prefix;
	var $nopert;

	function Kantor($userid,$passwd,$prefix,$nopert)	{
		$this->userid=$userid;
		$this->passwd=$passwd;
		$this->prefix=$prefix;
	  $this->nopert=$nopert;
		
				
		Database::database($userid, $passwd, $DBName);
		
		$sql="select ".
					"a.prefixpertanggungan,a.nopertanggungan,".
          "sum((select nvl(b.komisiagencb,0) from $DBUser.tabel_404_temp b ".
           "where  b.prefixpertanggungan = a.prefixpertanggungan ".
           "and    b.nopertanggungan = a.nopertanggungan ".
           "and    b.kdkomisiagen='01' ".
           "and    b.thnkomisi = floor(months_between(a.tglbooked,c.mulas)/12))) jmlkomisi ".
          "from ".
							"$DBUser.tabel_300_historis_premi a,".
          	  "$DBUser.tabel_200_pertanggungan c ".
          "where ".
							"a.prefixpertanggungan = c.prefixpertanggungan ".
              "and   a.nopertanggungan  = c.nopertanggungan ".
              "and   a.prefixpertanggungan = '$prefix' ".
              "and 	a.nopertanggungan ='$nopert' ".
              "and   a.tglseatled is null ".
          "group by a.prefixpertanggungan, a.nopertanggungan;";

    //echo $sql;
		Database::parse($sql);
		Database::execute();
		$ary=Database::nextrow();
		$this->jmlkomisiagen=$ary["JMLKOMISI"];
		
			 
	}
};
?>
