<?  
  include "../../includes/database.php";
  include "../../includes/session.php";
  echo("<title>Daftar Klien</title>");
	echo("<html><body topmargin=\"0\">");
	echo "<table width=\"100%\">";
  echo "<tr><td align=\"right\"><font face=\"Verdana\" size=\"2\" color=\"#0033CC\">F1413</font></td></tr>";
  echo "</table>";
/*	echo("<form method=\"POST\" action=PHP_SELF>");
	echo("<font face=\"Verdana\" size=\"2\" color=\"#00339\"><b>Query Klien</b></font><br>");
	echo("<input type=text name=noklien size=25><input type=submit name=submit value=Cari><br></form>");
*/	
	echo("<font face=\"Verdana\" size=\"2\" color=\"#00339\"><b>Daftar Klien</b></font><br>");
	echo("<hr size=1>");
/*	
	if (strlen($notertanggung)==0) 
	  $sql="select a.noklien noklieninsurable,a.namaklien1 ".
	     "from $DBUser.tabel_100_klien a ".
			 "order by 1";
	else */
    $sql="select a.noklieninsurable,b.namaklien1,a.kdhubungan ".
	       "from $DBUser.tabel_113_insurable a,$DBUser.tabel_100_klien b ".
	       "where a.noklieninsurable=b.noklien and notertanggung like '$notertanggung' ".
			   "order by 1";
//	end if
	$DB=New database($userid, $passwd, $DBName);
	$DB->parse($sql);
	$DB->execute();
	while($arr=$DB->nextrow()) {
    printf("<font face=\"Verdana\" size=\"1\"><a href=\"#\" onclick=\"javascript:window.opener.document.propmtc11.%s.value='%s';window.close();\" >%s</a>   %s      </font><br>",$item,$arr["NOKLIENINSURABLE"],$arr["NOKLIENINSURABLE"],$arr["NAMAKLIEN1"]);
	}
	echo("</body></html>");
?>