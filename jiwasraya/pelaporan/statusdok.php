<?
  include "../../includes/common.php";
  include "../../includes/database.php";
  include "../../includes/session.php";
	
	$DB=new Database($userid, $passwd, $DBName);
	$prefixpertanggungan=$kantor;

	$sql  = "select prefixpertanggungan,nopertanggungan ".
	        "from $DBUser.tabel_200_pertanggungan a ".
          "where ".
					       "(select count(*) from $DBUser.tabel_212_dok_cek_uw b ".
                 "where kdstatusunderwriting='0' ".
                 "and a.prefixpertanggungan=b.prefixpertanggungan ".
                 "and a.nopertanggungan=b.nopertanggungan)=0 ".
          "and a.prefixpertanggungan='$kantor' and a.kdstatusemail is null ".
          "and a.kdstatusmedical='M'";
	
	$DB->parse($sql);
	$DB->execute();
	
	echo "Dokumen Underwriting<br>";
	echo "<table>";
	echo "<tr>";
	echo "<td>No.</td><td>Prefix Pertanggungan</td><td>No.Pertanggungan</td></tr>";
	while($arr=$DB->nextrow()){
	 $nopertanggungan = $arr["NOPERTANGGUNGAN"];
	 $i = 0;
	 $i = $hit + 1;
	echo "<tr>";
	echo "<td>".$i."</td><td> ".$arr["PREFIXPERTANGGUNGAN"]."</td><td>".$nopertanggungan."</td>";
  echo "</tr>";
	$hit++;
	}
					//----------------------------- change kode statusemail ------------------
          if ($nopertanggungan == $nopertanggungan){
	           $query= "update $DBUser.tabel_200_pertanggungan set ".
	                   "kdstatusemail='1' where prefixpertanggungan='$kantor' and nopertanggungan='$nopertanggungan'";
             $DB->parse($query);
             $DB->execute();
	           $DB->commit();
	           }
				  //----------------------------- end change kode statusemail -------------- 
         
 ?>
