<?  
  include "../../includes/database.php";
  include "../../includes/session.php";
	include "../../includes/common.php";
	
$formname=(!$a) ? "ntryprop" : $a;	
$fieldname=(!$b) ? "noagen" : $b;	
  echo("<html><title>Agen List</title>");
  print( "<link href=\"../jws.css\" rel=\"stylesheet\" type=\"text/css\">" );
	echo("<body topmargin=\"0\">");
	echo "<div align=center><table width=\"100%\">";
  echo "<tr><td align=\"right\"><font face=\"Verdana\" size=\"2\" color=\"#0033CC\">F1332</font></td></tr>";
  echo "</table>";
	echo("<b><font face=\"Verdana\" size=\"2\">Daftar Agen kantor ".$kantor."</b></font><br>");
	$DB = new Database($userid, $passwd, $DBName);
  $sql="select a.noagen, b.namaklien1 from $DBUser.tabel_100_klien b,$DBUser.tabel_400_agen a ".
	         "where b.noklien=a.noagen and a.prefixagen='".$kantor."'";
	//echo $sql;
	$DB->parse($sql);
	$DB->execute();
?>
	<table border="0" width="100%">
  <tr  bgcolor="#97b3b9">
    <td align=center class="arial10bold">Nomor</td>
    <td align=center class="arial10bold">Nama</td>
  </tr>
<?
	$i=0;
	while($arr=$DB->nextrow()) {
	  include "../../includes/belang.php";
		$a="<td class=arial10ungu><a href=\"#\" onclick=\"javascript:".
		"window.opener.document.updatekonversi.noagenbaru".$n.".value='".$arr["NOAGEN"]."';".
		"window.opener.document.updatekonversi.namaagenbaru".$n.".value='".$arr["NAMAKLIEN1"]."';".
		"window.close();\" >".$arr["NOAGEN"]."</a></td>".
    "<td  class=arial10ungu>".$arr["NAMAKLIEN1"]."</td>".
    "</tr>";
	  echo($a);
		$i++;
	}
?>
</table></div>
</body></html>