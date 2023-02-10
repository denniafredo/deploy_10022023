<?  
  include "../../includes/database.php";  
  include "../../includes/session.php";  
	include "../../includes/common.php";
	include "../../includes/monthselector.php";
	include "../../includes/komisiagen.php";
	$DB=new Database($userid, $passwd, $DBName);	
	
	echo "<link href=\"../jws.css\" rel=\"stylesheet\" type=\"text/css\">";
	echo "<a class=\"verdana10blk\"><b>INFORMASI POLIS SELURUH KANTOR</b></a>";
	echo "<hr size=1>";
	?>
	<table>
	<form name="cariproposal" method="post" action="<? $PHP_SELF ?>">
	<tr>  
	<td class="verdana10blk">Periode (Mulai Asuransi)</td>
	<td> <?  DateSelector("v"); ?>	</td>
	<td>
	<input type="submit" name="caripoliskantor" value="CARI">
	</td>
  </tr>
	</form>
	</table>
	<?
if ($caripoliskantor){
  echo "<hr size=1>";
	echo "<div align=center>";

	        if($vbln==""){
							   
	               $thnsql = "select to_char(sysdate,'MMYYYY') nowbln from dual";
		             $DB->parse($thnsql);
	               $DB->execute();
		             $x=$DB->nextrow();
		             $thisperiode=$x["NOWBLN"];
		             $vthn=substr($thisperiode,-4);
							   $bln=substr($thisperiode,0,2);
								 //$periode="to_char(a.mulas,'mmyyyy')='$thisperiode'";
								 //$periode = "a.mulas = to_date('$thisperiode','MMYYYY')";
								 $periode = "to_char(a.mulas,'MMYYYY') = '$thisperiode'";
	        } elseif($vbln=="all"){
	               $thisperiode="$vthn";
		             $periode="to_char(a.mulas,'yyyy')='$thisperiode'";
								 //$periode = "a.mulas = to_date('$thisperiode','YYYY')";
	        } else {
		             $bln = substr(("0".$vbln),-2);
	               $thisperiode="$bln$vthn";
		             //$periode="to_char(a.mulas,'mmyyyy')='$thisperiode'";
          			 //$periode = "a.mulas = to_date('$thisperiode','MMYYYY')";
								 $periode = "to_char(a.mulas,'MMYYYY') = '$thisperiode'";
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
					 
				  $sql = "select a.prefixpertanggungan,a.nopertanggungan,a.kdproduk,a.noagen,(select namaklien1 from $DBUser.tabel_100_klien where noklien=a.noagen) namaagen,".
					       "a.kdstatusmedical,to_char(a.expirasi,'DD/MM/YYYY') expirasi,a.nobp3,".
					       "to_char(a.tglsendemail,'DD/MM/YYYY') tglsendemail,b.namaklien1,b.gelar,".
					       "f.noklien nopempol, f.namaklien1 namapempol,to_char(f.tgllahir,'DD/MM/YYYY') tgllahirpempol,f.kdid,f.noid,f.alamattetap01,".
								 "a.userupdated,to_char(a.tglrekam,'DD/MM/YYYY') tglrekam,a.indexawal,".
								 "a.premi1,a.premi2,a.juamainproduk,to_char(a.tglupdated,'DD/MM/YYYY') tglupdated,".
								 "to_char(a.mulas,'DD/MM/YYYY') mulas,a.juamainproduk, ".
								 "to_char(a.tglkonversi,'DD/MM/YYYY HH:MI:SS') tglkonversi, to_char(a.tglcetak,'DD/MM/YYYY HH:MI:SS') tglcetak, ".
								 "decode(a.kdvaluta,'0','RUPIAH INDEX','1','RUPIAH','DOLLAR AS') namavaluta, ".
								 "d.namacarabayar,e.namastatusfile, ".
								 "(select komisiagencb from $DBUser.tabel_404_temp where prefixpertanggungan=a.prefixpertanggungan ".
								    "and nopertanggungan=a.nopertanggungan and thnkomisi='1' and ".
								    "kdkomisiagen='01') komisiagen ".
	               "from ".
								 "$DBUser.tabel_100_klien b,".
								 "$DBUser.tabel_100_klien f,".
								 "$DBUser.tabel_200_pertanggungan a, ".
								 "$DBUser.tabel_500_penagih c, ".
								 "$DBUser.tabel_305_cara_bayar d, ".
								 "$DBUser.tabel_299_status_file e ".
			           "where a.notertanggung=b.noklien(+) and a.nopemegangpolis=f.noklien(+) and a.nopenagih=c.nopenagih ".
//			           "and c.kdrayonpenagih='$kantor' and a.kdpertanggungan='2' ".
			           "and a.kdpertanggungan='2' ".
								 "and notertanggung is not null and $periode ".
								 "and a.kdcarabayar=d.kdcarabayar(+) ".
								 "and e.kdstatusfile=a.kdstatusfile ".
								 "order by a.prefixpertanggungan,a.nopertanggungan";
					//echo $sql;			 
					//die;
					$DB->parse($sql);
					$DB->execute();
						  echo "<font color=\"003399\" face=verdana size=2><b>Daftar Polis Seluruh Kantor Periode $bln $vthn</b></font><br><br>";
 	 					  echo "<table>";
					    echo("<tr class=\"hijao\" >");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>No</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>No.Pertanggn.</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Tertanggung</b></font></td>");
							
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Nomor Pempol</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Nama Pemegang Polis</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Tgl Lahir Pempol</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>No Identitas Pempol</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Alamat Tetap Pemegang Polis</b></font></td>");
					    
						echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Produk</font></b></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>No.BP3</font></b></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Mulai</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Expirasi</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Med</font></b></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Cara Bayar</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Valuta</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>J U A</b></font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Premi 1</font></b></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Premi 2</font></b></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Idx.Awal</font></b></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Komisi CB</font></b></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>No. Agen</font></b></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Nama Agen</font></b></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Tgl Konversi</font></b></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Tgl Cetak</font></b></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Status Polis</font></b></td>");
							//echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Komisi Agen</font></b></td>");
							//echo("<td align=center><font face=\"Verdana\" size=\"1\"><b>Rekam</font></b></td>");
							echo("</tr>");					 
							$i=1;
							while ($arr=$DB->nextrow()) {
							/*
							  $sendemail = $arr["TGLSENDEMAIL"];
							  $nopertanggungan = $arr["NOPERTANGGUNGAN"];
							  $prefix = $arr["PREFIXPERTANGGUNGAN"];
							    switch ($sendemail)
							    {
							       case "": $sendemail="<font color=red>BELUM</font>"; break;
							       default : $sendemail; break; 
							    }
							*/
							//$KAG=new KomisiAgen($userid,$passwd,$arr["PREFIXPERTANGGUNGAN"],$arr["NOPERTANGGUNGAN"]);
							if($arr["NAMASTATUSFILE"]=="DELETE"){
							}else{
							include "../../includes/belang.php";	 
              echo("<td><font face=\"Verdana\" size=\"1\">".$i."</font></td>");
						  echo("<td align=center><font face=Verdana size=1><a href=\"#\" onclick=\"window.open('../polis/polis.php?prefix=".$arr["PREFIXPERTANGGUNGAN"]."&noper=".$arr["NOPERTANGGUNGAN"]."','','width=800,height=600,top=100,left=100,scrollbars=yes');\">".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."</a></td>");
		          echo("<td nowrap><font face=\"Verdana\" size=\"1\">".$arr["NAMAKLIEN1"].",".$arr["GELAR"]."</font></td>");

		          			echo("<td nowrap><font face=\"Verdana\" size=\"1\">".$arr["NOPEMPOL"]."</font></td>");
		          			echo("<td nowrap><font face=\"Verdana\" size=\"1\">".$arr["NAMAPEMPOL"]."</font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arr["TGLLAHIRPEMPOL"]."</font></td>");
					 		echo("<td><font face=\"Verdana\" size=\"1\">".$arr["KDID"]."-".$arr["NOID"]."</font></td>");
					 		echo("<td><font face=\"Verdana\" size=\"1\">".$arr["ALAMATTETAP01"]."</font></td>");

					 		echo("<td><font face=\"Verdana\" size=\"1\">".$arr["KDPRODUK"]."</font></td>");
							echo("<td><font face=\"Verdana\" size=\"1\">".$arr["NOBP3"]."</font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arr["MULAS"]."</font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arr["EXPIRASI"]."</font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arr["KDSTATUSMEDICAL"]."</font></td>");
		          echo("<td><font face=\"Verdana\" size=\"1\">".$arr["NAMACARABAYAR"]."</font></td>");
		          echo("<td nowrap><font face=\"Verdana\" size=\"1\">".$arr["NAMAVALUTA"]."</font></td>");      
							echo("<td align=right><font face=\"Verdana\" size=\"1\">".number_format($arr["JUAMAINPRODUK"],2)."</font></td>");
		      		echo("<td align=right><font face=\"Verdana\" size=\"1\">".number_format($arr["PREMI1"],2)."</font></td>");
							echo("<td align=right><font face=\"Verdana\" size=\"1\">".number_format($arr["PREMI2"],2)."</font></td>");
							echo("<td align=right><font face=\"Verdana\" size=\"1\">".number_format($arr["INDEXAWAL"],2)."</font></td>");
							echo("<td align=right><font face=\"Verdana\" size=\"1\">".number_format($arr["KOMISIAGEN"],2)."</font></td>");
							echo("<td align=right><font face=\"Verdana\" size=\"1\">".$arr["NOAGEN"]."</font></td>");
							echo("<td><font face=\"Verdana\" size=\"1\">".$arr["NAMAAGEN"]."</font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arr["TGLKONVERSI"]."</font></td>");
							echo("<td align=center><font face=\"Verdana\" size=\"1\">".$arr["TGLCETAK"]."</font></td>");
							echo("<td align=right><font face=\"Verdana\" size=\"1\">".$arr["NAMASTATUSFILE"]."</font></td>");
							//echo("<td align=right><font face=\"Verdana\" size=\"1\">".number_format($KAG->jmlkomisiagen,2)."</font></td>");       
							//echo("<td><font face=\"Verdana\" size=\"1\">".$arr["TGLREKAM"]."</font></td>");
              echo("</tr>");
							
					 $i++; 
					 }
					 }				 
           echo("</table>");
					 echo "</div>";
					 
					 $sql = "select ".
					 				   "b.namavaluta,".
										 "a.kdvaluta,count(a.nopertanggungan) as jpolis,".
										 "sum(a.premi1) as jpremi1, sum(a.premi2) as jpremi2, ".
										 "sum(a.juamainproduk) as jjua ".
	               "from ".
  								 "$DBUser.tabel_200_pertanggungan a, ".
									 "$DBUser.tabel_304_valuta b,".
  								 "$DBUser.tabel_500_penagih c ".
			           "where ".
								 "a.nopenagih=c.nopenagih ".
								 "and a.kdvaluta=b.kdvaluta ".
//			           "and c.kdrayonpenagih='$kantor' and a.kdpertanggungan='2' and a.kdstatusfile<>'7' ".
			           "and a.kdpertanggungan='2' and a.kdstatusfile<>'7' ".
								 "and notertanggung is not null and $periode ".
								 "group by a.kdvaluta,b.namavaluta";
					//echo $sql;			 
					$DB->parse($sql);
					$DB->execute();
					?>
					<br />
					<font face="Verdana" size="2"><b>SUMMARY</b></font>
					<table border="1" cellpadding="2" cellspacing="0" style="border-collapse: collapse" bordercolor="#C0C0C0" id="AutoNumber1">
            <tr>
              <td width="20%" rowspan="2" align="center" bgcolor="#569BD3"><b>
              <font color="#FFFFFF" face="Verdana" size="1">Valuta</font></b></td>
              <td width="80%" colspan="4" align="center" bgcolor="#569BD3"><b>
              <font color="#FFFFFF" face="Verdana" size="1">Jumlah</font></b></td>
            </tr>
            <tr>
              <td width="20%" align="center" bgcolor="#569BD3"><b>
              <font color="#FFFFFF" face="Verdana" size="1">Polis</font></b></td>
              <td width="20%" align="center" bgcolor="#569BD3"><b>
              <font color="#FFFFFF" face="Verdana" size="1">Premi1</font></b></td>
              <td width="20%" align="center" bgcolor="#569BD3"><b>
              <font color="#FFFFFF" face="Verdana" size="1">Premi2</font></b></td>
              <td width="20%" align="center" bgcolor="#569BD3"><b>
              <font color="#FFFFFF" face="Verdana" size="1">JUA</font></b></td>
            </tr>
					<?
					while ($arr=$DB->nextrow()) {
					   
						 echo "<tr>";
             echo " <td><font face=Verdana size=1><b>".$arr["NAMAVALUTA"]."</b></td>";
             echo " <td align=right><font face=Verdana size=1>".$arr["JPOLIS"]."</td>";
             echo " <td align=right><font face=Verdana size=1>".number_format($arr["JPREMI1"],2,",",".")."</td>";
             echo " <td align=right><font face=Verdana size=1>".number_format($arr["JPREMI2"],2,",",".")."</td>";
             echo " <td align=right><font face=Verdana size=1>".number_format($arr["JJUA"],2,",",".")."</td>";
             echo "</tr>";
						 /*
						 if($arr["KDVALUTA"]!="0")
						 {
						   echo "<tr>";
               echo " <td><font face=Verdana size=1><b>RUPIAH DENGAN INDEX</b></td>";
               echo " <td align=right><font face=Verdana size=1>-</td>";
               echo " <td align=right><font face=Verdana size=1>-</td>";
               echo " <td align=right><font face=Verdana size=1>-</td>";
               echo " <td align=right><font face=Verdana size=1>-</td>";
               echo "</tr>";
						 }
						 if($arr["KDVALUTA"]!="3")
						 {
						   echo "<tr>";
               echo " <td><font face=Verdana size=1><b>US DOLAR</b></td>";
               echo " <td align=right><font face=Verdana size=1>-</td>";
               echo " <td align=right><font face=Verdana size=1>-</td>";
               echo " <td align=right><font face=Verdana size=1>-</td>";
               echo " <td align=right><font face=Verdana size=1>-</td>";
               echo "</tr>";
						 }
						 if($arr["KDVALUTA"]!="1")
						 {
						   echo "<tr>";
               echo " <td><font face=Verdana size=1><b>RUPIAH TANPA INDEX</b></td>";
               echo " <td align=right><font face=Verdana size=1>-</td>";
               echo " <td align=right><font face=Verdana size=1>-</td>";
               echo " <td align=right><font face=Verdana size=1>-</td>";
               echo " <td align=right><font face=Verdana size=1>-</td>";
               echo "</tr>";
						 }
						 */
					}
					?>
					</table>
					<?
}
					 echo "<hr size=1>";
					 echo "<a class=verdana10blk href=\"index.php\">Menu Pelaporan</a>";
?>
