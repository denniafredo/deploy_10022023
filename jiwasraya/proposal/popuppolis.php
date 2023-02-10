<?  
  include "../../includes/database.php";  
  include "../../includes/session.php";  
	$DB=new database($userid, $passwd, $DBName);
	
	if (strlen($kriteria)==0) {
	  $kriteria= "";
	} else {
	  $kriteria="and (".$kriteria." )";
	}
	echo("<form name=polis method=post action=$PHP_SELF>");
//	echo "<br><br><br>";
	echo "<font color=\"003399\"><b>DAFTAR POLIS</b></font>";
	echo "<br><br>";
		printf("<font face=Verdana size=2><a href=popuppolis.php?id=all>All</a></font>&nbsp;");
	$aray=array();
for($i=0;$i<26;$i++) {
	$aray[]=chr(65+$i);
	printf("<font face=Verdana size=2><a href=popuppolis.php?id=".$aray[$i].">".$aray[$i]."</a></font>&nbsp;");
}
	printf("<font face=Verdana size=2><a href=popuppolis.php?id=all>All</a></font>&nbsp;");
	echo "<br><br>";
			if ($id=='all'){
			    	$sql="select a.nopertanggungan,a.kdproduk,b.namaklien1,b.gelar,a.userupdated,to_char(a.tglupdated,'DD/MM/YYYY') tglupdated,to_char(b.tgllahir,'DD/MM/YYYY') tgllahir ".
	               "from $DBUser.tabel_200_pertanggungan a, $DBUser.tabel_100_klien b ".
			           "where a.kdpertanggungan='2' and a.notertanggung=b.noklien(+) ".$kriteria." ".
			           "order by 1";
			} else {
					 if ($id!=''){ 	
					 $id=$id."%";
			    	$sql="select a.nopertanggungan,a.kdproduk,b.namaklien1,b.gelar,a.userupdated,to_char(a.tglupdated,'DD/MM/YYYY') tglupdated,to_char(b.tgllahir,'DD/MM/YYYY') tgllahir ".
	               "from $DBUser.tabel_200_pertanggungan a, $DBUser.tabel_100_klien b ".
			           "where a.kdpertanggungan='2' and b.namaklien1 like '$id' and a.notertanggung=b.noklien(+) ".$kriteria." ".
			           "order by 1";					  	 
					 }
			}
					 $DB->parse($sql);
					 $DB->execute();
					 echo "<table>";
					 while($arr=$DB->nextrow()) {
					    echo("<tr>");
    			    printf("<td><font face=Verdana size=1><a href=\"#\" onclick=\"javascript:window.opener.document.propmtc01.nopertanggungan.value='%s';window.close();\">%s</a></font></td>",$arr["NOPERTANGGUNGAN"],$arr["NOPERTANGGUNGAN"]);//,$arr["NAMAKLIEN1"],$arr["TGLLAHIR"]);
					 		echo("<td bgcolor=\"#FFFFFF\"><font face=\"Verdana\" size=\"1\">".$arr["KDPRODUK"]."</font></td>");
		          echo("<td bgcolor=\"#FFFFFF\"><font face=\"Verdana\" size=\"1\">".$arr["NAMAKLIEN1"].",".$arr["GELAR"]."</font></td>");
		          echo("<td bgcolor=\"#FFFFFF\"><font face=\"Verdana\" size=\"1\">".$arr["TGLLAHIR"]."</font></td>");
		          echo("<td bgcolor=\"#FFFFFF\"><font face=\"Verdana\" size=\"1\">".$arr["USERUPDATED"]."</font></td>");
		          echo("<td bgcolor=\"#FFFFFF\"><font face=\"Verdana\" size=\"1\">".$arr["TGLUPDATED"]."</font></td>");
              echo("</tr>");
					 }				 
           echo("</table>");
	echo "<br>";
	printf("<font face=Verdana size=2><a href=popuppolis.php?id=all>All</a></font>&nbsp;");
	$aray=array();
for($i=0;$i<26;$i++) {
	$aray[]=chr(65+$i);
	printf("<font face=Verdana size=2><a href=popuppolis.php?id=".$aray[$i].">".$aray[$i]."</a></font>&nbsp;");
}
	printf("<font face=Verdana size=2><a href=popuppolis.php?id=all>All</a></font>&nbsp;");
	echo "</form>";
	echo "</body></html>";
?>