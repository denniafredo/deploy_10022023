<?
  include "../../includes/database.php";  
  include "../../includes/session.php";  
  echo "<head><title>Benefit Produk</title><head>";	
	$DB=new database($userid, $passwd, $DBName);
	echo "<font face=\"Verdana\" size=\"2\" color=\"#00339\"><b>BENEFIT PRODUK <br>".$kdproduk." (".$namaproduk.")</b></font><br>";
	
	   $sql = "select a.kdbenefit,b.namabenefit from $DBUser.tabel_206_produk_benefit a,". 
		        "$DBUser.tabel_207_kode_benefit b ". 
            "where a.kdproduk='$kdproduk' and a.kdbenefit=b.kdbenefit";
		 
		 $DB->parse($sql);
	   $DB->execute();
		 $i = 0;			  
		 echo "<link href=\"../jws.css\" rel=\"stylesheet\" type=\"text/css\">";
		 echo "<table>";
		 echo "<tr bgcolor=#97b3b9>";
		 echo "<td><font face=\"Verdana\" size=\"1\">No.</font></td>";
		 echo "<td><font face=\"Verdana\" size=\"1\">Kode Benefit</font></td>";
		 echo "<td><font face=\"Verdana\" size=\"1\">Nama Benefit</font></td>";
		 echo "</tr>";
		 while($arr=$DB->nextrow()) {
		 $i = 0;
		 $i = $hit + 1;
	   $kdbenefit = $arr["KDBENEFIT"];
		 $namabenefit = $arr["NAMABENEFIT"];
		 if ($i % 2==0) {
		 echo "<tr bgcolor=#e0e0e4>";
		 } else	{						
	   echo "<tr>";
		 }	
		 echo "<td><font face=\"Verdana\" size=\"1\">".$i."</font></td>";
		 echo "<td><font face=\"Verdana\" size=\"1\">".$kdbenefit."</font></td>";
		 echo "<td><font face=\"Verdana\" size=\"1\">".$namabenefit."</font></td>";
		 echo "</tr>";
		 $hit++;
		 }
		 echo "</table>";
		 echo "<hr size=\"1\">";
	   echo "<a href=\"#\" onclick=\"javascript:window.close();\"><font face=\"Verdana\" size=\"1\">CLOSE</font></a>";
	?>
