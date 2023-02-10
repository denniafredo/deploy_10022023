<?  
  include "../../includes/database.php";  
  include "../../includes/session.php";  
	include "../../includes/monthselector.php";
	include "../../includes/klien.php";
	include "../../includes/pertanggungan.php";	
	
	$DB=new database($userid, $passwd, $DBName);	

	echo "<font color=\"003399\" face=verdana size=2><b>DAFTAR POLIS KLIEN</B></font><br>";
  echo "<hr size=1>";
	?>
	<link href="../jws.css" rel="stylesheet" type="text/css">
	<script language="JavaScript" type="text/javascript" src="../../includes/highlight.js" ></script>
	<script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>	
	<script language="JavaScript" type="text/javascript">
  <!--
 	
	function CariNama() {
	var noklien=document.clntmtc.noklien.value;
	if (!noklien=='') {
		window.open('../klien/carinama.php?namahalaman=clntmtc&noklien='+noklien+'','caripage','width=400,height=300,top=100,left=100,scrollbars=yes')
	}
}
</script>
<script language="JavaScript" type="text/javascript" src="../../includes/validasi.js"></script>
	

	<?
	echo "<hr size=1>";
	echo "<div align=center>";
	
				 $sql  = "select ".
				 			 	 		"a.prefixpertanggungan,a.nopertanggungan,a.kdproduk,".
					       		"a.kdstatusmedical,".
					       		"to_char(a.tglsendemail,'DD/MM/YYYY') tglsendemail,a.userupdated, ".
								 		"a.premi1,a.juamainproduk,to_char(a.tglupdated,'DD/MM/YYYY') tglupdated,to_char(a.mulas,'DD/MM/YYYY') mulas ".
	               "from  ".
								 	  "$DBUser.tabel_200_pertanggungan a ".
			           "where ".
    			   				"a.notertanggung='$noklien' ".
      							"and a.kdpertanggungan='2' ".
								 "order by a.prefixpertanggungan,a.nopertanggungan desc";
 
	//echo $sql;
					$DB->parse($sql);
					$DB->execute();

					 echo "<table>";
					    echo("<tr class=\"hijao\">");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>No</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>No. Pertanggungan</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Pemegang Polis</b></font></td>");
					    echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Produk</font></b></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Mulai</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Expirasi</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Stt.Med</font></b></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Cara Bayar</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Valuta</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>J U A</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Premi 1</font></b></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Premi 2</font></b></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Status</font></b></td>");
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
							$PER = New Pertanggungan ($userid,$passwd,$arr["PREFIXPERTANGGUNGAN"],$arr["NOPERTANGGUNGAN"]);
              echo("<td><font face=\"Verdana\" size=\"1\">".$i."</font></td>");
						  echo("<td align=center><font face=Verdana size=1><a href=\"#\" onclick=\"window.open('../polis/polis.php?prefix=".$arr["PREFIXPERTANGGUNGAN"]."&noper=".$arr["NOPERTANGGUNGAN"]."','','width=800,height=600,top=100,left=100,scrollbars=yes');\">".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."</a></td>");
		          echo("<td><font face=\"Verdana\" size=\"1\">".$PER->namapemegangpolis."</font></td>");
					 		echo("<td><font face=\"Verdana\" size=\"1\">".$PER->namaproduk."</font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arr["MULAS"]."</font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\">".$PER->expirasi."</font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arr["KDSTATUSMEDICAL"]."</font></td>");
		          echo("<td><font face=\"Verdana\" size=\"1\">".$PER->namacarabayar."</font></td>");
		          echo("<td><font face=\"Verdana\" size=\"1\">".$PER->namavaluta."</font></td>");      
							echo("<td align=right><font face=\"Verdana\" size=\"1\">".number_format($PER->jua,2)."</font></td>");
		      		echo("<td align=right><font face=\"Verdana\" size=\"1\">".number_format($PER->premi1,2)."</font></td>");
							echo("<td align=right><font face=\"Verdana\" size=\"1\">".number_format($PER->premi2,2)."</font></td>");
							echo("<td><font face=\"Verdana\" size=\"1\">".$PER->namastatusfile."</font></td>");
              echo("</tr>");
							
					 $i++;
					 }				 
           echo("</table>");

?>