<?
  include "../../includes/database.php";
  include "../../includes/session.php";
	//$prefixpertanggungan=$kantor;
	$DB=new database($userid, $passwd, $DBName);
	//------------------------ CARI PREFIX ---------------
  $sqlp="select prefixpertanggungan ".
			 "from $DBUser.tabel_200_pertanggungan where nopertanggungan='$nopertanggungan'";
	$DB->parse($sqlp);
  $DB->execute();
	$arr=$DB->nextrow();
	$prefixpertanggungan = $arr["PREFIXPERTANGGUNGAN"];
	//------------------------- END CARI PREFIX
/*premi dalam tabel adalah premi dalam tahun*/

	$sql="select namaklien1 from $DBUser.tabel_100_klien ".
	     "where noklien='$noagen'";
	$DB->parse($sql);
	$DB->execute();	
	$x=$DB->nextrow();
	$namaagen = $x["NAMAKLIEN1"];
	
	$sql="select a.kdcarabayar,b.namacarabayar,b.faktorkomisi ".
	     "from $DBUser.tabel_200_temp a,$DBUser.tabel_305_cara_bayar b ".
	     "where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan' and ".
			 "a.kdcarabayar=b.kdcarabayar";
	$DB->parse($sql);
	$DB->execute();	
	$s=$DB->nextrow();
	$cabayar=$s["KDCARABAYAR"];
	$cabar=$s["NAMACARABAYAR"];
	$faktorkomisi=$s["FAKTORKOMISI"];	
	
 	if (is_null($cabayar) || $cabayar==''){
	$sql="select a.kdcarabayar,b.namacarabayar,b.faktorkomisi ".
			 "from $DBUser.tabel_200_pertanggungan a,$DBUser.tabel_305_cara_bayar b ".
	     "where prefixpertanggungan='$prefixpertanggungan' and nopertanggungan='$nopertanggungan' and ".
			 "a.kdcarabayar=b.kdcarabayar";
	//echo $sql;
	$DB->parse($sql);
	$DB->execute();	
	$x=$DB->nextrow();
	$cabayar=$x["KDCARABAYAR"];
	$cabar=$x["NAMACARABAYAR"];
	$faktorkomisi=$x["FAKTORKOMISI"];	
	}		 

	$sql="select a.thnkomisi,a.komisiagen,b.namakomisiagen,b.kdkomisiagen ".
	     "from $DBUser.tabel_404_temp a, $DBUser.tabel_402_kode_komisi_agen b ".
			 "where a.kdkomisiagen=b.kdkomisiagen and ".
			 "a.prefixpertanggungan='$prefixpertanggungan' and a.nopertanggungan='$nopertanggungan' ".
			 "order by b.namakomisiagen desc";
	//echo $sql;
	$DB->parse($sql);
	$DB->execute();		
?>

<html>
<head><title>Hitung Komisi</title><link href="../jws.css" rel="stylesheet" type="text/css"></head>
<body topmargin="0">
<table width="100%">
<tr><td align="right"><font face="Verdana" size="2" color="#0033CC">F1431</font></td></tr>
</table>
	<font face="Verdana" size="2"><b>Komisi Agen Penutup</b> </font>
  <hr size=1>
	<table>
	<tr>
	  <td class="ver10teal">No. Agen</td>
	  <td class="ver10teal">:</td>
	  <td class="arial10ungu"><? echo $noagen; ?></td>
	  <td class="arial10bold"><? echo "&nbsp;".$namaagen; ?></td>
	</tr>
		<tr>
	  <td class="ver10teal">Cara bayar</td>
	  <td class="ver10teal">:</td>
	  <td class="arial10bold"><? echo $cabar; ?></td>
	</tr>
	</table>
  <hr size=1>
	<?
	echo "<div align=center><table>";
  print( "	 <tr bgcolor=#97b3b9 align=\"center\">\n" );
  print( "    <td rowspan=\"2\" class=\"arial10bold\">Tahun</td>\n" );
  print( "    <td  rowspan=\"2\" class=\"arial10bold\">Nama Komisi</td>\n" );
  print( "    <td colspan=\"2\" class=\"arial10bold\">K o m i s i</td>\n" );
  print( "  </tr>\n" );
  print( "  <tr bgcolor=#97b3b9 align=\"center\">\n" );
  print( "    <td  class=\"arial10bold\">Dalam Tahun</td>\n" );
  print( "    <td  class=\"arial10bold\">Sesuai Cara Bayar</td>\n" );
  print( "  </tr>" );

	$jmlkomisi=0;
	$i=0;
  while($arr=$DB->nextrow()) {
	//echo $arr["KOMISIAGEN"]."|".$arr["KDKOMISIAGEN"]."|".$faktorkomisi;	
		  $namakomisi = $arr["NAMAKOMISIAGEN"];
		switch ($namakomisi)
	  {
			case "KOMISI PROPOSAL BARU":
		    $komisi = "KOMISI TAHUN KE";
			  break;
	    case "KOMISI PROPOSAL BARU USD":
		    $komisi = "KOMISI TAHUN KE";
			  break;
			case "KOMISI PREMI PERTAMA":
		    $komisi = "<font color=#993399>KOMISI PREMI</font>";
			  break;
			default:
		    $komisi = $namakomisi;
			}
	/*buat warna selang seling*/	
		if ($i % 2==0) {
		echo  "<tr bgcolor=#e0e0e4>";
		} else	{						
	  echo "<tr>";
		}	
	/*perhitungan komisi*/
	  if ($arr["KDKOMISIAGEN"]=='02'){
		  $komisia=$arr["KOMISIAGEN"];
		} else { 
		  if ($cabayar=='1'||$cabayar=='2'||$cabayar=='3'||$cabayar=='4') {
			 $komisia=$arr["KOMISIAGEN"]/$faktorkomisi;
			} else {
			 $komisia=$arr["KOMISIAGEN"]*$faktorkomisi;
			}
  	}	
/*add 9 jan*/
	  if ($arr["KDKOMISIAGEN"]=='02'){
		      $komisio=0;	
		} else {
		  if ($arr["KDKOMISIAGEN"]=='01' or $arr["KDKOMISIAGEN"]=='03'){
					$komisio=$arr["KOMISIAGEN"];
			}		
		}	
/**/		
	  echo "<td align=\"center\" class=arial10ungu><font face=\"Arial\" size=\"1\">".$arr["THNKOMISI"]."</font></td>";
		echo "<td class=arial10ungu><font face=\"Arial\" size=\"1\">".$komisi." ".$arr["THNKOMISI"]."</font></td>";
	  echo "<td align=\"right\" class=arial10ungu><font face=\"Arial\" size=\"1\">".number_format($komisio,2)."</font></td>";
		echo "<td align=\"right\" class=arial10ungu><font face=\"Arial\" size=\"1\">".number_format($komisia,2)."</font></td>";
	  echo "</tr>";
		$i++;
		$jmlkomisia+=$komisia;
		$jmlkomisi += $komisio;
	}
  echo "<tr bgcolor=\"#C0C0C0\">";
  echo "<td colspan=\"2\" bgcolor=#e0e0e4><font face=\"Verdana\" size=\"2\"><b>Jumlah Komisi</b></font></td>";
  echo "<td align=\"right\" bgcolor=#e0e0e4><font face=\"Arial\" size=\"2\" color=#004080><b>".number_format($jmlkomisi,2)."</b></font></td>";
	echo "<td align=\"right\" bgcolor=#e0e0e4><font face=\"Arial\" size=\"2\" color=#004080><b>".number_format($jmlkomisia,2)."</b></font></td>";
  echo "</tr>";

	echo "</table></div>";
  echo "<hr size=1>";
	echo "<table width=\"100%\"><tr>";
	echo "<td></td>";
	echo "<td align=\"right\" valign=\"top\">";
	echo "<a href=\"#\" onclick=\"javascript:window.print();\"><font face=\"Verdana\" size=\"1\">CETAK</font></a>&nbsp;&nbsp;&nbsp;";
	echo "<a href=\"#\" onclick=\"javascript:window.close();\"><font face=\"Verdana\" size=\"1\">CLOSE</font></a>";
	echo "</td></tr></table>";
?>
</body>
</html>