<? 
  include "../../includes/database.php"; 
  include "../../includes/session.php"; 
	include "../../includes/common.php";
  $DB=new Database($userid, $passwd, $DBName);
?>	

<html>
<head>
<title>Untitled</title>
</head>
<link href="../jws.css" rel="stylesheet" type="text/css">
<body>
<?
function DateSelector($inName, $useDate=0) { 
	$monthName=array(1=>"Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"); 
	if ($useDate==0) { 
		$useDate=Time(); 
	} 
	//make day selector 
	print("<select name=".$inName."tgl>\n"); 
	echo "<option value=\"all\">-</option>";
	for ($currentDay=1; $currentDay<=31; $currentDay++) { 
		print("<option value=\"$currentDay\""); 
		if (intval(date("d", $useDate))==$currentDay) { 
			print(" selected"); 
		} 
		print(">$currentDay\n"); 
	} 
	print("</select>");  
	// make month selector 
	print("<select name=".$inName."bln>\n");
	echo "<option value=\"all\">-</option>";
	for ($currentMonth=1; $currentMonth<=12; $currentMonth++) { 
		print("<option value=\""); 
		print(intval($currentMonth)); 
		print("\""); 
		if (intval(date("m", $useDate))==$currentMonth) { 
			print(" selected");
		} 
		print(">".$monthName[$currentMonth]."\n"); 
	} 
	print("</select>"); 
	// make year selector 
	print("<select name=".$inName."thn>\n"); 
	$startYear=date("Y", $useDate); 
	for ($currentYear=$startYear-0; $currentYear<=$startYear+0;$currentYear++) {
		print("<option value=\"$currentYear\""); 
		if (date("Y", $useDate)==$currentYear) { 
			print(" selected"); 
		} 
		print(">$currentYear\n"); 
	} 
	print("</select>"); 
} 
?> 

<a class="verdana10blk"><b>PENERIMAAN PREMI OB PER KANTOR PERWAKILAN</b></a>
<hr size="1">
    <table>
    <form name="date" action="<? PHP_SEFT ?>"> 
    <tr>
		<td class="verdana10blk">Tanggal  <? DateSelector("v"); ?></td>
		<td><input type="submit" value="CARI" name="cari"></td>
    </form> 
    </tr>
		</table>

<hr size="1">
<div align="center">
<!------------------------------ End date selector ----------------------------->
<?
  $sql = "select to_char(sysdate,'DDMMYYYY') hariini from dual";
			 	 $DB->parse($sql);
				 $DB->execute();
				 $ars=$DB->nextrow();
				 $hariini = $ars["HARIINI"];
				 
$vtahun = substr($vthn,-4);
$tanggal = "0".$vtgl;
$bul = "0".$vbln;
$bln=substr($bul,-2);
$tglnow = substr($tanggal,-2);

switch ($bln) {
   case "01":  $vbulan = "Januari"; break;
   case "02":  $vbulan = "Pebruari"; break;
   case "03":  $vbulan = "Maret"; break;
   case "04":  $vbulan = "April"; break;
   case "05":  $vbulan = "Mei"; break;
   case "06":  $vbulan = "Juni"; break;
   case "07":  $vbulan = "Juli"; break;
   case "08":  $vbulan = "Agustus"; break;
   case "09":  $vbulan = "September"; break;					
   case "10":  $vbulan = "Oktober"; break;
   case "11":  $vbulan = "Nopember"; break;
   case "12":  $vbulan = "Desember"; break;										
}

if($vtgl=="" && $vbln=="" && $vthn=="") {
    $tglsearch=$hariini;
    $tglheader="Hari Ini";
		$summary="'DDMMYYYY')='".$tglsearch."' ";
} elseif(($vtgl=="all") && ($vbln!="all")){
	  $tglsearch="$bln$vtahun";
		//$searchbydate="to_char(a.tglkonversi,'MMYYYY')='".$tglsearch."' and ";
		$tglheader="Bulan ".$vbulan." ".$vthn;
		$summary="'MMYYYY')='".$tglsearch."' "; 
} elseif($vbln=="all"){
	  $tglsearch="$vtahun";
		$tglheader="Tahun ".$vthn;
		$summary="'YYYY')='".$vthn."' "; 
} elseif(($vbln=="all") && ($vtgl=="all")){
	  $tglsearch="$vtahun";
		$tglheader="Tahun ".$vthn;
		$summary="'YYYY')='".$vthn."' "; 
} else {
	  $tglsearch="$tglnow$bln$vtahun";
		//$searchbydate="to_char(a.tglkonversi,'DDMMYYYY')='".$tglsearch."' and ";
		$tglheader="Tanggal ".$vtgl." ".$vbulan." ".$vthn;
		$summary="'DDMMYYYY')='".$tglsearch."' ";
}

			$sql = "select ".
     					 	 "c.kdkantor,".
     						 "c.namakantor,".
                 "x.jmlpolrp,".
                 "x.premirupiah,".
								 "x.premirpr,".
                 "y.jmlpolindex,".
                 "y.premiindex,".
								 "y.premirpi,".
                 "z.jmlpoldolar,".
                 "z.premidolar,".
								 "z.premirpd ".
						 "from ".
                 "$DBUser.tabel_001_kantor c,".
                 "(select ".
                    	"r.kdrayonpenagih,".
                    	"sum(p.premi1) as premirupiah,".
											"sum(h.nilairp) as premirpr,".
                    	"count(p.nopertanggungan) as jmlpolrp ".
                   "from ".
                    	"$DBUser.tabel_200_pertanggungan p,".
                    	"$DBUser.tabel_300_historis_premi h,".
                     	"$DBUser.tabel_500_penagih r ".
                   "where ".
                    	"p.kdvaluta='1' and ".
                    	"h.prefixpertanggungan=p.prefixpertanggungan and ".
                    	"p.nopenagih=r.nopenagih and ".
                    	"h.nopertanggungan=p.nopertanggungan and ".
                    	"h.nilairp is not null and ".
                    	"h.kdkuitansi like 'OB%' and to_char(h.tglbayar,".$summary." ".
                   "group by r.kdrayonpenagih) x,".
                 "(select ".
                    	"r.kdrayonpenagih,".
                    	"sum(p.premi1) as premiindex,".
											"sum(h.nilairp) as premirpi,".
                    	"count(p.nopertanggungan) as jmlpolindex  ".
                   "from ".
                    	"$DBUser.tabel_200_pertanggungan p,".
                    	"$DBUser.tabel_300_historis_premi h,".
                     	"$DBUser.tabel_500_penagih r ".
                   "where ".
                    	"p.kdvaluta='0' and ".
                    	"h.prefixpertanggungan=p.prefixpertanggungan and ".
                    	"p.nopenagih=r.nopenagih and ".
                    	"h.nopertanggungan=p.nopertanggungan and ".
                    	"h.nilairp is not null and ".
                    	"h.kdkuitansi like 'OB%' and to_char(h.tglbayar,".$summary." ".
                   "group by r.kdrayonpenagih) y,".
                 "(select ".
                    	"r.kdrayonpenagih,".
                    	"sum(p.premi1) as premidolar,".
											"sum(h.nilairp) as premirpd,".
                    	"count(p.nopertanggungan) as jmlpoldolar ".
                   "from ".
                    	"$DBUser.tabel_200_pertanggungan p,".
                    	"$DBUser.tabel_300_historis_premi h,".
                     	"$DBUser.tabel_500_penagih r ".
                   "where ".
                    	"p.kdvaluta='3' and ".
                    	"h.prefixpertanggungan=p.prefixpertanggungan and ".
                    	"p.nopenagih=r.nopenagih and ".
                    	"h.nopertanggungan=p.nopertanggungan and ".
                    	"h.nilairp is not null and ".
                    	"h.kdkuitansi like 'OB%' and to_char(h.tglbayar,".$summary." ".
                   "group by r.kdrayonpenagih) z ".
                "where ".
								   "c.kdjeniskantor='2' and ".
                   "c.kdkantor=x.kdrayonpenagih(+) and ".
                   "c.kdkantor=y.kdrayonpenagih(+) and ".
                   "c.kdkantor=z.kdrayonpenagih(+) ".
                "group by ".
                   "c.kdkantor,".
                   "c.namakantor,".
									 "x.premirpr,".
									 "y.premirpi,".
									 "z.premirpd,".
                   "x.premirupiah,".
                   "x.jmlpolrp,".
                   "y.premiindex,".
                   "y.jmlpolindex,".
                   "z.jmlpoldolar,".
                   "z.premidolar ".
                "order by c.kdkantor";
								
				 $DB->parse($sql);
				 $DB->execute();
				 //echo "<br>".$sql."<br>";

	echo "<a class=verdana10blk><b>Penerimaan Premi OB ".$tglheader."</b></a><br>".
			 "<b><a class=verdana10blk>Berdasarkan Uang Masuk/Diterima Kasier</a></b><br><br>";
	echo "<table cellpadding=\"1\" cellspacing=\"1\">";
	?>
	<tr bgcolor="#78bdd8">
    <td rowspan="2" align="center" class="verdana7blk">NO.</td>
    <td colspan="2" align="center" class="verdana7blk">KANTOR</td>
    <td colspan="2" align="center" class="verdana7blk">RUPIAH</td>
    <td colspan="2" align="center" class="verdana7blk">RUPIAH INDEX</td>
    <td colspan="2" align="center" class="verdana7blk">US DOLAR</td>
    <td colspan="2" align="center" class="verdana7blk">TOTAL PREMI RUPIAH</td>
  </tr>
  <tr bgcolor="#78bdd8">
    <td align="center" class="verdana7blk">KD</td>
    <td align="center" class="verdana7blk">NAMA</td>
    <td align="center" class="verdana7blk">JML</td>
    <td align="center" class="verdana7blk">PREMI</td>
    <td align="center" class="verdana7blk">JML</td>
    <td align="center" class="verdana7blk">PREMI</td>
    <td align="center" class="verdana7blk">JML</td>
    <td align="center" class="verdana7blk">PREMI</td>
    <td align="center" class="verdana7blk">JML</td>
    <td align="center" class="verdana7blk">PREMI</td>
  </tr>
	<?
	$pol=0;
	$i=1;
	$prerp=0;
	$prerup=0;
	$preusd=0;
	$preidx=0;
	$jmlrp=0;
	$jmlusd=0;
	$jmlidx=0;
	while ($ark=$DB->nextrow()) {
		 $prerp=$ark["PREMIRP"];
		 $prerup=$ark["PREMIRUPIAH"];
		 $preusd=$ark["PREMIDOLAR"];
		 $preidx=$ark["PREMIINDEX"];
		 $jmlrp=$ark["JMLPOLRP"];
		 $jmlusd=$ark["JMLPOLDOLAR"];
		 $jmlidx=$ark["JMLPOLINDEX"];

		 $prerpr=$ark["PREMIRPR"];
		 $prerpi=$ark["PREMIRPI"];
		 $prerpd=$ark["PREMIRPD"];
		 
		 $pol=$jmlrp+$jmlusd+$jmlidx;
		 $premi=$prerpr+$prerpi+$prerpd;
		 
	   include "../../includes/belang.php";	
		 echo "<td class=verdana7blk>".$i."</td>"; 
	   echo "<td class=verdana7blk>".$ark["KDKANTOR"]."</td>"; 
		 echo "<td class=verdana7blk>".$ark["NAMAKANTOR"]."</td>"; 
		 echo "<td class=verdana7blk align=right>".($ark["JMLPOLRP"]=='' ? 0 : $ark["JMLPOLRP"])."</td>"; 
		 echo "<td class=verdana7blk align=right>".number_format($ark["PREMIRUPIAH"],2)."</td>";
		 echo "<td class=verdana7blk align=right>".($ark["JMLPOLINDEX"]=='' ? 0 : $ark["JMLPOLINDEX"])."</td>"; 
		 echo "<td class=verdana7blk align=right>".number_format($ark["PREMIINDEX"],2)."</td>";
		 echo "<td class=verdana7blk align=right>".($ark["JMLPOLDOLAR"]=='' ? 0 : $ark["JMLPOLDOLAR"])."</td>"; 
		 echo "<td class=verdana7blk align=right>".number_format($ark["PREMIDOLAR"],2)."</td>";
		 echo "<td class=verdana7blk align=right>".$pol."</td>";
		 echo "<td class=verdana7blk align=right>".number_format($premi,2)."</td>";
		 echo "</tr>";
		 $i++;
		 $totpol+=$pol;
		 $totpre+=$premi;
		 $totrupiah+=$prerup;
		 $totdolar+=$preusd;
		 $totindex+=$preidx;
		 
		 $totpolrp+=$jmlrp;
		 $totpolusd+=$jmlusd;
		 $totpolidx+=$jmlidx;
		 
	}
	   echo "<tr bgcolor=#cee0ff>";
	   echo "<td class=verdana7blk align=center colspan=3>TOTAL</td>"; 
		 echo "<td class=verdana7blk align=right>".$totpolrp."</td>"; 
		 echo "<td class=verdana7blk align=right>".number_format($totrupiah,2)."</td>";
		 echo "<td class=verdana7blk align=right>".$totpolidx."</td>"; 
		 echo "<td class=verdana7blk align=right>".number_format($totindex,2)."</td>";
		 echo "<td class=verdana7blk align=right>".$totpolusd."</td>"; 
		 echo "<td class=verdana7blk align=right>".number_format($totdolar,2)."</td>";
		 echo "<td class=verdana7blk align=right>".$totpol."</td>"; 
		 echo "<td class=verdana7blk align=right>".number_format($totpre,2)."</td>";
		 echo "</tr>";
	echo "</table>";
?>
<br><br>
</div>
<hr size="1">
<a href="index.php" class="verdana10blk">Back</a>
</body>
</html>
