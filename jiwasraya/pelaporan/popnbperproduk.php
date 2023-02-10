<? 
  include "../../includes/database.php"; 
  include "../../includes/session.php"; 
	include "../../includes/common.php";
  $DB=new Database($userid, $passwd, $DBName);
?>	

<html>
<head>
<title>PENERIMAAN PREMI</title>
</head>
<link href="../jws.css" rel="stylesheet" type="text/css">
<body>


<a class="verdana10blk"><b>PENERIMAAN PREMI</b></a>
<hr size="1">
<div align="center">
<!------------------------------ End date selector ---------------------------->
<?

$dijit=strlen($tglsearch);
if($dijit==4){
		 $searchbydate="to_char(a.mulas,'YYYY')='".$tglsearch."' ";
		 $tgltitle="Tahun ".$tglsearch;
} elseif($dijit==6){
     $bln=substr($tglsearch,0,2);
		 $tahun=substr($tglsearch,-4);
     $searchbydate="to_char(a.mulas,'MMYYYY')='".$tglsearch."' ";
		 $tgltitle="Bulan ".$bln." ".$tahun;
} else {
     $tgl=substr($tglsearch,0,2);
		 $bln=substr($tglsearch,2,2);
		 $tahun=substr($tglsearch,-4);
     $searchbydate="to_char(a.mulas,'DDMMYYYY')='".$tglsearch."' ";
		 $tgltitle="Tanggal ".$tgl." ".$bln." ".$tahun;
}

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

			 			 
$tandacabang=substr($kdkantor,-1);
$cabang=substr($kdkantor,0,1);
if(!$kdkantor){
     $pilihankantor="c.kdrayonpenagih='".$kantor."' ";
		 $kdkantor=$kantor;
} elseif($kdkantor=="ALL"){
     $pilihankantor="c.kdrayonpenagih like '%%' ";
} else {
     $pilihankantor="c.kdrayonpenagih='".$kdkantor."' ";
}

echo "<b><a class=verdana10blk>Penerimaan Premi NB Produk ".$kdproduk." ".$tgl." ".$vbulan." ".$tahun." Kantor $kdkantor</a></b><br><br>";
	
   $sql = "select ".
          	"a.prefixpertanggungan,a.nopertanggungan,to_char(a.mulas,'DD/MM/YYYY') mulas,".
						"to_char(a.expirasi,'DD/MM/YYYY') expirasi,".
						"a.kdstatusmedical,decode(a.kdvaluta,'0','RpI','1','Rp','US$') notasi,".
						"a.premi1,a.premi2,a.juamainproduk,a.lamapembpremi_th,a.lamapembpremi_bl,".
						"(select userupdated from $DBUser.tabel_214_acceptance_dokumen where nopertanggungan=a.nopertanggungan) useraksep,".
						"to_char(a.tglkonversi,'DD/MM/YY HH24:MI') jamkonversi,a.userkonversi,".
						"(select namaklien1 from $DBUser.tabel_100_klien where noklien=a.noagen) namaagen,".
          	"(select namaklien1 from $DBUser.tabel_100_klien where noklien=a.notertanggung) namatertanggung,".
          	"(select namacarabayar from $DBUser.tabel_305_cara_bayar where kdcarabayar=a.kdcarabayar) namacarabayar,".
						"a.kdproduk,a.kdvaluta,a.kdcarabayar,".
          	"a.premi1,b.nilairp,b.tglbooked, ".
						"c.kdrayonpenagih ".
          "from ".
          	"$DBUser.tabel_300_historis_premi b,".
          	"$DBUser.tabel_200_pertanggungan a, ".
						"$DBUser.tabel_500_penagih c ".
          "where ".
          	"a.prefixpertanggungan=b.prefixpertanggungan and ".
          	"a.nopertanggungan=b.nopertanggungan and ".
						"a.nopenagih=c.nopenagih and ".
          	"b.kdkuitansi in ('BP3','NB1') and ".
						$pilihankantor." and ".
          	"b.nilairp is not null and ". 
						$searchbydate." ".
						"and a.kdproduk='$kdproduk'";

				 $DB->parse($sql);
				 $DB->execute();
				 //echo "<br>".$sql."<br>";

  echo "<table>"; 
		 echo "<tr bgcolor=#78bdd8>"; 
		 echo "<td class=arial7>NO.</td>";
		 echo "<td class=arial7>KTR</td>";
	   echo "<td class=arial7>NO.PERTANG</td>";
		 echo "<td class=arial7>TERTANGGUNG</td>";
		 echo "<td class=arial7>NO.AGEN</td>";
		 echo "<td class=arial7>MULAS</td>";
		 echo "<td class=arial7>EXPIRASI</td>";
		 echo "<td class=arial7>KD.PRODUK</td>";
		 echo "<td class=arial7>CARABAYAR</td>";
		 echo "<td class=arial7>STT.MED</td>";
		 echo "<td class=arial7>VAL</td>";
		 echo "<td class=arial7>JUA</td>";
		 echo "<td class=arial7>PREMI1</td>";
		 echo "<td class=arial7>PREMI2</td>";
		 echo "<td class=arial7>MASA PREMI</td>";
		 echo "<td class=arial7>TGL.KONV.(WIB)</td>";
		 echo "<td class=arial7>USER ACCPT</td>";
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
		 echo "<td class=arial7>".$arr["EXPIRASI"]."</td>";
		 echo "<td class=arial7 align=center>".$arr["KDPRODUK"]."</td>";
		 echo "<td class=arial7>".$arr["NAMACARABAYAR"]."</td>";
		 echo "<td class=arial7 align=center>".$arr["KDSTATUSMEDICAL"]."</td>";
		 echo "<td class=arial7>".$arr["NOTASI"]."</td>";
		 echo "<td class=arial7 align=right>".number_format($arr["JUAMAINPRODUK"],2)."</td>";
		 echo "<td class=arial7 align=right>".number_format($arr["PREMI1"],2)."</td>";
		 echo "<td class=arial7 align=right>".number_format($arr["PREMI2"],2)."</td>";
		 echo "<td class=arial7 align=center>".$arr["LAMAPEMBPREMI_TH"]." th ".$arr["LAMAPEMBPREMI_BL"]." bl</td>";
		 echo "<td class=arial7 align=center>".$arr["JAMKONVERSI"]."</td>";
		 echo "<td class=arial7>".$arr["USERAKSEP"]."</td>";
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
