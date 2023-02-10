<?  
  include "../../includes/database.php";
  include "../../includes/session.php";
  echo("<title>Agen List</title>");
	echo("<html><body topmargin=\"0\">");
	echo "<table width=\"100%\">";
  echo "<tr><td align=\"right\"><font face=\"Verdana\" size=\"2\" color=\"#0033CC\">F1414</font></td></tr>";
  echo "</table>";
	echo("<font face=\"Verdana\" size=\"2\" color=\"#00339\"><b>Daftar Agen</b></font>");
	echo "<hr size=\"1\">";
	$DB=New database($userid, $passwd, $DBName);
  $sql="select noagen, namaklien1 from $DBUser.tabel_400_agen a, $DBUser.tabel_100_klien b ".
	     "where a.noagen=b.noklien order by namaklien1";
	$DB->parse($sql);
	$DB->execute();
	while($arr=$DB->nextrow()) {
    printf("<font face=\"Verdana\" size=\"1\"><a href=\"#\" onclick=\"javascript:window.opener.document.propmtc11.noagen.value='%s';window.close();\" >%s</a>   %s</font><br>",$arr["NOAGEN"],$arr["NOAGEN"],$arr["NAMAKLIEN1"]);
	}
	echo("</body></html>");
?>