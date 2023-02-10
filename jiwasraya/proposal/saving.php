<?
  include "../../includes/common.php";
  include "../../includes/database.php";
  include "../../includes/session.php";
	$DB=New database($userid, $passwd, $DBName);

?>
<html>
<head><title>Perhitungan Nilai Tebus</title>
<link href="../jws.css" rel="stylesheet" type="text/css">
<body topmargin="0">
<div align="center">
<table width="100%">
	<tr><td align="right"><font face="Verdana" size="1" color="#0033CC">F1432</font></td></tr>
		</table>
		<font face="Verdana" size="2"><b>Nilai Tebus <?echo $namaproduk;?></b></font><br>
		<font face="Verdana" size="2">Basis : <? echo $basistebus;?><br></font>
  	<font face="Verdana" size="2" color="#cc33cc"><b>TOP UP : <? echo number_format($jua,2);?></b></font>


  <table border="0" width="100%" cellpadding="1" cellspacing="1" class="tblisi">
  <tr class="tblhead">
  <td align="center"><b>Akhir Bulan Ke-</b></font></td>
  <td align="center"><b>Nilai Tebus</b></font></td>
  </tr>
<?
    if(substr($kdproduk,0,4)=="JSAP")
		{
      $tabeltebus = "$DBUser.tabel_231_tarif_saving"; // khusus JSAP
		}
		else
		{
		  $tabeltebus = "$DBUser.tabel_231_tarif_saving "; // khusus JSAP
		}

		$sql="select t, tarif from ".$tabeltebus." where ".
		     "(kdproduk)=".
				 "(select a.kdproduk from $DBUser.tabel_200_pertanggungan a ".
				 "where ".
				 "a.prefixpertanggungan='$pref' and a.nopertanggungan='$noper') ".
				 "and kdtarif='SAVING' ".//add apakah benar ?
				 "order by t";
		//echo $sql;
		$DB->parse($sql);
	  $DB->execute();
	  $i=0;
		while ($res=$DB->nextrow()) {
		  if ($res["TARIF"] <> 0){
	    include "../../includes/belang.php";
				print( "<td align=\"center\" class=verdana9>".$res["T"]."</td>\n" );

			  print( "<td align=\"right\" class=verdana9>".number_format(round($jua/1000000/0.95*$res["TARIF"],2),2)."</td>" );
			  print( "</tr>" );
		  }
			$i++;
		}
?>
	</table>
	</table>
  <table width="100%">
	 <tr>
	  <td align="left" class="verdana9"><a href="#" onClick="window.print();">Print</a></td>
	  <td align="right" class="verdana9"><a href="#" onClick="window.close();" >Close</a></td>
	 </tr>
	</table>
	

</div>
</body>
</html>