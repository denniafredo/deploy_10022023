<?
  include "../../includes/database.php";
  include "../../includes/session.php";
	include "../../includes/common.php";
	$DB=new database($userid, $passwd, $DBName);
	$prefixpertanggungan=$kantor;
	
	$sql="select namaklien1 from $DBUser.tabel_100_klien ".
	     "where noklien='$noagen'";
	$DB->parse($sql);
	$DB->execute();	
	$x=$DB->nextrow();
	$namaagen = $x["NAMAKLIEN1"];
			 
	$sql="select a.thnkomisi,a.komisiagen,b.namakomisiagen ".
	     "from $DBUser.tabel_404_temp a, $DBUser.tabel_402_kode_komisi_agen b ".
			 "where a.kdkomisiagen=b.kdkomisiagen and a.prefixpertanggungan='$prefixpertanggungan' and a.nopertanggungan='$nopertanggungan'";
	//echo $sql;
	$DB->parse($sql);
	$DB->execute();	
?>
<html>
<head><title>Hitung Komisi</title></head>
<body topmargin="0">
<table width="100%">
<tr><td align="right"><font face="Verdana" size="2" color="#0033CC">F1431</font></td></tr>
</table>
	<font face="Verdana" size="2"><b>Komisi Agen Penutup</b></font>
  <hr size=1>
	<table>
	<tr>
	  <td><font face="Verdana" size="2">No. Agen</font></td>
	  <td><font face="Verdana" size="2">:</font></td>
	  <td><font face="Verdana" size="2"><? echo $noagen; ?></font></td>
	  <td><font face="Verdana" size="2"><? echo "&nbsp;".$namaagen; ?></font></td>
	</tr>
	</table>
  <hr size=1>
	<?
	echo "<table width=\"100%\">";
	echo "<tr bgcolor=\"#666699\" align=\"center\">";
  echo "<td><font face=\"Arial\" size=\"2\" color=\"#ffffcc\">Tahun</font></td>";
  echo "<td width=50%><font face=\"Arial\" size=\"2\" color=\"#ffffcc\">Nama Komisi</font></td>";
  echo "<td><font face=\"Arial\" size=\"2\" color=\"#ffffcc\">Komisi</font></td>";
	echo "</tr>";
	
	$jmlkomisi=0;
  while($arr=$DB->nextrow()) {
	  $namakomisi = $arr["NAMAKOMISIAGEN"];
		switch ($namakomisi) {
	    case "KOMISI PROPOSAL BARU":
		    $komisi = "KOMISI TAHUN KE";
			  break;
			  default:
		    $komisi = $namakomisi;
			case "KOMISI PREMI PERTAMA":
		    $komisi = "KOMISI PREMI";
			  break;
			  default:
		    $komisi = $namakomisi;
		}
	  echo "<tr>";
	  echo "<td align=\"center\"><font face=\"Arial\" size=\"1\">".$arr["THNKOMISI"]."</font></td>";
	  echo "<td><font face=\"Arial\" size=\"1\">".$komisi." ".$arr["THNKOMISI"]."</font></td>";
	  //echo "<td><font face=\"Arial\" size=\"1\">".$arr["NAMAKOMISIAGEN"]."</font></td>";
	  echo "<td align=\"right\"><font face=\"Arial\" size=\"1\">".number_format($arr["KOMISIAGEN"],2)."</font></td>";
	  echo "</tr>";
		$jmlkomisi += $arr["KOMISIAGEN"];
	}
  echo "<tr bgcolor=\"#9999cc\">";
  echo "<td colspan=\"2\"><font face=\"Verdana\" size=\"2\"><b>Jumlah Komisi</b></font></td>";
  echo "<td align=\"right\"><font face=\"Arial\" size=\"2\" color=\"#000099\"><b>".number_format($jmlkomisi,2)."</b></font></td>";
  echo "</tr>";
	echo "</table>";
  echo "<hr size=1>";
	echo "<table width=\"100%\"><tr>";
	echo "<td></td>";
	echo "<td align=\"right\" valign=\"top\">";
	//echo "<a href=\"#\" onclick=\"javascript:window.print();\"><font face=\"Verdana\" size=\"1\">CETAK</font></a>&nbsp;&nbsp;&nbsp;";
	//echo "<a href=\"#\" onclick=\"javascript:window.close();\"><font face=\"Verdana\" size=\"1\">CLOSE</font></a>";
	echo "<a href=\"#\" onclick=\"javascript:window.print();\"><img src=\"http://$HTTP_HOST/jiwasraya/img/print.gif\" alt=\"cetak\" border=\"0\"></a>&nbsp;&nbsp;&nbsp;";
	echo "<a href=\"#\" onclick=\"javascript:window.close();\"><img src=\"http://$HTTP_HOST/jiwasraya/img/logout.gif\" alt=\"tutup\" border=\"0\" width=\"19\" height=\"19\"></a>";
	//echo "<input type=\"button\" value=\"Close\" onclick=\"javascript:window.close();\">";
	echo "</td></tr></table>";
?>
</body>
</html>