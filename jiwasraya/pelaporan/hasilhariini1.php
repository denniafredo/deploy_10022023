<? 
  include "../../includes/database.php"; 
  include "../../includes/session.php"; 
	include "../../includes/common.php";
  $DB=new Database($userid, $passwd, $DBName);
?>	

<html>
<head>
<title>Untitled</title>
</head>
<link href="../jws.css" rel="stylesheet" type="text/css">
<body>
<div align="center">
<h1><font color=red>s a b a r booo ...</font></h1>
<h2>This site is coming su'un</h2>
<br><br>
</div> 
<?
  $sql = "select to_char(sysdate,'DD/MM/YYYY') hariini from dual";
			 	 $DB->parse($sql);
				 $DB->execute();
				 $ars=$DB->nextrow();
				 $hariini = $ars["HARIINI"];
	echo "Konversi Polis tanggal ".$hariini;
	$sql = "select ".
	           "a.prefixpertanggungan,a.nopertanggungan,".
						 "(select namaklien1 from $DBUser.tabel_100_klien where noklien=a.notertanggung) namatertanggung,".
	       		 "decode(a.kdvaluta,'0','RpI','1','Rp','US$') notasi,a.premi1,".
				 		 "to_char(a.tglkonversi,'HH24:MI:SS') jamkonversi,a.userkonversi ".
				 "from ".
				     "$DBUser.tabel_200_pertanggungan a ".
				 "where ".
				     "trunc(a.tglkonversi)=trunc(sysdate) and ".
						 "a.prefixpertanggungan='$kantor' ".
				 "order by jamkonversi";
	$DB->parse($sql);
	$DB->execute();
  echo "<table>"; 
		 echo "<tr>"; 
		 echo "<td class=verdana8blk>NO.</td>";
	   echo "<td class=verdana8blk>NO. PERTANGGUNGAN</td>";
		 echo "<td class=verdana8blk>TERTANGGUNG</td>";
		 echo "<td class=verdana8blk>VALUTA</td>";
		 echo "<td class=verdana8blk>PREMI</td>";
		 echo "<td class=verdana8blk>WAKTU KONVERSI</td>";
		 echo "<td class=verdana8blk>USER KONVERSI</td>";
		 echo "</tr>";
	$i=1;
	while ($arr=$DB->nextrow()) {
	   include "../../includes/belang.php";	
	   //echo "<tr>"; 
		 echo "<td class=verdana8blk>".$i."</td>";
	   echo "<td class=verdana8blk>".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."</td>";
		 echo "<td class=verdana8blk>".$arr["NAMATERTANGGUNG"]."</td>";
		 echo "<td class=verdana8blk>".$arr["NOTASI"]."</td>";
		 echo "<td class=verdana8blk>".$arr["PREMI1"]."</td>";
		 echo "<td class=verdana8blk>".$arr["JAMKONVERSI"]."</td>";
		 echo "<td class=verdana8blk>".$arr["USERKONVERSI"]."</td>";
		 echo "</tr>";
		 $i++;
	}
	echo "</table>";
?>
<br><br>

<a href="index.php">Back</a>

</body>
</html>
