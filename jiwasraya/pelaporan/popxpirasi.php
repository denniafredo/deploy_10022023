<? 
  include "../../includes/database.php"; 
  include "../../includes/session.php"; 
	include "../../includes/common.php";
  $DB=new Database($userid, $passwd, $DBName);

	$thn=substr($awalxpr,-4);
	$xpawal=substr($awalxpr,0,2);
	$xpakhir=substr($akhirxpr,0,2);
?>	
<html>
<head>
<title>Polis Expirasi</title>
</head>
<link href="../jws.css" rel="stylesheet" type="text/css">
<body>
<a class="verdana10blk"><b>POLIS EXPIRASI</b></a>
<hr size="1">
<div align="center">
<?
switch ($xpawal) {
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

switch ($xpakhir) {
   case "01":  $vbulanakhir = "Januari"; break;
   case "02":  $vbulanakhir = "Pebruari"; break;
   case "03":  $vbulanakhir = "Maret"; break;
   case "04":  $vbulanakhir = "April"; break;
   case "05":  $vbulanakhir = "Mei"; break;
   case "06":  $vbulanakhir = "Juni"; break;
   case "07":  $vbulanakhir = "Juli"; break;
   case "08":  $vbulanakhir = "Agustus"; break;
   case "09":  $vbulanakhir = "September"; break;					
   case "10":  $vbulanakhir = "Oktober"; break;
   case "11":  $vbulanakhir = "Nopember"; break;
   case "12":  $vbulanakhir = "Desember"; break;										
}

echo "<b><a class=verdana10blk>Polis Expirasi Produk ".$kdproduk." Kantor ".$kdkantor." Bulan ".$vbulan." S/D ".$vbulanakhir." ".$thn."</a></b><br><br>";
	 if($kdvaluta==""){
	   $getvaluta="a.kdvaluta in ('0','1','3')";
	 } else {
	   $getvaluta="a.kdvaluta='$kdvaluta'";
	 }
   $sql = "select ".
          	"a.prefixpertanggungan,a.nopertanggungan,to_char(a.mulas,'DD/MM/YYYY') mulas,".
						"to_char(a.expirasi,'DD/MM/YYYY') expirasi,".
						"a.kdstatusmedical,decode(a.kdvaluta,'0','RpI','1','Rp','US$') notasi,".
						"a.premi1,a.juamainproduk,".
						"(select userupdated from $DBUser.tabel_214_acceptance_dokumen where nopertanggungan=a.nopertanggungan) useraksep,".
						"to_char(a.tglkonversi,'DD/MM/YY HH24:MI') jamkonversi,a.userkonversi,".
						"(select namaklien1 from $DBUser.tabel_100_klien where noklien=a.noagen) namaagen,".
          	"(select namaklien1 from $DBUser.tabel_100_klien where noklien=a.notertanggung) namatertanggung,".
          	"(select namacarabayar from $DBUser.tabel_305_cara_bayar where kdcarabayar=a.kdcarabayar) namacarabayar,".
						"a.kdproduk,a.kdvaluta,a.kdcarabayar,".
          	"a.premi1,".
						"c.kdrayonpenagih ".
          "from ".
          	"$DBUser.tabel_200_pertanggungan a, ".
						"$DBUser.tabel_500_penagih c ".
          "where ".
						"a.nopenagih=c.nopenagih and ".
 						"a.kdstatusfile='1' and ".
						"a.kdpertanggungan='2' and ".
						"a.kdproduk='$kdproduk' and ".
						"c.kdrayonpenagih='$kdkantor' and ".
						"a.expirasi between to_date('$awalxpr','MMYYYY') and to_date('$akhirxpr','MMYYYY') and ".
						"$getvaluta";
		
				 $DB->parse($sql);
				 $DB->execute();
				 //echo "<br>".$sql."<br>";

  echo "<table>"; 
		 echo "<tr bgcolor=#78bdd8>"; 
		 echo "<td class=arial7>NO.</td>";
		 echo "<td class=arial7>KTR</td>";
	   echo "<td class=arial7>NO.PERTANG</td>";
		 echo "<td class=arial7>TERTANGGUNG</td>";
		 echo "<td class=arial7>AGEN</td>";
		 echo "<td class=arial7>MULAS</td>";
		 echo "<td class=arial7>KD.PRODUK</td>";
		 echo "<td class=arial7>CARABAYAR</td>";
		 echo "<td class=arial7>STT.MED</td>";
		 echo "<td class=arial7>VAL</td>";
		 echo "<td class=arial7>JUA</td>";
		 echo "<td class=arial7>PREMI</td>";
		 echo "<td class=arial7>TGL.EXPIRASI</td>";
		 echo "</tr>";
	$i=1;
	while ($arr=$DB->nextrow()) {
	   include "../../includes/belang.php";	
		 echo "<td class=arial7>".$i."</td>";
	   echo "<td class=arial7>".$arr["KDRAYONPENAGIH"]."</td>"; 
		 echo "<td class=arial7>".$arr["PREFIXPERTANGGUNGAN"]."-".$arr["NOPERTANGGUNGAN"]."</td>";
		 echo "<td class=arial7>".$arr["NAMATERTANGGUNG"]."</td>";
		 echo "<td class=arial7>".$arr["NAMAAGEN"]."</td>";
		 echo "<td class=arial7>".$arr["MULAS"]."</td>";
		 echo "<td class=arial7 align=center>".$arr["KDPRODUK"]."</td>";
		 echo "<td class=arial7>".$arr["NAMACARABAYAR"]."</td>";
		 echo "<td class=arial7 align=center>".$arr["KDSTATUSMEDICAL"]."</td>";
		 echo "<td class=arial7>".$arr["NOTASI"]."</td>";
		 echo "<td class=arial7 align=right>".number_format($arr["JUAMAINPRODUK"],2)."</td>";
		 echo "<td class=arial7 align=right>".number_format($arr["PREMI1"],2)."</td>";
		 echo "<td class=arial7 align=center>".$arr["EXPIRASI"]."</td>";
		 echo "</tr>";
		 $i++;
	}
	echo "</table>";
?>
<br><br>
</div>
<hr size="1">
<a href="javascript:window.close();" class="verdana10blk">Close</a>
</body>
</html>
