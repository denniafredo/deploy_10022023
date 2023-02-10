<? 
  include "../../includes/common.php";
  include "../../includes/session.php";
	include "../../includes/database.php";
	$DB=New database($userid, $passwd, $DBName);

//----------------------- query historis mutasi ------------------------------------
	$sqlp="select prefixpertanggungan ".
			 "from $DBUser.tabel_200_pertanggungan where nopertanggungan='$nopertanggungan'";
	$DB->parse($sqlp);
  $DB->execute();
	$arr=$DB->nextrow();
	$prefixpertanggungan = $arr["PREFIXPERTANGGUNGAN"];

	$sql="select a.tglmutasi,to_char(a.tglmutasi,'HH:mi:ss') jammutasi,a.keteranganmutasi,a.userupdated,b.namamutasi ".
			 "from $DBUser.tabel_600_historis_mutasi_pert a,$DBUser.tabel_601_kode_mutasi b ".
  	   "where a.kdmutasi=b.kdmutasi and ".
			// "a.prefixpertanggungan='$prefix' and ".
			 "a.nopertanggungan='$nopertanggungan' order by a.tglmutasi desc"; 
	$DB->parse($sql);
  $DB->execute();
?>
<html>
<head>
<title>Historis Mutasi</title>
<link href="../jws.css" rel="stylesheet" type="text/css">
<font face="Verdana" size="2">
 <table width="100%">
<tr><td align="right"><font face="Verdana" size="2" color="#0033CC">F1338</font></td></tr>
</table><b>Historis Mutasi</b>&nbsp; No. Polis : <? echo $prefixpertanggungan."-".$nopertanggungan; ?>
</font>
<hr size=1>
<table border="0" width="100%" cellspacing="1">
  <tr>
    <td bgcolor="#98D1D1" align="center"><font face="Verdana" size="1"><b>NO</b></font></td>
    <td bgcolor="#98D1D1" align="center"><font face="Verdana" size="1"><b>TGL. MUTASI</b></font></td>
		<td bgcolor="#98D1D1" align="center"><font face="Verdana" size="1"><b>JAM MUTASI</b></font></td>
		<td bgcolor="#98D1D1" align="center"><font face="Verdana" size="1"><b>USER UPDATE</b></font></td>
    <td bgcolor="#98D1D1" align="center"><font face="Verdana" size="1"><b>JENIS MUTASI</b></font></td>
    <td bgcolor="#98D1D1" align="center"><font face="Verdana" size="1"><b>KETERANGAN</b></font></td>
  </tr>
<?
	$i=1;
	while($his=$DB->nextrow()){
	  include "../../includes/belang.php";	 
    echo "<td align=\"right\"><font face=\"Verdana\" size=\"1\">".$i."</font></td>";
    echo "<td align=\"center\"><font face=\"Verdana\" size=\"1\">".$his["TGLMUTASI"]."</font></td>";
		echo "<td align=\"center\"><font face=\"Verdana\" size=\"1\">".$his["JAMMUTASI"]."</font></td>";
		echo "<td align=\"center\"><font face=\"Verdana\" size=\"1\">".$his["USERUPDATED"]."</font></td>";
    echo "<td align=\"left\"><font face=\"Verdana\" size=\"1\">".$his["NAMAMUTASI"]."</font></td>";
    echo "<td ><font face=\"Verdana\" size=\"1\">".$his["KETERANGANMUTASI"]."</font></td>";
    echo "</tr>";
		$i++;
	}
?>
</table>
<hr size=1>
<table width="100%">
  <tr>
	  <td align="right">
		<? echo "<a href=\"#\" onclick=\"javascript:window.close();\"><font face=\"Verdana\" size=\"1\">CLOSE</font></a>"; ?>
	  </td>
	</tr>
</table>
</body>
</html>
