<? 
  include "../../includes/database.php"; 
  include "../../includes/session.php"; 
	include "../../includes/common.php";
  $DB=new Database($userid, $passwd, $DBName);
	$DC=new Database($userid, $passwd, $DBName);
?>	

<html>
<head>
<title>Untitled</title>
</head>
<link href="../jws.css" rel="stylesheet" type="text/css">
<body>
<!--
<font size=5 color=red>masih perbaikan... mohon dicoba sampai tulisan ini gak tampil lagi, thks</font><br>
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
<a class="verdana10blk"><b>POLIS TEBUS</b></a>
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
    $searchbydate="trunc(d.tglrekam)=trunc(sysdate) and ";
    $tglheader="Hari Ini";
		$carikurs="b.tglkursberlaku <= sysdate";
		$summary="trunc(d.tglrekam)=trunc(sysdate) ";
} elseif($vtgl=="all" && $vbln!="all"){
	  $tglsearch="$bln$vtahun";
		//$searchbydate="to_char(a.tglkonversi,'MMYYYY')='".$tglsearch."' and ";
		$searchbydate="to_char(d.tglrekam,'MMYYYY')='".$tglsearch."' and ";
		$tglheader="Bulan ".$vbulan." ".$vthn;
		$carikurs="to_char(b.tglkursberlaku,'MMYYYY') <='".$tglsearch."'";
		$summary="to_char(d.tglrekam,'MMYYYY')='".$tglsearch."' ";
} elseif($vbln=="all"){
	  $tglsearch="$vtahun";
		//$searchbydate="to_char(a.tglkonversi,'MMYYYY')='".$tglsearch."' and ";
		$searchbydate="to_char(d.tglrekam,'YYYY')='".$tglsearch."' and ";
		$tglheader="Tahun ".$vthn;
		$carikurs="to_char(b.tglkursberlaku,'YYYY') <='".$tglsearch."'";
		$summary="to_char(d.tglrekam,'YYYY')='".$tglsearch."' ";
} else {
	  $tglsearch="$tglnow$bln$vtahun";
		$searchbydate="to_char(d.tglrekam,'DDMMYYYY')='".$tglsearch."' and ";
		$tglheader="Tanggal ".$vtgl." ".$vbulan." ".$vthn;
		$carikurs="to_char(b.tglkursberlaku,'DDMMYYYY') <='".$tglsearch."'";
		$summary="to_char(d.tglrekam,'DDMMYYYY')='".$tglsearch."' ";
}

$sql = "select a.kurs ".
       "from $DBUser.tabel_999_kurs_transaksi a ".
			 "where a.kdvaluta='0' and a.tglkursberlaku=".
			       "(select max(b.tglkursberlaku) ".
			       "from  $DBUser.tabel_999_kurs_transaksi b ".
						 "where b.kdvaluta=a.kdvaluta and ".
						 "".$carikurs.")";
			 //echo "<br>".$sql."<br>";
			 $DB->parse($sql);
	     $DB->execute();
			 $ari=$DB->nextrow();
       $kursindex=$ari["KURS"];
			 //echo "<br>".$kursindex."<br>";

$sql = "select a.kurs ".
       "from $DBUser.tabel_999_kurs_transaksi a ".
			 "where a.kdvaluta='3' and a.tglkursberlaku=".
			       "(select max(b.tglkursberlaku) ".
			       "from  $DBUser.tabel_999_kurs_transaksi b ".
						 "where b.kdvaluta=a.kdvaluta and ".
						 "".$carikurs.")";
			 //echo "<br>".$sql."<br>";
			 $DB->parse($sql);
	     $DB->execute();
			 $ard=$DB->nextrow();
       $kursdolar=$ard["KURS"];
			 //echo "<br>".$kursdolar."<br>";
			 			 
$tandacabang=substr($kdkantor,-1);
$cabang=substr($kdkantor,0,1);
if(!$kdkantor){
     //$pilihankantor="a.prefixpertanggungan='".$kantor."' and ";
		 $pilihankantor="c.kdrayonpenagih='".$kantor."' and ";
		 $kdkantor=$kantor;
} else if($kdkantor=="SEMUA KANTOR"){
     $pilihankantor="";
} else if($tandacabang=="A"){
     $pilihankantor="c.kdrayonpenagih like'".$cabang."%' and ";
} else {
     $pilihankantor="c.kdrayonpenagih='".$kdkantor."' and ";
}

echo "<b><a class=verdana10blk>Polis Tebus Kantor ".$kdkantor." ".$tglheader."</a></b><br><br>";
	$sql = "select ".
	           "b.namakantor,b.kdkantor,d.nilaitebus,d.userrekam,d.userotorisasi,".
						 "a.lamaasuransi_th,to_char(a.mulas,'DD/MM/YYYY') mulas,".
	           "a.prefixpertanggungan,a.nopertanggungan,a.kdstatusmedical,a.noagen,a.kdproduk,".
						 "(select namacarabayar from $DBUser.tabel_305_cara_bayar where kdcarabayar=a.kdcarabayar) namacarabayar,".
						 "(select namaklien1 from $DBUser.tabel_100_klien where noklien=a.notertanggung) namatertanggung,".
	       		 "(select namaklien1 from $DBUser.tabel_100_klien where noklien=a.noagen) namaagen,".
	       		 "decode(a.kdvaluta,'0','RpI','1','Rp','US$') notasi,a.premi1,a.juamainproduk,".
						 "decode(d.status,'0','Pengajuan','1','Diotorisasi','2','Cetak SIP','Dibayar') status,".
				 		 //"to_char(d.tglotorisasi,'DD/MM/YY HH24:MI') tglotorisasi, ".
						 "to_char(d.tglotorisasi,'DD/MM/YYYY') tglotorisasi ".
						 //"a.userkonversi ".
				 "from ".
				     "$DBUser.tabel_200_pertanggungan a, ".
						 "$DBUser.tabel_001_kantor b, ".
						 "$DBUser.tabel_500_penagih c, ".
						 "$DBUser.tabel_700_tebus d ".
				 "where ".
				     "".$searchbydate."".
						 "".$pilihankantor."".
						 "a.nopenagih=c.nopenagih and ".
						 "a.prefixpertanggungan=d.prefixpertanggungan and ".
						 "a.nopertanggungan=d.nopertanggungan and ".
						 "d.status!='0' and ".
						 //"d.status in ('2','3') and ".
						 "b.kdkantor=a.prefixpertanggungan(+) ".
				 "order by a.prefixpertanggungan,d.tglotorisasi";
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
		 echo "<td class=arial7>NAMA AGEN</td>";
		 echo "<td class=arial7>MULAS</td>";
		 echo "<td class=arial7>KD.PRODUK</td>";
		 echo "<td class=arial7>CARABAYAR</td>";
		 echo "<td class=arial7>STT.MED</td>";
		 echo "<td class=arial7>VAL</td>";
		 echo "<td class=arial7>JUA</td>";
		 echo "<td class=arial7>PREMI</td>";
		 echo "<td class=arial7>NILAI TEBUS</td>";
		 echo "<td class=arial7>TGL.OTORISASI</td>";
		 echo "<td class=arial7>LAMA ASURANSI</td>";
		 echo "<td class=arial7>USER ACCPT</td>";
		 //echo "<td class=arial7>STATUS</td>";
		 echo "</tr>";
	$i=1;
	while ($arr=$DB->nextrow()) {
	
	   $sqlusiapol="select floor(months_between(to_date('".$arr["TGLOTORISASI"]."','DD/MM/YYYY'),to_date('".$arr["MULAS"]."','DD/MM/YYYY'))/12) usiapol_th,".
		 						 "floor(months_between(to_date('".$arr["TGLOTORISASI"]."','DD/MM/YYYY'),to_date('".$arr["MULAS"]."','DD/MM/YYYY'))) usiapol_bl1,".
								 "mod(floor(months_between(to_date('".$arr["TGLOTORISASI"]."','DD/MM/YYYY'),to_date('".$arr["MULAS"]."','DD/MM/YYYY'))),12) usiapol_bl ". 
								 "from dual";
					 $DC->parse($sqlusiapol);
	     		 $DC->execute();
			 		 $ass=$DC->nextrow();
       		 $uth=$ass["USIAPOL_TH"];
					 $ubl=$ass["USIAPOL_BL"];
					 $ubl1=$ass["USIAPOL_BL1"];
				 
	   include "../../includes/belang.php";	
		 echo "<td class=arial7>".$i."</td>";
	   echo "<td class=arial7>".$arr["KDKANTOR"]."</td>"; 
		 echo "<td class=arial7>".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."</td>";
		 echo "<td class=arial7>".$arr["NAMATERTANGGUNG"]."</td>";
		 echo "<td class=arial7>".$arr["NOAGEN"]."</td>";
		 echo "<td class=arial7>".$arr["NAMAAGEN"]."</td>";
		 echo "<td class=arial7>".$arr["MULAS"]."</td>";
		 echo "<td class=arial7>".$arr["KDPRODUK"]."/".$arr["LAMAASURANSI_TH"]." TH</td>";
		 echo "<td class=arial7>".$arr["NAMACARABAYAR"]."</td>";
		 echo "<td class=arial7 align=center>".$arr["KDSTATUSMEDICAL"]."</td>";
		 echo "<td class=arial7>".$arr["NOTASI"]."</td>";
		 echo "<td class=arial7 align=right>".number_format($arr["JUAMAINPRODUK"],2)."</td>";
		 echo "<td class=arial7 align=right>".number_format($arr["PREMI1"],2)."</td>";
		 echo "<td class=arial7 align=right>".number_format($arr["NILAITEBUS"],2)."</td>";
		 echo "<td class=arial7 align=center>".$arr["TGLOTORISASI"]."</td>";
		 echo "<td class=arial7 align=center>".$uth." TH, ".$ubl." BL</td>";
		 echo "<td class=arial7>".$arr["USEROTORISASI"]."</td>";
		 //echo "<td class=arial7>".$arr["STATUS"]."</td>";
		 echo "</tr>";
		 $i++;
	}
	echo "</table>";
	// echo $sqlusiapol;
	echo "<br><b><a class=verdana10blk>Summary</a></b>";
	$sql = "select ". 
               "decode(a.kdvaluta,'0','RUPIAH INDEX','1','RUPIAH','DOLLAR AS') namavaluta,".
        			 "a.kdvaluta,count(a.nopertanggungan) polis,".
        			 "sum(a.premi1) premi1,".
							 "sum(d.nilaitebus) premitebus,".
							 "sum(decode(a.kdvaluta,'1',d.nilaitebus,'0',d.nilaitebus/a.indexawal*".$kursindex.",'3',d.nilaitebus*".$kursdolar.")) premitebusrp ".
				 "from ".
               "$DBUser.tabel_700_tebus d,".
        			 "$DBUser.tabel_200_pertanggungan a, ".
							 "$DBUser.tabel_500_penagih c ".
         "where ".
				       "".$pilihankantor." ".
				       "".$summary." ".
        			 "and a.nopertanggungan=d.nopertanggungan ".
							 "and d.status!='0' ".
							 //"and d.status in ('2','3') ".
							 "and a.nopenagih=c.nopenagih ".
         "group by a.kdvaluta";
	/*			
	$sql = "select ".
	       "decode(a.kdvaluta,'0','RUPIAH INDEX','1','RUPIAH','DOLLAR AS') namavaluta,".
	       "a.kdvaluta,count(a.nopertanggungan) polis,sum(a.premi1) premi1,sum(b.nilairp) premirp ".
				 "from ".
				 "$DBUser.tabel_300_historis_premi b,$DBUser.tabel_200_pertanggungan a ".
				 "where ".
				 "".$pilihankantor." ".
				 "".$summary." ".
				 "and b.kdkuitansi='BP3' and ".
				 "a.nopertanggungan=b.nopertanggungan ".
				 "group by a.kdvaluta";
  */
				 //echo "<br>".$sql."<br>";
	
	$DB->parse($sql);
	$DB->execute();
	echo "<table width=600>";
	   echo "<tr bgcolor=#78bdd8>";
		 echo "<td class=verdana7blk align=center>VALUTA</td>"; 
		 echo "<td class=verdana7blk align=center>JML. POLIS</td>"; 
		 echo "<td class=verdana7blk align=center>NILAI TEBUS</td>";
		 echo "<td class=verdana7blk align=center>NILAI TEBUS (RP)</td>";
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
		 $prerp=$ark["PREMITEBUSRP"];
	   include "../../includes/belang.php";	
	   echo "<td class=verdana7blk>".$ark["NAMAVALUTA"]."</td>"; 
		 echo "<td class=verdana7blk align=right>".$ark["POLIS"]."</td>"; 
		 echo "<td class=verdana7blk align=right>".number_format($ark["PREMITEBUS"],2)."</td>";
		 //echo "<td class=verdana7blk>".$kursvaluta."</td>"; 
		 echo "<td class=verdana7blk align=right>".number_format($ark["PREMITEBUSRP"],2)."</td>";
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
