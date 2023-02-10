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
	
?>
<style type="text/css">
<!-- 
td {
 font-family: Verdana;
 font-size: 10px;
} 
-->
</style>
<script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>
	<table border="1" style="border-collapse: collapse" id="table1" cellpadding="4">
	<tr>
		<td bgcolor="#3366CC"><font color="#FFFFFF">No.Polis</font></td>
		<td bgcolor="#3366CC"><font color="#FFFFFF">No.Tertg</font></td>
		<td bgcolor="#3366CC"><font color="#FFFFFF">No.Pemeg.Pol</font></td>
		<td bgcolor="#3366CC"><font color="#FFFFFF">No.Pby.Premi</font></td>
		<!--<td bgcolor="#3366CC"><font color="#FFFFFF">Nama Tertanggung</font></td>-->
		<td bgcolor="#3366CC"><font color="#FFFFFF">No.Klien Ins</font></td>
		<td bgcolor="#3366CC"><font color="#FFFFFF">Jml.Polis Insrb</font></td>
	</tr>
	<? 
   $sql = "SELECT ".      
               "a.prefixpertanggungan, a.nopertanggungan, a.notertanggung,a.nopemegangpolis,a.nopembayarpremi,".
               "a.kdproduk, a.premi1,a.lamaasuransi_th, TO_CHAR (a.mulas, 'DD/MM/YYYY') mulas,".
               "a.juamainproduk,d.nilaitebus,b.noklien as noklientertanggung,".
      				 "(select count(1) from $DBUser.tabel_200_pertanggungan ".
      					"where ".
      					"prefixpertanggungan=a.prefixpertanggungan ".
      					"and nopertanggungan=a.nopertanggungan ".
      					"and notertanggung=b.noklien) as jmlpolisklientertanggung ".
         "FROM ".
      	 	 "$DBUser.tabel_219_pemegang_polis_baw b,".
      		 "$DBUser.tabel_200_pertanggungan a,".
           "$DBUser.tabel_700_tebus d,".
      		 "$DBUser.tabel_500_penagih c ".
         "WHERE ".
           "a.notertanggung=b.notertanggung ".
           "AND a.nopenagih = c.nopenagih ".
           "AND a.prefixpertanggungan = d.prefixpertanggungan ".
           "AND a.nopertanggungan = d.nopertanggungan AND ".
      	 	 //"AND TO_CHAR (d.tglrekam, 'MMYYYY') = '052006' ".
					 "".$searchbydate." ".
           "d.status != '0' ".
         "ORDER BY a.prefixpertanggungan,a.nopertanggungan ";

  
				 //echo "<br>".$sql."<br>";
	$DB->parse($sql);
	$DB->execute();
  while ($arr=$DB->nextrow()) {
	
	//if($arr["JMLPOLISKLIENTERTANGGUNG"]<>0)
	//{
	echo ($i%2)? "<tr bgcolor=#dceff5>" : "<tr>";
	//$KLN = new Klien($userid,$passwd,$arr["NOTERTANGGUNG"]);
	//$KLN2 = new Klien($userid,$passwd,$arr["NOKLIENTERTANGGUNG"]);
	?>
		<td>
  		<?
			if($prevnopol<>$arr["NOPERTANGGUNGAN"])
			{
  		echo $arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"];
			}
  		?>
		</td>
		<td><?
		  if($prevnotertanggung<>$arr["NOTERTANGGUNG"]) {
		   echo "<a href=\"#\" onclick=\"NewWindow('detilpolisklien.php?noklien=".$arr["NOTERTANGGUNG"]."&kdproduk=$kdproduk&vthn=$vthn','popuppage','1000','300','yes')\">".$arr["NOTERTANGGUNG"]."</a>"; }
			 ?></td>
		<td><?
		  if($prevnopmgpolis<>$arr["NOPEMEGANGPOLIS"]){
			 echo "<a href=\"#\" onclick=\"NewWindow('detilpolisklien.php?noklien=".$arr["NOPEMEGANGPOLIS"]."&kdproduk=$kdproduk&vthn=$vthn','popuppage','1000','300','yes')\">".$arr["NOPEMEGANGPOLIS"]."</a>";}?></td>
		<td><?
		  if($prevnopmypremi<>$arr["NOPEMBAYARPREMI"]) {
			 echo "<a href=\"#\" onclick=\"NewWindow('detilpolisklien.php?noklien=".$arr["NOPEMBAYARPREMI"]."&kdproduk=$kdproduk&vthn=$vthn','popuppage','1000','300','yes')\">".$arr["NOPEMBAYARPREMI"]."</a>";}
			?></td>
		<?
		/*
		 if($prevnamattg<>$KLN->nama){
		   echo $KLN->nama;}
			 */?>
		<td><?=$arr["NOKLIENTERTANGGUNG"];?></td>
		
		<td align="right"><?="<a href=\"#\" onclick=\"NewWindow('detilpolisklien.php?noklien=".$arr["NOKLIENTERTANGGUNG"]."&kdproduk=$kdproduk&vthn=$vthn','popuppage','1000','300','yes')\">";?><?=$arr["JMLPOLISKLIENTERTANGGUNG"];?></a></td>
	</tr>
	<? 
	$prevnopol 				 = $arr["NOPERTANGGUNGAN"];
	$prevnotertanggung = $arr["NOTERTANGGUNG"];
	$prevnopmgpolis		 = $arr["NOPEMEGANGPOLIS"];
	$prevnopmypremi		 = $arr["NOPEMBAYARPREMI"];
	$prevnamattg			 = $KLN->nama;
	}
	//}
	?>

</table>

	
<br><br>
</div>
<hr size="1">
<a href="index.php" class="verdana10blk">Back</a>
</body>
</html>
