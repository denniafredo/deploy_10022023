<? 
  include "../../includes/database.php"; 
  include "../../includes/session.php"; 
  $DB=new database($userid, $passwd, $DBName);
?>	

<html>
<head>
<title>Untitled</title>
</head>
<link href="../jws.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>
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
	for ($currentYear=$startYear-5; $currentYear<=$startYear+0;$currentYear++) {
		print("<option value=\"$currentYear\""); 
		if (date("Y", $useDate)==$currentYear) { 
			print(" selected"); 
		} 
		print(">$currentYear\n"); 
	} 
	print("</select>"); 
} 
?> 

<a class="verdana10blk"><b>HASIL PREMI NB PER PRODUK</b></a>
<hr size="1">
    <table>
    <form name="date" action="<? PHP_SEFT ?>"> 
    <tr>
		<td class="verdana10blk">Tanggal  <? DateSelector("v"); ?></td>
		<td class="verdana10blk">Kantor</td>
		
		<td>
		<select name="kdkantor" onfocus="highlight(event)" class="c">
		  <option value="ALL">ALL</option>
		<?
		  $sqa="select kdkantor,namakantor from $DBUser.tabel_001_kantor ".
					 "where kdjeniskantor='2' order by kdkantor";
				 
		  $DB->parse($sqa);
			$DB->execute();					 
		  while ($arr=$DB->nextrow()) {
				print( "<option value=".$arr["KDKANTOR"].">".$arr["KDKANTOR"]." - ".$arr["NAMAKANTOR"]."</option>" );
			}
			
		?>		
		</select>
		</td>
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
		$searchbydate="to_char(a.tglkonversi,'MMYYYY')='".$tglsearch."' and ";
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
		$searchbydate="to_char(a.tglkonversi,'DDMMYYYY')='".$tglsearch."' and ";
		$tglheader="Tanggal ".$vtgl." ".$vbulan." ".$vthn;
		$summary="'DDMMYYYY')='".$tglsearch."' ";
}

if(!$kdkantor){
   $judul="Kantor $kantor";
	 $officex=$kantor;
   $getkantor="='$kantor'";
} elseif($kdkantor=="ALL") {
	 $judul="Semua Kantor";
	 $officex="ALL";
   $getkantor=" like '%%'";
}	else {
	 $judul="Kantor $kdkantor";
	 $officex=$kdkantor;
   $getkantor="='$kdkantor'";
}
						 
	$sql = "select ".
       	 		"a.kdproduk,".
						"c.namaproduk,".
       			
						"count(distinct(a.nopertanggungan)) polis,".
						"sum(b.nilairp) premirp,".
						"x.jmlpolrp,".
						"x.premirupiah,".
						
						"y.jmlpoldolar,".
						"y.premidolar,".
						
						"z.jmlpolindex,".
						"z.premiindex ".
						
				 "from ".
       	    "$DBUser.tabel_300_historis_premi b,".
       			"$DBUser.tabel_200_pertanggungan a, ".
						"$DBUser.tabel_202_produk c, ".
						"$DBUser.tabel_500_penagih d,".
						
						"(select p.kdproduk,sum(p.premi1) as premirupiah,".
						 "count(p.nopertanggungan) as jmlpolrp ".
						 "from ".
						 "$DBUser.tabel_200_pertanggungan p,".
						 "$DBUser.tabel_300_historis_premi h,".
						 "$DBUser.tabel_500_penagih xa ".
						 "where ".
						 "p.kdvaluta='1' and ".
						 "h.prefixpertanggungan=p.prefixpertanggungan and ".
						 "h.nopertanggungan=p.nopertanggungan and ".
						 "p.kdpertanggungan='2' and ".
						 "xa.nopenagih=p.nopenagih and ".
						 "xa.kdrayonpenagih ".$getkantor." and ".
						 "h.kdkuitansi='NB1' and ".
						 "h.nilairp is not null and ".
						 "to_char(p.mulas,".$summary." ".
						 "group by p.kdproduk) x, ".
						 
						"(select d.kdproduk,sum(d.premi1) as premidolar,".
						 "count(d.nopertanggungan) as jmlpoldolar ".
						 "from ".
						 "$DBUser.tabel_200_pertanggungan d,".
						 "$DBUser.tabel_300_historis_premi i, ".
						 "$DBUser.tabel_500_penagih ya ".
						 "where ".
						 "d.kdvaluta='3' and ".
						 "i.prefixpertanggungan=d.prefixpertanggungan and ".
						 "i.nopertanggungan=d.nopertanggungan and ".
						 "d.kdpertanggungan='2' and ".
						 "ya.nopenagih=d.nopenagih and ".
						 "ya.kdrayonpenagih ".$getkantor." and ".
						 "i.kdkuitansi='NB1' and ".
						 "i.nilairp is not null and ".
						 "to_char(d.mulas,".$summary." ".
						 "group by d.kdproduk) y, ".
						 
						"(select e.kdproduk,sum(e.premi1) as premiindex, ".
						 "count(e.nopertanggungan) as jmlpolindex ".
						 "from ".
						 "$DBUser.tabel_200_pertanggungan e,".
						 "$DBUser.tabel_300_historis_premi j,".
						 "$DBUser.tabel_500_penagih za ".
						 "where ".
						 "e.kdvaluta='0' and ".
						 "j.prefixpertanggungan=e.prefixpertanggungan and ".
						 "j.nopertanggungan=e.nopertanggungan and ".
						 "e.kdpertanggungan='2' and ".
						 "za.nopenagih=e.nopenagih and ".
						 "za.kdrayonpenagih ".$getkantor." and ".
						 "j.kdkuitansi='NB1' and ".
						 "j.nilairp is not null and ".
						 "to_char(e.mulas,".$summary." ".
						 "group by e.kdproduk) z ".
    		    
				 "where ".
         		"to_char(a.mulas,".$summary." and ".
       			"b.kdkuitansi='NB1' and ".
						"b.nilairp is not null and ".
						"a.prefixpertanggungan=b.prefixpertanggungan and ".
       			"a.nopertanggungan=b.nopertanggungan and ".
						"a.kdpertanggungan='2' and ".
						"a.kdproduk=x.kdproduk(+) and ".
						"a.kdproduk=y.kdproduk(+) and ".
						"a.kdproduk=z.kdproduk(+) and ".
						"a.kdproduk=c.kdproduk and ".
						"a.nopenagih=d.nopenagih and ".
						//"d.kdrayonpenagih like '%%' ".
						"d.kdrayonpenagih ".$getkantor." ".
				 "group by a.kdproduk,c.namaproduk,x.premirupiah,y.premidolar,z.premiindex,".
				    "x.jmlpolrp,y.jmlpoldolar,z.jmlpolindex ".
				    "order by c.namaproduk";
				 $DB->parse($sql);
				 $DB->execute();
				 
				 //echo "<br>".$sql."<br>";

	echo "<a class=verdana10blk><b>Hasil Premi NB ".$tglheader." ".$judul."</b></a>";
	echo "<table cellpadding=\"1\" cellspacing=\"1\">";
	?>
	<tr bgcolor="#78bdd8">
    <td rowspan="2" align="center" class="verdana7blk">NO.</td>
    <td colspan="2" align="center" class="verdana7blk">PRODUK</td>
    <td colspan="2" align="center" class="verdana7blk">RUPIAH</td>
    <td colspan="2" align="center" class="verdana7blk">RUPIAH INDEX</td>
    <td colspan="2" align="center" class="verdana7blk">US DOLAR</td>
    <td colspan="2" align="center" class="verdana7blk">TOTAL PREMI BP3 (RP)</td>
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
	$xjmlpol=0;
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
		 $pol=$ark["POLIS"];
		 $xjmlpol=$jmlrp + $jmlusd + $jmlidx;
	   include "../../includes/belang.php";	
		 echo "<td class=verdana7blk>".$i."</td>"; 
	   echo "<td class=verdana7blk>".$ark["KDPRODUK"]."</td>"; 
		 echo "<td class=verdana7blk><a href=\"#\" onclick=\"NewWindow('popnbperproduk.php?tglsearch=$tglsearch&kdproduk=".$ark["KDPRODUK"]."&kdkantor=$officex','popuppage','850','300','yes')\">".$ark["NAMAPRODUK"]."</a></td>"; 
		 echo "<td class=verdana7blk align=right>".($ark["JMLPOLRP"]=='' ? 0 : $ark["JMLPOLRP"])."</td>"; 
		 echo "<td class=verdana7blk align=right>".number_format($ark["PREMIRUPIAH"],2)."</td>";
		 echo "<td class=verdana7blk align=right>".($ark["JMLPOLINDEX"]=='' ? 0 : $ark["JMLPOLINDEX"])."</td>"; 
		 echo "<td class=verdana7blk align=right>".number_format($ark["PREMIINDEX"],2)."</td>";
		 echo "<td class=verdana7blk align=right>".($ark["JMLPOLDOLAR"]=='' ? 0 : $ark["JMLPOLDOLAR"])."</td>"; 
		 echo "<td class=verdana7blk align=right>".number_format($ark["PREMIDOLAR"],2)."</td>";
		 //echo "<td class=verdana7blk align=right>".($ark["POLIS"]=='' ? 0 : $ark["POLIS"])."</td>";
		 echo "<td class=verdana7blk align=right>".$xjmlpol."</td>";
		 echo "<td class=verdana7blk align=right>".number_format($ark["PREMIRP"],2)."</td>";
		 echo "</tr>";
		 $i++;
		 $totpol+=$xjmlpol;
		 $totpre+=$prerp;
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
