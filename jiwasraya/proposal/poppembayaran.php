<?
 include "../../includes/database.php";
 include "../../includes/session.php";
 include "../../includes/common.php";
 //include "../../includes/pertanggungan.php";
 $DB=new Database($userid,$passwd,$DBName);
 echo "<link href=\"../jws.css\" rel=\"stylesheet\" type=\"text/css\">";
 echo "<title>Pembayaran $prefix-$nopert</title>";
 $sql = "select ".
        	 "novoucher,to_char(tglseatled,'DD/MM/YYYY') tglseatled,".
					 "nilaipembayaran,kdbatch,".
					 "decode(kdvaluta,'0','RUPIAH INDEX','1','RUPIAH','3','US DOLAR','TIDAK TAHU') namavaluta,".
        	 "kurs,biayamaterai,biayapolis,premi,".
					 "to_char(tglbayar,'DD/MM/YYYY') tglbayar,sisa ".
        "from ".
        	 "$DBUser.tabel_800_pembayaran ".
        "where ".
           "prefixpertanggungan='$prefix' and nopertanggungan='$nopert'";
 $DB->parse($sql);
 $DB->execute();

 echo "<div align=center>";
 echo "<a class=\"verdana10blk\">Historis Pembayaran</a><br><br>";
 echo "<table border=1 cellpadding=2 cellspacing=0 style=\"border-collapse: collapse\" bordercolor=\"#111111\">";
 echo "<tr bgcolor=#c1d6ff>";
 echo "<td class=\"verdana8blu\">Tgl.Bayar</td><td class=\"verdana8blu\">No.Voucher</td><td class=\"verdana8blu\">Valuta</td><td class=\"verdana8blu\">Kurs</td><td class=\"verdana8blu\">Nilai Pembayaran</td>".
 			"<td class=\"verdana8blu\">Premi</td><td class=\"verdana8blu\">Biaya Polis</td><td class=\"verdana8blu\">Biaya Materai</td><td class=\"verdana8blu\">Sisa</td>";
 echo "</tr>";

 while ($arr=$DB->nextrow()) {
 			 echo "<tr>" ;
			 echo "<td class=\"verdana8blu\">".$arr["TGLBAYAR"]."</td>";
		   echo "<td class=\"verdana8blu\" align=\"center\">".$arr["NOVOUCHER"]."</td>";
  		 echo "<td class=\"verdana8blu\" align=\"center\">".$arr["NAMAVALUTA"]."</td>";
  		 echo "<td class=\"verdana8blu\" align=\"center\">".number_format($arr["KURS"],2)."</td>" ;
			 echo "<td class=\"verdana8blu\" align=\"right\">".number_format($arr["NILAIPEMBAYARAN"],2)."</td>" ;
			 echo "<td class=\"verdana8blu\" align=\"right\">".number_format($arr["PREMI"],2)."</td>" ;
			 echo "<td class=\"verdana8blu\" align=\"right\">".number_format($arr["BIAYAPOLIS"],2)."</td>" ;
			 echo "<td class=\"verdana8blu\" align=\"right\">".number_format($arr["BIAYAMATERAI"],2)."</td>" ;
			 echo "<td class=\"verdana8blu\" align=\"right\">".number_format($arr["SISA"],2)."</td>" ;
		   echo "</tr>" ;
	 }	
 echo "</table>";
 echo "<br><a class=\"verdana8blu\" href=\"javascript:window.close()\">CLOSE</a>";
 echo "</div>";
 
?>
