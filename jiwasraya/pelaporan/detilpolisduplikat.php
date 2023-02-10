<?  
  include "../../includes/database.php";  
  include "../../includes/session.php";  
	include "../../includes/common.php";
	include "../../includes/monthselector.php";
	include "../../includes/klien.php";
	include "../../includes/pertanggungan.php";	
	$DB=new Database($userid, $passwd, $DBName);	

	if ($delete=="Delete"){
    	$sql="select prefixpertanggungan,nopertanggungan ".
    	  	 "from $DBUser.tabel_200_pertanggungan ".
    	     "where nopol='$nopolis'";
    	$DB->parse($sql);
    	$DB->execute();
    	$res = $DB->result();
    	foreach ($res as $foo => $data) {
        if (${$data["NOPERTANGGUNGAN"]} == "ON") {
    	    $nopert = $data["NOPERTANGGUNGAN"];
    	    $sql="update $DBUser.tabel_200_pertanggungan ".
							 "set kdstatusfile='7',nopenagih='0008524196' ".
     					 "where nopertanggungan='$nopert'";
					//echo $sql."<br><br>";
    	    $DB->parse($sql);
    		  $DB->execute();
    	  }
      }
    	$DB->commit();
	}
	echo "<font color=\"003399\" face=verdana size=2><b>DAFTAR POLIS DUPLIKAT</B></font><br>";
	?>
	<title>Polis Agen</title>
	<link href="../jws.css" rel="stylesheet" type="text/css">
	<script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>	
	<?
	echo "<hr size=1>";
	echo "<div align=center>";
	
				  $sql = "select a.prefixpertanggungan,a.nopertanggungan,a.kdproduk,".
					       "a.kdstatusmedical,a.nopol,b.kdrayonpenagih,".
					       "to_char(a.tglsendemail,'DD/MM/YYYY') tglsendemail,a.userupdated, ".
								 "a.premi1,a.juamainproduk,to_char(a.tglupdated,'DD/MM/YYYY') tglupdated,".
								 "to_char(a.mulas,'DD/MM/YYYY') mulas, ".
								 "(select to_char(max(tglseatled),'DD/MM/YYYY') from $DBUser.tabel_300_historis_premi where prefixpertanggungan=a.prefixpertanggungan and ".
   							 "nopertanggungan=a.nopertanggungan) lunasterakhir ".
	               "from $DBUser.tabel_200_pertanggungan a,$DBUser.tabel_500_penagih b ".
			           "where ".
			           "a.nopol='$nopolis' and ".
								 "a.kdpertanggungan='2' and ".
								 "a.kdstatusfile='1' and ".
								 "b.kdrayonpenagih='$kantor' and ".
								 "a.nopenagih=b.nopenagih";
								 //echo $sql;
								 //"and notertanggung is not null and $periode ".
								 //"order by a.prefixpertanggungan,a.nopertanggungan desc";
					$DB->parse($sql);
					$DB->execute();
					  switch ($bln)	{
		          case "01": $bln = "Januari"; break;
	            case "02": $bln = "Pebruari"; break;
	            case "03": $bln = "Maret"; break;
		          case "04": $bln = "April"; break;
		          case "05": $bln = "Mei"; break;
		          case "06": $bln = "Juni"; break;
		          case "07": $bln = "Juli"; break;
		          case "08": $bln = "Agustus"; break;
		          case "09": $bln = "September"; break;
		          case "10": $bln = "Oktober"; break;
		          case "11": $bln = "Nopember"; break;
		          case "12": $bln = "Desember"; break;
           }
					 echo "<a class=verdana10blk><b>Daftar Polis Duplikat $nopolis</b></a><br><br>";
					 echo "<form name=\"ntryclnthub\" method=\"POST\" action=\"detilpolisduplikat.php\">";
					 echo "<table>";
					    echo("<tr class=\"hijao\" >");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>No</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>No.Pertg.</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>No.Pol.Lama</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Pmg Polis</b></font></td>");
					    echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Produk</font></b></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Mulai</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Expirasi</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Stt.Med</font></b></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Cr. Bayar</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Valuta</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>J U A</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Premi 1</font></b></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Premi 2</font></b></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Rayon</font></b></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Bill Terakhir</font></b></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Lunas Terakhir</font></b></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Status</font></b></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Cek</font></b></td>");
							echo("</tr>");					 
							$i=1;
							while ($arr=$DB->nextrow()) {
								$DBX=new Database($userid, $passwd, $DBName);
									$sql="select to_char(max(tglbooked),'DD/MM/YYYY') blt from $DBUser.tabel_300_historis_premi ".
									     "where prefixpertanggungan='".$arr["PREFIXPERTANGGUNGAN"]."' and ".
											 "nopertanggungan='".$arr["NOPERTANGGUNGAN"]."'";
											 //echo $sql;
                	$DBX->parse($sql);
                	$DBX->execute();
                	$ars=$DBX->nextrow();
			            $akhirbill=$ars["BLT"];
								
								
							include "../../includes/belang.php";	 
							$PER = New Pertanggungan ($userid,$passwd,$arr["PREFIXPERTANGGUNGAN"],$arr["NOPERTANGGUNGAN"]);
              echo("<td><font face=\"Verdana\" size=\"1\">".$i."</font></td>");
						  echo("<td align=center><font face=Verdana size=1><a href=\"#\" onclick=\"window.open('../polis/polis.php?prefix=".$arr["PREFIXPERTANGGUNGAN"]."&noper=".$arr["NOPERTANGGUNGAN"]."','','width=800,height=600,top=100,left=100,scrollbars=yes');\">".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."</a></td>");
							echo("<td><font face=\"Verdana\" size=\"1\">".$arr["NOPOL"]."</font></td>");
		          echo("<td><font face=\"Verdana\" size=\"1\">".$PER->namapemegangpolis."</font></td>");
					 		echo("<td><font face=\"Verdana\" size=\"1\">".$PER->produk."</font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arr["MULAS"]."</font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\">".$PER->expirasi."</font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arr["KDSTATUSMEDICAL"]."</font></td>");
		          echo("<td><font face=\"Verdana\" size=\"1\">".$PER->namacarabayar."</font></td>");
		          echo("<td><font face=\"Verdana\" size=\"1\">".$PER->namavaluta."</font></td>");      
							echo("<td align=right><font face=\"Verdana\" size=\"1\">".number_format($PER->jua,2)."</font></td>");
		      		echo("<td align=right><font face=\"Verdana\" size=\"1\">".number_format($PER->premi1,2)."</font></td>");
							echo("<td align=right><font face=\"Verdana\" size=\"1\">".number_format($PER->premi2,2)."</font></td>");
							echo("<td><font face=\"Verdana\" size=\"1\">".$arr["KDRAYONPENAGIH"]."</font></td>");
							echo("<td><font face=\"Verdana\" size=\"1\">".$akhirbill."</font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arr["LUNASTERAKHIR"]."</font></td>");
							echo("<td><font face=\"Verdana\" size=\"1\">".$PER->namastatusfile."</font></td>");
  						echo("<td><font face=\"Verdana\" size=\"1\">");
							         if($PER->namastatusfile=="DELETE") {}
											 else {
											    echo "<input type=\"checkbox\" name=".$arr["NOPERTANGGUNGAN"]." value=\"ON\">";
									     }
							echo ("</font></td>");
              echo("</tr>");
							
					 $i++;
					 }			
					 echo "<tr>";	 
					 echo "<td colspan=18 align=right>".
					 			"<input type=\"hidden\" name=\"nopolis\" value=\"$nopolis\">".
								"<input type=\"submit\" name=\"delete\" value=\"Delete\">".
					 			"</td>";	 
					 echo "</tr>";	 
           echo("</table>");
           echo "</form>";			 
			echo "</div>";
			echo "<hr size=1>";
			//window.opener.location.replace('polisduplikat.php?kantor=$kantor';
					 ?>
					 <a class=verdana10blk href="javascript:window.close();">CLOSE</a>