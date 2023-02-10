<?  
  include "../../includes/database.php";  
  include "../../includes/session.php";  
	include "../../includes/common.php";
	include "../../includes/month_selector.php";
	include "../../includes/komisiagen.php";
	$DB=new Database($userid, $passwd, $DBName);	
	
	echo "<link href=\"../jws.css\" rel=\"stylesheet\" type=\"text/css\">";
	echo "<a class=\"verdana10blk\"><b>INFORMASI POLIS KANTOR $kantor</b></a>";
	echo "<hr size=1>";
	?>
	<script language="JavaScript" type="text/javascript" src="../../includes/window.js"></script>
	<table>
	<form name="cariproposal" method="post" action="<? $PHP_SELF ?>">
	<tr>  
	<td class="verdana10blk">Bulan Expirasi</td>
	<td> <?=ShowFromDate(10,"Future");?></td>
	<td>
	<input type="submit" name="caripoliskantor" value="CARI">
	</td>
  </tr>
	</form>
	</table>
	<?
  echo "<hr size=1>";
	echo "<div align=center>";

	        if($month==""){
							   
	               $thnsql = "select to_char(sysdate,'MMYYYY') nowbln from dual";
		             $DB->parse($thnsql);
	               $DB->execute();
		             $x=$DB->nextrow();
		             $thisperiode=$x["NOWBLN"];
		             $year=substr($thisperiode,-4);
							   $month=substr($thisperiode,0,2);
								 $periode = "to_char(a.expirasi,'MMYYYY') = '$thisperiode'";
	        } elseif($vbln=="all"){
	               $thisperiode="$vthn";
		             $periode="to_char(a.expirasi,'yyyy')='$thisperiode'";
	        } else {
		             $bln = substr(("0".$vbln),-2);
	               //$thisperiode="$bln$vthn";
								 $thisperiode=$month.$year;
								 $periode = "to_char(a.expirasi,'MMYYYY') = '$thisperiode'";
	        }
					switch ($month)	{
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
					 
				  $sql = "select ".
    							 	 "a.prefixpertanggungan,a.nopertanggungan,a.kdproduk,a.noagen,".
    					       "a.kdstatusmedical,to_char(a.expirasi,'DD/MM/YYYY') expirasi,a.nobp3,".
    					       "to_char(a.tglsendemail,'DD/MM/YYYY') tglsendemail,b.namaklien1,b.gelar,".
    								 "a.userupdated,to_char(a.tglrekam,'DD/MM/YYYY') tglrekam,a.indexawal,".
    								 "a.premi1,a.premi2,a.juamainproduk,to_char(a.tglupdated,'DD/MM/YYYY') tglupdated,".
    								 "to_char(a.mulas,'DD/MM/YYYY') mulas,a.juamainproduk, ".
    								 "decode(a.kdvaluta,'0','RUPIAH INDEX','1','RUPIAH','DOLLAR AS') namavaluta, ".
    								 "d.namacarabayar,e.namastatusfile, ".
    								 "(select komisiagencb from $DBUser.tabel_404_temp where prefixpertanggungan=a.prefixpertanggungan ".
    								    "and nopertanggungan=a.nopertanggungan and thnkomisi='1' and ".
    								    "kdkomisiagen='01') komisiagen ".
	               "from ".
    								 "$DBUser.tabel_100_klien b,".
    								 "$DBUser.tabel_200_pertanggungan a, ".
    								 "$DBUser.tabel_500_penagih c, ".
    								 "$DBUser.tabel_305_cara_bayar d, ".
    								 "$DBUser.tabel_299_status_file e ".
			           "where ".
    								 "a.notertanggung=b.noklien(+) and a.nopenagih=c.nopenagih ".
    			           "and c.kdrayonpenagih='$kantor' and a.kdpertanggungan='2' ".
    								 "and notertanggung is not null and $periode ".
    								 "and a.kdcarabayar=d.kdcarabayar(+) ".
    								 "and e.kdstatusfile=a.kdstatusfile ".
    								 "and a.kdstatusfile='1' ".
								 "order by a.prefixpertanggungan,a.nopertanggungan";
					//echo $sql;			 
					$DB->parse($sql);
					$DB->execute();
						  echo "<font color=\"003399\" face=verdana size=2><b>Daftar Polis Expirasi Kantor ".$kantor." Bulan $bln $year</b></font><br><br>";
 	 					  echo "<table>";
					    echo("<tr class=\"hijao\" >");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>No</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>No.Pertanggn.</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Tertanggung</b></font></td>");
					    echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Produk</font></b></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>No.BP3</font></b></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Mulai</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Expirasi</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Med</font></b></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Cara Bayar</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Valuta</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>J U A</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Premi 1</font></b></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Surat Pemb. Exp.</font></b></td>");
							echo("</tr>");					 
							$i=1;
							while ($arr=$DB->nextrow()) {
							include "../../includes/belang.php";	 
              echo("<td><font face=\"Verdana\" size=\"1\">".$i."</font></td>");
						  echo("<td align=center><font face=Verdana size=1><a href=\"#\" onclick=\"window.open('../polis/polis.php?prefix=".$arr["PREFIXPERTANGGUNGAN"]."&noper=".$arr["NOPERTANGGUNGAN"]."','','width=800,height=600,top=100,left=100,scrollbars=yes');\">".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."</a></td>");
		          echo("<td nowrap><font face=\"Verdana\" size=\"1\">".$arr["NAMAKLIEN1"].",".$arr["GELAR"]."</font></td>");
					 		echo("<td><font face=\"Verdana\" size=\"1\">".$arr["KDPRODUK"]."</font></td>");
							echo("<td><font face=\"Verdana\" size=\"1\">".$arr["NOBP3"]."</font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arr["MULAS"]."</font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arr["EXPIRASI"]."</font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arr["KDSTATUSMEDICAL"]."</font></td>");
		          echo("<td><font face=\"Verdana\" size=\"1\">".$arr["NAMACARABAYAR"]."</font></td>");
		          echo("<td nowrap><font face=\"Verdana\" size=\"1\">".$arr["NAMAVALUTA"]."</font></td>");      
							echo("<td align=right><font face=\"Verdana\" size=\"1\">".number_format($arr["JUAMAINPRODUK"],2)."</font></td>");
		      		echo("<td align=right><font face=\"Verdana\" size=\"1\">".number_format($arr["PREMI1"],2)."</font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><a href=# onclick=\"NewWindow('../polis/cetak_pemb_expirasi.php?prefix=".$arr["PREFIXPERTANGGUNGAN"]."&noper=".$arr["NOPERTANGGUNGAN"]."','',900,500,1)\">Cetak</a></font></td>");
					    echo("</tr>");
							
					 $i++;
					 }				 
           echo("</table>");
					 echo "</div>";
					 echo "<br />";
					 echo "<a class=verdana10blk href=# onclick=\"NewWindow('../polis/cetak_daftar_expirasi.php?month=".$month."&year=".$year."&kdkantor=".$kdkantor."','',900,500,1)\">Cetak Daftar</a>";
					 echo "<hr size=1>";
					 echo "<a class=verdana10blk href=\"index.php\">Menu Pelaporan</a>";
?>