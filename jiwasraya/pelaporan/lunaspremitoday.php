<? 
  include "../../includes/database.php"; 
  include "../../includes/session.php"; 
	include "../../includes/common.php";
	include "../../includes/pertanggungan.php";
	
  $DB=new Database($userid, $passwd, $DBName);
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
	//echo "<option value=\"all\">-</option>";
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

<a class="verdana10blk"><b>PELUNASAN PREMI PRODUK ASTHA PLUS  DAN DWIGUNA IDAMAN</b></a>
<hr size="1">
    <table>
    <form name="date" action="<? PHP_SEFT ?>"> 
    <tr>
		<td class="verdana10blk">Tanggal  <? DateSelector("v"); ?></td>
		<td><input type="submit" value="CARI" name="cari"></td>
    </form> 
    </tr>
		</table>

<?
if ($cari){
?>

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
          	   "a.prefixpertanggungan,a.nopertanggungan,".
							 "to_char(b.mulas,'DD/MM/YYYY') tglmulas,".
							 "to_char(b.expirasi,'DD/MM/YYYY') tglexpirasi,".
							 "to_char(a.tglbooked,'DD/MM/YYYY') tglbooked,".
							 "to_char(a.tglseatled,'DD/MM/YYYY') tglseatled,".
							 "to_char(a.tglbayar,'DD/MM/YYYY') tglbayar,".
							 "b.kdproduk,b.juamainproduk,a.premitagihan,a.nilairp,a.buktisetor,a.kdvaluta,a.kdkuitansi ".
          "from ".
          	   "$DBUser.tabel_300_historis_premi a,".
          	   "$DBUser.tabel_200_pertanggungan b,".
          	   "$DBUser.tabel_500_penagih c ".
          "where ".
          	   "a.prefixpertanggungan=b.prefixpertanggungan and ".
          	   "a.nopertanggungan=b.nopertanggungan and ".
          	   "b.nopenagih=c.nopenagih and ".
          	   "c.kdrayonpenagih='$kantor' and ".
          	   "to_char(a.tglseatled,".$summary." and ".
          	   "b.kdproduk in ('DGI','ATP')";
							 
		 		 $DB->parse($sql);
				 $DB->execute();
				 //echo "<br>".$sql."<br>";
	echo "<a class=verdana10blk><b>Pelunasan Premi ".$tglheader." ".$judul."</b></a>";
	echo "<table cellpadding=\"1\" cellspacing=\"1\">";
	?>

  <tr bgcolor="#78bdd8">
    <td align="center" class="verdana7blk">No.</td>
    <td align="center" class="verdana7blk">No.Pertg</td>
    <td align="center" class="verdana7blk">Pemegang Polis</td>
		<td align="center" class="verdana7blk">Produk</td>
    <td align="center" class="verdana7blk">Tgl.Mulas</td>
    <td align="center" class="verdana7blk">Tgl.Expirasi</td>
    <td align="center" class="verdana7blk">Tgl.Booked</td>
    <td align="center" class="verdana7blk">Tgl.Stld</td>
    <td align="center" class="verdana7blk">Tgl.Bayar</td>
    <td align="center" class="verdana7blk">JUA</td>
    <td align="center" class="verdana7blk">Premi</td>
    <td align="center" class="verdana7blk">Valuta</td>
    <td align="center" class="verdana7blk">Kwt.</td>
    <td align="center" class="verdana7blk">Bukti Setor</td>
  </tr>
	<?
	$i=1;
	while ($ark=$DB->nextrow()) {
	   $PER=new Pertanggungan($userid,$passwd,$ark["PREFIXPERTANGGUNGAN"],$ark["NOPERTANGGUNGAN"]);
	   include "../../includes/belang.php";	
		 echo "<td class=verdana7blk>".$i."</td>"; 
	   echo "<td class=verdana7blk>".$ark["PREFIXPERTANGGUNGAN"]."-".$ark["NOPERTANGGUNGAN"]."</td>"; 
		 echo "<td class=verdana7blk>".$PER->namapemegangpolis."</td>"; 
		 echo "<td class=verdana7blk align=center>".$ark["KDPRODUK"]."</td>"; 
		 echo "<td class=verdana7blk align=right>".$ark["TGLMULAS"]."</td>";
		 echo "<td class=verdana7blk align=right>".$ark["TGLEXPIRASI"]."</td>";
		 echo "<td class=verdana7blk align=right>".$ark["TGLBOOKED"]."</td>";
		 echo "<td class=verdana7blk align=right>".$ark["TGLSEATLED"]."</td>"; 
		 echo "<td class=verdana7blk align=right>".$ark["TGLBAYAR"]."</td>";
		 echo "<td class=verdana7blk align=right>".number_format($PER->jua,2)."</td>"; 
		 echo "<td class=verdana7blk align=right>".number_format($ark["PREMITAGIHAN"],2)."</td>"; 
		 echo "<td class=verdana7blk>".$PER->notasi."</td>";
		 echo "<td class=verdana7blk align=right>".$ark["KDKUITANSI"]."</td>";
		 echo "<td class=verdana7blk align=right>".$ark["BUKTISETOR"]."</td>";
		 echo "</tr>";
		 $i++;
	}
	echo "</table>";
?>
<br><br>
</div>
<?
}
?>
<hr size="1">
<a href="index.php" class="verdana10blk">Back</a>
</body>
</html>
