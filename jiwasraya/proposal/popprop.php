<?  
  include "../../includes/database.php";  
  include "../../includes/session.php";  
	$prefixpertanggungan = $kantor;
	$DB=new database($userid, $passwd, $DBName);	
	if (strlen($kriteria)==0) {
	  $kriteria= "";
	} else {
	  $kriteria="and (".$kriteria." )";
	}
  print( "<html><head>\n" );
  print( "</head><body><div align=center>" );
	echo "<table width=\"100%\">";
  echo "<tr><td align=\"right\"><font face=\"Verdana\" size=\"2\" color=\"#0033CC\">F1401</font></td></tr>";
  echo "</table>";
	echo "<font color=\"003399\"><b>DAFTAR PROPOSAL</b></font><br>";
	echo "<font face=Verdana size=1><b>Kantor : ".$kantor."</b></font>";
	echo("<form method=post action=$PHP_SELF>");
	printf("<font face=Verdana size=2><a href=popprop.php?id=all>All</a></font>&nbsp;");
	$aray=array();
	for($i=0;$i<26;$i++) {
		$aray[]=chr(65+$i);
		printf("<font face=Verdana size=2><a href=popprop.php?id=".$aray[$i].">".$aray[$i]."</a></font>&nbsp;");
	}
	printf("<font face=Verdana size=2><a href=popprop.php?id=all>All</a></font>&nbsp;");
	echo "<br><br>";
			if ($id=='all'){
			    	$sql="select a.nopertanggungan,a.kdproduk,b.namaklien1,b.gelar,a.userupdated, ".
								 "a.premi1,a.juamainproduk,to_char(a.tglupdated,'DD/MM/YYYY') tglupdated,to_char(a.mulas,'DD/MM/YYYY') mulas ".
	               "from $DBUser.tabel_200_pertanggungan a, $DBUser.tabel_100_klien b ".
			           "where a.notertanggung=b.noklien(+) ".$kriteria." ".
			           "and prefixpertanggungan='$prefixpertanggungan' and a.kdpertanggungan='1' order by nopertanggungan desc";
			} else {
					 if ($id!=''){ 	
					 $id=$id."%";
				  	$sql="select a.nopertanggungan,a.kdproduk,b.namaklien1,b.gelar,a.userupdated, ".
								 "a.premi1,a.juamainproduk,to_char(a.tglupdated,'DD/MM/YYYY') tglupdated,to_char(a.mulas,'DD/MM/YYYY') mulas ".
	               "from $DBUser.tabel_200_pertanggungan a, $DBUser.tabel_100_klien b ".
			           "where b.namaklien1 like '$id' and a.notertanggung=b.noklien(+) ".$kriteria." ".
			           "and prefixpertanggungan='$prefixpertanggungan' and a.kdpertanggungan='1' order by nopertanggungan desc";					  	 
					 }
			}
					 $DB->parse($sql);
					 $DB->execute();
					 echo "<table>";
//					 $i=1;
					    echo("<tr bgcolor=#97b3b9 ><td><font face=\"Verdana\" size=\"1\"><b>Nomor</b></font></td>");
					    echo("<td><font face=\"Verdana\" size=\"1\"><b>Produk</font></b></td>");
							echo("<td><font face=\"Verdana\" size=\"1\"><b>Tertanggung</b></font></td>");
							echo("<td><font face=\"Verdana\" size=\"1\"><b>J U A</b></font></td>");
							echo("<td><font face=\"Verdana\" size=\"1\"><b>Mulai Ass</b></font></td>");
							echo("<td><font face=\"Verdana\" size=\"1\"><b>Premi</font></b></td>");
							echo("<td><font face=\"Verdana\" size=\"1\"><b>Last Update</font></b></td></tr>");
 							echo("</tr>");					 
							$i=1;
							while ($arr=$DB->nextrow()) {
								include "../../includes/belang.php";	 
/*					 while($arr=$DB->nextrow()) {
					 	if ($i%2){
	      		  print( "<tr>" );
				    } else {
				      print( "<tr bgcolor=#e0e0e4>" );
				    }	*/
						printf("<td><font face=Verdana size=1><a href=\"#\" onclick=\"javascript:".
						       "window.opener.document.batal.nopertanggungan.value='%s';".
						       "window.opener.document.batal.namatertanggung.value='%s';".
									 "window.close();\">%s</a></font></td>",$arr["NOPERTANGGUNGAN"],$arr["NAMAKLIEN1"],$arr["NOPERTANGGUNGAN"],$arr["NAMAKLIEN1"]);
					 		echo("<td><font face=\"Verdana\" size=\"1\">".$arr["KDPRODUK"]."</font></td>");
		          echo("<td><font face=\"Verdana\" size=\"1\">".$arr["NAMAKLIEN1"].",".$arr["GELAR"]."</font></td>");
		          echo("<td align=right><font face=\"Verdana\" size=\"1\">".$arr["JUAMAINPRODUK"]."</font></td>");
		          echo("<td><font face=\"Verdana\" size=\"1\">".$arr["MULAS"]."</font></td>");
							echo("<td align=right><font face=\"Verdana\" size=\"1\">".$arr["PREMI1"]."</font></td>");
		          echo("<td><font face=\"Verdana\" size=\"1\">".$arr["TGLUPDATED"]."</font></td>");
              echo("</tr>");
					 $i++;
					 }				 
           echo("</table>");
	echo "<br>";
	printf("<font face=Verdana size=2><a href=popprop.php?id=all>All</a></font>&nbsp;");
	$aray=array();
	for($i=0;$i<26;$i++) {
	$aray[]=chr(65+$i);
	printf("<font face=Verdana size=2><a href=popprop.php?id=".$aray[$i].">".$aray[$i]."</a></font>&nbsp;");
	}
	printf("<font face=Verdana size=2><a href=popprop.php?id=all>All</a></font>&nbsp;");
	echo("</form></div></body></html>");
?>