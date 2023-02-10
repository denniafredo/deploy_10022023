<?  
  include "../../includes/database.php";  
  include "../../includes/session.php";  
	include "../../includes/common.php";
	include "../../includes/komisiagen.php";
	$DB=new Database($userid, $passwd, $DBName);	
	$DX=new Database($userid, $passwd, $DBName);	
	
	echo "<link href=\"../jws.css\" rel=\"stylesheet\" type=\"text/css\">";
	echo "<title>INFORMASI PELUNASAN PREMI KANTOR $kantor</title>";
	echo "<div align=center>";
					
					if($jnscari=="BL"){
					   $carilunas ="to_char(a.tglbooked,'MMYYYY')='$blnsearch' and ";
					} else {
					   $carilunas ="to_char(a.tglbooked,'YYYY')='$blnsearch' and ";
					}
					$thn=substr($blnsearch,-4);
					$bln=substr($blnsearch,0,2);
							
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

					if($lunas==1){
					    $ceklunas= "a.tglseatled is not null ";
							$pelunasan= "Lunas Premi";
					} else {
					    $ceklunas= "a.tglseatled is null ";
							$pelunasan= "Belum Lunas Premi";
					}
					 		 $sql ="select ".
							 					"a.prefixpertanggungan,".
                      	"a.nopertanggungan,".
												"a.tglbooked,".
                      	"decode(b.kdvaluta,'0','RUPIAH INDEX','1','RUPIAH','3','US DOLAR','TIDAK TAHU') namavaluta,".
												"b.premi1,b.premi2,".
												"b.kdproduk,".
                      	"b.kdcarabayar,".
												"b.kdstatusmedical,".
												"to_char(b.mulas,'DD/MM/YYYY') mulas,".
												"b.expirasi,".
            						"(select to_char(max(tglseatled),'DD/MM/YYYY') from $DBUser.tabel_300_historis_premi where prefixpertanggungan=a.prefixpertanggungan and nopertanggungan=a.nopertanggungan) maxseatled,".
												"(select namacarabayar from $DBUser.tabel_305_cara_bayar where kdcarabayar=b.kdcarabayar) namacarabayar,".
												"(select namaklien1 from $DBUser.tabel_100_klien where noklien=b.notertanggung) namatertanggung ".
                      "from ".
                      	"$DBUser.tabel_300_historis_premi a,".
                      	"$DBUser.tabel_200_pertanggungan b ".
                      "where ".
                      	"a.prefixpertanggungan=b.prefixpertanggungan and ".
                      	"a.nopertanggungan=b.nopertanggungan and ".
            						"b.kdstatusfile='1' and ".
              					"b.kdpertanggungan='2' and ".
												"b.nopenagih='$nopenagih' and ".
												"$carilunas ".
												"a.tglbooked is not null and ".
              					"$ceklunas";
   
					    //echo $sql;			 
					 		$DB->parse($sql);
							$DB->execute();
						
						  echo "<font color=\"003399\" face=verdana size=2><b>Daftar Polis $pelunasan Kantor ".$kantor." Bulan $bln $thn <br>".
									 "</b></font><br><br>";
 	 					  echo "<table>";
					    echo("<tr class=\"hijao\" >");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>No</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>No.Pertanggn.</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Tertanggung</b></font></td>");
					    echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Produk</font></b></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Mulas</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Med</font></b></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Cara Bayar</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Valuta</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Premi1</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Premi2</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Booked Terakhir</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Seatled Terakhir</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Tgl.Bayar</b></font></td>");
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
							$KAG=new KomisiAgen($userid,$passwd,$arr["PREFIXPERTANGGUNGAN"],$arr["NOPERTANGGUNGAN"]);
							
							$sqx="select to_char(max(tglbooked),'DD/MM/YYYY') tglbooked,to_char(max(tglbayar),'DD/MM/YYYY') tglbayar ".
							     "from $DBUser.tabel_300_historis_premi where ".
									 "prefixpertanggungan='".$arr["PREFIXPERTANGGUNGAN"]."' and nopertanggungan='".$arr["NOPERTANGGUNGAN"]."' and tglseatled in ".
									 "(select max(tglseatled) from $DBUser.tabel_300_historis_premi where ".
									 "prefixpertanggungan='".$arr["PREFIXPERTANGGUNGAN"]."' and nopertanggungan='".$arr["NOPERTANGGUNGAN"]."') ";
							$DX->parse($sqx);
					    $DX->execute();	
							$arx=$DX->nextrow(); 												
							
							include "../../includes/belang.php";	 
              echo("<td><font face=\"Verdana\" size=\"1\">".$i."</font></td>");
						  echo("<td align=center><font face=Verdana size=1><a href=\"#\" onclick=\"window.open('../polis/polis.php?prefix=".$arr["PREFIXPERTANGGUNGAN"]."&noper=".$arr["NOPERTANGGUNGAN"]."','','width=800,height=600,top=100,left=100,scrollbars=yes');\">".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."</a></td>");
		          echo("<td><font face=\"Verdana\" size=\"1\">".$arr["NAMATERTANGGUNG"]."</font></td>");
					 		echo("<td><font face=\"Verdana\" size=\"1\">".$arr["KDPRODUK"]."</font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arr["MULAS"]."</font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arr["KDSTATUSMEDICAL"]."</font></td>");
		          echo("<td><font face=\"Verdana\" size=\"1\">".$arr["NAMACARABAYAR"]."</font></td>");
		          echo("<td><font face=\"Verdana\" size=\"1\">".$arr["NAMAVALUTA"]."</font></td>");
		          echo("<td align=right><font face=\"Verdana\" size=\"1\">".number_format($arr["PREMI1"],2)."</font></td>");
		          echo("<td align=right><font face=\"Verdana\" size=\"1\">".number_format($arr["PREMI2"],2)."</font></td>");
		          echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arx["TGLBOOKED"]."</font></td>");      
							echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arr["MAXSEATLED"]."</font></td>");      
							echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arx["TGLBAYAR"]."</font></td>");      
							echo("</tr>");
							
					 $i++;
					 }				 
           echo("</table>");
					 echo "</div>";
					 echo "<hr size=1>";
					 echo "<a class=verdana10blk href=\"javascript:window.close()\">Close</a>";
?>