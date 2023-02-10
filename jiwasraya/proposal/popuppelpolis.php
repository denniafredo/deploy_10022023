<?  
  include "../../includes/database.php";  
  include "../../includes/session.php";  
	$DB=new database($userid, $passwd, $DBName);
  $prefixpertanggungan = $kantor;
?>
<html>
<head>
<title>List Polis</title>
<link href="../jws.css" rel="stylesheet" type="text/css">
</head>
<body>
<div align=center>
<?	
	echo("<form name=polis method=post action=$PHP_SELF>");
	echo "<font color=\"003399\"><b>DAFTAR POLIS RAYON PENAGIHAN ".$prefixpertanggungan."</b></font><br>";
	printf("<font face=Verdana size=2><a href=popuppelpolis.php?id=all>All</a></font>&nbsp;");
	$aray=array();
for($i=0;$i<26;$i++) {
	$aray[]=chr(65+$i);
	printf("<font face=Verdana size=2><a href=popuppelpolis.php?id=".$aray[$i].">".$aray[$i]."</a></font>&nbsp;");
}
	printf("<font face=Verdana size=2><a href=popuppelpolis.php?id=all>All</a></font>&nbsp;");
  echo "<table>";
	 				 print( "<tr bgcolor=#97b3b9>\n" );
					 print( "<td class=arial10bold align=center>No.</td>\n" );
  				 print( "<td class=arial10bold align=center>Nomor</td>\n" );
					 print( "<td class=arial10bold align=center>Tertanggung</td>\n" );
					 print( "<td class=arial10bold align=center>Produk</td>\n" );
					 print( "<td class=arial10bold align=center>Valuta</td>\n" );
					 print( "<td class=arial10bold align=center>JUA</td>\n" );
					 print( "<td class=arial10bold align=center>Premi1</td>\n" );
					 print( "<td class=arial10bold align=center>Medical</td>\n" );
					 print( "<td class=arial10bold align=center>Carabayar</td>\n" );
  				 print( "</tr>" );
			if ($id=='all'){
				$sql = "select a.prefixpertanggungan,a.nopertanggungan,b.kdrayonpenagih,c.namaklien1,d.namaklien1 tertanggung,b.nopenagih ".
				       "from $DBUser.tabel_200_pertanggungan a, $DBUser.tabel_500_penagih b, $DBUser.tabel_100_klien c, $DBUser.tabel_100_klien d ".
			         "where b.kdrayonpenagih='$kantor' and a.kdpertanggungan='2' ".
				       "and c.noklien=b.nopenagih and a.nopenagih=b.nopenagih and a.notertanggung=d.noklien order by a.nopertanggungan";
        echo $sql;
				$DB->parse($sql);
	      $DB->execute();
				while($arr=$DB->nextrow()) {
	           $nopertanggungan = $arr["NOPERTANGGUNGAN"];
		         $prefixpertanggungan = $arr["PREFIXPERTANGGUNGAN"];
	      $i=0;
		    $i = $count + 1;
	  		include "../../includes/belang.php";
				  $DA=new database($userid, $passwd, $DBName);
					$sqla="select a.prefixpertanggungan,a.nopertanggungan,a.kdproduk,b.namaklien1,decode(a.kdvaluta,'0','INDEX','1','RUPIAH','USD') valuta, ".
						     "a.juamainproduk,a.premi1,c.namacarabayar,a.kdstatusmedical ".
	               "from $DBUser.tabel_200_pertanggungan a, $DBUser.tabel_100_klien b,$DBUser.tabel_305_cara_bayar c,".
								 "$DBUser.tabel_500_penagih e ".
							   "where e.kdrayonpenagih='$kantor' and a.nopenagih=e.nopenagih and ".
								 "a.prefixpertanggungan=e.kdrayonpenagih and a.kdpertanggungan='2' ".
								 "and a.notertanggung=b.noklien(+) and a.kdcarabayar=c.kdcarabayar ".
			           "and a.nopertanggungan='$nopertanggungan'";// order by 1";
					 $DA->parse($sqla);
				   $DA->execute();
				   $ars=$DA->nextrow();	
					 		echo("<td class=arial10ungu>".$i."</font></td>");
						  printf("<td><font face=Verdana size=1>".$prefixpertanggungan."-<a href=\"#\" onclick=\"javascript:window.opener.document.peliharapolis.nopertanggungan.value='%s';window.close();\">%s</a></font></td>",$arr["NOPERTANGGUNGAN"],$arr["NOPERTANGGUNGAN"]);//,$arr["NAMAKLIEN1"],$arr["TGLLAHIR"]);
					 		echo("<td class=arial10ungu>".$ars["NAMAKLIEN1"]."</font></td>");
		          echo("<td class=arial10ungu>".$ars["KDPRODUK"]."</font></td>");
		          echo("<td class=arial10ungu>".$ars["VALUTA"]."</font></td>");
		          echo("<td class=arial10ungu align=right>".number_format($ars["JUAMAINPRODUK"],2)."</font></td>");
		          echo("<td class=arial10ungu align=right>".number_format($ars["PREMI1"],2)."</font></td>");
							echo("<td class=arial10ungu align=center>".$ars["KDSTATUSMEDICAL"]."</font></td>");
              echo("<td class=arial10ungu>".$ars["NAMACARABAYAR"]."</font></td>");
		          echo("</tr>");
							$count++;
			  }
			} else {
					 if ($id!=''){ 	
					 $id=$id."%";
				$sql = "select a.prefixpertanggungan,a.nopertanggungan,b.kdrayonpenagih,c.namaklien1,d.namaklien1 tertanggung,b.nopenagih ".
				       "from $DBUser.tabel_200_pertanggungan a, $DBUser.tabel_500_penagih b, $DBUser.tabel_100_klien c, $DBUser.tabel_100_klien d ".
			         "where b.kdrayonpenagih='$kantor' and a.kdpertanggungan='2' and b.kdrayonpenagih='$kantor' ".
				       "and d.namaklien1 like '$id' and c.noklien=b.nopenagih and a.nopenagih=b.nopenagih and a.notertanggung=d.noklien order by a.nopertanggungan";
        $DB->parse($sql);
	      $DB->execute();
				while($arr=$DB->nextrow()) {
	           $nopertanggungan = $arr["NOPERTANGGUNGAN"];
		         $prefixpertanggungan = $arr["PREFIXPERTANGGUNGAN"];
	      $i=0;
		    $i = $count + 1;
	  		include "../../includes/belang.php";
				  $DA=new database($userid, $passwd, $DBName);
					$sqla="select a.prefixpertanggungan,a.nopertanggungan,a.kdproduk,b.namaklien1,decode(a.kdvaluta,'0','INDEX','1','RUPIAH','USD') valuta, ".
						     "a.juamainproduk,a.premi1,c.namacarabayar,a.kdstatusmedical ".
	               "from $DBUser.tabel_200_pertanggungan a, $DBUser.tabel_100_klien b,$DBUser.tabel_305_cara_bayar c,".
								 "$DBUser.tabel_500_penagih e ".
							   "where e.kdrayonpenagih='$kantor' and a.nopenagih=e.nopenagih and ".
								 "a.prefixpertanggungan='$prefixpertanggungan' and a.kdpertanggungan='2' ".
								 "and b.namaklien1 like '$id' and a.notertanggung=b.noklien(+) and a.kdcarabayar=c.kdcarabayar ".
			           "and a.nopertanggungan='$nopertanggungan'";// order by 1";
					 $DA->parse($sqla);
				   $DA->execute();
				   $ars=$DA->nextrow();	
					 		echo("<td class=arial10ungu>".$i."</font></td>");
						  printf("<td><font face=Verdana size=1>".$prefixpertanggungan."-<a href=\"#\" onclick=\"javascript:window.opener.document.peliharapolis.nopertanggungan.value='%s';window.close();\">%s</a></font></td>",$arr["NOPERTANGGUNGAN"],$arr["NOPERTANGGUNGAN"]);//,$arr["NAMAKLIEN1"],$arr["TGLLAHIR"]);
					 		echo("<td class=arial10ungu>".$ars["NAMAKLIEN1"]."</font></td>");
		          echo("<td class=arial10ungu>".$ars["KDPRODUK"]."</font></td>");
		          echo("<td class=arial10ungu>".$ars["VALUTA"]."</font></td>");
		          echo("<td class=arial10ungu align=right>".number_format($ars["JUAMAINPRODUK"],2)."</font></td>");
		          echo("<td class=arial10ungu align=right>".number_format($ars["PREMI1"],2)."</font></td>");
							echo("<td class=arial10ungu align=center>".$ars["KDSTATUSMEDICAL"]."</font></td>");
              echo("<td class=arial10ungu>".$ars["NAMACARABAYAR"]."</font></td>");
		          echo("</tr>");
							$count++;
					 }
			}
					 }				 
           echo("</table>");
	echo "<br>";
	printf("<font face=Verdana size=2><a href=popuppelpolis.php?id=all>All</a></font>&nbsp;");
	$aray=array();
for($i=0;$i<26;$i++) {
	$aray[]=chr(65+$i);
	printf("<font face=Verdana size=2><a href=popuppelpolis.php?id=".$aray[$i].">".$aray[$i]."</a></font>&nbsp;");
}
	printf("<font face=Verdana size=2><a href=popuppelpolis.php?id=all>All</a></font>&nbsp;");
	echo "</form>";
	echo "</div></body></html>";
?>
