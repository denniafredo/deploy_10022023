<?  
  include "../../includes/database.php";  
  include "../../includes/session.php";  
	$prefixpertanggungan = $kantor;
	$DB=new database($userid, $passwd, $DBName);	
	?>
	<link href="../jws.css" rel="stylesheet" type="text/css">
	<script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>

	<?

	echo "<font color=\"003399\" face=verdana size=2><b>DAFTAR PROPOSAL YANG SUDAH DIEMAIL KANTOR : ".$kantor."</b></font><br>";
  echo "<hr size=1>";
	echo "<div align=center>";
	
				  $sql = "select a.prefixpertanggungan,a.nopertanggungan,a.kdproduk,".
					       "a.kdstatusmedical,a.kdstatusemail,".
					       "to_char(a.tglsendemail,'DD/MM/YYYY') tglsendemail,b.namaklien1,b.gelar,a.userupdated, ".
								 "a.premi1,a.juamainproduk,to_char(a.tglupdated,'DD/MM/YYYY') tglupdated,to_char(a.mulas,'DD/MM/YYYY') mulas ".
	               "from $DBUser.tabel_100_klien b, $DBUser.tabel_200_pertanggungan a ".
			           "where a.notertanggung=b.noklien(+) ".
			           "and prefixpertanggungan='$prefixpertanggungan' ".
								 "and a.kdpertanggungan='1' ".
								 "and a.kdstatusfile='1' ".
								 "and a.kdstatusemail is not null ".
								 "and a.notertanggung is not null ".
								 "order by prefixpertanggungan,nopertanggungan desc";
					$DB->parse($sql);
					$DB->execute();
					echo "<table width=100% class=tblisi cellpadding=0 cellspacing=0>";
					    echo("<tr class=hijao>");
							echo("<td align=center>No</td>");
							echo("<td align=center>Nomor</td>");
							echo("<td align=center>Tertanggung</td>");
					    echo("<td align=center>Produk</font></b></td>");
							echo("<td align=center>M</font></b></td>");
							echo("<td align=center>J U A</td>");
							echo("<td align=center>Mulas</td>");
							echo("<td align=center>Premi</td>");
							echo("<td align=center>Last Update</td>");
							echo("<td align=center>Tgl.Krm.Email</td>");
 							//echo("<td align=center>Update</td>");
							echo("</tr>");					 
							$i=1;
							while ($arr=$DB->nextrow()) {
							$sendemail = $arr["TGLSENDEMAIL"];
							$statusemail = $arr["KDSTATUSEMAIL"];
							$nopertanggungan = $arr["NOPERTANGGUNGAN"];
							$prefix = $arr["PREFIXPERTANGGUNGAN"];
							switch ($statusemail)
							{
							 case "": $statusemail="<font color=red>BELUM</font>"; break;
							 default : $statusemail="<font color=black>SUDAH</font>"; break; 
							}
							
							include "../../includes/belang.php";	 
							
              echo("<td><font face=\"Verdana\" size=\"1\">".$i."</font></td>");
						  echo("<td align=center><font face=Verdana size=1><a href=\"#\" onclick=\"NewWindow('../polis/polis.php?j=1&noper=$nopertanggungan&prefix=$prefix','updclnt',800,height=600,1);\">".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."</a></td>");
		          echo("<td><font face=\"Verdana\" size=\"1\">".$arr["NAMAKLIEN1"].",".$arr["GELAR"]."</font></td>");
					 		echo("<td><font face=\"Verdana\" size=\"1\">".$arr["KDPRODUK"]."</font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arr["KDSTATUSMEDICAL"]."</font></td>");
		          echo("<td align=right><font face=\"Verdana\" size=\"1\">".number_format($arr["JUAMAINPRODUK"],2)."</font></td>");
		          echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arr["MULAS"]."</font></td>");
							echo("<td align=right><font face=\"Verdana\" size=\"1\">".number_format($arr["PREMI1"],2)."</font></td>");
		          echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arr["TGLUPDATED"]."</font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\">".$sendemail."</font></td>");
							//echo("<td align=center><font face=\"Verdana\" size=\"1\"><a href=\"../proposal/ntrypropmtc.php?nopertanggungan=$nopertanggungan&prefixpertanggungan=$prefix\">UPDATE</a></font></td>");
              echo("</tr>");
							
					 $i++;
					 }				 
           echo("</table>");
					 echo "</div>";
					 echo "<hr size=1>";
					 echo "<a class=verdana10blk href=\"index.php\">Menu Pelaporan</a>";
?>
