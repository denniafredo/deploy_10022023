<? 
  include "../../includes/common.php";
  include "../../includes/session.php";
	include "../../includes/database.php";
	$DB=New Database($userid, $passwd, $DBName);
 
	$sql="select s.*,c.namaklien1 from ".
	     "$DBUser.tabel_100_klien c, ".
			 "$DBUser.tabel_200_pertanggungan b, ".
	     "(select distinct x.prefixpertanggungan,x.nopertanggungan,".
			 "to_char(x.tglmutasi,'DD/MM/YYYY') tglmutasi,x.keteranganmutasi, ".
			 "to_char(x.tglmutasi,'DD') tgl, ".
			 "to_char(x.tglmutasi,'MM') bln, ".
			 "to_char(x.tglmutasi,'YYYY') thn ".
			 "from $DBUser.tabel_600_historis_mutasi_pert x ".
//			 "where x.kdmutasi='01' and x.userupdated='$kantor' and ".
			 "where x.kdmutasi='01' and x.prefixpertanggungan='$kantor' and ".
			 "x.keteranganmutasi like 'MASUK%') s ".
			 "where ".
			 "b.nopertanggungan=s.nopertanggungan and ".
			 "b.kdstatusfile='1' and ".
			 "c.noklien=b.notertanggung order by thn,bln desc";

	$DB->parse($sql);
  $DB->execute();
	//echo $sql;
?>
<html>
<head>
<title>Historis Mutasi Polis</title>
<link href="../jws.css" rel="stylesheet" type="text/css">
<font face="Verdana" size="2">
<b>Daftar polis yang pernah dimutasi oleh kantor <? echo $kantor; ?></b>
</font>
<hr size=1>
<div align="center">
<table border="0" cellspacing="1" width="600">
  <tr>
    <td bgcolor="#98D1D1" align="center"><font face="Verdana" size="1"><b>NO</b></font></td>
		<td bgcolor="#98D1D1" align="center"><font face="Verdana" size="1"><b>NO. PERTANGGUNGAN</b></font></td>
		<td bgcolor="#98D1D1" align="center"><font face="Verdana" size="1"><b>TERTANGGUNG</b></font></td>
    <td bgcolor="#98D1D1" align="center"><font face="Verdana" size="1"><b>TGL. MUTASI</b></font></td>
    <td bgcolor="#98D1D1" align="center"><font face="Verdana" size="1"><b>RAYON TUJUAN</b></font></td>
  </tr>
<?
	$i=1;
	while($his=$DB->nextrow()){
	$ketmutasi=$his["KETERANGANMUTASI"];
	$pindah = substr($ketmutasi,21,2);
	  include "../../includes/belang.php";	 
    echo "<td align=\"right\"><font face=\"Verdana\" size=\"1\">".$i."</font></td>";
		echo "<td align=\"center\"><font face=\"Verdana\" size=\"1\">".$his["PREFIXPERTANGGUNGAN"]."-".$his["NOPERTANGGUNGAN"]."</font></td>";
		echo "<td><font face=\"Verdana\" size=\"1\">".$his["NAMAKLIEN1"]."</font></td>";
    echo "<td align=\"center\"><font face=\"Verdana\" size=\"1\">".$his["TGLMUTASI"]."</font></td>";
    echo "<td align=\"center\"><font face=\"Verdana\" size=\"1\" color=blue><b>".$pindah."</b></font></td>";
    echo "</tr>";
		$i++;
	}
?>
</table>
</div>
<hr size=1>
<a class=verdana10blk href="index.php">Menu Pelaporan</a>
</body>
</html>
