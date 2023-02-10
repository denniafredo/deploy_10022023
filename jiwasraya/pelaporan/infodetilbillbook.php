<?  
  include "../../includes/database.php";  
  include "../../includes/session.php";  
	include "../../includes/common.php";
	include "../../includes/komisiagen.php";
	$DB=new Database($userid, $passwd, $DBName);	
	
	echo "<link href=\"../jws.css\" rel=\"stylesheet\" type=\"text/css\">";
	echo "<title>INFORMASI BILING & BOOKING KANTOR $kantor</title>";
	echo "<div align=center>";

	        if($bln==""){
							   
	               $thnsql = "select to_char(sysdate,'MMYYYY') nowbln from dual";
		             $DB->parse($thnsql);
	               $DB->execute();
		             $x=$DB->nextrow();
		             $thisperiode=$x["NOWBLN"];
		             $vthn=substr($thisperiode,-4);
								 $thn=$vthn;
							   $bln=substr($thisperiode,0,2);
								 $periode ="to_char(a.tglbooked,'MMYYYY')='$thisperiode'";
	       } else {
		             $thisperiode="$bln$thn";
        				 $periode ="to_char(a.tglbooked,'MMYYYY')='$thisperiode'";
	        }
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
					 switch ($cb)	{
		          case "1": $cbar = "Bulanan"; break;
	            case "2": $cbar = "Kwartalan"; break;
	            case "3": $cbar = "Semesteran"; break;
		          case "4": $cbar = "Tahunan"; break;
					 }
					 
					 switch ($val)	{
		          case "0": $vl = "Rupiah Index"; break;
	            case "1": $vl = "Rupiah"; break;
	            case "3": $vl = "US Dolar"; break;
					 }
					 		 $sql ="select ".
							 					"a.prefixpertanggungan,".
                      	"a.nopertanggungan,".
												"a.tglbooked,".
                      	"b.kdvaluta,".
												"b.kdproduk,".
                      	"b.kdcarabayar,".
												"b.kdstatusmedical,".
												"to_char(b.mulas,'DD/MM/YYYY') mulas,".
												"b.expirasi,".
                      	"c.kdrayonpenagih, ".
												"(select namaklien1 from $DBUser.tabel_100_klien where noklien=b.notertanggung) namatertanggung ".
                      "from ".
                      	"$DBUser.tabel_300_historis_premi a,".
                      	"$DBUser.tabel_200_pertanggungan b,".
                      	"$DBUser.tabel_500_penagih c ".
                      "where ".
                      	"a.prefixpertanggungan=b.prefixpertanggungan and ".
                      	"a.nopertanggungan=b.nopertanggungan and ".
                      	"b.nopenagih=c.nopenagih and ".
												"c.kdrayonpenagih='$kantor' and ".
												"b.kdvaluta='$val'  and ".
												"decode(b.kdcarabayar,'1','1','M','1','2','2','Q','2','3','3','H','3','4','4','A','4') = ".
        								"'$cb' and ".
												$periode." ";
   
					//echo $sql;			 
					$DB->parse($sql);
					$DB->execute();
						  echo "<font color=\"003399\" face=verdana size=2><b>Daftar Polis Billing & Booking Kantor ".$kantor." Periode $bln $thn <br>".
									 "Valuta $vl Cara Bayar $cbar</b></font><br><br>";
 	 					  echo "<table>";
					    echo("<tr class=\"hijao\" >");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>No</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>No.Pertanggn.</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Tertanggung</b></font></td>");
					    echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Produk</font></b></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Mulas</b></font></td>");
							//echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Expirasi</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Med</font></b></td>");
							//echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Cara Bayar</b></font></td>");
							//echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Valuta</b></font></td>");
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
							include "../../includes/belang.php";	 
              echo("<td><font face=\"Verdana\" size=\"1\">".$i."</font></td>");
						  echo("<td align=center><font face=Verdana size=1><a href=\"#\" onclick=\"window.open('../polis/polis.php?prefix=".$arr["PREFIXPERTANGGUNGAN"]."&noper=".$arr["NOPERTANGGUNGAN"]."','','width=800,height=600,top=100,left=100,scrollbars=yes');\">".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."</a></td>");
		          echo("<td><font face=\"Verdana\" size=\"1\">".$arr["NAMATERTANGGUNG"]."</font></td>");
					 		echo("<td><font face=\"Verdana\" size=\"1\">".$arr["KDPRODUK"]."</font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arr["MULAS"]."</font></td>");
							//echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arr["EXPIRASI"]."</font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arr["KDSTATUSMEDICAL"]."</font></td>");
		          //echo("<td><font face=\"Verdana\" size=\"1\">".$arr["KDCARABAYAR"]."</font></td>");
		          //echo("<td><font face=\"Verdana\" size=\"1\">".$arr["KDVALUTA"]."</font></td>");      
							echo("</tr>");
							
					 $i++;
					 }				 
           echo("</table>");
					 echo "</div>";
					 echo "<hr size=1>";
					 echo "<a class=verdana10blk href=\"javascript:window.close()\">Close</a>";
?>