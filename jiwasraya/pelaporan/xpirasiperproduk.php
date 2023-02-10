<? 
  include "../../includes/database.php"; 
  include "../../includes/session.php"; 
	include "../../includes/common.php";
  $DB=new Database($userid, $passwd, $DBName);
	
	function DateSelector($inName, $useDate=0) { 
	$monthName=array(1=>"Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"); 
	if ($useDate==0) { 
		$useDate=Time(); 
	} 
	// make year selector 
	print("<select name=".$inName."thn>\n"); 
	$startYear=date("Y", $useDate); 
	for ($currentYear=$startYear-5; $currentYear<=$startYear+5;$currentYear++) {
		print("<option value=\"$currentYear\""); 
		if (date("Y", $useDate)==$currentYear) { 
			print(" selected"); 
		} 
		print(">$currentYear\n"); 
	} 
	print("</select>"); 
 } 
?>	

<html>
<head>
<title>Untitled</title>
</head>
<link href="../jws.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="../../includes/window.js" ></script>
<body>
<a class="verdana10blk"><b>EXPIRASI POLIS PER PRODUK</b></a>
<hr size="1">
    <table>
    <form name="date" action="<? PHP_SEFT ?>"> 
    <tr>
    <td class="verdana10blk">Cari Kantor 
		<select name="kdkantor" class="c">
    <option value="XXX">-- PILIH KANTOR --</option>
		<?
		  $sqa="select kdkantor,namakantor from $DBUser.tabel_001_kantor where kdjeniskantor in ('2') order by kdkantor";
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
		<td class="verdana10blk">
		Expirasi Bulan
		<? 
		switch($awalxpr){
		  case "01": $a1="selected"; break;
			case "02": $a2="selected"; break;
			case "03": $a3="selected"; break;
			case "04": $a4="selected"; break;
			case "05": $a5="selected"; break;
			case "06": $a6="selected"; break;
			case "07": $a7="selected"; break;
			case "08": $a8="selected"; break;
			case "09": $a9="selected"; break;
			case "10": $a10="selected"; break;
			case "11": $a11="selected"; break;
			case "12": $a12="selected"; break;
		}
		switch($akhirxpr){
		  case "01": $b1="selected"; break;
			case "02": $b2="selected"; break;
			case "03": $b3="selected"; break;
			case "04": $b4="selected"; break;
			case "05": $b5="selected"; break;
			case "06": $b6="selected"; break;
			case "07": $b7="selected"; break;
			case "08": $b8="selected"; break;
			case "09": $b9="selected"; break;
			case "10": $b10="selected"; break;
			case "11": $b11="selected"; break;
			case "12": $b12="selected"; break;
		}
		 ?>
		<select name="awalxpr" size="1">
		  <option value="01" <?=$a1;?>>Januari</option>
			<option value="02" <?=$a2;?>>Februari</option>
			<option value="03" <?=$a3;?>>Maret</option>
			<option value="04" <?=$a4;?>>April</option>
			<option value="05" <?=$a5;?>>Mei</option>
			<option value="06" <?=$a6;?>>Juni</option>
			<option value="07" <?=$a7;?>>Juli</option>
			<option value="08" <?=$a8;?>>Agustus</option>
			<option value="09" <?=$a9;?>>September</option>
			<option value="10" <?=$a10;?>>Oktober</option>
			<option value="11" <?=$a11;?>>November</option>
			<option value="12" <?=$a12;?>>Desember</option>
		</select>
		S / D
		<select name="akhirxpr" size="1">
		  <option value="01" <?=$b1;?>>Januari</option>
			<option value="02" <?=$b2;?>>Februari</option>
			<option value="03" <?=$b3;?>>Maret</option>
			<option value="04" <?=$b4;?>>April</option>
			<option value="05" <?=$b5;?>>Mei</option>
			<option value="06" <?=$b6;?>>Juni</option>
			<option value="07" <?=$b7;?>>Juli</option>
			<option value="08" <?=$b8;?>>Agustus</option>
			<option value="09" <?=$b9;?>>September</option>
			<option value="10" <?=$b10;?>>Oktober</option>
			<option value="11" <?=$b11;?>>November</option>
			<option value="12" <?=$b12;?>>Desember</option>
		</select>
		 <? DateSelector("v"); ?></td>
		<td><input type="submit" value="CARI" name="cari"></td>
    </form> 
    </tr>
		</table>
		
<hr size="1">
<div align="center">
<?
      
      switch ($awalxpr) {
         case "01":  $vbulanawal = "Januari"; break;
         case "02":  $vbulanawal = "Pebruari"; break;
         case "03":  $vbulanawal = "Maret"; break;
         case "04":  $vbulanawal = "April"; break;
         case "05":  $vbulanawal = "Mei"; break;
         case "06":  $vbulanawal = "Juni"; break;
         case "07":  $vbulanawal = "Juli"; break;
         case "08":  $vbulanawal = "Agustus"; break;
         case "09":  $vbulanawal = "September"; break;					
         case "10":  $vbulanawal = "Oktober"; break;
         case "11":  $vbulanawal = "Nopember"; break;
         case "12":  $vbulanawal = "Desember"; break;										
      }
      
      switch ($akhirxpr) {
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

		  $sql= "select ".
            "b.kdrayonpenagih,a.kdproduk,count(a.nopertanggungan) jmlpolis,".
						"c.namaproduk,".
          	"x.jmlpolisrp,x.juarp,".
          	"y.jmlpolisusd,y.juausd,".
          	"z.jmlpolisrpi,z.juarpi ".
          "from ".
            "$DBUser.tabel_200_pertanggungan a,".
          	"$DBUser.tabel_500_penagih b,".
						"$DBUser.tabel_202_produk c, ".
          	"(select ".
          	   "s.kdproduk,sum(s.juamainproduk) as juarp,count(s.nopertanggungan) jmlpolisrp ".
          	 "from ".
          	   "$DBUser.tabel_200_pertanggungan s,".
          	   "$DBUser.tabel_500_penagih t ".
          	 "where ".
          	   "s.nopenagih=t.nopenagih and ".
          	   "s.kdvaluta='1' and ".
          	   "s.kdstatusfile='1' and ".
          	   "s.kdpertanggungan='2' and ".
          	   "t.kdrayonpenagih='$kdkantor' and ".
							 "s.expirasi between to_date('$awalxpr$vthn','MMYYYY') and to_date('$akhirxpr$vthn', 'MMYYYY') ".
          	 "group by s.kdproduk) x, ".
          	 
          	 "(select ".
          	   "s.kdproduk,sum(s.juamainproduk) as juausd,count(s.nopertanggungan) jmlpolisusd ".
          	 "from ".
          	   "$DBUser.tabel_200_pertanggungan s,".
          	   "$DBUser.tabel_500_penagih t ".
          	 "where ".
          	   "s.nopenagih=t.nopenagih and ".
          	   "s.kdvaluta='3' and ".
          	   "s.kdstatusfile='1' and ".
          	   "s.kdpertanggungan='2' and ".
          	   "t.kdrayonpenagih='$kdkantor' and ".
							 "s.expirasi between to_date('$awalxpr$vthn','MMYYYY') and to_date('$akhirxpr$vthn', 'MMYYYY') ".
          	 "group by s.kdproduk) y,".
          	 
          	 "(select ".
          	   "s.kdproduk,sum(s.juamainproduk) as juarpi,count(s.nopertanggungan) jmlpolisrpi ".
          	 "from ".
          	   "$DBUser.tabel_200_pertanggungan s,".
          	   "$DBUser.tabel_500_penagih t ".
          	 "where ".
          	   "s.nopenagih=t.nopenagih and ".
          	   "s.kdvaluta='0' and ".
          	   "s.kdstatusfile='1' and ".
          	   "s.kdpertanggungan='2' and ".
          	   "t.kdrayonpenagih='$kdkantor' and ".
							 "s.expirasi between to_date('$awalxpr$vthn','MMYYYY') and to_date('$akhirxpr$vthn', 'MMYYYY') ".
          	 "group by s.kdproduk) z ".
          	 
          "where ".
          	"a.nopenagih=b.nopenagih and ".
						"a.kdproduk=c.kdproduk and ".
          	"a.kdstatusfile='1' and ".
          	"a.kdpertanggungan='2' and ".
          	"b.kdrayonpenagih='$kdkantor' and ".
          	"a.kdproduk=x.kdproduk(+) and ".
            "a.kdproduk=y.kdproduk(+) and ".
          	"a.kdproduk=z.kdproduk(+) and ".
						"a.expirasi between to_date('$awalxpr$vthn','MMYYYY') and to_date('$akhirxpr$vthn', 'MMYYYY') ".
          "group by ".
            "b.kdrayonpenagih,a.kdproduk,c.namaproduk,".
          	"x.jmlpolisrp,x.juarp,".
          	"y.jmlpolisusd,y.juausd,".
          	"z.jmlpolisrpi,z.juarpi";
						
				 $DB->parse($sql);
				 $DB->execute();
				 //echo "<br>".$sql."<br>";

	echo "<a class=verdana10blk><b>Polis Expirasi Kantor $kdkantor Bulan $vbulanawal S/D $vbulan Tahun $vthn</b></a>";
	echo "<table cellpadding=\"1\" cellspacing=\"1\">";
	?>
	<tr bgcolor="#78bdd8">
    <td rowspan="2" align="center" class="verdana7blk">NO.</td>
    <td colspan="2" align="center" class="verdana7blk">PRODUK</td>
    <td colspan="2" align="center" class="verdana7blk">RUPIAH</td>
    <td colspan="2" align="center" class="verdana7blk">RUPIAH INDEX</td>
    <td colspan="2" align="center" class="verdana7blk">US DOLAR</td>
    <td rowspan="2" align="center" class="verdana7blk">TOTAL</td>
  </tr>
  <tr bgcolor="#78bdd8">
    <td align="center" class="verdana7blk">KD</td>
    <td align="center" class="verdana7blk">NAMA</td>
    <td align="center" class="verdana7blk">JML</td>
    <td align="center" class="verdana7blk">JUA</td>
    <td align="center" class="verdana7blk">JML</td>
    <td align="center" class="verdana7blk">JUA</td>
    <td align="center" class="verdana7blk">JML</td>
    <td align="center" class="verdana7blk">JUA</td>
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
		 $prerp=$ark["JUARP"];
		 $prerup=$ark["JUARP"];
		 $preusd=$ark["JUAUSD"];
		 $preidx=$ark["JUARPI"];
		 
		 $jmlrp=$ark["JMLPOLISRP"];
		 $jmlusd=$ark["JMLPOLISUSD"];
		 $jmlidx=$ark["JMLPOLISRPI"];
		 
		 $pol=$ark["JMLPOLIS"];
		 $xjmlpol=$jmlrp + $jmlusd + $jmlidx;
	   //include "../../includes/belang.php";	
		 if($i%2){
		 echo "<tr>";
		 }else{
		 echo "<tr bgcolor=#cccccc>";
		 }
		 echo "<td class=verdana7blk>".$i."</td>"; 
	   echo "<td class=verdana7blk>".$ark["KDPRODUK"]."</td>"; 
		 echo "<td class=verdana7blk><a href=\"#\" onclick=\"NewWindow('popxpirasi.php?awalxpr=$awalxpr$vthn&akhirxpr=$akhirxpr$vthn&kdkantor=$kdkantor&kdproduk=".$ark["KDPRODUK"]."','popuppage','850','300','yes')\">".$ark["NAMAPRODUK"]."</a></td>"; 
		 echo "<td class=verdana7blk align=right><a href=\"#\" onclick=\"NewWindow('popxpirasi.php?awalxpr=$awalxpr$vthn&akhirxpr=$akhirxpr$vthn&kdkantor=$kdkantor&kdproduk=".$ark["KDPRODUK"]."&kdvaluta=1','popuppage','850','300','yes')\">".($ark["JMLPOLISRP"]=='' ? 0 : $ark["JMLPOLISRP"])."</a></td>"; 
		 echo "<td class=verdana7blk align=right>".number_format($ark["JUARP"],2)."</td>";
		 echo "<td class=verdana7blk align=right><a href=\"#\" onclick=\"NewWindow('popxpirasi.php?awalxpr=$awalxpr$vthn&akhirxpr=$akhirxpr$vthn&kdkantor=$kdkantor&kdproduk=".$ark["KDPRODUK"]."&kdvaluta=0','popuppage','850','300','yes')\">".($ark["JMLPOLISRPI"]=='' ? 0 : $ark["JMLPOLISRPI"])."</a></td>"; 
		 echo "<td class=verdana7blk align=right>".number_format($ark["JUARPI"],2)."</td>";
		 echo "<td class=verdana7blk align=right><a href=\"#\" onclick=\"NewWindow('popxpirasi.php?awalxpr=$awalxpr$vthn&akhirxpr=$akhirxpr$vthn&kdkantor=$kdkantor&kdproduk=".$ark["KDPRODUK"]."&kdvaluta=3','popuppage','850','300','yes')\">".($ark["JMLPOLISUSD"]=='' ? 0 : $ark["JMLPOLISUSD"])."</a></td>"; 
		 echo "<td class=verdana7blk align=right>".number_format($ark["JUAUSD"],2)."</td>";
		 echo "<td class=verdana7blk align=right><a href=\"#\" onclick=\"NewWindow('popxpirasi.php?awalxpr=$awalxpr$vthn&akhirxpr=$akhirxpr$vthn&kdkantor=$kdkantor&kdproduk=".$ark["KDPRODUK"]."','popuppage','850','300','yes')\">".($ark["JMLPOLIS"]=='' ? 0 : $ark["JMLPOLIS"])."</a></td>";
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
		 echo "</tr>";
	echo "</table>";
?>
<br><br>
</div>
<hr size="1">
<a href="index.php" class="verdana10blk">Back</a>
</body>
</html>
