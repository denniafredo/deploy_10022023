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
<body>
<link href="../jws.css" rel="stylesheet" type="text/css">
<!--
<div align="center">
<h1><font color=red>sorry ...</font></h1>
<font size=5>saat ini masih dikerjakan</font><br>
<br><br>
</div>
-->
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
	for ($currentYear=$startYear-3; $currentYear<=$startYear+5;$currentYear++) {
		print("<option value=\"$currentYear\""); 
		if (date("Y", $useDate)==$currentYear) { 
			print(" selected"); 
		} 
		print(">$currentYear\n"); 
	} 
	print("</select>"); 
} 

?> 
<a class="verdana10blk"><b>AKSEPTASI POLIS BERDASARKAN MULAI ASURANSI</b></a>
<hr size="1">
    <table>
    <form name="date" action="<? PHP_SEFT ?>"> 
    <tr>
    <td class="verdana10blk">Cari Kantor 
		<select name="kdkantor" onfocus="highlight(event)" class="c" onchange="return getPenagih(document.chry);">
		           <option value="SEMUA KANTOR">SEMUA KANTOR</option>
		<?
		  $sqa="select kdkantor,namakantor from $DBUser.tabel_001_kantor where kdjeniskantor in ('1','2') order by kdkantor";
		  $DB->parse($sqa);
			$DB->execute();					 
		  while ($arr=$DB->nextrow()) {
			 if ($arr["KDKANTOR"]==$kdkantor) {
			  print( "<option selected value=".$arr["KDKANTOR"].">".$arr["KDKANTOR"]." - ".$arr["NAMAKANTOR"]."</option>" );
		   } else { 
				print( "<option value=".$arr["KDKANTOR"].">".$arr["KDKANTOR"]." - ".$arr["NAMAKANTOR"]."</option>" );
		   }
			}
		?>		
		</td>
		<td class="verdana10blk">Tanggal  <? DateSelector("v"); ?></td>
		<td><input type="submit" value="CARI" name="cari"></td>
    </form> 
    </tr>
		</table>

<hr size="1">
<div align="center">
<!------------------------------ End date selector ----------------------------->
<?

  $sql = "select to_char(sysdate,'DD/MM/YYYY') hariini from dual";
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
    $searchbydate="trunc(a.tglkonversi)=trunc(sysdate) and ";
    $tglheader="Hari Ini";
		$carikurs="b.tglkursberlaku <= sysdate";
		$summary="trunc(a.tglkonversi)=trunc(sysdate) ";
} elseif($vtgl=="all"){
	  $tglsearch="$bln$vtahun";
		$searchbydate="to_char(a.tglkonversi,'MMYYYY')='".$tglsearch."' and ";
		$tglheader="Bulan ".$vbulan." ".$vthn;
		$carikurs="to_char(b.tglkursberlaku,'MMYYYY') <='".$tglsearch."'";
		$summary="to_char(a.tglkonversi,'MMYYYY')='".$tglsearch."' ";
} else {
	  $tglsearch="$tglnow$bln$vtahun";
		$searchbydate="to_char(a.tglkonversi,'DDMMYYYY')='".$tglsearch."' and ";
		$tglheader="Tanggal ".$vtgl." ".$vbulan." ".$vthn;
		$carikurs="to_char(b.tglkursberlaku,'DDMMYYYY') <='".$tglsearch."'";
		$summary="to_char(a.tglkonversi,'DDMMYYYY')='".$tglsearch."' ";
}

$tandacabang=substr($kdkantor,-1);
$cabang=substr($kdkantor,0,1);
if(!$kdkantor){
     $pilihankantor="a.prefixpertanggungan='".$kantor."' and ";
		 $kdkantor=$kantor;
} else if($kdkantor=="SEMUA KANTOR"){
     $pilihankantor="";
} else if($tandacabang=="A"){
     $pilihankantor="a.prefixpertanggungan like'".$cabang."%' and ";
} else {
     $pilihankantor="a.prefixpertanggungan='".$kdkantor."' and ";
}

echo "<b><a class=verdana10blk>Akseptasi Polis Kantor ".$kdkantor." ".$tglheader."</a></b><br><br>";
  $sql = "select ".
	           "a.prefixpertanggungan,a.nopertanggungan,a.kdcarabayar,a.kdstatusmedical,a.indexawal,".
						 "to_char(a.mulas,'DD/MM/YYYY') mulas,a.kdproduk,a.lamaasuransi_th,a.noagen,".
						 "to_char(a.tglkonversi,'DD/MM/YY HH24:MI') tglkonversi,a.premi1,a.juamainproduk,".
						 "floor(months_between(to_date(trunc(sysdate),'DD/MM/YYYY'),to_date(trunc(a.mulas),'DD/MM/YYYY'))) lamabulan,".
						 "count(x.nilairp) jmlkwitansi,a.userkonversi,".
						 "sum(x.nilairp) jumlahpremi, ".
						 "c.namacarabayar,d.namaklien1 as namatertanggung,e.notasi,f.userupdated ".
				 "from ".
				     "$DBUser.tabel_100_klien d, ".
				     "$DBUser.tabel_300_historis_premi x, ".
				     "$DBUser.tabel_200_pertanggungan a, ".
						 "$DBUser.tabel_305_cara_bayar c, ".
						 "$DBUser.tabel_304_valuta e, ".
						 "$DBUser.tabel_214_acceptance_dokumen f ".
				 "where ".
				     "x.prefixpertanggungan=a.prefixpertanggungan and ".
						 "x.nopertanggungan=a.nopertanggungan and ".
						 "f.nopertanggungan=a.nopertanggungan and ".
						 "a.notertanggung=d.noklien and ".
						 "a.kdvaluta=e.kdvaluta and ".
						 "a.kdcarabayar=c.kdcarabayar and ".
						 "".$searchbydate."".
						 "".$pilihankantor."".
						 "x.tglbooked between a.mulas and a.tglkonversi ".
				 "group by ".
					   "a.prefixpertanggungan,a.nopertanggungan,a.premi1,a.juamainproduk,a.tglkonversi,".
						 "d.namaklien1,a.noagen,e.notasi,a.indexawal,".
						 "c.namacarabayar,a.userkonversi,f.userupdated,".
						 "a.kdcarabayar,a.kdstatusmedical,a.mulas,a.lamaasuransi_th,a.kdproduk"; 
		//echo "<br>".$sql."<br>";
	$DB->parse($sql);
	$DB->execute();
  echo "<table>"; 
		 echo "<tr bgcolor=#78bdd8>"; 
		 echo "<td class=arial7>NO.</td>";
		 echo "<td class=arial7>KTR</td>";
	   echo "<td class=arial7>NO.PERTANG</td>";
		 echo "<td class=arial7>TERTANGGUNG</td>";
		 echo "<td class=arial7>NO.AGEN</td>";
		 echo "<td class=arial7>MULAS</td>";
		 echo "<td class=arial7>KD.PRODUK</td>";
		 echo "<td class=arial7>STT.MED</td>";
		 echo "<td class=arial7>CARABAYAR</td>";
		 echo "<td class=arial7>VAL</td>";
		 echo "<td class=arial7>JUA</td>";
		 echo "<td class=arial7>BLN</td>";
		 echo "<td class=arial7>PREMI BP3</td>";
		 echo "<td class=arial7>JML.KWT</td>";
		 echo "<td class=arial7>PREMI YANG<br>HARUS DITERIMA</td>";
     echo "<td class=arial7>IDX.AWAL</td>";
		 echo "<td class=arial7>TGL.KONV.<br>(WIB)</td>";
		 echo "<td class=arial7>USER ACCPT</td>";
		 echo "</tr>";
	$i=1;
	while ($arr=$DB->nextrow()) {
	   include "../../includes/belang.php";	
		 echo "<td class=arial7>".$i."</td>";
	   echo "<td class=arial7>".$arr["PREFIXPERTANGGUNGAN"]."</td>"; 
		 echo "<td class=arial7>".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."</td>";
		 echo "<td class=arial7>".$arr["NAMATERTANGGUNG"]."</td>";
		 echo "<td class=arial7>".$arr["NOAGEN"]."</td>";
		 echo "<td class=arial7>".$arr["MULAS"]."</td>";
		 echo "<td class=arial7>".$arr["KDPRODUK"]."/".$arr["LAMAASURANSI_TH"]." TH</td>";
		 echo "<td class=arial7 align=center>".$arr["KDSTATUSMEDICAL"]."</td>";
		 echo "<td class=arial7>".$arr["NAMACARABAYAR"]."</td>"; 
		 echo "<td class=arial7>".$arr["NOTASI"]."</td>";
		 echo "<td class=arial7 align=right>".number_format($arr["JUAMAINPRODUK"],2)."</td>";
		 echo "<td class=arial7 align=right>".$arr["LAMABULAN"]."</td>";
		 echo "<td class=arial7 align=right>".number_format($arr["PREMI1"],2)."</td>";
		 echo "<td class=arial7 align=right>".$arr["JMLKWITANSI"]."</td>";
		 echo "<td class=arial7 align=right>".number_format($arr["JUMLAHPREMI"],2)."</td>";
		 echo "<td class=arial7 align=right>".number_format($arr["INDEXAWAL"],2)."</td>";
		 echo "<td class=arial7 align=center>".$arr["TGLKONVERSI"]."</td>";
		 //echo "<td class=arial7>".$arr["USERKONVERSI"]."</td>";
		 echo "<td class=arial7>".$arr["USERUPDATED"]."</td>";
		 echo "</tr>";
		 $i++;
	}
	echo "</table>";
	
	echo "<br><b><a class=verdana10blk>Summary</a></b>";
	$sql = "select ".
	       "decode(a.kdvaluta,'0','RUPIAH INDEX','1','RUPIAH','DOLLAR AS') namavaluta,".
	       "a.kdvaluta,count(distinct(a.nopertanggungan)) polis,sum(a.premi1) premi1,sum(b.nilairp) premirp ".
				 "from ".
				 "$DBUser.tabel_300_historis_premi b,$DBUser.tabel_200_pertanggungan a ".
				 "where ".
				 "".$pilihankantor." ".
				 "".$summary." ".
				 "and a.prefixpertanggungan=b.prefixpertanggungan and ".
  			 "a.nopertanggungan=b.nopertanggungan and ".
				 "b.tglbooked between a.mulas and a.tglkonversi ".
				 "group by a.kdvaluta";
				 //echo "<br>".$sql."<br>";
	
	$DB->parse($sql);
	$DB->execute();
	echo "<table width=600>";
	   echo "<tr bgcolor=#78bdd8>";
		 echo "<td class=verdana7blk align=center>VALUTA</td>"; 
		 echo "<td class=verdana7blk align=center>JML. POLIS</td>"; 
		 echo "<td class=verdana7blk align=center>PREMI</td>";
		 echo "<td class=verdana7blk align=center>PREMI BP3 (RP)</td>";
		 echo "</tr>";
	$pol=0;
	$prerp=0;
	while ($ark=$DB->nextrow()) {
	   switch ($ark["KDVALUTA"]) {
		    case "0":  $kursvaluta = $kursindex; break;
				case "3":  $kursvaluta = $kursdolar; break;
				case "1":  $kursvaluta = "1"; break;
		 }
		 $pol=$ark["POLIS"];
		 $prerp=$ark["PREMIRP"];
	   include "../../includes/belang.php";	
	   echo "<td class=verdana7blk>".$ark["NAMAVALUTA"]."</td>"; 
		 echo "<td class=verdana7blk align=right>".$ark["POLIS"]."</td>"; 
		 echo "<td class=verdana7blk align=right>".number_format($ark["PREMI1"],2)."</td>";
		 echo "<td class=verdana7blk align=right>".number_format($ark["PREMIRP"],2)."</td>";
		 echo "</tr>";
		 $totpol+=$pol;
		 $totpre+=$prerp;
	}
	   echo "<tr bgcolor=#cee0ff>";
	   echo "<td class=verdana7blk>TOTAL</td>"; 
		 echo "<td class=verdana7blk align=right>".$totpol."</td>"; 
		 echo "<td class=verdana7blk align=right></td>";
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