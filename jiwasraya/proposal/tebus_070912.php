<?
  include "../../includes/common.php";
  include "../../includes/database.php";
  include "../../includes/session.php";
	$DB=New database($userid, $passwd, $DBName);

	if ($nottemp){
		$sql="select c.kdbasistebus,b.kdproduk,b.namaproduk, a.kdvaluta ".
		     "from $DBUser.tabel_200_pertanggungan a,$DBUser.tabel_202_produk b,$DBUser.tabel_247_pertanggungan_basis c ".
				 "where a.prefixpertanggungan=c.prefixpertanggungan and a.nopertanggungan=c.nopertanggungan and ".
				 "a.kdproduk=b.kdproduk and ".
		     "a.prefixpertanggungan='$pref' and a.nopertanggungan='$noper'";
  } else {
		$sql="select c.kdbasistebus, b.kdproduk,b.namaproduk, a.kdvaluta ".
		     "from $DBUser.tabel_200_temp a,$DBUser.tabel_202_produk b,$DBUser.tabel_247_temp c ".
				 "where a.prefixpertanggungan=c.prefixpertanggungan and a.nopertanggungan=c.nopertanggungan and ".
				 "a.kdproduk=b.kdproduk and ".
		     "a.prefixpertanggungan='$pref' and a.nopertanggungan='$noper'";
	}
	//echo $nottemp;
	//echo $sql; 
		$DB->parse($sql);
	  $DB->execute();
	  $res=$DB->nextrow();
		$namaproduk=$res["NAMAPRODUK"];
		$kdproduk=$res["KDPRODUK"];
    $basistebus=$res["KDBASISTEBUS"];
    $kdvaluta=$res["KDVALUTA"];

$tabel=($nottemp) ? "from $DBUser.tabel_200_pertanggungan a,$DBUser.tabel_247_pertanggungan_basis b " : "from $DBUser.tabel_200_temp a,$DBUser.tabel_247_temp b ";

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
  	<font face="Verdana" size="2" color="#cc33cc"><b>JUA : <? echo number_format($jua,2);?></b></font>


  <table border="0" width="100%" cellpadding="1" cellspacing="1" class="tblisi">
  <tr class="tblhead">
  <td align="center"><b>Akhir Th Ke-</b></font></td>
  <td align="center"><b>Nilai Tebus</b></font></td>
  </tr>
<?
    if(substr($kdproduk,0,4)=="JSAP")
		{
      $tabeltebus = "$DBUser.tabel_231_tarif_tebus_ms"; // khusus JSAP
		}
		else
		{
		  $tabeltebus = "$DBUser.tabel_231_tarif_tebus"; // khusus JSAP
		}

		$sql="select t, tarif from ".$tabeltebus." where ".
		     "(kdproduk,masa,cara,usia,kdvaluta,kdbasis)=".
				 "(select a.kdproduk,a.lamapembpremi_th,decode(a.kdcarabayar,'E','E','J','J','X','X','M','M','Q','Q','H','H','A','A','B'),".
				 "a.usia_th,a.kdvaluta,b.kdbasistebus ".
				 $tabel.
				 "where a.prefixpertanggungan=b.prefixpertanggungan and a.nopertanggungan=b.nopertanggungan ".
				 "and a.prefixpertanggungan='$pref' and a.nopertanggungan='$noper') ".
				 "and kdtarif='TEBUS' ".//add apakah benar ?
				 "order by t";
		//echo $sql;
		$DB->parse($sql);
	  $DB->execute();
	  $i=0;
		while ($res=$DB->nextrow()) {
		  if ($res["TARIF"] <> 0){
	    include "../../includes/belang.php";
				print( "<td align=\"center\" class=verdana9>".$res["T"]."</td>\n" );
  			if ($kdvaluta=='1') {
  				if (substr($kdproduk,0,4)=="JSSP") {
						 if ($kdproduk=='JSSPO4'||$kdproduk=='JSSPO5'||$kdproduk=='JSSPO6'){
      					print( "<td align=\"right\" class=verdana9>".number_format($jua/1000*$res["TARIF"],0)."</td>" );
  					 } else {
      					print( "<td align=\"right\" class=verdana9>".number_format(round($jua/1000*$res["TARIF"],-3),0)."</td>" );
//						print( "<td align=\"right\" class=verdana9>".number_format(round($res["TARIF"],-3),0)."</td>" );
						 }
  				} else {
      				print( "<td align=\"right\" class=verdana9>".number_format(round($jua/1000*$res["TARIF"],0),0)."</td>" );
      			}
			} else {
			  print( "<td align=\"right\" class=verdana9>".number_format(round($jua/1000*$res["TARIF"],2),2)."</td>" );
			}
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