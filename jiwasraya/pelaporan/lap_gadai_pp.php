<?  
  include "../../includes/database.php";  
  include "../../includes/session.php";  
	include "../../includes/common.php";
//	include "../../includes/monthselector.php";
	
	$DB=new Database($userid, $passwd, $DBName);	
	
	echo "<link href=\"../jws.css\" rel=\"stylesheet\" type=\"text/css\">";
	echo "<title>POLIS BPO</title>";
	echo "<a class=\"verdana10blk\"><b>DAFTAR POLIS BPO AGEN NOMOR $prefixagen-$noagen $namaagen</b></a>";
	echo "<hr size=1>";

	echo "<div align=center>";

				  $sql = "select a.prefixpertanggungan,a.nopertanggungan,a.kdproduk,".
					       "a.kdstatusmedical,to_char(a.expirasi,'DD/MM/YYYY') expirasi,".
					       "to_char(a.tglbpo,'DD/MM/YYYY') tglbpo,b.namaklien1,b.gelar,".
								 "a.userupdated, ".
								 "a.premi1,a.juamainproduk,to_char(a.tglupdated,'DD/MM/YYYY') tglupdated,".
								 "to_char(a.mulas,'DD/MM/YYYY') mulas,d.namacarabayar,e.kdrayonpenagih ".
	               "from $DBUser.tabel_200_pertanggungan a, $DBUser.tabel_100_klien b,".
								 "$DBUser.tabel_400_agen c,$DBUser.tabel_305_cara_bayar d,$DBUser.tabel_500_penagih e ".
			           "where a.notertanggung=b.noklien(+) and a.noagen=c.noagen ".
								 "and a.kdcarabayar=d.kdcarabayar(+) and a.nopenagih=e.nopenagih ".
			           "and c.noagen='$noagen' and a.kdpertanggungan='2' ".
								 "and notertanggung is not null and a.kdstatusfile='4' ".
								 "order by a.mulas";
					//echo $sql;			 
					$DB->parse($sql);
					$DB->execute();
						  //echo "<font color=\"003399\" face=verdana size=2><b>Daftar Polis BPO Kantor ".$kantor."</b></font><br><br>";
 	 					  echo "<table>";
					    echo("<tr bgcolor=#97b3b9 >");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>No</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>No. Pertanggungan</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Tertanggung</b></font></td>");
					    echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Produk</font></b></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Stt.Med</font></b></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Cara Bayar</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Mulai</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Expirasi</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Tgl. BPO</font></b></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Ry.Penagih</font></b></td>");
							echo("</tr>");					 
							$i=1;
							while ($arr=$DB->nextrow()) {
							$sendemail = $arr["TGLSENDEMAIL"];
							$nopertanggungan = $arr["NOPERTANGGUNGAN"];
							$prefix = $arr["PREFIXPERTANGGUNGAN"];
							switch ($sendemail)
							{
							 case "": $sendemail="<font color=red>BELUM</font>"; break;
							 default : $sendemail; break; 
							}
							
							include "../../includes/belang.php";	 
	            echo("<td><font face=\"Verdana\" size=\"1\">".$i."</font></td>");
						  echo("<td align=center><font face=Verdana size=1><a href=\"#\" onclick=\"window.open('../polis/polis.php?prefix=".$arr["PREFIXPERTANGGUNGAN"]."&noper=".$arr["NOPERTANGGUNGAN"]."','','width=800,height=600,top=100,left=100,scrollbars=yes');\">".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."</a></td>");
		          echo("<td><font face=\"Verdana\" size=\"1\">".$arr["NAMAKLIEN1"].",".$arr["GELAR"]."</font></td>");
					 		echo("<td><font face=\"Verdana\" size=\"1\">".$arr["KDPRODUK"]."</font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arr["KDSTATUSMEDICAL"]."</font></td>");
		          echo("<td><font face=\"Verdana\" size=\"1\">".$arr["NAMACARABAYAR"]."</font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arr["MULAS"]."</font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arr["EXPIRASI"]."</font></td>");
              echo("<td><font face=\"Verdana\" size=\"1\">".$arr["TGLBPO"]."</font></td>");
              echo("<td><font face=\"Verdana\" size=\"1\">".$arr["KDRAYONPENAGIH"]."</font></td>");
       
							echo("</tr>");
							
					 $i++;
					 }				 
           echo("</table>");
					 echo "</div>";
     
					 echo "<hr size=1>";
					 ?>
<table border="1" cellpadding="4" style="border-collapse: collapse" width="100%" bordercolor="#C0C0C0">
	<tr>
		<td rowspan="2" bgcolor="#CCCCCC">NO URUT</td>
		<td rowspan="2" bgcolor="#CCCCCC">NO POLIS LAMA</td>
		<td rowspan="2" bgcolor="#CCCCCC">NO POLIS JL-INDO</td>
		<td rowspan="2" bgcolor="#CCCCCC">NAMA PEMEGANG POLIS</td>
		<td rowspan="2" bgcolor="#CCCCCC">MULAI GADAI</td>
		<td colspan="2" bgcolor="#CCCCCC">SALDO AWAL BULAN</td>
		<td rowspan="2" bgcolor="#CCCCCC">TAGIHAN BUNGA BERJALAN</td>
		<td colspan="2" bgcolor="#CCCCCC">REALISASI PEMBAYARAN BULAN BERJALAN</td>
		<td rowspan="2" bgcolor="#CCCCCC">KAPITALISASI BUNGA PINJAMAN</td>
		<td colspan="2" bgcolor="#CCCCCC">SALDO AKHIR BULAN</td>
	</tr>
	<tr>
		<td bgcolor="#CCCCCC">POKOK</td>
		<td bgcolor="#CCCCCC">BUNGA</td>
		<td bgcolor="#CCCCCC">POKOK</td>
		<td bgcolor="#CCCCCC">BUNGA</td>
		<td bgcolor="#CCCCCC">POKOK</td>
		<td bgcolor="#CCCCCC">BUNGA</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
</table>

