<?  
  include "../../includes/database.php";
  include "../../includes/session.php";
	include "../../includes/common.php";
	$formname=(!$a) ? "ntryprop" : $a;	
	$fieldname=(!$b) ? "nopenagih" : $b;
  echo("<title>Penagih List</title>");
  print( "<link href=\"../jws.css\" rel=\"stylesheet\" type=\"text/css\">" );
	echo("<html><body topmargin=\"0\">");
	echo "<div align=center><table width=\"100%\">";
  echo "<tr><td align=\"right\"><font face=\"Verdana\" size=\"1\" color=\"#0033CC\">F1332</font></td></tr>";
  echo "</table>";
	echo("<b><font face=\"Verdana\" size=\"2\">Daftar Penagih Rayon Penagihan ".$kantor."</b></font><br>");
	$DB = new Database($userid, $passwd, $DBName);

  $sql="select a.prefixpenagih,a.nopenagih, b.namaklien1,a.kdrayonpenagih from ".
	     "$DBUser.tabel_100_klien b,$DBUser.tabel_500_penagih a ".
	     "where b.noklien=a.nopenagih and a.kdrayonpenagih='".$kantor."' ".
			 "and kdstatuspenagih != '04' ".
			 "order by b.namaklien1";
	
	$DB->parse($sql);
	$DB->execute();
?>
	<table border="0" width="100%">
  <tr  bgcolor="#97b3b9">
    <td align=center class="arial10bold">Nomor</td>
		<td align=center class="arial10bold">Asal</td>
    <td align=center class="arial10bold">Rayon</td>
    <td align=center class="arial10bold">Nama</td>
  </tr>
<?
	$i=0;
	while($arr=$DB->nextrow()) {
	  include "../../includes/belang.php";
		$namapenagih=$arr["NAMAKLIEN1"];
		$namapenagih=str_replace("'","`",$namapenagih);
		$a="<td class=arial10ungu><a href=\"#\" onclick=\"javascript:".
		"window.opener.document.updatekonversi.nopenagihbaru.value='".$arr["NOPENAGIH"]."';".
		"window.opener.document.updatekonversi.namapenagihbaru.value='".$namapenagih."';".
		"window.close();\" >".$arr["NOPENAGIH"]."</a></td>".
    "<td  class=arial10ungu align=center>".$arr["PREFIXPENAGIH"]."</td>".
    "<td  class=arial10ungu align=center>".$arr["KDRAYONPENAGIH"]."</td>".
    "<td  class=arial10ungu>".$arr["NAMAKLIEN1"]."</td>".
    "</tr>";
		echo($a);
		$i++;
	}
?>
</table></div>
</body></html>